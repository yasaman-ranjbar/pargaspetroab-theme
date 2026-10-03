<?php
/**
 * The template for displaying Single Project Reference Pages
 *
 * @package PargasPetroAb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();

	$project_id = get_the_ID();
	$client     = get_post_meta( $project_id, '_project_client', true );
	$year       = get_post_meta( $project_id, '_project_year', true );
	$capacity   = get_post_meta( $project_id, '_project_capacity', true );
	$location   = get_post_meta( $project_id, '_project_location', true );
	$status     = get_post_meta( $project_id, '_project_status', true );
	?>
	<main id="primary" class="site-main pargas-single-project">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<!-- Project Hero Header -->
			<header class="pargas-project-header">
				<div class="pargas-container">
					<div class="pargas-project-header-meta">
						<?php
						$terms = get_the_terms( $project_id, 'project_category' );
						if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
							?>
							<span class="pargas-project-category-tag">
								<?php echo esc_html( $terms[0]->name ); ?>
							</span>
						<?php endif; ?>

						<?php if ( ! empty( $status ) ) : ?>
							<span class="pargas-project-status-pill"><?php echo esc_html( $status ); ?></span>
						<?php endif; ?>
					</div>

					<h1 class="pargas-project-title"><?php the_title(); ?></h1>

					<!-- Project Engineering Metadata Grid -->
					<div class="pargas-project-meta-grid">
						<?php if ( ! empty( $client ) ) : ?>
							<div class="pargas-meta-card">
								<span class="pargas-meta-card-label"><?php esc_html_e( 'Client / Employer', 'pargaspetroab' ); ?></span>
								<strong class="pargas-meta-card-value"><?php echo esc_html( $client ); ?></strong>
							</div>
						<?php endif; ?>

						<?php if ( ! empty( $capacity ) ) : ?>
							<div class="pargas-meta-card highlight">
								<span class="pargas-meta-card-label"><?php esc_html_e( 'Design Treatment Capacity', 'pargaspetroab' ); ?></span>
								<strong class="pargas-meta-card-value" dir="ltr"><?php echo esc_html( $capacity ); ?></strong>
							</div>
						<?php endif; ?>

						<?php if ( ! empty( $year ) ) : ?>
							<div class="pargas-meta-card">
								<span class="pargas-meta-card-label"><?php esc_html_e( 'Commissioning Year', 'pargaspetroab' ); ?></span>
								<strong class="pargas-meta-card-value"><?php echo esc_html( $year ); ?></strong>
							</div>
						<?php endif; ?>

						<?php if ( ! empty( $location ) ) : ?>
							<div class="pargas-meta-card">
								<span class="pargas-meta-card-label"><?php esc_html_e( 'Plant Site Location', 'pargaspetroab' ); ?></span>
								<strong class="pargas-meta-card-value"><?php echo esc_html( $location ); ?></strong>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</header>

			<div class="pargas-container pargas-py-8">
				<!-- Project Featured Image Banner -->
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="pargas-project-featured-image">
						<?php the_post_thumbnail( 'large', array( 'loading' => 'eager', 'alt' => get_the_title() ) ); ?>
					</div>
				<?php endif; ?>

				<!-- Project Scope & Engineering Description -->
				<?php if ( get_the_content() ) : ?>
					<section class="pargas-project-description-section">
						<h2 class="pargas-section-title">
							<span class="pargas-title-accent"></span>
							<?php esc_html_e( 'Project Scope & Process Overview', 'pargaspetroab' ); ?>
						</h2>
						<div class="pargas-entry-content">
							<?php the_content(); ?>
						</div>
					</section>
				<?php endif; ?>

				<!-- Dedicated Project Technical Table -->
				<?php get_template_part( 'template-parts/projects/table' ); ?>

				<!-- Engineering Consultation CTA -->
				<div class="pargas-project-inquiry-box">
					<div class="pargas-project-inquiry-text">
						<h3><?php esc_html_e( 'Need a Similar Treatment Plant Solution?', 'pargaspetroab' ); ?></h3>
						<p><?php esc_html_e( 'Our chemical and environmental engineering team provides tailored design calculations, process flow diagrams (PFD), and equipment dimensioning.', 'pargaspetroab' ); ?></p>
					</div>
					<div class="pargas-project-inquiry-action">
						<button type="button" class="pargas-btn pargas-btn-primary pargas-btn-lg pargas-open-inquiry-modal" 
							data-product-title="<?php echo esc_attr( get_the_title() ); ?>">
							<?php esc_html_e( 'Inquire About Similar System', 'pargaspetroab' ); ?>
						</button>
					</div>
				</div>

				<!-- Navigation to adjacent projects -->
				<nav class="pargas-post-navigation">
					<div class="pargas-nav-previous">
						<?php previous_post_link( '%link', '&larr; %title' ); ?>
					</div>
					<div class="pargas-nav-archive">
						<a href="<?php echo esc_url( get_post_type_archive_link( 'projects' ) ); ?>">
							<?php esc_html_e( 'All Projects', 'pargaspetroab' ); ?>
						</a>
					</div>
					<div class="pargas-nav-next">
						<?php next_post_link( '%link', '%title &rarr;' ); ?>
					</div>
				</nav>
			</div>
		</article>
	</main>
	<?php
endwhile;

get_footer();
