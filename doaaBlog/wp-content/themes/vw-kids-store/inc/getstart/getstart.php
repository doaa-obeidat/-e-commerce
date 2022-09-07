<?php
//about theme info
add_action( 'admin_menu', 'vw_kids_store_gettingstarted' );
function vw_kids_store_gettingstarted() {    	
	add_theme_page( esc_html__('About VW Kids Store', 'vw-kids-store'), esc_html__('About VW Kids Store', 'vw-kids-store'), 'edit_theme_options', 'vw_kids_store_guide', 'vw_kids_store_mostrar_guide');
}

// Add a Custom CSS file to WP Admin Area
function vw_kids_store_admin_theme_style() {
   wp_enqueue_style('vw-kids-store-custom-admin-style', get_theme_file_uri() . '/inc/getstart/getstart.css');
   wp_enqueue_script('vw-kids-store-tabs', get_theme_file_uri() . '/inc/getstart/js/tab.js');
}
add_action('admin_enqueue_scripts', 'vw_kids_store_admin_theme_style');

//guidline for about theme
function vw_kids_store_mostrar_guide() { 
	//custom function about theme customizer
	$return = add_query_arg( array()) ;
	$theme = wp_get_theme( 'vw-kids-store' );
?>

<div class="wrapper-info">
	<div class="col-left">
		<h2><?php esc_html_e( 'Welcome to VW Kids Store Theme', 'vw-kids-store' ); ?> <span class="version"><?php esc_html_e( 'Version', 'vw-kids-store' ); ?>: <?php echo esc_html($theme['Version']);?></span></h2>
		<p><?php esc_html_e('All our WordPress themes are modern, minimalist, 100% responsive, seo-friendly,feature-rich, and multipurpose that best suit designers, bloggers and other professionals who are working in the creative fields.','vw-kids-store'); ?></p>
	</div>

	<div class="col-right">
    	<div class="logo">
			<img src="<?php echo esc_url(get_theme_file_uri()); ?>/inc/getstart/images/final-logo.png" alt="" />
		</div>
		<div class="update-now">
			<h4><?php esc_html_e('Buy VW Kids Store at 20% Discount','vw-kids-store'); ?></h4>
			<h4><?php esc_html_e('Use Coupon','vw-kids-store'); ?> ( <span><?php esc_html_e('vwpro20','vw-kids-store'); ?></span> ) </h4> 
			<div class="info-link">
				<a href="<?php echo esc_url( VW_KIDS_STORE_BUY_NOW ); ?>" target="_blank"> <?php esc_html_e( 'Upgrade to Pro', 'vw-kids-store' ); ?></a>
			</div>
		</div>
   </div>

 	<div class="tab-sec">
		<div class="tab">
		  	<button class="tablinks" onclick="vw_kids_store_open_tab(event, 'lite_theme')"><?php esc_html_e( 'Setup With Customizer', 'vw-kids-store' ); ?></button>
		  	<button class="tablinks" onclick="vw_kids_store_open_tab(event, 'block_pattern')"><?php esc_html_e( 'Setup With Block Pattern', 'vw-kids-store' ); ?></button>
			<button class="tablinks" onclick="vw_kids_store_open_tab(event, 'gutenberg_editor')"><?php esc_html_e( 'Setup With Gutunberg Block', 'vw-kids-store' ); ?></button>
			<button class="tablinks" onclick="vw_kids_store_open_tab(event, 'product_addons_editor')"><?php esc_html_e( 'Woocommerce Product Addons', 'vw-kids-store' ); ?></button>
			<button class="tablinks" onclick="vw_kids_store_open_tab(event, 'theme_pro')"><?php esc_html_e( 'Get Premium', 'vw-kids-store' ); ?></button>
		  	<button class="tablinks" onclick="vw_kids_store_open_tab(event, 'free_pro')"><?php esc_html_e( 'Support', 'vw-kids-store' ); ?></button>
		</div>

		<?php
			$vw_kids_store_plugin_custom_css = '';
			if(class_exists('Ibtana_Visual_Editor_Menu_Class')){
				$vw_kids_store_plugin_custom_css ='display: block';
			}
		?>
		<div id="lite_theme" class="tabcontent open">
			<?php if(!class_exists('Ibtana_Visual_Editor_Menu_Class')){ 
				$plugin_ins = VW_Kids_Store_Plugin_Activation_Settings::get_instance();
				$vw_kids_store_actions = $plugin_ins->recommended_actions;
				?>
				<div class="vw-kids-store-recommended-plugins">
				    <div class="vw-kids-store-action-list">
				        <?php if ($vw_kids_store_actions): foreach ($vw_kids_store_actions as $key => $vw_kids_store_actionValue): ?>
				                <div class="vw-kids-store-action" id="<?php echo esc_attr($vw_kids_store_actionValue['id']);?>">
			                        <div class="action-inner">
			                           <h3 class="action-title"><?php echo esc_html($vw_kids_store_actionValue['title']); ?></h3>
			                           <div class="action-desc"><?php echo esc_html($vw_kids_store_actionValue['desc']); ?></div>
			                           <?php echo wp_kses_post($vw_kids_store_actionValue['link']); ?>
			                           <a class="ibtana-skip-btn" get-start-tab-id="lite-theme-tab" href="javascript:void(0);"><?php esc_html_e('Skip','vw-kids-store'); ?></a>
			                        </div>
				                </div>
				            <?php endforeach;
				        endif; ?>
				    </div>
				</div>
			<?php } ?>
			<div class="lite-theme-tab" style="<?php echo esc_attr($vw_kids_store_plugin_custom_css); ?>">
				<h3><?php esc_html_e( 'Lite Theme Information', 'vw-kids-store' ); ?></h3>
				<hr class="h3hr">
			  	<p><?php esc_html_e('VW Kids Store is a free WordPress theme ideal for kids and baby shops, kids toy stores, childrens clothing, baby products, and more. This is a wonderful theme with an elegant and colorful design with the desired minimal approach. Crafted by a WordPress expert, it has a sophisticated design and a clean layout depicting every detail with precision and clarity. It is made retina-ready to publish crystal clear images of your products. Its user-friendly interface is great for everyone irrespective of the coding skills possessed. This beautiful theme comes with a responsive layout making your website look and work fabulously across every device including smartphones and gives your visitors a stunning viewing experience. To add more professional appeal to your website, you get the option to add a custom logo. As far as personalization options are concerned, you will get choices for colors, fonts, and typography. Developers have taken care of the conversion part and interactive part simultaneously and have included the Call to Action Button (CTA) for the same. Highly secure and clean codes that are also optimized will result in a lightweight design giving you faster page load time. SEO Friendly codes result in higher ranks in SERP and eventually, you get more traffic to your website.','vw-kids-store'); ?></p>
			  	<div class="col-left-inner">
			  		<h4><?php esc_html_e( 'Theme Documentation', 'vw-kids-store' ); ?></h4>
					<p><?php esc_html_e( 'If you need any assistance regarding setting up and configuring the Theme, our documentation is there.', 'vw-kids-store' ); ?></p>
					<div class="info-link">
						<a href="<?php echo esc_url( VW_KIDS_STORE_FREE_THEME_DOC ); ?>" target="_blank"> <?php esc_html_e( 'Documentation', 'vw-kids-store' ); ?></a>
					</div>
					<hr>
					<h4><?php esc_html_e('Theme Customizer', 'vw-kids-store'); ?></h4>
					<p> <?php esc_html_e('To begin customizing your website, start by clicking "Customize".', 'vw-kids-store'); ?></p>
					<div class="info-link">
						<a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e('Customizing', 'vw-kids-store'); ?></a>
					</div>
					<hr>				
					<h4><?php esc_html_e('Having Trouble, Need Support?', 'vw-kids-store'); ?></h4>
					<p> <?php esc_html_e('Our dedicated team is well prepared to help you out in case of queries and doubts regarding our theme.', 'vw-kids-store'); ?></p>
					<div class="info-link">
						<a href="<?php echo esc_url( VW_KIDS_STORE_SUPPORT ); ?>" target="_blank"><?php esc_html_e('Support Forum', 'vw-kids-store'); ?></a>
					</div>
					<hr>
					<h4><?php esc_html_e('Reviews & Testimonials', 'vw-kids-store'); ?></h4>
					<p> <?php esc_html_e('All the features and aspects of this WordPress Theme are phenomenal. I\'d recommend this theme to all.', 'vw-kids-store'); ?>  </p>
					<div class="info-link">
						<a href="<?php echo esc_url( VW_KIDS_STORE_REVIEW ); ?>" target="_blank"><?php esc_html_e('Reviews', 'vw-kids-store'); ?></a>
					</div>

					<div class="link-customizer">
						<h3><?php esc_html_e( 'Link to customizer', 'vw-kids-store' ); ?></h3>
						<hr class="h3hr">
						<div class="first-row">
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-buddicons-buddypress-logo"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>" target="_blank"><?php esc_html_e('Upload your logo','vw-kids-store'); ?></a>
								</div>
								<div class="row-box2">
									<span class="dashicons dashicons-slides"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_kids_slidersettings') ); ?>" target="_blank"><?php esc_html_e('Slider Section','vw-kids-store'); ?></a>
								</div>
							</div>

							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-admin-generic"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_kids_left_right') ); ?>" target="_blank"><?php esc_html_e('General Settings','vw-kids-store'); ?></a>
								</div>
								<div class="row-box2">
									<span class="dashicons dashicons-text-page"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_kids_footer') ); ?>" target="_blank"><?php esc_html_e('Footer Text','vw-kids-store'); ?></a>
								</div>
							</div>

							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-format-gallery"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_kids_post_settings') ); ?>" target="_blank"><?php esc_html_e('Post settings','vw-kids-store'); ?></a>
								</div>
								 <div class="row-box2">
									<span class="dashicons dashicons-align-center"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_kids_woocommerce_section') ); ?>" target="_blank"><?php esc_html_e('WooCommerce Layout','vw-kids-store'); ?></a>
								</div> 
							</div>
							
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-menu"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>" target="_blank"><?php esc_html_e('Menus','vw-kids-store'); ?></a>
								</div>
								 <div class="row-box2">
									<span class="dashicons dashicons-screenoptions"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=widgets') ); ?>" target="_blank"><?php esc_html_e('Footer Widget','vw-kids-store'); ?></a>
								</div> 
							</div>
						</div>
					</div>

			  	</div>
				<div class="col-right-inner">
					<h3 class="page-template"><?php esc_html_e('How to set up Home Page Template','vw-kids-store'); ?></h3>
				  	<hr class="h3hr">
					<p><?php esc_html_e('Follow these instructions to setup Home page.','vw-kids-store'); ?></p>
	                <ul>
	                  	<p><span class="strong"><?php esc_html_e('1. Create a new page :','vw-kids-store'); ?></span><?php esc_html_e(' Go to ','vw-kids-store'); ?>
					  	<b><?php esc_html_e(' Dashboard >> Pages >> Add New Page','vw-kids-store'); ?></b></p>

	                  	<p><?php esc_html_e('Name it as "Home" then select the template "Custom Home Page".','vw-kids-store'); ?></p>
	                  	<img src="<?php echo esc_url(get_theme_file_uri()); ?>/inc/getstart/images/home-page-template.png" alt="" />
	                  	<p><span class="strong"><?php esc_html_e('2. Set the front page:','vw-kids-store'); ?></span><?php esc_html_e(' Go to ','vw-kids-store'); ?>
					  	<b><?php esc_html_e(' Settings >> Reading ','vw-kids-store'); ?></b></p>
					  	<p><?php esc_html_e('Select the option of Static Page, now select the page you created to be the homepage, while another page to be your default page.','vw-kids-store'); ?></p>
	                  	<img src="<?php echo esc_url(get_theme_file_uri()); ?>/inc/getstart/images/set-front-page.png" alt="" />
	                  	<p><?php esc_html_e(' Once you are done with this, then follow the','vw-kids-store'); ?> <a class="doc-links" href="https://www.vwthemesdemo.com/docs/free-vw-kids-store/" target="_blank"><?php esc_html_e('Documentation','vw-kids-store'); ?></a></p>
	                </ul>
			  	</div>
			</div>
		</div>

		<div id="block_pattern" class="tabcontent">
			<?php if(!class_exists('Ibtana_Visual_Editor_Menu_Class')){ 
				$plugin_ins = VW_Kids_Store_Plugin_Activation_Settings::get_instance();
				$vw_kids_store_actions = $plugin_ins->recommended_actions;
				?>
				<div class="vw-kids-store-recommended-plugins">
				    <div class="vw-kids-store-action-list">
				        <?php if ($vw_kids_store_actions): foreach ($vw_kids_store_actions as $key => $vw_kids_store_actionValue): ?>
				                <div class="vw-kids-store-action" id="<?php echo esc_attr($vw_kids_store_actionValue['id']);?>">
			                        <div class="action-inner">
			                            <h3 class="action-title"><?php echo esc_html($vw_kids_store_actionValue['title']); ?></h3>
			                            <div class="action-desc"><?php echo esc_html($vw_kids_store_actionValue['desc']); ?></div>
			                            <?php echo wp_kses_post($vw_kids_store_actionValue['link']); ?>
			                            <a class="ibtana-skip-btn" href="javascript:void(0);" get-start-tab-id="gutenberg-editor-tab"><?php esc_html_e('Skip','vw-kids-store'); ?></a>
			                        </div>
				                </div>
				            <?php endforeach;
				        endif; ?>
				    </div>
				</div>
			<?php } ?>
			<div class="gutenberg-editor-tab" style="<?php echo esc_attr($vw_kids_store_plugin_custom_css); ?>">
				<div class="block-pattern-img">
				  	<h3><?php esc_html_e( 'Block Patterns', 'vw-kids-store' ); ?></h3>
					<hr class="h3hr">
					<p><?php esc_html_e('Follow the below instructions to setup Home page with Block Patterns.','vw-kids-store'); ?></p>
	              	<p><b><?php esc_html_e('Click on Below Add new page button >> Click on "+" Icon >> Click Pattern Tab >> Click on homepage sections >> Publish.','vw-kids-store'); ?></span></b></p>
	              	<div class="vw-kids-store-pattern-page">
				    	<a href="javascript:void(0)" class="vw-pattern-page-btn button-primary button"><?php esc_html_e('Add New Page','vw-kids-store'); ?></a>
				    </div>
	              	<img src="<?php echo esc_url(get_theme_file_uri()); ?>/inc/getstart/images/block-pattern.png" alt="" />	
	            </div>	

	            <div class="block-pattern-link-customizer">
	              	<div class="link-customizer-with-block-pattern">
							<h3><?php esc_html_e( 'Link to customizer', 'vw-kids-store' ); ?></h3>
							<hr class="h3hr">
							<div class="first-row">
								<div class="row-box">
									<div class="row-box1">
										<span class="dashicons dashicons-buddicons-buddypress-logo"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>" target="_blank"><?php esc_html_e('Upload your logo','vw-kids-store'); ?></a>
									</div>
									<div class="row-box2">
										<span class="dashicons dashicons-networking"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_kids_social_icon_settings') ); ?>" target="_blank"><?php esc_html_e('Social Icons','vw-kids-store'); ?></a>
									</div>
								</div>
								<div class="row-box">
									<div class="row-box1">
										<span class="dashicons dashicons-menu"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>" target="_blank"><?php esc_html_e('Menus','vw-kids-store'); ?></a>
									</div>
									
									<div class="row-box2">
										<span class="dashicons dashicons-text-page"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_kids_footer') ); ?>" target="_blank"><?php esc_html_e('Footer Text','vw-kids-store'); ?></a>
									</div>
								</div>

								<div class="row-box">
									<div class="row-box1">
										<span class="dashicons dashicons-format-gallery"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_kids_post_settings') ); ?>" target="_blank"><?php esc_html_e('Post settings','vw-kids-store'); ?></a>
									</div>
									 <div class="row-box2">
										<span class="dashicons dashicons-align-center"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_kids_woocommerce_section') ); ?>" target="_blank"><?php esc_html_e('WooCommerce Layout','vw-kids-store'); ?></a>
									</div> 
								</div>
								
								<div class="row-box">
									<div class="row-box1">
										<span class="dashicons dashicons-admin-generic"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_kids_left_right') ); ?>" target="_blank"><?php esc_html_e('General Settings','vw-kids-store'); ?></a>
									</div>
									 <div class="row-box2">
										<span class="dashicons dashicons-screenoptions"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=widgets') ); ?>" target="_blank"><?php esc_html_e('Footer Widget','vw-kids-store'); ?></a>
									</div> 
								</div>
							</div>
					</div>	
				</div>		
	        </div>
		</div>

		<div id="gutenberg_editor" class="tabcontent">
			<?php if(!class_exists('Ibtana_Visual_Editor_Menu_Class')){ 
			$plugin_ins = VW_Kids_Store_Plugin_Activation_Settings::get_instance();
			$vw_kids_store_actions = $plugin_ins->recommended_actions;
			?>
				<div class="vw-kids-store-recommended-plugins">
				    <div class="vw-kids-store-action-list">
				        <?php if ($vw_kids_store_actions): foreach ($vw_kids_store_actions as $key => $vw_kids_store_actionValue): ?>
				                <div class="vw-kids-store-action" id="<?php echo esc_attr($vw_kids_store_actionValue['id']);?>">
			                        <div class="action-inner plugin-activation-redirect">
			                            <h3 class="action-title"><?php echo esc_html($vw_kids_store_actionValue['title']); ?></h3>
			                            <div class="action-desc"><?php echo esc_html($vw_kids_store_actionValue['desc']); ?></div>
			                            <?php echo wp_kses_post($vw_kids_store_actionValue['link']); ?>
			                        </div>
				                </div>
				            <?php endforeach;
				        endif; ?>
				    </div>
				</div>
			<?php }else{ ?>
				<h3><?php esc_html_e( 'Gutunberg Blocks', 'vw-kids-store' ); ?></h3>
				<hr class="h3hr">
				<div class="vw-kids-store-pattern-page">
			    	<a href="<?php echo esc_url( admin_url( 'admin.php?page=ibtana-visual-editor-templates' ) ); ?>" class="vw-pattern-page-btn ibtana-dashboard-page-btn button-primary button"><?php esc_html_e('Ibtana Settings','vw-kids-store'); ?></a>
			   </div>

			   <div class="link-customizer-with-guternberg-ibtana">
					<h3><?php esc_html_e( 'Link to customizer', 'vw-kids-store' ); ?></h3>
					<hr class="h3hr">
					<div class="first-row">
						<div class="row-box">
							<div class="row-box1">
								<span class="dashicons dashicons-buddicons-buddypress-logo"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>" target="_blank"><?php esc_html_e('Upload your logo','vw-kids-store'); ?></a>
							</div>
							<div class="row-box2">
								<span class="dashicons dashicons-networking"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_kids_social_icon_settings') ); ?>" target="_blank"><?php esc_html_e('Social Icons','vw-kids-store'); ?></a>
							</div>
						</div>
						<div class="row-box">
							<div class="row-box1">
								<span class="dashicons dashicons-menu"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>" target="_blank"><?php esc_html_e('Menus','vw-kids-store'); ?></a>
							</div>
							
							<div class="row-box2">
								<span class="dashicons dashicons-text-page"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_kids_footer') ); ?>" target="_blank"><?php esc_html_e('Footer Text','vw-kids-store'); ?></a>
							</div>
						</div>

						<div class="row-box">
							<div class="row-box1">
								<span class="dashicons dashicons-format-gallery"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_kids_post_settings') ); ?>" target="_blank"><?php esc_html_e('Post settings','vw-kids-store'); ?></a>
							</div>
							 <div class="row-box2">
								<span class="dashicons dashicons-align-center"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_kids_woocommerce_section') ); ?>" target="_blank"><?php esc_html_e('WooCommerce Layout','vw-kids-store'); ?></a>
							</div> 
						</div>
						
						<div class="row-box">
							<div class="row-box1">
								<span class="dashicons dashicons-admin-generic"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_kids_left_right') ); ?>" target="_blank"><?php esc_html_e('General Settings','vw-kids-store'); ?></a>
							</div>
							 <div class="row-box2">
								<span class="dashicons dashicons-screenoptions"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=widgets') ); ?>" target="_blank"><?php esc_html_e('Footer Widget','vw-kids-store'); ?></a>
							</div> 
						</div>
					</div>
				</div>
			<?php } ?>
		</div>

		<div id="product_addons_editor" class="tabcontent">
			<?php if(!class_exists('IEPA_Loader')){
				$plugin_ins = VW_Kids_Store_Plugin_Activation_Woo_Products::get_instance();
				$vw_kids_store_actions = $plugin_ins->recommended_actions;
				?>
				<div class="vw-kids-store-recommended-plugins">
					    <div class="vw-kids-store-action-list">
					        <?php if ($vw_kids_store_actions): foreach ($vw_kids_store_actions as $key => $vw_kids_store_actionValue): ?>
					                <div class="vw-kids-store-action" id="<?php echo esc_attr($vw_kids_store_actionValue['id']);?>">
				                        <div class="action-inner plugin-activation-redirect">
				                            <h3 class="action-title"><?php echo esc_html($vw_kids_store_actionValue['title']); ?></h3>
				                            <div class="action-desc"><?php echo esc_html($vw_kids_store_actionValue['desc']); ?></div>
				                            <?php echo wp_kses_post($vw_kids_store_actionValue['link']); ?>
				                        </div>
					                </div>
					            <?php endforeach;
					        endif; ?>
					    </div>
				</div>
			<?php }else{ ?>
				<h3><?php esc_html_e( 'Woocommerce Products Blocks', 'vw-kids-store' ); ?></h3>
				<hr class="h3hr">
				<div class="vw-kids-store-pattern-page">
					<p><?php esc_html_e('Follow the below instructions to setup Products Templates.','vw-kids-store'); ?></p>
					<p><b><?php esc_html_e('1. First you need to activate these plugins','vw-kids-store'); ?></b></p>
						<p><?php esc_html_e('1. Ibtana - WordPress Website Builder ','vw-kids-store'); ?></p>
						<p><?php esc_html_e('2. Ibtana - Ecommerce Product Addons.','vw-kids-store'); ?></p>
						<p><?php esc_html_e('3. Woocommerce','vw-kids-store'); ?></p>

					<p><b><?php esc_html_e('2. Go To Dashboard >> Ibtana Settings >> Woocommerce Templates','vw-kids-store'); ?></span></b></p>
	              	<div class="vw-kids-store-pattern-page">
			    		<a href="<?php echo esc_url( admin_url( 'admin.php?page=ibtana-visual-editor-woocommerce-templates&ive_wizard_view=parent' ) ); ?>" class="vw-pattern-page-btn ibtana-dashboard-page-btn button-primary button"><?php esc_html_e('Woocommerce Templates','vw-kids-store'); ?></a>
			    	</div>
	              	<p><?php esc_html_e('You can create a template as you like.','vw-kids-store'); ?></span></p>
			    </div>
			<?php } ?>
		</div>

		<div id="theme_pro" class="tabcontent">
		  	<h3><?php esc_html_e( 'Premium Theme Information', 'vw-kids-store' ); ?></h3>
			<hr class="h3hr">
		    <div class="col-left-pro">
		    	<p><?php esc_html_e('Creating a website with children and kids in mind isn’t that easy. But with Toy Store WordPress Theme, designing a kids’ related website becomes a breeze. It is created with keeping children and young audiences in focus that love colorful and playful designs and give attention to the things that look good. This theme is not only visually appealing but also comes with useful business options that you can run your kids’ store smoothly online. WP Toy Store WordPress Theme shows quality images through an amazing full-screen slider that is designed retina-ready for displaying a wonderful slideshow. Smartly placed Call To Action Buttons (CTA) will make the overall website interactive and guides the visitors to take the next course of action thus improving conversions also. There isn’t any need to start from scratch even if you have zero coding knowledge as this theme offers you demo data that you can import in a single click and start your online journey within minutes.','vw-kids-store'); ?></p>
		    	<div class="pro-links">
			    	<a href="<?php echo esc_url( VW_KIDS_STORE_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'vw-kids-store'); ?></a>
					<a href="<?php echo esc_url( VW_KIDS_STORE_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Buy Pro', 'vw-kids-store'); ?></a>
					<a href="<?php echo esc_url( VW_KIDS_STORE_PRO_DOC ); ?>" target="_blank"><?php esc_html_e('Pro Documentation', 'vw-kids-store'); ?></a>
				</div>
		    </div>
		    <div class="col-right-pro">
		    	<img src="<?php echo esc_url(get_theme_file_uri()); ?>/inc/getstart/images/responsive.png" alt="" />
		    </div>
		    <div class="featurebox">
			    <h3><?php esc_html_e( 'Theme Features', 'vw-kids-store' ); ?></h3>
				<hr class="h3hr">
				<div class="table-image">
					<table class="tablebox">
						<thead>
							<tr>
								<th></th>
								<th><?php esc_html_e('Free Themes', 'vw-kids-store'); ?></th>
								<th><?php esc_html_e('Premium Themes', 'vw-kids-store'); ?></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?php esc_html_e('Theme Customization', 'vw-kids-store'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Responsive Design', 'vw-kids-store'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Logo Upload', 'vw-kids-store'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Social Media Links', 'vw-kids-store'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Slider Settings', 'vw-kids-store'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Number of Slides', 'vw-kids-store'); ?></td>
								<td class="table-img"><?php esc_html_e('4', 'vw-kids-store'); ?></td>
								<td class="table-img"><?php esc_html_e('Unlimited', 'vw-kids-store'); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Template Pages', 'vw-kids-store'); ?></td>
								<td class="table-img"><?php esc_html_e('3', 'vw-kids-store'); ?></td>
								<td class="table-img"><?php esc_html_e('6', 'vw-kids-store'); ?></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Home Page Template', 'vw-kids-store'); ?></td>
								<td class="table-img"><?php esc_html_e('1', 'vw-kids-store'); ?></td>
								<td class="table-img"><?php esc_html_e('1', 'vw-kids-store'); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Theme sections', 'vw-kids-store'); ?></td>
								<td class="table-img"><?php esc_html_e('2', 'vw-kids-store'); ?></td>
								<td class="table-img"><?php esc_html_e('13', 'vw-kids-store'); ?></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Contact us Page Template', 'vw-kids-store'); ?></td>
								<td class="table-img">0</td>
								<td class="table-img"><?php esc_html_e('1', 'vw-kids-store'); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Blog Templates & Layout', 'vw-kids-store'); ?></td>
								<td class="table-img">0</td>
								<td class="table-img"><?php esc_html_e('3(Full width/Left/Right Sidebar)', 'vw-kids-store'); ?></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Page Templates & Layout', 'vw-kids-store'); ?></td>
								<td class="table-img">0</td>
								<td class="table-img"><?php esc_html_e('2(Left/Right Sidebar)', 'vw-kids-store'); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Color Pallete For Particular Sections', 'vw-kids-store'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Global Color Option', 'vw-kids-store'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Section Reordering', 'vw-kids-store'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Demo Importer', 'vw-kids-store'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Allow To Set Site Title, Tagline, Logo', 'vw-kids-store'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Enable Disable Options On All Sections, Logo', 'vw-kids-store'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Full Documentation', 'vw-kids-store'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Latest WordPress Compatibility', 'vw-kids-store'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Woo-Commerce Compatibility', 'vw-kids-store'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Support 3rd Party Plugins', 'vw-kids-store'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Secure and Optimized Code', 'vw-kids-store'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Exclusive Functionalities', 'vw-kids-store'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Section Enable / Disable', 'vw-kids-store'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Section Google Font Choices', 'vw-kids-store'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Gallery', 'vw-kids-store'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Simple & Mega Menu Option', 'vw-kids-store'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Support to add custom CSS / JS ', 'vw-kids-store'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Shortcodes', 'vw-kids-store'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Custom Background, Colors, Header, Logo & Menu', 'vw-kids-store'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Premium Membership', 'vw-kids-store'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Budget Friendly Value', 'vw-kids-store'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Priority Error Fixing', 'vw-kids-store'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Custom Feature Addition', 'vw-kids-store'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('All Access Theme Pass', 'vw-kids-store'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Seamless Customer Support', 'vw-kids-store'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td></td>
								<td class="table-img"></td>
								<td class="update-link"><a href="<?php echo esc_url( VW_KIDS_STORE_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Upgrade to Pro', 'vw-kids-store'); ?></a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div id="free_pro" class="tabcontent">
		  	<div class="col-3">
		  		<h4><span class="dashicons dashicons-star-filled"></span><?php esc_html_e('Pro Version', 'vw-kids-store'); ?></h4>
				<p> <?php esc_html_e('To gain access to extra theme options and more interesting features, upgrade to pro version.', 'vw-kids-store'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( VW_KIDS_STORE_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Get Pro', 'vw-kids-store'); ?></a>
				</div>
		  	</div>
		  	<div class="col-3">
		  		<h4><span class="dashicons dashicons-cart"></span><?php esc_html_e('Pre-purchase Queries', 'vw-kids-store'); ?></h4>
				<p> <?php esc_html_e('If you have any pre-sale query, we are prepared to resolve it.', 'vw-kids-store'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( VW_KIDS_STORE_CONTACT ); ?>" target="_blank"><?php esc_html_e('Question', 'vw-kids-store'); ?></a>
				</div>
		  	</div>
		  	<div class="col-3">		  		
		  		<h4><span class="dashicons dashicons-admin-customizer"></span><?php esc_html_e('Child Theme', 'vw-kids-store'); ?></h4>
				<p> <?php esc_html_e('For theme file customizations, make modifications in the child theme and not in the main theme file.', 'vw-kids-store'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( VW_KIDS_STORE_CHILD_THEME ); ?>" target="_blank"><?php esc_html_e('About Child Theme', 'vw-kids-store'); ?></a>
				</div>
		  	</div>

		  	<div class="col-3">
		  		<h4><span class="dashicons dashicons-admin-comments"></span><?php esc_html_e('Frequently Asked Questions', 'vw-kids-store'); ?></h4>
				<p> <?php esc_html_e('We have gathered top most, frequently asked questions and answered them for your easy understanding. We will list down more as we get new challenging queries. Check back often.', 'vw-kids-store'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( VW_KIDS_STORE_FAQ ); ?>" target="_blank"><?php esc_html_e('View FAQ','vw-kids-store'); ?></a>
				</div>
		  	</div>

		  	<div class="col-3">
		  		<h4><span class="dashicons dashicons-sos"></span><?php esc_html_e('Support Queries', 'vw-kids-store'); ?></h4>
				<p> <?php esc_html_e('If you have any queries after purchase, you can contact us. We are eveready to help you out.', 'vw-kids-store'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( VW_KIDS_STORE_SUPPORT ); ?>" target="_blank"><?php esc_html_e('Contact Us', 'vw-kids-store'); ?></a>
				</div>
		  	</div>
		</div>

	</div>
</div>
<?php } ?>