<?php

acf_add_local_field_group
(
    array
    (
        'key' => 'header_blocks_group',
        'title' => 'Header block',
        'menu_order' => 10,
        'fields' => array
        (
            array
            (
                'key'               => 'header_blocks_group_manin_info_field',
                'label'             => 'Main info',
                'name'              => 'manin_info',
                'type' 				=> 'text',
                'require'			=> 0,
            ),
            array
            (
                'key'               => 'header_blocks_group_site_logo_field',
                'label'             => 'Site Logo',
                'name'              => 'site_logo',
                'type' 				=> 'image',
                'require'			=> 1,
                'return_format'     => 'array',
            ),
            array
            (
                'key'               => 'header_blocks_group_add_header_menu_field',
                'label'             => 'Header menu',
                'name'              => 'add_header_menu',
                'type' 				=> 'repeater',
                'layout'			=> 'block',
                'sub_fields' 		=> array
                (
                    array
                    (
                        'button_label'	=> 'Add section',
                    ),
                ),
                'collapsed'			=> 'header_blocks_group_add_header_menu_title_field',
            ),
            array
            (
                'key'               => 'header_blocks_group_mail_for_contact_field',
                'label'             => 'Send mail',
                'name'              => 'mail_for_contact',
                'type' 				=> 'text',
                'require'			=> 1,
            ),
            array
            (
                'key'               => 'header_blocks_group_popup_message_field',
                'label'             => 'Popup message',
                'name'              => 'popup_message',
                'type' 				=> 'textarea',
                'rows'              => 4,
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
        'key' => 'header_blocks_group_add_header_menu_title_field',
        'label' => 'Title',
        'name' => 'title',
        'type' => 'text',
        'parent' => 'header_blocks_group_add_header_menu_field',
        'require' => 0,
    )
);
acf_add_local_field
(
    array
    (
        'key' => 'header_blocks_group_add_header_menu_link_field',
        'label' => 'Link',
        'name' => 'link',
        'type' => 'text',
        'default_value'     => '#',
        'parent' => 'header_blocks_group_add_header_menu_field',
        'require' => 0,
    )
);

?>