<?php

class BlogSectionImageWithHoverToolTip {

    private $id = 'image-with-hover-tool-tip';
    private $name = 'Image with hover tool tip';

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
        wp_enqueue_style( $this->id, get_theme_file_uri('assets/theme-page/Image with hover tool tip/Image with hover tool tip.css') );
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
        $post = get_post();
        $post_id = $post->post_parent == 0 ? get_the_ID() : $post->post_parent;
        ?>

        <section class="theme-intro">
            <div class="container">
                <h1 class="theme-intro__title h2"><?php echo get_field('title') ?></h1>
                <div class="theme-intro__board">
                    <picture class="theme-intro-pc">
                        <source srcset="" type="image/webp">
                        <?php
                        $image = get_field('image');
                        if( is_array($image) ){
                            ?>
                            <img src="<?php echo $image['url'] ?>" alt="<?php echo $image['alt'] ?>">
                            <?php
                        }
                        ?>
                    </picture>
                    <picture class="theme-intro-mob">
                        <source srcset="" type="image/webp">

                        <?php
                        $image = get_field('mob_image');
                        if( is_array($image) ){
                            ?>
                            <img src="<?php echo $image['url'] ?>" alt="<?php echo $image['alt'] ?>">
                            <?php
                        }
                        ?>
                    </picture>
                    <div class="theme-intro__dropdown">
                        <?php
                        $id = get_field('product');
                        if (is_array($id)){
                            $id = $id[0];
                            ?>
                            <a class="theme-intro__link" href="<?php echo get_permalink($id) ?>">
                                <p class="theme-intro__name h5"><?php echo get_the_title($id) ?></p>
                                <p class="theme-intro__model body-s"><?php echo get_field('product_model', $id) ?></p>
                                <p class="theme-intro__price body-s-bold"><?php echo get_post_field('_price', $id) . ' ' . get_woocommerce_currency_symbol() ?></p>
                            </a>
                            <?php
                        }
                        ?>
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
				'key' => 'image_with_hover_tool_tip_group',
				'title' => 'Image with hover tool tip',
				'fields' => array 
				(

                    array
                    (
                        'key'               => 'image_with_hover_tool_tip_group_title_field',
                        'label'             => 'Title',
                        'name'              => 'title',
                        'type' 				=> 'text',
                        'require'			=> 1,
                        'return_format'     => 'array',

                    ),
                    array
                    (
                        'key'               => 'image_with_hover_tool_tip_group_image_field',
                        'label'             => 'Image',
                        'name'              => 'image',
                        'type' 				=> 'image',
                        'require'			=> 1,
                        'return_format'     => 'array',

                    ),
                    array
                    (
                        'key'               => 'image_with_hover_tool_tip_group_mob_image_field',
                        'label'             => 'Mob image',
                        'name'              => 'mob_image',
                        'type' 				=> 'image',
                        'require'			=> 1,
                        'return_format'     => 'array',

                    ),
                    array
                    (
                        'key'               => 'image_with_hover_tool_tip_group_product_field',
                        'label'             => 'Product',
                        'name'              => 'product',
                        'type' 				=> 'relationship',
                        'post_type'         => 'product',
                        'require'			=> 1,
                        'max'               => 1,
                        'return_format'     => 'id',
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

new BlogSectionImageWithHoverToolTip();


?>