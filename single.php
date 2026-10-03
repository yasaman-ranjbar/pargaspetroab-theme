<?php
/**
 * The template for displaying all single blog posts & technical articles
 *
 * @package PargasPetroAb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<main id="primary" class="site-main pargas-single-post">
		<header class="pargas-post-header">
			<div class="pargas-container">
				<div class="pargas-post-meta-top">
					<span class="pargas-post-category"><?php the_category( ', ' ); ?></span>
					<span class="pargas-post-date">📅 <?php echo get_the_date(); ?></span>
				</div>
				<h1 class="pargas-post-title"><?php the_title(); ?></h1>
			</div>
		</header>

		<div class="pargas-container pargas-py-8">
			<div class="pargas-post-layout">
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'pargas-post-article' ); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="pargas-post-featured-image">
							<?php the_post_thumbnail( 'large', array( 'loading' => 'eager' ) ); ?>
						</div>
					<?php endif; ?>

					<div class="pargas-entry-content">
						<?php the_content(); ?>
					</div>

					<footer class="pargas-post-footer">
						<?php the_tags( '<div class="pargas-tags-list"><span>' . esc_html__( 'Tags: ', 'pargaspetroab' ) . '</span>', ' ', '</div>' ); ?>
					</footer>

					<nav class="pargas-post-navigation">
						<div class="pargas-nav-previous"><?php previous_post_link( '%link', '&larr; %title' ); ?></div>
						<div class="pargas-nav-archive"><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'All Articles', 'pargaspetroab' ); ?></a></div>
						<div class="pargas-nav-next"><?php next_post_link( '%link', '%title &rarr;' ); ?></div>
					</nav>
				</article>

				<!-- Technical Sidebar -->
				<aside class="pargas-post-sidebar">
					<div class="pargas-sidebar-widget">
						<h3><?php esc_html_e( 'Need Treatment Advice?', 'pargaspetroab' ); ?></h3>
						<p><?php esc_html_e( 'Speak directly with our process engineering department for water testing and plant dimensioning.', 'pargaspetroab' ); ?></p>
						<button type="button" class="pargas-btn pargas-btn-primary pargas-btn-block pargas-open-inquiry-modal">
							<?php esc_html_e( 'Consult an Engineer', 'pargaspetroab' ); ?>
						</button>
					</div>

					<div class="pargas-sidebar-widget">
						<h3><?php esc_html_e( 'Key Equipment', 'pargaspetroab' ); ?></h3>
						<ul class="pargas-widget-links">
							<li><a href="<?php echo esc_url( home_url( '/product-category/wastewater-packages/' ) ); ?>"><?php esc_html_e( 'MBBR / MBR Sewage Packages', 'pargaspetroab' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/product-category/daf-systems/' ) ); ?>"><?php esc_html_e( 'DAF Dissolved Air Flotation', 'pargaspetroab' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/product-category/sand-carbon-filters/' ) ); ?>"><?php esc_html_e( 'Sand & Activated Carbon Filters', 'pargaspetroab' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/product-category/ro-plants/' ) ); ?>"><?php esc_html_e( 'Industrial Reverse Osmosis (RO)', 'pargaspetroab' ); ?></a></li>
						</ul>
					</div>
				</aside>
			</div>
		</div>
	</main>
	<?php
endwhile;

get_footer();
