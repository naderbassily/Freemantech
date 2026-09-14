<?php
/**
 * Micromeritics Products.
 *
 * Replaces the Elementor single-page template "Mic Products" (982).
 *
 * @package freemantech
 */

get_header();
?>

<main id="primary" class="site-main main-flow ft-page ft-page--mic">

	<header class="ft-page__intro">
		<h1 class="ft-page__title ft-title-sm"><?php esc_html_e( 'Micromeritics Product', 'freemantech' ); ?></h1>

		<div class="ft-page__intro-text">
			<p>
				<?php
				printf(
					/* translators: %s: link to micromeritics.com. */
					esc_html__( 'Freeman Technology became part of the %s in June 2018.', 'freemantech' ),
					'<a href="https://micromeritics.com/" target="_blank" rel="noopener">' . esc_html__( 'Micromeritics Instrument Corporation', 'freemantech' ) . '</a>'
				);
				?>
			</p>
			<p><?php esc_html_e( 'Micromeritics is the world’s leading supplier of high-performance systems to characterize particles, powders and porous materials with a focus on physical properties, chemical activity, and flow properties. Our industry-leading technology portfolio includes: pycnometry, adsorption, dynamic chemisorption, intrusion porosimetry, powder rheology, activity testing of catalysts, and particle size.', 'freemantech' ); ?></p>
			<p><?php esc_html_e( 'The company has R&D and manufacturing sites in the USA, UK, and Spain, and direct sales and service operations throughout the Americas, Europe, and Asia. Micromeritics systems are the instruments-of-choice in more than 10,000 laboratories of the world’s most innovative companies, prestigious government, and academic institutions. Our world-class scientists and responsive support teams enable customer success by applying Micromeritics technology to the most demanding applications.', 'freemantech' ); ?></p>
		</div>
	</header>

	<div class="ft-product-grid">
		<?php
		$freemantech_products = new WP_Query(
			array(
				'post_type'           => 'product',
				'post__not_in'        => array( 279 ), // The FT4 has its own page.
				'posts_per_page'      => 99,
				'orderby'             => 'title',
				'order'               => 'ASC',
				'ignore_sticky_posts' => true,
			)
		);

		while ( $freemantech_products->have_posts() ) :
			$freemantech_products->the_post();
			get_template_part( 'template-parts/cards/card', 'product' );
		endwhile;
		wp_reset_postdata();
		?>
	</div>

</main><!-- #primary -->

<?php
get_footer();
