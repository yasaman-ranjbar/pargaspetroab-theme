<?php
/**
 * The header for Pargas Petro Ab theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package PargasPetroAb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary">
		<?php esc_html_e( 'Skip to primary content', 'pargaspetroab' ); ?>
	</a>

	<header id="masthead" class="site-header">
		<?php get_template_part( 'template-parts/header/top-bar' ); ?>
		<?php get_template_part( 'template-parts/header/main-nav' ); ?>
	</header>

	<?php get_template_part( 'template-parts/header/mobile-nav' ); ?>

	<!-- Breadcrumb presentation area -->
	<?php
	if ( function_exists( 'pargas_render_breadcrumbs' ) ) {
		pargas_render_breadcrumbs();
	}
	?>

	<div id="content" class="site-content">
