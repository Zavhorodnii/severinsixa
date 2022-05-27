<?php

class BlogSectionType1 {

    private $id = 'Intro';
    private $name = 'Intro';

    public function __construct() {
        add_action('acf/init', array($this, 'register_block'));
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
        wp_enqueue_style( $this->id, get_theme_file_uri('assets/index/HeroSlider/HeroSlider.css') );
        wp_enqueue_script( $this->id, get_theme_file_uri('assets/index/HeroSlider/HeroSlider.js') );
//        wp_enqueue_style( $this->id . '-custom',  get_theme_file_uri('dist/sidekick.css') );
//        wp_enqueue_style( $this->id . '-main',  get_template_directory_uri() . '/assets/css/main.css' );
//        wp_enqueue_style( $this->id . '-vendor',  get_template_directory_uri() . '/assets/css/vendor.css' );
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
        <section class="intro">
            <div class="swiper-wrapper">
                <?php
                $intro = get_field('intro');
//                var_export($intro);
                if ( is_array($intro) )
                foreach ( $intro as $item ){
                    ?>
                    <div class="swiper-slide intro__slide">
                        <div class="container">
                            <picture class="intro__img">
                                <source srcset="" type="image/webp">
                                <img src="<?php echo $item['image']['url'] ?>" alt="<?php echo $item['image']['alt'] ?>">
                            </picture>
                            <h1 class="h1 intro__title"><?php echo $item['title'] ?></h1>
                            <div class="intro__nav">
                                <?php
                                if ( is_array( $item['button'])){
                                    ?>
                                    <a class="btn btn--trans" href="<?php echo $item['button']['url'] ?>">
                                        <?php echo $item['button']['title'] ?>
                                    </a>
                                    <?php
                                }
                                if ( is_array( $item['link'])){
                                    ?>
                                    <a class="intro__info-btn" href="<?php echo $item['link']['url'] ?>"><?php echo $item['link']['title'] ?></a>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <button class="intro-button-next"></button>
            <button class="intro-button-prev"></button>
        </section>
        <?php

    }

}

new BlogSectionType1();


?>