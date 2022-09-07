<?php
/**
 * Template part for displaying Hero Content
 *
 * @package Business Commerce Lite
 */
if ( business_commerce_gtm( 'business_commerce_promotional_headline_page' ) ) {
	$business_commerce_args = array(
		'page_id' => absint( business_commerce_gtm( 'business_commerce_promotional_headline_page' ) ),
	);
} 

// If $business_commerce_args is empty return false
if ( empty( $business_commerce_args ) ) {
	return;
}

$business_commerce_args['posts_per_page'] = 1;
$business_commerce_args['post_type'] = 'page';

$business_commerce_loop = new WP_Query( $business_commerce_args );

while ( $business_commerce_loop->have_posts() ) :
	$business_commerce_loop->the_post();
	?>
	<div id="promotional-headline-section" class="section text-aligncenter promotional-headline-section overlay-enabled" <?php echo has_post_thumbnail() ? 'style="background-image: url( ' .esc_url( get_the_post_thumbnail_url() ) . ' )"' : ''; ?>>
	<div class="promotion-inner-wrapper section-promotion">
		<div class="container">
			<div class="promotion-content">
				<div class="promotion-description">
					<?php the_title( '<h2>', '</h2>' ); ?>

					<?php business_commerce_display_content(); ?>
				</div><!-- .promotion-description -->
			</div><!-- .promotion-content -->
		</div><!-- .container -->
	</div><!-- .promotion-inner-wrapper" -->
</div><!-- .section -->
<?php
endwhile;

wp_reset_postdata();
