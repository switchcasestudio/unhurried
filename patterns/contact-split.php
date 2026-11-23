<?php
/**
 * Title: Contact details and note card
 * Slug: unhurried/contact-split
 * Categories: contact, featured
 * Keywords: contact, address, hours, email, visit
 * Viewport width: 1400
 * Description: Address, hours and email on Stone beside a Bone card inviting a note. With Contact Form 7 or WPForms active, the card holds your first form, styled to match; otherwise it offers an Email us button.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.0.0
 */

// The first form from Contact Form 7 or WPForms (see unhurried_contact_form()), or an Email us button.
$unhurried_form = unhurried_contact_form();
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
				<p class="is-style-eyebrow"><?php esc_html_e( 'Lorem', 'unhurried' ); ?></p>
				<!-- /wp:paragraph -->
				<!-- wp:paragraph {"fontSize":"large"} -->
				<p class="has-large-font-size"><?php echo wp_kses( __( '12 Lorem Sit<br>Consequat, 00000', 'unhurried' ), array( 'br' => array() ) ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
			<!-- wp:group {"style":{"spacing":{"blockGap":"0.5rem"}},"layout":{"type":"default"}} -->
			<div class="wp-block-group">
				<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
				<p class="is-style-eyebrow"><?php esc_html_e( 'Lorem', 'unhurried' ); ?></p>
				<!-- /wp:paragraph -->
				<!-- wp:paragraph -->
				<p><?php echo wp_kses( __( 'Eiusmod do Labore, 10 ut 7<br>Pariatur, 9 et 3', 'unhurried' ), array( 'br' => array() ) ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
			<!-- wp:group {"style":{"spacing":{"blockGap":"0.5rem"}},"layout":{"type":"default"}} -->
			<div class="wp-block-group">
				<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
				<p class="is-style-eyebrow"><?php esc_html_e( 'Lorem', 'unhurried' ); ?></p>
				<!-- /wp:paragraph -->
				<!-- wp:paragraph -->
				<p><a href="mailto:hello@example.com"><?php esc_html_e( 'hello@example.com', 'unhurried' ); ?></a></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"width":"58%","className":"is-style-card unhurried-reveal","style":{"spacing":{"blockGap":"var:preset|spacing|50"},"shadow":"var:preset|shadow|float"}} -->
		<div class="wp-block-column is-style-card unhurried-reveal" style="box-shadow:var(--wp--preset--shadow--float);flex-basis:58%">
			<!-- wp:heading {"fontSize":"xx-large"} -->
			<h2 class="wp-block-heading has-xx-large-font-size"><?php echo wp_kses( __( 'Lorem ad <em>elit</em>', 'unhurried' ), array( 'em' => array() ) ); ?></h2>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"textColor":"contrast-2"} -->
			<p class="has-contrast-2-color has-text-color"><?php esc_html_e( 'Voluptate, enim magna ex ea minim nostrud. In dolore irure quis excepteur. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur.', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
			<?php if ( '' !== $unhurried_form ) : ?>
				<?php echo $unhurried_form; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Block markup from unhurried_contact_form(), parsed and rendered by WordPress. ?>
			<?php else : ?>
			<!-- wp:buttons -->
			<div class="wp-block-buttons">
				<!-- wp:button -->
				<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="mailto:hello@example.com"><?php esc_html_e( 'Email us', 'unhurried' ); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
			<?php endif; ?>
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
