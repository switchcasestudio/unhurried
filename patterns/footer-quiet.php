<?php
/**
 * Title: Footer, quiet
 * Slug: unhurried/footer-quiet
 * Categories: footer
 * Block Types: core/template-part/footer
 * Viewport width: 1400
 * Description: A Stone footer without the wordmark: site title and tagline, Explore navigation, and a hairline with the credit.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.1.0
 */

// Privacy, Terms and Returns beside the closing line, once those pages are published (inc/legal.php).
$unhurried_legal = function_exists( 'unhurried_legal_links_block' ) ? unhurried_legal_links_block() : '';
?>
<!-- wp:group {"backgroundColor":"base-2","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|60"},"blockGap":"var:preset|spacing|70","margin":{"top":"0"}}},"layout":{"type":"constrained","contentSize":"1360px"}} -->
<div class="wp-block-group has-base-2-background-color has-background" style="margin-top:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--60)">
	<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|70"}}}} -->
	<div class="wp-block-columns">
		<!-- wp:column {"width":"66.66%","style":{"spacing":{"blockGap":"var:preset|spacing|30"}}} -->
		<div class="wp-block-column" style="flex-basis:66.66%">
			<!-- wp:site-title {"level":0,"fontSize":"large","style":{"typography":{"fontWeight":"500","letterSpacing":"-0.02em"}}} /-->
			<!-- wp:site-tagline {"textColor":"contrast-2","style":{"typography":{"lineHeight":"1.5"},"layout":{"selfStretch":"fixed","flexSize":"min(100%, 36ch)"}}} /-->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"width":"33.33%","style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
		<div class="wp-block-column" style="flex-basis:33.33%">
			<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
			<p class="is-style-eyebrow"><?php esc_html_e( 'Explore', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:navigation {"overlayMenu":"never","showSubmenuIcon":false,"className":"unhurried-nav-plain","layout":{"type":"flex","orientation":"vertical"},"style":{"spacing":{"blockGap":"0.25rem"}}} /-->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
	<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40"}},"border":{"top":{"color":"var:preset|color|hairline","width":"1px","style":"solid"}}},"textColor":"contrast-2","fontSize":"x-small","layout":{"type":"flex","justifyContent":"space-between","flexWrap":"wrap"}} -->
	<div class="wp-block-group has-contrast-2-color has-text-color has-x-small-font-size" style="border-top-color:var(--wp--preset--color--hairline);border-top-style:solid;border-top-width:1px;padding-top:var(--wp--preset--spacing--40)">
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
