<?php
/**
 * Single "article" layout, shared by Applications, Resources and Features.
 *
 * Replaces the Elementor single-post template "Single Article" (229), which was
 * bound to all three post types.
 *
 * @package freemantech
 */

get_header();

while ( have_posts() ) :
	the_post();

	$freemantech_overlay = freemantech_asset_url( '2026/02/favi-white.svg' );
	$freemantech_terms   = get_the_term_list( get_the_ID(), 'class', '', ', ', '' );
	$freemantech_video   = function_exists( 'get_field' ) ? get_field( 'video' ) : '';
	$freemantech_dl      = function_exists( 'get_field' ) ? get_field( 'resource_link' ) : '';

	/*
	 * The download link was gated by Dynamic Visibility: Resources carrying the
	 * "Application note" term in the `class` taxonomy.
	 */
	$freemantech_show_dl = $freemantech_dl
		&& 'resources' === get_post_type()
		&& has_term( 'application-note', 'class' );
	?>

	<main id="primary" class="site-main main-flow">

		<article <?php post_class( 'ft-article' ); ?>>

			<header class="ft-article__hero"
				<?php if ( has_post_thumbnail() ) : ?>
					style="background-image:url('<?php echo esc_url( get_the_post_thumbnail_url( null, 'full' ) ); ?>');"
				<?php endif; ?>>

				<?php if ( $freemantech_overlay ) : ?>
					<span class="ft-article__hero-mark" aria-hidden="true"
						style="background-image:url('<?php echo esc_url( $freemantech_overlay ); ?>');"></span>
				<?php endif; ?>

				<?php if ( $freemantech_terms && ! is_wp_error( $freemantech_terms ) ) : ?>
					<div class="ft-article__terms"><?php echo wp_kses_post( $freemantech_terms ); ?></div>
				<?php endif; ?>

				<h1 class="ft-article__title"><?php the_title(); ?></h1>
			</header>

			<div class="ft-article__layout post-content-1">

				<div class="ft-article__main">

					<?php if ( $freemantech_video ) : ?>
						<div class="ft-article__video">
							<?php echo wp_oembed_get( $freemantech_video ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</div>
					<?php endif; ?>

					<div class="ft-article__content entry-content">
						<?php the_content(); ?>
					</div>

					<?php if ( $freemantech_show_dl ) : ?>
						<div class="simple-read-more btn-blue ft-article__download">
							<a href="<?php echo esc_url( $freemantech_dl ); ?>"><?php esc_html_e( 'Download', 'freemantech' ); ?></a>
						</div>
					<?php endif; ?>

				</div>

				<?php
				$freemantech_related = freemantech_related_query( get_the_ID(), 10 );

				if ( $freemantech_related && $freemantech_related->have_posts() ) :
					?>
					<aside class="ft-article__related">
						<h2 class="ft-article__related-title ft-title-sm"><?php esc_html_e( 'Related:', 'freemantech' ); ?></h2>

						<div class="ft-article__related-list">
							<?php
							while ( $freemantech_related->have_posts() ) :
								$freemantech_related->the_post();
								get_template_part( 'template-parts/cards/card', 'related' );
							endwhile;
							wp_reset_postdata();
							?>
						</div>
					</aside>
					<?php
				endif;
				?>

			</div>

		</article>

	</main><!-- #primary -->

	<?php
endwhile;

get_template_part( 'template-parts/back-to-top' );
get_footer();
