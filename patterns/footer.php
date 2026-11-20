<?php
/**
 * Title: Footer with wordmark
 * Slug: unhurried/footer
 * Categories: footer
 * Block Types: core/template-part/footer
 * Viewport width: 1400
 * Description: An Ink footer: the site tagline as the lead line, the Explore navigation, the giant wordmark and a hairline with the credit. Nothing in it needs editing.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.0.0
 */

/*
 * Since 1.1.2 the footer carries no sample copy: the lead line is the site
 * tagline (Settings > General) and the address column lives in the
 * "Footer with visit details" pattern. Many sites never edit the footer, so
 * whatever is printed here goes live as it stands.
 */
$unhurried_has_tagline = '' !== trim( (string) get_bloginfo( 'description' ) );
?>
<!-- wp:group {"className":"is-style-section-ink","style":{"spacing":{"padding":{"top":"var:preset|spacing|90","bottom":"var:preset|spacing|60"},"blockGap":"var:preset|spacing|80","margin":{"top":"0"}}},"layout":{"type":"constrained","contentSize":"1360px"}} -->
<div class="wp-block-group is-style-section-ink" style="margin-top:0;padding-top:var(--wp--preset--spacing--90);padding-bottom:var(--wp--preset--spacing--60)">
	<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|70","left":"var:preset|spacing|70"}}}} -->
	<div class="wp-block-columns">
		<?php if ( $unhurried_has_tagline ) : ?>
		<!-- wp:column {"width":"66.66%"} -->
		<div class="wp-block-column" style="flex-basis:66.66%">
			<!-- wp:site-tagline {"className":"unhurried-footer-lead","fontSize":"x-large","fontFamily":"display","style":{"typography":{"fontWeight":"500","lineHeight":"1.05","letterSpacing":"-0.03em"}}} /-->
		</div>
		<!-- /wp:column -->
		<?php endif; ?>
		<!-- wp:column {"width":"33.33%","style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
		<div class="wp-block-column" style="flex-basis:33.33%">
			<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
			<p class="is-style-eyebrow"><?php esc_html_e( 'Explore', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:navigation {"overlayMenu":"never","layout":{"type":"flex","orientation":"vertical"},"style":{"spacing":{"blockGap":"0.25rem"}}} /-->
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
