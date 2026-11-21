<?php
/**
 * Title: Team feature
 * Slug: unhurried/team
 * Categories: team, about
 * Keywords: team, people, founder, about, portrait
 * Viewport width: 1400
 * Description: One large image beside a short introduction to the people who run the place.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.0.0
 */

?>
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr_x( 'Team', 'Pattern block name', 'unhurried' ); ?>"},"align":"full","className":"is-style-section-ink","style":{"spacing":{"padding":{"top":"var:preset|spacing|90","bottom":"var:preset|spacing|90"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"1360px"}} -->
<div class="wp-block-group alignfull is-style-section-ink" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--90);padding-bottom:var(--wp--preset--spacing--90)">
	<!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|80"}}}} -->
	<div class="wp-block-columns are-vertically-aligned-center">
		<!-- wp:column {"verticalAlignment":"center","width":"40%","className":"unhurried-mono unhurried-reveal"} -->
		<div class="wp-block-column is-vertically-aligned-center unhurried-mono unhurried-reveal" style="flex-basis:40%">
			<!-- wp:image {"aspectRatio":"4/5","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"24px"}}} -->
			<figure class="wp-block-image size-full has-custom-border"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/pedestal.webp' ) ); ?>" alt="" style="border-radius:24px;aspect-ratio:4/5;object-fit:cover"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"verticalAlignment":"center","width":"60%","className":"unhurried-reveal","style":{"spacing":{"blockGap":"var:preset|spacing|60"}}} -->
		<div class="wp-block-column is-vertically-aligned-center unhurried-reveal" style="flex-basis:60%">
			<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
			<p class="is-style-eyebrow"><?php esc_html_e( 'Lorem enim', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:heading {"fontSize":"huge","style":{"typography":{"lineHeight":"0.92","letterSpacing":"-0.04em"}}} -->
			<h2 class="wp-block-heading has-huge-font-size" style="letter-spacing:-0.04em;line-height:0.92"><?php echo wp_kses( __( 'Lorem aliqua sit quis <em>nisi</em>', 'unhurried' ), array( 'em' => array() ) ); ?></h2>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"fontSize":"large","style":{"typography":{"lineHeight":"1.45"}}} -->
			<p class="has-large-font-size" style="line-height:1.45"><?php esc_html_e( 'Lorem eu eu, duis aute ac veniam id pharetra. Sit esse sed ut sint do ut sunt. Similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
