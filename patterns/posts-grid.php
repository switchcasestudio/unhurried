<?php
/**
 * Title: Posts grid
 * Slug: unhurried/posts-grid
 * Categories: query
 * Block Types: core/query
 * Viewport width: 1400
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.0.0
 */

// The search offered when there are no posts: named, so it can be told from the other search forms on the page.
$unhurried_search = serialize_block_attributes(
	array(
		'label'      => __( 'Search again', 'unhurried' ),
		'showLabel'  => false,
		'buttonText' => __( 'Search', 'unhurried' ),
	)
);
?>
<!-- wp:query {"queryId":1,"query":{"perPage":9,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","inherit":true},"align":"wide","layout":{"type":"default"}} -->
<div class="wp-block-query alignwide">
	<!-- wp:query-total {"className":"unhurried-query-total","fontSize":"x-small","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|60"}}}} /-->
	<!-- wp:post-template {"className":"unhurried-cards is-scatter","style":{"spacing":{"blockGap":"var:preset|spacing|70"}},"layout":{"type":"grid","columnCount":3}} -->
		<!-- wp:group {"className":"unhurried-reveal","style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"default"}} -->
		<div class="wp-block-group unhurried-reveal">
			<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"4/5","className":"unhurried-mono"} /-->
			<!-- wp:group {"className":"unhurried-card-meta","style":{"spacing":{"blockGap":"0.75rem"}},"layout":{"type":"flex","flexWrap":"wrap","verticalAlignment":"center"}} -->
			<div class="wp-block-group unhurried-card-meta">
				<!-- wp:post-terms {"term":"category","className":"unhurried-chip-links"} /-->
				<!-- wp:post-date /-->
				<!-- wp:post-time-to-read {"displayAsRange":false} /-->
			</div>
			<!-- /wp:group -->
			<!-- wp:post-title {"level":2,"isLink":true,"fontSize":"large"} /-->
			<!-- wp:post-excerpt {"excerptLength":22,"textColor":"contrast-2","fontSize":"small"} /-->
		</div>
		<!-- /wp:group -->
	<!-- /wp:post-template -->
	<!-- wp:query-no-results -->
		<!-- wp:paragraph {"fontSize":"large"} -->
		<p class="has-large-font-size"><?php esc_html_e( 'Nothing here yet. Try a search instead.', 'unhurried' ); ?></p>
		<!-- /wp:paragraph -->
		<!-- wp:search <?php echo $unhurried_search; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- serialize_block_attributes() escapes it for a block comment. ?> /-->
		<!-- wp:terms-query {"termQuery":{"perPage":12,"taxonomy":"category","order":"desc","orderBy":"count","include":[],"hideEmpty":true,"showNested":false,"inherit":false},"className":"unhurried-chip-terms"} -->
		<div class="wp-block-terms-query unhurried-chip-terms"><!-- wp:term-template -->
		<!-- wp:term-name {"isLink":true} /-->
		<!-- wp:term-count /-->
		<!-- /wp:term-template --></div>
		<!-- /wp:terms-query -->
	<!-- /wp:query-no-results -->
	<!-- wp:query-pagination {"paginationArrow":"arrow","style":{"spacing":{"margin":{"top":"var:preset|spacing|80"}}},"layout":{"type":"flex","justifyContent":"space-between"}} -->
		<!-- wp:query-pagination-previous /-->
		<!-- wp:query-pagination-numbers /-->
		<!-- wp:query-pagination-next /-->
	<!-- /wp:query-pagination -->
</div>
<!-- /wp:query -->
