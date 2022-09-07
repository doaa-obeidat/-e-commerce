<?php
/**
 * Displays main header
 *
 * @package Cake Shop Bakery
 */
?>

<div class="main-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-4 align-self-center">
                <div class="navbar-brand text-center text-md-left">
                    <?php if ( has_custom_logo() ) : ?>
                        <div class="site-logo"><?php the_custom_logo(); ?></div>
                    <?php endif; ?>
                    <?php $blog_info = get_bloginfo( 'name' ); ?>
                        <?php if ( ! empty( $blog_info ) ) : ?>
                            <?php if ( is_front_page() && is_home() ) : ?>
                                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                            <?php else : ?>
                                <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php
                            $description = get_bloginfo( 'description', 'display' );
                            if ( $description || is_customize_preview() ) :
                        ?>
                        <p class="site-description"><?php echo esc_html($description); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6 col-md-2 col-sm-2 col-4 align-self-center">
                <?php get_template_part('template-parts/navigation/nav'); ?>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-3 col-4  align-self-center">
                <div class="cart_no">
                    <?php if(class_exists('woocommerce')){ ?>
                        <div class="user-account">
                            <?php if ( is_user_logged_in() ) { ?>
                                <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_attr_e('My Account','cake-shop-bakery'); ?>"><i class="fas fa-user mr-2"></i><?php esc_html_e('My Account','cake-shop-bakery'); ?></a>
                            <?php }
                            else { ?>
                                <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_attr_e('Login / Register','cake-shop-bakery'); ?>"><i class="fas fa-sign-in-alt mr-2"></i><?php esc_html_e('Login / Register','cake-shop-bakery'); ?></a>
                            <?php } ?>
                        </div>
                    <?php }?>
                </div>
            </div>
            <div class="col-lg-1 col-md-3 col-sm-3 col-4  align-self-center">
                <div class="cart_no">
                    <?php if(class_exists('woocommerce')){ ?>
                        <?php global $woocommerce; ?>
                        <a class="cart-customlocation" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e( 'shopping cart','cake-shop-bakery' ); ?>"><i class="fas fa-shopping-cart mr-2"></i><?php esc_html_e('Cart','cake-shop-bakery'); ?></a>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</div>