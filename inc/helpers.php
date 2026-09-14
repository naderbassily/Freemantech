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
 * listed the most recent posts of the same post type, excluding the one being
 * viewed.
 *
 * Several resources share an identical post_date, so date alone leaves the
 * tail of the list to MySQL's discretion and it can differ between installs.
 * ID descending is the tiebreaker that reproduces the live ordering.
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
			'orderby'             => array(
				'date' => 'DESC',
				'ID'   => 'DESC',
			),
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
 * Deliberately NOT the /jsform/ script embed that Elementor used. That script
 * is render-blocking and calls document.write() to inject the iframe, so the
 * iframe cannot start loading until the script has fully downloaded and run --
 * the two requests run back to back instead of in parallel.
 *
 * Pointing an iframe straight at the form puts the URL in the initial HTML, so
 * the browser starts fetching it while it is still parsing the page, and
 * nothing blocks rendering.
 *
 * @param string $form_id    JotForm form id.
 * @param int    $min_height Height to reserve while the form loads, in px.
 */
function freemantech_jotform( $form_id, $min_height = 700 ) {
	$form_id = preg_replace( '/[^0-9]/', '', (string) $form_id );

	if ( '' === $form_id ) {
		return;
	}

	freemantech_note_jotform( true );
	?>
	<div class="ft-jotform" style="min-height:<?php echo (int) $min_height; ?>px">
		<iframe
			id="JotFormIFrame-<?php echo esc_attr( $form_id ); ?>"
			title="<?php esc_attr_e( 'Enquiry form', 'freemantech' ); ?>"
			src="<?php echo esc_url( 'https://form.jotform.com/' . $form_id ); ?>"
			allow="geolocation; microphone; camera; fullscreen; payment"
			allowtransparency="true"
			scrolling="no"
			frameborder="0"
			style="height:<?php echo (int) $min_height; ?>px"></iframe>
	</div>
	<?php
}

/**
 * Track whether a JotForm was rendered on this request.
 *
 * @param bool|null $set Pass true to record one.
 * @return bool
 */
function freemantech_note_jotform( $set = null ) {
	static $present = false;

	if ( true === $set ) {
		$present = true;
	}

	return $present;
}

/**
 * Warm up the JotForm connections.
 *
 * DNS and TLS to a third-party host is most of the wait before the form's own
 * bytes start arriving; doing it in the head overlaps that with page render.
 *
 * @param array  $urls          Resource URLs.
 * @param string $relation_type Relation type.
 * @return array
 */
function freemantech_jotform_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array( 'href' => 'https://form.jotform.com' );
		$urls[] = array( 'href' => 'https://cdn.jotfor.ms' );
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'freemantech_jotform_hints', 10, 2 );

/**
 * Load JotForm's resize handler, but only where a form was actually rendered.
 *
 * Deferred: it only adjusts the iframe height once the form reports its size,
 * so it has no reason to hold up rendering.
 */
function freemantech_jotform_resizer() {
	if ( ! freemantech_note_jotform() ) {
		return;
	}
	?>
	<script src="https://cdn.jotfor.ms/s/umd/latest/for-form-embed-handler.js" defer></script>
	<script>
		( function () {
			function init() {
				if ( ! window.jotformEmbedHandler ) {
					window.setTimeout( init, 50 );
					return;
				}

				Array.prototype.forEach.call(
					document.querySelectorAll( '.ft-jotform iframe[id^="JotFormIFrame-"]' ),
					function ( frame ) {
						window.jotformEmbedHandler( "iframe[id='" + frame.id + "']", 'https://form.jotform.com/' );
					}
				);
			}

			init();
		} )();
	</script>
	<?php
}
add_action( 'wp_footer', 'freemantech_jotform_resizer', 20 );

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
function freemantech_has_excerpt() {
	return '' !== trim( (string) get_post_field( 'post_excerpt', get_the_ID() ) );
}

/**
 * Output the excerpt. See freemantech_has_excerpt() for why callers should
 * skip the wrapper element entirely when there is nothing to show: Elementor
 * dropped widgets whose dynamic tag came back empty, so an empty wrapper adds
 * flex gaps the original never had.
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
