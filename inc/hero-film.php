<?php
/**
 * Hero, film (patterns/hero-film.php): a short silent loop in a framed
 * picture.
 *
 * The frame is a Group holding an Image and a Video block, so a site owner
 * swaps either one in the editor. The picture is what shows: by default,
 * without scripts, for visitors who ask for reduced motion or less data, and
 * until the film can play. assets/js/hero-film.js starts the film only after
 * the page has loaded, while the frame is in view and motion is allowed; it
 * pauses when the frame leaves the view, never plays sound, and gives the
 * film a pause and play button. Its stylesheet and script load only on pages
 * that show the frame.
 *
 * @package Unhurried
 * @author  Moses Atia Poston, Switch Case Studio
 * @since 1.2.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Not a page: this file only runs inside WordPress.
}

if ( ! function_exists( 'unhurried_hero_film_editor_style' ) ) :
	/**
	 * Gives the editor the frame's look, so the pattern previews and edits as it shows.
	 *
	 * @since 1.2.1
	 * @return void
	 */
	function unhurried_hero_film_editor_style() {
		add_editor_style( 'assets/css/hero-film.css' );
	}
endif;
add_action( 'after_setup_theme', 'unhurried_hero_film_editor_style', 11 );

if ( ! function_exists( 'unhurried_hero_film_frame' ) ) :
	/**
	 * Prepares a hero film frame as the page is shown.
	 *
	 * - The video loads nothing by itself: no autoplay, preload "none",
	 *   muted, inline on phones, hidden from screen readers (the film is
	 *   decorative, as the picture is), and it fades in only once playing
	 *   (class has-film; the script adds is-playing).
	 * - The picture gets the theme's phone copy (-800) as a srcset, and, when
	 *   the frame is part of the template rather than a post's content,
	 *   fetchpriority="high" while nothing else on the page has it
	 *   (WordPress decides inside content, as for any picture).
	 * - A pause and play button follows the frame, hidden until the script
	 *   starts the film, in a place kept for it so nothing moves.
	 *
	 * Copies of the pattern already in pages get this too: it works on the
	 * markup as it is shown, and nothing saved changes.
	 *
	 * @since 1.2.1
	 * @param string $block_content Rendered Group block.
	 * @param array  $block         Parsed block.
	 * @return string
	 */
	function unhurried_hero_film_frame( $block_content, $block ) {
		if ( empty( $block['attrs']['className'] ) || false === strpos( (string) $block['attrs']['className'], 'unhurried-hero-film__frame' ) || false === stripos( (string) $block_content, '<video' ) || ! class_exists( 'WP_HTML_Tag_Processor' ) ) {
			return $block_content;
		}
		$tags = new WP_HTML_Tag_Processor( $block_content );
		if ( ! $tags->next_tag() || ! $tags->has_class( 'unhurried-hero-film__frame' ) ) {
			return $block_content;
		}
		$tags->add_class( 'has-film' );
		$video_id = '';
		while ( $tags->next_tag() ) {
			if ( 'IMG' === $tags->get_tag() && '' === $video_id ) {
				$src  = (string) $tags->get_attribute( 'src' );
				$file = function_exists( 'unhurried_theme_image_file' ) ? unhurried_theme_image_file( $src ) : '';
				if ( '' !== $file && null === $tags->get_attribute( 'srcset' ) ) {
					$info = pathinfo( $file );
					$copy = $info['dirname'] . '/' . $info['filename'] . '-800.' . $info['extension'];
					$size = wp_getimagesize( $file );
					if ( is_file( $copy ) && $size && (int) $size[0] > 800 ) {
						$url = strtok( $src, '?#' );
						$tags->set_attribute( 'srcset', esc_url_raw( substr( $url, 0, strrpos( $url, '/' ) + 1 ) . basename( $copy ) ) . ' 800w, ' . esc_url_raw( $src ) . ' ' . (int) $size[0] . 'w' );
						$tags->set_attribute( 'sizes', '(max-width: 781px) 100vw, 560px' );
					}
				}
				if ( ! doing_filter( 'the_content' ) && function_exists( 'wp_high_priority_element_flag' ) && wp_high_priority_element_flag() && null === $tags->get_attribute( 'loading' ) && null === $tags->get_attribute( 'fetchpriority' ) ) {
					$tags->set_attribute( 'fetchpriority', 'high' );
					wp_high_priority_element_flag( false );
				}
			} elseif ( 'VIDEO' === $tags->get_tag() ) {
				$video_id = (string) $tags->get_attribute( 'id' );
				if ( '' === $video_id ) {
					$video_id = wp_unique_id( 'unhurried-film-' );
					$tags->set_attribute( 'id', $video_id );
				}
				$tags->remove_attribute( 'autoplay' );
				$tags->set_attribute( 'preload', 'none' );
				$tags->set_attribute( 'muted', true );
				$tags->set_attribute( 'playsinline', true );
				$tags->set_attribute( 'disablepictureinpicture', true );
				$tags->set_attribute( 'disableremoteplayback', true );
				$tags->set_attribute( 'aria-hidden', 'true' );
				break;
			}
		}
		if ( '' === $video_id ) {
			return $block_content;
		}
		$version = wp_get_theme( get_template() )->get( 'Version' );
		wp_enqueue_style( 'unhurried-hero-film', get_template_directory_uri() . '/assets/css/hero-film.css', array( 'unhurried-style' ), $version );
		wp_style_add_data( 'unhurried-hero-film', 'path', get_template_directory() . '/assets/css/hero-film.css' );
		wp_enqueue_script(
			'unhurried-hero-film',
			get_template_directory_uri() . '/assets/js/hero-film.js',
			array(),
			$version,
			array(
				'strategy'  => 'defer',
				'in_footer' => true,
			)
		);
		$button = sprintf(
			'<button type="button" class="unhurried-hero-film__toggle" aria-controls="%1$s" data-label-pause="%2$s" data-label-play="%3$s" hidden>'
				. '<svg class="unhurried-hero-film__pause" width="16" height="16" viewBox="0 0 16 16" aria-hidden="true" focusable="false"><path d="M5 3.5v9M11 3.5v9" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" fill="none"/></svg>'
				. '<svg class="unhurried-hero-film__play" width="16" height="16" viewBox="0 0 16 16" aria-hidden="true" focusable="false"><path d="M5.5 3.6v8.8L12.5 8z" fill="currentColor"/></svg>'
				. '<span class="unhurried-visually-hidden">%2$s</span></button>',
			esc_attr( $video_id ),
			esc_attr__( 'Pause the film', 'unhurried' ),
			esc_attr__( 'Play the film', 'unhurried' )
		);
		return $tags->get_updated_html() . $button;
	}
endif;
add_filter( 'render_block_core/group', 'unhurried_hero_film_frame', 10, 2 );
