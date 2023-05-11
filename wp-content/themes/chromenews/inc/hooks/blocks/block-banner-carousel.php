<?php
    /**
     * Full block part for displaying page content in page.php
     *
     * @package ChromeNews
     */
    
    $chromenews_posts_filter_by = chromenews_get_option('select_main_banner_carousel_filterby');
    if ($chromenews_posts_filter_by == 'tag') {
        $chromenews_slider_category = chromenews_get_option('select_slider_news_tag');
        $chromenews_filterby = 'tag';
        
    } else {
        $chromenews_slider_category = chromenews_get_option('select_slider_news_category');
        $chromenews_filterby = 'cat';
        
    }
    
    $chromenews_number_of_slides = chromenews_get_option('number_of_slides');
    $chromenews_slider_mode = chromenews_get_option('select_main_banner_section_mode');
    $chromenews_main_banner_layout_section = 'layout-aligned';
    
    $chromenews_centerPadding = '';
    $chromenews_break_point_1_centerPadding = '';
    $chromenews_break_point_2_centerPadding = '';
    $chromenews_break_point_3_centerPadding = '';
    
    $chromenews_main_banner_carousel_autoplay = chromenews_get_option('main_banner_carousel_autoplay');
    $chromenews_main_banner_carousel_autoplay_speed = chromenews_get_option('main_banner_carousel_autoplay_speed');

        $chromenews_centerMode = false;
        $chromenews_slidesToShow = 1;
        $chromenews_slidesToScroll = 1;
        $chromenews_carousel_class = 'af-carousel-default';
        $chromenews_break_point_1_slidesToShow = 1;
        $chromenews_break_point_1_slidesToScroll = 1;
        $chromenews_break_point_2_slidesToShow = 1;
        $chromenews_break_point_2_slidesToScroll = 1;
        $chromenews_break_point_3_slidesToShow = 1;
        $chromenews_break_point_3_slidesToScroll = 1;

    $thumbnail_size = 'large';
    
    
    $chromenews_carousel_args = array(
        'slidesToShow' => $chromenews_slidesToShow,
        'slidesToScroll' => $chromenews_slidesToScroll,
        'autoplay' => $chromenews_main_banner_carousel_autoplay,
        'autoplaySpeed' => absint($chromenews_main_banner_carousel_autoplay_speed),
        'centerMode' => $chromenews_centerMode,
        'centerPadding' => $chromenews_centerPadding,
        'responsive' => array(
            array(
                'breakpoint' => 1025,
                'settings' => array(
                    'slidesToShow' => $chromenews_break_point_2_slidesToShow,
                    'slidesToScroll' => $chromenews_break_point_3_slidesToScroll,
                    'infinite' => true,
                    'centerPadding' => $chromenews_break_point_1_centerPadding,
                ),
            ),
            array(
                'breakpoint' => 600,
                'settings' => array(
                    'slidesToShow' => $chromenews_break_point_2_slidesToShow,
                    'slidesToScroll' => $chromenews_break_point_2_slidesToScroll,
                    'infinite' => true,
                    'centerPadding' => $chromenews_break_point_2_centerPadding,
                ),
            ),
            array(
                'breakpoint' => 480,
                'settings' => array(
                    'slidesToShow' => $chromenews_break_point_3_slidesToShow,
                    'slidesToScroll' => $chromenews_break_point_3_slidesToScroll,
                    'infinite' => true,
                    'centerPadding' => $chromenews_break_point_3_centerPadding,
                ),
            ),
        ),
    );
    
    $chromenews_carousel_args_encoded = wp_json_encode($chromenews_carousel_args);
?>

<div class="af-widget-carousel aft-carousel">
    <div class="slick-wrapper af-banner-carousel af-banner-carousel-1 common-carousel af-cat-widget-carousel <?php echo esc_html($chromenews_carousel_class); ?>"
         data-slick='<?php echo wp_kses_post($chromenews_carousel_args_encoded); ?>'>
        <?php
            $chromenews_slider_posts = chromenews_get_posts($chromenews_number_of_slides, $chromenews_slider_category, $chromenews_filterby);
            if ($chromenews_slider_posts->have_posts()) :
                while ($chromenews_slider_posts->have_posts()) : $chromenews_slider_posts->the_post();
                    global $post;

                    ?>
                    <div class="slick-item">
                        <?php do_action('chromenews_action_loop_grid', $post->ID, 'grid-design-texts-over-image', $thumbnail_size); ?>
                    </div>
                <?php
                endwhile;
            endif;
            wp_reset_postdata();
        ?>
    </div>
    <div class="af-main-navcontrols af-slick-navcontrols"></div>
</div>