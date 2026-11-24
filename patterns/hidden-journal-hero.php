<?php
/**
 * Title: Journal hero
 * Slug: unhurried/hidden-journal-hero
 * Inserter: no
 *
 * The top of the journal (the posts page and the blog index): breadcrumbs and
 * the site's own words, as unhurried/hidden-blog-heading prints them (the posts
 * page title with the site name as the eyebrow, else the tagline, else the site
 * name alone), over one of the theme's black-and-white photographs in the
 * statue hero's frame. hidden-blog-heading stays as it was for templates saved
 * in the Site Editor before 1.2.0.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.2.0
 */

$unhurried_img        = get_theme_file_uri( 'assets/images/marble-face-wide.webp' );
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
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr_x( 'Hero', 'Pattern block name', 'unhurried' ); ?>"},"align":"full","className":"unhurried-hero-photo","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|70"},"padding":{"top":"10px","right":"clamp(10px, 2vw, 28px)","bottom":"0","left":"clamp(10px, 2vw, 28px)"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group alignfull unhurried-hero-photo" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--70);padding-top:10px;padding-right:clamp(10px, 2vw, 28px);padding-bottom:0;padding-left:clamp(10px, 2vw, 28px)">
	<!-- wp:cover {"url":"<?php echo esc_url( $unhurried_img ); ?>","dimRatio":60,"overlayColor":"contrast","focalPoint":{"x":0.67,"y":0.45},"minHeight":56,"minHeightUnit":"vh","contentPosition":"bottom left","className":"unhurried-mono unhurried-hero-photo__stage","style":{"border":{"radius":"28px"},"spacing":{"padding":{"top":"var:preset|spacing|80","right":"clamp(1.25rem, 4vw, 4.5rem)","bottom":"var:preset|spacing|70","left":"clamp(1.25rem, 4vw, 4.5rem)"}}},"layout":{"type":"default"}} -->
	<div class="wp-block-cover has-custom-content-position is-position-bottom-left unhurried-mono unhurried-hero-photo__stage" style="border-radius:28px;padding-top:var(--wp--preset--spacing--80);padding-right:clamp(1.25rem, 4vw, 4.5rem);padding-bottom:var(--wp--preset--spacing--70);padding-left:clamp(1.25rem, 4vw, 4.5rem);min-height:56vh"><img class="wp-block-cover__image-background" alt="" src="<?php echo esc_url( $unhurried_img ); ?>" style="object-position:67% 45%" data-object-fit="cover" data-object-position="67% 45%"/><span aria-hidden="true" class="wp-block-cover__background has-contrast-background-color has-background-dim-60 has-background-dim"></span><div class="wp-block-cover__inner-container">
		<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|50"}},"layout":{"type":"constrained","contentSize":"1100px","justifyContent":"left"}} -->
		<div class="wp-block-group">
			<!-- wp:breadcrumbs {"className":"unhurried-breadcrumbs"} /-->
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
	</div></div>
	<!-- /wp:cover -->
</div>
<!-- /wp:group -->
