<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package ChromeNews
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function chromenews_body_classes($classes)
{
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    $first_post_full = chromenews_get_option('archive_layout_first_post_full');
    if ($first_post_full) {
        $classes[] = 'archive-first-post-full';
    }


    $global_site_mode_setting = chromenews_get_option('global_site_mode_setting');

    
    if(isset($_COOKIE["stored-site-mode"])){
        $classes[] = $_COOKIE["stored-site-mode"];
    }else{
        if (!empty($global_site_mode_setting)) {
            $classes[] = $global_site_mode_setting;        
        }
    }
    $secondary_color_mode = chromenews_get_option('secondary_color_mode');
    if (!empty($secondary_color_mode)) {
        $classes[] = 'aft-secondary-' . $secondary_color_mode;
    }

    $header_layout = chromenews_get_option('header_layout');
    if (!empty($header_layout)) {
        $classes[] = 'aft-' . $header_layout;
    }

    $select_header_image_mode = chromenews_get_option('select_header_image_mode');
    if ($select_header_image_mode == 'full') {
        $classes[] = 'header-image-full';
    } else {
        $classes[] = 'header-image-default';
    }

    $remove_gaps = chromenews_get_option('remove_gaps_between_thumbs');
    if ($remove_gaps) {
        $classes[] = 'aft-no-thumbs-gap';
    }

    $global_widget_title_border = chromenews_get_option('global_widget_title_border');
    if (!empty($global_widget_title_border)) {
        $classes[] = $global_widget_title_border;
    }


    global $post;

    $global_layout = chromenews_get_option('global_content_layout');
    if (!empty($global_layout)) {
        $classes[] = $global_layout;
    }


    $global_alignment = chromenews_get_option('global_content_alignment');
    $page_layout = $global_alignment;
    $disable_class = '';
    $frontpage_content_status = chromenews_get_option('frontpage_content_status');
    if (1 != $frontpage_content_status) {
        $disable_class = 'disable-default-home-content';
    }

    // Check if single.
    if (is_singular('post') || is_singular('page')) {
        $post_options = get_post_meta($post->ID, 'chromenews-meta-content-alignment', true);
        if (!empty($post_options)) {
            $page_layout = $post_options;
        } else {
            $page_layout = $global_alignment;
        }
    }

    // Check if single.
    if (is_singular('post')) {
        $global_single_content_mode = chromenews_get_option('global_single_content_mode');
        $post_single_content_mode = get_post_meta($post->ID, 'chromenews-meta-content-mode', true);
        if (!empty($post_single_content_mode)) {
            $classes[] = $post_single_content_mode;
        } else {
            $classes[] = $global_single_content_mode;
        }
    }

    if (is_singular('page')) {              
        $post_single_content_mode = get_post_meta($post->ID, 'chromenews-meta-content-mode', true);
        if (!empty($post_single_content_mode)) {
            $classes[] = $post_single_content_mode;
        }else{
            $classes[] = 'single-content-mode-boxed'; 
        } 
    }

    if (is_singular('post')) {
        $single_post_title_view = chromenews_get_option('single_post_title_view');
        $classes[] = 'aft-single-featured-' . $single_post_title_view;
    }


    if (is_front_page()) {
        $frontpage_layout = chromenews_get_option('frontpage_content_alignment');
        if (!empty($frontpage_layout)) {
            $page_layout = $frontpage_layout;
        }
    }

    if (!is_front_page() && is_home()) {
        $page_layout = $global_alignment;
    }

    if ($page_layout == 'align-content-right') {
        if (is_front_page() && !is_home()) {

            if(is_page_template('tmpl-front-page.php')){
                if (is_active_sidebar('home-sidebar-widgets')) {
                    $classes[] = 'align-content-right';
                } else {
                    $classes[] = 'full-width-content';
                }
            }else{
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

            if(is_page_template('tmpl-front-page.php')){
                if (is_active_sidebar('home-sidebar-widgets')) {
                    $classes[] = 'align-content-left';
                } else {
                    $classes[] = 'full-width-content';
                }
            }else{
                if (is_active_sidebar('sidebar-1')) {
                    $classes[] = 'align-content-left';
                } else {
                    $classes[] = 'full-width-content';
                }
            }
           
        } else {
            if (is_active_sidebar('sidebar-1')) {
                $classes[] = 'align-content-left';
            } else {
                $classes[] = 'full-width-content';
            }
        }
    }



    $classes[] = 'af-wide-layout';


    $section_layout = chromenews_get_option('global_section_layout_setting');
    $classes[] = 'aft-section-layout-' . $section_layout;

    return $classes;
}

add_filter('body_class', 'chromenews_body_classes');



/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function chromenews_pingback_header()
{
    if (is_singular() && pings_open()) {
        echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
    }
}

add_action('wp_head', 'chromenews_pingback_header');


/**
 * Returns posts.
 *
 * @since ChromeNews 1.0.0
 */
if (!function_exists('chromenews_get_posts')) :
    function chromenews_get_posts($number_of_posts, $tax_id = '0', $filterby = 'cat')
    {


        $ins_args = array(
            'post_type' => 'post',
            'posts_per_page' => absint($number_of_posts),
            'post_status' => 'publish',
            'order' => 'DESC',
            'ignore_sticky_posts' => true
        );

        $tax_id = isset($tax_id) ? $tax_id : '0';

        if ((absint($tax_id) > 0) && ($filterby == 'tag')) {
            $ins_args['tag_id'] = absint($tax_id);
            $ins_args['orderby'] = 'date';
        } elseif (($filterby == 'view')) {
            $ins_args['orderby'] = 'meta_value_num';
            $ins_args['meta_key'] = 'af_post_views_count';
        } elseif (($filterby == 'comment')) {
            $ins_args['orderby'] = 'comment_count';
        } elseif ((absint($tax_id) > 0) && ($filterby == 'cat')) {
            $ins_args['cat'] = absint($tax_id);
            $ins_args['orderby'] = 'date';
        } else {
            $ins_args['orderby'] = 'date';
        }

        $all_posts = new WP_Query($ins_args);

        return $all_posts;
    }

endif;


/**
 * Returns no image url.
 *
 * @since  ChromeNews 1.0.0
 */
if (!function_exists('chromenews_post_format')) :
    function chromenews_post_format($post_id)
    {
        $post_format = get_post_format($post_id);
        switch ($post_format) {
            case "image":
                $post_format = "<div class='af-post-format em-post-format'><i class='fas fa-camera'></i></div>";
                break;
            case "video":
                $post_format = "<div class='af-post-format em-post-format'><i class='fas fa-video'></i></div>";

                break;
            case "gallery":
                $post_format = "<div class='af-post-format em-post-format'><i class='fas fa-photo-video'></i></div>";
                break;
            default:
                $post_format = "";
        }

        echo wp_kses_post($post_format);
    }

endif;


if (!function_exists('chromenews_get_block')) :
    /**
     *
     * @param null
     *
     * @return null
     *
     * @since ChromeNews 1.0.0
     *
     */
    function chromenews_get_block($block = 'grid', $section = 'post')
    {

        get_template_part('inc/hooks/blocks/block-' . $section, $block);
    }
endif;

if (!function_exists('chromenews_archive_title')) :
    /**
     *
     * @param null
     *
     * @return null
     *
     * @since ChromeNews 1.0.0
     *
     */

    function chromenews_archive_title($title)
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
add_filter('get_the_archive_title', 'chromenews_archive_title');


/* Display Breadcrumbs */
if (!function_exists('chromenews_get_breadcrumb')) :

    /**
     * Simple breadcrumb.
     *
     * @since 1.0.0
     */
    function chromenews_get_breadcrumb()
    {

        $enable_breadcrumbs = chromenews_get_option('enable_breadcrumb');

        if (1 != $enable_breadcrumbs) {
            return;
        }
        // Bail if Home Page.
        if (is_front_page() || is_home()) {
            return;
        }

        $select_breadcrumbs = chromenews_get_option('select_breadcrumb_mode');

?>
        <div class="af-breadcrumbs font-family-1 color-pad">

            <?php
            if ((function_exists('yoast_breadcrumb')) && ($select_breadcrumbs == 'yoast')) {
                yoast_breadcrumb();
            } elseif ((function_exists('rank_math_the_breadcrumbs')) && ($select_breadcrumbs == 'rankmath')) {
                rank_math_the_breadcrumbs();
            } elseif ((function_exists('bcn_display')) && ($select_breadcrumbs == 'bcn')) {
                bcn_display();
            } else {
                chromenews_get_breadcrumb_trail();
            }
            ?>

        </div>
    <?php


    }

endif;
add_action('chromenews_action_get_breadcrumb', 'chromenews_get_breadcrumb');

/* Display Breadcrumbs */
if (!function_exists('chromenews_get_breadcrumb_trail')) :

    /**
     * Simple excerpt length.
     *
     * @since 1.0.0
     */

    function chromenews_get_breadcrumb_trail()
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
if (!function_exists('chromenews_front_page_main_section_scope')) {

    function chromenews_front_page_main_section_scope()
    {

        $chromenews_hide_on_blog = chromenews_get_option('disable_main_banner_on_blog_archive');

        if ($chromenews_hide_on_blog) {
            if (is_front_page()) {                
                do_action('chromenews_action_front_page_main_section');
            }
        } else {
            if (is_front_page() || is_home()) {
                do_action('chromenews_action_front_page_main_section');
            }
        }
    }
}
add_action('chromenews_action_front_page_main_section_scope', 'chromenews_front_page_main_section_scope');


/* Display Breadcrumbs */
if (!function_exists('chromenews_excerpt_length')) :

    /**
     * Simple excerpt length.
     *
     * @since 1.0.0
     */

    function chromenews_excerpt_length($length)
    {

        $chromenews_global_excerpt_length = chromenews_get_option('global_excerpt_length');
        if (is_admin()) {
            return $length;
        }
        return $chromenews_global_excerpt_length;
    }

endif;
add_filter('excerpt_length', 'chromenews_excerpt_length', 999);


/* Display Breadcrumbs */
if (!function_exists('chromenews_excerpt_more')) :

    /**
     * Simple excerpt more.
     *
     * @since 1.0.0
     */
    function chromenews_excerpt_more($more)
    {
        if (is_admin()) {
            return $more;
        }
        global $post;
        $chromenews_global_read_more_texts = chromenews_get_option('global_read_more_texts');
        //return $chromenews_global_read_more_texts;
        return '';
    }

endif;
add_filter('excerpt_more', 'chromenews_excerpt_more');


/* Display Breadcrumbs */
if (!function_exists('chromenews_get_the_excerpt')) :

    /**
     * Simple excerpt more.
     *
     * @since 1.0.0
     */
    function chromenews_get_the_excerpt($post_id)
    {


        if (empty($post_id))
            return;

        $chromenews_default_excerpt = get_the_excerpt($post_id);
        $chromenews_global_read_more_texts = chromenews_get_option('global_read_more_texts');

        $chromenews_read_more = '<div class="aft-readmore-wrapper"><a href="' . get_permalink($post_id) . '" class="aft-readmore">' . $chromenews_global_read_more_texts . '</a></div>';

        $chromenews_global_excerpt_length = chromenews_get_option('global_excerpt_length');
        $excerpt = explode(' ', $chromenews_default_excerpt, $chromenews_global_excerpt_length);
        if (count($excerpt) >= $chromenews_global_excerpt_length) {
            array_pop($excerpt);
            $excerpt = implode(" ", $excerpt) . '...';
        } else {
            $excerpt = implode(" ", $excerpt);
        }
        $excerpt = preg_replace('`[[^]]*]`', '', $excerpt);
        $excerpt = $excerpt . $chromenews_read_more;
        return $excerpt;
    }

endif;


/* Display Pagination */
if (!function_exists('chromenews_numeric_pagination')) :

    /**
     * Simple excerpt more.
     *
     * @since 1.0.0
     */
    function chromenews_numeric_pagination()
    {

        the_posts_pagination(array(
            'mid_size' => 3,
            'prev_text' => __('Previous', 'chromenews'),
            'next_text' => __('Next', 'chromenews'),
        ));
    }

endif;


/* Word read count Pagination */
if (!function_exists('chromenews_count_content_words')) :
    /**
     * @param $content
     *
     * @return string
     */
    function chromenews_count_content_words($post_id)
    {
        $chromenews_show_read_mins = chromenews_get_option('global_show_min_read');
        if ($chromenews_show_read_mins == 'yes') {
            $content = apply_filters('the_content', get_post_field('post_content', $post_id));
            $chromenews_read_words = chromenews_get_option('global_show_min_read_number');
            $chromenews_decode_content = html_entity_decode($content);
            $chromenews_filter_shortcode = do_shortcode($chromenews_decode_content);
            $chromenews_strip_tags = wp_strip_all_tags($chromenews_filter_shortcode, true);
            $chromenews_count = str_word_count($chromenews_strip_tags);
            $chromenews_word_per_min = (absint($chromenews_count) / $chromenews_read_words);
            $chromenews_word_per_min = ceil($chromenews_word_per_min);

            if (absint($chromenews_word_per_min) > 0) {
                $word_count_strings = sprintf(__("%s min read", 'chromenews'), number_format_i18n($chromenews_word_per_min));
                if ('post' == get_post_type($post_id)) :
                    echo '<span class="min-read">';
                    echo esc_html($word_count_strings);
                    echo '</span>';
                endif;
            }
        }
    }

endif;


/**
 * Check if given term has child terms
 *
 * @param Integer $term_id
 * @param String $taxonomy
 *
 * @return Boolean
 */
function chromenews_list_popular_taxonomies($taxonomy = 'post_tag', $title = "Popular Tags", $number = 5, $filterby = "popular")
{


    $tags_filerby = (($filterby == 'latest')) ? 'date' : 'count';
    $popular_taxonomies = get_terms(array(
        'taxonomy' => $taxonomy,
        'number' => absint($number),
        'orderby' => $tags_filerby,
        'order' => 'DESC',
        'hide_empty' => true,
    ));

    $html = '';

    if (isset($popular_taxonomies) && !empty($popular_taxonomies)) :
        $html .= '<div class="aft-popular-taxonomies-lists clearfix">';
        if (!empty($title)) :
            $html .= '<strong>';
            $html .= esc_html($title);
            $html .= '</strong>';
        endif;
        $html .= '<ul>';
        foreach ($popular_taxonomies as $tax_term) :
            $html .= '<li>';
            $html .= '<a href="' . esc_url(get_term_link($tax_term)) . '">';
            $html .= $tax_term->name;
            $html .= '</a>';
            $html .= '</li>';
        endforeach;
        $html .= '</ul>';
        $html .= '</div>';
    endif;

    echo wp_kses_post($html);
}


/**
 * @param $post_id
 * @param string $size
 *
 * @return mixed|string
 */
function chromenews_get_freatured_image_url($post_id, $size = 'large')
{
    if (has_post_thumbnail($post_id)) {
        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), $size);
        if (isset($thumb)) {
            $url = $thumb['0'];
        }
    } else {
        $url = '';
    }

    return $url;
}


//Get attachment alt tag

if (!function_exists('chromenews_get_img_alt')) :
    function chromenews_get_img_alt($attachment_ID)
    {
        // Get ALT
        $thumb_alt = get_post_meta($attachment_ID, '_wp_attachment_image_alt', true);

        // No ALT supplied get attachment info
        if (empty($thumb_alt))
            $attachment = get_post($attachment_ID);

        // Use caption if no ALT supplied
        if (empty($thumb_alt))
            $thumb_alt = $attachment->post_excerpt;

        // Use title if no caption supplied either
        if (empty($thumb_alt))
            $thumb_alt = $attachment->post_title;

        // Return ALT
        return trim(strip_tags($thumb_alt));
    }
endif;

// Move Jetpack from the_content / the_excerpt to another position

function chromenews_jptweak_remove_share()
{
    if(is_singular('post')){
        remove_filter('the_content', 'sharing_display', 19);
        remove_filter('the_excerpt', 'sharing_display', 19);
    }  
}

add_action('loop_start', 'chromenews_jptweak_remove_share');


/**
 * @param $post_id
 */
function chromenews_get_comments_views_share($post_id)
{

    $aft_post_type = get_post_type($post_id);

    if ($aft_post_type !== 'post') {
        return;
    }

    ?>
    <span class="aft-comment-view-share">
        <?php
        $show_comment_count = $section_mode = chromenews_get_option('global_show_comment_count');
        if ($show_comment_count == 'yes') :
            $comment_count = get_comments_number($post_id);
            if (absint($comment_count) > 1) :
        ?>
                <span class="aft-comment-count">
                    <a href="<?php the_permalink(); ?>">
                        <i class="far fa-comment"></i>
                        <span class="aft-show-hover">
                            <?php echo wp_kses_post(get_comments_number($post_id)); ?>
                        </span>
                    </a>
                </span>
        <?php endif;
        endif;

        ?>
    </span>
    <?php
}


/**
 * @param $post_id
 */
function chromenews_archive_social_share_icons($post_id)
{
    if (class_exists('Jetpack') && Jetpack::is_module_active('sharedaddy')) :
        if (function_exists('sharing_display')) :
            $sharer = new Sharing_Service();
            $global = $sharer->get_global_options();
            if (in_array('index', $global['show']) && (is_home() || is_front_page() || is_archive() || is_search() || in_array(get_post_type(), $global['show']))) :
    ?>
                <div class="aft-comment-view-share">
                    <span class="aft-jpshare">
                        <i class="fa fa-share-alt" aria-hidden="true"></i>
                        <?php sharing_display('', true); ?>
                    </span>
                </div>
        <?php
            endif;
        endif;
    endif;
}

//Social share icons and comments view for single page

function chromenews_single_post_social_share_icons()
{
    if (class_exists('Jetpack') && Jetpack::is_module_active('sharedaddy')) :

        $social_share_icon_opt = chromenews_get_option('single_post_social_share_view');

        if ($social_share_icon_opt == 'side') {
            echo '<div class="vertical-left-right">';
        }
        ?>
        <div class="aft-social-share">
            <?php
            if (function_exists('sharing_display')) {
                sharing_display('', true);
            }
            ?>

        </div>
    <?php
        if ($social_share_icon_opt == 'side') {
            echo '</div>';
        }
    endif;
}

function chromenews_single_post_commtents_view($post_id)
{
    ?>
    <div class="aft-comment-view-share">
        <?php
        $show_comment_count = $section_mode = chromenews_get_option('global_show_comment_count');
        if ($show_comment_count == 'yes') :
            $comment_count = get_comments_number($post_id);
            if (absint($comment_count) > 1) :
        ?>
                <span class="aft-comment-count">
                    <a href="<?php the_permalink(); ?>">
                        <i class="far fa-comment"></i>
                        <span class="aft-show-hover">
                            <?php echo esc_html(get_comments_number($post_id)); ?>
                        </span>
                    </a>
                </span>
        <?php endif;
        endif;

        ?>
    </div>
<?php
}
