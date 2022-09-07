<?php
/**
 * Hero Content Options
 *
 * @package Business Commerce Lite
 */

class Business_Commerce_Featured_Product_Options {
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
			'business_commerce_featured_product_visibility'      => 'disabled',
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
					'settings'          => 'ff_multiputpose_breadcrumb_plugin_notice',
					'label'             =>  esc_html__( 'Info', 'business-commerce-lite' ),
					'description'       =>  sprintf( esc_html__( 'Install %1$sWooCommerce%2$s Plugin for this section.', 'business-commerce-lite' ), '<a href="https://wordpress.org/plugins/woocommerce/" target="_blank">', '</a>' ),
					'section'           => 'business_commerce_ss_featured_product',
				)
			);

			return;
		}

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'settings'          => 'business_commerce_featured_product_visibility',
				'type'              => 'select',
				'sanitize_callback' => 'business_commerce_sanitize_select',
				'label'             => esc_html__( 'Visible On', 'business-commerce-lite' ),
				'section'           => 'business_commerce_ss_featured_product',
				'choices'           => Business_Commerce_Customizer_Utilities::section_visibility(),
			)
		);

		// Add Edit Shortcut Icon.
		$wp_customize->selective_refresh->add_partial( 'business_commerce_featured_product_visibility', array(
			'selector' => '#featured-product-section',
		) );

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'sanitize_callback' => 'business_commerce_text_sanitization',
				'settings'          => 'business_commerce_featured_product_custom_subtitle',
				'label'             => esc_html__( 'Top Subtitle', 'business-commerce-lite' ),
				'section'           => 'business_commerce_ss_featured_product',
				'active_callback'   => array( $this, 'is_featured_product_visible' ),
			)
		);

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Business_Commerce_Dropdown_Posts_Custom_Control',
				'sanitize_callback' => 'absint',
				'settings'          => 'business_commerce_featured_product_product',
				'label'             => esc_html__( 'Select Product', 'business-commerce-lite' ),
				'section'           => 'business_commerce_ss_featured_product',
				'active_callback'   => array( $this, 'is_featured_product_visible' ),
				'input_attrs' => array(
					'post_type'      => 'product',
					'posts_per_page' => -1,
				),
			)
		);
	}

	/**
	 * Hero Content visibility active callback.
	 */
	public function is_featured_product_visible( $control ) {
		return ( business_commerce_display_section( $control->manager->get_setting( 'business_commerce_featured_product_visibility' )->value() ) );
	}
}

/**
 * Initialize class
 */
$business_commerce_ss_featured_product = new Business_Commerce_Featured_Product_Options();
