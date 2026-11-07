<?php
/**
 * Title: Map and directions
 * Slug: unhurried/map-directions
 * Categories: contact, featured
 * Keywords: map, directions, address, location, find us, parking, travel
 * Viewport width: 1400
 * Description: Address, how to get there and a Get directions button, beside a drawn map placeholder with a pin and an address note. Replace the placeholder group with your map plugin's block.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.1.0
 */

?>
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr_x( 'Map and directions', 'Pattern block name', 'unhurried' ); ?>"},"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"1360px"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
	<!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|80"}}}} -->
	<div class="wp-block-columns are-vertically-aligned-center">
		<!-- wp:column {"verticalAlignment":"center","width":"42%","className":"unhurried-reveal","style":{"spacing":{"blockGap":"var:preset|spacing|50"}}} -->
		<div class="wp-block-column is-vertically-aligned-center unhurried-reveal" style="flex-basis:42%">
			<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
			<p class="is-style-eyebrow"><?php esc_html_e( 'Find us', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:heading {"fontSize":"xx-large"} -->
			<h2 class="wp-block-heading has-xx-large-font-size"><?php echo wp_kses( __( 'Ten minutes<br>from the <em>station</em>', 'unhurried' ), array( 'em' => array(), 'br' => array() ) ); ?></h2>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"fontSize":"large"} -->
			<p class="has-large-font-size"><?php echo wp_kses( __( '12 Linden Row<br>Hillsdale, 00000', 'unhurried' ), array( 'br' => array() ) ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph {"textColor":"contrast-2","style":{"layout":{"selfStretch":"fixed","flexSize":"min(100%, 40ch)"}}} -->
			<p class="has-contrast-2-color has-text-color"><?php esc_html_e( 'By train: Hillsdale, then a slow walk up Linden Row. By car: two hours of free parking behind the building. The door is the green one.', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:buttons -->
			<div class="wp-block-buttons">
				<!-- wp:button {"className":"is-style-hairline"} -->
				<div class="wp-block-button is-style-hairline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( 'https://www.google.com/maps/search/?api=1&query=12+Linden+Row+Hillsdale' ); ?>"><?php esc_html_e( 'Get directions', 'unhurried' ); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"verticalAlignment":"center","width":"58%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:58%">
			<!-- wp:group {"className":"unhurried-map unhurried-reveal","layout":{"type":"default"}} -->
			<div class="wp-block-group unhurried-map unhurried-reveal">
				<!-- wp:group {"className":"is-style-glass unhurried-note","style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"default"}} -->
				<div class="wp-block-group is-style-glass unhurried-note">
					<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
					<p class="is-style-eyebrow"><?php esc_html_e( 'The studio', 'unhurried' ); ?></p>
					<!-- /wp:paragraph -->
					<!-- wp:paragraph {"fontSize":"small"} -->
					<p class="has-small-font-size"><?php esc_html_e( '12 Linden Row, Hillsdale', 'unhurried' ); ?></p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
