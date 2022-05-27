<?php

class BlogSectionProductReviewsBlock {

    private $id = 'product-review-grid';
    private $name = 'Product reviews Grid';

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


        $product_page_blocks_reviews = get_field('product_page_blocks_reviews', get_the_ID());
//        var_export($product_page_blocks_reviews);
        $middle_rating = 0;
        if($product_page_blocks_reviews != null){
            foreach ($product_page_blocks_reviews as $blocks_review){
                $middle_rating += intval($blocks_review['stars']);
            }
            $middle_rating = round($middle_rating / count($product_page_blocks_reviews), 2);
        }
        ?>

        <section class="reviews">
            <div class="container">
                <h2 class="reviews__title title title-center">
                    <?php echo get_field('product_reviews_grid_title') ?>
                </h2>
                <div class="reviews__wrapper">
                    <div class="reviews__top">
                        <div class="reviews__left">
                            <?php echo $product_page_blocks_reviews != null ? count($product_page_blocks_reviews) : 0 ?> Bewertungen
                            <span>Für <?php echo get_the_title() ?></span>
                        </div>
                        <?php
                        if($product_page_blocks_reviews != null){
                            ?><div class="reviews__right">
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
                            <?php
                        }
                        ?>

                    </div>
                    <div class="swiper reviews-swiper">
                        <div class="swiper-wrapper">
                            <?php
                             if($product_page_blocks_reviews != null)
                            foreach ($product_page_blocks_reviews as $blocks_review){
                                ?>
                                <div class="swiper-slide">
                                    <div class="reviews-item">
                                        <div class="reviews-item__top">
                                            <div class="reviews-item__star">
                                                <div class="rating rating-black" data-total-value='<?php echo intval($blocks_review['stars']) ?>'>
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
                                                <?php echo $blocks_review['date'] ?>
                                            </div>
                                            <div class="reviews-item__pay">
                                                <?php
                                                if ($blocks_review['confirmed']){
                                                    echo '(bestätigter Kauf)';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <p class="reviews-item__descr">
                                            <?php echo $blocks_review['comment'] ?>
                                        </p>
                                    </div>
                                </div>
                                <?php
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
                'key'       => 'product_reviews_grid_group',
                'title'     => 'Product reviews Grid',
                'fields'    => array
                (
                    array
                    (
                        'key'               => 'product_reviews_grid_group_title_field',
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

new BlogSectionProductReviewsBlock();


?>