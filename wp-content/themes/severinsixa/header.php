<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--    <title>Page</title>-->
    <?php wp_head(); ?>
<!--    <link rel="stylesheet" href="css/vendor.css">-->
<!--    <link rel="stylesheet" href="css/main.css">-->
</head>

<!-- <svg class="svg">
    <use xlink:href="img/sprite.svg#telega"></use>
</svg> -->

<body>
<div class="page">
    <header class="header">
        <?php
        $manin_info = get_field('manin_info', 'options');
        if (isset($manin_info)){
            ?>
            <div class="highlight-bar">
                <div class="container">
                    <p class="highlight-bar__text body-s">
                        <?php echo $manin_info ?>
                    </p>
                    <button class="highlight-bar__btn"></button>
                </div>
            </div>
            <?php
        }
        ?>
        <div class="header__top">
            <div class="container">
                <div class="header__top-inner">
                    <div class="lang">
                        <p class="lang__title body-s">Deutsch</p>
                        <div class="lang__list">
                            <a class="lang__item body-s" href="#">English</a>
                            <a class="lang__item body-s" href="#">English</a>
                            <a class="lang__item body-s" href="#">English</a>
                        </div>
                    </div>
                    <nav class="top-nav" data-da=".header__bottom, 1340, 1">
                        <?php
                        $add_header_menu = get_field('add_header_menu', 'options');
                        if (is_array($add_header_menu)){
                            foreach ($add_header_menu as $menu_item){
                                ?>
                                <a class="top-nav__item body-s" href="<?php echo $menu_item['link'] ?>">
                                    <?php echo $menu_item['title'] ?>
                                </a>
                                <?php
                            }
                        }
                        ?>
                    </nav>
                </div>
            </div>
        </div>
        <div class="header__center">
            <div class="container">
                <div class="header__center-inner">
                    <form class="header__search" action="/">
                        <input class="header__search-field" type="text"
                               placeholder="Suche nach Produkten, Kategorien und mehr..." name="search">
                        <button class="header__search-btn"></button>
                    </form>
                    <?php
                    $site_logo = get_field('site_logo', 'options');
                    if (is_array($site_logo)){
                        ?>
                        <a class="header__logo" href="<?php echo get_home_url() ?>">
                            <img src="<?php echo $site_logo['url'] ?>" alt="<?php echo $site_logo['alt'] ?>">
                        </a>
                        <?php
                    }
                    ?>
                    <div class="header__center-nav">
                        <?php if ( is_user_logged_in() ) { ?>
                            <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="header__user body-s" title="<?php _e('My Account','woothemes'); ?>"><?php _e('My Account','woothemes'); ?></a>
                        <?php }
                        else { ?>
                            <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="header__user body-s" title="<?php _e('Login / Register','woothemes'); ?>"><?php _e('Login / Register','woothemes'); ?></a>
                        <?php } ?>
<!--                        <a class="header__user body-s" href="#">Anmelden</a>-->
                        <a class="header__shop" href="<?php echo wc_get_cart_url() ?>">
                            <span class="header__shop-counter body-m js_update_product_cart"><?php echo WC()->cart->get_cart_contents_count() ?></span>
                        </a>
                        <div class="burger">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="header__bottom">
            <div class="container">
                <nav class="bottom-nav">

                    <?php
                    $menu_items = wp_get_nav_menu_items('Top Menu');
                    if (is_array($menu_items)) {
                        foreach ($menu_items as $menu_item) {
                            if ($menu_item->menu_item_parent == '0') {
//                                var_export($menu_item);
                                $menu_level_1_ID = $menu_item->ID;
                                $selected = get_field('menu_view', $menu_level_1_ID);
                                if ($selected == 'banner' || $selected == 'none' || $selected == 'columns'){
                                    if ($selected == 'banner'){
                                        $banner = get_field('bunner', $menu_level_1_ID);
                                    }
                                    elseif ($selected == 'columns'){
                                        $banner = get_field('columns', $menu_level_1_ID);
                                    }
                                    ?>
                                    <div class="bottom-nav__wrap">
                                        <div class="bottom-nav__item <?php echo get_field('highlight', $menu_level_1_ID) ? 'color-sale' : '' ?>">
                                            <span><?php echo $menu_item->title ?></span>
                                            <a href="#">Alles</a>
                                        </div>
                                        <div class="submenu submenu-white submenu-left">
                                            <div class="submenu-list">
                                                <?php
                                                $start = true;
                                                $close_block = false;
                                                foreach ( $menu_items as $menu_level_2 ){
//                                                    var_export($menu_level_2);
                                                    $new_block = get_field('new_menu_column', $menu_level_2->ID);
                                                    if ( $menu_item->ID == $menu_level_2->menu_item_parent ){
                                                        if ($start || $new_block){
                                                            if ( $new_block ){
                                                                ?>
                                                                </div>
                                                                <?php
                                                            }
                                                            ?>
                                                            <div class="col">
                                                            <?php
                                                        }
                                                            if ( $start ){
                                                            ?>
                                                            <div class="back">Zurück</div>
                                                            <div class="submenu-list__mob-top">
                                                                <span><?php echo $menu_item->title ?></span>

                                                                <?php
                                                                if ( is_array( $banner['main_link']) ){
                                                                    ?>
                                                                    <a href="<?php echo $banner['main_link']['link'] ?>" class="submenu-list__title h5">
                                                                        <?php echo $banner['main_link']['title'] ?>
                                                                        <span>Alles</span>
                                                                    </a>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </div>
                                                            <?php
                                                                $start = false;
                                                            }
                                                            ?>
                                                            <ul class="submenu-list__item">
                                                                <li><?php echo $menu_level_2->title ?></li>
                                                                <?php
                                                                foreach ( $menu_items as $menu_level_3 ){
                                                                    if ( $menu_level_2->ID == $menu_level_3->menu_item_parent ) {
                                                                        ?>
                                                                        <li><a href="<?php echo $menu_level_3->url ?>"><?php echo $menu_level_3->title ?></a></li>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </ul>
<!--                                                            <ul class="submenu-list__item">-->
<!--                                                                <li>BÜGELEISEN</li>-->
<!--                                                                <li><a href="#">Alle</a></li>-->
<!--                                                            </ul>-->
                                                        <?php
//                                                        if ( $new_block ){
//                                                            ?>
<!--                                                            </div>-->
<!--                                                            --><?php
//                                                        }
                                                    }
                                                }
                                                if ( !$new_block ){
                                                    ?>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <?php
                                            if ($selected == 'banner'){
                                                ?>
                                                <div class="submenu-wrap">
                                                    <div class="submenu-card">
                                                        <div class="submenu-card__logo">
                                                            <img loading="lazy" src="<?php echo $banner['logo']['url'] ?>" alt="<?php echo $banner['logo']['alt'] ?>">
                                                        </div>
                                                        <div class="submenu-card__img">
                                                            <img loading="lazy" src="<?php echo $banner['image']['url'] ?>" alt="<?php echo $banner['image']['alt'] ?>">
                                                        </div>
                                                        <div class="submenu-card__title h4">
                                                            <?php echo $banner['description'] ?>
                                                        </div>
                                                        <a href="<?php echo $banner['button']['link'] ?>" class="submenu-card__btn btn  btn--trans">
                                                            <?php echo $banner['button']['title'] ?>
                                                        </a>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                                elseif ($selected == 'blocks'){
                                    $menu = get_field('blocks', $menu_level_1_ID);
                                    ?>
                                    <div class="bottom-nav__wrap">
                                        <div class="bottom-nav__item <?php echo get_field('highlight', $menu_level_1_ID) ? 'color-sale' : '' ?>">
                                            <?php echo $menu_item->title ?>
                                            <a href="#">Alles</a>
                                        </div>
                                        <div class="submenu submenu-black submenu-right">
                                            <div class="submenu-wrap">
                                                <?php
                                                foreach ($menu['blocks_section'] as $menu_item){
                                                    ?>
                                                    <div class="submenu-card">
                                                        <div class="submenu-card__logo">
                                                            <img loading="lazy" src="<?php echo $menu_item['logo']['url'] ?>" alt="<?php echo $menu_item['logo']['alt'] ?>">
                                                        </div>
                                                        <div class="submenu-card__img">
                                                            <img loading="lazy" src="<?php echo $menu_item['image']['url'] ?>" alt="<?php echo $menu_item['image']['alt'] ?>">
                                                        </div>
                                                        <div class="submenu-card__title h4">
                                                            <?php echo $menu_item['description'] ?>
                                                        </div>
                                                        <a href="<?php echo $menu_item['button']['link'] ?>" class="submenu-card__btn btn  btn--trans">
                                                            <?php echo $menu_item['button']['title'] ?>
                                                        </a>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        }
                    }
                    ?>


                </nav>
            </div>
        </div>
    </header>

    <div class="overley"></div>

    <?php
    if (!is_404())
        echo '<main>';
    ?>


