<?php
/**
 * Template Name:Widerrufsbelehrung
 * Template Post Type: Page
 */
get_header();
?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/content-template/content-template.css">

<section class="content-template">
    <div class="container">
        <div class="content-template__inner">
            <h1><?php the_title() ?></h1>
            <?php the_content(); ?>
        </div>
    </div>
</section>

<?php
get_footer();
?>
