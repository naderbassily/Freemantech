<?php
/**
 * Mobile navigation overlay.
 *
 * Replaces the former Elementor popup template "Mobile Nav" (post 1335):
 * full-viewport panel on the Freeman Blue ground, sliding in from the right.
 *
 * @package freemantech
 */

?>
<div id="mobile-nav" class="mobile-nav" hidden>
	<div class="mobile-nav__backdrop" data-mobile-nav-close></div>

	<div class="mobile-nav__panel" role="dialog" aria-modal="true"
		aria-label="<?php esc_attr_e( 'Site menu', 'freemantech' ); ?>">

		<button type="button" class="mobile-nav__close" data-mobile-nav-close
			aria-label="<?php esc_attr_e( 'Close menu', 'freemantech' ); ?>">
			<span aria-hidden="true">&times;</span>
		</button>

		<?php
		$freemantech_mark = freemantech_asset_url( '2026/02/favi-white.svg' );
		if ( $freemantech_mark ) :
			?>
			<a class="mobile-nav__mark" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<img src="<?php echo esc_url( $freemantech_mark ); ?>" alt="" width="60" height="60">
			</a>
		<?php endif; ?>

		<nav class="mobile-nav__menu" aria-label="<?php esc_attr_e( 'Mobile menu', 'freemantech' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_class'     => 'mobile-nav__list',
					'container'      => false,
					'depth'          => 2,
					'fallback_cb'    => false,
				)
			);
			?>
		</nav>

		<div class="mobile-nav__search">
			<?php get_search_form(); ?>
		</div>

	</div>
</div>
