<?php

class BlogSectionFullWidthBanner {

    private $id = 'full-width-banner';
    private $name = 'Full width banner';

    public function __construct() {
        add_action('acf/init', array($this, 'register_block'));
		add_action('acf/init', array($this, 'RegisterMainFields'));
    }

   
    public function register_block() {
    
        // check function exists.
        if( function_exists('acf_register_block_type') ) {
    
            // register a testimonial block.
            acf_register_block_type(array(
                'name'              => $this->id,
                'title'             => __($this->name),
                'render_callback'   => array($this, 'render'),
                'category'          => 'formatting',
                'mode'              => 'preview',
                'enqueue_assets' => array($this, 'enqueue_assets'),
            ));
        }
    }

    public function enqueue_assets() {
        wp_enqueue_style( $this->id, get_theme_file_uri('assets/subcategory-page/Full width banner.css') );
    }
    
    /**
     * Testimonial Block Callback Function.
     *
     * @param   array $block The block settings and attributes.
     * @param   string $content The block inner HTML (empty).
     * @param   bool $is_preview True during AJAX preview.
     * @param   (int|string) $post_id The post ID this block is saved to.
     */
    public function render( $block, $content = '', $is_preview = false, $post_id = 0 ) {
        wp_reset_postdata();

        $image_field = get_field('image_field');
        ?>

        <section class="help-block">
            <picture class="help-block__img">
                <source srcset="" type="image/webp">
                <img src="<?php echo is_array($image_field) ? $image_field['url'] : '' ?>"
                     alt="<?php echo is_array($image_field) ? $image_field['alt'] : '' ?>">
            </picture>
            <div class="container">
                <div class="help-block__inner">
                    <div class="help-block__wrapper">
                        <h2 class="help-block__title h2"><?php echo get_field('title') ?></h2>
                        <p class="help-block__text body-l"><?php echo get_field('description') ?></p>
                        <div class="help-block__nav">
                            <a class="help-block__btn btn btn--trans" href="<?php echo get_field('button_left')['link'] ?>">
                                <?php echo get_field('button_left')['title'] ?>
                            </a>
                            <a class="help-block__btn btn btn--trans" href="<?php echo get_field('button_right')['link'] ?>">
                                <?php echo get_field('button_right')['title'] ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php
    }

	public function RegisterMainFields() {
		acf_add_local_field_group
		(
			array
			(
				'key'       => 'full_width_banner_group',
				'title'     => 'Full width banner',
				'fields'    => array
				(
                    array
                    (
                        'key'               => 'full_width_banner_group_image_field',
                        'label'             => 'Image',
                        'name'              => 'image_field',
                        'type' 				=> 'image',
                        'require'			=> 1,
                        'return_format'     => 'array',
                    ),
                    array
                    (
                        'key'               => 'full_width_banner_group_title_field',
                        'label'             => 'Title',
                        'name'              => 'title',
                        'type' 				=> 'text',
                        'require'			=> 1,
                    ),
                    array
                    (
                        'key'               => 'full_width_banner_group_description_field',
                        'label'             => 'Description',
                        'name'              => 'description',
                        'type' 				=> 'textarea',
                        'rows'              => 4,
                        'new_lines'         => 'br',
                        'require'			=> 0,
                    ),
                    array
                    (
                        'key'               => 'full_width_banner_group_button_left_field',
                        'label'             => 'Button left',
                        'name'              => 'button_left',
                        'type' 				=> 'group',
                        'require'			=> 0,
                    ),
                    array
                    (
                        'key'               => 'full_width_banner_group_button_right_field',
                        'label'             => 'Button right',
                        'name'              => 'button_right',
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
							'param' 		=> 'block',
							'operator' 		=> '==',
							'value' 		=> 'acf/' . $this->id,
						),
					),
				)
			)
		);
        acf_add_local_field
        (
            array
            (
                'key'               => 'full_width_banner_group_button_left_title_field',
                'label'             => 'Title',
                'name'              => 'title',
                'type' 				=> 'text',
                'parent'            => 'full_width_banner_group_button_left_field',
                'require'			=> 0,
            )
        );
        acf_add_local_field
        (
            array
            (
                'key'               => 'full_width_banner_group_button_left_link_field',
                'label'             => 'Link',
                'name'              => 'link',
                'type' 				=> 'text',
                'default_value'     => '#',
                'parent'            => 'full_width_banner_group_button_left_field',
                'require'			=> 0,
            )
        );
        acf_add_local_field
        (
            array
            (
                'key'               => 'full_width_banner_group_button_left_title_field',
                'label'             => 'Title',
                'name'              => 'title',
                'type' 				=> 'text',
                'parent'            => 'full_width_banner_group_button_left_field',
                'require'			=> 0,
            )
        );
        acf_add_local_field
        (
            array
            (
                'key'               => 'full_width_banner_group_button_left_link_field',
                'label'             => 'Link',
                'name'              => 'link',
                'type' 				=> 'text',
                'default_value'     => '#',
                'parent'            => 'full_width_banner_group_button_left_field',
                'require'			=> 0,
            )
        );
        acf_add_local_field
        (
            array
            (
                'key'               => 'full_width_banner_group_button_right_field_title_field',
                'label'             => 'Title',
                'name'              => 'title',
                'type' 				=> 'text',
                'parent'            => 'full_width_banner_group_button_right_field',
                'require'			=> 0,
            )
        );
        acf_add_local_field
        (
            array
            (
                'key'               => 'full_width_banner_group_button_right_field_link_field',
                'label'             => 'Link',
                'name'              => 'link',
                'type' 				=> 'text',
                'default_value'     => '#',
                'parent'            => 'full_width_banner_group_button_right_field',
                'require'			=> 0,
            )
        );

	}
}

new BlogSectionFullWidthBanner();


?>