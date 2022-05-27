<?php

acf_add_local_field_group
(
    array
    (
        'key' => 'footer_blocks_group',
        'title' => 'Footer block',
        'menu_order' => 20,
        'fields' => array
        (
            array
            (
                'key'               => 'footer_blocks_group_image_field',
                'label'             => 'Image',
                'name'              => 'image',
                'type' 				=> 'image',
                'require'			=> 1,
                'return_format'     => 'array',
            ),
            array
            (
                'key'               => 'footer_blocks_group_copyright_field',
                'label'             => 'Copyright',
                'name'              => 'copyright',
                'type' 				=> 'text',
                'require'			=> 0,
            ),
            array
            (
                'key'               => 'footer_blocks_group_gallery_field',
                'label'             => 'Images',
                'name'              => 'footer_images',
                'type' 				=> 'gallery',
                'insert' 		    => 'prepend',
                'require'			=> 0,
            ),

            array
            (
                'key'               => 'footer_blocks_group_add_footer_menu_field',
                'label'             => 'Footer menu',
                'name'              => 'add_footer_menu',
                'type' 				=> 'repeater',
                'layout'			=> 'block',
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
                'key'               => 'footer_blocks_group_add_footer_social_menu_field',
                'label'             => 'Social footer menu',
                'name'              => 'add_social_footer_menu',
                'type' 				=> 'repeater',
                'layout'			=> 'block',
                'sub_fields' 		=> array
                (
                    array
                    (
                        'button_label'	=> 'Add section',
                    ),
                ),
                'collapsed'			=> 'intro_title_field',
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

acf_add_local_field
(
    array
    (
        'key' => 'footer_blocks_group_add_footer_menu_title_field',
        'label' => 'Title',
        'name' => 'title',
        'type' => 'text',
        'parent' => 'footer_blocks_group_add_footer_menu_field',
        'require' => 0,
    )
);
acf_add_local_field
(
    array
    (
        'key' => 'footer_blocks_group_add_footer_menu_link_field',
        'label' => 'Link',
        'name' => 'link',
        'type' => 'text',
        'default_value'     => '#',
        'parent' => 'footer_blocks_group_add_footer_menu_field',
        'require' => 0,
    )
);
acf_add_local_field
(
    array
    (
        'key'               => 'footer_blocks_group_add_footer_menu_icon_field',
        'label'             => 'Icon',
        'name'              => 'icon',
        'type' 				=> 'image',
        'parent'            => 'footer_blocks_group_add_footer_social_menu_field',
        'require'			=> 1,
        'return_format'     => 'array',

    )
);
acf_add_local_field
(
    array
    (
        'key' => 'footer_blocks_group_add_footer_menu_link_field',
        'label' => 'Link',
        'name' => 'link',
        'type' => 'text',
        'default_value'     => '#',
        'parent' => 'footer_blocks_group_add_footer_social_menu_field',
        'require' => 0,
    )
);

?>