<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= get_template_directory_uri();?>/assets/css/footer.css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>"> 
    <?php wp_head() ?>
    </head>
<body translate="no">
    <?php
wp_nav_menu( array( 'theme_location' => 'primary_menu' ) );
?>