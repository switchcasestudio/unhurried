<?php
/**
 * Title: Footer with visit details
 * Slug: unhurried/footer-visit
 * Categories: footer
 * Block Types: core/template-part/footer
 * Viewport width: 1400
 * Description: The Ink footer with a closing line, the Explore navigation, a Visit column for your address and email, the giant wordmark and the credit. Replace the sample address and email with your own.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.1.2
 */

// Privacy, Terms and Returns beside the closing line, once those pages are published (inc/legal.php).
$unhurried_legal = function_exists( 'unhurried_legal_links_block' ) ? unhurried_legal_links_block() : '';
?>
<!-- wp:group {"className":"is-style-section-ink","style":{"spacing":{"padding":{"top":"var:preset|spacing|90","bottom":"var:preset|spacing|60"},"blockGap":"var:preset|spacing|80","margin":{"top":"0"}}},"layout":{"type":"constrained","contentSize":"1360px"}} -->
<div class="wp-block-group is-style-section-ink" style="margin-top:0;padding-top:var(--wp--preset--spacing--90);padding-bottom:var(--wp--preset--spacing--60)">
	<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|70","left":"var:preset|spacing|70"}}}} -->
	<div class="wp-block-columns">
		<!-- wp:column {"width":"50%","style":{"spacing":{"blockGap":"var:preset|spacing|60"}}} -->
		<div class="wp-block-column" style="flex-basis:50%">
			<!-- wp:heading {"level":2,"fontSize":"xx-large"} -->
			<h2 class="wp-block-heading has-xx-large-font-size"><?php echo wp_kses( __( 'Lorem ipsum <em>dolor.</em>', 'unhurried' ), array( 'em' => array() ) ); ?></h2>
			<!-- /wp:heading -->
			<!-- wp:site-tagline {"style":{"typography":{"lineHeight":"1.5"}}} /-->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"width":"25%","style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
		<div class="wp-block-column" style="flex-basis:25%">
			<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
			<p class="is-style-eyebrow"><?php esc_html_e( 'Explore', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:navigation {"overlayMenu":"never","showSubmenuIcon":false,"className":"unhurried-nav-plain","layout":{"type":"flex","orientation":"vertical"},"style":{"spacing":{"blockGap":"0.25rem"}}} /-->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"width":"25%","style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
		<div class="wp-block-column" style="flex-basis:25%">
			<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
			<p class="is-style-eyebrow"><?php esc_html_e( 'Visit', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph -->
			<p><?php echo wp_kses( __( '12 Lorem Sit<br>Malesuada, 00000', 'unhurried' ), array( 'br' => array() ) ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph -->
			<p><a href="mailto:hello@example.com"><?php esc_html_e( 'hello@example.com', 'unhurried' ); ?></a></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
	<!-- wp:site-title {"level":0,"className":"unhurried-wordmark","style":{"typography":{"fontSize":"clamp(3.5rem, 15vw, 17rem)","fontWeight":"500"}}} /-->
	<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40"}},"border":{"top":{"color":"#f6f4ef2e","width":"1px","style":"solid"}}},"fontSize":"x-small","layout":{"type":"flex","justifyContent":"space-between","flexWrap":"wrap"}} -->
	<div class="wp-block-group has-x-small-font-size" style="border-top-color:#f6f4ef2e;border-top-style:solid;border-top-width:1px;padding-top:var(--wp--preset--spacing--40)">
		<?php if ( '' !== $unhurried_legal ) : ?>
		<!-- wp:group {"className":"unhurried-footer-start","style":{"spacing":{"blockGap":"var:preset|spacing|50"}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
		<div class="wp-block-group unhurried-footer-start">
		<?php endif; ?>
		<!-- wp:paragraph -->
		<p><?php esc_html_e( 'Lorem ipsum, dolor sit.', 'unhurried' ); ?></p>
		<!-- /wp:paragraph -->
		<?php if ( '' !== $unhurried_legal ) : ?>
			<?php echo $unhurried_legal; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Block markup from unhurried_legal_links_block(), which escapes each address and label. ?>
		</div>
		<!-- /wp:group -->
		<?php endif; ?>
		<!-- wp:paragraph -->
		<p>
		<?php
		printf(
			/* translators: %s: Theme author link. */
			esc_html__( 'Designed by %s', 'unhurried' ),
			'<a href="' . esc_url( 'https://switchcasestudio.com' ) . '">Switch Case Studio</a>'
		);
		?>
		</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
