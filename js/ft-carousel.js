/**
 * Post carousels.
 *
 * Replaces Elementor's loop-carousel widget. Any element carrying
 * [data-ft-carousel] is initialised with Swiper using the same breakpoints the
 * Elementor widget used (1 / 2 / 3 slides, 30px between slides).
 */
( function () {
	'use strict';

	function init() {
		if ( typeof window.Swiper === 'undefined' ) {
			return;
		}

		Array.prototype.forEach.call(
			document.querySelectorAll( '[data-ft-carousel]' ),
			function ( el ) {
				var perView = parseInt( el.getAttribute( 'data-slides' ), 10 ) || 3;

				new window.Swiper( el, {
					slidesPerView: 1,
					spaceBetween: 30,
					watchOverflow: true,
					navigation: {
						prevEl: el.querySelector( '.ft-carousel__prev' ),
						nextEl: el.querySelector( '.ft-carousel__next' )
					},
					pagination: {
						el: el.querySelector( '.ft-carousel__pagination' ),
						clickable: true
					},
					breakpoints: {
						768: { slidesPerView: Math.min( 2, perView ) },
						1025: { slidesPerView: perView }
					}
				} );
			}
		);
	}

	if ( document.readyState === 'loading' ) {
		document.addEventListener( 'DOMContentLoaded', init );
	} else {
		init();
	}
} )();
