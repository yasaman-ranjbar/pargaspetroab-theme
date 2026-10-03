<?php
/**
 * The template for displaying search results pages
 *
 * @package PargasPetroAb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main pargas-search-page">
	<header class="pargas-archive-banner">
		<div class="pargas-container">
			<span class="pargas-subheading"><?php esc_html_e( 'Search Inquiry Results', 'pargaspetroab' ); ?></span>
			<h1 class="pargas-archive-title">
				<?php
				/* translators: %s: search query. */
				printf( esc_html__( 'Results for: "%s"', 'pargaspetroab' ), '<span class="highlight">' . get_search_query() . '</span>' );
				?>
			</h1>
		</div>
	</header>

	<div class="pargas-container pargas-py-8">
		<?php if ( have_posts() ) : ?>
			<div class="pargas-posts-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					$type = get_post_type();
					if ( 'projects' === $type ) {
						get_template_part( 'template-parts/projects/card' );
					} elseif ( 'product' === $type && function_exists( 'wc_get_product' ) ) {
						get_template_part( 'template-parts/products/card' );
					} else {
						?>
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'pargas-blog-card' ); ?>>
							<div class="pargas-blog-card-body">
								<div class="pargas-blog-meta">
									<span><?php echo esc_html( strtoupper( $type ) ); ?></span>
								</div>
								<h2 class="pargas-blog-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<div class="pargas-blog-excerpt"><?php the_excerpt(); ?></div>
								<a href="<?php the_permalink(); ?>" class="pargas-link-more"><?php esc_html_e( 'View Details', 'pargaspetroab' ); ?> &rarr;</a>
							</div>
						</article>
						<?php
					}
				endwhile;
				?>
			</div>

			<div class="pargas-pagination">
				<?php
				the_posts_pagination(
					array(
						'mid_size'  => 2,
						'prev_text' => '&larr; ' . __( 'Previous', 'pargaspetroab' ),
						'next_text' => __( 'Next', 'pargaspetroab' ) . ' &rarr;',
					)
				);
				?>
			</div>
		<?php else : ?>
			<div class="pargas-no-results">
				<h2><?php esc_html_e( 'No Matching Results', 'pargaspetroab' ); ?></h2>
				<p><?php esc_html_e( 'No equipment, projects, or articles matched your query. Please try different keywords or contact our sales team.', 'pargaspetroab' ); ?></p>
				<div class="pargas-searchform-center">
					<?php get_search_form(); ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
