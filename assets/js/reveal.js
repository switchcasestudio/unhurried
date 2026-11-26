/**
 * Unhurried motion: sections enter as they scroll into view.
 *
 * The first screen rises by CSS alone (style.css, "1. Entrances"; the class
 * "uh-motion" comes from unhurried_motion_head()). This script marks what is
 * below the window so it enters later; the rest of the motion is in
 * assets/js/reveal-late.js. Without either, or with reduced motion, all is
 * simply visible. "unhurried-still" opts a block out.
 *
 * @package Unhurried
 */
( function () {
	'use strict';

	var html = document.documentElement;
	var config = window.unhurriedScroll || {};
	var hooks = window.unhurriedMotion = window.unhurriedMotion || {};

	// fn runs in a later task, when the page is idle.
	function later( fn, timeout ) {
		if ( 'requestIdleCallback' in window ) {
			window.requestIdleCallback( fn, { timeout: timeout || 100 } );
		} else {
			window.setTimeout( fn, 1 );
		}
	}

	// The rest (reveal-late.js) comes once the page has loaded and is idle.
	function loadLate() {
		later( function () {
			var src = config.late;
			if ( ! src ) {
				return;
			}
			var script = document.createElement( 'script' );
			script.src = src;
			script.async = true;
			document.head.appendChild( script );
		}, 600 );
	}
	if ( 'complete' === document.readyState ) {
		loadLate();
	} else {
		window.addEventListener( 'load', loadLate );
	}

	if ( ! ( 'IntersectionObserver' in window ) || window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches ) {
		html.classList.remove( 'uh-motion' );
		return;
	}

	// Timing comes from the motion tokens (style.css, scroll.css).
	var rootStyle = window.getComputedStyle( html );
	function token( name, fallback ) {
		var value = parseFloat( rootStyle.getPropertyValue( name ) );
		return isFinite( value ) ? value : fallback;
	}
	var STAGGER = token( '--uh-stagger', 40 );
	var MAX_DELAY = token( '--uh-stagger-cap', 160 );
	var ENTER = token( '--uh-dur-slow', 420 );
	var LONGEST = Math.max( token( '--uh-dur-large', 760 ), token( '--uh-dur-draw', 900 ), token( '--uh-dur-text', 420 ) + 3 * token( '--uh-line-stagger', 90 ) );
	var auto = html.classList.contains( 'uh-motion' );

	/* ── Legacy opt-in reveal ─────────────────────────────────────────── */
	var legacy = document.querySelectorAll( '.unhurried-reveal, .is-style-reveal' );
	if ( auto ) {
		legacy.forEach( function ( el ) {
			el.classList.add( 'is-revealed' );
		} );
	} else if ( legacy.length ) {
		var legacyObserver = new IntersectionObserver(
			function ( entries ) {
				entries.forEach( function ( entry ) {
					if ( entry.isIntersecting ) {
						entry.target.classList.add( 'is-revealed' );
						legacyObserver.unobserve( entry.target );
					}
				} );
			},
			{ rootMargin: '0px 0px -8% 0px' }
		);
		legacy.forEach( function ( el ) {
			if ( el.getBoundingClientRect().top < window.innerHeight ) {
				el.classList.add( 'is-revealed' );
			} else {
				legacyObserver.observe( el );
			}
		} );
		html.classList.add( 'has-unhurried-reveal' );
	}
	if ( ! auto ) {
		return;
	}

	// What a reader scrolls past before load is never hidden again.
	var early = false;
	function markEarly() {
		early = false;
		document.querySelectorAll( 'main :is(h1, h2, h3, h4, h5, h6, p, li, figure, form, .wp-block-buttons, .wp-block-post, .wc-block-product, .wp-block-columns, .wp-block-cover)' ).forEach( function ( el ) {
			var r = el.getBoundingClientRect();
			if ( r.top < window.innerHeight && r.bottom > 0 ) {
				el.setAttribute( 'data-uh-early', '' );
			}
		} );
	}
	function onEarlyScroll() {
		if ( ! early ) {
			early = true;
			window.requestAnimationFrame( markEarly );
		}
	}
	if ( 'complete' !== document.readyState ) {
		window.addEventListener( 'scroll', onEarlyScroll, { passive: true } );
		window.addEventListener( 'load', function () {
			window.removeEventListener( 'scroll', onEarlyScroll );
		} );
	}

	// Set up once the page has loaded.
	function startReveal() {
		// First match wins; inside a marked element all stays still.
		var KINDS = [
			[ 'words', '.unhurried-wordmark' ],
			[ 'image', 'figure.wp-block-image, .wp-block-post-featured-image, .wp-block-gallery > figure, .wp-block-cover' ],
			[ 'card', '.wp-block-post, .wc-block-product, .wc-block-grid__product, .is-style-card, .is-style-section-card, .is-style-panel, .unhurried-giftcard, .unhurried-map, .wp-block-term, .wp-block-details, .wp-block-pullquote, .unhurried-author-box' ],
			[ 'side', '.wp-block-columns > .wp-block-column' ],
			[ 'draw', 'hr.wp-block-separator' ],
			[ 'count', '.unhurried-stat' ],
			[ 'tick', '.unhurried-numeral' ],
			[ 'line', 'h1, h2, h3' ],
			[ 'rise', 'h1, h2, h3, h4, h5, h6, p, .wp-block-buttons, .wp-block-search, .wp-block-social-links, .wp-block-quote, li, .wp-block-table, form, .wp-block-post-terms, .wp-block-post-date, .wp-block-post-time-to-read, .wp-block-post-author-name, .wp-block-query-total, .wp-block-breadcrumbs, .wp-block-query-pagination, .wp-block-post-navigation-link, .wp-block-comments, .wp-block-term-description' ]
		];
		// Never moved: chrome, things with motion of their own, an article's body.
		var SKIP = [
			'header',
			'.unhurried-header',
			'.wp-block-navigation',
			'.unhurried-marquee',
			'.unhurried-still',
			'.unhurried-hero-spiral__disc',
			'.wp-block-button',
			'.screen-reader-text',
			'.unhurried-visually-hidden',
			'#wpadminbar',
			'.single .wp-block-post-content > p',
			'.single .wp-block-post-content > ul > li',
			'.single .wp-block-post-content > ol > li'
		].join( ',' );
		// A product's buy area holds still.
		var BUY = '.wp-block-columns:has(form.cart, .wp-block-add-to-cart-form, .wp-block-woocommerce-add-to-cart-form, .wp-block-add-to-cart-with-options)';
		var buyAreas = [];
		try {
			buyAreas = Array.prototype.slice.call( document.querySelectorAll( BUY ) );
		} catch ( e ) {
			buyAreas = [];
		}

		var hasEarly = !! document.querySelector( '[data-uh-early]' );
		var rtl = 'rtl' === window.getComputedStyle( document.body ).direction;
		var selector = KINDS.map( function ( k ) {
			return k[ 1 ];
		} ).join( ',' );
		var candidates = [];
		document.querySelectorAll( '.wp-site-blocks > main, .wp-site-blocks > footer, main.wp-block-group' ).forEach( function ( scope ) {
			scope.querySelectorAll( selector ).forEach( function ( el ) {
				if ( el.closest( SKIP ) || ( hasEarly && ( el.closest( '[data-uh-early]' ) || el.querySelector( '[data-uh-early]' ) ) ) ) {
					return;
				}
				for ( var b = 0; b < buyAreas.length; b++ ) {
					if ( buyAreas[ b ].contains( el ) ) {
						return;
					}
				}
				candidates.push( el );
			} );
		} );
		// Arriving at #anchor: all above it and its own screen show at once.
		var hashTarget = null;
		try {
			hashTarget = window.location.hash ? document.getElementById( decodeURIComponent( window.location.hash.slice( 1 ) ) ) : null;
		} catch ( e ) {
			hashTarget = null;
		}
		var shownTo = hashTarget ? hashTarget.getBoundingClientRect().top + window.pageYOffset + window.innerHeight : 0;

		function finish( el, delay ) {
			var long = Math.max( ENTER, LONGEST ) + ( el.getAttribute( 'data-uh' ) === 'words' ? MAX_DELAY : 0 ) + 50;
			window.setTimeout( function () {
				el.classList.add( 'is-done' );
				el.style.removeProperty( '--uh-delay' );
			}, delay + long );
		}

		var observer;
		var tallObserver;

		function enter( el, step ) {
			observer.unobserve( el );
			tallObserver.unobserve( el );
			// A heading not yet in lines: wrapped now, or it rises whole.
			if ( 'line' === el.getAttribute( 'data-uh' ) && ! el.classList.contains( 'uh-split' ) ) {
				if ( hooks.split ) {
					hooks.split( el );
					window.requestAnimationFrame( function () {
						go( el, step );
					} );
					return;
				}
				el.setAttribute( 'data-uh', 'rise' );
			}
			go( el, step );
		}
		function go( el, step ) {
			var delay = Math.min( step * STAGGER, MAX_DELAY );
			el.style.setProperty( '--uh-delay', delay + 'ms' );
			el.classList.add( 'is-in' );
			if ( el.getAttribute( 'data-uh' ) === 'count' && hooks.count ) {
				window.setTimeout( function () {
					hooks.count( el );
				}, delay );
			}
			finish( el, delay );
			// What waits inside it follows a step later.
			el.querySelectorAll( '[data-uh]:not(.is-in)' ).forEach( function ( inner ) {
				enter( inner, step + 2 );
			} );
		}

		observer = new IntersectionObserver(
			function ( entries ) {
				var step = 0;
				entries.forEach( function ( entry ) {
					if ( entry.isIntersecting && ! entry.target.classList.contains( 'is-in' ) ) {
						enter( entry.target, step++ );
					}
				} );
			},
			{ rootMargin: '0px 0px 8% 0px', threshold: 0.15 }
		);
		// Taller than the window: enters once it fills 15% of the window.
		tallObserver = new IntersectionObserver(
			function ( entries ) {
				var step = 0;
				entries.forEach( function ( entry ) {
					if ( entry.isIntersecting && entry.boundingClientRect.height > window.innerHeight && ! entry.target.classList.contains( 'is-in' ) ) {
						enter( entry.target, step++ );
					}
				} );
			},
			{ rootMargin: '0px 0px -15% 0px', threshold: 0 }
		);

		// Planned in short slices (a slow phone never waits on it) that only
		// read; then marked in one go, so the page restyles once. What is on
		// screen at that moment shows, only what is below the window waits.
		var next = 0;
		var plan = [];
		var kindOf = new Map();
		function inside( el ) {
			for ( var n = el.parentElement; n && n !== document.body; n = n.parentElement ) {
				if ( kindOf.has( n ) ) {
					return kindOf.get( n );
				}
			}
			return '';
		}
		function slice() {
			var began = window.performance.now();
			var fold = window.innerHeight;
			var width = document.documentElement.clientWidth;
			while ( next < candidates.length && window.performance.now() - began < 8 ) {
				var el = candidates[ next++ ];
				var parent = inside( el );
				if ( parent && ! ( /^(side-|image)/.test( parent ) && el.matches( 'h1, h2, h3' ) ) ) {
					continue;
				}
				for ( var i = 0; i < KINDS.length; i++ ) {
					if ( ! el.matches( KINDS[ i ][ 1 ] ) ) {
						continue;
					}
					var kind = KINDS[ i ][ 0 ];
					var box = el.getBoundingClientRect();
					// On screen or passed: it entered with the page.
					if ( 'draw' !== kind && 'words' !== kind && ( box.top < fold || box.top + window.pageYOffset < shownTo ) ) {
						break;
					}
					if ( 'side' === kind ) {
						// Two columns arrive from their sides, with room to travel.
						var row = el.parentElement;
						if ( window.innerWidth < 782 || ! row || 2 !== row.children.length ) {
							continue;
						}
						var start = row.firstElementChild === el;
						if ( start !== rtl ? box.left < 64 : width - box.right < 64 ) {
							continue;
						}
						kind = start ? 'side-start' : 'side-end';
					}
					kindOf.set( el, kind );
					plan.push( el );
					break;
				}
			}
			if ( next < candidates.length ) {
				later( slice );
				return;
			}
			// Read once more (a reader may have scrolled meanwhile), then write.
			var tops = plan.map( function ( el ) {
				return el.getBoundingClientRect().top;
			} );
			plan.forEach( function ( el, n ) {
				var kind = kindOf.get( el );
				if ( 'draw' !== kind && 'words' !== kind && tops[ n ] < window.innerHeight ) {
					return;
				}
				el.setAttribute( 'data-uh', kind );
				if ( 'line' === kind && hooks.watch ) {
					hooks.watch( el );
				}
				observer.observe( el );
				tallObserver.observe( el );
			} );
			html.classList.add( 'uh-motion-live' );
		}
		later( slice );
	}
	if ( 'complete' === document.readyState ) {
		startReveal();
	} else {
		window.addEventListener( 'load', startReveal );
	}

} )();
