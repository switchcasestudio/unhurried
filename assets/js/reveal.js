/**
 * Unhurried motion.
 *
 * Every section enters gently as it scrolls into view: headings and text
 * rise, images settle, cards and list items follow one another, dividers
 * draw, and figures count up. Items entering together are staggered
 * (40ms apart, capped at 160ms, so nothing waits long) so the eye takes
 * in one thing at a time.
 *
 * The <head> adds the class "uh-motion" before first paint (see
 * unhurried_motion_head() in functions.php). With it, the first screen
 * rises by CSS alone as the page paints (style.css, "1. Entrances"), and
 * this script then holds back only what is still below the window, so it
 * can enter as it scrolls into view. Without the class, without this
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

	// The scroll choreography's stylesheet (assets/css/scroll.css) loads once
	// the page has: it styles only what is below the window or answers a
	// pointer, so it never competes with the first screen.
	var scrollCss = window.unhurriedScroll && window.unhurriedScroll.css;
	var scrollCssReady = [];
	var STATE_FADES = '.single_variation_wrap .woocommerce-variation-price, .single_variation_wrap .woocommerce-variation-availability, .wc-block-cart-items__row, .wp-block-details > :not(summary), .woocommerce-Tabs-panel';
	// State fades (scroll.css) play only on a change the reader made: an
	// accordion opened, a tab chosen, an option picked, a row put back. What
	// is on the page at load, and anything a script redraws on its own (the
	// cart block re-renders its rows), is marked seen and never fades.
	var actedAt = -1e5;
	function acted() {
		actedAt = Date.now();
	}
	document.addEventListener( 'pointerdown', acted, true );
	document.addEventListener( 'keydown', acted, true );
	document.addEventListener( 'change', acted, true );
	document.addEventListener( 'click', function ( event ) {
		var target = event.target.closest ? event.target : null;
		var summary = target && target.closest( '.wp-block-details > summary' );
		if ( summary && ! summary.parentNode.open ) {
			Array.prototype.forEach.call( summary.parentNode.children, function ( el ) {
				el.removeAttribute( 'data-uh-seen' );
			} );
		}
		if ( target && target.closest( '.woocommerce-tabs .tabs a' ) ) {
			document.querySelectorAll( '.woocommerce-Tabs-panel[data-uh-seen]' ).forEach( function ( el ) {
				el.removeAttribute( 'data-uh-seen' );
			} );
		}
	}, true );
	function markSeen( root ) {
		if ( root.matches && root.matches( STATE_FADES ) ) {
			root.setAttribute( 'data-uh-seen', '' );
		}
		if ( root.querySelectorAll ) {
			root.querySelectorAll( STATE_FADES ).forEach( function ( el ) {
				el.setAttribute( 'data-uh-seen', '' );
			} );
		}
	}
	// Only where such things can appear later (a cart, a variable product).
	if ( window.MutationObserver && document.querySelector( '.wc-block-cart, .wc-block-mini-cart, .variations_form' ) ) {
		new window.MutationObserver( function ( records ) {
			if ( Date.now() - actedAt < 1500 ) {
				return;
			}
			records.forEach( function ( record ) {
				Array.prototype.forEach.call( record.addedNodes, function ( node ) {
					if ( 1 === node.nodeType ) {
						markSeen( node );
					}
				} );
			} );
		} ).observe( document.body, { childList: true, subtree: true } );
	}
	function loadScrollCss() {
		if ( ! scrollCss || document.getElementById( 'unhurried-scroll-css' ) ) {
			return;
		}
		// What is already showing never fades in again when the stylesheet
		// arrives: its state animations are for changes after load only.
		markSeen( document );
		html.classList.add( 'uh-late' );
		// The accent rule is for the sections below the first screen.
		document.querySelectorAll( 'main .is-style-eyebrow' ).forEach( function ( el ) {
			if ( el.getBoundingClientRect().top + window.scrollY < window.innerHeight ) {
				el.setAttribute( 'data-uh-first', '' );
			}
		} );
		var link = document.createElement( 'link' );
		link.rel = 'stylesheet';
		link.id = 'unhurried-scroll-css';
		link.href = scrollCss;
		link.onload = function () {
			scrollCssReady.forEach( function ( fn ) {
				fn();
			} );
		};
		document.head.appendChild( link );
	}
	if ( 'complete' === document.readyState ) {
		loadScrollCss();
	} else {
		window.addEventListener( 'load', loadScrollCss );
	}

	if ( ! ( 'IntersectionObserver' in window ) || window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches ) {
		html.classList.remove( 'uh-motion' );
		return;
	}

	// Timing comes from the motion tokens in style.css (--uh-stagger,
	// --uh-stagger-cap, --uh-dur-slow), so a child theme that retunes them
	// retunes this too. The numbers after || are the tokens' own values.
	var rootStyle = window.getComputedStyle( html );
	function token( name, fallback ) {
		var value = parseFloat( rootStyle.getPropertyValue( name ) );
		return isFinite( value ) ? value : fallback;
	}
	var STAGGER = token( '--uh-stagger', 40 ); // ms between items entering together.
	var MAX_DELAY = token( '--uh-stagger-cap', 160 ); // the longest any item waits.
	var ENTER = token( '--uh-dur-slow', 420 ); // ms an entrance takes.
	// The larger moves (assets/css/scroll.css): text, photos, rules, counts.
	var LONGEST = Math.max( token( '--uh-dur-large', 760 ), token( '--uh-dur-draw', 900 ), token( '--uh-dur-text', 420 ) + 3 * token( '--uh-line-stagger', 90 ) );
	var COUNT = token( '--uh-dur-count', 1100 );
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
	/* ── Marquee: a pause button (1.2.1) ───────────────────────────────── */
	// The moving line runs for good, so it gets a control to stop it (WCAG
	// 2.2.2); the button is in the page from unhurried_marquee_loop() and
	// shows only here, where it works.
	document.querySelectorAll( '.unhurried-marquee__pause' ).forEach( function ( button ) {
		var line = button.closest( '.unhurried-marquee' );
		// Shown once its styles are in.
		scrollCssReady.push( function () {
			button.hidden = false;
		} );
		button.addEventListener( 'click', function () {
			var paused = 'true' !== button.getAttribute( 'aria-pressed' );
			button.setAttribute( 'aria-pressed', paused ? 'true' : 'false' );
			line.classList.toggle( 'is-paused', paused );
		} );
	} );

	/* ── Escape closes a dropdown from anywhere (WCAG 1.4.13) ──────────── */
	// A dropdown the pointer rests on closes without the pointer moving, and
	// focus stays where it is; it opens again once the pointer comes back.
	// (With focus inside it, the Navigation block's own Escape handles it.)
	document.addEventListener( 'keydown', function ( event ) {
		if ( 'Escape' !== event.key ) {
			return;
		}
		document.querySelectorAll( '.wp-block-navigation .wp-block-navigation-submenu' ).forEach( function ( item ) {
			var toggle = item.querySelector( ':scope > [aria-expanded]' );
			var shown = item.matches( ':hover' ) || ( toggle && 'true' === toggle.getAttribute( 'aria-expanded' ) );
			if ( ! shown || item.contains( event.target ) || item.closest( '.is-menu-open' ) ) {
				return;
			}
			item.classList.add( 'uh-dismissed' );
			if ( toggle ) {
				toggle.setAttribute( 'aria-expanded', 'false' );
			}
			item.addEventListener( 'pointerleave', function () {
				item.classList.remove( 'uh-dismissed' );
			}, { once: true } );
		} );
	} );

	/* ── Page to page: the card you opened becomes the page's head ──────── */
	// Cross-document view transitions (style.css, Continuity). The page being
	// left names the photo and title of the card that was clicked; the post
	// or product page names its own head (style.css), so the two morph into
	// each other. Elsewhere the pages simply cross-fade.
	var openedCard = null;
	document.addEventListener( 'click', function ( event ) {
		var link = event.target.closest ? event.target.closest( 'a[href]' ) : null;
		openedCard = link ? link.closest( '.wp-block-post, .wc-block-product' ) : null;
	}, true );
	window.addEventListener( 'pageswap', function ( event ) {
		if ( ! event.viewTransition || ! openedCard ) {
			return;
		}
		// The page's own head carries the same names (a post or product page,
		// unhurried_page_head_names()); one element per name, so it lets go.
		document.querySelectorAll( 'main img, main h1' ).forEach( function ( el ) {
			var name = window.getComputedStyle( el ).viewTransitionName;
			if ( 'uh-photo' === name || 'uh-title' === name ) {
				el.style.viewTransitionName = 'none';
			}
		} );
		var photo = openedCard.querySelector( '.wp-block-post-featured-image img, .wc-block-components-product-image img' );
		var title = openedCard.querySelector( '.wp-block-post-title' );
		if ( photo ) {
			photo.style.viewTransitionName = 'uh-photo';
		}
		if ( title ) {
			title.style.viewTransitionName = 'uh-title';
		}
	} );

	if ( ! auto ) {
		return;
	}

	/* ── Header: steps aside while reading down, returns on the way up ──── */
	// A translate of the sticky header only (no layout shift). It never
	// hides while it holds keyboard focus or an open menu, and comes back as
	// soon as focus goes into it.
	var headerPart = document.querySelector( 'header.wp-block-template-part' );
	if ( headerPart && headerPart.querySelector( '.unhurried-header' ) ) {
		var lastY = window.pageYOffset;
		var ticking = false;
		var update = function () {
			ticking = false;
			var y = window.pageYOffset;
			if ( Math.abs( y - lastY ) < 6 ) {
				return;
			}
			var busy = headerPart.contains( document.activeElement ) || headerPart.querySelector( '[aria-expanded="true"], .is-menu-open' );
			html.classList.toggle( 'uh-header-away', y > lastY && y > 320 && ! busy );
			lastY = y;
		};
		window.addEventListener( 'scroll', function () {
			if ( ! ticking ) {
				ticking = true;
				window.requestAnimationFrame( update );
			}
		}, { passive: true } );
		headerPart.addEventListener( 'focusin', function () {
			html.classList.remove( 'uh-header-away' );
		} );
	}

	// Whatever a reader scrolls past before the page has loaded has been seen:
	// it is never hidden again for an entrance (startReveal() skips it).
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

	/* The entrances are set up once the page has loaded: the work of marking
	   every element never competes with the first screen. What is still below
	   the window then waits for its entrance; anything a quick reader already
	   reached simply shows. */
	function startReveal() {
		/* ── Automatic reveal ─────────────────────────────────────────────── */
		// First match wins; a marked element's descendants stay still, so a
		// card moves as one piece rather than as a pile of parts.
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
		// A product's buy area holds still (the columns that hold its form).
		var BUY = '.wp-block-columns:has(form.cart, .wp-block-add-to-cart-form, .wp-block-woocommerce-add-to-cart-form, .wp-block-add-to-cart-with-options)';
		try {
			document.querySelector( BUY );
			SKIP += ',' + BUY;
		} catch ( e ) {
			BUY = '';
		}

		// Split layouts (two columns side by side): each side arrives from its own side.
		function sideOf( col ) {
			var row = col.parentElement;
			if ( window.innerWidth < 782 || ! row || 2 !== row.children.length ) {
				return '';
			}
			return row.firstElementChild === col ? 'side-start' : 'side-end';
		}

		// Headings arrive line by line (the fourth line on together).
		// The words are wrapped in place; the heading reads the same to screen
		// readers. If wrapping would change the heading's size at all, it is undone
		// and the heading rises as one piece.
		function splitWords( el ) {
			var text = el.textContent.trim();
			if ( ! text || text.split( /\s+/ ).length > 16 ) {
				return false;
			}
			var before = el.getBoundingClientRect();
			var saved = Array.prototype.slice.call( el.childNodes );
			var units = [];
			saved.forEach( function ( n ) {
				if ( 3 === n.nodeType ) {
					var frag = document.createDocumentFragment();
					n.textContent.split( /(\s+)/ ).forEach( function ( part ) {
						if ( ! part ) {
							return;
						}
						if ( /^\s+$/.test( part ) ) {
							frag.appendChild( document.createTextNode( part ) );
							return;
						}
						var w = document.createElement( 'span' );
						w.className = 'uh-w';
						w.style.display = 'inline-block';
						w.textContent = part;
						frag.appendChild( w );
						units.push( w );
					} );
					n.parentNode.replaceChild( frag, n );
				} else if ( 1 === n.nodeType && 'BR' !== n.tagName ) {
					n.classList.add( 'uh-w' );
					n.style.display = 'inline-block';
					units.push( n );
				}
			} );
			var after = el.getBoundingClientRect();
			if ( Math.abs( after.height - before.height ) > 0.5 || Math.abs( after.width - before.width ) > 0.5 ) {
				while ( el.firstChild ) {
					el.removeChild( el.firstChild );
				}
				saved.forEach( function ( n ) {
					if ( 1 === n.nodeType ) {
						n.classList.remove( 'uh-w' );
						n.style.removeProperty( 'display' );
					}
					el.appendChild( n );
				} );
				return false;
			}
			// Words on the same line set off together, a line at a time.
			var line = -1;
			var lastTop = null;
			units.forEach( function ( u ) {
				var top = Math.round( u.getBoundingClientRect().top );
				if ( null === lastTop || Math.abs( top - lastTop ) > 4 ) {
					line++;
					lastTop = top;
				}
				u.style.setProperty( '--uh-w', Math.min( line, 3 ) );
			} );
			return true;
		}

		var scopes = document.querySelectorAll( '.wp-site-blocks > main, .wp-site-blocks > footer, main.wp-block-group' );
		var selector = KINDS.map( function ( k ) {
			return k[ 1 ];
		} ).join( ',' );
		var targets = [];
		var fold = window.innerHeight;
		// Arriving at #anchor from another page: what is above the target and the
		// target's own screen show at once, so the page never opens on (or
		// scrolls past) sections still waiting to enter.
		var hashTarget = null;
		try {
			hashTarget = window.location.hash ? document.getElementById( decodeURIComponent( window.location.hash.slice( 1 ) ) ) : null;
		} catch ( e ) {
			hashTarget = null;
		}
		var shownTo = hashTarget ? hashTarget.getBoundingClientRect().top + window.pageYOffset + fold : 0;

		scopes.forEach( function ( scope ) {
			scope.querySelectorAll( selector ).forEach( function ( el ) {
				if ( el.hasAttribute( 'data-uh' ) || el.closest( SKIP ) || el.closest( '[data-uh-early]' ) || el.querySelector( '[data-uh-early]' ) ) {
					return;
				}
				var parent = el.parentElement && el.parentElement.closest( '[data-uh]' );
				// Inside a column arriving from its side, or a cover lifting its
				// curtain, a heading still arrives word by word.
				if ( parent && ! ( /^(side-|image)/.test( parent.getAttribute( 'data-uh' ) ) && el.matches( 'h1, h2, h3' ) ) ) {
					return;
				}
				for ( var i = 0; i < KINDS.length; i++ ) {
					if ( el.matches( KINDS[ i ][ 1 ] ) ) {
						// On screen already, or scrolled past: it entered with the
						// page (style.css) and is left to finish. A divider and the
						// wordmark were not part of that, so they still draw in. A
						// figure that counts up shows its final value here: the
						// first screen must read at once (DESIGN-GUIDE section 6),
						// and counting now would turn the figure already on screen
						// back to 0. Below the window it counts up as it enters.
						if ( 'draw' !== KINDS[ i ][ 0 ] && 'words' !== KINDS[ i ][ 0 ] && ( el.getBoundingClientRect().top < fold || el.getBoundingClientRect().top + window.pageYOffset < shownTo ) ) {
							break;
						}
						var kind = KINDS[ i ][ 0 ];
						if ( 'side' === kind ) {
							kind = sideOf( el );
							if ( ! kind ) {
								continue;
							}
						}
						el.setAttribute( 'data-uh', kind );
						if ( 'line' === kind && ! splitWords( el ) ) {
							el.setAttribute( 'data-uh', 'rise' );
						}
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
			var duration = COUNT;
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
			// The wordmark's letters set off up to MAX_DELAY after one another.
			var long = Math.max( ENTER, LONGEST ) + ( el.getAttribute( 'data-uh' ) === 'words' ? MAX_DELAY : 0 ) + 50;
			window.setTimeout( function () {
				el.classList.add( 'is-done' );
				el.style.removeProperty( '--uh-delay' );
			}, delay + long );
		}

		var observer;
		var tallObserver;

		function enter( el, step ) {
			var delay = Math.min( step * STAGGER, MAX_DELAY );
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
			// What waits inside it (a heading in a cover or a column) follows,
			// a step later: under a curtain the observer cannot see it yet.
			el.querySelectorAll( '[data-uh]:not(.is-in)' ).forEach( function ( inner ) {
				enter( inner, step + 2 );
			} );
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
			// Starts a little before it is in view, so text is readable as it arrives.
			{ rootMargin: '0px 0px 8% 0px', threshold: 0.15 }
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
		// Switch to the per-element states, and make the browser compute them
		// now, so a divider or wordmark already on screen draws in from its
		// starting state rather than jumping straight to its end.
		html.classList.add( 'uh-motion-live' );
		void document.body.offsetWidth;
		targets.forEach( function ( el ) {
			observer.observe( el );
			tallObserver.observe( el );
		} );
	}
	if ( 'complete' === document.readyState ) {
		startReveal();
	} else {
		window.addEventListener( 'load', startReveal );
	}

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
