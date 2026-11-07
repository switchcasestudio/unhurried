<?php
/**
 * Growth features: recommended plugins, the Unhurried Pro card, two notices.
 *
 * Rules (WordPress.org Themes Team, checked 2026-11-06): plugins must be
 * hosted on WordPress.org and installed by the user's own click; no tracking
 * or affiliate links in the admin; notices through admin_notices, dismissible;
 * nothing on the front end. Affiliate links live on switchcasestudio.com, and
 * the plugins card says so.
 *
 * @package Unhurried
 * @author  Moses Atia Poston, Switch Case Studio
 * @copyright 2026 Moses Atia Poston, Switch Case Studio
 * @license GPL-2.0-or-later
 * @since 1.1.0
 */

if ( ! defined( 'UNHURRIED_PRO_VARIANT' ) ) {
	define( 'UNHURRIED_PRO_VARIANT', 'shop' ); // shop | time | proof
}
if ( ! defined( 'UNHURRIED_PLUGINS_VARIANT' ) ) {
	define( 'UNHURRIED_PLUGINS_VARIANT', 'list' ); // list | tiles | compact
}
if ( ! defined( 'UNHURRIED_SHOW_REVIEWSCRIBE' ) ) {
	define( 'UNHURRIED_SHOW_REVIEWSCRIBE', true );
}
if ( ! defined( 'UNHURRIED_PRO_URL' ) ) {
	define( 'UNHURRIED_PRO_URL', 'https://switchcasestudio.com/unhurried-pro/' );
}
if ( ! defined( 'UNHURRIED_GUIDE_URL' ) ) {
	define( 'UNHURRIED_GUIDE_URL', 'https://switchcasestudio.com/unhurried/guide/' );
}
if ( ! defined( 'UNHURRIED_REVIEW_URL' ) ) {
	define( 'UNHURRIED_REVIEW_URL', 'https://wordpress.org/support/theme/unhurried/reviews/#new-post' );
}

if ( ! function_exists( 'unhurried_recommended_plugins' ) ) :
	/**
	 * Plugins the About screen recommends. All hosted on WordPress.org.
	 *
	 * @since 1.1.0
	 * @return array[] Each: slug, name, line.
	 */
	function unhurried_recommended_plugins() {
		$plugins = array(
			array(
				'slug' => 'woocommerce',
				'name' => 'WooCommerce',
				'line' => __( 'Sell products. Unhurried Pro styles its shop, product, cart and checkout pages.', 'unhurried' ),
			),
			array(
				'slug' => 'contact-form-7',
				'name' => 'Contact Form 7',
				'line' => __( 'A plain form for the note card on the Contact page.', 'unhurried' ),
			),
		);
		if ( UNHURRIED_SHOW_REVIEWSCRIBE ) {
			$plugins[] = array(
				'slug' => 'reviewscribe',
				'name' => 'ReviewScribe',
				'line' => __( 'Collect and show customer reviews, with or without a shop.', 'unhurried' ),
			);
		}
		return apply_filters( 'unhurried_recommended_plugins', $plugins );
	}
endif;

if ( ! function_exists( 'unhurried_plugin_state' ) ) :
	/**
	 * Whether a plugin slug is active, installed or missing.
	 *
	 * @since 1.1.0
	 * @param string $slug Plugin directory name.
	 * @return string active|installed|missing
	 */
	function unhurried_plugin_state( $slug ) {
		if ( ! function_exists( 'get_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}
		foreach ( array_keys( get_plugins() ) as $file ) {
			if ( 0 === strpos( $file, $slug . '/' ) ) {
				return is_plugin_active( $file ) ? 'active' : 'installed';
			}
		}
		return 'missing';
	}
endif;

if ( ! function_exists( 'unhurried_plugin_action' ) ) :
	/**
	 * Label and URL for a plugin's state. Installing is always the user's click.
	 *
	 * @since 1.1.0
	 * @param string $slug  Plugin slug.
	 * @param string $state active|installed|missing.
	 * @return array{label:string,url:string}
	 */
	function unhurried_plugin_action( $slug, $state ) {
		if ( 'active' === $state ) {
			return array(
				'label' => __( 'Active', 'unhurried' ),
				'url'   => '',
			);
		}
		if ( 'installed' === $state ) {
			return array(
				'label' => __( 'Activate', 'unhurried' ),
				'url'   => self_admin_url( 'plugins.php' ),
			);
		}
		if ( current_user_can( 'install_plugins' ) ) {
			return array(
				'label' => __( 'Install', 'unhurried' ),
				'url'   => self_admin_url( 'plugin-install.php?s=' . rawurlencode( $slug ) . '&tab=search&type=term' ),
			);
		}
		return array(
			'label' => __( 'View', 'unhurried' ),
			'url'   => 'https://wordpress.org/plugins/' . rawurlencode( $slug ) . '/',
		);
	}
endif;

if ( ! function_exists( 'unhurried_pro_present' ) ) :
	/**
	 * True when Unhurried Pro is installed (active or not).
	 *
	 * @since 1.1.0
	 * @return bool
	 */
	function unhurried_pro_present() {
		return wp_get_theme( 'unhurried-pro' )->exists();
	}
endif;

if ( ! function_exists( 'unhurried_pro_card' ) ) :
	/**
	 * Copy for the Pro card, by variant. The 'shop' variant swaps its heading
	 * when WooCommerce is active, because that is when the loss is visible.
	 *
	 * @since 1.1.0
	 * @return array{eyebrow:string,heading:string,body:string,button:string}
	 */
	function unhurried_pro_card() {
		$woo  = class_exists( 'WooCommerce' );
		$copy = array(
			'shop'  => array(
				'eyebrow' => __( 'Unhurried Pro', 'unhurried' ),
				'heading' => $woo
					? __( 'Your shop pages are still in WooCommerce\'s <em>default</em> look', 'unhurried' )
					: __( 'Want a <em>shop</em>?', 'unhurried' ),
				'body'    => __( 'Unhurried Pro styles the shop, product, cart and checkout pages to match the rest of your site, and adds a Shop shelf pattern, a lead-story blog layout and a Coming soon page. One payment of $49, updates included, 14-day money-back guarantee.', 'unhurried' ),
				'button'  => __( 'See Unhurried Pro', 'unhurried' ),
			),
			'time'  => array(
				'eyebrow' => __( 'Unhurried Pro', 'unhurried' ),
				'heading' => __( 'Keep the calm all the way to <em>checkout</em>', 'unhurried' ),
				'body'    => __( 'Most shop pages shout. Pro gives WooCommerce the same quiet pace as the rest of Unhurried: tall product photos, hairline buttons, a floating cart panel and a checkout with nothing else on the page. $49 once, with 14 days to change your mind.', 'unhurried' ),
				'button'  => __( 'See Unhurried Pro', 'unhurried' ),
			),
			'proof' => array(
				'eyebrow' => __( 'Unhurried Pro', 'unhurried' ),
				'heading' => __( 'Made by the same <em>hands</em>', 'unhurried' ),
				'body'    => __( 'Pro is built by the studio that designed Unhurried, as a child theme, so your pages and Site Editor changes carry over untouched. Shop, product, cart and checkout pages, a Coming soon page, a Shop shelf and a lead story. $49 once, 14-day money-back guarantee.', 'unhurried' ),
				'button'  => __( 'See Unhurried Pro', 'unhurried' ),
			),
		);
		$variant = isset( $copy[ UNHURRIED_PRO_VARIANT ] ) ? UNHURRIED_PRO_VARIANT : 'shop';
		return apply_filters( 'unhurried_pro_card', $copy[ $variant ], $variant );
	}
endif;
