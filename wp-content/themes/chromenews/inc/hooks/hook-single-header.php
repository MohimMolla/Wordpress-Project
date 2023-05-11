<?php
if (!function_exists('chromenews_single_header')) :
    /**
     * Banner Slider
     *
     * @since ChromeNews 1.0.0
     *
     */
    function chromenews_single_header()
    {
        global $post;
        $chromenews_post_id = $post->ID;

        $social_share_icon_opt = chromenews_get_option('single_post_social_share_view');
        $wrap_class = '';
        if ($social_share_icon_opt == 'after-title-default') {
            $wrap_class = 'social-after-title';
        } else {
            $wrap_class = 'social-before-title';
        }
        ?>
        <header class="entry-header pos-rel <?php echo esc_attr($wrap_class); ?>">
            <div class="read-details">
                <div class="entry-header-details af-cat-widget-carousel">
                    <?php if ('post' === get_post_type()) : ?>

                        <div class="figure-categories read-categories figure-categories-bg ">
                            <?php chromenews_post_format($post->ID); ?>
                            <?php chromenews_post_categories(true); ?>
                        </div>
                    <?php endif; ?>
                    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>

                   

                    <?php
                    if ('post' === get_post_type()) :
                        if (($social_share_icon_opt == 'after-title-default') || ($social_share_icon_opt == 'before-title')) {
                            chromenews_single_post_social_share_icons($post->ID);
                        }
                    endif;
                    ?>

                    <div class="aft-post-excerpt-and-meta color-pad">

                        <div class="entry-meta">

                            <?php chromenews_post_item_meta(); ?>
                            <?php chromenews_count_content_words($post->ID); ?>
                            <?php chromenews_single_post_commtents_view($post->ID); ?>

                        </div>
                    </div>
                </div>
            </div>
        </header><!-- .entry-header -->

        <!-- end slider-section -->
        <?php
    }
endif;
add_action('chromenews_action_single_header', 'chromenews_single_header', 40);


if (!function_exists('chromenews_single_featured_image')) :
    /**
     * Banner Slider
     *
     * @since ChromeNews 1.0.0
     *
     */
    function chromenews_single_featured_image()
    {
        global $post;
        $chromenews_post_id = $post->ID;
        ?>

        <?php
        $show_featured_image = chromenews_get_option('single_show_featured_image');
        if ($show_featured_image):

            ?>
            <div class="read-img pos-rel">
                <?php chromenews_post_thumbnail(); ?>
                <?php
                if (has_post_thumbnail($chromenews_post_id)):
                    if ($aft_image_caption = get_post(get_post_thumbnail_id())->post_excerpt):
                        if (trim($aft_image_caption) !== ''):
                            ?>
                            <span class="aft-image-caption">
                            <p>
                                <?php echo esc_html($aft_image_caption); ?>
                            </p>
                        </span>
                        <?php
                        endif;
                    endif;
                endif;
                ?>
            </div>

        <?php endif; ?>


        <!-- end slider-section -->
        <?php
    }
endif;
add_action('chromenews_action_single_featured_image', 'chromenews_single_featured_image', 40);