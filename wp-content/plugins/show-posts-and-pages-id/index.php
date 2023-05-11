<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php
/*
Plugin Name: YYDevelopment - Show Pages ID
Plugin URI:  https://www.yydevelopment.com/yydevelopment-wordpress-plugins/
Description: Simple plugin that show you the pages and posts #id number
Version:     1.5.5
Author:      YYDevelopment
Author URI:  https://www.yydevelopment.com/
*/

// ================================================================================================================================================
// display the page id on the admin bar in the
// front-end part of the page
// ================================================================================================================================================

function adding_id_number_to_admin_bar( $wp_admin_bar ) {

	 global $wp_query;

	$post_id_num = "";
	$post_type = get_post_type();

	// ------------------------------------------------
	// getting the id for regular wordpresss pages
	// ------------------------------------------------

	// in case of page or blog post
	if( $post_type === 'page' || $post_type === 'post' || is_single() ) {		
		$post_id_num =  "ID: " . get_the_ID();
	} // if( $post_type === 'page' || $post_type === 'post' || is_single() ) {	

	// in case of category page or tag page
	if( is_category() || is_tag() ) {

		$id_type = "";
		if( is_category() ) { $id_type = "Category ";}
		if( is_tag() ) { $id_type = "Tag ";}

		$post_id_num =  $id_type . "ID: " . $wp_query->get_queried_object_id();
		
	} // if( is_category() || is_tag() ) {

	// in case of static home page
	if( is_home() ) {
		$blog_page_id = get_option( 'page_for_posts' );

		// incase the blog is on the home page
		if( !empty($blog_page_id) ) {
			$post_id_num =  "ID: " . $blog_page_id;
		} // if( $blog_page_id ) {

	} // if( !empty($blog_page_id) ) {

	// ------------------------------------------------
	// getting it to work with wocommerce
	// ------------------------------------------------

	if( class_exists('woocommerce') ) {

		// in case of a product page
		if( $post_type === 'product' ) {		
			$post_id_num =  "ID: " . get_the_ID();
		} // if( $post_type === 'product' ) {

		// in case of category page or tag page
		if( is_product_category() || is_product_tag() ) {

			$id_type = "";
			if( is_product_category() ) { $id_type = "Category ";}
			if( is_product_tag() ) { $id_type = "Tag ";}

			$post_id_num =  $id_type . "ID: " . $wp_query->get_queried_object_id();
			
		} // if( is_product_category() || is_product_tag() ) {

	} // if( class_exists('woocommerce') ) {

	// ------------------------------------------------
	// making sure the output the code only when it's page, post, category or tag
	// ------------------------------------------------

	if( !empty($post_id_num) ) {

		$args = array(
			'id'    => 'my_page',
			'title' => $post_id_num,
			'href'  => '',
			'meta'  => array( 'class' => 'my-toolbar-page' )
		);

		$wp_admin_bar->add_node( $args );

	} // if( !empty($post_id_num) ) {

} // function toolbar_link_to_mypage( $wp_admin_bar ) {

// this action will output the page ID into the admin page
add_action( 'admin_bar_menu', 'adding_id_number_to_admin_bar', 9999 );


// ================================================================================================================================================
// Adding class with the id to the page body
// ================================================================================================================================================

function yydev_add_id_class_to_body( $classes ) {

	 global $wp_query;

	$post_id_num = "";
	$post_type = get_post_type();

	// ------------------------------------------------
	// getting the id for regular wordpresss pages
	// ------------------------------------------------

	// in case of page or blog post
	if( $post_type === 'page' || $post_type === 'post' || is_single() ) {
		$post_id_class =  "page-id-" . get_the_ID();
	} // if( $post_type === 'page' || $post_type === 'post' || is_single() ) {	

	// in case of category page or tag page
	if( is_category() || is_tag() ) {

		$id_type = "";
		if( is_category() ) { $id_type = "category";}
		if( is_tag() ) { $id_type = "tag ";}

		$post_id_class =  $id_type . "-id-" . $wp_query->get_queried_object_id();
		
	} // if( is_category() || is_tag() ) {

	// in case of static home page
	if( is_home() ) {
		$blog_page_id = get_option( 'page_for_posts' );

		// incase the blog is on the home page
		if( !empty($blog_page_id) ) {
			$post_id_class =  "page-id-" . $blog_page_id;
		} // if( $blog_page_id ) {

	} // if( !empty($blog_page_id) ) {

	// ------------------------------------------------
	// getting it to work with wocommerce
	// ------------------------------------------------

	if( class_exists('woocommerce') ) {

		// in case of a product page
		if( $post_type === 'product' ) {		
			$post_id_class =  "page-id-" . get_the_ID();
		} // if( $post_type === 'product' ) {

		// in case of category page or tag page
		if( is_product_category() || is_product_tag() ) {

			$id_type = "";
			if( is_product_category() ) { $id_type = "category";}
			if( is_product_tag() ) { $id_type = "tag";}

			$post_id_class =  $id_type . "-id-" . $wp_query->get_queried_object_id();
			
		} // if( is_product_category() || is_product_tag() ) {

	} // if( class_exists('woocommerce') ) {

	// ------------------------------------------------
	// return the class id into the page
	// ------------------------------------------------

	if( isset($post_id_class) && !empty($post_id_class) ) {
		$classes[] = $post_id_class;
	} // if( isset($post_id_class) && !empty($post_id_class) ) {

	return $classes;

} // function yydev_add_id_class_to_body( $classes ) {

// this action will add body class with the page id
add_filter( 'body_class', 'yydev_add_id_class_to_body');


// ================================================================================================================================================
// display the plugin we have create on the wordpress post blog and pages
// ================================================================================================================================================

// ---------------------------------------------------------------
// adding the ID title to all the pages we are adding the id into
// ---------------------------------------------------------------

function add_id_title_to_table($columns) {
	return array_merge( $columns, array('show_id_num' => __('ID')) );
} // function add_id_title_to_table($columns) {

add_filter('manage_posts_columns' , 'add_id_title_to_table', 1); // adding id title to posts
add_filter('manage_pages_columns' , 'add_id_title_to_table', 1); // adding id title to pages
add_filter('manage_media_columns' , 'add_id_title_to_table', 1); // adding id title to media files
add_filter('manage_edit-comments_columns' , 'add_id_title_to_table', 1); // adding id title to comments
add_filter('manage_edit-category_columns' , 'add_id_title_to_table', 1); // adding id title to categories
add_filter('manage_edit-post_tag_columns' , 'add_id_title_to_table', 1); // adding id title to tags
add_filter('manage_edit-product_cat_columns' , 'add_id_title_to_table', 1); // adding id title to woocommerce products categories
add_filter('manage_edit-product_tag_columns' , 'add_id_title_to_table', 1); // adding id title to woocommerce products tags
add_filter('manage_users_columns', 'add_id_title_to_table', 1); // add id title to users page

// ---------------------------------------------------------------
// adding ids to users columns
// ---------------------------------------------------------------

function add_id_number_users_column($value, $column_name, $user_id) {

    $user = get_userdata($user_id);

	if ( 'show_id_num' == $column_name ) {
		$value = $user_id;
	} // if ( 'show_id_num' == $column_name ) {
	
    return $value;

} // function add_id_number_users_column($value, $column_name, $user_id) {

add_action('manage_users_custom_column', 'add_id_number_users_column', 1, 3);


// ---------------------------------------------------------------
// adding the ID title to all the pages we are adding the id into
// ---------------------------------------------------------------

function add_id_number_to_id_column( $column, $id ) {
	if( $column === "show_id_num" ) {
		echo $id;
	} // if( $column === "show_id_num" ) {
} // function add_id_number_to_id_column( $column, $id ) {

add_action('manage_posts_custom_column' , 'add_id_number_to_id_column', 2, 2); // adding id number to posts
add_action('manage_pages_custom_column' , 'add_id_number_to_id_column', 2, 2); // adding id number to pages
add_action('manage_media_custom_column' , 'add_id_number_to_id_column', 2, 2); // adding id number to media files
add_action('manage_comments_custom_column' , 'add_id_number_to_id_column', 2, 2); // adding id number to comments

// ---------------------------------------------------------------
// adding id to category and to tags
// ---------------------------------------------------------------

function add_id_number_to_categories_tags( $content, $column_name, $term_id ) {

	if( $column_name === "show_id_num" ) {
		echo $term_id;
	} // if( $column_name === "show_id_num" ) {

} // function add_id_number_to_id_column( $column, $id ) {


add_action('manage_category_custom_column' , 'add_id_number_to_categories_tags', 2, 3); // adding id number to categories
add_action('manage_post_tag_custom_column' , 'add_id_number_to_categories_tags', 2, 3); // adding id number to categories
add_action('manage_product_cat_custom_column' , 'add_id_number_to_categories_tags', 2, 3); // adding id number to categories
add_action('manage_product_tag_custom_column' , 'add_id_number_to_categories_tags', 2, 3); // adding id number to categories

// ---------------------------------------------------------------
// forcing wordpress to give proper width to id in tables
// ---------------------------------------------------------------

add_action('admin_head', function() {

	$output_code = "";
    $output_code .= "<style>";
		$output_code .= "th#show_id_num {width: 55px;}";
    $output_code .= "</style>";

	echo $output_code;

}); // add_action('admin_head', function() {


// ================================================
// Add donate button into the page
// ================================================

add_filter( 'plugin_action_links', function($actions, $plugin_file) {

	static $plugin;

    if (!isset($plugin)) { $plugin = plugin_basename(__FILE__); }
    
	if ($plugin == $plugin_file) {

            $admin_page_url = esc_url( menu_page_url( 'yydev-show-pages-id', false ) );
            $donate = array('donate' => '<a target="_blank" href="https://www.yydevelopment.com/coffee-break/?plugin=show-posts-and-pages-id">Donate</a>');
		
            $actions = array_merge($donate, $actions);
        
    } // if ($plugin == $plugin_file) {
		
    return $actions;

}, 10, 5 );

// ================================================
// including admin notices flie
// ================================================

if( is_admin() ) {
	include_once('notices.php');
} // if( is_admin() ) {

