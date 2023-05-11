<style>
    * {
  box-sizing: border-box;
}

@-webkit-keyframes ticker {
  0% {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
    visibility: visible;
  }
  100% {
    -webkit-transform: translate3d(-100%, 0, 0);
    transform: translate3d(-100%, 0, 0);
  }
}
@keyframes ticker {
  0% {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
    visibility: visible;
  }
  100% {
    -webkit-transform: translate3d(-100%, 0, 0);
    transform: translate3d(-100%, 0, 0);
  }
}
.ticker-wrap {
  position: fixed;
  bottom: 0;
  width: 100%;
  overflow: hidden;
  height: 4rem;
  background-color: rgba(200, 200, 200, 0.9);
  padding-left: 100%;
  box-sizing: content-box;
}
.ticker-wrap .ticker {
  display: inline-block;
  height: 4rem;
  line-height: 4rem;
  white-space: nowrap;
  padding-right: 100%;
  box-sizing: content-box;
  -webkit-animation-iteration-count: infinite;
  animation-iteration-count: infinite;
  -webkit-animation-timing-function: linear;
  animation-timing-function: linear;
  -webkit-animation-name: ticker;
  animation-name: ticker;
  -webkit-animation-duration: 30s;
  animation-duration: 30s;
}
.ticker-wrap .ticker__item {
  display: inline-block;
  padding: 0 2rem;
  font-size: 2rem;
  color: white;
}

body {
  padding-bottom: 5rem;
}

h1, h2, p {
  padding: 0 5%;
}
</style>
<?php $op = get_option('prowp_options');
var_dump($op['newsids']);
?>
<hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr>
<div class="ticker-wrap">
        <div class="ticker">
<?php  
$myPosts = new WP_Query( array( 'post_type' => 'post', 'post__in' => explode(",",$op['newsids'] ) ) );
while ( $myPosts->have_posts() )
: $myPosts->the_post();
?>
<div class="ticker__item"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></div>
<?php endwhile; ?>
</div>
</div>
