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
	array( __( 'Lorem', 'unhurried' ), __( 'Nulla', 'unhurried' ) ),
	array( __( 'Aliquip ut Fugiat', 'unhurried' ), __( '10 lorem 7', 'unhurried' ) ),
	array( __( 'Suscipit', 'unhurried' ), __( '9 lorem 3', 'unhurried' ) ),
	array( __( 'Tempor', 'unhurried' ), __( '11 lorem 4', 'unhurried' ) ),
	array( __( 'Magna', 'unhurried' ), __( 'Nulla', 'unhurried' ) ),
);

// Tags the translated heading may hold.
$unhurried_heading_tags = array(
	'em' => array(),
	'br' => array(),
);
?>
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr_x( 'Hours', 'Pattern block name', 'unhurried' ); ?>"},"align":"full","className":"is-style-section-ground","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"1360px"}} -->
<div class="wp-block-group alignfull is-style-section-ground" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
	<!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|80"}}}} -->
	<div class="wp-block-columns are-vertically-aligned-center">
		<!-- wp:column {"verticalAlignment":"center","width":"42%","className":"unhurried-reveal","style":{"spacing":{"blockGap":"var:preset|spacing|50"}}} -->
		<div class="wp-block-column is-vertically-aligned-center unhurried-reveal" style="flex-basis:42%">
			<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
			<p class="is-style-eyebrow"><?php esc_html_e( 'Lorem', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:heading {"fontSize":"xx-large"} -->
			<h2 class="wp-block-heading has-xx-large-font-size"><?php echo wp_kses( __( 'Lorem duis ex<br><em>aute</em>', 'unhurried' ), $unhurried_heading_tags ); ?></h2>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"textColor":"contrast-2","fontSize":"large","style":{"typography":{"lineHeight":"1.45"}}} -->
			<p class="has-contrast-2-color has-text-color has-large-font-size" style="line-height:1.45"><?php esc_html_e( 'Lorem ea non qui magna. Sint minim est in sunt, nullam quis risus eget urna mollis ornare vel eu leo. Vivamus sagittis lacus vel augue laoreet rutrum.', 'unhurried' ); ?></p>
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
				<!-- wp:paragraph -->
				<p><?php echo esc_html( $unhurried_row[1] ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
			<?php endforeach; ?>
			<!-- wp:paragraph {"fontSize":"x-small","textColor":"contrast-2","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
			<p class="has-contrast-2-color has-text-color has-x-small-font-size" style="margin-top:var(--wp--preset--spacing--50)"><?php esc_html_e( 'Lorem id mattis bibendum. Sed ornare ut eu anim sem, donec id elit non mi porta gravida at eget metus.', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
