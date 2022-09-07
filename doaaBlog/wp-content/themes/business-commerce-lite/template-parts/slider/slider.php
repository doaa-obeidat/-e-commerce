<?php
/**
 * Template part for displaying Slider
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Business Commerce Lite
 */

$business_commerce_visibility = business_commerce_gtm( 'business_commerce_slider_visibility' );

if ( ! business_commerce_display_section( $business_commerce_visibility ) ) {
	return;
}

$slider_class = 'ff-grid-12';

if( is_active_sidebar( 'sidebar-slider-left' ) ) {
	$slider_class = 'ff-grid-8';
}

?>
<div id="slider-section" class="section style-full-width slider-section overlay-enabled  no-padding style-one">
	<div class="container">
		<div class="row">
			<?php if( is_active_sidebar( 'sidebar-slider-left' ) ) : ?>
				<div class="ff-grid-4 slider-left-widgetarea">
					<?php dynamic_sidebar( 'sidebar-slider-left' ); ?>
				</div><!-- .ff-grid-3 -->
			<?php endif; ?>

			<div class="<?php echo esc_attr( $slider_class ); ?>">
				<div class="slider slider-section-wrapper">
					<div class="swiper-wrapper">
						<?php get_template_part( 'template-parts/slider/post', 'type' ); ?>
					</div><!-- .swiper-wrapper -->

					<div class="swiper-pagination"></div>

				    <div class="swiper-button-prev"></div>
				    <div class="swiper-button-next"></div>
				</div><!-- .slider -->
			</div><!-- .ff-grid-12 -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</div> <!-- .slider-section
 -->
