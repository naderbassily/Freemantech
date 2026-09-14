<?php
/**
 * Template helpers used by the native (non-Elementor) templates.
 *
 * @package freemantech
 */

defined( 'ABSPATH' ) || exit;

/**
 * Resolve a URL for a file living in wp-content/uploads.
 *
 * Used for the brand marks that were previously referenced directly inside
 * Elementor widgets. Returns an empty string when the file is missing so the
 * caller can degrade gracefully.
 *
 * @param string $relative_path Path relative to the uploads base dir, e.g. '2026/01/ft-logo.svg'.
 * @return string
 */
function freemantech_asset_url( $relative_path ) {
	$uploads = wp_get_upload_dir();

	if ( ! empty( $uploads['error'] ) ) {
		return '';
	}

	$relative_path = ltrim( $relative_path, '/' );

	if ( ! file_exists( trailingslashit( $uploads['basedir'] ) . $relative_path ) ) {
		return '';
	}

	return trailingslashit( $uploads['baseurl'] ) . $relative_path;
}

/**
 * Output the header logo, linked home.
 *
 * Mirrors Elementor's "Site Logo" widget: the Customizer custom logo when one
 * is set, otherwise the site name as text.
 */
function freemantech_site_logo() {
	$logo_id = get_theme_mod( 'custom_logo' );

	if ( $logo_id ) {
		printf(
			'<a class="site-header__logo" href="%1$s" rel="home">%2$s</a>',
			esc_url( home_url( '/' ) ),
			wp_get_attachment_image(
				$logo_id,
				'full',
				false,
				array(
					'class' => 'site-header__logo-img',
					'alt'   => get_bloginfo( 'name' ),
				)
			)
		);
		return;
	}

	printf(
		'<a class="site-header__logo site-header__logo--text" href="%1$s" rel="home">%2$s</a>',
		esc_url( home_url( '/' ) ),
		esc_html( get_bloginfo( 'name' ) )
	);
}

/**
 * Render one footer link column.
 *
 * Each column was an Elementor heading + divider + icon-list. The links now
 * come from a nav menu location so they are editable under Appearance > Menus.
 *
 * @param string $location Registered nav menu location.
 * @param string $title    Column heading.
 */
function freemantech_footer_menu_column( $location, $title ) {
	if ( ! has_nav_menu( $location ) ) {
		return;
	}
	?>
	<div class="site-footer__col">
		<h2 class="site-footer__heading"><?php echo esc_html( $title ); ?></h2>
		<span class="site-footer__divider" aria-hidden="true"></span>
		<nav aria-label="<?php echo esc_attr( $title ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => $location,
					'menu_class'     => 'site-footer__list',
					'container'      => false,
					'depth'          => 1,
					'fallback_cb'    => false,
				)
			);
			?>
		</nav>
	</div>
	<?php
}

/**
 * Register the nav menu locations the rebuilt templates rely on.
 */
function freemantech_register_menus() {
	register_nav_menus(
		array(
			'primary'        => esc_html__( 'Primary', 'freemantech' ),
			'footer-popular' => esc_html__( 'Footer — Popular links', 'freemantech' ),
			'footer-ft4'     => esc_html__( 'Footer — FT4 Powder Rheometer', 'freemantech' ),
			'footer-legal'   => esc_html__( 'Footer — Legal information', 'freemantech' ),
		)
	);
}
add_action( 'after_setup_theme', 'freemantech_register_menus', 11 );

/**
 * Query posts related to the given one.
 *
 * Reproduces Elementor's "Related" loop source: same post type, sharing at
 * least one term in any of that post type's taxonomies, most recent first.
 *
 * @param int $post_id Post to find relatives for.
 * @param int $limit   Maximum posts to return.
 * @return WP_Query|null
 */
function freemantech_related_query( $post_id, $limit = 10 ) {
	$post_type  = get_post_type( $post_id );
	$taxonomies = get_object_taxonomies( $post_type );
	$tax_query  = array( 'relation' => 'OR' );

	foreach ( $taxonomies as $taxonomy ) {
		$terms = wp_get_object_terms( $post_id, $taxonomy, array( 'fields' => 'ids' ) );

		if ( ! is_wp_error( $terms ) && $terms ) {
			$tax_query[] = array(
				'taxonomy' => $taxonomy,
				'field'    => 'term_id',
				'terms'    => $terms,
			);
		}
	}

	$args = array(
		'post_type'           => $post_type,
		'post__not_in'        => array( $post_id ),
		'posts_per_page'      => $limit,
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	);

	// Only constrain by taxonomy when the post actually has terms.
	if ( count( $tax_query ) > 1 ) {
		$args['tax_query'] = $tax_query; // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
	}

	$query = new WP_Query( $args );

	return $query->have_posts() ? $query : null;
}

/**
 * Archive pagination.
 *
 * Elementor's loop grids used a "Load More" button; this is the standard
 * numbered equivalent and only prints when there is more than one page.
 */
function freemantech_pagination() {
	the_posts_pagination(
		array(
			'mid_size'           => 1,
			'prev_text'          => esc_html__( 'Previous', 'freemantech' ),
			'next_text'          => esc_html__( 'Next', 'freemantech' ),
			'screen_reader_text' => esc_html__( 'Posts navigation', 'freemantech' ),
			'class'              => 'ft-pagination',
		)
	);
}
