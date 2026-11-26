<?php
/**
 * Title: Policy page
 * Slug: unhurried/page-policy
 * Categories: unhurried_page
 * Keywords: policy, privacy, terms, returns, refunds, legal, contents
 * Block Types: core/post-content
 * Post Types: page
 * Viewport width: 1400
 * Description: A plain page for a policy: the date it was last updated, a short introduction, a contents list beside six numbered sections, and a closing line that links to Contact. Use it for your Privacy, Terms and Returns pages with the default Pages template. Published at /privacy/ (or chosen in Settings > Privacy), /terms/ and /returns/, each one gets a link in the footer. The words are placeholders: put your own policy in their place.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.2.1
 */

// Six sections: an anchor for the contents list, a heading with one accent word, then paragraphs or a short list.
$unhurried_sections = array(
	array(
		'heading' => __( 'Lorem ipsum <em>dolor</em>', 'unhurried' ),
		'text'    => array(
			__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'unhurried' ),
			__( 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'unhurried' ),
		),
		'list'    => array(),
	),
	array(
		'heading' => __( 'Sit amet <em>consectetur</em>', 'unhurried' ),
		'text'    => array(
			__( 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.', 'unhurried' ),
		),
		'list'    => array(
			__( 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur.', 'unhurried' ),
			__( 'Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.', 'unhurried' ),
			__( 'Ut enim ad minima veniam, quis nostrum exercitationem ullam.', 'unhurried' ),
		),
	),
	array(
		'heading' => __( 'Adipiscing elit, <em>sed</em>', 'unhurried' ),
		'text'    => array(
			__( 'Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur. At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti.', 'unhurried' ),
		),
		'list'    => array(),
	),
	array(
		'heading' => __( 'Eiusmod <em>tempor</em> incididunt', 'unhurried' ),
		'text'    => array(
			__( 'Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus.', 'unhurried' ),
			__( 'Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.', 'unhurried' ),
		),
		'list'    => array(),
	),
	array(
		'heading' => __( 'Ut labore et <em>dolore</em>', 'unhurried' ),
		'text'    => array(
			__( 'Similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.', 'unhurried' ),
		),
		'list'    => array(
			__( 'Lorem cras mattis consectetur purus sit amet fermentum.', 'unhurried' ),
			__( 'Donec sed odio dui, nullam quis risus eget urna mollis ornare.', 'unhurried' ),
			__( 'Maecenas sed diam eget risus varius blandit sit amet non magna.', 'unhurried' ),
		),
	),
	array(
		'heading' => __( 'Magna <em>aliqua</em> ut enim', 'unhurried' ),
		'text'    => array(
			__( 'Aenean eu leo quam, pellentesque ornare sem lacinia quam venenatis vestibulum. Curabitur blandit tempus porttitor, integer posuere erat a ante venenatis dapibus posuere velit aliquet.', 'unhurried' ),
		),
		'list'    => array(),
	),
);
// Tags a translated heading may hold.
$unhurried_heading = array( 'em' => array() );
// The closing line links to the Contact page, and only when there is one (no link that leads nowhere).
$unhurried_contact = unhurried_page_link( 'contact', '' );
?>
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr_x( 'Policy', 'Pattern block name', 'unhurried' ); ?>"},"align":"wide","className":"unhurried-policy","style":{"spacing":{"blockGap":"var:preset|spacing|70"}},"layout":{"type":"default"}} -->
<div class="wp-block-group alignwide unhurried-policy">
	<!-- wp:group {"className":"unhurried-policy__head","style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"default"}} -->
	<div class="wp-block-group unhurried-policy__head">
		<!-- wp:group {"className":"unhurried-policy__updated","style":{"spacing":{"blockGap":"0.75rem"}},"layout":{"type":"flex","flexWrap":"wrap","verticalAlignment":"center"}} -->
		<div class="wp-block-group unhurried-policy__updated">
			<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
			<p class="is-style-eyebrow"><?php esc_html_e( 'Last updated', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:post-date {"className":"unhurried-policy__date is-modified","metadata":{"bindings":{"datetime":{"source":"core/post-data","args":{"field":"modified"}}}}} /-->
			<!-- wp:post-date {"className":"unhurried-policy__date is-published","metadata":{"bindings":{"datetime":{"source":"core/post-data","args":{"field":"date"}}}}} /-->
		</div>
		<!-- /wp:group -->
		<!-- wp:paragraph {"className":"unhurried-policy__intro","textColor":"contrast-2","fontSize":"large","style":{"typography":{"lineHeight":"1.45"}}} -->
		<p class="unhurried-policy__intro has-contrast-2-color has-text-color has-large-font-size" style="line-height:1.45"><?php esc_html_e( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua, ut enim ad minim veniam.', 'unhurried' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
	<!-- wp:columns {"className":"unhurried-policy__columns","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|80"}}}} -->
	<div class="wp-block-columns unhurried-policy__columns">
		<!-- wp:column {"width":"30%","className":"unhurried-policy__aside","style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
		<div class="wp-block-column unhurried-policy__aside" style="flex-basis:30%">
			<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
			<p class="is-style-eyebrow"><?php esc_html_e( 'Contents', 'unhurried' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:list {"ordered":true,"className":"unhurried-policy__toc","fontSize":"small"} -->
			<ol class="wp-block-list unhurried-policy__toc has-small-font-size">
				<?php foreach ( $unhurried_sections as $unhurried_i => $unhurried_section ) : ?>
				<!-- wp:list-item -->
				<li><a href="#policy-<?php echo absint( $unhurried_i + 1 ); ?>"><?php echo esc_html( wp_strip_all_tags( $unhurried_section['heading'] ) ); ?></a></li>
				<!-- /wp:list-item -->
				<?php endforeach; ?>
			</ol>
			<!-- /wp:list -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"width":"70%","className":"unhurried-policy__body","style":{"spacing":{"blockGap":"var:preset|spacing|70"}}} -->
		<div class="wp-block-column unhurried-policy__body" style="flex-basis:70%">
			<?php foreach ( $unhurried_sections as $unhurried_i => $unhurried_section ) : ?>
			<!-- wp:group {"className":"unhurried-policy__section","style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"default"}} -->
			<div class="wp-block-group unhurried-policy__section">
				<!-- wp:heading {"fontSize":"x-large"} -->
				<h2 class="wp-block-heading has-x-large-font-size" id="policy-<?php echo absint( $unhurried_i + 1 ); ?>"><?php echo wp_kses( $unhurried_section['heading'], $unhurried_heading ); ?></h2>
				<!-- /wp:heading -->
				<?php foreach ( $unhurried_section['text'] as $unhurried_text ) : ?>
				<!-- wp:paragraph -->
				<p><?php echo esc_html( $unhurried_text ); ?></p>
				<!-- /wp:paragraph -->
				<?php endforeach; ?>
				<?php if ( $unhurried_section['list'] ) : ?>
				<!-- wp:list -->
				<ul class="wp-block-list">
					<?php foreach ( $unhurried_section['list'] as $unhurried_item ) : ?>
					<!-- wp:list-item -->
					<li><?php echo esc_html( $unhurried_item ); ?></li>
					<!-- /wp:list-item -->
					<?php endforeach; ?>
				</ul>
				<!-- /wp:list -->
				<?php endif; ?>
			</div>
			<!-- /wp:group -->
			<?php endforeach; ?>
			<!-- wp:paragraph {"className":"unhurried-policy__close","textColor":"contrast-2"} -->
			<p class="unhurried-policy__close has-contrast-2-color has-text-color"><?php esc_html_e( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.', 'unhurried' ); ?><?php echo '' !== $unhurried_contact ? ' <a href="' . esc_url( $unhurried_contact ) . '">' . esc_html__( 'Contact', 'unhurried' ) . '</a>' : ''; ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
