<?php
require_once 'options/options.php';
//require_once 'records/records.php';
//require_once 'taxonomy/taxonomy.php';
//require_once 'rewrite/rewrite.php';
//require_once 'ajax/ajax.php';
require_once 'templates/templates.php';

//require_once 'telegram_bot/bot.php';

// on thumbnails for post
add_theme_support('post-thumbnails');
//// on title tag
add_theme_support('title-tag');

add_action('init', 'register_menus');
function register_menus(){
    $locations = array(
        //'example' => __('Example Menu', 'theme'),
//        'header'        => 'Шапка',
    );

    register_nav_menus( $locations );
}

function webp_upload_mimes($existing_mimes){
    $existing_mimes['webp'] = 'image/webp';
    return $existing_mimes;
}
add_filter('mime_types', 'webp_upload_mimes');


// правильный способ подключить стили и скрипты
add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );
add_action( 'enqueue_block_editor_assets', 'theme_name_scripts' );
function theme_name_scripts() {
    wp_enqueue_style( 'footer', get_template_directory_uri() . '/assets/footer.css' );
    wp_enqueue_style( 'global', get_template_directory_uri() . '/assets/global.css' );
    wp_enqueue_style( 'header', get_template_directory_uri() . '/assets/header.css' );
    wp_enqueue_style( 'main', get_template_directory_uri() . '/assets/main.css' );
    wp_enqueue_style( 'popup', get_template_directory_uri() . '/assets/popup.css' );
    wp_enqueue_style( 'vendor', get_template_directory_uri() . '/assets/vendor.css' );

//    wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/example.js', array(), '1.0.0', true );
}

function footer_scripts(){
    wp_deregister_script('jquery');

    wp_enqueue_script('header', get_template_directory_uri() .'/assets/header.js');
    wp_enqueue_script('popup', get_template_directory_uri() .'/assets/popup.js');
}
add_action('get_footer', 'footer_scripts', 50);

