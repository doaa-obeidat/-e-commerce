<?php
/**
 * Product Categories Options
 *
 * @package Business Commerce Lite
 */
class Business_Commerce_Product_Categories_Options {
	public function __construct() {
		// Register Hero Content Options.
		add_action( 'customize_register', array( $this, 'register_options' ), 99 );

		// Add default options.
		add_filter( 'business_commerce_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			'business_commerce_product_categories_visibility'  => 'disabled',
			'business_commerce_product_categories_button_text' => esc_html__( 'View All', 'business-commerce-lite' ),
		);

		$updated_defaults = wp_parse_args( $defaults, $default_options );

		return $updated_defaults;
	}

	/**
	 * Add layouts section and its controls
	 */
	public function register_options( $wp_customize ) {
		if ( ! class_exists( 'WooCommerce' ) ) {
			Business_Commerce_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'Business_Commerce_Simple_Notice_Custom_Control',
					'sanitize_callback' => 'sanitize_text_field',
					'settings'          => 'ff_multiputpose_product_categories_plugin_notice',
					'label'             =>  esc_html__( 'Info', 'business-commerce-lite' ),
					'description'       =>  sprintf( esc_html__( 'Install %1$sWooCommerce%2$s Plugin for this section.', 'business-commerce-lite' ), '<a href="https://wordpress.org/plugins/woocommerce/" target="_blank">', '</a>' ),
					'section'           => 'business_commerce_ss_product_categories',
				)
			);

			return;
		}

		Business_Commerce_Customizer_Utilities::register_option(
				array(
	            'settings'          => 'business_commerce_product_categories_visibility',
				'sanitize_callback' => 'business_commerce_sanitize_select',
	            'type'              => 'select',
				'label'             => esc_html__( 'Visible On', 'business-commerce-lite' ),
				'section'           => 'business_commerce_ss_product_categories',
				'choices'           => Business_Commerce_Customizer_Utilities::section_visibility(),
	        )
	    );

	    Business_Commerce_Customizer_Utilities::register_option(
			array(
				'settings'          => 'business_commerce_product_categories_section_title',
				'type'              => 'text',
				'sanitize_callback' => 'business_commerce_text_sanitization',
				'label'             => esc_html__( 'Section Title', 'business-commerce-lite' ),
				'section'           => 'business_commerce_ss_product_categories',
				'active_callback'   => array( $this, 'is_product_categories_visible' ),
			)
		);

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'sanitize_callback' => 'business_commerce_text_sanitization',
				'settings'          => 'business_commerce_product_categories_section_top_subtitle',
				'label'             => esc_html__( 'Section Top Sub-title', 'business-commerce-lite' ),
				'section'           => 'business_commerce_ss_product_categories',
				'active_callback'   => array( $this, 'is_product_categories_visible' ),
			)
		);

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Business_Commerce_Dropdown_Select2_Custom_Control',
				'sanitize_callback' => 'business_commerce_text_sanitization',
				'settings'          => 'business_commerce_product_categories_category',
				'label'             => esc_html__( 'Pick Product categories', 'business-commerce-lite' ),
				'section'           => 'business_commerce_ss_product_categories',
				'input_attrs'       => array(
					'multiselect' => true,
				),
				'choices'           => array( esc_html__( '--Select--', 'business-commerce-lite' ) => Business_Commerce_Customizer_Utilities::get_terms( 'product_cat' ) ),
				'active_callback'   => array( $this, 'is_product_categories_visible' ),
			)
		);

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'sanitize_callback' => 'business_commerce_text_sanitization',
				'settings'          => 'business_commerce_product_categories_button_text',
				'label'             => esc_html__( 'Button Text', 'business-commerce-lite' ),
				'section'           => 'business_commerce_ss_key_features',
				'active_callback'   => array( $this, 'is_product_categories_visible' ),
			)
		);

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'url',
				'sanitize_callback' => 'esc_url_raw',
				'settings'          => 'business_commerce_product_categories_button_link',
				'label'             => esc_html__( 'Button Link', 'business-commerce-lite' ),
				'section'           => 'business_commerce_ss_key_features',
				'active_callback'   => array( $this, 'is_product_categories_visible' ),
			)
		);

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Business_Commerce_Toggle_Switch_Custom_control',
				'settings'          => 'business_commerce_product_categories_button_target',
				'sanitize_callback' => 'business_commerce_switch_sanitization',
				'label'             => esc_html__( 'Open link in new tab?', 'business-commerce-lite' ),
				'section'           => 'business_commerce_ss_key_features',
				'active_callback'   => array( $this, 'is_product_categories_visible' ),
			)
		);
	}

	/**
	 * Hero Content visibility active callback.
	 */
	public function is_product_categories_visible( $control ) {
		return ( business_commerce_display_section( $control->manager->get_setting( 'business_commerce_product_categories_visibility' )->value() ) );
	}
}

/**
 * Initialize class
 */
$business_commerce_ss_product_categories = new Business_Commerce_Product_Categories_Options();
