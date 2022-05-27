<?php

add_action('wp_ajax_ajax_get_product_filter', 'ajax_get_product_filter');
add_action('wp_ajax_nopriv_ajax_get_product_filter', 'ajax_get_product_filter');


function ajax_get_product_filter(){
    if(!isset($_POST['get_params'])){
        $result = array(
            'result'    => 'error1',
        );
        echo json_encode($result);
        die();
    }
    parse_str($_POST['get_params'], $params);
    foreach ($params as &$param ){
        $param = explode(';', $param);
    }
    $offset = intval($_POST['offset']);
    $show_count_products = intval(get_field('show_count_product_in_filter', 'options'));

    $query = get_product_by_get_params($params);
    $result_data = get_html_filter($query->posts, $show_count_products, $offset);


    $result = array(
        'result'                => 'ok',
        'html'                  => implode('', $result_data['html']),
        'post_count'            => count($query->posts),
        'show_product_count'    => $result_data['show_product_count'],
        'hide'                  => $result_data['show_product_count'] == $query->post_count ? 'hidden' : 'visible',
    );

    echo json_encode($result);
    die();
}

function get_html_filter($posts, $show_count_products, $offset){
    $html = array();
    $show = $show_count_products * $offset;
    $show_product_count = 0;
    foreach ($posts as $key => $id ){
        if ($show == 0)
            break;

        $image_id = get_post_field('_thumbnail_id', $id);
        $post_thumbnail_img = wp_get_attachment_image_src($image_id, 'full');
        $alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);

        $html[] = '<a class="product" href="' . get_permalink($id) .'">
                        <picture class="product__img">
                            <source srcset="" type="image/webp">
                            <img src="' . ($image_id ? $post_thumbnail_img[0] : '') .'"
                                 alt="' . ($alt ?: '') .'">
                        </picture>
                        <p class="product__name">
                            ' . get_the_title($id) .'
                        </p>
                        <p class="product__model body-s">
                            ' . get_field('product_model', $id) .'
                        </p>
                        <p class="product__price body-s-bold">
                            ' . get_post_field('_price', $id) . ' ' . get_woocommerce_currency_symbol() .'
                        </p>
                    </a>';
        $show--;
        $show_product_count++;
    }
    return [ 'html' => $html, 'show_product_count' => $show_product_count];
}