/**
 * Marks the in-page product nav once it sticks, so the logo can fade in.
 * Replaces Elementor's elementor-sticky--active class.
 */
( function () {
	'use strict';

	var nav = document.querySelector( '.inner-nav' );

	if ( ! nav || typeof window.IntersectionObserver === 'undefined' ) {
		return;
	}

	// Sentinel just above the nav: when it scrolls out of view, the nav is stuck.
	var sentinel = document.createElement( 'div' );
	sentinel.setAttribute( 'aria-hidden', 'true' );
	nav.parentNode.insertBefore( sentinel, nav );

	new window.IntersectionObserver(
		function ( entries ) {
			nav.classList.toggle( 'is-stuck', ! entries[ 0 ].isIntersecting );
		},
		{ threshold: [ 0 ] }
	).observe( sentinel );
} )();
