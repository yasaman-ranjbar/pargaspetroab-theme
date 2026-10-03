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

/**
 * Fallback menu if no WordPress menu is assigned yet.
 */
if ( ! function_exists( 'pargas_fallback_desktop_menu' ) ) {
	function pargas_fallback_desktop_menu() {
		?>
		<ul class="pargas-nav-list" id="primary-menu">
			<li class="menu-item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'pargaspetroab' ); ?></a></li>
			<li class="menu-item menu-item-has-children">
				<a href="<?php echo esc_url( home_url( '/products/' ) ); ?>"><?php esc_html_e( 'Products & Equipment', 'pargaspetroab' ); ?></a>
				<ul class="sub-menu">
					<li><a href="<?php echo esc_url( home_url( '/product-category/wastewater-packages/' ) ); ?>"><?php esc_html_e( 'Sewage Treatment Packages (MBBR/MBR)', 'pargaspetroab' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/product-category/sand-carbon-filters/' ) ); ?>"><?php esc_html_e( 'Sand & Activated Carbon Filters', 'pargaspetroab' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/product-category/daf-systems/' ) ); ?>"><?php esc_html_e( 'DAF (Dissolved Air Flotation)', 'pargaspetroab' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/product-category/ro-plants/' ) ); ?>"><?php esc_html_e( 'Industrial Reverse Osmosis (RO)', 'pargaspetroab' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/product-category/sludge-dewatering/' ) ); ?>"><?php esc_html_e( 'Filter Press & Dewatering', 'pargaspetroab' ); ?></a></li>
				</ul>
			</li>
			<li class="menu-item"><a href="<?php echo esc_url( home_url( '/projects/' ) ); ?>"><?php esc_html_e( 'Projects & References', 'pargaspetroab' ); ?></a></li>
			<li class="menu-item"><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'Technical Articles', 'pargaspetroab' ); ?></a></li>
			<li class="menu-item"><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About Us', 'pargaspetroab' ); ?></a></li>
			<li class="menu-item"><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact Us', 'pargaspetroab' ); ?></a></li>
		</ul>
		<?php
	}
}
