<?php
/**
 * Title: Latest journal notes
 * Slug: unhurried/journal-latest
 * Categories: featured, posts
 * Keywords: journal, blog, posts, latest, news
 * Block Types: core/query
 * Viewport width: 1400
 * Description: A centered heading and lede above the three latest posts in a scattered grid.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.0.0
 */

?>
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr_x( 'Journal', 'Pattern block name', 'unhurried' ); ?>"},"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"},"blockGap":"var:preset|spacing|70"}},"layout":{"type":"constrained","contentSize":"1360px"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
	<!-- wp:group {"className":"unhurried-reveal","style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained","contentSize":"640px"}} -->
	<div class="wp-block-group unhurried-reveal">
		<!-- wp:paragraph {"align":"center","className":"is-style-eyebrow"} -->
		<p class="has-text-align-center is-style-eyebrow"><?php esc_html_e( 'Stories', 'unhurried' ); ?></p>
		<!-- /wp:paragraph -->
		<!-- wp:heading {"textAlign":"center","fontSize":"xx-large"} -->
		<h2 class="wp-block-heading has-text-align-center has-xx-large-font-size"><?php echo wp_kses( __( 'From the <em>studio</em>', 'unhurried' ), array( 'em' => array() ) ); ?></h2>
		<!-- /wp:heading -->
		<!-- wp:paragraph {"align":"center","textColor":"contrast-2"} -->
		<p class="has-text-align-center has-contrast-2-color has-text-color"><?php echo wp_kses( __( 'Recipes, reading lists and <em>small</em> rituals to try at home.', 'unhurried' ), array( 'em' => array() ) ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
	<!-- wp:query {"queryId":2,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","inherit":false,"sticky":""},"layout":{"type":"default"}} -->
	<div class="wp-block-query">
		<!-- wp:post-template {"className":"unhurried-cards is-scatter","style":{"spacing":{"blockGap":"var:preset|spacing|60"}},"layout":{"type":"grid","columnCount":3}} -->
			<!-- wp:group {"className":"unhurried-reveal","style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"default"}} -->
			<div class="wp-block-group unhurried-reveal">
				<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"4/5","className":"unhurried-mono"} /-->
				<!-- wp:post-date /-->
				<!-- wp:post-title {"level":3,"isLink":true,"fontSize":"large"} /-->
			</div>
			<!-- /wp:group -->
		<!-- /wp:post-template -->
	</div>
	<!-- /wp:query -->
</div>
<!-- /wp:group -->
