<?php
/**
 * Generic archive fallback.
 *
 * Used for any archive without a more specific template.
 *
 * @package freemantech
 */

get_header();
?>

<main id="primary" class="site-main main-flow ft-archive">

	<?php if ( have_posts() ) : ?>

		<header class="ft-archive__intro">
			<?php the_archive_title( '<h1 class="ft-archive__title ft-title-sm">', '</h1>' ); ?>
			<?php the_archive_description( '<div class="ft-archive__lead">', '</div>' ); ?>
		</header>

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
