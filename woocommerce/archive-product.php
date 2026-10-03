<?php
/**
 * Custom WooCommerce Archive Product Template
 *
 * Implements clean industrial equipment catalog with:
 * - Product Category filtering
 * - Product Type filtering
 * - Zero heavy visual builder dependencies
 *
 * @package PargasPetroAb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header( 'shop' );
?>

<div class="pargas-catalog-header">
	<div class="pargas-container">
		<span class="pargas-subheading"><?php esc_html_e( 'Equipment Catalog & Engineering Systems', 'pargaspetroab' ); ?></span>
		<h1 class="pargas-catalog-title">
			<?php
			if ( is_product_category() ) {
				single_term_title();
			} else {
				esc_html_e( 'Industrial Water Treatment Equipment', 'pargaspetroab' );
			}
			?>
		</h1>
		<?php if ( is_product_category() ) : ?>
			<div class="pargas-category-description">
				<?php do_action( 'woocommerce_archive_description' ); ?>
			</div>
		<?php else : ?>
			<p class="pargas-catalog-lead">
				<?php esc_html_e( 'Engineered for biological, physical, chemical, and membrane separation in wastewater and water purification applications.', 'pargaspetroab' ); ?>
			</p>
		<?php endif; ?>
	</div>
</div>

<div class="pargas-container pargas-py-8">
	<!-- Lightweight Product Filter Bar (Category & Type Only) -->
	<div class="pargas-catalog-toolbar">
		<form method="get" class="pargas-catalog-filter-form" action="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">
			<!-- Product Category Filter -->
			<div class="pargas-filter-item">
				<label for="filter_cat" class="screen-reader-text"><?php esc_html_e( 'Filter by Category', 'pargaspetroab' ); ?></label>
				<select name="filter_cat" id="filter_cat" class="pargas-select-filter" onchange="this.form.submit()">
					<option value=""><?php esc_html_e( 'All Equipment Categories', 'pargaspetroab' ); ?></option>
					<?php
					$categories = get_terms(
						array(
							'taxonomy'   => 'product_cat',
							'hide_empty' => true,
						)
					);
					$selected_cat = isset( $_GET['filter_cat'] ) ? sanitize_text_field( wp_unslash( $_GET['filter_cat'] ) ) : '';
					if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
						foreach ( $categories as $cat ) {
							printf(
								'<option value="%s" %s>%s (%d)</option>',
								esc_attr( $cat->slug ),
								selected( $selected_cat, $cat->slug, false ),
								esc_html( $cat->name ),
								esc_html( $cat->count )
							);
						}
					}
					?>
				</select>
			</div>

			<!-- Product Type Filter -->
			<div class="pargas-filter-item">
				<label for="filter_type" class="screen-reader-text"><?php esc_html_e( 'Filter by Equipment Type', 'pargaspetroab' ); ?></label>
				<select name="filter_type" id="filter_type" class="pargas-select-filter" onchange="this.form.submit()">
					<option value=""><?php esc_html_e( 'All Equipment Types', 'pargaspetroab' ); ?></option>
					<?php
					$types = get_terms(
						array(
							'taxonomy'   => 'pargas_product_type',
							'hide_empty' => false,
						)
					);
					$selected_type = isset( $_GET['filter_type'] ) ? sanitize_text_field( wp_unslash( $_GET['filter_type'] ) ) : '';
					if ( ! empty( $types ) && ! is_wp_error( $types ) ) {
						foreach ( $types as $t ) {
							printf(
								'<option value="%s" %s>%s (%d)</option>',
								esc_attr( $t->slug ),
								selected( $selected_type, $t->slug, false ),
								esc_html( $t->name ),
								esc_html( $t->count )
							);
						}
					}
					?>
				</select>
			</div>

			<?php if ( ! empty( $selected_cat ) || ! empty( $selected_type ) ) : ?>
				<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="pargas-clear-filter-btn">
					&times; <?php esc_html_e( 'Reset Filters', 'pargaspetroab' ); ?>
				</a>
			<?php endif; ?>
		</form>

		<div class="pargas-catalog-count">
			<?php woocommerce_result_count(); ?>
		</div>
	</div>

	<!-- Product Grid -->
	<?php if ( woocommerce_product_loop() ) : ?>
		<div class="pargas-products-grid">
			<?php
			if ( wc_get_loop_prop( 'total' ) ) {
				while ( have_posts() ) {
					the_post();
					get_template_part( 'template-parts/products/card' );
				}
			}
			?>
		</div>

		<!-- Pagination -->
		<div class="pargas-pagination">
			<?php woocommerce_pagination(); ?>
		</div>

	<?php else : ?>
		<div class="pargas-no-results">
			<h2><?php esc_html_e( 'No Equipment Found', 'pargaspetroab' ); ?></h2>
			<p><?php esc_html_e( 'No equipment currently matches your filter selection. Please reset your filters or contact our engineering team directly for custom fabrication.', 'pargaspetroab' ); ?></p>
		</div>
	<?php endif; ?>
</div>

<?php
get_footer( 'shop' );
