<?php

class BlogSectionBannerWithCTA {

    private $id = 'banner-with-cta';
    private $name = 'Banner with CTA';

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
        wp_enqueue_style( $this->id, get_theme_file_uri('assets/theme-page/Banner with CTA/Banner with CTA.css') );
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
        $button = get_field('button');
        $image = get_field('image');
        ?>

        <section class="banner-sales">
            <div class="container">
                <div class="banner-sales__inner">
                    <div class="banner-sales__info">
                        <h2 class="banner-sales__title h3">
                            <?php echo get_field('title') ?>
                        </h2>
                        <p class="banner-sales__text body-m">
                            <?php echo get_field('description') ?>
                        </p>
                        <a class="btn btn--trans" href="<?php echo $button['link'] ?>">
                            <?php echo $button['title'] ?>
                        </a>
                    </div>
                    <picture class="banner-sales__img">
                        <source srcset="" type="image/webp">
                        <?php
                        if( is_array($image)){
                            ?>
                            <img src="<?php echo $image['url'] ?>" alt="<?php echo $image['alt'] ?>">
                            <?php
                        }
                        ?>
                    </picture>
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
                'key'       => 'banner_with_cta_group',
                'title'     => 'Banner with CTA',
                'fields'    => array
                (
                    array
                    (
                        'key'               => 'banner_with_cta_group_title_field',
                        'label'             => 'Title',
                        'name'              => 'title',
                        'type' 				=> 'text',
                        'require'			=> 0,
                    ),
                    array
                    (
                        'key'               => 'banner_with_cta_group_description_field',
                        'label'             => 'Description',
                        'name'              => 'description',
                        'type' 				=> 'textarea',
                        'rows'              => 4,
                        'new_lines'         => 'br',
                        'require'			=> 0,
                    ),
                    array
                    (
                        'key'               => 'banner_with_cta_group_button_field',
                        'label'             => 'Button',
                        'name'              => 'button',
                        'type' 				=> 'group',
                        'require'			=> 0,
                    ),
                    array
                    (
                        'key'               => 'banner_with_cta_group_image_field',
                        'label'             => 'Image',
                        'name'              => 'image',
                        'type' 				=> 'image',
                        'require'			=> 1,
                        'return_format'     => 'array',

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
                'key'               => 'banner_with_cta_group_button_title_field',
                'label'             => 'Title',
                'name'              => 'title',
                'type' 				=> 'text',
                'parent'            => 'banner_with_cta_group_button_field',
                'require'			=> 0,
            )
        );
        acf_add_local_field
        (
            array
            (
                'key'               => 'banner_with_cta_group_button_link_field',
                'label'             => 'Link',
                'name'              => 'link',
                'type' 				=> 'text',
                'default_value'     => '#',
                'parent'            => 'banner_with_cta_group_button_field',
                'require'			=> 0,
            )
        );
	}
}

new BlogSectionBannerWithCTA();


?>