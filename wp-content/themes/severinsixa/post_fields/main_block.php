<?php

acf_add_local_field_group
(
    array
    (
        'key' => 'main_blocks_group',
        'title' => 'Main block',
        'menu_order' => 10,
        'fields' => array
        (
            array
            (
                'key'               => 'main_blocks_group_filter_field',
                'label'             => 'Filter',
                'name'              => 'filter',
                'type' 				=> 'tab',
            ),
            array
            (
                'key'           => 'main_blocks_group_show_count_product_in_filter_field',
                'label'         => 'Show count product in filter',
                'name'          => 'show_count_product_in_filter',
                'type'          => 'number',
                'min'           => 1,
                'require'       => 0,
            ),
            array
            (
                'key'               => 'main_blocks_group_price_filter_field',
                'label'             => 'Price filter',
                'name'              => 'price_filter',
                'type' 				=> 'repeater',
                'layout'			=> 'table',
                'min'               => 1,
                'sub_fields' 		=> array
                (
                    array
                    (
                        'button_label'	=> 'Add section',
                    ),
                ),
                'collapsed'			=> 'intro_title_field',
            ),
            array
            (
                'key'               => 'main_blocks_group_page_404_field',
                'label'             => 'Page 404',
                'name'              => 'page_404',
                'type' 				=> 'tab',
            ),
            array
            (
                'key'               => 'main_blocks_group_page_404_image_field',
                'label'             => 'Image',
                'name'              => 'page_404_image',
                'type' 				=> 'image',
                'require'			=> 1,
                'return_format'     => 'array',
            )
        ),
        'location' => array
        (
            array
            (
                array
                (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'site_main_settings_page',
                ),
            ),
        )
    )
);

acf_add_local_field
(
    array
    (
        'key'           => 'main_blocks_group_price_filter_min_price_field',
        'label'         => 'Min price',
        'name'          => 'min_price',
        'type'          => 'number',
        'min'           =>  1,
        'parent'        => 'main_blocks_group_price_filter_field',
        'require'       => 0,
    )
);
acf_add_local_field
(
    array
    (
        'key'           => 'main_blocks_group_price_filter_max_price_field',
        'label'         => 'Max price',
        'name'          => 'max_price',
        'type'          => 'number',
        'min'           =>  2,
        'parent'        => 'main_blocks_group_price_filter_field',
        'require'       => 0,
    )
);

?>