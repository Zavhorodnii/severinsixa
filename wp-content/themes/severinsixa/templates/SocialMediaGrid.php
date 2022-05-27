<?php

class BlogSectionSocialMediaGrid {

    private $id = 'social-media-grid';
    private $name = 'Social Media Grid';

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
        wp_enqueue_style( $this->id, get_theme_file_uri('assets/index/Social Media Grid/Social Media Grid.css') );
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
        <section class="instagram-feed">
            <div class="container">
                <h2 class="instagram-feed__title title"><?php echo get_field('title') ?></h2>
                <div class="instagram-feed__list">
                    <?php
                    $images = get_field('images');
                    if(is_array($images)){
                        foreach ($images as $image){
                            ?>
                            <div class="instagram-feed__item">
                                <picture>
                                    <source srcset="" type="image/webp">
                                    <img src="<?php echo $image['image']['url'] ?>" alt="<?php echo $image['image']['alt'] ?>">
                                </picture>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <div class="instagram-feed__links">
                    <?php
                    $images = get_field('icons');
                    if(is_array($images)){
                        foreach ($images as $image){
                            ?>
                            <a class="instagram-feed__link" href="<?php echo $image['link'] ?>" target="_blank">
                                <img src="<?php echo $image['icon']['url'] ?>" alt="<?php echo $image['icon']['alt'] ?>">
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
				'key' => 'social_media_grid_group',
				'title' => 'Social Media Grid',
				'fields' => array 
				(
                    array
                    (
                        'key'               => 'social_media_grid_title_field',
                        'label'             => 'Title',
                        'name'              => 'title',
                        'type' 				=> 'text',
                        'require'			=> 0,
                    ),
                    array
                    (
                        'key'               => 'social_media_grid_images_field',
                        'label'             => 'Images',
                        'name'              => 'images',
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
                    array
                    (
                        'key'               => 'social_media_grid_social_field',
                        'label'             => 'Icons',
                        'name'              => 'icons',
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
                'key'               => 'social_media_grid_image_field',
                'label'             => 'Image',
                'name'              => 'image',
                'type' 				=> 'image',
                'require'			=> 1,
                'return_format'     => 'array',
                'parent'            => 'social_media_grid_images_field',
            )
        );
        acf_add_local_field
        (
            array
            (
                'key'               => 'social_media_grid_social_icon_field',
                'label'             => 'icon',
                'name'              => 'icon',
                'type' 				=> 'image',
                'require'			=> 1,
                'return_format'     => 'array',
                'parent'            => 'social_media_grid_social_field',
            )
        );
        acf_add_local_field
        (
            array
            (
                'key'               => 'social_media_grid_social_link_field',
                'label'             => 'link',
                'name'              => 'link',
                'default_value'     => '#',
                'type' 				=> 'text',
                'parent'            => 'social_media_grid_social_field',
                'require'			=> 1,
            )
        );
	}
}

new BlogSectionSocialMediaGrid();


?>