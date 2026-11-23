<?php
/**
 * Title: Services index rows
 * Slug: unhurried/service-rows
 * Categories: services, featured
 * Keywords: services, menu, price list, index
 * Viewport width: 1400
 * Description: An editorial index of services: thumbnail, name, short note, duration and price in hairline rows.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.0.0
 */

$unhurried_rows = array(
	array( 'autumn-still-life', __( 'Cupidatat officia', 'unhurried' ), __( 'Lorem qui, esse dolor, mauris laborum. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam.', 'unhurried' ), __( '90 lorem', 'unhurried' ), __( 'Lorem $180', 'unhurried' ) ),
	array( 'pink-vase', __( 'Lorem magna turpis', 'unhurried' ), __( 'Lorem mattis sem anim deserunt. Donec ullamcorper nulla non metus auctor fringilla, vestibulum id ligula porta felis euismod semper. Aenean lacinia bibendum nulla sed consectetur.', 'unhurried' ), __( '45 lorem', 'unhurried' ), __( 'Lorem $140', 'unhurried' ) ),
	array( 'vase-niche', __( 'Lorem irure', 'unhurried' ), __( 'Lorem eget velit nulla ex vel ea diam est. Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae. At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium.', 'unhurried' ), __( '30 lorem', 'unhurried' ), __( 'Lorem', 'unhurried' ) ),
	array( 'flower-vase', __( 'Lorem sem sit', 'unhurried' ), __( 'Lorem sed, arcu in odio. Cras mattis consectetur purus sit amet fermentum, etiam porta sem malesuada magna mollis euismod. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.', 'unhurried' ), __( '4 lorem', 'unhurried' ), __( 'Lorem $620', 'unhurried' ) ),
);
?>
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr_x( 'Services index', 'Pattern block name', 'unhurried' ); ?>"},"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"},"blockGap":"var:preset|spacing|70"}},"layout":{"type":"constrained","contentSize":"1360px"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
	<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
	<div class="wp-block-group">
		<!-- wp:heading {"fontSize":"xx-large"} -->
		<h2 class="wp-block-heading has-xx-large-font-size"><?php echo wp_kses( __( 'Lorem <em>amet</em>', 'unhurried' ), array( 'em' => array() ) ); ?></h2>
		<!-- /wp:heading -->
		<!-- wp:paragraph {"textColor":"contrast-2","style":{"layout":{"selfStretch":"fixed","flexSize":"min(100%, 36ch)"}}} -->
		<p class="has-contrast-2-color has-text-color"><?php esc_html_e( 'Lorem sodales qui, nisl id dolore est ut amet eu sed elit. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet.', 'unhurried' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
	<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
	<div class="wp-block-group">
		<?php foreach ( $unhurried_rows as $unhurried_row ) : ?>
		<!-- wp:columns {"verticalAlignment":"center","isStackedOnMobile":false,"className":"unhurried-row unhurried-reveal","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"},"blockGap":{"left":"var:preset|spacing|50"}}}} -->
		<div class="wp-block-columns are-vertically-aligned-center is-not-stacked-on-mobile unhurried-row unhurried-reveal" style="padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40)">
			<!-- wp:column {"verticalAlignment":"center","width":"72px","className":"unhurried-mono"} -->
			<div class="wp-block-column is-vertically-aligned-center unhurried-mono" style="flex-basis:72px">
				<!-- wp:image {"width":"72px","aspectRatio":"1","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"12px"}}} -->
				<figure class="wp-block-image size-full is-resized has-custom-border"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/' . $unhurried_row[0] . '.webp' ) ); ?>" alt="" style="border-radius:12px;aspect-ratio:1;object-fit:cover;width:72px"/></figure>
				<!-- /wp:image -->
			</div>
			<!-- /wp:column -->
			<!-- wp:column {"verticalAlignment":"center","style":{"spacing":{"blockGap":"0.25rem"}}} -->
			<div class="wp-block-column is-vertically-aligned-center">
				<!-- wp:heading {"level":3,"fontSize":"large"} -->
				<h3 class="wp-block-heading has-large-font-size"><?php echo esc_html( $unhurried_row[1] ); ?></h3>
				<!-- /wp:heading -->
				<!-- wp:paragraph {"textColor":"contrast-2","fontSize":"small"} -->
				<p class="has-contrast-2-color has-text-color has-small-font-size"><?php echo esc_html( $unhurried_row[2] ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:column -->
			<!-- wp:column {"verticalAlignment":"center","width":"20%","style":{"spacing":{"blockGap":"0.25rem"}}} -->
			<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:20%">
				<!-- wp:paragraph {"align":"right","textColor":"contrast-2","fontSize":"x-small"} -->
				<p class="has-text-align-right has-contrast-2-color has-text-color has-x-small-font-size"><?php echo esc_html( $unhurried_row[3] ); ?></p>
				<!-- /wp:paragraph -->
				<!-- wp:paragraph {"align":"right","fontFamily":"display","style":{"typography":{"fontWeight":"500"}}} -->
				<p class="has-text-align-right has-display-font-family" style="font-weight:500"><?php echo esc_html( $unhurried_row[4] ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:column -->
		</div>
		<!-- /wp:columns -->
		<?php endforeach; ?>
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
