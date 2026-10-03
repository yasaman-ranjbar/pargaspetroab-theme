<?php
/**
 * The template for displaying archive pages
 *
 * @package PargasPetroAb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main pargas-general-archive">
	<header class="pargas-archive-banner">
		<div class="pargas-container">
			<?php the_archive_title( '<h1 class="pargas-archive-title">', '</h1>' ); ?>
			<?php the_archive_description( '<div class="pargas-archive-intro">', '</div>' ); ?>
		</div>
	</header>

	<div class="pargas-container pargas-py-8">
		<?php if ( have_posts() ) : ?>
			<div class="pargas-posts-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'pargas-blog-card' ); ?>>
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="pargas-blog-card-thumb">
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium_large' ); ?></a>
							</div>
						<?php endif; ?>
						<div class="pargas-blog-card-body">
							<div class="pargas-blog-meta">
								<span><?php echo get_the_date(); ?></span>
								<span class="pargas-meta-divider">&bull;</span>
								<span><?php the_category( ', ' ); ?></span>
							</div>
							<h2 class="pargas-blog-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<div class="pargas-blog-excerpt"><?php the_excerpt(); ?></div>
							<a href="<?php the_permalink(); ?>" class="pargas-link-more"><?php esc_html_e( 'Read Article', 'pargaspetroab' ); ?> &rarr;</a>
						</div>
					</article>
					<?php
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
				<h2><?php esc_html_e( 'Nothing Found', 'pargaspetroab' ); ?></h2>
				<p><?php esc_html_e( 'No entries found under this archive.', 'pargaspetroab' ); ?></p>
			</div>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
