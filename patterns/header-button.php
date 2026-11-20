<?php
/**
 * Title: Header button
 * Slug: unhurried/header-button
 * Inserter: no
 *
 * Shown only when a published page with the slug "contact" exists, labeled
 * with that page's own title. Blogs and one-page sites have nothing to book,
 * and before 1.1.2 they showed "Book a visit" linked to "#".
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.0.0
 */

$unhurried_contact_page = get_page_by_path( 'contact' );
if ( ! $unhurried_contact_page || 'publish' !== $unhurried_contact_page->post_status ) {
	return;
}
$unhurried_contact_label = trim( wp_strip_all_tags( get_the_title( $unhurried_contact_page ) ) );
if ( '' === $unhurried_contact_label ) {
	$unhurried_contact_label = __( 'Contact', 'unhurried' );
}
?>
<!-- wp:buttons {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-buttons">
	<!-- wp:button -->
	<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( get_permalink( $unhurried_contact_page ) ); ?>"><?php echo esc_html( $unhurried_contact_label ); ?></a></div>
	<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
