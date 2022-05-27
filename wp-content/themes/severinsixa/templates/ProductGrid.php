<?php

class BlogSectionProductGrid
{

    private $id = 'product-grid';
    private $name = 'Product Grid';

    public function __construct()
    {
        add_action('acf/init', array($this, 'register_block'));
        add_action('acf/init', array($this, 'RegisterMainFields'));
    }


    public function register_block()
    {

        // check function exists.
        if (function_exists('acf_register_block_type')) {

            // register a testimonial block.
            acf_register_block_type(array(
                'name' => $this->id,
                'title' => __($this->name),
                'render_callback' => array($this, 'render'),
                'category' => 'formatting',
                'mode' => 'preview',
                'enqueue_assets' => array($this, 'enqueue_assets'),
            ));
        }
    }

    public function enqueue_assets()
    {
        wp_enqueue_style($this->id, get_theme_file_uri('assets/index/Product Grid/Product Grid.css'));
    }

    /**
     * Testimonial Block Callback Function.
     *
     * @param array $block The block settings and attributes.
     * @param string $content The block inner HTML (empty).
     * @param bool $is_preview True during AJAX preview.
     * @param   (int|string) $post_id The post ID this block is saved to.
     */
    public function render($block, $content = '', $is_preview = false, $post_id = 0)
    {
        ?>


        <section class="bestseller">
            <div class="container">
                <h2 class="bestseller__title title"><?php echo get_field('title') ?></h2>
                <div class="bestseller__list swiper">
                    <div class="swiper-wrapper swiper-wrapper--short">
                        <?php
                        $products = get_field('post');
                        if (isset($products)) {
                            foreach ($products as $id) {
                                $image_id = get_post_field('_thumbnail_id', $id);
                                $post_thumbnail_img = wp_get_attachment_image_src($image_id, 'full');
                                $alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
                                ?>
                                <a class="product product--set swiper-slide" href="<?php echo get_permalink($id) ?>">
                                    <picture class="product__img">
                                        <source srcset="" type="image/webp">
                                        <img src="<?php echo $image_id ? $post_thumbnail_img[0] : '' ?>"
                                             alt="<?php echo $alt ?: '' ?>">
                                    </picture>
                                    <?php
                                    $price = intval(get_post_field('_price', $id));
                                    $regular_price = intval(get_post_field('_regular_price', $id));

                                    if ($price != $regular_price) {
                                        $percent = round($price * 100 / $regular_price, 0);
                                        ?>
                                        <p class="product__discount h5">-<?php echo $percent ?>%</p>
                                        <?php
                                    }
                                    ?>
                                    <p class="product__name">
                                        <?php echo get_the_title($id) ?>
                                    </p>
                                    <p class="product__model body-s">
                                        <?php echo get_field('product_model', $id); ?>
                                    </p>
                                    <p class="product__price body-s-bold">
                                        <?php
                                        if ($regular_price != $price){
                                            ?>
                                            <span class="product__price-new"><?php echo get_post_field('_price', $id) . ' ' . get_woocommerce_currency_symbol() ?></span>
                                            <span class="product__price-old"><?php echo get_post_field('_regular_price', $id) . ' ' . get_woocommerce_currency_symbol() ?></span>
                                            <?php
                                        }else{
                                        ?>
                                            <p class="product__price body-s-bold">
                                                <?php echo get_post_field('_price', $id) . ' ' . get_woocommerce_currency_symbol() ?>
                                            </p>
                                        <?php
                                        }
                                        ?>
                                    </p>
                                </a>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <div class="bestseller__progressbar progressbar"></div>
                </div>
            </div>
        </section>

        <!--        <section class="bestseller bestseller--big">-->
        <!--            <div class="container">-->
        <!--                <h2 class="bestseller__title title">--><?php //echo get_field('title') ?><!--</h2>-->
        <!--                <div class="bestseller__list swiper">-->
        <!--                    <div class="swiper-wrapper">-->
        <!--                        --><?php
//                        $products = get_field('post');
//                        if ( isset($products) ){
//                            foreach ( $products as $id){
//                                $image_id = get_post_field('_thumbnail_id', $id);
//                                $post_thumbnail_img = wp_get_attachment_image_src( $image_id, 'full' );
//                                $alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
//                                ?>
        <!--                                <a class="product swiper-slide" href="--><?php //echo get_permalink($id) ?><!--">-->
        <!--                                    <picture class="product__img">-->
        <!--                                        <source srcset="" type="image/webp">-->
        <!--                                        <img src="--><?php //echo $image_id ? $post_thumbnail_img[0] : '' ?><!--" alt="--><?php //echo $alt ?: '' ?><!--">-->
        <!--                                    </picture>-->
        <!--                                    <p class="product__name">-->
        <!--                                        --><?php //echo get_the_title($id) ?>
        <!--                                    </p>-->
        <!--                                    <p class="product__model body-s">-->
        <!--                                        --><?php //echo get_post_field('_sku', $id) ?>
        <!--                                    </p>-->
        <!--                                    <p class="product__price body-s-bold">-->
        <!--                                        --><?php //echo get_post_field('_price', $id) . ' ' . get_woocommerce_currency_symbol() ?>
        <!--                                    </p>-->
        <!--                                </a>-->
        <!--                                --><?php
//                            }
//                        }
//                        ?>
        <!--                    </div>-->
        <!--                    <div class="bestseller__progressbar progressbar"></div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </section>-->
        <?php

    }

    public function RegisterMainFields()
    {
        acf_add_local_field_group
        (
            array
            (
                'key' => 'product_grid_group',
                'title' => 'Product Grid',
                'fields' => array
                (
                    array
                    (
                        'key' => 'product_grid_group_field',
                        'label' => 'Title',
                        'name' => 'title',
                        'type' => 'text',
                        'require' => 0,
                    ),
                    array
                    (
                        'key' => 'product_grid_group_post_field',
                        'label' => 'Posts',
                        'name' => 'post',
                        'type' => 'relationship',
                        'return_format' => 'id',
                        'post_type' => 'product',
                        'multiple' => 1,
                        'require' => 0,
                    ),
                ),
                'location' => array
                (
                    array
                    (
                        array
                        (
                            'param' => 'block',
                            'operator' => '==',
                            'value' => 'acf/' . $this->id,
                        ),
                    ),
                )
            )
        );

    }
}

new BlogSectionProductGrid();


?>