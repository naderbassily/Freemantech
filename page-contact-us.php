<?php
/**
 * Contact us.
 *
 * Replaces the Elementor single-page template "Contact us" (794).
 *
 * @package freemantech
 */

get_header();

while ( have_posts() ) :
	the_post();

	$freemantech_hero = freemantech_asset_url( '2026/02/mail.png' );
	$freemantech_in   = freemantech_asset_url( '2026/02/Flag_of_India.svg.png' );
	$freemantech_jp   = freemantech_asset_url( '2026/02/Flag_of_Japan.svg.png' );
	?>

	<main id="primary" <?php post_class( array( 'site-main', 'main-flow', 'ft-page', 'ft-page--contact' ) ); ?>>

		<header class="ft-page__hero ft-page__hero--pale ft-page__hero--mail"
			<?php if ( $freemantech_hero ) : ?>
				style="background-image:url('<?php echo esc_url( $freemantech_hero ); ?>');"
			<?php endif; ?>>
			<h1 class="ft-page__hero-title ft-title-sm"><?php the_title(); ?></h1>
		</header>

		<div class="ft-contact">

			<div class="ft-contact__form">
				<h2 class="ft-contact__form-title ft-title-xs">
					<?php esc_html_e( 'Submit your enquiry and we’ll respond promptly.', 'freemantech' ); ?>
				</h2>

				<?php freemantech_jotform( '232205999688171' ); ?>
			</div>

			<aside class="ft-contact__info">

				<div class="ft-contact__tile">
					<div class="simple-read-more btn-blue">
						<a href="<?php echo esc_url( home_url( '/support/' ) ); ?>"><?php esc_html_e( 'Product Support', 'freemantech' ); ?></a>
					</div>
				</div>

				<div class="ft-contact__tile">
					<div class="simple-read-more btn-blue">
						<a href="<?php echo esc_url( home_url( '/product/ft4-powder-rheometer/' ) ); ?>"><?php esc_html_e( 'Buy Accessories', 'freemantech' ); ?></a>
					</div>
				</div>

				<div class="ft-contact__tile">
					<div class="simple-read-more btn-blue">
						<a href="#distributors"><?php esc_html_e( 'Distributor', 'freemantech' ); ?></a>
					</div>
				</div>

				<div class="ft-contact__details">
					<p class="ft-contact__details-title"><?php esc_html_e( 'Contact information', 'freemantech' ); ?></p>
					<hr class="ft-contact__rule">

					<p><?php esc_html_e( '1 Miller Court, Severn Drive, Tewkesbury, GL20 8DN', 'freemantech' ); ?></p>

					<p class="ft-contact__row"><span><?php esc_html_e( 'Tel', 'freemantech' ); ?></span><span>+44 (0) 1684 851 551</span></p>
					<p class="ft-contact__row"><span><?php esc_html_e( 'Fax', 'freemantech' ); ?></span><span>+44 (0) 1684 851 552</span></p>
					<p class="ft-contact__row"><span><?php esc_html_e( 'Email', 'freemantech' ); ?></span><span><a href="mailto:info@freemantech.co.uk">info@freemantech.co.uk</a></span></p>
				</div>

			</aside>

		</div>

		<div class="ft-contact__offices">
			<?php echo do_shortcode( '[distributors_grid]' ); ?>
		</div>

		<section class="ft-distributors">

			<h2 class="ft-distributors__title ft-title-xs"><?php esc_html_e( 'Distributor Information', 'freemantech' ); ?></h2>

			<p>
				<?php
				printf(
					/* translators: %s: link to the Micromeritics office locations page. */
					esc_html__( 'For all other locations, not listed below, please visit the %s page.', 'freemantech' ),
					'<a href="https://www.micromeritics.com/contact-us/worldwide-office-locations/" target="_blank" rel="noopener">' . esc_html__( 'Micromeritics Office Locations', 'freemantech' ) . '</a>'
				);
				?>
			</p>

			<div id="distributors" class="ft-distributor">
				<div class="ft-distributor__flag">
					<?php if ( $freemantech_in ) : ?>
						<img src="<?php echo esc_url( $freemantech_in ); ?>" alt="<?php esc_attr_e( 'India', 'freemantech' ); ?>" width="100" height="100">
					<?php endif; ?>
				</div>
				<div class="ft-distributor__body">
					<p>
						<strong><?php esc_html_e( 'Apex Chromatography Pvt Ltd', 'freemantech' ); ?></strong><br>
						<?php esc_html_e( 'Email:', 'freemantech' ); ?> <a href="mailto:ft4@apexchromatography.com">ft4@apexchromatography.com</a><br>
						<?php esc_html_e( 'Tel:', 'freemantech' ); ?> +91 40 6631 9696<br>
						<a href="http://www.apexchromatography.com" target="_blank" rel="noopener">www.apexchromatography.com</a>
					</p>
				</div>
			</div>

			<div class="ft-distributor">
				<div class="ft-distributor__flag">
					<?php if ( $freemantech_jp ) : ?>
						<img src="<?php echo esc_url( $freemantech_jp ); ?>" alt="<?php esc_attr_e( 'Japan', 'freemantech' ); ?>" width="100" height="100">
					<?php endif; ?>
				</div>
				<div class="ft-distributor__body">
					<p>
						<strong><?php esc_html_e( 'Malvern Japan, Div of Spectris Co.Ltd', 'freemantech' ); ?></strong><br>
						<?php esc_html_e( 'Email:', 'freemantech' ); ?> <a href="mailto:yukiyoshi.hiramura@malvern.com">yukiyoshi.hiramura@malvern.com</a><br>
						<?php esc_html_e( 'Tel:', 'freemantech' ); ?> +81 78 306 3806<br>
						<a href="http://www.malvernpanalytical.com/jp" target="_blank" rel="noopener">www.malvernpanalytical.com/jp</a>
					</p>
				</div>
			</div>

		</section>

	</main><!-- #primary -->

	<?php
endwhile;

get_footer();
