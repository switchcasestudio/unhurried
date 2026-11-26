/**
 * Unhurried hero film (patterns/hero-film.php, inc/hero-film.php).
 *
 * The frame shows its picture until the film can play. The film starts
 * only when motion is allowed (no reduced motion), the visitor has not asked
 * for less data, the page has finished loading (so the film never competes
 * with the page itself), and the frame is in view; it pauses when the frame
 * leaves the view and goes on when it returns. It is always muted and plays
 * inline on phones. The button beside the caption pauses and plays it, and
 * the choice is kept for this visitor (localStorage, when the browser
 * allows it), so a paused film stays paused, here and on the next visit.
 *
 * Plain JavaScript, no dependencies.
 *
 * @package Unhurried
 * @since 1.2.1
 */
( function () {
	'use strict';

	var KEY = 'unhurried-film-paused';
	var toggles = document.querySelectorAll( '.unhurried-hero-film__toggle[aria-controls]' );
	if ( ! toggles.length ) {
		return;
	}
	var reduce = window.matchMedia( '(prefers-reduced-motion: reduce)' );
	var lessData = window.matchMedia( '(prefers-reduced-data: reduce)' );

	function saveData() {
		var c = navigator.connection;
		return !! ( c && c.saveData ) || lessData.matches;
	}
	function remembered() {
		try {
			return '1' === window.localStorage.getItem( KEY );
		} catch ( e ) {
			return false;
		}
	}
	function remember( paused ) {
		try {
			if ( paused ) {
				window.localStorage.setItem( KEY, '1' );
			} else {
				window.localStorage.removeItem( KEY );
			}
		} catch ( e ) {
			// Storage refused (private window, blocked site data): the choice lasts for this page.
		}
	}

	function setUp( button ) {
		var video = document.getElementById( button.getAttribute( 'aria-controls' ) );
		var frame = video && video.closest( '.unhurried-hero-film__frame' );
		if ( ! frame || 'function' !== typeof video.play || ! ( 'IntersectionObserver' in window ) ) {
			return;
		}
		var label = button.querySelector( '.unhurried-visually-hidden' );
		var state = { inView: false, ready: false, userPaused: remembered(), broken: false };

		function allowed() {
			return state.ready && ! state.broken && ! reduce.matches && ! saveData();
		}
		function show( paused ) {
			var text = button.getAttribute( paused ? 'data-label-play' : 'data-label-pause' );
			button.classList.toggle( 'is-paused', paused );
			if ( label && text ) {
				label.textContent = text;
			}
		}
		function stop() {
			if ( ! video.paused ) {
				video.pause();
			}
		}
		function go() {
			video.muted = true;
			var started = video.play();
			if ( started && 'function' === typeof started.catch ) {
				started.catch( function () {
					// The browser refused to start it (low power mode, say): the
					// picture stays, and the button offers to play it.
					show( true );
				} );
			}
		}
		function update() {
			if ( ! allowed() ) {
				stop();
				frame.classList.remove( 'is-playing' );
				button.hidden = true;
				return;
			}
			button.hidden = false;
			show( state.userPaused );
			if ( state.inView && ! state.userPaused ) {
				go();
			} else {
				stop();
			}
		}

		video.muted = true;
		video.setAttribute( 'muted', '' );
		video.setAttribute( 'playsinline', '' );
		video.addEventListener( 'playing', function () {
			frame.classList.add( 'is-playing' );
			show( false );
		} );
		video.addEventListener( 'pause', function () {
			show( true );
		} );
		video.addEventListener( 'error', function () {
			state.broken = true;
			update();
		} );
		button.addEventListener( 'click', function () {
			if ( video.paused ) {
				state.userPaused = false;
				remember( false );
				go();
			} else {
				state.userPaused = true;
				remember( true );
				stop();
			}
			show( state.userPaused );
		} );
		new window.IntersectionObserver( function ( entries ) {
			state.inView = entries[ entries.length - 1 ].isIntersecting;
			update();
		}, { threshold: 0.25 } ).observe( frame );
		[ reduce, lessData ].forEach( function ( query ) {
			if ( query.addEventListener ) {
				query.addEventListener( 'change', update );
			}
		} );

		// Not before the page itself has loaded, then when the browser is idle.
		function start() {
			var idle = window.requestIdleCallback || function ( fn ) {
				return window.setTimeout( fn, 1 );
			};
			idle( function () {
				state.ready = true;
				update();
			}, { timeout: 1500 } );
		}
		if ( 'complete' === document.readyState ) {
			start();
		} else {
			window.addEventListener( 'load', start, { once: true } );
		}
	}

	toggles.forEach( setUp );
}() );
