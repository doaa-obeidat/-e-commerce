<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Business Commerce Lite
 */

$sidebar = business_commerce_get_sidebar_id();

if ( '' === $sidebar || ! is_active_sidebar( $sidebar ) ) {
    return;
}

?>

<div id="secondary" class="widget-area sidebar">
	<?php dynamic_sidebar( $sidebar ); ?>
</div><!-- #secondary -->
