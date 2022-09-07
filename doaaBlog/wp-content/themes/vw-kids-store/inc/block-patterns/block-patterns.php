<?php
/**
 *  VW Kids Store: Block Patterns
 *
 * @package  VW Kids Store
 * @since   1.0.0
 */

/**
 * Register Block Pattern Category.
 */
if ( function_exists( 'register_block_pattern_category' ) ) {

	register_block_pattern_category(
		'vw-kids-store',
		array( 'label' => __( 'VW Kids Store', 'vw-kids-store' ) )
	);
}

/**
 * Register Block Patterns.
 */
if ( function_exists( 'register_block_pattern' ) ) {
	register_block_pattern(
		'vw-kids-store/banner-section',
		array(
			'title'      => __( 'Banner Section', 'vw-kids-store' ),
			'categories' => array( 'vw-kids-store' ),
			'content'    => "<!-- wp:cover {\"customOverlayColor\":\"#ffe6e6\",\"isDark\":false,\"align\":\"full\",\"className\":\"banner-section\"} -->\n<div class=\"wp-block-cover alignfull is-light banner-section\"><span aria-hidden=\"true\" class=\"wp-block-cover__background has-background-dim-100 has-background-dim\" style=\"background-color:#ffe6e6\"></span><div class=\"wp-block-cover__inner-container\"><!-- wp:columns {\"align\":\"full\",\"className\":\"mx-lg-4 px-lg-4 m-0\"} -->\n<div class=\"wp-block-columns alignfull mx-lg-4 px-lg-4 m-0\"><!-- wp:column {\"width\":\"22.22%\",\"backgroundColor\":\"white\",\"className\":\"banner-section1\"} -->\n<div class=\"wp-block-column banner-section1 has-white-background-color has-background\" style=\"flex-basis:22.22%\"><!-- wp:heading {\"level\":5,\"style\":{\"color\":{\"background\":\"#ffc85b\"}}} -->\n<h5 class=\"has-background\" style=\"background-color:#ffc85b\">ALL CATEGORIES</h5>\n<!-- /wp:heading -->\n\n<!-- wp:woocommerce/product-categories {\"className\":\"banner-section1-shop-categories\"} /-->\n\n<!-- wp:paragraph -->\n<p></p>\n<!-- /wp:paragraph --></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"width\":\"77.77%\"} -->\n<div class=\"wp-block-column\" style=\"flex-basis:77.77%\"><!-- wp:cover {\"url\":\"" . get_theme_file_uri() . "/inc/block-patterns/images/banner.png\",\"id\":2161,\"dimRatio\":0,\"className\":\"banner-section2\"} -->\n<div class=\"wp-block-cover banner-section2\"><span aria-hidden=\"true\" class=\"wp-block-cover__background has-background-dim-0 has-background-dim\"></span><img class=\"wp-block-cover__image-background wp-image-2161\" alt=\"\" src=\"" . get_theme_file_uri() . "/inc/block-patterns/images/banner.png\" data-object-fit=\"cover\"/><div class=\"wp-block-cover__inner-container\"><!-- wp:columns {\"className\":\"banner-section-main-class px-lg-5\"} -->\n<div class=\"wp-block-columns banner-section-main-class px-lg-5\"><!-- wp:column {\"width\":\"66.66%\",\"className\":\"baner-section3\"} -->\n<div class=\"wp-block-column baner-section3\" style=\"flex-basis:66.66%\"><!-- wp:heading {\"textAlign\":\"left\",\"level\":1,\"style\":{\"typography\":{\"fontSize\":\"50px\"}},\"textColor\":\"white\"} -->\n<h1 class=\"has-text-align-left has-white-color has-text-color\" style=\"font-size:50px\">  THE TREE PET RABIT</h1>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph {\"align\":\"left\",\"textColor\":\"white\"} -->\n<p class=\"has-text-align-left has-white-color has-text-color\">Make Play time a blast with our finest toys and gamessimply     dummy text of the    printing and typesetting industry. Lorem Ipsum when an unknown printer took a galley of type and scrambled.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:buttons -->\n<div class=\"wp-block-buttons\"><!-- wp:button {\"style\":{\"typography\":{\"fontSize\":\"18px\"}},\"className\":\"banner-section2-button is-style-fill\"} -->\n<div class=\"wp-block-button has-custom-font-size banner-section2-button is-style-fill\" style=\"font-size:18px\"><a class=\"wp-block-button__link\">SHOP NOW</a></div>\n<!-- /wp:button --></div>\n<!-- /wp:buttons --></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"width\":\"33.33%\",\"className\":\"baner-section4\"} -->\n<div class=\"wp-block-column baner-section4\" style=\"flex-basis:33.33%\"></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns --></div></div>\n<!-- /wp:cover --></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns --></div></div>\n<!-- /wp:cover -->",
		)
	);

	register_block_pattern(
		'vw-kids-store/category-section',
		array(
			'title'      => __( 'category-section', 'vw-kids-store' ),
			'categories' => array( 'vw-kids-store' ),
			'content'    => "<!-- wp:group {\"className\":\"category-section py-5\"} -->\n<div class=\"wp-block-group category-section py-5\"><!-- wp:columns {\"className\":\"category-section \"} -->\n<div class=\"wp-block-columns category-section\"><!-- wp:column {\"className\":\"category-section1\"} -->\n<div class=\"wp-block-column category-section1\"><!-- wp:image {\"align\":\"center\",\"id\":2209,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} -->\n<figure class=\"wp-block-image aligncenter size-full\"><img src=\"" . get_theme_file_uri() . "/inc/block-patterns/images/category1.png\" alt=\"\" class=\"wp-image-2209\"/></figure>\n<!-- /wp:image -->\n\n<!-- wp:heading {\"textAlign\":\"center\",\"level\":3,\"textColor\":\"white\"} -->\n<h3 class=\"has-text-align-center has-white-color has-text-color\">STUFFED TOYS</h3>\n<!-- /wp:heading --></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"className\":\"category-section2 text-center\"} -->\n<div class=\"wp-block-column category-section2 text-center\"><!-- wp:image {\"align\":\"center\",\"id\":2210,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} -->\n<figure class=\"wp-block-image aligncenter size-full\"><img src=\"" . get_theme_file_uri() . "/inc/block-patterns/images/category2.png\" alt=\"\" class=\"wp-image-2210\"/></figure>\n<!-- /wp:image -->\n\n<!-- wp:heading {\"textAlign\":\"center\",\"level\":3,\"textColor\":\"white\"} -->\n<h3 class=\"has-text-align-center has-white-color has-text-color\">LEARNING TOYS</h3>\n<!-- /wp:heading --></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"className\":\"category-section3\"} -->\n<div class=\"wp-block-column category-section3\"><!-- wp:image {\"align\":\"center\",\"id\":2211,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} -->\n<figure class=\"wp-block-image aligncenter size-full\"><img src=\"" . get_theme_file_uri() . "/inc/block-patterns/images/category3.png\" alt=\"\" class=\"wp-image-2211\"/></figure>\n<!-- /wp:image -->\n\n<!-- wp:heading {\"textAlign\":\"center\",\"level\":3,\"textColor\":\"white\"} -->\n<h3 class=\"has-text-align-center has-white-color has-text-color\">CHEWABLE TOYS</h3>\n<!-- /wp:heading --></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns --></div>\n<!-- /wp:group -->",
		)
	);
}