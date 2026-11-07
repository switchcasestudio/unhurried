<?php
/**
 * Title: Process panel
 * Slug: unhurried/process-panel
 * Categories: featured, text
 * Keywords: process, steps, how it works, panel
 * Viewport width: 1400
 * Description: A floating Bone panel that rises over the section above, with a two-line title, four numbered steps and a closing line with a button.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.0.0
 */

$unhurried_steps = array(
	array( __( 'Arrive', 'unhurried' ), __( 'Leave the day at the door. We will take it from here.', 'unhurried' ) ),
	array( __( 'Settle in', 'unhurried' ), __( 'Tea, a warm room and ten quiet minutes before anything starts.', 'unhurried' ) ),
	array( __( 'The ritual', 'unhurried' ), __( 'An hour or two that belongs entirely to you.', 'unhurried' ) ),
	array( __( 'Take it home', 'unhurried' ), __( 'Something small to take home, and a reason to come back.', 'unhurried' ) ),
);
?>
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr_x( 'Process', 'Pattern block name', 'unhurried' ); ?>"},"align":"full","className":"is-style-section-ground","style":{"spacing":{"padding":{"top":"0","bottom":"var:preset|spacing|80","left":"clamp(12px, 2vw, 44px)","right":"clamp(12px, 2vw, 44px)"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group alignfull is-style-section-ground" style="margin-top:0;margin-bottom:0;padding-top:0;padding-right:clamp(12px, 2vw, 44px);padding-bottom:var(--wp--preset--spacing--80);padding-left:clamp(12px, 2vw, 44px)">
	<!-- wp:group {"className":"is-style-panel unhurried-rise unhurried-reveal","style":{"spacing":{"blockGap":"var:preset|spacing|70"}},"layout":{"type":"default"}} -->
	<div class="wp-block-group is-style-panel unhurried-rise unhurried-reveal">
		<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|50"}},"layout":{"type":"default"}} -->
		<div class="wp-block-group">
			<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
			<p class="is-style-eyebrow"><?php esc_html_e( 'Your visit', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:heading {"fontSize":"xx-large"} -->
			<h2 class="wp-block-heading has-xx-large-font-size"><?php echo wp_kses( __( 'How a visit<br><em>unfolds</em>', 'unhurried' ), array( 'em' => array(), 'br' => array() ) ); ?></h2>
			<!-- /wp:heading -->
		</div>
		<!-- /wp:group -->
		<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|60"}}}} -->
		<div class="wp-block-columns">
			<?php foreach ( $unhurried_steps as $unhurried_i => $unhurried_step ) : ?>
			<!-- wp:column {"className":"unhurried-step","style":{"spacing":{"blockGap":"0.5rem"}}} -->
			<div class="wp-block-column unhurried-step">
				<!-- wp:paragraph {"className":"unhurried-numeral"} -->
				<p class="unhurried-numeral"><?php echo esc_html( sprintf( '%02d', $unhurried_i + 1 ) ); ?></p>
				<!-- /wp:paragraph -->
				<!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.125rem","fontWeight":"600","letterSpacing":"0"}}} -->
				<h3 class="wp-block-heading" style="font-size:1.125rem;font-weight:600;letter-spacing:0"><?php echo esc_html( $unhurried_step[0] ); ?></h3>
				<!-- /wp:heading -->
				<!-- wp:paragraph {"textColor":"contrast-2","fontSize":"small"} -->
				<p class="has-contrast-2-color has-text-color has-small-font-size"><?php echo esc_html( $unhurried_step[1] ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:column -->
			<?php endforeach; ?>
		</div>
		<!-- /wp:columns -->
		<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|60"}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
		<div class="wp-block-group">
			<!-- wp:paragraph {"className":"is-style-statement","style":{"layout":{"selfStretch":"fixed","flexSize":"min(100%, 22ch)"}}} -->
			<p class="is-style-statement"><?php echo wp_kses( __( 'No clocks on the walls, <em>no rush</em> at the door.', 'unhurried' ), array( 'em' => array() ) ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:buttons -->
			<div class="wp-block-buttons">
				<!-- wp:button -->
				<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( unhurried_page_link( 'contact' ) ); ?>"><?php esc_html_e( 'Plan a visit', 'unhurried' ); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
