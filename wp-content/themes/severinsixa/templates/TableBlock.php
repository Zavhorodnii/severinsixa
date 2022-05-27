<?php

class BlogSectionTableBlock {

    private $id = 'table-block';
    private $name = 'Table Block';

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
//        if (!is_product()){
//            return;
//        }
        global $product;
        if ($product == null){
            return;
        }
        ?>
        <section class="characteristic">
            <div class="container">
                <h2 class="characteristic__title title title-center">
                    <?php echo get_field('title') ?>
                </h2>
                <div class="characteristic__wrapper">
                    <?php
                    foreach ($product->get_attributes() as $taxonomy => $attribute_obj ) {
                        $attribute_label_name = wc_attribute_label($taxonomy);
                        $terms = [];
                        foreach ($attribute_obj['options'] as $option){
                            $terms[] = get_term_by('id', $option, $taxonomy)->name;
                        }
                        ?>
                        <div>
                            <span class="characteristic-name"><?php echo $attribute_label_name ?></span>
                            <span class="characteristic-value"><?php echo implode(', ', $terms) ?></span>
                        </div>
                        <?php
                    }
                    $addition_attributes = get_field('addition_attributes');
                    if(is_array($addition_attributes)){
                        foreach ($addition_attributes as $addition_attribute){
                            ?>
                            <div>
                                <span class="characteristic-name"><?php echo $addition_attribute['title'] ?></span>
                                <a href="<?php echo $addition_attribute['file']['url'] ?>" target="_blank" class="characteristic-value value-pdf">
                                    <?php echo $addition_attribute['file']['filename'] ?>
                                </a>
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
				'key'       => 'table_block_group',
				'title'     => 'Table Block',
				'fields'    => array
				(
                    array
                    (
                        'key'               => 'table_block_group_title_field',
                        'label'             => 'Title',
                        'name'              => 'title',
                        'type' 				=> 'text',
                        'require'			=> 0,
                    ),
                    array
                    (
                        'key'               => 'table_block_group_addition_attributes_field',
                        'label'             => 'Addition attributes',
                        'name'              => 'addition_attributes',
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
                'key'               => 'table_block_group_addition_attributes_title_field',
                'label'             => 'Title',
                'name'              => 'title',
                'type' 				=> 'text',
                'parent'            => 'table_block_group_addition_attributes_field',
                'require'			=> 0,
            )
        );
        acf_add_local_field
        (
            array
            (
                'key'               => 'table_block_group_addition_attributes_file_field',
                'label'             => 'File',
                'name'              => 'file',
                'type' 				=> 'file',
                'parent'            => 'table_block_group_addition_attributes_field',
                'require'			=> 0,
            )
        );

	}
}

new BlogSectionTableBlock();


?>