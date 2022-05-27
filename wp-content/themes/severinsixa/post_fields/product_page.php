<?php

acf_add_local_field_group
(
    array
    (
        'key' => 'product_page_blocks_group',
        'title' => 'Footer block',
        'menu_order' => 20,
        'fields' => array
        (
            array
            (
                'key'               => 'product_page_blocks_group_product_model_field',
                'label'             => 'Product model',
                'name'              => 'product_model',
                'type' 				=> 'text',
                'require'			=> 0,
            ),
            array
            (
                'key'               => 'product_page_blocks_group_reviews_field',
                'label'             => 'Reviews',
                'name'              => 'product_page_blocks_reviews',
                'type' 				=> 'repeater',
                'layout'			=> 'block',
                'sub_fields' 		=> array
                (
                    array
                    (
                        'button_label'	=> 'Add section',
                    ),
                ),
                'collapsed'			=> 'product_page_blocks_group_reviews_date_field',
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
                    'value' => 'product',
                ),
            ),
        )
    )
);



acf_add_local_field
(
    array
    (
        'key'               => 'product_page_blocks_group_reviews_stars_field',
        'label'             => 'Star',
        'name'              => 'stars',
        'type' 				=> 'number',
        'default_value'     => '5',
        'parent'            => 'product_page_blocks_group_reviews_field',
        'min'               => 1,
        'max'               => 5,
    ),
);
acf_add_local_field
(
    array
    (
        'key'               => 'product_page_blocks_group_reviews_date_field',
        'label'             => 'Date',
        'name'              => 'date',
        'type' 				=> 'date_picker',
        'display_format'    => 'd.m.Y',
        'return_format'     => 'd.m.Y',
        'parent'            => 'product_page_blocks_group_reviews_field',
        'require' => 1,
    ),
);
acf_add_local_field
(
    array
    (
        'key'               => 'product_page_blocks_group_reviews_confirmed_field',
        'label'             => 'Confirmed',
        'name'              => 'confirmed',
        'type'              => 'true_false',
        'parent'            => 'product_page_blocks_group_reviews_field',
        'require'			=> 0,
    ),
);
acf_add_local_field
(
    array
    (
        'key'               => 'product_page_blocks_group_reviews_comment_field',
        'label'             => 'Comment',
        'name'              => 'comment',
        'type'              => 'textarea',
        'new_lines'         => 'br',
        'require'			=> 0,
        'parent'            => 'product_page_blocks_group_reviews_field',
    ),
);


?>