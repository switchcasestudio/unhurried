<?php
/**
 * Maps: the drawn map, and a live Google map in the Unhurried look.
 *
 * The theme itself never loads a map service. The Map and directions
 * pattern shows a drawn map; a live Google map appears when the site owner
 * adds one: through the free Gmap Block plugin (the pattern then uses its
 * block, see patterns/map-directions.php) or Google Maps' own embed code in
 * a Custom HTML block. Whichever way it came, a block that is just a Google
 * map is shown in the theme's frame: rounded, 4:3, black and white (dark in
 * a dark look), loading only as it nears the window, with a title. On the
 * drawn map and on a live map of one place, a terracotta pin drops onto the
 * place as the map comes into view. The live map waits for the visitor: the
 * page scrolls over it and it cannot move from under the pin until a click
 * on it or on "Pan and zoom", or keyboard focus, hands it over. Without
 * scripts the map works as Google draws it, with Google's pin. The
 * stylesheets and the script load only on pages that show a map.
 *
 * @package Unhurried
 * @author  Moses Atia Poston, Switch Case Studio
 * @since 1.2.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Not a page: this file only runs inside WordPress.
}

if ( ! function_exists( 'unhurried_map_editor_style' ) ) :
	/**
	 * Gives the editor the maps' look.
	 *
	 * @since 1.2.1
	 * @return void
	 */
	function unhurried_map_editor_style() {
		add_editor_style( array( 'assets/css/map.css', 'assets/css/map-live.css' ) );
	}
endif;
add_action( 'after_setup_theme', 'unhurried_map_editor_style', 11 );

if ( ! function_exists( 'unhurried_map_assets' ) ) :
	/**
	 * Loads the pin's stylesheet and the script that drops it and, for a live
	 * map, the frame's stylesheet. WordPress prints small stylesheets inline.
	 *
	 * A live map's styles go in the head: they hold its frame's shape from the
	 * first paint. The drawn map's only add the pin's drop, so they wait for
	 * the end of the page and hold up nothing above it (in the head they took
	 * the place of another stylesheet WordPress would have printed inline).
	 *
	 * @since 1.2.1
	 * @param bool $live Whether a live map is on the page.
	 * @return void
	 */
	function unhurried_map_assets( $live = false ) {
		if ( ! $live && ! did_action( 'wp_head' ) ) {
			if ( false === has_action( 'wp_footer', 'unhurried_map_late_assets' ) ) {
				add_action( 'wp_footer', 'unhurried_map_late_assets', 0 );
			}
			return;
		}
		$version = wp_get_theme( get_template() )->get( 'Version' );
		$files   = $live ? array( 'unhurried-map', 'unhurried-map-live' ) : array( 'unhurried-map' );
		foreach ( $files as $handle ) {
			if ( wp_style_is( $handle, 'enqueued' ) ) {
				continue;
			}
			$file = 'assets/css/' . substr( $handle, strlen( 'unhurried-' ) ) . '.css';
			wp_enqueue_style( $handle, get_template_directory_uri() . '/' . $file, array( 'unhurried-style' ), $version );
			wp_style_add_data( $handle, 'path', get_template_directory() . '/' . $file );
			if ( 'unhurried-map-live' === $handle && function_exists( 'unhurried_is_dark_look' ) && unhurried_is_dark_look() ) {
				// A white map would glare on a dark page: the map turns dark, its labels light.
				wp_add_inline_style( $handle, ':root{--uh-map-filter:grayscale(1) invert(.9) contrast(.88) brightness(1.04)}' );
			}
		}
		if ( ! wp_script_is( 'unhurried-map', 'enqueued' ) ) {
			wp_enqueue_script(
				'unhurried-map',
				get_template_directory_uri() . '/assets/js/map.js',
				array(),
				$version,
				array(
					'strategy'  => 'defer',
					'in_footer' => true,
				)
			);
		}
	}
endif;

if ( ! function_exists( 'unhurried_map_late_assets' ) ) :
	/**
	 * Loads the drawn map's pin stylesheet at the end of the page.
	 *
	 * @since 1.2.1
	 * @return void
	 */
	function unhurried_map_late_assets() {
		unhurried_map_assets( false );
	}
endif;

if ( ! function_exists( 'unhurried_is_google_map' ) ) :
	/**
	 * Whether an address is a Google Maps embed (any google.* host, a /maps path).
	 *
	 * @since 1.2.1
	 * @param string $src Address of a frame.
	 * @return bool
	 */
	function unhurried_is_google_map( $src ) {
		$parts = wp_parse_url( (string) $src );
		if ( ! is_array( $parts ) || empty( $parts['host'] ) || empty( $parts['path'] ) ) {
			return false;
		}
		return (bool) preg_match( '/(^|\.)google\.[a-z]{2,3}(\.[a-z]{2})?$/i', $parts['host'] ) && 0 === strpos( $parts['path'], '/maps' );
	}
endif;

if ( ! function_exists( 'unhurried_map_centered' ) ) :
	/**
	 * Whether a Google map shows one place at its center, where the theme's pin
	 * stands: an address or a point typed into the map (maps?q=..., as the
	 * Gmap Block plugin and most map blocks make it), Google Maps' own
	 * "Share", "Embed a map" code for one place (Google centers the place
	 * when the map is shared straight after the search), or the Maps Embed
	 * API's place mode. A map of an area, a route or a street view has no
	 * single place at its center: Google's own pins mark it.
	 *
	 * @since 1.2.1
	 * @param string $src Address of a Google Maps frame.
	 * @return bool
	 */
	function unhurried_map_centered( $src ) {
		$parts = wp_parse_url( html_entity_decode( (string) $src, ENT_QUOTES ) );
		$path  = isset( $parts['path'] ) ? untrailingslashit( $parts['path'] ) : '';
		$query = array();
		if ( ! empty( $parts['query'] ) ) {
			wp_parse_str( $parts['query'], $query );
		}
		if ( '/maps/embed' === $path && ! empty( $query['pb'] ) && is_string( $query['pb'] ) ) {
			// A map view (!1m3!1d...) marking one place, a point (!1m1!2z...) or a business (!1m2!1s...); no route (!4m), no street view (!6m).
			$pb = $query['pb'];
			return false !== strpos( $pb, '!1m3!1d' ) && 1 === preg_match_all( '/!3m2!1m1!2z|!3m3!1m2!1s/', $pb ) && ! preg_match( '/!4m\d|!6m\d/', $pb );
		}
		if ( 0 === strpos( $path, '/maps/embed/v1/place' ) ) {
			return ! isset( $query['center'] );
		}
		return '/maps' === $path && ! empty( $query['q'] ) && ! isset( $query['ll'] ) && ! isset( $query['sll'] );
	}
endif;

if ( ! function_exists( 'unhurried_map_frame' ) ) :
	/**
	 * Shows a block that is just a Google map in the theme's map frame.
	 *
	 * Works on the markup as it is shown, so it reaches a map from any block
	 * (a plugin's, or Google's embed code in a Custom HTML block) and maps
	 * saved before this version. A block with anything more than the map
	 * (text, a picture, a form) is left as it is. The map gets
	 * loading="lazy" and a title when it has none (or only coordinates for
	 * one). Where the map's place is at its center, the theme's pin and a
	 * "Pan and zoom" button come with it (shown by assets/js/map.js). The
	 * innermost block holding the map is framed; the blocks around it see
	 * the frame and pass.
	 *
	 * @since 1.2.1
	 * @param string $block_content Rendered block.
	 * @return string
	 */
	function unhurried_map_frame( $block_content ) {
		$html = (string) $block_content;
		if ( false === stripos( $html, '<iframe' ) || false === stripos( $html, 'google.' ) || false !== strpos( $html, 'unhurried-map-frame' ) || ! class_exists( 'WP_HTML_Tag_Processor' ) ) {
			return $block_content;
		}
		// Just a map: one frame, and around it nothing to read, see or use.
		$rest = (string) preg_replace( '#<iframe\b[^>]*>.*?</iframe>#is', '', $html, -1, $count );
		if ( 1 !== $count || '' !== trim( wp_strip_all_tags( $rest ) ) || preg_match( '#<(a|img|picture|svg|video|audio|canvas|object|embed|form|input|button|select|textarea)\b#i', $rest ) ) {
			return $block_content;
		}
		$tags = new WP_HTML_Tag_Processor( $html );
		if ( ! $tags->next_tag( 'iframe' ) ) {
			return $block_content;
		}
		$src = (string) $tags->get_attribute( 'src' );
		if ( ! unhurried_is_google_map( $src ) ) {
			return $block_content;
		}
		if ( null === $tags->get_attribute( 'loading' ) ) {
			$tags->set_attribute( 'loading', 'lazy' );
		}
		$title = trim( (string) $tags->get_attribute( 'title' ) );
		if ( '' === $title || preg_match( '/^-?\d+(\.\d+)?\s*,\s*-?\d+(\.\d+)?$/', $title ) ) {
			$tags->set_attribute( 'title', __( 'Map', 'unhurried' ) );
		}
		// The map's own full-screen button needs the frame's permission, as
		// Google's embed code gives it (1.2.1). A plugin's frame may come
		// without (Gmap Block does), and Safari then logged a failed
		// "fullscreen" permission check. Both copies below carry it, as
		// allowfullscreen alone: it allows any address the frame goes on to,
		// and maps.google.com moves on to www.google.com. An allow attribute
		// naming fullscreen would allow only the first address and would
		// overrule allowfullscreen, so the theme adds none.
		$tags->set_attribute( 'allowfullscreen', true );
		// The address waits in data-src until map.js sees the map within
		// about a screen of the window (the browser's own lazy loading reached
		// Google two to four screens ahead). Without JavaScript the copy in
		// <noscript> loads as before, lazily (map-live.css hides the other).
		preg_match( '#<iframe\b[^>]*>.*?</iframe>#is', $tags->get_updated_html(), $original );
		$tags->set_attribute( 'data-src', $src );
		$tags->remove_attribute( 'src' );
		$noscript = isset( $original[0] ) ? '<noscript>' . $original[0] . '</noscript>' : '';
		unhurried_map_assets( true );
		$pin = unhurried_map_centered( $src );
		// The button comes first: it sits at the map's top, and the keyboard reaches it before the map.
		return '<div class="unhurried-map-frame' . ( $pin ? ' has-pin' : '' ) . '">'
			. ( $pin ? '<button type="button" class="unhurried-map-frame__use" hidden>' . esc_html__( 'Pan and zoom', 'unhurried' ) . '</button>' : '' )
			. '<div class="unhurried-map-frame__map">' . $tags->get_updated_html() . $noscript . '</div>'
			. ( $pin ? '<span class="unhurried-map-frame__pin" aria-hidden="true"></span>' : '' )
			. '</div>';
	}
endif;
add_filter( 'render_block', 'unhurried_map_frame', 20 );

if ( ! function_exists( 'unhurried_map_drawn' ) ) :
	/**
	 * Loads the maps' stylesheet where the drawn map is shown (its pin drops in).
	 *
	 * @since 1.2.1
	 * @param string $block_content Rendered Group block.
	 * @param array  $block         Parsed block.
	 * @return string
	 */
	function unhurried_map_drawn( $block_content, $block ) {
		if ( ! empty( $block['attrs']['className'] ) && preg_match( '/(^|\s)unhurried-map(\s|$)/', (string) $block['attrs']['className'] ) ) {
			unhurried_map_assets( false );
		}
		return $block_content;
	}
endif;
add_filter( 'render_block_core/group', 'unhurried_map_drawn', 10, 2 );
