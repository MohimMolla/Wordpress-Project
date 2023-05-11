<?php
/**
 * List block part for displaying page content in page.php
 *
 * @package CoverNews
 */

$excerpt_length = 20;

global $post;
$thumbnail_size = 'medium';
$covernews_post_id = $post->ID;
?>

<div class="align-items-center">
        <div class="spotlight-post">
            <figure class="categorised-article inside-img">
                <div class="categorised-article-wrapper">
                    <div class="data-bg-hover data-bg-categorised read-bg-img">
                        <a href="<?php the_permalink(); ?>">
                            <?php covernews_the_post_thumbnail($thumbnail_size, $covernews_post_id);
                            ?>
                        </a>
                    </div>
                    <?php echo covernews_post_format($post->ID); ?>
                    <div class="figure-categories figure-categories-bg">
                        <?php covernews_post_categories(); ?>
                    </div>
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
                <?php
                $archive_content_view = covernews_get_option('archive_content_view');
                if ($archive_content_view != 'archive-content-none'):
                    ?>
                    <div class="full-item-discription">
                        <div class="post-description">
                            <?php

                            if ($archive_content_view == 'archive-content-excerpt') {
                                $excerpt = covernews_get_excerpt($excerpt_length, get_the_content());
                                echo wp_kses_post(wpautop($excerpt));
                            } else {
                                the_content();
                            }
                            ?>

                        </div>
                    </div>
                <?php endif; ?>
            </figcaption>
    </div>
    <?php
    wp_link_pages(array(
        'before' => '<div class="page-links">' . esc_html__('Pages:', 'covernews'),
        'after' => '</div>',
    ));
    ?>
</div>







