<?php
/**
 * Title: Blog heading
 * Slug: unhurried/hidden-blog-heading
 * Inserter: no
 *
 * Prints the site's own words, never sample copy: the posts page title (with
 * the site name as the eyebrow), else the tagline, else the site name alone.
 * Before 1.1.2 it read "Notes on craft" on every blog, and the pattern is
 * hidden from the inserter, so owners could not find it to change it.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.0.0
 */

$unhurried_site_name  = trim( wp_strip_all_tags( (string) get_bloginfo( 'name' ) ) );
$unhurried_tagline    = trim( wp_strip_all_tags( (string) get_bloginfo( 'description' ) ) );
$unhurried_posts_page = ( 'page' === get_option( 'show_on_front' ) ) ? (int) get_option( 'page_for_posts' ) : 0;
$unhurried_eyebrow    = $unhurried_site_name;

if ( $unhurried_posts_page && '' !== trim( wp_strip_all_tags( get_the_title( $unhurried_posts_page ) ) ) ) {
	$unhurried_heading = trim( wp_strip_all_tags( get_the_title( $unhurried_posts_page ) ) );
} elseif ( '' !== $unhurried_tagline ) {
	$unhurried_heading = $unhurried_tagline;
} else {
	$unhurried_heading = $unhurried_site_name;
	$unhurried_eyebrow = '';
}
// A long tagline at the huge size fills the screen; step it down a size.
$unhurried_heading_size = ( mb_strlen( $unhurried_heading ) > 32 ) ? 'xx-large' : 'huge';
?>
<!-- wp:group {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|80"},"blockGap":"var:preset|spacing|50"}},"layout":{"type":"constrained","contentSize":"1100px","justifyContent":"left"}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--80)">
	<?php if ( '' !== $unhurried_eyebrow ) : ?>
	<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
	<p class="is-style-eyebrow"><?php echo esc_html( $unhurried_eyebrow ); ?></p>
	<!-- /wp:paragraph -->
	<?php endif; ?>
	<!-- wp:heading {"level":1,"className":"unhurried-reveal","fontSize":"<?php echo esc_attr( $unhurried_heading_size ); ?>"} -->
	<h1 class="wp-block-heading unhurried-reveal has-<?php echo esc_attr( $unhurried_heading_size ); ?>-font-size"><?php echo esc_html( $unhurried_heading ); ?></h1>
	<!-- /wp:heading -->
</div>
<!-- /wp:group -->
