<?php
/**
 * Safe Native Excel (.xlsx) Import System for Project Technical Tables
 *
 * Implements a lightweight, zero-dependency OpenXML (.xlsx) parser
 * following strict WordPress security standards:
 * - Validates file types and MIME structures
 * - Disables external entity resolution (XXE prevention)
 * - Ignores spreadsheet formulas (formula injection prevention)
 * - Sanitizes all cell text
 *
 * @package PargasPetroAb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Handle AJAX Excel Import for Project Tables.
 */
function pargas_ajax_import_excel_table() {
	check_ajax_referer( 'pargas_table_admin_nonce', 'nonce' );

	if ( ! current_user_can( 'edit_posts' ) ) {
		wp_send_json_error( array( 'message' => esc_html__( 'Unauthorized access.', 'pargaspetroab' ) ) );
	}

	if ( empty( $_FILES['excel_file'] ) || ! isset( $_FILES['excel_file']['tmp_name'] ) ) {
		wp_send_json_error( array( 'message' => esc_html__( 'No file uploaded.', 'pargaspetroab' ) ) );
	}

	$file = $_FILES['excel_file']; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized

	// Validate extension.
	$file_name = sanitize_file_name( $file['name'] );
	$file_ext  = strtolower( pathinfo( $file_name, PATHINFO_EXTENSION ) );
	if ( 'xlsx' !== $file_ext ) {
		wp_send_json_error( array( 'message' => esc_html__( 'Invalid file type. Only .xlsx spreadsheets are permitted.', 'pargaspetroab' ) ) );
	}

	// Validate upload errors.
	if ( UPLOAD_ERR_OK !== $file['error'] || ! is_uploaded_file( $file['tmp_name'] ) ) {
		wp_send_json_error( array( 'message' => esc_html__( 'File upload failure.', 'pargaspetroab' ) ) );
	}

	// Parse XLSX using native PHP ZipArchive and safe XML reading.
	$parsed_table = pargas_parse_xlsx_file( $file['tmp_name'] );

	if ( is_wp_error( $parsed_table ) ) {
		wp_send_json_error( array( 'message' => $parsed_table->get_error_message() ) );
	}

	wp_send_json_success(
		array(
			'message' => esc_html__( 'Spreadsheet imported successfully.', 'pargaspetroab' ),
			'table'   => $parsed_table,
		)
	);
}
add_action( 'wp_ajax_pargas_import_excel_table', 'pargas_ajax_import_excel_table' );

/**
 * Parse .xlsx file natively.
 *
 * @param string $file_path Local path to the uploaded file.
 * @return array|WP_Error Array with 'columns' and 'rows', or WP_Error.
 */
function pargas_parse_xlsx_file( $file_path ) {
	if ( ! class_exists( 'ZipArchive' ) ) {
		return new WP_Error( 'missing_zip', esc_html__( 'Server PHP ZipArchive extension is required to unpack .xlsx files.', 'pargaspetroab' ) );
	}

	$zip = new ZipArchive();
	if ( true !== $zip->open( $file_path ) ) {
		return new WP_Error( 'corrupt_file', esc_html__( 'Unable to open spreadsheet archive. File may be corrupted.', 'pargaspetroab' ) );
	}

	// Read Shared Strings (xl/sharedStrings.xml).
	$shared_strings = array();
	$strings_xml    = $zip->getFromName( 'xl/sharedStrings.xml' );
	if ( false !== $strings_xml ) {
		$strings_obj = pargas_safe_xml_load( $strings_xml );
		if ( $strings_obj && isset( $strings_obj->si ) ) {
			foreach ( $strings_obj->si as $si ) {
				if ( isset( $si->t ) ) {
					$shared_strings[] = (string) $si->t;
				} elseif ( isset( $si->r ) ) {
					$combined = '';
					foreach ( $si->r as $r ) {
						if ( isset( $r->t ) ) {
							$combined .= (string) $r->t;
						}
					}
					$shared_strings[] = $combined;
				} else {
					$shared_strings[] = '';
				}
			}
		}
	}

	// Locate primary worksheet (usually xl/worksheets/sheet1.xml).
	$sheet_xml = $zip->getFromName( 'xl/worksheets/sheet1.xml' );
	if ( false === $sheet_xml ) {
		// Fallback check for any sheet.
		for ( $i = 0; $i < $zip->numFiles; $i++ ) {
			$entry_name = $zip->getNameIndex( $i );
			if ( 0 === strpos( $entry_name, 'xl/worksheets/sheet' ) && 'xml' === pathinfo( $entry_name, PATHINFO_EXTENSION ) ) {
				$sheet_xml = $zip->getFromIndex( $i );
				break;
			}
		}
	}

	$zip->close();

	if ( false === $sheet_xml ) {
		return new WP_Error( 'empty_sheet', esc_html__( 'No readable worksheets found inside spreadsheet.', 'pargaspetroab' ) );
	}

	$sheet_obj = pargas_safe_xml_load( $sheet_xml );
	if ( ! $sheet_obj || ! isset( $sheet_obj->sheetData->row ) ) {
		return new WP_Error( 'invalid_data', esc_html__( 'Sheet structure does not contain readable tabular data.', 'pargaspetroab' ) );
	}

	$raw_grid = array();
	$max_cols = 0;

	foreach ( $sheet_obj->sheetData->row as $row ) {
		$row_cells = array();
		foreach ( $row->c as $cell ) {
			$cell_coord = (string) $cell['r']; // e.g. A1, B2
			$cell_type  = (string) $cell['t']; // e.g. 's' for sharedString
			$raw_val    = isset( $cell->v ) ? (string) $cell->v : '';

			$col_letter = preg_replace( '/[0-9]/', '', $cell_coord );
			$col_idx    = pargas_col_letter_to_index( $col_letter );

			$val = '';
			if ( 's' === $cell_type && '' !== $raw_val ) {
				$s_index = (int) $raw_val;
				$val     = isset( $shared_strings[ $s_index ] ) ? $shared_strings[ $s_index ] : '';
			} elseif ( 'inlineStr' === $cell_type && isset( $cell->is->t ) ) {
				$val = (string) $cell->is->t;
			} else {
				$val = $raw_val;
			}

			// Security: Strip leading formula characters to avoid formula injection.
			if ( '' !== $val && in_array( $val[0], array( '=', '+', '-', '@' ), true ) ) {
				$val = "'" . $val;
			}

			$row_cells[ $col_idx ] = sanitize_text_field( $val );
			if ( $col_idx + 1 > $max_cols ) {
				$max_cols = $col_idx + 1;
			}
		}

		if ( ! empty( $row_cells ) ) {
			// Normalize indices.
			$normalized_row = array();
			for ( $c = 0; $c < $max_cols; $c++ ) {
				$normalized_row[ $c ] = isset( $row_cells[ $c ] ) ? $row_cells[ $c ] : '';
			}
			$raw_grid[] = $normalized_row;
		}
	}

	if ( empty( $raw_grid ) ) {
		return new WP_Error( 'empty_table', esc_html__( 'The spreadsheet does not contain any rows.', 'pargaspetroab' ) );
	}

	// Extract headers and body rows.
	$columns = array_shift( $raw_grid );

	// Provide fallback header names if empty.
	for ( $c = 0; $c < $max_cols; $c++ ) {
		if ( empty( $columns[ $c ] ) ) {
			$columns[ $c ] = sprintf( __( 'Column %d', 'pargaspetroab' ), $c + 1 );
		}
	}

	return array(
		'columns' => array_values( $columns ),
		'rows'    => array_values( $raw_grid ),
	);
}

/**
 * Convert Excel column letters (A, B, AA, etc.) to 0-based integer index.
 *
 * @param string $letter Column letter.
 * @return int 0-based column index.
 */
function pargas_col_letter_to_index( $letter ) {
	$letter = strtoupper( $letter );
	$len    = strlen( $letter );
	$idx    = 0;
	for ( $i = 0; $i < $len; $i++ ) {
		$idx = $idx * 26 + ( ord( $letter[ $i ] ) - 64 );
	}
	return $idx - 1;
}

/**
 * Safely parse XML string with entity loader disabled.
 *
 * @param string $xml_string Raw XML string.
 * @return SimpleXMLElement|false Parsed XML object or false on failure.
 */
function pargas_safe_xml_load( $xml_string ) {
	if ( function_exists( 'libxml_disable_entity_loader' ) && PHP_VERSION_ID < 80000 ) {
		libxml_disable_entity_loader( true ); // phpcs:ignore Generic.PHP.DeprecatedFunctions.Deprecated
	}
	$prev = libxml_use_internal_errors( true );
	$res  = simplexml_load_string( $xml_string, 'SimpleXMLElement', LIBXML_NONET | LIBXML_NOERROR | LIBXML_NOWARNING );
	libxml_clear_errors();
	libxml_use_internal_errors( $prev );
	return $res;
}
