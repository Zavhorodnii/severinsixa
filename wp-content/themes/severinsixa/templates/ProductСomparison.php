<?php

class BlogSectionProductComparison {

    private $id = 'product-comparison-grid';
    private $name = 'Product comparison';

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
//        if (!is_product()){
//            return;
//        }
        $post = get_post();
        $product = wc_get_product($post->post_parent == 0 ? get_the_ID() : $post->post_parent);
        if ($product == null){
            return;
        }
        $post_id = $post->post_parent == 0 ? get_the_ID() : $post->post_parent;

        $product_page_blocks_reviews = get_field('product_page_blocks_reviews', $post_id);
        $middle_rating = 0;
        if(is_array($product_page_blocks_reviews)){
            foreach ($product_page_blocks_reviews as $blocks_review){
                $middle_rating += intval($blocks_review['stars']);
            }
            $middle_rating = round($middle_rating / count($product_page_blocks_reviews), 2);
        }
        $current_categories = $product->get_category_ids();
        if(is_array($current_categories)){
            $args = array(
                'post_type'             => 'product',
                'post_status'           => 'publish',
                'ignore_sticky_posts'   => 1,
                'posts_per_page'        => -1,
                'fields'                => 'ids',
                'tax_query'             => array(
                    array(
                        'taxonomy'      => 'product_cat',
                        'field'         => 'term_id', //This is optional, as it defaults to 'term_id'
                        'terms'         => $current_categories[0],
                        'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
                    ),
                    array(
                        'taxonomy'      => 'product_visibility',
                        'field'         => 'slug',
                        'terms'         => 'exclude-from-catalog', // Possibly 'exclude-from-search' too
                        'operator'      => 'NOT IN'
                    )
                )
            );
            $products = new WP_Query($args);
//            var_dump($products);
        }

        $image_id = get_post_thumbnail_id($product->get_id());

        ?>

        <section class="card-sec">
            <div class="container">
                <h2 class="card-sec__title title title-center">
                    <?php echo get_field('product_reviews_grid_title') ?>
                </h2>
                <div class="card-sec__wrapper js_loader_control ">
                    <?php
                    $index = 0;
                    while ( $index < 3){
                        ?>
                        <div class="card-prod js_find_produc" data-term-id="<?php echo $current_categories[0] ?>" data-block="<?php echo $index ?>">
                            <div class="card-prod__title">
                                <select name="select" class="castom-select js_click_select">
                                    <?php
                                    if (isset($products)){
                                        $first = true;
                                        foreach ($products->posts as $item){
                                            if ($first){
                                                ?>
                                                <option value="" class="" data-product_id="<?php echo $item ?>">
                                                    <?php echo get_the_title($post_id) ?>
                                                </option>
                                                <?php
                                                $first = false;
                                                continue;
                                            }
                                            if ($item != $post_id){
                                            ?>
                                            <option value="" class="" data-product_id="<?php echo $item ?>">
                                                <?php echo get_the_title($item) ?>
                                            </option>
                                            <?php
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="product_class js_pate_product">
                                <div class="card-prod__price">
                                    <?php echo get_post_field('_price', $product->get_id()) . ' ' . get_woocommerce_currency_symbol() ?>
                                </div>
                                <div class="card-prod__code">
                                    <?php echo get_field('product_model', $product->get_id()); ?> / Art.-Nr. <?php echo $product->get_sku() ?>
                                </div>
                                <div class="card-prod__star">
                                    <div class="rating rating-black" data-total-value='<?php echo intval($middle_rating) ?>'>
                                        <div class="rating__item" data-rating-value='5'>
                                            <svg class="rating__icon rating__icon--reviews">
                                                <use xlink:href="<?php echo get_template_directory_uri() ?>/img/sprite.svg#star"></use>
                                            </svg>
                                        </div>
                                        <div class="rating__item" data-rating-value="4">
                                            <svg class="rating__icon rating__icon--reviews">
                                                <use xlink:href="<?php echo get_template_directory_uri() ?>/img/sprite.svg#star"></use>
                                            </svg>
                                        </div>
                                        <div class="rating__item" data-rating-value="3">
                                            <svg class="rating__icon rating__icon--reviews">
                                                <use xlink:href="<?php echo get_template_directory_uri() ?>/img/sprite.svg#star"></use>
                                            </svg>
                                        </div>
                                        <div class="rating__item" data-rating-value="2">
                                            <svg class="rating__icon rating__icon--reviews">
                                                <use xlink:href="<?php echo get_template_directory_uri() ?>/img/sprite.svg#star"></use>
                                            </svg>
                                        </div>
                                        <div class="rating__item" data-rating-value="1">
                                            <svg class="rating__icon rating__icon--reviews">
                                                <use xlink:href="<?php echo get_template_directory_uri() ?>/img/sprite.svg#star"></use>
                                            </svg>
                                        </div>
                                    </div>
                                    <?php echo $middle_rating . ' (' . count($product_page_blocks_reviews) . ')' ?>
                                </div>
                                <a href="<?php echo get_permalink($product->get_id()) ?>" class="card-prod__img long-img">
                                    <?php
                                    if (isset($image_id)){
                                        ?>
                                        <img loading="lazy" src="<?php echo wp_get_attachment_image_url($image_id, 'full') ?>"
                                             alt="<?php echo wp_get_attachment_image_url($image_id, '_wp_attachment_image_alt', TRUE) ?>">
                                        <?php
                                    }
                                    ?>
                                </a>
                                <a href="<?php echo get_permalink($product->get_id()) ?>" class="card-prod__btn btn btn--black">
                                    Zum Produkt
                                </a>
                                <div class="card-prod__bottom">
                                    <?php
                                    foreach ($product->get_attributes() as $taxonomy => $attribute_obj ) {
                                        $attribute_label_name = wc_attribute_label($taxonomy);
//                                        $tax = str_replace('pa_', '', $taxonomy);
                                        $terms = [];
                                        foreach ($attribute_obj['options'] as $option){
                                            $terms[] = get_term_by('id', $option, $taxonomy)->name;
                                        }
                                        ?>
                                        <div>
                                            <span><?php echo $attribute_label_name ?></span>
                                            <span><?php echo implode(', ', $terms) ?>r</span>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        $index++;
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
                'key'       => 'product_comparison_grid_group',
                'title'     => 'Product comparison',
                'fields'    => array
                (
                    array
                    (
                        'key'               => 'product_comparison_grid_group_title_field',
                        'label'             => 'Title',
                        'name'              => 'product_reviews_grid_title',
                        'type' 				=> 'text',
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

new BlogSectionProductComparison();


?>