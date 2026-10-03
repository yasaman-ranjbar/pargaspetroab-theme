<?php
/**
 * Template Name: تماس با ما (Contact Us)
 *
 * Minimal Contact Us page with a secure nonce-verified form,
 * honeypot spam protection and a lazy-loaded Google Maps embed.
 *
 * @package PargasPetroAb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$form_success = isset( $_GET['sent'] ) && '1' === $_GET['sent']; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
$form_error   = false;
$error_msg    = '';

// Process secure POST submission.
if ( 'POST' === $_SERVER['REQUEST_METHOD'] && isset( $_POST['pargas_contact_submit'] ) ) {
	if ( ! isset( $_POST['pargas_contact_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['pargas_contact_nonce'] ), 'pargas_contact_action' ) ) {
		$form_error = true;
		$error_msg  = __( 'اعتبارسنجی امنیتی ناموفق بود. لطفاً صفحه را بازنشانی کرده و مجدداً تلاش نمایید.', 'pargaspetroab' );
	} elseif ( ! empty( $_POST['pargas_contact_hp'] ) ) {
		$form_error = true;
		$error_msg  = __( 'ارسال نامعتبر شناسایی شد.', 'pargaspetroab' );
	} else {
		$name    = isset( $_POST['contact_name'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_name'] ) ) : '';
		$phone   = isset( $_POST['contact_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_phone'] ) ) : '';
		$email   = isset( $_POST['contact_email'] ) ? sanitize_email( wp_unslash( $_POST['contact_email'] ) ) : '';
		$subject = isset( $_POST['contact_subject'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_subject'] ) ) : '';
		$message = isset( $_POST['contact_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['contact_message'] ) ) : '';

		if ( empty( $name ) || empty( $email ) || ! is_email( $email ) || empty( $message ) ) {
			$form_error = true;
			$error_msg  = __( 'لطفاً فیلدهای الزامی را به‌درستی تکمیل فرمایید.', 'pargaspetroab' );
		} else {
			$to        = get_option( 'admin_email' );
			$mail_sub  = sprintf( '[پرگاس پترو آب] %s', $subject ? $subject : 'پیام جدید از فرم تماس' );
			$mail_body = "پیام جدید از فرم تماس وب‌سایت:\n\n";
			$mail_body .= 'نام: ' . $name . "\n";
			$mail_body .= 'تلفن: ' . $phone . "\n";
			$mail_body .= 'ایمیل: ' . $email . "\n";
			$mail_body .= 'موضوع: ' . $subject . "\n\n";
			$mail_body .= "پیام:\n" . $message . "\n";

			$headers = array(
				'Content-Type: text/plain; charset=UTF-8',
				'Reply-To: ' . $name . ' <' . $email . '>',
			);

			if ( wp_mail( $to, $mail_sub, $mail_body, $headers ) ) {
				// Post/Redirect/Get to prevent duplicate submissions on refresh.
				wp_safe_redirect( add_query_arg( 'sent', '1', get_permalink() ) . '#contact-form' );
				exit;
			}

			$form_error = true;
			$error_msg  = __( 'ارسال پیام با خطا مواجه شد. لطفاً مستقیماً با شماره تلفن یا ایمیل شرکت تماس بگیرید.', 'pargaspetroab' );
		}
	}
}

/**
 * Re-populate a field value after a failed submission.
 *
 * @param string $key POST key.
 * @return string
 */
$pp_old = static function ( $key ) {
	return isset( $_POST[ $key ] ) ? wp_unslash( $_POST[ $key ] ) : ''; // phpcs:ignore
};

$map_query = rawurlencode( 'شهرک صنعتی کاوه، نجف آباد، اصفهان' );

get_header();
?>

<main id="primary" class="site-main pp-page pp-contact">
	<header class="pp-hero">
		<div class="pp-wrap">
			<span class="pp-eyebrow"><?php esc_html_e( 'پرگاس پترو آب', 'pargaspetroab' ); ?></span>
			<h1 class="pp-title"><?php esc_html_e( 'تماس با ما', 'pargaspetroab' ); ?></h1>
		</div>
	</header>

	<section class="pp-section">
		<div class="pp-wrap pp-contact-grid">
			<!-- Contact information -->
			<div>
				<h2 class="pp-h2"><?php esc_html_e( 'اطلاعات تماس', 'pargaspetroab' ); ?></h2>
				<ul class="pp-info-list">
					<li class="pp-info-item">
						<span class="pp-info-icon" aria-hidden="true">
							<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
						</span>
						<div>
							<span class="pp-info-label"><?php esc_html_e( 'آدرس', 'pargaspetroab' ); ?></span>
							<address class="pp-info-value" style="font-style:normal;"><?php esc_html_e( 'اصفهان - نجف‌آباد - شهر صنعتی کاوه - خیابان سوم - شماره ۲۷', 'pargaspetroab' ); ?></address>
						</div>
					</li>
					<li class="pp-info-item">
						<span class="pp-info-icon" aria-hidden="true">
							<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 6-10 7L2 6"/></svg>
						</span>
						<div>
							<span class="pp-info-label"><?php esc_html_e( 'ایمیل', 'pargaspetroab' ); ?></span>
							<span class="pp-info-value"><a href="mailto:info@pargaspetroab.com" dir="ltr">info@pargaspetroab.com</a></span>
						</div>
					</li>
					<li class="pp-info-item">
						<span class="pp-info-icon" aria-hidden="true">
							<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
						</span>
						<div>
							<span class="pp-info-label"><?php esc_html_e( 'تلفن', 'pargaspetroab' ); ?></span>
							<span class="pp-info-value"><a href="tel:+982191091286" dir="ltr">021 9109 1286</a></span>
						</div>
					</li>
				</ul>
			</div>

			<!-- Contact form -->
			<div id="contact-form">
				<h2 class="pp-h2"><?php esc_html_e( 'ارسال پیام', 'pargaspetroab' ); ?></h2>

				<?php if ( $form_success ) : ?>
					<div class="pp-alert pp-alert-success" role="alert">
						<?php esc_html_e( 'پیام شما با موفقیت ارسال شد. به‌زودی با شما تماس خواهیم گرفت.', 'pargaspetroab' ); ?>
					</div>
				<?php elseif ( $form_error ) : ?>
					<div class="pp-alert pp-alert-danger" role="alert">
						<?php echo esc_html( $error_msg ); ?>
					</div>
				<?php endif; ?>

				<form method="post" action="<?php echo esc_url( get_permalink() ); ?>#contact-form" class="pp-form" novalidate>
					<?php wp_nonce_field( 'pargas_contact_action', 'pargas_contact_nonce' ); ?>

					<div class="pp-hp" aria-hidden="true">
						<label for="pargas_contact_hp">Leave empty</label>
						<input type="text" id="pargas_contact_hp" name="pargas_contact_hp" tabindex="-1" autocomplete="off" />
					</div>

					<div class="pp-form-row">
						<div class="pp-field">
							<label for="contact_name"><?php esc_html_e( 'نام و نام خانوادگی', 'pargaspetroab' ); ?> <span class="req">*</span></label>
							<input type="text" id="contact_name" name="contact_name" required autocomplete="name" value="<?php echo esc_attr( $pp_old( 'contact_name' ) ); ?>" />
						</div>
						<div class="pp-field">
							<label for="contact_phone"><?php esc_html_e( 'شماره تماس', 'pargaspetroab' ); ?></label>
							<input type="tel" id="contact_phone" name="contact_phone" dir="ltr" autocomplete="tel" value="<?php echo esc_attr( $pp_old( 'contact_phone' ) ); ?>" />
						</div>
					</div>

					<div class="pp-form-row">
						<div class="pp-field">
							<label for="contact_email"><?php esc_html_e( 'ایمیل', 'pargaspetroab' ); ?> <span class="req">*</span></label>
							<input type="email" id="contact_email" name="contact_email" required dir="ltr" autocomplete="email" value="<?php echo esc_attr( $pp_old( 'contact_email' ) ); ?>" />
						</div>
						<div class="pp-field">
							<label for="contact_subject"><?php esc_html_e( 'موضوع', 'pargaspetroab' ); ?></label>
							<input type="text" id="contact_subject" name="contact_subject" value="<?php echo esc_attr( $pp_old( 'contact_subject' ) ); ?>" />
						</div>
					</div>

					<div class="pp-field">
						<label for="contact_message"><?php esc_html_e( 'پیام', 'pargaspetroab' ); ?> <span class="req">*</span></label>
						<textarea id="contact_message" name="contact_message" rows="5" required><?php echo esc_textarea( $pp_old( 'contact_message' ) ); ?></textarea>
					</div>

					<button type="submit" name="pargas_contact_submit" value="1" class="pargas-btn pargas-btn-primary pargas-btn-lg">
						<?php esc_html_e( 'ارسال پیام', 'pargaspetroab' ); ?>
					</button>
				</form>
			</div>
		</div>
	</section>

	<!-- Google Map -->
	<section class="pp-section">
		<div class="pp-wrap">
			<div class="pp-map">
				<iframe
					title="<?php esc_attr_e( 'موقعیت شرکت پرگاس پترو آب روی نقشه', 'pargaspetroab' ); ?>"
					src="https://maps.google.com/maps?q=<?php echo esc_attr( $map_query ); ?>&hl=fa&z=14&output=embed"
					allowfullscreen
					loading="lazy"
					referrerpolicy="no-referrer-when-downgrade">
				</iframe>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();
