<?php
/**
 * The header for our theme.
 *
 * Replaces the former Elementor "Global Header" template (post 12) and the
 * "Mobile Nav" popup (post 1335).
 *
 * @package freemantech
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link ft-screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'freemantech' ); ?></a>

	<header id="masthead" class="site-header">

		<div class="site-header__bar" aria-hidden="true"></div>

		<div class="site-header__main">

			<div class="site-header__branding">
				<?php freemantech_site_logo(); ?>
			</div>

			<div class="site-header__actions">

				<nav class="site-nav ft-hide-tablet ft-hide-mobile" aria-label="<?php esc_attr_e( 'Main menu', 'freemantech' ); ?>">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'menu_class'     => 'site-nav__list',
							'container'      => false,
							'depth'          => 2,
							'fallback_cb'    => false,
						)
					);
					?>
				</nav>

				<div class="site-search ft-hide-tablet ft-hide-mobile">
					<?php get_search_form(); ?>
				</div>

				<button type="button"
					class="site-header__toggle ft-hide-desktop"
					aria-controls="mobile-nav"
					aria-expanded="false"
					aria-label="<?php esc_attr_e( 'Open menu', 'freemantech' ); ?>">
					<span class="site-header__toggle-bars" aria-hidden="true"></span>
				</button>

			</div>

		</div><!-- .site-header__main -->
	</header><!-- #masthead -->

	<?php get_template_part( 'template-parts/mobile-nav' ); ?>
