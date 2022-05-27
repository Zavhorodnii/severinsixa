    </main>

    <div class="popup">
        <div class="popup__overley"></div>
        <div class="popup__inner">
            <p class="popup__text h4">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            <button class="popup__btn"></button>
        </div>
    </div>

    <section class="payment-methods">
    <div class="payment-methods__item">
        <img src="img/payment-icon1.svg" alt="payment-icon">
    </div>
    <div class="payment-methods__item">
        <img src="img/payment-icon2.svg" alt="payment-icon">
    </div>
    <div class="payment-methods__item">
        <img src="img/payment-icon3.svg" alt="payment-icon">
    </div>
    <div class="payment-methods__item">
        <img src="img/payment-icon4.svg" alt="payment-icon">
    </div>
    <div class="payment-methods__item">
        <img src="img/payment-icon5.svg" alt="payment-icon">
    </div>
    <div class="payment-methods__item">
        <img src="img/payment-icon6.svg" alt="payment-icon">
    </div>
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
            <div class="footer__nav-block">
                <p class="footer__nav-title">Einkaufen</p>
                <a class="footer__nav-link body-s" href="#">Kaffee</a>
                <a class="footer__nav-link body-s" href="#">Grill</a>
                <a class="footer__nav-link body-s" href="#">Küche</a>
                <a class="footer__nav-link body-s" href="#">Backen</a>
                <a class="footer__nav-link body-s" href="#">Kühl- & Gefrierschränke</a>
                <a class="footer__nav-link body-s" href="#">Haushalt</a>
                <a class="footer__nav-link body-s" href="#">Haarpflege</a>
                <a class="footer__nav-link body-s" href="#">Sales</a>
                <a class="footer__nav-link body-s" href="#">Aktionen</a>
            </div>
            <div class="footer__nav-block">
                <p class="footer__nav-title">INNOVATIONEN</p>
                <a class="footer__nav-link body-s" href="#">SEVO</a>
                <a class="footer__nav-link body-s" href="#">SEPURO</a>
                <a class="footer__nav-link body-s" href="#">FILKA</a>
            </div>
            <div class="footer__nav-block">
                <p class="footer__nav-title">UNTERNEHMEN</p>
                <a class="footer__nav-link body-s" href="#">Über uns</a>
                <a class="footer__nav-link body-s" href="#">Karriere</a>
                <a class="footer__nav-link body-s" href="#">Pressemitteilungen</a>
                <a class="footer__nav-link body-s" href="#">Blogazin</a>
            </div>
            <div class="footer__nav-block">
                <p class="footer__nav-title">Hilfe & Kontakt</p>
                <a class="footer__nav-link body-s" href="#">Versandinformationen</a>
                <a class="footer__nav-link body-s" href="#">FAQ</a>
                <a class="footer__nav-link body-s" href="#">Service Center</a>
                <a class="footer__nav-link body-s" href="#">Widerrufsbelehrung</a>
                <a class="footer__nav-link body-s" href="#">Ersatzteile</a>
                <a class="footer__nav-link body-s" href="#">Händlerbereich</a>
                <a class="footer__nav-link body-s" href="#">Produktberatung</a>
                <a class="footer__nav-link body-s" href="#">Kontakt</a>
            </div>
        </nav>
        <div class="footer__info">
            <div class="footer__info-left">
                <a class="footer__logo" href="/">
                    <img src="img/logo.svg" alt="">
                </a>
                <p class="footer__copyright body-s">© 2022 SEVERIN Elektrogeräte GmbH</p>
            </div>
            <div class="footer__info-right">
                <img src="img/award-1.png" alt="">
                <img src="img/award-2.png" alt="">
                <img src="img/award-3.png" alt="">
            </div>
        </div>
        <div class="footer__bottom">
            <nav class="footer__bottom-nav">
                <a class="footer__bottom-link body-s " href="#">Deutschland/Deutsch</a>
                <a class="footer__bottom-link body-s" href="#">AGB</a>
                <a class="footer__bottom-link body-s" href="#">Datenschutz</a>
                <a class="footer__bottom-link body-s" href="#">Impressum</a>
            </nav>
            <div class="footer__social">
                <a class="footer__social-link" href="#" target="_blank">
                    <img src="img/instagram.svg" alt="">
                </a>
                <a class="footer__social-link" href="#" target="_blank">
                    <img src="img/pinterest.svg" alt="">
                </a>
                <a class="footer__social-link" href="#" target="_blank">
                    <img src="img/xing.svg" alt="">
                </a>
                <a class="footer__social-link" href="#" target="_blank">
                    <img src="img/facebook.svg" alt="">
                </a>
                <a class="footer__social-link" href="#" target="_blank">
                    <img src="img/linkedin.svg" alt="">
                </a>
                <a class="footer__social-link" href="#" target="_blank">
                    <img src="img/youtube.svg" alt="">
                </a>
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

