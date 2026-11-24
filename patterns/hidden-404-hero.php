<?php
/**
 * Title: Page not found hero
 * Slug: unhurried/hidden-404-hero
 * Inserter: no
 *
 * The page-not-found screen: the words of unhurried/hidden-404 and a search
 * box, over one of the theme's black-and-white photographs in the statue hero's
 * frame. hidden-404 stays as it was for templates saved in the Site Editor
 * before 1.2.0.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.2.0
 */

$unhurried_img    = get_theme_file_uri( 'assets/images/white-basin-wide.webp' );
$unhurried_search = serialize_block_attributes(
	array(
		'label'          => _x( 'Search', 'search form label', 'unhurried' ),
		'showLabel'      => false,
		'placeholder'    => _x( 'Search…', 'search input placeholder', 'unhurried' ),
		'buttonText'     => _x( 'Search', 'search button text', 'unhurried' ),
		'buttonPosition' => 'button-inside',
		'buttonUseIcon'  => true,
		'className'      => 'unhurried-journal-search',
	)
);
?>
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr_x( 'Hero', 'Pattern block name', 'unhurried' ); ?>"},"align":"full","className":"unhurried-hero-photo","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|70"},"padding":{"top":"10px","right":"clamp(10px, 2vw, 28px)","bottom":"0","left":"clamp(10px, 2vw, 28px)"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group alignfull unhurried-hero-photo" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--70);padding-top:10px;padding-right:clamp(10px, 2vw, 28px);padding-bottom:0;padding-left:clamp(10px, 2vw, 28px)">
	<!-- wp:cover {"url":"<?php echo esc_url( $unhurried_img ); ?>","dimRatio":60,"overlayColor":"contrast","focalPoint":{"x":0.55,"y":0.45},"minHeight":72,"minHeightUnit":"vh","contentPosition":"bottom left","className":"unhurried-mono unhurried-hero-photo__stage","style":{"border":{"radius":"28px"},"spacing":{"padding":{"top":"var:preset|spacing|80","right":"clamp(1.25rem, 4vw, 4.5rem)","bottom":"var:preset|spacing|70","left":"clamp(1.25rem, 4vw, 4.5rem)"}}},"layout":{"type":"default"}} -->
	<div class="wp-block-cover has-custom-content-position is-position-bottom-left unhurried-mono unhurried-hero-photo__stage" style="border-radius:28px;padding-top:var(--wp--preset--spacing--80);padding-right:clamp(1.25rem, 4vw, 4.5rem);padding-bottom:var(--wp--preset--spacing--70);padding-left:clamp(1.25rem, 4vw, 4.5rem);min-height:72vh"><img class="wp-block-cover__image-background" alt="" src="<?php echo esc_url( $unhurried_img ); ?>" style="object-position:55% 45%" data-object-fit="cover" data-object-position="55% 45%"/><span aria-hidden="true" class="wp-block-cover__background has-contrast-background-color has-background-dim-60 has-background-dim"></span><div class="wp-block-cover__inner-container">
		<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|60"}},"layout":{"type":"constrained","contentSize":"1100px","justifyContent":"left"}} -->
		<div class="wp-block-group">
			<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
			<p class="is-style-eyebrow"><?php esc_html_e( 'Error 404', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:heading {"level":1,"fontSize":"huge"} -->
			<h1 class="wp-block-heading has-huge-font-size"><?php echo wp_kses( __( 'Nothing <em>here,</em> yet.', 'unhurried' ), array( 'em' => array() ) ); ?></h1>
			<!-- /wp:heading -->
			<!-- wp:group {"layout":{"type":"constrained","contentSize":"36ch","justifyContent":"left"}} -->
			<div class="wp-block-group">
				<!-- wp:paragraph {"fontSize":"large"} -->
				<p class="has-large-font-size"><?php esc_html_e( 'The page you were looking for has moved or never existed. Try a search.', 'unhurried' ); ?></p>
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
