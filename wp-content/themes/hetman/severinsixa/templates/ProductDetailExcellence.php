<?php

class BlogSectionProductDetailExcellence {

    private $id = 'product-detail-excellence';
    private $name = 'Product Detail';

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

//        var_export($product);
        if ($product == null){
            return;
        }

//        echo 'ID = ' . get_the_ID();

//        $product = wc_get_product( 7402 );
        ?>
        <div class="container">
            <ul class="breadcrumbs-list">
                <?php
                $terms = get_the_terms ( get_the_ID(), 'product_cat' );
                $cat = $this->get_category_product($terms[0]->term_id, []);
                if (is_array($cat)){
                    foreach ( $cat as $key=>$item ){
                        if ($key == count($cat)-1 ){
                            ?>
                            <li class="breadcrumbs-list__item">
                                <span><?php echo $item->name ?></span>
                            </li>
                            <?php
                            break;
                        }
                        ?>
                        <li class="breadcrumbs-list__item">
                            <a href="<?php echo get_term_link( $item->term_id, 'product_cat' ); ?>"><?php echo $item->name ?></a>
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>

        <?php
        $image_id = $product->get_image_id();
        $gallery_image_ids = $product->get_gallery_image_ids();
        $product_info_group = get_field('product_info_group',);
//        var_export($product_info_group);
        $product_availability = get_field('product_availability', 'options');
        $product_page_blocks_reviews = get_field('product_page_blocks_reviews', get_the_ID());
        $middle_rating = 0;
        if(is_array($product_page_blocks_reviews)){
            foreach ($product_page_blocks_reviews as $blocks_review){
                $middle_rating += intval($blocks_review['stars']);
            }
            $middle_rating = round($middle_rating / count($product_page_blocks_reviews), 2);
        }
//        var_export($product_page_blocks_reviews);
        ?>

        <section class="card-page">
            <div class="container card-page__wrapper">
                <div class="card-page-slider">
                    <div class="swiper card-page-swiper">
                        <div class="swiper-wrapper" id="lightgallery">

                            <?php
                            if ($image_id){
                                ?>
                                <a href="<?php echo wp_get_attachment_image_url($image_id, 'full') ?>" class="swiper-slide">
                                    <picture>
                                        <source srcset="" type="image/webp">
                                        <img loading="lazy" src="<?php echo wp_get_attachment_image_url($image_id, 'full') ?>"
                                             alt="<?php echo wp_get_attachment_image_url($image_id, '_wp_attachment_image_alt', TRUE) ?>">
                                    </picture>
                                </a>
                                <?php
                            }
                            if (is_array($gallery_image_ids)) {
                                foreach ($gallery_image_ids as $gallery_image_id) {
                                    ?>
                                    <a href="<?php echo wp_get_attachment_image_url($gallery_image_id, 'full') ?>" class="swiper-slide">
                                        <picture>
                                            <source srcset="" type="image/webp">
                                            <img loading="lazy" src="<?php echo wp_get_attachment_image_url($gallery_image_id, 'full') ?>"
                                                 alt="<?php echo get_post_meta($gallery_image_id, '_wp_attachment_image_alt', TRUE) ?>">
                                        </picture>
                                    </a>
                                    <?php
                                }
                            }

                            ?>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="card-page-slider__bottom">
                            <div class="swiper-pagination"></div>
                            <button class="btn-vr">
                                Augmented Reality
                            </button>
                        </div>
                    </div>
                </div>
                <form class="card-page-info js_get_info">
                    <div class="card-page-info__top">
                        <div class="card-page__title">
                            <?php echo $product->get_title() ?>
                        </div>
                        <div class="card-page__price">
                            <?php echo $product->get_price() . ' ' . get_woocommerce_currency_symbol() ?>
                        </div>
                    </div>
                    <div class="card-page__model">
                        <?php echo get_field('product_model', $product->get_id()) ?>
                    </div>
                    <div class="card-page__star">
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
                        <?php echo $middle_rating . ' (' . ($product_page_blocks_reviews ? count($product_page_blocks_reviews) : '0') . ')' ?>
                    </div>
                    <div class="card-page__top-wrap">
                        <div class="card-page__link">
                            Referenz: <?php echo $product->get_sku() ?>
                        </div>
                        <div class="card-page__availability green">
                            <?php
                            if ($product->get_stock_quantity() > 0){
                                ?>
                                <?php echo $product_availability['in_stock'] ?>, <?php echo $product_info_group['product_delivery'] ?>
                                <?php
                            }
                            else{
                                echo $product_availability['out_of_stock'];
                            }
                            ?>
                        </div>
                    </div>
                    <div class="card-page__descr">
                        <?php echo $product_info_group['product_description'] ?>
                    </div>

                    <?php
                    $bundle_sell_ids = get_post_meta( $product->get_id(), '_wc_pb_bundle_sell_ids' );
                    $wc_pb_bundle_sells_discount = get_post_meta( $product->get_id(), '_wc_pb_bundle_sells_discount');
//                    var_export($wc_pb_bundle_sells_discount);
//                    var_export($bundle_sell_ids);
                    if (count($bundle_sell_ids) > 0){
                        ?>
                        <div class="together-prod">
                            <div class="together-prod__title">
                                Passende Produkte
                            </div>
                            <?php
                            foreach ($bundle_sell_ids[0] as $bundle_sell_id ){
//                                $image_id = get_post_meta($bundle_sell_id, '_thumbnail_id');
                                $image_id = get_post_thumbnail_id($bundle_sell_id);
//                                var_export($image_id);
                                $product_bundle = wc_get_product($bundle_sell_id);
                                $price = $product_bundle->get_price();
                                ?>
                                <div class="together-prod-item">
                                    <div class="together-prod-item__img">
                                        <?php if ( $image_id ) { ?>
                                        <img loading="lazy" src="<?php echo wp_get_attachment_image_url($image_id, 'full') ?>"
                                             alt="<?php echo wp_get_attachment_image_url($image_id, '_wp_attachment_image_alt', TRUE) ?>">
                                        <?php } ?>
                                    </div>
                                    <div class="together-prod-item__right">
                                        <div class="together-prod-item__title">
                                            <?php echo get_the_title($bundle_sell_id) ?>
                                        </div>
                                        <label class="together-prod-item__check checkbox js_click_checkbox js_get_bundle">
                                            <input class="checkbox__input " data-product_id="<?php echo $bundle_sell_id ?>" type="checkbox">
                                            <p class="checkbox__content">
                                                Für <?php echo $price - round($price * ($wc_pb_bundle_sells_discount[0] / 100) , 2) . ' ' . get_woocommerce_currency_symbol() ?> hinzufügen
                                            </p>
                                        </label>
                                        <div class="together-prod-item__bottom">
                                            <span>Anstatt <?php echo $price . ' ' . get_woocommerce_currency_symbol() ?></span>
                                            <p class="save">Du sparst <?php echo $wc_pb_bundle_sells_discount[0] ?>% auf diesen Artikel.</p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="card-page__count ">
                        <div class="select-block-wrap">
                            <select class="amount-block js_get_quantity">
                                <option value="">1</option>
                                <option value="">2</option>
                                <option value="">3</option>
                            </select>
                        </div>
                        <button class="card-page__btn btn btn--black js_add_product_to_cart" data-product_id="<?php echo $product->get_id() ?>">
                            In den Warenkorb
                        </button>
                    </div>
                    <?php
                    $product_info_scroll_link_group = get_field('product_info_scroll_link_group');
                    if( is_array($product_info_scroll_link_group) ){
                        ?>
                        <div class="card-page__bottom-link">
                            <?php
                            foreach ($product_info_scroll_link_group as $item){
                                ?>
                                <a href="<?php echo $item['link'] ?>"><?php echo $item['title'] ?></a>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>

                    <div class="card-page__bottom-info">
                        <?php
                        $product_info_addition_info_group = get_field('product_info_addition_info_group');
                        if ( is_array($product_info_addition_info_group) ){
                            foreach ($product_info_addition_info_group as $item){
                                ?>
                                <div class="bottom-info__item">
                                    <img loading="lazy" src="<?php echo $item['icon']['url'] ?>" alt="<?php echo $item['icon']['alt'] ?>">
                                    <?php echo $item['title'] ?>
                                </div>
                                <?php
                            }
                        }
                        ?>
                        <?php
                        $show_payment_methods = get_field('show_payment_methods');
                        if ( $show_payment_methods ){
                            ?>
                            <div class="bottom-info__item">
                                <img loading="lazy" src="<?php echo get_template_directory_uri() ?>/img/bottom-info3.svg" alt="img">
                                Zahlungsmethoden
                                <div class="bottom-info__icons">
                                    <?php
                                    $payment_methods = get_field('payment_methods', 'options');
                                    if( is_array( $payment_methods ) ){
                                        foreach ( $payment_methods as $image_id ){
                                            ?>
                                            <img loading="lazy" src="<?php echo $image_id['url'] ?>"
                                                 alt="<?php echo $image_id['alt'] ?>">
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>

                </form>
            </div>
        </section>

        <?php

    }

    public function get_category_product( $category_id, $category_arr){
        $term = get_term_by('id', $category_id, 'product_cat');
        if ( $term->parent )
            $category_arr = $this->get_category_product( $term->parent, $category_arr );
        $category_arr[] = $term;
        return $category_arr;
    }

	public function RegisterMainFields() {
		acf_add_local_field_group
		(
			array
			(
				'key'       => 'product_info_block_group',
				'title'     => 'Product info',
				'fields'    => array
				(
                    array
                    (
                        'key'               => 'product_info_block_main_group_field',
                        'label'             => 'Product',
                        'name'              => 'product_info_group',
                        'type' 				=> 'group',
                        'require'			=> 0,
                    ),
                    array
                    (
                        'key'               => 'product_info_block_main_scroll_link_field',
                        'label'             => 'Scroll link',
                        'name'              => 'product_info_scroll_link_group',
                        'type' 				=> 'repeater',
                        'layout'			=> 'block',
                        'sub_fields' 		=> array
                        (
                            array
                            (
                                'button_label'	=> 'Add section',
                            ),
                        ),
                        'collapsed'			=> 'product_info_block_main_scroll_link_title_field',
                    ),
                    array
                    (
                        'key'               => 'product_info_block_main_addition_info_field',
                        'label'             => 'Addition info',
                        'name'              => 'product_info_addition_info_group',
                        'type' 				=> 'repeater',
                        'layout'			=> 'row',
                        'sub_fields' 		=> array
                        (
                            array
                            (
                                'button_label'	=> 'Add section',
                            ),
                        ),
                        'collapsed'			=> 'thematic_block_title_field',
                    ),
                    array
                    (
                        'key'               => 'product_info_block_main_show_payment_methods_field',
                        'label'             => 'Show payment methods',
                        'name'              => 'show_payment_methods',
                        'type' 				=> 'true_false',
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


//        acf_add_local_field
//        (
//            array
//            (
//                'key'               => 'product_info_block_main_group_product_model_field',
//                'label'             => 'Product model',
//                'name'              => 'product_model',
//                'type' 				=> 'text',
//                'parent'            => 'product_info_block_main_group_field',
//                'require'			=> 0,
//            )
//        );
        acf_add_local_field
        (
            array
            (
                'key'               => 'product_info_block_main_group_product_delivery_field',
                'label'             => 'Delivery',
                'name'              => 'product_delivery',
                'type' 				=> 'text',
                'parent'            => 'product_info_block_main_group_field',
                'require'			=> 0,
            )
        );
        acf_add_local_field
        (
            array
            (
                'key'               => 'product_info_block_main_group_product_description_field',
                'label'             => 'Description',
                'name'              => 'product_description',
                'type' 				=> 'wysiwyg',
                'parent'            => 'product_info_block_main_group_field',
                'require'			=> 0,
            )
        );
        acf_add_local_field
        (
            array
            (
                'key'               => 'product_info_block_main_scroll_link_title_field',
                'label'             => 'Title',
                'name'              => 'title',
                'type' 				=> 'text',
                'parent'            => 'product_info_block_main_scroll_link_field',
                'require'			=> 0,
            )
        );
        acf_add_local_field
        (
            array
            (
                'key'               => 'product_info_block_main_scroll_link_link_field',
                'label'             => 'Link',
                'name'              => 'link',
                'type' 				=> 'text',
                'default_value'     => '#',
                'parent'            => 'product_info_block_main_scroll_link_field',
                'require'			=> 0,
            )
        );
		acf_add_local_field
		(
			array
			(
				'key'               => 'product_info_block_main_addition_info_icon_field',
				'label'             => 'Icon',
				'name'              => 'icon',
				'type' 				=> 'image',
				'parent'            => 'product_info_block_main_addition_info_field',
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
                'key'               => 'product_info_block_main_addition_info_text_field',
                'label'             => 'Title',
                'name'              => 'title',
                'type' 				=> 'text',
                'parent'            => 'product_info_block_main_addition_info_field',
                'require'			=> 0,
            )
        );
	}
}

new BlogSectionProductDetailExcellence();


?>