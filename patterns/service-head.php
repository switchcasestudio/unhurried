<?php
/**
 * Title: Page head with breadcrumbs
 * Slug: unhurried/service-head
 * Categories: unhurried_hero
 * Keywords: hero, title, breadcrumbs, page head, service, image, photograph
 * Viewport width: 1400
 * Description: Breadcrumbs, then the page's own title and excerpt in a huge headline over a black-and-white photograph, inside a rounded, inset frame. Made for nested pages such as services, so each one reads its own words. Swap the image in the Cover block's toolbar.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.2.0
 */

$unhurried_img = get_theme_file_uri( 'assets/images/lotus-bowl-wide.webp' );
?>
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr_x( 'Page head', 'Pattern block name', 'unhurried' ); ?>"},"align":"full","className":"unhurried-hero-photo","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"10px","right":"clamp(10px, 2vw, 28px)","bottom":"0","left":"clamp(10px, 2vw, 28px)"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group alignfull unhurried-hero-photo" style="margin-top:0;margin-bottom:0;padding-top:10px;padding-right:clamp(10px, 2vw, 28px);padding-bottom:0;padding-left:clamp(10px, 2vw, 28px)">
	<!-- wp:cover {"url":"<?php echo esc_url( $unhurried_img ); ?>","dimRatio":60,"overlayColor":"contrast","focalPoint":{"x":0.62,"y":0.4},"minHeight":64,"minHeightUnit":"vh","contentPosition":"bottom left","className":"unhurried-mono unhurried-hero-photo__stage","style":{"border":{"radius":"28px"},"spacing":{"padding":{"top":"var:preset|spacing|80","right":"clamp(1.25rem, 4vw, 4.5rem)","bottom":"var:preset|spacing|70","left":"clamp(1.25rem, 4vw, 4.5rem)"}}},"layout":{"type":"default"}} -->
	<div class="wp-block-cover has-custom-content-position is-position-bottom-left unhurried-mono unhurried-hero-photo__stage" style="border-radius:28px;padding-top:var(--wp--preset--spacing--80);padding-right:clamp(1.25rem, 4vw, 4.5rem);padding-bottom:var(--wp--preset--spacing--70);padding-left:clamp(1.25rem, 4vw, 4.5rem);min-height:64vh"><img class="wp-block-cover__image-background" alt="" src="<?php echo esc_url( $unhurried_img ); ?>" style="object-position:62% 40%" data-object-fit="cover" data-object-position="62% 40%"/><span aria-hidden="true" class="wp-block-cover__background has-contrast-background-color has-background-dim-60 has-background-dim"></span><div class="wp-block-cover__inner-container">
		<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|60"}},"layout":{"type":"constrained","contentSize":"1100px","justifyContent":"left"}} -->
		<div class="wp-block-group">
			<!-- wp:breadcrumbs {"className":"unhurried-breadcrumbs"} /-->
			<!-- wp:post-title {"level":1,"fontSize":"huge","style":{"typography":{"lineHeight":"0.9","letterSpacing":"-0.04em"}}} /-->
			<!-- wp:group {"layout":{"type":"constrained","contentSize":"36ch","justifyContent":"left"}} -->
			<div class="wp-block-group">
				<!-- wp:post-excerpt {"fontSize":"large","style":{"typography":{"lineHeight":"1.45"}}} /-->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	</div></div>
	<!-- /wp:cover -->
</div>
<!-- /wp:group -->
