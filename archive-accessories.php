<?php
/**
 * Accessories archive.
 *
 * Replaces the Elementor archive template #1107.
 *
 * @package freemantech
 */

get_header();
?>

<main id="primary" class="site-main main-flow ft-archive ft-archive--accessories">

	<header class="ft-archive__intro">
		<h1 class="ft-archive__title ft-title-sm"><?php esc_html_e( 'Accessories', 'freemantech' ); ?></h1>

		<p class="ft-archive__lead">
			<?php esc_html_e( 'Accessories designed to streamline your workflow and meet all your needs, ensuring you have everything required for optimal productivity and convenience.', 'freemantech' ); ?>
		</p>
	</header>

	<div class="ft-archive__grid ft-archive__grid--3">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/cards/card', 'accessory' );
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
