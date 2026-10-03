<?php
/**
 * Site Footer Component
 *
 * @package PargasPetroAb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<footer id="colophon" class="pargas-site-footer">
	<div class="pargas-footer-main">
		<div class="pargas-container">
			<div class="pargas-footer-grid">
				<!-- Column 1: Company Profile & Engineering Brand -->
				<div class="pargas-footer-col pargas-footer-about">
					<div class="pargas-footer-brand">
						<svg width="40" height="40" viewBox="0 0 100 100" fill="none" aria-hidden="true">
							<circle cx="50" cy="50" r="46" stroke="var(--color-accent-bright)" stroke-width="6" stroke-dasharray="10 6"/>
							<path d="M50 18C50 18 28 46 28 62C28 74.15 37.85 84 50 84C62.15 84 72 74.15 72 62C72 46 50 18 50 18Z" fill="#00A8CC"/>
						</svg>
						<span class="pargas-footer-title"><?php esc_html_e( 'Pargas Petro Ab', 'pargaspetroab' ); ?></span>
					</div>
					<p class="pargas-footer-desc">
						<?php esc_html_e( 'Manufacturer of advanced industrial and sanitary water and wastewater treatment plant equipment. Delivering turnkey engineering solutions, biological treatment packages, DAF systems, and membrane desalination plants since 2011.', 'pargaspetroab' ); ?>
					</p>
					<div class="pargas-footer-certifications">
						<span class="pargas-badge"><?php esc_html_e( 'ISO 9001:2015 Compliant', 'pargaspetroab' ); ?></span>
						<span class="pargas-badge"><?php esc_html_e( '14+ Years Experience', 'pargaspetroab' ); ?></span>
					</div>
				</div>

				<!-- Column 2: Quick Links -->
				<div class="pargas-footer-col pargas-footer-links">
					<h3 class="pargas-footer-heading"><?php esc_html_e( 'Quick Links', 'pargaspetroab' ); ?></h3>
					<?php
					if ( has_nav_menu( 'footer_quick' ) ) {
						wp_nav_menu(
							array(
								'theme_location' => 'footer_quick',
								'container'      => false,
								'menu_class'     => 'pargas-footer-menu',
								'depth'          => 1,
							)
						);
					} else {
						?>
						<ul class="pargas-footer-menu">
							<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'pargaspetroab' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/products/' ) ); ?>"><?php esc_html_e( 'Equipment Catalog', 'pargaspetroab' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/projects/' ) ); ?>"><?php esc_html_e( 'Project References', 'pargaspetroab' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'Technical Articles & Knowledge Base', 'pargaspetroab' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About Our Company', 'pargaspetroab' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact & Factory Inquiries', 'pargaspetroab' ); ?></a></li>
						</ul>
						<?php
					}
					?>
				</div>

				<!-- Column 3: Equipment & Systems -->
				<div class="pargas-footer-col pargas-footer-products">
					<h3 class="pargas-footer-heading"><?php esc_html_e( 'Water & Wastewater Systems', 'pargaspetroab' ); ?></h3>
					<ul class="pargas-footer-menu">
						<li><a href="<?php echo esc_url( home_url( '/product-category/wastewater-packages/' ) ); ?>"><?php esc_html_e( 'Package Sewage Treatment Plants (MBBR / IFAS)', 'pargaspetroab' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/product-category/sand-carbon-filters/' ) ); ?>"><?php esc_html_e( 'Pressure Sand & Activated Carbon Filters', 'pargaspetroab' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/product-category/daf-systems/' ) ); ?>"><?php esc_html_e( 'DAF (Dissolved Air Flotation) Units', 'pargaspetroab' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/product-category/ro-plants/' ) ); ?>"><?php esc_html_e( 'Industrial Reverse Osmosis (RO) Desalination', 'pargaspetroab' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/product-category/chemical-dosing/' ) ); ?>"><?php esc_html_e( 'Chemical Preparation & Dosing Systems', 'pargaspetroab' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/product-category/sludge-dewatering/' ) ); ?>"><?php esc_html_e( 'Filter Press & Sludge Dewatering Units', 'pargaspetroab' ); ?></a></li>
					</ul>
				</div>

				<!-- Column 4: Contact & Locations -->
				<div class="pargas-footer-col pargas-footer-contact">
					<h3 class="pargas-footer-heading"><?php esc_html_e( 'Headquarters & Factory', 'pargaspetroab' ); ?></h3>
					<ul class="pargas-footer-contact-list">
						<li class="pargas-contact-item-detailed">
							<span class="pargas-contact-icon">📍</span>
							<div>
								<strong><?php esc_html_e( 'Tehran Commercial Office:', 'pargaspetroab' ); ?></strong>
								<p><?php esc_html_e( 'Shahid Motahari St, Delara St, Mirza Shirazi St, No. 24, Floor 2, Tehran, Iran', 'pargaspetroab' ); ?></p>
							</div>
						</li>
						<li class="pargas-contact-item-detailed">
							<span class="pargas-contact-icon">🏭</span>
							<div>
								<strong><?php esc_html_e( 'Manufacturing Plant / Factory:', 'pargaspetroab' ); ?></strong>
								<p><?php esc_html_e( '3rd St, Kaveh Industrial Estate, Najafabad County, Isfahan Province, Iran', 'pargaspetroab' ); ?></p>
							</div>
						</li>
						<li class="pargas-contact-item-detailed">
							<span class="pargas-contact-icon">📞</span>
							<div>
								<strong><?php esc_html_e( 'Sales & Technical Support:', 'pargaspetroab' ); ?></strong>
								<p><a href="tel:+982191091286" dir="ltr">+98 (21) 9109 1286</a></p>
							</div>
						</li>
						<li class="pargas-contact-item-detailed">
							<span class="pargas-contact-icon">✉️</span>
							<div>
								<strong><?php esc_html_e( 'Email:', 'pargaspetroab' ); ?></strong>
								<p><a href="mailto:info@pargaspetroab.com">info@pargaspetroab.com</a></p>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<!-- Footer Bottom Strip -->
	<div class="pargas-footer-bottom">
		<div class="pargas-container pargas-footer-bottom-inner">
			<p class="pargas-copyright">
				&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php esc_html_e( 'Pargas Petro Ab. All rights reserved. Industrial Water & Wastewater Equipment Manufacturer.', 'pargaspetroab' ); ?>
			</p>
			<div class="pargas-footer-extra">
				<span><?php esc_html_e( 'Engineered for Performance, Built for Reliability', 'pargaspetroab' ); ?></span>
			</div>
		</div>
	</div>
</footer>
