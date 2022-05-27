<?php

class BlogSectionReviewsBlock {

    private $id = 'review-grid';
    private $name = 'Review Grid';

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
        $my_posts = new WP_Query;
        $myposts = $my_posts->query( array(
            'post_type' => 'comments_block',
            'posts_per_page' => -1,
            'post_status' => [ 'publish', ],
            'fields'        => 'ids',
        ) );
        $middle_star = 0;
        foreach( $myposts as $pst ){
            $middle_star += intval(get_field('stars', $pst));
        }
        $middle_star = round($middle_star / $my_posts->post_count, 2);
        $middle_title = get_field('title'. intval($middle_star), 'options');
        ?>
        <section class="testimonials">
            <div class="container">
                <div class="testimonials__inner">
                    <div class="testimonials__stats">
                        <div class="testimonials__stats-rating">
                            <div class="rating" data-total-value='<?php echo intval($middle_star) ?>'>
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
                        </div>
                        <p class="testimonials__stats-text body-m"><?php echo $middle_title ?></p>
                        <p class="testimonials__stats-grade h5">
                            <?php echo $middle_star ?>/5.00
                        </p>
                        <div class="testimonials__stats-icon">
                            <img src="<?php echo get_template_directory_uri() ?>/img/testimonials-logo.svg" alt="">
                        </div>
                    </div>
                    <div class="testimonials__list">
                        <div class="testimonials__slider swiper">
                            <div class="swiper-wrapper">
                                <?php
                                foreach( $myposts as $pst ){
                                    ?>
                                    <div class="swiper-slide testimonials__slide">
                                        <div class="testimonials__rating">
                                            <div class="rating" data-total-value='<?php echo get_field('stars', $pst) ?>'>
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
                                        </div>
                                        <time class="testimonials__time" datetime="2022-02-12"><?php echo get_field('date', $pst) ?></time>
                                        <p class="testimonials__title body-s-bold"><?php echo get_field('title', $pst) ?></p>
                                        <p class="testimonials__descr body-s"><?php echo get_field('comment', $pst) ?></p>
                                    </div>
                                    <?php
                                }

                                ?>
                            </div>
                        </div>
                        <div class="testimonials-button-next">
                            <svg class="rating__icon rating__icon--reviews">
                                <use xlink:href="<?php echo get_template_directory_uri() ?>/img/sprite.svg#arrow-right"></use>
                            </svg>
                        </div>
                        <div class="testimonials-button-prev">
                            <svg class="rating__icon rating__icon--reviews">
                                <use xlink:href="<?php echo get_template_directory_uri() ?>/img/sprite.svg#arrow-left"></use>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php

    }

	public function RegisterMainFields() {

	}
}

new BlogSectionReviewsBlock();


?>