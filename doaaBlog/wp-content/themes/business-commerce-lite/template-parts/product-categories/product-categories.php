<?php
/**
 * The template for displaying Product Categories
 *
 * @package Business Commerce Lite
 */

if ( ! class_exists( 'WooCommerce' ) ) {
	// Bail if WooCommerce is not installed
	return;
}

$business_commerce_visibility = business_commerce_gtm( 'business_commerce_product_categories_visibility' );

if ( ! business_commerce_display_section( $business_commerce_visibility ) ) {
	return;
}

?>
<div id="product-categories-section" class="section product-categories-section layout-3">
	<div class="section-categoriess">
		<div class="container">
			<div class="section-title-wrapper clear-fix">
				<?php business_commerce_section_title( 'product_categories' ); ?>
				
				<?php
				$business_commerce_button_text   = business_commerce_gtm( 'business_commerce_product_categories_button_text' );
				$business_commerce_button_link   = business_commerce_gtm( 'business_commerce_product_categories_button_link' );
				$business_commerce_button_target = business_commerce_gtm( 'business_commerce_product_categories_button_target' ) ? '_blank' : '_self';

				if ( $business_commerce_button_text ) : ?>
					<div class="cat-more-wrapper">
						<a href="<?php echo esc_url( $business_commerce_button_link ); ?>" class="more-link" target="<?php echo esc_attr( $business_commerce_button_target ); ?>"><?php echo esc_html( $business_commerce_button_text ); ?></a>
					</div><!-- .more-wrapper -->
				<?php endif; ?>
			</div><!-- .section-title-wrapper -->

			<div class="section-carousel-wrapper">
				<div class="product-category-block-list clear-fix">
					<div class="row">
						<?php
							$business_commerce_args = array(
								'taxonomy' => 'product_cat',
								'orderby'  => 'include',
								'include'  => business_commerce_gtm( 'business_commerce_product_categories_category' ),
							);

							$business_commerce_product_categories = get_terms( $business_commerce_args );

							if ( ! empty( $business_commerce_product_categories ) && ! is_wp_error( $business_commerce_product_categories ) ) {
								foreach ( $business_commerce_product_categories as $business_commerce_term ) {
								?>
								<div class="products-category-item ff-grid-3">
									<div class="item-inner-wrapper inner-block-shadow">
										<?php
										$business_commerce_thumbnail_id = get_term_meta( $business_commerce_term->term_id, 'thumbnail_id', true );

										if ( $business_commerce_thumbnail_id ) :
										?>
										<div class="products-category-thumb-wrap">
											<?php echo wp_get_attachment_image( $business_commerce_thumbnail_id, 'business-commerceduct-category', false, array( 'class' => 'business-commerceducts-category' ) ); ?>
										</div>
										<?php endif; ?>

										<div class="products-category-content">
											<h3>
												<a href="<?php echo esc_url( get_term_link( $business_commerce_term ) ); ?>" rel="bookmark"><?php echo esc_html( $business_commerce_term->name ) . '<span class="category-count">' . absint( $business_commerce_term->count ) . '</span>'; ?></a>
											</h3>
										</div><!-- .products-category-content -->
									</div><!-- .item-inner-wrapper -->
								</div><!-- .products-category-item -->
								<?php
								}
							}
						?>
					</div><!-- .row -->
				</div><!-- .product-category-block-list -->
			</div><!-- .section-carousel-wrapper -->
		</div><!-- .container -->
	</div><!-- .latest-posts-section -->
</div><!-- .section-latest-posts -->
