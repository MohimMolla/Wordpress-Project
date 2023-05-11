<?php
/**
 * html2wordpress functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package html2wordpress
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function htmlwp_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on html2wordpress, use a find and replace
		* to change 'htmlwp' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'htmlwp', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'htmlwp' ),
		)
	);

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
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'htmlwp_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'htmlwp_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function htmlwp_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'htmlwp_content_width', 640 );
}
add_action( 'after_setup_theme', 'htmlwp_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function htmlwp_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'htmlwp' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'htmlwp' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'htmlwp_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function htmlwp_scripts() {
	wp_enqueue_style( 'htmlwp-style', get_stylesheet_uri(), array() );
	wp_enqueue_script( 'bootstrap-datepicker.min', get_template_directory_uri() . '/css/bootstrap-datepicker.min.css', array() );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array() );
	wp_enqueue_script( 'bootstrap.min', get_template_directory_uri() . '/css/bootstrap.min.css', array() );
	wp_enqueue_script( 'font-awesome.min', get_template_directory_uri() . '/css/font-awesome.min.css', array() );
	wp_enqueue_script( 'icomoon', get_template_directory_uri() . '/css/icomoon.css', array() );
	wp_enqueue_script( 'nice-select', get_template_directory_uri() . '/css/nice-select.css', array() );
	wp_enqueue_script( 'niceCountryInput', get_template_directory_uri() . '/css/niceCountryInput.css', array() );
	wp_enqueue_script( 'owl.carousel.min', get_template_directory_uri() . '/css/owl.carousel.min.css', array() );
	wp_enqueue_script( 'responsive', get_template_directory_uri() . '/css/responsive.css', array() );
	wp_enqueue_script( 'style', get_template_directory_uri() . '/css/style.css', array() );
	wp_enqueue_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css', array(), '5.3.0-alpha2', 'all' );

	wp_enqueue_style( 'font-awesome', 'https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css' );

	wp_style_add_data( 'htmlwp-style', 'rtl', 'replace' );

	wp_enqueue_script( 'htmlwp-navigation', get_template_directory_uri() . '/js/navigation.js', array() );
	wp_enqueue_script( 'jquery.min', get_template_directory_uri() . '/js/jquery.min.js', array() );
	wp_enqueue_script( 'bootstrap-datepicker.min', get_template_directory_uri() . '/js/bootstrap-datepicker.min.js', array() );
	wp_enqueue_script( 'bootstrap.bundle.min', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array() );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array() );
	wp_enqueue_script( 'bootstrap.min', get_template_directory_uri() . '/js/bootstrap.min.js', array() );
	wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js', array() );
	wp_enqueue_script( 'customizer', get_template_directory_uri() . '/js/customizer.js', array() );
	wp_enqueue_script( 'jquery-3.0.0.min', get_template_directory_uri() . '/js/jquery-3.0.0.min.js', array() );
	
	wp_enqueue_script( 'jquery.nice-select.min', get_template_directory_uri() . '/js/jquery.nice-select.min.js', array() );
	wp_enqueue_script( 'navigation', get_template_directory_uri() . '/js/navigation.js', array() );
	wp_enqueue_script( 'niceCountryInput', get_template_directory_uri() . '/js/niceCountryInput.js', array() );
	wp_enqueue_script( 'owl.carousel.min', get_template_directory_uri() . '/js/owl.carousel.min.js', array() );
	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'htmlwp_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
// heder functions start
function register_custom_menus() {
    register_nav_menus(array(
        'primary-menu' => __('Primary Menu'),
    ));
}
add_action('init', 'register_custom_menus');

// heder functions end

