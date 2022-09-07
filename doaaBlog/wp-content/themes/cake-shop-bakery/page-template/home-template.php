<?php
/**
 * Template Name: Home Template
 */

get_header(); ?>

<main id="skip-content">
  <section id="top-slider">
    <?php $cake_shop_bakery_slide_pages = array();
      for ( $count = 1; $count <= 3; $count++ ) {
        $mod = intval( get_theme_mod( 'cake_shop_bakery_top_slider_page' . $count ));
        if ( 'page-none-selected' != $mod ) {
          $cake_shop_bakery_slide_pages[] = $mod;
        }
      }
      if( !empty($cake_shop_bakery_slide_pages) ) :
        $args = array(
          'post_type' => 'page',
          'post__in' => $cake_shop_bakery_slide_pages,
          'orderby' => 'post__in'
        );
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) :
          $i = 1;
    ?>
    <div class="owl-carousel" role="listbox">
      <?php  while ( $query->have_posts() ) : $query->the_post(); ?>
        <div class="slider-box">
          <img src="<?php esc_url(the_post_thumbnail_url('full')); ?>"/>
          <div class="slider-inner-box">
            <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
            <p><?php echo wp_trim_words( get_the_content(), 30 ); ?></p>
            <div class="slider-box-btn mt-4">
              <a href="<?php the_permalink(); ?>"><?php esc_html_e('Order Now','cake-shop-bakery'); ?><i class="fas fa-angle-right ml-2"></i></a>
            </div>
          </div>
        </div>
      <?php $i++; endwhile;
      wp_reset_postdata();?>
    </div>
    <?php else : ?>
      <div class="no-postfound"></div>
    <?php endif;
    endif;?>
  </section>

  <section id="new-products" class="py-5">
    <div class="container">
      <?php if(get_theme_mod('cake_shop_bakery_new_product_title') != ''){ ?>
        <h3 class="text-center"><?php echo esc_html(get_theme_mod('cake_shop_bakery_new_product_title','')); ?></h3>
      <?php }?>
      <?php if(get_theme_mod('cake_shop_bakery_new_product_text') != ''){ ?>
        <p class="text-center"><?php echo esc_html(get_theme_mod('cake_shop_bakery_new_product_text','')); ?></p>
      <?php }?>
      <div class="row mt-5">
        <?php
        if ( class_exists( 'WooCommerce' ) ) {
          $args = array( 
            'post_type' => 'product',
            'posts_per_page' => get_theme_mod('cake_shop_bakery_new_product_number'),
            'product_cat' => get_theme_mod('cake_shop_bakery_new_product_category'),
            'order' => 'ASC'
          );
          $loop = new WP_Query( $args );
          while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
            <div class="col-lg-3 col-md-4 col-sm-4">
              <div class="product-box mb-4">
                <div class="product-image mb-4">
                  <?php if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); else echo '<img src="'.esc_url(woocommerce_placeholder_img_src()).'" />'; ?>
                </div>
                <?php woocommerce_show_product_sale_flash( $post, $product ); ?>
                <p class="my-2 product-title"><a href="<?php echo esc_url(get_permalink( $loop->post->ID )); ?>"><?php the_title(); ?></a></p>
                <p class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?> mb-0"><?php echo $product->get_price_html(); ?></p>
                <div class="addtocart mt-3">
                  <?php if( $product->is_type( 'simple' ) ) { woocommerce_template_loop_add_to_cart(  $loop->post, $product );} ?>
                </div>
              </div>
            </div>
          <?php endwhile; wp_reset_query(); ?>
        <?php } ?>
      </div>
    </div>
  </section>

  <section id="page-content">
    <div class="container">
      <div class="py-5">
        <?php
          if ( have_posts() ) :
            while ( have_posts() ) : the_post();
              the_content();
            endwhile;
          endif;
        ?>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>