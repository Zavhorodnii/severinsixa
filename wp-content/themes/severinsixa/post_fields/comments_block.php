<?php

acf_add_local_field_group
(
    array
    (
        'key' => 'comments_block_group',
        'title' => 'Comments block',
        'position'  => 'acf_after_title',
        'fields' => array
        (
            array
            (
                'key'               => 'comments_block_group_star_field',
                'label'             => 'Star',
                'name'              => 'stars',
                'type' 				=> 'number',
                'default_value'     => '5',
                'min'               => 1,
                'max'               => 5,
//                'require' => 1,
            ),
            array
            (
                'key'               => 'comments_block_group_date_field',
                'label'             => 'Date',
                'name'              => 'date',
                'type' 				=> 'date_picker',
                'display_format'    => 'd.m.Y',
                'return_format'     => 'd.m.Y',
                'require' => 1,
            ),
            array
            (
                'key'               => 'comments_block_group_title_field',
                'label'             => 'Title',
                'name'              => 'title',
                'type' 				=> 'text',
                'require'			=> 0,
            ),
            array
            (
                'key'               => 'comments_block_group_comment_field',
                'label'             => 'Comment',
                'name'              => 'comment',
                'type'              => 'textarea',
                'new_lines'         => 'br',
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
                    'value' => 'comments_block',
                ),
            ),
        )
    )
);

//acf_add_local_field
//(
//    array
//    (
//        'key' => 'intro_title_field',
//        'label' => 'Title',
//        'name' => 'title',
//        'type' => 'text',
//        'parent' => 'intro_field',
//        'require' => 0,
//    )
//);

?>