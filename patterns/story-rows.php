<?php
/**
 * Title: Story rows
 * Slug: unhurried/story-rows
 * Categories: featured, about
 * Keywords: story, rows, alternating, image, text, about, features
 * Viewport width: 1400
 * Description: Three rows that alternate image and text: an eyebrow, a short heading with an accent word, a paragraph and a text link. The image stays above the text on phones.
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.1.0
 */

$unhurried_rows = array(
	array( 'light-window', __( 'Lorem nisi', 'unhurried' ), __( 'Lorem sodales, <em>duis</em> ipsum', 'unhurried' ), __( 'Lorem fermentum aute esse in mollit sint sem mauris. Id sunt ut anim, dolor sit magna minim sit sed turpis eu nunc irure. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus.', 'unhurried' ), __( 'Contact us', 'unhurried' ), 'contact' ),
	array( 'vessel', __( 'Lorem est', 'unhurried' ), __( 'Lorem sed mattis <em>volutpat</em>', 'unhurried' ), __( 'Lorem nulla ornare nunc sem integer non ac vel id phasellus arcu. Tempor ut culpa do vitae iaculis ut. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet.', 'unhurried' ), __( 'Our services', 'unhurried' ), 'services' ),
	array( 'pedestal', __( 'Lorem velit', 'unhurried' ), __( 'Lorem et <em>sit</em> tristique', 'unhurried' ), __( 'Lorem vitae justo ex sit diam: sed non amet qui nisl, ea dolore, in est id sed sem. Egestas ut magna non amet elit. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores.', 'unhurried' ), __( 'Contact us', 'unhurried' ), 'contact' ),
);
?>
<!-- wp:group {"metadata":{"name":"<?php echo esc_attr_x( 'Story rows', 'Pattern block name', 'unhurried' ); ?>"},"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"},"blockGap":"var:preset|spacing|80"}},"layout":{"type":"constrained","contentSize":"1360px"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
	<?php foreach ( $unhurried_rows as $unhurried_i => $unhurried_row ) : ?>
		<?php $unhurried_flipped = 1 === $unhurried_i % 2; ?>
	<!-- wp:columns {"verticalAlignment":"center","className":"unhurried-story<?php echo $unhurried_flipped ? ' is-flipped' : ''; ?>","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|80"}}}} -->
	<div class="wp-block-columns are-vertically-aligned-center unhurried-story<?php echo $unhurried_flipped ? ' is-flipped' : ''; ?>">
		<?php if ( ! $unhurried_flipped ) : ?>
		<!-- wp:column {"verticalAlignment":"center","width":"48%","className":"unhurried-mono unhurried-reveal"} -->
		<div class="wp-block-column is-vertically-aligned-center unhurried-mono unhurried-reveal" style="flex-basis:48%">
			<!-- wp:image {"aspectRatio":"4/3","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"24px"}}} -->
			<figure class="wp-block-image size-full has-custom-border"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/' . $unhurried_row[0] . '.webp' ) ); ?>" alt="" style="border-radius:24px;aspect-ratio:4/3;object-fit:cover"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->
		<?php endif; ?>
		<!-- wp:column {"verticalAlignment":"center","width":"52%","className":"unhurried-reveal","style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
		<div class="wp-block-column is-vertically-aligned-center unhurried-reveal" style="flex-basis:52%">
			<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
			<p class="is-style-eyebrow"><?php echo esc_html( $unhurried_row[1] ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:heading {"level":3,"fontSize":"x-large"} -->
			<h3 class="wp-block-heading has-x-large-font-size"><?php echo wp_kses( $unhurried_row[2], array( 'em' => array() ) ); ?></h3>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"textColor":"contrast-2","style":{"layout":{"selfStretch":"fixed","flexSize":"min(100%, 44ch)"}}} -->
			<p class="has-contrast-2-color has-text-color"><?php echo esc_html( $unhurried_row[3] ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:buttons -->
			<div class="wp-block-buttons">
				<!-- wp:button {"className":"is-style-text-link"} -->
				<div class="wp-block-button is-style-text-link"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( unhurried_page_link( $unhurried_row[5] ) ); ?>"><?php echo esc_html( $unhurried_row[4] ); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->
		<?php if ( $unhurried_flipped ) : ?>
		<!-- wp:column {"verticalAlignment":"center","width":"48%","className":"unhurried-mono unhurried-reveal"} -->
		<div class="wp-block-column is-vertically-aligned-center unhurried-mono unhurried-reveal" style="flex-basis:48%">
			<!-- wp:image {"aspectRatio":"4/3","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"24px"}}} -->
			<figure class="wp-block-image size-full has-custom-border"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/' . $unhurried_row[0] . '.webp' ) ); ?>" alt="" style="border-radius:24px;aspect-ratio:4/3;object-fit:cover"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->
		<?php endif; ?>
	</div>
	<!-- /wp:columns -->
	<?php endforeach; ?>
</div>
<!-- /wp:group -->
