<?php
/**
 * The template for displaying Woo Products Showcase
 *
 * @package Business Commerce Lite
 */

if ( ! class_exists( 'WooCommerce' ) ) {
    // Bail if WooCommerce is not installed
    return;
}

$business_commerce_visibility = business_commerce_gtm( 'business_commerce_products_listing_visibility' );

if ( ! business_commerce_display_section( $business_commerce_visibility ) ) {
	return;
}

if ( 'custom-pages' === $business_commerce_visibility ) {
	// Bail if custom pages is selected, and current page is not in list.
	if (  ! in_array( get_the_ID(), explode( ',', business_commerce_gtm( 'business_commerce_products_listing_custom_pages' ) ) ) ) {
		return;
	}
}

$business_commerce_carousel = business_commerce_gtm( 'business_commerce_products_listing_enable_slider' );
?>
<div id="products-listing-section" class="section products-listing-section<?php echo $business_commerce_carousel ? ' carousel-enabled' : ''; ?>">
	<div class="section-listings">
		<div class="container">
			<div class="section-title-wrapper">
				<?php business_commerce_section_title( 'products_listing' ); ?>
				
				<?php
				$business_commerce_button_text   = business_commerce_gtm( 'business_commerce_products_listing_button_text' );
				$business_commerce_button_link   = business_commerce_gtm( 'business_commerce_products_listing_button_link' );
				$business_commerce_button_target = business_commerce_gtm( 'business_commerce_products_listing_button_target' ) ? '_blank' : '_self';

				if ( $business_commerce_button_text ) : ?>
					<div class="cat-more-wrapper">
						<a href="<?php echo esc_url( $business_commerce_button_link ); ?>" class="more-link" target="<?php echo esc_attr( $business_commerce_button_target ); ?>"><?php echo esc_html( $business_commerce_button_text ); ?></a>
					</div><!-- .more-wrapper -->
				<?php endif; ?>
			</div> <!-- .section-title-wrapper -->
			
			<?php 
				$number                  = business_commerce_gtm( 'business_commerce_products_listing_number' );
				$columns                 = business_commerce_gtm( 'business_commerce_products_listing_columns' );
				$paginate                = business_commerce_gtm( 'business_commerce_products_listing_paginate' );
				$business_commerce_orderby = isset( $_GET['orderby'] ) ? $_GET['orderby'] : business_commerce_gtm( 'business_commerce_products_listing_orderby' );
				$product_filter          = business_commerce_gtm( 'business_commerce_products_listing_products_filter' );
				$featured                = business_commerce_gtm( 'business_commerce_products_listing_featured' );
				$abletone_order          = business_commerce_gtm( 'business_commerce_products_listing_order' );
				$skus                    = business_commerce_gtm( 'business_commerce_products_listing_skus' );
				$category                = business_commerce_gtm( 'business_commerce_products_listing_category' );

				$shortcode = '[products';

				if ( $number ) {
					$shortcode .= ' limit="' . esc_attr( $number ) . '"';
				}

				if ( $columns ) {
					$shortcode .= ' columns="' . absint( $columns ) . '"';
				}

				if ( $paginate ) {
					$shortcode .= ' paginate="' . esc_attr( $paginate ) . '"';
				}

				if ( $business_commerce_orderby ) {
					$shortcode .= ' orderby="' . esc_attr( $business_commerce_orderby ) . '"';
				}

				if ( $abletone_order ) {
					$shortcode .= ' order="' . esc_attr( $abletone_order ) . '"';
				}

				if ( $product_filter && 'none' !== $product_filter ) {
					$shortcode .= ' ' . esc_attr( $product_filter ) . '="true"';
				}

				if ( $skus ) {
					$shortcode .= ' skus="' . esc_attr( $skus ) . '"';
				}

				if ( $category ) {
					$shortcode .= ' category="' . esc_attr( $category ) . '"';
				}

				if ( $featured ) {
					$shortcode .= ' visibility="featured"';
				}

				$shortcode .= ']';
			?>

			<div class="products-listing-block-list clear-fix<?php echo $business_commerce_carousel ? ' swiper-carousel-enabled normal-carousel' : ''; ?>">
				<div class="products-wrapper">
					<?php echo do_shortcode( $shortcode ); ?>
				</div><!-- .products-wrapper -->

				<?php
				// Navigation.
				if ( $business_commerce_carousel && business_commerce_gtm( 'business_commerce_products_listing_slider_navigation' ) ) : ?>
				<div class="next-prev-wrap">
					<div class="swiper-button-prev"></div>
				    <div class="swiper-button-next"></div>
				</div>
				<?php endif; ?>

				<?php
				// Pagination.
				if ( $business_commerce_carousel && business_commerce_gtm( 'business_commerce_products_listing_slider_pagination' ) ) : ?>
			    <div class="swiper-pagination"></div>
				<?php endif; ?>
			</div><!-- .products-listing-block-list -->
		</div><!-- .container -->
	</div><!-- .section-listings -->
</div><!-- .products-listing-section -->
