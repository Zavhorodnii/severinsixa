<?php

acf_add_local_field_group
(
    array
    (
        'key' => 'salutation__group',
        'title' => 'Settings block',
        'menu_order' => 10,
        'fields' => array
        (
            array
            (
                'key'               => 'salutation__group_salutation_field',
                'label'             => 'Salutation',
                'name'              => 'salutation',
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
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'shop_order',
                ),
            ),
        )
    )
);


?>