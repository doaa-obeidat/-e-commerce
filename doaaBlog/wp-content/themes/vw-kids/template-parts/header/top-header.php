<?php
/**
 * The template part for top header
 *
 * @package VW Kids 
 * @subpackage vw_kids
 * @since VW Kids 1.0
 */
?>

<?php if( get_theme_mod( 'vw_kids_discount_text') != '' || get_theme_mod( 'vw_kids_call') != '' || get_theme_mod( 'vw_kids_email') != '') { ?>

  <?php if( get_theme_mod( 'vw_kids_topbar_hide_show', false) != '' || get_theme_mod( 'vw_kids_resp_topbar_hide_show', false) != '') { ?>
    <div id="topbar">
      <div class="container">
        <div class="row">
          <div class="col-lg-7 col-md-12">
            <?php if( get_theme_mod( 'vw_kids_discount_text') != '') { ?>
              <span><?php echo esc_html(get_theme_mod('vw_kids_discount_text',''));?></span>
            <?php }?>
          </div>
          <div class="call col-lg-2 col-md-6">
            <?php if( get_theme_mod('vw_kids_call') != '' ){ ?>
              <i class="<?php echo esc_attr(get_theme_mod('vw_kids_phone_number_icon','fas fa-phone')); ?>"></i><span><a href="tel:<?php echo esc_attr( get_theme_mod('vw_kids_call','') ); ?>"><?php echo esc_html(get_theme_mod('vw_kids_call',''));?></a></span>
            <?php }?>            
          </div>
          <div class="email col-lg-3 col-md-6">            
            <?php if( get_theme_mod( 'vw_kids_email') != ''){ ?>
              <i class="<?php echo esc_attr(get_theme_mod('vw_kids_email_icon','far fa-envelope')); ?>"></i><span><a href="mailto:<?php echo esc_attr(get_theme_mod('vw_kids_email',''));?>"><?php echo esc_html(get_theme_mod('vw_kids_email',''));?></a></span>
            <?php }?>
          </div>
        </div>
      </div>
    </div>
  <?php }?>

<?php } ?>