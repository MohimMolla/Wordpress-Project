<?php
    /**
     * List block part for displaying latest posts in footer.php
     *
     * @package ChromeNews
     */
    
    $chromenews_latest_posts_title = chromenews_get_option('frontpage_latest_posts_section_title');
    $chromenews_latest_posts_subtitle = chromenews_get_option('frontpage_latest_posts_section_subtitle');
    $chromenews_number_of_posts = chromenews_get_option('number_of_frontpage_latest_posts');
    $chromenews_all_posts = chromenews_get_posts($chromenews_number_of_posts);
?>
<div class="af-main-banner-latest-posts grid-layout chromenews-customizer">
    <div class="container-wrapper">
        <div class="widget-title-section">
            <?php if (!empty($chromenews_latest_posts_title)): ?>
                <?php chromenews_render_section_title($chromenews_latest_posts_title); ?>
            <?php endif; ?>
        </div>
        <div class="af-container-row clearfix">
            <?php
                if ($chromenews_all_posts->have_posts()) :
                    while ($chromenews_all_posts->have_posts()) : $chromenews_all_posts->the_post();
                        global $post;

                        ?>
                        <div class="col-3 pad float-l trending-posts-item">
                            <div class="aft-trending-posts list-part af-sec-post">
                                <?php do_action('chromenews_action_loop_list', $post->ID, 'thumbnail', 0, false, true, false); ?>
                        </div>
                        </div>
                    <?php
                    endwhile; ?>
                <?php
                endif;
                wp_reset_postdata();
            ?>
        </div>
    </div>
</div>
