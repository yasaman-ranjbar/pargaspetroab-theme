<?php
/**
 * Theme Setup & Feature Registration
 *
 * @package PargasPetroAb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Setup theme features.
 */
function pargas_theme_setup() {
	// Internationalization support.
	load_theme_textdomain( 'pargaspetroab', PARGAS_THEME_DIR . '/languages' );

	// Document title management.
	add_theme_support( 'title-tag' );

	// Featured images.
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'pargas-project-card', 640, 420, true );
	add_image_size( 'pargas-product-card', 520, 440, true );
	add_image_size( 'pargas-hero-banner', 1920, 800, true );

	// Custom logo.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 80,
			'width'       => 280,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	// HTML5 markup support.
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Responsive embeds.
	add_theme_support( 'responsive-embeds' );

	// WooCommerce Theme Support.
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	// Register Navigation Menus.
	register_nav_menus(
		array(
			'primary'         => esc_html__( 'Primary Desktop Menu', 'pargaspetroab' ),
			'mobile'          => esc_html__( 'Mobile Drawer Menu', 'pargaspetroab' ),
			'footer_quick'    => esc_html__( 'Footer Quick Links', 'pargaspetroab' ),
			'footer_products' => esc_html__( 'Footer Equipment Categories', 'pargaspetroab' ),
		)
	);
}
add_action( 'after_setup_theme', 'pargas_theme_setup' );

/**
 * Set max content width for media.
 */
function pargas_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'pargas_content_width', 1280 );
}
add_action( 'after_setup_theme', 'pargas_content_width', 0 );

/**
 * Increase WordPress upload size limit to 1024 MB.
 *
 * @param int $bytes Default byte limit.
 * @return int Adjusted byte limit.
 */
function pargas_filter_upload_size_limit( $bytes ) {
	return 1024 * 1024 * 1024; // 1024 MB in bytes
}
add_filter( 'upload_size_limit', 'pargas_filter_upload_size_limit' );

/**
 * Detect language and handle Persian / English switching.
 *
 * @param string $locale Current locale.
 * @return string Filtered locale.
 */
function pargas_filter_locale( $locale ) {
	$lang = '';
	if ( isset( $_GET['lang'] ) ) {
		$lang = sanitize_text_field( wp_unslash( $_GET['lang'] ) );
		if ( ! headers_sent() ) {
			setcookie( 'pargas_lang', $lang, time() + 30 * DAY_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN );
		}
	} elseif ( isset( $_COOKIE['pargas_lang'] ) ) {
		$lang = sanitize_text_field( wp_unslash( $_COOKIE['pargas_lang'] ) );
	}

	if ( 'fa' === $lang || 'fa_IR' === $lang ) {
		return 'fa_IR';
	} elseif ( 'en' === $lang || 'en_US' === $lang ) {
		return 'en_US';
	}

	return $locale;
}
add_filter( 'locale', 'pargas_filter_locale', 99 );

/**
 * Force RTL direction when Persian language is chosen.
 *
 * @param bool $is_rtl Default RTL status.
 * @return bool Whether to apply RTL.
 */
function pargas_force_rtl( $is_rtl ) {
	$lang = '';
	if ( isset( $_GET['lang'] ) ) {
		$lang = sanitize_text_field( wp_unslash( $_GET['lang'] ) );
	} elseif ( isset( $_COOKIE['pargas_lang'] ) ) {
		$lang = sanitize_text_field( wp_unslash( $_COOKIE['pargas_lang'] ) );
	} else {
		$current_locale = get_locale();
		$lang           = ( 0 === strpos( $current_locale, 'fa' ) ) ? 'fa' : 'en';
	}

	if ( 'fa' === $lang || 'fa_IR' === $lang ) {
		return true;
	}
	if ( 'en' === $lang || 'en_US' === $lang ) {
		return false;
	}

	return $is_rtl;
}
add_filter( 'is_rtl', 'pargas_force_rtl', 99 );

/**
 * Filter language attributes to output dir="rtl" and lang="fa-IR" correctly.
 *
 * @param string $output Default HTML language attributes.
 * @return string Filtered attributes.
 */
function pargas_custom_language_attributes( $output ) {
	if ( is_rtl() ) {
		return 'lang="fa-IR" dir="rtl"';
	}
	return 'lang="en-US" dir="ltr"';
}
add_filter( 'language_attributes', 'pargas_custom_language_attributes', 99 );

/**
 * Add RTL class to body.
 *
 * @param array $classes Body classes.
 * @return array Filtered body classes.
 */
function pargas_filter_body_classes( $classes ) {
	if ( is_rtl() ) {
		$classes[] = 'rtl';
	}
	return $classes;
}
add_filter( 'body_class', 'pargas_filter_body_classes', 99 );

/**
 * Automatically create core pages and starter project references if not yet in database.
 */
function pargas_auto_create_core_pages() {
	if ( get_option( 'pargas_pages_initialized' ) ) {
		return;
	}

	// 1. Home Page
	$home_page = get_page_by_path( 'home' );
	if ( ! $home_page ) {
		$home_id = wp_insert_post(
			array(
				'post_title'    => 'خانه',
				'post_name'     => 'home',
				'post_status'   => 'publish',
				'post_type'     => 'page',
				'page_template' => 'front-page.php',
			)
		);
		if ( $home_id && ! is_wp_error( $home_id ) ) {
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $home_id );
		}
	}

	// 2. About Us Page
	$about_page = get_page_by_path( 'about' );
	if ( ! $about_page ) {
		wp_insert_post(
			array(
				'post_title'    => 'درباره ما',
				'post_name'     => 'about',
				'post_status'   => 'publish',
				'post_type'     => 'page',
				'page_template' => 'template-about.php',
			)
		);
	}

	// 3. Contact Us Page
	$contact_page = get_page_by_path( 'contact' );
	if ( ! $contact_page ) {
		wp_insert_post(
			array(
				'post_title'    => 'تماس با ما',
				'post_name'     => 'contact',
				'post_status'   => 'publish',
				'post_type'     => 'page',
				'page_template' => 'page-contact.php',
			)
		);
	}

	// 4. Projects & References Page
	$projects_page = get_page_by_path( 'projects-references' );
	if ( ! $projects_page ) {
		wp_insert_post(
			array(
				'post_title'    => 'سوابق و مراجع اجرایی',
				'post_name'     => 'projects-references',
				'post_status'   => 'publish',
				'post_type'     => 'page',
				'page_template' => 'template-projects.php',
			)
		);
	}

	// 5. Seed Starter Project References with Technical Tables
	$existing_projects = get_posts( array( 'post_type' => 'projects', 'posts_per_page' => 1 ) );
	if ( empty( $existing_projects ) ) {
		pargas_seed_initial_projects();
	}

	update_option( 'pargas_pages_initialized', 1 );
}
add_action( 'init', 'pargas_auto_create_core_pages', 20 );

/**
 * Seed realistic starter project references.
 */
function pargas_seed_initial_projects() {
	$starter_projects = array(
		array(
			'title'    => 'تصفیه‌خانه فاضلاب صنعتی و چربی‌گیر DAF مجتمع پتروشیمی',
			'client'   => 'شرکت صنایع پتروشیمی خلیج فارس',
			'year'     => '۱۴۰۲ (2023)',
			'capacity' => '۳,۵۰۰ m³/day',
			'location' => 'بوشهر، منطقه ویژه عسلویه',
			'status'   => 'در حال بهره‌برداری',
			'content'  => 'طراحی و ساخت پکیج پیشرفته شناورسازی با هوای محلول (DAF) به همراه هوادهی گسترده و فیلتر شنی جهت تصفیه پساب روغنی با COD ورودی ۴,۵۰۰ میلی‌گرم بر لیتر.',
			'table'    => array(
				'columns' => array( 'پارامتر فنی', 'مقدار طراحی', 'واحد سنجش', 'تکنولوژی و متریال' ),
				'rows'    => array(
					array( 'ظرفیت دبی ورودی', '۳,۵۰۰', 'مترمکعب/روز', 'جریان پیوسته (Continuous)' ),
					array( 'راندمان حذف چربی و روغن (FOG)', '> ۹۸.۵', 'درصد (%)', 'میکروبابل DAF استیل SS316' ),
					array( 'میزان COD ورودی / خروجی', '۴,۵۰۰ به کمتر از ۶۰', 'میلی‌گرم بر لیتر', 'فرآیند تلفیقی DAF + MBBR' ),
					array( 'کدورت نهایی خروجی (Turbidity)', '< ۱.۵', 'NTU', 'فیلتراسیون تحت فشار شنی و کربنی' ),
					array( 'توان الکتریکی مصرفی', '۴۵', 'کیلووات (kW)', 'موتورهای زیمنس با اینورتر' ),
				),
			),
		),
		array(
			'title'    => 'پکیج مدولار تصفیه فاضلاب بهداشتی شهرک صنعتی',
			'client'   => 'شرکت شهرک‌های صنعتی استان اصفهان',
			'year'     => '۱۴۰۱ (2022)',
			'capacity' => '۵,۰۰۰ m³/day',
			'location' => 'اصفهان، شهرک صنعتی کاوه',
			'status'   => 'در حال بهره‌برداری',
			'content'  => 'طراحی، ساخت و نصب پکیج فلزی تصفیه بیولوژیکی با سیستم هوادهی عمقی و مخازن ته‌نشینی لاملایی، مناسب برای تامین آب فضای سبز.',
			'table'    => array(
				'columns' => array( 'پارامتر فنی', 'مقدار طراحی', 'واحد سنجش', 'تکنولوژی و متریال' ),
				'rows'    => array(
					array( 'ظرفیت کل پکیج', '۵,۰۰۰', 'مترمکعب/روز', 'مدولار فلزی با پوشش زینک‌ریچ' ),
					array( 'حذف BOD5 و COD', '> ۹۴', 'درصد (%)', 'لجن فعال هوادهی گسترده (EAAS)' ),
					array( 'میزان TSS خروجی', '< ۳۰', 'mg/L', 'حوض ته‌نشینی ثانویه لاملایی' ),
					array( 'سیستم ضدعفونی', 'کلرزنی اتوماتیک مایع', 'دوزینگ اسکید', 'پمپ‌های اتوماتیک دیجیتال' ),
					array( 'کاربری آب تصفیه‌شده', 'آبیاری فضای سبز صنعتی', 'استاندارد محیط‌زیست', 'مورد تایید سازمان محیط‌زیست' ),
				),
			),
		),
		array(
			'title'    => 'تصفیه‌خانه پساب بیمارستانی و گندزدایی تخصصی',
			'client'   => 'مرکز آموزشی و درمانی تخصصی',
			'year'     => '۱۴۰۳ (2024)',
			'capacity' => '۸۰۰ m³/day',
			'location' => 'تهران، منطقه مرکزی',
			'status'   => 'در حال بهره‌برداری',
			'content'  => 'پکیج اختصاصی تصفیه فاضلاب بیمارستانی مجهز به مرحله بی‌خطرسازی، بیوراکتور غشایی (MBR) و گندزدایی با ازن و کلر جهت حذف کامل پاتوژن‌ها و آنتی‌بیوتیک‌ها.',
			'table'    => array(
				'columns' => array( 'پارامتر فنی', 'مقدار طراحی', 'واحد سنجش', 'تکنولوژی و متریال' ),
				'rows'    => array(
					array( 'دبی هیدرولیکی ورودی', '۸۰۰', 'مترمکعب/روز', 'تزریق یکنواخت ۲۴ ساعته' ),
					array( 'تکنولوژی فرآیند', 'MBR بیوراکتور غشایی', 'هالو فایبر', 'ممبران‌های غشایی PVDF' ),
					array( 'حذف کلیفرم و پاتوژن', '۹۹.۹۹', 'درصد (%)', 'تزریق ازن + کلرزنی تکمیلی' ),
					array( 'کاهش بار دارویی و آنتی‌بیوتیک', '> ۹۰', 'درصد (%)', 'اکسیداسیون پیشرفته (AOP)' ),
					array( 'جنس مخازن و سازه', 'استنلس استیل و کربن استیل', 'پوشش داخلی اپوکسی', 'مقاوم در برابر مواد شوینده بیمارستانی' ),
				),
			),
		),
	);

	foreach ( $starter_projects as $p ) {
		$p_id = wp_insert_post(
			array(
				'post_title'   => $p['title'],
				'post_content' => $p['content'],
				'post_status'  => 'publish',
				'post_type'    => 'projects',
			)
		);
		if ( $p_id && ! is_wp_error( $p_id ) ) {
			update_post_meta( $p_id, '_project_client', $p['client'] );
			update_post_meta( $p_id, '_project_year', $p['year'] );
			update_post_meta( $p_id, '_project_capacity', $p['capacity'] );
			update_post_meta( $p_id, '_project_location', $p['location'] );
			update_post_meta( $p_id, '_project_status', $p['status'] );
			update_post_meta( $p_id, '_project_technical_table', $p['table'] );
		}
	}
}

/**
 * Fallback menu if no WordPress menu is assigned yet.
 */
if ( ! function_exists( 'pargas_fallback_desktop_menu' ) ) {
	function pargas_fallback_desktop_menu() {
		?>
		<ul class="pargas-nav-list" id="primary-menu">
			<li class="menu-item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'خانه', 'pargaspetroab' ); ?></a></li>
			<li class="menu-item menu-item-has-children">
				<a href="<?php echo esc_url( home_url( '/products/' ) ); ?>"><?php esc_html_e( 'محصولات و تجهیزات', 'pargaspetroab' ); ?></a>
				<ul class="sub-menu">
					<li><a href="<?php echo esc_url( home_url( '/product-category/wastewater-packages/' ) ); ?>"><?php esc_html_e( 'پکیج‌های تصفیه فاضلاب (MBBR/MBR)', 'pargaspetroab' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/product-category/sand-carbon-filters/' ) ); ?>"><?php esc_html_e( 'فیلتر شنی و کربن اکتیو تحت فشار', 'pargaspetroab' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/product-category/daf-systems/' ) ); ?>"><?php esc_html_e( 'سیستم‌های چربی‌گیری DAF', 'pargaspetroab' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/product-category/ro-plants/' ) ); ?>"><?php esc_html_e( 'دستگاه‌های اسمز معکوس (RO)', 'pargaspetroab' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/product-category/sludge-dewatering/' ) ); ?>"><?php esc_html_e( 'فیلتر پرس و آبگیری لجن', 'pargaspetroab' ); ?></a></li>
				</ul>
			</li>
			<li class="menu-item"><a href="<?php echo esc_url( home_url( '/projects/' ) ); ?>"><?php esc_html_e( 'سوابق و پروژه‌ها', 'pargaspetroab' ); ?></a></li>
			<li class="menu-item"><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'درباره ما', 'pargaspetroab' ); ?></a></li>
			<li class="menu-item"><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'تماس با ما', 'pargaspetroab' ); ?></a></li>
		</ul>
		<?php
	}
}
