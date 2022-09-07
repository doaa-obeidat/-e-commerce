<?php
/**
 * Business Commerce Theme Customizer
 *
 * @package Business Commerce Lite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function business_commerce_sortable_sections( $wp_customize ) {
	$wp_customize->add_panel( 'business_commerce_sp_sortable', array(
		'title'       => esc_html__( 'Sections', 'business-commerce-lite' ),
		'priority'    => 150,
	) );

	$default_sections = business_commerce_get_default_sortable_sections();

	$sortable_options = array();

	$sortable_order = business_commerce_gtm( 'business_commerce_ss_order' );

	if ( $sortable_order ) {
		$sortable_options = explode( ',', $sortable_order );
	}

	$sortable_sections = array_unique( $sortable_options + array_keys( $default_sections ) );

	foreach ( $sortable_sections as $section ) {
		if ( isset( $default_sections[$section] ) ) {
			// Add sections.
			$wp_customize->add_section( 'business_commerce_ss_' . $section,
				array(
					'title' => $default_sections[$section],
					'panel' => 'business_commerce_sp_sortable'
				)
			);
		}

		unset($default_sections[$section]);
	}

	if ( count( $default_sections ) ) {
		foreach ($default_sections as $key => $value) {
			// Add new sections.
			$wp_customize->add_section( 'business_commerce_ss_' . $key,
				array(
					'title' => $value,
					'panel' => 'business_commerce_sp_sortable'
				)
			);
		}
	}

	// Add hidden section for saving sorted sections.
	Business_Commerce_Customizer_Utilities::register_option(
		array(
			'settings'          => 'business_commerce_ss_order',
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Section layout', 'business-commerce-lite' ),
			'section'           => 'business_commerce_ss_main_content',
		)
	);
}
add_action( 'customize_register', 'business_commerce_sortable_sections', 1 );

/**
 * Default sortable sections order
 * @return array
 */
function business_commerce_get_default_sortable_sections() {
	return $default_sections = array (
		'slider'                => esc_html__( 'Slider', 'business-commerce-lite' ),
		'wwd'                   => esc_html__( 'What We Do', 'business-commerce-lite' ),
		'product_categories'    => esc_html__( 'Product Categories', 'business-commerce-lite' ),
		'products_listing'      => esc_html__( 'Products Listing', 'business-commerce-lite' ),
		'promotional_headline'  => esc_html__( 'Promotion Headline', 'business-commerce-lite' ),
		'featured_product'      => esc_html__( 'Featured Product', 'business-commerce-lite' ),
		'testimonial'           => esc_html__( 'Testimonials', 'business-commerce-lite' ),
	);
}
