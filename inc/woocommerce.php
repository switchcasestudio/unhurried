<?php
/**
 * WooCommerce: legibility, nothing more.
 *
 * Unhurried does not lay out a shop; Unhurried Pro does. All this file does
 * is keep WooCommerce's own cart, checkout and account pages readable in
 * every look (4.5:1 for text, 3:1 for the edge of a field):
 *
 * - In a dark look the theme says so with WordPress's own flag, the
 *   "dark-editor-style" theme support. WooCommerce reads that flag and gives
 *   its Cart and Checkout blocks their dark fields. Without it those blocks
 *   keep white fields while the labels on them take the page's light text.
 * - Two small stylesheets cover what the flag does not reach:
 *   assets/css/woocommerce.css in every look, assets/css/woocommerce-dark.css
 *   in a dark one.
 * - The purchase pages (the cart, the checkout, the account) hold still:
 *   no scroll-in entrances, no page cross-fade (since 1.2.1); a product
 *   page holds its first screen and buy area still.
 *
 * Nothing here runs without WooCommerce. The dark flag and the stylesheets
 * are skipped under Unhurried Pro, which brings its own.
 *
 * @package Unhurried
 * @author  Moses Atia Poston, Switch Case Studio
 * @copyright 2026 Moses Atia Poston, Switch Case Studio
 * @license GPL-2.0-or-later
 * @since 1.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Not a page: this file only runs inside WordPress.
}

if ( ! function_exists( 'unhurried_is_dark_look' ) ) :
	/**
	 * Whether the active look is a dark one: its page color ("base") is darker
	 * than its text color ("contrast").
	 *
	 * True for Nocturne, Moss, Harbor, Plum, Lagoon and Dusk, and for a
	 * palette the site owner has darkened by hand. Read from the palette in
	 * use, not from the name of a look: a chosen look is saved with the site,
	 * and its colors can be edited afterwards.
	 *
	 * @since 1.2.0
	 * @return bool
	 */
	function unhurried_is_dark_look() {
		$colors = array();
		foreach ( (array) wp_get_global_settings( array( 'color', 'palette', 'theme' ) ) as $color ) {
			if ( isset( $color['slug'], $color['color'] ) ) {
				$colors[ $color['slug'] ] = (string) $color['color'];
			}
		}
		// Perceived brightness, 0 to 255, of a hex color; null for anything else.
		$brightness = static function ( $color ) {
			$hex = ltrim( (string) sanitize_hex_color( $color ), '#' );
			if ( 3 === strlen( $hex ) ) {
				$hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
			}
			if ( 6 !== strlen( $hex ) ) {
				return null;
			}
			return 0.299 * hexdec( substr( $hex, 0, 2 ) ) + 0.587 * hexdec( substr( $hex, 2, 2 ) ) + 0.114 * hexdec( substr( $hex, 4, 2 ) );
		};
		$base       = isset( $colors['base'] ) ? $brightness( $colors['base'] ) : null;
		$contrast   = isset( $colors['contrast'] ) ? $brightness( $colors['contrast'] ) : null;
		$dark       = null !== $base && null !== $contrast && $base < $contrast;
		/**
		 * Filters whether the active look counts as a dark one.
		 *
		 * @since 1.2.0
		 * @param bool $dark Whether the page color is darker than the text color.
		 */
		return (bool) apply_filters( 'unhurried_is_dark_look', $dark );
	}
endif;

if ( ! function_exists( 'unhurried_woocommerce_legibility' ) ) :
	/**
	 * Whether the theme looks after the legibility of WooCommerce's pages.
	 *
	 * Yes while WooCommerce is active, except under Unhurried Pro, which
	 * styles every shop page itself.
	 *
	 * @since 1.2.0
	 * @return bool
	 */
	function unhurried_woocommerce_legibility() {
		$pro = is_child_theme() && ( 'unhurried-pro' === get_stylesheet() || 'unhurried-pro' === wp_get_theme()->get( 'TextDomain' ) );
		/**
		 * Filters whether the theme looks after the legibility of WooCommerce's pages.
		 *
		 * A child theme that colors WooCommerce's fields itself can return false.
		 *
		 * @since 1.2.0
		 * @param bool $on Default: WooCommerce is active and Unhurried Pro is not.
		 */
		return (bool) apply_filters( 'unhurried_woocommerce_legibility', class_exists( 'WooCommerce' ) && ! $pro );
	}
endif;

if ( ! function_exists( 'unhurried_woocommerce_dark_fields' ) ) :
	/**
	 * In a dark look, tells WooCommerce so.
	 *
	 * "dark-editor-style" is WordPress's flag for a theme with a dark
	 * background. WooCommerce's Cart and Checkout blocks read it as the
	 * default of their "Dark mode inputs" setting.
	 *
	 * @since 1.2.0
	 * @return void
	 */
	function unhurried_woocommerce_dark_fields() {
		if ( unhurried_woocommerce_legibility() && unhurried_is_dark_look() ) {
			add_theme_support( 'dark-editor-style' );
		}
	}
endif;
// Before WooCommerce prints either block: on the front end, and in the editor.
add_action( 'wp', 'unhurried_woocommerce_dark_fields' );
add_action( 'enqueue_block_editor_assets', 'unhurried_woocommerce_dark_fields', 1 );

if ( ! function_exists( 'unhurried_woocommerce_styles' ) ) :
	/**
	 * Enqueues the legibility styles. Both files are small, so WordPress
	 * prints them inline rather than fetching them.
	 *
	 * @since 1.2.0
	 * @return void
	 */
	function unhurried_woocommerce_styles() {
		if ( ! unhurried_woocommerce_legibility() ) {
			return;
		}
		$version = wp_get_theme( get_template() )->get( 'Version' );
		$files   = array( 'unhurried-woocommerce' => 'woocommerce' );
		if ( unhurried_is_dark_look() ) {
			$files['unhurried-woocommerce-dark'] = 'woocommerce-dark';
		}
		foreach ( $files as $handle => $file ) {
			wp_enqueue_style( $handle, get_template_directory_uri() . '/assets/css/' . $file . '.css', array( 'unhurried-style' ), $version );
			wp_style_add_data( $handle, 'path', get_template_directory() . '/assets/css/' . $file . '.css' );
		}
	}
endif;
add_action( 'wp_enqueue_scripts', 'unhurried_woocommerce_styles', 11 );

if ( ! function_exists( 'unhurried_woocommerce_is_purchase_page' ) ) :
	/**
	 * Whether this is a step of buying: the cart, the checkout (with its
	 * order received page) or the customer's account.
	 *
	 * These pages hold still: nothing enters as it scrolls and the pages do
	 * not cross-fade, so nothing stands between a buyer and the next step.
	 * Controls still answer the pointer and the keyboard as everywhere else.
	 * A product page moves below its buy area only (since 1.2.1 f68: the
	 * first screen and the columns holding the form stay still; style.css
	 * and assets/js/reveal.js).
	 *
	 * @since 1.2.1
	 * @return bool
	 */
	function unhurried_woocommerce_is_purchase_page() {
		if ( ! function_exists( 'is_cart' ) || ! function_exists( 'is_checkout' ) || ! function_exists( 'is_account_page' ) || ! function_exists( 'is_product' ) ) {
			return false;
		}
		return is_cart() || is_checkout() || is_account_page();
	}
endif;

if ( ! function_exists( 'unhurried_woocommerce_still_motion' ) ) :
	/**
	 * Turns the scroll-in entrances off on the purchase pages.
	 *
	 * @since 1.2.1
	 * @param bool $enabled Whether pages animate as they scroll.
	 * @return bool
	 */
	function unhurried_woocommerce_still_motion( $enabled ) {
		return unhurried_woocommerce_is_purchase_page() ? false : $enabled;
	}
endif;
add_filter( 'unhurried_motion', 'unhurried_woocommerce_still_motion' );

if ( ! function_exists( 'unhurried_woocommerce_still_body' ) ) :
	/**
	 * Marks the purchase pages with the class "unhurried-still", which also
	 * skips the page cross-fade (style.css, Motion system, Continuity).
	 *
	 * @since 1.2.1
	 * @param string[] $classes Body classes.
	 * @return string[]
	 */
	function unhurried_woocommerce_still_body( $classes ) {
		if ( unhurried_woocommerce_is_purchase_page() && ! in_array( 'unhurried-still', $classes, true ) ) {
			$classes[] = 'unhurried-still';
		}
		return $classes;
	}
endif;
add_filter( 'body_class', 'unhurried_woocommerce_still_body' );

if ( ! function_exists( 'unhurried_woocommerce_still_scripts' ) ) :
	/**
	 * Stops jQuery's own animations on the purchase pages.
	 *
	 * WooCommerce slides a variable product's price in and out (200ms, and
	 * it ran twice, so Add to cart jumped down, up and down again under the
	 * pointer) and the product gallery slides its height. With jQuery's
	 * documented switch every such step lands at once: the price appears
	 * in place, the button moves once and never bounces.
	 *
	 * @since 1.2.1
	 * @return void
	 */
	function unhurried_woocommerce_still_scripts() {
		if ( ( unhurried_woocommerce_is_purchase_page() || ( function_exists( 'is_product' ) && is_product() ) ) && wp_script_is( 'jquery-core', 'registered' ) ) {
			wp_add_inline_script( 'jquery-core', 'jQuery.fx.off = true;' );
		}
	}
endif;
add_action( 'wp_enqueue_scripts', 'unhurried_woocommerce_still_scripts', 20 );
