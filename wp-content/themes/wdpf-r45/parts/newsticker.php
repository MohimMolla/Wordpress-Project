  <?php
      $options = get_option( 'clean_blog_options' );
if(isset($options['show_breaking_news'])){
      ?>          
            <div class="ticker-container mt-3">
  <div class="ticker-caption">
    <p>Breaking News</p>
  </div>
  <ul>
    <!-- ######################## --> 
    
    <?php $newsticker = get_posts(
    array(
        'post_type' => 'newsticker', 
        'posts_per_page' => $options['num_breaking_news']
    )); 
      
      foreach($newsticker as $news):
      //var_dump($news);
    $news_post = get_post($news->ID); 
      
      ?>
    <div><li><span><?php echo $news_post->post_title; ?> &ndash; <a href="<?php the_permalink($news); ?>" target="_blank">read more</a></span></li></div>
           
      
    <?php endforeach; ?>
      <!-- ######################## -->
  </ul>
</div>
<?php } ?>
