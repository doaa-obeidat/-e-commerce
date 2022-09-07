<?php
$theme = wp_get_theme(); // gets the current theme
	
if( 'Storely' == $theme->name){
	require ECOMMERCE_COMP_PLUGIN_DIR . 'inc/themes/storely/storely.php';
}

if( 'Shoply' == $theme->name){
	require ECOMMERCE_COMP_PLUGIN_DIR . 'inc/themes/shoply/shoply.php';
}

if( 'Storess' == $theme->name){
	require ECOMMERCE_COMP_PLUGIN_DIR . 'inc/themes/storess/storess.php';
}

if( 'Storezia' == $theme->name){
	require ECOMMERCE_COMP_PLUGIN_DIR . 'inc/themes/storezia/storezia.php';
}

if( 'Shopwire' == $theme->name){
	require ECOMMERCE_COMP_PLUGIN_DIR . 'inc/themes/shopwire/shopwire.php';
}

if( 'Aromatic' == $theme->name){
	require ECOMMERCE_COMP_PLUGIN_DIR . 'inc/themes/aromatic/aromatic.php';
}

if( 'Ayroma' == $theme->name){
	require ECOMMERCE_COMP_PLUGIN_DIR . 'inc/themes/ayroma/ayroma.php';
}

if( 'Feauty' == $theme->name){
	require ECOMMERCE_COMP_PLUGIN_DIR . 'inc/themes/feauty/feauty.php';
}

