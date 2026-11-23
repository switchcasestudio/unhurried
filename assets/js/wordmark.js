/**
 * Unhurried footer wordmark: the whole site title, from edge to edge.
 *
 * The server sets the wordmark's size from the title's width in em
 * (unhurried_size_wordmark() in functions.php; style.css divides the column
 * by it). Latin letters are measured from the theme's own font, so a Latin
 * title fills its column exactly. Letters in other scripts (Arabic, Hebrew,
 * Cyrillic, Greek, Chinese, Japanese, Korean) and emoji are drawn in the
 * visitor's own fonts, whose widths differ from one device to the next, so
 * the server can only estimate them, on the wide side. This script measures
 * the title as the browser drew it and sets --unhurried-wordmark-fit, a
 * factor style.css applies to that size:
 *
 * - any title wider than its column (with a reader's own letter spacing,
 *   say) is set smaller until it fits;
 * - a title in another script is set to fill its column, as a Latin one
 *   does, and never larger than the shortest titles are set.
 *
 * A Latin title that fits keeps exactly the size the server gave it. The
 * title is measured again when its column changes width, when fonts finish
 * loading and when its content changes.
 *
 * @package Unhurried
 */
( function () {
	'use strict';

	var marks = document.querySelectorAll( '.unhurried-wordmark' );
	if ( ! marks.length || ! document.createRange || ! window.getComputedStyle ) {
		return;
	}

	// A title with letters from another script than Latin, or an emoji, was estimated.
	var estimated = null;
	try {
		estimated = new RegExp( '[^\\p{Script=Latin}\\p{Script=Common}\\p{Script=Inherited}]|\\p{Extended_Pictographic}', 'u' );
	} catch ( e ) {
		estimated = null;
	}

	// A title set smaller to fit keeps the small room at its end that a Latin
	// title has. A title in another script keeps .1em clear at each end, so a
	// letter whose ink reaches past its box, in a font the theme does not
	// know, is never cut.
	var FILL = 0.985;
	var EDGE = 0.1;

	function fit( el ) {
		var text = el.querySelector( '.unhurried-wordmark__letters' ) || el.querySelector( 'a' ) || el;
		var range = document.createRange();
		range.selectNodeContents( text );
		var width = range.getBoundingClientRect().width;
		var style = window.getComputedStyle( el );
		var column = el.clientWidth - parseFloat( style.paddingLeft ) - parseFloat( style.paddingRight );
		var size = parseFloat( style.fontSize );
		if ( ! width || ! column || ! size ) {
			return;
		}
		var factor = parseFloat( el.style.getPropertyValue( '--unhurried-wordmark-fit' ) ) || 1;
		// Width and size at the server's size; both scale with the factor.
		var natural = width / factor;
		var base = size / factor;
		var next = 1;
		// WordPress's emoji script swaps an emoji for a picture where the
		// browser has no emoji font of its own.
		var guessed = !! el.querySelector( 'img' ) || !! ( estimated && estimated.test( el.textContent ) );
		if ( guessed ) {
			// Title, its two edges and the tight tracking the last letter's
			// ink reaches into, across the column. The shortest titles are set
			// at the column divided by 2.5 (unhurried_size_wordmark()).
			var tail = Math.max( 0, -parseFloat( style.letterSpacing ) || 0 ) / size;
			var em = parseFloat( style.getPropertyValue( '--unhurried-wordmark-em' ) ) || 2.5;
			next = Math.min( column / ( natural + ( 2 * EDGE + tail ) * base ), Math.max( 1, em / 2.5 ) );
		} else if ( natural > column ) {
			next = column * FILL / natural;
		}
		if ( Math.abs( next - factor ) > 0.002 ) {
			if ( 1 === next ) {
				el.style.removeProperty( '--unhurried-wordmark-fit' );
			} else {
				el.style.setProperty( '--unhurried-wordmark-fit', next.toFixed( 4 ) );
			}
		}
		// The edge the line starts from. Usually the start of the title's own
		// direction (an indent: the right one for a right-to-left title); on a
		// right-to-left site every title is set against the right edge, also a
		// left-to-right one, whose indent would fall on the left.
		var link = el.querySelector( 'a' );
		var right = guessed && link && 'right' === style.textAlign;
		if ( guessed && ! right ) {
			el.style.textIndent = EDGE + 'em';
		} else if ( el.style.textIndent ) {
			el.style.removeProperty( 'text-indent' );
		}
		if ( right ) {
			link.style.marginRight = EDGE + 'em';
		} else if ( link && link.style.marginRight ) {
			link.style.removeProperty( 'margin-right' );
		}
	}

	function fitAll() {
		for ( var i = 0; i < marks.length; i++ ) {
			fit( marks[ i ] );
		}
	}

	fitAll();
	var resized = null;
	if ( 'ResizeObserver' in window ) {
		// The column's width, and the letters' own box, which a reader's
		// letter spacing widens.
		resized = new window.ResizeObserver( function ( entries ) {
			for ( var e = 0; e < entries.length; e++ ) {
				var mark = entries[ e ].target.closest( '.unhurried-wordmark' );
				if ( mark ) {
					fit( mark );
				}
			}
		} );
	} else {
		window.addEventListener( 'resize', fitAll );
	}
	// The title's own content changing (an emoji swapped for a picture).
	var changed = 'MutationObserver' in window ? new window.MutationObserver( fitAll ) : null;
	for ( var i = 0; i < marks.length; i++ ) {
		var letters = marks[ i ].querySelector( '.unhurried-wordmark__letters' );
		if ( resized ) {
			resized.observe( marks[ i ] );
			if ( letters ) {
				resized.observe( letters );
			}
		}
		if ( changed ) {
			changed.observe( marks[ i ], { childList: true, characterData: true, subtree: true } );
		}
	}
	if ( document.fonts && document.fonts.ready ) {
		document.fonts.ready.then( fitAll );
		if ( document.fonts.addEventListener ) {
			document.fonts.addEventListener( 'loadingdone', fitAll );
		}
	}
} )();
