<?php
/**
 * Title: Text, essay
 * Slug: unhurried/text-essay
 * Categories: text, featured
 * Keywords: text, essay, long form, editorial, article, story, columns, quote
 * Viewport width: 1400
 * Description: A long-form editorial section: a heading and reading time on the left; a lede with a drop cap, two columns of body text and a pull quote on the right, ending in a link to the journal.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.2.0
 */

$unhurried_posts_page = ( 'page' === get_option( 'show_on_front' ) ) ? (int) get_option( 'page_for_posts' ) : 0;
$unhurried_journal    = $unhurried_posts_page ? get_permalink( $unhurried_posts_page ) : home_url( '/' );
?>
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr_x( 'Essay', 'Pattern block name', 'unhurried' ); ?>"},"align":"full","className":"unhurried-essay","style":{"spacing":{"padding":{"top":"var:preset|spacing|90","bottom":"var:preset|spacing|90"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"base","layout":{"type":"constrained","contentSize":"1360px"}} -->
<div class="wp-block-group alignfull unhurried-essay has-base-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--90);padding-bottom:var(--wp--preset--spacing--90)">
	<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|70","left":"var:preset|spacing|80"}}}} -->
	<div class="wp-block-columns">
		<!-- wp:column {"width":"34%","className":"unhurried-essay__aside","style":{"spacing":{"blockGap":"var:preset|spacing|50"}}} -->
		<div class="wp-block-column unhurried-essay__aside" style="flex-basis:34%">
			<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
			<p class="is-style-eyebrow"><?php esc_html_e( 'Lorem ipsum', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:heading {"fontSize":"xx-large","style":{"typography":{"lineHeight":"0.95","letterSpacing":"-0.03em"}}} -->
			<h2 class="wp-block-heading has-xx-large-font-size" style="letter-spacing:-0.03em;line-height:0.95"><?php echo wp_kses( __( 'Dolor sit amet, <em>consectetur</em>', 'unhurried' ), array( 'em' => array() ) ); ?></h2>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"textColor":"contrast-2","fontSize":"x-small","style":{"typography":{"letterSpacing":"0.04em"}}} -->
			<p class="has-contrast-2-color has-text-color has-x-small-font-size" style="letter-spacing:0.04em"><?php esc_html_e( 'Lorem ipsum · 6 min', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"width":"66%","style":{"spacing":{"blockGap":"var:preset|spacing|60"}}} -->
		<div class="wp-block-column" style="flex-basis:66%">
			<!-- wp:paragraph {"dropCap":true,"fontSize":"large","style":{"typography":{"lineHeight":"1.5"}}} -->
			<p class="has-drop-cap has-large-font-size" style="line-height:1.5"><?php esc_html_e( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|60"}}}} -->
			<div class="wp-block-columns">
				<!-- wp:column {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
				<div class="wp-block-column">
					<!-- wp:paragraph {"textColor":"contrast-2"} -->
					<p class="has-contrast-2-color has-text-color"><?php esc_html_e( 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'unhurried' ); ?></p>
					<!-- /wp:paragraph -->
					<!-- wp:paragraph {"textColor":"contrast-2"} -->
					<p class="has-contrast-2-color has-text-color"><?php esc_html_e( 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.', 'unhurried' ); ?></p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:column -->
				<!-- wp:column {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
				<div class="wp-block-column">
					<!-- wp:paragraph {"textColor":"contrast-2"} -->
					<p class="has-contrast-2-color has-text-color"><?php esc_html_e( 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.', 'unhurried' ); ?></p>
					<!-- /wp:paragraph -->
					<!-- wp:paragraph {"textColor":"contrast-2"} -->
					<p class="has-contrast-2-color has-text-color"><?php esc_html_e( 'Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur. Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse.', 'unhurried' ); ?></p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:column -->
			</div>
			<!-- /wp:columns -->
			<!-- wp:quote {"className":"is-style-plain unhurried-essay__quote"} -->
			<blockquote class="wp-block-quote is-style-plain unhurried-essay__quote"><!-- wp:paragraph {"fontFamily":"accent","fontSize":"x-large","style":{"typography":{"fontStyle":"italic","fontWeight":"400","lineHeight":"1.15"}}} -->
			<p class="has-accent-font-family has-x-large-font-size" style="font-style:italic;font-weight:400;line-height:1.15"><?php esc_html_e( 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum.', 'unhurried' ); ?></p>
			<!-- /wp:paragraph --><cite><?php esc_html_e( 'Lorem Ipsum', 'unhurried' ); ?></cite></blockquote>
			<!-- /wp:quote -->
			<!-- wp:paragraph {"className":"unhurried-text-link"} -->
			<p class="unhurried-text-link"><a href="<?php echo esc_url( $unhurried_journal ); ?>"><?php esc_html_e( 'Read the journal →', 'unhurried' ); ?></a></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
