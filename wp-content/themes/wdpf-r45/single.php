<?php get_header();?>
 <h3>single.php</h3>
    <div class="row">
    <?php if(have_posts(  )): while(have_posts(  )): the_post(  ); ?>
<div class="col-12">
<?php the_post_thumbnail( 'large',['class'=>'img-fluid'] ); ?>
<a href="<?php the_permalink(  ); ?>"><h3><?php the_title() ?></h3></a>
<p> <?php if(is_home(  )) the_excerpt(  ); else the_content( ); ?> </p>
</div>
<?php
// If comments are open or we have at least one comment, load up the comment template.
 if ( comments_open() || get_comments_number() ) :
     comments_template();
 endif;
 ?>
    <?php endwhile;?>
    
    <?php else: ?>
    <h3>No post found</h3>
    <?php endif;?>
    </div>
    <?php get_footer();?>