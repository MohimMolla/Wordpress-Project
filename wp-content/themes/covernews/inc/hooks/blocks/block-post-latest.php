<?php
/**
 * List block part for displaying latest posts in footer.php
 *
 * @package CoverNews
 */

$covernews_latest_posts_title = covernews_get_option('frontpage_latest_posts_section_title');
$covernews_latest_posts_subtitle = covernews_get_option('frontpage_latest_posts_section_subtitle');
$number_of_posts = covernews_get_option('number_of_frontpage_latest_posts');

$all_posts = covernews_get_posts(5);
?>
<div class="af-main-banner-latest-posts grid-layout">
    <div class="container">
        <div class="row">
        <div class="widget-title-section">
                <?php if (!empty($covernews_latest_posts_title)): ?>
                    <h4 class="widget-title header-after1">
                        <span class="header-after">                            
                            <?php echo apply_filters('the_title', $covernews_latest_posts_title); ?>
                            </span>
                    </h4>
                <?php endif; ?>

        </div>
            <div class="row">
            <?php
            if ($all_posts->have_posts()) :
                while ($all_posts->have_posts()) : $all_posts->the_post();
                    $thumbnail_size = 'medium';
                    global $post;
                    $covernews_post_id = $post->ID;
                    ?>
                    <div class="col-sm-15 latest-posts-grid" data-mh="latest-posts-grid">
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
                <?php
                endwhile; ?>
            <?php
            endif;
            wp_reset_postdata();
            ?>
        </div>
        </div>
    </div>
</div>
