<?php
/**
 * Support.
 *
 * Replaces the Elementor single-page template "Support page" (1042).
 *
 * @package freemantech
 */

get_header();

while ( have_posts() ) :
	the_post();

	$freemantech_hero = freemantech_asset_url( '2026/01/Ft4-hero.webp' );
	?>

	<main id="primary" <?php post_class( array( 'site-main', 'main-flow', 'ft-page', 'ft-page--support' ) ); ?>>

		<header class="ft-page__hero ft-page__hero--pale"
			<?php if ( $freemantech_hero ) : ?>
				style="background-image:url('<?php echo esc_url( $freemantech_hero ); ?>');"
			<?php endif; ?>>
			<h1 class="ft-page__hero-title ft-title-sm"><?php the_title(); ?></h1>
			<p class="ft-page__hero-lead">
				<?php esc_html_e( 'Download user manual, software updates and error messages guide', 'freemantech' ); ?>
			</p>
			<a class="ft-btn ft-btn--blue" href="#form"><?php esc_html_e( 'Contact Support', 'freemantech' ); ?></a>
		</header>

		<div class="ft-page__synced">
			<?php echo do_shortcode( '[synced_content slug="ft4"]' ); ?>
		</div>

		<section id="form" class="ft-contact-block">
			<h2 class="ft-contact-block__title ft-title-sm"><?php esc_html_e( 'Need Help?', 'freemantech' ); ?></h2>

			<p class="ft-contact-block__text">
				<?php esc_html_e( 'Contact our team of technical support specialists for assistance with your instruments. We’ll work with you to answer any questions, address issues remotely, and determine the next steps.', 'freemantech' ); ?>
			</p>

			<?php freemantech_jotform( '243436558978172', 716 ); ?>
		</section>

	</main><!-- #primary -->

	<?php
endwhile;

get_footer();
