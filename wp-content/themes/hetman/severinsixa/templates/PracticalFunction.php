<?php

class BlogSectionPracticalFunction {

    private $id = 'practical-function-grid';
    private $name = 'Practical function';

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

        $image_field = get_field('excellence_icons_grid_icon_field');
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
                            if(is_array($blocks)){
                                foreach ($blocks as $item){
                                    ?>
                                    <div class="swiper-slide">
                                        <div class="practic-fanc-item">
                                            <div class="practic-fanc-item__img">
                                                <?php
                                                if(is_array($item['image'])){
                                                    ?>
                                                    <img loading="lazy" src="<?php echo $item['image']['url'] ?>" alt="<?php echo $item['image']['alt'] ?>">
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="practic-fanc-item__title">
                                                <?php echo $item['title'] ?>
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
				'key'       => 'practical_function_grid',
				'title'     => 'Practical function grid',
				'fields'    => array
				(

                    array
                    (
                        'key'               => 'practical_function_grid_title_field',
                        'label'             => 'Title',
                        'name'              => 'title',
                        'type' 				=> 'text',
                        'require'			=> 1,
                    ),
                    array
                    (
                        'key'               => 'practical_function_grid_blocks_field',
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
                        'collapsed'			=> 'intro_title_field',
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
                'key'               => 'practical_function_grid_blocks_image_field',
                'label'             => 'Image',
                'name'              => 'image',
                'type' 				=> 'image',
                'parent'            => 'practical_function_grid_blocks_field',
                'require'			=> 1,
//				'choices'			=> array('one', 'two'),
//				'ui'				=> 0,
                'return_format'     => 'array',

            )
        );
        acf_add_local_field
        (
            array
            (
                'key'               => 'practical_function_grid_blocks_title_field',
                'label'             => 'Title',
                'name'              => 'title',
                'type' 				=> 'text',
                'parent'            => 'practical_function_grid_blocks_field',
                'require'			=> 1,
            )
        );
        acf_add_local_field
        (
            array
            (
                'key'               => 'practical_function_grid_blocks_description_field',
                'label'             => 'Description',
                'name'              => 'description',
                'type' 				=> 'textarea',
                'rows'              => 4,
                'new_lines'         => 'br',
                'require'			=> 0,
                'parent'            => 'practical_function_grid_blocks_field',
            )
        );
	}
}

new BlogSectionPracticalFunction();


?>