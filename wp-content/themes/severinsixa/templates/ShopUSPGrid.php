<?php

class BlogSectionShopUSPGrid {

    private $id = 'shop-usp-grid';
    private $name = 'Shop USP Grid';

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
        wp_enqueue_style( $this->id, get_theme_file_uri('assets/index/benefits/benefits.css') );
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
        <section class="benefits">
            <div class="container">
                <h2 class="benefits__title title"><?php echo get_field('title') ?></span></h2>
                <ul class="benefits__list">
                    <?php
                    $blocks = get_field('blocks_shop_usp');
                    if( is_array($blocks)){
                        foreach ($blocks as $block_){
                            ?>
                            <li class="benefits__item">
                                <div class="benefits__img">
                                    <img src="<?php echo $block_['image']['url'] ?>" alt="<?php echo $block_['image']['alt'] ?>">
                                </div>
                                <p class="benefits__name">
                                    <?php echo $block_['title'] ?>
                                </p>
                                <p class="benefits__descr body-s">
                                    <?php echo $block_['description'] ?>
                                </p>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </section>
        <?php

    }

	public function RegisterMainFields() {
		acf_add_local_field_group
		(
			array
			(
				'key' => 'shop_usp_grid_group',
				'title' => 'Shop USP Grid',
				'fields' => array 
				(
                    array
                    (
                        'key'               => 'shop_usp_grid_group_title_field',
                        'label'             => 'Title',
                        'name'              => 'title',
                        'type' 				=> 'text',
                        'require'			=> 0,
                    ),
                    array
                    (
                        'key'               => 'shop_usp_grid_blocks_field',
                        'label'             => 'Blocks',
                        'name'              => 'blocks_shop_usp',
                        'type' 				=> 'repeater',
                        'layout'			=> 'block',
                        'sub_fields' 		=> array
                        (
                            array
                            (
                                'button_label'	=> 'Add section',
                            ),
                        ),
                        'collapsed'			=> 'thematic_block_title_field',
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
                'key'               => 'shop_usp_grid_image_field',
                'label'             => 'Image',
                'name'              => 'image',
                'type' 				=> 'image',
                'require'			=> 1,
                'return_format'     => 'array',
                'parent'            => 'shop_usp_grid_blocks_field',
            )
        );

        acf_add_local_field
        (
            array
            (
                'key'               => 'shop_usp_grid_title_field',
                'label'             => 'Title',
                'name'              => 'title',
                'type' 				=> 'text',
                'parent'            => 'shop_usp_grid_blocks_field',
                'require'			=> 0,
            )
        );
        acf_add_local_field
        (
            array
            (
                'key'               => 'shop_usp_grid_description_field',
                'label'             => 'Description',
                'name'              => 'description',
                'type' 				=> 'textarea',
                'new_lines'         => 'br',
                'parent'            => 'shop_usp_grid_blocks_field',
            ),
        );

	}
}

new BlogSectionShopUSPGrid();


?>