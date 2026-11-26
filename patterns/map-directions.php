<?php
/**
 * Title: Map and directions
 * Slug: unhurried/map-directions
 * Categories: contact, featured
 * Keywords: map, directions, address, location, find us, parking, travel
 * Viewport width: 1400
 * Description: Address, how to get there and a Get directions button, beside a map: a drawn one with a pin and an address note, or, with the free Gmap Block plugin active, a live Google map in the theme's frame with the address under it. Type your address in the map block, or paste Google Maps' embed code in a Custom HTML block in its place.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.1.0
 */

// Tags the translated heading may hold.
$unhurried_heading_tags = array(
	'em' => array(),
	'br' => array(),
);

// With the free Gmap Block plugin (Google Maps, no API key) the section shows
// a live map in the theme's frame (inc/map.php); otherwise the drawn one. The
// demo place is a point, not an address: Google turned the demo address into
// a real business and showed its card.
$unhurried_live_map = class_exists( 'WP_Block_Type_Registry' ) && WP_Block_Type_Registry::get_instance()->is_registered( 'gmap/gmap-block' );
?>
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr_x( 'Map and directions', 'Pattern block name', 'unhurried' ); ?>"},"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"1360px"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
	<!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|80"}}}} -->
	<div class="wp-block-columns are-vertically-aligned-center">
		<!-- wp:column {"verticalAlignment":"center","width":"42%","className":"unhurried-reveal","style":{"spacing":{"blockGap":"var:preset|spacing|50"}}} -->
		<div class="wp-block-column is-vertically-aligned-center unhurried-reveal" style="flex-basis:42%">
			<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
			<p class="is-style-eyebrow"><?php esc_html_e( 'Lorem ut', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:heading {"fontSize":"xx-large"} -->
			<h2 class="wp-block-heading has-xx-large-font-size"><?php echo wp_kses( __( 'Lorem iaculis<br>nunc sem <em>egestas</em>', 'unhurried' ), $unhurried_heading_tags ); ?></h2>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"fontSize":"large"} -->
			<p class="has-large-font-size"><?php echo wp_kses( __( '12 Lorem Sit<br>Malesuada, 00000', 'unhurried' ), array( 'br' => array() ) ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph {"textColor":"contrast-2","style":{"layout":{"selfStretch":"fixed","flexSize":"min(100%, 40ch)"}}} -->
			<p class="has-contrast-2-color has-text-color"><?php esc_html_e( 'Lorem nulla: Facilisis, arcu ut odio diam et Dolore Sit. Ad sed: non culpa ex amet egestas aliqua qui pariatur. Est nisl ea sed vitae sem.', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:buttons -->
			<div class="wp-block-buttons">
				<!-- wp:button {"className":"is-style-hairline"} -->
				<div class="wp-block-button is-style-hairline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( 'https://www.google.com/maps/search/?api=1&query=41.5087%2C-81.6129' ); ?>"><?php esc_html_e( 'Get directions', 'unhurried' ); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"verticalAlignment":"center","width":"58%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:58%">
			<?php if ( $unhurried_live_map ) : ?>
			<!-- wp:gmap/gmap-block {"address":"41.5087,-81.6129","zoom":15} -->
			<div class="wp-block-gmap-gmap-block"><iframe src="https://maps.google.com/maps?q=41.5087%2C-81.6129&amp;z=15&amp;t=roadmap&amp;output=embed" class="embd-map" title="41.5087,-81.6129"></iframe></div>
			<!-- /wp:gmap/gmap-block -->
			<!-- wp:paragraph {"className":"unhurried-map-caption","textColor":"contrast-2","fontSize":"x-small"} -->
			<p class="unhurried-map-caption has-contrast-2-color has-text-color has-x-small-font-size"><?php esc_html_e( '12 Lorem Est, Consequat', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
			<?php else : ?>
			<!-- wp:group {"className":"unhurried-map unhurried-reveal","layout":{"type":"default"}} -->
			<div class="wp-block-group unhurried-map unhurried-reveal">
				<!-- wp:group {"className":"is-style-glass unhurried-note","style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"default"}} -->
				<div class="wp-block-group is-style-glass unhurried-note">
					<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
					<p class="is-style-eyebrow"><?php esc_html_e( 'Lorem veniam', 'unhurried' ); ?></p>
					<!-- /wp:paragraph -->
					<!-- wp:paragraph {"fontSize":"small"} -->
					<p class="has-small-font-size"><?php esc_html_e( '12 Lorem Est, Consequat', 'unhurried' ); ?></p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
			<?php endif; ?>
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
