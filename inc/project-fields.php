<?php
/**
 * Project Custom Fields & Meta Box Registration
 *
 * @package PargasPetroAb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register meta boxes for Project CPT.
 */
function pargas_register_project_meta_boxes() {
	add_meta_box(
		'pargas_project_details',
		__( 'Project Engineering & Reference Details', 'pargaspetroab' ),
		'pargas_project_details_callback',
		'projects',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'pargas_register_project_meta_boxes' );

/**
 * Render Project Details Meta Box.
 *
 * @param WP_Post $post Current post object.
 */
function pargas_project_details_callback( $post ) {
	// Add nonce for verification.
	wp_nonce_field( 'pargas_save_project_details', 'pargas_project_details_nonce' );

	$client   = get_post_meta( $post->ID, '_project_client', true );
	$year     = get_post_meta( $post->ID, '_project_year', true );
	$capacity = get_post_meta( $post->ID, '_project_capacity', true );
	$location = get_post_meta( $post->ID, '_project_location', true );
	$status   = get_post_meta( $post->ID, '_project_status', true );
	?>
	<div class="pargas-meta-box-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px; padding: 10px 0;">
		<div class="pargas-field-group">
			<label for="pargas_project_client" style="display: block; font-weight: 600; margin-bottom: 6px;">
				<?php esc_html_e( 'Client / Employer:', 'pargaspetroab' ); ?>
			</label>
			<input type="text" id="pargas_project_client" name="pargas_project_client" value="<?php echo esc_attr( $client ); ?>" style="width: 100%;" placeholder="<?php esc_attr_e( 'e.g. National Petrochemical Company', 'pargaspetroab' ); ?>" />
		</div>

		<div class="pargas-field-group">
			<label for="pargas_project_year" style="display: block; font-weight: 600; margin-bottom: 6px;">
				<?php esc_html_e( 'Execution Year:', 'pargaspetroab' ); ?>
			</label>
			<input type="text" id="pargas_project_year" name="pargas_project_year" value="<?php echo esc_attr( $year ); ?>" style="width: 100%;" placeholder="<?php esc_attr_e( 'e.g. 2023 / 1402', 'pargaspetroab' ); ?>" />
		</div>

		<div class="pargas-field-group">
			<label for="pargas_project_capacity" style="display: block; font-weight: 600; margin-bottom: 6px;">
				<?php esc_html_e( 'Treatment Capacity:', 'pargaspetroab' ); ?>
			</label>
			<input type="text" id="pargas_project_capacity" name="pargas_project_capacity" value="<?php echo esc_attr( $capacity ); ?>" style="width: 100%;" placeholder="<?php esc_attr_e( 'e.g. 5,000 m³/day or 200 m³/hr', 'pargaspetroab' ); ?>" />
		</div>

		<div class="pargas-field-group">
			<label for="pargas_project_location" style="display: block; font-weight: 600; margin-bottom: 6px;">
				<?php esc_html_e( 'Project Location / Plant Site:', 'pargaspetroab' ); ?>
			</label>
			<input type="text" id="pargas_project_location" name="pargas_project_location" value="<?php echo esc_attr( $location ); ?>" style="width: 100%;" placeholder="<?php esc_attr_e( 'e.g. Asaluyeh, Bushehr', 'pargaspetroab' ); ?>" />
		</div>

		<div class="pargas-field-group">
			<label for="pargas_project_status" style="display: block; font-weight: 600; margin-bottom: 6px;">
				<?php esc_html_e( 'Operational Status:', 'pargaspetroab' ); ?>
			</label>
			<select id="pargas_project_status" name="pargas_project_status" style="width: 100%;">
				<option value="Operational" <?php selected( $status, 'Operational' ); ?>><?php esc_html_e( 'Operational / Commissioned', 'pargaspetroab' ); ?></option>
				<option value="Under Construction" <?php selected( $status, 'Under Construction' ); ?>><?php esc_html_e( 'Under Construction / Execution', 'pargaspetroab' ); ?></option>
				<option value="Completed" <?php selected( $status, 'Completed' ); ?>><?php esc_html_e( 'Completed', 'pargaspetroab' ); ?></option>
			</select>
		</div>
	</div>
	<?php
}

/**
 * Save Project Details.
 *
 * @param int $post_id Post ID.
 */
function pargas_save_project_details( $post_id ) {
	if ( ! isset( $_POST['pargas_project_details_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( sanitize_key( $_POST['pargas_project_details_nonce'] ), 'pargas_save_project_details' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$fields = array(
		'pargas_project_client'   => '_project_client',
		'pargas_project_year'     => '_project_year',
		'pargas_project_capacity' => '_project_capacity',
		'pargas_project_location' => '_project_location',
		'pargas_project_status'   => '_project_status',
	);

	foreach ( $fields as $input_name => $meta_key ) {
		if ( isset( $_POST[ $input_name ] ) ) {
			$value = sanitize_text_field( wp_unslash( $_POST[ $input_name ] ) );
			update_post_meta( $post_id, $meta_key, $value );
		}
	}
}
add_action( 'save_post_projects', 'pargas_save_project_details' );
