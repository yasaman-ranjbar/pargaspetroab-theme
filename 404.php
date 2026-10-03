<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package PargasPetroAb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main pargas-404-page">
	<div class="pargas-container pargas-py-16 text-center">
		<div class="pargas-404-box">
			<span class="pargas-404-code" dir="ltr">404</span>
			<h1 class="pargas-404-title"><?php esc_html_e( 'Page or Specification Not Found', 'pargaspetroab' ); ?></h1>
			<p class="pargas-lead">
				<?php esc_html_e( 'The industrial equipment specification, project reference, or technical document you requested may have moved or been updated.', 'pargaspetroab' ); ?>
			</p>

			<div class="pargas-404-actions">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="pargas-btn pargas-btn-primary pargas-btn-lg">
					<?php esc_html_e( 'Return to Homepage', 'pargaspetroab' ); ?>
				</a>
				<a href="<?php echo esc_url( home_url( '/products/' ) ); ?>" class="pargas-btn pargas-btn-outline pargas-btn-lg">
					<?php esc_html_e( 'Browse Equipment Catalog', 'pargaspetroab' ); ?>
				</a>
			</div>

			<div class="pargas-search-404-wrap" style="max-width: 500px; margin: 40px auto 0;">
				<?php get_search_form(); ?>
			</div>
		</div>
	</div>
</main>

<?php
get_footer();
