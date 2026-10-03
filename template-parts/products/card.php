<?php
/**
 * Product Item Card Component
 *
 * Designed for Industrial Equipment B2B catalog browsing.
 *
 * @package PargasPetroAb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
if ( ! $product ) {
	$product = wc_get_product( get_the_ID() );
}
if ( ! $product ) {
	return;
}

$product_id    = $product->get_id();
$product_title = $product->get_name();
$categories    = wc_get_product_category_list( $product_id, ', ' );
$short_desc    = $product->get_short_description();
?>
<div <?php wc_product_class( 'pargas-product-card', $product ); ?>>
	<div class="pargas-product-card-thumb">
		<a href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( $product_title ); ?>">
			<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail( 'pargas-product-card', array( 'loading' => 'lazy', 'alt' => $product_title ) ); ?>
			<?php else : ?>
				<div class="pargas-product-placeholder-img">
					<svg width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
						<path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
						<polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
						<line x1="12" y1="22.08" x2="12" y2="12"></line>
					</svg>
					<span><?php esc_html_e( 'Equipment Specimen', 'pargaspetroab' ); ?></span>
				</div>
			<?php endif; ?>
		</a>
		<span class="pargas-product-badge"><?php esc_html_e( 'Industrial Grade', 'pargaspetroab' ); ?></span>
	</div>

	<div class="pargas-product-card-content">
		<?php if ( ! empty( $categories ) ) : ?>
			<div class="pargas-product-categories">
				<?php echo wp_kses_post( $categories ); ?>
			</div>
		<?php endif; ?>

		<h3 class="pargas-product-card-title">
			<a href="<?php the_permalink(); ?>"><?php echo esc_html( $product_title ); ?></a>
		</h3>

		<?php if ( ! empty( $short_desc ) ) : ?>
			<div class="pargas-product-excerpt">
				<?php echo wp_trim_words( wp_strip_all_tags( $short_desc ), 16, '...' ); ?>
			</div>
		<?php endif; ?>

		<div class="pargas-product-card-actions">
			<a href="<?php the_permalink(); ?>" class="pargas-btn pargas-btn-outline-sm">
				<?php esc_html_e( 'Technical Specs', 'pargaspetroab' ); ?>
			</a>
			<button type="button" class="pargas-btn pargas-btn-primary-sm pargas-open-inquiry-modal" 
				data-product-id="<?php echo esc_attr( $product_id ); ?>" 
				data-product-title="<?php echo esc_attr( $product_title ); ?>"
				data-product-sku="<?php echo esc_attr( $product->get_sku() ); ?>">
				<?php esc_html_e( 'Inquire', 'pargaspetroab' ); ?>
			</button>
		</div>
	</div>
</div>
