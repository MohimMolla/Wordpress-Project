<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name') ?><?php wp_title() ?></title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri();?>">
    <?php wp_head(  ); ?>
</head>
<body <?php body_class('main round45'); ?>>

<div class="container">
<div id="header" class="section">

<h1 class="header">
<a href="<?php bloginfo('url'); ?>">
<?php
if ( function_exists( 'the_custom_logo' ) ) {
    the_custom_logo();
}
?> <?php bloginfo('name'); ?></a> </h1>
</div>
<hr>
<div id="nav-top">
<?php //wp_nav_menu(['menu'=>'topmenu']); ?>
<?php wp_nav_menu( array( 'theme_location' => 'primary_menu' ) ); ?>
</div>
<?php if ( get_header_image() ) : ?>
<div class="text-center" id="customheader">
<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="header image" />
</div>
<?php endif; ?>
