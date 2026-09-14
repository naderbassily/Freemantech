<?php
/**
 * The main template file — fallback for anything without a specific template.
 *
 * @package freemantech
 */

get_header();
?>

<main id="primary" class="site-main main-flow ft-archive">

	<?php if ( have_posts() ) : ?>

		<div class="ft-archive__grid ft-archive__grid--3">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/cards/card', 'feature' );
			endwhile;
			?>
		</div>

		<?php freemantech_pagination(); ?>

	<?php else : ?>

		<?php get_template_part( 'template-parts/content', 'none' ); ?>

	<?php endif; ?>

</main><!-- #primary -->

<?php
get_footer();
