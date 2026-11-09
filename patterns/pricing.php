<?php
/**
 * Title: Pricing tiers
 * Slug: unhurried/pricing
 * Categories: featured, services
 * Keywords: pricing, plans, membership, programs, tiers
 * Viewport width: 1400
 * Description: Three equal-height tiers; the featured tier is set apart by an Ink surface, not by size.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.0.0
 */

$unhurried_tiers = array(
	array( __( 'Monthly', 'unhurried' ), '$120', __( 'One visit a month and a member price on everything else.', 'unhurried' ), false ),
	array( __( 'Fortnightly', 'unhurried' ), '$220', __( 'Two visits a month and a guest pass each season.', 'unhurried' ), true ),
	array( __( 'Regular', 'unhurried' ), '$390', __( 'Unlimited visits, first pick of new rituals and a guest pass each season.', 'unhurried' ), false ),
);
?>
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr_x( 'Pricing', 'Pattern block name', 'unhurried' ); ?>"},"align":"full","className":"is-style-section-ground","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"},"blockGap":"var:preset|spacing|70"}},"layout":{"type":"constrained","contentSize":"1360px"}} -->
<div class="wp-block-group alignfull is-style-section-ground" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
	<!-- wp:heading {"textAlign":"center","fontSize":"xx-large"} -->
	<h2 class="wp-block-heading has-text-align-center has-xx-large-font-size"><?php echo wp_kses( __( 'Come <em>often</em>', 'unhurried' ), array( 'em' => array() ) ); ?></h2>
	<!-- /wp:heading -->
	<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|40","left":"var:preset|spacing|40"}}}} -->
	<div class="wp-block-columns">
		<?php foreach ( $unhurried_tiers as $unhurried_tier ) : ?>
		<?php if ( $unhurried_tier[3] ) : ?>
		<!-- wp:column {"className":"is-style-section-ink unhurried-reveal","style":{"border":{"radius":"24px"},"spacing":{"padding":{"top":"clamp(1.5rem, 3vw, 3rem)","bottom":"clamp(1.5rem, 3vw, 3rem)","left":"clamp(1.5rem, 3vw, 3rem)","right":"clamp(1.5rem, 3vw, 3rem)"},"blockGap":"var:preset|spacing|50"}}} -->
		<div class="wp-block-column is-style-section-ink unhurried-reveal" style="border-radius:24px;padding-top:clamp(1.5rem, 3vw, 3rem);padding-right:clamp(1.5rem, 3vw, 3rem);padding-bottom:clamp(1.5rem, 3vw, 3rem);padding-left:clamp(1.5rem, 3vw, 3rem)">
		<?php else : ?>
		<!-- wp:column {"className":"is-style-card unhurried-reveal","style":{"spacing":{"blockGap":"var:preset|spacing|50"}}} -->
		<div class="wp-block-column is-style-card unhurried-reveal">
		<?php endif; ?>
			<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
			<p class="is-style-eyebrow"><?php echo esc_html( $unhurried_tier[0] ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph {"fontFamily":"display","fontSize":"xx-large","style":{"typography":{"fontWeight":"500","letterSpacing":"-0.03em","lineHeight":"1"}}} -->
			<p class="has-display-font-family has-xx-large-font-size" style="font-weight:500;letter-spacing:-0.03em;line-height:1"><?php echo esc_html( $unhurried_tier[1] ); ?><sub style="font-size:0.3em;letter-spacing:0"><?php esc_html_e( '/month', 'unhurried' ); ?></sub></p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph -->
			<p><?php echo esc_html( $unhurried_tier[2] ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:buttons -->
			<div class="wp-block-buttons">
				<?php if ( $unhurried_tier[3] ) : ?>
				<!-- wp:button -->
				<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( unhurried_page_link( 'contact' ) ); ?>"><?php esc_html_e( 'Choose', 'unhurried' ); ?></a></div>
				<?php else : ?>
				<!-- wp:button {"className":"is-style-hairline"} -->
				<div class="wp-block-button is-style-hairline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( unhurried_page_link( 'contact' ) ); ?>"><?php esc_html_e( 'Choose', 'unhurried' ); ?></a></div>
				<?php endif; ?>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->
		<?php endforeach; ?>
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
