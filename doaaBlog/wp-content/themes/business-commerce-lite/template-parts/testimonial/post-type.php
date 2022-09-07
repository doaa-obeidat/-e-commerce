<?php
/**
 * Template part for displaying Post Types Slider
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Business Commerce Lite
 */

$business_commerce_args = business_commerce_get_section_args( 'testimonial' );
$business_commerce_loop = new WP_Query( $business_commerce_args );

if ( $business_commerce_loop->have_posts() ) :
	?>
	<div class="testimonial-content-wrapper">
		<div class="row">
		<?php

		while ( $business_commerce_loop->have_posts() ) :
			$business_commerce_loop->the_post();
			?>
			<div class="testimonial-item ff-grid-4">
				<div class="testimonial-wrapper clear-fix">
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="testimonial-thumb">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( 'business-commerce-portfolio', array( 'class' => 'pull-left' ) ); ?>
							</a>
						</div>
					<?php endif; ?>
					<div class="testimonial-summary pull-right">
						<div class="clinet-info">
							<?php the_title( '<h3><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h3>'); ?>
						</div>
						<!-- .clinet-info -->

						<?php business_commerce_display_content( 'testimonial' ); ?>
					</div>
				</div><!-- .testimonial-wrapper -->
			</div><!-- .testimonial-item -->
		<?php
		endwhile;
		?>
		</div><!-- .swiper-wrapper -->
	</div><!-- .testimonial-content-wrapper -->
<?php
endif;

wp_reset_postdata();
