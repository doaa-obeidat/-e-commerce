<?php
/**
 * Template part for displaying Post Types Slider
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Business Commerce Lite
 */

$business_commerce_wwd_args = business_commerce_get_section_args( 'wwd' );

$business_commerce_loop = new WP_Query( $business_commerce_wwd_args );

if ( $business_commerce_loop->have_posts() ) :
	?>
	<div class="wwd-block-list">
		<div class="row">
		<?php

		while ( $business_commerce_loop->have_posts() ) :
			$business_commerce_loop->the_post();
			$count = absint( $business_commerce_loop->current_post );
			$icon  = business_commerce_gtm( 'business_commerce_wwd_custom_icon_' . $count );
			$image = business_commerce_gtm( 'business_commerce_wwd_custom_image_' . $count );
			?>
			<div class="wwd-block-item post-type ff-grid-3">
				<div class="wwd-block-wrapper">
					<div class="wwd-block-inner">
						<?php if ( $icon ) : ?>
						<a class="wwd-fonts-icon" href="<?php the_permalink(); ?>" >
							<i class="<?php echo esc_attr( $icon ); ?>"></i>
						</a>
						<?php elseif ( $image ) : ?>
						<a class="wwd-image" href="<?php echo esc_url( $more_link ); ?>">
							<img src="<?php echo esc_url( $image ); ?>" title="<?php echo esc_attr( $title ); ?>"/>
						</a>
						<?php endif; ?>

						<div class="wwd-block-inner-content">
							<?php the_title( '<h3 class="wwd-item-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h3>'); ?>

							<?php business_commerce_display_content(); ?>
						</div><!-- .wwd-block-inner-content -->
					</div><!-- .wwd-block-inner -->
				</div><!-- .wwd-block-wrapper -->
			</div><!-- .wwd-block-item -->
		<?php
		endwhile;
		?>
		</div><!-- .row -->
	</div><!-- .wwd-block-list -->
<?php
endif;

wp_reset_postdata();
