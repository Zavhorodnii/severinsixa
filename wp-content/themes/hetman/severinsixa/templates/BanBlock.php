<?php

class BlogSectionBanBlock {

    private $id = 'ban-block-grid';
    private $name = 'Banner Block';

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
        wp_enqueue_style( $this->id, get_theme_file_uri('assets/index/testimonials/testimonials.css') );
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

        <div class="ban-block">
            <?php
            $image = get_field('image');
            if (is_array($image)){
                ?>
                <img loading="lazy" src="<?php echo $image['url'] ?>" alt="<?php echo $image['alt'] ?>">
                <?php
            }
            ?>
            <div class="container">
                <?php echo get_field('title') ?>
            </div>
        </div>

        <?php

    }

	public function RegisterMainFields() {
        acf_add_local_field_group
        (
            array
            (
                'key'       => 'ban_block_grid_group',
                'title'     => 'Ban Block',
                'fields'    => array
                (
                    array
                    (
                        'key'               => 'ban_block_grid_group_title_field',
                        'label'             => 'Title',
                        'name'              => 'title',
                        'type' 				=> 'text',
                        'require'			=> 0,
                    ),
                    array
                    (
                        'key'               => 'ban_block_grid_group_image_field',
                        'label'             => 'Image',
                        'name'              => 'image',
                        'type' 				=> 'image',
                        'require'			=> 1,
                        'return_format'     => 'array',

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

new BlogSectionBanBlock();


?>