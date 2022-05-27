<?php

add_action( 'init', 'reg_comments' ); // register post type

function reg_comments()
{
    $labels = array
    (
        'name' 					=> 'Comments',
        'singular_name'			=> 'Comment',
        'add_new' 				=> 'Add',
        'add_new_item' 			=> 'Add',
        'edit_item' 			=> 'Edit',
        'new_item' 				=> 'New',
        'all_items' 			=> 'Comments',
        'view_item' 			=> 'View',
        'search_items' 			=> 'Search',
        'not_found' 			=> 'Not found',
        'not_found_in_trash' 	=> 'Not found in trash',
        'menu_name' 			=> 'Comments block'
    );
    $args = array
    (
        'labels' 				=> $labels,
        'public' 				=> false,
        'show_ui' 				=> true,
        'has_archive' 			=> false,
        'menu_icon' 			=> 'dashicons-admin-comments',
        'menu_position' 		=> 10,
        'publicly_queryable'	=> true,
        'supports' 				=> array( 'title','thumbnail', 'custom-fields',),
    );
    register_post_type('comments_block', $args);
}
