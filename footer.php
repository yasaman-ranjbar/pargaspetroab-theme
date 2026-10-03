<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content up to </body>
 *
 * @package PargasPetroAb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
	</div><!-- #content -->

	<?php get_template_part( 'template-parts/footer/site-footer' ); ?>

	<!-- Global B2B Inquiry Modal Component -->
	<?php get_template_part( 'template-parts/components/inquiry-modal' ); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
