<?php
add_theme_support( 'post-thumbnails' );

if ( ! function_exists( 'chitkar_register_nav_menu' ) ) {

	function chitkar_register_nav_menu(){
		register_nav_menus( array(
	    	'primary_menu' => __( 'Primary Menu', 'text_domain' ),
	    	'footer_menu'  => __( 'Footer Menu', 'text_domain' ),
		) );
	}
	add_action( 'after_setup_theme', 'chitkar_register_nav_menu', 0 );
}



add_action( 'init', 'prowp_register_my_post_types' );
function prowp_register_my_post_types() {

register_post_type( 'notice',
array(
	'public' => true,
'labels' => array( 'name' => 'Notice', ),
'taxonomies' => array( 'category','Course','post_tag' ),
'supports' => array( 'title', 'editor', 'author','thumbnail', 'comments','custom-fields' )
)
);
register_post_type( 'results',
array(
'labels' => array( 'name' => 'Results' ),
'taxonomies' => array( 'post_tag'),
'public' => true,
'supports' => array( 'title', 'editor', 'author','thumbnail', 'comments' )
)
);
register_post_type( 'carousel',
array(
	'public' => true,
'labels' => array( 'name' => 'Carousel', ),
'taxonomies' => array( 'category','Course','post_tag' ),
'supports' => array( 'title', 'editor', 'thumbnail','excerpt' )
)
);

}

//CUSTOM TAXONOMY
//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_topics_hierarchical_taxonomy', 0 );
//create a custom taxonomy name it topics for your posts
function create_topics_hierarchical_taxonomy() {
// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI
 $labels = array(
   'name' => _x( 'Course', 'taxonomy general name' ),
   'singular_name' =>_x( 'Course', 'taxonomy singular name' ),
   'search_items' =>__( 'Search Course' ),
   'all_items' =>__( 'All Course' ),
   'parent_item' =>__( 'Parent Course' ),
   'parent_item_colon' =>__( 'Parent Course:' ),
   'edit_item' =>__( 'Edit Course' ),
   'update_item' =>__( 'Update Course' ),
   'add_new_item' =>__( 'Add New Course' ),
   'new_item_name' =>__( 'New Course Name' ),
   'menu_name' =>__( 'Course' ),
 );  
// Now register the taxonomy
 register_taxonomy('Course',array('post'), array(
   'hierarchical' =>true,
   'labels' =>$labels,
   'show_ui' =>true,
   'show_in_menu'=>true,
   'show_in_rest'=>true,
   'show_admin_column' =>true,
   'query_var' =>true,
   'rewrite' =>array( 'slug' => 'topic' ),
 ));

}
?>