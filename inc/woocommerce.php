<?php
/**
 * WooCommerce Custom Integration & Hooks
 *
 * Tailored for Industrial B2B equipment catalog, inquiries, and filtering.
 * Safe against missing/inactive WooCommerce plugin.
 *
 * @package PargasPetroAb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Exit early if WooCommerce is not active to prevent fatal errors on fresh installs.
if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

/**
 * Remove default WooCommerce wrapper markup and replace with clean theme containers.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

function pargas_wc_wrapper_start() {
	echo '<main id="primary" class="site-main pargas-wc-container"><div class="pargas-container">';
}
add_action( 'woocommerce_before_main_content', 'pargas_wc_wrapper_start', 10 );

function pargas_wc_wrapper_end() {
	echo '</div></main>';
}
add_action( 'woocommerce_after_main_content', 'pargas_wc_wrapper_end', 10 );

/**
 * Custom B2B Quote / Inquiry CTA button on Single Product Pages.
 */
function pargas_add_b2b_inquiry_button() {
	global $product;
	if ( ! $product ) {
		return;
	}
	$product_title = $product->get_name();
	$product_sku   = $product->get_sku();
	?>
	<div class="pargas-b2b-inquiry-box">
		<button type="button" class="pargas-btn pargas-btn-primary pargas-open-inquiry-modal" 
			data-product-id="<?php echo esc_attr( $product->get_id() ); ?>" 
			data-product-title="<?php echo esc_attr( $product_title ); ?>"
			data-product-sku="<?php echo esc_attr( $product_sku ); ?>">
			<span class="dashicons dashicons-email-alt"></span>
			<?php esc_html_e( 'Request Engineering Quote / Technical Inquiry', 'pargaspetroab' ); ?>
		</button>
		<p class="pargas-inquiry-subtext">
			<small><?php esc_html_e( 'Direct B2B procurement consultation & custom fabrication specifications available upon request.', 'pargaspetroab' ); ?></small>
		</p>
	</div>
	<?php
}
add_action( 'woocommerce_single_product_summary', 'pargas_add_b2b_inquiry_button', 35 );

/**
 * Product Query Filter: Category and Product Type filtering support.
 *
 * @param WP_Query $query The main query.
 */
function pargas_filter_product_query( $query ) {
	if ( ! is_admin() && $query->is_main_query() && function_exists( 'is_shop' ) && function_exists( 'is_product_taxonomy' ) && ( is_shop() || is_product_taxonomy() ) ) {
		$tax_query = (array) $query->get( 'tax_query' );

		// Filter by Category.
		if ( ! empty( $_GET['filter_cat'] ) ) {
			$cat_slug = sanitize_text_field( wp_unslash( $_GET['filter_cat'] ) );
			$tax_query[] = array(
				'taxonomy' => 'product_cat',
				'field'    => 'slug',
				'terms'    => $cat_slug,
			);
		}

		// Filter by Product Type.
		if ( ! empty( $_GET['filter_type'] ) ) {
			$type_slug = sanitize_text_field( wp_unslash( $_GET['filter_type'] ) );
			$tax_query[] = array(
				'taxonomy' => 'pargas_product_type',
				'field'    => 'slug',
				'terms'    => $type_slug,
			);
		}

		if ( count( $tax_query ) > 1 ) {
			$tax_query['relation'] = 'AND';
		}

		$query->set( 'tax_query', $tax_query );
	}
}
add_action( 'pre_get_posts', 'pargas_filter_product_query' );

/**
 * Handle B2B Inquiry Form Submission via AJAX.
 */
function pargas_handle_b2b_inquiry() {
	check_ajax_referer( 'pargas_frontend_nonce', 'nonce' );

	$name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$company = isset( $_POST['company'] ) ? sanitize_text_field( wp_unslash( $_POST['company'] ) ) : '';
	$phone   = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
	$email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$product = isset( $_POST['product'] ) ? sanitize_text_field( wp_unslash( $_POST['product'] ) ) : '';
	$message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

	// Simple anti-spam honeypot check.
	if ( ! empty( $_POST['pargas_hp'] ) ) {
		wp_send_json_error( array( 'message' => esc_html__( 'Spam detected.', 'pargaspetroab' ) ) );
	}

	if ( empty( $name ) || empty( $email ) || ! is_email( $email ) ) {
		wp_send_json_error( array( 'message' => esc_html__( 'Please provide a valid name and email address.', 'pargaspetroab' ) ) );
	}

	$admin_email = get_option( 'admin_email' );
	$subject     = sprintf( __( '[B2B Technical Inquiry] New request from %s for %s', 'pargaspetroab' ), $company ? $company : $name, $product ? $product : 'Water Equipment' );

	$body  = "A new engineering procurement inquiry has been submitted:\n\n";
	$body .= "Name: " . $name . "\n";
	$body .= "Company: " . $company . "\n";
	$body .= "Phone: " . $phone . "\n";
	$body .= "Email: " . $email . "\n";
	$body .= "Target Product / Plant Equipment: " . $product . "\n\n";
	$body .= "Technical Requirements / Message:\n" . $message . "\n\n";
	$body .= "--\nSent from Pargas Petro Ab Website (https://pargaspetroab.com/)";

	$headers = array( 'Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . $name . ' <' . $email . '>' );

	$sent = wp_mail( $admin_email, $subject, $body, $headers );

	if ( $sent ) {
		wp_send_json_success( array( 'message' => esc_html__( 'Thank you! Your technical inquiry has been submitted. Our engineering sales department will contact you shortly.', 'pargaspetroab' ) ) );
	} else {
		wp_send_json_error( array( 'message' => esc_html__( 'Failed to send message. Please contact us directly via phone or email.', 'pargaspetroab' ) ) );
	}
}
add_action( 'wp_ajax_pargas_submit_inquiry', 'pargas_handle_b2b_inquiry' );
add_action( 'wp_ajax_nopriv_pargas_submit_inquiry', 'pargas_handle_b2b_inquiry' );
