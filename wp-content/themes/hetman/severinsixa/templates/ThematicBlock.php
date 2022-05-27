<?php

class BlogSectionTypeThematicBlock {

    private $id = 'thematic-block';
    private $name = 'Media Text + Image + Products';

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
        wp_enqueue_style( $this->id, get_theme_file_uri('assets/index/Media Text + Image + Products/Media Text + Image + Products.css') );
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
        <section class="thematic-block">
            <div class="container">
                <div class="thematic-block__list">
                    <?php
                    $blocks = get_field('blocks');
                    if ( is_array($blocks)){
                        foreach ($blocks as $item){
                            ?>
                            <div class="thematic-block__item">
                                <div class="thematic-block__photo">
                                    <picture class="thematic-block__img">
                                        <source srcset="" type="image/webp">
                                        <img src="<?php echo $item['image']['url'] ?>" alt="<?php echo $item['image']['alt'] ?>">
                                    </picture>
                                </div>
                                <div class="thematic-block__content">
                                    <div class="thematic-block__info">
                                        <p class="thematic-block__title h3"><?php echo $item['title'] ?></p>
                                        <div class="thematic-block__text body-m">
                                            <?php echo $item['description'] ?>
                                        </div>
                                        <a class="thematic-block__btn btn btn--black" href="<?php echo $item['button']['link'] ?>"><?php echo $item['button']['title'] ?></a>
                                    </div>
                                    <?php
                                    if (is_array($item['post'])){
                                        ?>
                                    <div class="thematic-block__wrapper">
                                        <?php
                                        foreach ($item['post'] as $id){
                                            $image_id = get_post_field('_thumbnail_id', $id);
                                            $post_thumbnail_img = wp_get_attachment_image_src( $image_id, 'full' );
                                            $alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
                                            ?>
                                            <a class="product" href="<?php echo get_permalink($id) ?>">
                                                <picture class="product__img">
                                                    <source srcset="" type="image/webp">
                                                    <img src="<?php echo $image_id ? $post_thumbnail_img[0] : '' ?>" alt="<?php echo $alt ?: '' ?>">
                                                </picture>
                                                <p class="product__name">
                                                    <?php echo get_the_title($id) ?>
                                                </p>
                                                <p class="product__model body-s">
                                                    <?php echo get_post_field('_sku', $id) ?>
                                                </p>
                                                <p class="product__price body-s-bold">
                                                    <?php echo get_post_field('_price', $id) ?> €
                                                </p>
                                            </a>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
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
				'key' => 'thematic_block_group',
				'title' => 'Blocks',
				'fields' => array 
				(
					array 
					(
						'key'               => 'thematic_block_field',
						'label'             => 'Blocks',
						'name'              => 'blocks',
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
                'key'               => 'thematic_block_title_field',
                'label'             => 'Title',
                'name'              => 'title',
                'type' 				=> 'text',
                'parent'            => 'thematic_block_field',
                'require'			=> 0,
            )
        );
		acf_add_local_field
		(
			array
			(
				'key'               => 'thematic_block_image_field',
				'label'             => 'Image',
				'name'              => 'image',
				'type' 				=> 'image',
				'parent'            => 'thematic_block_field',
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
                'key'               => 'thematic_block_description_group_field',
                'label'             => 'Description',
                'name'              => 'description',
                'type' 				=> 'wysiwyg',
                'parent'            => 'thematic_block_field',
                'require'			=> 0,
            )
        );
		acf_add_local_field
		(
			array
			(
				'key'               => 'thematic_block_button_group_field',
				'label'             => 'Button',
				'name'              => 'button',
				'type' 				=> 'group',
				'parent'            => 'thematic_block_field',
				'require'			=> 0,
			)
		);
        acf_add_local_field
        (
            array
            (
                'key'               => 'thematic_block_button_group_title_field',
                'label'             => 'Title',
                'name'              => 'title',
                'type' 				=> 'text',
                'parent'            => 'thematic_block_button_group_field',
                'require'			=> 0,
            )
        );
        acf_add_local_field
        (
            array
            (
                'key'               => 'thematic_block_button_group_link_field',
                'label'             => 'link',
                'name'              => 'link',
                'default_value'     => '#',
                'type' 				=> 'text',
                'parent'            => 'thematic_block_button_group_field',
                'require'			=> 0,
            )
        );
        acf_add_local_field
        (
            array
            (
                'key'               => 'thematic_block_group_product_field',
                'label'             => 'Posts',
                'name'              => 'post',
                'type' 				=> 'relationship',
                'return_format'     => 'id',
                'post_type'         => 'product',
                'multiple'          => 1,
                'require'			=> 0,
                'parent'            => 'thematic_block_field',
            ),
        );
	}
}

new BlogSectionTypeThematicBlock();


?>