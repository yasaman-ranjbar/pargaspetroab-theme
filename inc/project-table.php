<?php
/**
 * Project Technical Table System
 *
 * Provides a lightweight, high-performance table builder integrated directly
 * into the Project CPT without relying on heavy external plugins like TablePress.
 *
 * @package PargasPetroAb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Technical Table Meta Box for Projects.
 */
function pargas_register_project_table_meta_box() {
	add_meta_box(
		'pargas_project_technical_table_box',
		__( 'Technical Specifications Table', 'pargaspetroab' ),
		'pargas_project_table_meta_box_callback',
		'projects',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'pargas_register_project_table_meta_box' );

/**
 * Render Project Technical Table Meta Box Callback.
 *
 * @param WP_Post $post Current post object.
 */
function pargas_project_table_meta_box_callback( $post ) {
	wp_nonce_field( 'pargas_save_project_table', 'pargas_project_table_nonce' );

	$table_data = get_post_meta( $post->ID, '_project_technical_table', true );
	if ( empty( $table_data ) || ! is_array( $table_data ) ) {
		// Default starter template for an industrial water treatment reference.
		$table_data = array(
			'columns' => array(
				__( 'Technical Parameter', 'pargaspetroab' ),
				__( 'Design Value', 'pargaspetroab' ),
				__( 'Unit', 'pargaspetroab' ),
				__( 'Material / Method', 'pargaspetroab' ),
			),
			'rows'    => array(
				array( __( 'Inflow Capacity', 'pargaspetroab' ), '2,500', 'm³/day', 'Continuous Flow' ),
				array( __( 'Influent COD / BOD5', 'pargaspetroab' ), '1200 / 600', 'mg/L', 'Biological Oxidation' ),
				array( __( 'Effluent Turbidity', 'pargaspetroab' ), '< 1.0', 'NTU', 'Sand & Carbon Filtration' ),
			),
		);
	}

	$json_data = wp_json_encode( $table_data );
	?>
	<div id="pargas-table-builder-app" class="pargas-admin-table-wrapper">
		<div class="pargas-admin-table-toolbar">
			<div class="pargas-toolbar-left">
				<button type="button" class="button button-primary" id="pargas-add-row-btn">
					<span class="dashicons dashicons-plus-alt"></span> <?php esc_html_e( 'Add Row', 'pargaspetroab' ); ?>
				</button>
				<button type="button" class="button" id="pargas-add-col-btn">
					<span class="dashicons dashicons-plus"></span> <?php esc_html_e( 'Add Column', 'pargaspetroab' ); ?>
				</button>
			</div>
			<div class="pargas-toolbar-right">
				<label for="pargas-excel-file-input" class="button button-secondary" id="pargas-excel-upload-label">
					<span class="dashicons dashicons-upload"></span> <?php esc_html_e( 'Import Table from Excel (.xlsx)', 'pargaspetroab' ); ?>
				</label>
				<input type="file" id="pargas-excel-file-input" accept=".xlsx" style="display: none;" />
				<span id="pargas-excel-import-spinner" class="spinner" style="float: none; margin: 0 8px;"></span>
			</div>
		</div>

		<div class="pargas-admin-table-scroll">
			<table id="pargas-admin-grid" class="widefat striped">
				<thead>
					<tr id="pargas-admin-grid-headers">
						<th class="pargas-row-num">#</th>
						<?php foreach ( $table_data['columns'] as $col_index => $col_title ) : ?>
							<th class="pargas-col-header" data-col-index="<?php echo esc_attr( $col_index ); ?>">
								<div class="pargas-header-wrap">
									<input type="text" class="pargas-col-title-input" value="<?php echo esc_attr( $col_title ); ?>" />
									<button type="button" class="pargas-remove-col-btn" title="<?php esc_attr_e( 'Remove column', 'pargaspetroab' ); ?>">&times;</button>
								</div>
							</th>
						<?php endforeach; ?>
						<th class="pargas-action-col"><?php esc_html_e( 'Action', 'pargaspetroab' ); ?></th>
					</tr>
				</thead>
				<tbody id="pargas-admin-grid-body">
					<?php foreach ( $table_data['rows'] as $row_index => $row_cells ) : ?>
						<tr class="pargas-data-row" data-row-index="<?php echo esc_attr( $row_index ); ?>">
							<td class="pargas-row-num"><?php echo esc_html( $row_index + 1 ); ?></td>
							<?php foreach ( $table_data['columns'] as $col_index => $unused ) : ?>
								<?php $cell_value = isset( $row_cells[ $col_index ] ) ? $row_cells[ $col_index ] : ''; ?>
								<td class="pargas-data-cell" data-col-index="<?php echo esc_attr( $col_index ); ?>">
									<input type="text" class="pargas-cell-input" value="<?php echo esc_attr( $cell_value ); ?>" />
								</td>
							<?php endforeach; ?>
							<td class="pargas-action-col">
								<button type="button" class="pargas-remove-row-btn button-link-delete" title="<?php esc_attr_e( 'Delete row', 'pargaspetroab' ); ?>">
									<span class="dashicons dashicons-trash"></span>
								</button>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>

		<!-- Hidden input holding JSON state synchronized on save -->
		<textarea name="pargas_technical_table_json" id="pargas_technical_table_json" style="display: none;"><?php echo esc_textarea( $json_data ); ?></textarea>

		<p class="description" style="margin-top: 10px;">
			<?php esc_html_e( 'Edit cells directly or import an Excel (.xlsx) file. Columns and rows can be adjusted dynamically and are saved securely.', 'pargaspetroab' ); ?>
		</p>
	</div>
	<?php
}

/**
 * Save Project Technical Table Data.
 *
 * @param int $post_id Post ID.
 */
function pargas_save_project_table_data( $post_id ) {
	if ( ! isset( $_POST['pargas_project_table_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( sanitize_key( $_POST['pargas_project_table_nonce'] ), 'pargas_save_project_table' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['pargas_technical_table_json'] ) ) {
		$raw_json = wp_unslash( $_POST['pargas_technical_table_json'] ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		$decoded  = json_decode( $raw_json, true );

		if ( is_array( $decoded ) && isset( $decoded['columns'] ) && isset( $decoded['rows'] ) ) {
			$sanitized_columns = array();
			foreach ( $decoded['columns'] as $col ) {
				$sanitized_columns[] = sanitize_text_field( $col );
			}

			$sanitized_rows = array();
			foreach ( $decoded['rows'] as $row ) {
				if ( is_array( $row ) ) {
					$clean_row = array();
					foreach ( $row as $cell ) {
						// Clean cell text without allowing arbitrary formula or script execution.
						$clean_row[] = sanitize_text_field( $cell );
					}
					$sanitized_rows[] = $clean_row;
				}
			}

			$clean_table = array(
				'columns' => $sanitized_columns,
				'rows'    => $sanitized_rows,
			);

			update_post_meta( $post_id, '_project_technical_table', $clean_table );
		}
	}
}
add_action( 'save_post_projects', 'pargas_save_project_table_data' );

/**
 * Frontend Renderer for Project Technical Table.
 *
 * @param int $post_id Project Post ID.
 * @return string Rendered HTML table.
 */
function pargas_render_project_table( $post_id ) {
	$table = get_post_meta( $post_id, '_project_technical_table', true );

	if ( empty( $table ) || ! is_array( $table ) || empty( $table['columns'] ) || empty( $table['rows'] ) ) {
		return '';
	}

	ob_start();
	?>
	<div class="pargas-technical-table-container">
		<div class="pargas-table-scroll-wrapper" tabindex="0" role="region" aria-label="<?php esc_attr_e( 'Project Technical Specifications Table', 'pargaspetroab' ); ?>">
			<table class="pargas-technical-table">
				<thead>
					<tr>
						<?php foreach ( $table['columns'] as $col ) : ?>
							<th scope="col"><?php echo esc_html( $col ); ?></th>
						<?php endforeach; ?>
					</tr>
				</thead>
				<tbody>
					<?php foreach ( $table['rows'] as $row ) : ?>
						<tr>
							<?php foreach ( $table['columns'] as $idx => $unused ) : ?>
								<?php $cell = isset( $row[ $idx ] ) ? $row[ $idx ] : ''; ?>
								<td><?php echo esc_html( $cell ); ?></td>
							<?php endforeach; ?>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<div class="pargas-table-scroll-hint" aria-hidden="true">
			<span>&larr; <?php esc_html_e( 'Scroll horizontally to view complete specifications', 'pargaspetroab' ); ?> &rarr;</span>
		</div>
	</div>
	<?php
	return ob_get_clean();
}
