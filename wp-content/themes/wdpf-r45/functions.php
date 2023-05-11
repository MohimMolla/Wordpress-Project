<?php
add_theme_support( 'post-thumbnails' );
add_theme_support( 'menus' );

/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		$logo_width  = 300;
		$logo_height = 100;

		add_theme_support(
			'custom-logo',
			array(
				'height'               => $logo_height,
				'width'                => $logo_width,
				'flex-width'           => true,
				'flex-height'          => true,
				'unlink-homepage-logo' => true,
			)
		);

        //custom header
        function themename_custom_header_setup() {
            $args = array(
                'default-image'      => get_template_directory_uri() . 'img/add (1).gif',
                'default-text-color' => '000',
                'width'              => 1000,
                'height'             => 250,
                'flex-width'         => true,
                'flex-height'        => true,
            );
            add_theme_support( 'custom-header', $args );
        }
        add_action( 'after_setup_theme', 'themename_custom_header_setup' );

        /*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
                'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets',
			)
		);
// Action Hook
add_action( 'wp_footer', 'say_hello' );
function say_hello() {
echo '<!-- Hello, curious theme developer! -->';
}
add_action( 'wp_head', 'say_hi' );
function say_hi() {
echo '<!-- head tag comment -->';
}
//filter hook
// add_filter( 'wp_title', 'design_title' );
// function design_title( $title ) {
// return ' title ';
// }
// function suppress_if_blurb( $title, $id = null ) {
 
//       return ' ---'.$title.'--- ';
// }
// add_filter( 'the_title', 'suppress_if_blurb', 10, 2 );

function show_footer_image( $content, $id = null ) {
 
    return $content.'<hr><div>This article contains '.mb_strlen($content).' characters</div>';
}
add_filter( 'the_content', 'show_footer_image', 10, 2 );

function add_my_option() {
    $args = array(
                'show' => 'true',
        		'message' => 'admin message',
				'col'=>'4'
            );
			
    add_option( 'scl_simple_options',  $args , '', 'yes' ); 
	add_option( 'round',  '45' , '', 'yes' );
} 
add_action( 'admin_init', 'add_my_option' );

//form
//options menu

function scl_simple_options_page() {
    ?>
    <div class="wrap">
    <form method="post" id="scl_simple_options" action="options.php">
	<?php
settings_fields('scl_simple_options');

$options = get_option( 'scl_simple_options' );
var_dump($options);

//$d = get_option( 'recently_edited' );
//var_dump($d);
?>
    <h2><?php _e('Sample Options' ); ?></h2>
	<table class="form-table">
    <tr>
        <th>Show Slider on all Pages?</th>
        <td><input type="checkbox" name="scl_simple_options[slider_all_pages]" id="" 
        <?php if(isset($options['slider_all_pages']))
	if('on' == $options['slider_all_pages']){
?>
	checked	
		<?php } ?> >
        
        </td>
    </tr>
<tr>
<th scope="row"><?php _e('Short Links' ); ?></th>
<td colspan="3">
<p> <label>
<input type="text" id="show"
name="scl_simple_options[show]" value="<?php echo esc_attr($options['show']); ?>" />
</label></p>
</td>
</tr>
<tr>
<th scope="row"><?php _e('Admin Message' ); ?></th>
<td colspan="3">
<input size=150 type="text" id="google_meta_key"
name="scl_simple_options[message]" value="<?php echo esc_attr($options['message']); ?>" />
<br /><span class="description">
</td>
</tr>
<tr>
<th scope="row"><?php _e('Home page post column width' ); ?></th>
<td colspan="3">
<input size=150 type="text" id="google_meta_key"
name="scl_simple_options[col]" value="<?php echo esc_attr($options['col']); ?>" />
<br />
</td>
</tr>
</table>
    <p class="submit">
    <input type="submit" value="<?php esc_attr_e('Update Options'); ?>"
    class="button-primary" />
    </p>
    </form>
    </div>
    <?php
    }
    add_action('admin_menu', 'scl_simple_options_add_pages');
    function scl_simple_options_add_pages() {
    add_options_page('Admin Message Form', 'Sample Options', 'manage_options', 'simple-options-example', 'scl_simple_options_page');
	register_setting( 'scl_simple_options', 'scl_simple_options' );    
}


//register menu location

if ( ! function_exists( 'mytheme_register_nav_menu' ) ) {
 
    function mytheme_register_nav_menu(){
        register_nav_menus( array(
            'primary_menu' => __( 'Primary Menu', 'text_domain' ),
            'footer_menu'  => __( 'Footer Menu', 'text_domain' ),
        ) );
    }
    add_action( 'after_setup_theme', 'mytheme_register_nav_menu', 0 );
}

/**
 * Add a sidebar.
 */
function wpdocs_theme_slug_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Main Sidebar', 'textdomain' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Widgets in this area will be shown on all posts and pages.', 'textdomain' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget'  => '</li>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer', 'textdomain' ),
        'id'            => 'sidebar-footer',
        'description'   => __( 'Widgets in this area will be shown on all posts and pages.', 'textdomain' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget'  => '</li>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'wpdocs_theme_slug_widgets_init' );



//custom post types
// Our custom post type function
function create_posttype() {
 
    register_post_type( 'movies',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Movies' ),
                'singular_name' => __( 'Movie' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'movies'),
            'show_in_rest' => true,
            'taxonomies'   => array( 'genres'),
 
        )
    );
    //bootstrap slider post type start
    $labels = array(
		'name'               => _x( 'Slider', 'post type general name'),
		'singular_name'      => _x( 'Slide', 'post type singular name'),
		'menu_name'          => _x( 'Bootstrap Slider', 'admin menu'),
		'name_admin_bar'     => _x( 'Slide', 'add new on admin bar'),
		'add_new'            => _x( 'Add New', 'Slide'),
		'add_new_item'       => __( 'Name'),
		'new_item'           => __( 'New Slide'),
		'edit_item'          => __( 'Edit Slide'),
		'view_item'          => __( 'View Slide'),
		'all_items'          => __( 'All Slide'),
		'featured_image'     => __( 'Featured Image', 'text_domain' ),
		'search_items'       => __( 'Search Slide'),
		'parent_item_colon'  => __( 'Parent Slide:'),
		'not_found'          => __( 'No Slide found.'),
		'not_found_in_trash' => __( 'No Slide found in Trash.'),
	);

	$args = array(
		'labels'             => $labels,
		'menu_icon'	     => 'dashicons-star-half',
    	        'description'        => __( 'Description.'),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array('title','editor','thumbnail')
	);
    register_post_type( 'slider', $args );
    //bootstrap slider post type end

    //
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );


//hook into the init action and call create_book_taxonomies when it fires
 
add_action( 'init', 'create_subjects_hierarchical_taxonomy', 0 );
 
//create a custom taxonomy name it subjects for your posts
 
function create_subjects_hierarchical_taxonomy() {
 
// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI
 
  $labels = array(
    'name' => _x( 'Genre', 'taxonomy general name' ),
    'singular_name' => _x( 'Genre', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Genre' ),
    'all_items' => __( 'All Genre' ),
    'parent_item' => __( 'Parent Genre' ),
    'parent_item_colon' => __( 'Parent Genre:' ),
    'edit_item' => __( 'Edit Genre' ), 
    'update_item' => __( 'Update Genre' ),
    'add_new_item' => __( 'Add New Genre' ),
    'new_item_name' => __( 'New Genre Name' ),
    'menu_name' => __( 'Genres' ),
  );    
 
// Now register the taxonomy
  register_taxonomy('genres',array('movies','post'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'genres' ),
  ));

}

//carousel and custom post start
//register custom post type start
add_action( 'init', 'custom_bootstrap_slider' );
/**
 * Register a Custom post type for.
 */
function custom_bootstrap_slider() {
	$labels = array(
		'name'               => _x( 'Slider', 'post type general name'),
		'singular_name'      => _x( 'Slide', 'post type singular name'),
		'menu_name'          => _x( 'Bootstrap Slider', 'admin menu'),
		'name_admin_bar'     => _x( 'Slide', 'add new on admin bar'),
		'add_new'            => _x( 'Add New', 'Slide'),
		'add_new_item'       => __( 'Name'),
		'new_item'           => __( 'New Slide'),
		'edit_item'          => __( 'Edit Slide'),
		'view_item'          => __( 'View Slide'),
		'all_items'          => __( 'All Slide'),
		'featured_image'     => __( 'Featured Image', 'text_domain' ),
		'search_items'       => __( 'Search Slide'),
		'parent_item_colon'  => __( 'Parent Slide:'),
		'not_found'          => __( 'No Slide found.'),
		'not_found_in_trash' => __( 'No Slide found in Trash.'),
	);

	$args = array(
		'labels'             => $labels,
		'menu_icon'	     => 'dashicons-star-half',
    	        'description'        => __( 'Description.'),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array('title','editor','thumbnail')
	);
    register_post_type( 'slider', $args );
}
//carousel and custom post end

