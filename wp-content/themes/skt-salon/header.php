<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="container">
 *
 * @package SKT Salon
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
<?php endif; ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php do_action( 'wp_body_open' ); ?>
<a class="skip-link screen-reader-text" href="#content_navigator">
<?php esc_html_e( 'Skip to content', 'skt-salon' ); ?>
</a>
<?php
	$header_trans = esc_html(get_theme_mod('option_header_transparent', 1));
	$header_trans_inner = esc_html(get_theme_mod('option_inner_header_transparent', 1));
	$showpagebanner = esc_html(get_theme_mod('inner_page_banner_option', 1));
	$showpostbanner = esc_html(get_theme_mod('inner_post_banner_option', 1));
	$pagethumb = esc_html(get_theme_mod('inner_page_banner_thumb'));
	$postthumb = esc_html(get_theme_mod('inner_post_banner_thumb'));
	$header_email = esc_html(get_theme_mod('header_email'));
	$hideheader_email = esc_html(get_theme_mod('hide_header_email', 1));
	$header_button = esc_html(get_theme_mod('header_buttontext'));
	$header_button_link = esc_html(get_theme_mod('header_buttonurl'));
	$hideheader_button = esc_html(get_theme_mod('hide_header_button', 1));
	$header_phonenumbertext = esc_html(get_theme_mod('header_phonenumbertext'));
	$hideheaderphone = esc_html(get_theme_mod('hide_header_phonenumber', 1));
?>
<div id="main-set" class="header-full-set <?php if( !is_home() && is_front_page() && $header_trans == '') {echo esc_html('transheader');}else{if(!is_home() && $header_trans_inner == '') {echo esc_html('transheader');}}?>">
<div class="container">

<?php if( (!empty($header_email)) || (!empty($header_phonenumbertext)) || (!empty($header_button))) { ?>
<div class="head-info-area">
    <div class="container">
    <div class="left">
    <?php if( $hideheader_email == '') { ?>
    <?php if (!empty($header_email)) { ?>
    	<span class="emltp"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/mail-icon.png" alt="Email"></i> <a href="mailto:<?php echo esc_attr( antispambot(sanitize_email( $header_email ) )); ?>"><?php echo esc_html( antispambot( $header_email ) ); ?></a></span>
    <?php }?>
    <?php } ?>    
   	<?php if( $hideheaderphone == '') { ?>
    	<?php if (!empty($header_phonenumbertext)) { ?>
    		<span class="phntp"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/phone-icon.png" alt="Phone"></i> <a href="<?php echo esc_attr('tel:'. $header_phonenumbertext); ?>"><?php echo esc_html($header_phonenumbertext); ?></a></span>
        <?php }?>
    <?php } ?>
            <div class="clear"></div>    
    </div>
    <?php if( $hideheader_button == '') { ?>
    <?php if (!empty($header_button)) { ?>    
    <div class="right">
    <span class="suptp"><a href="<?php echo esc_url($header_button_link); ?>" class="top-btn"><?php echo esc_html($header_button); ?></a></span>
    </div>
    <?php }?>
    <?php } ?>    
    <div class="clear"></div>
    </div>
</div>
<?php } ?>

    <div class="header">
        <div class="logo">
            <?php skt_salon_the_custom_logo(); ?>
            <div class="clear"></div>
            <?php	
            $description = get_bloginfo( 'description', 'display' );
            ?>
            <div id="logo-main">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <h2 class="site-title"><?php bloginfo('name'); ?></h2>
            <?php if ( $description || is_customize_preview() ) :?>
            <p class="site-description"><?php echo esc_html($description); ?></p>                          
            <?php endif; ?>
            </a>
            </div>
        </div> 
            <div id="navigation"><nav id="site-navigation" class="main-navigation">
                    <button type="button" class="menu-toggle">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
            <?php wp_nav_menu( array('theme_location' => 'primary', 'container' => 'ul', 'menu_id' => 'primary', 'menu_class' => 'primary-menu menu' ) ); ?>
                </nav></div>
                <?php if ( class_exists( 'WooCommerce' ) ) { ?>	
                <div class="header-shop-count">
                    <li><a href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View Cart', 'skt-salon' ); ?>">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/cart-icon.png" alt="cart-icon"><span class="custom-cart-count"><div id="mini-cart-count"></div></span></a>
                    <div class="header-cart-count-contents"><span><?php echo esc_html_e('Total', 'skt-salon'); ?></span><a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'skt-salon' ); ?>"><div id="mini-cart-total"></div></a></div>
                    </li>
                </div>
                <?php } ?>
      </div>
  <div class="clear"></div> 
  </div> <!-- container --> 
  </div><!--main-set-->
  <?php if( !is_home() && !is_front_page() && is_page()) {?>
      <div class="clear"></div>
      <div class="inner-banner-thumb <?php if( !is_home() && is_front_page() && $header_trans == '') {echo esc_html('inrheaderon');}else{if(!is_home() && $header_trans_inner == '') {echo esc_html('inrheaderon');}}?>">
      	<?php if($showpagebanner == '') {?>
        <?php 	if ( has_post_thumbnail() ) {
                    echo esc_url(the_post_thumbnail('full'));
                }else{
			if(!empty($pagethumb)){ ?>
            <img src="<?php echo esc_url($pagethumb); ?>" />
            <?php } } ?>
        <?php } ?>    
        <div class="banner-container <?php if($showpagebanner != '') {?>black-title<?php }?>"><h1><?php the_title(); ?></h1></div>
        <div class="clear"></div>
        <h1>Mohim</h1>
      </div>
  <?php } ?>
  <?php if( !is_home() && !is_front_page() && !is_page() && is_single() && 'post' == get_post_type()) {?>
    
      <div class="clear"></div>
      <div class="inner-banner-thumb <?php if( !is_home() && is_front_page() && $header_trans == '') {echo esc_html('inrheaderon');}else{if(!is_home() && $header_trans_inner == '') {echo esc_html('inrheaderon');}}?>">
      	<?php if($showpostbanner == '') {?>
        <?php 	if ( has_post_thumbnail() ) {
                    echo esc_url(the_post_thumbnail('full'));
                }else{
			if(!empty($postthumb)){ ?>
            <img src="<?php echo esc_url($postthumb); ?>" />
            <?php }  } ?>
         <?php } ?>   
        <div class="banner-container <?php if($showpostbanner != '') {?>black-title<?php }?>"><h1><?php the_title(); ?></h1></div>
        <div class="clear"></div>
      </div>
      
  <?php } ?>  
  <?php if (is_category() || is_archive()) { ?>
  <div class="clear"></div>
  <div class="inner-banner-thumb <?php if( !is_home() && is_front_page() && $header_trans == '') {echo esc_html('inrheaderon');}else{if(!is_home() && $header_trans_inner == '') {echo esc_html('inrheaderon');}}?>">
      	<?php if($showpostbanner == '') {?>
        <?php 
			if(!empty($postthumb)){ ?>
            <img src="<?php echo esc_url($postthumb); ?>" />
            <?php }   ?>
         <?php } ?>   
        <div class="banner-container <?php if($showpostbanner != '') {?>black-title<?php }?>">
  	    <?php if ( class_exists( 'WooCommerce' ) ) {
		if(is_shop()) {
			?><h1><?php woocommerce_page_title(); ?> </h1><?php
		}else{
		?><h1><?php the_archive_title(); ?></h1><?php	
		}
	}else{ ?>
    <h1><?php the_archive_title(); ?></h1>
    <?php } ?>	
  </div>
        <div class="clear"></div>
      </div>
  <?php } ?>  
  <div class="clear"></div> 
  