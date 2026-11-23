<?php
/**
 * Title: Footer with wordmark
 * Slug: unhurried/footer
 * Categories: footer
 * Block Types: core/template-part/footer
 * Viewport width: 1400
 * Description: An Ink footer: the site tagline, a search box, a newsletter row and social icons; the Explore navigation, your topics and latest posts; the giant capitalized wordmark, which rolls letter by letter on hover; and a hairline with the year, a back-to-top link and the credit. Add your social profile addresses; icons without an address stay hidden from visitors.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.0.0
 */

/*
 * Since 1.1.2 the footer carries no sample copy, and since 1.2.0 every column
 * shows the site's own content (menu, categories, latest posts, search): the lead line is the site
 * tagline (Settings > General) and the address column lives in the
 * "Footer with visit details" pattern. Many sites never edit the footer, so
 * whatever is printed here goes live as it stands.
 */
$unhurried_has_tagline = '' !== trim( (string) get_bloginfo( 'description' ) );
// Journal columns only once there is something to list.
$unhurried_post_count = (int) wp_count_posts( 'post' )->publish;
$unhurried_search     = serialize_block_attributes(
	array(
		'label'          => __( 'Search', 'unhurried' ),
		'showLabel'      => false,
		'placeholder'    => __( 'Search the site', 'unhurried' ),
		'buttonText'     => __( 'Search', 'unhurried' ),
		'buttonPosition' => 'button-inside',
		'buttonUseIcon'  => true,
		'className'      => 'unhurried-footer-search',
	)
);
// Newsletter: a plugin's signup form (see unhurried_newsletter_form()), or the RSS feed.
$unhurried_newsletter = unhurried_newsletter_form();

/*
 * Social profiles. They ship as "#" placeholders, which
 * unhurried_hide_placeholder_social() keeps out of the public footer until
 * each one gets a real address in the editor.
 */
$unhurried_social = array(
	'google'    => __( 'Google Business Profile', 'unhurried' ),
	'instagram' => __( 'Instagram', 'unhurried' ),
	'facebook'  => __( 'Facebook', 'unhurried' ),
	'x'         => __( 'X', 'unhurried' ),
	'pinterest' => __( 'Pinterest', 'unhurried' ),
	'tiktok'    => __( 'TikTok', 'unhurried' ),
	'youtube'   => __( 'YouTube', 'unhurried' ),
	'linkedin'  => __( 'LinkedIn', 'unhurried' ),
	'yelp'      => __( 'Yelp', 'unhurried' ),
);
?>
<!-- wp:group {"className":"is-style-section-ink unhurried-footer","style":{"spacing":{"padding":{"top":"var:preset|spacing|90","bottom":"var:preset|spacing|60"},"blockGap":"var:preset|spacing|80","margin":{"top":"0"}}},"layout":{"type":"constrained","contentSize":"1360px"}} -->
<div class="wp-block-group is-style-section-ink unhurried-footer" style="margin-top:0;padding-top:var(--wp--preset--spacing--90);padding-bottom:var(--wp--preset--spacing--60)">
	<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|70","left":"var:preset|spacing|70"}}}} -->
	<div class="wp-block-columns">
		<!-- wp:column {"width":"36%","style":{"spacing":{"blockGap":"var:preset|spacing|60"}}} -->
		<div class="wp-block-column" style="flex-basis:36%">
			<?php if ( $unhurried_has_tagline ) : ?>
			<!-- wp:site-tagline {"className":"unhurried-footer-lead","fontSize":"x-large","fontFamily":"display","style":{"typography":{"fontWeight":"500","lineHeight":"1.05","letterSpacing":"-0.03em"}}} /-->
			<?php endif; ?>
			<!-- wp:search <?php echo $unhurried_search; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- serialize_block_attributes() escapes it for a block comment. ?> /-->
			<!-- wp:group {"className":"unhurried-footer-newsletter","style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"default"}} -->
			<div class="wp-block-group unhurried-footer-newsletter">
				<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
				<p class="is-style-eyebrow"><?php esc_html_e( 'Newsletter', 'unhurried' ); ?></p>
				<!-- /wp:paragraph -->
				<?php if ( '' !== $unhurried_newsletter ) : ?>
				<!-- wp:paragraph {"fontSize":"small"} -->
				<p class="has-small-font-size"><?php esc_html_e( 'New posts by email, now and then.', 'unhurried' ); ?></p>
				<!-- /wp:paragraph -->
					<?php echo $unhurried_newsletter; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Block markup from unhurried_newsletter_form(), parsed and rendered by WordPress. ?>
				<?php else : ?>
				<!-- wp:paragraph {"fontSize":"small"} -->
				<p class="has-small-font-size"><?php esc_html_e( 'Follow new posts in your feed reader.', 'unhurried' ); ?></p>
				<!-- /wp:paragraph -->
				<!-- wp:buttons -->
				<div class="wp-block-buttons">
					<!-- wp:button {"className":"is-style-hairline unhurried-footer-newsletter__rss"} -->
					<div class="wp-block-button is-style-hairline unhurried-footer-newsletter__rss"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( get_feed_link() ); ?>"><?php esc_html_e( 'Subscribe by RSS', 'unhurried' ); ?></a></div>
					<!-- /wp:button -->
				</div>
				<!-- /wp:buttons -->
				<?php endif; ?>
			</div>
			<!-- /wp:group -->
			<!-- wp:social-links {"className":"is-style-logos-only unhurried-footer-social","style":{"spacing":{"blockGap":{"left":"0.5rem","top":"0.5rem"}}}} -->
			<ul class="wp-block-social-links is-style-logos-only unhurried-footer-social">
			<?php
			foreach ( $unhurried_social as $unhurried_service => $unhurried_label ) :
				$unhurried_link = array(
					'url'     => '#',
					'service' => $unhurried_service,
					'label'   => $unhurried_label,
				);
				?>
				<!-- wp:social-link <?php echo serialize_block_attributes( $unhurried_link ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- serialize_block_attributes() escapes it for a block comment. ?> /-->
			<?php endforeach; ?>
			</ul>
			<!-- /wp:social-links -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
		<div class="wp-block-column">
			<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
			<p class="is-style-eyebrow"><?php esc_html_e( 'Explore', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:navigation {"overlayMenu":"never","showSubmenuIcon":false,"className":"unhurried-nav-plain","layout":{"type":"flex","orientation":"vertical"},"style":{"spacing":{"blockGap":"0.25rem"}}} /-->
		</div>
		<!-- /wp:column -->
		<?php if ( $unhurried_post_count > 0 ) : ?>
		<!-- wp:column {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
		<div class="wp-block-column">
			<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
			<p class="is-style-eyebrow"><?php esc_html_e( 'Topics', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:categories {"showPostCounts":true,"className":"unhurried-footer-list"} /-->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
		<div class="wp-block-column">
			<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
			<p class="is-style-eyebrow"><?php esc_html_e( 'Latest', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:latest-posts {"postsToShow":3,"displayPostDate":true,"className":"unhurried-footer-list"} /-->
		</div>
		<!-- /wp:column -->
		<?php endif; ?>
	</div>
	<!-- /wp:columns -->
	<!-- wp:site-title {"level":0,"className":"unhurried-wordmark","style":{"typography":{"fontSize":"clamp(3.5rem, 15vw, 17rem)","fontWeight":"500"}}} /-->
	<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40"},"blockGap":"var:preset|spacing|60"},"border":{"top":{"color":"#f6f4ef2e","width":"1px","style":"solid"}}},"fontSize":"x-small","layout":{"type":"flex","justifyContent":"space-between","flexWrap":"wrap"}} -->
	<div class="wp-block-group has-x-small-font-size" style="border-top-color:#f6f4ef2e;border-top-style:solid;border-top-width:1px;padding-top:var(--wp--preset--spacing--40)">
		<!-- wp:paragraph -->
		<p>
		<?php
		printf(
			/* translators: 1: Current year. 2: Site name. */
			esc_html__( '© %1$s %2$s', 'unhurried' ),
			esc_html( wp_date( 'Y' ) ),
			esc_html( get_bloginfo( 'name' ) )
		);
		?>
		</p>
		<!-- /wp:paragraph -->
		<!-- wp:paragraph -->
		<p><a href="#top"><?php esc_html_e( 'Back to top ↑', 'unhurried' ); ?></a></p>
		<!-- /wp:paragraph -->
		<!-- wp:paragraph -->
		<p>
		<?php
		printf(
			/* translators: %s: Theme author link. */
			esc_html__( 'Designed by %s', 'unhurried' ),
			'<a href="' . esc_url( 'https://switchcasestudio.com' ) . '">Switch Case Studio</a>'
		);
		?>
		</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
