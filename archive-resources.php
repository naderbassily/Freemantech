<?php
/**
 * Resources archive.
 *
 * Replaces the Elementor archive template "Resource Archive" (483). The listing
 * itself is the theme's own [resource_filter] shortcode, unchanged.
 *
 * @package freemantech
 */

get_header();
?>

<main id="primary" class="site-main main-flow ft-archive ft-archive--resources">

	<header class="ft-archive__intro">
		<h1 class="ft-archive__title ft-title-sm"><?php esc_html_e( 'Resource Library', 'freemantech' ); ?></h1>

		<p>
			<?php esc_html_e( 'Freeman Technology, a global leader in powder characterisation, has a wide array of materials providing an authoritative knowledge base for formulation scientists, process engineers and product developers working with powders. These resources provide a detailed overview of the complexity of powders and the challenges they present, and uses industry specific examples to demonstrate how powder rheology has been used to solve processing problems.', 'freemantech' ); ?>
		</p>
	</header>

	<?php echo do_shortcode( '[resource_filter]' ); ?>

</main><!-- #primary -->

<?php
get_footer();
