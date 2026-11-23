<?php
/**
 * Title: Marquee
 * Slug: unhurried/marquee
 * Categories: header, text
 * Keywords: marquee, ticker, announcement, banner, scrolling, news
 * Viewport width: 1400
 * Description: A thin Ink line that drifts slowly across the top of the page: the site tagline and the newest posts. It pauses under the pointer or keyboard focus and stands still for visitors who ask for reduced motion. Edit, add or remove lines as you like.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.2.0
 */

/*
 * The default header prints this on every site that has not edited its
 * header, so it carries only the site's own words: the tagline and the
 * three newest post titles. With neither, it prints nothing.
 */
$unhurried_items   = array();
$unhurried_tagline = trim( (string) get_bloginfo( 'description' ) );
if ( '' !== $unhurried_tagline ) {
	$unhurried_items[] = esc_html( $unhurried_tagline );
}
$unhurried_posts = get_posts(
	array(
		'numberposts'      => 3,
		'post_type'        => 'post',
		'post_status'      => 'publish',
		'suppress_filters' => false,
	)
);
foreach ( $unhurried_posts as $unhurried_post ) {
	$unhurried_items[] = sprintf(
		/* translators: %s: Linked post title. */
		esc_html__( 'New in the journal: %s', 'unhurried' ),
		'<a href="' . esc_url( get_permalink( $unhurried_post ) ) . '">' . esc_html( get_the_title( $unhurried_post ) ) . '</a>'
	);
}
if ( ! $unhurried_items ) {
	return;
}
// Enough copy to cross a wide screen before the loop repeats.
$unhurried_count = count( $unhurried_items );
while ( $unhurried_count < 4 ) {
	$unhurried_items = array_merge( $unhurried_items, $unhurried_items );
	$unhurried_count = count( $unhurried_items );
}
?>
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr_x( 'Marquee', 'Pattern block name', 'unhurried' ); ?>"},"className":"unhurried-marquee","backgroundColor":"contrast","textColor":"base","fontSize":"x-small","layout":{"type":"default"}} -->
<div class="wp-block-group unhurried-marquee has-base-color has-contrast-background-color has-text-color has-background has-x-small-font-size">
<?php foreach ( $unhurried_items as $unhurried_item ) : ?>
	<!-- wp:paragraph -->
	<p><?php echo $unhurried_item; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped above. ?></p>
	<!-- /wp:paragraph -->
<?php endforeach; ?>
</div>
<!-- /wp:group -->
