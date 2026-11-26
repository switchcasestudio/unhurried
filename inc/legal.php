<?php
/**
 * Legal links: the footers' quiet row of links to the Privacy, Terms and
 * Returns pages (make each one from the Policy page pattern).
 *
 * A link is printed only for a page that is published, so a site without
 * such pages shows no row at all and its footer looks exactly as before:
 *
 * - Privacy: the page chosen in Settings > Privacy (WordPress's own
 *   setting) once it is published, or else the page at /privacy/.
 * - Terms: the page at /terms/.
 * - Returns: the page at /returns/.
 *
 * A page is also found by the mark the setup checklist gives its pages
 * (see unhurried_find_page()), a plugin or child theme can point any of the
 * three elsewhere with the unhurried_page_id filter (Unhurried Pro adds
 * WooCommerce's terms and returns pages that way), and the row itself can
 * be changed or left out with the unhurried_legal_links filter.
 *
 * The footer patterns ask for the row each time a page is shown, so a page
 * published or removed later appears in or leaves the footer by itself. A
 * footer saved in the Site Editor keeps the links it had when it was saved,
 * like any link written into it.
 *
 * @package Unhurried
 * @author  Moses Atia Poston, Switch Case Studio
 * @copyright 2026 Moses Atia Poston, Switch Case Studio
 * @license GPL-2.0-or-later
 * @since 1.2.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Not a page: this file only runs inside WordPress.
}

if ( ! function_exists( 'unhurried_legal_links' ) ) :
	/**
	 * The legal pages that are published, in the order the footer lists them.
	 *
	 * @since 1.2.1
	 * @return array<string, array{label:string, url:string, current:bool}> Key (privacy, terms, returns) => link.
	 */
	function unhurried_legal_links() {
		$labels = array(
			'privacy' => __( 'Privacy', 'unhurried' ),
			'terms'   => __( 'Terms', 'unhurried' ),
			'returns' => __( 'Returns', 'unhurried' ),
		);
		$links  = array();
		foreach ( $labels as $key => $label ) {
			$url     = '';
			$page_id = 0;
			if ( 'privacy' === $key ) {
				// WordPress's own privacy page: an address only once that page is published.
				$url     = (string) get_privacy_policy_url();
				$page_id = '' !== $url ? (int) get_option( 'wp_page_for_privacy_policy' ) : 0;
			}
			if ( '' === $url && function_exists( 'unhurried_find_page' ) ) {
				$page = unhurried_find_page( $key );
				if ( $page ) {
					$url     = (string) get_permalink( $page );
					$page_id = (int) $page->ID;
				}
			}
			if ( '' === $url ) {
				continue;
			}
			$links[ $key ] = array(
				'label'   => $label,
				'url'     => $url,
				'current' => $page_id > 0 && is_page( $page_id ),
			);
		}
		/**
		 * Filters the footers' legal links.
		 *
		 * Each link has a label, an address (url) and whether it is the page
		 * being shown (current). Return an empty array to leave the row out.
		 *
		 * @since 1.2.1
		 * @param array $links Key (privacy, terms, returns) => link, published pages only.
		 */
		$links = apply_filters( 'unhurried_legal_links', $links );
		return is_array( $links ) ? $links : array();
	}
endif;

if ( ! function_exists( 'unhurried_legal_links_block' ) ) :
	/**
	 * The footers' legal links as block markup: a List block of links, or ''
	 * while the site has none of these pages.
	 *
	 * @since 1.2.1
	 * @return string
	 */
	function unhurried_legal_links_block() {
		$items = '';
		foreach ( unhurried_legal_links() as $link ) {
			if ( empty( $link['url'] ) || ! isset( $link['label'] ) || '' === (string) $link['label'] ) {
				continue;
			}
			$items .= '<!-- wp:list-item --><li><a href="' . esc_url( $link['url'] ) . '"' . ( empty( $link['current'] ) ? '' : ' aria-current="page"' ) . '>' . esc_html( $link['label'] ) . '</a></li><!-- /wp:list-item -->';
		}
		if ( '' === $items ) {
			return '';
		}
		return '<!-- wp:list {"className":"unhurried-legal-links"} --><ul class="wp-block-list unhurried-legal-links">' . $items . '</ul><!-- /wp:list -->';
	}
endif;
