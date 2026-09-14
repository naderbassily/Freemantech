<?php
/**
 * The front page.
 *
 * Replaces the Elementor single-page template "Homepage" (post 40), which was
 * bound to page 182.
 *
 * @package freemantech
 */

get_header();

$freemantech_hero_image  = freemantech_asset_url( '2026/01/FT4-hero.jpg' );
$freemantech_intro_image = freemantech_asset_url( '2026/01/a2015a30-9320-4582-9462-f61ef30db650.png' );
?>

<main id="primary" class="site-main main-flow">

	<?php // ------------------------------------------------------------ hero -- ?>
	<section class="ft-hero">

		<div class="ft-hero__content">
			<h1 class="ft-hero__title"><?php esc_html_e( 'FT4 Powder Rheometer', 'freemantech' ); ?></h1>

			<p class="ft-hero__lead">
				<?php esc_html_e( 'A universal powder flow tester for measuring powder flow properties and powder behaviour.', 'freemantech' ); ?>
			</p>

			<a class="ft-btn ft-btn--blue" href="<?php echo esc_url( home_url( '/product/ft4-powder-rheometer/#form' ) ); ?>">
				<?php esc_html_e( 'Request Quote', 'freemantech' ); ?>
			</a>
		</div>

		<div class="ft-hero__media">
			<?php if ( $freemantech_hero_image ) : ?>
				<img class="ft4-hero" src="<?php echo esc_url( $freemantech_hero_image ); ?>"
					alt="<?php esc_attr_e( 'FT4 Powder Rheometer', 'freemantech' ); ?>" width="800" height="500">
			<?php endif; ?>
		</div>

	</section>

	<?php // ------------------------------------------------------- ft4 intro -- ?>
	<section class="ft-intro">

		<div class="ft-intro__media"
			<?php if ( $freemantech_intro_image ) : ?>
				style="background-image:url('<?php echo esc_url( $freemantech_intro_image ); ?>');"
			<?php endif; ?>
			role="img"
			aria-label="<?php esc_attr_e( 'FT4 Powder Rheometer in use', 'freemantech' ); ?>"></div>

		<div class="ft-intro__body">
			<h2 class="ft-intro__title ft-title-sm">
				<?php esc_html_e( 'Comprehensive powder flow characterisation', 'freemantech' ); ?>
			</h2>

			<p>
				<?php esc_html_e( "The FT4, the flagship product from Freeman Technology, is a universal powder flow tester. The range of measurement capabilities the FT4 provides makes it the world’s most versatile powder testing instrument for measuring and understanding powder flow and powder behaviour.", 'freemantech' ); ?>
			</p>

			<div class="simple-read-more btn-blue">
				<a href="<?php echo esc_url( home_url( '/product/ft4-powder-rheometer/' ) ); ?>">
					<?php esc_html_e( 'Learn more about The FT4', 'freemantech' ); ?>
				</a>
			</div>
		</div>

	</section>

	<?php // ----------------------------------------------- resources + promo -- ?>
	<section class="ft-home-cards">

		<div class="ft-home-cards__grid">
			<?php
			$freemantech_resources = new WP_Query(
				array(
					'post_type'           => 'resources',
					'post__in'            => array( 82, 80 ),
					'orderby'             => 'post__in',
					'posts_per_page'      => 2,
					'ignore_sticky_posts' => true,
				)
			);

			if ( $freemantech_resources->have_posts() ) :
				while ( $freemantech_resources->have_posts() ) :
					$freemantech_resources->the_post();
					get_template_part( 'template-parts/cards/card', 'resource' );
				endwhile;
				wp_reset_postdata();
			endif;
			?>
		</div>

		<aside class="ft-home-promo">
			<div class="ft-home-promo__title ft-subtitle">
				<?php esc_html_e( 'Looking for something else?', 'freemantech' ); ?>
			</div>

			<p><?php esc_html_e( 'Browse our full range of instruments.', 'freemantech' ); ?></p>

			<div class="simple-read-more btn-white">
				<a href="<?php echo esc_url( home_url( '/micromeritics-products/' ) ); ?>">
					<?php esc_html_e( 'Micromeritics Products', 'freemantech' ); ?>
				</a>
			</div>
		</aside>

	</section>

	<?php // ---------------------------------------------- applications slider -- ?>
	<section class="ft-applications">

		<h2 class="ft-applications__title ft-title-sm"><?php esc_html_e( 'Applications', 'freemantech' ); ?></h2>

		<?php
		$freemantech_applications = new WP_Query(
			array(
				'post_type'           => 'applications',
				'posts_per_page'      => 99,
				'ignore_sticky_posts'  => true,
			)
		);

		if ( $freemantech_applications->have_posts() ) :
			?>
			<div class="ft-carousel swiper" data-ft-carousel>
				<div class="swiper-wrapper">
					<?php
					while ( $freemantech_applications->have_posts() ) :
						$freemantech_applications->the_post();
						?>
						<div class="swiper-slide">
							<?php get_template_part( 'template-parts/cards/card', 'feature' ); ?>
						</div>
						<?php
					endwhile;
					wp_reset_postdata();
					?>
				</div>

				<button class="ft-carousel__prev" type="button" aria-label="<?php esc_attr_e( 'Previous', 'freemantech' ); ?>"></button>
				<button class="ft-carousel__next" type="button" aria-label="<?php esc_attr_e( 'Next', 'freemantech' ); ?>"></button>
			</div>
			<?php
		endif;
		?>

	</section>

</main><!-- #primary -->

<?php
get_footer();
