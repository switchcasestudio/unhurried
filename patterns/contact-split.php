<?php
/**
 * Title: Contact details and note card
 * Slug: unhurried/contact-split
 * Categories: contact, featured
 * Keywords: contact, address, hours, email, visit
 * Viewport width: 1400
 * Description: Address, hours and email on Stone beside a Bone card inviting a note. Add a form plugin's block inside the card if you use one.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.0.0
 */

?>
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr_x( 'Contact', 'Pattern block name', 'unhurried' ); ?>"},"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"1360px"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
	<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|50"}}}} -->
	<div class="wp-block-columns">
		<!-- wp:column {"width":"42%","className":"unhurried-reveal","backgroundColor":"base-2","style":{"border":{"radius":"24px"},"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70","left":"var:preset|spacing|70","right":"var:preset|spacing|70"},"blockGap":"var:preset|spacing|60"}}} -->
		<div class="wp-block-column unhurried-reveal has-base-2-background-color has-background" style="border-radius:24px;padding-top:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70);padding-left:var(--wp--preset--spacing--70);flex-basis:42%">
			<!-- wp:group {"style":{"spacing":{"blockGap":"0.5rem"}},"layout":{"type":"default"}} -->
			<div class="wp-block-group">
				<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
				<p class="is-style-eyebrow"><?php esc_html_e( 'Visit', 'unhurried' ); ?></p>
				<!-- /wp:paragraph -->
				<!-- wp:paragraph {"fontSize":"large"} -->
				<p class="has-large-font-size"><?php echo wp_kses( __( '12 Linden Row<br>Hillsdale, 00000', 'unhurried' ), array( 'br' => array() ) ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
			<!-- wp:group {"style":{"spacing":{"blockGap":"0.5rem"}},"layout":{"type":"default"}} -->
			<div class="wp-block-group">
				<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
				<p class="is-style-eyebrow"><?php esc_html_e( 'Hours', 'unhurried' ); ?></p>
				<!-- /wp:paragraph -->
				<!-- wp:paragraph -->
				<p><?php echo wp_kses( __( 'Tuesday to Friday, 10 to 7<br>Saturday, 9 to 3', 'unhurried' ), array( 'br' => array() ) ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
			<!-- wp:group {"style":{"spacing":{"blockGap":"0.5rem"}},"layout":{"type":"default"}} -->
			<div class="wp-block-group">
				<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
				<p class="is-style-eyebrow"><?php esc_html_e( 'Write', 'unhurried' ); ?></p>
				<!-- /wp:paragraph -->
				<!-- wp:paragraph -->
				<p><?php esc_html_e( 'hello@example.com', 'unhurried' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"width":"58%","className":"is-style-card unhurried-reveal","style":{"spacing":{"blockGap":"var:preset|spacing|50"},"shadow":"var:preset|shadow|float"}} -->
		<div class="wp-block-column is-style-card unhurried-reveal" style="box-shadow:var(--wp--preset--shadow--float);flex-basis:58%">
			<!-- wp:heading {"fontSize":"xx-large"} -->
			<h2 class="wp-block-heading has-xx-large-font-size"><?php echo wp_kses( __( 'Send a <em>note</em>', 'unhurried' ), array( 'em' => array() ) ); ?></h2>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"textColor":"contrast-2"} -->
			<p class="has-contrast-2-color has-text-color"><?php esc_html_e( 'Questions, gift cards or a group booking. We answer every note ourselves.', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:buttons -->
			<div class="wp-block-buttons">
				<!-- wp:button -->
				<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="mailto:hello@example.com"><?php esc_html_e( 'Email the studio', 'unhurried' ); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
