<?php

acf_add_local_field_group
(
    array
    (
        'key'           => 'options_product_settings_blocks_group',
        'title'         => 'Product settings',
        'menu_order'    => 11,
        'fields'        => array
        (
            array
            (
                'key'               => 'options_product_settings_blocks_product_availability_field',
                'label'             => 'Product availability',
                'name'              => 'product_availability',
                'type' 				=> 'group',
                'require'			=> 0,
            ),
        ),
        'location' => array
        (
            array
            (
                array
                (
                    'param'         => 'options_page',
                    'operator'      => '==',
                    'value'         => 'site_main_product_settings_page',
                ),
            ),
        )
    )
);

acf_add_local_field
(
    array
    (
        'key'               => 'options_product_settings_blocks_product_availability_in_stock_field',
        'label'             => 'In stock',
        'name'              => 'in_stock',
        'type'              => 'text',
        'default_value'     => 'In stock',
        'parent'            => 'options_product_settings_blocks_product_availability_field',
        'require'           => 1,
    )
);
acf_add_local_field
(
    array
    (
        'key'               => 'options_product_settings_blocks_product_availability_out_of_stock_field',
        'label'             => 'Out of stock',
        'name'              => 'out_of_stock',
        'type'              => 'text',
        'default_value'     => 'Out of stock',
        'parent'            => 'options_product_settings_blocks_product_availability_field',
        'require'           => 1,
    )
);

?>