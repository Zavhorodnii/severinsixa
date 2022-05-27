<?php

class BlogSectionFullWidthImageWithlogoQuote {

    private $id = 'full-width-image-with-logo';
    private $name = 'Full width image with logo + Quote';

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

        $image_field = get_field('image_field');
        $sub_image_field = get_field('sub_image_field');
        ?>

        <div class="present-prod">
            <div class="present-prod__top">
                <?php
                if (is_array($image_field)){
                ?>
                <img loading="lazy" src="<?php echo $image_field['url'] ?>" alt="<?php echo $image_field['alt'] ?>">
                <?php
                }
                ?>
                <div class="container">
                    <?php
                    if (is_array($sub_image_field)){
                    ?>
                    <img loading="lazy" src="<?php echo $sub_image_field['url'] ?>" alt="<?php echo $sub_image_field['alt'] ?>">
                    <?php } ?>
                    <p>
                        <?php echo get_field('description') ?>
                    </p>
                </div>
            </div>
        </div>

        <?php
    }

	public function RegisterMainFields() {
		acf_add_local_field_group
		(
			array
			(
				'key'       => 'full_width_image_with_logo_group',
				'title'     => 'Full width image with logo + Quote',
				'fields'    => array
				(
                    array
                    (
                        'key'               => 'full_width_image_with_logo_group_image_field',
                        'label'             => 'Image',
                        'name'              => 'image_field',
                        'type' 				=> 'image',
                        'require'			=> 1,
                        'return_format'     => 'array',
                    ),
                    array
                    (
                        'key'               => 'full_width_image_with_logo_group_sub_image_field',
                        'label'             => 'Sub Image',
                        'name'              => 'sub_image_field',
                        'type' 				=> 'image',
                        'require'			=> 1,
                        'return_format'     => 'array',
                    ),
                    array
                    (
                        'key'               => 'full_width_image_with_logo_group_description_field',
                        'label'             => 'Description',
                        'name'              => 'description',
                        'type' 				=> 'textarea',
                        'rows'              => 4,
                        'new_lines'         => 'br',
                        'require'			=> 0,
                    )
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

new BlogSectionFullWidthImageWithlogoQuote();


?>