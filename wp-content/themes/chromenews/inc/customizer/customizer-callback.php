<?php

/**
 * Customizer callback functions for active_callback.
 *
 * @package ChromeNews
 */

/*select page for slider*/
if (!function_exists('chromenews_frontpage_content_status')) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function chromenews_frontpage_content_status($control)
    {

        if ('page' == $control->manager->get_setting('show_on_front')->value()) {
            return true;
        } else {
            return false;
        }
    }

endif;



/*select page for chromenews_enable_header_image_tint_overlay_status news*/
if (!function_exists('chromenews_enable_header_image_tint_overlay_status')) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function chromenews_enable_header_image_tint_overlay_status($control)
    {

        if (true == $control->manager->get_setting('enable_header_image_tint_overlay')->value()) {
            return true;
        } else {
            return false;
        }
    }

endif;

/*select page for chromenews_show_date_on_header news*/
if (!function_exists('chromenews_top_header_status')) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function chromenews_top_header_status($control)
    {

        if (true == $control->manager->get_setting('show_top_header_section')->value()) {
            return true;
        } else {
            return false;
        }
    }

endif;

/*select page for chromenews_show_date_on_header news*/
if (!function_exists('chromenews_show_time_status')) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function chromenews_show_time_status($control)
    {

        if (true == $control->manager->get_setting('show_time_section')->value()) {
            return true;
        } else {
            return false;
        }
    }

endif;




/*select page for trending news*/
if (!function_exists('chromenews_popular_tags_section_status')) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function chromenews_popular_tags_section_status($control)
    {

        if (true == $control->manager->get_setting('show_popular_tags_section')->value()) {
            return true;
        } else {
            return false;
        }
    }

endif;


/*select page for trending news*/
if (!function_exists('chromenews_flash_posts_section_status')) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function chromenews_flash_posts_section_status($control)
    {

        if (true == $control->manager->get_setting('show_flash_news_section')->value()) {
            return true;
        } else {
            return false;
        }
    }

endif;




/*select page for slider*/
if (!function_exists('chromenews_global_site_mode_dark_status')) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function chromenews_global_site_mode_dark_status($control)
    {

        if (('aft-dark-mode' == $control->manager->get_setting('global_site_mode_setting')->value())) {
            return true;
        } else {
            return false;
        }
    }

endif;



/*select page for slider*/
if (!function_exists('chromenews_main_banner_section_status')) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function chromenews_main_banner_section_status($control)
    {

        if (true == $control->manager->get_setting('show_main_news_section')->value()) {
            return true;
        } else {
            return false;
        }
    }

endif;



/*select page for slider*/
if (!function_exists('chromenews_main_banner_section_filterby_cat_status')) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function chromenews_main_banner_section_filterby_cat_status($control)
    {

        if ('cat' == $control->manager->get_setting('select_main_banner_carousel_filterby')->value()) {
            return true;
        } else {
            return false;
        }
    }

endif;



/*select page for slider*/
if (!function_exists('chromenews_main_banner_section_filterby_tag_status')) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function chromenews_main_banner_section_filterby_tag_status($control)
    {

        if ('tag' == $control->manager->get_setting('select_main_banner_carousel_filterby')->value()) {
            return true;
        } else {
            return false;
        }
    }

endif;


/*select page for slider*/
if (!function_exists('chromenews_editors_picks_section_filterby_cat_status')) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function chromenews_editors_picks_section_filterby_cat_status($control)
    {

        if ('cat' == $control->manager->get_setting('select_editors_picks_filterby')->value()) {
            return true;
        } else {
            return false;
        }
    }

endif;


/*select page for slider*/
if (!function_exists('chromenews_editors_picks_section_filterby_tag_status')) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function chromenews_editors_picks_section_filterby_tag_status($control)
    {

        if ('tag' == $control->manager->get_setting('select_editors_picks_filterby')->value()) {
            return true;
        } else {
            return false;
        }
    }

endif;


if (!function_exists('chromenews_editors_picks_section_autoplay_status')) :
        
    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function chromenews_editors_picks_section_autoplay_status($control)
    {

        if (
            
            ('layout-aligned' == $control->manager->get_setting('select_main_banner_layout_section')->value() )
            ) {
            return true;
        } else {
            return false;
        }
        
    }

endif;

/*select page for slider*/
if (!function_exists('chromenews_trending_post_section_filterby_cat_status')) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function chromenews_trending_post_section_filterby_cat_status($control)
    {

        if ('cat' == $control->manager->get_setting('select_trending_post_filterby')->value()) {
            return true;
        } else {
            return false;
        }
    }

endif;


/*select page for slider*/
if (!function_exists('chromenews_trending_post_section_filterby_tag_status')) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function chromenews_trending_post_section_filterby_tag_status($control)
    {

        if ('tag' == $control->manager->get_setting('select_trending_post_filterby')->value()) {
            return true;
        } else {
            return false;
        }
    }

endif;




/*select page for slider*/
if (!function_exists('chromenews_show_watch_online_section_status')) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function chromenews_show_watch_online_section_status($control)
    {

        if (true == $control->manager->get_setting('show_watch_online_section')->value()) {
            return true;
        } else {
            return false;
        }
    }

endif;





/*select post*/
if (!function_exists('chromenews_featured_posts_section')) :

    /**
     * Check if ticker section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function chromenews_featured_posts_section($control)
    {

        if (true == $control->manager->get_setting('show_featured_posts_section')->value()) {
            return true;
        } else {
            return false;
        }
    }

endif;




/*select page for slider*/
if (!function_exists('chromenews_display_author_status')) :

    /**
     * Check if ticker section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function chromenews_display_author_status($control)
    {

        if (('show-date-author' == $control->manager->get_setting('global_post_date_author_setting')->value()) || ('show-author-only' == $control->manager->get_setting('global_post_date_author_setting')->value())) {
            return true;
        } else {
            return false;
        }
    }

endif;


/*select page for slider*/
if (!function_exists('chromenews_display_date_status')) :

    /**
     * Check if ticker section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function chromenews_display_date_status($control)
    {

        if (('show-date-author' == $control->manager->get_setting('global_post_date_author_setting')->value()) || ('show-date-only' == $control->manager->get_setting('global_post_date_author_setting')->value())) {
            return true;
        } else {
            return false;
        }
    }

endif;



/*select page for slider*/
if (!function_exists('chromenews_frontpage_sticky_sidebar_status')) :

    /**
     * Check if ticker section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function chromenews_frontpage_sticky_sidebar_status($control)
    {

        if (true == $control->manager->get_setting('frontpage_sticky_sidebar')->value()) {
            return true;
        } else {
            return false;
        }
    }

endif;


/*select page for slider*/
if (!function_exists('chromenews_latest_news_section_status')) :

    /**
     * Check if ticker section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function chromenews_latest_news_section_status($control)
    {

        if (true == $control->manager->get_setting('frontpage_show_latest_posts')->value()) {
            return true;
        } else {
            return false;
        }
    }

endif;


/*featured image posts*/
if (!function_exists('chromenews_featured_image_posts_status')) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function chromenews_featured_image_posts_status($control)
    {

        if (true == $control->manager->get_setting('single_show_featured_image')->value()) {
            return true;
        } else {
            return false;
        }
    }

endif;


/*related posts*/
if (!function_exists('chromenews_related_posts_status')) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function chromenews_related_posts_status($control)
    {

        if (true == $control->manager->get_setting('single_show_related_posts')->value()) {
            return true;
        } else {
            return false;
        }
    }

endif;


if (!function_exists('chromenews_main_banner_layout_tabs_status')) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function chromenews_main_banner_layout_tabs_status($control)
    {

        if (
            'layout-tabbed' == $control->manager->get_setting('select_main_banner_layout_section')->value()
            ) {
            return true;
        } else {
            return false;
        }

    }

endif;


if (!function_exists('chromenews_main_banner_layout_trending_status')) :
        
    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function chromenews_main_banner_layout_trending_status($control)
    {

        if (
            
            ('layout-aligned' == $control->manager->get_setting('select_main_banner_layout_section')->value()) ||            
            ('layout-tiled-2' == $control->manager->get_setting('select_main_banner_layout_section')->value()) ||            
            ('layout-vertical' == $control->manager->get_setting('select_main_banner_layout_section')->value())
            ) {
            return true;
        } else {
            return false;
        }
        
    }

endif;


/*select page for slider*/
if (!function_exists('chromenews_banner_latest_post_section_filterby_cat_status')) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function chromenews_banner_latest_post_section_filterby_cat_status($control)
    {

        if ('cat' == $control->manager->get_setting('select_banner_latest_post_filterby')->value()) {
            return true;
        } else {
            return false;
        }

    }

endif;


/*select page for slider*/
if (!function_exists('chromenews_banner_latest_post_section_filterby_tag_status')) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function chromenews_banner_latest_post_section_filterby_tag_status($control)
    {

        if ('tag' == $control->manager->get_setting('select_banner_latest_post_filterby')->value()) {
            return true;
        } else {
            return false;
        }

    }

endif;



/*select page for slider*/
if (!function_exists('chromenews_popular_post_section_filterby_cat_status')) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function chromenews_popular_post_section_filterby_cat_status($control)
    {

        if ('cat' == $control->manager->get_setting('select_popular_post_filterby')->value()) {
            return true;
        } else {
            return false;
        }

    }

endif;


/*select page for slider*/
if (!function_exists('chromenews_popular_post_section_filterby_tag_status')) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function chromenews_popular_post_section_filterby_tag_status($control)
    {

        if ('tag' == $control->manager->get_setting('select_popular_post_filterby')->value()) {
            return true;
        } else {
            return false;
        }

    }

endif;