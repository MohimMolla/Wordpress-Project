<div class="af-main-banner-thumb-posts">
    <div class="section-wrapper">
        <div class="small-grid-style clearfix">
            <?php
                
                $chromenews_posts_filter_by = chromenews_get_option('select_editors_picks_filterby');
                
                if ($chromenews_posts_filter_by == 'tag') {
                    $chromenews_editors_pick_category = chromenews_get_option('select_editors_picks_news_tag');
                    $chromenews_filterby = 'tag';
                } else {
                    
                    $chromenews_editors_pick_category = chromenews_get_option('select_editors_picks_news_category');
                    $chromenews_filterby = 'cat';
                }
                
                $chromenews_featured_posts = chromenews_get_posts(2, $chromenews_editors_pick_category, $chromenews_filterby);
                if ($chromenews_featured_posts->have_posts()) :
                    $chromenews_count = 1;
                    while ($chromenews_featured_posts->have_posts()) :
                        $chromenews_featured_posts->the_post();
                        global $post;

                        ?>

                        <div class="af-sec-post">
                            <?php do_action('chromenews_action_loop_grid', $post->ID, 'grid-design-texts-over-image'); ?>
                        </div>


                        <?php
                        $chromenews_count++;
                    endwhile;
                    wp_reset_postdata();
                    ?>
                <?php endif; ?>
        </div>
    </div>
</div>
<!-- Editors Pick line END -->
