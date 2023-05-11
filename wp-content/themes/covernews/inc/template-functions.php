<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package CoverNews
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function covernews_body_classes($classes)
{
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    global $post;

    $global_layout = covernews_get_option('global_content_layout');
    if (!empty($global_layout)) {
        $classes[] = $global_layout;
    }


    $sticky_header = covernews_get_option('disable_sticky_header_option');
    if ($sticky_header ==  false) {
        $sticky_header_class = covernews_get_option('sticky_header_direction');
        $classes[] = $sticky_header_class.' aft-sticky-header';
    }

    $sticky_sidebar = covernews_get_option('frontpage_sticky_sidebar');
    if($sticky_sidebar){
        $classes[] = 'aft-sticky-sidebar';
    }

    $global_site_mode = covernews_get_option('global_site_mode');
    $classes[] = $global_site_mode;


    $global_alignment = covernews_get_option('global_content_alignment');
    $page_layout = $global_alignment;
    $disable_class = '';
    $frontpage_content_status = covernews_get_option('frontpage_content_status');
    if (1 != $frontpage_content_status) {
        $disable_class = 'disable-default-home-content';
    }

    // Check if single.
    if (is_singular()) {
        $post_options = get_post_meta($post->ID, 'covernews-meta-content-alignment', true);
        if (!empty($post_options)) {
            $page_layout = $post_options;
        } else {
            $page_layout = $global_alignment;
        }
    }   

    $section_mode = covernews_get_option('select_main_banner_section_mode');
    if ($section_mode) {
        $classes[] = 'aft-main-banner-' . $section_mode;
    }

    if (is_front_page()) {
        $frontpage_layout = covernews_get_option('frontpage_content_alignment');
        if (!empty($frontpage_layout)) {
            $page_layout = $frontpage_layout;
        }
    }

    if (!is_front_page() && is_home()) {
        $page_layout = $global_alignment;
    }

    // Check if single.
    if ($post && is_singular()) {
        $global_single_content_mode = covernews_get_option('global_single_content_mode');
        $post_single_content_mode = get_post_meta($post->ID, 'covernews-meta-content-mode', true);
        if (!empty($post_single_content_mode)) {
            $classes[] = $post_single_content_mode;
        } else {
            $classes[] = $global_single_content_mode;
        }
    }


    $select_header_image_mode = covernews_get_option('select_header_image_mode');
    if ($select_header_image_mode == 'full') {
        $classes[] = 'header-image-full';
    } else {
        $classes[] = 'header-image-default';
    }


    if ($page_layout == 'align-content-right') {
        if (is_front_page() && !is_home()) {
            if (is_page_template('tmpl-front-page.php')) {
                if (is_active_sidebar('home-sidebar-widgets')) {
                    $classes[] = 'align-content-right';
                } else {
                    $classes[] = 'full-width-content';
                }
            } else {
                if (is_active_sidebar('sidebar-1')) {
                    $classes[] = 'align-content-right';
                } else {
                    $classes[] = 'full-width-content';
                }
            }
        } else {
            if (is_active_sidebar('sidebar-1')) {
                $classes[] = 'align-content-right';
            } else {
                $classes[] = 'full-width-content';
            }
        }
    } elseif ($page_layout == 'full-width-content') {
        $classes[] = 'full-width-content';
    } else {
        if (is_front_page() && !is_home()) {
            if (is_page_template('tmpl-front-page.php')) {
                if (is_active_sidebar('home-sidebar-widgets')) {
                    $classes[] = 'align-content-left';
                } else {
                    $classes[] = 'full-width-content';
                }
            } else {
                if (is_active_sidebar('sidebar-1')) {
                    $classes[] = 'align-content-left ';
                } else {
                    $classes[] = 'full-width-content';
                }
            }
        } else {
            if (is_active_sidebar('sidebar-1')) {
                $classes[] = 'align-content-left aft-and';
            } else {
                $classes[] = 'full-width-content';
            }
        }
    }
    return $classes;


}

add_filter('body_class', 'covernews_body_classes');


/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function covernews_pingback_header()
{
    if (is_singular() && pings_open()) {
        echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
    }
}

add_action('wp_head', 'covernews_pingback_header');


/**
 * Returns no image url.
 *
 * @since  CoverNews 1.0.0
 */
if (!function_exists('covernews_post_format')):
    function covernews_post_format($post_id)
    {
        $post_format = get_post_format($post_id);
        switch ($post_format) {
            case "image":
                echo "<div class='em-post-format'><i class='fas fa-camera'></i></div>";
                break;
            case "video":
                echo "<div class='em-post-format'><i class='fas fa-video'></i></div>";

                break;
            case "gallery":
                echo "<div class='em-post-format'><i class='fas fa-images'></i></div>";
                break;
            default:
                echo "";
        }


    }

endif;


if (!function_exists('covernews_get_block')) :
    /**
     *
     * @since CoverNews 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function covernews_get_block($block = 'grid')
    {

        get_template_part('inc/hooks/blocks/block-post', $block);

    }
endif;

if (!function_exists('covernews_archive_title')) :
    /**
     *
     * @since CoverNews 1.0.0
     *
     * @param null
     * @return null
     *
     */

    function covernews_archive_title($title)
    {
        if (is_category()) {
            $title = single_cat_title('', false);
        } elseif (is_tag()) {
            $title = single_tag_title('', false);
        } elseif (is_author()) {
            $title = '<span class="vcard">' . get_the_author() . '</span>';
        } elseif (is_post_type_archive()) {
            $title = post_type_archive_title('', false);
        } elseif (is_tax()) {
            $title = single_term_title('', false);
        }

        return $title;
    }

endif;
add_filter('get_the_archive_title', 'covernews_archive_title');

/* Display Breadcrumbs */
if (!function_exists('covernews_get_breadcrumb')) :

    /**
     * Simple breadcrumb.
     *
     * @since 1.0.0
     */
    function covernews_get_breadcrumb()
    {

        $enable_breadcrumbs = covernews_get_option('enable_breadcrumb');

        if (1 != $enable_breadcrumbs) {
            return;
        }
        // Bail if Home Page.
        if (is_front_page() || is_home()) {
            return;
        }

        $select_breadcrumbs = covernews_get_option('select_breadcrumb_mode');

        ?>
        <div class="em-breadcrumbs font-family-1 covernews-breadcrumbs">
            <div class="row">
                <?php
                if ((function_exists('yoast_breadcrumb')) && ($select_breadcrumbs == 'yoast')) {
                    yoast_breadcrumb();
                } elseif ((function_exists('rank_math_the_breadcrumbs')) && ($select_breadcrumbs == 'rankmath')) {
                    rank_math_the_breadcrumbs();
                } elseif ((function_exists('bcn_display')) && ($select_breadcrumbs == 'bcn')) {
                    bcn_display();
                } else {
                    covernews_get_breadcrumb_trail();
                }
                ?>
            </div>
        </div>
        <?php


    }

endif;
add_action('covernews_action_get_breadcrumb', 'covernews_get_breadcrumb');

/* Display Breadcrumbs */
if (!function_exists('covernews_get_breadcrumb_trail')) :

    /**
     * Simple excerpt length.
     *
     * @since 1.0.0
     */

    function covernews_get_breadcrumb_trail()
    {

        if (!function_exists('breadcrumb_trail')) {

            /**
             * Load libraries.
             */

            require_once get_template_directory() . '/lib/breadcrumb-trail/breadcrumb-trail.php';
        }

        $breadcrumb_args = array(
            'container' => 'div',
            'show_browse' => false,
        );

        breadcrumb_trail($breadcrumb_args);

    }

endif;

/**
 * Front-page main banner section layout
 */
if(!function_exists('covernews_front_page_main_section')){

    function covernews_front_page_main_section(){

        $hide_on_blog = covernews_get_option('disable_main_banner_on_blog_archive');

            if ($hide_on_blog) {
                if (is_front_page()) {
                    do_action('covernews_action_front_page_main_section_1');
                }

            } else {
                if (is_front_page() || is_home()) {
                    do_action('covernews_action_front_page_main_section_1');
                }

        }
    }
}
add_action('covernews_action_front_page_main_section', 'covernews_front_page_main_section');



/* Display Breadcrumbs */
if (!function_exists('covernews_excerpt_length')) :

    /**
     * Simple excerpt length.
     *
     * @since 1.0.0
     */

    function covernews_excerpt_length($length)
    {
        
        if ( is_admin() ) {
                return $length;
        }

        return 15;
    }

endif;
add_filter('excerpt_length', 'covernews_excerpt_length', 999);


/* Display Breadcrumbs */
if (!function_exists('covernews_excerpt_more')) :

    /**
     * Simple excerpt more.
     *
     * @since 1.0.0
     */
    function covernews_excerpt_more($more)
    {
        return '...';
    }

endif;

add_filter('excerpt_more', 'covernews_excerpt_more');


/* Display Pagination */
if (!function_exists('covernews_numeric_pagination')) :

    /**
     * Simple excerpt more.
     *
     * @since 1.0.0
     */
    function covernews_numeric_pagination()
    {
        the_posts_pagination(array(
            'mid_size' => 3,
            'prev_text' => __( 'Previous', 'covernews' ),
            'next_text' => __( 'Next', 'covernews' ),
        ));
    }

endif;




/* Display Breadcrumbs */
if (!function_exists('covernews_toggle_lazy_load')) :

    /**
     * Simple excerpt more.
     *
     * @since 1.0.0
     */
    function covernews_toggle_lazy_load()
    {
        $covernews_lazy_load = covernews_get_option('global_toggle_image_lazy_load_setting');
        if($covernews_lazy_load == 'disable'){
            add_filter('wp_lazy_loading_enabled', '__return_false');
        }
    }

endif;

add_action('wp_loaded', 'covernews_toggle_lazy_load');