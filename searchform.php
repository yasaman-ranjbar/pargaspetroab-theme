<?php
/**
 * Accessible search form template
 *
 * @package PargasPetroAb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<form role="search" method="get" class="pargas-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="pargas-search-field-default" class="screen-reader-text">
		<?php esc_html_e( 'Search for:', 'pargaspetroab' ); ?>
	</label>
	<div class="pargas-search-bar">
		<input type="search" id="pargas-search-field-default" class="pargas-search-field" placeholder="<?php esc_attr_e( 'Search equipment, references, or articles...', 'pargaspetroab' ); ?>" value="<?php echo get_search_query(); ?>" name="s" required />
		<button type="submit" class="pargas-search-submit pargas-btn pargas-btn-primary">
			<?php esc_html_e( 'Search', 'pargaspetroab' ); ?>
		</button>
	</div>
</form>
