<?php
/**
 * Title: Header, centred title
 * Slug: unhurried/header-centred
 * Categories: header
 * Block Types: core/template-part/header
 * Viewport width: 1400
 * Description: The capsule with navigation on the left, the site title in the middle and the button on the right.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.1.0
 */

?>
<!-- wp:group {"tagName":"header","className":"unhurried-header","style":{"spacing":{"padding":{"top":"10px","bottom":"0","left":"clamp(10px, 2vw, 28px)","right":"clamp(10px, 2vw, 28px)"}}},"layout":{"type":"default"}} -->
<header class="wp-block-group unhurried-header" style="padding-top:10px;padding-right:clamp(10px, 2vw, 28px);padding-bottom:0;padding-left:clamp(10px, 2vw, 28px)">
	<!-- wp:group {"className":"unhurried-capsule is-centred","style":{"border":{"radius":"999px"},"spacing":{"padding":{"top":"0.5rem","bottom":"0.5rem","left":"0.5rem","right":"0.5rem"},"blockGap":"var:preset|spacing|50"}},"backgroundColor":"base","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
	<div class="wp-block-group unhurried-capsule is-centred has-base-background-color has-background" style="border-radius:999px;padding-top:0.5rem;padding-right:0.5rem;padding-bottom:0.5rem;padding-left:0.5rem">
		<!-- wp:navigation {"overlayBackgroundColor":"base","overlayTextColor":"contrast","layout":{"type":"flex","justifyContent":"left"},"style":{"spacing":{"blockGap":"var:preset|spacing|50"}}} /-->
		<!-- wp:group {"style":{"spacing":{"blockGap":"0.75rem"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
		<div class="wp-block-group">
			<!-- wp:site-logo {"width":36,"shouldSyncIcon":false} /-->
			<!-- wp:site-title {"level":0} /-->
		</div>
		<!-- /wp:group -->
		<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"right"}} -->
		<div class="wp-block-group">
			<!-- wp:pattern {"slug":"unhurried/header-button"} /-->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</header>
<!-- /wp:group -->
