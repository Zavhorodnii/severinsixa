<?php

acf_add_local_field_group
(
    array
    (
        'key' => 'post_blocks_group',
        'title' => 'Post description',
        'fields' => array
        (
            array
            (
                'key'               => 'post_group_description_field',
                'label'             => 'Description',
                'name'              => 'description',
                'type' 				=> 'textarea',
                'new_lines'         => 'br'
//                'require' => 1,
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
                    'value' => 'post',
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