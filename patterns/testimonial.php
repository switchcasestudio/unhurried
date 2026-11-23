<?php
/**
 * Title: Testimonial panel
 * Slug: unhurried/testimonial
 * Categories: testimonials
 * Keywords: testimonial, review, quote
 * Viewport width: 1400
 * Description: A single large italic quote in a floating panel.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.0.0
 */

?>
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr_x( 'Testimonial', 'Pattern block name', 'unhurried' ); ?>"},"align":"full","className":"is-style-section-ground","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80","left":"clamp(12px, 2vw, 44px)","right":"clamp(12px, 2vw, 44px)"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group alignfull is-style-section-ground" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-right:clamp(12px, 2vw, 44px);padding-bottom:var(--wp--preset--spacing--80);padding-left:clamp(12px, 2vw, 44px)">
	<!-- wp:group {"className":"is-style-panel unhurried-reveal","style":{"spacing":{"blockGap":"var:preset|spacing|60"}},"layout":{"type":"constrained","contentSize":"980px"}} -->
	<div class="wp-block-group is-style-panel unhurried-reveal">
		<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
		<p class="is-style-eyebrow"><?php esc_html_e( 'Lorem fames lacus', 'unhurried' ); ?></p>
		<!-- /wp:paragraph -->
		<!-- wp:quote -->
		<blockquote class="wp-block-quote">
			<!-- wp:paragraph -->
			<p><?php esc_html_e( 'Lorem cillum non egestas anim ex fugiat ea, qui in nunc eget diam velit magna nulla. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam.', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
			<cite><?php esc_html_e( 'Lorem eiusmod, lorem est ipsum mollit', 'unhurried' ); ?></cite>
		</blockquote>
		<!-- /wp:quote -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
