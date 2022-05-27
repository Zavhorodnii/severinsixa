<?php

class BlogSectionFeaturesGrid {

    private $id = 'features-grid';
    private $name = 'Features grid';

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
//        wp_enqueue_style( $this->id, get_theme_file_uri('assets/index/Media Text + Image + Products/Media Text + Image + Products.css') );
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
        ?>
        <section class="practic-fanc">
            <div class="container">
                <h2 class="practic-fanc__title title title-center">
                    <?php echo get_field('title') ?>
                </h2>
                <div class="practic-fanc__wrapper">
                    <div class="swiper practic-fanc-swiper">
                        <div class="swiper-wrapper">
                            <?php
                            $blocks = get_field('blocks');
                            if (is_array($blocks)) {
                                foreach ($blocks as $item) {
                                    ?>
                                    <div class="swiper-slide">
                                        <div class="practic-fanc-item">
                                            <div class="practic-fanc-item__img">
                                                <?php
                                                if (is_array($item['image'])){
                                                    ?>
                                                    <img loading="lazy" src="<?php echo $item['image']['url'] ?>" alt="<?php echo $item['image']['alt'] ?>">
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="practic-fanc-item__title">
                                                <?php echo $item['title'] ?> <br> <span><?php echo $item['seb_title'] ?></span>
                                            </div>
                                            <p class="practic-fanc-item__descr">
                                                <?php echo $item['description'] ?>
                                            </p>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="highlights__progressbar progressbar"></div>
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
				'key'       => 'features_grid_group',
				'title'     => 'Text half width with 2 products',
				'fields'    => array
				(
                    array
                    (
                        'key'               => 'features_grid_group_title_field',
                        'label'             => 'Title',
                        'name'              => 'title',
                        'type' 				=> 'text',
                        'parent'            => 'text_half_width_with_2_products_first_block_field',
                        'require'			=> 0,
                    ),
                    array
                    (
                        'key'               => 'features_grid_group_block_field',
                        'label'             => 'Blocks',
                        'name'              => 'blocks',
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
                'key'               => 'features_grid_group_block_image_field',
                'label'             => 'Image',
                'name'              => 'image',
                'type' 				=> 'image',
                'parent'            => 'features_grid_group_block_field',
                'require'			=> 1,
                'return_format'     => 'array',

            )
        );
        acf_add_local_field
        (
            array
            (
                'key'               => 'features_grid_group_block_title_field',
                'label'             => 'Title',
                'name'              => 'title',
                'type' 				=> 'text',
                'parent'            => 'features_grid_group_block_field',
                'require'			=> 0,
            )
        );
        acf_add_local_field
        (
            array
            (
                'key'               => 'features_grid_group_block_sbu_title_field',
                'label'             => 'Sub title',
                'name'              => 'seb_title',
                'type' 				=> 'text',
                'parent'            => 'features_grid_group_block_field',
                'require'			=> 0,
            )
        );
        acf_add_local_field
        (
            array
            (
                'key'               => 'features_grid_group_block_description_field',
                'label'             => 'Description',
                'name'              => 'description',
                'type' 				=> 'textarea',
                'rows'              => 4,
                'new_lines'         => 'br',
                'parent'            => 'features_grid_group_block_field',
                'require'			=> 0,
            )
        );

	}
}

new BlogSectionFeaturesGrid();


?>