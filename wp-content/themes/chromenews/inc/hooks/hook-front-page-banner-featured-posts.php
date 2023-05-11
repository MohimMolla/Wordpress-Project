<?php
if (!function_exists('chromenews_banner_featured_posts')):
    /**
     * Ticker Slider
     *
     * @since ChromeNews 1.0.0
     *
     */
    function chromenews_banner_featured_posts()
    {

        $chromenews_enable_featured_news = chromenews_get_option('show_featured_posts_section');
        $chromenews_category = chromenews_get_option('select_featured_news_category');
        $chromenews_number_of_featured_news = chromenews_get_option('number_of_featured_news');
        $chromenews_featured_posts = chromenews_get_posts($chromenews_number_of_featured_news, $chromenews_category);
        $color_class = '';
        if (absint($chromenews_category) > 0) {
            $color_id = "category_color_" . $chromenews_category;
            // retrieve the existing value(s) for this meta field. This returns an array
            $term_meta = get_option($color_id);
            $color_class = ($term_meta) ? $term_meta['color_class_term_meta'] : 'category-color-1';
        }

        if ($chromenews_enable_featured_news):
            $chromenews_featured_news_title = chromenews_get_option('featured_news_section_title');
            ?>
            <div class="af-main-banner-featured-posts featured-posts chromenews-customizer">

                <?php if (!empty($chromenews_featured_news_title)): ?>
                    <?php chromenews_render_section_title($chromenews_featured_news_title, $color_class); ?>
                <?php endif; ?>



                <div class="section-wrapper af-widget-body">
                    <div class="af-container-row clearfix">
                        <?php

                        
                        if ($chromenews_featured_posts->have_posts()) :
                            while ($chromenews_featured_posts->have_posts()) :
                                $chromenews_featured_posts->the_post();
                                global $post;
                                ?>


<div class="col-3 pad float-l trending-posts-item">
                            <div class="aft-trending-posts list-part af-sec-post">
                                <?php do_action('chromenews_action_loop_list', $post->ID, 'thumbnail', 0, false, true, false); ?>
                        </div>
                        </div>


                            <?php endwhile;
                        endif;
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </div>

        <?php endif; ?>

        <!-- Trending line END -->
        <?php

    }
endif;

add_action('chromenews_action_banner_featured_posts', 'chromenews_banner_featured_posts', 10);