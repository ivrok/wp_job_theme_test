<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 14.09.2017
 * Time: 16:13
 */

/**
 * Add js and css
 */
add_action( 'admin_enqueue_scripts',
    function() {
        if ( ! did_action( 'wp_enqueue_media' ) ) {
            wp_enqueue_media();
        }
        wp_enqueue_style( 'admin_settings', get_template_directory_uri() . '/layouts/admin_settings.css', false, '1.0.0' );

        wp_enqueue_script( 'color_picker', get_stylesheet_directory_uri() . '/js/jquery.colorpicker.min.js', array('jquery'), null, false );
        wp_enqueue_script( 'admin_settings', get_stylesheet_directory_uri() . '/js/admin_settings.js', array('jquery'), null, false );
    }
);



function add_theme_menu_item()
{
    add_menu_page("Theme Panel", "Theme Panel", "manage_options", "theme-panel", "theme_settings_page", null, 99);
}

add_action("admin_menu", "add_theme_menu_item");

function theme_settings_page()
{
    ?>
    <div class="wrap">
        <h1>Theme Panel</h1>
        <form method="post" action="options.php" enctype="multipart/form-data">
            <?php
            settings_fields("section");
            do_settings_sections("theme-options");
            submit_button();
            ?>
        </form>
    </div>
    <?php
}
function logo_display()
{
    $logo = get_option('LogoUrl');
    ?>
    <div class="inputWrapper">
        <? if ($logo) :?>
            <img id="LogoUrl" class="LogoUrl" width=200 src="<?=$logo;?>">
        <? endif;?>
        <input id="Logo" class="Logo" type="file" name="Logo" />
        <input name="deleteLogo" type="submit" value="Delete logo">
    </div>
<?
}
function logoR_display()
{
    $logo = get_option('LogoRUrl');
    ?>
    <div class="inputWrapper">
        <? if ($logo) :?>
            <img id="LogoRUrl" class="LogoUrl" width=200 src="<?=$logo;?>">
        <? endif;?>
        <input id="LogoR" class="Logo" type="file" name="LogoR" />
        <input name="deleteLogoR" type="submit" value="Delete logo">
    </div>
    <?
}
function bgimage_display()
{
    $img = get_option('headbgimageUrl');
    ?>
    <div class="inputWrapper">
        <? if ($img) :?>
            <img id="headbgimageUrl" class="LogoUrl" width=200 src="<?=$img;?>">
        <? endif;?>
        <input id="headbgimage" class="Logo" type="file" name="headbgimage" />
        <input name="deleteheadbgimage" type="submit" value="Delete image">
    </div>
    <?
}
function bgcolor_display(){
    $bgcolor = get_option('headbgcolor');
    ?>
    <label for="headbgcolor"><input type="text" id="headbgcolor" name="headbgcolor" value="<?=$bgcolor;?>"></label>
    <?
}
function headFixed_display(){
    $check = get_option('headFixed');
    ?>
    <label for="headFixed"><input type="checkbox" id="headFixed" name="headFixed" <?=$check ? 'checked' : '';?>></label>
    <?
}
function handle_logo(){//sorry for copy paste
    if (!empty($_FILES["Logo"]["tmp_name"]) || !empty($_FILES["LogoR"]["tmp_name"])) {
        $letter = empty($_FILES["Logo"]["tmp_name"]) ? 'R' : '';
        $res = wp_handle_upload($_FILES["Logo" . $letter], array('test_form' => FALSE));
        update_option('Logo' . $letter . 'Url', $res['url']);
        update_option('Logo' . $letter . 'Path', $res['file']);
        return $res;
    }
    if (!empty($_FILES["headbgimage"]["tmp_name"])) {
        $res = wp_handle_upload($_FILES["headbgimage"], array('test_form' => FALSE));
        update_option('headbgimageUrl', $res['url']);
        update_option('headbgimagePath', $res['file']);
        return $res;
    }

    if (isset($_REQUEST['deleteLogo']) || isset($_REQUEST['deleteLogoR'])) {
        $letter = isset($_REQUEST['deleteLogo']) ? '' : 'R';
        update_option('Logo' . $letter . 'Url', '');
        update_option('Logo' . $letter . 'Path', '');
    }
    if (isset($_REQUEST['deleteheadbgimage'])) {
        update_option('headbgimageUrl', '');
        update_option('headbgimagePath', '');
    }
    return false;
}
function display_theme_panel_fields()
{
    add_settings_section("BackgroundSection", "Header background", null, "theme-options");
    add_settings_field("headbgcolor", "color", "bgcolor_display", "theme-options", "BackgroundSection");
    add_settings_field("headbgimage", "image", "bgimage_display", "theme-options", "BackgroundSection");
    register_setting('section', 'headbgcolor');

    add_settings_section("LogoSection", "Logo", null, "theme-options");
    add_settings_field("logo", "Logo", "logo_display", "theme-options", "LogoSection");
    add_settings_field("logoR", "Logo Retina", "logoR_display", "theme-options", "LogoSection");
    register_setting("section", "Logo", "handle_logo");

    add_settings_section("AnotherSection", "Another options", null, "theme-options");
    add_settings_field("headFixed", "Fixed header", "headFixed_display", "theme-options", "AnotherSection");
    register_setting('section', 'headFixed');
}

add_action("admin_init", "display_theme_panel_fields");