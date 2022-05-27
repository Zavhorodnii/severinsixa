<?php

class BlogSectionTextHalfWidthWith2Products {

    private $id = 'text-half-width-with-2-products';
    private $name = 'Text half width with 2 products';

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

        $first_block = get_field('first_block');
        $second_block = get_field('second_block');
        ?>

        <div class="present-prod margin-b">
            <?php
            if (is_array($first_block)){
                ?>
                <div class="present-prod-item mob--change">
                    <div class="present-prod-item__wrap">
                        <div class="present-prod-item__text">
                            <div class="present-prod-item__title">
                                <?php echo $first_block['title'] ?>
                            </div>
                            <p class="present-prod-item__descr">
                                <?php echo $first_block['description'] ?>
                            </p>
                            <p class="big"><?php echo $first_block['big_title'] ?></p>
                        </div>
                        <div class="present-prod-item__img">
                            <?php
                            if (is_array($first_block['image'])){
                                ?>
                                <img loading="lazy" src="<?php echo $first_block['image']['url'] ?>" alt="<?php echo $first_block['image']['alt'] ?>">
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
            }
            if(is_array($second_block)){
                ?>
                <div class="present-prod-item">
                    <div class="present-prod-item__wrap">
                        <div class="present-prod-item__img">
                            <?php
                            if(is_array($second_block['image'])){
                                ?>
                                <img loading="lazy" src="<?php echo $second_block['image']['url'] ?>" alt="<?php echo $second_block['image']['alt'] ?>">
                                <?php
                            }
                            ?>
                        </div>
                        <div class="present-prod-item__text">
                            <div class="present-prod-item__title">
                                <?php echo $second_block['title'] ?>
                            </div>
                            <p class="present-prod-item__descr">
                                <?php echo $second_block['description'] ?>
                            </p>
                            <div class="present-prod-item__card">
                                <?php
                                if (is_array($second_block['product_ids'])){
                                    foreach ($second_block['product_ids'] as $product_id ){
                                        $image_id = get_post_thumbnail_id($product_id);
                                        ?>
                                        <div class="card-mini">
                                            <a href="<?php echo get_permalink($product_id) ?>" class="card-mini__img">
                                                <img loading="lazy" src="<?php echo wp_get_attachment_image_url($image_id, 'full') ?>"
                                                     alt="<?php echo wp_get_attachment_image_url($image_id, '_wp_attachment_image_alt', TRUE) ?>">
                                            </a>
                                            <a href="<?php echo get_permalink($product_id) ?>" class="card-mini__title">
                                                <?php echo get_the_title($product_id) ?>
                                            </a>
                                            <div class="card-mini__code">
                                                <?php
                                                echo get_field('product_model', $product_id);
                                                ?>
                                            </div>
                                            <div class="card-mini__price">
                                                <?php echo get_post_field('_price', $product_id) . ' ' . get_woocommerce_currency_symbol() ?>
                                            </div>
                                            <button class="card-mini__btn">
                                                Hinzufügen
                                            </button>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>

        </div>

        <?php
    }

	public function RegisterMainFields() {
		acf_add_local_field_group
		(
			array
			(
				'key'       => 'text_half_width_with_2_products',
				'title'     => 'Text half width with 2 products',
				'fields'    => array
				(
                    array
                    (
                        'key'               => 'text_half_width_with_2_products_first_block_field',
                        'label'             => 'First block',
                        'name'              => 'first_block',
                        'type' 				=> 'group',
                    ),
                    array
                    (
                        'key'               => 'text_half_width_with_2_products_second_block_field',
                        'label'             => 'second block',
                        'name'              => 'second_block',
                        'type' 				=> 'group',
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
                'key'               => 'text_half_width_with_2_products_first_block_image_field',
                'label'             => 'Image',
                'name'              => 'image',
                'type' 				=> 'image',
                'parent'            => 'text_half_width_with_2_products_first_block_field',
                'require'			=> 1,
                'return_format'     => 'array',

            )
        );
        acf_add_local_field
        (
            array
            (
                'key'               => 'text_half_width_with_2_products_first_block_title_field',
                'label'             => 'Title',
                'name'              => 'title',
                'type' 				=> 'text',
                'parent'            => 'text_half_width_with_2_products_first_block_field',
                'require'			=> 0,
            )
        );
        acf_add_local_field
        (
            array
            (
                'key'               => 'text_half_width_with_2_products_first_block_description_field',
                'label'             => 'Description',
                'name'              => 'description',
                'type' 				=> 'textarea',
                'rows'              => 4,
                'new_lines'         => 'br',
                'parent'            => 'text_half_width_with_2_products_first_block_field',
                'require'			=> 0,
            )
        );

        acf_add_local_field
        (
            array
            (
                'key'               => 'text_half_width_with_2_products_first_block_big_title_field',
                'label'             => 'Big title',
                'name'              => 'big_title',
                'type' 				=> 'text',
                'parent'            => 'text_half_width_with_2_products_first_block_field',
                'require'			=> 0,
            )
        );
        ////
        acf_add_local_field
        (
            array
            (
                'key'               => 'text_half_width_with_2_products_second_block_title_field',
                'label'             => 'Title',
                'name'              => 'title',
                'type' 				=> 'text',
                'parent'            => 'text_half_width_with_2_products_second_block_field',
                'require'			=> 0,
            )
        );
        acf_add_local_field
        (
            array
            (
                'key'               => 'text_half_width_with_2_products_second_block_description_field',
                'label'             => 'Description',
                'name'              => 'description',
                'type' 				=> 'textarea',
                'rows'              => 4,
                'new_lines'         => 'br',
                'parent'            => 'text_half_width_with_2_products_second_block_field',
                'require'			=> 0,
            )
        );

        acf_add_local_field
        (
            array
            (
                'key'               => 'text_half_width_with_2_products_second_block_image_field',
                'label'             => 'Image',
                'name'              => 'image',
                'type' 				=> 'image',
                'parent'            => 'text_half_width_with_2_products_second_block_field',
                'require'			=> 0,
            )
        );
        acf_add_local_field
        (
            array
            (
                'key'               => 'text_half_width_with_2_products_second_block_big_title_field',
                'label'             => 'Product',
                'name'              => 'product_ids',
                'type' 				=> 'relationship',
                'return_format'     => 'id',
                'post_type'         => 'product',
                'parent'            => 'text_half_width_with_2_products_second_block_field',
                'multiple'          => 1,
                'require'			=> 0,
            ),
        );
	}
}

new BlogSectionTextHalfWidthWith2Products();


?>