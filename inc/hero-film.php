<?php
/**
 * Hero films: a short silent film a site owner adds to a hero, shown after
 * the picture, in the Unhurried way.
 *
 * Two heroes hold a film slot, a Video block named "Film (optional)" that
 * the theme ships empty (it ships no film):
 *
 * - Hero, statue (patterns/hero-statue.php, the homepage's hero): the film
 *   covers the whole stage, behind the shade and the words, over the
 *   Cover's photograph (unhurried_hero_film_stage()).
 * - Hero, framed picture (patterns/hero-film.php): the film fills the
 *   rounded frame beside the words, over its picture
 *   (unhurried_hero_film_frame()).
 *
 * An empty slot shows nothing on the page (the picture alone, nothing
 * loaded for it); in the editor it is the Video block's own "upload or
 * choose a video" box (assets/css/hero-film-editor.css). With a film, the
 * picture still shows first: by default, without scripts, for visitors who
 * ask for reduced motion or less data, and until the film can play.
 * assets/js/hero-film.js starts the film only after the page has loaded,
 * while it is in view and motion is allowed; it pauses when it leaves the
 * view, never plays sound, and gives the film a pause and play button that
 * keeps the visitor's choice. The stylesheet and script load only on pages
 * that show a film (the framed picture's stylesheet with its frame).
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
	 * Gives the editor the heroes' film look, so the patterns preview and edit as they show.
	 *
	 * @since 1.2.1
	 * @return void
	 */
	function unhurried_hero_film_editor_style() {
		add_editor_style( array( 'assets/css/hero-film.css', 'assets/css/hero-film-editor.css' ) );
	}
endif;
add_action( 'after_setup_theme', 'unhurried_hero_film_editor_style', 11 );

if ( ! function_exists( 'unhurried_hero_film_assets' ) ) :
	/**
	 * Loads the films' stylesheet (printed inline) and, with a film, its script.
	 *
	 * @since 1.2.1
	 * @param bool $script Whether a film is on the page.
	 * @return void
	 */
	function unhurried_hero_film_assets( $script ) {
		$version = wp_get_theme( get_template() )->get( 'Version' );
		wp_enqueue_style( 'unhurried-hero-film', get_template_directory_uri() . '/assets/css/hero-film.css', array( 'unhurried-style' ), $version );
		wp_style_add_data( 'unhurried-hero-film', 'path', get_template_directory() . '/assets/css/hero-film.css' );
		if ( $script ) {
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
		}
	}
endif;

if ( ! function_exists( 'unhurried_hero_film_video' ) ) :
	/**
	 * Makes a hero's video a silent loop that loads nothing by itself: no
	 * autoplay, no controls, no poster, preload "none", muted, looping, inline
	 * on phones, hidden from screen readers (the film is decorative, as the
	 * picture is). A site owner's upload comes with the Video block's own
	 * defaults (controls on, loop off): this is what makes it a hero film.
	 *
	 * @since 1.2.1
	 * @param WP_HTML_Tag_Processor $tags The markup, on its VIDEO tag.
	 * @return string The video's id, or '' when it has no source.
	 */
	function unhurried_hero_film_video( $tags ) {
		if ( '' === trim( (string) $tags->get_attribute( 'src' ) ) ) {
			return '';
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
		return $video_id;
	}
endif;

if ( ! function_exists( 'unhurried_hero_film_button' ) ) :
	/**
	 * The film's pause and play button, hidden until the script starts the film.
	 *
	 * @since 1.2.1
	 * @param string $video_id The film's id.
	 * @param string $media    A media query the window must match for the film to play ('' for any).
	 * @return string
	 */
	function unhurried_hero_film_button( $video_id, $media = '' ) {
		return sprintf(
			'<button type="button" class="unhurried-hero-film__toggle" data-film="%1$s" data-label-pause="%2$s" data-label-play="%3$s"%4$s hidden>'
				. '<svg class="unhurried-hero-film__pause" width="16" height="16" viewBox="0 0 16 16" aria-hidden="true" focusable="false"><path d="M5 3.5v9M11 3.5v9" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" fill="none"/></svg>'
				. '<svg class="unhurried-hero-film__play" width="16" height="16" viewBox="0 0 16 16" aria-hidden="true" focusable="false"><path d="M5.5 3.6v8.8L12.5 8z" fill="currentColor"/></svg>'
				. '<span class="unhurried-visually-hidden">%2$s</span></button>',
			esc_attr( $video_id ),
			esc_attr__( 'Pause the film', 'unhurried' ),
			esc_attr__( 'Play the film', 'unhurried' ),
			'' !== $media ? ' data-media="' . esc_attr( $media ) . '"' : ''
		);
	}
endif;

if ( ! function_exists( 'unhurried_hero_film_stage' ) ) :
	/**
	 * Lays a hero's film over its whole stage, behind the shade and the words.
	 *
	 * The film slot is a Video block among the Cover's words (so a site owner
	 * finds it there in the editor, and sets, swaps or removes it there).
	 * On the page it moves out of the words to sit just over the Cover's
	 * photograph: the photograph shows first and stays under it, the film
	 * fades in once it plays, and the shade and the words stay on top. An
	 * empty slot is left out. The pause and play button goes beside the
	 * caption (Hero, statue's lower right), never on the words or the
	 * buttons, in a place kept for it from the start.
	 *
	 * The film plays only where the stage is wide enough for it: at 782px
	 * and wider in a window wider than it is tall. A landscape film in the
	 * tall stage of a phone or an upright tablet would be cropped to less than
	 * half its width and lose the face as it turns: there the photograph stays
	 * (and the film is never loaded).
	 *
	 * @since 1.2.1
	 * @param string $block_content Rendered Cover block.
	 * @return string
	 */
	function unhurried_hero_film_stage( $block_content ) {
		$html = (string) $block_content;
		if ( false === strpos( $html, 'unhurried-hero-film__film' ) || ! class_exists( 'WP_HTML_Tag_Processor' ) ) {
			return $block_content;
		}
		if ( ! preg_match( '#<figure\b[^>]*\bunhurried-hero-film__film\b[^>]*>.*?</figure>#s', $html, $slot, PREG_OFFSET_CAPTURE ) ) {
			return $block_content;
		}
		// Out of the words, whether it holds a film or not.
		$html = substr_replace( $html, '', $slot[0][1], strlen( $slot[0][0] ) );
		$film = new WP_HTML_Tag_Processor( $slot[0][0] );
		if ( ! $film->next_tag( 'figure' ) ) {
			return $html;
		}
		// The film is part of the stage, which holds still: no entrance of its own (f69's first screen, reveal.js).
		$film->add_class( 'unhurried-still' );
		if ( ! $film->next_tag( 'video' ) ) {
			return $html;
		}
		$video_id = unhurried_hero_film_video( $film );
		if ( '' === $video_id ) {
			return $html;
		}
		$cover = new WP_HTML_Tag_Processor( $html );
		if ( ! $cover->next_tag() ) {
			return $block_content;
		}
		$cover->add_class( 'has-film' );
		$html = $cover->get_updated_html();
		// Just over the Cover's photograph, else first in the Cover.
		if ( preg_match( '#<img\b[^>]*\bwp-block-cover__image-background\b[^>]*>#', $html, $image, PREG_OFFSET_CAPTURE ) ) {
			$at = $image[0][1] + strlen( $image[0][0] );
		} else {
			$at = strpos( $html, '>' ) + 1;
		}
		$html   = substr_replace( $html, $film->get_updated_html(), $at, 0 );
		$button = unhurried_hero_film_button( $video_id, '(min-width: 782px) and (min-aspect-ratio: 1/1)' );
		if ( preg_match( '#<p\b[^>]*\bunhurried-hero-statue__caption\b[^>]*>.*?</p>#s', $html, $caption, PREG_OFFSET_CAPTURE ) ) {
			$html = substr_replace( $html, '<div class="unhurried-hero-film__aside">' . $caption[0][0] . $button . '</div>', $caption[0][1], strlen( $caption[0][0] ) );
		} else {
			// No caption: the button closes the Cover's words.
			$end   = strrpos( $html, '</div>' );
			$inner = false === $end ? false : strrpos( substr( $html, 0, $end ), '</div>' );
			if ( false !== $inner ) {
				$html = substr_replace( $html, '<div class="unhurried-hero-film__aside">' . $button . '</div>', $inner, 0 );
			}
		}
		unhurried_hero_film_assets( true );
		return $html;
	}
endif;
add_filter( 'render_block_core/cover', 'unhurried_hero_film_stage', 12 );

if ( ! function_exists( 'unhurried_hero_film_frame' ) ) :
	/**
	 * Prepares the framed picture's frame (Hero, framed picture) as the page is shown.
	 *
	 * - An empty Video block (no video chosen yet) is left out: the frame
	 *   shows its picture alone, with no player, no button and no request.
	 * - The picture gets its real width and height, the theme's smaller copy
	 *   (-800) as a srcset, and, on phones, the theme's square crop
	 *   (-square, and its -square-660 copy) where one sits beside it (a
	 *   picture element). When the frame is part of the template rather than
	 *   a post's content, it gets fetchpriority="high" while nothing else on
	 *   the page has it (WordPress decides inside content, as for any picture).
	 * - A video becomes a hero film (unhurried_hero_film_video()); it fades in
	 *   only once playing (class has-film; the script adds is-playing), and
	 *   the pause and play button follows the frame, in a row kept for it so
	 *   nothing moves.
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
				$video_id = unhurried_hero_film_video( $tags );
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
		unhurried_hero_film_assets( '' !== $video_id );
		if ( '' === $video_id ) {
			return $html;
		}
		return $html . unhurried_hero_film_button( $video_id );
	}
endif;
add_filter( 'render_block_core/group', 'unhurried_hero_film_frame', 10, 2 );
