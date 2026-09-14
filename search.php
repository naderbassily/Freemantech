<?php
/**
 * Search results.
 *
 * Elementor's Search widget rendered results through its own template; this is
 * the theme's equivalent, reusing the resource card.
 *
 * @package freemantech
 */

get_header();
?>

<main id="primary" class="site-main main-flow ft-archive ft-archive--search">

	<header class="ft-archive__intro">
		<h1 class="ft-archive__title ft-title-sm">
			<?php
			printf(
				/* translators: %s: search query. */
				esc_html__( 'Search results for: %s', 'freemantech' ),
				'<span>' . esc_html( get_search_query() ) . '</span>'
			);
			?>
		</h1>

		<div class="ft-archive__search"><?php get_search_form(); ?></div>
	</header>

	<?php if ( have_posts() ) : ?>

		<div class="ft-search-results">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/cards/card', 'resource' );
			endwhile;
			?>
		</div>

		<?php freemantech_pagination(); ?>

	<?php else : ?>

		<p><?php esc_html_e( 'It seems we can’t find what you’re looking for.', 'freemantech' ); ?></p>

	<?php endif; ?>

</main><!-- #primary -->

<?php
get_footer();
