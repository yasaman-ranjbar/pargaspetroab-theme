<?php
/**
 * Main Navigation & Branding Component
 *
 * @package PargasPetroAb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Current language detection (WPML, Polylang, or native locale).
$current_lang = 'fa';
if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
	$current_lang = ICL_LANGUAGE_CODE;
} elseif ( function_exists( 'pll_current_language' ) ) {
	$current_lang = pll_current_language();
} else {
	$locale       = get_locale();
	$current_lang = ( 0 === strpos( $locale, 'fa' ) ) ? 'fa' : 'en';
}
?>
<div class="pargas-main-header" id="pargas-main-header">
	<div class="pargas-container pargas-main-header-inner">
		<!-- Brand Logo -->
		<div class="pargas-site-branding">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="pargas-custom-logo-link" rel="home">
					<div class="pargas-brand-mark">
						<!-- Industrial Water Treatment SVG Logo -->
						<svg width="42" height="42" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
							<circle cx="50" cy="50" r="46" stroke="var(--color-accent-bright)" stroke-width="6" stroke-dasharray="10 6"/>
							<path d="M50 18C50 18 28 46 28 62C28 74.15 37.85 84 50 84C62.15 84 72 74.15 72 62C72 46 50 18 50 18Z" fill="url(#pargas_water_gradient)"/>
							<path d="M38 60C38 60 44 68 54 66C60 64.8 63 60 63 60" stroke="#FFFFFF" stroke-width="4" stroke-linecap="round"/>
							<defs>
								<linearGradient id="pargas_water_gradient" x1="50" y1="18" x2="50" y2="84" gradientUnits="userSpaceOnUse">
									<stop stop-color="#00A8CC"/>
									<stop offset="1" stop-color="#0F2B48"/>
								</linearGradient>
							</defs>
						</svg>
					</div>
					<div class="pargas-brand-text">
						<span class="pargas-brand-title"><?php esc_html_e( 'PARGAS PETRO AB', 'pargaspetroab' ); ?></span>
						<span class="pargas-brand-tagline"><?php esc_html_e( 'Water & Wastewater Engineering Equipment', 'pargaspetroab' ); ?></span>
					</div>
				</a>
			<?php endif; ?>
		</div>

		<!-- Desktop Navigation Menu -->
		<nav id="site-navigation" class="pargas-desktop-nav" aria-label="<?php esc_attr_e( 'Main Menu', 'pargaspetroab' ); ?>">
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
						'container'      => false,
						'menu_class'     => 'pargas-nav-list',
						'fallback_cb'    => 'pargas_fallback_desktop_menu',
						'depth'          => 3,
					)
				);
			} else {
				pargas_fallback_desktop_menu();
			}
			?>
		</nav>

		<!-- Header Actions: Language Switcher & Quote CTA -->
		<div class="pargas-header-actions">
			<!-- Language Switcher -->
			<div class="pargas-lang-switcher" aria-label="<?php esc_attr_e( 'Language Selection', 'pargaspetroab' ); ?>">
				<?php if ( function_exists( 'pll_the_languages' ) ) : ?>
					<ul class="pargas-lang-list">
						<?php pll_the_languages( array( 'show_flags' => 0, 'show_names' => 1 ) ); ?>
					</ul>
				<?php elseif ( function_exists( 'icl_get_languages' ) ) : ?>
					<?php
					$languages = icl_get_languages( 'skip_missing=0' );
					if ( ! empty( $languages ) ) :
						?>
						<div class="pargas-lang-dropdown">
							<span class="pargas-lang-active"><?php echo strtoupper( esc_html( $current_lang ) ); ?></span>
							<ul class="pargas-lang-list">
								<?php foreach ( $languages as $l ) : ?>
									<li class="<?php echo $l['active'] ? 'active' : ''; ?>">
										<a href="<?php echo esc_url( $l['url'] ); ?>"><?php echo esc_html( $l['native_name'] ); ?></a>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
					<?php endif; ?>
				<?php else : ?>
					<!-- Fallback Bilingual Switcher -->
					<div class="pargas-lang-pills">
						<a href="?lang=fa" class="pargas-lang-pill <?php echo 'fa' === $current_lang ? 'active' : ''; ?>">فا</a>
						<span class="pargas-lang-divider">|</span>
						<a href="?lang=en" class="pargas-lang-pill <?php echo 'en' === $current_lang ? 'active' : ''; ?>">EN</a>
					</div>
				<?php endif; ?>
			</div>

			<!-- B2B Procurement CTA -->
			<div class="pargas-header-cta pargas-hide-mobile">
				<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="pargas-btn pargas-btn-outline-sm">
					<?php esc_html_e( 'Inquiry & Quote', 'pargaspetroab' ); ?>
				</a>
			</div>

			<!-- Hamburger Toggle Button -->
			<button type="button" class="pargas-hamburger-btn" id="pargas-drawer-open-btn" aria-controls="pargas-mobile-nav-drawer" aria-expanded="false" aria-label="<?php esc_attr_e( 'Open Navigation Menu', 'pargaspetroab' ); ?>">
				<span class="pargas-hamburger-line"></span>
				<span class="pargas-hamburger-line"></span>
				<span class="pargas-hamburger-line"></span>
			</button>
		</div>
	</div>
</div>

<?php
/**
 * Fallback menu if no WordPress menu is assigned yet.
 */
function pargas_fallback_desktop_menu() {
	?>
	<ul class="pargas-nav-list" id="primary-menu">
		<li class="menu-item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'pargaspetroab' ); ?></a></li>
		<li class="menu-item menu-item-has-children">
			<a href="<?php echo esc_url( home_url( '/products/' ) ); ?>"><?php esc_html_e( 'Products & Equipment', 'pargaspetroab' ); ?></a>
			<ul class="sub-menu">
				<li><a href="<?php echo esc_url( home_url( '/product-category/wastewater-packages/' ) ); ?>"><?php esc_html_e( 'Sewage Treatment Packages (MBBR/MBR)', 'pargaspetroab' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/product-category/sand-carbon-filters/' ) ); ?>"><?php esc_html_e( 'Sand & Activated Carbon Filters', 'pargaspetroab' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/product-category/daf-systems/' ) ); ?>"><?php esc_html_e( 'DAF (Dissolved Air Flotation)', 'pargaspetroab' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/product-category/ro-plants/' ) ); ?>"><?php esc_html_e( 'Industrial Reverse Osmosis (RO)', 'pargaspetroab' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/product-category/sludge-dewatering/' ) ); ?>"><?php esc_html_e( 'Filter Press & Dewatering', 'pargaspetroab' ); ?></a></li>
			</ul>
		</li>
		<li class="menu-item"><a href="<?php echo esc_url( home_url( '/projects/' ) ); ?>"><?php esc_html_e( 'Projects & References', 'pargaspetroab' ); ?></a></li>
		<li class="menu-item"><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'Technical Articles', 'pargaspetroab' ); ?></a></li>
		<li class="menu-item"><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About Us', 'pargaspetroab' ); ?></a></li>
		<li class="menu-item"><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact Us', 'pargaspetroab' ); ?></a></li>
	</ul>
	<?php
}
