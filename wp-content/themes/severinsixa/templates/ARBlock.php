<?php

class BlogSectionARBlock {

    private $id = 'ar-block';
    private $name = 'AR Block';

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

        $ar_block_group_slider = get_field('ar_block_group_slider');
        ?>

        <section class="slider-prod">
            <div class="slider-prod__wrapper">
                <div class="swiper slider-prod-swiper">
                    <div class="swiper-wrapper">
                        <?php
                        if (is_array($ar_block_group_slider)){
                            foreach ($ar_block_group_slider as $item){
                                ?>
                                <div class="swiper-slide">
                                    <div class="slider-prod-item">
                                        <picture>

                                            <source srcset="" type="image/webp">
                                            <source media="(max-width: 930px)" srcset="" type="image/webp">
                                            <?php
                                            if (is_array($item['image_bg'])){
                                                ?>
                                                <source media="(max-width: 930px)" srcset="<?php echo $item['image_bg']['url'] ?>">
                                                <?php
                                            }
                                            if (is_array($item['image_bg_2'])){
                                                ?>
                                                <img loading="lazy" class="slider-prod-item__img" src="<?php echo $item['image_bg_2']['url'] ?>"
                                                     alt="<?php echo $item['image_bg_2']['alt'] ?>">
                                                <?php
                                            }
                                            ?>
                                        </picture>
                                        <div class="container">
                                            <div class="slider-prod-item__ofer">
                                                <h2 class="slider-prod-item__title">
                                                    <?php echo $item['title'] ?>
                                                </h2>
                                                <p class="slider-prod-item__descr">
                                                    <?php echo $item['description'] ?>
                                                </p>
                                                <div class="slider-prod-item__product">
                                                    <?php echo $item['title_2'] ?>
                                                </div>
                                                <div class="slider-prod-item__qr">
                                                    <?php
                                                    if (is_array($item['image'])){
                                                        ?>
                                                        <img loading="lazy" src="<?php echo $item['image']['url'] ?>" alt="<?php echo $item['image']['alt'] ?>">
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                                <a href="<?php echo $item['button']['link'] ?>" class="slider-prod-item__btn btn btn--black">
                                                    <?php echo $item['button']['title'] ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
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
				'key'       => 'ar_block_group',
				'title'     => 'AR Block',
				'fields'    => array
				(
                    array
                    (
                        'key'               => 'ar_block_group_slider_field',
                        'label'             => 'Slider',
                        'name'              => 'ar_block_group_slider',
                        'type' 				=> 'repeater',
                        'layout'			=> 'block',
                        'sub_fields' 		=> array
                        (
                            array
                            (
                                'button_label'	=> 'Add section',
                            ),
                        ),
                        'collapsed'			=> 'product_info_block_main_scroll_link_title_field',
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
                'key'               => 'ar_block_group_slider_image_bg_field',
                'label'             => 'Image bg',
                'name'              => 'image_bg',
                'type' 				=> 'image',
                'parent'            => 'ar_block_group_slider_field',
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
                'key'               => 'ar_block_group_slider_image_bg_2_field',
                'label'             => 'Image bg 2',
                'name'              => 'image_bg_2',
                'type' 				=> 'image',
                'parent'            => 'ar_block_group_slider_field',
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
                'key'               => 'ar_block_group_slider_title_field',
                'label'             => 'Title',
                'name'              => 'title',
                'type' 				=> 'text',
                'parent'            => 'ar_block_group_slider_field',
                'require'			=> 0,
            )
        );
        acf_add_local_field
        (
            array
            (
                'key'               => 'ar_block_group_slider_description_field',
                'label'             => 'Description',
                'name'              => 'description',
                'type' 				=> 'textarea',
                'rows'              => 4,
                'new_lines'         => 'br',
                'parent'            => 'ar_block_group_slider_field',
                'require'			=> 0,
            )
        );

        acf_add_local_field
        (
            array
            (
                'key'               => 'ar_block_group_slider_title_2_field',
                'label'             => 'Title 2',
                'name'              => 'title_2',
                'type' 				=> 'text',
                'parent'            => 'ar_block_group_slider_field',
                'require'			=> 0,
            )
        );

        acf_add_local_field
        (
            array
            (
                'key'               => 'ar_block_group_slider_image_field',
                'label'             => 'Image',
                'name'              => 'image',
                'type' 				=> 'image',
                'parent'            => 'ar_block_group_slider_field',
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
                'key' => 'ar_block_group_slider_button_field',
                'label' => 'Button',
                'name' => 'button',
                'type' => 'group',
                'parent' => 'ar_block_group_slider_field',
                'require' => 0,
            ),
        );
        acf_add_local_field
        (
            array
            (
                'key' => 'ar_block_group_slider_button_title_field',
                'label' => 'Title',
                'name' => 'title',
                'type' => 'text',
                'parent' => 'ar_block_group_slider_button_field',
                'require' => 0,
            )
        );
        acf_add_local_field
        (
            array
            (
                'key' => 'ar_block_group_slider_button_link_field',
                'label' => 'link',
                'name' => 'link',
                'default_value' => '#',
                'type' => 'text',
                'parent' => 'ar_block_group_slider_button_field',
                'require' => 0,
            )
        );

	}
}

new BlogSectionARBlock();


?>