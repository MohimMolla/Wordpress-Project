<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <style>
      body{
         background-color: #<?= get_option('idb_background_color') ?>;
      }
   </style>
</head>
<body>
   <?php get_template_part('inc/newsticker'); ?>
   <h1><?= get_template_directory(); ?></h1>
<?php
$colors = array(
    'aliceblue' => 'F0F8FF',
    'antiquewhite' => 'FAEBD7',
    'aqua' => '00FFFF',
    'aquamarine' => '7FFFD4',
    'azure' => 'F0FFFF',
    'beige' => 'F5F5DC',
    'bisque' => 'FFE4C4',
    'black' => '000000',
    'blanchedalmond' => 'FFEBCD');
// get_template_part('inc/colors');

update_option( 'idb_background_color', $colors[array_rand($colors)] );
if ( isset( $_POST['submit'] ) ) {
//check nonce for security
wp_verify_nonce( 'prowp_settings_form_save', 'prowp_nonce_field' );
//nonce passed, now do stuff
}
?>
<h1>site URL: <?= site_url()?></h1>
<h1>home URL: <?= home_url()?></h1>
<h1>admin url : <?= admin_url()?></h1>
<h1>wp_upload_dir() url : <?php print_r(wp_upload_dir())?></h1>
<h1>testing $wpdb</h1>
<h3>nonce check</h3>
<form method="post">
<?php wp_nonce_field( 'prowp_settings_form_save', 'prowp_nonce_field' ); ?>
Enter your name: <input type="text" name="text" /><br />
<input type="submit" name="submit" value="Save Options" />
</form>
<!--  -->
<?php
$args = array(
    'post_type'        => 'carousel',
   );
   $query = new WP_Query( $args ); 
   if ( $query->have_posts() ) {
   while ( $query->have_posts() ) {
   $query->the_post(); 
   ?>
<li><?php the_title(); ?>
<img src="<?php the_post_thumbnail_url() ?>" alt="">
</li>
   <?php
   
   } // end while
   } // end if
   wp_reset_query();
?>

<!--  -->
<?php
/*
global $wpdb;
$field_key = "address";
$field_value = "1428 Elm St";
$wpdb->query( $wpdb->prepare( "INSERT INTO $wpdb->my_custom_table
( id, field_key, field_value ) VALUES ( %d, %s, %s )", 1,
$field_key, $field_value ) );
*/

global $wpdb;
$comment_count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*)
FROM $wpdb->comments
WHERE comment_approved = %d;", 1 ) );
echo '<p>Total comments: ' . $comment_count . '</p>';
?>
<hr>
<?php
$thepost = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $wpdb->posts WHERE ID = %d", 1 ), ARRAY_A );
print_r ( $thepost );
?>
<hr>
<?php
$liveposts = $wpdb->get_results( $wpdb->prepare( "SELECT ID, post_title 
FROM $wpdb->posts WHERE post_status = %d ", 'publish' ) );
foreach ( $liveposts as $livepost ) {
echo '<p>' .$livepost->post_title. '</p>';
}
?>
</body>
</html>
