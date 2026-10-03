<?php
/**
 * Template Name: سوابق و مراجع اجرایی (Projects & References)
 *
 * Dedicated Projects/References Page Template with interactive
 * technical table expansion on click.
 *
 * @package PargasPetroAb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main pargas-projects-page">
	<header class="pargas-page-banner">
		<div class="pargas-container">
			<span class="pargas-subheading"><?php esc_html_e( 'سوابق و مراجع اجرایی', 'pargaspetroab' ); ?></span>
			<h1 class="pargas-page-title"><?php esc_html_e( 'پروژه‌ها و تصفیه‌خانه‌های راه‌اندازی‌شده', 'pargaspetroab' ); ?></h1>
			<p class="pargas-page-intro">
				<?php esc_html_e( 'فهرست پروژه‌های اجرا شده توسط شرکت پرگاس پترو آب به همراه امکان مشاهده آنلاین جدول مشخصات فنی، ظرفیت و نتایج عملکردی هر پروژه.', 'pargaspetroab' ); ?>
			</p>
		</div>
	</header>

	<div class="pargas-container pargas-py-8">
		<!-- Sector Filter Tabs -->
		<?php
		$sectors = get_terms(
			array(
				'taxonomy'   => 'project_category',
				'hide_empty' => false,
			)
		);
		$current_sector = isset( $_GET['sector'] ) ? sanitize_text_field( wp_unslash( $_GET['sector'] ) ) : '';
		?>
		<div class="pargas-filter-tabs">
			<a href="<?php echo esc_url( get_permalink() ); ?>" class="pargas-filter-tab <?php echo empty( $current_sector ) ? 'active' : ''; ?>">
				<?php esc_html_e( 'همه حوزه‌ها', 'pargaspetroab' ); ?>
			</a>
			<?php if ( ! empty( $sectors ) && ! is_wp_error( $sectors ) ) : ?>
				<?php foreach ( $sectors as $sec ) : ?>
					<a href="<?php echo esc_url( add_query_arg( 'sector', $sec->slug, get_permalink() ) ); ?>" class="pargas-filter-tab <?php echo $current_sector === $sec->slug ? 'active' : ''; ?>">
						<?php echo esc_html( $sec->name ); ?> (<?php echo esc_html( $sec->count ); ?>)
					</a>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>

		<!-- Projects Query -->
		<?php
		$args = array(
			'post_type'      => 'projects',
			'posts_per_page' => 20,
			'post_status'    => 'publish',
		);

		if ( ! empty( $current_sector ) ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'project_category',
					'field'    => 'slug',
					'terms'    => $current_sector,
				),
			);
		}

		$projects_query = new WP_Query( $args );

		if ( $projects_query->have_posts() ) :
			?>
			<div class="pargas-interactive-projects-list">
				<?php
				while ( $projects_query->have_posts() ) :
					$projects_query->the_post();
					$project_id = get_the_ID();
					$client     = get_post_meta( $project_id, '_project_client', true );
					$year       = get_post_meta( $project_id, '_project_year', true );
					$capacity   = get_post_meta( $project_id, '_project_capacity', true );
					$location   = get_post_meta( $project_id, '_project_location', true );
					$status     = get_post_meta( $project_id, '_project_status', true );
					$table_html = function_exists( 'pargas_render_project_table' ) ? pargas_render_project_table( $project_id ) : '';
					?>
					<article id="project-card-<?php echo esc_attr( $project_id ); ?>" class="pargas-project-interactive-card">
						<div class="pargas-project-card-summary">
							<div class="pargas-project-interactive-thumb">
								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( 'pargas-project-card', array( 'loading' => 'lazy', 'alt' => get_the_title() ) ); ?>
								<?php else : ?>
									<div class="pargas-project-placeholder-img">
										<span>⚙️ <?php esc_html_e( 'پروژه پرگاس پترو آب', 'pargaspetroab' ); ?></span>
									</div>
								<?php endif; ?>
							</div>

							<div class="pargas-project-interactive-info">
								<div class="pargas-project-card-meta-top">
									<?php if ( ! empty( $year ) ) : ?>
										<span class="pargas-project-year">📅 <?php echo esc_html( $year ); ?></span>
									<?php endif; ?>
									<?php if ( ! empty( $location ) ) : ?>
										<span class="pargas-project-location">📍 <?php echo esc_html( $location ); ?></span>
									<?php endif; ?>
									<?php if ( ! empty( $status ) ) : ?>
										<span class="pargas-project-status-pill"><?php echo esc_html( $status ); ?></span>
									<?php endif; ?>
								</div>

								<h2 class="pargas-project-interactive-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h2>

								<div class="pargas-project-specs">
									<?php if ( ! empty( $client ) ) : ?>
										<div class="pargas-spec-row">
											<span class="pargas-spec-label"><?php esc_html_e( 'کارفرما / مجتمع:', 'pargaspetroab' ); ?></span>
											<strong class="pargas-spec-val"><?php echo esc_html( $client ); ?></strong>
										</div>
									<?php endif; ?>

									<?php if ( ! empty( $capacity ) ) : ?>
										<div class="pargas-spec-row highlight">
											<span class="pargas-spec-label"><?php esc_html_e( 'ظرفیت تصفیه:', 'pargaspetroab' ); ?></span>
											<strong class="pargas-spec-val" dir="ltr"><?php echo esc_html( $capacity ); ?></strong>
										</div>
									<?php endif; ?>
								</div>

								<!-- Interactive Trigger for Technical Table -->
								<div class="pargas-interactive-actions">
									<?php if ( ! empty( $table_html ) ) : ?>
										<button type="button" class="pargas-btn pargas-btn-primary-sm pargas-toggle-table-btn" data-target="pargas-table-box-<?php echo esc_attr( $project_id ); ?>">
											<span class="pargas-table-icon">📊</span>
											<span class="pargas-btn-label"><?php esc_html_e( 'مشاهده جدول مشخصات فنی', 'pargaspetroab' ); ?></span>
											<span class="pargas-toggle-caret" aria-hidden="true">&#9660;</span>
										</button>
									<?php endif; ?>

									<a href="<?php the_permalink(); ?>" class="pargas-btn pargas-btn-outline-sm">
										<?php esc_html_e( 'صفحه اختصاصی پروژه', 'pargaspetroab' ); ?> &larr;
									</a>
								</div>
							</div>
						</div>

						<!-- Collapsible Technical Specifications Table Section -->
						<?php if ( ! empty( $table_html ) ) : ?>
							<div id="pargas-table-box-<?php echo esc_attr( $project_id ); ?>" class="pargas-interactive-table-panel" style="display: none;">
								<div class="pargas-table-panel-header">
									<h4>📋 <?php esc_html_e( 'جدول مشخصات و پارامترهای فنی پروژه:', 'pargaspetroab' ); ?> <?php the_title(); ?></h4>
								</div>
								<div class="pargas-table-panel-body">
									<?php echo $table_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</div>
							</div>
						<?php endif; ?>
					</article>
					<?php
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		<?php else : ?>
			<div class="pargas-no-results">
				<h2><?php esc_html_e( 'هیچ پروژه‌ای یافت نشد', 'pargaspetroab' ); ?></h2>
				<p><?php esc_html_e( 'در این بخش پروژه‌ای ثبت نشده است.', 'pargaspetroab' ); ?></p>
			</div>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
