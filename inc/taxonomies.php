<?php
/**
 * Custom Taxonomies Registration
 *
 * @package PargasPetroAb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Taxonomies for Projects & Products.
 */
function pargas_register_taxonomies() {
	// Project Categories (e.g., Industrial Wastewater, Municipal, Petrochemical, Hospital).
	$project_cat_labels = array(
		'name'              => _x( 'Project Sectors', 'taxonomy general name', 'pargaspetroab' ),
		'singular_name'     => _x( 'Project Sector', 'taxonomy singular name', 'pargaspetroab' ),
		'search_items'      => __( 'Search Sectors', 'pargaspetroab' ),
		'all_items'         => __( 'All Sectors', 'pargaspetroab' ),
		'parent_item'       => __( 'Parent Sector', 'pargaspetroab' ),
		'parent_item_colon' => __( 'Parent Sector:', 'pargaspetroab' ),
		'edit_item'         => __( 'Edit Sector', 'pargaspetroab' ),
		'update_item'       => __( 'Update Sector', 'pargaspetroab' ),
		'add_new_item'      => __( 'Add New Project Sector', 'pargaspetroab' ),
		'new_item_name'     => __( 'New Sector Name', 'pargaspetroab' ),
		'menu_name'         => __( 'Sectors', 'pargaspetroab' ),
	);

	register_taxonomy(
		'project_category',
		array( 'projects' ),
		array(
			'hierarchical'      => true,
			'labels'            => $project_cat_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'project-sector' ),
			'show_in_rest'      => true,
		)
	);

	// Product Type Filter Taxonomy for WooCommerce products (e.g. Mechanical Equipment, Chemical Dosing, Membrane Systems, Package Plants).
	$product_type_labels = array(
		'name'              => _x( 'Product Types', 'taxonomy general name', 'pargaspetroab' ),
		'singular_name'     => _x( 'Product Type', 'taxonomy singular name', 'pargaspetroab' ),
		'search_items'      => __( 'Search Product Types', 'pargaspetroab' ),
		'all_items'         => __( 'All Product Types', 'pargaspetroab' ),
		'edit_item'         => __( 'Edit Product Type', 'pargaspetroab' ),
		'update_item'       => __( 'Update Product Type', 'pargaspetroab' ),
		'add_new_item'      => __( 'Add New Product Type', 'pargaspetroab' ),
		'new_item_name'     => __( 'New Product Type Name', 'pargaspetroab' ),
		'menu_name'         => __( 'Product Types', 'pargaspetroab' ),
	);

	register_taxonomy(
		'pargas_product_type',
		array( 'product' ),
		array(
			'hierarchical'      => true,
			'labels'            => $product_type_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'equipment-type' ),
			'show_in_rest'      => true,
		)
	);
}
add_action( 'init', 'pargas_register_taxonomies' );
