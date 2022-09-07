<?php
/**
 * Cake Shop Bakery Theme Customizer
 *
 * @link: https://developer.wordpress.org/themes/customize-api/customizer-objects/
 *
 * @package Cake Shop Bakery
 */

use WPTRT\Customize\Section\Cake_Shop_Bakery_Button;

add_action( 'customize_register', function( $manager ) {

    $manager->register_section_type( Cake_Shop_Bakery_Button::class );

    $manager->add_section(
        new Cake_Shop_Bakery_Button( $manager, 'cake_shop_bakery_pro', [
            'title'       => __( 'Cake Shop Pro', 'cake-shop-bakery' ),
            'priority'    => 0,
            'button_text' => __( 'GET PREMIUM', 'cake-shop-bakery' ),
            'button_url'  => esc_url( 'https://www.themagnifico.net/themes/cake-shop-wordpress-theme/', 'cake-shop-bakery')
        ] )
    );

} );

// Load the JS and CSS.
add_action( 'customize_controls_enqueue_scripts', function() {

    $version = wp_get_theme()->get( 'Version' );

    wp_enqueue_script(
        'cake-shop-bakery-customize-section-button',
        get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/js/customize-controls.js' ),
        [ 'customize-controls' ],
        $version,
        true
    );

    wp_enqueue_style(
        'cake-shop-bakery-customize-section-button',
        get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/css/customize-controls.css' ),
        [ 'customize-controls' ],
        $version
    );

} );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function cake_shop_bakery_customize_register($wp_customize){
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';

    // General Settings
     $wp_customize->add_section('cake_shop_bakery_general_settings',array(
        'title' => esc_html__('General Settings','cake-shop-bakery'),
        'description' => esc_html__('General settings of our theme.','cake-shop-bakery'),
        'priority'   => 30,
    ));

    $wp_customize->add_setting('cake_shop_bakery_preloader_hide', array(
        'default' => '0',
        'sanitize_callback' => 'cake_shop_bakery_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'cake_shop_bakery_preloader_hide',array(
        'label'          => __( 'Show Theme Preloader', 'cake-shop-bakery' ),
        'section'        => 'cake_shop_bakery_general_settings',
        'settings'       => 'cake_shop_bakery_preloader_hide',
        'type'           => 'checkbox',
    )));

    //Slider
    $wp_customize->add_section('cake_shop_bakery_top_slider',array(
        'title' => esc_html__('Slider Option','cake-shop-bakery')
    ));

    for ( $count = 1; $count <= 3; $count++ ) {
        $wp_customize->add_setting( 'cake_shop_bakery_top_slider_page' . $count, array(
            'default'           => '',
            'sanitize_callback' => 'cake_shop_bakery_sanitize_dropdown_pages'
        ) );
        $wp_customize->add_control( 'cake_shop_bakery_top_slider_page' . $count, array(
            'label'    => __( 'Select Slide Page', 'cake-shop-bakery' ),
            'section'  => 'cake_shop_bakery_top_slider',
            'type'     => 'dropdown-pages'
        ) );
    }

    //Product
    $wp_customize->add_section('cake_shop_bakery_new_product',array(
        'title' => esc_html__('Featured Product','cake-shop-bakery'),
        'description' => esc_html__('Here you have to select product category which will display perticular new featured product in the home page.','cake-shop-bakery')
    ));

    $wp_customize->add_setting('cake_shop_bakery_new_product_title',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('cake_shop_bakery_new_product_title',array(
        'label' => esc_html__('Title','cake-shop-bakery'),
        'section' => 'cake_shop_bakery_new_product',
        'setting' => 'cake_shop_bakery_new_product_title',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('cake_shop_bakery_new_product_text',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('cake_shop_bakery_new_product_text',array(
        'label' => esc_html__('Text','cake-shop-bakery'),
        'section' => 'cake_shop_bakery_new_product',
        'setting' => 'cake_shop_bakery_new_product_text',
        'type'  => 'text'
    ));
    
    $wp_customize->add_setting('cake_shop_bakery_new_product_number',array(
        'default' => '',
        'sanitize_callback' => 'absint'
    )); 
    $wp_customize->add_control('cake_shop_bakery_new_product_number',array(
        'label' => esc_html__('No of Product','cake-shop-bakery'),
        'section' => 'cake_shop_bakery_new_product',
        'setting' => 'cake_shop_bakery_new_product_number',
        'type'  => 'number'
    ));

    $args = array(
       'type'                     => 'product',
        'child_of'                 => 0,
        'parent'                   => '',
        'orderby'                  => 'term_group',
        'order'                    => 'ASC',
        'hide_empty'               => false,
        'hierarchical'             => 1,
        'number'                   => '',
        'taxonomy'                 => 'product_cat',
        'pad_counts'               => false
    );
    $categories = get_categories( $args );
    $cats = array();
    $i = 0;
    foreach($categories as $category){
        if($i==0){
            $default = $category->slug;
            $i++;
        } 
        $cats[$category->slug] = $category->name;
    }
    $wp_customize->add_setting('cake_shop_bakery_new_product_category',array(
        'sanitize_callback' => 'cake_shop_bakery_sanitize_select',
    ));
    $wp_customize->add_control('cake_shop_bakery_new_product_category',array(
        'type'    => 'select',
        'choices' => $cats,
        'label' => __('Select Product Category','cake-shop-bakery'),
        'section' => 'cake_shop_bakery_new_product',
    ));
    
    // Footer
    $wp_customize->add_section('cake_shop_bakery_site_footer_section', array(
        'title' => esc_html__('Footer', 'cake-shop-bakery'),
    ));

    $wp_customize->add_setting('cake_shop_bakery_footer_text_setting', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('cake_shop_bakery_footer_text_setting', array(
        'label' => __('Replace the footer text', 'cake-shop-bakery'),
        'section' => 'cake_shop_bakery_site_footer_section',
        'priority' => 1,
        'type' => 'text',
    ));
}
add_action('customize_register', 'cake_shop_bakery_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function cake_shop_bakery_customize_partial_blogname(){
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function cake_shop_bakery_customize_partial_blogdescription(){
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function cake_shop_bakery_customize_preview_js(){
    wp_enqueue_script('cake-shop-bakery-customizer', esc_url(get_template_directory_uri()) . '/assets/js/customizer.js', array('customize-preview'), '20151215', true);
}
add_action('customize_preview_init', 'cake_shop_bakery_customize_preview_js');