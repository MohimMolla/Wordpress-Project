<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ChromeNews
 */

get_header(); ?>
<section class="section-block-upper">
<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php
        if (have_posts()) : ?>

            <header class="header-title-wrapper1 entry-header-details">
                <?php
                the_archive_title('<h1 class="page-title">', '</h1>');
                the_archive_description('<div class="archive-description">', '</div>');
                ?>
            </header><!-- .header-title-wrapper -->
            <?php
            //div wrap start
            do_action('chromenews_archive_layout_before_loop');
            $count = 1;
            $set_full_first = chromenews_get_option('archive_layout_first_post_full');
            $applied_archive = true;
            $archive_layout = chromenews_get_option('archive_layout');
            $current_term = get_queried_object();
            if ($current_term && get_class( $current_term ) === 'WP_Term') {
                $current_term_id =  $current_term->term_id;
                $term_archive_layout = get_option("category_layout_$current_term_id");
                if (isset($term_archive_layout) && !empty($term_archive_layout)) {
                    $archive_layout = $term_archive_layout['archive_layout_term_meta'];
                }
                if ($archive_layout == 'archive-layout-masonry' || $archive_layout == 'archive-layout-full') {
                    $applied_archive = false;
                }
            }


            while (have_posts()) : the_post();

               
                    /*
                     * Include the Post-Format-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                     */

                    get_template_part('template-parts/content', get_post_format());
            


                $count++;
            endwhile;

            //div wrap end
            do_action('chromenews_archive_layout_after_loop');


        else :

            get_template_part('template-parts/content', 'none');

        endif; ?>
    </main><!-- #main -->
    <div class="col col-ten">
        <div class="chromenews-pagination">
            <?php chromenews_numeric_pagination(); ?>
        </div>
    </div>
</div><!-- #primary -->

<?php
get_sidebar();
?>
</section>
<?php
get_footer();
