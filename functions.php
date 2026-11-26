<?php
/**
 * Unhurried functions and definitions.
 *
 * @package Unhurried
 * @author  Moses Atia Poston, Switch Case Studio
 * @copyright 2026 Moses Atia Poston, Switch Case Studio
 * @license GPL-2.0-or-later
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Not a page: this file only runs inside WordPress.
}

require_once get_template_directory() . '/inc/about-page.php';
require_once get_template_directory() . '/inc/hero-film.php';
require_once get_template_directory() . '/inc/map.php';
require_once get_template_directory() . '/inc/recommended.php';
require_once get_template_directory() . '/inc/setup.php';
require_once get_template_directory() . '/inc/woocommerce.php';

if ( ! function_exists( 'unhurried_setup' ) ) :
	/**
	 * Registers theme support and editor styles.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	function unhurried_setup() {
		add_theme_support( 'wp-block-styles' );
		add_editor_style( 'style.css' );
		// A short summary for pages, shown as the lede of service pages and
		// on the cards that list them.
		add_post_type_support( 'page', 'excerpt' );
	}
endif;
add_action( 'after_setup_theme', 'unhurried_setup' );

if ( ! function_exists( 'unhurried_enqueue_assets' ) ) :
	/**
	 * Enqueues the stylesheet and the motion script (assets/js/reveal.js).
	 *
	 * @since 1.0.0
	 * @return void
	 */
	function unhurried_enqueue_assets() {
		// These are the parent theme's files, so they carry its version: under a
		// child theme, wp_get_theme() is the child, and a parent update would
		// otherwise leave browsers on the old stylesheet and script.
		$version = wp_get_theme( get_template() )->get( 'Version' );
		// A child theme may ship its own reveal.js; that copy follows the child's version.
		$script_version = ( is_child_theme() && file_exists( get_stylesheet_directory() . '/assets/js/reveal.js' ) ) ? wp_get_theme()->get( 'Version' ) : $version;

		wp_enqueue_style( 'unhurried-style', get_template_directory_uri() . '/style.css', array(), $version );
		if ( function_exists( 'unhurried_is_dark_look' ) && unhurried_is_dark_look() ) {
			// Text over photographs stays light on a dark shade (printed inline).
			wp_enqueue_style( 'unhurried-dark-covers', get_template_directory_uri() . '/assets/css/dark-covers.css', array( 'unhurried-style' ), $version );
			wp_style_add_data( 'unhurried-dark-covers', 'path', get_template_directory() . '/assets/css/dark-covers.css' );
			if ( defined( 'WPFORMS_VERSION' ) || function_exists( 'wpforms' ) ) {
				// WPForms labels take the look's text color (printed inline).
				wp_enqueue_style( 'unhurried-wpforms-dark', get_template_directory_uri() . '/assets/css/wpforms-dark.css', array( 'unhurried-style' ), $version );
				wp_style_add_data( 'unhurried-wpforms-dark', 'path', get_template_directory() . '/assets/css/wpforms-dark.css' );
			}
			/**
			 * Filters whether a dark look tells the browser it is dark.
			 *
			 * In a dark look the theme declares `color-scheme: dark`
			 * (assets/css/dark.css, printed inline), so what the browser draws
			 * itself follows: scrollbars, the lists of selects, date pickers,
			 * fields the theme does not style. A plugin field that sets only a
			 * white fill, or only dark text, can become unreadable that way.
			 * Return false to keep the browser's light scheme:
			 *
			 *     add_filter( 'unhurried_dark_color_scheme', '__return_false' );
			 *
			 * @since 1.2.0
			 * @param bool $dark True in a dark look.
			 */
			if ( apply_filters( 'unhurried_dark_color_scheme', true ) ) {
				wp_enqueue_style( 'unhurried-dark', get_template_directory_uri() . '/assets/css/dark.css', array( 'unhurried-style' ), $version );
				wp_style_add_data( 'unhurried-dark', 'path', get_template_directory() . '/assets/css/dark.css' );
			}
		}

		wp_enqueue_script(
			'unhurried-reveal',
			get_theme_file_uri( 'assets/js/reveal.js' ),
			array(),
			$script_version,
			array(
				'strategy'  => 'defer',
				'in_footer' => true,
			)
		);
	}
endif;
add_action( 'wp_enqueue_scripts', 'unhurried_enqueue_assets' );

if ( ! function_exists( 'unhurried_image_frame' ) ) :
	/**
	 * Gives a photo a frame of its own shape, for the scroll drift and the
	 * pointer response (style.css and assets/css/scroll.css, 1.2.1).
	 *
	 * An Image block without a caption, a set size, a border or an unusual
	 * shape gets the class unhurried-frame and its corner radius as
	 * --uh-frame-r, so the figure can clip the picture as it drifts and eases
	 * inside. Front end only; the saved block is unchanged.
	 *
	 * @since 1.2.1
	 * @param string $block_content Rendered block.
	 * @param array  $block         Parsed block.
	 * @return string
	 */
	function unhurried_image_frame( $block_content, $block ) {
		$attrs  = isset( $block['attrs'] ) ? (array) $block['attrs'] : array();
		$class  = isset( $attrs['className'] ) ? (string) $attrs['className'] : '';
		$border = isset( $attrs['style']['border'] ) ? (array) $attrs['style']['border'] : array();
		$radius = isset( $border['radius'] ) ? $border['radius'] : '';
		if ( ! class_exists( 'WP_HTML_Tag_Processor' )
			|| false !== strpos( $block_content, '<figcaption' )
			|| preg_match( '/is-style-(arch|rounded|circle)/', $class )
			// A picture that shares its frame with another layer (the film
			// hero's poster under its film) must not drift or round alone.
			|| false !== strpos( $class, 'unhurried-hero-' )
			|| ! empty( $attrs['width'] ) || ! empty( $attrs['height'] )
			|| ! empty( $border['width'] ) || ! empty( $border['color'] ) || ! empty( $border['style'] ) || ! empty( $attrs['borderColor'] )
			|| ( '' !== $radius && ( ! is_string( $radius ) || ! preg_match( '/^[0-9.]+(px|rem|em|%)$/', $radius ) ) ) ) {
			return $block_content;
		}
		$tags = new WP_HTML_Tag_Processor( $block_content );
		if ( ! $tags->next_tag( 'figure' ) ) {
			return $block_content;
		}
		$tags->add_class( 'unhurried-frame' );
		if ( '' !== $radius ) {
			$style = (string) $tags->get_attribute( 'style' );
			$tags->set_attribute( 'style', trim( $style . ';--uh-frame-r:' . $radius, ';' ) );
		}
		return $tags->get_updated_html();
	}
endif;
add_filter( 'render_block_core/image', 'unhurried_image_frame', 10, 2 );

if ( ! function_exists( 'unhurried_scroll_styles' ) ) :
	/**
	 * The scroll choreography and the quiet responses (assets/css/scroll.css).
	 *
	 * Loaded by assets/js/reveal.js once the page has loaded, so it never
	 * competes with the first screen: all it styles is below the window or
	 * answers a pointer. Without JavaScript a noscript link loads it for the
	 * pointer responses (unhurried_scroll_styles_noscript()). Child themes
	 * (Unhurried Pro among them) can tell this version has it by this
	 * function.
	 *
	 * @since 1.2.1
	 * @return void
	 */
	function unhurried_scroll_styles() {
		wp_localize_script( 'unhurried-reveal', 'unhurriedScroll', array( 'css' => unhurried_scroll_styles_url() ) );
	}
endif;
add_action( 'wp_enqueue_scripts', 'unhurried_scroll_styles', 20 );

if ( ! function_exists( 'unhurried_scroll_styles_url' ) ) :
	/**
	 * The address of assets/css/scroll.css, with the parent theme's version.
	 *
	 * @since 1.2.1
	 * @return string
	 */
	function unhurried_scroll_styles_url() {
		return add_query_arg( 'ver', rawurlencode( (string) wp_get_theme( get_template() )->get( 'Version' ) ), get_template_directory_uri() . '/assets/css/scroll.css' );
	}
endif;

if ( ! function_exists( 'unhurried_scroll_styles_noscript' ) ) :
	/**
	 * Without JavaScript the pointer responses still load (nothing in the
	 * stylesheet hides anything without the script).
	 *
	 * @since 1.2.1
	 * @return void
	 */
	function unhurried_scroll_styles_noscript() {
		echo '<noscript><link rel="stylesheet" href="' . esc_url( unhurried_scroll_styles_url() ) . '"></noscript>' . "\n"; // phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedStylesheet -- only without JavaScript; with it, reveal.js loads the file after the page.
	}
endif;
add_action( 'wp_footer', 'unhurried_scroll_styles_noscript', 1 );

if ( ! function_exists( 'unhurried_page_head_names' ) ) :
	/**
	 * Names a post's or a product's head for the page-to-page transition.
	 *
	 * The script assets/js/reveal.js names the photo and title of the card that was
	 * clicked; these name the head they become, so the two morph into each
	 * other (style.css, Continuity). Printed only on those pages: it has to
	 * be in place at the page's first paint.
	 *
	 * @since 1.2.1
	 * @return void
	 */
	function unhurried_page_head_names() {
		$product = function_exists( 'is_product' ) && is_product();
		if ( ! is_singular( 'post' ) && ! $product ) {
			return;
		}
		wp_add_inline_style(
			'unhurried-style',
			'@media (prefers-reduced-motion: no-preference){'
			. '.single main .wp-block-post-featured-image:not(.wp-block-post *) img,.single-product main .woocommerce-product-gallery__image:first-child img.wp-post-image{view-transition-name:uh-photo}'
			. '.single main h1.wp-block-post-title,.single-product main h1:is(.wp-block-post-title,.product_title){view-transition-name:uh-title}'
			. '::view-transition-group(uh-photo),::view-transition-group(uh-title),::view-transition-old(uh-photo),::view-transition-new(uh-photo),::view-transition-old(uh-title),::view-transition-new(uh-title){animation-duration:480ms}}'
		);
	}
endif;
add_action( 'wp_enqueue_scripts', 'unhurried_page_head_names', 20 );

if ( ! function_exists( 'unhurried_touch_button_rest' ) ) :
	/**
	 * Keeps a tapped button at its resting colors on a touch screen.
	 *
	 * WordPress prints the button hover colors of theme.json (and of the Site
	 * Editor) for every device. A touch screen keeps a tapped element in its
	 * hover state until something else is tapped, so a button stayed in its
	 * hover color after the tap (the cart's Apply, for example). Where there
	 * is no hover, the hover state takes the button's resting colors, read
	 * from the same global styles, so a color chosen in the Site Editor is
	 * the one kept. Devices with a pointer keep the hover.
	 *
	 * @since 1.2.1
	 * @return void
	 */
	function unhurried_touch_button_rest() {
		if ( ! function_exists( 'wp_get_global_styles' ) || ! wp_style_is( 'global-styles', 'enqueued' ) ) {
			return;
		}
		$colors     = (array) wp_get_global_styles( array( 'elements', 'button', 'color' ) );
		$rules      = array();
		$properties = array(
			'background' => 'background-color',
			'text'       => 'color',
		);
		foreach ( $properties as $key => $property ) {
			if ( empty( $colors[ $key ] ) || ! is_string( $colors[ $key ] ) ) {
				continue;
			}
			$value = $colors[ $key ];
			// A preset saved by the Site Editor: var:preset|color|contrast.
			if ( 0 === strpos( $value, 'var:' ) ) {
				$value = 'var(--wp--' . str_replace( '|', '--', substr( $value, 4 ) ) . ')';
			}
			if ( preg_match( '/^[a-zA-Z0-9#(),.%\s_-]+$/', $value ) ) {
				$rules[] = $property . ':' . $value;
			}
		}
		if ( $rules ) {
			wp_add_inline_style( 'global-styles', '@media (hover: none){:root :where(.wp-element-button:hover, .wp-block-button__link:hover){' . implode( ';', $rules ) . '}}' );
		}
	}
endif;
add_action( 'wp_enqueue_scripts', 'unhurried_touch_button_rest', 20 );

if ( ! function_exists( 'unhurried_motion_head' ) ) :
	/**
	 * Turns on the automatic motion before the first paint.
	 *
	 * Adds the class "uh-motion" to <html> when the browser can observe
	 * scrolling and the visitor has not asked for reduced motion. The first
	 * screen then rises by CSS alone from the first paint, starting at
	 * opacity .4 (style.css, "1. Entrances"), and assets/js/reveal.js holds
	 * back only what is below the window. Nothing waits on the script, so
	 * the 2.5 second failsafe that used to lift a hidden first screen is
	 * gone: nothing is hidden before the script runs. Filter
	 * unhurried_motion to false to keep pages still (the older Reveal style
	 * keeps working).
	 *
	 * @since 1.2.0
	 * @return void
	 */
	function unhurried_motion_head() {
		/**
		 * Filters whether pages animate as they scroll.
		 *
		 * @since 1.2.0
		 * @param bool $enabled Default true.
		 */
		if ( ! apply_filters( 'unhurried_motion', true ) ) {
			return;
		}
		// A reload or a return through history shows the page as it was left:
		// nothing rises again where the reader already is (1.2.1).
		wp_print_inline_script_tag( "(function(d,w){var h=d.documentElement,p=w.performance,n=p&&p.getEntriesByType&&p.getEntriesByType('navigation')[0];if(!('IntersectionObserver' in w)||w.matchMedia('(prefers-reduced-motion: reduce)').matches||(n&&(n.type==='reload'||n.type==='back_forward'))){return;}h.classList.add('uh-motion');try{if(!d.referrer||new URL(d.referrer).origin!==w.location.origin){h.classList.add('uh-enter');}}catch(e){}})(document,window);" );
	}
endif;
add_action( 'wp_head', 'unhurried_motion_head', 1 );

if ( ! function_exists( 'unhurried_theme_image_file' ) ) :
	/**
	 * The file behind an image address, when it is one of the pictures
	 * bundled with the theme (assets/images/ of this theme or its child).
	 *
	 * The address must lead to this site: a relative one, or one on the
	 * host (and port) of the theme or of the site's home address (the
	 * theme's address follows WordPress's own address unless a plugin
	 * moves it, to a CDN for example). A picture at the
	 * same path on another host (content still pointing at a staging site
	 * or an old domain) is that host's file, not this theme's.
	 *
	 * @since 1.2.0
	 * @param string $src Image address.
	 * @return string Absolute path of the file, or '' for any other image.
	 */
	function unhurried_theme_image_file( $src ) {
		static $folders = null;
		static $hosts   = null;
		static $host_of = null;
		if ( null === $host_of ) {
			// Host and port of an address, lowercased, without a default port; '' when it names no host.
			$host_of = static function ( $url ) {
				$parts = wp_parse_url( (string) $url );
				if ( ! is_array( $parts ) || empty( $parts['host'] ) ) {
					return '';
				}
				$port   = isset( $parts['port'] ) ? (int) $parts['port'] : 0;
				$scheme = isset( $parts['scheme'] ) ? strtolower( (string) $parts['scheme'] ) : '';
				if ( ( 'http' === $scheme && 80 === $port ) || ( 'https' === $scheme && 443 === $port ) ) {
					$port = 0;
				}
				return strtolower( (string) $parts['host'] ) . ( $port ? ':' . $port : '' );
			};
		}
		if ( null === $folders ) {
			$folders = array();
			$hosts   = array( $host_of( home_url() ) );
			$themes  = array(
				get_stylesheet_directory_uri() => get_stylesheet_directory(),
				get_template_directory_uri()   => get_template_directory(),
			);
			foreach ( $themes as $uri => $dir ) {
				$folders[ (string) wp_parse_url( $uri, PHP_URL_PATH ) . '/assets/images/' ] = $dir . '/assets/images/';
				$hosts[] = $host_of( $uri );
			}
			$hosts = array_filter( array_unique( $hosts ) );
		}
		$path = wp_parse_url( (string) $src, PHP_URL_PATH );
		if ( ! is_string( $path ) || false === strpos( $path, '/assets/images/' ) ) {
			return '';
		}
		$host = $host_of( $src );
		if ( '' !== $host && ! in_array( $host, $hosts, true ) ) {
			return '';
		}
		foreach ( $folders as $prefix => $dir ) {
			if ( 0 === strpos( $path, $prefix ) ) {
				$name = substr( $path, strlen( $prefix ) );
				// A file name only: no folders, no "..".
				return ( preg_match( '/^[A-Za-z0-9_-][A-Za-z0-9._-]*$/', $name ) && is_file( $dir . $name ) ) ? $dir . $name : '';
			}
		}
		return '';
	}
endif;

if ( ! function_exists( 'unhurried_theme_image_size' ) ) :
	/**
	 * Gives the pictures bundled with the theme their width and height.
	 *
	 * Patterns show images from the theme's assets/images/ folder. Those are
	 * not in the Media Library, so WordPress cannot add their size, and it
	 * never lazy-loads an image that has none: on a long page every picture
	 * loaded at once, in competition with the first screen. With the size
	 * read from the file, WordPress's own loading rules
	 * (wp_filter_content_tags()) take over; see also
	 * unhurried_theme_image_loading(). The size also keeps the picture's
	 * place before it arrives. It is the file's own size, so nothing changes
	 * on screen.
	 *
	 * It works as a block is shown, so it reaches pages built from the
	 * patterns before this version too (those are copies in the page and
	 * do not change when a pattern file does). Images that already have a
	 * width or height, and every other image, are left as they are.
	 *
	 * @since 1.2.0
	 * @param string $block_content Rendered Image or Cover block.
	 * @return string
	 */
	function unhurried_theme_image_size( $block_content ) {
		if ( false === strpos( (string) $block_content, '/assets/images/' ) || ! class_exists( 'WP_HTML_Tag_Processor' ) ) {
			return $block_content;
		}
		static $sizes = array();
		$tags         = new WP_HTML_Tag_Processor( $block_content );
		while ( $tags->next_tag( 'img' ) ) {
			if ( null !== $tags->get_attribute( 'width' ) || null !== $tags->get_attribute( 'height' ) ) {
				continue;
			}
			$file = unhurried_theme_image_file( (string) $tags->get_attribute( 'src' ) );
			if ( '' === $file ) {
				continue;
			}
			if ( ! array_key_exists( $file, $sizes ) ) {
				$size           = wp_getimagesize( $file );
				$sizes[ $file ] = ( $size && $size[0] > 0 && $size[1] > 0 ) ? array( (int) $size[0], (int) $size[1] ) : null;
			}
			if ( $sizes[ $file ] ) {
				$tags->set_attribute( 'width', (string) $sizes[ $file ][0] );
				$tags->set_attribute( 'height', (string) $sizes[ $file ][1] );
			}
		}
		return $tags->get_updated_html();
	}
endif;
add_filter( 'render_block_core/image', 'unhurried_theme_image_size' );
add_filter( 'render_block_core/cover', 'unhurried_theme_image_size' );

if ( ! function_exists( 'unhurried_mark_theme_photo_cover' ) ) :
	/**
	 * Marks a Cover whose photograph is one of the pictures bundled with the
	 * theme with the class `unhurried-theme-photo`.
	 *
	 * In a dark look assets/css/dark-covers.css keeps the Statement section's
	 * text light over its Ink scrim, and it has to tell that Cover from an
	 * owner's: the class `unhurried-mono` cannot, since the readme invites
	 * owners to add it to any block. Only the theme's patterns show these
	 * photographs (unhurried_theme_image_file() checks the address against
	 * this theme's and its child's assets/images/ folders, read as the page
	 * is shown, and this site's hosts). The class is added as the block is
	 * shown, so copies of the patterns already in pages carry it too; a Cover
	 * whose photograph the owner replaced does not.
	 *
	 * @since 1.2.0
	 * @param string $block_content Rendered Cover block.
	 * @return string
	 */
	function unhurried_mark_theme_photo_cover( $block_content ) {
		if ( false === strpos( (string) $block_content, '/assets/images/' ) || ! class_exists( 'WP_HTML_Tag_Processor' ) ) {
			return $block_content;
		}
		$tags = new WP_HTML_Tag_Processor( $block_content );
		if ( ! $tags->next_tag() || ! $tags->has_class( 'wp-block-cover' ) ) {
			return $block_content;
		}
		$tags->set_bookmark( 'unhurried-cover' );
		// The Cover's own photograph comes first, before or after its shade; a
		// picture further in belongs to the Cover's content.
		$seen = 0;
		while ( $seen < 2 && $tags->next_tag() ) {
			++$seen;
			if ( 'IMG' === $tags->get_tag() && $tags->has_class( 'wp-block-cover__image-background' ) ) {
				if ( '' === unhurried_theme_image_file( (string) $tags->get_attribute( 'src' ) ) ) {
					return $block_content;
				}
				$tags->seek( 'unhurried-cover' );
				$tags->add_class( 'unhurried-theme-photo' );
				return $tags->get_updated_html();
			}
			if ( ! $tags->has_class( 'wp-block-cover__background' ) ) {
				break;
			}
		}
		return $block_content;
	}
endif;
add_filter( 'render_block_core/cover', 'unhurried_mark_theme_photo_cover' );

if ( ! function_exists( 'unhurried_theme_image_loading' ) ) :
	/**
	 * Lets only the first picture of a page's content load at once when the
	 * pictures after it are the theme's own.
	 *
	 * WordPress loads the first three pictures of the content at once,
	 * because any of them might be on the first screen. The theme's patterns
	 * open with one picture (a hero) and the next ones are full-width
	 * section photographs further down: on About, a 254 KB photograph near
	 * the foot of the page loaded in competition with the hero. A bundled
	 * picture that is not the first in the content, and not the one
	 * WordPress gave fetchpriority="high", now waits until it nears the
	 * window. Measured on About (Lighthouse, phone): largest paint
	 * 5.2 s to 2.6 s. Pictures from the Media Library keep WordPress's rule.
	 *
	 * @since 1.2.0
	 * @param array|false $loading_attrs Loading attributes WordPress chose.
	 * @param string      $tag_name      Tag name.
	 * @param array       $attr          The tag's attributes.
	 * @return array|false
	 */
	function unhurried_theme_image_loading( $loading_attrs, $tag_name, $attr ) {
		// Left alone: an image that already has its loading or priority
		// (WordPress looks at the page a second time, as a whole), and
		// everything before the page's priority image has been chosen.
		if ( 'img' !== $tag_name || ! is_array( $loading_attrs ) || isset( $loading_attrs['loading'] ) || isset( $loading_attrs['fetchpriority'] ) || ! empty( $attr['loading'] ) || ! empty( $attr['fetchpriority'] ) || empty( $attr['src'] ) ) {
			return $loading_attrs;
		}
		if ( ! wp_high_priority_element_flag() && wp_increase_content_media_count( 0 ) > 1 && '' !== unhurried_theme_image_file( (string) $attr['src'] ) ) {
			$loading_attrs['loading'] = 'lazy';
		}
		return $loading_attrs;
	}
endif;
add_filter( 'wp_get_loading_optimization_attributes', 'unhurried_theme_image_loading', 10, 3 );

if ( ! function_exists( 'unhurried_hero_image_priority' ) ) :
	/**
	 * Lets the photograph of a hero that a template places load first.
	 *
	 * WordPress gives the first large picture in a page's content
	 * fetchpriority="high" and keeps it from lazy loading, but it leaves
	 * pictures that are part of the template itself to their blocks (the
	 * journal, archive, search and page-not-found heroes since 1.2.0), and
	 * a Cover block decides nothing for a picture it holds. The post pictures
	 * in the grid further down were counted first, so
	 * unhurried_theme_image_loading() then lazy-loaded the hero's photograph,
	 * the largest thing on the first screen. Here the photograph of a theme
	 * hero (a Cover with the class unhurried-hero-photo__stage or
	 * unhurried-hero-statue__stage) shown outside a post's content gets
	 * fetchpriority="high", when nothing on the page has had it yet. In a
	 * post's content WordPress's own rule is left to decide.
	 *
	 * @since 1.2.0
	 * @param string $block_content Rendered Cover block.
	 * @return string
	 */
	function unhurried_hero_image_priority( $block_content ) {
		if ( false === strpos( (string) $block_content, 'unhurried-hero-' ) || doing_filter( 'the_content' ) || ! function_exists( 'wp_high_priority_element_flag' ) || ! wp_high_priority_element_flag() || ! class_exists( 'WP_HTML_Tag_Processor' ) ) {
			return $block_content;
		}
		$tags = new WP_HTML_Tag_Processor( $block_content );
		if ( ! $tags->next_tag() || ! ( $tags->has_class( 'unhurried-hero-photo__stage' ) || $tags->has_class( 'unhurried-hero-statue__stage' ) ) ) {
			return $block_content;
		}
		// The Cover's own photograph comes first, before or after its shade.
		$seen = 0;
		while ( $seen < 2 && $tags->next_tag() ) {
			++$seen;
			if ( 'IMG' === $tags->get_tag() && $tags->has_class( 'wp-block-cover__image-background' ) ) {
				if ( null !== $tags->get_attribute( 'loading' ) || null !== $tags->get_attribute( 'fetchpriority' ) ) {
					return $block_content;
				}
				$tags->set_attribute( 'fetchpriority', 'high' );
				wp_high_priority_element_flag( false );
				return $tags->get_updated_html();
			}
		}
		return $block_content;
	}
endif;
add_filter( 'render_block_core/cover', 'unhurried_hero_image_priority', 11 );

if ( ! function_exists( 'unhurried_theme_image_srcset' ) ) :
	/**
	 * Lets phones load a smaller copy of a bundled Cover photograph.
	 *
	 * A Cover fills its box and crops its picture, so on a phone held upright
	 * the statue hero's photograph is drawn about as wide as 80% of the
	 * screen's height, and on a phone held sideways (or in a short window)
	 * about as wide as the screen: sizes asks for the larger of the two.
	 * Where the theme ships smaller copies beside a picture
	 * (assets/images/david-mono-800.webp and -1200.webp beside david-mono.webp,
	 * each named after that picture and its own width, in its proportions),
	 * the Cover's picture gets a srcset of the copies and the original, with
	 * sizes that send every screen 782px and wider to the original: desktops
	 * load exactly the file they loaded before, and a phone takes the
	 * smallest file that is still as sharp as its screen.
	 *
	 * It works on the tag as the page is shown, after WordPress has set its
	 * loading and sizes (wp_content_img_tag), so pages built from the pattern
	 * before this version get it too and nothing saved changes. Coming after
	 * WordPress also keeps it from adding "auto" to these sizes on a lazy
	 * picture: "auto" would measure the Cover's box, not the cropped photo.
	 *
	 * @since 1.2.0
	 * @param string $image An img tag in the page.
	 * @return string
	 */
	function unhurried_theme_image_srcset( $image ) {
		if ( false === strpos( (string) $image, 'wp-block-cover__image-background' ) || false === strpos( (string) $image, '/assets/images/' ) || false !== strpos( (string) $image, ' srcset=' ) || ! class_exists( 'WP_HTML_Tag_Processor' ) ) {
			return $image;
		}
		$tags = new WP_HTML_Tag_Processor( $image );
		if ( ! $tags->next_tag( 'img' ) || ! $tags->has_class( 'wp-block-cover__image-background' ) ) {
			return $image;
		}
		$src  = (string) $tags->get_attribute( 'src' );
		$file = unhurried_theme_image_file( $src );
		if ( '' === $file ) {
			return $image;
		}
		static $sets = array();
		if ( ! array_key_exists( $file, $sets ) ) {
			$sets[ $file ] = null;
			$size          = wp_getimagesize( $file );
			$info          = pathinfo( $file );
			$copies        = array();
			if ( $size && isset( $info['extension'] ) && (int) $size[0] > 0 && (int) $size[1] > 0 ) {
				$ratio = (int) $size[0] / (int) $size[1];
				foreach ( (array) glob( $info['dirname'] . '/' . $info['filename'] . '-*.' . $info['extension'] ) as $copy ) {
					// A copy is named after the picture it was cut from and its own
					// width (david-mono-800.webp is 800 pixels wide), is narrower and keeps
					// the picture's proportions. Another picture whose name begins the
					// same way is not one of its copies.
					if ( ! preg_match( '/^' . preg_quote( $info['filename'], '/' ) . '-([0-9]+)\.' . preg_quote( $info['extension'], '/' ) . '$/', basename( (string) $copy ), $match ) ) {
						continue;
					}
					$copy_size = wp_getimagesize( $copy );
					if ( ! $copy_size || (int) $copy_size[0] !== (int) $match[1] || (int) $copy_size[0] >= (int) $size[0] || (int) $copy_size[1] <= 0 ) {
						continue;
					}
					if ( abs( (int) $copy_size[0] / (int) $copy_size[1] - $ratio ) <= 0.01 * $ratio ) {
						$copies[ basename( $copy ) ] = (int) $copy_size[0];
					}
				}
			}
			if ( $copies ) {
				asort( $copies );
				$sets[ $file ] = array(
					'copies' => $copies,
					'width'  => (int) $size[0],
				);
			}
		}
		if ( null === $sets[ $file ] ) {
			return $image;
		}
		$url    = strtok( $src, '?#' );
		$folder = substr( $url, 0, strrpos( $url, '/' ) + 1 );
		$srcset = array();
		foreach ( $sets[ $file ]['copies'] as $name => $width ) {
			$srcset[] = esc_url_raw( $folder . $name ) . ' ' . $width . 'w';
		}
		$srcset[] = esc_url_raw( $src ) . ' ' . $sets[ $file ]['width'] . 'w';
		$tags->set_attribute( 'srcset', implode( ', ', $srcset ) );
		$tags->set_attribute( 'sizes', '(max-width: 781px) max(100vw, 80vh), ' . $sets[ $file ]['width'] . 'px' );
		return $tags->get_updated_html();
	}
endif;
add_filter( 'wp_content_img_tag', 'unhurried_theme_image_srcset' );

if ( ! function_exists( 'unhurried_block_styles' ) ) :
	/**
	 * Registers custom block style variations.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	function unhurried_block_styles() {
		register_block_style(
			'core/image',
			array(
				'name'  => 'arch',
				'label' => __( 'Arch', 'unhurried' ),
			)
		);
		register_block_style(
			'core/image',
			array(
				'name'  => 'color',
				'label' => __( 'Keep color', 'unhurried' ),
			)
		);
		foreach ( array( 'core/group', 'core/columns', 'core/column', 'core/image', 'core/heading', 'core/paragraph', 'core/cover', 'core/quote' ) as $unhurried_block ) {
			register_block_style(
				$unhurried_block,
				array(
					'name'  => 'reveal',
					'label' => __( 'Reveal on scroll', 'unhurried' ),
				)
			);
		}
	}
endif;
add_action( 'init', 'unhurried_block_styles' );

if ( ! function_exists( 'unhurried_pattern_categories' ) ) :
	/**
	 * Registers pattern categories.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	function unhurried_pattern_categories() {
		register_block_pattern_category(
			'unhurried_page',
			array(
				'label'       => _x( 'Pages', 'Block pattern category', 'unhurried' ),
				'description' => __( 'Full page layouts.', 'unhurried' ),
			)
		);
		register_block_pattern_category(
			'unhurried_hero',
			array(
				'label'       => _x( 'Heroes', 'Block pattern category', 'unhurried' ),
				'description' => __( 'Opening sections for the top of a page.', 'unhurried' ),
			)
		);
	}
endif;
add_action( 'init', 'unhurried_pattern_categories' );

if ( ! function_exists( 'unhurried_wordmark_em_width' ) ) :
	/**
	 * Estimated width, in em, of a line of text set as the footer wordmark
	 * (Hanken Grotesk 500, letter-spacing -0.06em).
	 *
	 * Widths for printable ASCII were measured from the bundled font. Accented
	 * Latin letters count as their base letter; Æ, Œ, Þ and © as measured in
	 * the font, 3% wide (1.2.0); the other characters of the Latin-1 and Latin
	 * Extended-A blocks as 0.62em, and three-byte characters below U+3000
	 * (’, –, €, ™, Thai, Devanagari and others) as 1em, as in 1.1.2. Letters
	 * of other scripts are drawn in the visitor's own fonts, so they are
	 * counted on the wide side of what Chromium, WebKit and Firefox draw
	 * (1.2.0): Hebrew and Arabic as 0.56em, other two-byte scripts (Greek,
	 * Cyrillic) as 0.8em, emoji and pictographs as 1.25em, Chinese, Japanese,
	 * Korean and the rest from U+3000 as 1.06em. Overestimating only makes the
	 * wordmark a little smaller, never clipped, and assets/js/wordmark.js then
	 * sets a title in another script to its measured width.
	 *
	 * @since 1.1.2
	 * @param string $text Plain text.
	 * @return float
	 */
	function unhurried_wordmark_em_width( $text ) {
		// Hundredths of an em for characters 32 (space) to 126 (~), in order.
		static $ascii = null;
		if ( null === $ascii ) {
			$ascii = array_map(
				'intval',
				explode( ',', '26,24,35,70,56,74,69,18,24,24,40,56,24,33,24,42,56,56,56,56,56,56,56,56,56,56,24,24,56,56,56,52,87,65,60,71,68,58,56,73,68,25,55,64,50,84,68,75,56,78,60,57,59,66,66,96,65,61,59,27,45,27,58,43,30,54,58,52,58,54,34,52,55,23,23,54,27,83,55,58,58,58,41,47,35,55,53,75,53,53,47,25,26,25,56' )
			);
		}
		// Letters remove_accents() spells with two (Æ to AE, Œ to OE, Þ to TH), and ©: em, from the font, plus 3 percent.
		static $known = array(
			"\xC3\x86" => 0.94,
			"\xC5\x92" => 1.04,
			"\xC3\x9E" => 0.65,
			"\xC2\xA9" => 0.85,
		);

		$width = 0.0;
		$count = 0;
		foreach ( preg_split( '//u', $text, -1, PREG_SPLIT_NO_EMPTY ) as $char ) {
			++$count;
			$bytes = strlen( $char );
			if ( 2 === $bytes ) {
				$base  = remove_accents( $char );
				$char  = ( 1 === strlen( $base ) ) ? $base : $char;
				$bytes = strlen( $char );
			}
			if ( 1 === $bytes ) {
				$code   = ord( $char );
				$width += ( $code >= 32 && $code <= 126 ) ? $ascii[ $code - 32 ] / 100 : 0.56;
			} elseif ( 2 === $bytes ) {
				$lead = ord( $char[0] );
				if ( isset( $known[ $char ] ) ) {
					$width += $known[ $char ];
				} elseif ( $lead <= 0xC5 ) {
					// Other characters of the Latin-1 and Latin Extended-A blocks, in the theme's font.
					$width += 0.62;
				} else {
					// Hebrew and Arabic (lead bytes 0xD6 to 0xDB) join or run narrow in the fallback faces.
					$width += ( $lead >= 0xD6 && $lead <= 0xDB ) ? 0.56 : 0.8;
				}
			} elseif ( 4 === $bytes || ( "\xE2\x98\x80" <= $char && $char <= "\xE2\x9E\xBF" ) ) {
				// Emoji, and the symbols and dingbats (U+2600 to U+27BF) that browsers draw as emoji.
				$width += 1.25;
			} else {
				// Chinese, Japanese, Korean and the rest from U+3000; punctuation and signs below it as before.
				$width += ( "\xE3\x80\x80" <= $char ) ? 1.06 : 1.0;
			}
		}
		return max( 0.0, $width - 0.06 * $count );
	}
endif;

if ( ! function_exists( 'unhurried_size_wordmark' ) ) :
	/**
	 * Lets the footer wordmark shrink to fit long site titles.
	 *
	 * Adds --unhurried-wordmark-em (the title's estimated width in em, plus a
	 * small margin) to the wordmark's style attribute; style.css caps the font
	 * size at the column width divided by it. Before 1.1.2 the size was fixed
	 * at 15vw, so a title longer than about twelve characters was cut off.
	 * Since 1.2.0 it also loads assets/js/wordmark.js, which measures the
	 * title as the browser draws it: a title wider than its column is set
	 * smaller, and a title in another script than Latin is set to fill it.
	 *
	 * @since 1.1.2
	 * @param string $block_content Rendered block HTML.
	 * @param array  $block         Parsed block.
	 * @return string
	 */
	function unhurried_size_wordmark( $block_content, $block ) {
		$class = isset( $block['attrs']['className'] ) ? (string) $block['attrs']['className'] : '';
		if ( false === strpos( $class, 'unhurried-wordmark' ) || ! class_exists( 'WP_HTML_Tag_Processor' ) ) {
			return $block_content;
		}
		$text = trim( html_entity_decode( wp_strip_all_tags( $block_content ), ENT_QUOTES, get_bloginfo( 'charset' ) ) );
		if ( '' === $text ) {
			return $block_content;
		}
		// Since 1.2.0 the wordmark is set in capitals (text-transform), so measure those.
		$caps      = function_exists( 'mb_strtoupper' ) ? mb_strtoupper( $text, 'UTF-8' ) : strtoupper( $text );
		$em        = max( 2.5, unhurried_wordmark_em_width( $caps ) * 1.01 + 0.02 );
		$processor = new WP_HTML_Tag_Processor( $block_content );
		if ( ! $processor->next_tag() ) {
			return $block_content;
		}
		$style = trim( (string) $processor->get_attribute( 'style' ) );
		if ( '' !== $style && ';' !== substr( $style, -1 ) ) {
			$style .= ';';
		}
		// A title in another script than Latin, or with an emoji, starts .1em in from its column, as wordmark.js sets
		// it, so a first letter whose ink reaches past its box is not cut before (or without) the script.
		$indent = preg_match( '/[^\p{Latin}\p{Common}\p{Inherited}]|[\x{2600}-\x{27BF}\x{1F000}-\x{1FAFF}]/u', $text ) ? 'text-indent:.1em;' : '';
		$processor->set_attribute( 'style', $style . '--unhurried-wordmark-em:' . number_format( $em, 3, '.', '' ) . ';' . $indent );
		// The title as drawn: keeps it whole in any script (the block renders before the page's scripts print).
		wp_enqueue_script(
			'unhurried-wordmark',
			get_template_directory_uri() . '/assets/js/wordmark.js',
			array(),
			wp_get_theme( get_template() )->get( 'Version' ),
			array(
				'strategy'  => 'defer',
				'in_footer' => true,
			)
		);
		return $processor->get_updated_html();
	}
endif;
add_filter( 'render_block_core/site-title', 'unhurried_size_wordmark', 10, 2 );

if ( ! function_exists( 'unhurried_split_title_letters' ) ) :
	/**
	 * Splits a rendered site title into one span per letter, the markup the
	 * footer wordmark's roll uses: the letters hidden from assistive technology,
	 * the whole title repeated in a visually hidden span. Marks, joiners,
	 * right-to-left scripts and emoji skin tones leave the title whole.
	 *
	 * Shared by the footer wordmark and, since 1.2.1, the header title.
	 *
	 * @since 1.2.1
	 * @param string $block_content Rendered site title HTML.
	 * @return string
	 */
	function unhurried_split_title_letters( $block_content ) {
		$split = static function ( $inner ) {
			$text = trim( html_entity_decode( wp_strip_all_tags( $inner ), ENT_QUOTES, get_bloginfo( 'charset' ) ) );
			// Marks, joiners, right-to-left scripts and emoji skin tones stay whole.
			if ( '' === $text || preg_match( '/[\p{M}\x{200C}\x{200D}\x{0590}-\x{08FF}\x{FB1D}-\x{FDFF}\x{FE70}-\x{FEFF}\x{10800}-\x{10FFF}\x{1E800}-\x{1EFFF}\x{1F3FB}-\x{1F3FF}]/u', $text ) ) {
				return $inner;
			}
			$letters = '';
			foreach ( preg_split( '//u', $text, -1, PREG_SPLIT_NO_EMPTY ) as $i => $char ) {
				$letters .= '<span style="--i:' . (int) $i . '">' . ( ' ' === $char ? '&nbsp;' : esc_html( $char ) ) . '</span>';
			}
			// Accents, descenders and other scripts reach past a capital's height.
			$classes = preg_match( '/[^\x20-\x7E]/', $text ) ? 'unhurried-wordmark__letters unhurried-wordmark__letters--tall' : 'unhurried-wordmark__letters';
			return '<span class="' . $classes . '" aria-hidden="true">' . $letters . '</span><span class="unhurried-visually-hidden">' . esc_html( $text ) . '</span>';
		};
		// Linked title: split the link text. Unlinked: split the element's text.
		$out = preg_replace_callback(
			'#(<a\b[^>]*>)(.*?)(</a>)#s',
			static function ( $m ) use ( $split ) {
				return $m[1] . $split( $m[2] ) . $m[3];
			},
			$block_content,
			1,
			$count
		);
		if ( ! $count ) {
			$out = preg_replace_callback(
				'#^(\s*<[a-z0-9]+\b[^>]*>)(.*)(</[a-z0-9]+>\s*)$#s',
				static function ( $m ) use ( $split ) {
					return $m[1] . $split( $m[2] ) . $m[3];
				},
				$block_content,
				1
			);
		}
		return is_string( $out ) ? $out : $block_content;
	}
endif;

if ( ! function_exists( 'unhurried_wordmark_letters' ) ) :
	/**
	 * Splits the footer wordmark into one span per letter for the hover roll.
	 *
	 * The letters are hidden from assistive technology and the whole title is
	 * repeated in a visually hidden span, so screen readers still hear one word.
	 *
	 * Each letter becomes a box of its own, so the title is left whole, as in
	 * 1.1.1, where boxes would misread it: on a right-to-left site the boxes
	 * line up from the right (a Latin title read backwards), and letters that
	 * join or carry separate marks (Arabic, Hebrew, the Indic scripts, an
	 * accent typed apart, an emoji sequence) would come apart.
	 *
	 * A title with a letter outside plain ASCII (an accented capital, the
	 * Cyrillic Д, Greek, Chinese, Japanese, an emoji) gets the modifier class
	 * unhurried-wordmark__letters--tall: its letters reach above or below a
	 * capital, so style.css gives them a taller window and a longer roll.
	 *
	 * @since 1.2.0
	 * @param string $block_content Rendered block HTML.
	 * @param array  $block         Parsed block.
	 * @return string
	 */
	function unhurried_wordmark_letters( $block_content, $block ) {
		$class = isset( $block['attrs']['className'] ) ? (string) $block['attrs']['className'] : '';
		if ( false === strpos( $class, 'unhurried-wordmark' ) || false !== strpos( $block_content, 'unhurried-wordmark__letters' ) || is_rtl() ) {
			return $block_content;
		}
		return unhurried_split_title_letters( $block_content );
	}
endif;
add_filter( 'render_block_core/site-title', 'unhurried_wordmark_letters', 11, 2 );

if ( ! function_exists( 'unhurried_header_title_letters' ) ) :
	/**
	 * Splits the header title into letters for its hover roll (style.css,
	 * "Header title").
	 *
	 * The title is found inside the header capsule (the group with the class
	 * unhurried-capsule) once the capsule has rendered, so it works in the
	 * theme's headers, the header patterns and a header saved in the Site
	 * Editor alike, whatever the title says and with or without the logo.
	 * Right-to-left sites keep the title whole, as the wordmark does.
	 *
	 * @since 1.2.1
	 * @param string $block_content Rendered group HTML.
	 * @param array  $block         Parsed block.
	 * @return string
	 */
	function unhurried_header_title_letters( $block_content, $block ) {
		$class = isset( $block['attrs']['className'] ) ? (string) $block['attrs']['className'] : '';
		if ( false === strpos( $class, 'unhurried-capsule' ) || false === strpos( $block_content, 'wp-block-site-title' ) || is_rtl() ) {
			return $block_content;
		}
		$out = preg_replace_callback(
			'#<(p|h[1-6])\b[^>]*\bclass="[^"]*\bwp-block-site-title\b[^"]*"[^>]*>.*?</\1>#s',
			static function ( $m ) {
				return false !== strpos( $m[0], 'unhurried-wordmark__letters' ) ? $m[0] : unhurried_split_title_letters( $m[0] );
			},
			$block_content,
			1
		);
		return is_string( $out ) ? $out : $block_content;
	}
endif;
add_filter( 'render_block_core/group', 'unhurried_header_title_letters', 10, 2 );

if ( ! function_exists( 'unhurried_marquee_loop' ) ) :
	/**
	 * Doubles the Marquee's lines so the drift can loop without a gap.
	 *
	 * The copy is hidden from assistive technology and its links leave the
	 * tab order, so the lines are read and focused once.
	 *
	 * @since 1.2.0
	 * @param string $block_content Rendered block HTML.
	 * @param array  $block         Parsed block.
	 * @return string
	 */
	function unhurried_marquee_loop( $block_content, $block ) {
		$class = isset( $block['attrs']['className'] ) ? (string) $block['attrs']['className'] : '';
		if ( false === strpos( $class, 'unhurried-marquee' ) || ! class_exists( 'WP_HTML_Tag_Processor' ) ) {
			return $block_content;
		}
		$open  = strpos( $block_content, '>' );
		$close = strrpos( $block_content, '</div>' );
		if ( false === $open || false === $close || $close <= $open ) {
			return $block_content;
		}
		$inner = substr( $block_content, $open + 1, $close - $open - 1 );
		if ( '' === trim( $inner ) ) {
			return '';
		}
		$copy = new WP_HTML_Tag_Processor( $inner );
		while ( $copy->next_tag( 'a' ) ) {
			$copy->set_attribute( 'tabindex', '-1' );
		}
		return substr( $block_content, 0, $open + 1 )
			. '<div class="unhurried-marquee__window"><div class="unhurried-marquee__track"><div class="unhurried-marquee__set">' . $inner . '</div>'
			. '<div class="unhurried-marquee__set" aria-hidden="true">' . $copy->get_updated_html() . '</div></div></div>'
			// A pause control (1.2.1): the line moves for good, so it can be
			// stopped (WCAG 2.2.2). Shown by assets/js/reveal.js, which runs it.
			. '<button type="button" class="unhurried-marquee__pause" aria-pressed="false" hidden><span class="unhurried-visually-hidden">' . esc_html__( 'Pause the moving line', 'unhurried' ) . '</span></button>'
			. substr( $block_content, $close );
	}
endif;
add_filter( 'render_block_core/group', 'unhurried_marquee_loop', 10, 2 );

if ( ! function_exists( 'unhurried_newsletter_form' ) ) :
	/**
	 * Block markup for an email signup form, taken from a newsletter plugin.
	 *
	 * A theme may not collect addresses itself, so the form comes from a
	 * plugin. Supported without setup:
	 * - Newsletter (https://wordpress.org/plugins/newsletter/): free, GPL and
	 *   self-hosted, no outside account. Its minimal form: an email field and a button.
	 * - Jetpack: its Subscribe block.
	 * Any other plugin can supply block markup through the
	 * unhurried_newsletter_block filter. Returns '' when there is no form.
	 *
	 * @since 1.2.0
	 * @return string
	 */
	function unhurried_newsletter_form() {
		$markup = '';
		// Detect the plugin, not its shortcode: Newsletter registers the
		// shortcode only on the front end, and the Site Editor must get the
		// same markup, or saving the footer there would drop the form.
		if ( defined( 'NEWSLETTER_VERSION' ) || class_exists( 'Newsletter' ) ) {
			$markup = "<!-- wp:shortcode -->\n[newsletter_form type=\"minimal\" button_label=\"" . esc_attr__( 'Subscribe', 'unhurried' ) . "\"]\n<!-- /wp:shortcode -->";
		} elseif ( WP_Block_Type_Registry::get_instance()->is_registered( 'jetpack/subscriptions' ) ) {
			$markup = '<!-- wp:jetpack/subscriptions /-->';
		}
		/**
		 * Filters the newsletter signup form the theme prints, as block markup.
		 *
		 * @since 1.2.0
		 * @param string $markup Block markup, or '' for none (the theme then offers the RSS feed).
		 */
		return (string) apply_filters( 'unhurried_newsletter_block', $markup );
	}
endif;

if ( ! function_exists( 'unhurried_contact_form' ) ) :
	/**
	 * Block markup for a contact form, taken from a form plugin.
	 *
	 * Supported without setup: Contact Form 7 and WPForms (each adds a first
	 * form when it is activated; the oldest form is used). Any other plugin
	 * can supply block markup through the unhurried_contact_form_block filter.
	 * Returns '' when there is no form.
	 *
	 * @since 1.2.0
	 * @return string
	 */
	function unhurried_contact_form() {
		$markup = '';
		// Detected by plugin, not shortcode, so the editor gets the same markup.
		$plugins = array(
			'contact-form-7' => array( 'wpcf7_contact_form', defined( 'WPCF7_VERSION' ) ),
			'wpforms'        => array( 'wpforms', defined( 'WPFORMS_VERSION' ) || function_exists( 'wpforms' ) ),
		);
		foreach ( $plugins as $shortcode => $plugin ) {
			list( $post_type, $active ) = $plugin;
			if ( ! $active ) {
				continue;
			}
			$form = get_posts(
				array(
					'post_type'   => $post_type,
					'post_status' => 'publish',
					'numberposts' => 1,
					'orderby'     => 'ID',
					'order'       => 'ASC',
					'fields'      => 'ids',
				)
			);
			if ( $form ) {
				$markup = "<!-- wp:shortcode -->\n[" . $shortcode . ' id="' . (int) $form[0] . "\"]\n<!-- /wp:shortcode -->";
				break;
			}
		}
		/**
		 * Filters the contact form the Contact pattern prints, as block markup.
		 *
		 * @since 1.2.0
		 * @param string $markup Block markup, or '' for none (the pattern then shows an Email us button).
		 */
		return (string) apply_filters( 'unhurried_contact_form_block', $markup );
	}
endif;

if ( ! function_exists( 'unhurried_render_newsletter_shortcode' ) ) :
	/**
	 * Runs the form shortcodes the theme places (Newsletter, Contact Form 7,
	 * WPForms) inside templates.
	 *
	 * A template part runs shortcodes before it renders the patterns inside
	 * it, so the footer's [newsletter_form] would print as text. This renders
	 * those shortcodes, and only while they are still unrendered.
	 *
	 * @since 1.2.0
	 * @param string $block_content Rendered block HTML.
	 * @return string
	 */
	function unhurried_render_newsletter_shortcode( $block_content ) {
		$pending = false;
		foreach ( array( 'newsletter_form', 'contact-form-7', 'wpforms' ) as $tag ) {
			if ( false !== strpos( $block_content, '[' . $tag ) && shortcode_exists( $tag ) ) {
				$pending = true;
			}
		}
		if ( ! $pending ) {
			return $block_content;
		}
		$html = do_shortcode( shortcode_unautop( $block_content ) );
		// The minimal form's email field has only a placeholder; give it a name.
		if ( class_exists( 'WP_HTML_Tag_Processor' ) ) {
			$form  = new WP_HTML_Tag_Processor( $html );
			$email = array(
				'tag_name'   => 'input',
				'class_name' => 'tnp-email',
			);
			while ( $form->next_tag( $email ) ) {
				if ( null === $form->get_attribute( 'aria-label' ) ) {
					$form->set_attribute( 'aria-label', __( 'Email address', 'unhurried' ) );
				}
			}
			$html = $form->get_updated_html();
		}
		return $html;
	}
endif;
add_filter( 'render_block_core/shortcode', 'unhurried_render_newsletter_shortcode' );

if ( ! function_exists( 'unhurried_child_pages_query' ) ) :
	/**
	 * Query Loops marked "unhurriedChildren" list the pages under the page
	 * being viewed, in their menu order: Services lists its groups, and a
	 * group lists its services (/services/design/identity/).
	 *
	 * @since 1.2.0
	 * @param array    $query Query vars.
	 * @param WP_Block $block The Post Template block.
	 * @return array
	 */
	function unhurried_child_pages_query( $query, $block ) {
		if ( empty( $block->context['query']['unhurriedChildren'] ) ) {
			return $query;
		}
		$query['post_type']       = 'page';
		$query['post_parent__in'] = array( is_singular( 'page' ) ? (int) get_queried_object_id() : -1 );
		$query['orderby']         = array(
			'menu_order' => 'ASC',
			'title'      => 'ASC',
		);
		return $query;
	}
endif;
add_filter( 'query_loop_block_query_vars', 'unhurried_child_pages_query', 10, 2 );

if ( ! function_exists( 'unhurried_hide_empty_child_pages' ) ) :
	/**
	 * Drops the "pages under this page" section, heading and all, on a page
	 * that has none yet.
	 *
	 * @since 1.2.0
	 * @param string $content Rendered block.
	 * @param array  $block   Parsed block.
	 * @return string
	 */
	function unhurried_hide_empty_child_pages( $content, $block ) {
		if ( empty( $block['attrs']['query']['unhurriedChildren'] ) ) {
			return $content;
		}
		if ( ! is_singular( 'page' ) ) {
			return '';
		}
		$children = get_pages(
			array(
				'parent' => (int) get_queried_object_id(),
				'number' => 1,
			)
		);
		return $children ? $content : '';
	}
endif;
add_filter( 'render_block_core/query', 'unhurried_hide_empty_child_pages', 10, 2 );

if ( ! function_exists( 'unhurried_hide_placeholder_social' ) ) :
	/**
	 * Keeps social icons that still point at "#" out of the public footer.
	 *
	 * The footer ships with placeholder profiles. People who can edit the site
	 * see them as a reminder to add real links; visitors see only icons that
	 * lead somewhere. The Playground demo defines UNHURRIED_DEMO to show all.
	 *
	 * @since 1.2.0
	 * @param string $block_content Rendered block HTML.
	 * @param array  $block         Parsed block.
	 * @return string
	 */
	function unhurried_hide_placeholder_social( $block_content, $block ) {
		$url = isset( $block['attrs']['url'] ) ? trim( (string) $block['attrs']['url'] ) : '';
		if ( '#' !== $url || ( defined( 'UNHURRIED_DEMO' ) && UNHURRIED_DEMO ) || current_user_can( 'edit_theme_options' ) ) {
			return $block_content;
		}
		return '';
	}
endif;
add_filter( 'render_block_core/social-link', 'unhurried_hide_placeholder_social', 10, 2 );

if ( ! function_exists( 'unhurried_drop_empty_social' ) ) :
	/**
	 * Prints nothing for a Social Icons block whose icons were all hidden.
	 *
	 * @since 1.2.0
	 * @param string $block_content Rendered block HTML.
	 * @return string
	 */
	function unhurried_drop_empty_social( $block_content ) {
		return ( false === strpos( $block_content, '<li' ) ) ? '' : $block_content;
	}
endif;
add_filter( 'render_block_core/social-links', 'unhurried_drop_empty_social' );

if ( ! function_exists( 'unhurried_hide_front_page_head' ) ) :
	/**
	 * Drops the title band of the default Pages template on a static front page.
	 *
	 * The homepage almost always opens with its own hero, so the page title
	 * ("Home") printed at the huge size above it is a second, unwanted heading.
	 * Only the band marked unhurried-page-head in templates/page.html is
	 * removed; a template edited before 1.1.2 lacks the class and is left alone.
	 * Child themes can keep the band with:
	 * add_filter( 'unhurried_hide_front_page_title', '__return_false' );
	 *
	 * @since 1.1.2
	 * @param string $block_content Rendered block HTML.
	 * @param array  $block         Parsed block.
	 * @return string
	 */
	function unhurried_hide_front_page_head( $block_content, $block ) {
		$class = isset( $block['attrs']['className'] ) ? (string) $block['attrs']['className'] : '';
		if ( false === strpos( $class, 'unhurried-page-head' ) ) {
			return $block_content;
		}
		if ( ! is_front_page() || ! is_page() ) {
			return $block_content;
		}
		/**
		 * Filters whether a static front page drops the title band of the default Pages template.
		 *
		 * @since 1.1.2
		 * @param bool $hide Default true. Return false to keep the band.
		 */
		if ( apply_filters( 'unhurried_hide_front_page_title', true ) ) {
			return '';
		}
		return $block_content;
	}
endif;
add_filter( 'render_block_core/group', 'unhurried_hide_front_page_head', 10, 2 );

if ( ! function_exists( 'unhurried_mark_contact_link' ) ) :
	/**
	 * Tags the menu item that links to the Contact page with `unhurried-nav-contact`.
	 *
	 * When the header's button links there too (unhurried_mark_contact_button()),
	 * style.css hides that item in the header capsule, and keeps it in the open
	 * mobile menu. A button that goes anywhere else leaves the menu as it is.
	 *
	 * @since 1.2.0
	 * @param string $block_content Rendered navigation block.
	 * @return string
	 */
	function unhurried_mark_contact_link( $block_content ) {
		static $contact_url = null;
		if ( null === $contact_url ) {
			$contact_url = untrailingslashit( (string) unhurried_page_link( 'contact', '' ) );
		}
		if ( '' === $contact_url || ! class_exists( 'WP_HTML_Tag_Processor' ) ) {
			return $block_content;
		}
		$tags   = new WP_HTML_Tag_Processor( $block_content );
		$in_li  = false;
		$marked = false;
		while ( $tags->next_tag() ) {
			if ( 'LI' === $tags->get_tag() ) {
				$tags->set_bookmark( 'unhurried-li' );
				$in_li = true;
				continue;
			}
			if ( $in_li && 'A' === $tags->get_tag() && untrailingslashit( (string) $tags->get_attribute( 'href' ) ) === $contact_url ) {
				$in_li  = false;
				$marked = true;
				$tags->seek( 'unhurried-li' );
				$tags->add_class( 'unhurried-nav-contact' );
			}
		}
		return $marked ? $tags->get_updated_html() : $block_content;
	}
endif;
add_filter( 'render_block_core/navigation', 'unhurried_mark_contact_link' );

if ( ! function_exists( 'unhurried_mark_contact_button' ) ) :
	/**
	 * Tags a button that links to the Contact page with `unhurried-button-contact`.
	 *
	 * The menu's own Contact item is hidden beside the header button (style.css)
	 * only when that button is the one that goes to Contact. The header button
	 * pattern points it there; an owner may point it at a booking site or any
	 * other page instead, and then keeps every menu link they made.
	 *
	 * @since 1.2.0
	 * @param string $block_content Rendered button block.
	 * @return string
	 */
	function unhurried_mark_contact_button( $block_content ) {
		static $contact_url = null;
		if ( null === $contact_url ) {
			$contact_url = untrailingslashit( (string) unhurried_page_link( 'contact', '' ) );
		}
		if ( '' === $contact_url || ! class_exists( 'WP_HTML_Tag_Processor' ) ) {
			return $block_content;
		}
		$tags = new WP_HTML_Tag_Processor( $block_content );
		while ( $tags->next_tag( 'a' ) ) {
			if ( $tags->has_class( 'wp-block-button__link' ) && untrailingslashit( (string) $tags->get_attribute( 'href' ) ) === $contact_url ) {
				$tags->add_class( 'unhurried-button-contact' );
				return $tags->get_updated_html();
			}
		}
		return $block_content;
	}
endif;
add_filter( 'render_block_core/button', 'unhurried_mark_contact_button' );

if ( ! function_exists( 'unhurried_is_page_list_only' ) ) :
	/**
	 * Whether block markup is nothing but one Page List block, as it comes.
	 *
	 * That is the menu WordPress makes by itself when a site has none: it
	 * prints every published page. A menu with anything else in it, a Page
	 * List among other links included, is one somebody made. So is a lone
	 * Page List with a setting of its own (a parent page, say): WordPress
	 * never saves one like that. A lone Page List without settings is
	 * exactly what WordPress saves, so the two cannot be told apart and it
	 * counts as the automatic menu.
	 *
	 * @since 1.2.0
	 * @param string $content Block markup, e.g. the content of a menu.
	 * @return bool
	 */
	function unhurried_is_page_list_only( $content ) {
		$blocks = array();
		foreach ( parse_blocks( (string) $content ) as $block ) {
			if ( null !== $block['blockName'] || '' !== trim( (string) $block['innerHTML'] ) ) {
				$blocks[] = $block;
			}
		}
		return 1 === count( $blocks ) && 'core/page-list' === $blocks[0]['blockName'] && empty( $blocks[0]['attrs'] );
	}
endif;

if ( ! function_exists( 'unhurried_navigation_is_automatic' ) ) :
	/**
	 * Whether a Navigation block is about to show the automatic page list
	 * and not a menu somebody made.
	 *
	 * The block shows, in this order: the blocks written inside it, the menu
	 * it names, or the newest menu of the site. With no menu at all WordPress
	 * falls back to a lone Page List (and saves it as a menu named
	 * "Navigation").
	 *
	 * @since 1.2.0
	 * @param array $parsed_block The Navigation block about to render.
	 * @return bool
	 */
	function unhurried_navigation_is_automatic( $parsed_block ) {
		if ( ! empty( $parsed_block['innerBlocks'] ) ) {
			return 1 === count( $parsed_block['innerBlocks'] ) && 'core/page-list' === $parsed_block['innerBlocks'][0]['blockName'] && empty( $parsed_block['innerBlocks'][0]['attrs'] );
		}
		if ( ! empty( $parsed_block['attrs']['ref'] ) ) {
			$menu = get_post( (int) $parsed_block['attrs']['ref'] );
			return $menu instanceof WP_Post && 'wp_navigation' === $menu->post_type && unhurried_is_page_list_only( $menu->post_content );
		}
		$newest = get_posts(
			array(
				'post_type'   => 'wp_navigation',
				'post_status' => 'publish',
				'numberposts' => 1,
				'orderby'     => 'date',
				'order'       => 'DESC',
			)
		);
		return ! $newest || unhurried_is_page_list_only( $newest[0]->post_content );
	}
endif;

if ( ! function_exists( 'unhurried_page_header_part' ) ) :
	/**
	 * The header template part of the page being rendered, as "theme//slug".
	 *
	 * Noted by unhurried_page_list_scope() as the first header part starts
	 * to render. Empty when no header part has rendered (yet).
	 *
	 * @since 1.2.0
	 * @param string|null $set Template part ID to remember; the first one stays.
	 * @return string
	 */
	function unhurried_page_header_part( $set = null ) {
		static $part = '';
		if ( null !== $set && '' === $part ) {
			$part = (string) $set;
		}
		return $part;
	}
endif;

if ( ! function_exists( 'unhurried_page_list_exclude' ) ) :
	/**
	 * Pages kept out of the automatic page list.
	 *
	 * Until a site has a menu of its own, the Navigation block prints every
	 * published page, and with WooCommerce that includes its Checkout, Cart
	 * and My account pages. Checkout is a step, not a place to go, so it is
	 * always left out. Cart and My account are left out only when the header
	 * of the page being shown carries WooCommerce's cart and account icons,
	 * which lead to the same pages. Without the icons, or when the header is
	 * not known, the two links stay, as the only way there.
	 *
	 * The header is read as the site has it now (a header edited in the Site
	 * Editor included), and it is the header part this page really uses, so
	 * a template with another header part is judged by that part.
	 *
	 * @since 1.2.0
	 * @return int[] Page IDs.
	 */
	function unhurried_page_list_exclude() {
		$exclude = array();
		if ( function_exists( 'wc_get_page_id' ) ) {
			$part      = unhurried_page_header_part();
			$header    = '' !== $part ? get_block_template( $part, 'wp_template_part' ) : null;
			$markup    = $header ? (string) $header->content : '';
			$exclude[] = (int) wc_get_page_id( 'checkout' );
			if ( false !== strpos( $markup, 'wp:woocommerce/mini-cart' ) ) {
				$exclude[] = (int) wc_get_page_id( 'cart' );
			}
			if ( false !== strpos( $markup, 'wp:woocommerce/customer-account' ) ) {
				$exclude[] = (int) wc_get_page_id( 'myaccount' );
			}
		}
		/**
		 * Filters the pages kept out of the automatic page list.
		 *
		 * @since 1.2.0
		 * @param int[] $exclude Page IDs. Return an empty array to list every page.
		 */
		$exclude = (array) apply_filters( 'unhurried_page_list_exclude', $exclude );
		return array_values( array_filter( array_map( 'intval', $exclude ) ) );
	}
endif;

if ( ! function_exists( 'unhurried_page_list_pages' ) ) :
	/**
	 * Drops the pages named by unhurried_page_list_exclude() from a list of pages.
	 *
	 * @since 1.2.0
	 * @param WP_Post[] $pages Pages.
	 * @return WP_Post[]
	 */
	function unhurried_page_list_pages( $pages ) {
		$exclude = unhurried_page_list_exclude();
		if ( ! $exclude || ! is_array( $pages ) ) {
			return $pages;
		}
		$kept = array();
		foreach ( $pages as $page ) {
			if ( ! in_array( (int) $page->ID, $exclude, true ) ) {
				$kept[] = $page;
			}
		}
		return $kept;
	}
endif;

if ( ! function_exists( 'unhurried_page_list_scope' ) ) :
	/**
	 * Applies unhurried_page_list_pages() while a Navigation block renders
	 * the automatic page list, and only then.
	 *
	 * A menu somebody made is never filtered, whatever it holds (see
	 * unhurried_navigation_is_automatic()). The filter goes on as the block
	 * starts and comes off when it has rendered (unhurried_page_list_unscope()),
	 * so no other list of pages is touched. The Navigation block renders its
	 * Page List itself, which is why the scope is the menu and not the list
	 * inside it. Also notes which header part the page uses, for
	 * unhurried_page_list_exclude().
	 *
	 * @since 1.2.0
	 * @param array $parsed_block The block about to render.
	 * @return array
	 */
	function unhurried_page_list_scope( $parsed_block ) {
		$name  = isset( $parsed_block['blockName'] ) ? $parsed_block['blockName'] : '';
		$attrs = isset( $parsed_block['attrs'] ) && is_array( $parsed_block['attrs'] ) ? $parsed_block['attrs'] : array();
		if ( 'core/template-part' === $name && ! empty( $attrs['slug'] ) && '' === unhurried_page_header_part() && 'header' === unhurried_template_part_area( $attrs ) ) {
			unhurried_page_header_part( ( ! empty( $attrs['theme'] ) ? $attrs['theme'] : get_stylesheet() ) . '//' . $attrs['slug'] );
		}
		if ( 'core/navigation' === $name && unhurried_navigation_is_automatic( $parsed_block ) ) {
			add_filter( 'get_pages', 'unhurried_page_list_pages' );
		}
		return $parsed_block;
	}
endif;
add_filter( 'render_block_data', 'unhurried_page_list_scope' );

if ( ! function_exists( 'unhurried_page_list_unscope' ) ) :
	/**
	 * Takes the page list filter off again once the Navigation block has rendered.
	 *
	 * @since 1.2.0
	 * @param string $block_content Rendered block HTML.
	 * @return string
	 */
	function unhurried_page_list_unscope( $block_content ) {
		remove_filter( 'get_pages', 'unhurried_page_list_pages' );
		return $block_content;
	}
endif;
add_filter( 'render_block_core/navigation', 'unhurried_page_list_unscope' );

if ( ! function_exists( 'unhurried_template_part_area' ) ) :
	/**
	 * The area of a Template Part block: the one it states, the one its tag
	 * implies, or, when the block says neither (as some of WooCommerce's
	 * templates do), the area of the part it names.
	 *
	 * @since 1.2.0
	 * @param array $attrs Attributes of a Template Part block.
	 * @return string 'header', 'footer', another area, or ''.
	 */
	function unhurried_template_part_area( $attrs ) {
		if ( ! empty( $attrs['area'] ) ) {
			return (string) $attrs['area'];
		}
		if ( ! empty( $attrs['tagName'] ) && in_array( $attrs['tagName'], array( 'header', 'footer' ), true ) ) {
			return (string) $attrs['tagName'];
		}
		if ( empty( $attrs['slug'] ) ) {
			return '';
		}
		$part = get_block_template( ( ! empty( $attrs['theme'] ) ? $attrs['theme'] : get_stylesheet() ) . '//' . $attrs['slug'], 'wp_template_part' );
		return ( $part && ! empty( $part->area ) ) ? (string) $part->area : '';
	}
endif;

if ( ! function_exists( 'unhurried_part_area' ) ) :
	/**
	 * The area ("header", "footer"…) of the template part being rendered
	 * right now, or '' outside any part.
	 *
	 * @since 1.2.0
	 * @param string|null $change 'enter' or 'leave' as a part starts or ends; null to read.
	 * @param string      $area   The area being entered.
	 * @return string
	 */
	function unhurried_part_area( $change = null, $area = '' ) {
		static $areas = array();
		if ( 'enter' === $change ) {
			$areas[] = (string) $area;
		} elseif ( 'leave' === $change ) {
			array_pop( $areas );
		}
		return $areas ? (string) end( $areas ) : '';
	}
endif;

if ( ! function_exists( 'unhurried_enter_part' ) ) :
	/**
	 * Notes the area of a template part as it starts to render.
	 *
	 * @since 1.2.0
	 * @param array $parsed_block The block about to render.
	 * @return array
	 */
	function unhurried_enter_part( $parsed_block ) {
		if ( isset( $parsed_block['blockName'] ) && 'core/template-part' === $parsed_block['blockName'] ) {
			$attrs = isset( $parsed_block['attrs'] ) && is_array( $parsed_block['attrs'] ) ? $parsed_block['attrs'] : array();
			unhurried_part_area( 'enter', unhurried_template_part_area( $attrs ) );
		}
		return $parsed_block;
	}
endif;
add_filter( 'render_block_data', 'unhurried_enter_part' );

if ( ! function_exists( 'unhurried_leave_part' ) ) :
	/**
	 * Forgets the template part once it has rendered.
	 *
	 * @since 1.2.0
	 * @param string $block_content Rendered block HTML.
	 * @return string
	 */
	function unhurried_leave_part( $block_content ) {
		unhurried_part_area( 'leave' );
		return $block_content;
	}
endif;
add_filter( 'render_block_core/template-part', 'unhurried_leave_part' );

if ( ! function_exists( 'unhurried_label_navigation' ) ) :
	/**
	 * Names the menus in the header and the footer for screen readers.
	 *
	 * A Navigation block takes its label from the menu it names. The theme's
	 * header and footer name none, so the header's menu had no label and the
	 * footer's was labeled " 2". They become "Main" and "Footer" (a screen
	 * reader adds "navigation" itself). A menu that has a label keeps it.
	 *
	 * @since 1.2.0
	 * @param string $block_content Rendered navigation block.
	 * @return string
	 */
	function unhurried_label_navigation( $block_content ) {
		$area = unhurried_part_area();
		if ( ( 'header' !== $area && 'footer' !== $area ) || ! class_exists( 'WP_HTML_Tag_Processor' ) ) {
			return $block_content;
		}
		$tags = new WP_HTML_Tag_Processor( $block_content );
		if ( ! $tags->next_tag( 'nav' ) ) {
			return $block_content;
		}
		$label = trim( (string) $tags->get_attribute( 'aria-label' ) );
		if ( '' !== $label && ! ctype_digit( $label ) ) {
			return $block_content;
		}
		// A second unnamed menu in the same area is numbered, as WordPress numbers its own.
		static $seen   = array();
		$seen[ $area ] = isset( $seen[ $area ] ) ? $seen[ $area ] + 1 : 1;
		$label         = 'header' === $area ? _x( 'Main', 'Label of the header menu for screen readers', 'unhurried' ) : _x( 'Footer', 'Label of the footer menu for screen readers', 'unhurried' );
		$tags->set_attribute( 'aria-label', $seen[ $area ] > 1 ? $label . ' ' . $seen[ $area ] : $label );
		return $tags->get_updated_html();
	}
endif;
add_filter( 'render_block_core/navigation', 'unhurried_label_navigation' );

if ( ! function_exists( 'unhurried_label_search' ) ) :
	/**
	 * Names each search form for screen readers.
	 *
	 * A Search block is a search landmark without a name of its own, so two
	 * on a page (the journal's and the footer's) could not be told apart. The
	 * form takes the block's own words: its placeholder when that says more
	 * than its label ("Search the site" in the footer, whose label is
	 * "Search"), else its label ("Search the journal"), else "Search".
	 *
	 * @since 1.2.0
	 * @param string $block_content Rendered search block.
	 * @param array  $block         Parsed block.
	 * @return string
	 */
	function unhurried_label_search( $block_content, $block ) {
		if ( ! class_exists( 'WP_HTML_Tag_Processor' ) ) {
			return $block_content;
		}
		$tags = new WP_HTML_Tag_Processor( $block_content );
		if ( ! $tags->next_tag( 'form' ) || 'search' !== $tags->get_attribute( 'role' ) || null !== $tags->get_attribute( 'aria-label' ) || null !== $tags->get_attribute( 'aria-labelledby' ) ) {
			return $block_content;
		}
		$label = isset( $block['attrs']['label'] ) ? trim( wp_strip_all_tags( (string) $block['attrs']['label'] ) ) : '';
		$hint  = isset( $block['attrs']['placeholder'] ) ? trim( wp_strip_all_tags( (string) $block['attrs']['placeholder'] ), " \t\n\r\0\x0B.…" ) : '';
		if ( strlen( $hint ) > strlen( $label ) ) {
			$label = $hint;
		}
		if ( '' === $label ) {
			$label = __( 'Search', 'unhurried' );
		}
		$tags->set_attribute( 'aria-label', $label );
		return $tags->get_updated_html();
	}
endif;
add_filter( 'render_block_core/search', 'unhurried_label_search', 10, 2 );

if ( ! function_exists( 'unhurried_mark_current_term' ) ) :
	/**
	 * Marks the term the visitor is browsing: on a category or tag archive, the
	 * matching Term Name link gets `is-current` and `aria-current="page"`, so the
	 * journal's topic chips show where you are.
	 *
	 * @since 1.2.0
	 * @param string   $block_content Rendered term name.
	 * @param array    $block         Parsed block.
	 * @param WP_Block $instance      Block instance, carrying the term context.
	 * @return string
	 */
	function unhurried_mark_current_term( $block_content, $block, $instance = null ) {
		if ( ! ( is_category() || is_tag() || is_tax() ) || ! $instance instanceof WP_Block ) {
			return $block_content;
		}
		$term_id = isset( $instance->context['termId'] ) ? (int) $instance->context['termId'] : 0;
		if ( ! $term_id || get_queried_object_id() !== $term_id ) {
			return $block_content;
		}
		$tags = new WP_HTML_Tag_Processor( $block_content );
		if ( $tags->next_tag() ) {
			$tags->add_class( 'is-current' );
			if ( $tags->next_tag( 'a' ) ) {
				$tags->set_attribute( 'aria-current', 'page' );
			}
		}
		return $tags->get_updated_html();
	}
endif;
add_filter( 'render_block_core/term-name', 'unhurried_mark_current_term', 10, 3 );

if ( ! function_exists( 'unhurried_term_count_label' ) ) :
	/**
	 * Term Count blocks with the class `unhurried-term-count` read "3 posts"
	 * (translated, singular or plural) instead of the bare "(3)".
	 *
	 * @since 1.2.0
	 * @param string   $block_content Rendered term count.
	 * @param array    $block         Parsed block.
	 * @param WP_Block $instance      Block instance, carrying the term context.
	 * @return string
	 */
	function unhurried_term_count_label( $block_content, $block, $instance = null ) {
		$class = isset( $block['attrs']['className'] ) ? (string) $block['attrs']['className'] : '';
		if ( false === strpos( $class, 'unhurried-term-count' ) || ! $instance instanceof WP_Block || empty( $instance->context['termId'] ) ) {
			return $block_content;
		}
		$term = get_term( (int) $instance->context['termId'] );
		if ( ! $term instanceof WP_Term ) {
			return $block_content;
		}
		/* translators: %s: Number of posts in a category or tag. */
		$label = sprintf( _n( '%s post', '%s posts', (int) $term->count, 'unhurried' ), number_format_i18n( (int) $term->count ) );
		return preg_replace( '/>[^<]*</', '>' . esc_html( $label ) . '<', $block_content, 1 );
	}
endif;
add_filter( 'render_block_core/term-count', 'unhurried_term_count_label', 10, 3 );

if ( ! function_exists( 'unhurried_find_page' ) ) :
	/**
	 * The page the theme treats as one of its named pages (Contact, Services…).
	 *
	 * First the page at that slug, as always. When there is none, the page the
	 * setup checklist opened for it: the checklist marks each of its pages
	 * with its key (post meta _unhurried_page), because on a translated site
	 * the page is titled, and so addressed, in the site's own language
	 * ("Kontakt", /kontakt/) and the English slug finds nothing.
	 *
	 * @since 1.2.0
	 * @param string   $slug     The page's key: its English slug, e.g. 'contact'.
	 * @param string[] $statuses Post statuses that count. Default: published only.
	 * @return WP_Post|null
	 */
	function unhurried_find_page( $slug, $statuses = array( 'publish' ) ) {
		$slug     = (string) $slug;
		$statuses = (array) $statuses;
		$page     = '' !== $slug ? get_page_by_path( $slug ) : null;
		if ( ! $page || ! in_array( $page->post_status, $statuses, true ) ) {
			$page = null;
			if ( '' !== $slug ) {
				$marked = get_posts(
					array(
						'post_type'   => 'page',
						'post_status' => $statuses,
						'meta_key'    => '_unhurried_page', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key -- Runs only when no page has the slug; a handful of rows; WP_Query caches the result.
						'meta_value'  => $slug, // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value -- As above.
						'orderby'     => 'ID',
						'order'       => 'ASC',
						'numberposts' => 10,
					)
				);
				// A published page first, then the oldest of the rest.
				foreach ( $marked as $candidate ) {
					if ( 'publish' === $candidate->post_status ) {
						$page = $candidate;
						break;
					}
				}
				if ( ! $page && $marked ) {
					$page = $marked[0];
				}
			}
		}
		/**
		 * Filters which page the theme treats as one of its named pages.
		 *
		 * A multilingual plugin can return the page for the visitor's language.
		 *
		 * @since 1.2.0
		 * @param int      $page_id  Page ID, or 0 when the theme found none.
		 * @param string   $slug     The page's key: its English slug, e.g. 'contact'.
		 * @param string[] $statuses Post statuses that count.
		 */
		$page_id = (int) apply_filters( 'unhurried_page_id', $page ? $page->ID : 0, $slug, $statuses );
		if ( $page && $page_id === $page->ID ) {
			return $page;
		}
		$page = $page_id ? get_post( $page_id ) : null;
		return ( $page instanceof WP_Post && in_array( $page->post_status, $statuses, true ) ) ? $page : null;
	}
endif;

if ( ! function_exists( 'unhurried_page_link' ) ) :
	/**
	 * Permalink of a published page by slug, or a fallback, for pattern buttons.
	 *
	 * @since 1.1.0
	 * @since 1.2.0 Also finds the page the setup checklist made (see unhurried_find_page()); filterable.
	 * @param string $slug     Page slug, e.g. 'contact'.
	 * @param string $fallback Used when the page does not exist.
	 * @return string
	 */
	function unhurried_page_link( $slug, $fallback = '#' ) {
		$page = unhurried_find_page( $slug );
		$url  = $page ? get_permalink( $page ) : $fallback;
		/**
		 * Filters the address the theme links to for one of its named pages.
		 *
		 * @since 1.2.0
		 * @param string $url      The page's permalink, or the fallback when there is no such page.
		 * @param string $slug     The page's key: its English slug, e.g. 'contact'.
		 * @param string $fallback The fallback the caller asked for.
		 */
		return apply_filters( 'unhurried_page_link', $url, $slug, $fallback );
	}
endif;
