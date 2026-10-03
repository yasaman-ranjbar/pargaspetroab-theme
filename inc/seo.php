<?php
/**
 * SEO Integration & Yoast SEO Premium Compatibility
 *
 * Adheres strictly to the principle of non-duplication:
 * Yoast SEO Premium manages all OpenGraph, Twitter Cards, Canonical URLs,
 * and JSON-LD schema graphs.
 *
 * @package PargasPetroAb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Display Yoast Breadcrumbs with semantic wrapper, or fallback to clean accessible trail.
 */
function pargas_render_breadcrumbs() {
	if ( is_front_page() ) {
		return;
	}

	echo '<nav class="pargas-breadcrumbs-nav" aria-label="' . esc_attr__( 'Breadcrumbs', 'pargaspetroab' ) . '">';
	echo '<div class="pargas-container">';

	if ( function_exists( 'yoast_breadcrumb' ) ) {
		yoast_breadcrumb( '<div class="pargas-breadcrumbs">', '</div>' );
	} else {
		// Native semantic fallback when Yoast is not active.
		echo '<ol class="pargas-breadcrumbs" itemscope itemtype="https://schema.org/BreadcrumbList">';
		echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
		echo '<a itemprop="item" href="' . esc_url( home_url( '/' ) ) . '"><span itemprop="name">' . esc_html__( 'Home', 'pargaspetroab' ) . '</span></a>';
		echo '<meta itemprop="position" content="1" />';
		echo '</li>';

		$position = 2;
		if ( is_singular( 'projects' ) ) {
			echo '<li class="separator">/</li>';
			echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
			echo '<a itemprop="item" href="' . esc_url( get_post_type_archive_link( 'projects' ) ) . '"><span itemprop="name">' . esc_html__( 'Projects & References', 'pargaspetroab' ) . '</span></a>';
			echo '<meta itemprop="position" content="' . esc_attr( $position++ ) . '" />';
			echo '</li>';

			echo '<li class="separator">/</li>';
			echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" aria-current="page">';
			echo '<span itemprop="name">' . esc_html( get_the_title() ) . '</span>';
			echo '<meta itemprop="position" content="' . esc_attr( $position ) . '" />';
			echo '</li>';
		} elseif ( is_post_type_archive( 'projects' ) ) {
			echo '<li class="separator">/</li>';
			echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" aria-current="page">';
			echo '<span itemprop="name">' . esc_html__( 'Projects & References', 'pargaspetroab' ) . '</span>';
			echo '<meta itemprop="position" content="' . esc_attr( $position ) . '" />';
			echo '</li>';
		} elseif ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
			if ( is_product() ) {
				echo '<li class="separator">/</li>';
				echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
				echo '<a itemprop="item" href="' . esc_url( wc_get_page_permalink( 'shop' ) ) . '"><span itemprop="name">' . esc_html__( 'Equipment Catalog', 'pargaspetroab' ) . '</span></a>';
				echo '<meta itemprop="position" content="' . esc_attr( $position++ ) . '" />';
				echo '</li>';

				echo '<li class="separator">/</li>';
				echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" aria-current="page">';
				echo '<span itemprop="name">' . esc_html( get_the_title() ) . '</span>';
				echo '<meta itemprop="position" content="' . esc_attr( $position ) . '" />';
				echo '</li>';
			} else {
				echo '<li class="separator">/</li>';
				echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" aria-current="page">';
				echo '<span itemprop="name">' . esc_html__( 'Equipment Catalog', 'pargaspetroab' ) . '</span>';
				echo '<meta itemprop="position" content="' . esc_attr( $position ) . '" />';
				echo '</li>';
			}
		} elseif ( is_page() ) {
			echo '<li class="separator">/</li>';
			echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" aria-current="page">';
			echo '<span itemprop="name">' . esc_html( get_the_title() ) . '</span>';
			echo '<meta itemprop="position" content="' . esc_attr( $position ) . '" />';
			echo '</li>';
		} elseif ( is_single() ) {
			echo '<li class="separator">/</li>';
			echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" aria-current="page">';
			echo '<span itemprop="name">' . esc_html( get_the_title() ) . '</span>';
			echo '<meta itemprop="position" content="' . esc_attr( $position ) . '" />';
			echo '</li>';
		}

		echo '</ol>';
	}

	echo '</div>';
	echo '</nav>';
}

/**
 * Filter Yoast SEO Schema graph to integrate Pargas Petro Ab Organization metadata if needed.
 *
 * @param array $pieces Schema graph pieces.
 * @return array Modified pieces.
 */
function pargas_enhance_yoast_schema( $pieces ) {
	// Yoast takes care of Organization, WebSite, and WebPage schema automatically.
	// We ensure our theme coordinates seamlessly without conflict.
	return $pieces;
}
add_filter( 'wpseo_schema_graph', 'pargas_enhance_yoast_schema', 11, 1 );
