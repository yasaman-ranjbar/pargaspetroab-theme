<?php
/**
 * Theme Setup & Feature Registration
 *
 * @package PargasPetroAb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Setup theme features.
 */
function pargas_theme_setup() {
	// Internationalization support.
	load_theme_textdomain( 'pargaspetroab', PARGAS_THEME_DIR . '/languages' );

	// Document title management.
	add_theme_support( 'title-tag' );

	// Featured images.
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'pargas-project-card', 640, 420, true );
	add_image_size( 'pargas-product-card', 520, 440, true );
	add_image_size( 'pargas-hero-banner', 1920, 800, true );

	// Custom logo.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 80,
			'width'       => 280,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	// HTML5 markup support.
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Responsive embeds.
	add_theme_support( 'responsive-embeds' );

	// WooCommerce Theme Support.
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	// Register Navigation Menus.
	register_nav_menus(
		array(
			'primary'         => esc_html__( 'Primary Desktop Menu', 'pargaspetroab' ),
			'mobile'          => esc_html__( 'Mobile Drawer Menu', 'pargaspetroab' ),
			'footer_quick'    => esc_html__( 'Footer Quick Links', 'pargaspetroab' ),
			'footer_products' => esc_html__( 'Footer Equipment Categories', 'pargaspetroab' ),
		)
	);
}
add_action( 'after_setup_theme', 'pargas_theme_setup' );

/**
 * Set max content width for media.
 */
function pargas_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'pargas_content_width', 1280 );
}
add_action( 'after_setup_theme', 'pargas_content_width', 0 );
