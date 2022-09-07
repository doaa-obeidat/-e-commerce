<?php
/**
 * Header one Style Template
 *
 * @package Business Commerce Lite
 */
$business_commerce_header_top_text = business_commerce_gtm( 'business_commerce_header_top_text' );
$business_commerce_phone           = business_commerce_gtm( 'business_commerce_header_phone' );
$business_commerce_email           = business_commerce_gtm( 'business_commerce_header_email' );
$business_commerce_address         = business_commerce_gtm( 'business_commerce_header_address' );
$business_commerce_open_hours      = business_commerce_gtm( 'business_commerce_header_open_hours' );

$business_commerce_button_text   = business_commerce_gtm( 'business_commerce_header_button_text' );
$business_commerce_button_link   = business_commerce_gtm( 'business_commerce_header_button_link' );
$business_commerce_button_target = business_commerce_gtm( 'business_commerce_header_button_target' ) ? '_blank' : '_self';
?>
<div class="header-wrapper main-header-one<?php echo ! $business_commerce_button_text ? ' button-disabled' : ''; ?>">
	<?php if ( $business_commerce_header_top_text || $business_commerce_phone || $business_commerce_email || $business_commerce_address || $business_commerce_open_hours || has_nav_menu( 'social' ) ) : ?>
	<div id="top-header" class="main-top-header-one dark-top-header">
	
		<div class="site-top-header-mobile">
			<div class="container">
				<button id="header-top-toggle" class="header-top-toggle" aria-controls="header-top" aria-expanded="false">
					<i class="fas fa-bars"></i><span class="menu-label"> <?php esc_html_e( 'Top Bar', 'business-commerce-lite' ); ?></span>
				</button><!-- #header-top-toggle -->
				<div id="site-top-header-mobile-container">
				<?php if ( $business_commerce_header_top_text ) : ?>
					<div id="quick-info" class="text-aligncenter">
	                	<p><?php echo esc_html( $business_commerce_header_top_text ); ?></p>
					</div>
				<?php endif; ?>
					<?php if ( $business_commerce_phone || $business_commerce_email || $business_commerce_address || $business_commerce_open_hours ) : ?>
						<div id="quick-contact">
							<?php get_template_part( 'template-parts/header/quick-contact' ); ?>
						</div>
					<?php endif; ?>

					<?php if ( has_nav_menu( 'social' ) ): ?>
						<div id="top-social" class="pull-left">
							<div class="social-nav no-border">
								<nav id="social-primary-navigation" class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'business-commerce-lite' ); ?>">
									<?php
									wp_nav_menu( array(
										'theme_location' => 'social',
										'menu_class'     => 'social-links-menu',
										'depth'          => 1,
										'link_before'    => '<span class="screen-reader-text">',
									) );
									?>
								</nav><!-- .social-navigation -->
							</div>
						</div><!-- #top-social -->
					<?php endif; ?>
				</div><!-- #site-top-header-mobile-container-->
			

			</div><!-- .container -->
		</div><!-- .site-top-header-mobile -->

		<div class="site-top-header">
			<div class="container">
				<?php if ( $business_commerce_header_top_text ) : ?>
					<div id="quick-info" class="pull-left">
		            	<p><?php echo esc_html( $business_commerce_header_top_text ); ?></p>
					</div>
				<?php endif; ?>
				<div id="quick-contact" class="layout-one pull-left">
					<?php get_template_part( 'template-parts/header/quick-contact' ); ?>
				</div><!-- #quick-contact -->
				<div class="top-head-right pull-right">
					<?php if ( has_nav_menu( 'social' ) ): ?>
					<div id="top-social" class="pull-left">
						<div class="social-nav no-border">
							<nav id="social-primary-navigation" class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'business-commerce-lite' ); ?>">
								<?php
									wp_nav_menu( array(
										'theme_location' => 'social',
										'menu_class'     => 'social-links-menu',
										'depth'          => 1,
										'link_before'    => '<span class="screen-reader-text">',
									) );
								?>
							</nav><!-- .social-navigation -->
						</div>
					</div><!-- #top-social -->
					<?php endif; ?>
					
					<?php get_template_part( 'template-parts/third-party/woocommerce-currency-switcher' ); ?>

					<?php get_template_part( 'template-parts/third-party/translatepress-language-switcher' ); ?>
				</div><!-- .container -->
			</div><!-- .site-top-header -->
		</div><!-- .site-top-header -->
	</div><!-- .#top-header -->
	<?php endif; ?>

	<header id="masthead" class="site-header clear-fix">
		<div class="container">
			<div class="site-header-main">
				<div class="site-branding">
					<?php get_template_part( 'template-parts/header/site-branding' ); ?>
				</div><!-- .site-branding -->

				<div class="right-head pull-right">
					<div id="main-nav" class="pull-left">
						<?php get_template_part( 'template-parts/navigation/navigation-primary' ); ?>
					</div>
					<div class="header-search-wrapper toggled-on-default pull-left">
						<?php get_template_part( 'template-parts/header/product-cat-search' ); ?>
					</div><!-- .header-search -->

					<?php if ( business_commerce_gtm( 'business_commerce_header_login_on' ) ) : ?>
					<div class="login-register pull-left">
						<a href="<?php echo esc_url( business_commerce_gtm( 'business_commerce_header_login_link' ) ); ?>" class="account-login"<?php echo business_commerce_gtm( 'business_commerce_header_login_target' ) ? ' target="_blank"' : ''; ?>><i class="<?php echo esc_attr( business_commerce_gtm( 'business_commerce_header_login_icon' ) ); ?>"></i></a>
					</div><!-- .login-register -->
					<?php endif; ?>

					<?php if ( function_exists( 'business_commerce_woocommerce_header_cart' ) ) : ?>
					<div class="cart-contents pull-left">
						<?php business_commerce_woocommerce_header_cart(); ?>
					</div>
					<?php endif; ?>
										<?php if ( $business_commerce_button_text ) : ?>
							<a target="<?php echo esc_attr( $business_commerce_button_target );?>" href="<?php echo esc_url( $business_commerce_button_link );?>" class="ff-button header-button  pull-right"><?php echo esc_html( $business_commerce_button_text );?></a>
							<?php endif; ?>
				</div><!-- .right-head -->
			</div><!-- .site-header-main -->
		</div><!-- .container -->
	</header><!-- #masthead -->
</div>
