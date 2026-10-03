<?php
/**
 * Custom Post Types Registration
 *
 * @package PargasPetroAb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Projects CPT.
 */
function pargas_register_project_cpt() {
	$labels = array(
		'name'                  => _x( 'Projects & References', 'Post type general name', 'pargaspetroab' ),
		'singular_name'         => _x( 'Project', 'Post type singular name', 'pargaspetroab' ),
		'menu_name'             => _x( 'Projects', 'Admin Menu text', 'pargaspetroab' ),
		'name_admin_bar'        => _x( 'Project', 'Add New on Toolbar', 'pargaspetroab' ),
		'add_new'               => __( 'Add New Project', 'pargaspetroab' ),
		'add_new_item'          => __( 'Add New Project Reference', 'pargaspetroab' ),
		'new_item'              => __( 'New Project', 'pargaspetroab' ),
		'edit_item'             => __( 'Edit Project', 'pargaspetroab' ),
		'view_item'             => __( 'View Project', 'pargaspetroab' ),
		'all_items'             => __( 'All Projects', 'pargaspetroab' ),
		'search_items'          => __( 'Search Projects', 'pargaspetroab' ),
		'parent_item_colon'     => __( 'Parent Projects:', 'pargaspetroab' ),
		'not_found'             => __( 'No projects found.', 'pargaspetroab' ),
		'not_found_in_trash'    => __( 'No projects found in Trash.', 'pargaspetroab' ),
		'featured_image'        => _x( 'Project Cover Image', 'Overrides the "Featured Image" phrase for this post type.', 'pargaspetroab' ),
		'set_featured_image'    => _x( 'Set project cover image', 'Overrides the "Set featured image" phrase.', 'pargaspetroab' ),
		'remove_featured_image' => _x( 'Remove project cover image', 'Overrides the "Remove featured image" phrase.', 'pargaspetroab' ),
		'use_featured_image'    => _x( 'Use as project cover image', 'Overrides the "Use as featured image" phrase.', 'pargaspetroab' ),
		'archives'              => _x( 'Project Archives', 'The post type archive label used in nav menus.', 'pargaspetroab' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array(
			'slug'       => 'projects',
			'with_front' => false,
		),
		'capability_type'    => 'post',
		'has_archive'        => 'projects',
		'hierarchical'       => false,
		'menu_position'      => 20,
		'menu_icon'          => 'dashicons-hammer',
		'show_in_rest'       => true,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' ),
	);

	register_post_type( 'projects', $args );
}
add_action( 'init', 'pargas_register_project_cpt' );
