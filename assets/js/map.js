/**
 * Unhurried maps: the drawn map (.unhurried-map) and a Google map in the
 * theme's frame (.unhurried-map-frame, from inc/map.php).
 *
 * A pin drops in once its map is 40% in view (.is-in; assets/css/map.css):
 * the drawn map's, and the theme's pin over a live map that shows one place
 * at its center (.has-pin).
 *
 * Until the visitor reaches for a live map, it ignores the pointer, so the
 * page scrolls over it and the map cannot move away from under the pin. A
 * click on the map or on "Pan and zoom", or keyboard focus moving into the
 * map, hands it over: the pin fades and the map answers as Google made it,
 * its own pin on the place. Keyboard focus inside a map draws the theme's
 * ring around the frame. Without this script a live map is Google's own and
 * the drawn map's pin simply stands.
 *
 * Plain JavaScript, no dependencies.
 *
 * @package Unhurried
 * @since 1.2.1
 */
( function () {
	'use strict';

	var frames = document.querySelectorAll( '.unhurried-map-frame' );
	var drawn = document.querySelectorAll( '.unhurried-map' );
	if ( ! frames.length && ! drawn.length ) {
		return;
	}

	// Whether the visitor is using the keyboard (the last thing they did was press a key).
	var keyboard = false;
	document.addEventListener( 'keydown', function () {
		keyboard = true;
	}, true );
	document.addEventListener( 'pointerdown', function () {
		keyboard = false;
	}, true );

	// A live map's frame gets its address (data-src, from inc/map.php) only
	// once it is within about a screen of the window: until then the page
	// contacts no one for it.
	function load( map ) {
		if ( map && map.hasAttribute( 'data-src' ) ) {
			map.src = map.getAttribute( 'data-src' );
			map.removeAttribute( 'data-src' );
		}
	}
	var near = 'IntersectionObserver' in window ? new window.IntersectionObserver( function ( entries ) {
		entries.forEach( function ( entry ) {
			if ( entry.isIntersecting ) {
				near.unobserve( entry.target );
				load( entry.target );
			}
		} );
	}, { rootMargin: '100% 0px' } ) : null;
	frames.forEach( function ( frame ) {
		var map = frame.querySelector( 'iframe[data-src]' );
		if ( map && near ) {
			near.observe( map );
		} else {
			load( map );
		}
	} );

	function live( frame, focus ) {
		var button = frame.querySelector( '.unhurried-map-frame__use' );
		var map = frame.querySelector( 'iframe' );
		load( map );
		frame.classList.add( 'is-live' );
		if ( button ) {
			button.hidden = true;
		}
		if ( focus && map ) {
			map.focus();
		}
	}

	var seen = 'IntersectionObserver' in window ? new window.IntersectionObserver( function ( entries ) {
		entries.forEach( function ( entry ) {
			if ( entry.isIntersecting ) {
				entry.target.classList.add( 'is-in' );
				seen.unobserve( entry.target );
			}
		} );
	}, { threshold: 0.4 } ) : null;

	drawn.forEach( function ( map ) {
		if ( seen ) {
			seen.observe( map );
		} else {
			map.classList.add( 'is-in' );
		}
	} );

	frames.forEach( function ( frame ) {
		var button = frame.querySelector( '.unhurried-map-frame__use' );
		// A pointer on its way into a map is not the keyboard.
		frame.addEventListener( 'pointerenter', function () {
			keyboard = false;
		} );
		if ( ! frame.classList.contains( 'has-pin' ) || ! button || ! frame.querySelector( 'iframe' ) ) {
			return;
		}
		frame.classList.add( 'is-ready' );
		button.hidden = false;
		button.addEventListener( 'click', function () {
			live( frame, true );
		} );
		frame.addEventListener( 'click', function ( event ) {
			if ( event.target !== button && ! frame.classList.contains( 'is-live' ) ) {
				live( frame, false );
			}
		} );
		if ( seen ) {
			seen.observe( frame );
		} else {
			frame.classList.add( 'is-in' );
		}
	} );

	// Focus moving into a map's frame takes it away from this window.
	window.addEventListener( 'blur', function () {
		window.setTimeout( function () {
			var active = document.activeElement;
			var frame = active && 'IFRAME' === active.tagName ? active.closest( '.unhurried-map-frame' ) : null;
			if ( ! frame ) {
				return;
			}
			if ( frame.classList.contains( 'is-ready' ) ) {
				live( frame, false );
			}
			frame.classList.toggle( 'is-focused', keyboard );
		}, 0 );
	} );
	window.addEventListener( 'focus', function () {
		frames.forEach( function ( frame ) {
			frame.classList.remove( 'is-focused' );
		} );
	} );
}() );
