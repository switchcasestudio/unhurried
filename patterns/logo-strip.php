<?php
/**
 * Title: Names strip
 * Slug: unhurried/logo-strip
 * Categories: featured, text
 * Keywords: logos, press, partners, clients, stockists, as seen in
 * Viewport width: 1400
 * Description: A centred eyebrow over a row of names set in the accent italic. Swap the names for stockists, press or partners, or replace each with a logo image.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.1.0
 */

$unhurried_names = array( 'Linden House', 'Still & Co.', 'Marrow', 'Hearth Studio', 'Fernway' );
?>
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr_x( 'Names strip', 'Pattern block name', 'unhurried' ); ?>"},"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"},"blockGap":"var:preset|spacing|50"}},"layout":{"type":"constrained","contentSize":"1360px"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:paragraph {"align":"center","className":"is-style-eyebrow"} -->
	<p class="has-text-align-center is-style-eyebrow"><?php esc_html_e( 'Stocked by', 'unhurried' ); ?></p>
	<!-- /wp:paragraph -->
	<!-- wp:group {"className":"unhurried-names unhurried-reveal","style":{"spacing":{"blockGap":"clamp(1.5rem, 4vw, 4rem)"}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"}} -->
	<div class="wp-block-group unhurried-names unhurried-reveal">
		<?php foreach ( $unhurried_names as $unhurried_name ) : ?>
		<!-- wp:paragraph {"fontFamily":"accent","fontSize":"x-large","style":{"typography":{"fontStyle":"italic","lineHeight":"1"}}} -->
		<p class="has-accent-font-family has-x-large-font-size" style="font-style:italic;line-height:1"><?php echo esc_html( $unhurried_name ); ?></p>
		<!-- /wp:paragraph -->
		<?php endforeach; ?>
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
