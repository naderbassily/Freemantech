/**
 * Tabbed panels. Replaces Elementor's nested-tabs widget.
 */
( function () {
	'use strict';

	Array.prototype.forEach.call(
		document.querySelectorAll( '[data-ft-tabs]' ),
		function ( root ) {
			var tabs = Array.prototype.slice.call( root.querySelectorAll( '.ft-tabs__tab' ) );

			function select( index ) {
				tabs.forEach( function ( tab, i ) {
					var panel = document.getElementById( tab.getAttribute( 'aria-controls' ) );
					var active = i === index;

					tab.classList.toggle( 'is-active', active );
					tab.setAttribute( 'aria-selected', active ? 'true' : 'false' );

					if ( panel ) {
						panel.hidden = ! active;
					}
				} );
			}

			tabs.forEach( function ( tab, i ) {
				tab.addEventListener( 'click', function () {
					select( i );
				} );

				tab.addEventListener( 'keydown', function ( event ) {
					if ( event.key !== 'ArrowRight' && event.key !== 'ArrowLeft' ) {
						return;
					}

					event.preventDefault();
					var next = event.key === 'ArrowRight' ? i + 1 : i - 1;
					next = ( next + tabs.length ) % tabs.length;

					select( next );
					tabs[ next ].focus();
				} );
			} );
		}
	);
} )();
