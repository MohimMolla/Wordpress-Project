<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package html2wordpress
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
	<div id="page" class="site">

	<!-- header -->
	<!-- <header class="header-area">
		<div class="container">
			<div class="row d_flex">
				<div class=" col-md-3 col-sm-3">
					<div class="logo">
						<a href="index.html">Bliss</a>
					</div>
				</div>
				<div class="col-md-9 col-sm-9">
					<div class="navbar-area">
						<nav class="site-navbar">
							<ul>
								<li><a class="active" href="index.html">Home</a></li>
								<li><a href="about.html">About</a></li>
								<li><a href="service.html">Service</a></li>
								<li><a href="blog.html">Blog</a></li>
								<li><a href="contact.html">Contact us</a></li>
								<li class="d_none"><a href="Javascript:void(0)"><i class="fa fa-user" aria-hidden="true"></i></a></li>
								<li class="d_none"><a href="Javascript:void(0)"><i class="fa fa-search" aria-hidden="true"></i></a></li>
							</ul>
							<button class="nav-toggler">
								<span></span>
							</button>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</header> -->
	<!-- end header inner -->
	<header class="header-area">
    <div class="container">
        <div class="row d_flex">
            <div class=" col-md-3 col-sm-3">
                <div class="logo">
                    <?php if (is_front_page()) { ?>
                        <h1><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h1>
                    <?php } else { ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-9 col-sm-9">
                <div class="navbar-area">
                    <?php
                        wp_nav_menu(array(
                            'theme_location' => 'primary-menu',
                            'menu_class' => 'site-navbar',
                        ));
                    ?>
                    <button class="nav-toggler">
                        <span></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>








	
		