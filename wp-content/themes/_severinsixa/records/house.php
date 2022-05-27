<?php

add_action( 'init', 'reg_house' ); // register post type

function reg_house()
{
    $labels = array
    (
        'name' 					=> 'Дома',
        'singular_name'			=> 'Дом',
        'add_new' 				=> 'Добавить',
        'add_new_item' 			=> 'Добавить',
        'edit_item' 			=> 'Редактировать',
        'new_item' 				=> 'Новая',
        'all_items' 			=> 'Дома',
        'view_item' 			=> 'Просмотреть',
        'search_items' 			=> 'Поиск',
        'not_found' 			=> 'Решение не найдено',
        'not_found_in_trash' 	=> 'В корзине не найдено',
        'menu_name' 			=> 'Дома'
    );
    $args = array
    (
        'labels' 				=> $labels,
        'public' 				=> true,
        'show_ui' 				=> true,
        'has_archive' 			=> false,
        'menu_icon' 			=> 'dashicons-admin-home',
        'menu_position' 		=> 10,
        'publicly_queryable'	=> true,
        'supports' 				=> array( 'title','thumbnail', 'custom-fields',),
    );
    register_post_type('house', $args);
}
