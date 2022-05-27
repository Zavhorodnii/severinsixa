<?php
get_header();

$image = get_field('page_404_image', 'options')
?>

<div class="error error--two">
    <picture>
        <source srcset="" type="image/webp">
        <img src="<?php echo $image['url'] ?>" alt="<?php echo $image['alt'] ?>">
    </picture>
</div>


