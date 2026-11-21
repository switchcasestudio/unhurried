<?php
/**
 * Title: Journal toolbar
 * Slug: unhurried/journal-toolbar
 * Categories: posts
 * Keywords: journal, blog, topics, categories, filter, search
 * Viewport width: 1400
 * Description: Topic chips (All plus each category with its post count, the current one highlighted) and a search box that looks only through posts. Links to the topics directory when you have a page at /topics/.
 *
 * Everything in it is the site's own content: categories, the posts page and
 * a Topics page are linked only when they exist.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.2.0
 */

$unhurried_posts_page = ( 'page' === get_option( 'show_on_front' ) ) ? (int) get_option( 'page_for_posts' ) : 0;
$unhurried_all_url    = $unhurried_posts_page ? get_permalink( $unhurried_posts_page ) : home_url( '/' );
$unhurried_topics_url = unhurried_page_link( 'topics', '' );
$unhurried_search     = serialize_block_attributes(
	array(
		'label'          => __( 'Search the journal', 'unhurried' ),
		'showLabel'      => false,
		'placeholder'    => __( 'Search the journal', 'unhurried' ),
		'buttonText'     => __( 'Search', 'unhurried' ),
		'buttonPosition' => 'button-inside',
		'buttonUseIcon'  => true,
		'query'          => array( 'post_type' => 'post' ),
		'className'      => 'unhurried-journal-search',
	)
);
?>
<!-- wp:group {"className":"unhurried-toolbar","style":{"spacing":{"blockGap":"var:preset|spacing|50","margin":{"bottom":"var:preset|spacing|70"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group unhurried-toolbar" style="margin-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:group {"className":"unhurried-chips","style":{"spacing":{"blockGap":"0.5rem"}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
	<div class="wp-block-group unhurried-chips">
		<!-- wp:paragraph {"className":"unhurried-chip<?php echo is_home() ? ' is-current' : ''; ?>"} -->
		<p class="unhurried-chip<?php echo is_home() ? ' is-current' : ''; ?>"><a href="<?php echo esc_url( $unhurried_all_url ); ?>"><?php esc_html_e( 'All', 'unhurried' ); ?></a></p>
		<!-- /wp:paragraph -->
		<!-- wp:terms-query {"termQuery":{"perPage":12,"taxonomy":"category","order":"desc","orderBy":"count","include":[],"hideEmpty":true,"showNested":false,"inherit":false},"className":"unhurried-chip-terms"} -->
		<div class="wp-block-terms-query unhurried-chip-terms"><!-- wp:term-template -->
		<!-- wp:term-name {"isLink":true} /-->
		<!-- wp:term-count /-->
		<!-- /wp:term-template --></div>
		<!-- /wp:terms-query -->
	</div>
	<!-- /wp:group -->
	<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|50"}},"layout":{"type":"flex","flexWrap":"wrap","verticalAlignment":"center"}} -->
	<div class="wp-block-group">
		<!-- wp:search <?php echo $unhurried_search; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- serialize_block_attributes() escapes it for a block comment. ?> /-->
		<?php if ( $unhurried_topics_url ) : ?>
		<!-- wp:paragraph {"className":"unhurried-text-link","fontSize":"small"} -->
		<p class="unhurried-text-link has-small-font-size"><a href="<?php echo esc_url( $unhurried_topics_url ); ?>"><?php esc_html_e( 'All topics →', 'unhurried' ); ?></a></p>
		<!-- /wp:paragraph -->
		<?php endif; ?>
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
