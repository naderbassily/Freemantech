<?php
/**
 * Search results.
 *
 * Presented like the Resource Library listing: a stacked list of cards, each
 * showing what kind of content it is, its title, an excerpt and a read-more.
 *
 * @package freemantech
 */

get_header();

global $wp_query;
$freemantech_total = (int) $wp_query->found_posts;
$freemantech_query = get_search_query();
?>

<main id="primary" class="site-main main-flow ft-results">

	<header class="ft-results__header">
		<h1 class="ft-results__title"><?php esc_html_e( 'Search', 'freemantech' ); ?></h1>

		<?php if ( have_posts() ) : ?>
			<p class="ft-results__count">
				<?php
				printf(
					/* translators: 1: number of results, 2: search term. */
					esc_html( _n( '%1$s result for %2$s', '%1$s results for %2$s', $freemantech_total, 'freemantech' ) ),
					'<strong>' . esc_html( number_format_i18n( $freemantech_total ) ) . '</strong>',
					'<strong>&ldquo;' . esc_html( $freemantech_query ) . '&rdquo;</strong>'
				);
				?>
			</p>
		<?php endif; ?>

		<?php // With no results the empty state carries its own field, so skip this one. ?>
		<?php if ( have_posts() ) : ?>
			<div class="ft-results__search"><?php get_search_form(); ?></div>
		<?php endif; ?>
	</header>

	<?php if ( have_posts() ) : ?>

		<div class="ft-results__list">
			<?php
			while ( have_posts() ) :
				the_post();

				$freemantech_type  = get_post_type_object( get_post_type() );
				$freemantech_label = $freemantech_type ? $freemantech_type->labels->singular_name : '';
				?>
				<article <?php post_class( 'ft-result' ); ?>>

					<?php if ( has_post_thumbnail() ) : ?>
						<a class="ft-result__media" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
							<?php the_post_thumbnail( 'medium', array( 'alt' => '' ) ); ?>
						</a>
					<?php endif; ?>

					<div class="ft-result__body">
						<?php if ( $freemantech_label ) : ?>
							<p class="ft-result__meta"><?php echo esc_html( $freemantech_label ); ?></p>
						<?php endif; ?>

						<h2 class="ft-result__title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h2>

						<div class="ft-result__excerpt">
							<?php echo esc_html( wp_trim_words( get_the_excerpt(), 30 ) ); ?>
						</div>

						<a class="ft-result__link" href="<?php the_permalink(); ?>">
							<?php esc_html_e( 'Read More', 'freemantech' ); ?> &rarr;
						</a>
					</div>

				</article>
				<?php
			endwhile;
			?>
		</div>

		<?php freemantech_pagination(); ?>

	<?php else : ?>

		<div class="ft-empty">
			<svg class="ft-empty__icon" viewBox="0 0 512 512" width="48" height="48" aria-hidden="true" focusable="false"><path d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"/></svg>

			<h2 class="ft-empty__title">
				<?php
				if ( '' !== $freemantech_query ) {
					printf(
						/* translators: %s: search term. */
						esc_html__( 'No results for %s', 'freemantech' ),
						'&ldquo;' . esc_html( $freemantech_query ) . '&rdquo;'
					);
				} else {
					esc_html_e( 'Nothing to search for yet', 'freemantech' );
				}
				?>
			</h2>

			<p class="ft-empty__text">
				<?php esc_html_e( 'Try a different wording, a shorter phrase, or a product name such as “FT4”. You can also browse the sections below.', 'freemantech' ); ?>
			</p>

			<div class="ft-empty__search"><?php get_search_form(); ?></div>

			<div class="ft-empty__links">
				<a class="ft-btn ft-btn--blue" href="<?php echo esc_url( home_url( '/resources/' ) ); ?>"><?php esc_html_e( 'Resource Library', 'freemantech' ); ?></a>
				<a class="ft-btn ft-btn--outline" href="<?php echo esc_url( home_url( '/products/' ) ); ?>"><?php esc_html_e( 'Products', 'freemantech' ); ?></a>
				<a class="ft-btn ft-btn--outline" href="<?php echo esc_url( home_url( '/applications/' ) ); ?>"><?php esc_html_e( 'Applications', 'freemantech' ); ?></a>
				<a class="ft-btn ft-btn--outline" href="<?php echo esc_url( home_url( '/contact-us/' ) ); ?>"><?php esc_html_e( 'Contact us', 'freemantech' ); ?></a>
			</div>
		</div>

	<?php endif; ?>

</main><!-- #primary -->

<?php
get_footer();
