<?php
/**
 * Title: Hero, framed picture
 * Slug: unhurried/hero-film
 * Categories: unhurried_hero, featured
 * Keywords: hero, header, intro, headline, david, michelangelo, statue, sculpture, framed, video, film, loop
 * Viewport width: 1400
 * Description: An oversized headline, a short lede and one button beside Michelangelo's David in a rounded frame, with a caption under it. The frame can also play a short silent film: select the Video block in the frame ("Film (optional)" in the List View) and upload or choose a video. The picture shows first, and stays whenever the film cannot play.
 *
 * @package Unhurried
 * @author  Moses Atia Poston, Switch Case Studio
 * @since 1.2.1
 */

// Tags the translated heading may hold. Its lines are set short, so each one
// fits its column with room to spare in the theme's fonts and in the fallback
// faces shown while they load: the headline keeps its lines when the fonts
// arrive, and nothing below it moves.
$unhurried_heading_tags = array(
	'em' => array(),
	'br' => array(),
);
?>
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr_x( 'Hero', 'Pattern block name', 'unhurried' ); ?>"},"align":"full","className":"unhurried-hero-film","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained","contentSize":"1360px"}} -->
<div class="wp-block-group alignfull unhurried-hero-film" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:columns {"verticalAlignment":"bottom","className":"unhurried-hero-film__row","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|70"}}}} -->
	<div class="wp-block-columns are-vertically-aligned-bottom unhurried-hero-film__row">
		<!-- wp:column {"verticalAlignment":"bottom","width":"58%","className":"unhurried-hero-film__text","style":{"spacing":{"blockGap":"var:preset|spacing|50"}}} -->
		<div class="wp-block-column is-vertically-aligned-bottom unhurried-hero-film__text" style="flex-basis:58%">
			<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
			<p class="is-style-eyebrow"><?php esc_html_e( 'Lorem ipsum dolor', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:heading {"level":1,"fontSize":"huge","style":{"typography":{"lineHeight":"0.9","letterSpacing":"-0.04em"}}} -->
			<h1 class="wp-block-heading has-huge-font-size" style="letter-spacing:-0.04em;line-height:0.9"><?php echo wp_kses( __( 'Lorem<br><em>ipsum</em><br>dolor sit', 'unhurried' ), $unhurried_heading_tags ); ?></h1>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"textColor":"contrast-2","fontSize":"large","style":{"typography":{"lineHeight":"1.45"}}} -->
			<p class="has-contrast-2-color has-text-color has-large-font-size" style="line-height:1.45"><?php esc_html_e( 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:buttons -->
			<div class="wp-block-buttons">
				<!-- wp:button -->
				<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( unhurried_page_link( 'services' ) ); ?>"><?php esc_html_e( 'See our services', 'unhurried' ); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"verticalAlignment":"bottom","width":"42%","className":"unhurried-hero-film__media"} -->
		<div class="wp-block-column is-vertically-aligned-bottom unhurried-hero-film__media" style="flex-basis:42%">
			<!-- wp:group {"metadata":{"name":"<?php echo esc_attr_x( 'Frame', 'Pattern block name', 'unhurried' ); ?>"},"className":"unhurried-hero-film__frame unhurried-mono unhurried-still","layout":{"type":"default"}} -->
			<div class="wp-block-group unhurried-hero-film__frame unhurried-mono unhurried-still">
				<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"unhurried-hero-film__poster"} -->
				<figure class="wp-block-image size-full unhurried-hero-film__poster"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/david-hero.webp' ) ); ?>" alt=""/></figure>
				<!-- /wp:image -->
				<!-- wp:video {"metadata":{"name":"<?php echo esc_attr_x( 'Film (optional)', 'Pattern block name', 'unhurried' ); ?>"},"className":"unhurried-hero-film__film"} -->
				<figure class="wp-block-video unhurried-hero-film__film"></figure>
				<!-- /wp:video -->
			</div>
			<!-- /wp:group -->
			<!-- wp:paragraph {"className":"unhurried-hero-film__caption","textColor":"contrast-2","fontSize":"x-small"} -->
			<p class="unhurried-hero-film__caption has-contrast-2-color has-text-color has-x-small-font-size"><?php echo wp_kses( __( 'Michelangelo, <em>David</em>, Florence. Photograph: Edizione Brogi, Rijksmuseum', 'unhurried' ), array( 'em' => array() ) ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
