<?php
/**
 * Custom WooCommerce Single Product Template
 *
 * Tailored for technical B2B industrial equipment with:
 * - High-resolution gallery
 * - Direct Engineering Quotation / Inquiry CTA
 * - Technical details and specifications tab
 * - Related equipment recommendations
 *
 * @package PargasPetroAb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header( 'shop' );

while ( have_posts() ) :
	the_post();
	global $product;
	?>
	<div class="pargas-single-product-page">
		<div class="pargas-container pargas-py-8">
			<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'pargas-product-layout', $product ); ?>>
				
				<!-- Product Media Gallery -->
				<div class="pargas-product-gallery-col">
					<?php
					/**
					 * Hook: woocommerce_before_single_product_summary.
					 *
					 * @hooked woocommerce_show_product_images - 20
					 */
					do_action( 'woocommerce_before_single_product_summary' );
					?>
				</div>

				<!-- Product Overview & B2B Inquiry Column -->
				<div class="pargas-product-summary-col">
					<div class="pargas-product-meta-header">
						<?php echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="pargas-cat-tag">', '</span>' ); ?>
						<?php if ( $product->get_sku() ) : ?>
							<span class="pargas-sku-tag">SKU: <?php echo esc_html( $product->get_sku() ); ?></span>
						<?php endif; ?>
					</div>

					<h1 class="pargas-single-product-title"><?php the_title(); ?></h1>

					<!-- Short Description / Engineering Highlights -->
					<div class="pargas-product-short-desc">
						<?php woocommerce_template_single_excerpt(); ?>
					</div>

					<!-- Direct B2B Quotation Action -->
					<div class="pargas-b2b-action-card">
						<h3><?php esc_html_e( 'Industrial Procurement & Custom Engineering', 'pargaspetroab' ); ?></h3>
						<p><?php esc_html_e( 'Equipment is manufactured to order based on custom capacity requirements, metallurgical specifications, and effluent chemistry.', 'pargaspetroab' ); ?></p>
						
						<div class="pargas-b2b-cta-btns">
							<button type="button" class="pargas-btn pargas-btn-primary pargas-btn-lg pargas-open-inquiry-modal" 
								data-product-id="<?php echo esc_attr( $product->get_id() ); ?>" 
								data-product-title="<?php echo esc_attr( $product->get_name() ); ?>"
								data-product-sku="<?php echo esc_attr( $product->get_sku() ); ?>">
								<span class="dashicons dashicons-email-alt"></span>
								<?php esc_html_e( 'Request Engineering Quote & Data Sheet', 'pargaspetroab' ); ?>
							</button>

							<a href="tel:+982191091286" class="pargas-btn pargas-btn-outline pargas-btn-lg" dir="ltr">
								📞 +98 (21) 9109 1286
							</a>
						</div>
					</div>

					<!-- Additional Specs and Certifications -->
					<div class="pargas-product-badges-row">
						<span class="pargas-badge-outline">✓ ISO 9001:2015</span>
						<span class="pargas-badge-outline">✓ 1-Year Full Warranty</span>
						<span class="pargas-badge-outline">✓ 10-Year Spare Parts Supply</span>
						<span class="pargas-badge-outline">✓ Turnkey Commissioning</span>
					</div>
				</div>

			</div><!-- .pargas-product-layout -->

			<!-- Technical Specifications Tabs (Full Description / Specs / Attributes) -->
			<div class="pargas-product-tabs-wrapper">
				<?php
				/**
				 * Hook: woocommerce_after_single_product_summary.
				 *
				 * @hooked woocommerce_output_product_data_tabs - 10
				 * @hooked woocommerce_upsell_display - 15
				 * @hooked woocommerce_output_related_products - 20
				 */
				do_action( 'woocommerce_after_single_product_summary' );
				?>
			</div>

		</div><!-- .pargas-container -->
	</div><!-- .pargas-single-product-page -->

	<?php
endwhile;

get_footer( 'shop' );
