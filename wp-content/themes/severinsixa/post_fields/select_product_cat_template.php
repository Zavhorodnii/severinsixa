<?php

acf_add_local_field_group
(
    array
    (
        'key' => 'select_product_cat_template',
        'title' => 'Select product template',
        'menu_order' => 20,
        'fields' => array
        (
            array
            (
                'key'               => 'select_product_cat_template_template_field',
                'label'             => 'Template',
                'name'              => 'product_cat_template',
                'type' 				=> 'post_object',
                'return_format'     => 'object',
                'post_type'         => 'product_cat_template',
                'require'			=> 0,
            ),
        ),
        'location' => array
        (
            array
            (
                array
                (
                    'param' => 'taxonomy',
                    'operator' => '==',
                    'value' => 'product_cat',
                ),
            ),
        )
    )
);


?>