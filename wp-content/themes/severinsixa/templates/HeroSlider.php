<?php

class BlogSectionType1L {

    private $id = 'hero-slider';
    private $name = 'Hero Slider';

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
        wp_enqueue_style( $this->id, get_theme_file_uri('assets/index/Hero Slider/HeroSlider.css') );
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
        <section class="intro">
            <div class="swiper-wrapper">
                <?php
                // $intro = get_field('intro');
                $intro = get_field('intro');
//               var_export($intro);
                if ( is_array($intro) )
                foreach ( $intro as $item ){
                    ?>
                    <div class="swiper-slide intro__slide">
                        <div class="container">
                            <picture class="intro__img">
                                <source srcset="" type="image/webp">
                                <img src="<?php echo $item['image']['url'] ?>" alt="<?php echo $item['image']['alt'] ?>">
                            </picture>
                            <h1 class="h1 intro__title"><?php echo $item['title'] ?></h1>
                            <div class="intro__nav">
                                <?php
                                if ( is_array( $item['button'])){
                                    ?>
                                    <a class="btn btn--trans" href="<?php echo $item['button']['link'] ?>">
                                        <?php echo $item['button']['title'] ?>
                                    </a>
                                    <?php
                                }
                                if ( is_array( $item['link'])){
                                    ?>
                                    <a class="intro__info-btn" href="<?php echo $item['link']['link'] ?>"><?php echo $item['link']['title'] ?></a>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <button class="intro-button-next"></button>
            <button class="intro-button-prev"></button>
        </section>
        <?php

    }

	public function RegisterMainFields() {
		acf_add_local_field_group
		(
			array
			(
				'key' => 'intro_group',
				'title' => 'Intro',
				'fields' => array 
				(
					array 
					(
						'key'               => 'intro_field',
						'label'             => 'Intro',
						'name'              => 'intro',
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
				'key'               => 'intro_image_field',
				'label'             => 'Image',
				'name'              => 'image',
				'type' 				=> 'image',
				'parent'            => 'intro_field',
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
				'key'               => 'intro_title_field',
				'label'             => 'Title',
				'name'              => 'title',
				'type' 				=> 'text',
				'parent'            => 'intro_field',
				'require'			=> 0,
			)
		);
		acf_add_local_field
		(
			array
			(
				'key'               => 'intro_button_group_field',
				'label'             => 'Button',
				'name'              => 'button',
				'type' 				=> 'group',
				'parent'            => 'intro_field',
				'require'			=> 0,
			)
		);

        acf_add_local_field
        (
            array
            (
                'key'               => 'intro_button_group_title_field',
                'label'             => 'Title',
                'name'              => 'title',
                'type' 				=> 'text',
                'parent'            => 'intro_button_group_field',
                'require'			=> 0,
            )
        );
        acf_add_local_field
        (
            array
            (
                'key'               => 'intro_button_group_link_field',
                'label'             => 'link',
                'name'              => 'link',
                'type' 				=> 'text',
                'parent'            => 'intro_button_group_field',
                'require'			=> 0,
            )
        );
        //link button
		acf_add_local_field
		(
			array
			(
				'key'               => 'intro_link_group_field',
				'label'             => 'Link',
				'name'              => 'link',
				'type' 				=> 'group',
				'parent'            => 'intro_field',
				'require'			=> 0,
			)
		);

        acf_add_local_field
        (
            array
            (
                'key'               => 'intro_link_group_title_field',
                'label'             => 'Title',
                'name'              => 'title',
                'type' 				=> 'text',
                'parent'            => 'intro_link_group_field',
                'require'			=> 0,
            )
        );
        acf_add_local_field
        (
            array
            (
                'key'               => 'intro_link_group_link_field',
                'label'             => 'link',
                'name'              => 'link',
                'type' 				=> 'text',
                'parent'            => 'intro_link_group_field',
                'require'			=> 0,
            )
        );
	}
}

new BlogSectionType1L();


?>