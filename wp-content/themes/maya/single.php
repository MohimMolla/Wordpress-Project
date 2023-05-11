<?php get_header() ?>

<div class="container">
    <h1>welcome to our theme</h1>
    <p><?= get_template_directory(); ?></p>
    <p><?= get_template_directory_uri(); ?></p>
    <hr>
    <div class="row">
        <div class="col-9">
            <?php
            // 
            // $myPosts = new WP_Query( 'posts_per_page=20' );
            if (have_posts()) :
                while (have_posts()) :
                    the_post();
                    //loop content (template tags, html, etc)
            ?>
                    
                    <div class="row">
                        <div class="col-12">
                        <?php the_post_thumbnail('medium',['class'=>'img-fluid']); ?>
                        <a href="<?php the_permalink() ?>">
                        <h3><?php the_title(); ?></h3>                        
                    </a>
                    written by <?php the_author(); ?> at <?php the_date(); ?> <?php the_time(); ?>
                    in category: <?php the_category(); ?>
                    <h6>Post ID: <?php the_ID(); ?></h6>
                    <p><?php the_tags();?></p>
                    
                            <?php if (is_home()) { ?>
                                <p><?php the_excerpt(); ?></p>
                            <?php } else { ?>
                                <p><?php the_content(); ?></p>
                            <?php } ?>
                            <?php edit_post_link() ?>
                            <hr>
                            <div>
                                <?php
// comment_form()
comments_template();
                                ?>
                            </div>
                            <!--  -->
                            <div class="nav-previous alignleft"><?php previous_posts_link( 'Older posts' ); ?></div>
<div class="nav-next alignright"><?php next_posts_link( 'Newer posts' ); ?></div>
                            <!--  -->
                        </div>
                    </div>
                    <!--  -->

                    <!--  -->
            <?php
                endwhile;
            endif;
            ?>
            <!-- <p>Next Post: <?php next_posts_link( __( 'Older Entries', 'textdomain' )); ?></p> -->
        </div>
        <div class="col-3">
            <h3>sidebar</h3>
            <?php get_sidebar(); ?>
        </div>
    </div>

</div>
<?php get_footer() ?>