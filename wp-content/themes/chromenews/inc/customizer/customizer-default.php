<?php

/**
 * Default theme options.
 *
 * @package ChromeNews
 */

if (!function_exists('chromenews_get_default_theme_options')) :

    /**
     * Get default theme options
     *
     * @since 1.0.0
     *
     * @return array Default theme options.
     */
    function chromenews_get_default_theme_options()
    {

        $defaults = array();
        // Preloader options section
        $defaults['enable_site_preloader'] = 1;

        // Header options section
        $defaults['header_layout'] = 'header-layout-centered';

        $defaults['show_top_header_section'] = 1;
        $defaults['show_social_menu_section'] = 1;
        $defaults['enable_sticky_header_option'] = 0;

        $defaults['show_date_section'] = 1;
        $defaults['show_time_section'] = 1;
        $defaults['top_header_time_format'] = 'en-US';

        $defaults['global_show_min_read']           = 'yes';
        $defaults['global_show_min_read_number']   = 250;
        $defaults['global_show_categories']           = 'yes';
        $defaults['global_show_home_menu_border']    = 'show-menu-border';
        $defaults['global_site_mode_setting']    = 'aft-light-mode';
        $defaults['header_textcolor_dark_mode']    = '#ffffff';
        $defaults['enable_site_mode_switch']    = 'aft-enable-mode-switch';
        $defaults['continue_switched_site_mode']    = 'aft-only-on-switched-page';
        $defaults['aft_language_switcher']           = '';
        $defaults['show_watch_online_section']           = 1;
        $defaults['aft_custom_icon_preset']           = 'fas fa-bell';
        $defaults['aft_custom_icon']           = 'fas fa-bell';
        $defaults['aft_custom_title']           = __('Subscribe', 'chromenews');
        $defaults['aft_custom_link']           = '';

        $defaults['enable_header_image_tint_overlay'] = 1;
        $defaults['header_image_tint_overlay_percentage'] = 75;
        $defaults['select_header_image_mode'] = 'default';
        $defaults['show_offpanel_menu_section'] = 1;

        $defaults['banner_advertisement_section'] = '';
        $defaults['banner_advertisement_section_url'] = '';
        $defaults['banner_advertisement_open_on_new_tab'] = 1;
        $defaults['banner_advertisement_scope'] = 'site-wide';

        //Popular Tags
        $defaults['frontpage_popular_tags_settings'] = '';
        $defaults['show_popular_tags_section'] = 0;
        $defaults['frontpage_popular_tags_section_title'] = __('Trending', 'chromenews');
        $defaults['number_of_popular_tags'] = 10;
        $defaults['frontpage_popular_tags_section_filterby'] = 'popular';
        $defaults['select_popular_tags_mode'] = 'post_tag';

        //Flash news
        $defaults['frontpage_flash_news_settings'] = '';
        $defaults['show_flash_news_section'] = 1;
        $defaults['flash_news_title'] = __('Breaking News', 'chromenews');
        $defaults['select_flash_news_category'] = 0;
        $defaults['number_of_flash_news'] = 5;

       // breadcrumb options section
        $defaults['enable_breadcrumb'] = 1;
        $defaults['select_breadcrumb_mode'] = 'default';


        // Frontpage Section.
        $defaults['show_main_news_section'] = 1;
        $defaults['select_main_banner_background_color'] = 'background-default';
        $defaults['main_banner_custom_background_color'] = '#0159b7';
        $defaults['main_banner_custom_texts_color'] = '#ffffff';
        $defaults['main_banner_background_section'] = 0;


        $defaults['select_main_banner_layout_section'] = 'layout-aligned';

        $defaults['main_banner_news_section_title'] = __('Main News', 'chromenews');
        $defaults['select_main_banner_order'] = 'order-1';
        $defaults['select_main_banner_order_2'] = 'order-1';
        $defaults['select_main_banner_order_3'] = 'order-1';       

        $defaults['main_trending_news_section_title'] = __('Trending Now', 'chromenews');
        $defaults['select_trending_post_filterby'] = 'cat';
        $defaults['select_trending_post_category'] = 0;
        $defaults['select_trending_post_tag'] = 0;
        $defaults['trending_post_number_of_slides'] = 7;

        $defaults['trending_post_autoplay'] = true;
        $defaults['trending_post_autoplay_speed'] = 9000;

        $defaults['main_popular_news_section_title'] = __('Popular', 'chromenews');;
        $defaults['select_popular_post_filterby'] = 'comment';
        $defaults['select_popular_post_category'] = 0;
        $defaults['select_popular_post_tag'] = 0;

        $defaults['main_latest_news_section_title'] = __('Latest', 'chromenews');
        $defaults['select_banner_latest_post_filterby'] = 'cat';
        $defaults['select_banner_latest_post_category'] = 0;
        $defaults['select_latest_post_tag'] = 0;
        

        $defaults['select_slider_news_category'] = 0;
        $defaults['select_slider_news_tag'] = 0;
        $defaults['select_tab_section_mode'] = 'default';
        $defaults['select_trending_tab_news_category'] = 0;
        $defaults['main_banner_carousel_autoplay'] = true;
        $defaults['main_banner_carousel_autoplay_speed'] = 8000;

        $defaults['select_main_banner_section_mode'] = 'banner-carousel';

        $defaults['select_main_banner_carousel_option'] = 'carousel-layout-default';
        $defaults['select_main_banner_carousel_filterby'] = 'cat';

        $defaults['select_main_banner_carousel_position'] = 'aft-position-1';
        $defaults['select_editors_picks_news_position'] = 'aft-position-2';
        $defaults['select_trending_post_position'] = 'aft-position-3';

        $defaults['main_editors_picks_section_title'] = __("Editor's Picks", 'chromenews');
        $defaults['select_editors_picks_filterby'] = 'cat';
        $defaults['select_editors_picks_news_category'] = 0;
        $defaults['select_editors_picks_news_tag'] = 0;
        $defaults['editors_picks_news_autoplay'] = true;
        $defaults['editors_picks_news_autoplay_speed'] = 12000;

        $defaults['select_main_banner_carousel_layout_option'] = 'square-default';

        
        $defaults['number_of_slides'] = 5;

        $defaults['editors_picks_title'] = __("Editor's Picks", 'chromenews');
        $defaults['select_editors_picks_category'] = 0;

        $defaults['trending_slider_title'] = __("Trending Story", 'chromenews');
        $defaults['select_trending_news_category'] = 0;
        $defaults['number_of_trending_slides'] = 5;

        $defaults['show_featured_posts_section'] = 1;
        $defaults['featured_news_section_title'] = __('Featured Posts', 'chromenews');
        $defaults['number_of_featured_news'] = 6;
        //$defaults['select_featured_post'] = 0;

        
        $defaults['select_featured_news_category'] = 0;       

        $defaults['frontpage_content_alignment'] = 'align-content-left';
        $defaults['frontpage_sticky_sidebar'] = 1;
        $defaults['frontpage_sticky_sidebar_position'] = 'sidebar-sticky-top';

        //layout options
        $defaults['global_content_layout'] = 'default-content-layout';
        $defaults['global_content_alignment'] = 'align-content-left';
        $defaults['global_image_alignment'] = 'full-width-image';
        $defaults['global_post_date_author_setting'] = 'show-date-author';
        $defaults['small_grid_post_date_author_setting'] = 'show-date-only';
        $defaults['list_post_date_author_setting'] = 'show-date-only';
        $defaults['global_author_icon_gravatar_display_setting'] = 'display-icon';

        $defaults['global_excerpt_length'] = 15;
        $defaults['global_read_more_texts'] = __('Read More', 'chromenews');
        $defaults['global_widget_excerpt_setting'] = 'default-excerpt';
        $defaults['global_date_display_type'] = 'published';
        $defaults['global_date_display_setting'] = 'default-date';

        $defaults['archive_layout'] = 'archive-layout-list';
        $defaults['archive_layout_first_post_full'] = 0;
        $defaults['archive_pagination_view'] = 'archive-default';
        $defaults['archive_image_alignment_grid'] = 'archive-image-default';

        //grid column optoon
        $defaults['archive_grid_column_layout'] = 'grid-layout-two';
        $defaults['archive_image_alignment'] = 'archive-image-left';        

        $defaults['archive_content_view'] = 'archive-content-excerpt';
        $defaults['disable_main_banner_on_blog_archive'] = 1;

        //Related posts
        $defaults['single_show_featured_image'] = 1;
        $defaults['global_single_content_mode'] = 'single-content-mode-boxed';        
        $defaults['single_post_title_view']     = 'boxed';

        $defaults['single_post_social_share_view']     = 'after-title-default';
        $defaults['single_post_view_count']     = 'each-load-default';

        

        //Related posts
        $defaults['single_show_related_posts'] = 1;
        $defaults['single_related_posts_title']     = __('Related News', 'chromenews');
        $defaults['single_number_of_related_posts']  = 2;

        //Pagination.
        $defaults['site_pagination_type'] = 'default';

       

        // Footer.
        // Latest posts
        $defaults['frontpage_show_latest_posts'] = 1;
        $defaults['frontpage_latest_posts_section_title'] = __('You may have missed', 'chromenews');
        $defaults['frontpage_latest_posts_category'] = 0;
        $defaults['number_of_frontpage_latest_posts'] = 6;

        $defaults['footer_copyright_text'] = esc_html__('Copyright &copy; All rights reserved.', 'chromenews');
        $defaults['hide_footer_menu_section']  = 0;        
        $defaults['hide_footer_copyright_credits']  = 0;
        $defaults['number_of_footer_widget']  = 3;        
        $defaults['footer_background_image'] = 0;
        

        // font and color options
        
        $defaults['secondary_color']     = '#FFC934 ';
        $defaults['dark_background_color']     = '#000000'; 
        $defaults['text_over_secondary_color']    = '#000000';
        $defaults['main_navigation_background_color_mode']     = 'secondary-color';
        $defaults['main_navigation_link_color']     = '#ffffff';
        $defaults['main_navigation_custom_background_color']     = '#003bb3';


        //font options additional value
        global $chromenews_google_fonts;
        $chromenews_google_fonts = array(

            'Jost:200,300,400,500,600,700,900'          => 'Jost',
            'Lato:400,300,400italic,900,700'            => 'Lato',
            'Lora:400,400italic,700,700italic'          => 'Lora',
            'Montserrat:400,700'                        => 'Montserrat',
            'Noto+Sans:400,400italic,700'               => 'Noto Sans',
            'Noto+Sans+Arabic:400,700'                  => 'Noto Sans Arabic',                   
            'Noto+Serif:400,400italic,700'              => 'Noto Serif',
            'Noto+Serif+JP:400,400italic,700'           => 'Noto Serif JP',
            'Noto+Serif+SC:400,400italic,700'           => 'Noto Serif SC',        
            'Noto+Serif+KR:400,400italic,700'           => 'Noto Serif KR',
            'Open+Sans:400,400italic,600,700'           => 'Open Sans',
            'Oswald:300,400,700'                        => 'Oswald',
            'Playfair+Display:400,400italic,700,900'    => 'Playfair Display',
            'Poppins:300,400,500,600,700'               => 'Poppins',
            'Raleway:400,300,500,600,700,900'           => 'Raleway',
            'Roboto:100,300,400,500,700'                => 'Roboto',
        );

        //font option

        $defaults['site_title_font']      = 'Jost:200,300,400,500,600,700,900';
        $defaults['primary_font']      = 'Noto+Serif:400,400italic,700';
        $defaults['secondary_font']    = 'Jost:200,300,400,500,600,700,900';
        

        $defaults['global_widget_title_border']       = 'widget-title-border-bottom';
        $defaults['global_scroll_to_top_position']    = 'right';
       
        $defaults['global_show_comment_count']        = 'yes';
        $defaults['global_show_view_count']           = 'yes';
        $defaults['global_show_primary_menu_border']  = 'show-menu-border';

        $defaults['global_show_categories']           = 'yes';
        $defaults['global_number_of_categories']        = 'all';
        $defaults['global_custom_number_of_categories']  = 3;

        $defaults['global_site_layout_setting']    = 'wide';
        $defaults['global_section_layout_setting']    = 'background';
        $defaults['global_site_layout_topbottom_gaps']    = true;

        $defaults['site_title_uppercase']    = true;

        //font size
        $defaults['site_title_font_size']    = 72;
        $defaults['title_font_weight']    = 700;        
        $defaults['chromenews_section_title_font_size']    = 24;


        // Pass through filter.
        $defaults = apply_filters('chromenews_filter_default_theme_options', $defaults);

        return $defaults;
    }

endif;
