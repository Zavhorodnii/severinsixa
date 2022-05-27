<?php

class BlogSectionProductGridBlock {

    private $id = 'product-grid-block-product';
    private $name = 'Product Grid Block';

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
        ?>
        <section class="mini-card">
            <div class="container">
                <h2 class="mini-card__title title title-center">
                   <?php echo get_field('title') ?>
                </h2>
                <div class="mini-card__wrapper">
                    <div class="swiper mini-card-swiper">
                        <div class="swiper-wrapper">
                            <?php
                            $product_ids = get_field('product_ids');
                            if (is_array($product_ids)){
                                foreach ($product_ids as $product_id ){
                                    $image_id = get_post_thumbnail_id($product_id);
                                    ?>
                                    <div class="swiper-slide">
                                        <div class="card-mini">
                                            <a href="<?php echo get_permalink($product_id) ?>" class="card-mini__img">
                                                <?php
                                                if (isset($image_id)){
                                                ?>
                                                <img loading="lazy" src="<?php echo wp_get_attachment_image_url($image_id, 'full') ?>"
                                                     alt="<?php echo wp_get_attachment_image_url($image_id, '_wp_attachment_image_alt', TRUE) ?>">
                                                <?php
                                                }
                                                ?>
                                            </a>
                                            <a href="<?php echo get_permalink($product_id) ?>" class="card-mini__title">
                                                <?php echo get_the_title($product_id) ?>
                                            </a>
                                            <div class="card-mini__code">
                                                <?php echo get_field('product_model', $product_id); ?>
                                            </div>
                                            <div class="card-mini__price">
                                                <?php echo get_post_field('_price', $product_id) . ' ' . get_woocommerce_currency_symbol() ?>
                                            </div>
                                            <button class="card-mini__btn">
                                                Hinzufügen
                                            </button>
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
				'key'       => 'product_grid_block',
				'title'     => 'Product Grid Block',
				'fields'    => array
				(
                    array
                    (
                        'key'               => 'product_grid_block_group_title_field',
                        'label'             => 'Title',
                        'name'              => 'title',
                        'type' 				=> 'text',
                        'require'			=> 0,
                    ),
                    array
                    (
                        'key'               => 'product_grid_block_group_product_ids_field',
                        'label'             => 'Posts',
                        'name'              => 'product_ids',
                        'type' 				=> 'relationship',
                        'return_format'     => 'id',
                        'post_type'         => 'product',
                        'multiple'          => 1,
                        'require'			=> 0,
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


        
	}
}

new BlogSectionProductGridBlock();


?>