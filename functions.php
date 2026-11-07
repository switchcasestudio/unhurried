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

require_once get_template_directory() . '/inc/about-page.php';
require_once get_template_directory() . '/inc/recommended.php';

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
	}
endif;
add_action( 'after_setup_theme', 'unhurried_setup' );

if ( ! function_exists( 'unhurried_enqueue_assets' ) ) :
	/**
	 * Enqueues the stylesheet and the small reveal script.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	function unhurried_enqueue_assets() {
		$version = wp_get_theme()->get( 'Version' );

		wp_enqueue_style( 'unhurried-style', get_template_directory_uri() . '/style.css', array(), $version );

		wp_enqueue_script(
			'unhurried-reveal',
			get_theme_file_uri( 'assets/js/reveal.js' ),
			array(),
			$version,
			array(
				'strategy'  => 'defer',
				'in_footer' => true,
			)
		);
	}
endif;
add_action( 'wp_enqueue_scripts', 'unhurried_enqueue_assets' );

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
				'name'  => 'colour',
				'label' => __( 'Keep colour', 'unhurried' ),
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

if ( ! function_exists( 'unhurried_page_link' ) ) :
	/**
	 * Permalink of a published page by slug, or a fallback, for pattern buttons.
	 *
	 * @since 1.1.0
	 * @param string $slug     Page slug, e.g. 'contact'.
	 * @param string $fallback Used when the page does not exist.
	 * @return string
	 */
	function unhurried_page_link( $slug, $fallback = '#' ) {
		$page = get_page_by_path( $slug );
		return ( $page && 'publish' === $page->post_status ) ? get_permalink( $page ) : $fallback;
	}
endif;
