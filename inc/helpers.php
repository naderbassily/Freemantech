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
