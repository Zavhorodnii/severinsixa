<?php

acf_add_local_field_group
(
    array
    (
        'key' => 'acf_contact_template_group',
        'title' => 'Contact template',
        'menu_order' => 10,
        'position'  => 'acf_after_title',
        'fields' => array
        (
            array
            (
                'key'               => 'acf_contact_template_group_sub_title_field',
                'label'             => 'Sub title',
                'name'              => 'sub_title',
                'type'              => 'text',
                'require'           => 0,
            ),
            array
            (
                'key'               => 'acf_contact_template_group_content_field',
                'label'             => 'Content',
                'name'              => 'content',
                'type'              => 'wysiwyg',
                'require'           => 0,
            ),
            array
            (
                'key'               => 'acf_contact_template_group_reason_petition_field',
                'label'             => 'The reason for petition',
                'name'              => 'reason_petition',
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
                'key'               => 'acf_contact_template_group_right_block_field',
                'label'             => 'Right block',
                'name'              => 'right_block',
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
                'collapsed'			=> 'acf_contact_template_group_right_block_title_field',
            ),
            array
            (
                'key'               => 'acf_contact_template_group_iframe_map_field',
                'label'             => 'Iframe map',
                'name'              => 'iframe_map',
                'type'              => 'textarea',
                'require'           => 0,
            ),
            array
            (
                'key'               => 'acf_contact_template_group_image_field',
                'label'             => 'Image',
                'name'              => 'image',
                'type' 				=> 'image',
                'require'			=> 1,
                'return_format'     => 'array',
            ),
        ),
        'location' => array
        (
            array
            (
                array
                (
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'template-contact.php',
                ),
            ),
        )
    )
);

acf_add_local_field
(
    array
    (
        'key'           => 'acf_contact_template_group_reason_petition_title_field',
        'label'         => 'Title',
        'name'          => 'title',
        'type'          => 'text',
        'min'           =>  1,
        'parent'        => 'acf_contact_template_group_reason_petition_field',
        'require'       => 0,
    )
);
acf_add_local_field
(
    array
    (
        'key'           => 'acf_contact_template_group_right_block_title_field',
        'label'         => 'Title',
        'name'          => 'title',
        'type'          => 'text',
        'min'           =>  1,
        'parent'        => 'acf_contact_template_group_right_block_field',
        'require'       => 0,
    )
);
acf_add_local_field
(
    array
    (
        'key'               => 'acf_contact_template_group_right_block_content_field',
        'label'             => 'Content',
        'name'              => 'content',
        'type'              => 'wysiwyg',
        'require'           => 0,
        'parent'            => 'acf_contact_template_group_right_block_field',
    ),
);
acf_add_local_field
(
    array
    (
        'key'           => 'acf_contact_template_group_right_block_link_field',
        'label'         => 'Link',
        'name'          => 'link',
        'type'          => 'group',
        'min'           =>  1,
        'parent'        => 'acf_contact_template_group_right_block_field',
        'require'       => 0,
    )
);

acf_add_local_field
(
    array
    (
        'key'           => 'acf_contact_template_group_right_block_link_title_field',
        'label'         => 'Title',
        'name'          => 'title',
        'type'          => 'text',
        'min'           =>  1,
        'parent'        => 'acf_contact_template_group_right_block_link_field',
        'require'       => 0,
    )
);
acf_add_local_field
(
    array
    (
        'key'               => 'acf_contact_template_group_right_block_link_link_field',
        'label'             => 'Link',
        'name'              => 'link',
        'type'              => 'text',
        'default_value'     => '#',
        'parent'            => 'acf_contact_template_group_right_block_link_field',
        'require'           => 0,
    )
);

?>