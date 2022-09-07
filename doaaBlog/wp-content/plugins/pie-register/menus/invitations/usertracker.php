<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php 
$piereg = get_option(OPTION_PIE_REGISTER);
$_disable = false;
if(!$this->piereg_pro_is_activate)  {
  $_disable       = true;
}
if ( !current_user_can('piereg_manage_cap') )
{
  wp_redirect(esc_url_raw("admin.php?page=pie-invitation-codes"));
}
?>
<fieldset class="piereg_fieldset_area-nobg pr-user-tracker pr-allow-user-invitation-menu" <?php disabled($_disable, true, true); ?>>
<form method="post" action="" name="pie_invite_sent" id="pie_invite_sent" enctype="multipart/form-data">
<?php if( function_exists( 'wp_nonce_field' )) wp_nonce_field( 'piereg_wp_invitation_code_nonce','piereg_invitation_code_nonce'); ?>
<h3><?php echo esc_html_e('Track Users','pie-register'); ?></h3>
<ul class="clearfix invite-form pr-user-tracker-menu">
<?php if(!$this->piereg_pro_is_activate ){ ?>
  <h3 class="inactive-promessage"><?php esc_html_e("Available in premium version","pie-register");?></h3>
<?php }?>
<div class="user-tracker-search-box-container" style="width: 100%; margin: 20px 0;">
    <div class="user-tracker-search-box">
        <input $_disable type="text" name="user-tracker-search-input" class="user-tracker-search-input" value="<?php echo isset($this->pie_post_array['user-tracker-search-input']) ? esc_attr($this->pie_post_array['user-tracker-search-input']) : ''; ?>" placeholder="Search By Code Name..">
        <button class="user-tracker-search-button">
            <img title="Search" alt="Search" src="<?php echo esc_url(plugins_url("../../assets/images/search.png",__FILE__)); ?>">
        </button>
    </div>
</div>
<?php 
if($this->piereg_pro_is_activate)  
{
  $Pie_Invitation_Table = new Pie_Invitation_Table();
  $Pie_Invitation_Table->set_order();
  $Pie_Invitation_Table->set_orderby();
  $Pie_Invitation_Table->prepare_items();
  $Pie_Invitation_Table->display();
}
?>
</ul>
</form>
</fieldset>