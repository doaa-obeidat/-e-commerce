<?php
/**
 * Template part for displaying Hero Content
 *
 * @package Business Commerce Lite
 */

$business_commerce_visibility = business_commerce_gtm( 'business_commerce_promotional_headline_visibility' );

if ( ! business_commerce_display_section( $business_commerce_visibility ) ) {
	return;
}

get_template_part( 'template-parts/promotional-headline/post-type' );
