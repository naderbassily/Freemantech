/**
 * Mobile navigation overlay.
 *
 * Replaces the Elementor popup that used to be triggered by the header
 * hamburger. Opens on toggle, closes on backdrop click, close button or Escape,
 * and keeps focus inside the panel while open.
 */
( function () {
	'use strict';

	var nav = document.getElementById( 'mobile-nav' );
	var toggle = document.querySelector( '.site-header__toggle' );

	if ( ! nav || ! toggle ) {
		return;
	}

	var panel = nav.querySelector( '.mobile-nav__panel' );
	var lastFocused = null;

	function focusable() {
		return Array.prototype.filter.call(
			panel.querySelectorAll( 'a[href], button, input, select, textarea' ),
			function ( el ) {
				return ! el.disabled && el.offsetParent !== null;
			}
		);
	}

	function open() {
		lastFocused = document.activeElement;
		nav.hidden = false;
		document.body.classList.add( 'ft-nav-open' );
		toggle.setAttribute( 'aria-expanded', 'true' );

		var items = focusable();
		if ( items.length ) {
			items[ 0 ].focus();
		}
	}

	function close() {
		nav.hidden = true;
		document.body.classList.remove( 'ft-nav-open' );
		toggle.setAttribute( 'aria-expanded', 'false' );

		if ( lastFocused ) {
			lastFocused.focus();
		}
	}

	toggle.addEventListener( 'click', function () {
		if ( nav.hidden ) {
			open();
		} else {
			close();
		}
	} );

	Array.prototype.forEach.call(
		nav.querySelectorAll( '[data-mobile-nav-close]' ),
		function ( el ) {
			el.addEventListener( 'click', close );
		}
	);

	document.addEventListener( 'keydown', function ( event ) {
		if ( nav.hidden ) {
			return;
		}

		if ( event.key === 'Escape' ) {
			close();
			return;
		}

		if ( event.key !== 'Tab' ) {
			return;
		}

		// Trap focus inside the panel.
		var items = focusable();
		if ( ! items.length ) {
			return;
		}

		var first = items[ 0 ];
		var last = items[ items.length - 1 ];

		if ( event.shiftKey && document.activeElement === first ) {
			event.preventDefault();
			last.focus();
		} else if ( ! event.shiftKey && document.activeElement === last ) {
			event.preventDefault();
			first.focus();
		}
	} );
} )();
