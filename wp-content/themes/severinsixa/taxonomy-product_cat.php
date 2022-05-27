<?php
get_header();

$the_id =  get_queried_object()->term_id;

//$post_id = get_field('product_cat_template', $the_id);
$post_id = get_term_meta($the_id, 'product_cat_template', true);

$post = get_post($post_id);

if ( has_blocks( $post->post_content ) ) {
    $blocks = parse_blocks( $post->post_content );
    foreach ($blocks as $block) {
        echo render_block($block);
    }
}

get_footer();

?>