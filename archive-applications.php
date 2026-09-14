<?php
/**
 * Applications archive.
 *
 * Replaces the Elementor archive template "Applications Archive" (925).
 *
 * @package freemantech
 */

get_header();

$freemantech_hero = freemantech_asset_url( '2026/02/applications-hero.jpg' );
?>

<main id="primary" class="site-main main-flow ft-archive ft-archive--applications">

	<header class="ft-archive__hero"
		<?php if ( $freemantech_hero ) : ?>
			style="background-image:url('<?php echo esc_url( $freemantech_hero ); ?>');"
		<?php endif; ?>>
		<span class="ft-archive__hero-scrim" aria-hidden="true"></span>
		<h1 class="ft-archive__hero-title"><?php esc_html_e( 'Applications', 'freemantech' ); ?></h1>
	</header>

	<div class="ft-archive__grid ft-archive__grid--4 post-content-1">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/cards/card', 'related' );
			endwhile;
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif;
		?>
	</div>

	<?php freemantech_pagination(); ?>

</main><!-- #primary -->

<?php
get_footer();
