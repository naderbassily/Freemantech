<?php
/**
 * Single accessory.
 *
 * Replaces the Elementor single-post template "Accessories" (1132).
 *
 * @package freemantech
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>

	<main id="primary" class="site-main main-flow ft-accessory">

		<article <?php post_class( 'ft-accessory__intro' ); ?>>

			<?php if ( has_post_thumbnail() ) : ?>
				<div class="ft-accessory__media">
					<?php the_post_thumbnail( 'large', array( 'alt' => '' ) ); ?>
				</div>
			<?php endif; ?>

			<div class="ft-accessory__body">
				<h1 class="ft-accessory__title"><?php the_title(); ?></h1>

				<div class="ft-accessory__content entry-content">
					<?php the_content(); ?>
				</div>
			</div>

		</article>

		<section id="form" class="ft-contact-block">
			<h2 class="ft-contact-block__title ft-title-sm"><?php esc_html_e( 'Request Info', 'freemantech' ); ?></h2>

			<p class="ft-contact-block__text">
				<?php esc_html_e( 'Request a quote or talk to an expert for more information', 'freemantech' ); ?>
			</p>

			<?php freemantech_jotform( '232205999688171' ); ?>
		</section>

	</main><!-- #primary -->

	<?php
endwhile;

get_footer();
