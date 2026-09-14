<?php
/**
 * Single product.
 *
 * Replaces the Elementor single-post template "Single Product" (281).
 *
 * @package freemantech
 */

get_header();

while ( have_posts() ) :
	the_post();

	$freemantech_side   = freemantech_asset_url( '2026/01/side-ft4.jpg' );
	$freemantech_logo   = freemantech_asset_url( '2026/01/ft-logo.svg' );
	$freemantech_powder = freemantech_asset_url( '2026/01/ft4-powder.jpg' );
	?>

	<main id="primary" class="site-main main-flow ft-product">

		<?php // -------------------------------------------------------- hero -- ?>
		<section class="ft-product__hero">

			<div class="ft-product__banner">

				<div class="ft-product__banner-content">
					<h1 class="ft-product__title"><?php the_title(); ?></h1>

					<p class="ft-product__lead">
						<?php esc_html_e( 'A universal powder flow tester for measuring powder flow properties and powder behaviour.', 'freemantech' ); ?>
					</p>

					<div class="ft-product__cta">
						<a class="ft-btn ft-btn--blue" href="#form"><?php esc_html_e( 'Request Quote', 'freemantech' ); ?></a>
						<a class="ft-btn ft-btn--blue" href="https://downloads.micromeritics.com/Brochures/FT4-Powder-Rheometer.pdf" target="_blank" rel="noopener">
							<?php esc_html_e( 'Download Brochure', 'freemantech' ); ?>
						</a>
					</div>
				</div>

				<div class="ft-product__banner-media">
					<?php if ( $freemantech_side ) : ?>
						<img class="ft4-hero" src="<?php echo esc_url( $freemantech_side ); ?>" alt="" width="800" height="500">
					<?php endif; ?>
				</div>

			</div>

			<?php // Sticky in-page navigation (was a sticky Elementor container). ?>
			<nav class="inner-nav" aria-label="<?php esc_attr_e( 'On this page', 'freemantech' ); ?>">
				<div class="inner-logo">
					<?php if ( $freemantech_logo ) : ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<img src="<?php echo esc_url( $freemantech_logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" width="203" height="40">
						</a>
					<?php endif; ?>
				</div>

				<div class="inner-nav__items">
					<ul class="inner-nav__list">
						<li><a href="#features"><?php esc_html_e( 'Features', 'freemantech' ); ?></a></li>
						<li><a href="#Methodologies"><?php esc_html_e( 'Methodologies', 'freemantech' ); ?></a></li>
						<li><a href="#hiw"><?php esc_html_e( 'How it works', 'freemantech' ); ?></a></li>
						<li><a href="#applications"><?php esc_html_e( 'Applications', 'freemantech' ); ?></a></li>
						<li><a href="#Specifications"><?php esc_html_e( 'Specifications', 'freemantech' ); ?></a></li>
					</ul>

					<a class="ft-btn ft-btn--blue" href="#form"><?php esc_html_e( 'Request Quote', 'freemantech' ); ?></a>
				</div>
			</nav>

		</section>

		<?php // ---------------------------------------------------- features -- ?>
		<section id="features" class="ft-product__intro">

			<div class="ft-product__intro-body">
				<h2 class="ft-product__heading ft-title-sm">
					<?php esc_html_e( 'Powder Flow Testing with the FT4 Powder Rheometer', 'freemantech' ); ?>
				</h2>

				<p><?php esc_html_e( 'The FT4 was designed with one purpose in mind - to characterise the rheology of powders, or powder flow properties. This remains a primary function today, but the instrument, accessories and methodologies have been continuously developed to the point where the FT4 is now considered a universal powder flow tester. It differs from other powder testers in many ways but when assessing industrial value, three features are critical:', 'freemantech' ); ?></p>

				<ul>
					<li><?php esc_html_e( 'The ability to simulate powder processing conditions, by testing samples in consolidated, moderately stressed, aerated or fluidised state', 'freemantech' ); ?></li>
					<li><?php esc_html_e( 'The application of multi-faceted powder characterisation to assess dynamic powder flow, bulk and shear properties to construct the most comprehensive understanding of how a powder behaves', 'freemantech' ); ?></li>
					<li><?php esc_html_e( 'Unparalleled sensitivity, enabling the differentiation of powders that other testers classify as identical', 'freemantech' ); ?></li>
				</ul>
			</div>

			<div class="ft-product__intro-media"
				<?php if ( $freemantech_powder ) : ?>
					style="background-image:url('<?php echo esc_url( $freemantech_powder ); ?>');"
				<?php endif; ?>
				role="img" aria-label="<?php esc_attr_e( 'Powder sample', 'freemantech' ); ?>"></div>

		</section>

		<hr class="ft-product__rule">

		<section class="ft-product__tiles">
			<div class="ft-product__tile">
				<p class="ft-product__tile-lead"><?php esc_html_e( 'Fully automated', 'freemantech' ); ?></p>
				<p><?php esc_html_e( 'test programs and data analysis', 'freemantech' ); ?></p>
			</div>
			<div class="ft-product__tile">
				<p class="ft-product__tile-lead"><?php esc_html_e( 'Conditioning mode', 'freemantech' ); ?></p>
				<p><?php esc_html_e( 'provides unparalleled repeatability', 'freemantech' ); ?></p>
			</div>
			<div class="ft-product__tile">
				<p class="ft-product__tile-lead"><?php esc_html_e( 'Range of sample size, 10ml to 160m', 'freemantech' ); ?></p>
				<p><?php esc_html_e( '(in addition a 1ml Shear Cell is available)', 'freemantech' ); ?></p>
			</div>
		</section>

		<hr class="ft-product__rule">

		<?php // ------------------------------------------------ methodologies -- ?>
		<section id="Methodologies" class="ft-product__methodologies">

			<div class="ft-product__methodologies-body">
				<h2 class="ft-product__heading ft-title-sm"><?php esc_html_e( 'Methodologies', 'freemantech' ); ?></h2>

				<p><?php esc_html_e( 'The FT4 is a truly universal powder flow tester, with four categories of methodologies, defined as', 'freemantech' ); ?></p>

				<div class="ft-product__method-links">
					<div class="simple-read-more btn-blue"><a href="<?php echo esc_url( home_url( '/features/bulk/' ) ); ?>"><?php esc_html_e( 'Bulk', 'freemantech' ); ?></a></div>
					<div class="simple-read-more btn-blue"><a href="<?php echo esc_url( home_url( '/features/external-variables/' ) ); ?>"><?php esc_html_e( 'Process', 'freemantech' ); ?></a></div>
					<div class="simple-read-more btn-blue"><a href="<?php echo esc_url( home_url( '/features/dynamic-methodology/' ) ); ?>"><?php esc_html_e( 'Dynamic Flow', 'freemantech' ); ?></a></div>
					<div class="simple-read-more btn-blue"><a href="<?php echo esc_url( home_url( '/features/shear-testing/' ) ); ?>"><?php esc_html_e( 'Shear (in accordance with ASTM D7981)', 'freemantech' ); ?></a></div>
				</div>

				<div class="ft-product__note">
					<h3 class="ft-product__note-title"><?php esc_html_e( 'Other Measurements', 'freemantech' ); ?></h3>
					<p><?php esc_html_e( 'Utilising the dynamic methodologies of the FT4 Powder Rheometer, and good experimental design, it is possible to investigate a number of other behavioural properties of powders.', 'freemantech' ); ?></p>
					<div class="simple-read-more btn-blue">
						<a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Learn more', 'freemantech' ); ?></a>
					</div>
				</div>
			</div>

			<div class="ft-product__chart">
				<?php get_template_part( 'template-parts/powder-chart' ); ?>
			</div>

		</section>

		<hr class="ft-product__rule">

		<?php // ------------------------------------------------- how it works -- ?>
		<section id="hiw" class="ft-product__hiw">

			<h2 class="ft-product__heading ft-title-sm"><?php esc_html_e( 'How it works', 'freemantech' ); ?></h2>

			<?php get_template_part( 'template-parts/product-tabs' ); ?>

		</section>

		<hr class="ft-product__rule">

		<?php // ------------------------------------------------------- others -- ?>
		<section class="ft-product__others">

			<div class="ft-product__other">
				<h2 class="ft-product__heading ft-title-sm"><?php esc_html_e( 'Sample Conditioning', 'freemantech' ); ?></h2>
				<h3 class="ft-product__other-sub"><?php esc_html_e( 'The Importance of Conditioning', 'freemantech' ); ?></h3>

				<div class="ft-product__other-text">
					<p><?php esc_html_e( 'Anyone who has worked with powders will know how easily they change their density, just as a result of handling them. Tip them from a beaker and they aerate, or tap the beaker on the bench and observe a reduction in volume as the powder becomes compacted.', 'freemantech' ); ?></p>
				</div>

				<div class="simple-read-more btn-blue">
					<a href="<?php echo esc_url( home_url( '/features/sample-conditioning/' ) ); ?>"><?php esc_html_e( 'Learn more', 'freemantech' ); ?></a>
				</div>
			</div>

			<div class="ft-product__other">
				<h2 class="ft-product__heading ft-title-sm"><?php esc_html_e( 'External Variables', 'freemantech' ); ?></h2>
				<h3 class="ft-product__other-sub"><?php esc_html_e( 'The Need for Versatility', 'freemantech' ); ?></h3>

				<div class="ft-product__other-text">
					<p><?php esc_html_e( 'Powder flow properties are complex and cannot be quantified by a single number. Flowability must be considered in relation to the conditions imposed by the process and application. Powders may exhibit “good” flow if loosely packed, but “bad” flow after consolidation. Some powders may flow well as long as flow rates are relatively high, however they may stop flowing when moved more slowly.', 'freemantech' ); ?></p>
				</div>

				<div class="simple-read-more btn-blue">
					<a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Learn more', 'freemantech' ); ?></a>
				</div>
			</div>

		</section>

		<hr class="ft-product__rule">

		<?php // ------------------------------------------------- applications -- ?>
		<section id="applications" class="ft-product__applications">

			<h2 class="ft-product__heading ft-title-sm"><?php esc_html_e( 'Applications', 'freemantech' ); ?></h2>

			<p><?php esc_html_e( 'Whether your objective is to optimise a formulation in a development environment, predict in-process performance, understand batch differences, or to ensure the quality of raw materials or intermediates, the FT4 will provide valuable and unique information that will help you address your powder flow challenges.', 'freemantech' ); ?></p>

			<?php
			$freemantech_apps = new WP_Query(
				array(
					'post_type'           => 'applications',
					'posts_per_page'      => 99,
					'ignore_sticky_posts' => true,
				)
			);

			if ( $freemantech_apps->have_posts() ) :
				?>
				<div class="ft-carousel swiper" data-ft-carousel>
					<div class="swiper-wrapper">
						<?php
						while ( $freemantech_apps->have_posts() ) :
							$freemantech_apps->the_post();
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
					<div class="ft-carousel__pagination"></div>
				</div>
				<?php
			endif;
			?>

		</section>

		<?php // ------------------------------------------------ specifications -- ?>
		<section id="Specifications" class="ft-product__specs">
			<h2 class="ft-product__heading ft-title-sm"><?php esc_html_e( 'Specifications', 'freemantech' ); ?></h2>
			<?php echo do_shortcode( '[product_specs]' ); ?>
		</section>

		<?php // -------------------------------------------------------- form -- ?>
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
