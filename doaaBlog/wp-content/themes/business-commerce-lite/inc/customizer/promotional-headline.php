<?php
/**
 * Promotional Headline Options
 *
 * @package Business Commerce Lite
 */

class Business_Commerce_Promotional_Headline_Options {
	public function __construct() {
		// Register Promotion Headline Options.
		add_action( 'customize_register', array( $this, 'register_options' ), 99 );

		// Add default options.
		add_filter( 'business_commerce_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			'business_commerce_promotional_headline_visibility' => 'disabled',
		);

		$updated_defaults = wp_parse_args( $defaults, $default_options );

		return $updated_defaults;
	}

	/**
	 * Add layouts section and its controls
	 */
	public function register_options( $wp_customize ) {
		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'settings'          => 'business_commerce_promotional_headline_visibility',
				'type'              => 'select',
				'sanitize_callback' => 'business_commerce_sanitize_select',
				'label'             => esc_html__( 'Visible On', 'business-commerce-lite' ),
				'section'           => 'business_commerce_ss_promotional_headline',
				'choices'           => Business_Commerce_Customizer_Utilities::section_visibility(),
			)
		);

		// Add Edit Shortcut Icon.
		$wp_customize->selective_refresh->add_partial( 'business_commerce_promotional_headline_visibility', array(
			'selector' => '#promotional-headline-section',
		) );

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Business_Commerce_Dropdown_Posts_Custom_Control',
				'sanitize_callback' => 'absint',
				'settings'          => 'business_commerce_promotional_headline_page',
				'label'             => esc_html__( 'Select Page', 'business-commerce-lite' ),
				'section'           => 'business_commerce_ss_promotional_headline',
				'active_callback'   => array( $this, 'is_promotional_headline_visible' ),
				'input_attrs' => array(
					'post_type'      => 'page',
					'posts_per_page' => -1,
					'orderby'        => 'name',
					'order'          => 'ASC',
				),
			)
		);
	}

	/**
	 * Promotion Headline visibility active callback.
	 */
	public function is_promotional_headline_visible( $control ) {
		return ( business_commerce_display_section( $control->manager->get_setting( 'business_commerce_promotional_headline_visibility' )->value() ) );
	}
}

/**
 * Initialize class
 */
$business_commerce_ss_promotional_headline = new Business_Commerce_Promotional_Headline_Options();
