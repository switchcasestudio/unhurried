<?php
/**
 * Hero, film (patterns/hero-film.php): Michelangelo's David in a frame that
 * can also play a short silent film.
 *
 * The frame is a Group holding an Image block (the picture) and a Video block
 * (the film), so a site owner swaps either one in the editor. The theme ships
 * the picture and leaves the Video block empty: an empty slot shows nothing
 * on the page (the picture alone, nothing loaded for it), and in the editor
 * it is the Video block's own "upload or choose a video" box. With a video
 * in it, the picture still shows first: by default, without scripts, for
 * visitors who ask for reduced motion or less data, and until the film can
 * play. assets/js/hero-film.js starts the film only after the page has
 * loaded, while the frame is in view and motion is allowed; it pauses when
 * the frame leaves the view, never plays sound, and gives the film a pause
 * and play button. The stylesheet loads only on pages that show the frame,
 * the script only when the frame holds a film.
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
		add_editor_style( array( 'assets/css/hero-film.css', 'assets/css/hero-film-editor.css' ) );
	}
endif;
add_action( 'after_setup_theme', 'unhurried_hero_film_editor_style', 11 );

if ( ! function_exists( 'unhurried_hero_film_frame' ) ) :
	/**
	 * Prepares a hero film frame as the page is shown.
	 *
	 * - An empty Video block (no video chosen yet) is left out: the frame
	 *   shows its picture alone, with no player, no button and no request.
	 * - The picture gets its real width and height, the theme's smaller copy
	 *   (-800) as a srcset, and, on phones, the theme's square crop
	 *   (-square, and its -square-660 copy) where one sits beside it (a
	 *   picture element). When the
	 *   frame is part of the template rather than a post's content, it gets
	 *   fetchpriority="high" while nothing else on the page has it (WordPress
	 *   decides inside content, as for any picture).
	 * - A video plays as a silent loop that loads nothing by itself: no
	 *   autoplay, no controls, no poster, preload "none", muted, looping,
	 *   inline on phones, hidden from screen readers (the film is decorative,
	 *   as the picture is); it fades in only once playing (class has-film;
	 *   the script adds is-playing), and a pause and play button follows the
	 *   frame, hidden until the script starts the film, in a row kept for it
	 *   so nothing moves.
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
		if ( empty( $block['attrs']['className'] ) || false === strpos( (string) $block['attrs']['className'], 'unhurried-hero-film__frame' ) || ! class_exists( 'WP_HTML_Tag_Processor' ) ) {
			return $block_content;
		}
		// An empty film slot shows nothing.
		$html = (string) preg_replace( '#<figure\b[^>]*\bwp-block-video\b[^>]*>\s*</figure>#', '', (string) $block_content );
		$tags = new WP_HTML_Tag_Processor( $html );
		if ( ! $tags->next_tag() || ! $tags->has_class( 'unhurried-hero-film__frame' ) ) {
			return $block_content;
		}
		$tags->set_bookmark( 'frame' );
		$version = wp_get_theme( get_template() )->get( 'Version' );
		wp_enqueue_style( 'unhurried-hero-film', get_template_directory_uri() . '/assets/css/hero-film.css', array( 'unhurried-style' ), $version );
		wp_style_add_data( 'unhurried-hero-film', 'path', get_template_directory() . '/assets/css/hero-film.css' );

		$square   = null;
		$picture  = false;
		$video_id = '';
		while ( $tags->next_tag() ) {
			if ( 'IMG' === $tags->get_tag() && ! $picture ) {
				$picture = true;
				$src     = (string) $tags->get_attribute( 'src' );
				$file    = function_exists( 'unhurried_theme_image_file' ) ? unhurried_theme_image_file( $src ) : '';
				if ( '' !== $file ) {
					$info = pathinfo( $file );
					$size = wp_getimagesize( $file );
					$url  = strtok( $src, '?#' );
					$dir  = substr( $url, 0, strrpos( $url, '/' ) + 1 );
					if ( $size && null === $tags->get_attribute( 'width' ) && null === $tags->get_attribute( 'height' ) ) {
						$tags->set_attribute( 'width', (string) (int) $size[0] );
						$tags->set_attribute( 'height', (string) (int) $size[1] );
					}
					$copy = $info['dirname'] . '/' . $info['filename'] . '-800.' . $info['extension'];
					if ( null === $tags->get_attribute( 'srcset' ) && is_file( $copy ) && $size && (int) $size[0] > 800 ) {
						$tags->set_attribute( 'srcset', esc_url_raw( $dir . basename( $copy ) ) . ' 800w, ' . esc_url_raw( $src ) . ' ' . (int) $size[0] . 'w' );
						// Phones take the square crop below, or this picture full width; wider, the frame is at most 560px.
						$tags->set_attribute( 'sizes', '(max-width: 599px) 100vw, (max-width: 781px) 42vw, 560px' );
					}
					$crop = $info['dirname'] . '/' . $info['filename'] . '-square.' . $info['extension'];
					$dims = is_file( $crop ) ? wp_getimagesize( $crop ) : false;
					if ( $dims ) {
						$square = array( esc_url_raw( $dir . basename( $crop ) ) . ' ' . (int) $dims[0] . 'w', (int) $dims[0], (int) $dims[1] );
						// Its smaller copy, for phones up to about 1.75x (the frame is the window less its margins, at most 30rem).
						$small = $info['dirname'] . '/' . $info['filename'] . '-square-660.' . $info['extension'];
						if ( is_file( $small ) ) {
							$square[0] = esc_url_raw( $dir . basename( $small ) ) . ' 660w, ' . $square[0];
						}
					}
				}
				if ( ! doing_filter( 'the_content' ) && function_exists( 'wp_high_priority_element_flag' ) && wp_high_priority_element_flag() && null === $tags->get_attribute( 'loading' ) && null === $tags->get_attribute( 'fetchpriority' ) ) {
					$tags->set_attribute( 'fetchpriority', 'high' );
					wp_high_priority_element_flag( false );
				}
			} elseif ( 'VIDEO' === $tags->get_tag() ) {
				if ( '' === trim( (string) $tags->get_attribute( 'src' ) ) ) {
					break;
				}
				$video_id = (string) $tags->get_attribute( 'id' );
				if ( '' === $video_id ) {
					$video_id = wp_unique_id( 'unhurried-film-' );
					$tags->set_attribute( 'id', $video_id );
				}
				foreach ( array( 'autoplay', 'controls', 'poster' ) as $name ) {
					$tags->remove_attribute( $name );
				}
				$tags->set_attribute( 'preload', 'none' );
				foreach ( array( 'loop', 'muted', 'playsinline', 'disablepictureinpicture', 'disableremoteplayback' ) as $name ) {
					$tags->set_attribute( $name, true );
				}
				$tags->set_attribute( 'aria-hidden', 'true' );
				break;
			}
		}
		if ( '' !== $video_id && $tags->seek( 'frame' ) ) {
			$tags->add_class( 'has-film' );
		}
		$tags->release_bookmark( 'frame' );
		$html = $tags->get_updated_html();
		if ( $square ) {
			// The phone frame is square: its own crop, so the face sits as it should there too.
			$html = (string) preg_replace(
				'#<img\b#',
				sprintf( '<picture><source media="(max-width: 599px)" srcset="%1$s" sizes="min(calc(100vw - 2.5rem), 30rem)" width="%2$d" height="%3$d">', esc_attr( $square[0] ), $square[1], $square[2] ) . '<img',
				$html,
				1
			);
			$html = (string) preg_replace( '#(<picture><source[^>]*><img\b[^>]*>)#', '$1</picture>', $html, 1 );
		}
		if ( '' === $video_id ) {
			return $html;
		}
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
			'<button type="button" class="unhurried-hero-film__toggle" data-film="%1$s" data-label-pause="%2$s" data-label-play="%3$s" hidden>'
				. '<svg class="unhurried-hero-film__pause" width="16" height="16" viewBox="0 0 16 16" aria-hidden="true" focusable="false"><path d="M5 3.5v9M11 3.5v9" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" fill="none"/></svg>'
				. '<svg class="unhurried-hero-film__play" width="16" height="16" viewBox="0 0 16 16" aria-hidden="true" focusable="false"><path d="M5.5 3.6v8.8L12.5 8z" fill="currentColor"/></svg>'
				. '<span class="unhurried-visually-hidden">%2$s</span></button>',
			esc_attr( $video_id ),
			esc_attr__( 'Pause the film', 'unhurried' ),
			esc_attr__( 'Play the film', 'unhurried' )
		);
		return $html . $button;
	}
endif;
add_filter( 'render_block_core/group', 'unhurried_hero_film_frame', 10, 2 );
