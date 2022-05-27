    </main>

    <div class="popup">
        <div class="popup__overley"></div>
        <div class="popup__inner">
            <p class="popup__text h4"><?php echo get_field('popup_message', 'options') ?></p>
            <button class="popup__btn"></button>
        </div>
    </div>

    <section class="payment-methods">
        <?php
        $payment_methods = get_field('payment_methods', 'options');
        if ( is_array($payment_methods) ){
            foreach ($payment_methods as $method){
                ?>
                <div class="payment-methods__item">
                    <img src="<?php echo $method['url'] ?>" alt="<?php echo $method['alt'] ?>">
                </div>
                <?php
            }
        }
        ?>
    </section>

<footer class="footer">
    <div class="container">
        <form class="footer__form" action="/">
            <h2 class="footer__title h3">Sichere dir 10% auf deine erste Bestellung!</h2>
            <p class="footer__text">Für den Newsletter anmelden und exklusive Angebote erhalten</p>
            <input class="footer__input input" type="text" placeholder="E-Mail-Adresse">
            <button class="btn btn--black">Jetzt anmelden</button>
        </form>
        <nav class="footer__nav">

            <?php
            $menu_items = wp_get_nav_menu_items('Footer menu');
            if (is_array($menu_items)) {
                foreach ($menu_items as $menu_item) {
                    if ($menu_item->menu_item_parent == '0') {
                    ?>
                        <div class="footer__nav-block">
                            <p class="footer__nav-title"><?php echo $menu_item->title ?></p>
                            <?php
                            foreach ( $menu_items as $menu_level_2 ) {
                                if ($menu_item->ID == $menu_level_2->menu_item_parent) {
                                    ?>
                                    <a class="footer__nav-link body-s" href="<?php echo $menu_level_2->url ?>"><?php echo $menu_level_2->title ?></a>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    <?php
                    }
                }
            }
            ?>
        </nav>
        <div class="footer__info">
            <div class="footer__info-left">
                <a class="footer__logo" href="/">
                    <img src="<?php echo get_field('image', 'options')['url'] ?>" alt="<?php echo get_field('image', 'options')['alt'] ?>">
                </a>
                <p class="footer__copyright body-s"><?php echo get_field('copyright', 'options') ?></p>
            </div>
            <div class="footer__info-right">
                <?php
                $gallery = get_field('footer_images', 'options');
                if(is_array($gallery)){
                    foreach ($gallery as $item){
                        ?>
                        <img src="<?php echo $item['url'] ?>" alt="<?php echo $item['alt'] ?>">
                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <div class="footer__bottom">
            <nav class="footer__bottom-nav">
                <?php
                $gallery = get_field('add_footer_menu', 'options');
                if(is_array($gallery)){
                    foreach ($gallery as $item){
                        ?>
                        <a class="footer__bottom-link body-s " href="<?php echo $item['link'] ?>"><?php echo $item['title'] ?></a>
                        <?php
                    }
                }
                ?>
            </nav>
            <div class="footer__social">
                <?php
                $gallery = get_field('add_social_footer_menu', 'options');
                if(is_array($gallery)){
                    foreach ($gallery as $item){
                        ?>
                        <a class="footer__social-link" href="<?php echo $item['link'] ?>" target="_blank">
                            <img src="<?php echo $item['icon']['url'] ?>" alt="<?php echo $item['icon']['alt'] ?>">
                        </a>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</footer>
</div>
    <?php wp_footer(); ?>
    <script>
        window.ajaxUrl = '<?php echo admin_url('admin-ajax.php'); ?>';
    </script>
<!--<script src="js/vendor.js"></script>-->
<!--<script src="js/main.js"></script>-->
</body>

</html>

