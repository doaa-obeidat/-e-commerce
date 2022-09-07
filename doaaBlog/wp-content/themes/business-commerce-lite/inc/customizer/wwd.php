<?php
/**
 * WWD Options
 *
 * @package Business Commerce Lite
 */

class Business_Commerce_WWD_Options {
	public function __construct() {
		// Register WWD Options.
		add_action( 'customize_register', array( $this, 'register_options' ), 99 );

		// Add default options.
		add_filter( 'business_commerce_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			'business_commerce_wwd_visibility' => 'disabled',
			'business_commerce_wwd_number'     => 4,
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
				'settings'          => 'business_commerce_wwd_visibility',
				'type'              => 'select',
				'sanitize_callback' => 'business_commerce_sanitize_select',
				'label'             => esc_html__( 'Visible On', 'business-commerce-lite' ),
				'section'           => 'business_commerce_ss_wwd',
				'choices'           => Business_Commerce_Customizer_Utilities::section_visibility(),
			)
		);

		$wp_customize->selective_refresh->add_partial( 'business_commerce_wwd_visibility', array(
			'selector' => '#wwd-section',
		) );

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'sanitize_callback' => 'business_commerce_text_sanitization',
				'settings'          => 'business_commerce_wwd_section_top_subtitle',
				'label'             => esc_html__( 'Section Top Sub-title', 'business-commerce-lite' ),
				'section'           => 'business_commerce_ss_wwd',
				'active_callback'   => array( $this, 'is_wwd_visible' ),
			)
		);

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'settings'          => 'business_commerce_wwd_section_title',
				'type'              => 'text',
				'sanitize_callback' => 'business_commerce_text_sanitization',
				'label'             => esc_html__( 'Section Title', 'business-commerce-lite' ),
				'section'           => 'business_commerce_ss_wwd',
				'active_callback'   => array( $this, 'is_wwd_visible' ),
			)
		);

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'settings'          => 'business_commerce_wwd_number',
				'type'              => 'number',
				'label'             => esc_html__( 'Number', 'business-commerce-lite' ),
				'description'       => esc_html__( 'Please refresh the customizer page once the number is changed.', 'business-commerce-lite' ),
				'section'           => 'business_commerce_ss_wwd',
				'sanitize_callback' => 'absint',
				'input_attrs'       => array(
					'min'   => 1,
					'max'   => 80,
					'step'  => 1,
					'style' => 'width:100px;',
				),
				'active_callback'   => array( $this, 'is_wwd_visible' ),
			)
		);

		$numbers = business_commerce_gtm( 'business_commerce_wwd_number' );

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Business_Commerce_Simple_Notice_Custom_Control',
				'sanitize_callback' => 'sanitize_text_field',
				'settings'          => 'business_commerce_wwd_icon_note',
				'label'             =>  esc_html__( 'Info', 'business-commerce-lite' ),
				'description'       =>  sprintf( esc_html__( 'If you want camera icon, save "fas fa-camera". For more classes, check %1$sthis%2$s', 'business-commerce-lite' ), '<a href="' . esc_url( 'https://fontawesome.com/icons?d=gallery&m=free' ) . '" target="_blank">', '</a>' ),
				'section'           => 'business_commerce_ss_wwd',
				'active_callback'   => array( $this, 'is_wwd_visible' ),
			)
		);

		for( $i = 0, $j = 1; $i < $numbers; $i++, $j++ ) {
			Business_Commerce_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'Business_Commerce_Simple_Notice_Custom_Control',
					'sanitize_callback' => 'business_commerce_text_sanitization',
					'settings'          => 'business_commerce_wwd_notice_' . $i,
					'label'             => esc_html__( 'Item #', 'business-commerce-lite' )  . $j,
					'section'           => 'business_commerce_ss_wwd',
					'active_callback'   => array( $this, 'is_wwd_visible' ),
				)
			);

			Business_Commerce_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'Business_Commerce_Dropdown_Posts_Custom_Control',
					'sanitize_callback' => 'absint',
					'settings'          => 'business_commerce_wwd_page_' . $i,
					'label'             => esc_html__( 'Select Page #', 'business-commerce-lite' )  . $j,
					'section'           => 'business_commerce_ss_wwd',
					'active_callback'   => array( $this, 'is_wwd_visible' ),
					'input_attrs' => array(
						'post_type'      => 'page',
						'posts_per_page' => -1,
						'orderby'        => 'name',
						'order'          => 'ASC',
					),
				)
			);

			Business_Commerce_Customizer_Utilities::register_option(
				array(
					'sanitize_callback' => 'sanitize_text_field',
					'settings'          => 'business_commerce_wwd_custom_icon_' . $i,
					'label'             => esc_html__( 'Icon Class', 'business-commerce-lite' ),
					'section'           => 'business_commerce_ss_wwd',
					'active_callback'   => array( $this, 'is_wwd_visible' ),
				)
			);

			Business_Commerce_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'WP_Customize_Image_Control',
					'sanitize_callback' => 'esc_url_raw',
					'settings'          => 'business_commerce_wwd_custom_image_' . $i,
					'label'             => esc_html__( 'Image', 'business-commerce-lite' ),
					'section'           => 'business_commerce_ss_wwd',
					'active_callback'   => array( $this, 'is_wwd_visible' ),
				)
			);
		}
	}

	/**
	 * WWD visibility active callback.
	 */
	public function is_wwd_visible( $control ) {
		return ( business_commerce_display_section( $control->manager->get_setting( 'business_commerce_wwd_visibility' )->value() ) );
	}
}

/**
 * Initialize class
 */
$business_commerce_ss_wwd = new Business_Commerce_WWD_Options();
