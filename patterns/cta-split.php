<?php
/**
 * Title: Call to action, image and card
 * Slug: unhurried/cta-split
 * Categories: call-to-action, featured
 * Keywords: cta, contact, book, visit
 * Viewport width: 1400
 * Description: A monochrome image joined to a Bone card with a headline, a short note and a button.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.0.0
 */

?>
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr_x( 'Call to action', 'Pattern block name', 'unhurried' ); ?>"},"align":"full","className":"is-style-section-ground","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"1360px"}} -->
<div class="wp-block-group alignfull is-style-section-ground" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
	<!-- wp:columns {"className":"unhurried-reveal","style":{"spacing":{"blockGap":{"top":"0","left":"0"}},"border":{"radius":"24px"},"shadow":"var:preset|shadow|float"}} -->
	<div class="wp-block-columns unhurried-reveal" style="border-radius:24px;box-shadow:var(--wp--preset--shadow--float)">
		<!-- wp:column {"className":"unhurried-mono"} -->
		<div class="wp-block-column unhurried-mono">
			<!-- wp:image {"aspectRatio":"4/3","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":{"topLeft":"24px","bottomLeft":"24px","topRight":"0px","bottomRight":"0px"}}}} -->
			<figure class="wp-block-image size-full has-custom-border"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/light-window.webp' ) ); ?>" alt="" style="border-top-left-radius:24px;border-top-right-radius:0px;border-bottom-left-radius:24px;border-bottom-right-radius:0px;aspect-ratio:4/3;object-fit:cover"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"verticalAlignment":"center","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70","left":"var:preset|spacing|70","right":"var:preset|spacing|70"},"blockGap":"var:preset|spacing|50"},"border":{"radius":{"topRight":"24px","bottomRight":"24px"}}},"backgroundColor":"base"} -->
		<div class="wp-block-column is-vertically-aligned-center has-base-background-color has-background" style="border-top-right-radius:24px;border-bottom-right-radius:24px;padding-top:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70);padding-left:var(--wp--preset--spacing--70)">
			<!-- wp:heading {"fontSize":"xx-large"} -->
			<h2 class="wp-block-heading has-xx-large-font-size"><?php echo wp_kses( __( 'Make some<br><em>time</em> for it', 'unhurried' ), array( 'em' => array(), 'br' => array() ) ); ?></h2>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"textColor":"contrast-2"} -->
			<p class="has-contrast-2-color has-text-color"><?php esc_html_e( 'Pick a morning, an afternoon or a whole Saturday. We will keep it quiet for you.', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:buttons -->
			<div class="wp-block-buttons">
				<!-- wp:button -->
				<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( unhurried_page_link( 'contact' ) ); ?>"><?php esc_html_e( 'Book a visit', 'unhurried' ); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
