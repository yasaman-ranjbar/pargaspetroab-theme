<?php
/**
 * The template for displaying all pages
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
	<main id="primary" class="site-main pargas-page-template">
		<header class="pargas-page-header">
			<div class="pargas-container">
				<h1 class="pargas-page-title"><?php the_title(); ?></h1>
			</div>
		</header>

		<div class="pargas-container pargas-py-8">
			<div class="pargas-page-content-wrapper">
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'pargas-entry-content' ); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="pargas-page-featured-image">
							<?php the_post_thumbnail( 'large' ); ?>
						</div>
					<?php endif; ?>

					<div class="pargas-content-body">
						<?php
						the_content();

						wp_link_pages(
							array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'pargaspetroab' ),
								'after'  => '</div>',
							)
						);
						?>
					</div>
				</article>
			</div>
		</div>
	</main>
	<?php
endwhile;

get_footer();
