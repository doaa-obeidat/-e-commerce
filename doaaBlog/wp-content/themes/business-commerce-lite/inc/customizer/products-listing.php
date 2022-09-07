<?php
/**
 * Products Listing Options
 *
 * @package Business Commerce Lite
 */

class Business_Commerce_Products_Listing_Options {
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
			'business_commerce_products_listing_visibility'              => 'disabled',
			'business_commerce_products_listing_number'                  => 5,
			'business_commerce_products_listing_columns'                 => 5,
			'business_commerce_products_listing_orderby'                 => 'title',
			'business_commerce_products_listing_products_filter'         => 'none',
			'business_commerce_products_listing_order'                   => 'ASC',
			'business_commerce_products_listing_button_text'             => esc_html__( 'View All', 'business-commerce-lite' ),
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
					'settings'          => 'ff_multiputpose_products_listing_plugin_notice',
					'label'             =>  esc_html__( 'Info', 'business-commerce-lite' ),
					'description'       =>  sprintf( esc_html__( 'Install %1$sWooCommerce%2$s Plugin for this section.', 'business-commerce-lite' ), '<a href="https://wordpress.org/plugins/woocommerce/" target="_blank">', '</a>' ),
					'section'           => 'business_commerce_ss_products_listing',
				)
			);

			return;
		}

		Business_Commerce_Customizer_Utilities::register_option(
				array(
	            'settings'          => 'business_commerce_products_listing_visibility',
				'sanitize_callback' => 'business_commerce_sanitize_select',
	            'type'              => 'select',
				'label'             => esc_html__( 'Visible On', 'business-commerce-lite' ),
				'section'           => 'business_commerce_ss_products_listing',
				'choices'           => Business_Commerce_Customizer_Utilities::section_visibility(),
	        )
	    );

	    Business_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'sanitize_callback' => 'business_commerce_text_sanitization',
				'settings'          => 'business_commerce_products_listing_section_top_subtitle',
				'label'             => esc_html__( 'Section Top Sub-title', 'business-commerce-lite' ),
				'section'           => 'business_commerce_ss_products_listing',
				'active_callback'   => array( $this, 'is_products_listing_visible' ),
			)
		);

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'settings'          => 'business_commerce_products_listing_section_title',
				'type'              => 'text',
				'sanitize_callback' => 'business_commerce_text_sanitization',
				'label'             => esc_html__( 'Section Title', 'business-commerce-lite' ),
				'section'           => 'business_commerce_ss_products_listing',
				'active_callback'   => array( $this, 'is_products_listing_visible' ),
			)
		);

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'settings'          => 'business_commerce_products_listing_number',
				'type'              => 'number',
				'label'             => esc_html__( 'Number', 'business-commerce-lite' ),
				'description'       => esc_html__( 'Please refresh the customizer page once the number is changed.', 'business-commerce-lite' ),
				'section'           => 'business_commerce_ss_products_listing',
				'sanitize_callback' => 'absint',
				'input_attrs'       => array(
					'min'   => 1,
					'max'   => 80,
					'step'  => 1,
					'style' => 'width:100px;',
				),
				'active_callback'   => array( $this, 'is_products_listing_visible' ),
			)
		);

		Business_Commerce_Customizer_Utilities::register_option(
				array(
				'settings'          => 'business_commerce_products_listing_columns',
				'sanitize_callback' => 'absint',
				'description'       => esc_html__( 'Theme supports up to 6 columns', 'business-commerce-lite' ),
				'label'             => esc_html__( 'No of Columns', 'business-commerce-lite' ),
				'section'           => 'business_commerce_ss_products_listing',
				'type'              => 'number',
				'input_attrs'       => array(
	                'style' => 'width: 50px;',
	                'min'   => 2,
	                'max'   => 6,
	            ),
	            'active_callback'  => array( $this, 'is_products_listing_visible' ),
	        )
	    );

	    Business_Commerce_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Business_Commerce_Toggle_Switch_Custom_control',
				'settings'          => 'business_commerce_products_listing_paginate',
				'sanitize_callback' => 'business_commerce_switch_sanitization',
				'label'             => esc_html__( 'Paginate', 'business-commerce-lite' ),
				'section'           => 'business_commerce_ss_products_listing',
				'active_callback'   => array( $this, 'is_products_listing_visible' ),
			)
		);

		Business_Commerce_Customizer_Utilities::register_option(
				array(
	            'settings'          => 'business_commerce_products_listing_orderby',
				'sanitize_callback' => 'business_commerce_sanitize_select',
	            'type'              => 'select',
				'label'             => esc_html__( 'Order By', 'business-commerce-lite' ),
				'section'           => 'business_commerce_ss_products_listing',
				'choices'           => array(
	                'date'       => esc_html__( 'Date - The date the product was published', 'business-commerce-lite' ),
	                'id'         => esc_html__( 'ID - The post ID of the product', 'business-commerce-lite' ),
	                'menu_order' => esc_html__( 'Menu Order - The Menu Order, if set (lower numbers display first)', 'business-commerce-lite' ),
	                'popularity' => esc_html__( 'Popularity - The number of purchases', 'business-commerce-lite' ),
	                'rand'       => esc_html__( 'Random', 'business-commerce-lite' ),
	                'rating'     => esc_html__( 'Rating - The average product rating', 'business-commerce-lite' ),
	                'title'      => esc_html__( 'Title - The product title', 'business-commerce-lite' ),
	            ),
	            'active_callback'   => array( $this, 'is_products_listing_visible' ),
	        )
	    );

	    Business_Commerce_Customizer_Utilities::register_option(
				array(
	            'settings'          => 'business_commerce_products_listing_products_filter',
				'sanitize_callback' => 'business_commerce_sanitize_select',
	            'type'              => 'select',
				'label'             => esc_html__( 'Products Filter', 'business-commerce-lite' ),
				'section'           => 'business_commerce_ss_products_listing',
				'choices'           => array(
	                'none'         => esc_html__( 'None', 'business-commerce-lite' ),
	                'on_sale'      => esc_html__( 'Retrieve on sale products', 'business-commerce-lite' ),
	                'best_selling' => esc_html__( 'Retrieve best selling products', 'business-commerce-lite' ),
	                'top_rated'    => esc_html__( 'Retrieve top rated products', 'business-commerce-lite' ),
	            ),
	            'active_callback'   => array( $this, 'is_products_listing_visible' ),
	        )
	    );

	    Business_Commerce_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Business_Commerce_Toggle_Switch_Custom_control',
				'settings'          => 'business_commerce_products_listing_featured',
				'sanitize_callback' => 'business_commerce_switch_sanitization',
				'label'             => esc_html__( 'Show only Products that are marked as Featured Products', 'business-commerce-lite' ),
				'section'           => 'business_commerce_ss_products_listing',
				'active_callback'   => array( $this, 'is_products_listing_visible' ),
			)
		);

		Business_Commerce_Customizer_Utilities::register_option(
				array(
	            'settings'          => 'business_commerce_products_listing_order',
				'sanitize_callback' => 'business_commerce_sanitize_select',
	            'type'              => 'select',
				'label'             => esc_html__( 'Order', 'business-commerce-lite' ),
				'section'           => 'business_commerce_ss_products_listing',
				'choices'           => array(
	                'ASC'  => esc_html__( 'Ascending', 'business-commerce-lite' ),
	                'DESC' => esc_html__( 'Descending', 'business-commerce-lite' ),
	            ),
	            'active_callback'   => array( $this, 'is_products_listing_visible' ),
	        )
	    );

	    Business_Commerce_Customizer_Utilities::register_option(
			array(
				'settings'          => 'business_commerce_products_listing_skus',
				'type'              => 'text',
				'description'       => esc_html__( 'Comma separated list of product SKUs', 'business-commerce-lite' ),
				'sanitize_callback' => 'business_commerce_text_sanitization',
				'label'             => esc_html__( 'SKUs', 'business-commerce-lite' ),
				'section'           => 'business_commerce_ss_products_listing',
				'active_callback'   => array( $this, 'is_products_listing_visible' ),
			)
		);

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Business_Commerce_Dropdown_Select2_Custom_Control',
				'sanitize_callback' => 'business_commerce_text_sanitization',
				'settings'          => 'business_commerce_products_listing_category',
				'label'             => esc_html__( 'Pick Product categories', 'business-commerce-lite' ),
				'section'           => 'business_commerce_ss_products_listing',
				'input_attrs'       => array(
					'multiselect' => true,
				),
				'choices'           => array( esc_html__( '--Select--', 'business-commerce-lite' ) => Business_Commerce_Customizer_Utilities::get_terms( 'product_cat' ) ),
				'active_callback'   => array( $this, 'is_products_listing_visible' ),
			)
		);

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'sanitize_callback' => 'business_commerce_text_sanitization',
				'settings'          => 'business_commerce_products_listing_button_text',
				'label'             => esc_html__( 'Button Text', 'business-commerce-lite' ),
				'section'           => 'business_commerce_ss_key_features',
				'active_callback'   => array( $this, 'is_products_listing_visible' ),
			)
		);

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'url',
				'sanitize_callback' => 'esc_url_raw',
				'settings'          => 'business_commerce_products_listing_button_link',
				'label'             => esc_html__( 'Button Link', 'business-commerce-lite' ),
				'section'           => 'business_commerce_ss_key_features',
				'active_callback'   => array( $this, 'is_products_listing_visible' ),
			)
		);

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Business_Commerce_Toggle_Switch_Custom_control',
				'settings'          => 'business_commerce_products_listing_button_target',
				'sanitize_callback' => 'business_commerce_switch_sanitization',
				'label'             => esc_html__( 'Open link in new tab?', 'business-commerce-lite' ),
				'section'           => 'business_commerce_ss_key_features',
				'active_callback'   => array( $this, 'is_products_listing_visible' ),
			)
		);
	}

	/**
	 * Hero Content visibility active callback.
	 */
	public function is_products_listing_visible( $control ) {
		return ( business_commerce_display_section( $control->manager->get_setting( 'business_commerce_products_listing_visibility' )->value() ) );
	}
}

/**
 * Initialize class
 */
$business_commerce_ss_products_listing = new Business_Commerce_Products_Listing_Options();
