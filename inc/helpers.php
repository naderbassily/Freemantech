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
 * Elementor's "Related" loop source had no taxonomy selected, so in practice it
 * listed the most recent posts of the same post type. This reproduces that,
 * with one deliberate change: the post being viewed is excluded, where the
 * Elementor version could list the current article under "Related:".
 *
 * @param int $post_id Post to find relatives for.
 * @param int $limit   Maximum posts to return.
 * @return WP_Query|null
 */
function freemantech_related_query( $post_id, $limit = 10 ) {
	$query = new WP_Query(
		array(
			'post_type'           => get_post_type( $post_id ),
			'post__not_in'        => array( $post_id ),
			'posts_per_page'      => $limit,
			'orderby'             => 'date',
			'order'               => 'DESC',
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		)
	);

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

/**
 * Embed a JotForm.
 *
 * The forms were previously injected through Elementor HTML widgets; the markup
 * is identical, it just lives in the theme now.
 *
 * @param string $form_id JotForm form id.
 */
function freemantech_jotform( $form_id ) {
	printf(
		'<div class="ft-jotform"><script type="text/javascript" src="%s"></script></div>',
		esc_url( 'https://form.jotform.com/jsform/' . $form_id )
	);
}

/**
 * Output a post excerpt the way Elementor's post-excerpt widget did.
 *
 * Two behaviours worth keeping:
 *
 * 1. It read the excerpt field directly (the dynamic tag ran with
 *    apply_to_post_content "no" and no fallback), so a post with an empty
 *    excerpt showed nothing at all. get_the_excerpt() would instead trim the
 *    post content into an auto-excerpt ending in "[…]", which 17 posts here
 *    would suddenly gain.
 * 2. Excerpts are hand-written: some wrap themselves in <p> tags, and some
 *    contain a bare "<" (for example "sizes <10 μm"). wp_kses_post() keeps the
 *    real markup and escapes the stray "<", where the_excerpt() would treat it
 *    as a tag and swallow the rest of the sentence.
 */
function freemantech_the_excerpt() {
	$excerpt = get_post_field( 'post_excerpt', get_the_ID() );

	if ( '' === trim( (string) $excerpt ) ) {
		return;
	}

	echo wp_kses_post( wptexturize( $excerpt ) );
}

/**
 * Load the brand webfonts.
 *
 * Elementor used to enqueue these from Google Fonts; without them the theme
 * declared Inter / Inter Tight / Roboto but fell back to whatever the visitor
 * happened to have, which changed text metrics and line wrapping everywhere.
 * Weights match what Elementor requested.
 */
function freemantech_fonts() {
	$weights = '100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic';

	$families = array(
		'Inter'       => $weights,
		'Inter+Tight' => $weights,
		'Roboto'      => $weights,
	);

	foreach ( $families as $family => $variants ) {
		wp_enqueue_style(
			'freemantech-font-' . strtolower( str_replace( '+', '-', $family ) ),
			'https://fonts.googleapis.com/css?family=' . $family . ':' . $variants . '&display=swap',
			array(),
			null // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
		);
	}
}
add_action( 'wp_enqueue_scripts', 'freemantech_fonts', 5 );

/**
 * Preconnect to the Google Fonts hosts so the faces arrive sooner.
 *
 * @param array  $urls          Resource URLs.
 * @param string $relation_type Relation type.
 * @return array
 */
function freemantech_font_preconnect( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array( 'href' => 'https://fonts.gstatic.com', 'crossorigin' );
		$urls[] = array( 'href' => 'https://fonts.googleapis.com' );
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'freemantech_font_preconnect', 10, 2 );

/**
 * Render an image that lives in uploads, via its attachment where possible.
 *
 * Going through the attachment gets real width/height (and srcset) onto the
 * tag, so lazy-loaded images reserve their space instead of collapsing to zero
 * height before they load.
 *
 * @param string $relative_path Path relative to the uploads base dir.
 * @param array  $attr          Extra attributes for the img tag.
 */
function freemantech_asset_image( $relative_path, $attr = array() ) {
	$url = freemantech_asset_url( $relative_path );

	if ( ! $url ) {
		return;
	}

	$attachment_id = attachment_url_to_postid( $url );

	if ( $attachment_id ) {
		echo wp_get_attachment_image( $attachment_id, 'full', false, $attr ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		return;
	}

	$out = '';
	foreach ( $attr as $key => $value ) {
		$out .= sprintf( ' %s="%s"', esc_attr( $key ), esc_attr( $value ) );
	}

	printf( '<img src="%s"%s>', esc_url( $url ), $out ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}
