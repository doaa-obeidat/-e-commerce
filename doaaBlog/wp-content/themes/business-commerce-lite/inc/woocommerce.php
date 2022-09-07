<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Business Commerce Lite
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function business_commerce_woocommerce_setup() {
	add_theme_support( 'woocommerce' );

	if ( ! business_commerce_gtm( 'business_commerce_product_gallery_zoom' ) ) {
		add_theme_support('wc-product-gallery-zoom');
	}

	if ( ! business_commerce_gtm( 'business_commerce_product_gallery_lightbox' ) ) {
		add_theme_support('wc-product-gallery-lightbox');
	}

	if ( ! business_commerce_gtm( 'business_commerce_product_gallery_slider' ) ) {
		add_theme_support('wc-product-gallery-slider');
	}
}
add_action( 'after_setup_theme', 'business_commerce_woocommerce_setup' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function business_commerce_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'business_commerce_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function business_commerce_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'business_commerce_woocommerce_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'business_commerce_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function business_commerce_woocommerce_wrapper_before() {
		?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
			<?php
	}
}
add_action( 'woocommerce_before_main_content', 'business_commerce_woocommerce_wrapper_before' );

if ( ! function_exists( 'business_commerce_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function business_commerce_woocommerce_wrapper_after() {
			?>
			</main><!-- #main -->
		</div><!-- #primary -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'business_commerce_woocommerce_wrapper_after' );

if ( ! function_exists( 'business_commerce_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function business_commerce_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		business_commerce_woocommerce_cart_link();
		$fragments['a.cart-link'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'business_commerce_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'business_commerce_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function business_commerce_woocommerce_cart_link() {
		?>
		<a class="cart-link" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'business-commerce-lite' ); ?>">
			<i class="fas fa-shopping-basket" aria-hidden="true"></i>
			<span class="cart-count"><?php echo absint( WC()->cart->get_cart_contents_count() ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'business_commerce_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function business_commerce_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<?php if ( class_exists( 'YITH_WCWL' ) ) : ?>
				<?php
				$wishlist_page_id = yith_wcwl_object_id( get_option( 'yith_wcwl_wishlist_page_id' ) );
				?>
				<li class="wishlist-btn"><a href="<?php echo esc_url( get_permalink( $wishlist_page_id ) ); ?>"><i class="far fa-heart"></i><span class="wishlist-count"><?php echo absint( yith_wcwl_count_products() ); ?></span></a></li>
			<?php endif; ?>

			<li class="cart-summary-btn <?php echo esc_attr( $class ); ?>">
				<?php business_commerce_woocommerce_cart_link(); ?>
				<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
			</li>
		</ul>
		<?php
	}
}

/**
 * Remove breadcrumb from default position
 * Check template-parts/header/custom-header.php
 */
function business_commerce_remove_wc_breadcrumbs() {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}
add_action( 'init', 'business_commerce_remove_wc_breadcrumbs' );

if ( ! function_exists( 'business_commerce_woocommerce_custom_excerpt' ) ) :
	/**
	 * Adds Continue reading link to more tag excerpts.
	 *
	 * function tied to the get_the_excerpt filter hook.
	 */
	function business_commerce_woocommerce_custom_excerpt( $output ) {
		if ( is_admin() ) {
			return $output;
		}

		if ( 'product' === get_post_type() ) {
			$output = preg_replace( "/<a\s(.+?)>(.+?)<\/a>/is", do_shortcode( '[add_to_cart id="' . get_the_id() . '"]' ), $output );
		}

		return $output;
	} // business_commerce_custom_excerpt.
endif;
add_filter( 'get_the_excerpt', 'business_commerce_woocommerce_custom_excerpt' );


/**
 * Remove items from product loop
 * Check woocommerce/content-product.php
 */
function business_commerce_remove_product_loop_content() {
	remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
	
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

	remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
}
add_action( 'init', 'business_commerce_remove_product_loop_content' );

if ( defined( 'YITH_WCWL' ) && ! function_exists( 'business_commerce_yith_wishlist_ajax_update' ) ) {
	/**
	 * Count number of items in wishlist and send it.
	 */
	function business_commerce_yith_wishlist_ajax_update() {
		wp_send_json( array(
			'count' => yith_wcwl_count_all_products(),
		) );
	}
	add_action( 'wp_ajax_business_commerce_yith_wcwl_update_wishlist_count', 'business_commerce_yith_wishlist_ajax_update' );
	add_action( 'wp_ajax_nopriv_business_commerce_yith_wcwl_update_wishlist_count', 'business_commerce_yith_wishlist_ajax_update' );
}

if ( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_enqueue_custom_script' ) ) {
	/**
	 * Count number of products wishlist in ajax and update count in header.
	 */
	function business_commerce_yith_wcwl_enqueue_custom_script() {
		wp_add_inline_script(
			'jquery-yith-wcwl',
			"
			jQuery( function( $ ) {
				$( document ).on( 'added_to_wishlist removed_from_wishlist', function() {
					$.get( yith_wcwl_l10n.ajax_url, {
						action: 'business_commerce_yith_wcwl_update_wishlist_count'
					}, function( data ) {
						$('.wishlist-count').html( data.count );
					});
				});
			});
			"
		);
	}
	add_action( 'wp_enqueue_scripts', 'business_commerce_yith_wcwl_enqueue_custom_script', 20 );
}



add_action( 'product_cat_add_form_fields', 'business_commerce_add_term_fields', 999999 );

function business_commerce_add_term_fields( $taxonomy ) {
	?>
	<br /><br />
	<div class="form-field term-display-type-wrap">
		<p><?php printf( esc_html__( 'Icon takes Priority Over Image. If you want camera icon, save "fas fa-camera". For more classes, check %1$sthis%2$s', 'business-commerce-lite' ), '<a href="' . esc_url( 'https://fontawesome.com/icons?d=gallery&m=free' ) . '" target="_blank">', '</a>' ); ?></p>
		
		<label for="business-commerce-custom-icon"><?php esc_html_e( 'Icon Class', 'business-commerce-lite' ); ?></label>
		<input type="text" name="business-commerce-custom-icon" id="business-commerce-custom-icon" />

		<label><?php esc_html_e( 'Icon Image', 'business-commerce-lite' ); ?></label>
			<div id="business_commerce_icon_image" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url( wc_placeholder_img_src() ); ?>" width="60px" height="60px" /></div>
			<div style="line-height: 60px;">
				<input type="hidden" id="business_commerce_icon_image_id" name="business_commerce_icon_image_id" />
				<button type="button" class="business_business_upload_image_button button"><?php esc_html_e( 'Upload/Add image', 'business-commerce-lite' ); ?></button>
				<button type="button" class="business_commerce_remove_image_button button"><?php esc_html_e( 'Remove image', 'business-commerce-lite' ); ?></button>
			</div>
			<script type="text/javascript">

				// Only show the "remove image" button when needed
				if ( ! jQuery( '#business_commerce_icon_image_id' ).val() ) {
					jQuery( '.business_commerce_remove_image_button' ).hide();
				}

				// Uploading files
				var file_frame;

				jQuery( document ).on( 'click', '.business_business_upload_image_button', function( event ) {

					event.preventDefault();

					// If the media frame already exists, reopen it.
					if ( file_frame ) {
						file_frame.open();
						return;
					}

					// Create the media frame.
					file_frame = wp.media.frames.downloadable_file = wp.media({
						title: '<?php esc_html_e( 'Choose an image', 'business-commerce-lite' ); ?>',
						button: {
							text: '<?php esc_html_e( 'Use image', 'business-commerce-lite' ); ?>'
						},
						multiple: false
					});

					// When an image is selected, run a callback.
					file_frame.on( 'select', function() {
						var attachment           = file_frame.state().get( 'selection' ).first().toJSON();
						var attachment_thumbnail = attachment.sizes.thumbnail || attachment.sizes.full;

						jQuery( '#business_commerce_icon_image_id' ).val( attachment.id );
						jQuery( '#business_commerce_icon_image' ).find( 'img' ).attr( 'src', attachment_thumbnail.url );
						jQuery( '.business_commerce_remove_image_button' ).show();
					});

					// Finally, open the modal.
					file_frame.open();
				});

				jQuery( document ).on( 'click', '.business_commerce_remove_image_button', function() {
					jQuery( '#business_commerce_icon_image' ).find( 'img' ).attr( 'src', '<?php echo esc_js( wc_placeholder_img_src() ); ?>' );
					jQuery( '#business_commerce_icon_image_id' ).val( '' );
					jQuery( '.business_commerce_remove_image_button' ).hide();
					return false;
				});

				jQuery( document ).ajaxComplete( function( event, request, options ) {
					if ( request && 4 === request.readyState && 200 === request.status
						&& options.data && 0 <= options.data.indexOf( 'action=add-tag' ) ) {

						var res = wpAjax.parseAjaxResponse( request.responseXML, 'ajax-response' );
						if ( ! res || res.errors ) {
							return;
						}
						// Clear Thumbnail fields on submit
						jQuery( '#business_commerce_icon_image' ).find( 'img' ).attr( 'src', '<?php echo esc_js( wc_placeholder_img_src() ); ?>' );
						jQuery( '#business_commerce_icon_image_id' ).val( '' );
						jQuery( '.business_commerce_remove_image_button' ).hide();
						// Clear Display type field on submit
						jQuery( '#display_type' ).val( '' );
						return;
					}
				} );

			</script>
			<div class="clear"></div>
	</div>
	<?php
}

add_action( 'product_cat_edit_form_fields', 'business_commerce_edit_term_fields', 100, 2 );

function business_commerce_edit_term_fields( $term, $taxonomy ) {

	$icon     = get_term_meta( $term->term_id, 'business-commerce-custom-icon', true );
	$image_id = get_term_meta( $term->term_id, 'business_commerce_icon_image_id', true );
	
	$image_thumb = wc_placeholder_img_src();
	
	if ( $image_thumb_obj = wp_get_attachment_image_src( $image_id ) ) {
		$image_thumb = $image_thumb_obj[0];
	}
	?>
	<tr><td colspan="2"><?php printf( esc_html__( 'Icon takes Priority Over Image. If you want camera icon, save "fas fa-camera". For more classes, check %1$sthis%2$s', 'business-commerce-lite' ), '<a href="' . esc_url( 'https://fontawesome.com/icons?d=gallery&m=free' ) . '" target="_blank">', '</a>' ); ?></td></tr>
	<tr class="form-field">
		<th>
		<label for="business-commerce-custom-icon"><?php esc_html_e( 'Icon Class', 'business-commerce-lite' ); ?></label></th>
		<td><input type="text" name="business-commerce-custom-icon" id="business-commerce-custom-icon" value="<?php echo esc_attr( $icon ); ?>" /></td>
	</tr>
	<tr class="form-field">
		<th>
		<label><?php esc_html_e( 'Icon Image', 'business-commerce-lite' ); ?></label>
		</th>
		<td>
			<div id="business_commerce_icon_image" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url( $image_thumb ); ?>" width="60px" height="60px" /></div>
			<div style="line-height: 60px;">
				<input type="hidden" id="business_commerce_icon_image_id" name="business_commerce_icon_image_id" />
				<button type="button" class="business_business_upload_image_button button"><?php esc_html_e( 'Upload/Add image', 'business-commerce-lite' ); ?></button>
				<button type="button" class="business_commerce_remove_image_button button"><?php esc_html_e( 'Remove image', 'business-commerce-lite' ); ?></button>
			</div>
			<script type="text/javascript">

				// Only show the "remove image" button when needed
				if ( ! jQuery( '#business_commerce_icon_image_id' ).val() ) {
					jQuery( '.business_commerce_remove_image_button' ).hide();
				}

				// Uploading files
				var file_frame;

				jQuery( document ).on( 'click', '.business_business_upload_image_button', function( event ) {

					event.preventDefault();

					// If the media frame already exists, reopen it.
					if ( file_frame ) {
						file_frame.open();
						return;
					}

					// Create the media frame.
					file_frame = wp.media.frames.downloadable_file = wp.media({
						title: '<?php esc_html_e( 'Choose an image', 'business-commerce-lite' ); ?>',
						button: {
							text: '<?php esc_html_e( 'Use image', 'business-commerce-lite' ); ?>'
						},
						multiple: false
					});

					// When an image is selected, run a callback.
					file_frame.on( 'select', function() {
						var attachment           = file_frame.state().get( 'selection' ).first().toJSON();
						var attachment_thumbnail = attachment.sizes.thumbnail || attachment.sizes.full;

						jQuery( '#business_commerce_icon_image_id' ).val( attachment.id );
						jQuery( '#business_commerce_icon_image' ).find( 'img' ).attr( 'src', attachment_thumbnail.url );
						jQuery( '.business_commerce_remove_image_button' ).show();
					});

					// Finally, open the modal.
					file_frame.open();
				});

				jQuery( document ).on( 'click', '.business_commerce_remove_image_button', function() {
					jQuery( '#business_commerce_icon_image' ).find( 'img' ).attr( 'src', '<?php echo esc_js( wc_placeholder_img_src() ); ?>' );
					jQuery( '#business_commerce_icon_image_id' ).val( '' );
					jQuery( '.business_commerce_remove_image_button' ).hide();
					return false;
				});

				jQuery( document ).ajaxComplete( function( event, request, options ) {
					if ( request && 4 === request.readyState && 200 === request.status
						&& options.data && 0 <= options.data.indexOf( 'action=add-tag' ) ) {

						var res = wpAjax.parseAjaxResponse( request.responseXML, 'ajax-response' );
						if ( ! res || res.errors ) {
							return;
						}
						// Clear Thumbnail fields on submit
						jQuery( '#business_commerce_icon_image' ).find( 'img' ).attr( 'src', '<?php echo esc_js( wc_placeholder_img_src() ); ?>' );
						jQuery( '#business_commerce_icon_image_id' ).val( '' );
						jQuery( '.business_commerce_remove_image_button' ).hide();
						// Clear Display type field on submit
						jQuery( '#display_type' ).val( '' );
						return;
					}
				} );

			</script>
		</td>
	</tr>
	<?php
}

add_action( 'created_product_cat', 'business_commerce_save_term_fields' );
add_action( 'edited_product_cat', 'business_commerce_save_term_fields' );

function business_commerce_save_term_fields( $term_id ) {
	update_term_meta(
		$term_id,
		'business-commerce-custom-icon',
		sanitize_text_field( $_POST[ 'business-commerce-custom-icon' ] )
	);

	update_term_meta(
		$term_id,
		'business_commerce_icon_image_id',
		absint( $_POST[ 'business_commerce_icon_image_id' ] )
	);
}

function business_commerce_add_image_in_cat( $output, $cat ) {
	$icon     = get_term_meta( $cat->term_id, 'business-commerce-custom-icon', true );
	$image_id = get_term_meta( $cat->term_id, 'business_commerce_icon_image_id', true );
	
	if ( $icon ) {
		$output = '<i class="' . esc_attr( $icon ) . '"></i>' . $output;
	} elseif ( $image_id ) {
		if ( $image_thumb_obj = wp_get_attachment_image_src( $image_id ) ) {
			$image_thumb = $image_thumb_obj[0];
		}

		$output = '<img src="' . esc_url( $image_thumb ) . '" />' . $output;
	}
	return $output;
}
add_filter( 'list_product_cats', 'business_commerce_add_image_in_cat', 10, 2 );
