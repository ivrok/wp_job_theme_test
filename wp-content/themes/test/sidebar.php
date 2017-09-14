<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package test
 */

//if ( ! is_active_sidebar( 'sidebar-1' ) ) {
//	return;
//}
?>

<div id="sidebar">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('header-widget') ) : endif; ?>
</div>