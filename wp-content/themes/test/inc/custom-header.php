<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package test
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses test_header_style()
 */
function getLogo(){
    return get_option('LogoUrl');
}
function getLogoRetina(){
    return get_option('LogoRUrl');
}
function getHeadBGColor(){
    return get_option('headbgcolor');
}
function getHeadBGImage(){
    return get_option('headbgimageUrl');
}
function isHeaderFixed(){
    return get_option('headFixed');
}