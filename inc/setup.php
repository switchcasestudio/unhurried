<?php
/**
 * Setup checklist: the steps from a fresh install to a finished site, each
 * with its live status and one button, shown on Appearance > About Unhurried.
 *
 * Nothing is created for the user. A "Create" button opens a new page in the
 * editor already filled with the matching page pattern and template; the user
 * reviews it and publishes it with their own click.
 *
 * @package Unhurried
 * @author  Moses Atia Poston, Switch Case Studio
 * @copyright 2026 Moses Atia Poston, Switch Case Studio
 * @license GPL-2.0-or-later
 * @since 1.2.0
 */

if ( ! function_exists( 'unhurried_starter_pages' ) ) :
	/**
	 * Pages the checklist can open ready-made: slug => title, pattern, template.
	 *
	 * @since 1.2.0
	 * @return array<string, array{title:string, pattern:string, template:string}>
	 */
	function unhurried_starter_pages() {
		$pages = array(
			'home'          => array( __( 'Home', 'unhurried' ), 'page-home', 'page-ground' ),
			'about'         => array( __( 'About', 'unhurried' ), 'page-about', 'page-canvas' ),
			'services'      => array( __( 'Services', 'unhurried' ), 'page-services', 'page-canvas' ),
			'contact'       => array( __( 'Contact', 'unhurried' ), 'page-contact', 'page-canvas' ),
			'work'          => array( __( 'Work', 'unhurried' ), 'page-work', 'page-canvas' ),
			'pricing'       => array( __( 'Pricing', 'unhurried' ), 'page-pricing', 'page-canvas' ),
			'visit'         => array( __( 'Visit', 'unhurried' ), 'page-visit', 'page-canvas' ),
			'topics'        => array( __( 'Topics', 'unhurried' ), 'page-topics', 'page-canvas' ),
			'journal'       => array( __( 'Journal', 'unhurried' ), '', '' ),
			// Nested under Services: /services/{group}/{service}/. Untitled, so the user names them.
			'service-group' => array( '', 'page-service-group', 'page-canvas' ),
			'service'       => array( '', 'page-service', 'page-canvas' ),
		);
		$out = array();
		foreach ( $pages as $slug => $page ) {
			$out[ $slug ] = array(
				'title'    => $page[0],
				'pattern'  => $page[1],
				'template' => $page[2],
			);
		}
		return $out;
	}
endif;

if ( ! function_exists( 'unhurried_new_page_url' ) ) :
	/**
	 * Editor URL for a new page prefilled from unhurried_starter_pages().
	 *
	 * @since 1.2.0
	 * @param string $slug Key of unhurried_starter_pages().
	 * @return string
	 */
	function unhurried_new_page_url( $slug ) {
		return add_query_arg(
			array(
				'post_type'      => 'page',
				'unhurried_page' => $slug,
			),
			admin_url( 'post-new.php' )
		);
	}
endif;

if ( ! function_exists( 'unhurried_prefill_page' ) ) :
	/**
	 * Fills a new page opened from the checklist: title, pattern and template.
	 *
	 * Runs on default_content, after WordPress has saved the new page as an
	 * auto-draft, so the template can be set before the editor loads.
	 *
	 * @since 1.2.0
	 * @param string  $content Default content.
	 * @param WP_Post $post    The new auto-draft.
	 * @return string
	 */
	function unhurried_prefill_page( $content, $post ) {
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only choice from a fixed list; the user still publishes.
		$slug  = isset( $_GET['unhurried_page'] ) ? sanitize_key( wp_unslash( $_GET['unhurried_page'] ) ) : '';
		$pages = unhurried_starter_pages();
		if ( '' === $slug || ! isset( $pages[ $slug ] ) || ! $post instanceof WP_Post || 'page' !== $post->post_type || ! current_user_can( 'edit_pages' ) ) {
			return $content;
		}
		$page = $pages[ $slug ];
		if ( '' !== $page['template'] ) {
			update_post_meta( $post->ID, '_wp_page_template', $page['template'] );
		}
		// A service group starts nested under Services; a service is placed
		// under its group by the user (Page settings, Parent).
		$services = 'service-group' === $slug ? unhurried_page_exists( 'services' ) : null;
		if ( $services ) {
			wp_update_post(
				array(
					'ID'          => $post->ID,
					'post_parent' => $services->ID,
				)
			);
		}
		return '' !== $page['pattern'] ? '<!-- wp:pattern {"slug":"unhurried/' . $page['pattern'] . '"} /-->' : $content;
	}
endif;
add_filter( 'default_content', 'unhurried_prefill_page', 10, 2 );

if ( ! function_exists( 'unhurried_prefill_title' ) ) :
	/**
	 * Gives a page opened from the checklist its title.
	 *
	 * @since 1.2.0
	 * @param string $title Default title.
	 * @return string
	 */
	function unhurried_prefill_title( $title ) {
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only choice from a fixed list.
		$slug  = isset( $_GET['unhurried_page'] ) ? sanitize_key( wp_unslash( $_GET['unhurried_page'] ) ) : '';
		$pages = unhurried_starter_pages();
		return ( '' !== $slug && isset( $pages[ $slug ] ) && '' !== $pages[ $slug ]['title'] ) ? $pages[ $slug ]['title'] : $title;
	}
endif;
add_filter( 'default_title', 'unhurried_prefill_title' );

if ( ! function_exists( 'unhurried_site_editor_url' ) ) :
	/**
	 * Site Editor link that works on WordPress 6.6 and 6.7 (old routes) and 6.8+.
	 *
	 * @since 1.2.0
	 * @param string $where navigation|styles|header|footer.
	 * @return string
	 */
	function unhurried_site_editor_url( $where ) {
		$new  = version_compare( get_bloginfo( 'version' ), '6.8', '>=' );
		$part = get_stylesheet() . '//' . $where;
		switch ( $where ) {
			case 'navigation':
				$args = $new ? array( 'p' => '/navigation' ) : array( 'path' => '/navigation' );
				break;
			case 'styles':
				$args = $new ? array( 'p' => '/styles' ) : array( 'path' => '/wp_global_styles' );
				break;
			default:
				$args = $new
					? array(
						'p'      => '/wp_template_part/' . $part,
						'canvas' => 'edit',
					)
					: array(
						'postType' => 'wp_template_part',
						'postId'   => $part,
						'canvas'   => 'edit',
					);
		}
		return add_query_arg( array_map( 'rawurlencode', $args ), admin_url( 'site-editor.php' ) );
	}
endif;

if ( ! function_exists( 'unhurried_page_exists' ) ) :
	/**
	 * Whether a published or draft page has this slug.
	 *
	 * @since 1.2.0
	 * @param string $slug Page slug.
	 * @return WP_Post|null
	 */
	function unhurried_page_exists( $slug ) {
		$page = get_page_by_path( $slug );
		return ( $page && in_array( $page->post_status, array( 'publish', 'draft', 'future', 'private' ), true ) ) ? $page : null;
	}
endif;

if ( ! function_exists( 'unhurried_footer_has_social' ) ) :
	/**
	 * Whether the site's own (edited) footer has a social icon with an address.
	 *
	 * @since 1.2.0
	 * @return bool
	 */
	function unhurried_footer_has_social() {
		$part = get_block_template( get_stylesheet() . '//footer', 'wp_template_part' );
		return $part && 'custom' === $part->source && (bool) preg_match( '/wp:social-link \{[^}]*"url":"(https?:|mailto:)/', (string) $part->content );
	}
endif;

if ( ! function_exists( 'unhurried_setup_steps' ) ) :
	/**
	 * The checklist. Each step: id, title, text, done (true, false or null
	 * for optional), and actions (label, url, primary).
	 *
	 * @since 1.2.0
	 * @return array[]
	 */
	function unhurried_setup_steps() {
		$tagline   = trim( (string) get_bloginfo( 'description' ) );
		$front_id  = ( 'page' === get_option( 'show_on_front' ) ) ? (int) get_option( 'page_on_front' ) : 0;
		$posts_id  = (int) get_option( 'page_for_posts' );
		$reading   = admin_url( 'options-reading.php' );
		$plugin_cb = static function ( $slug, $label ) {
			$state  = unhurried_plugin_state( $slug );
			$action = unhurried_plugin_action( $slug, $state );
			return array(
				'state'   => $state,
				'actions' => $action['url'] ? array(
					array(
						'label'   => sprintf( '%1$s %2$s', $action['label'], $label ),
						'url'     => $action['url'],
						'primary' => true,
					),
				) : array(),
			);
		};

		$nav = get_posts(
			array(
				'post_type'   => 'wp_navigation',
				'post_status' => 'publish',
				'numberposts' => 1,
				'fields'      => 'ids',
			)
		);

		$pages_done = unhurried_page_exists( 'about' ) && unhurried_page_exists( 'services' ) && unhurried_page_exists( 'contact' );
		$page_links = array();
		$pages      = unhurried_starter_pages();
		foreach ( array( 'about', 'services', 'contact', 'work', 'pricing', 'visit', 'topics' ) as $slug ) {
			$existing     = unhurried_page_exists( $slug );
			$page_links[] = array(
				'label'   => $existing
					/* translators: %s: Page title. */
					? sprintf( __( '%s ✓', 'unhurried' ), $pages[ $slug ]['title'] )
					/* translators: %s: Page title. */
					: sprintf( __( 'Create %s', 'unhurried' ), $pages[ $slug ]['title'] ),
				'url'     => $existing ? (string) get_edit_post_link( $existing->ID, 'raw' ) : unhurried_new_page_url( $slug ),
				'primary' => false,
				'done'    => (bool) $existing,
			);
		}

		$newsletter = $plugin_cb( 'newsletter', 'Newsletter' );
		// Contact Form 7 needs PHP 8.3; on older hosts WPForms Lite does the same job.
		$forms      = version_compare( PHP_VERSION, '8.3', '>=' ) ? $plugin_cb( 'contact-form-7', 'Contact Form 7' ) : $plugin_cb( 'wpforms-lite', 'WPForms Lite' );
		$has_form   = 'active' === unhurried_plugin_state( 'contact-form-7' ) || 'active' === unhurried_plugin_state( 'wpforms-lite' ) || 'active' === unhurried_plugin_state( 'wpforms' );

		$steps = array(
			array(
				'id'      => 'identity',
				'title'   => __( 'Name your site', 'unhurried' ),
				'text'    => __( 'The site title becomes the giant footer wordmark; the tagline leads the footer and the marquee.', 'unhurried' ),
				'done'    => '' !== $tagline,
				'actions' => array(
					array(
						'label'   => __( 'Open General settings', 'unhurried' ),
						'url'     => admin_url( 'options-general.php' ),
						'primary' => true,
					),
				),
			),
			array(
				'id'      => 'home',
				'title'   => __( 'Create your homepage', 'unhurried' ),
				'text'    => __( 'Opens a new page with the full homepage layout and the Ground template already chosen. Publish it, then make it the homepage in Reading settings.', 'unhurried' ),
				'done'    => $front_id > 0 && 'publish' === get_post_status( $front_id ),
				'actions' => array(
					array(
						'label'   => __( 'Create the homepage', 'unhurried' ),
						'url'     => unhurried_new_page_url( 'home' ),
						'primary' => true,
					),
					array(
						'label'   => __( 'Reading settings', 'unhurried' ),
						'url'     => $reading,
						'primary' => false,
					),
				),
			),
			array(
				'id'      => 'journal',
				'title'   => __( 'Give your posts a page', 'unhurried' ),
				'text'    => __( 'Create an empty page called Journal (or Blog) and pick it as the Posts page in Reading settings. The theme adds the topic chips, search and grid.', 'unhurried' ),
				'done'    => $posts_id > 0 || 'posts' === get_option( 'show_on_front' ),
				'actions' => array(
					array(
						'label'   => __( 'Create the Journal page', 'unhurried' ),
						'url'     => unhurried_new_page_url( 'journal' ),
						'primary' => true,
					),
					array(
						'label'   => __( 'Reading settings', 'unhurried' ),
						'url'     => $reading,
						'primary' => false,
					),
				),
			),
			array(
				'id'      => 'pages',
				'title'   => __( 'Add your pages', 'unhurried' ),
				'text'    => __( 'Each one opens ready-made, with its layout and template. Edit the words and photos, then publish. A page called Contact also turns on the header button.', 'unhurried' ),
				'done'    => $pages_done,
				'actions' => $page_links,
			),
			array(
				'id'      => 'services',
				'title'   => __( 'Group your services', 'unhurried' ),
				'text'    => __( 'Give each kind of service a page under Services, and each service a page under its kind (Page settings, Parent), for addresses like /services/design/identity/. Services and each group list the pages under them as cards, with breadcrumbs back up; the excerpt and featured image fill each card.', 'unhurried' ),
				'done'    => null,
				'actions' => array(
					array(
						'label'   => __( 'Add a service group', 'unhurried' ),
						'url'     => unhurried_new_page_url( 'service-group' ),
						'primary' => false,
					),
					array(
						'label'   => __( 'Add a service', 'unhurried' ),
						'url'     => unhurried_new_page_url( 'service' ),
						'primary' => false,
					),
				),
			),
			array(
				'id'      => 'menu',
				'title'   => __( 'Set your menu', 'unhurried' ),
				'text'    => __( 'Choose which pages appear in the header and the footer, and drag them into order. Keep it to the pages people look for; a dropdown only where pages truly belong together, such as Services and its groups.', 'unhurried' ),
				'done'    => (bool) $nav,
				'actions' => array(
					array(
						'label'   => __( 'Open menus', 'unhurried' ),
						'url'     => unhurried_site_editor_url( 'navigation' ),
						'primary' => true,
					),
				),
			),
			array(
				'id'      => 'social',
				'title'   => __( 'Add your social profiles', 'unhurried' ),
				'text'    => __( 'Select each footer icon and paste your profile address. Icons you leave empty stay hidden from visitors.', 'unhurried' ),
				'done'    => unhurried_footer_has_social(),
				'actions' => array(
					array(
						'label'   => __( 'Edit the footer', 'unhurried' ),
						'url'     => unhurried_site_editor_url( 'footer' ),
						'primary' => true,
					),
				),
			),
			array(
				'id'      => 'newsletter',
				'title'   => __( 'Collect newsletter signups', 'unhurried' ),
				'text'    => __( 'The free Newsletter plugin keeps subscribers in your own WordPress. Once it is active, its form appears in the footer and the Newsletter band by itself.', 'unhurried' ),
				'done'    => 'active' === $newsletter['state'] || 'active' === unhurried_plugin_state( 'jetpack' ),
				'actions' => $newsletter['actions'],
			),
			array(
				'id'      => 'forms',
				'title'   => __( 'Take messages', 'unhurried' ),
				'text'    => __( 'With Contact Form 7 (or WPForms) active, your first form appears in the card on the Contact page by itself, styled to match.', 'unhurried' ),
				'done'    => $has_form,
				'actions' => $has_form ? array() : $forms['actions'],
			),
			array(
				'id'      => 'look',
				'title'   => __( 'Pick a look', 'unhurried' ),
				'text'    => __( 'Try the color and paper styles. Switching never moves your content.', 'unhurried' ),
				'done'    => null,
				'actions' => array(
					array(
						'label'   => __( 'Open Styles', 'unhurried' ),
						'url'     => unhurried_site_editor_url( 'styles' ),
						'primary' => true,
					),
				),
			),
		);

		/**
		 * Filters the setup checklist on the About screen.
		 *
		 * @since 1.2.0
		 * @param array[] $steps Steps.
		 */
		return apply_filters( 'unhurried_setup_steps', $steps );
	}
endif;

if ( ! function_exists( 'unhurried_setup_progress' ) ) :
	/**
	 * Done and total counts of the required (non-optional) steps.
	 *
	 * @since 1.2.0
	 * @return array{done:int, total:int}
	 */
	function unhurried_setup_progress() {
		$done  = 0;
		$total = 0;
		foreach ( unhurried_setup_steps() as $step ) {
			if ( null === $step['done'] ) {
				continue;
			}
			++$total;
			$done += $step['done'] ? 1 : 0;
		}
		return array(
			'done'  => $done,
			'total' => $total,
		);
	}
endif;

if ( ! function_exists( 'unhurried_render_setup_card' ) ) :
	/**
	 * Prints the checklist card.
	 *
	 * @since 1.2.0
	 * @return void
	 */
	function unhurried_render_setup_card() {
		$steps    = unhurried_setup_steps();
		$progress = unhurried_setup_progress();
		?>
		<div class="ua-card ua-setup" id="unhurried-setup">
			<div class="ua-setup-head">
				<h2><?php esc_html_e( 'Set up your site', 'unhurried' ); ?></h2>
				<p class="ua-setup-count">
					<?php
					/* translators: 1: Steps done, 2: Steps in total. */
					printf( esc_html__( '%1$d of %2$d done', 'unhurried' ), (int) $progress['done'], (int) $progress['total'] );
					?>
				</p>
			</div>
			<div class="ua-setup-bar" aria-hidden="true"><span style="width:<?php echo esc_attr( (string) ( $progress['total'] ? round( 100 * $progress['done'] / $progress['total'] ) : 0 ) ); ?>%"></span></div>
			<ol class="ua-steps">
				<?php foreach ( $steps as $step ) : ?>
					<?php
					$state = ( null === $step['done'] ) ? 'is-optional' : ( $step['done'] ? 'is-done' : 'is-todo' );
					$label = ( null === $step['done'] ) ? __( 'Optional', 'unhurried' ) : ( $step['done'] ? __( 'Done', 'unhurried' ) : __( 'To do', 'unhurried' ) );
					?>
					<li class="ua-step <?php echo esc_attr( $state ); ?>">
						<span class="ua-step-mark" aria-hidden="true"><?php echo $step['done'] ? '✓' : ''; ?></span>
						<div>
							<h3><?php echo esc_html( $step['title'] ); ?> <span class="ua-step-state"><?php echo esc_html( $label ); ?></span></h3>
							<p><?php echo esc_html( $step['text'] ); ?></p>
							<?php if ( ! empty( $step['actions'] ) ) : ?>
							<p class="ua-step-actions">
								<?php foreach ( $step['actions'] as $action ) : ?>
									<?php
									if ( $step['done'] && false !== strpos( $action['url'], 'unhurried_page=' ) ) {
										continue; // Done: no second copy of the page.
									}
									?>
									<a class="button<?php echo ! empty( $action['primary'] ) && ! $step['done'] ? ' button-primary' : ''; ?><?php echo ! empty( $action['done'] ) ? ' ua-is-done' : ''; ?>" href="<?php echo esc_url( $action['url'] ); ?>"><?php echo esc_html( $action['label'] ); ?></a>
								<?php endforeach; ?>
							</p>
							<?php endif; ?>
						</div>
					</li>
				<?php endforeach; ?>
			</ol>
		</div>
		<?php
	}
endif;
