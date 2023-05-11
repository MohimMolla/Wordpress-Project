<?php
$chromenews_banner_layout = chromenews_get_option('select_main_banner_layout_section');
$chromenews_posts_filter_by = chromenews_get_option('select_trending_post_filterby');
if ($chromenews_posts_filter_by == 'tag') {
    $chromenews_editors_pick_category = chromenews_get_option('select_trending_post_tag');
    $chromenews_filterby = 'tag';
} elseif ($chromenews_posts_filter_by == 'view') {
    $chromenews_editors_pick_category = 0;
    $chromenews_filterby = 'view';
} else {
    $chromenews_editors_pick_category = chromenews_get_option('select_trending_post_category');
    $chromenews_filterby = 'cat';
}

$chromenews_trending_post_number_of_slides = chromenews_get_option('trending_post_number_of_slides');
$chromenews_all_posts_vertical = chromenews_get_posts($chromenews_trending_post_number_of_slides, $chromenews_editors_pick_category, $chromenews_filterby);


$chromenews_trending_post_autoplay = chromenews_get_option('trending_post_autoplay');
$chromenews_trending_post_autoplay_speed = chromenews_get_option('trending_post_autoplay_speed');
$chromenews_carousel_args = array(    
    'autoplay' => $chromenews_trending_post_autoplay,
    'autoplaySpeed' => absint($chromenews_trending_post_autoplay_speed),    
    
);

$chromenews_carousel_args_encoded = wp_json_encode($chromenews_carousel_args);
?>
<div class="full-wid-resp">
    <div class="slick-wrapper banner-vertical-slider af-widget-carousel" data-slick='<?php echo wp_kses_post($chromenews_carousel_args_encoded); ?>'>
        <?php
        $chromenews_count = 1;
        if ($chromenews_all_posts_vertical->have_posts()) :
            while ($chromenews_all_posts_vertical->have_posts()) : $chromenews_all_posts_vertical->the_post();

                global $post;

                ?>
                <div class="slick-item">
                    <div class="aft-trending-posts list-part af-sec-post">
                        <?php do_action('chromenews_action_loop_list', $post->ID, 'thumbnail', $chromenews_count, false, true, false); ?>
                    </div>
                </div>
                <?php
                $chromenews_count++;
            endwhile;
        endif;
        wp_reset_postdata();
        ?>
    </div>
    <div class="af-trending-navcontrols af-slick-navcontrols"></div>
   
</div>
