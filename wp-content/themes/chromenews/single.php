<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ChromeNews
 */

get_header();

?>
<div class="section-block-upper">
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <?php
            $social_share_icon_opt = chromenews_get_option('single_post_social_share_view');
            $wrap_class = '';
            if ($social_share_icon_opt == 'after-content') {
                $wrap_class = 'social-after-content';
            }

            while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('af-single-article'); ?>>

                    <div class="entry-content-wrap read-single <?php echo esc_attr($wrap_class); ?>">

                        <?php if (is_single()) : ?>
                            <div class="entry-content-title-featured-wrap">
                                <?php

                                $single_post_title_view = chromenews_get_option('single_post_title_view');
                                if (($single_post_title_view == 'boxed') || ($single_post_title_view == 'title-below-image')) {
                                    do_action('chromenews_action_single_header');                                
                                    do_action('chromenews_action_single_featured_image');
                                }

                                ?>
                            </div>
                        <?php endif; ?>


                        <?php
                        get_template_part('template-parts/content', get_post_type());
                        ?>



                    </div>

                    

                    <?php
                    // If comments are open or we have at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                    ?>


                    <?php
                    $show_related_posts = chromenews_get_option('single_show_related_posts');
                    if ($show_related_posts) :
                        if ('post' === get_post_type()) :
                            chromenews_get_block('related');
                        endif;
                    endif;
                    ?>                  


                </article>
            <?php

            endwhile; // End of the loop...
            ?>

        </main><!-- #main -->
    </div><!-- #primary -->

    <?php
    get_sidebar();
    ?>
</div>
<?php
get_footer();
