<?php
if( file_exists( PIEREG_DIR_NAME . '/classes/registration_form.php') ) 
	require_once('classes/registration_form.php');

class Pie_Register_Widget extends WP_Widget 
{
	function __construct() 
	{
		parent::__construct(
			'pie_widget', // Base ID
			__('Pie Register - Registration Form', 'pie-register'), // Name
			array( 'description' => __( 'Display the Pie Register registration form on sidebar', 'pie-register' ), ) // Args
		);		
	}
	public function widget( $args, $instance ){
		$option = get_option(OPTION_PIE_REGISTER);
		global	$piereg_post_array;
		$this->pie_post_array	= $piereg_post_array;
		
		$pie_register = new PieRegister();
		$pie_register->piereg_ssl_template_redirect();
		if(is_user_logged_in() && !is_admin() && $option['redirect_user']==1 ){
			//do nothing here
		}elseif( (isset($instance['form_id']) && $instance['form_id'] != $pie_register->regFormForFreeVers()) ) {
			//do nothing here			
			
		}else{
			global $errors;
			$form_on_free	= get_option("piereg_form_free_id");

			$success 	= $error = '' ;
			$title 		= isset($instance['title']) ? apply_filters( 'widget_title', $instance['title'] ) : '';
			$form_id 	= isset($instance['form_id']) ? $instance['form_id'] : $form_on_free;
			$form_title = isset($instance['form_title']) ? $instance['form_title'] : '';
			$form_desc 	= isset($instance['form_desc']) ? $instance['form_desc'] : true;
			
			echo $args['before_widget'];
			
			echo('<div class="piereg_container pieregWrapper">');
			if(isset($this->pie_post_array['success']) && $this->pie_post_array['success'] != "")
				echo('<p class="piereg_message">'.apply_filters('piereg_messages',__($this->pie_post_array['success'],"pie-register")).'</p>');
				
			if(isset($this->pie_post_array['error']) && $this->pie_post_array['error'] != "")
				echo('<p class="piereg_login_error">'.apply_filters('piereg_messages',__($this->pie_post_array['error'],"pie-register")).'</p>');
			
			if(isset($this->pie_post_array['registration_success']) && $this->pie_post_array['registration_success'] != ""){
				echo('<p class="piereg_message">'.apply_filters('piereg_messages',__($this->pie_post_array['registration_success'],"pie-register")).'</p>');
				unset($_POST);
			}
			
			if(isset($errors->errors) && sizeof($errors->errors) > 0)
			{
				foreach($errors->errors as $key=>$err)
				{
					if($key != "login-error")
						$error .= $err[0] . "<br />";	
				}
				if(isset($error) && !empty($error))
					echo('<p class="piereg_login_error">'.apply_filters('piereg_messages',__($error,"pie-register")).'</p>');
			}
			 echo wp_kses($pie_register->outputRegForm(true,$form_id,$form_title,$form_desc), $pie_register->piereg_forms_get_allowed_tags());
			echo('</div>');
			echo $args['after_widget'];
			set_pr_stats("register","view");
			
		}
	}
	// Widget Backend 
	public function form( $instance ) {
		$base = new PieReg_Base();

		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Pie Registration Form', 'pie_forgot' );
		}
		$form_id = ((isset($instance['form_id']))?$instance['form_id']:"");
		$form_title = ((isset($instance['form_title']))?$instance['form_title']:"true");
		$form_desc = ((isset($instance['form_desc']))?$instance['form_desc']:"true");
		// Widget admin form
		?>
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id( 'form_id' )); ?>"><?php esc_html_e( 'Form:' );?></label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'form_id' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'form_id' )); ?>">
				<?php
                $fields_id = get_option("piereg_form_fields_id");
                for($a=1;$a<=$fields_id;$a++)
                {
                    $option = get_option("piereg_form_field_option_".$a);
                    if($option != "" && (!isset($option['IsDeleted']) || trim($option['IsDeleted']) != 1) )
                    {
						echo '<option '.selected( (!empty($form_id) && $form_id == $option['Id']), true).' value="'.esc_attr($option['Id']).'" >'.esc_html($option['Title']).'</option>';
						
						if(!$base->piereg_pro_is_activate){
							break;
						}
                    }
                }?>
            </select>
		</p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'form_title' )); ?>"><?php esc_html_e( 'Form Title:' );?></label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'form_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'form_title' )); ?>">
            <?php
		        echo '<option '.selected((!empty($form_title) && $form_title == "true"), true).' value="true" >Show</option>';
		        echo '<option '.selected((!empty($form_title) && $form_title == "false"), true).' value="false" >Hide</option>';
			?>
            </select>
		</p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'form_desc' )); ?>"><?php esc_html_e( 'Form Description:' );?></label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'form_desc' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'form_desc' )); ?>">
            <?php
		        echo '<option '.selected((!empty($form_desc) && $form_desc == "true"), true).' value="true" >Show</option>';
		        echo '<option '.selected((!empty($form_desc) && $form_desc == "false"), true).' value="false" >Hide</option>';
			?>
            </select>
		</p>
		<?php 
	}
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? wp_strip_all_tags( $new_instance['title'] ) : '';
		$instance['form_id'] = ( ! empty( $new_instance['form_id'] ) ) ? wp_strip_all_tags( $new_instance['form_id'] ) : '';
		$instance['form_title'] = ( ! empty( $new_instance['form_title'] ) ) ? wp_strip_all_tags( $new_instance['form_title'] ) : '';
		$instance['form_desc'] = ( ! empty( $new_instance['form_desc'] ) ) ? wp_strip_all_tags( $new_instance['form_desc'] ) : '';
		return $instance;
	}
}




/*
	*	Pie Register Login Widgets
*/
class Pie_Login_Widget extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() 
	{
		parent::__construct(
			'pie_login_widget', // Base ID
			__('Pie Register - Login Form', 'pie_login'), // Name
			array( 'description' => __( 'Display Pie Register Login Form on Sidebar', 'pie-register' ), ) // Args
		);		
	}
	public function widget( $args, $instance ){
		$option = get_option(OPTION_PIE_REGISTER);
		$pie_register = new PieRegister();
		$pie_register->piereg_ssl_template_redirect();
		
		echo $args['before_widget'];
		$before_title = isset($instance['before_title']) ? apply_filters( 'widget_title', $instance['before_title'] ) : '';
		$after_title  = isset($instance['after_title']) ? apply_filters( 'widget_title', $instance['after_title'] ) : '';
		$social_login = ( (isset($instance['social_login'])) ? apply_filters( 'widget_title', $instance['social_login'] ) : 0 );
		if ( !is_user_logged_in() ) 
		{
			if ( ! empty( $before_title ) )
			echo $args['before_title'] . $before_title . $args['after_title'];
			set_pr_stats("login","view");
			if( file_exists(PIEREG_DIR_NAME . "/login_form.php") )
				include_once("login_form.php");
			echo wp_kses(pieOutputLoginForm(true), $pie_register->piereg_forms_get_allowed_tags());
			if(intval($social_login) > 0 )
			{
				$social_site_data = "";
				$social_site_data .= apply_filters("get_enable_social_sites_button_widgets",$social_site_data);
				echo wp_kses($social_site_data, $pie_register->piereg_forms_get_allowed_tags());
			}
		}else{

			$current_user = wp_get_current_user();
			if ( ! empty( $after_title ) )
			echo $args['before_title'] . $after_title . $args['after_title'];
			$profile_pic_array 	= get_user_meta($current_user->ID);
			$profile_pic		= "";
			foreach($profile_pic_array as $key=>$val)
			{
				if(strpos($key,'profile_pic') !== false){
					$profile_pic = trim($val[0]);
				} 
			}
			
			$profile_pic = apply_filters("piereg_profile_image_url",$profile_pic,$current_user);
			echo '<div class="logged-In">';
			$user_avater = get_avatar(get_current_user_id(),75);
			$profile_link = get_permalink($option['alternate_profilepage']);
			$profile_avatar = ((!empty($profile_pic))?('<img src="'.esc_url($profile_pic).'" style="max-width:75px;max-height:75px;"/>'):$user_avater);
			$profile_image_html = '<a href="'.esc_url($profile_link).'">'.$profile_avatar.'</a>';
			echo wp_kses_post(apply_filters('pie_profile_image_frontend_widget',$profile_image_html,$profile_link,$profile_pic));
			////////////////////////////
			$first_name = get_user_meta($current_user->ID,"first_name",true);
			$last_name = get_user_meta($current_user->ID,"last_name",true);
			if( !empty($first_name) && !empty($last_name) )
				$profile_text = $first_name . "&nbsp;" . $last_name;
			elseif( !empty($current_user->display_name) )
				$profile_text = $current_user->display_name;
			else
				$profile_text = $current_user->user_login;
			
			$profile_text_html = '<a href="'.esc_url($profile_link) .'">' . esc_html($profile_text) . '</a>';
			echo '';
			echo '<div class="member_div"><h4>';
			echo wp_kses_post(apply_filters('pie_profile_username_frontend_widget',$profile_text_html,$profile_link,$profile_text));
			echo '</h4>';
			echo '<a href="'.esc_url(wp_logout_url()).'" class="logout-link" title="Logout">'.__("Logout","pie-register").'</a></div></div>';
		}
		echo $args['after_widget'];
	}
	// Widget Backend 
	public function form( $instance ) {
		if ( isset( $instance[ 'before_title' ] ) ) {
			$before_title = $instance[ 'before_title' ];
		}
		else {
			$before_title = __( 'Pie Login', 'pie_login' );
		}
		if ( isset( $instance[ 'after_title' ] ) ) {
			$after_title = $instance[ 'after_title' ];
		}
		else {
			$after_title = __( 'Welcome User', 'pie_login' );
		}
		if ( isset( $instance[ 'social_login' ] ) ) {
			$social_login = $instance[ 'social_login' ];
		}
		else {
			$social_login = 0;
		}
		// Widget admin form
		?>
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'before_title' )); ?>"><?php esc_html_e( 'Before Login Title:' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'before_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'before_title' )); ?>" type="text" value="<?php echo esc_attr( $before_title ); ?>" />
        <label for="<?php echo esc_attr($this->get_field_id( 'after_title' )); ?>"><?php esc_html_e( 'After Login Title:' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'after_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'after_title' )); ?>" type="text" value="<?php echo esc_attr( $after_title ); ?>" />
        <?php
		if(is_plugin_active('pie-register-social-site/pie-register-social-site.php')):
		?>
            <label for="<?php echo esc_attr($this->get_field_id( 'social_login' )); ?>"><?php esc_html_e( 'Social Login:' ); ?></label> 
            <select class="widefat" name="<?php echo esc_attr($this->get_field_name( 'social_login' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'social_login' )); ?>">
                <option value="0" <?php selected( $social_login == 0, true); ?>><?php esc_html_e("Disable","pie-register"); ?></option>
                <option value="1" <?php selected( $social_login == 1, true); ?>><?php esc_html_e("Enable","pie-register"); ?></option>
            </select>
		<?php
		endif;
		?>
		</p>
		<?php 
	}
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['before_title'] = ( ! empty( $new_instance['before_title'] ) ) ? wp_strip_all_tags( $new_instance['before_title'] ) : '';
		$instance['after_title']  = ( ! empty( $new_instance['after_title'] ) ) ? wp_strip_all_tags( $new_instance['after_title'] ) : '';
		$instance['social_login'] = ( isset( $new_instance['social_login'] ) && ! empty( $new_instance['social_login'] ) ) ? intval( $new_instance['social_login'] ) : '';
		return $instance;
	}
}

class Pie_Forgot_Widget extends WP_Widget 
{
	function __construct() 
	{
		parent::__construct(
			'pie_forgot_widget', // Base ID
			__('Pie Register - Forgot Password Form', 'pie-register'), // Name
			array( 'description' => __( 'Forgot Password Form', 'pie-register' ), ) // Args
		);	

	}
	public function widget( $args, $instance ) 
	{
		$option = get_option(OPTION_PIE_REGISTER);
		$pie_register = new PieRegister();
		$pie_register->piereg_ssl_template_redirect();
		if(is_user_logged_in() && !is_admin() && $option['redirect_user']==1 ){
			//do nothing here
		}else{
			$title = (isset($instance['title']) && $instance['title']) ? $instance['title'] : __( 'Forgot password', 'pie-register' );
			echo $args['before_widget'];
			if ( ! empty( $title ) )
				echo $args['before_title'] . esc_html($title) . $args['after_title'];
			if( file_exists(PIEREG_DIR_NAME . "/forgot_password.php") )	
				include_once("forgot_password.php");
			set_pr_stats("forgot","view");
			echo wp_kses(pieResetFormOutput(true), $pie_register->piereg_forms_get_allowed_tags());
			echo $args['after_widget'];
		}
	}
	// Widget Backend 
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Forgot password', 'pie-register' );
		}
		// Widget admin form
		?>
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php echo esc_html( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php 
	}
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? wp_strip_all_tags( $new_instance['title'] ) : '';
		return $instance;
	}
}