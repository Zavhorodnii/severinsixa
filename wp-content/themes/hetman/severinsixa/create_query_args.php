<?php
function get_product_by_get_params($params, $skip = 0){
    $args = [
        'post_type'         => 'product',
        'offset'            => $skip,
        'posts_per_page'    => -1,
        'fields'            => 'ids',

//        'tax_query'         => array(
////            'relation'  => 'AND',
//            [
//                'taxonomy'      => 'product_cat',
//                'field'         => 'slug',
//                'terms'         => ['backoefen',],
//            ],
//            [
////                'relation'  => 'AND',
//                [
//                    'taxonomy'      => 'pa_abnehmbarer-wassertank',
//                    'field'         => 'slug',
//                    'terms'         => ['ja', 'nein'],
//                    'compare'       => 'OR',
//                ],
//                [
//                    'taxonomy'      => 'pa_abnehmbare-platten',
//                    'field'         => 'slug',
//                    'terms'         => ['ja', 'nein'],
//                    'compare'       => 'OR',
//                ],
//            ]
//        ),
//        'meta_query'         => array(
//            'relation'  => 'OR',
//            array(
//                'key'       => '_price',
//                'value'     => array(30, 50),
//                'type'      => 'numeric',
//                'compare'   => 'BETWEEN',
//            ),
//            array(
//                'key'       => '_price',
//                'value'     => array(150, 200),
//                'type'      => 'numeric',
//                'compare'   => 'BETWEEN',
//            ),
//        ),
    ];


//    $args['tax_query']['relation'] = 'AND';
//    $args['tax_query']['sub_meta']['relation'] = 'AND';
    $sub_meta = [];
    $meta_query = [];
    foreach ($params as $key => $param){
        if ($key == 'price') {
            $price_filter = get_field('price_filter', 'options');
//            if (count($param) > 1)
//                $meta_query['relation'] = 'OR';
            foreach ($param as $item){
                $meta_query[] = [
                    'key'       => '_price',
                    'value'     => array(intval($price_filter[$item]['min_price']), intval($price_filter[$item]['max_price'])),
                    'type'      => 'numeric',
                    'compare'   => 'BETWEEN',
                ];
            }
            continue;
        }
        if ($key == 'category'){
            $args['tax_query'][] = [
                'taxonomy'      => 'product_cat',
                'field'         => 'slug',
                'terms'         => $param,
            ];
            continue;
        }
        $sub_meta[] = [
            'taxonomy'  => 'pa_' . $key,
            'field'     => 'slug',
            'terms'     => $param,
        ];
    }

    if (count($meta_query) > 0){
        $args['meta_query'] = $meta_query;
        if (count($meta_query) > 1) {
            $args['meta_query']['relation'] = 'OR';
        }
    }
    if (count($sub_meta) > 0)
        $args['tax_query'][] = $sub_meta;
//var_export($args);
    return new WP_Query($args);
}
