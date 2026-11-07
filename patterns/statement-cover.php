<?php
/**
 * Title: Statement on image, with note card
 * Slug: unhurried/statement-cover
 * Categories: featured, about
 * Keywords: values, statement, about, cover, quote
 * Viewport width: 1400
 * Description: A dark full-bleed image with a right-aligned two-line statement and a frosted note card in the lower left.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.0.0
 */

?>
<!-- wp:cover {"url":"<?php echo esc_url( get_theme_file_uri( 'assets/images/branch-shadow.webp' ) ); ?>","dimRatio":70,"gradient":"scrim-right","minHeight":820,"minHeightUnit":"px","isDark":true,"metadata":{"name":"<?php echo esc_attr_x( 'Statement', 'Pattern block name', 'unhurried' ); ?>"},"align":"full","className":"unhurried-mono","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"1360px"}} -->
<div class="wp-block-cover alignfull is-dark unhurried-mono" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80);min-height:820px"><img class="wp-block-cover__image-background" alt="" src="<?php echo esc_url( get_theme_file_uri( 'assets/images/branch-shadow.webp' ) ); ?>" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-background-dim-70 has-background-dim wp-block-cover__gradient-background has-background-gradient has-scrim-right-gradient-background"></span><div class="wp-block-cover__inner-container">
	<!-- wp:group {"className":"unhurried-reveal","style":{"spacing":{"blockGap":"var:preset|spacing|50","margin":{"bottom":"var:preset|spacing|80"}}},"layout":{"type":"constrained","contentSize":"760px","justifyContent":"right"}} -->
	<div class="wp-block-group unhurried-reveal" style="margin-bottom:var(--wp--preset--spacing--80)">
		<!-- wp:paragraph {"align":"right","className":"is-style-eyebrow","textColor":"base"} -->
		<p class="has-text-align-right is-style-eyebrow has-base-color has-text-color"><?php esc_html_e( 'What we believe', 'unhurried' ); ?></p>
		<!-- /wp:paragraph -->
		<!-- wp:heading {"textAlign":"right","textColor":"base","fontSize":"xx-large"} -->
		<h2 class="wp-block-heading has-text-align-right has-base-color has-text-color has-xx-large-font-size"><?php echo wp_kses( __( '<em>Slow</em> is<br>a practice', 'unhurried' ), array( 'em' => array(), 'br' => array() ) ); ?></h2>
		<!-- /wp:heading -->
		<!-- wp:paragraph {"align":"right","textColor":"base","fontSize":"medium"} -->
		<p class="has-text-align-right has-base-color has-text-color has-medium-font-size"><?php esc_html_e( 'We leave space around every booking, so nobody watches the clock, including us.', 'unhurried' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
	<!-- wp:group {"className":"is-style-glass unhurried-note unhurried-reveal","style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"default"}} -->
	<div class="wp-block-group is-style-glass unhurried-note unhurried-reveal">
		<!-- wp:paragraph {"fontSize":"small"} -->
		<p class="has-small-font-size"><?php esc_html_e( 'Arrive ten minutes early. The kettle is always on.', 'unhurried' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</div></div>
<!-- /wp:cover -->
