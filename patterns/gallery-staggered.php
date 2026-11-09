<?php
/**
 * Title: Staggered gallery
 * Slug: unhurried/gallery-staggered
 * Categories: featured, gallery
 * Keywords: gallery, images, materials, products
 * Viewport width: 1400
 * Description: A centered heading over four staggered monochrome images.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.0.0
 */

$unhurried_images = array( 'vessel', 'orb', 'pedestal', 'arch' );
?>
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr_x( 'Gallery', 'Pattern block name', 'unhurried' ); ?>"},"align":"full","className":"is-style-section-ground","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"},"blockGap":"var:preset|spacing|70"}},"layout":{"type":"constrained","contentSize":"1360px"}} -->
<div class="wp-block-group alignfull is-style-section-ground" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
	<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group">
		<!-- wp:paragraph {"align":"center","className":"is-style-eyebrow"} -->
		<p class="has-text-align-center is-style-eyebrow"><?php esc_html_e( 'Around the studio', 'unhurried' ); ?></p>
		<!-- /wp:paragraph -->
		<!-- wp:heading {"textAlign":"center","fontSize":"x-large"} -->
		<h2 class="wp-block-heading has-text-align-center has-x-large-font-size"><?php echo wp_kses( __( 'Small <em>things</em>', 'unhurried' ), array( 'em' => array() ) ); ?></h2>
		<!-- /wp:heading -->
	</div>
	<!-- /wp:group -->
	<!-- wp:columns {"isStackedOnMobile":false,"className":"unhurried-stagger unhurried-mono","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|40","left":"clamp(0.75rem, 2vw, 1.5rem)"}}}} -->
	<div class="wp-block-columns is-not-stacked-on-mobile unhurried-stagger unhurried-mono">
		<?php foreach ( $unhurried_images as $unhurried_image ) : ?>
		<!-- wp:column {"className":"unhurried-reveal"} -->
		<div class="wp-block-column unhurried-reveal">
			<!-- wp:image {"aspectRatio":"4/5","scale":"cover","sizeSlug":"full","linkDestination":"none"} -->
			<figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/' . $unhurried_image . '.webp' ) ); ?>" alt="" style="aspect-ratio:4/5;object-fit:cover"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->
		<?php endforeach; ?>
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
