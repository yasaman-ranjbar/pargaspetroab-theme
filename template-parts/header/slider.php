<?php
/**
 * Modern Industrial Water-Treatment Homepage Slider
 *
 * Replaces static hero with an interactive, responsive, lightweight slider.
 *
 * @package PargasPetroAb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$slides = array(
	array(
		'tag'         => __( 'پکیج‌های تصفیه بیولوژیکی فاضلاب', 'pargaspetroab' ),
		'title'       => __( 'طراحی و ساخت پکیج‌های نوین تصفیه فاضلاب بهداشتی و صنعتی (MBBR / IFAS)', 'pargaspetroab' ),
		'description' => __( 'واحدهای پیش‌ساخته فلزی با پوشش چندلایه ضدخوردگی زینک‌ریچ و پلی‌اورتان، دستیابی به بالاترین استانداردهای سازمان حفاظت محیط‌زیست جهت استفاده مجدد در آبیاری و صنعت.', 'pargaspetroab' ),
		'capacity'    => '۵ تا ۵۰,۰۰۰ m³/day',
		'spec_label'  => __( 'ظرفیت تصفیه:', 'pargaspetroab' ),
		'btn_primary' => __( 'درخواست استعلام قیمت و دیتاشیت', 'pargaspetroab' ),
		'btn_sec'     => __( 'مشاهده سوابق و پروژه‌ها', 'pargaspetroab' ),
		'sec_link'    => home_url( '/projects/' ),
		'target_rfq'  => 'Package Sewage Treatment Plant (MBBR)',
	),
	array(
		'tag'         => __( 'سیستم‌های جداسازی فیزیکی و شیمیایی', 'pargaspetroab' ),
		'title'       => __( 'واحدهای پیشرفته شناورسازی با هوای محلول (DAF) صنایع نفت و پتروشیمی', 'pargaspetroab' ),
		'description' => __( 'راندمان بالای ۹۸٪ در حذف چربی، روغن‌های امولسیونی (FOG) و ذرات معلق روغنی در پالایشگاه‌ها، صنایع پتروشیمی، لبنی و پساب‌های سنگین صنعتی.', 'pargaspetroab' ),
		'capacity'    => 'حباب‌های ۲۰ الی ۴۰ میکرون | SS304/SS316',
		'spec_label'  => __( 'مشخصه مهندسی:', 'pargaspetroab' ),
		'btn_primary' => __( 'مشاوره فنی و استعلام DAF', 'pargaspetroab' ),
		'btn_sec'     => __( 'کاتالوگ تجهیزات', 'pargaspetroab' ),
		'sec_link'    => home_url( '/products/' ),
		'target_rfq'  => 'DAF Dissolved Air Flotation Unit',
	),
	array(
		'tag'         => __( 'نمک‌زدایی و تولید آب خالص صنعتی', 'pargaspetroab' ),
		'title'       => __( 'واحدهای صنعتی تصفیه آب و اسمز معکوس (RO) و پیش‌تصفیه فیلتر شنی', 'pargaspetroab' ),
		'description' => __( 'طراحی اسکیدهای اسمز معکوس آب‌های لب‌شور و شور جهت تامین آب بویلر، برج‌های خنک‌کننده و صنایع دارویی با استفاده از ممبران‌های استاندارد ضد فولینگ.', 'pargaspetroab' ),
		'capacity'    => 'حذف ۹۹.۵٪ TDS | بازیافت تا ۸۵٪',
		'spec_label'  => __( 'راندمان نمک‌زدایی:', 'pargaspetroab' ),
		'btn_primary' => __( 'استعلام سیستم اسمز معکوس (RO)', 'pargaspetroab' ),
		'btn_sec'     => __( 'تماس با مهندسین فروش', 'pargaspetroab' ),
		'sec_link'    => home_url( '/contact/' ),
		'target_rfq'  => 'Industrial Reverse Osmosis (RO) System',
	),
);

$slides = apply_filters( 'pargas_homepage_slides', $slides );
?>

<section class="pargas-hero-slider-section" id="pargas-hero-slider" aria-label="<?php esc_attr_e( 'اسلایدر اصلی تجهیزات تصفیه آب و فاضلاب', 'pargaspetroab' ); ?>">
	<div class="pargas-slider-track" id="pargas-slider-track">
		<?php foreach ( $slides as $index => $slide ) : ?>
			<div class="pargas-slide <?php echo 0 === $index ? 'is-active' : ''; ?>" data-slide-index="<?php echo esc_attr( $index ); ?>">
				<div class="pargas-slide-overlay"></div>
				<div class="pargas-container pargas-slide-container">
					<div class="pargas-slide-content">
						<div class="pargas-slide-badge">
							<span class="pargas-badge-pulse"></span>
							<?php echo esc_html( $slide['tag'] ); ?>
						</div>

						<h1 class="pargas-slide-title">
							<?php echo esc_html( $slide['title'] ); ?>
						</h1>

						<p class="pargas-slide-desc">
							<?php echo esc_html( $slide['description'] ); ?>
						</p>

						<div class="pargas-slide-spec-pill">
							<span class="pargas-spec-label"><?php echo esc_html( $slide['spec_label'] ); ?></span>
							<strong class="pargas-spec-val" dir="ltr"><?php echo esc_html( $slide['capacity'] ); ?></strong>
						</div>

						<div class="pargas-slide-actions">
							<button type="button" class="pargas-btn pargas-btn-primary pargas-btn-lg pargas-open-inquiry-modal" data-product-title="<?php echo esc_attr( $slide['target_rfq'] ); ?>">
								<span class="pargas-btn-icon">📋</span>
								<?php echo esc_html( $slide['btn_primary'] ); ?>
							</button>

							<a href="<?php echo esc_url( $slide['sec_link'] ); ?>" class="pargas-btn pargas-btn-outline-light pargas-btn-lg">
								<?php echo esc_html( $slide['btn_sec'] ); ?> &larr;
							</a>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>

	<!-- Slider Controls -->
	<div class="pargas-slider-controls">
		<button type="button" class="pargas-slider-btn pargas-slider-prev" id="pargas-slide-prev" aria-label="<?php esc_attr_e( 'اسلاید قبلی', 'pargaspetroab' ); ?>">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"></polyline></svg>
		</button>

		<div class="pargas-slider-dots" id="pargas-slider-dots">
			<?php foreach ( $slides as $index => $slide ) : ?>
				<button type="button" class="pargas-slider-dot <?php echo 0 === $index ? 'is-active' : ''; ?>" data-slide-target="<?php echo esc_attr( $index ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'رفتن به اسلاید %d', 'pargaspetroab' ), $index + 1 ) ); ?>"></button>
			<?php endforeach; ?>
		</div>

		<button type="button" class="pargas-slider-btn pargas-slider-next" id="pargas-slide-next" aria-label="<?php esc_attr_e( 'اسلاید بعدی', 'pargaspetroab' ); ?>">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
		</button>
	</div>
</section>
