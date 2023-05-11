<?php
/**
 * Full block part for displaying page content in page.php
 *
 * @package CoverNews
 */
?>

<div class="entry-header-image-wrap">
    <header class="entry-header">
    <div class="post-thumbnail">
        <?php 
        $thumbnail_size = 'large';
        $covernews_post_id = get_the_ID();
        covernews_the_post_thumbnail($thumbnail_size, $covernews_post_id); ?>
    </div>
        <div class="header-details-wrapper">
            <div class="entry-header-details">
                <?php if ('post' === get_post_type()) : ?>
                    <div class="figure-categories figure-categories-bg">
                        <?php echo covernews_post_format(get_the_ID()); ?>
                        <?php covernews_post_categories(); ?>
                    </div>
                <?php endif; ?>

                <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a>
                    </h2>'); ?>
                <?php if ('post' === get_post_type()) : ?>
                    <div class="post-item-metadata entry-meta">
                        <?php covernews_post_item_meta(); ?>
                    </div>
                <?php endif; ?>

                <?php
                $archive_content_view = covernews_get_option('archive_content_view');
                if ($archive_content_view != 'archive-content-none'):
                    ?>

                    <div class="post-excerpt">
                        <?php

                        if ($archive_content_view == 'archive-content-excerpt') {
                            $excerpt = covernews_get_excerpt(20, get_the_content());
                            echo wp_kses_post(wpautop($excerpt));
                        } else {
                            the_content();
                        }
                        ?>
                    </div>
                <?php endif; ?>


            </div>
        </div>
    </header>
</div>