<?php

/**
 * List block part for displaying page content in page.php
 *
 * @package ChromeNews
 */

global $post;
$chromenews_categories = get_the_category($post->ID);
$chromenews_related_section_title = esc_attr(chromenews_get_option('single_related_posts_title'));
$chromenews_number_of_related_posts = esc_attr(chromenews_get_option('single_number_of_related_posts'));

if ($chromenews_categories) :
    $chromenews_cat_ids = array();
    foreach ($chromenews_categories as $chromenews_category) $chromenews_cat_ids[] = $chromenews_category->term_id;
    $chromenews_args = array(
        'category__in' => $chromenews_cat_ids,
        'post__not_in' => array($post->ID),
        'posts_per_page' => $chromenews_number_of_related_posts, // Number of related posts to display.
        'ignore_sticky_posts' => 1
    );
    $chromenews_related_posts = new wp_query($chromenews_args);
    if ($chromenews_related_posts->have_posts()) :?>

        <div class="promotionspace enable-promotionspace">
            <div class="af-reated-posts chromenews-customizer">

                <?php chromenews_render_section_title($chromenews_related_section_title); ?>

                <div class="af-container-row clearfix">
                    <?php
                    while ($chromenews_related_posts->have_posts()) {
                        $chromenews_related_posts->the_post();
                        global $post;


                    ?>
                        <div class="col-2 pad float-l trending-posts-item">
                            <div class="aft-trending-posts list-part af-sec-post">
                                <?php do_action('chromenews_action_loop_list', $post->ID, 'thumbnail', 0, false, true, false); ?>
                            </div>
                        </div>
                    <?php }

                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
<?php
    endif;
endif;
