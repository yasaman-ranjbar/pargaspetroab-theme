<?php
/**
 * Template Name: تماس با ما (Contact Us)
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
		$error_msg  = __( 'اعتبارسنجی امنیتی ناموفق بود. لطفاً صفحه را بازنشانی کرده و مجدداً تلاش نمایید.', 'pargaspetroab' );
	} elseif ( ! empty( $_POST['pargas_contact_hp'] ) ) {
		$form_error = true;
		$error_msg  = __( 'ارسال خودکار اسپم شناسایی شد.', 'pargaspetroab' );
	} else {
		$name    = isset( $_POST['contact_name'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_name'] ) ) : '';
		$company = isset( $_POST['contact_company'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_company'] ) ) : '';
		$phone   = isset( $_POST['contact_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_phone'] ) ) : '';
		$email   = isset( $_POST['contact_email'] ) ? sanitize_email( wp_unslash( $_POST['contact_email'] ) ) : '';
		$subject = isset( $_POST['contact_subject'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_subject'] ) ) : '';
		$message = isset( $_POST['contact_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['contact_message'] ) ) : '';

		if ( empty( $name ) || empty( $email ) || ! is_email( $email ) || empty( $message ) ) {
			$form_error = true;
			$error_msg  = __( 'لطفاً تمامی فیلدهای الزامی را به صورت صحیح تکمیل فرمایید.', 'pargaspetroab' );
		} else {
			$to          = get_option( 'admin_email' );
			$mail_sub    = sprintf( __( '[استعلام فنی پرگاس پترو آب] %s (%s)', 'pargaspetroab' ), $subject ? $subject : 'پیام از سایت', $company ? $company : $name );
			$mail_body   = "یک استعلام فنی جدید در وب‌سایت ثبت شد:\n\n";
			$mail_body  .= "نام و نام خانوادگی: " . $name . "\n";
			$mail_body  .= "شرکت / سازمان: " . $company . "\n";
			$mail_body  .= "تلفن تماس: " . $phone . "\n";
			$mail_body  .= "ایمیل: " . $email . "\n";
			$mail_body  .= "موضوع: " . $subject . "\n\n";
			$mail_body  .= "شرح درخواست و مشخصات فنی پساب:\n" . $message . "\n\n";
			$mail_body  .= "--\nارسال‌شده از فرم تماس شرکت پرگاس پترو آب (https://pargaspetroab.com/)";

			$headers = array(
				'Content-Type: text/plain; charset=UTF-8',
				'Reply-To: ' . $name . ' <' . $email . '>',
			);

			if ( wp_mail( $to, $mail_sub, $mail_body, $headers ) ) {
				$form_success = true;
			} else {
				$form_error = true;
				$error_msg  = __( 'خطا در ارسال ایمیل سرور. لطفاً مستقیماً با شماره تلفن دفتر تماس حاصل فرمایید.', 'pargaspetroab' );
			}
		}
	}
}

get_header();
?>

<main id="primary" class="site-main pargas-contact-page">
	<div class="pargas-page-banner">
		<div class="pargas-container">
			<span class="pargas-subheading"><?php esc_html_e( 'واحد مهندسی فروش و پشتیبانی فنی کارخانه', 'pargaspetroab' ); ?></span>
			<h1 class="pargas-page-title"><?php esc_html_e( 'تماس با پرگاس پترو آب', 'pargaspetroab' ); ?></h1>
			<p class="pargas-page-intro">
				<?php esc_html_e( 'جهت مشاوره تخصصی در زمینه تصفیه پساب‌های صنعتی و بهداشتی، برآورد اولیه ابعاد پکیج، استعلام قیمت یا هماهنگی بازدید از کارخانه با ما در ارتباط باشید.', 'pargaspetroab' ); ?>
			</p>
		</div>
	</div>

	<div class="pargas-container pargas-py-8">
		<div class="pargas-contact-layout">
			<!-- Contact Information & Company Cards -->
			<div class="pargas-contact-info-panel">
				<div class="pargas-contact-card">
					<h3>📍 <?php esc_html_e( 'دفتر مرکزی مهندسی و فروش (تهران)', 'pargaspetroab' ); ?></h3>
					<p><?php esc_html_e( 'خیابان شهید مطهری، خیابان میرزای شیرازی، خیابان دل‌آرا، پلاک ۲۴، طبقه دوم، تهران، ایران', 'pargaspetroab' ); ?></p>
					<div class="pargas-card-contact-line">
						<strong><?php esc_html_e( 'تلفن دفتر مرکزی:', 'pargaspetroab' ); ?></strong>
						<a href="tel:+982191091286" dir="ltr">+98 (21) 9109 1286</a>
					</div>
					<div class="pargas-card-contact-line">
						<strong><?php esc_html_e( 'کد پستی:', 'pargaspetroab' ); ?></strong>
						<span dir="ltr">1596975113</span>
					</div>
				</div>

				<div class="pargas-contact-card">
					<h3>🏭 <?php esc_html_e( 'کارخانه و سالن‌های ساخت تجهیزات (اصفهان)', 'pargaspetroab' ); ?></h3>
					<p><?php esc_html_e( 'استان اصفهان، شهرستان نجف‌آباد، خیابان سوم، شهرک صنعتی کاوه ویلاشهر', 'pargaspetroab' ); ?></p>
					<div class="pargas-card-contact-line">
						<strong><?php esc_html_e( 'تلفن تماس کارخانه:', 'pargaspetroab' ); ?></strong>
						<a href="tel:+982191091286" dir="ltr">+98 (21) 9109 1286</a>
					</div>
					<div class="pargas-card-contact-line">
						<strong><?php esc_html_e( 'ساعات کاری کارخانه:', 'pargaspetroab' ); ?></strong>
						<span><?php esc_html_e( 'شنبه تا چهارشنبه: ۰۷:۰۰ الی ۱۶:۰۰ | پنج‌شنبه‌ها: ۰۷:۰۰ الی ۱۳:۰۰', 'pargaspetroab' ); ?></span>
					</div>
				</div>

				<div class="pargas-contact-card">
					<h3>✉️ <?php esc_html_e( 'مسیرهای ارتباط مستقیم', 'pargaspetroab' ); ?></h3>
					<div class="pargas-card-contact-line">
						<strong><?php esc_html_e( 'ایمیل واحد مهندسی و بازرگانی:', 'pargaspetroab' ); ?></strong>
						<a href="mailto:info@pargaspetroab.com">info@pargaspetroab.com</a>
					</div>
					<div class="pargas-card-contact-line">
						<strong><?php esc_html_e( 'پشتیبانی واتس‌اپ و تلگرام:', 'pargaspetroab' ); ?></strong>
						<a href="https://wa.me/989124388097" target="_blank" rel="noopener noreferrer" dir="ltr">+98 912 438 8097</a>
					</div>
				</div>
			</div>

			<!-- Contact Form -->
			<div class="pargas-contact-form-panel">
				<div class="pargas-form-box">
					<h2><?php esc_html_e( 'ارسال مستقیم استعلام فنی و پروپوزال', 'pargaspetroab' ); ?></h2>
					<p><?php esc_html_e( 'فرم زیر را تکمیل فرمایید تا کارشناسان فرآیند شرکت پرگاس پترو آب در اسرع وقت پروپوزال فنی و مالی را ارسال کنند.', 'pargaspetroab' ); ?></p>

					<?php if ( $form_success ) : ?>
						<div class="pargas-alert pargas-alert-success" role="alert">
							<strong><?php esc_html_e( 'درخواست شما با موفقیت ثبت شد!', 'pargaspetroab' ); ?></strong>
							<?php esc_html_e( 'کارشناس فنی پرگاس پترو آب ظرف ۲۴ ساعت کاری با شما تماس خواهد گرفت.', 'pargaspetroab' ); ?>
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
								<label for="contact_name"><?php esc_html_e( 'نام و نام خانوادگی *', 'pargaspetroab' ); ?></label>
								<input type="text" id="contact_name" name="contact_name" required value="<?php echo isset( $_POST['contact_name'] ) ? esc_attr( wp_unslash( $_POST['contact_name'] ) ) : ''; ?>" />
							</div>

							<div class="pargas-form-field">
								<label for="contact_company"><?php esc_html_e( 'نام شرکت / سازمان / پروژه *', 'pargaspetroab' ); ?></label>
								<input type="text" id="contact_company" name="contact_company" required value="<?php echo isset( $_POST['contact_company'] ) ? esc_attr( wp_unslash( $_POST['contact_company'] ) ) : ''; ?>" />
							</div>
						</div>

						<div class="pargas-form-row">
							<div class="pargas-form-field">
								<label for="contact_phone"><?php esc_html_e( 'تلفن تماس / همراه *', 'pargaspetroab' ); ?></label>
								<input type="tel" id="contact_phone" name="contact_phone" required dir="ltr" value="<?php echo isset( $_POST['contact_phone'] ) ? esc_attr( wp_unslash( $_POST['contact_phone'] ) ) : ''; ?>" />
							</div>

							<div class="pargas-form-field">
								<label for="contact_email"><?php esc_html_e( 'آدرس ایمیل سازمانی *', 'pargaspetroab' ); ?></label>
								<input type="email" id="contact_email" name="contact_email" required dir="ltr" value="<?php echo isset( $_POST['contact_email'] ) ? esc_attr( wp_unslash( $_POST['contact_email'] ) ) : ''; ?>" />
							</div>
						</div>

						<div class="pargas-form-field">
							<label for="contact_subject"><?php esc_html_e( 'موضوع استعلام / نوع سیستم درخواستی *', 'pargaspetroab' ); ?></label>
							<input type="text" id="contact_subject" name="contact_subject" placeholder="<?php esc_attr_e( 'مثال: استعلام پکیج تصفیه MBBR یا سیستم چربی‌گیر DAF', 'pargaspetroab' ); ?>" value="<?php echo isset( $_POST['contact_subject'] ) ? esc_attr( wp_unslash( $_POST['contact_subject'] ) ) : ''; ?>" required />
						</div>

						<div class="pargas-form-field">
							<label for="contact_message"><?php esc_html_e( 'مشخصات فنی و توضیحات پروژه *', 'pargaspetroab' ); ?></label>
							<textarea id="contact_message" name="contact_message" rows="5" required placeholder="<?php esc_attr_e( 'لطفاً دبی پساب ورودی، نوع کاربری (صنعتی، بهداشتی)، پارامترهای کیفی (COD, BOD, TSS) یا نیازمندی‌های خاص را مرقوم فرمایید.', 'pargaspetroab' ); ?>"><?php echo isset( $_POST['contact_message'] ) ? esc_textarea( wp_unslash( $_POST['contact_message'] ) ) : ''; ?></textarea>
						</div>

						<button type="submit" name="pargas_contact_submit" class="pargas-btn pargas-btn-primary pargas-btn-lg">
							<?php esc_html_e( 'ثبت و ارسال استعلام', 'pargaspetroab' ); ?>
						</button>
					</form>
				</div>
			</div>
		</div>

		<!-- Lazy-loaded Google Maps Embed Section -->
		<section class="pargas-map-section">
			<h2 class="pargas-map-title"><?php esc_html_e( 'موقعیت کارخانه و سالن‌های تولید', 'pargaspetroab' ); ?></h2>
			<p class="pargas-map-desc"><?php esc_html_e( 'استان اصفهان، شهرک صنعتی کاوه نجف‌آباد، خیابان سوم', 'pargaspetroab' ); ?></p>
			
			<div class="pargas-map-container" id="pargas-map-wrapper">
				<iframe 
					title="<?php esc_attr_e( 'موقعیت کارخانه پرگاس پترو آب', 'pargaspetroab' ); ?>"
					src="https://maps.google.com/maps?q=32.6341,51.3668&hl=fa&z=14&output=embed" 
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
