<?php
/**
 * Title: Numbers
 * Slug: unhurried/stats-row
 * Categories: text, featured
 * Keywords: numbers, stats, statistics, figures, facts, counter, results
 * Viewport width: 1400
 * Description: Four large figures set in the display face, each over a hairline with a short label and a line of detail, under a left-aligned heading.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.2.0
 */

$unhurried_stats = array(
	array( '12', __( 'Lorem ipsum', 'unhurried' ), __( 'Dolor sit amet, consectetur adipiscing elit sed do.', 'unhurried' ) ),
	array( '340', __( 'Dolor sit', 'unhurried' ), __( 'Eiusmod tempor incididunt ut labore et dolore magna.', 'unhurried' ) ),
	array( '98%', __( 'Consectetur', 'unhurried' ), __( 'Ut enim ad minim veniam, quis nostrud exercitation.', 'unhurried' ) ),
	array( '2008', __( 'Adipiscing', 'unhurried' ), __( 'Duis aute irure dolor in reprehenderit in voluptate.', 'unhurried' ) ),
);
?>
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr_x( 'Numbers', 'Pattern block name', 'unhurried' ); ?>"},"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|90","bottom":"var:preset|spacing|90"},"margin":{"top":"0","bottom":"0"},"blockGap":"var:preset|spacing|80"}},"layout":{"type":"constrained","contentSize":"1360px"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--90);padding-bottom:var(--wp--preset--spacing--90)">
	<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|50"}},"layout":{"type":"constrained","contentSize":"760px","justifyContent":"left"}} -->
	<div class="wp-block-group">
		<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
		<p class="is-style-eyebrow"><?php esc_html_e( 'Lorem ipsum', 'unhurried' ); ?></p>
		<!-- /wp:paragraph -->
		<!-- wp:heading {"fontSize":"xx-large"} -->
		<h2 class="wp-block-heading has-xx-large-font-size"><?php echo wp_kses( __( 'Ut enim ad <em>minim</em> veniam', 'unhurried' ), array( 'em' => array() ) ); ?></h2>
		<!-- /wp:heading -->
	</div>
	<!-- /wp:group -->
	<!-- wp:columns {"className":"unhurried-stats unhurried-reveal","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|70","left":"var:preset|spacing|60"}}}} -->
	<div class="wp-block-columns unhurried-stats unhurried-reveal">
		<?php foreach ( $unhurried_stats as $unhurried_stat ) : ?>
		<!-- wp:column {"style":{"border":{"top":{"color":"var:preset|color|hairline","width":"1px","style":"solid"}},"spacing":{"padding":{"top":"var:preset|spacing|50"},"blockGap":"var:preset|spacing|30"}}} -->
		<div class="wp-block-column" style="border-top-color:var(--wp--preset--color--hairline);border-top-style:solid;border-top-width:1px;padding-top:var(--wp--preset--spacing--50)">
			<!-- wp:paragraph {"className":"unhurried-stat","fontFamily":"display","style":{"typography":{"fontSize":"clamp(3.5rem, 7vw, 6.5rem)","fontWeight":"500","lineHeight":"0.9","letterSpacing":"-0.05em"}}} -->
			<p class="unhurried-stat has-display-font-family" style="font-size:clamp(3.5rem, 7vw, 6.5rem);font-weight:500;letter-spacing:-0.05em;line-height:0.9"><?php echo esc_html( $unhurried_stat[0] ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph {"style":{"typography":{"fontWeight":"500"}}} -->
			<p style="font-weight:500"><?php echo esc_html( $unhurried_stat[1] ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph {"textColor":"contrast-2","fontSize":"small"} -->
			<p class="has-contrast-2-color has-text-color has-small-font-size"><?php echo esc_html( $unhurried_stat[2] ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->
		<?php endforeach; ?>
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
