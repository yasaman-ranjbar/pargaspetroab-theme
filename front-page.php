<?php
/**
 * The template for displaying the custom Homepage
 *
 * Integrates interactive homepage slider, preserves all technical
 * water-treatment equipment content, reorganizes information architecture,
 * and showcases equipment, reference projects, and engineering capabilities.
 *
 * @package PargasPetroAb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main pargas-homepage">

	<!-- 1. Hero Slider: Industrial Engineering & Water Technology -->
	<?php get_template_part( 'template-parts/header/slider' ); ?>

	<!-- Metrics Bar below slider -->
	<section class="pargas-hero-metrics-bar">
		<div class="pargas-container">
			<div class="pargas-hero-stats">
				<div class="pargas-stat-item">
					<span class="pargas-stat-number" dir="ltr">14+</span>
					<span class="pargas-stat-label"><?php esc_html_e( 'سال سابقه صنعتی (تاسیس ۱۳۹۰)', 'pargaspetroab' ); ?></span>
				</div>
				<div class="pargas-stat-item">
					<span class="pargas-stat-number" dir="ltr">150+</span>
					<span class="pargas-stat-label"><?php esc_html_e( 'پروژه و تصفیه‌خانه راه‌اندازی‌شده', 'pargaspetroab' ); ?></span>
				</div>
				<div class="pargas-stat-item">
					<span class="pargas-stat-number" dir="ltr">50,000</span>
					<span class="pargas-stat-label"><?php esc_html_e( 'مترمکعب بر شبانه‌روز دامنه ظرفیت', 'pargaspetroab' ); ?></span>
				</div>
				<div class="pargas-stat-item">
					<span class="pargas-stat-number" dir="ltr">100%</span>
					<span class="pargas-stat-label"><?php esc_html_e( 'تطابق با استانداردهای محیط‌زیست', 'pargaspetroab' ); ?></span>
				</div>
			</div>
		</div>
	</section>

	<!-- 2. Core Equipment & Systems Overview -->
	<section class="pargas-section pargas-systems-section">
		<div class="pargas-container">
			<div class="pargas-section-intro text-center">
				<span class="pargas-subheading"><?php esc_html_e( 'تجهیزات و فرآیندها', 'pargaspetroab' ); ?></span>
				<h2 class="pargas-heading"><?php esc_html_e( 'سیستم‌ها و پکیج‌های تصفیه آب و فاضلاب صنعتی', 'pargaspetroab' ); ?></h2>
				<p class="pargas-lead">
					<?php esc_html_e( 'طراحی و ساخت با متریال مهندسی فولاد زنگ‌نزن (SS304/SS316L) و کربن استیل همراه با سندبلاست استاندارد Sa 2.5 و رنگ‌آمیزی چندلایه اپوکسی جهت کاربری در شرایط سخت صنعتی و پتروشیمی.', 'pargaspetroab' ); ?>
				</p>
			</div>

			<div class="pargas-equipment-grid">
				<!-- Category 1 -->
				<div class="pargas-equipment-card">
					<div class="pargas-equipment-icon">
						<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
					</div>
					<h3><?php esc_html_e( 'پکیج‌های تصفیه فاضلاب (MBBR / IFAS / MBR)', 'pargaspetroab' ); ?></h3>
					<p><?php esc_html_e( 'پکیج‌های پیش‌ساخته تصفیه بیولوژیکی فاضلاب بهداشتی و صنعتی مناسب برای شهرک‌های صنعتی، کمپ‌ها، صنایع غذایی و مجتمع‌های مسکونی.', 'pargaspetroab' ); ?></p>
					<a href="<?php echo esc_url( home_url( '/product-category/wastewater-packages/' ) ); ?>" class="pargas-link-more">
						<?php esc_html_e( 'مشاهده مشخصات فنی', 'pargaspetroab' ); ?> &larr;
					</a>
				</div>

				<!-- Category 2 -->
				<div class="pargas-equipment-card">
					<div class="pargas-equipment-icon">
						<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><path d="M12 6v6l4 2"></path></svg>
					</div>
					<h3><?php esc_html_e( 'مخازن فیلتر شنی و کربن اکتیو تحت فشار', 'pargaspetroab' ); ?></h3>
					<p><?php esc_html_e( 'فیلترهای فشار قوی چندلایه برای حذف کدورت (Turbidity)، ذرات معلق، کلرزدایی و پالایش بوی نامطبوع و مواد آلی آب.', 'pargaspetroab' ); ?></p>
					<a href="<?php echo esc_url( home_url( '/product-category/sand-carbon-filters/' ) ); ?>" class="pargas-link-more">
						<?php esc_html_e( 'مشاهده مشخصات فنی', 'pargaspetroab' ); ?> &larr;
					</a>
				</div>

				<!-- Category 3 -->
				<div class="pargas-equipment-card">
					<div class="pargas-equipment-icon">
						<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12h20M2 17h20M2 7h20"></path></svg>
					</div>
					<h3><?php esc_html_e( 'سیستم‌های چربی‌گیری DAF شناورسازی با هوای محلول', 'pargaspetroab' ); ?></h3>
					<p><?php esc_html_e( 'واحدهای فلوتاسیون با هوای محلول با تزریق میکرو حباب جهت حذف روغن، گریس و لجن‌های سبک در پالایشگاه‌ها، صنایع لبنی و پساب‌های روغنی.', 'pargaspetroab' ); ?></p>
					<a href="<?php echo esc_url( home_url( '/product-category/daf-systems/' ) ); ?>" class="pargas-link-more">
						<?php esc_html_e( 'مشاهده مشخصات فنی', 'pargaspetroab' ); ?> &larr;
					</a>
				</div>

				<!-- Category 4 -->
				<div class="pargas-equipment-card">
					<div class="pargas-equipment-icon">
						<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
					</div>
					<h3><?php esc_html_e( 'دستگاه‌های اسمز معکوس (RO) نمک‌زدایی صنعتی', 'pargaspetroab' ); ?></h3>
					<p><?php esc_html_e( 'واحدهای شیرین‌سازی آب‌های چاه، لب‌شور و دریا با ممبران‌های صنعتی با کیفیت جهت تامین آب دیگ بخار، خنک‌کن و شرب.', 'pargaspetroab' ); ?></p>
					<a href="<?php echo esc_url( home_url( '/product-category/ro-plants/' ) ); ?>" class="pargas-link-more">
						<?php esc_html_e( 'مشاهده مشخصات فنی', 'pargaspetroab' ); ?> &larr;
					</a>
				</div>

				<!-- Category 5 -->
				<div class="pargas-equipment-card">
					<div class="pargas-equipment-icon">
						<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 8 9"></polyline></svg>
					</div>
					<h3><?php esc_html_e( 'فیلتر پرس و آبگیری لجن صنعتی', 'pargaspetroab' ); ?></h3>
					<p><?php esc_html_e( 'دستگاه‌های هیدرولیکی فیلتر پرس اتوماتیک و نیمه‌اتوماتیک با صفحات ممبرانی و چدنی جهت خشک‌سازی کیک لجن و کاهش حجم پسماند.', 'pargaspetroab' ); ?></p>
					<a href="<?php echo esc_url( home_url( '/product-category/sludge-dewatering/' ) ); ?>" class="pargas-link-more">
						<?php esc_html_e( 'مشاهده مشخصات فنی', 'pargaspetroab' ); ?> &larr;
					</a>
				</div>

				<!-- Category 6 -->
				<div class="pargas-equipment-card">
					<div class="pargas-equipment-icon">
						<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
					</div>
					<h3><?php esc_html_e( 'پکیج‌های تزریق مواد شیمیایی و کلرزنی', 'pargaspetroab' ); ?></h3>
					<p><?php esc_html_e( 'اسکیدهای آماده آماده‌سازی و دوزینگ مواد منعقدکننده (پلی‌الکترولیت، آلوم، کلروفریک)، اسید، قلیا و پکیج‌های اتوماتیک کلرزن مایع و گاز.', 'pargaspetroab' ); ?></p>
					<a href="<?php echo esc_url( home_url( '/product-category/chemical-dosing/' ) ); ?>" class="pargas-link-more">
						<?php esc_html_e( 'مشاهده مشخصات فنی', 'pargaspetroab' ); ?> &larr;
					</a>
				</div>
			</div>
		</div>
	</section>

	<!-- 3. Featured Project References (CPT Showcase) -->
	<section class="pargas-section pargas-section-alt pargas-home-projects">
		<div class="pargas-container">
			<div class="pargas-section-header-split">
				<div>
					<span class="pargas-subheading"><?php esc_html_e( 'سوابق و مراجع اجرایی', 'pargaspetroab' ); ?></span>
					<h2 class="pargas-heading"><?php esc_html_e( 'پروژه‌های شاخص تصفیه آب و فاضلاب اجرا شده', 'pargaspetroab' ); ?></h2>
				</div>
				<a href="<?php echo esc_url( get_post_type_archive_link( 'projects' ) ); ?>" class="pargas-btn pargas-btn-outline">
					<?php esc_html_e( 'مشاهده تمام سوابق و جداول فنی', 'pargaspetroab' ); ?> &larr;
				</a>
			</div>

			<div class="pargas-projects-grid">
				<?php
				$projects_query = new WP_Query(
					array(
						'post_type'      => 'projects',
						'posts_per_page' => 3,
						'post_status'    => 'publish',
					)
				);

				if ( $projects_query->have_posts() ) :
					while ( $projects_query->have_posts() ) :
						$projects_query->the_post();
						get_template_part( 'template-parts/projects/card' );
					endwhile;
					wp_reset_postdata();
				endif;
				?>
			</div>
		</div>
	</section>

	<!-- 4. Engineering & Manufacturing Advantages -->
	<section class="pargas-section pargas-advantages-section">
		<div class="pargas-container">
			<div class="pargas-advantages-wrapper">
				<div class="pargas-advantages-text">
					<span class="pargas-subheading"><?php esc_html_e( 'مزایای شرکت پرگاس پترو آب', 'pargaspetroab' ); ?></span>
					<h2 class="pargas-heading"><?php esc_html_e( 'مهندسی یکپارچه فرآیند، ساخت کارخانه‌ای و راه‌اندازی در سایت', 'pargaspetroab' ); ?></h2>
					<p class="pargas-lead">
						<?php esc_html_e( 'شرکت پرگاس پترو آب با در اختیار داشتن کارخانه اختصاصی در شهرک صنعتی کاوه نجف‌آباد، از مرحله طراحی فرآیند تا ساخت ادوات مکانیکی و پایپینگ را با کنترل کیفی دقیق اجرا می‌کند.', 'pargaspetroab' ); ?>
					</p>

					<div class="pargas-feature-list">
						<div class="pargas-feature-item">
							<div class="pargas-feature-icon">🛡️</div>
							<div>
								<h4><?php esc_html_e( 'استانداردهای متالورژی و پوشش‌های مقاوم', 'pargaspetroab' ); ?></h4>
								<p><?php esc_html_e( 'ساخت مخازن با ورق‌های استاندارد فولادی، جوشکاری زیرپودری اتوماتیک، تست‌های غیرمخرب (NDT) و پوشش‌های تخصصی اپوکسی و پلی‌اورتان.', 'pargaspetroab' ); ?></p>
							</div>
						</div>

						<div class="pargas-feature-item">
							<div class="pargas-feature-icon">⚙️</div>
							<div>
								<h4><?php esc_html_e( 'طراحی اختصاصی هیدرولیکی و بیولوژیکی', 'pargaspetroab' ); ?></h4>
								<p><?php esc_html_e( 'محاسبه دقیق پارامترهای بار آلودگی (BOD, COD, TSS) و مدلسازی فرآیندی متناسب با شرایط آب‌وهوایی و استانداردهای تخلیه پساب.', 'pargaspetroab' ); ?></p>
							</div>
						</div>

						<div class="pargas-feature-item">
							<div class="pargas-feature-icon">🤝</div>
							<div>
								<h4><?php esc_html_e( 'نصب، راه‌اندازی و تامین قطعات یدکی', 'pargaspetroab' ); ?></h4>
								<p><?php esc_html_e( 'اعزام کارشناسان فنی جهت تست‌های هیدرولیکی، برق و ابزاردقیق، راه‌اندازی بیولوژیکی و ۱۰ سال تضمین خدمات و قطعات.', 'pargaspetroab' ); ?></p>
							</div>
						</div>
					</div>
				</div>

				<div class="pargas-advantages-media">
					<div class="pargas-stat-card-highlight">
						<div class="pargas-stat-big" dir="ltr">100%</div>
						<div class="pargas-stat-big-label"><?php esc_html_e( 'تضمین دستیابی به استاندارد محیط‌زیست', 'pargaspetroab' ); ?></div>
						<p><?php esc_html_e( 'کلیه پکیج‌ها و تصفیه‌خانه‌ها با گارانتی فرآیندی عملکرد و ارائه تاییدیه‌های آزمایشگاهی معتبر تحویل کارفرما می‌گردند.', 'pargaspetroab' ); ?></p>
						<hr />
						<div class="pargas-factory-info">
							<strong><?php esc_html_e( 'کارخانه نجف‌آباد (اصفهان)', 'pargaspetroab' ); ?></strong>
							<span><?php esc_html_e( 'مجهز به خطوط نورد سنگین، دستگاه‌های جوش اتوماتیک و سالن‌های تست هیدرولیک و سندبلاست.', 'pargaspetroab' ); ?></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- 5. Bottom B2B Quotation & Consultation Banner -->
	<section class="pargas-cta-banner-section">
		<div class="pargas-container">
			<div class="pargas-cta-banner">
				<div class="pargas-cta-text">
					<h2><?php esc_html_e( 'نیاز به مشاوره یا استعلام قیمت تصفیه‌خانه دارید؟', 'pargaspetroab' ); ?></h2>
					<p><?php esc_html_e( 'مشخصات اولیه پساب (دبی، نوع کاربری، پارامترهای آلایندگی) را برای مهندسین فروش پرگاس پترو آب ارسال کنید تا پروپوزال فنی و مالی ظرف ۲۴ ساعت کاری تهیه گردد.', 'pargaspetroab' ); ?></p>
				</div>
				<div class="pargas-cta-buttons">
					<button type="button" class="pargas-btn pargas-btn-primary pargas-btn-lg pargas-open-inquiry-modal">
						<?php esc_html_e( 'ارسال مشخصات پروژه و استعلام قیمت', 'pargaspetroab' ); ?>
					</button>
					<a href="tel:+982191091286" class="pargas-btn pargas-btn-outline pargas-btn-lg" dir="ltr">
						📞 +98 (21) 9109 1286
					</a>
				</div>
			</div>
		</div>
	</section>

</main>

<?php
get_footer();
