<?php
get_header();

$get_params = [];
foreach($_GET as $key => $value) {
    $get_params[$key] = $value;
}
$search = '';
if (array_key_exists('s', $get_params)) {
    $search = $get_params['s'];
}

$count_posts = 0;
$category = [];
$products = [];
while (have_posts()) {
    the_post();
//    $product = get_the_ID();
    if (get_post_type(get_the_ID()) == 'product') {
        $image_id = get_post_thumbnail_id(get_the_ID());
        $product = wc_get_product(get_the_ID());
        $model = get_field('product_model', $product->get_id()) ;

        $products[] = '<a class="product" href="' . get_permalink(get_the_ID()) . '">
                    <picture class="product__img">
                        <source srcset="" type="image/webp">
                        <img loading="lazy" src="'. wp_get_attachment_image_url($image_id, 'full') .'"
                             alt="'. wp_get_attachment_image_url($image_id, '_wp_attachment_image_alt', TRUE) .'">
                    </picture>
                    <p class="product__name">
                        ' . get_the_title(get_the_ID()) . '
                    </p>';
        if (strlen($model) > 0){
            $products[] = '<p class="product__model body-s">
                        '. $model .'
                    </p>';
            };
        $products[] = '<p class="product__price body-s-bold">
                        '. $product->get_price() .' ' . get_woocommerce_currency_symbol() . '
                    </p>
                </a>';
        $count_posts++;
    }
    if (get_post_type(get_the_ID()) == 'product_cat') {
        $image_id = get_post_thumbnail_id(get_the_ID());
        $category[] = '
                    <a class="category-nav__item" href="' . get_permalink(get_the_ID()) . '">
                        <picture>
                            <source srcset="" type="image/webp">
                        <img loading="lazy" src="'. wp_get_attachment_image_url($image_id, 'full') .'"
                             alt="'. wp_get_attachment_image_url($image_id, '_wp_attachment_image_alt', TRUE) .'">
                        </picture>
                        <p class="category-nav__name h4">'. get_term(get_the_ID())->name .'</p>
                    </a>';
        $count_posts++;
    }
}

?>

<link href="<?php echo get_template_directory_uri() ?>/assets/search/search.css" rel="stylesheet">

<section class="search">
    <div class="container">
        <div class="search__top">
            <h2 class="search__line h3">Deine Suche nach: <span
                        class="search__key h3">“<?php echo $search ?>”</span></h2>
            <div class="search__count h5">
                <?php echo $count_posts ?>
            </div>
        </div>
        <div class="search__result">

        <?php
        if (count($category) > 0){
            ?>
            <h3 class="search__title h4">
                Kategorien
            </h3>
            <div class="category-nav category-nav--overview">
                <div class="category-nav__wrapper">
                    <?php echo implode($category); ?>
                </div>
            </div>
        <?php
        }
        if (count($products) > 0){
            ?>
            <h3 class="search__title h4">
                Produkte
            </h3>

            <div class="catalog__list">
                <?php echo implode($products); ?>
            </div>
            <?php
        }
        ?>
        </div>
        <?php
        if ($count_posts == 0){
            ?>
            <div class="search__no-result">
                <p class="search__text body-m">
                    Deine Suche nach <span class="body-m">"<?php echo $search ?>"</span> ergab leider keinen Treffer. <br>
                    Versuch es doch noch einmal mit einem anderen Begriff
                </p>
                <?php get_search_form(); ?>
            </div>
            <?php
        }
        ?>
    </div>
</section>

<?php
get_footer();
?>
