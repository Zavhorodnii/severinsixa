<?php


add_action('init', 'reg_product_cat_template'); // register post type

function reg_product_cat_template()
{
    $labels = array
    (
        'name' => 'Category templates',
        'singular_name' => 'Category template',
        'add_new' => 'Add',
        'add_new_item' => 'Add',
        'edit_item' => 'Edit',
        'new_item' => 'New',
        'all_items' => 'Category templates',
        'view_item' => 'View',
        'search_items' => 'Search',
        'not_found' => 'Not found',
        'not_found_in_trash' => 'Not found in trash',
        'menu_name' => 'Category templates'
    );
    $args = array
    (
        'labels' => $labels,
        'public' => false,
        'show_ui' => true,
        'has_archive' => false,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-excerpt-view',
        'menu_position' => 10,
        'publicly_queryable' => true,
        'supports' 				=> array( 'title','thumbnail', 'custom-fields', 'editor', ),
    );
    register_post_type('product_cat_template', $args);
}
