<?php

apply_filters(
    'woocommerce_taxonomy_args_product_cat',
    array(
        'show_in_rest'          => true,
        'show_ui'               => true,
        'query_var'             => true,
    )
);

function activate_gutenberg_product( $can_edit, $post_type ) {

    if ( $post_type == 'product' ) {
        $can_edit = true;
    }
    return $can_edit;
}
add_filter( 'use_block_editor_for_post_type', 'activate_gutenberg_product', 10, 2 );

function enable_taxonomy_rest( $args ) {
    $args['show_in_rest'] = true;
    return $args;
}
add_filter( 'woocommerce_taxonomy_args_product_cat', 'enable_taxonomy_rest', 20, 2 );
add_filter( 'woocommerce_taxonomy_args_product_tag', 'enable_taxonomy_rest', 20, 2 );


function wplook_activate_gutenberg_products_cat( $args, $taxonomy_name ) {
    if ( 'product_cat' === $taxonomy_name ) {
        $args['show_in_rest'] = true;
    }

    return $args;
}
add_filter( 'register_taxonomy_args', 'wplook_activate_gutenberg_products_cat', 10, 2 );

function register_catalog_meta_boxes() {
    global $current_screen;
    // Make sure gutenberg is loaded before adding the metabox
    if ( method_exists( $current_screen, 'is_block_editor' ) && $current_screen->is_block_editor() ) {
        add_meta_box( 'catalog-visibility', __( 'Catalog visibility', 'textdomain' ), 'product_data_visibility', 'product', 'side' );
    }
}
add_action( 'add_meta_boxes', 'register_catalog_meta_boxes' );


function product_data_visibility( $post ) {

    $thepostid          = $post->ID;
    $product_object     = $thepostid ? wc_get_product( $thepostid ) : new WC_Product();
    $current_visibility = $product_object->get_catalog_visibility();
    $current_featured   = wc_bool_to_string( $product_object->get_featured() );
    $visibility_options = wc_get_product_visibility_options();
    ?>
    <div class="misc-pub-section" id="catalog-visibility">
        <?php esc_html_e( 'Catalog visibility:', 'woocommerce' ); ?>
        <strong id="catalog-visibility-display">
            <?php

            echo isset( $visibility_options[ $current_visibility ] ) ? esc_html( $visibility_options[ $current_visibility ] ) : esc_html( $current_visibility );

            if ( 'yes' === $current_featured ) {
                echo ', ' . esc_html__( 'Featured', 'woocommerce' );
            }
            ?>
        </strong>

        <a href="#catalog-visibility"
           class="edit-catalog-visibility hide-if-no-js"><?php esc_html_e( 'Edit', 'woocommerce' ); ?></a>

        <div id="catalog-visibility-select" class="hide-if-js">

            <input type="hidden" name="current_visibility" id="current_visibility"
                   value="<?php echo esc_attr( $current_visibility ); ?>" />
            <input type="hidden" name="current_featured" id="current_featured"
                   value="<?php echo esc_attr( $current_featured ); ?>" />

            <?php
            echo '<p>' . esc_html__( 'This setting determines which shop pages products will be listed on.', 'woocommerce' ) . '</p>';

            foreach ( $visibility_options as $name => $label ) {
                echo '<input type="radio" name="_visibility" id="_visibility_' . esc_attr( $name ) . '" value="' . esc_attr( $name ) . '" ' . checked( $current_visibility, $name, false ) . ' data-label="' . esc_attr( $label ) . '" /> <label for="_visibility_' . esc_attr( $name ) . '" class="selectit">' . esc_html( $label ) . '</label><br />';
            }

            echo '<br /><input type="checkbox" name="_featured" id="_featured" ' . checked( $current_featured, 'yes', false ) . ' /> <label for="_featured">' . esc_html__( 'This is a featured product', 'woocommerce' ) . '</label><br />';
            ?>
            <p>
                <a href="#catalog-visibility"
                   class="save-post-visibility hide-if-no-js button"><?php esc_html_e( 'OK', 'woocommerce' ); ?></a>
                <a href="#catalog-visibility"
                   class="cancel-post-visibility hide-if-no-js"><?php esc_html_e( 'Cancel', 'woocommerce' ); ?></a>
            </p>
        </div>
    </div>
    <?php
}