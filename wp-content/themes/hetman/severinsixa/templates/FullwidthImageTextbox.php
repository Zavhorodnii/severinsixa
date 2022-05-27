<?php

class BlogSectionFullwidthImageTextbox {

    private $id = 'fullwidth-image-textbox';
    private $name = 'Fullwidth Image + Textbox';

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
        wp_enqueue_style( $this->id, get_theme_file_uri('assets/index/Fullwidth Image + Textbox/Fullwidth Image + Textbox.css') );
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
        ?>
        <section class="severin">
            <picture class="severin__bg">
                <source srcset="" type="image/webp">
                <img src="<?php echo get_field('image')['url'] ?>" alt="<?php echo get_field('image')['alt'] ?>">
            </picture>
            <div class="container">
                <div class="severin__inner">
                    <div class="severin__info">
                        <h2 class="severin__title h3"><?php echo get_field('title')?></h2>
                        <p class="severin__descr body-m"><?php echo get_field('description')?></p>
                        <a class="severin__btn btn btn--trans" href="<?php echo get_field('button')['link'] ?>">
                            <?php echo get_field('button')['title'] ?>
                        </a>
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
				'key' => 'blog_full_grid_group',
				'title' => 'Blog Grid',
				'fields' => array 
				(
                    array
                    (
                        'key'               => 'blog_full_image_field',
                        'label'             => 'Image',
                        'name'              => 'image',
                        'type' 				=> 'image',
                        'require'			=> 1,
                        'return_format'     => 'array',

                    ),
                    array
                    (
                        'key'               => 'blog_full_grid_title_field',
                        'label'             => 'Title',
                        'name'              => 'title',
                        'type' 				=> 'text',
                        'require'			=> 0,
                    ),
                    array
                    (
                        'key'               => 'blog_full_grid_description_field',
                        'label'             => 'Description',
                        'name'              => 'description',
                        'type'              => 'textarea',
                        'new_lines'         => 'br',
                        'require'			=> 0,
                    ),
                    array
                    (
                        'key'               => 'blog_full_grid_button_field',
                        'label'             => 'Button',
                        'name'              => 'button',
                        'type' 				=> 'group',
                        'require'			=> 0,
                    )
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
                'key'               => 'blog_full_grid_button_title_field',
                'label'             => 'Title',
                'name'              => 'title',
                'type' 				=> 'text',
                'parent'            => 'blog_full_grid_button_field',
                'require'			=> 0,
            )
        );
        acf_add_local_field
        (
            array
            (
                'key'               => 'blog_full_grid_button_link_field',
                'label'             => 'link',
                'name'              => 'link',
                'default_value'     => '#',
                'type' 				=> 'text',
                'parent'            => 'blog_full_grid_button_field',
                'require'			=> 0,
            )
        );

	}
}

new BlogSectionFullwidthImageTextbox();


?>