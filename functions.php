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
require_once get_template_directory() . '/inc/recommended.php';
require_once get_template_directory() . '/inc/setup.php';

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

if ( ! function_exists( 'unhurried_motion_head' ) ) :
	/**
	 * Turns on the automatic motion before the first paint.
	 *
	 * Adds the class "uh-motion" to <html> when the browser can observe
	 * scrolling and the visitor has not asked for reduced motion, so content
	 * that is about to rise in starts hidden instead of flashing. If the
	 * motion script has not started within 2.5 seconds, the class comes off
	 * again and everything simply shows. Filter unhurried_motion to false to
	 * keep pages still (the older Reveal style keeps working).
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
		wp_print_inline_script_tag( "(function(d,w){var h=d.documentElement;if(!('IntersectionObserver' in w)||w.matchMedia('(prefers-reduced-motion: reduce)').matches){return;}h.classList.add('uh-motion');w.setTimeout(function(){if(!h.classList.contains('uh-motion-live')){h.classList.remove('uh-motion');}},2500);})(document,window);" );
	}
endif;
add_action( 'wp_head', 'unhurried_motion_head', 1 );

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
	 * Latin letters count as their base letter; Hebrew and Arabic as 0.45em;
	 * other two-byte scripts (Greek, Cyrillic) as 0.62em; three- and four-byte characters (CJK
	 * and others) as a full 1em. Overestimating only makes the wordmark a
	 * little smaller, never clipped.
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
		$width = 0.0;
		$count = 0;
		foreach ( preg_split( '//u', $text, -1, PREG_SPLIT_NO_EMPTY ) as $char ) {
			++$count;
			$bytes = strlen( $char );
			if ( 2 === $bytes ) {
				$base = remove_accents( $char );
				$char = ( 1 === strlen( $base ) ) ? $base : $char;
				$bytes = strlen( $char );
			}
			if ( 1 === $bytes ) {
				$code   = ord( $char );
				$width += ( $code >= 32 && $code <= 126 ) ? $ascii[ $code - 32 ] / 100 : 0.56;
			} elseif ( 2 === $bytes ) {
				// Hebrew and Arabic (lead bytes 0xD6 to 0xDB) join or run narrow in the fallback faces.
				$lead   = ord( $char[0] );
				$width += ( $lead >= 0xD6 && $lead <= 0xDB ) ? 0.45 : 0.62;
			} else {
				$width += 1.0;
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
		$processor->set_attribute( 'style', $style . '--unhurried-wordmark-em:' . number_format( $em, 3, '.', '' ) . ';' );
		return $processor->get_updated_html();
	}
endif;
add_filter( 'render_block_core/site-title', 'unhurried_size_wordmark', 10, 2 );

if ( ! function_exists( 'unhurried_wordmark_letters' ) ) :
	/**
	 * Splits the footer wordmark into one span per letter for the hover roll.
	 *
	 * The letters are hidden from assistive technology and the whole title is
	 * repeated in a visually hidden span, so screen readers still hear one word.
	 *
	 * @since 1.2.0
	 * @param string $block_content Rendered block HTML.
	 * @param array  $block         Parsed block.
	 * @return string
	 */
	function unhurried_wordmark_letters( $block_content, $block ) {
		$class = isset( $block['attrs']['className'] ) ? (string) $block['attrs']['className'] : '';
		if ( false === strpos( $class, 'unhurried-wordmark' ) || false !== strpos( $block_content, 'unhurried-wordmark__letters' ) ) {
			return $block_content;
		}
		$split = static function ( $inner ) {
			$text = trim( html_entity_decode( wp_strip_all_tags( $inner ), ENT_QUOTES, get_bloginfo( 'charset' ) ) );
			if ( '' === $text ) {
				return $inner;
			}
			$letters = '';
			foreach ( preg_split( '//u', $text, -1, PREG_SPLIT_NO_EMPTY ) as $i => $char ) {
				$letters .= '<span style="--i:' . (int) $i . '">' . ( ' ' === $char ? '&nbsp;' : esc_html( $char ) ) . '</span>';
			}
			return '<span class="unhurried-wordmark__letters" aria-hidden="true">' . $letters . '</span><span class="unhurried-visually-hidden">' . esc_html( $text ) . '</span>';
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
add_filter( 'render_block_core/site-title', 'unhurried_wordmark_letters', 11, 2 );

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
			. '<div class="unhurried-marquee__track"><div class="unhurried-marquee__set">' . $inner . '</div>'
			. '<div class="unhurried-marquee__set" aria-hidden="true">' . $copy->get_updated_html() . '</div></div>'
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
		$markup  = '';
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
			$form = new WP_HTML_Tag_Processor( $html );
			while ( $form->next_tag( array( 'tag_name' => 'input', 'class_name' => 'tnp-email' ) ) ) {
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
		if ( is_front_page() && is_page() && apply_filters( 'unhurried_hide_front_page_title', true ) ) {
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
	 * The header button already links there, so style.css hides that item in the
	 * header capsule while the button shows, and keeps it in the open mobile menu.
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

if ( ! function_exists( 'unhurried_page_list_exclude' ) ) :
	/**
	 * Pages kept out of the automatic page list.
	 *
	 * Until a site has a menu of its own, the Navigation block prints every
	 * published page, and with WooCommerce that includes its Checkout, Cart
	 * and My account pages. Checkout is a step, not a place to go, so it is
	 * always left out. Cart and My account are left out when the header
	 * already carries WooCommerce's cart and account icons, which lead to the
	 * same pages; without the icons the two links stay, as the only way there.
	 *
	 * @since 1.2.0
	 * @return int[] Page IDs.
	 */
	function unhurried_page_list_exclude() {
		$exclude = array();
		if ( function_exists( 'wc_get_page_id' ) ) {
			$header    = get_block_template( get_stylesheet() . '//header', 'wp_template_part' );
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
	 * Applies unhurried_page_list_pages() while a Navigation block renders,
	 * and only then: the filter goes on as the block starts and comes off
	 * when it has rendered (unhurried_page_list_unscope()), so no other list
	 * of pages is touched. The Navigation block renders its Page List itself,
	 * which is why the scope is the menu and not the list inside it.
	 *
	 * @since 1.2.0
	 * @param array $parsed_block The block about to render.
	 * @return array
	 */
	function unhurried_page_list_scope( $parsed_block ) {
		if ( isset( $parsed_block['blockName'] ) && 'core/navigation' === $parsed_block['blockName'] ) {
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
