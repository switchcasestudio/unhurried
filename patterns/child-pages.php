<?php
/**
 * Title: Pages under this page
 * Slug: unhurried/child-pages
 * Categories: services, featured
 * Keywords: services, child pages, subpages, section, index, cards
 * Viewport width: 1400
 * Description: Cards for every page nested under the page it sits on, in menu order: on Services it lists your service groups, on a group it lists its services. Each card shows the page's featured image, title and excerpt. Hidden while the page has none.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.2.0
 */

?>
<!-- wp:query {"queryId":21,"query":{"perPage":24,"pages":0,"offset":0,"postType":"page","order":"asc","orderBy":"menu_order","inherit":false,"unhurriedChildren":true},"metadata":{"name":"<?php echo esc_attr_x( 'Pages under this page', 'Pattern block name', 'unhurried' ); ?>"},"align":"full","className":"unhurried-child-pages","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"},"blockGap":"var:preset|spacing|70"}},"layout":{"type":"constrained","contentSize":"1360px"}} -->
<div class="wp-block-query alignfull unhurried-child-pages" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
	<!-- wp:heading {"fontSize":"xx-large"} -->
	<h2 class="wp-block-heading has-xx-large-font-size"><?php echo wp_kses( __( 'Lorem <em>amet</em>', 'unhurried' ), array( 'em' => array() ) ); ?></h2>
	<!-- /wp:heading -->
	<!-- wp:post-template {"className":"unhurried-cards","style":{"spacing":{"blockGap":"var:preset|spacing|70"}},"layout":{"type":"grid","columnCount":3}} -->
		<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"default"}} -->
		<div class="wp-block-group">
			<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"4/5","className":"unhurried-mono","style":{"border":{"radius":"20px"}}} /-->
			<!-- wp:post-title {"level":3,"isLink":true,"fontSize":"large"} /-->
			<!-- wp:post-excerpt {"excerptLength":24,"textColor":"contrast-2","fontSize":"small"} /-->
		</div>
		<!-- /wp:group -->
	<!-- /wp:post-template -->
</div>
<!-- /wp:query -->
