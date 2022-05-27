<?php

acf_add_local_field_group
(
    array
    (
        'key'           => 'user_page_group',
        'title'         => 'User page',
        'menu_order'    => 1,
        'position'      => 'acf_after_title',
        'fields'        => array
        (
            array
            (
                'key'               => 'user_page_group_credit_card_number_field',
                'label'             => 'Credit card number',
                'name'              => 'credit_card_number',
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
                    'param'         => 'user_form',
                    'operator'      => '==',
                    'value'         => 'edit',
                ),
            ),
        )
    )
);

?>