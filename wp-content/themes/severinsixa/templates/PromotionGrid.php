<?php

class BlogSectionPromotionGrid {

    private $id = 'promotion-grid';
    private $name = 'Promotion Grid';

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
        wp_enqueue_style( $this->id, get_theme_file_uri('assets/index/Promotion Grid/Promotion Grid.css') );
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
        <section class="highlights">
            <div class="container">
                <h2 class="title highlights-main__title"><?php echo get_field('title') ?></h2>
                <div class="highlights__inner">
                    <div class="swiper-wrapper">
                        <?php
                        $promotion_grid = get_field('promotion_grid');
                        if ( is_array( $promotion_grid ) )
                            foreach ($promotion_grid as $item){
                                ?>
                                <a class="highlights__item swiper-slide" href="<?php echo isset($item['section_category']) ? get_term_link($item['section_category']) : '' ?>">
                                    <picture class="highlights__img">
                                        <source srcset="" type="image/webp">
                                        <?php
                                        if (is_array($item['image'])){
                                            ?>
                                            <img src="<?php echo $item['image']['url'] ?>" alt="<?php echo $item['image']['alt'] ?>">
                                            <?php
                                        }
                                        ?>
                                    </picture>
                                    <div class="highlights__info">
                                        <p class="highlights__title h4"><?php echo $item['title'] ?>
                                        </p>
                                        <p class="highlights__text body-m"><?php echo $item['description'] ?>
                                        </p>
                                        <div class="btn btn--trans">
                                            <?php echo $item['button']['title'] ?>
                                        </div>
                                    </div>
                                </a>
                                <?php
                            }
                        ?>
                    </div>
                    <div class="highlights__progressbar progressbar"></div>
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
				'key' => 'promotion_grid_group',
				'title' => 'Promotion Grid',
				'fields' => array 
				(
                    array
                    (
                        'key'               => 'promotion_grid_group_field',
                        'label'             => 'Title',
                        'name'              => 'title',
                        'type' 				=> 'text',
                        'require'			=> 0,
                    ),
					array 
					(
						'key'               => 'promotion_grid_field',
						'label'             => 'Promotion Grid',
						'name'              => 'promotion_grid',
						'type' 				=> 'repeater',
						'layout'			=> 'block',
						'sub_fields' 		=> array
						(
							array
							(
								'button_label'	=> 'Add section',
							),
						),
						'collapsed'			=> 'promotion_grid_title_field',
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
                'key'               => 'promotion_grid_section_category_field',
                'label'             => 'Section',
                'name'              => 'section_category',
                'type' 				=> 'taxonomy',
                'field_type'        => 'select',
                'parent'            => 'promotion_grid_field',
                'require'			=> 1,
                'taxonomy'			=> 'product_cat',
                'ui'				=> 0,
            )
		);
        acf_add_local_field
        (
            array
            (
                'key'               => 'promotion_grid_image_field',
                'label'             => 'Image',
                'name'              => 'image',
                'type' 				=> 'image',
                'parent'            => 'promotion_grid_field',
                'require'			=> 1,
                'return_format'     => 'array',

            )
        );
		acf_add_local_field
		(
			array
			(
				'key'               => 'promotion_grid_title_field',
				'label'             => 'Title',
				'name'              => 'title',
				'type' 				=> 'text',
				'parent'            => 'promotion_grid_field',
				'require'			=> 0,
			)
		);
        acf_add_local_field
		(
            array
            (
                'key'               => 'category_description_field',
                'label'             => 'Description',
                'name'              => 'description',
                'type'              => 'textarea',
                'parent'            => 'promotion_grid_field',
                'require'			=> 0,
            ),
		);
		acf_add_local_field
		(
			array
			(
				'key'               => 'promotion_grid_button_group_field',
				'label'             => 'Button',
				'name'              => 'button',
				'type' 				=> 'group',
				'parent'            => 'promotion_grid_field',
				'require'			=> 0,
			)
		);

        acf_add_local_field
        (
            array
            (
                'key'               => 'promotion_grid_button_group_title_field',
                'label'             => 'Title',
                'name'              => 'title',
                'type' 				=> 'text',
                'parent'            => 'promotion_grid_button_group_field',
                'require'			=> 0,
            )
        );
	}
}

new BlogSectionPromotionGrid();


?>