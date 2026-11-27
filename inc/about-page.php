<?php
/**
 * About Unhurried: a getting-started and credits screen under Appearance.
 *
 * @package Unhurried
 * @author  Moses Atia Poston, Switch Case Studio
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Not a page: this file only runs inside WordPress.
}

if ( ! function_exists( 'unhurried_about_menu' ) ) :
	/**
	 * Adds Appearance > About Unhurried.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	function unhurried_about_menu() {
		add_theme_page(
			__( 'About Unhurried', 'unhurried' ),
			__( 'About Unhurried', 'unhurried' ),
			'edit_theme_options',
			'unhurried-about',
			'unhurried_about_screen'
		);
	}
endif;
add_action( 'admin_menu', 'unhurried_about_menu' );

if ( ! function_exists( 'unhurried_about_styles' ) ) :
	/**
	 * Styles for the About Unhurried screen, loaded on that screen only.
	 *
	 * They sit on a stylesheet handle of their own, without a file, through
	 * wp_add_inline_style(), so WordPress prints them in the head with the
	 * other admin styles. The screen used to print them in a style element
	 * inside its own markup.
	 *
	 * @since 1.2.0
	 * @param string $hook_suffix The admin page being loaded.
	 * @return void
	 */
	function unhurried_about_styles( $hook_suffix ) {
		if ( 'appearance_page_unhurried-about' !== $hook_suffix ) {
			return;
		}
		$css = <<<'CSS'
.unhurried-about { max-width: 980px; }
.unhurried-about .ua-hero { background: #E6E1D5; border-radius: 24px; padding: 40px 44px; margin: 20px 0 28px; }
.unhurried-about .ua-hero h1 { font-size: 44px; line-height: 1; letter-spacing: -0.03em; font-weight: 500; margin: 0 0 12px; padding: 0; }
.unhurried-about .ua-hero h1 em { font-family: Georgia, serif; font-weight: 400; }
.unhurried-about .ua-hero p { font-size: 15px; max-width: 60ch; margin: 0; color: #3b3830; }
.unhurried-about .ua-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 20px; }
.unhurried-about .ua-card { background: #F6F4EF; border: 1px solid #D8D5CE; border-radius: 20px; padding: 24px 26px; }
.unhurried-about .ua-card h2 { font-size: 13px; letter-spacing: .14em; text-transform: uppercase; font-weight: 600; margin: 0 0 14px; color: #5A564E; }
.unhurried-about .ua-card ol, .unhurried-about .ua-card ul { margin: 0 0 0 18px; }
.unhurried-about .ua-card li { margin-bottom: 8px; }
.unhurried-about .ua-credit { background: #16140F; color: #F6F4EF; border-radius: 24px; padding: 36px 44px; margin-top: 28px; }
.unhurried-about .ua-credit h2 { color: #F6F4EF; font-size: 28px; font-weight: 500; letter-spacing: -0.02em; margin: 0 0 10px; }
.unhurried-about .ua-credit p { color: rgba(246, 244, 239, .82); font-size: 15px; max-width: 64ch; }
.unhurried-about .ua-credit a { color: #F6F4EF; }
.unhurried-about .ua-small { font-size: 13px; color: #5A564E; }
.unhurried-about .ua-pro h3 { font-size: 28px; line-height: 1.05; letter-spacing: -0.02em; font-weight: 500; margin: 0 0 10px; }
.unhurried-about .ua-pro h3 em { font-family: Georgia, serif; font-weight: 400; }
.unhurried-about .ua-pro p { max-width: 60ch; }
.unhurried-about .ua-plugins ul { list-style: none; margin: 0; padding: 0; }
.unhurried-about .ua-plugins li { display: grid; grid-template-columns: 1fr auto; gap: 2px 16px; align-items: center; padding: 12px 0; border-top: 1px solid #D8D5CE; }
.unhurried-about .ua-plugins li:first-child { border-top: 0; padding-top: 0; }
.unhurried-about .ua-plugins li strong { font-weight: 600; }
.unhurried-about .ua-plugins li span { grid-column: 1; color: #5A564E; font-size: 13px; }
.unhurried-about .ua-plugins li .button, .unhurried-about .ua-plugins li em { grid-column: 2; grid-row: 1 / span 2; font-style: normal; color: #5A564E; }
.unhurried-about .ua-plugins.is-tiles ul { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 12px; }
.unhurried-about .ua-plugins.is-tiles li { display: block; border: 1px solid #D8D5CE; border-radius: 14px; padding: 14px; }
.unhurried-about .ua-plugins.is-tiles li span { display: block; margin: 4px 0 10px; }
.unhurried-about .ua-review { margin-top: 20px; }
.unhurried-about .ua-grid.is-loose { align-items: start; margin-top: 20px; }
.unhurried-about .ua-setup { margin-bottom: 20px; padding: 28px 30px; }
.unhurried-about .ua-setup-head { display: flex; justify-content: space-between; align-items: baseline; gap: 12px; }
.unhurried-about .ua-setup-count { margin: 0; color: #5A564E; font-size: 13px; }
.unhurried-about .ua-setup-bar { height: 4px; border-radius: 4px; background: #E6E1D5; overflow: hidden; margin: 4px 0 18px; }
.unhurried-about .ua-setup-bar span { display: block; height: 100%; background: #16140F; }
.unhurried-about .ua-steps { list-style: none; margin: 0; padding: 0; }
.unhurried-about .ua-step { display: grid; grid-template-columns: 26px 1fr; gap: 14px; padding: 16px 0; border-top: 1px solid #D8D5CE; margin: 0; }
.unhurried-about .ua-step:first-child { border-top: 0; }
.unhurried-about .ua-step-mark { width: 22px; height: 22px; border-radius: 50%; border: 1.5px solid #B9B4A9; display: grid; place-items: center; font-size: 12px; margin-top: 2px; }
.unhurried-about .ua-step.is-done .ua-step-mark { background: #16140F; border-color: #16140F; color: #F6F4EF; }
.unhurried-about .ua-step.is-optional .ua-step-mark { border-style: dashed; }
.unhurried-about .ua-step h3 { font-size: 15px; font-weight: 600; margin: 0 0 4px; }
.unhurried-about .ua-step.is-done h3 { color: #5A564E; }
.unhurried-about .ua-step-state { font-size: 11px; font-weight: 500; letter-spacing: .08em; text-transform: uppercase; color: #8A857B; margin-left: 6px; }
.unhurried-about .ua-step.is-todo .ua-step-state { color: #D44B19; }
.unhurried-about .ua-step p { margin: 0; color: #3b3830; max-width: 70ch; }
.unhurried-about .ua-step .ua-step-actions { margin-top: 10px; display: flex; flex-wrap: wrap; gap: 6px; }
.unhurried-about .ua-step .ua-is-done { color: #5A564E; border-color: #D8D5CE; }
CSS;
		wp_register_style( 'unhurried-about', false, array(), wp_get_theme( get_template() )->get( 'Version' ) );
		wp_enqueue_style( 'unhurried-about' );
		wp_add_inline_style( 'unhurried-about', $css );
	}
endif;
add_action( 'admin_enqueue_scripts', 'unhurried_about_styles' );

if ( ! function_exists( 'unhurried_about_screen' ) ) :
	/**
	 * Renders the About Unhurried screen.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	function unhurried_about_screen() {
		$theme   = wp_get_theme( get_template() );
		$version = $theme->get( 'Version' );
		?>
		<div class="wrap unhurried-about">
			<div class="ua-hero">
				<h1><?php echo wp_kses( __( 'Welcome to <em>Unhurried</em>', 'unhurried' ), array( 'em' => array() ) ); ?></h1>
				<p>
					<?php
					/* translators: %s: Theme version. */
					printf( esc_html__( 'Version %s. A calm, editorial block theme. Everything is edited in the Site Editor, and every section is a pattern you can add, move or remove.', 'unhurried' ), esc_html( $version ) );
					?>
				</p>
			</div>
			<hr class="wp-header-end">

			<?php unhurried_render_setup_card(); ?>

			<div class="ua-grid">
				<div class="ua-card">
					<h2><?php esc_html_e( 'Good to know', 'unhurried' ); ?></h2>
					<ul>
						<li><?php esc_html_e( 'Every section is a pattern: click + in the editor, open Patterns and browse the Unhurried categories.', 'unhurried' ); ?></li>
						<li><?php esc_html_e( 'Italic words in headings turn into the Fraunces accent face.', 'unhurried' ); ?></li>
						<li><?php esc_html_e( 'Every section moves gently as it scrolls into view, and stays still for visitors who ask for reduced motion. Add the class unhurried-still to a block to keep it and everything in it still: nothing in it enters, drifts or moves by itself. What answers the pointer or the keyboard still moves, and a film plays until it is paused.', 'unhurried' ); ?></li>
						<li><?php esc_html_e( 'Add the class unhurried-mono to show a block\'s images in grayscale.', 'unhurried' ); ?></li>
						<li><?php esc_html_e( 'Twenty looks live under Styles in the Site Editor: eight color themes, ten tinted papers and Folio. Switching never moves your content.', 'unhurried' ); ?></li>
					</ul>
				</div>
			</div>

			<div class="ua-grid is-loose">
				<?php unhurried_render_pro_card(); ?>
				<?php unhurried_render_plugins_card(); ?>
			</div>

			<div class="ua-credit">
				<h2><?php esc_html_e( 'Credits', 'unhurried' ); ?></h2>
				<p>
					<?php
					printf(
						/* translators: 1: Designer name, 2: Studio link. */
						esc_html__( 'Unhurried was designed and built by %1$s of %2$s.', 'unhurried' ),
						'Moses Atia Poston',
						'<a href="' . esc_url( 'https://switchcasestudio.com' ) . '">Switch Case Studio</a>'
					);
					?>
				</p>
				<p>
					<?php
					printf(
						/* translators: %s: Studio link. */
						esc_html__( 'Need it set up with your own content, photos and colors? %s can do it for you.', 'unhurried' ),
						'<a href="' . esc_url( 'https://switchcasestudio.com' ) . '">Switch Case Studio</a>'
					);
					?>
				</p>
				<p class="ua-small" style="color:rgba(246,244,239,.65)">
					<?php esc_html_e( '© 2026 Moses Atia Poston, Switch Case Studio. Licensed under the GNU GPL v2 or later.', 'unhurried' ); ?>
				</p>
			</div>

			<div class="ua-card" style="margin-top:20px">
				<h2><?php esc_html_e( 'Resources', 'unhurried' ); ?></h2>
				<ul>
					<li><?php esc_html_e( 'Hanken Grotesk, Inter and Fraunces: SIL Open Font License 1.1.', 'unhurried' ); ?></li>
					<li><?php esc_html_e( 'Photographs: the Cleveland Museum of Art\'s Open Access collection and the Rijksmuseum, all CC0 1.0. Credits per file are in readme.txt.', 'unhurried' ); ?></li>
				</ul>
				<p class="ua-review">
					<?php
					printf(
						/* translators: %s: WordPress.org review link. */
						esc_html__( 'If Unhurried has been good to you, %s helps other studios find it.', 'unhurried' ),
						'<a href="' . esc_url( UNHURRIED_REVIEW_URL ) . '">' . esc_html__( 'a short review on WordPress.org', 'unhurried' ) . '</a>'
					);
					?>
				</p>
			</div>
		</div>
		<?php
	}
endif;
