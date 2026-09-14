<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * Replaces the Elementor error-404 template (1079).
 *
 * @package freemantech
 */

get_header();
?>

<main id="primary" class="site-main main-flow ft-404">

	<h1 class="ft-404__title"><?php esc_html_e( 'Page not found', 'freemantech' ); ?></h1>

	<p><?php esc_html_e( 'Sorry, we couldn’t find that page.', 'freemantech' ); ?></p>

	<div class="simple-read-more btn-blue ft-404__home">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'HOME', 'freemantech' ); ?></a>
	</div>

</main><!-- #primary -->

<?php
get_footer();
