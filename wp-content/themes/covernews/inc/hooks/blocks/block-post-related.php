<?php
/**
 * List block part for displaying page content in page.php
 *
 * @package CoverNews
 */

?>

<div class="promotionspace enable-promotionspace">

    <div class="em-reated-posts  col-ten">
<div class="row">
            <?php
            global $post;
            $categories = get_the_category($post->ID);
            $related_section_title = esc_attr(covernews_get_option('single_related_posts_title'));
            $number_of_related_posts = 3;

            if ($categories) {
            $cat_ids = array();
            foreach ($categories as $category) $cat_ids[] = $category->term_id;
            $args = array(
                'category__in' => $cat_ids,
                'post__not_in' => array($post->ID),
                'posts_per_page' => $number_of_related_posts, // Number of related posts to display.
                'ignore_sticky_posts' => 1
            );
            $related_posts = new wp_query($args);

            if (!empty($related_posts)) { ?>
                <h3 class="related-title">                    
                    <?php echo apply_filters( 'the_title', $related_section_title); ?>
                </h3>
            <?php }
            ?>
        <div class="row">
                <?php
                while ($related_posts->have_posts()) {
                    $related_posts->the_post();
                    global $post;
                    $thumbnail_size = 'medium';
                    $covernews_post_id = $post->ID;
                    ?>
                    <div class="col-sm-4 latest-posts-grid" data-mh="latest-posts-grid">
                        <div class="spotlight-post">
                            <figure class="categorised-article inside-img">
                                <div class="categorised-article-wrapper">
                                    <div class="data-bg-hover data-bg-categorised read-bg-img">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php covernews_the_post_thumbnail($thumbnail_size, $covernews_post_id);
                                            ?>
                                        </a>
                                    </div>
                                </div>
                                <?php echo covernews_post_format($post->ID); ?>
                                <div class="figure-categories figure-categories-bg">

                                    <?php covernews_post_categories(); ?>
                                </div>
                            </figure>

                            <figcaption>

                                <h3 class="article-title article-title-1">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>
                                <div class="grid-item-metadata">
                                    <?php covernews_post_item_meta(); ?>
                                </div>
                            </figcaption>
                        </div>
                    </div>
                <?php }
                }
                wp_reset_postdata();
                ?>
                   </div>
                   </div>
    </div>
</div>