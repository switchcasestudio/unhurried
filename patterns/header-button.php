<?php
/**
 * Title: Header button
 * Slug: unhurried/header-button
 * Inserter: no
 *
 * Shown only when the site has a published Contact page: the page with the
 * slug "contact" or, on a site in another language, the one the setup
 * checklist made (see unhurried_find_page()). Labeled with that page's own
 * title. Blogs and one-page sites have nothing to book, and before 1.1.2
 * they showed "Book a visit" linked to "#".
 *
 * @package Unhurried
 * @author  Switch Case Studio
 * @since 1.0.0
 */

$unhurried_contact_url = unhurried_page_link( 'contact', '' );
if ( ! $unhurried_contact_url ) {
	return;
}
$unhurried_contact_page  = unhurried_find_page( 'contact' );
$unhurried_contact_label = $unhurried_contact_page ? trim( wp_strip_all_tags( get_the_title( $unhurried_contact_page ) ) ) : '';
if ( '' === $unhurried_contact_label ) {
	$unhurried_contact_label = __( 'Contact', 'unhurried' );
}
?>
<!-- wp:buttons {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-buttons">
	<!-- wp:button -->
	<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $unhurried_contact_url ); ?>"><?php echo esc_html( $unhurried_contact_label ); ?></a></div>
	<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
