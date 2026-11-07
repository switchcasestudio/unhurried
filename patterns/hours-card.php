<?php
/**
 * Title: Opening hours card
 * Slug: unhurried/hours-card
 * Categories: featured, contact
 * Keywords: hours, opening, times, open, closed, week
 * Viewport width: 1400
 * Description: A Bone card with the week's hours in hairline rows, beside a short note about visiting.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.1.0
 */

$unhurried_hours = array(
	array( __( 'Monday', 'unhurried' ), __( 'Closed', 'unhurried' ) ),
	array( __( 'Tuesday to Friday', 'unhurried' ), __( '10 to 7', 'unhurried' ) ),
	array( __( 'Saturday', 'unhurried' ), __( '9 to 3', 'unhurried' ) ),
	array( __( 'Sunday', 'unhurried' ), __( 'Closed', 'unhurried' ) ),
);
?>
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr_x( 'Hours', 'Pattern block name', 'unhurried' ); ?>"},"align":"full","className":"is-style-section-ground","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"1360px"}} -->
<div class="wp-block-group alignfull is-style-section-ground" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
	<!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|80"}}}} -->
	<div class="wp-block-columns are-vertically-aligned-center">
		<!-- wp:column {"verticalAlignment":"center","width":"42%","className":"unhurried-reveal","style":{"spacing":{"blockGap":"var:preset|spacing|50"}}} -->
		<div class="wp-block-column is-vertically-aligned-center unhurried-reveal" style="flex-basis:42%">
			<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
			<p class="is-style-eyebrow"><?php esc_html_e( 'Hours', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:heading {"fontSize":"xx-large"} -->
			<h2 class="wp-block-heading has-xx-large-font-size"><?php echo wp_kses( __( 'When the door<br>is <em>open</em>', 'unhurried' ), array( 'em' => array(), 'br' => array() ) ); ?></h2>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"textColor":"contrast-2","fontSize":"large","style":{"typography":{"lineHeight":"1.45"}}} -->
			<p class="has-contrast-2-color has-text-color has-large-font-size" style="line-height:1.45"><?php esc_html_e( 'Walk in for the shelf. Book ahead for a room.', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"verticalAlignment":"center","width":"58%","className":"is-style-card unhurried-reveal","style":{"spacing":{"blockGap":"0"},"shadow":"var:preset|shadow|float"}} -->
		<div class="wp-block-column is-vertically-aligned-center is-style-card unhurried-reveal" style="box-shadow:var(--wp--preset--shadow--float);flex-basis:58%">
			<?php foreach ( $unhurried_hours as $unhurried_row ) : ?>
			<!-- wp:group {"className":"unhurried-hours","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}}},"layout":{"type":"flex","justifyContent":"space-between","flexWrap":"nowrap"}} -->
			<div class="wp-block-group unhurried-hours" style="padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40)">
				<!-- wp:paragraph {"fontFamily":"display","style":{"typography":{"fontWeight":"500"}}} -->
				<p class="has-display-font-family" style="font-weight:500"><?php echo esc_html( $unhurried_row[0] ); ?></p>
				<!-- /wp:paragraph -->
				<!-- wp:paragraph {"textColor":"contrast-2"} -->
				<p class="has-contrast-2-color has-text-color"><?php echo esc_html( $unhurried_row[1] ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
			<?php endforeach; ?>
			<!-- wp:paragraph {"fontSize":"x-small","textColor":"contrast-2","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
			<p class="has-contrast-2-color has-text-color has-x-small-font-size" style="margin-top:var(--wp--preset--spacing--50)"><?php esc_html_e( 'Closed on public holidays. The kettle is on from ten.', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
