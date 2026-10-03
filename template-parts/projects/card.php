<?php
/**
 * Project Reference Card Component
 *
 * Displays individual project reference card with metadata:
 * image, title, client, execution year, capacity, location.
 *
 * @package PargasPetroAb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$project_id = get_the_ID();
$client     = get_post_meta( $project_id, '_project_client', true );
$year       = get_post_meta( $project_id, '_project_year', true );
$capacity   = get_post_meta( $project_id, '_project_capacity', true );
$location   = get_post_meta( $project_id, '_project_location', true );
$status     = get_post_meta( $project_id, '_project_status', true );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'pargas-project-card' ); ?>>
	<div class="pargas-project-card-thumb">
		<a href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( get_the_title() ); ?>">
			<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail( 'pargas-project-card', array( 'loading' => 'lazy', 'alt' => get_the_title() ) ); ?>
			<?php else : ?>
				<div class="pargas-project-placeholder-img">
					<svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
						<path d="M2 20h20"></path><path d="M5 20V8a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v12"></path><path d="M9 12h6"></path><path d="M9 16h6"></path>
					</svg>
					<span><?php esc_html_e( 'Pargas Petro Ab Project', 'pargaspetroab' ); ?></span>
				</div>
			<?php endif; ?>
		</a>
		<?php if ( ! empty( $status ) ) : ?>
			<span class="pargas-project-status-badge"><?php echo esc_html( $status ); ?></span>
		<?php endif; ?>
	</div>

	<div class="pargas-project-card-content">
		<div class="pargas-project-card-meta-top">
			<?php if ( ! empty( $year ) ) : ?>
				<span class="pargas-project-year">
					<span class="pargas-meta-icon" aria-hidden="true">📅</span>
					<?php echo esc_html( $year ); ?>
				</span>
			<?php endif; ?>
			<?php if ( ! empty( $location ) ) : ?>
				<span class="pargas-project-location">
					<span class="pargas-meta-icon" aria-hidden="true">📍</span>
					<?php echo esc_html( $location ); ?>
				</span>
			<?php endif; ?>
		</div>

		<h3 class="pargas-project-card-title">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h3>

		<div class="pargas-project-specs">
			<?php if ( ! empty( $client ) ) : ?>
				<div class="pargas-spec-row">
					<span class="pargas-spec-label"><?php esc_html_e( 'Client / Employer:', 'pargaspetroab' ); ?></span>
					<span class="pargas-spec-val"><?php echo esc_html( $client ); ?></span>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $capacity ) ) : ?>
				<div class="pargas-spec-row highlight">
					<span class="pargas-spec-label"><?php esc_html_e( 'Treatment Capacity:', 'pargaspetroab' ); ?></span>
					<span class="pargas-spec-val" dir="ltr"><?php echo esc_html( $capacity ); ?></span>
				</div>
			<?php endif; ?>
		</div>

		<div class="pargas-project-card-footer">
			<a href="<?php the_permalink(); ?>" class="pargas-link-arrow">
				<span><?php esc_html_e( 'View Technical Specifications & Table', 'pargaspetroab' ); ?></span>
				<span class="pargas-arrow" aria-hidden="true">&rarr;</span>
			</a>
		</div>
	</div>
</article>
