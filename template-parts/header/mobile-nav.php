<?php
/**
 * Accessible Mobile Navigation Drawer Component
 *
 * Implements:
 * - Backdrop click to close
 * - Close button with focus state
 * - Trapped keyboard focus & ESC key listener
 * - Company branding inside drawer
 * - Language switcher & quick direct contact
 *
 * @package PargasPetroAb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- Mobile Drawer Backdrop -->
<div class="pargas-drawer-backdrop" id="pargas-drawer-backdrop" aria-hidden="true"></div>

<!-- Mobile Navigation Drawer -->
<aside id="pargas-mobile-nav-drawer" class="pargas-mobile-drawer" aria-label="<?php esc_attr_e( 'Mobile Menu', 'pargaspetroab' ); ?>" aria-hidden="true" role="dialog" aria-modal="true">
	<div class="pargas-drawer-header">
		<div class="pargas-drawer-brand">
			<svg width="34" height="34" viewBox="0 0 100 100" fill="none" aria-hidden="true">
				<circle cx="50" cy="50" r="46" stroke="var(--color-accent-bright)" stroke-width="6" stroke-dasharray="10 6"/>
				<path d="M50 18C50 18 28 46 28 62C28 74.15 37.85 84 50 84C62.15 84 72 74.15 72 62C72 46 50 18 50 18Z" fill="var(--color-accent)"/>
			</svg>
			<span class="pargas-drawer-brand-text"><?php esc_html_e( 'Pargas Petro Ab', 'pargaspetroab' ); ?></span>
		</div>
		<button type="button" class="pargas-drawer-close-btn" id="pargas-drawer-close-btn" aria-label="<?php esc_attr_e( 'Close navigation drawer', 'pargaspetroab' ); ?>">
			&times;
		</button>
	</div>

	<div class="pargas-drawer-body">
		<!-- Search in Mobile Drawer -->
		<div class="pargas-drawer-search">
			<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<input type="search" placeholder="<?php esc_attr_e( 'Search equipment...', 'pargaspetroab' ); ?>" value="<?php echo get_search_query(); ?>" name="s" class="pargas-drawer-search-input" />
			</form>
		</div>

		<!-- Mobile Navigation List -->
		<nav class="pargas-drawer-nav">
			<?php
			if ( has_nav_menu( 'mobile' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'mobile',
						'container'      => false,
						'menu_class'     => 'pargas-drawer-nav-list',
						'depth'          => 2,
					)
				);
			} elseif ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'pargas-drawer-nav-list',
						'depth'          => 2,
					)
				);
			} else {
				pargas_fallback_desktop_menu();
			}
			?>
		</nav>

		<!-- Language Switcher in Drawer -->
		<div class="pargas-drawer-lang-section">
			<span class="pargas-drawer-section-title"><?php esc_html_e( 'Language:', 'pargaspetroab' ); ?></span>
			<div class="pargas-lang-pills">
				<a href="?lang=fa" class="pargas-lang-pill">فارسی</a>
				<span class="pargas-lang-divider">|</span>
				<a href="?lang=en" class="pargas-lang-pill">English</a>
			</div>
		</div>

		<!-- Quick Contacts in Drawer -->
		<div class="pargas-drawer-contacts">
			<div class="pargas-drawer-contact-line">
				<strong><?php esc_html_e( 'Tehran Sales HQ:', 'pargaspetroab' ); ?></strong>
				<a href="tel:+982191091286" dir="ltr">+98 (21) 9109 1286</a>
			</div>
			<div class="pargas-drawer-contact-line">
				<strong><?php esc_html_e( 'Email:', 'pargaspetroab' ); ?></strong>
				<a href="mailto:info@pargaspetroab.com">info@pargaspetroab.com</a>
			</div>
			<div class="pargas-drawer-contact-line">
				<strong><?php esc_html_e( 'Factory:', 'pargaspetroab' ); ?></strong>
				<span><?php esc_html_e( 'Najafabad, Kaveh Industrial Estate, Isfahan', 'pargaspetroab' ); ?></span>
			</div>
		</div>

		<!-- Direct CTA in Drawer -->
		<div class="pargas-drawer-cta-wrap">
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="pargas-btn pargas-btn-primary pargas-btn-block">
				<?php esc_html_e( 'Request Quotation', 'pargaspetroab' ); ?>
			</a>
		</div>
	</div>
</aside>
