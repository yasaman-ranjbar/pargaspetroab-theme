<?php
/**
 * Template Name: Contact Us
 *
 * Dedicated Contact & Factory Inquiries Page with secure nonce-verified
 * form submission, spam protection, and lazy-loaded Google Maps embed.
 *
 * @package PargasPetroAb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$form_success = false;
$form_error   = false;
$error_msg    = '';

// Process secure POST submission if submitted directly.
if ( 'POST' === $_SERVER['REQUEST_METHOD'] && isset( $_POST['pargas_contact_submit'] ) ) {
	if ( ! isset( $_POST['pargas_contact_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['pargas_contact_nonce'] ), 'pargas_contact_action' ) ) {
		$form_error = true;
		$error_msg  = __( 'Security verification failed. Please refresh and try again.', 'pargaspetroab' );
	} elseif ( ! empty( $_POST['pargas_contact_hp'] ) ) {
		$form_error = true;
		$error_msg  = __( 'Automated spam submission detected.', 'pargaspetroab' );
	} else {
		$name    = isset( $_POST['contact_name'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_name'] ) ) : '';
		$company = isset( $_POST['contact_company'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_company'] ) ) : '';
		$phone   = isset( $_POST['contact_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_phone'] ) ) : '';
		$email   = isset( $_POST['contact_email'] ) ? sanitize_email( wp_unslash( $_POST['contact_email'] ) ) : '';
		$subject = isset( $_POST['contact_subject'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_subject'] ) ) : '';
		$message = isset( $_POST['contact_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['contact_message'] ) ) : '';

		if ( empty( $name ) || empty( $email ) || ! is_email( $email ) || empty( $message ) ) {
			$form_error = true;
			$error_msg  = __( 'Please complete all required fields with valid information.', 'pargaspetroab' );
		} else {
			$to          = get_option( 'admin_email' );
			$mail_sub    = sprintf( __( '[Pargas Petro Ab Inquiry] %s (%s)', 'pargaspetroab' ), $subject ? $subject : 'Website Contact', $company ? $company : $name );
			$mail_body   = "New B2B Procurement / Technical Inquiry:\n\n";
			$mail_body  .= "Name: " . $name . "\n";
			$mail_body  .= "Company / Organization: " . $company . "\n";
			$mail_body  .= "Phone: " . $phone . "\n";
			$mail_body  .= "Email: " . $email . "\n";
			$mail_body  .= "Subject: " . $subject . "\n\n";
			$mail_body  .= "Message / Specifications:\n" . $message . "\n\n";
			$mail_body  .= "--\nSent from Pargas Petro Ab Contact Form (https://pargaspetroab.com/)";

			$headers = array(
				'Content-Type: text/plain; charset=UTF-8',
				'Reply-To: ' . $name . ' <' . $email . '>',
			);

			if ( wp_mail( $to, $mail_sub, $mail_body, $headers ) ) {
				$form_success = true;
			} else {
				$form_error = true;
				$error_msg  = __( 'Unable to send message due to a server transmission issue. Please call our sales team directly.', 'pargaspetroab' );
			}
		}
	}
}

get_header();
?>

<main id="primary" class="site-main pargas-contact-page">
	<div class="pargas-page-banner">
		<div class="pargas-container">
			<span class="pargas-subheading"><?php esc_html_e( 'Engineering Sales & Manufacturing Support', 'pargaspetroab' ); ?></span>
			<h1 class="pargas-page-title"><?php esc_html_e( 'Contact Pargas Petro Ab', 'pargaspetroab' ); ?></h1>
			<p class="pargas-page-intro">
				<?php esc_html_e( 'Connect with our technical engineering consultants for inquiries, custom plant equipment specifications, or factory site visits.', 'pargaspetroab' ); ?>
			</p>
		</div>
	</div>

	<div class="pargas-container pargas-py-8">
		<div class="pargas-contact-layout">
			<!-- Contact Information & Company Cards -->
			<div class="pargas-contact-info-panel">
				<div class="pargas-contact-card">
					<h3>📍 <?php esc_html_e( 'Tehran Commercial & Engineering HQ', 'pargaspetroab' ); ?></h3>
					<p><?php esc_html_e( 'Shahid Motahari St, Delara St, Mirza Shirazi St, No. 24, 2nd Floor, Tehran, Iran', 'pargaspetroab' ); ?></p>
					<div class="pargas-card-contact-line">
						<strong><?php esc_html_e( 'Central Office Phone:', 'pargaspetroab' ); ?></strong>
						<a href="tel:+982191091286" dir="ltr">+98 (21) 9109 1286</a>
					</div>
					<div class="pargas-card-contact-line">
						<strong><?php esc_html_e( 'Postal Code:', 'pargaspetroab' ); ?></strong>
						<span dir="ltr">1596975113</span>
					</div>
				</div>

				<div class="pargas-contact-card">
					<h3>🏭 <?php esc_html_e( 'Najafabad Manufacturing Facility', 'pargaspetroab' ); ?></h3>
					<p><?php esc_html_e( '3rd St, Kaveh Industrial Estate, Najafabad County, Isfahan Province, Iran', 'pargaspetroab' ); ?></p>
					<div class="pargas-card-contact-line">
						<strong><?php esc_html_e( 'Factory Direct:', 'pargaspetroab' ); ?></strong>
						<a href="tel:+982191091286" dir="ltr">+98 (21) 9109 1286</a>
					</div>
					<div class="pargas-card-contact-line">
						<strong><?php esc_html_e( 'Working Hours:', 'pargaspetroab' ); ?></strong>
						<span><?php esc_html_e( 'Saturday – Wednesday: 07:00 – 16:00 | Thursday: 07:00 – 13:00', 'pargaspetroab' ); ?></span>
					</div>
				</div>

				<div class="pargas-contact-card">
					<h3>✉️ <?php esc_html_e( 'Direct Communications', 'pargaspetroab' ); ?></h3>
					<div class="pargas-card-contact-line">
						<strong><?php esc_html_e( 'General & Procurement:', 'pargaspetroab' ); ?></strong>
						<a href="mailto:info@pargaspetroab.com">info@pargaspetroab.com</a>
					</div>
					<div class="pargas-card-contact-line">
						<strong><?php esc_html_e( 'WhatsApp Engineering Hotline:', 'pargaspetroab' ); ?></strong>
						<a href="https://wa.me/989124388097" target="_blank" rel="noopener noreferrer" dir="ltr">+98 912 438 8097</a>
					</div>
				</div>
			</div>

			<!-- Contact Form -->
			<div class="pargas-contact-form-panel">
				<div class="pargas-form-box">
					<h2><?php esc_html_e( 'Send a Direct Technical Inquiry', 'pargaspetroab' ); ?></h2>
					<p><?php esc_html_e( 'Fill out the form below to receive detailed technical catalogues, pricing proposals, or project feasibility advice.', 'pargaspetroab' ); ?></p>

					<?php if ( $form_success ) : ?>
						<div class="pargas-alert pargas-alert-success" role="alert">
							<strong><?php esc_html_e( 'Inquiry Received!', 'pargaspetroab' ); ?></strong>
							<?php esc_html_e( 'Thank you for reaching out. An engineering consultant from Pargas Petro Ab will contact you within 24 hours.', 'pargaspetroab' ); ?>
						</div>
					<?php elseif ( $form_error ) : ?>
						<div class="pargas-alert pargas-alert-danger" role="alert">
							<?php echo esc_html( $error_msg ); ?>
						</div>
					<?php endif; ?>

					<form method="post" action="<?php echo esc_url( get_permalink() ); ?>" class="pargas-form">
						<?php wp_nonce_field( 'pargas_contact_action', 'pargas_contact_nonce' ); ?>

						<!-- Honeypot -->
						<div style="display: none !important;" aria-hidden="true">
							<label for="pargas_contact_hp">Leave empty</label>
							<input type="text" id="pargas_contact_hp" name="pargas_contact_hp" tabindex="-1" autocomplete="off" />
						</div>

						<div class="pargas-form-row">
							<div class="pargas-form-field">
								<label for="contact_name"><?php esc_html_e( 'Full Name *', 'pargaspetroab' ); ?></label>
								<input type="text" id="contact_name" name="contact_name" required value="<?php echo isset( $_POST['contact_name'] ) ? esc_attr( wp_unslash( $_POST['contact_name'] ) ) : ''; ?>" />
							</div>

							<div class="pargas-form-field">
								<label for="contact_company"><?php esc_html_e( 'Company / Organization *', 'pargaspetroab' ); ?></label>
								<input type="text" id="contact_company" name="contact_company" required value="<?php echo isset( $_POST['contact_company'] ) ? esc_attr( wp_unslash( $_POST['contact_company'] ) ) : ''; ?>" />
							</div>
						</div>

						<div class="pargas-form-row">
							<div class="pargas-form-field">
								<label for="contact_phone"><?php esc_html_e( 'Phone Number *', 'pargaspetroab' ); ?></label>
								<input type="tel" id="contact_phone" name="contact_phone" required dir="ltr" value="<?php echo isset( $_POST['contact_phone'] ) ? esc_attr( wp_unslash( $_POST['contact_phone'] ) ) : ''; ?>" />
							</div>

							<div class="pargas-form-field">
								<label for="contact_email"><?php esc_html_e( 'Email Address *', 'pargaspetroab' ); ?></label>
								<input type="email" id="contact_email" name="contact_email" required dir="ltr" value="<?php echo isset( $_POST['contact_email'] ) ? esc_attr( wp_unslash( $_POST['contact_email'] ) ) : ''; ?>" />
							</div>
						</div>

						<div class="pargas-form-field">
							<label for="contact_subject"><?php esc_html_e( 'Subject / Equipment Type *', 'pargaspetroab' ); ?></label>
							<input type="text" id="contact_subject" name="contact_subject" placeholder="<?php esc_attr_e( 'e.g. DAF System Inquiry for Petrochemical Plant', 'pargaspetroab' ); ?>" value="<?php echo isset( $_POST['contact_subject'] ) ? esc_attr( wp_unslash( $_POST['contact_subject'] ) ) : ''; ?>" required />
						</div>

						<div class="pargas-form-field">
							<label for="contact_message"><?php esc_html_e( 'Message & Specifications *', 'pargaspetroab' ); ?></label>
							<textarea id="contact_message" name="contact_message" rows="5" required placeholder="<?php esc_attr_e( 'Please provide capacity, water parameters (COD/BOD, TDS, pH), or specific equipment requirements.', 'pargaspetroab' ); ?>"><?php echo isset( $_POST['contact_message'] ) ? esc_textarea( wp_unslash( $_POST['contact_message'] ) ) : ''; ?></textarea>
						</div>

						<button type="submit" name="pargas_contact_submit" class="pargas-btn pargas-btn-primary pargas-btn-lg">
							<?php esc_html_e( 'Submit Inquiry', 'pargaspetroab' ); ?>
						</button>
					</form>
				</div>
			</div>
		</div>

		<!-- Lazy-loaded Google Maps Embed Section (Zero Global JS) -->
		<section class="pargas-map-section">
			<h2 class="pargas-map-title"><?php esc_html_e( 'Factory & Manufacturing Plant Location', 'pargaspetroab' ); ?></h2>
			<p class="pargas-map-desc"><?php esc_html_e( 'Kaveh Industrial Estate, Najafabad County, Isfahan Province', 'pargaspetroab' ); ?></p>
			
			<div class="pargas-map-container" id="pargas-map-wrapper">
				<!-- Lightweight responsive iframe with native lazy loading -->
				<iframe 
					title="<?php esc_attr_e( 'Pargas Petro Ab Factory Location', 'pargaspetroab' ); ?>"
					src="https://maps.google.com/maps?q=32.6341,51.3668&hl=en&z=14&output=embed" 
					width="100%" 
					height="420" 
					style="border:0;" 
					allowfullscreen="" 
					loading="lazy" 
					referrerpolicy="no-referrer-when-downgrade">
				</iframe>
			</div>
		</section>
	</div>
</main>

<?php
get_footer();
