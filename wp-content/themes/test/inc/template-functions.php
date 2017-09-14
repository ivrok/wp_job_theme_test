<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package test
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function test_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'test_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function test_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'test_pingback_header' );


add_action('widgets_init', function(){
    register_sidebar(array(
        'name' => 'сайдбар в шапке',
        'id' => 'header-widget'));
});


function mytheme_customize_register( $wp_customize )
{
    //All our sections, settings, and controls will be added here

    $wp_customize->add_section('test test test', array(
        'title'    => __('test', 'test'),
        'description' => '',
        'priority' => 120,
    ));
}
add_action( 'customize_register', 'mytheme_customize_register' );