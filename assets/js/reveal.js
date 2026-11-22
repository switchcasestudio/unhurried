/**
 * Unhurried motion.
 *
 * Every section enters gently as it scrolls into view: headings and text
 * rise, images settle, cards and list items follow one another, dividers
 * draw, and figures count up. Items entering together are staggered
 * (capped, so nothing waits long) so the eye takes in one thing at a time.
 *
 * The <head> adds the class "uh-motion" before first paint (see
 * unhurried_motion_head() in functions.php); without it, or without this
 * script, or for visitors who prefer reduced motion, every element is
 * simply visible. A block, or a whole section, opts out with the class
 * "unhurried-still". Older content that uses "unhurried-reveal" or the
 * Reveal block style keeps working, with or without the automatic mode.
 *
 * @package Unhurried
 */
( function () {
	'use strict';

	var html = document.documentElement;
	if ( ! ( 'IntersectionObserver' in window ) || window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches ) {
		html.classList.remove( 'uh-motion' );
		return;
	}

	var STAGGER = 70; // ms, matches --wp--custom--motion--stagger.
	var MAX_STEPS = 8; // the ninth item in a batch waits no longer than the eighth.
	var auto = html.classList.contains( 'uh-motion' );

	/* ── Legacy opt-in reveal ─────────────────────────────────────────── */
	var legacy = document.querySelectorAll( '.unhurried-reveal, .is-style-reveal' );
	if ( auto ) {
		// The automatic mode animates their contents one by one instead.
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

	/* ── Automatic reveal ─────────────────────────────────────────────── */
	// First match wins; a marked element's descendants stay still, so a
	// card moves as one piece rather than as a pile of parts.
	var KINDS = [
		[ 'words', '.unhurried-wordmark' ],
		[ 'image', 'figure.wp-block-image, .wp-block-post-featured-image, .wp-block-gallery > figure' ],
		[ 'card', '.wp-block-post, .is-style-card, .is-style-section-card, .is-style-panel, .unhurried-giftcard, .unhurried-map, .wp-block-term, .wp-block-details, .wp-block-pullquote, .unhurried-author-box' ],
		[ 'draw', 'hr.wp-block-separator' ],
		[ 'count', '.unhurried-stat' ],
		[ 'rise', 'h1, h2, h3, h4, h5, h6, p, .wp-block-buttons, .wp-block-search, .wp-block-social-links, .wp-block-quote, li, .wp-block-table, form, .wp-block-post-terms, .wp-block-post-date, .wp-block-post-time-to-read, .wp-block-post-author-name, .wp-block-query-total, .wp-block-breadcrumbs, .wp-block-query-pagination, .wp-block-post-navigation-link, .wp-block-comments, .wp-block-term-description' ]
	];
	// Never moved: chrome that is already on screen, things with motion of
	// their own, and the body of an article (motion beside a paragraph
	// someone is reading pulls their eye away from it).
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

	var scopes = document.querySelectorAll( '.wp-site-blocks > main, .wp-site-blocks > footer, main.wp-block-group' );
	var selector = KINDS.map( function ( k ) {
		return k[ 1 ];
	} ).join( ',' );
	var targets = [];

	scopes.forEach( function ( scope ) {
		scope.querySelectorAll( selector ).forEach( function ( el ) {
			if ( el.hasAttribute( 'data-uh' ) || el.closest( SKIP ) ) {
				return;
			}
			var parent = el.parentElement && el.parentElement.closest( '[data-uh]' );
			if ( parent ) {
				return;
			}
			for ( var i = 0; i < KINDS.length; i++ ) {
				if ( el.matches( KINDS[ i ][ 1 ] ) ) {
					el.setAttribute( 'data-uh', KINDS[ i ][ 0 ] );
					targets.push( el );
					break;
				}
			}
		} );
	} );

	/* Figures count up from zero to their printed value, in the author's own
	   format ("1,200", "12,5", "1.200.000"), and end as exactly what the
	   author wrote. While they count, the real value stays in the page for
	   screen readers and the moving digits are hidden from them. */
	function countUp( el ) {
		var text = el.textContent.trim();
		var match = text.match( /^(\D*)(\d[\d,.]*)(.*)$/ );
		if ( ! match ) {
			return;
		}
		// A full stop or comma that ends the figure is punctuation, not part of it.
		var figure = match[ 2 ].replace( /[.,]+$/, '' );
		var after = match[ 2 ].slice( figure.length ) + match[ 3 ];
		// Which mark is the decimal one? With both, the last. With one kind,
		// used once and not followed by exactly three digits ("12,5", "0.75"),
		// that one; otherwise it groups thousands ("1,200", "1.200.000").
		var dot = figure.lastIndexOf( '.' );
		var comma = figure.lastIndexOf( ',' );
		var decimalMark = '';
		if ( dot > -1 && comma > -1 ) {
			decimalMark = dot > comma ? '.' : ',';
		} else if ( dot > -1 || comma > -1 ) {
			var mark = dot > -1 ? '.' : ',';
			var pieces = figure.split( mark );
			if ( 2 === pieces.length && ( 3 !== pieces[ 1 ].length || '0' === pieces[ 0 ] ) ) {
				decimalMark = mark;
			}
		}
		var groupMark = '';
		if ( '.' !== decimalMark && dot > -1 ) {
			groupMark = '.';
		} else if ( ',' !== decimalMark && comma > -1 ) {
			groupMark = ',';
		}
		var whole = decimalMark ? figure.slice( 0, figure.lastIndexOf( decimalMark ) ) : figure;
		var decimals = decimalMark ? figure.length - figure.lastIndexOf( decimalMark ) - 1 : 0;
		var digits = whole.replace( /\D/g, '' );
		var target = parseFloat( digits + ( decimals ? '.' + figure.slice( -decimals ) : '' ) );
		if ( ! isFinite( target ) ) {
			return;
		}
		// A year (four digits, nothing after) counts up from a nearby year.
		var from = ( /^\d{4}$/.test( match[ 2 ] ) && ! match[ 3 ] ) ? target - 24 : 0;
		// "007" keeps its width.
		var width = /^0\d/.test( digits ) ? digits.length : 0;
		function format( value ) {
			var parts = value.toFixed( decimals ).split( '.' );
			while ( parts[ 0 ].length < width ) {
				parts[ 0 ] = '0' + parts[ 0 ];
			}
			if ( groupMark ) {
				parts[ 0 ] = parts[ 0 ].replace( /\B(?=(\d{3})+(?!\d))/g, groupMark );
			}
			return parts[ 0 ] + ( decimals ? decimalMark + parts[ 1 ] : '' );
		}
		// Set the author's own nodes aside (the text, and any markup such as
		// an accent word) and put them back when the count is over.
		var written = document.createDocumentFragment();
		while ( el.firstChild ) {
			written.appendChild( el.firstChild );
		}
		var shown = document.createElement( 'span' );
		shown.setAttribute( 'aria-hidden', 'true' );
		var real = document.createElement( 'span' );
		real.className = 'unhurried-visually-hidden';
		real.textContent = text;
		el.appendChild( shown );
		el.appendChild( real );
		var start = null;
		var duration = 1400;
		function frame( now ) {
			if ( null === start ) {
				start = now;
			}
			var t = Math.min( 1, ( now - start ) / duration );
			var eased = 1 - Math.pow( 1 - t, 4 );
			var value = from + ( target - from ) * eased;
			if ( t < 1 ) {
				shown.textContent = match[ 1 ] + format( value ) + after;
				window.requestAnimationFrame( frame );
				return;
			}
			el.textContent = '';
			el.appendChild( written );
		}
		window.requestAnimationFrame( frame );
	}

	function finish( el, delay ) {
		var long = el.getAttribute( 'data-uh' ) === 'image' || el.getAttribute( 'data-uh' ) === 'words' ? 1500 : 950;
		window.setTimeout( function () {
			el.classList.add( 'is-done' );
			el.style.removeProperty( '--uh-delay' );
		}, delay + long );
	}

	var observer;
	var tallObserver;

	function enter( el, step ) {
		var delay = Math.min( step, MAX_STEPS ) * STAGGER;
		el.style.setProperty( '--uh-delay', delay + 'ms' );
		el.classList.add( 'is-in' );
		observer.unobserve( el );
		tallObserver.unobserve( el );
		if ( el.getAttribute( 'data-uh' ) === 'count' ) {
			window.setTimeout( function () {
				countUp( el );
			}, delay );
		}
		finish( el, delay );
	}

	// An element enters once 15% of it is in view.
	observer = new IntersectionObserver(
		function ( entries ) {
			var step = 0;
			entries.forEach( function ( entry ) {
				if ( entry.isIntersecting && ! entry.target.classList.contains( 'is-in' ) ) {
					enter( entry.target, step++ );
				}
			} );
		},
		{ rootMargin: '0px', threshold: 0.15 }
	);
	// Something taller than the window may never show 15% of itself (past
	// about 6.7 screens it cannot: a long form on a phone stayed hidden), so
	// it enters once it fills 15% of the window instead.
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
	// Switch from the pre-paint hold to the per-element states, and make the
	// browser compute them now, so items already on screen animate from
	// their hidden state rather than jumping straight to visible.
	html.classList.add( 'uh-motion-live' );
	void document.body.offsetWidth;
	targets.forEach( function ( el ) {
		observer.observe( el );
		tallObserver.observe( el );
	} );

	/* ── Gift card: tilts toward the pointer, like a card in the hand ── */
	if ( window.matchMedia( '(hover: hover) and (pointer: fine)' ).matches ) {
		document.querySelectorAll( '.unhurried-giftcard' ).forEach( function ( card ) {
			card.addEventListener( 'pointermove', function ( e ) {
				var r = card.getBoundingClientRect();
				var x = ( e.clientX - r.left ) / r.width - 0.5;
				var y = ( e.clientY - r.top ) / r.height - 0.5;
				card.style.setProperty( '--uh-tilt-x', ( y * -8 ).toFixed( 2 ) + 'deg' );
				card.style.setProperty( '--uh-tilt-y', ( x * 10 ).toFixed( 2 ) + 'deg' );
				card.style.setProperty( '--uh-glare-x', ( ( x + 0.5 ) * 100 ).toFixed( 1 ) + '%' );
				card.style.setProperty( '--uh-glare-y', ( ( y + 0.5 ) * 100 ).toFixed( 1 ) + '%' );
			} );
			card.addEventListener( 'pointerleave', function () {
				card.style.setProperty( '--uh-tilt-x', '0deg' );
				card.style.setProperty( '--uh-tilt-y', '0deg' );
			} );
		} );
	}

} )();
