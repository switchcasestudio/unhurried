<?php
/**
 * About Unhurried: a getting-started and credits screen under Appearance.
 *
 * @package Unhurried
 * @author  Moses Atia Poston, Switch Case Studio
 * @since 1.0.0
 */

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
			<style>
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
			</style>

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

			<div class="ua-grid">
				<div class="ua-card">
					<h2><?php esc_html_e( 'Start here', 'unhurried' ); ?></h2>
					<ol>
						<li><?php esc_html_e( 'Create a page and choose the Ground artboard template.', 'unhurried' ); ?></li>
						<li><?php esc_html_e( 'Pick the Homepage pattern when WordPress offers page patterns.', 'unhurried' ); ?></li>
						<li><?php esc_html_e( 'Set it as your homepage under Settings > Reading.', 'unhurried' ); ?></li>
					</ol>
					<p><a class="button button-primary" href="<?php echo esc_url( admin_url( 'site-editor.php' ) ); ?>"><?php esc_html_e( 'Open the Site Editor', 'unhurried' ); ?></a></p>
				</div>
				<div class="ua-card">
					<h2><?php esc_html_e( 'Good to know', 'unhurried' ); ?></h2>
					<ul>
						<li><?php esc_html_e( 'Italic words in headings turn into the Fraunces accent face.', 'unhurried' ); ?></li>
						<li><?php esc_html_e( 'Add the class unhurried-reveal to any block for a gentle scroll reveal.', 'unhurried' ); ?></li>
						<li><?php esc_html_e( 'Add the class unhurried-mono to show a block\'s images in greyscale.', 'unhurried' ); ?></li>
						<li><?php esc_html_e( 'Try the Nocturne and Linen styles under Styles in the Site Editor.', 'unhurried' ); ?></li>
					</ul>
				</div>
			</div>

			<div class="ua-grid" style="margin-top:20px">
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
						esc_html__( 'Need it set up with your own content, photos and colours? %s can do it for you.', 'unhurried' ),
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
					<li><?php esc_html_e( 'Theme images: created for Unhurried, CC0 1.0.', 'unhurried' ); ?></li>
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
