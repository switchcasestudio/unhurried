<?php
/**
 * Title: Related posts
 * Slug: unhurried/hidden-related-posts
 * Inserter: no
 *
 * Up to three more posts from the current post's categories, newest first.
 * Prints nothing when there are none, so a new blog shows no empty heading.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.2.0
 */

$unhurried_post_id = is_singular( 'post' ) ? (int) get_queried_object_id() : 0;
$unhurried_cats    = $unhurried_post_id ? wp_get_post_categories( $unhurried_post_id ) : array();
if ( ! $unhurried_cats ) {
	return;
}
$unhurried_has_related = get_posts(
	array(
		'post_type'      => 'post',
		'posts_per_page' => 1,
		'fields'         => 'ids',
		'category__in'   => $unhurried_cats,
		'post__not_in'   => array( $unhurried_post_id ),
		'no_found_rows'  => true,
	)
);
if ( ! $unhurried_has_related ) {
	return;
}
$unhurried_query = wp_json_encode(
	array(
		'queryId' => 7,
		'query'   => array(
			'perPage'  => 3,
			'pages'    => 1,
			'offset'   => 0,
			'postType' => 'post',
			'order'    => 'desc',
			'orderBy'  => 'date',
			'inherit'  => false,
			'exclude'  => array( $unhurried_post_id ),
			'taxQuery' => array( 'category' => array_map( 'intval', $unhurried_cats ) ),
		),
		'className' => 'unhurried-related',
		'layout'    => array( 'type' => 'default' ),
	)
);
?>
<!-- wp:group {"className":"unhurried-related-wrap","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"blockGap":"var:preset|spacing|60"}},"backgroundColor":"base-2","layout":{"type":"constrained","contentSize":"1360px"}} -->
<div class="wp-block-group unhurried-related-wrap has-base-2-background-color has-background" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
	<!-- wp:heading {"fontSize":"x-large"} -->
	<h2 class="wp-block-heading has-x-large-font-size"><?php echo wp_kses( __( 'Keep <em>reading</em>', 'unhurried' ), array( 'em' => array() ) ); ?></h2>
	<!-- /wp:heading -->
	<!-- wp:query <?php echo $unhurried_query; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- wp_json_encode() of integers and fixed keys. ?> -->
	<div class="wp-block-query unhurried-related">
		<!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|60"}},"layout":{"type":"grid","columnCount":3}} -->
			<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"default"}} -->
			<div class="wp-block-group">
				<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"4/3","className":"unhurried-mono","style":{"border":{"radius":"18px"}}} /-->
				<!-- wp:group {"className":"unhurried-card-meta","style":{"spacing":{"blockGap":"0.75rem"}},"layout":{"type":"flex","flexWrap":"wrap","verticalAlignment":"center"}} -->
				<div class="wp-block-group unhurried-card-meta">
					<!-- wp:post-terms {"term":"category","className":"unhurried-chip-links"} /-->
					<!-- wp:post-time-to-read {"displayAsRange":false} /-->
				</div>
				<!-- /wp:group -->
				<!-- wp:post-title {"level":3,"isLink":true,"fontSize":"large"} /-->
			</div>
			<!-- /wp:group -->
		<!-- /wp:post-template -->
	</div>
	<!-- /wp:query -->
</div>
<!-- /wp:group -->
