<?php
/**
 * Title: Topics directory
 * Slug: unhurried/page-topics
 * Categories: unhurried_page, posts
 * Keywords: topics, categories, tags, directory, index, journal, archive
 * Block Types: core/post-content
 * Post Types: page, wp_template
 * Viewport width: 1400
 * Description: A directory of the journal: a heading and a search box over a black-and-white photograph, every category as a card with its description and post count, then every tag. Publish it on a page with the slug "topics" and the journal toolbar links to it.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.2.0
 */

$unhurried_img    = get_theme_file_uri( 'assets/images/marble-face-wide.webp' );
$unhurried_search = serialize_block_attributes(
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
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr_x( 'Hero', 'Pattern block name', 'unhurried' ); ?>"},"align":"full","className":"unhurried-hero-photo","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"10px","right":"clamp(10px, 2vw, 28px)","bottom":"0","left":"clamp(10px, 2vw, 28px)"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group alignfull unhurried-hero-photo" style="margin-top:0;margin-bottom:0;padding-top:10px;padding-right:clamp(10px, 2vw, 28px);padding-bottom:0;padding-left:clamp(10px, 2vw, 28px)">
	<!-- wp:cover {"url":"<?php echo esc_url( $unhurried_img ); ?>","dimRatio":60,"overlayColor":"contrast","focalPoint":{"x":0.67,"y":0.45},"minHeight":64,"minHeightUnit":"vh","contentPosition":"bottom left","className":"unhurried-mono unhurried-hero-photo__stage","style":{"border":{"radius":"28px"},"spacing":{"padding":{"top":"var:preset|spacing|80","right":"clamp(1.25rem, 4vw, 4.5rem)","bottom":"var:preset|spacing|70","left":"clamp(1.25rem, 4vw, 4.5rem)"}}},"layout":{"type":"default"}} -->
	<div class="wp-block-cover has-custom-content-position is-position-bottom-left unhurried-mono unhurried-hero-photo__stage" style="border-radius:28px;padding-top:var(--wp--preset--spacing--80);padding-right:clamp(1.25rem, 4vw, 4.5rem);padding-bottom:var(--wp--preset--spacing--70);padding-left:clamp(1.25rem, 4vw, 4.5rem);min-height:64vh"><img class="wp-block-cover__image-background" alt="" src="<?php echo esc_url( $unhurried_img ); ?>" style="object-position:67% 45%" data-object-fit="cover" data-object-position="67% 45%"/><span aria-hidden="true" class="wp-block-cover__background has-contrast-background-color has-background-dim-60 has-background-dim"></span><div class="wp-block-cover__inner-container">
		<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|50"}},"layout":{"type":"constrained","contentSize":"900px","justifyContent":"left"}} -->
		<div class="wp-block-group">
			<!-- wp:breadcrumbs {"className":"unhurried-breadcrumbs"} /-->
			<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
			<p class="is-style-eyebrow"><?php esc_html_e( 'Lorem ipsum', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:heading {"level":1,"fontSize":"huge","style":{"typography":{"lineHeight":"0.9","letterSpacing":"-0.04em"}}} -->
			<h1 class="wp-block-heading has-huge-font-size" style="letter-spacing:-0.04em;line-height:0.9"><?php echo wp_kses( __( 'Lorem <em>ipsum</em>', 'unhurried' ), array( 'em' => array() ) ); ?></h1>
			<!-- /wp:heading -->
			<!-- wp:group {"layout":{"type":"constrained","contentSize":"36ch","justifyContent":"left"}} -->
			<div class="wp-block-group">
				<!-- wp:paragraph {"fontSize":"large","style":{"typography":{"lineHeight":"1.45"}}} -->
				<p class="has-large-font-size" style="line-height:1.45"><?php esc_html_e( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua, ut enim ad minim veniam.', 'unhurried' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
			<!-- wp:search <?php echo $unhurried_search; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- serialize_block_attributes() escapes it for a block comment. ?> /-->
		</div>
		<!-- /wp:group -->
	</div></div>
	<!-- /wp:cover -->
</div>
<!-- /wp:group -->
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr_x( 'Topics', 'Pattern block name', 'unhurried' ); ?>"},"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|90"},"margin":{"top":"0","bottom":"0"},"blockGap":"var:preset|spacing|80"}},"layout":{"type":"constrained","contentSize":"1360px"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--90)">
	<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|60"}},"layout":{"type":"default"}} -->
	<div class="wp-block-group">
		<!-- wp:group {"style":{"border":{"bottom":{"color":"var:preset|color|hairline","width":"1px","style":"solid"}},"spacing":{"padding":{"bottom":"var:preset|spacing|40"}}},"layout":{"type":"flex","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
		<div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--hairline);border-bottom-style:solid;border-bottom-width:1px;padding-bottom:var(--wp--preset--spacing--40)">
			<!-- wp:heading {"fontSize":"x-large"} -->
			<h2 class="wp-block-heading has-x-large-font-size"><?php echo wp_kses( __( 'By <em>topic</em>', 'unhurried' ), array( 'em' => array() ) ); ?></h2>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
			<p class="is-style-eyebrow"><?php esc_html_e( 'Categories', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
		<!-- wp:terms-query {"termQuery":{"perPage":50,"taxonomy":"category","order":"asc","orderBy":"name","include":[],"hideEmpty":true,"showNested":false,"inherit":false},"className":"unhurried-topic-cards"} -->
		<div class="wp-block-terms-query unhurried-topic-cards"><!-- wp:term-template {"layout":{"type":"grid","columnCount":3}} -->
		<!-- wp:group {"className":"is-style-section-card","style":{"spacing":{"blockGap":"var:preset|spacing|40","padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|60","right":"var:preset|spacing|60"}}},"layout":{"type":"default"}} -->
		<div class="wp-block-group is-style-section-card" style="padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--60)">
			<!-- wp:term-count {"bracketType":"none","className":"is-style-eyebrow unhurried-term-count"} /-->
			<!-- wp:term-name {"level":3,"isLink":true,"fontSize":"x-large"} /-->
			<!-- wp:term-description {"textColor":"contrast-2"} /-->
		</div>
		<!-- /wp:group -->
		<!-- /wp:term-template --></div>
		<!-- /wp:terms-query -->
	</div>
	<!-- /wp:group -->
	<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|60"}},"layout":{"type":"default"}} -->
	<div class="wp-block-group">
		<!-- wp:group {"style":{"border":{"bottom":{"color":"var:preset|color|hairline","width":"1px","style":"solid"}},"spacing":{"padding":{"bottom":"var:preset|spacing|40"}}},"layout":{"type":"flex","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
		<div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--hairline);border-bottom-style:solid;border-bottom-width:1px;padding-bottom:var(--wp--preset--spacing--40)">
			<!-- wp:heading {"fontSize":"x-large"} -->
			<h2 class="wp-block-heading has-x-large-font-size"><?php echo wp_kses( __( 'By <em>tag</em>', 'unhurried' ), array( 'em' => array() ) ); ?></h2>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
			<p class="is-style-eyebrow"><?php esc_html_e( 'Tags', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
		<!-- wp:terms-query {"termQuery":{"perPage":100,"taxonomy":"post_tag","order":"asc","orderBy":"name","include":[],"hideEmpty":true,"showNested":false,"inherit":false},"className":"unhurried-chip-terms"} -->
		<div class="wp-block-terms-query unhurried-chip-terms"><!-- wp:term-template -->
		<!-- wp:term-name {"isLink":true} /-->
		<!-- wp:term-count /-->
		<!-- /wp:term-template --></div>
		<!-- /wp:terms-query -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
