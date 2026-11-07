<?php
/**
 * Title: Header, quiet
 * Slug: unhurried/header-quiet
 * Categories: header
 * Block Types: core/template-part/header
 * Viewport width: 1400
 * Description: Logo, site title and one button. No navigation, for a landing page or a one-page site.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.1.0
 */

?>
<!-- wp:group {"tagName":"header","className":"unhurried-header","style":{"spacing":{"padding":{"top":"10px","bottom":"0","left":"clamp(10px, 2vw, 28px)","right":"clamp(10px, 2vw, 28px)"}}},"layout":{"type":"default"}} -->
<header class="wp-block-group unhurried-header" style="padding-top:10px;padding-right:clamp(10px, 2vw, 28px);padding-bottom:0;padding-left:clamp(10px, 2vw, 28px)">
	<!-- wp:group {"className":"unhurried-capsule","style":{"border":{"radius":"999px"},"spacing":{"padding":{"top":"0.5rem","bottom":"0.5rem","left":"clamp(1rem, 2vw, 1.75rem)","right":"0.5rem"},"blockGap":"var:preset|spacing|50"}},"backgroundColor":"base","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
	<div class="wp-block-group unhurried-capsule has-base-background-color has-background" style="border-radius:999px;padding-top:0.5rem;padding-right:0.5rem;padding-bottom:0.5rem;padding-left:clamp(1rem, 2vw, 1.75rem)">
		<!-- wp:group {"style":{"spacing":{"blockGap":"0.75rem"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
		<div class="wp-block-group">
			<!-- wp:site-logo {"width":36,"shouldSyncIcon":false} /-->
			<!-- wp:site-title {"level":0} /-->
		</div>
		<!-- /wp:group -->
		<!-- wp:pattern {"slug":"unhurried/header-button"} /-->
	</div>
	<!-- /wp:group -->
</header>
<!-- /wp:group -->
