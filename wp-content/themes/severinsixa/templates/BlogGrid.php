<?php

class BlogSectionBlogGrid {

    private $id = 'blog-grid';
    private $name = 'Blog Grid';

    public function __construct() {
        add_action('acf/init', array($this, 'register_block'));
		add_action('acf/init', array($this, 'RegisterMainFields'));
    }

   
    public function register_block() {
    
        // check function exists.
        if( function_exists('acf_register_block_type') ) {
    
            // register a testimonial block.
            acf_register_block_type(array(
                'name'              => $this->id,
                'title'             => __($this->name),
                'render_callback'   => array($this, 'render'),
                'category'          => 'formatting',
                'mode'              => 'preview',
                'enqueue_assets' => array($this, 'enqueue_assets'),
            ));
        }
    }

    public function enqueue_assets() {
        wp_enqueue_style( $this->id, get_theme_file_uri('assets/index/Blog Grid/Blog Grid.css') );
    }
    
    /**
     * Testimonial Block Callback Function.
     *
     * @param   array $block The block settings and attributes.
     * @param   string $content The block inner HTML (empty).
     * @param   bool $is_preview True during AJAX preview.
     * @param   (int|string) $post_id The post ID this block is saved to.
     */
    public function render( $block, $content = '', $is_preview = false, $post_id = 0 ) {
        ?>
        <section class="articles">
            <div class="container">
                <h2 class="articles__sec-title title"><?php echo get_field('title') ?></h2>

                <div class="articles__list">
                    <?php
                    $posts = get_field('post');
//                    var_export($posts);
                    if(is_array($posts)){
                        foreach ($posts as $post){
                            $id = $post->ID;

                            $date = date_create($post->post_date);
                            $format = date_format($date, 'd/m/Y');
                            $image_id = get_post_thumbnail_id($id);

                            $post_thumbnail_img = wp_get_attachment_image_src( $image_id, 'full' );
                            $alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
                            ?>
                            <article class="articles__item">
                                <picture class="articles__img">
                                    <source srcset="" type="image/webp">
                                    <img src="<?php echo $image_id ? $post_thumbnail_img[0] : '' ?>" alt="<?php echo $alt ?: '' ?>">
                                </picture>
                                <div class="articles__info">
                                    <time class="articles__time" pubdate datetime="2022-06-11"> <?php echo $format ?> </time>
                                    <?php
                                    $cat = get_the_category($id);
                                    if(is_array($cat)){
                                        foreach ($cat as $item){
                                            ?>
                                            <p class="articles__category"><?php echo $item->name ?></p>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <h3 class="articles__title h3"><?php echo get_the_title($id) ?></h3>
                                <p class="articles__descr body-m">
                                    <?php echo get_field('description', $id) ?>
                                </p>
                                <a class="articles__link body-s" href="<?php echo get_permalink($id) ?>">Mehr dazu erfahren</a>
                            </article>
                            <?php
                        }
                    }
                    ?>
                </div>
                <a class="articles__blog-link btn btn--black" href="<?php echo get_field('button')['link'] ?>"><?php echo get_field('button')['title'] ?></a>
            </div>
        </section>
        <?php

    }

	public function RegisterMainFields() {
		acf_add_local_field_group
		(
			array
			(
				'key' => 'blog_grid_group',
				'title' => 'Blog Grid',
				'fields' => array 
				(
                    array
                    (
                        'key'               => 'blog_grid_group_field',
                        'label'             => 'Title',
                        'name'              => 'title',
                        'type' 				=> 'text',
                        'require'			=> 0,
                    ),
                    array
                    (
                        'key'               => 'blog_grid_post_field',
                        'label'             => 'Posts',
                        'name'              => 'post',
                        'type' 				=> 'relationship',
//                        'return_format'     => 'id',
                        'post_type'         => 'post',
                        'multiple'          => 1,
                        'require'			=> 0,
                    ),
                    array
                    (
                        'key'               => 'blog_grid_button_field',
                        'label'             => 'Button',
                        'name'              => 'button',
                        'type' 				=> 'group',
                        'require'			=> 0,
                    )
				),
				'location' => array 
				(
					array 
					(
						array 
						(
							'param' 		=> 'block',
							'operator' 		=> '==',
							'value' 		=> 'acf/' . $this->id,
						),
					),
				)
			)
		);

        acf_add_local_field
        (
            array
            (
                'key'               => 'blog_grid_button_title_field',
                'label'             => 'Title',
                'name'              => 'title',
                'type' 				=> 'text',
                'parent'            => 'blog_grid_button_field',
                'require'			=> 0,
            )
        );
        acf_add_local_field
        (
            array
            (
                'key'               => 'blog_grid_button_link_field',
                'label'             => 'link',
                'name'              => 'link',
                'default_value'     => '#',
                'type' 				=> 'text',
                'parent'            => 'blog_grid_button_field',
                'require'			=> 0,
            )
        );

	}
}

new BlogSectionBlogGrid();


?>