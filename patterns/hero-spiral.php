<?php
/**
 * Title: Hero, spiral
 * Slug: unhurried/hero-spiral
 * Categories: unhurried_hero, featured
 * Keywords: hero, header, intro, headline, image, spiral, staircase
 * Viewport width: 1400
 * Description: A full-height Ink stage with a round image that turns very slowly inside a ring of ticks, an oversized headline whose italic last word slips behind it, a short lede and two buttons. Any square image works.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.1.2
 */

// Tags the translated heading may hold.
$unhurried_heading_tags = array(
	'em' => array(),
	'br' => array(),
);
?>
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr_x( 'Hero', 'Pattern block name', 'unhurried' ); ?>"},"align":"full","className":"unhurried-hero-spiral","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"10px","right":"clamp(10px, 2vw, 28px)","bottom":"0","left":"clamp(10px, 2vw, 28px)"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group alignfull unhurried-hero-spiral" style="margin-top:0;margin-bottom:0;padding-top:10px;padding-right:clamp(10px, 2vw, 28px);padding-bottom:0;padding-left:clamp(10px, 2vw, 28px)">
	<!-- wp:group {"className":"is-style-section-ink unhurried-hero-spiral__stage","style":{"border":{"radius":"28px"},"spacing":{"padding":{"top":"var:preset|spacing|80","right":"clamp(1.25rem, 4vw, 4.5rem)","bottom":"var:preset|spacing|70","left":"clamp(1.25rem, 4vw, 4.5rem)"},"blockGap":"0"}},"layout":{"type":"default"}} -->
	<div class="wp-block-group is-style-section-ink unhurried-hero-spiral__stage" style="border-radius:28px;padding-top:var(--wp--preset--spacing--80);padding-right:clamp(1.25rem, 4vw, 4.5rem);padding-bottom:var(--wp--preset--spacing--70);padding-left:clamp(1.25rem, 4vw, 4.5rem)">
		<!-- wp:image {"aspectRatio":"1","scale":"cover","sizeSlug":"full","linkDestination":"none","className":"unhurried-hero-spiral__disc","style":{"border":{"radius":"999px"}}} -->
		<figure class="wp-block-image size-full has-custom-border unhurried-hero-spiral__disc"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/spiral.webp' ) ); ?>" alt="" style="border-radius:999px;aspect-ratio:1;object-fit:cover"/></figure>
		<!-- /wp:image -->
		<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
		<p class="is-style-eyebrow"><?php esc_html_e( 'Lorem ipsum dolor sit amet', 'unhurried' ); ?></p>
		<!-- /wp:paragraph -->
		<!-- wp:heading {"level":1,"className":"unhurried-hero-spiral__title","style":{"typography":{"lineHeight":"0.9","letterSpacing":"-0.04em"}},"fontSize":"xx-large"} -->
		<h1 class="wp-block-heading unhurried-hero-spiral__title has-xx-large-font-size" style="letter-spacing:-0.04em;line-height:0.9"><?php echo wp_kses( __( 'Lorem ipsum<br>dolor sit <em>amet.</em>', 'unhurried' ), $unhurried_heading_tags ); ?></h1>
		<!-- /wp:heading -->
		<!-- wp:group {"className":"unhurried-hero-spiral__body","style":{"spacing":{"blockGap":"var:preset|spacing|60"}},"layout":{"type":"constrained","contentSize":"30ch","justifyContent":"left"}} -->
		<div class="wp-block-group unhurried-hero-spiral__body">
			<!-- wp:paragraph {"fontSize":"large","style":{"typography":{"lineHeight":"1.45"}}} -->
			<p class="has-large-font-size" style="line-height:1.45"><?php esc_html_e( 'Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'unhurried' ); ?></p>
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
</div>
<!-- /wp:group -->
