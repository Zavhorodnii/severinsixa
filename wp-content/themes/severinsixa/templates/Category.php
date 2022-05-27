<?php

class BlogSectionProductProductGridFilter
{

    private $id = 'product-grid-filter';
    private $name = 'Product Grid + Filter';

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
        wp_enqueue_style($this->id, get_theme_file_uri('assets/category-page/Product Grid + Filter/Product Grid + Filter.css'));
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
        wp_reset_postdata();
        $term_obj = get_field('category');
        $insert_ad_block = get_field('insert_ad_block');
        $show_count_products = intval(get_field('show_count_product_in_filter', 'options'));

        $get_params = [];
        foreach($_GET as $key => $value) {
            $get_params[$key] = explode(';', $value);
        }

//        echo 'term = ' . $term_obj->slug . ' ';

        if (count($get_params) == 0 ) {
            if (isset($term_obj)) {
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => -1,
                    'fields' => 'ids',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product_cat',
                            'field' => 'slug',
                            'terms' => $term_obj->slug,
                        )
                    )
                );
                $query = new WP_Query($args);
            }
        }
        else{
            $query = get_product_by_get_params($get_params);
        }
        $terms_arr = get_field('filter_items');
        ?>

        <section class="catalog">
            <div class="container js_find_product js_loader_control">
                <form class="filter js_get_filter_params" data-term="<?php echo $term_obj->slug ?>" action="/">
                    <ul class="filter__list">
                        <li class="filter__item">
                            <p class="filter__btn" type="button">Preis</p>
                            <div class="filter__dropdown">
                                <?php
                                $price_filter = get_field('price_filter', 'options');
                                if (is_array($price_filter)) {
                                    foreach ($price_filter as $key => $item) {
                                        $data_active = 0;
                                        if(key_exists('price', $get_params ) ){
                                            $data_active = in_array($key, $get_params['price']) ? 1 : 0;
                                        }
                                        ?>
                                        <label class="filter__checkbox checkbox">
                                            <input class="checkbox__input" type="checkbox" <?php echo $data_active ? 'checked' : '' ?> name="price">
                                            <p class="checkbox__content js_click_filter"
                                               data-active="<?php echo $data_active ?>"
                                               data-term-slug="<?php echo $key ?>"
                                               data-term-main="price"
                                            >
                                                <?php echo $item['min_price'] . ' ' . get_woocommerce_currency_symbol() . ' – '
                                                    . $item['max_price'] . ' ' . get_woocommerce_currency_symbol() ?>
                                            </p>
                                        </label>
                                        <?php
                                    }
                                }
                                ?>

                            </div>
                        </li>
                        <?php
                        if (is_array($terms_arr)){
                            foreach ($terms_arr as $item){
                                $args = array(
                                    'taxonomy'      => array( 'pa_' . $item['term_slug'], ), // название таксономии с WP 4.5
                                    'orderby'       => 'id',
                                    'order'         => 'ASC',
                                    'hide_empty'    => true,
                                );

                                $term_query = new WP_Term_Query( $args );
                                if (count($term_query->terms)){
                                    ?>
                                    <li class="filter__item ">
                                        <p class="filter__btn" type="button"><?php echo wc_attribute_label('pa_' . $item['term_slug']) ?></p>
                                        <div class="filter__dropdown">
                                            <?php
                                            foreach ($term_query->terms as $term){
                                                $data_active = 0;
                                                if(key_exists($item['term_slug'], $get_params ) ){
                                                    $data_active = in_array($term->slug, $get_params[$item['term_slug']]) ? 1 : 0;
                                                }
                                                ?>
                                                <label class="filter__checkbox checkbox">
                                                    <input class="checkbox__input" type="checkbox" <?php echo $data_active ? 'checked' : '' ?> name="battery-life">
                                                    <p class="js_click_filter checkbox__content"
                                                       data-active="<?php echo $data_active ?>"
                                                       data-term-main="<?php echo $item['term_slug'] ?>"
                                                       data-term-slug="<?php echo $term->slug ?>">
                                                        <?php echo $term->name ?>
                                                    </p>
                                                </label>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </li>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </ul>
                    <p class="filter__value h5 js_post_count">
                        <?php echo isset($term_obj) ? $query->post_count : '' ?>
                    </p>
                </form>
                <div class="catalog__list js_paste_product">
                    <?php
                    $index = 0;
                    if (isset($term_obj)) {
                        while ($query->have_posts()) : $query->the_post();
                            $index++;
                            $id = get_the_ID();
                            $image_id = get_post_field('_thumbnail_id', $id);
                            $post_thumbnail_img = wp_get_attachment_image_src($image_id, 'full');
                            $alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
                            ?>
                            <a class="product" href="<?php echo get_permalink($id) ?>">
                                <picture class="product__img">
                                    <source srcset="" type="image/webp">
                                    <img src="<?php echo $image_id ? $post_thumbnail_img[0] : '' ?>"
                                         alt="<?php echo $alt ?: '' ?>">
                                </picture>
                                <p class="product__name">
                                    <?php echo get_the_title($id) ?>
                                </p>
                                <p class="product__model body-s">
                                    <?php echo get_field('product_model', $id); ?>
                                </p>
                                <p class="product__price body-s-bold">
                                    <?php echo get_post_field('_price', $id) . ' ' . get_woocommerce_currency_symbol() ?>
                                </p>
                            </a>
                        <?php

                        foreach ($insert_ad_block as $item){
                            if ($item['skip_items'] == $index ){
                                ?>
                                <div class="card-intermediate">
                                    <div class="card-intermediate__content">
                                        <p class="card-intermediate__title h3">
                                            <?php echo $item['title'] ?>
                                        </p>
                                        <a class="btn btn--trans" href="<?php echo $item['button']['link'] ?>">
                                            <?php echo $item['button']['title'] ?>
                                        </a>
                                    </div>
                                    <picture class="card-intermediate__img">
                                        <source srcset="" type="image/webp">
                                        <?php
                                        if( is_array( $item['image'] ) ){
                                            ?>
                                            <img src="<?php echo $item['image']['url'] ?>" alt="<?php echo $item['image']['alt'] ?>">
                                            <?php
                                        }
                                        ?>
                                    </picture>
                                </div>
                                <?php
                            }
                        }

                        if ($index == $show_count_products)
                            break;
                        endwhile;
                    }
                    ?>
                </div>
                <div class="page-status">
                    <p class="page-status-text"><span class="js_show_product_count"><?php echo $index ?></span> von <span class="js_post_count"><?php echo $query->post_count ?></span> werden angezeigt</p>
<!--                    --><?php
//                    if ($query->post_count > $show_count_products){
//                        ?>
                        <div class="page-status-bar">
                            <span class="page-status-line"></span>
                        </div>
                        <button class="btn btn--black js_click_load_more js_click_filter" style="visibility: <?php echo $query->post_count > $show_count_products ? 'visible' : 'hidden' ?>" data-offset="1">Mehr anzeigen</button>
<!--                        --><?php
//                    }
//                    ?>
                </div>
            </div>
        </section>


        <?php

    }

//    public function get_category_product($category_id, $category_arr)
//    {
//        $term = get_term_by('id', $category_id, 'product_cat');
//        if ($term->parent)
//            $category_arr = $this->get_category_product($term->parent, $category_arr);
//        $category_arr[] = $term;
//        return $category_arr;
//    }

    public function RegisterMainFields()
    {
        acf_add_local_field_group
        (
            array
            (
                'key' => 'product_grid_filter_group',
                'title' => 'Category filter',
                'fields' => array
                (
                    array
                    (
                        'key' => 'product_grid_filter_group_category_field',
                        'label' => 'Category',
                        'name' => 'category',
                        'type' => 'taxonomy',
                        'taxonomy' => 'product_cat',
                        'return_format' => 'object',
                        'field_type' => 'select',
                        'add_term' => 0,
                        'require' => 1,
                    ),
                    array
                    (
                        'key' => 'product_grid_filter_group_filter_items_field',
                        'label' => 'Filter attributes slug',
                        'name' => 'filter_items',
                        'type' => 'repeater',
                        'layout' => 'block',
                        'sub_fields' => array
                        (
                            array
                            (
                                'button_label' => 'Add section',
                            ),
                        ),
                        'collapsed' => 'product_grid_filter_group_filter_items_term_slug_field',
                    ),
                    array
                    (
                        'key'           => 'product_grid_filter_group_insert_ad_block_field',
                        'label'         => 'Insert ad block',
                        'name'          => 'insert_ad_block',
                        'type'          => 'repeater',
                        'layout'        => 'block',
                        'sub_fields'    => array
                        (
                            array
                            (
                                'button_label' => 'Add section',
                            ),
                        ),
                        'collapsed' => 'product_info_block_main_scroll_link_title_field',
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


        acf_add_local_field
        (
            array
            (
                'key' => 'product_grid_filter_group_filter_items_term_slug_field',
                'label' => 'Term slug',
                'name' => 'term_slug',
                'type' => 'text',
                'parent' => 'product_grid_filter_group_filter_items_field',
                'require' => 0,
            )
        );

//----------
        acf_add_local_field
        (
            array
            (
                'key'           => 'product_grid_filter_group_insert_ad_block_skip_items_field',
                'label'         => 'Skip items before add ad',
                'name'          => 'skip_items',
                'type'          => 'number',
                'min'           => 1,
                'require'       => 0,
                'parent'        => 'product_grid_filter_group_insert_ad_block_field',
            ),
        );
        acf_add_local_field
        (
            array
            (
                'key'               => 'product_grid_filter_group_insert_ad_block_title_field',
                'label'             => 'title',
                'name'              => 'title',
                'type' 				=> 'text',
                'parent'            => 'product_grid_filter_group_insert_ad_block_field',
                'require'			=> 0,
            )
        );

		acf_add_local_field
		(
			array
			(
				'key'               => 'product_grid_filter_group_insert_ad_block_image_field',
				'label'             => 'Image',
				'name'              => 'image',
				'type' 				=> 'image',
				'parent'            => 'product_grid_filter_group_insert_ad_block_field',
				'require'			=> 1,
                'return_format'     => 'array',

			)
        );

        acf_add_local_field
        (
            array
            (
                'key'               => 'product_grid_filter_group_insert_ad_block_button_field',
                'label'             => 'Button',
                'name'              => 'button',
                'type' 				=> 'group',
                'parent'            => 'product_grid_filter_group_insert_ad_block_field',
                'require'			=> 0,
            )
        );
        acf_add_local_field
        (
            array
            (
                'key'               => 'product_grid_filter_group_insert_ad_block_button_title_field',
                'label'             => 'title',
                'name'              => 'title',
                'type' 				=> 'text',
                'parent'            => 'product_grid_filter_group_insert_ad_block_button_field',
                'require'			=> 0,
            )
        );
        acf_add_local_field
        (
            array
            (
                'key'               => 'product_grid_filter_group_insert_ad_block_button_link_field',
                'label'             => 'Link',
                'name'              => 'link',
                'type' 				=> 'text',
                'default_value'     => '#',
                'parent'            => 'product_grid_filter_group_insert_ad_block_button_field',
                'require'			=> 0,
            )
        );
    }
}

new BlogSectionProductProductGridFilter();


?>