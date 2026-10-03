<?php
/**
 * The template for displaying the Projects & References Archive
 *
 * @package PargasPetroAb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main pargas-projects-archive">
	<!-- Page Header Banner -->
	<div class="pargas-archive-banner">
		<div class="pargas-container">
			<span class="pargas-subheading"><?php esc_html_e( 'Engineering Excellence & Portfolio', 'pargaspetroab' ); ?></span>
			<h1 class="pargas-archive-title"><?php esc_html_e( 'Project References & Commissioned Plants', 'pargaspetroab' ); ?></h1>
			<p class="pargas-archive-intro">
				<?php esc_html_e( 'Explore turnkey installations, industrial wastewater treatment packages, DAF systems, and filtration plants delivered across refinery, petrochemical, municipal, and healthcare sectors.', 'pargaspetroab' ); ?>
			</p>
		</div>
	</div>

	<div class="pargas-container pargas-py-8">
		<!-- Sector Filter Tabs -->
		<?php
		$sectors = get_terms(
			array(
				'taxonomy'   => 'project_category',
				'hide_empty' => true,
			)
		);

		$current_term_id = is_tax( 'project_category' ) ? get_queried_object_id() : 0;
		?>
		<div class="pargas-filter-tabs">
			<a href="<?php echo esc_url( get_post_type_archive_link( 'projects' ) ); ?>" class="pargas-filter-tab <?php echo 0 === $current_term_id ? 'active' : ''; ?>">
				<?php esc_html_e( 'All Sectors', 'pargaspetroab' ); ?>
			</a>
			<?php if ( ! empty( $sectors ) && ! is_wp_error( $sectors ) ) : ?>
				<?php foreach ( $sectors as $sector ) : ?>
					<a href="<?php echo esc_url( get_term_link( $sector ) ); ?>" class="pargas-filter-tab <?php echo $current_term_id === $sector->term_id ? 'active' : ''; ?>">
						<?php echo esc_html( $sector->name ); ?> (<?php echo esc_html( $sector->count ); ?>)
					</a>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>

		<!-- Projects Grid -->
		<?php if ( have_posts() ) : ?>
			<div class="pargas-projects-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/projects/card' );
				endwhile;
				?>
			</div>

			<!-- Pagination -->
			<div class="pargas-pagination">
				<?php
				the_posts_pagination(
					array(
						'mid_size'           => 2,
						'prev_text'          => '&larr; ' . __( 'Previous', 'pargaspetroab' ),
						'next_text'          => __( 'Next', 'pargaspetroab' ) . ' &rarr;',
						'screen_reader_text' => __( 'Projects Navigation', 'pargaspetroab' ),
					)
				);
				?>
			</div>

		<?php else : ?>
			<div class="pargas-no-results">
				<h2><?php esc_html_e( 'No Project References Found', 'pargaspetroab' ); ?></h2>
				<p><?php esc_html_e( 'No project references currently match your selection criteria. Please check back soon or contact our sales team directly.', 'pargaspetroab' ); ?></p>
			</div>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
