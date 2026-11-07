<?php
/**
 * Title: Header button
 * Slug: unhurried/header-button
 * Inserter: no
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.0.0
 */

?>
<!-- wp:buttons {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-buttons">
	<!-- wp:button -->
	<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( unhurried_page_link( 'contact' ) ); ?>"><?php esc_html_e( 'Book a visit', 'unhurried' ); ?></a></div>
	<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
