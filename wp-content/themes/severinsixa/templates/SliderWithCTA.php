<?php

class BlogSectionProductSliderWithCTA {

    private $id = 'slider-with-cta';
    private $name = 'Slider with CTA';

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
        wp_enqueue_style( $this->id, get_theme_file_uri('assets/category-page/Slider with CTA/Slider with CTA.css') );
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
        $sliders = get_field('slider');
        ?>

        <section class="category-intro">
            <div class="container">
                <h1 class="category-intro__title h2"><?php echo get_field('title') ?></h1>
                <div class="category-intro__slider swiper">
                    <div class="swiper-wrapper">

                        <?php
                        if(is_array($sliders)){
                            foreach ($sliders as $slider){
                            ?>
                            <div class="swiper-slide category-intro__slide">
                                <picture>
                                    <?php
                                    if (is_array($slider['image'])){
                                        ?>
                                        <source srcset="<?php echo $slider['image']['url'] ?>" type="image/webp">
                                        <img src="<?php echo $slider['image']['url'] ?>" alt="<?php echo $slider['image']['alt'] ?>">
                                        <?php
                                    }
                                    ?>
                                </picture>
                                <div class="category-intro__content">
                                    <p class="category-intro__name h3">
                                        <?php echo $slider['title'] ?>
                                    </p>
                                    <a class="btn btn--trans" href="<?php echo $slider['button']['link'] ?>">
                                        <?php echo $slider['button']['title'] ?>
                                    </a>
                                </div>
                            </div>
                            <?php
                            }
                        }
                        ?>

                    </div>
                    <div class="category-intro__prev"></div>
                    <div class="category-intro__next"></div>
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
				'key'       => 'slider_with_cta_group',
				'title'     => 'Slider with CTA',
				'fields'    => array
				(

                    array
                    (
                        'key'               => 'slider_with_cta_group_title_field',
                        'label'             => 'Title',
                        'name'              => 'title',
                        'type' 				=> 'text',
                        'require'			=> 0,
                    ),
                    array
                    (
                        'key'               => 'slider_with_cta_group_slider_field',
                        'label'             => 'Slider',
                        'name'              => 'slider',
                        'type' 				=> 'repeater',
                        'layout'			=> 'block',
                        'sub_fields' 		=> array
                        (
                            array
                            (
                                'button_label'	=> 'Add section',
                            ),
                        ),
                        'collapsed'			=> 'slider_with_cta_group_slider_title_field',
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
                'key'               => 'slider_with_cta_group_slider_title_field',
                'label'             => 'Title',
                'name'              => 'title',
                'type' 				=> 'text',
                'require'			=> 0,
                'parent'            => 'slider_with_cta_group_slider_field',
            ),
        );
        acf_add_local_field
        (
            array
            (
                'key'               => 'slider_with_cta_group_slider_image_field',
                'label'             => 'Image',
                'name'              => 'image',
                'type' 				=> 'image',
                'parent'            => 'slider_with_cta_group_slider_field',
                'require'			=> 1,
                'return_format'     => 'array',

            )
        );
        acf_add_local_field
        (
            array
            (
                'key'               => 'slider_with_cta_group_slider_group_field',
                'label'             => 'Button',
                'name'              => 'button',
                'type' 				=> 'group',
                'parent'            => 'slider_with_cta_group_slider_field',
                'require'			=> 0,
            )
        );
        acf_add_local_field
        (
            array
            (
                'key'               => 'slider_with_cta_group_slider_group_title_field',
                'label'             => 'Title',
                'name'              => 'title',
                'type' 				=> 'text',
                'parent'            => 'slider_with_cta_group_slider_group_field',
                'require'			=> 0,
            )
        );
        acf_add_local_field
        (
            array
            (
                'key'               => 'slider_with_cta_group_slider_group_link_field',
                'label'             => 'Link',
                'name'              => 'link',
                'type' 				=> 'text',
                'default_value'     => '#',
                'parent'            => 'slider_with_cta_group_slider_group_field',
                'require'			=> 0,
            )
        );
	}
}

new BlogSectionProductSliderWithCTA();


?>