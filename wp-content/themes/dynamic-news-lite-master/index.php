<?php get_header() ?>
<div class="container">
    <h3>index.php page</h3>
    <div class="row">
        <div class="col-9">
            <!--  -->
            <h1><?php echo get_template_directory_uri(); ?></h1>
            <?php
            if (have_posts()) :
                // Start the Loop.
                while (have_posts()) : the_post();
                    /*
* Include the post format-specific template for the content.
* If you want to use this in a child theme, then include a file called
* called content-___.php (where ___ is the post format) and that will be
* used instead.
*/
                    get_template_part('content');
                endwhile;
            // Previous/next post navigation.

            else :
                // If no content, include the "No posts found" template.
            ?>
                <h1>no post found</h1>
            <?php
            endif;

            ?>
            <hr>
            <?php previous_post_link(); ?>
            <br>
            <div class="navigation">
                <p><?php posts_nav_link(); ?></p>
            </div>
            <!-- col9 end -->
        </div>
        <div class="col-3">
            <?php get_sidebar('right'); ?>
        </div>
    </div>

</div><!-- container end -->
<?php get_footer() ?>