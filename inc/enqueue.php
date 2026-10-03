<?php
/**
 * Asset Enqueue & Conditional Loading
 *
 * @package PargasPetroAb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue frontend scripts and styles.
 */
function pargas_enqueue_scripts() {
	// Main Theme Stylesheet (metadata & core tokens).
	wp_enqueue_style(
		'pargas-theme-style',
		get_stylesheet_uri(),
		array(),
		PARGAS_THEME_VERSION
	);

	// Production Frontend Stylesheet.
	wp_enqueue_style(
		'pargas-main-style',
		PARGAS_THEME_URI . '/assets/css/main.css',
		array( 'pargas-theme-style' ),
		PARGAS_THEME_VERSION
	);

	// Minimal static pages (About Us / Contact Us).
	if ( is_page() ) {
		wp_enqueue_style(
			'pargas-pages-style',
			PARGAS_THEME_URI . '/assets/css/pages.css',
			array( 'pargas-main-style' ),
			PARGAS_THEME_VERSION
		);
	}

	// Main Vanilla JavaScript (no jQuery dependency).
	wp_enqueue_script(
		'pargas-main-script',
		PARGAS_THEME_URI . '/assets/js/main.js',
		array(),
		PARGAS_THEME_VERSION,
		array(
			'strategy'  => 'defer',
			'in_footer' => true,
		)
	);

	// Localize script data for AJAX interactions (e.g. quote modal, filters).
	wp_localize_script(
		'pargas-main-script',
		'pargasThemeData',
		array(
			'ajaxUrl'    => admin_url( 'admin-ajax.php' ),
			'nonce'      => wp_create_nonce( 'pargas_frontend_nonce' ),
			'i18n'       => array(
				'menuOpened' => esc_html__( 'Navigation menu opened', 'pargaspetroab' ),
				'menuClosed' => esc_html__( 'Navigation menu closed', 'pargaspetroab' ),
				'sending'    => esc_html__( 'Sending inquiry...', 'pargaspetroab' ),
				'success'    => esc_html__( 'Thank you. Your inquiry has been transmitted successfully.', 'pargaspetroab' ),
				'error'      => esc_html__( 'An error occurred while sending. Please try again.', 'pargaspetroab' ),
			),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'pargas_enqueue_scripts' );

/**
 * Conditionally enqueue admin assets only on Project CPT edit screens.
 *
 * @param string $hook The current admin page hook.
 */
function pargas_admin_enqueue_scripts( $hook ) {
	global $post_type, $pagenow;

	if ( ( 'post.php' === $pagenow || 'post-new.php' === $pagenow ) && 'projects' === $post_type ) {
		wp_enqueue_style(
			'pargas-admin-table-style',
			PARGAS_THEME_URI . '/assets/css/admin-table.css',
			array(),
			PARGAS_THEME_VERSION
		);

		wp_enqueue_script(
			'pargas-admin-table-script',
			PARGAS_THEME_URI . '/assets/js/admin-table.js',
			array( 'jquery' ),
			PARGAS_THEME_VERSION,
			true
		);

		wp_localize_script(
			'pargas-admin-table-script',
			'pargasAdminTable',
			array(
				'ajaxUrl'       => admin_url( 'admin-ajax.php' ),
				'nonce'         => wp_create_nonce( 'pargas_table_admin_nonce' ),
				'confirmRemove' => esc_html__( 'Are you sure you want to remove this column?', 'pargaspetroab' ),
				'emptyImport'   => esc_html__( 'Please select a valid .xlsx file to import.', 'pargaspetroab' ),
			)
		);
	}
}
add_action( 'admin_enqueue_scripts', 'pargas_admin_enqueue_scripts' );
