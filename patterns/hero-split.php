<?php
/**
 * Title: Hero, split with arched image
 * Slug: unhurried/hero-split
 * Categories: unhurried_hero, featured
 * Keywords: hero, about, split, image
 * Viewport width: 1400
 * Description: A headline and lede on the left, a tall arch-topped image on the right.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.0.0
 */

?>
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr_x( 'Hero', 'Pattern block name', 'unhurried' ); ?>"},"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"1360px"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
	<!-- wp:columns {"verticalAlignment":"bottom","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|80"}}}} -->
	<div class="wp-block-columns are-vertically-aligned-bottom">
		<!-- wp:column {"verticalAlignment":"bottom","width":"58%","className":"unhurried-reveal","style":{"spacing":{"blockGap":"var:preset|spacing|60"}}} -->
		<div class="wp-block-column is-vertically-aligned-bottom unhurried-reveal" style="flex-basis:58%">
			<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
			<p class="is-style-eyebrow"><?php esc_html_e( 'Lorem eu', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:heading {"level":1,"fontSize":"huge","style":{"typography":{"lineHeight":"0.9","letterSpacing":"-0.04em"}}} -->
			<h1 class="wp-block-heading has-huge-font-size" style="letter-spacing:-0.04em;line-height:0.9"><?php echo wp_kses( __( 'Lorem esse ac <em>egestas</em>', 'unhurried' ), array( 'em' => array() ) ); ?></h1>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"textColor":"contrast-2","fontSize":"large","style":{"typography":{"lineHeight":"1.45"}}} -->
			<p class="has-contrast-2-color has-text-color has-large-font-size" style="line-height:1.45"><?php esc_html_e( 'Lorem velit sint sunt sem eiusmod, anim sit sit ut senectus do sed nostrud vitae ut.', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"verticalAlignment":"bottom","width":"42%","className":"unhurried-mono unhurried-reveal"} -->
		<div class="wp-block-column is-vertically-aligned-bottom unhurried-mono unhurried-reveal" style="flex-basis:42%">
			<!-- wp:image {"aspectRatio":"3/4","scale":"cover","sizeSlug":"full","linkDestination":"none","className":"is-style-arch"} -->
			<figure class="wp-block-image size-full is-style-arch"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/white-vase.webp' ) ); ?>" alt="" style="aspect-ratio:3/4;object-fit:cover"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
