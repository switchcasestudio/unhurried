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

if ( ! function_exists( 'unhurried_render_pro_card' ) ) :
	/**
	 * The Pro card on the About screen. Hidden when Pro is installed.
	 *
	 * @since 1.1.0
	 * @return void
	 */
	function unhurried_render_pro_card() {
		if ( unhurried_pro_present() ) {
			return;
		}
		$card = unhurried_pro_card();
		?>
		<div class="ua-card ua-pro">
			<h2><?php echo esc_html( $card['eyebrow'] ); ?></h2>
			<h3><?php echo wp_kses( $card['heading'], array( 'em' => array() ) ); ?></h3>
			<p><?php echo esc_html( $card['body'] ); ?></p>
			<p><a class="button button-primary" href="<?php echo esc_url( UNHURRIED_PRO_URL ); ?>"><?php echo esc_html( $card['button'] ); ?></a></p>
		</div>
		<?php
	}
endif;

if ( ! function_exists( 'unhurried_render_plugins_card' ) ) :
	/**
	 * The recommended-plugins card, in one of three layouts.
	 *
	 * @since 1.1.0
	 * @return void
	 */
	function unhurried_render_plugins_card() {
		$plugins = unhurried_recommended_plugins();
		if ( empty( $plugins ) ) {
			return;
		}
		$variant = in_array( UNHURRIED_PLUGINS_VARIANT, array( 'list', 'tiles', 'compact' ), true ) ? UNHURRIED_PLUGINS_VARIANT : 'list';
		?>
		<div class="ua-card ua-plugins is-<?php echo esc_attr( $variant ); ?>">
			<h2><?php esc_html_e( 'Plugins that fit', 'unhurried' ); ?></h2>
			<?php if ( 'compact' === $variant ) : ?>
				<p>
				<?php
				$parts = array();
				foreach ( $plugins as $plugin ) {
					$state   = unhurried_plugin_state( $plugin['slug'] );
					$action  = unhurried_plugin_action( $plugin['slug'], $state );
					$parts[] = $action['url']
						? '<a href="' . esc_url( $action['url'] ) . '">' . esc_html( $plugin['name'] ) . '</a>'
						: esc_html( $plugin['name'] );
				}
				echo wp_kses( implode( ', ', $parts ), array( 'a' => array( 'href' => array() ) ) );
				?>
				</p>
			<?php else : ?>
				<ul>
				<?php foreach ( $plugins as $plugin ) : ?>
					<?php
					$state  = unhurried_plugin_state( $plugin['slug'] );
					$action = unhurried_plugin_action( $plugin['slug'], $state );
					?>
					<li>
						<strong><?php echo esc_html( $plugin['name'] ); ?></strong>
						<span><?php echo esc_html( $plugin['line'] ); ?></span>
						<?php if ( $action['url'] ) : ?>
							<a class="button" href="<?php echo esc_url( $action['url'] ); ?>"><?php echo esc_html( $action['label'] ); ?></a>
						<?php else : ?>
							<em><?php echo esc_html( $action['label'] ); ?></em>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
				</ul>
			<?php endif; ?>
			<p class="ua-small">
				<?php
				printf(
					/* translators: %s: Setup guide link. */
					esc_html__( 'Nothing installs on its own. The %s lists these too; some links there are affiliate links, which help pay for the free theme.', 'unhurried' ),
					'<a href="' . esc_url( UNHURRIED_GUIDE_URL ) . '">' . esc_html__( 'setup guide', 'unhurried' ) . '</a>'
				);
				?>
			</p>
		</div>
		<?php
	}
endif;

if ( ! function_exists( 'unhurried_mark_activated' ) ) :
	/**
	 * Remembers when the theme started being used, for the review ask.
	 * Runs on activation and on admin_init, so sites that update from 1.0.x
	 * (where after_switch_theme never fires again) start their clock at the
	 * update. One autoloaded option, no query after the first visit.
	 *
	 * @since 1.1.0
	 * @return void
	 */
	function unhurried_mark_activated() {
		if ( ! get_option( 'unhurried_activated' ) ) {
			add_option( 'unhurried_activated', time() );
		}
	}
endif;
add_action( 'after_switch_theme', 'unhurried_mark_activated' );
add_action( 'admin_init', 'unhurried_mark_activated' );

if ( ! function_exists( 'unhurried_dismiss_url' ) ) :
	/**
	 * Nonce-protected URL that dismisses a notice for the current user.
	 *
	 * @since 1.1.0
	 * @param string $notice pro|review.
	 * @return string
	 */
	function unhurried_dismiss_url( $notice ) {
		return wp_nonce_url(
			add_query_arg(
				array(
					'action' => 'unhurried_dismiss',
					'notice' => $notice,
				),
				admin_url( 'admin-post.php' )
			),
			'unhurried_dismiss_' . $notice
		);
	}
endif;

if ( ! function_exists( 'unhurried_dismiss_notice' ) ) :
	/**
	 * Handles the Not now link: stores the dismissal, returns to the page.
	 *
	 * @since 1.1.0
	 * @return void
	 */
	function unhurried_dismiss_notice() {
		$notice = isset( $_GET['notice'] ) ? sanitize_key( wp_unslash( $_GET['notice'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- checked below.
		if ( ! in_array( $notice, array( 'pro', 'review' ), true ) || ! current_user_can( 'edit_theme_options' ) ) {
			wp_die( esc_html__( 'Nothing to dismiss.', 'unhurried' ) );
		}
		check_admin_referer( 'unhurried_dismiss_' . $notice );
		update_user_meta( get_current_user_id(), 'unhurried_dismissed_' . $notice, time() );
		$back = wp_get_referer();
		wp_safe_redirect( $back ? $back : admin_url() );
		exit;
	}
endif;
add_action( 'admin_post_unhurried_dismiss', 'unhurried_dismiss_notice' );

if ( ! function_exists( 'unhurried_admin_notices' ) ) :
	/**
	 * At most one notice, on three screens, for theme editors only.
	 *
	 * @since 1.1.0
	 * @return void
	 */
	function unhurried_admin_notices() {
		if ( ! current_user_can( 'edit_theme_options' ) ) {
			return;
		}
		$screen = get_current_screen();
		if ( ! $screen || ! in_array( $screen->id, array( 'dashboard', 'themes', 'appearance_page_unhurried-about' ), true ) ) {
			return;
		}
		$user = get_current_user_id();

		if ( class_exists( 'WooCommerce' ) && ! unhurried_pro_present() && ! get_user_meta( $user, 'unhurried_dismissed_pro', true ) ) {
			?>
			<div class="notice notice-info">
				<p><strong><?php esc_html_e( 'WooCommerce is on.', 'unhurried' ); ?></strong> <?php esc_html_e( 'Your shop pages are still in WooCommerce\'s default look. Unhurried Pro styles the shop, product, cart and checkout pages to match the rest of your site.', 'unhurried' ); ?></p>
				<p><a class="button button-primary" href="<?php echo esc_url( UNHURRIED_PRO_URL ); ?>"><?php esc_html_e( 'See Unhurried Pro', 'unhurried' ); ?></a> <a href="<?php echo esc_url( unhurried_dismiss_url( 'pro' ) ); ?>"><?php esc_html_e( 'Not now', 'unhurried' ); ?></a></p>
			</div>
			<?php
			return;
		}

		$since = (int) get_option( 'unhurried_activated', 0 );
		$days  = (int) apply_filters( 'unhurried_notice_days', 14 );
		if ( $since && ( time() - $since ) > $days * DAY_IN_SECONDS && ! get_user_meta( $user, 'unhurried_dismissed_review', true ) ) {
			?>
			<div class="notice notice-info">
				<p><?php esc_html_e( 'Two weeks with Unhurried. If it has been good to you, a short review on WordPress.org helps other studios find it.', 'unhurried' ); ?></p>
				<p><a class="button button-primary" href="<?php echo esc_url( UNHURRIED_REVIEW_URL ); ?>"><?php esc_html_e( 'Leave a review', 'unhurried' ); ?></a> <a href="<?php echo esc_url( unhurried_dismiss_url( 'review' ) ); ?>"><?php esc_html_e( 'Not now', 'unhurried' ); ?></a></p>
			</div>
			<?php
		}
	}
endif;
add_action( 'admin_notices', 'unhurried_admin_notices' );
