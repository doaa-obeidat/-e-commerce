<?php
/**
 * Slider Options
 *
 * @package Business Commerce Lite
 */

class Business_Commerce_Slider_Options {
	public function __construct() {
		// Register Slider Options.
		add_action( 'customize_register', array( $this, 'register_options' ), 98 );

		// Register Slider Advance Options.
		add_action( 'customize_register', array( $this, 'register_advanced_options' ), 99 );

		// Add default options.
		add_filter( 'business_commerce_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			'business_commerce_slider_visibility' => 'disabled',
			'business_commerce_slider_number'     => 2,
		);

		$updated_defaults = wp_parse_args( $defaults, $default_options );

		return $updated_defaults;
	}

	/**
	 * Add slider section and its controls
	 */
	public function register_options( $wp_customize ) {
		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'settings'          => 'business_commerce_slider_visibility',
				'type'              => 'select',
				'sanitize_callback' => 'business_commerce_sanitize_select',
				'label'             => esc_html__( 'Visible On', 'business-commerce-lite' ),
				'section'           => 'business_commerce_ss_slider',
				'choices'           => Business_Commerce_Customizer_Utilities::section_visibility(),
			)
		);

		$wp_customize->selective_refresh->add_partial( 'business_commerce_slider_visibility', array(
			'selector' => '#slider-section',
		) );

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Business_Commerce_Simple_Notice_Custom_Control',
				'sanitize_callback' => 'sanitize_text_field',
				'settings'          => 'business_commerce_wwd_icon_note',
				'label'             =>  esc_html__( 'Info', 'business-commerce-lite' ),
				'description'       =>  sprintf( esc_html__( 'For Slider left Section, add widgets to Slider Sidabar Left, form Widgets Section %1$shere%2$s', 'business-commerce-lite' ), '<a href="' . esc_url( admin_url( 'widgets.php' ) ) . '" target="_blank">', '</a>' ),
				'section'           => 'business_commerce_ss_slider',
				'active_callback'   => array( $this, 'is_slider_visible' ),
			)
		);

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'number',
				'settings'          => 'business_commerce_slider_number',
				'label'             => esc_html__( 'Number', 'business-commerce-lite' ),
				'description'       => esc_html__( 'Please refresh the customizer page once the number is changed.', 'business-commerce-lite' ),
				'section'           => 'business_commerce_ss_slider',
				'sanitize_callback' => 'absint',
				'input_attrs'       => array(
					'min'   => 1,
					'max'   => 80,
					'step'  => 1,
					'style' => 'width:100px;',
				),
				'active_callback'   => array( $this, 'is_slider_visible' ),
			)
		);

		$numbers = business_commerce_gtm( 'business_commerce_slider_number' );

		for( $i = 0, $j = 1; $i < $numbers; $i++, $j++ ) {
			Business_Commerce_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'Business_Commerce_Dropdown_Posts_Custom_Control',
					'sanitize_callback' => 'absint',
					'settings'          => 'business_commerce_slider_page_' . $i,
					'label'             => esc_html__( 'Page #', 'business-commerce-lite' )  . $j,
					'section'           => 'business_commerce_ss_slider',
					'active_callback'   => array( $this, 'is_slider_visible' ),
					'input_attrs'       => array(
						'post_type'      => 'page',
						'posts_per_page' => -1,
						'orderby'        => 'name',
						'order'          => 'ASC',
					),
				)
			);
		}
	}

	/**
	 * Add slider advance options
	 */
	public function register_advanced_options( $wp_customize ) {
		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Business_Commerce_Note_Control',
				'settings'          => 'business_commerce_slider_advance_options_notice',
				'sanitize_callback' => 'business_commerce_text_sanitization',
				'label'             => esc_html__( 'Slider Advance Options', 'business-commerce-lite' ),
				'section'           => 'business_commerce_ss_slider',
				'active_callback'   => array( $this, 'is_slider_visible' ),
				'transport'         => 'postMessage',
			)
		);

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Business_Commerce_Toggle_Switch_Custom_control',
				'settings'          => 'business_commerce_slider_autoplay',
				'sanitize_callback' => 'business_commerce_switch_sanitization',
				'label'             => esc_html__( 'Autoplay', 'business-commerce-lite' ),
				'section'           => 'business_commerce_ss_slider',
				'active_callback'   => array( $this, 'is_slider_visible' ),
			)
		);

		Business_Commerce_Customizer_Utilities::register_option(
			array(
				'settings'          => 'business_commerce_slider_autoplay_delay',
				'type'              => 'number',
				'sanitize_callback' => 'absint',
				'label'             => esc_html__( 'Autoplay Delay', 'business-commerce-lite' ),
				'description'       => esc_html__( '(in ms)', 'business-commerce-lite' ),
				'section'           => 'business_commerce_ss_slider',
				'input_attrs'           => array(
					'width' => '10px',
				),
				'active_callback'   => array( $this, 'is_slider_autoplay_on' ),
			)
		);
	}

	/**
	 * Slider visibility active callback.
	 */
	public function is_slider_visible( $control ) {
		return ( business_commerce_display_section( $control->manager->get_setting( 'business_commerce_slider_visibility' )->value() ) );
	}

	/**
	 * Slider autoplay check.
	 */
	public function is_slider_autoplay_on( $control ) {
		return ( $this->is_slider_visible( $control ) && $control->manager->get_setting( 'business_commerce_slider_autoplay' )->value() );
	}
}

/**
 * Initialize class
 */
$business_commerce_ss_slider = new Business_Commerce_Slider_Options();
