<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Business Commerce Lite
 */

	$show_content = business_commerce_gtm( 'business_commerce_show_homepage_content' );

	if ( $show_content || ! is_front_page() ) : ?>
				</div><!-- .row -->
			</div><!-- .container -->
		</div><!-- #content -->
	<?php endif; ?>

		<?php do_action( 'business_commerce_after_content' ); ?>

		<footer id="colophon" class="site-footer footer-color-scheme-dark">
			<?php get_template_part( 'template-parts/footer/footer', 'widget' ); ?>

			<?php get_template_part( 'template-parts/footer/site-info' ); ?>
		</footer><!-- #colophon -->
	</div><!-- #page -->

	<div id="scrollup" class="displaynone">
		<a title="<?php echo esc_attr__( 'Go to Top', 'business-commerce-lite' ); ?>" class="scrollup" href="#"><i class="fas fa-angle-up"></i></a>
	</div>

	<?php wp_footer(); ?>
</body>
</html>
