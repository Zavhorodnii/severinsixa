<?php

acf_add_local_field_group
(
    array
    (
        'key' => 'options_block_payment_methods_group',
        'title' => 'Payment methods',
        'menu_order' => 15,
        'fields' => array
        (
            array
            (
                'key'               => 'options_block_payment_methods_field',
                'label'             => 'Payment methods',
                'name'              => 'payment_methods',
                'type' 				=> 'gallery',
                'insert' 		    => 'prepend',
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