<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package test
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
    <?
    $logo = getLogo();
    $logoR = getLogoRetina();
    $headColor = getHeadBGColor();
    $headImage = getHeadBGImage();
    ?>
    <style>
        header {
            <? if ($headColor) :?> background-color: <?=$headColor;?>;<?endif;?>
            <? if ($headImage) :?> background-image: url(<?=$headImage;?>);<?endif;?>
        }
        #logo {
            <?=$logo ? 'background-image: url(' . $logo . ');' : ''?>
        }
        @media only screen and (min--moz-device-pixel-ratio: 2),
        only screen and (-o-min-device-pixel-ratio: 2/1),
        only screen and (-webkit-min-device-pixel-ratio: 2),
        only screen and (min-device-pixel-ratio: 2) {
            <?=$logoR ? 'background-image: url(' . $logoR . ');' : ''?>
        }
    </style>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'test' ); ?></a>

	<header id="masthead" class="site-header">
        <div >
            <div class="header-top header-left">
                <div id="logo"></div>
            </div>
            <div id="header-widget" class="header-top widget header-right">
                <?get_sidebar('header-widget');
                ?>
            </div>
        </div>
        <div>
            <nav id="site-navigation" class="main-navigation header-left">
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'test' ); ?></button>
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'menu-1',
                    'menu_id'        => 'primary-menu',
                ) );
                ?>
            </nav><!-- #site-navigation -->
            <div id="search-string" class="header-right">
                <? get_search_form();?>
<!--                <form method="get" id="searchform" action="--><?php //bloginfo('url'); ?><!--/">-->
<!--                    <div>-->
<!--                        <input type="text" value="--><?php //the_search_query(); ?><!--" name="s" id="s" />-->
<!--                        <input type="submit" id="searchsubmit" value="Search" />-->
<!--                    </div>-->
<!--                </form>-->
            </div>
        </div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
