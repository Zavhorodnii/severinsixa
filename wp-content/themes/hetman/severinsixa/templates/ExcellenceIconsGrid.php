<?php

class BlogSectionExcellenceIconsGrid {

    private $id = 'excellence-icons-grid';
    private $name = 'Excellence icons grid';

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

        <div class="present-prod">
            <div class="present-prod-advant">
                <div class="container">
                    <?php
                    if (is_array($image_field)){
                        foreach ($image_field as $item){
                        ?>
                        <div class="present-prod-advant__item">
                            <img loading="lazy" src="<?php echo $item['icon']['url'] ?>" alt="<?php echo $item['icon']['alt'] ?>">
                            <?php echo $item['title'] ?>
                        </div>
                        <?php
                        }
                    }
                    ?>
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
				'key'       => 'excellence_icons_grid',
				'title'     => 'Excellence icons grid',
				'fields'    => array
				(
                    array
                    (
                        'key'               => 'excellence_icons_grid_icons_field',
                        'label'             => 'Icons',
                        'name'              => 'excellence_icons_grid_icon_field',
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
                'key'               => 'excellence_icons_grid_icons_icon_field',
                'label'             => 'Icon',
                'name'              => 'icon',
                'type' 				=> 'image',
                'parent'            => 'excellence_icons_grid_icons_field',
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
                'key'               => 'excellence_icons_grid_icons_title_field',
                'label'             => 'Title',
                'name'              => 'title',
                'type' 				=> 'text',
                'parent'            => 'excellence_icons_grid_icons_field',
                'require'			=> 0,
            )
        );
	}
}

new BlogSectionExcellenceIconsGrid();


?>