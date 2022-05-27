<?php

class BlogSectionCategoryGrid {

    private $id = 'category-grid';
    private $name = 'Category Grid';

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
        wp_enqueue_style( $this->id, get_theme_file_uri('assets/index/Category Grid/Category Grid.css') );
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
        <section class="category">
            <div class="container">
                <h2 class="category__title title">
                    <?php echo get_field('title') ?>
                </h2>
                <div class="category__slider">
                    <div class="swiper-wrapper">
                        <?php
                        $category_grid = get_field('category_grid');
                        if(is_array($category_grid)){
                            foreach ( $category_grid as $item ){
                                if ($item['section_category'] == null)
                                    continue;
                                $image_id           = get_term_meta( $item['section_category']->term_id, 'thumbnail_id', true );
                                $post_thumbnail_img = wp_get_attachment_image_src( $image_id, 'large' );
                                ?>
                                <a class="swiper-slide category__slide" href="<?php echo get_term_link($item['section_category']->term_id) ?>">
                                    <picture class="category__img">
                                        <source srcset="" type="image/webp">
                                        <img src="<?php echo $image_id ? $post_thumbnail_img[0] : '' ?>" alt="<?php echo get_post_meta($image_id, '_wp_attachment_image_alt', TRUE); ?>">
                                    </picture>
                                    <p class="category__name h4"><?php echo $item['section_category']->name ?></p>
                                </a>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <div class="category__progressbar progressbar"></div>
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
				'key' => 'category_grid_group',
				'title' => 'Category Grid',
				'fields' => array 
				(
                    array
                    (
                        'key'               => 'category_grid_group_field',
                        'label'             => 'Title',
                        'name'              => 'title',
                        'type' 				=> 'text',
                        'require'			=> 0,
                    ),
					array 
					(
						'key'               => 'category_grid_field',
						'label'             => 'Category Grid',
						'name'              => 'category_grid',
						'type' 				=> 'repeater',
						'layout'			=> 'block',
						'sub_fields' 		=> array
						(
							array
							(
								'button_label'	=> 'Add section',
							),
						),
						'collapsed'			=> 'category_grid_title_field',
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
                'key'               => 'category_grid_section_category_field',
                'label'             => 'Section',
                'name'              => 'section_category',
                'type' 				=> 'taxonomy',
                'field_type'        => 'select',
                'return_format'     => 'object',
                'parent'            => 'category_grid_field',
                'require'			=> 1,
                'taxonomy'			=> 'product_cat',
                'ui'				=> 0,
            )
		);

	}
}

new BlogSectionCategoryGrid();


?>