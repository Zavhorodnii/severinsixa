<?php

acf_add_local_field_group
(
    array
    (
        'key' => 'options_block__group',
        'title' => 'Settings block',
        'menu_order' => 10,
        'fields' => array
        (
            array
            (
                'key'               => 'options_block_group_title1_field',
                'label'             => 'Title star 1',
                'name'              => 'title1',
                'type' 				=> 'text',
                'require'			=> 0,
            ),
            array
            (
                'key'               => 'options_block_group_title2_field',
                'label'             => 'Title star 2',
                'name'              => 'title2',
                'type' 				=> 'text',
                'require'			=> 0,
            ),
            array
            (
                'key'               => 'options_block_group_title3_field',
                'label'             => 'Title star 3',
                'name'              => 'title3',
                'type' 				=> 'text',
                'require'			=> 0,
            ),
            array
            (
                'key'               => 'options_block_group_title4_field',
                'label'             => 'Title star 4',
                'name'              => 'title4',
                'type' 				=> 'text',
                'require'			=> 0,
            ),
            array
            (
                'key'               => 'options_block_group_title5_field',
                'label'             => 'Title star 5',
                'name'              => 'title5',
                'type' 				=> 'text',
                'require'			=> 0,
            ),
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


?>