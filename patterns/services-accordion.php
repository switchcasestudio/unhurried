<?php
/**
 * Title: Services on image, accordion
 * Slug: unhurried/services-accordion
 * Categories: featured, services
 * Keywords: services, treatments, menu, accordion, cover
 * Viewport width: 1400
 * Description: A full-bleed monochrome image with a headline and a frosted-glass accordion of services.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.0.0
 */

$unhurried_services = array(
	array( __( 'Curabitur integer', 'unhurried' ), __( 'Lorem iaculis, enim sem non eu quis vel pulvinar ac est. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.', 'unhurried' ) ),
	array( __( 'Lorem vitae', 'unhurried' ), __( 'Lorem nisi velit vitae ut duis egestas aute dui justo esse sint do. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam.', 'unhurried' ) ),
	array( __( 'Lorem magna veniam', 'unhurried' ), __( 'Lorem cillum sit anim habitant ut fugiat et nunc eget. Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae. At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium.', 'unhurried' ) ),
	array( __( 'Lorem sit sed', 'unhurried' ), __( 'Lorem mauris diam non qui incididunt, est sed sem egestas non nunc. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet.', 'unhurried' ) ),
);

// Tags the translated heading may hold.
$unhurried_heading_tags = array(
	'em' => array(),
	'br' => array(),
);
?>
<!-- wp:cover {"url":"<?php echo esc_url( get_theme_file_uri( 'assets/images/desert-dune.webp' ) ); ?>","dimRatio":50,"overlayColor":"contrast","minHeight":860,"minHeightUnit":"px","isDark":true,"metadata":{"name":"<?php echo esc_attr_x( 'Services', 'Pattern block name', 'unhurried' ); ?>"},"align":"full","className":"unhurried-mono","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"1360px"}} -->
<div class="wp-block-cover alignfull is-dark unhurried-mono" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80);min-height:860px"><img class="wp-block-cover__image-background" alt="" src="<?php echo esc_url( get_theme_file_uri( 'assets/images/desert-dune.webp' ) ); ?>" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-contrast-background-color has-background-dim"></span><div class="wp-block-cover__inner-container">
	<!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|70","left":"var:preset|spacing|80"}}}} -->
	<div class="wp-block-columns are-vertically-aligned-center">
		<!-- wp:column {"verticalAlignment":"center","width":"45%","style":{"spacing":{"blockGap":"var:preset|spacing|50"}}} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:45%">
			<!-- wp:paragraph {"className":"is-style-eyebrow","textColor":"base"} -->
			<p class="is-style-eyebrow has-base-color has-text-color"><?php esc_html_e( 'Eiusmod', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:heading {"textColor":"base","fontSize":"xx-large"} -->
			<h2 class="wp-block-heading has-base-color has-text-color has-xx-large-font-size"><?php echo wp_kses( __( 'Nostrud vel<br>est <em>lorem</em> arcu', 'unhurried' ), $unhurried_heading_tags ); ?></h2>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"textColor":"base","fontSize":"large","style":{"typography":{"lineHeight":"1.45"}}} -->
			<p class="has-base-color has-text-color has-large-font-size" style="line-height:1.45"><?php esc_html_e( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua, ut enim ad minim veniam.', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:buttons -->
			<div class="wp-block-buttons">
				<!-- wp:button {"className":"is-style-hairline"} -->
				<div class="wp-block-button is-style-hairline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( unhurried_page_link( 'services' ) ); ?>"><?php esc_html_e( 'Our services', 'unhurried' ); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"verticalAlignment":"center","width":"55%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:55%">
			<!-- wp:group {"className":"is-style-glass unhurried-reveal","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|60","right":"var:preset|spacing|60"},"blockGap":"0"}},"layout":{"type":"default"}} -->
			<div class="wp-block-group is-style-glass unhurried-reveal" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--60)">
				<?php foreach ( $unhurried_services as $unhurried_i => $unhurried_service ) : ?>
				<!-- wp:details {"showContent":<?php echo 0 === $unhurried_i ? 'true' : 'false'; ?>} -->
				<details class="wp-block-details"<?php echo 0 === $unhurried_i ? ' open' : ''; ?>><summary><?php echo esc_html( $unhurried_service[0] ); ?></summary>
					<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"1rem"}}}} -->
					<p style="margin-top:1rem"><?php echo esc_html( $unhurried_service[1] ); ?></p>
					<!-- /wp:paragraph -->
				</details>
				<!-- /wp:details -->
				<?php endforeach; ?>
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div></div>
<!-- /wp:cover -->
