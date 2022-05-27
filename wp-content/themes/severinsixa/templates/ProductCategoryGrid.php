<?php

class BlogSectionProductCategoryGrid {

    private $id = 'product-category-grid';
    private $name = 'Product Category Grid';

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
        wp_enqueue_style( $this->id, get_theme_file_uri('assets/theme-page/Product Category Grid/Product Category Grid.css') );
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


        <section class="category-nav category-nav--theme">
            <div class="container">
                <div class="category-nav__wrapper">
                    <?php
                    $categories = get_field('categories');
                    if(is_array($categories)){
                        foreach ($categories as $category){
                            $image_id           = get_term_meta( $category->term_id, 'thumbnail_id', true );
                            $post_thumbnail_img = wp_get_attachment_image_src( $image_id, 'large' );
                            ?>

                            <a class="category-nav__item" href="<?php echo get_term_link($category->term_id) ?>">
                                <picture>
                                    <source srcset="" type="image/webp">
                                    <img src="<?php echo $image_id ? $post_thumbnail_img[0] : '' ?>"
                                         alt="<?php echo get_post_meta($image_id, '_wp_attachment_image_alt', TRUE); ?>">
                                </picture>
                                <p class="category-nav__name h4"><?php echo $category->name ?></p>
                            </a>

                            <?php
                        }
                    }
                    ?>

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
				'key' => 'product_category_grid_group',
				'title' => 'Product Category Grid',
				'fields' => array 
				(
                    array
                    (
                        'key'               => 'product_category_grid_group_taxonomy_field',
                        'label'             => 'Categories',
                        'name'              => 'categories',
                        'type' 				=> 'taxonomy',
                        'return_format'     => 'object',
                        'taxonomy'          => 'product_cat',
                        'multiple'          => 1,
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

	}
}

new BlogSectionProductCategoryGrid();


?>