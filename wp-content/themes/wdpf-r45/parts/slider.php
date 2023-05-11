    <?php 
$options = get_option( 'scl_simple_options' );
// var_dump($options);
if(isset($options['slider_all_pages']) && $options['slider_all_pages']=="on"){
?>
       <div class="row mt-3">
        <div class="col-12">
              <!--carousel -->
              <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">    
    <?php $slider = get_posts(array('post_type' => 'slider', 'posts_per_page' => 5)); 
      $count = 0; 
      foreach($slider as $slide): ?>
      <div class="carousel-item <?php echo ($count == 0) ? 'active' : ''; ?>" data-bs-interval="5000">
        <img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($slide->ID)) ?>" class="d-block w-100"/>
              <div class="carousel-caption d-none d-md-block">
    <h5><?php 
    $content_post = get_post($slide->ID);
    echo $content_post->post_title; ?></h5>    
    <p><?php        
        //var_dump($content_post);
echo $content_post->post_content; ?></p>
  </div>
      </div>
      <?php $count++; ?>
    <?php endforeach; ?>
  </div>

  <!-- Controls -->
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
    <!--carousel --> 
        </div>
    </div>
    <?php } ?>
    <hr>
    