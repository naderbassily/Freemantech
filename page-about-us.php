<?php
/**
 * About us.
 *
 * Replaces the Elementor single-page template "About us" (760).
 *
 * @package freemantech
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>

	<main id="primary" class="site-main main-flow ft-page ft-page--about">

		<header class="ft-page__hero"
			<?php if ( has_post_thumbnail() ) : ?>
				style="background-image:url('<?php echo esc_url( get_the_post_thumbnail_url( null, 'full' ) ); ?>');"
			<?php endif; ?>>
			<span class="ft-page__hero-scrim" aria-hidden="true"></span>
			<h1 class="ft-page__hero-title"><?php the_title(); ?></h1>
		</header>

		<div class="ft-page__layout post-content-1">
			<div class="ft-page__content entry-content">
				<?php the_content(); ?>
			</div>

			<aside class="ft-page__aside">
				<?php echo do_shortcode( '[testimonial_carousel]' ); ?>
			</aside>
		</div>

	</main><!-- #primary -->

	<?php
endwhile;

get_footer();
