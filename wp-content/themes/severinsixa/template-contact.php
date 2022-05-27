<?php
/**
 * Template Name:Contact
 * Template Post Type: Page
 */
get_header();
?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/contact/style.css">


<section class="contact">
    <div class="container">
        <h1 class="contact__title title title-center">
            <?php the_title() ?>
        </h1>
        <div class="contact__wrapper">
			<div class="contact-form">
				<div class="contact-form__title">
                    <?php echo get_field('sub_title') ?>
                </div>
                <p class="contact-form__descr">
                    <?php echo get_field('content') ?>
                </p>
				
				<?php echo apply_shortcodes( '[contact-form-7 id="7981" title="Contact form 1"]' ); ?>
			</div>
		
<!--             <form action="#" class="contact-form js_get_form_info">
                <div class="contact-form__title">
                    <?php echo get_field('sub_title') ?>
                </div>
                <p class="contact-form__descr">
                    <?php echo get_field('content') ?>
                </p>
                <div class="input-wrap">
                    <p class="input-title">VORNAME<span>*</span></p>
                    <input class="input js_get_first_name" type="text" placeholder="Type something">
                </div>
                <div class="input-wrap">
                    <p class="input-title">NaCHNAME<span>*</span></p>
                    <input class="input js_get_last_name" type="text" placeholder="Type something">
                </div>
                <div class="input-wrap">
                    <p class="input-title">E-MAIL ADRESSE<span>*</span></p>
                    <input class="input js_get_email" type="email" placeholder="Type something">
                </div>
                <div class="input-wrap">
                    <p class="input-title">TELEFON<span>*</span></p>
                    <input class="input js_get_phone" type="text" placeholder="Type something">
                </div>
                <div class="select-wrap">
                    <p class="select-title">
                        Grund der kontaktaufnahme<span>*</span>
                    </p>
                    <div class="select-block-wrap">
                        <select class="select js_get_select">
                            <?php
                            $reason_petition = get_field('reason_petition');
                            if (is_array($reason_petition)){
                                foreach ($reason_petition as $key=>$item){
                                    ?>
                                    <option value="" <?php echo $key == 0 ? 'selected' : '' ?>><?php echo $item['title'] ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="input-wrap">
                    <p class="input-title">Betreff, Produktname oder Artikelnummer (bspw. WA2324)<span>*</span></p>
                    <input class="input js_get_theme" type="text" placeholder="Type something">
                </div>
                <div class="texarea-wrap">
                    <p class="texarea-title">NACHRICHT<span>*</span></p>
                    <textarea class="js_get_message" placeholder="Type something"></textarea>
                </div>
                <button class="contact-form__btn btn btn--black js_send_contact_form">
                    Anfrage abschicken
                </button>
            </form> -->
            <div class="contact-info">
                <?php
                $right_block = get_field('right_block');
                if (is_array($right_block)){
                    foreach ($right_block as $item){
                        ?>
                        <div class="contact-info-item">
                            <div class="contact-info-item__title">
                                <?php echo $item['title'] ?>
                            </div>
                            <?php echo $item['content'] ?>
                            <a href="<?php echo $item['link']['link'] ?>" class="contact-info-item__btn btn btn--blue">
                                <?php echo $item['link']['title'] ?>
                            </a>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <div class="map">
<!--            <img loading="lazy" src="img/map.png" alt="img">-->
            <?php echo get_field('iframe_map') ?>
        </div>
    </div>
    <?php
    $image = get_field('image');
    ?>
    <img class="contact-img-bottom" loading="lazy" src="<?php echo is_array($image) ? $image['url'] : '' ?>" alt="<?php echo is_array($image) ? $image['alt'] : '' ?>">
</section>


<?php
get_footer();
?>
