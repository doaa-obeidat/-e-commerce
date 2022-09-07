<?php

	/*------------ First highlight color --------------*/

	$vw_kids_first_color = get_theme_mod('vw_kids_first_color');

	$vw_kids_custom_css = '';

	if($vw_kids_first_color != false){
		$vw_kids_custom_css .='#menu-box, .categry-title, #slider hr, #slider .view-more:hover, .woocommerce ul.products li.product:hover, .woocommerce ul.products li.product:hover span.onsale, #footer-2, nav.woocommerce-MyAccount-navigation ul li, .header-fixed, #preloader, .cart-value, #slider .carousel-control-prev-icon:hover, #slider .carousel-control-next-icon:hover, .scrollup i, input[type="submit"], .view-more:hover , .pagination .current, .pagination a:hover, #sidebar .tagcloud a:hover, #footer .tagcloud a:hover, #comments input[type="submit"], #comments a.comment-reply-link, .woocommerce #respond input#submit:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce button.button:disabled:hover, .woocommerce button.button:disabled[disabled]:hover, #toy-category .owl-nav button:hover, #toy-category .cat-box h3:after{';
			$vw_kids_custom_css .='background-color: '.esc_attr($vw_kids_first_color).';';
		$vw_kids_custom_css .='}';
	}
	if($vw_kids_first_color != false){
		$vw_kids_custom_css .='{';
			$vw_kids_custom_css .='background-color: '.esc_attr($vw_kids_first_color).'!important;';
		$vw_kids_custom_css .='}';
	}
	if($vw_kids_first_color != false){
		$vw_kids_custom_css .='.main-navigation ul.sub-menu a:hover, .post-main-box:hover h2 a, .post-main-box:hover .entry-date a, .post-main-box:hover .entry-author a, .single-post .post-info:hover .entry-date a, .single-post .post-info:hover .entry-author a, .cart_no i:hover,.logo .site-title a:hover{';
			$vw_kids_custom_css .='color: '.esc_attr($vw_kids_first_color).';';
		$vw_kids_custom_css .='}';
	}
	if($vw_kids_first_color != false){
		$vw_kids_custom_css .='#slider .view-more:hover, #slider .carousel-control-prev-icon:hover, #slider .carousel-control-next-icon:hover, #popular-toys hr, .products li:hover a.button, #footer h3:after, #footer .wp-block-search .wp-block-search__label:after, .view-more:hover, a.added_to_cart.wc-forward, .woocommerce #respond input#submit:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce button.button:disabled:hover, .woocommerce button.button:disabled[disabled]:hover, #toy-category .owl-nav button:hover{';
			$vw_kids_custom_css .='border-color: '.esc_attr($vw_kids_first_color).';';
		$vw_kids_custom_css .='}';
	}

	if($vw_kids_first_color != false){
		$vw_kids_custom_css .='.post-main-box, #sidebar .widget{
		box-shadow: 0px 15px 10px -15px '.esc_attr($vw_kids_first_color).';
		}';
	}

	/*------------ Second highlight color --------------*/

	$vw_kids_second_color = get_theme_mod('vw_kids_second_color');

	if($vw_kids_second_color != false){
		$vw_kids_custom_css .='#topbar, .woocommerce span.onsale, .woocommerce ul.products li.product, #footer, .pagination span, .pagination a, #comments a.comment-reply-link:hover, .toggle-nav i{';
			$vw_kids_custom_css .='background-color: '.esc_attr($vw_kids_second_color).';';
		$vw_kids_custom_css .='}';
	}
	if($vw_kids_second_color != false){
		$vw_kids_custom_css .='a, .logo h1 a, .logo p.site-title a, .main-navigation a, .categry-title strong, .product-cat li a:hover, .main-navigation ul ul a, #slider .view-more:hover, .view-more:hover i, #popular-toys strong, .woocommerce ul.products li.product:hover h2, .woocommerce ul.products li.product:hover .price, .woocommerce ul.products li.product:hover .star-rating::before, .woocommerce ul.products li.product:hover span.onsale, .copyright p, .copyright a, .account a:hover, #footer input[type="submit"], .content-vw a, .woocommerce-product-details__short-description p a, .entry-content a, #sidebar .textwidget a, .textwidget a, #comments .comment-content a,.post-main-box h2 a, .view-more, .content-bttn .view-more:hover i, .error-btn .view-more:hover i, #sidebar li a:hover, .woocommerce div.product .product_title, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, h1, h2, h3, h4, h5, h6, .woocommerce button.button:disabled, .woocommerce button.button:disabled[disabled], nav.woocommerce-MyAccount-navigation ul li a, .cart_no i, .cart-value, #slider .carousel-control-prev-icon:hover, #slider .carousel-control-next-icon:hover, .scrollup i, input[type="submit"], .view-more:hover , .pagination .current, .pagination a:hover, #sidebar .tagcloud a:hover, #footer .tagcloud a:hover, #comments input[type="submit"], #comments a.comment-reply-link, .woocommerce #respond input#submit:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce button.button:disabled:hover, .woocommerce button.button:disabled[disabled]:hover, #toy-category .owl-nav button:hover, #toy-category .owl-nav button{';
			$vw_kids_custom_css .='color: '.esc_attr($vw_kids_second_color).';';
		$vw_kids_custom_css .='}';
	}
	if($vw_kids_second_color != false){
		$vw_kids_custom_css .='.main-navigation ul ul, a.button.product_type_simple.add_to_cart_button, .view-more, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .cart_no i, .header-fixed, .loader-line, #toy-category .owl-nav button{';
			$vw_kids_custom_css .='border-color: '.esc_attr($vw_kids_second_color).';';
		$vw_kids_custom_css .='}';
	}

	if($vw_kids_second_color != false){
		$vw_kids_custom_css .='nav.woocommerce-MyAccount-navigation ul li{
		box-shadow: 2px 2px 0 0 '.esc_attr($vw_kids_second_color).';
		}';
	}

	if($vw_kids_second_color != false){
		$vw_kids_custom_css .='@media screen and (max-width: 1000px){
		.main-navigation ul li a{';
			$vw_kids_custom_css .='color: '.esc_attr($vw_kids_second_color). ';';
		$vw_kids_custom_css .='} }';
	}