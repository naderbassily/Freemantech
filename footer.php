<?php
/**
 * The template for displaying the footer.
 *
 * Replaces the former Elementor "Global Footer" template (post 270).
 *
 * @package freemantech
 */

$freemantech_footer_logo = freemantech_asset_url( '2026/01/ft-light-logo.svg' );
?>

	<footer id="colophon" class="site-footer">

		<div class="site-footer__main">

			<div class="site-footer__col site-footer__col--brand">
				<?php if ( $freemantech_footer_logo ) : ?>
					<a class="site-footer__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<img src="<?php echo esc_url( $freemantech_footer_logo ); ?>"
							alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" width="250" height="60">
					</a>
				<?php endif; ?>

				<ul class="site-footer__social">
					<li>
						<a href="https://www.youtube.com/user/FREEMANTECHNOLOGYTV" target="_blank" rel="noopener noreferrer">
							<span class="ft-screen-reader-text">YouTube</span>
							<svg viewBox="0 0 576 512" width="14" height="14" aria-hidden="true" focusable="false"><path d="M549.7 124.1c-6.3-23.7-24.8-42.3-48.3-48.6C458.8 64 288 64 288 64S117.2 64 74.6 75.5c-23.5 6.3-42 24.9-48.3 48.6-11.4 42.9-11.4 132.3-11.4 132.3s0 89.4 11.4 132.3c6.3 23.7 24.8 41.5 48.3 47.8C117.2 448 288 448 288 448s170.8 0 213.4-11.5c23.5-6.3 42-24.1 48.3-47.8 11.4-42.9 11.4-132.3 11.4-132.3s0-89.4-11.4-132.3zm-317.5 213.5V175.2l142.7 81.2-142.7 81.2z"/></svg>
						</a>
					</li>
					<li>
						<a href="https://www.linkedin.com/company/freeman-technology/" target="_blank" rel="noopener noreferrer">
							<span class="ft-screen-reader-text">LinkedIn</span>
							<svg viewBox="0 0 448 512" width="14" height="14" aria-hidden="true" focusable="false"><path d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z"/></svg>
						</a>
					</li>
				</ul>
			</div>

			<?php
			freemantech_footer_menu_column( 'footer-popular', __( 'Popular links', 'freemantech' ) );
			freemantech_footer_menu_column( 'footer-ft4', __( 'FT4 Powder Rheometer®', 'freemantech' ) );
			freemantech_footer_menu_column( 'footer-legal', __( 'Legal information', 'freemantech' ) );
			?>

		</div><!-- .site-footer__main -->

		<div class="site-footer__legal">
			<p>
				<?php
				printf(
					/* translators: %s: current year. */
					esc_html__( 'Copyright © 2014 – %s | Freeman Technology and Powder Rheometer are registered trademarks of Freeman Technology Ltd', 'freemantech' ),
					esc_html( gmdate( 'Y' ) )
				);
				?>
			</p>
		</div>

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
