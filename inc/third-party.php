<?php
/**
 * Third-party embeds that used to live in Elementor custom-code snippets.
 *
 * @package freemantech
 */

defined( 'ABSPATH' ) || exit;

/**
 * Optimole image CDN loader.
 *
 * Carried over verbatim from the Elementor custom-code snippet "Optimole" (44),
 * which ran in the head on every page. Return false from the
 * `freemantech_enable_optimole` filter to switch it off.
 */
function freemantech_optimole_script() {
	if ( ! apply_filters( 'freemantech_enable_optimole', true ) ) {
		return;
	}
	?>
	<script type="text/javascript">
		( function ( w, d ) {
			var b = d.getElementsByTagName( 'head' )[0];
			var s = d.createElement( 'script' );
			var v = ( 'IntersectionObserver' in w ) ? '_no_poly' : '';
			s.async = true;
			s.src = 'https://d5jmkjjpb7yfg.cloudfront.net/v2/latest/optimole_lib' + v + '.min.js';
			w.optimoleData = {
				key: 'mlsii5crw2sd',
				quality: '85'
			};
			b.appendChild( s );
		}( window, document ) );
	</script>
	<?php
}
add_action( 'wp_head', 'freemantech_optimole_script', 1 );
