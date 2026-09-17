<?php
/**
 * Products archive.
 *
 * Replaces the Elementor archive template "Products Archive" (657). The page is
 * a hand-built FT4 feature panel followed by the accessories grid rather than a
 * listing of the product post type.
 *
 * @package freemantech
 */

get_header();

$freemantech_ft4_thumb = freemantech_asset_url( '2026/01/FT4-thumb.jpg' );
?>

<main id="primary" class="site-main main-flow ft-archive ft-archive--products">

	<section class="ft-feature-panel">

		<div class="ft-feature-panel__media"
			<?php if ( $freemantech_ft4_thumb ) : ?>
				style="background-image:url('<?php echo esc_url( $freemantech_ft4_thumb ); ?>');"
			<?php endif; ?>
			role="img" aria-label="<?php esc_attr_e( 'FT4 Powder Rheometer', 'freemantech' ); ?>"></div>

		<div class="ft-feature-panel__body">
			<h1 class="ft-feature-panel__title ft-title-sm"><?php esc_html_e( 'FT4 Powder Rheometer®', 'freemantech' ); ?></h1>

			<div class="ft-feature-panel__text">
				<p><?php esc_html_e( 'The FT4 Powder Rheometer, the flagship product from Freeman Technology, is a universal powder tester.', 'freemantech' ); ?></p>
				<p><?php esc_html_e( "In addition to the unique dynamic methodology, where a powder's resistance to flow is measured whilst the powder is in motion, the FT4 also includes a shear cell for measuring the powder’s shear strength, a wall friction kit to quantify how a powder shears with respect to the surfaces of process equipment (in accordance with ASTM Standard D7891), as well as accessories for measuring bulk properties, such as density, compressibility and permeability.", 'freemantech' ); ?></p>
				<p><?php esc_html_e( "The range of measurement capabilities the FT4 provides makes it the world’s most versatile powder testing instrument for measuring and understanding powder flow and powder behaviour.", 'freemantech' ); ?></p>
			</div>

			<div class="simple-read-more btn-blue">
				<a href="<?php echo esc_url( home_url( '/product/ft4-powder-rheometer/' ) ); ?>">
					<?php esc_html_e( 'Learn more about The FT4', 'freemantech' ); ?>
				</a>
			</div>
		</div>

	</section>

	<section id="accessories" class="ft-archive__accessories">

		<header class="ft-archive__intro">
			<h2 class="ft-archive__title ft-title-sm"><?php esc_html_e( 'Accessories', 'freemantech' ); ?></h2>

			<p class="ft-archive__lead">
				<?php esc_html_e( 'Accessories designed to streamline your workflow and meet all your needs, ensuring you have everything required for optimal productivity and convenience.', 'freemantech' ); ?>
			</p>
		</header>

		<div class="ft-archive__grid ft-archive__grid--4">
			<?php
			$freemantech_accessories = new WP_Query(
				array(
					'post_type'           => 'accessories',
					'posts_per_page'      => 20,
					'ignore_sticky_posts' => true,
				)
			);

			while ( $freemantech_accessories->have_posts() ) :
				$freemantech_accessories->the_post();
				get_template_part( 'template-parts/cards/card', 'accessory' );
			endwhile;
			wp_reset_postdata();
			?>
		</div>

	</section>

</main><!-- #primary -->

<?php
get_footer();
