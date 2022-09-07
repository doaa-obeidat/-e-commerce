<?php
/**
 * Adds the theme options sections, settings, and controls to the theme customizer
 *
 * @package Business Commerce Lite
 */

class Business_Commerce_Theme_Options {
	public function __construct() {
		// Register our Panel.
		add_action( 'customize_register', array( $this, 'add_panel' ) );

		// Register Breadcrumb Options.
		add_action( 'customize_register', array( $this, 'register_breadcrumb_options' ) );

		// Register Excerpt Options.
		add_action( 'customize_register', array( $this, 'register_excerpt_options' ) );

		// Register Homepage Options.
		add_action( 'customize_register', array( $this, 'register_homepage_options' ) );

		// Register Layout Options.
		add_action( 'customize_register', array( $this, 'register_layout_options' ) );

		// Add default options.
		add_filter( 'business_commerce_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			// Header Media.
			'business_commerce_header_image_visibility' => 'disabled',

			// Breadcrumb
			'business_commerce_breadcrumb_show' => 1,

			// Layout Options.
			'business_commerce_default_layout'          => 'right-sidebar',
			'business_commerce_homepage_archive_layout' => 'no-sidebar-full-width',
			'business_commerce_woocommerce_layout'      => 'no-sidebar-full-width',
			
			// Excerpt Options
			'business_commerce_excerpt_length'    => 30,
			'business_commerce_excerpt_more_text' => esc_html__( 'Continue reading', 'business-commerce-lite' ),

			// Homepage/Frontpage Options.
			'business_commerce_front_page_category'   => '',
			'business_commerce_show_homepage_content' => 1,
		);


		$updated_defaults = wp_parse_args( $defaults, $default_options );

		return $updated_defaults;
	}

	/**
	 * Register the Customizer panels
	 */
	public function add_panel( $wp_customize ) {
		/**
		 * Add our Header & Navigation Panel
		 */
		 $wp_customize->add_panel( 'business_commerce_theme_options',
			array(
				'title' => esc_html__( 'Theme Options', 'business-commerce-lite' ),
			)
		);
	}

	/**
	 * Add breadcrumb section and its controls
	 */
	public function register_breadcrumb_options( $wp_customize ) {
		// Add Excerpt Options section.
		$wp_customize->add_section( 'business_commerce_breadcrumb_options',
			array(
				'title' => esc_html__( 'Breadcrumb', 'business-commerce-lite' ),
				'panel' => 'business_commerce_theme_options',
			)
		);

		if ( function_exists( 'bcn_display' ) ) {
			Business_Commerce_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'Business_Commerce_Simple_Notice_Custom_Control',
					'sanitize_callback' => 'sanitize_text_field',
					'settings'          => 'ff_multiputpose_breadcrumb_plugin_notice',
					'label'             =>  esc_html__( 'Info', 'business-commerce-lite' ),
					'description'       =>  sprintf( esc_html__( 'Since Breadcrumb NavXT Plugin is installed, edit plugin\'s settings %1$shere%2$s', 'business-commerce-lite' ), '<a href="' . esc_url( get_admin_url( null, 'options-general.php?page=breadcrumb-navxt' ) ) . '" target="_blank">', '</a>' ),
					'section'           => 'ff_multiputpose_breadcrumb_options',
				)
			);

			return;
		}

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Business_Commerce_Toggle_Switch_Custom_control',
				'settings'          => 'business_commerce_breadcrumb_show',
				'sanitize_callback' => 'business_commerce_switch_sanitization',
				'label'             => esc_html__( 'Display Breadcrumb?', 'business-commerce-lite' ),
				'section'           => 'business_commerce_breadcrumb_options',
			)
		);

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Business_Commerce_Toggle_Switch_Custom_control',
				'settings'          => 'business_commerce_breadcrumb_show_home',
				'sanitize_callback' => 'business_commerce_switch_sanitization',
				'label'             => esc_html__( 'Show on homepage?', 'business-commerce-lite' ),
				'section'           => 'business_commerce_breadcrumb_options',
			)
		);
	}

	/**
	 * Add layouts section and its controls
	 */
	public function register_layout_options( $wp_customize ) {
		// Add layouts section.
		$wp_customize->add_section( 'business_commerce_layouts',
			array(
				'title' => esc_html__( 'Layouts', 'business-commerce-lite' ),
				'panel' => 'business_commerce_theme_options'
			)
		);

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'select',
				'settings'          => 'business_commerce_default_layout',
				'sanitize_callback' => 'business_commerce_sanitize_select',
				'label'             => esc_html__( 'Default Layout', 'business-commerce-lite' ),
				'section'           => 'business_commerce_layouts',
				'choices'           => array(
					'right-sidebar'         => esc_html__( 'Right Sidebar', 'business-commerce-lite' ),
					'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'business-commerce-lite' ),
				),
			)
		);

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'select',
				'settings'          => 'business_commerce_homepage_archive_layout',
				'sanitize_callback' => 'business_commerce_sanitize_select',
				'label'             => esc_html__( 'Homepage/Archive Layout', 'business-commerce-lite' ),
				'section'           => 'business_commerce_layouts',
				'choices'           => array(
					'right-sidebar'         => esc_html__( 'Right Sidebar', 'business-commerce-lite' ),
					'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'business-commerce-lite' ),
				),
			)
		);

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'select',
				'settings'          => 'business_commerce_woocommerce_layout',
				'sanitize_callback' => 'business_commerce_sanitize_select',
				'label'             => esc_html__( 'WooCommerce Pages Layout', 'business-commerce-lite' ),
				'section'           => 'business_commerce_layouts',
				'choices'           => array(
					'right-sidebar'         => esc_html__( 'Right Sidebar', 'business-commerce-lite' ),
					'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'business-commerce-lite' ),
				),
			)
		);
	}

	/**
	 * Add excerpt section and its controls
	 */
	public function register_excerpt_options( $wp_customize ) {
		// Add Excerpt Options section.
		$wp_customize->add_section( 'business_commerce_excerpt_options',
			array(
				'title' => esc_html__( 'Excerpt Options', 'business-commerce-lite' ),
				'panel' => 'business_commerce_theme_options',
			)
		);

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'number',
				'settings'          => 'business_commerce_excerpt_length',
				'sanitize_callback' => 'absint',
				'label'             => esc_html__( 'Excerpt Length (Words)', 'business-commerce-lite' ),
				'section'           => 'business_commerce_excerpt_options',
			)
		);

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'business_commerce_excerpt_more_text',
				'sanitize_callback' => 'sanitize_text_field',
				'label'             => esc_html__( 'Excerpt More Text', 'business-commerce-lite' ),
				'section'           => 'business_commerce_excerpt_options',
			)
		);
	}

	/**
	 * Add Homepage/Frontpage section and its controls
	 */
	public function register_homepage_options( $wp_customize ) {
		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Business_Commerce_Dropdown_Select2_Custom_Control',
				'sanitize_callback' => 'business_commerce_text_sanitization',
				'settings'          => 'business_commerce_front_page_category',
				'description'       => esc_html__( 'Filter Homepage/Blog page posts by following categories', 'business-commerce-lite' ),
				'label'             => esc_html__( 'Categories', 'business-commerce-lite' ),
				'section'           => 'static_front_page',
				'input_attrs'       => array(
					'multiselect' => true,
				),
				'choices'           => array( esc_html__( '--Select--', 'business-commerce-lite' ) => Business_Commerce_Customizer_Utilities::get_terms( 'category' ) ),
			)
		);

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Business_Commerce_Toggle_Switch_Custom_control',
				'settings'          => 'business_commerce_show_homepage_content',
				'sanitize_callback' => 'business_commerce_switch_sanitization',
				'label'             => esc_html__( 'Show Home Content/Blog', 'business-commerce-lite' ),
				'section'           => 'static_front_page',
			)
		);
	}
}

/**
 * Initialize class
 */
$business_commerce_theme_options = new Business_Commerce_Theme_Options();
