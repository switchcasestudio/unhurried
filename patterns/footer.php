<?php
/**
 * Title: Footer with wordmark
 * Slug: unhurried/footer
 * Categories: footer
 * Block Types: core/template-part/footer
 * Viewport width: 1400
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.0.0
 */

?>
<!-- wp:group {"className":"is-style-section-ink","style":{"spacing":{"padding":{"top":"var:preset|spacing|90","bottom":"var:preset|spacing|60"},"blockGap":"var:preset|spacing|80","margin":{"top":"0"}}},"layout":{"type":"constrained","contentSize":"1360px"}} -->
<div class="wp-block-group is-style-section-ink" style="margin-top:0;padding-top:var(--wp--preset--spacing--90);padding-bottom:var(--wp--preset--spacing--60)">
	<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|70","left":"var:preset|spacing|70"}}}} -->
	<div class="wp-block-columns">
		<!-- wp:column {"width":"50%","style":{"spacing":{"blockGap":"var:preset|spacing|60"}}} -->
		<div class="wp-block-column" style="flex-basis:50%">
			<!-- wp:heading {"level":2,"fontSize":"xx-large"} -->
			<h2 class="wp-block-heading has-xx-large-font-size"><?php echo wp_kses( __( 'Take your <em>time.</em>', 'unhurried' ), array( 'em' => array() ) ); ?></h2>
			<!-- /wp:heading -->
			<!-- wp:site-tagline {"style":{"typography":{"lineHeight":"1.5"}}} /-->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"width":"25%","style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
		<div class="wp-block-column" style="flex-basis:25%">
			<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
			<p class="is-style-eyebrow"><?php esc_html_e( 'Explore', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:navigation {"overlayMenu":"never","layout":{"type":"flex","orientation":"vertical"},"style":{"spacing":{"blockGap":"0.25rem"}}} /-->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"width":"25%","style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
		<div class="wp-block-column" style="flex-basis:25%">
			<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
			<p class="is-style-eyebrow"><?php esc_html_e( 'Visit', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph -->
			<p><?php echo wp_kses( __( '12 Linden Row<br>Hillsdale, 00000', 'unhurried' ), array( 'br' => array() ) ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph -->
			<p><?php esc_html_e( 'hello@example.com', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
	<!-- wp:site-title {"level":0,"className":"unhurried-wordmark","style":{"typography":{"fontSize":"clamp(3.5rem, 15vw, 17rem)","fontWeight":"500"}}} /-->
	<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40"}},"border":{"top":{"color":"#f6f4ef2e","width":"1px","style":"solid"}}},"fontSize":"x-small","layout":{"type":"flex","justifyContent":"space-between","flexWrap":"wrap"}} -->
	<div class="wp-block-group has-x-small-font-size" style="border-top-color:#f6f4ef2e;border-top-style:solid;border-top-width:1px;padding-top:var(--wp--preset--spacing--40)">
		<!-- wp:paragraph -->
		<p><?php esc_html_e( 'Made slowly, with care.', 'unhurried' ); ?></p>
		<!-- /wp:paragraph -->
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
