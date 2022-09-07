<?php
/**
 * Header Search
 *
 * @package Business Commerce Lite
 */

$business_commerce_phone      = business_commerce_gtm( 'business_commerce_header_phone' );
$business_commerce_email      = business_commerce_gtm( 'business_commerce_header_email' );
$business_commerce_address    = business_commerce_gtm( 'business_commerce_header_address' );
$business_commerce_open_hours = business_commerce_gtm( 'business_commerce_header_open_hours' );

if ( $business_commerce_phone || $business_commerce_email || $business_commerce_address || $business_commerce_open_hours ) : ?>
	<div class="inner-quick-contact">
		<ul>
			<?php if ( $business_commerce_phone ) : ?>
				<li class="quick-call">
					<span><?php esc_html_e( 'Phone', 'business-commerce-lite' ); ?></span><a href="tel:<?php echo preg_replace( '/\s+/', '', esc_attr( $business_commerce_phone ) ); ?>"><?php echo esc_html( $business_commerce_phone ); ?></a> </li>
			<?php endif; ?>

			<?php if ( $business_commerce_email ) : ?>
				<li class="quick-email"><span><?php esc_html_e( 'Email', 'business-commerce-lite' ); ?></span><a href="<?php echo esc_url( 'mailto:' . esc_attr( antispambot( $business_commerce_email ) ) ); ?>"><?php echo esc_html( antispambot( $business_commerce_email ) ); ?></a> </li>
			<?php endif; ?>

			<?php if ( $business_commerce_address ) : ?>
				<li class="quick-address"><span><?php esc_html_e( 'Address', 'business-commerce-lite' ); ?></span><?php echo esc_html( $business_commerce_address ); ?></li>
			<?php endif; ?>

			<?php if ( $business_commerce_open_hours ) : ?>
				<li class="quick-open-hours"><span><?php esc_html_e( 'Open Hours', 'business-commerce-lite' ); ?></span><?php echo esc_html( $business_commerce_open_hours ); ?></li>
			<?php endif; ?>
		</ul>
	</div><!-- .inner-quick-contact -->
<?php endif; ?>

