<?php
/**
 * Title: Hero, staggered type
 * Slug: unhurried/hero-staggered
 * Categories: unhurried_hero, featured
 * Keywords: hero, header, intro, headline, image, photograph, cover
 * Viewport width: 1400
 * Description: An oversized, staggered headline with an italic accent line, a short lede and two buttons, over a black-and-white photograph in a rounded, inset frame. Swap the image in the Cover block's toolbar.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.0.0
 * @since 1.2.0 On a photograph, in the statue hero's frame (it was on the Ground artboard).
 */

$unhurried_img = get_theme_file_uri( 'assets/images/white-basin-wide.webp' );

// Tags the translated heading may hold.
$unhurried_heading_tags = array(
	'em' => array(),
	'br' => array(),
);
?>
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr_x( 'Hero', 'Pattern block name', 'unhurried' ); ?>"},"align":"full","className":"unhurried-hero-photo","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"10px","right":"clamp(10px, 2vw, 28px)","bottom":"0","left":"clamp(10px, 2vw, 28px)"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group alignfull unhurried-hero-photo" style="margin-top:0;margin-bottom:0;padding-top:10px;padding-right:clamp(10px, 2vw, 28px);padding-bottom:0;padding-left:clamp(10px, 2vw, 28px)">
	<!-- wp:cover {"url":"<?php echo esc_url( $unhurried_img ); ?>","dimRatio":60,"overlayColor":"contrast","focalPoint":{"x":0.5,"y":0.45},"minHeight":86,"minHeightUnit":"vh","contentPosition":"bottom left","className":"unhurried-mono unhurried-hero-photo__stage unhurried-hero-photo__stage--even","style":{"border":{"radius":"28px"},"spacing":{"padding":{"top":"var:preset|spacing|80","right":"clamp(1.25rem, 4vw, 4.5rem)","bottom":"var:preset|spacing|70","left":"clamp(1.25rem, 4vw, 4.5rem)"}}},"layout":{"type":"default"}} -->
	<div class="wp-block-cover has-custom-content-position is-position-bottom-left unhurried-mono unhurried-hero-photo__stage unhurried-hero-photo__stage--even" style="border-radius:28px;padding-top:var(--wp--preset--spacing--80);padding-right:clamp(1.25rem, 4vw, 4.5rem);padding-bottom:var(--wp--preset--spacing--70);padding-left:clamp(1.25rem, 4vw, 4.5rem);min-height:86vh"><img class="wp-block-cover__image-background" alt="" src="<?php echo esc_url( $unhurried_img ); ?>" style="object-position:50% 45%" data-object-fit="cover" data-object-position="50% 45%"/><span aria-hidden="true" class="wp-block-cover__background has-contrast-background-color has-background-dim-60 has-background-dim"></span><div class="wp-block-cover__inner-container">
		<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained","contentSize":"1360px"}} -->
		<div class="wp-block-group">
			<!-- wp:paragraph {"className":"is-style-eyebrow unhurried-indent unhurried-reveal","style":{"spacing":{"margin":{"bottom":"clamp(2rem, 8vh, 6rem)"}}}} -->
			<p class="is-style-eyebrow unhurried-indent unhurried-reveal" style="margin-bottom:clamp(2rem, 8vh, 6rem)"><?php esc_html_e( 'Lorem mauris non nunc qui turpis', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:heading {"level":1,"className":"unhurried-first-indent unhurried-reveal","style":{"typography":{"lineHeight":"0.9","letterSpacing":"-0.04em"}},"fontSize":"huge"} -->
			<h1 class="wp-block-heading unhurried-first-indent unhurried-reveal has-huge-font-size" style="letter-spacing:-0.04em;line-height:0.9"><?php echo wp_kses( __( 'Lorem diam<br>justo est <em>nunc</em>', 'unhurried' ), $unhurried_heading_tags ); ?></h1>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"align":"right","className":"unhurried-reveal","style":{"typography":{"lineHeight":"0.95","letterSpacing":"-0.02em"},"spacing":{"margin":{"top":"0.75rem"}}},"fontFamily":"display","fontSize":"huge"} -->
			<p class="has-text-align-right unhurried-reveal has-display-font-family has-huge-font-size" style="margin-top:0.75rem;letter-spacing:-0.02em;line-height:0.95"><?php echo wp_kses( __( 'lorem <em>arcu.</em>', 'unhurried' ), array( 'em' => array() ) ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:group {"className":"unhurried-indent unhurried-reveal","style":{"spacing":{"margin":{"top":"clamp(2.5rem, 8vh, 6rem)"},"blockGap":"var:preset|spacing|60"}},"layout":{"type":"constrained","contentSize":"32ch","justifyContent":"left"}} -->
			<div class="wp-block-group unhurried-indent unhurried-reveal" style="margin-top:clamp(2.5rem, 8vh, 6rem)">
				<!-- wp:paragraph {"fontSize":"large","style":{"typography":{"lineHeight":"1.45"}}} -->
				<p class="has-large-font-size" style="line-height:1.45"><?php esc_html_e( 'Incididunt odio ad diam ex ea ullamco mattis, amet sem magna non in vel nisl ornare.', 'unhurried' ); ?></p>
				<!-- /wp:paragraph -->
				<!-- wp:buttons {"style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60"}}}} -->
				<div class="wp-block-buttons">
					<!-- wp:button -->
					<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( unhurried_page_link( 'contact' ) ); ?>"><?php esc_html_e( 'Contact us', 'unhurried' ); ?></a></div>
					<!-- /wp:button -->
					<!-- wp:button {"className":"is-style-text-link"} -->
					<div class="wp-block-button is-style-text-link"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( unhurried_page_link( 'services' ) ); ?>"><?php esc_html_e( 'Our services', 'unhurried' ); ?></a></div>
					<!-- /wp:button -->
				</div>
				<!-- /wp:buttons -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	</div></div>
	<!-- /wp:cover -->
</div>
<!-- /wp:group -->
