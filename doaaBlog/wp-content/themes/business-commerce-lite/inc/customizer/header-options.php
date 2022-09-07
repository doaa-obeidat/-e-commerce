<?php
/**
 * Adds the header options sections, settings, and controls to the theme customizer
 *
 * @package Business Commerce Lite
 */

class Business_Commerce_Header_Options {
	public function __construct() {
		// Register Header Options.
		add_action( 'customize_register', array( $this, 'register_header_options' ) );

		// Register Header Top Options
		add_action( 'customize_register', array( $this, 'register_header_top_options' ) );

		// Add default options.
		add_filter( 'business_commerce_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			'business_commerce_header_phone_text'  => esc_html__( 'Customer Support', 'business-commerce-lite' ),
			'business_commerce_header_login_on'   => 1,
			'business_commerce_header_login_icon' => 'far fa-user',
			'business_commerce_header_login_link' => get_permalink( get_option('woocommerce_myaccount_page_id') ),
		);

		$updated_defaults = wp_parse_args( $defaults, $default_options );

		return $updated_defaults;
	}

	/**
	 * Add header options section and its controls
	 */
	public function register_header_options( $wp_customize ) {
		// Add header options section.
		$wp_customize->add_section( 'business_commerce_header_options',
			array(
				'title' => esc_html__( 'Header Options', 'business-commerce-lite' ),
				'panel' => 'business_commerce_theme_options'
			)
		);

		// Add Edit Shortcut Icon.
		$wp_customize->selective_refresh->add_partial( 'business_commerce_header_style', array(
			'selector' => '#masthead',
		) );

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Business_Commerce_Toggle_Switch_Custom_control',
				'settings'          => 'business_commerce_header_login_on',
				'sanitize_callback' => 'business_commerce_switch_sanitization',
				'label'             => esc_html__( 'Login Icon/Link', 'business-commerce-lite' ),
				'section'           => 'business_commerce_header_options',
			) 
		);

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Business_Commerce_Simple_Notice_Custom_Control',
				'sanitize_callback' => 'sanitize_text_field',
				'settings'          => 'business_commerce_header_login_link_note',
				'label'             =>  esc_html__( 'Info', 'business-commerce-lite' ),
				'description'       =>  sprintf( esc_html__( 'If you want user icon, save "far fa-user". For more classes, check %1$sthis%2$s', 'business-commerce-lite' ), '<a href="' . esc_url( 'https://fontawesome.com/icons?d=gallery&m=free' ) . '" target="_blank">', '</a>' ),
				'section'           => 'business_commerce_header_options',
				'active_callback'   => array( $this, 'is_login_link_on' ),
			)
		);

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'business_commerce_header_login_icon',
				'sanitize_callback' => 'business_commerce_text_sanitization',
				'label'             => esc_html__( 'Icon', 'business-commerce-lite' ),
				'section'           => 'business_commerce_header_options',
				'active_callback'   => array( $this, 'is_login_link_on' ),
			)
		);

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'url',
				'settings'          => 'business_commerce_header_login_link',
				'sanitize_callback' => 'esc_url_raw',
				'label'             => esc_html__( 'Link', 'business-commerce-lite' ),
				'section'           => 'business_commerce_header_options',
				'active_callback'   => array( $this, 'is_login_link_on' ),
			)
		);

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Business_Commerce_Toggle_Switch_Custom_control',
				'settings'          => 'business_commerce_header_login_target',
				'sanitize_callback' => 'business_commerce_switch_sanitization',
				'label'             => esc_html__( 'Open link in new tab?', 'business-commerce-lite' ),
				'section'           => 'business_commerce_header_options',
				'active_callback'   => array( $this, 'is_login_link_on' ),
			)
		);
	}

	/**
	 * Active callback to determine if login link is on/pff
	 */
	public function is_login_link_on( $control ) {
		return $control->manager->get_setting( 'business_commerce_header_login_on' )->value() ? true : false;
	} 

	public function register_header_top_options( $wp_customize ) {
		// Add header options section.
		$wp_customize->add_section( 'business_commerce_header_top_options',
			array(
				'title' => esc_html__( 'Header Top Options', 'business-commerce-lite' ),
				'panel' => 'business_commerce_theme_options'
			)
		);

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'business_commerce_header_top_text',
				'sanitize_callback' => 'business_commerce_text_sanitization',
				'label'             => esc_html__( 'Text', 'business-commerce-lite' ),
				'section'           => 'business_commerce_header_top_options',
			)
		);

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'business_commerce_header_email',
				'sanitize_callback' => 'sanitize_email',
				'label'             => esc_html__( 'Email', 'business-commerce-lite' ),
				'section'           => 'business_commerce_header_top_options',
			)
		);

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'business_commerce_header_phone',
				'sanitize_callback' => 'business_commerce_text_sanitization',
				'label'             => esc_html__( 'Phone', 'business-commerce-lite' ),
				'section'           => 'business_commerce_header_top_options',
			)
		);

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'business_commerce_header_phone_text',
				'sanitize_callback' => 'business_commerce_text_sanitization',
				'label'             => esc_html__( 'Text Below Phone', 'business-commerce-lite' ),
				'description'       => esc_html__( 'Not Applicable for Header Style Two and Six', 'business-commerce-lite' ),
				'section'           => 'business_commerce_header_top_options',
			)
		);

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'business_commerce_header_address',
				'sanitize_callback' => 'business_commerce_text_sanitization',
				'label'             => esc_html__( 'Address', 'business-commerce-lite' ),
				'section'           => 'business_commerce_header_top_options',
			)
		);

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'business_commerce_header_open_hours',
				'sanitize_callback' => 'business_commerce_text_sanitization',
				'label'             => esc_html__( 'Open Hours', 'business-commerce-lite' ),
				'section'           => 'business_commerce_header_top_options',
			)
		);

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'business_commerce_header_button_text',
				'sanitize_callback' => 'business_commerce_text_sanitization',
				'label'             => esc_html__( 'Button Text', 'business-commerce-lite' ),
				'section'           => 'business_commerce_header_top_options',
			)
		);

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'url',
				'settings'          => 'business_commerce_header_button_link',
				'sanitize_callback' => 'esc_url_raw',
				'label'             => esc_html__( 'Button Link', 'business-commerce-lite' ),
				'section'           => 'business_commerce_header_top_options',
			)
		);

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Business_Commerce_Toggle_Switch_Custom_control',
				'settings'          => 'business_commerce_header_button_target',
				'sanitize_callback' => 'business_commerce_switch_sanitization',
				'label'             => esc_html__( 'Open link in new tab?', 'business-commerce-lite' ),
				'section'           => 'business_commerce_header_top_options',
			)
		);
	}
}

/**
 * Initialize class
 */
$business_commerce_theme_options = new Business_Commerce_Header_Options();
