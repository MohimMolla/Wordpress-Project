<?php
if (!function_exists('chromenews_banner_exclusive_posts')) :
    /**
     * Ticker Slider
     *
     * @since ChromeNews 1.0.0
     *
     */
    function chromenews_banner_exclusive_posts()
    {



        if (false != chromenews_get_option('show_popular_tags_section')) : ?>
            <div class="aft-popular-tags">
                <div class="container-wrapper">
                    <?php

                    $chromenews_show_popular_tags_title = chromenews_get_option('frontpage_popular_tags_section_title');
                    $chromenews_select_popular_tags_mode = chromenews_get_option('select_popular_tags_mode');
                    $chromenews_number_of_popular_tags = chromenews_get_option('number_of_popular_tags');
                    $chromenews_tags_section_filterby = chromenews_get_option('frontpage_popular_tags_section_filterby');


                    chromenews_list_popular_taxonomies($chromenews_select_popular_tags_mode, $chromenews_show_popular_tags_title, $chromenews_number_of_popular_tags, $chromenews_tags_section_filterby);


                    ?>
                </div>
            </div>
        <?php endif;



        ?>
        <?php if (false != chromenews_get_option('show_flash_news_section')) :

            $chromenews_em_ticker_news_mode = 'aft-flash-slide left';
            $chromenews_dir = 'left';
            if (is_rtl()) {
                $chromenews_em_ticker_news_mode = 'aft-flash-slide right';
                $chromenews_dir = 'right';
            }
        ?>
            <div class="banner-exclusive-posts-wrapper">

                <?php
                $chromenews_categories = chromenews_get_option('select_flash_news_category');
                $chromenews_number_of_posts = chromenews_get_option('number_of_flash_news');
                $chromenews_em_ticker_news_title = chromenews_get_option('flash_news_title');

                $chromenews_all_posts = chromenews_get_posts($chromenews_number_of_posts, $chromenews_categories);
                $chromenews_show_trending = true;
                $chromenews_count = 1;
                ?>

                <div class="container-wrapper">
                    <div class="exclusive-posts">
                        <div class="exclusive-now primary-color">
                            <div class="aft-ripple"></div>
                            <?php if (!empty($chromenews_em_ticker_news_title)) : ?>
                                <span><?php echo esc_html($chromenews_em_ticker_news_title); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="exclusive-slides" dir="ltr">
                            <?php
                            if ($chromenews_all_posts->have_posts()) : ?>
                                <div class='marquee <?php echo esc_attr($chromenews_em_ticker_news_mode); ?>' data-speed='120000' data-gap='0' data-duplicated='true' data-direction="<?php echo esc_attr($chromenews_dir); ?>">
                                    <?php
                                    while ($chromenews_all_posts->have_posts()) : $chromenews_all_posts->the_post();
                                        global $post;
                                        
                                    ?>
                                        <a href="<?php the_permalink(); ?>">
                                            
                                            <span class="circle-marq">
                                            <?php chromenews_the_post_thumbnail('thumbnail', $post->ID); ?>
                                            </span>
                                            <h4>
                                            <span class="exclusive-post-title">
                                                <?php the_title(); ?>
                                                </span>
                                                </h4>
                                        </a>
                                <?php
                                        $chromenews_count++;
                                    endwhile;
                                endif;
                                wp_reset_postdata();
                                ?>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Excluive line END -->
<?php

        endif;
    }
endif;

add_action('chromenews_action_banner_exclusive_posts', 'chromenews_banner_exclusive_posts', 10);
