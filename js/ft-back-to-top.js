/**
 * Back-to-top button. Replaces the Elementor custom-code snippet (591).
 */
( function () {
	'use strict';

	var btn = document.getElementById( 'back-to-top' );

	if ( ! btn ) {
		return;
	}

	function sync() {
		btn.classList.toggle( 'is-visible', window.scrollY > 300 );
	}

	window.addEventListener( 'scroll', sync, { passive: true } );
	sync();

	btn.addEventListener( 'click', function () {
		window.scrollTo( { top: 0, behavior: 'smooth' } );
	} );
} )();
