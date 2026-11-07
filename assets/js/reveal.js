/**
 * Unhurried: gentle reveal on scroll.
 *
 * Elements with the class "unhurried-reveal", or the Reveal block style
 * (class "is-style-reveal"), rise into place as they enter
 * the viewport. Content is fully visible without JavaScript, and nothing
 * moves when the visitor prefers reduced motion.
 */
( function () {
	if ( ! ( 'IntersectionObserver' in window ) ) {
		return;
	}
	if ( window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches ) {
		return;
	}

	var items = document.querySelectorAll( '.unhurried-reveal, .is-style-reveal' );
	if ( ! items.length ) {
		return;
	}

	var observer = new IntersectionObserver(
		function ( entries ) {
			entries.forEach( function ( entry ) {
				if ( entry.isIntersecting ) {
					entry.target.classList.add( 'is-revealed' );
					observer.unobserve( entry.target );
				}
			} );
		},
		{ rootMargin: '0px 0px -8% 0px' }
	);

	items.forEach( function ( item ) {
		var rect = item.getBoundingClientRect();
		if ( rect.top < window.innerHeight ) {
			item.classList.add( 'is-revealed' );
		} else {
			observer.observe( item );
		}
	} );

	document.documentElement.classList.add( 'has-unhurried-reveal' );
} )();
