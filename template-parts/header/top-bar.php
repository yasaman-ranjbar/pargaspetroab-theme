<?php
/**
 * Header Top Bar Component
 *
 * Sticky top bar containing search, direct contact numbers, and social links.
 *
 * @package PargasPetroAb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="pargas-top-bar" id="pargas-top-bar">
	<div class="pargas-container pargas-top-bar-inner">
		<!-- Search Form Widget -->
		<div class="pargas-top-search">
			<form role="search" method="get" class="pargas-header-searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<label for="pargas-top-search-input" class="screen-reader-text"><?php esc_html_e( 'Search industrial equipment...', 'pargaspetroab' ); ?></label>
				<div class="pargas-search-input-wrap">
					<span class="pargas-search-icon" aria-hidden="true">
						<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
					</span>
					<input type="search" id="pargas-top-search-input" class="pargas-top-search-input" placeholder="<?php esc_attr_e( 'Search equipment, products, or references...', 'pargaspetroab' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
					<?php if ( class_exists( 'WooCommerce' ) ) : ?>
						<input type="hidden" name="post_type" value="product" />
					<?php endif; ?>
				</div>
			</form>
		</div>

		<!-- Direct Contact Numbers -->
		<div class="pargas-top-contacts">
			<div class="pargas-contact-item">
				<span class="pargas-icon" aria-hidden="true">
					<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
				</span>
				<span class="pargas-label"><?php esc_html_e( 'Tehran HQ:', 'pargaspetroab' ); ?></span>
				<a href="tel:+982191091286" class="pargas-phone-link" dir="ltr">+98 (21) 9109 1286</a>
			</div>
			<div class="pargas-contact-item pargas-hide-mobile">
				<span class="pargas-icon" aria-hidden="true">
					<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
				</span>
				<a href="mailto:info@pargaspetroab.com" class="pargas-email-link">info@pargaspetroab.com</a>
			</div>
		</div>

		<!-- Social & Professional Links -->
		<div class="pargas-top-socials">
			<a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'LinkedIn', 'pargaspetroab' ); ?>" class="pargas-social-link">
				<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
			</a>
			<a href="https://wa.me/989124388097" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'WhatsApp', 'pargaspetroab' ); ?>" class="pargas-social-link">
				<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
			</a>
		</div>
	</div>
</div>
