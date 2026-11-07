<?php
/**
 * Title: Footer, quiet
 * Slug: unhurried/footer-quiet
 * Categories: footer
 * Block Types: core/template-part/footer
 * Viewport width: 1400
 * Description: A Stone footer without the wordmark: site title and tagline, Explore navigation, visit details, and a hairline with the credit.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.1.0
 */

?>
<!-- wp:group {"backgroundColor":"base-2","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|60"},"blockGap":"var:preset|spacing|70","margin":{"top":"0"}}},"layout":{"type":"constrained","contentSize":"1360px"}} -->
<div class="wp-block-group has-base-2-background-color has-background" style="margin-top:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--60)">
	<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|70"}}}} -->
	<div class="wp-block-columns">
		<!-- wp:column {"width":"50%","style":{"spacing":{"blockGap":"var:preset|spacing|30"}}} -->
		<div class="wp-block-column" style="flex-basis:50%">
			<!-- wp:site-title {"level":0,"fontSize":"large","style":{"typography":{"fontWeight":"500","letterSpacing":"-0.02em"}}} /-->
			<!-- wp:site-tagline {"textColor":"contrast-2","style":{"typography":{"lineHeight":"1.5"},"layout":{"selfStretch":"fixed","flexSize":"min(100%, 36ch)"}}} /-->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"width":"25%","style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
		<div class="wp-block-column" style="flex-basis:25%">
			<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
			<p class="is-style-eyebrow"><?php esc_html_e( 'Explore', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:navigation {"overlayMenu":"never","layout":{"type":"flex","orientation":"vertical"},"style":{"spacing":{"blockGap":"0.5rem"}}} /-->
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
	<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40"}},"border":{"top":{"color":"var:preset|color|hairline","width":"1px","style":"solid"}}},"textColor":"contrast-2","fontSize":"x-small","layout":{"type":"flex","justifyContent":"space-between","flexWrap":"wrap"}} -->
	<div class="wp-block-group has-contrast-2-color has-text-color has-x-small-font-size" style="border-top-color:var(--wp--preset--color--hairline);border-top-style:solid;border-top-width:1px;padding-top:var(--wp--preset--spacing--40)">
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
