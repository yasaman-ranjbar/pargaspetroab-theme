<?php
/**
 * Template Name: درباره ما (About Us)
 *
 * Minimal About Us template for Pargas Petro Ab.
 *
 * @package PargasPetroAb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main pp-page pp-about">
	<header class="pp-hero">
		<div class="pp-wrap">
			<span class="pp-eyebrow"><?php esc_html_e( 'پرگاس پترو آب', 'pargaspetroab' ); ?></span>
			<h1 class="pp-title"><?php esc_html_e( 'درباره ما', 'pargaspetroab' ); ?></h1>
		</div>
	</header>

	<section class="pp-section">
		<div class="pp-wrap pp-about-text">
			<p><?php esc_html_e( 'شرکت پرگاس پترو آب در سال ۱۳۹۰ با هدف تولید تجهیزات تصفیه‌خانه‌های آب و فاضلاب بهداشتی و صنعتی تأسیس شد. در حال حاضر شرکت پرگاس پترو آب با طراحی و ساخت تجهیزات بیش از ۴۰ تصفیه‌خانه آب و فاضلاب می‌تواند دامنه وسیعی از تجهیزات تصفیه‌خانه‌های آب و فاضلاب را تولید نماید.', 'pargaspetroab' ); ?></p>

			<p><?php esc_html_e( 'پرگاس پترو آب قصد دارد با تعهد به کیفیت و اطمینان‌بخشی به مشتری، در مسیر پیشرفت فنی جهت تأمین نیازهای پیمانکاران و کارفرمایان حرکت نماید.', 'pargaspetroab' ); ?></p>

			<p><?php esc_html_e( 'در ضمن مهندسین شرکت پرگاس پترو آب با تجربه فراوان در طراحی و ساخت تصفیه‌خانه‌های آب و فاضلاب بهداشتی و صنعتی، آمادگی دارند تجربیات خود را در خصوص طراحی، ساخت و ارائه راه‌حل جهت تصفیه پساب‌های بهداشتی و صنعتی در اختیار پیمانکاران و کارفرمایان قرار دهند.', 'pargaspetroab' ); ?></p>
		</div>
	</section>

	<section class="pp-section">
		<div class="pp-wrap">
			<div class="pp-stats">
				<div class="pp-stat">
					<span class="pp-stat-num">۱۳۹۰</span>
					<span class="pp-stat-label"><?php esc_html_e( 'سال تأسیس', 'pargaspetroab' ); ?></span>
				</div>
				<div class="pp-stat">
					<span class="pp-stat-num">+۴۰</span>
					<span class="pp-stat-label"><?php esc_html_e( 'تصفیه‌خانه آب و فاضلاب', 'pargaspetroab' ); ?></span>
				</div>
				<div class="pp-stat">
					<span class="pp-stat-num"><?php esc_html_e( 'صنعتی و بهداشتی', 'pargaspetroab' ); ?></span>
					<span class="pp-stat-label"><?php esc_html_e( 'حوزه تخصص', 'pargaspetroab' ); ?></span>
				</div>
			</div>
		</div>
	</section>

	<section class="pp-section">
		<div class="pp-wrap pp-cta">
			<p><?php esc_html_e( 'برای مشاوره و همکاری با ما در ارتباط باشید.', 'pargaspetroab' ); ?></p>
			<?php
			$pp_contact_page = get_page_by_path( 'contact' );
			$pp_contact_url  = $pp_contact_page ? get_permalink( $pp_contact_page ) : home_url( '/contact/' );
			?>
			<a href="<?php echo esc_url( $pp_contact_url ); ?>" class="pargas-btn pargas-btn-primary pargas-btn-lg">
				<?php esc_html_e( 'تماس با ما', 'pargaspetroab' ); ?>
			</a>
		</div>
	</section>
</main>

<?php
get_footer();
