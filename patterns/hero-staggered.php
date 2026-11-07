<?php
/**
 * Title: Hero, staggered type
 * Slug: unhurried/hero-staggered
 * Categories: unhurried_hero, featured
 * Keywords: hero, header, intro, headline
 * Viewport width: 1400
 * Description: An oversized, staggered headline with an italic accent line, a short lede and two buttons, on the Ground artboard.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.0.0
 */

?>
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr_x( 'Hero', 'Pattern block name', 'unhurried' ); ?>"},"align":"full","className":"is-style-section-ground","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"calc(clamp(80px, 11vw, 160px) + 2.5rem)"},"margin":{"top":"0","bottom":"0"},"blockGap":"0"}},"layout":{"type":"constrained","contentSize":"1360px"}} -->
<div class="wp-block-group alignfull is-style-section-ground" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:calc(clamp(80px, 11vw, 160px) + 2.5rem)">
	<!-- wp:paragraph {"className":"is-style-eyebrow unhurried-indent unhurried-reveal","style":{"spacing":{"margin":{"bottom":"clamp(2rem, 8vh, 6rem)"}}}} -->
	<p class="is-style-eyebrow unhurried-indent unhurried-reveal" style="margin-bottom:clamp(2rem, 8vh, 6rem)"><?php esc_html_e( 'A studio for rest and ritual', 'unhurried' ); ?></p>
	<!-- /wp:paragraph -->
	<!-- wp:heading {"level":1,"className":"unhurried-first-indent unhurried-reveal","style":{"typography":{"lineHeight":"0.9","letterSpacing":"-0.04em"}},"fontSize":"huge"} -->
	<h1 class="wp-block-heading unhurried-first-indent unhurried-reveal has-huge-font-size" style="letter-spacing:-0.04em;line-height:0.9"><?php echo wp_kses( __( 'Good work<br>takes its <em>time</em>', 'unhurried' ), array( 'em' => array(), 'br' => array() ) ); ?></h1>
	<!-- /wp:heading -->
	<!-- wp:paragraph {"align":"right","className":"unhurried-reveal","style":{"typography":{"lineHeight":"0.95","letterSpacing":"-0.02em"},"spacing":{"margin":{"top":"0.75rem"}}},"fontFamily":"display","fontSize":"huge"} -->
	<p class="has-text-align-right unhurried-reveal has-display-font-family has-huge-font-size" style="margin-top:0.75rem;letter-spacing:-0.02em;line-height:0.95"><?php echo wp_kses( __( 'and <em>care.</em>', 'unhurried' ), array( 'em' => array() ) ); ?></p>
	<!-- /wp:paragraph -->
	<!-- wp:group {"className":"unhurried-indent unhurried-reveal","style":{"spacing":{"margin":{"top":"clamp(2.5rem, 8vh, 6rem)"},"blockGap":"var:preset|spacing|60"}},"layout":{"type":"constrained","contentSize":"32ch","justifyContent":"left"}} -->
	<div class="wp-block-group unhurried-indent unhurried-reveal" style="margin-top:clamp(2.5rem, 8vh, 6rem)">
		<!-- wp:paragraph {"textColor":"contrast-2","fontSize":"large","style":{"typography":{"lineHeight":"1.45"}}} -->
		<p class="has-contrast-2-color has-text-color has-large-font-size" style="line-height:1.45"><?php esc_html_e( 'Everything here is made to be enjoyed slowly, from the first cup to the last minute.', 'unhurried' ); ?></p>
		<!-- /wp:paragraph -->
		<!-- wp:buttons {"style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60"}}}} -->
		<div class="wp-block-buttons">
			<!-- wp:button -->
			<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( unhurried_page_link( 'contact' ) ); ?>"><?php esc_html_e( 'Book a visit', 'unhurried' ); ?></a></div>
			<!-- /wp:button -->
			<!-- wp:button {"className":"is-style-text-link"} -->
			<div class="wp-block-button is-style-text-link"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( unhurried_page_link( 'services' ) ); ?>"><?php esc_html_e( 'See our services', 'unhurried' ); ?></a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
