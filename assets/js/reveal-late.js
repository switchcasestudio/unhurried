/**
 * Unhurried motion, the part that waits: fetched by assets/js/reveal.js once
 * the page has loaded and is idle, so none of it competes with the first
 * screen.
 *
 * It loads the scroll choreography's stylesheet (assets/css/scroll.css), and
 * runs what answers the reader after load: state fades, the marquee's pause
 * button, Escape for dropdowns, the header that steps aside, the gift card's
 * tilt, headings arriving line by line and figures counting up.
 *
 * @package Unhurried
 */
( function () {
	'use strict';

	var html = document.documentElement;
	var config = window.unhurriedScroll || {};
	var hooks = window.unhurriedMotion = window.unhurriedMotion || {};
	if ( hooks.late ) {
		return;
	}
	hooks.late = true;
	var still = window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
	var auto = html.classList.contains( 'uh-motion' );
	var rootStyle = window.getComputedStyle( html );
	function token( name, fallback ) {
		var value = parseFloat( rootStyle.getPropertyValue( name ) );
		return isFinite( value ) ? value : fallback;
	}

	/* ── State fades ─────────────────────────────────────────────────── */
	// They (scroll.css) play only on a change the reader made: an accordion
	// opened, a tab chosen, an option picked, a row put back. What is on the
	// page now, and anything a script redraws on its own (the cart block
	// re-renders its rows), is marked seen and never fades.
	var STATE_FADES = '.single_variation_wrap .woocommerce-variation-price, .single_variation_wrap .woocommerce-variation-availability, .wc-block-cart-items__row, .wp-block-details > :not(summary), .woocommerce-Tabs-panel';
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
	// A row in the mini-cart fades in when the drawer shows it (scroll.css),
	// once: then it is seen.
	document.addEventListener( 'animationend', function ( event ) {
		if ( 'uh-notice-in' === event.animationName && event.target.matches && event.target.matches( '.wc-block-mini-cart__drawer .wc-block-cart-items__row' ) ) {
			event.target.setAttribute( 'data-uh-seen', '' );
		}
	} );
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
	// Watched only where a script redraws what is already shown: the cart
	// page's block and a variable product's form.
	var redrawn = document.querySelectorAll( '.wc-block-cart, .variations_form' );
	if ( window.MutationObserver && redrawn.length ) {
		var watcher = new window.MutationObserver( function ( records ) {
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
		} );
		Array.prototype.forEach.call( redrawn, function ( el ) {
			watcher.observe( el, { childList: true, subtree: true } );
		} );
	}

	/* ── The late stylesheet ─────────────────────────────────────────── */
	var cssReady = [];
	if ( config.css && ! document.getElementById( 'unhurried-scroll-css' ) ) {
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
		link.href = config.css;
		link.onload = function () {
			cssReady.forEach( function ( fn ) {
				fn();
			} );
		};
		document.head.appendChild( link );
	}

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

	if ( still ) {
		return;
	}

	/* ── Marquee: a pause button (1.2.1) ───────────────────────────────── */
	// The moving line runs for good, so it gets a control to stop it (WCAG
	// 2.2.2); the button is in the page from unhurried_marquee_loop() and
	// shows once its styles are in.
	document.querySelectorAll( '.unhurried-marquee__pause' ).forEach( function ( button ) {
		var line = button.closest( '.unhurried-marquee' );
		cssReady.push( function () {
			button.hidden = false;
		} );
		button.addEventListener( 'click', function () {
			var paused = 'true' !== button.getAttribute( 'aria-pressed' );
			button.setAttribute( 'aria-pressed', paused ? 'true' : 'false' );
			line.classList.toggle( 'is-paused', paused );
			// Play moves the line at once, with the pointer or the focus
			// still on the button; hover and focus hold it again once they
			// have left it (style.css).
			line.classList.toggle( 'is-played', ! paused );
		} );
		line.addEventListener( 'pointerleave', function () {
			line.classList.remove( 'is-played' );
		} );
		line.addEventListener( 'focusout', function ( event ) {
			if ( ! line.contains( event.relatedTarget ) ) {
				line.classList.remove( 'is-played' );
			}
		} );
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

	if ( ! auto ) {
		return;
	}

	/* ── Header: steps aside while reading down, returns on the way up ──── */
	// A translate of the sticky header only (no layout shift). It never
	// hides while it holds keyboard focus or an open menu, comes back as soon
	// as keyboard focus goes into it, and otherwise returns only after about
	// 120px of reading back up (or near the top), not on any small nudge of
	// the wheel. Focus a tap or a click leaves in it (the menu button, once
	// the menu closes) does not hold it: only focus the browser shows a ring
	// for (:focus-visible).
	var headerPart = document.querySelector( 'header.wp-block-template-part' );
	if ( headerPart && headerPart.querySelector( '.unhurried-header' ) ) {
		var lastY = window.pageYOffset;
		var turnY = lastY;
		var away = false;
		var ticking = false;
		var keyFocus = function () {
			try {
				return !! headerPart.querySelector( ':focus-visible' );
			} catch ( e ) {
				return headerPart.contains( document.activeElement );
			}
		};
		var update = function () {
			ticking = false;
			var y = window.pageYOffset;
			if ( y > lastY ) {
				turnY = y;
				if ( ! away && y > 320 && ! ( keyFocus() || headerPart.querySelector( '[aria-expanded="true"], .is-menu-open' ) ) ) {
					away = true;
					// On the header itself, not <html>: a class on the root
					// restyled the whole page.
					headerPart.classList.add( 'uh-header-away' );
				}
			} else if ( away && ( turnY - y >= 120 || y <= 320 ) ) {
				away = false;
				headerPart.classList.remove( 'uh-header-away' );
			}
			lastY = y;
		};
		window.addEventListener( 'scroll', function () {
			if ( ! ticking ) {
				ticking = true;
				window.requestAnimationFrame( update );
			}
		}, { passive: true } );
		headerPart.addEventListener( 'focusin', function () {
			if ( keyFocus() ) {
				away = false;
				headerPart.classList.remove( 'uh-header-away' );
			}
		} );
	}

	/* ── Headings arrive line by line ─────────────────────────────────── */
	// The words are wrapped in place shortly before the heading enters (the
	// fourth line on together); the heading reads the same to screen
	// readers. If wrapping would change the heading's size at all, it is
	// undone and the heading rises as one piece.
	hooks.split = function ( el ) {
		if ( el.classList.contains( 'uh-split' ) || 'line' !== el.getAttribute( 'data-uh' ) ) {
			return;
		}
		var text = el.textContent.trim();
		var before = el.getBoundingClientRect();
		var saved = Array.prototype.slice.call( el.childNodes );
		var units = [];
		if ( text && text.split( /\s+/ ).length <= 16 ) {
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
		}
		// Read everything, then write.
		var after = el.getBoundingClientRect();
		var tops = units.map( function ( u ) {
			return Math.round( u.getBoundingClientRect().top );
		} );
		if ( ! units.length || Math.abs( after.height - before.height ) > 0.5 || Math.abs( after.width - before.width ) > 0.5 ) {
			if ( units.length ) {
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
			}
			el.setAttribute( 'data-uh', 'rise' );
			return;
		}
		// Words on the same line set off together, a line at a time.
		var line = -1;
		var lastTop = null;
		units.forEach( function ( u, i ) {
			if ( null === lastTop || Math.abs( tops[ i ] - lastTop ) > 4 ) {
				line++;
				lastTop = tops[ i ];
			}
			u.style.setProperty( '--uh-w', Math.min( line, 3 ) );
		} );
		el.classList.add( 'uh-split' );
	};
	// Headings are wrapped as they come within a screen of the window, one
	// at a time when the page is idle (never inside a scrolling frame).
	if ( 'IntersectionObserver' in window ) {
		var queue = [];
		var idle = function ( fn, options ) {
			return 'requestIdleCallback' in window ? window.requestIdleCallback( fn, options ) : window.setTimeout( fn, 1 );
		};
		var work = function () {
			var el = queue.shift();
			if ( el && ! el.classList.contains( 'is-in' ) ) {
				hooks.split( el );
			}
			if ( queue.length ) {
				idle( work, { timeout: 300 } );
			}
		};
		var soon = new IntersectionObserver( function ( entries ) {
			entries.forEach( function ( entry ) {
				if ( entry.isIntersecting ) {
					soon.unobserve( entry.target );
					if ( 1 === queue.push( entry.target ) ) {
						idle( work, { timeout: 300 } );
					}
				}
			} );
		}, { rootMargin: '0px 0px 100% 0px' } );
		hooks.watch = function ( el ) {
			soon.observe( el );
		};
		document.querySelectorAll( '[data-uh="line"]:not(.uh-split):not(.is-in)' ).forEach( hooks.watch );
	}

	/* ── Figures count up ─────────────────────────────────────────────── */
	// From zero to their printed value, in the author's own format ("1,200",
	// "12,5", "1.200.000"), ending as exactly what the author wrote. While
	// they count, the real value stays in the page for screen readers and the
	// moving digits are hidden from them.
	var COUNT = token( '--uh-dur-count', 1100 );
	hooks.count = function ( el ) {
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
		function frame( now ) {
			if ( null === start ) {
				start = now;
			}
			var t = Math.min( 1, ( now - start ) / COUNT );
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
	};
}() );
