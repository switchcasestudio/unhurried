<?php
/**
 * Title: Newsletter, Ink band
 * Slug: unhurried/signup-cta
 * Categories: call-to-action, featured
 * Keywords: newsletter, subscribe, email, letter, signup
 * Viewport width: 1400
 * Description: An Ink band with a two-line heading, a short note and a hairline button. Replace the button with your newsletter plugin's form block.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.1.0
 */

?>
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr_x( 'Newsletter', 'Pattern block name', 'unhurried' ); ?>"},"align":"full","className":"is-style-section-ink","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"1360px"}} -->
<div class="wp-block-group alignfull is-style-section-ink" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
	<!-- wp:columns {"verticalAlignment":"bottom","className":"unhurried-reveal","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|80"}}}} -->
	<div class="wp-block-columns are-vertically-aligned-bottom unhurried-reveal">
		<!-- wp:column {"verticalAlignment":"bottom","width":"60%","style":{"spacing":{"blockGap":"var:preset|spacing|50"}}} -->
		<div class="wp-block-column is-vertically-aligned-bottom" style="flex-basis:60%">
			<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
			<p class="is-style-eyebrow"><?php esc_html_e( 'A letter', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:heading {"fontSize":"xx-large"} -->
			<h2 class="wp-block-heading has-xx-large-font-size"><?php echo wp_kses( __( 'A note from us,<br><em>now and then</em>', 'unhurried' ), array( 'em' => array(), 'br' => array() ) ); ?></h2>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"className":"unhurried-dim","fontSize":"large","style":{"typography":{"lineHeight":"1.45"}}} -->
			<p class="unhurried-dim has-large-font-size" style="line-height:1.45"><?php esc_html_e( 'One short letter a season: what is new on the shelf, a recipe, a reading list. Nothing else.', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"verticalAlignment":"bottom","width":"40%","className":"unhurried-signup"} -->
		<div class="wp-block-column is-vertically-aligned-bottom unhurried-signup" style="flex-basis:40%">
			<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"right"}} -->
			<div class="wp-block-buttons">
				<!-- wp:button {"className":"is-style-hairline"} -->
				<div class="wp-block-button is-style-hairline"><a class="wp-block-button__link wp-element-button" href="mailto:hello@example.com?subject=The%20letter"><?php esc_html_e( 'Ask for the letter', 'unhurried' ); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
