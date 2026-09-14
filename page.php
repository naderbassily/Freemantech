<?php
/**
 * Default page template.
 *
 * Replaces the Elementor single-page template "Policies Template" (993), which
 * was bound to the three policy pages: title followed by the editor content.
 *
 * @package freemantech
 */

get_header();
?>

<main id="primary" class="site-main main-flow ft-page ft-page--doc">

	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article <?php post_class( 'ft-page__article' ); ?>>
			<h1 class="ft-page__title ft-title-md"><?php the_title(); ?></h1>

			<div class="ft-page__content entry-content">
				<?php the_content(); ?>
			</div>
		</article>
		<?php
	endwhile;
	?>

</main><!-- #primary -->

<?php
get_footer();
