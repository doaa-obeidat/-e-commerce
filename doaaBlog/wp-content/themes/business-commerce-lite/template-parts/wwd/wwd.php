<?php
/**
 * Template part for displaying Service
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Business Commerce Lite
 */

$business_commerce_visibility = business_commerce_gtm( 'business_commerce_wwd_visibility' );

if ( ! business_commerce_display_section( $business_commerce_visibility ) ) {
	return;
}
?>
<div id="wwd-section" class="wwd-section page style-one section">
	<div class="section-wwd">
		<div class="container">
			<?php business_commerce_section_title( 'wwd' ); ?>
			
			<div class="section-carousel-wrapper">
				<?php
				get_template_part( 'template-parts/wwd/post-type' );
				?>
			</div>
		</div><!-- .container -->
	</div><!-- .section-wwd  -->
</div><!-- .section -->
