<?php
/**
 * Title: Questions and answers
 * Slug: unhurried/faq
 * Categories: text, featured
 * Keywords: faq, questions, answers, accordion
 * Viewport width: 1400
 * Description: A heading column beside an accordion of questions and answers.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.0.0
 */

$unhurried_faqs = array(
	array( __( 'Lorem laboris ut et velit vitae?', 'unhurried' ), __( 'Lorem justo eget, ex diam magna sed ea nunc in sem arcu. Odio non diam id lorem. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores. Similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 'unhurried' ) ),
	array( __( 'Lorem est morbi veniam Ut amet?', 'unhurried' ), __( 'Lorem nisl eu dui ac aliquip cillum. Commodo proident id netus. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.', 'unhurried' ) ),
	array( __( 'Lorem Ut fugiat do mollit?', 'unhurried' ), __( 'Lorem. Amet ut 48 fames sit lacus et ad sed. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam.', 'unhurried' ) ),
	array( __( 'Lorem non elit deserunt?', 'unhurried' ), __( 'Lorem velit nulla in mauris id qui curabitur, est officia ut lorem sed. Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae. At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium.', 'unhurried' ) ),
);
?>
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr_x( 'FAQ', 'Pattern block name', 'unhurried' ); ?>"},"align":"full","backgroundColor":"base-2","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"1360px"}} -->
<div class="wp-block-group alignfull has-base-2-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
	<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|80"}}}} -->
	<div class="wp-block-columns">
		<!-- wp:column {"width":"38%","style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
		<div class="wp-block-column" style="flex-basis:38%">
			<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
			<p class="is-style-eyebrow"><?php esc_html_e( 'Lorem eu quis', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:heading {"fontSize":"xx-large"} -->
			<h2 class="wp-block-heading has-xx-large-font-size"><?php echo wp_kses( __( 'Dignissim, <em>pulvinar</em>', 'unhurried' ), array( 'em' => array() ) ); ?></h2>
			<!-- /wp:heading -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"width":"62%","style":{"spacing":{"blockGap":"0"}}} -->
		<div class="wp-block-column" style="flex-basis:62%">
			<?php foreach ( $unhurried_faqs as $unhurried_faq ) : ?>
			<!-- wp:details -->
			<details class="wp-block-details"><summary><?php echo esc_html( $unhurried_faq[0] ); ?></summary>
				<!-- wp:paragraph {"textColor":"contrast-2","style":{"spacing":{"margin":{"top":"1rem"}}}} -->
				<p class="has-contrast-2-color has-text-color" style="margin-top:1rem"><?php echo esc_html( $unhurried_faq[1] ); ?></p>
				<!-- /wp:paragraph -->
			</details>
			<!-- /wp:details -->
			<?php endforeach; ?>
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
