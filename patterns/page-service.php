<?php
/**
 * Title: Service page
 * Slug: unhurried/page-service
 * Categories: unhurried_page, services
 * Keywords: service, detail, offering, treatment
 * Block Types: core/post-content
 * Post Types: page, wp_template
 * Viewport width: 1400
 * Description: For one service, nested under its group, such as /services/design/identity/: breadcrumbs, the page's own title, excerpt and featured image, an essay, the process and a call to action.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.2.0
 */

?>
<!-- wp:pattern {"slug":"unhurried/service-head"} /-->
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"0","bottom":"clamp(10px, 2vw, 28px)","left":"clamp(10px, 2vw, 28px)","right":"clamp(10px, 2vw, 28px)"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"base-2","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull has-base-2-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:0;padding-right:clamp(10px, 2vw, 28px);padding-bottom:clamp(10px, 2vw, 28px);padding-left:clamp(10px, 2vw, 28px)">
	<!-- wp:post-featured-image {"aspectRatio":"21/9","className":"unhurried-mono","style":{"border":{"radius":"24px"}}} /-->
</div>
<!-- /wp:group -->
<!-- wp:pattern {"slug":"unhurried/text-essay"} /-->
<!-- wp:pattern {"slug":"unhurried/process-panel"} /-->
<!-- wp:pattern {"slug":"unhurried/cta-split"} /-->
