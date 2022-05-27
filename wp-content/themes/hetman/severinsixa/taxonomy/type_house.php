<?php

add_action( 'init', 'create_taxonomy' );
function create_taxonomy(){

    // список параметров: wp-kama.ru/function/get_taxonomy_labels
    register_taxonomy( 'tax_type_house', [ 'house' ], [
        'label'                 => '', // определяется параметром $labels->name
        'labels'                => [
            'name'              => 'Тип дома',
            'singular_name'     => 'Тип дома',
            'search_items'      => 'Поиск',
            'all_items'         => 'Все',
            'view_item '        => 'Просмотреть',
            'parent_item'       => 'Родительский тип дома',
            'parent_item_colon' => 'Родительский тип дома:',
            'edit_item'         => 'Править',
            'update_item'       => 'Обновить',
            'add_new_item'      => 'Создать',
            'new_item_name'     => 'Новое имя',
            'menu_name'         => 'Тип дома',
            'back_to_items'     => '← Вернуться',
        ],
        'description'           => '', // описание таксономии
        'public'                => true,
        // 'publicly_queryable'    => null, // равен аргументу public
         'show_in_nav_menus'     => true, // равен аргументу public
         'show_ui'               => true, // равен аргументу public
         'show_in_menu'          => true, // равен аргументу show_ui
        // 'show_tagcloud'         => true, // равен аргументу show_ui
        // 'show_in_quick_edit'    => null, // равен аргументу show_ui
        'hierarchical'          => true,

        'rewrite'               => true,
        //'query_var'             => $taxonomy, // название параметра запроса
        'capabilities'          => array(),
        'meta_box_cb'           => null, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
        'show_admin_column'     => false, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
        'show_in_rest'          => null, // добавить в REST API
        'rest_base'             => null, // $taxonomy
        'sort'                  => false,
        // '_builtin'              => false,
        //'update_count_callback' => '_update_post_term_count',
    ] );
}
