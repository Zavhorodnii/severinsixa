<?php

add_action('wp_ajax_ajax_get_product_comparison', 'ajax_get_product_comparison');
add_action('wp_ajax_nopriv_ajax_get_product_comparison', 'ajax_get_product_comparison');


function ajax_get_product_comparison(){
    if(!isset($_POST['title'])){
        $result = array(
            'result'    => 'error1',
        );
        echo json_encode($result);
        die();
    }
    $title = $_POST[ 'title' ];
//    $post = get_page_by_title( $title, OBJECT, 'product' );
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
                'terms'         =>  $_POST[ 'term' ],
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
    foreach ($products->posts as $post){
        if (trim(get_the_title($post)) == $title)
//            $html = [$post];
            $html = get_html($post);
    }




//    var_export($product);

    if (isset($post)){

    }

    if (isset($post)){
        $result = array(
            'result'    => 'ok',
            'html'      => implode('', $html),
        );
    } else{
        $result = array(
            'result'    => 'error2',
        );
    }
    echo json_encode($result);
//    var_export($result);
    die();
}

function get_html($post){


    $product = wc_get_product($post);
    $product_page_blocks_reviews = get_field('product_page_blocks_reviews',  $post);

    $image_id = get_post_thumbnail_id($product->get_id());
    $middle_rating = 0;
    if(is_array($product_page_blocks_reviews)){
        foreach ($product_page_blocks_reviews as $blocks_review){
            $middle_rating += intval($blocks_review['stars']);
        }
        $middle_rating = round($middle_rating / count($product_page_blocks_reviews), 2);
    }
    $html[] = '<div class="card-prod__price">' .
        get_post_field('_price', $product->get_id()) . ' ' . get_woocommerce_currency_symbol() .'
    </div>
    <div class="card-prod__code"> ' .
        get_field('product_model', $product->get_id()) .' / Art.-Nr. ' . $product->get_sku() . '
    </div>
    <div class="card-prod__star">
        <div class="rating rating-black" data-total-value="' . intval($middle_rating) . '">
            <div class="rating__item" data-rating-value="5">
                <svg class="rating__icon rating__icon--reviews">
                    <use xlink:href="'. get_template_directory_uri() .'/img/sprite.svg#star"></use>
                </svg>
            </div>
            <div class="rating__item" data-rating-value="4">
                <svg class="rating__icon rating__icon--reviews">
                    <use xlink:href="'.  get_template_directory_uri() .'/img/sprite.svg#star"></use>
                </svg>
            </div>
            <div class="rating__item" data-rating-value="3">
                <svg class="rating__icon rating__icon--reviews">
                    <use xlink:href="'.  get_template_directory_uri() .'/img/sprite.svg#star"></use>
                </svg>
            </div>
            <div class="rating__item" data-rating-value="2">
                <svg class="rating__icon rating__icon--reviews">
                    <use xlink:href="'.  get_template_directory_uri() .'/img/sprite.svg#star"></use>
                </svg>
            </div>
            <div class="rating__item" data-rating-value="1">
                <svg class="rating__icon rating__icon--reviews">
                    <use xlink:href="'.  get_template_directory_uri() .'/img/sprite.svg#star"></use>
                </svg>
            </div>
        </div>
        '. $middle_rating . (isset($product_page_blocks_reviews) ?  ' (' . count($product_page_blocks_reviews). ')' : '')  .'
    </div>
    <a href="'. get_permalink($product->get_id()) .'" class="card-prod__img long-img">
        ';
    if ( $image_id ){
        $html[] = '<img loading="lazy" src="'. wp_get_attachment_image_url($image_id, 'full') .'"
                 alt="'. wp_get_attachment_image_url($image_id, '_wp_attachment_image_alt', TRUE) .'">';
    }
    $html[] = '</a>
    <a href="'. get_permalink($product->get_id()) .'" class="card-prod__btn btn btn--black">
    Zum Produkt
    </a>
    <div class="card-prod__bottom">';

    foreach ($product->get_attributes() as $taxonomy => $attribute_obj ) {
        $attribute_label_name = wc_attribute_label($taxonomy);

        $terms = [];

//        $args = array(
//            'taxonomy'      => array( $taxonomy, ), // название таксономии с WP 4.5
//            'orderby'       => 'id',
//            'order'         => 'ASC',
//            'hide_empty'    => true,
//        );
//
//        $term_query = new WP_Term_Query( $args );
//
//        foreach( $term_query->terms as $term ){
//            $query = new WP_Query( [
//                'fields'    => 'ids',
//                'tax_query' => [
//                    [
//                        'taxonomy' => $taxonomy,
//                        'field'    => 'id',
//                        'terms'    => $term->term_id,
//                    ]
//                ]
//            ] );
//
//            if (in_array($product->get_id(), $query->posts)){
//                $terms[] = $term->name;
//            }
//
//        }

        foreach ($attribute_obj['options'] as $option){
            $terms[] = get_term_by('id', $option, $taxonomy)->name;
        }
        $html[] = '<div>
                <span>'. $attribute_label_name .'</span>
                <span>'. implode(', ', $terms) .'</span>
            </div>';
    }
    $html[] = '</div>';
    return $html;
}
