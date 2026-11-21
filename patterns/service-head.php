<?php
/**
 * Title: Page head with breadcrumbs
 * Slug: unhurried/service-head
 * Categories: unhurried_hero
 * Keywords: hero, title, breadcrumbs, page head, service
 * Viewport width: 1400
 * Description: Breadcrumbs, then the page's own title and excerpt in a huge headline on Stone. Made for nested pages such as services, so each one reads its own words.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.2.0
 */

?>
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr_x( 'Page head', 'Pattern block name', 'unhurried' ); ?>"},"align":"full","backgroundColor":"base-2","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"1360px"}} -->
<div class="wp-block-group alignfull has-base-2-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
	<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|60"}},"layout":{"type":"constrained","contentSize":"1100px","justifyContent":"left"}} -->
	<div class="wp-block-group">
		<!-- wp:breadcrumbs {"className":"unhurried-breadcrumbs"} /-->
		<!-- wp:post-title {"level":1,"fontSize":"huge","style":{"typography":{"lineHeight":"0.9","letterSpacing":"-0.04em"}}} /-->
		<!-- wp:post-excerpt {"textColor":"contrast-2","fontSize":"large","style":{"layout":{"selfStretch":"fit"}}} /-->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
