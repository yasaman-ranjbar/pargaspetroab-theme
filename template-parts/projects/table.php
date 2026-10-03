<?php
/**
 * Project Technical Specifications Table Component
 *
 * @package PargasPetroAb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$project_id = get_the_ID();
$table_html = pargas_render_project_table( $project_id );

if ( ! empty( $table_html ) ) :
	?>
	<section class="pargas-project-technical-section">
		<div class="pargas-section-header">
			<h2 class="pargas-section-title">
				<span class="pargas-title-accent"></span>
				<?php esc_html_e( 'Technical Specifications & Performance Parameters', 'pargaspetroab' ); ?>
			</h2>
			<p class="pargas-section-subtitle">
				<?php esc_html_e( 'Verified engineering design criteria, mechanical specifications, and plant operating metrics.', 'pargaspetroab' ); ?>
			</p>
		</div>

		<?php echo $table_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</section>
<?php endif; ?>
