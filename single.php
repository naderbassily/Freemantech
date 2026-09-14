<?php
/**
 * Single post fallback (core "post" type).
 *
 * @package freemantech
 */

get_header();
?>

<main id="primary" class="site-main main-flow ft-page">

	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article <?php post_class( 'ft-page__article' ); ?>>
			<h1 class="ft-page__title ft-title-sm"><?php the_title(); ?></h1>

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
