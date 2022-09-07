<?php
	if ( ! function_exists( 'vw_kids_store_setup' ) ) :

	function vw_kids_store_setup() {
		$GLOBALS['content_width'] = apply_filters( 'vw_kids_store_content_width', 640 );
		
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'woocommerce' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', ) );
		add_theme_support( 'custom-logo', array(
			'height'      => 240,
			'width'       => 240,
			'flex-height' => true,
		) );

		add_theme_support( 'custom-background', array(
			'default-color' => 'f1f1f1'
		) );

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		add_editor_style( array( 'css/editor-style.css', vw_kids_font_url() ) );

		// Theme Activation Notice
		global $pagenow;

		if (is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] )) {
			add_action('admin_notices', 'vw_kids_store_activation_notice');
		}
	}
	endif;

	add_action( 'after_setup_theme', 'vw_kids_store_setup' );

	// Notice after Theme Activation
	function vw_kids_store_activation_notice() {
		echo '<div class="notice notice-success is-dismissible welcome-notice">';
			echo '<p>'. esc_html__( 'Thank you for choosing VW Kids Store Theme. Would like to have you on our Welcome page so that you can reap all the benefits of our VW Kids Store Theme.', 'vw-kids-store' ) .'</p>';
			echo '<span><a href="'. esc_url( admin_url( 'themes.php?page=vw_kids_store_guide' ) ) .'" class="button button-primary">'. esc_html__( 'GET STARTED', 'vw-kids-store' ) .'</a></span>';
			echo '<span class="demo-btn"><a href="'. esc_url( 'https://www.vwthemes.net/vw-kids-store/' ) .'" class="button button-primary" target=_blank>'. esc_html__( 'VIEW DEMO', 'vw-kids-store' ) .'</a></span>';
			echo '<span class="upgrade-btn"><a href="'. esc_url( 'https://www.vwthemes.com/themes/toy-store-wordpress-theme/' ) .'" class="button button-primary" target=_blank>'. esc_html__( 'UPGRADE PRO', 'vw-kids-store' ) .'</a></span>';
		echo '</div>';
	}

	add_action( 'wp_enqueue_scripts', 'vw_kids_store_enqueue_styles' );
	function vw_kids_store_enqueue_styles() {
    	$parent_style = 'vw-kids-basic-style'; // Style handle of parent theme.
    	
		wp_enqueue_style( 'bootstrap-style', esc_url(get_template_directory_uri()).'/assets/css/bootstrap.css' );
		wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'vw-kids-store-style', get_stylesheet_uri(), array( $parent_style ) );
		require get_parent_theme_file_path( '/inline-style.php' );
		wp_add_inline_style( 'vw-kids-store-style',$vw_kids_custom_css );
		require get_theme_file_path( '/inline-style.php' );
		wp_add_inline_style( 'vw-kids-store-style',$vw_kids_custom_css );
		wp_enqueue_style( 'vw-kids-store-block-style', get_theme_file_uri('/assets/css/blocks.css') );
		wp_enqueue_style( 'vw-kids-store-block-patterns-style-frontend', get_theme_file_uri('/inc/block-patterns/css/block-frontend.css') );
		wp_enqueue_style( 'owl.carousel-style', esc_url(get_theme_file_uri()).'/assets/css/owl.carousel.css' );
		wp_enqueue_script( 'owl.carousel-js', esc_url(get_theme_file_uri()). '/assets/js/owl.carousel.js', array('jquery') ,'',true);
		wp_enqueue_script( 'vw-kids-store-custom-scripts-jquery', esc_url(get_theme_file_uri()) . '/assets/js/custom.js', array('jquery'),'' ,true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
			
	add_action( 'init', 'vw_kids_store_remove_parent_function');
	function vw_kids_store_remove_parent_function() {
		remove_action( 'admin_notices', 'vw_kids_activation_notice' );
		remove_action( 'admin_menu', 'vw_kids_gettingstarted' );
	}

	function vw_kids_store_customize_register() {
		global $wp_customize;
		$wp_customize->remove_section( 'vw_kids_upgrade_pro_link' );
		$wp_customize->remove_section( 'vw_kids_get_started_link' );		
	}
	add_action( 'customize_register', 'vw_kids_store_customize_register', 11 );

	define('VW_KIDS_STORE_FREE_THEME_DOC',__('https://www.vwthemesdemo.com/docs/free-vw-kids-store/','vw-kids-store'));
	define('VW_KIDS_STORE_SUPPORT',__('https://wordpress.org/support/theme/vw-kids-store/','vw-kids-store'));
	define('VW_KIDS_STORE_REVIEW',__('https://wordpress.org/support/theme/vw-kids-store/reviews','vw-kids-store'));
	define('VW_KIDS_STORE_BUY_NOW',__('https://www.vwthemes.com/themes/toy-store-wordpress-theme/','vw-kids-store'));
	define('VW_KIDS_STORE_LIVE_DEMO',__('https://www.vwthemes.net/vw-kids-store/','vw-kids-store'));
	define('VW_KIDS_STORE_PRO_DOC',__('https://www.vwthemesdemo.com/docs/vw-kids-store-pro/','vw-kids-store'));
	define('VW_KIDS_STORE_FAQ',__('https://www.vwthemes.com/faqs/','vw-kids-store'));
	define('VW_KIDS_STORE_CONTACT',__('https://www.vwthemes.com/contact/','vw-kids-store'));
	define('VW_KIDS_STORE_CHILD_THEME',__('https://developer.wordpress.org/themes/advanced-topics/child-themes/','vw-kids-store'));
	define('VW_KIDS_STORE_CREDIT',__('https://www.vwthemes.com/themes/free-kids-store-wordpress-theme/','vw-kids-store'));

	if ( ! function_exists( 'vw_kids_store_credit' ) ) {
		function vw_kids_store_credit(){
			echo "<a href=".esc_url(VW_KIDS_STORE_CREDIT)." target='_blank'>". esc_html__('Kids Store WordPress Theme','vw-kids-store') ."</a>";
		}
	}

	/**
	 * Enqueue block editor style
	 */
	function vw_kids_store_block_editor_styles() {
		wp_enqueue_style( 'vw-kids-store-font', vw_kids_font_url(), array() );
	    wp_enqueue_style( 'vw-kids-store-block-patterns-style-editor', get_theme_file_uri( '/inc/block-patterns/css/block-editor.css' ), false, '1.0', 'all' );
	}
	add_action( 'enqueue_block_editor_assets', 'vw_kids_store_block_editor_styles' );

	function vw_kids_store_sanitize_choices( $input, $setting ) {
	    global $wp_customize; 
	    $control = $wp_customize->get_control( $setting->id ); 
	    if ( array_key_exists( $input, $control->choices ) ) {
	        return $input;
	    } else {
	        return $setting->default;
	    }
	}

	function vw_kids_store_sanitize_dropdown_pages( $page_id, $setting ) {
	  	$page_id = absint( $page_id );
	  	return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
	}

	/* Theme Widgets Setup */

	function vw_kids_store_widgets_init() {
		register_sidebar( array(
			'name'          => __( 'Footer Navigation 1', 'vw-kids-store' ),
			'description'   => __( 'Appears on footer 1', 'vw-kids-store' ),
			'id'            => 'footer-1',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => __( 'Footer Navigation 2', 'vw-kids-store' ),
			'description'   => __( 'Appears on footer 2', 'vw-kids-store' ),
			'id'            => 'footer-2',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => __( 'Footer Navigation 3', 'vw-kids-store' ),
			'description'   => __( 'Appears on footer 3', 'vw-kids-store' ),
			'id'            => 'footer-3',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => __( 'Footer Navigation 4', 'vw-kids-store' ),
			'description'   => __( 'Appears on footer 4', 'vw-kids-store' ),
			'id'            => 'footer-4',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}
	add_action( 'widgets_init', 'vw_kids_store_widgets_init' );

// Customizer Pro
load_template( ABSPATH . WPINC . '/class-wp-customize-section.php' );

class VW_Kids_Store_Customize_Section_Pro extends WP_Customize_Section {
	public $type = 'vw-kids-store';
	public $pro_text = '';
	public $pro_url = '';
	public function json() {
		$json = parent::json();
		$json['pro_text'] = $this->pro_text;
		$json['pro_url']  = esc_url( $this->pro_url );
		return $json;
	}
	protected function render_template() { ?>
		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
			<h3 class="accordion-section-title">
				{{ data.title }}
				<# if ( data.pro_text && data.pro_url ) { #>
					<a href="{{ data.pro_url }}" class="button button-secondary alignright" target="_blank">{{ data.pro_text }}</a>
				<# } #>
			</h3>
		</li>
	<?php }
}

final class VW_Kids_Store_Customize {
	public static function get_instance() {
		static $instance = null;
		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}
		return $instance;
	}
	private function __construct() {}
	private function setup_actions() {
		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );
		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}
	public function sections( $manager ) {
		// Register custom section types.
		$manager->register_section_type( 'VW_Kids_Store_Customize_Section_Pro' );
		// Register sections.
		$manager->add_section( new VW_Kids_Store_Customize_Section_Pro( $manager, 'vw_kids_store_upgrade_pro_link',
		array(
			'priority'   => 1,
			'title'    => esc_html__( 'VW KIDS STORE PRO', 'vw-kids-store' ),
			'pro_text' => esc_html__( 'UPGRADE PRO', 'vw-kids-store' ),
			'pro_url'  => esc_url('https://www.vwthemes.com/themes/toy-store-wordpress-theme/'),
		)));

		// Register sections.
		$manager->add_section(new VW_Kids_Store_Customize_Section_Pro($manager,'vw_kids_store2',array(
			'priority'   => 1,
			'title'    => esc_html__( 'DOCUMENTATION', 'vw-kids-store' ),
			'pro_text' => esc_html__( 'DOCS', 'vw-kids-store' ),
			'pro_url'  => esc_url('https://www.vwthemesdemo.com/docs/free-vw-kids-store/'),
		)));
	}
	public function enqueue_control_scripts() {
		wp_enqueue_script( 'vw-kids-store-customize-controls', get_stylesheet_directory_uri() . '/assets/js/customize-controls-child.js', array( 'customize-controls' ) );
		wp_enqueue_style( 'vw-kids-store-customize-controls', get_stylesheet_directory_uri() . '/assets/css/customize-controls-child.css' );
	}
}
VW_Kids_Store_Customize::get_instance();

/* getstart */
require get_theme_file_path('/inc/getstart/getstart.php');

/* TGM */
require get_theme_file_path('/inc/tgm/tgm.php');

/* Block Pattern */
require get_theme_file_path('/inc/block-patterns/block-patterns.php');

/* Plugin Activation */
require get_theme_file_path('/inc/getstart/plugin-activation.php');