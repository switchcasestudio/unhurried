<?php
/**
 * Title: Gift card
 * Slug: unhurried/gift-card
 * Categories: featured, call-to-action
 * Keywords: gift, voucher, card, present, give, birthday
 * Viewport width: 1400
 * Description: A Ground band with a short pitch, the price and a button, beside an Ink gift card drawn from your site title.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.1.0
 */

?>
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr_x( 'Gift card', 'Pattern block name', 'unhurried' ); ?>"},"align":"full","className":"is-style-section-ground","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"1360px"}} -->
<div class="wp-block-group alignfull is-style-section-ground" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
	<!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|70","left":"var:preset|spacing|80"}}}} -->
	<div class="wp-block-columns are-vertically-aligned-center">
		<!-- wp:column {"verticalAlignment":"center","width":"52%","className":"unhurried-reveal","style":{"spacing":{"blockGap":"var:preset|spacing|50"}}} -->
		<div class="wp-block-column is-vertically-aligned-center unhurried-reveal" style="flex-basis:52%">
			<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
			<p class="is-style-eyebrow"><?php esc_html_e( 'Gift cards', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:heading {"fontSize":"xx-large"} -->
			<h2 class="wp-block-heading has-xx-large-font-size"><?php echo wp_kses( __( 'Give someone<br>an <em>hour</em>', 'unhurried' ), array( 'em' => array(), 'br' => array() ) ); ?></h2>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"textColor":"contrast-2","fontSize":"large","style":{"typography":{"lineHeight":"1.45"},"layout":{"selfStretch":"fixed","flexSize":"min(100%, 36ch)"}}} -->
			<p class="has-contrast-2-color has-text-color has-large-font-size" style="line-height:1.45"><?php esc_html_e( 'Any amount from $60, good for a year, sent by post or by email the same day.', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:buttons -->
			<div class="wp-block-buttons">
				<!-- wp:button -->
				<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( unhurried_page_link( 'contact' ) ); ?>"><?php esc_html_e( 'Buy a gift card', 'unhurried' ); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"verticalAlignment":"center","width":"48%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:48%">
			<!-- wp:group {"className":"is-style-section-ink unhurried-giftcard unhurried-reveal","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|60","right":"var:preset|spacing|60"}}},"layout":{"type":"default"}} -->
			<div class="wp-block-group is-style-section-ink unhurried-giftcard unhurried-reveal" style="padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--60)">
				<!-- wp:group {"layout":{"type":"flex","justifyContent":"space-between","flexWrap":"nowrap"}} -->
				<div class="wp-block-group">
					<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
					<p class="is-style-eyebrow"><?php esc_html_e( 'Gift card', 'unhurried' ); ?></p>
					<!-- /wp:paragraph -->
					<!-- wp:paragraph {"fontFamily":"accent","fontSize":"medium","style":{"typography":{"fontStyle":"italic"}}} -->
					<p class="has-accent-font-family has-medium-font-size" style="font-style:italic"><?php esc_html_e( 'for someone you like', 'unhurried' ); ?></p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
				<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
				<div class="wp-block-group">
					<!-- wp:site-title {"level":0,"fontSize":"x-large","style":{"typography":{"fontWeight":"500","letterSpacing":"-0.03em","lineHeight":"1"}}} /-->
					<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
					<p class="is-style-eyebrow"><?php esc_html_e( 'Valid twelve months', 'unhurried' ); ?></p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
