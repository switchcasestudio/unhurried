<?php
/**
 * Title: Hero, type only (contact)
 * Slug: unhurried/hero-type-contact
 * Categories: unhurried_hero
 * Keywords: hero, title, heading, intro
 * Viewport width: 1400
 * Description: A huge left-aligned headline with an eyebrow and a short lede, on Stone.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.0.0
 */

?>
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr_x( 'Hero', 'Pattern block name', 'unhurried' ); ?>"},"align":"full","backgroundColor":"base-2","style":{"spacing":{"padding":{"top":"var:preset|spacing|90","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"1360px"}} -->
<div class="wp-block-group alignfull has-base-2-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--90);padding-bottom:var(--wp--preset--spacing--80)">
	<!-- wp:group {"className":"unhurried-reveal","style":{"spacing":{"blockGap":"var:preset|spacing|60"}},"layout":{"type":"constrained","contentSize":"1100px","justifyContent":"left"}} -->
	<div class="wp-block-group unhurried-reveal">
		<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
		<p class="is-style-eyebrow"><?php esc_html_e( 'Laboris', 'unhurried' ); ?></p>
		<!-- /wp:paragraph -->
		<!-- wp:heading {"level":1,"fontSize":"huge","style":{"typography":{"lineHeight":"0.9","letterSpacing":"-0.04em"}}} -->
		<h1 class="wp-block-heading has-huge-font-size" style="letter-spacing:-0.04em;line-height:0.9"><?php echo wp_kses( __( 'Lorem ut <em>elit</em>', 'unhurried' ), array( 'em' => array() ) ); ?></h1>
		<!-- /wp:heading -->
		<!-- wp:paragraph {"textColor":"contrast-2","fontSize":"large","style":{"layout":{"selfStretch":"fit"}}} -->
		<p class="has-contrast-2-color has-text-color has-large-font-size"><?php esc_html_e( 'Phasellus, netus tempor eu eu labore fames. Ac dolore lacus enim tristique.', 'unhurried' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
