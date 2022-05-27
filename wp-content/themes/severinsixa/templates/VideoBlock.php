<?php

class BlogSectionVideoBlock
{

    private $id = 'video-block';
    private $name = 'Video Block';

    public function __construct()
    {
        add_action('acf/init', array($this, 'register_block'));
        add_action('acf/init', array($this, 'RegisterMainFields'));
    }


    public function register_block()
    {

        // check function exists.
        if (function_exists('acf_register_block_type')) {

            // register a testimonial block.
            acf_register_block_type(array(
                'name' => $this->id,
                'title' => __($this->name),
                'render_callback' => array($this, 'render'),
                'category' => 'formatting',
                'mode' => 'preview',
                'enqueue_assets' => array($this, 'enqueue_assets'),
            ));
        }
    }

    public function enqueue_assets()
    {
        wp_enqueue_style($this->id, get_theme_file_uri('assets/index/Full width video/Full width video.css'));
    }

    /**
     * Testimonial Block Callback Function.
     *
     * @param array $block The block settings and attributes.
     * @param string $content The block inner HTML (empty).
     * @param bool $is_preview True during AJAX preview.
     * @param   (int|string) $post_id The post ID this block is saved to.
     */
    public function render($block, $content = '', $is_preview = false, $post_id = 0)
    {
        ?>

        <section class="video-block">
            <h2 class="video-block__tilte title">
                <?php echo get_field('title') ?>
            </h2>
            <div class="video-block__wrapper">
                <video class="video-block__player" src="<?php echo get_field('video') ?>" muted loop playsinline>
                </video>
                <button class="video-block__control"></button>
            </div>
            <a class="video-block__more-btn btn btn--black" href="<?php echo get_field('button')['link'] ?>">
                <?php echo get_field('button')['title'] ?>
            </a>
        </section>
        <?php

    }

    public function RegisterMainFields()
    {
        acf_add_local_field_group
        (
            array
            (
                'key' => 'video_block_group',
                'title' => 'Video Block',
                'fields' => array
                (
                    array
                    (
                        'key' => 'video_block_group_title_field',
                        'label' => 'Title',
                        'name' => 'title',
                        'type' => 'text',
                        'require' => 0,
                    ),
                    array
                    (
                        'key' => 'video_block_group_video_field',
                        'label' => 'Video',
                        'name' => 'video',
                        'type' => 'file',
                        'return_format' => 'url',
                        'require' => 0,
                    ),
                    array
                    (
                        'key' => 'video_block_group_button_field',
                        'label' => 'Button',
                        'name' => 'button',
                        'type' => 'group',
                        'require' => 0,
                    ),
                ),
                'location' => array
                (
                    array
                    (
                        array
                        (
                            'param' => 'block',
                            'operator' => '==',
                            'value' => 'acf/' . $this->id,
                        ),
                    ),
                )
            )
        );


        acf_add_local_field
        (
            array
            (
                'key' => 'video_block_group_title_field',
                'label' => 'Title',
                'name' => 'title',
                'type' => 'text',
                'parent' => 'video_block_group_button_field',
                'require' => 0,
            )
        );
        acf_add_local_field
        (
            array
            (
                'key' => 'video_block_group_link_field',
                'label' => 'link',
                'name' => 'link',
                'default_value' => '#',
                'type' => 'text',
                'parent' => 'video_block_group_button_field',
                'require' => 0,
            )
        );

    }
}

new BlogSectionVideoBlock();


?>