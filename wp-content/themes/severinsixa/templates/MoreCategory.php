<?php

class BlogSectionMoreCategory {

    private $id = 'more-category';
    private $name = 'More category';

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
        wp_enqueue_style( $this->id, get_theme_file_uri('assets/index/Product Grid/Product Grid.css') );
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

        <section class="more-category">
            <div class="container">
                <h2 class="more-category__title title title-center">
                    <?php echo get_field('title') ?>
                </h2>
                <div class="more-category__wrapper">
                    <?php
                    $categories = get_field('categories');
                    if(is_array($categories)){
                        foreach ($categories as $category){
                            $image_id           = get_term_meta( $category->term_id, 'thumbnail_id', true );
                            $post_thumbnail_img = wp_get_attachment_image_src( $image_id, 'large' );
                            ?>
                            <a href="<?php echo get_term_link($category->term_id) ?>" class="more-category-item">
                                <img loading="lazy" src="<?php echo $image_id ? $post_thumbnail_img[0] : '' ?>"
                                     alt="<?php echo get_post_meta($image_id, '_wp_attachment_image_alt', TRUE); ?>">
                                <?php echo $category->name ?>
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
				'key' => 'more_category_group',
				'title' => 'More category',
				'fields' => array 
				(
                    array
                    (
                        'key'               => 'more_category_group_title_field',
                        'label'             => 'Title',
                        'name'              => 'title',
                        'type' 				=> 'text',
                        'require'			=> 0,
                    ),
                    array
                    (
                        'key'               => 'more_category_group_taxonomy_field',
                        'label'             => 'Categories',
                        'name'              => 'categories',
                        'type' 				=> 'taxonomy',
                        'return_format'     => 'object',
                        'taxonomy'         => 'product_cat',
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

new BlogSectionMoreCategory();


?>