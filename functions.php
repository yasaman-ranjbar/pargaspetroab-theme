<?php
/**
 * Pargas Petro Ab - Custom Theme Bootstrap
 *
 * @package PargasPetroAb
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Define Theme Constants.
define( 'PARGAS_THEME_VERSION', '1.0.0' );
define( 'PARGAS_THEME_DIR', get_template_directory() );
define( 'PARGAS_THEME_URI', get_template_directory_uri() );

/**
 * Require Theme Modules.
 */
require_once PARGAS_THEME_DIR . '/inc/setup.php';
require_once PARGAS_THEME_DIR . '/inc/enqueue.php';
require_once PARGAS_THEME_DIR . '/inc/post-types.php';
require_once PARGAS_THEME_DIR . '/inc/taxonomies.php';
require_once PARGAS_THEME_DIR . '/inc/project-fields.php';
require_once PARGAS_THEME_DIR . '/inc/project-table.php';
require_once PARGAS_THEME_DIR . '/inc/excel-import.php';
require_once PARGAS_THEME_DIR . '/inc/seo.php';

// Include WooCommerce module only when WooCommerce plugin is active.
if ( class_exists( 'WooCommerce' ) ) {
	require_once PARGAS_THEME_DIR . '/inc/woocommerce.php';
}
