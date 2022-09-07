<?php
/**
 * Template part for displaying Featured Product
 *
 * @package Business Commerce Lite
 */

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

$business_commerce_enable = business_commerce_gtm( 'business_commerce_featured_product_visibility' );

if ( ! business_commerce_display_section( $business_commerce_enable ) ) {
	return;
}


if ( 'custom-pages' === $business_commerce_enable ) {
	// Bail if custom pages is selected, and current page is not in list.
	if (  ! in_array( get_the_ID(), explode( ',', business_commerce_gtm( 'business_commerce_featured_product_custom_pages' ) ) ) ) {
		return;
	}
}

if ( $business_commerce_id = business_commerce_gtm( 'business_commerce_featured_product_product' ) ) {
	$business_commerce_args = array(
		'post_type' => 'product',
		'p'         => absint( $business_commerce_id ),
	);
}
// If $business_commerce_args is empty return false
if ( empty( $business_commerce_args ) ) {
	return;
}

$business_commerce_args['posts_per_page'] = 1;

$business_commerce_loop = new WP_Query( $business_commerce_args );

while ( $business_commerce_loop->have_posts() ) :
	$business_commerce_loop->the_post();

	$business_commerce_subtitle      = business_commerce_gtm( 'business_commerce_featured_product_custom_subtitle' );
	?>

	<div id="featured-product-section" class="featured-product-section section content-position-right default">
		<div class="section-featured-page">
			<div class="container">
				<div class="row">
					<?php if ( has_post_thumbnail() ) : ?>
					<div class="ff-grid-6 featured-page-thumb">
						<?php the_post_thumbnail( 'business-commerce-hero', array( 'class' => 'alignnone' ) );?>
					</div>
					<?php endif; ?>

					<div class="ff-grid-6 featured-page-content">
						<div class="featured-page-section">
							<div class="section-title-wrap text-alignleft clear-fix">
								<?php if ( $business_commerce_subtitle ) : ?>
								<p class="section-top-subtitle"><?php echo esc_html( $business_commerce_subtitle ); ?></p>
								<?php endif; ?>

								<?php the_title( '<h2 class="section-title"><a href="' . esc_url( get_permalink() ) .'">', '</a></h2>' ); ?>
							</div>

							<div class="clear-fix"><?php
							woocommerce_template_loop_rating();

							business_commerce_display_content(); ?>
						</div>
						</div><!-- .featured-page-section -->
					</div><!-- .ff-grid-6 -->
				</div><!-- .row -->
			</div><!-- .container -->
		</div><!-- .section-featured-page -->
	</div><!-- .section -->
<?php
endwhile;

wp_reset_postdata();
