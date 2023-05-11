<?php $options = get_option( 'scl_simple_options' ); ?>
<div class="row">
    <?php if(have_posts(  )): while(have_posts(  )): the_post(  ); ?>

<div class="col-md-<?php echo $options['col']; ?>">
<?php the_post_thumbnail( 'medium',['class'=>'img-fluid'] ); ?>
<a href="<?php the_permalink(  ); ?>"><h4 <?php post_class(); ?>><?php the_title() ?></h4></a>
<p> <?php if(is_home(  )) {the_excerpt(); ?> 
<a href="<?php the_permalink(  ); ?>">Read more...</a> 
<?php }else the_content( ); ?> <?php wp_link_pages(); ?></p>
<p>Published at <?php the_date() ?> <?php the_time() ?> by <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo esc_attr( get_the_author() ); ?>"><?php the_author(); ?></a>(<?php the_author_posts( ) ?>)</p>
<p>Category: <?php the_category( ','); ?>, Tags: <?php the_tags( ) ?></p>
</div>    
    <?php endwhile;?>    
    <?php else: ?>
    <h3>No post found</h3>
    <?php endif;?>
    </div>
    <!-- old posts links -->
    <?php posts_nav_link(); ?>