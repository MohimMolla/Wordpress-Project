<?php

/**
 * Option Panel
 *
 * @package ChromeNews
 */

$chromenews_default = chromenews_get_default_theme_options();
/*theme option panel info*/
require get_template_directory() . '/inc/customizer/frontpage-options.php';

//font and color options
require get_template_directory() . '/inc/customizer/font-color-options.php';


/**
 * Frontpage options section
 *
 * @package ChromeNews
 */


// Add Frontpage Options Panel.
$wp_customize->add_panel('site_header_option_panel',
    array(
        'title' => esc_html__('Header Options', 'chromenews'),
        'priority' => 29,
        'capability' => 'edit_theme_options',
    )
);

/**
 * Header section
 *
 * @package ChromeNews
 */

// Frontpage Section.
$wp_customize->add_section('header_options_settings',
    array(
        'title' => esc_html__('Header Settings', 'chromenews'),
        'priority' => 49,
        'capability' => 'edit_theme_options',
        'panel' => 'site_header_option_panel',
    )
);

// Setting - global content alignment of news.
$wp_customize->add_setting(
    'enable_site_mode_switch',
    array(
        'default' => $chromenews_default['enable_site_mode_switch'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_select',
    )
);

$wp_customize->add_control(
    'enable_site_mode_switch',
    array(
        'label' => esc_html__('Site Mode Switch', 'chromenews'),
        'section' => 'header_options_settings',
        'type' => 'select',
        'choices' => array(
            'aft-enable-mode-switch' => esc_html__('Enable', 'chromenews'),
            'aft-disable-mode-switch' => esc_html__('Disable', 'chromenews'),
        ),
        'priority' => 5,
    )
);



//section title
$wp_customize->add_setting('show_top_header_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new ChromeNews_Section_Title(
        $wp_customize,
        'show_top_header_section_title',
        array(
            'label' => esc_html__("Top Header Section", 'chromenews'),
            'section' => 'header_options_settings',
            'priority' => 10,

        )
    )
);


// Setting - show_site_title_section.
$wp_customize->add_setting('show_top_header_section',
    array(
        'default' => $chromenews_default['show_top_header_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_checkbox',
    )
);

$wp_customize->add_control('show_top_header_section',
    array(
        'label' => esc_html__('Show Top Header', 'chromenews'),
        'section' => 'header_options_settings',
        'type' => 'checkbox',
        'priority' => 10,
        //'active_callback' => 'chromenews_top_header_status'
    )
);

// Setting - show_site_title_section.
$wp_customize->add_setting('show_social_menu_section',
    array(
        'default' => $chromenews_default['show_social_menu_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_checkbox',
    )
);

$wp_customize->add_control('show_social_menu_section',
    array(
        'label' => esc_html__('Show Social Menu', 'chromenews'),
        'section' => 'header_options_settings',
        'type' => 'checkbox',
        'priority' => 10,
        'active_callback' => 'chromenews_top_header_status'
    )
);


// Setting - show_site_title_section.
$wp_customize->add_setting('show_date_section',
    array(
        'default' => $chromenews_default['show_date_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_checkbox',
    )
);
$wp_customize->add_control('show_date_section',
    array(
        'label' => esc_html__('Show Date', 'chromenews'),
        'section' => 'header_options_settings',
        'type' => 'checkbox',
        'priority' => 10,
        'active_callback' => 'chromenews_top_header_status'
    )
);

// Setting - show_site_title_section.
$wp_customize->add_setting(
    'show_time_section',
    array(
        'default' => $chromenews_default['show_time_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'show_time_section',
    array(
        'label' => esc_html__('Show Time', 'chromenews'),
        'section' => 'header_options_settings',
        'type' => 'checkbox',
        'priority' => 10,
        'active_callback' => 'chromenews_top_header_status'
    )
);

// Setting - select_main_banner_section_mode.
$wp_customize->add_setting(
    'top_header_time_format',
    array(
        'default' => $chromenews_default['top_header_time_format'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_select',
    )
);

$wp_customize->add_control(
    'top_header_time_format',
    array(
        'label' => esc_html__('Time Format', 'chromenews'),        
        'section' => 'header_options_settings',
        'type' => 'select',
        'choices' => array(
            'en-US' => esc_html__('12 hours', 'chromenews'),
            'en-GB' => esc_html__('24 hours', 'chromenews'),
            'en-WP' => esc_html__('From WordPress Settings', 'chromenews'),
        ),
        'priority' => 10,
        'active_callback' => function ($control) {
            return (
                chromenews_top_header_status($control)
                &&
                chromenews_show_time_status($control)               

            );
        },

    )
);



// Advertisement Section.
$wp_customize->add_section('frontpage_advertisement_settings',
    array(
        'title' => esc_html__('Header Advertisement', 'chromenews'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'site_header_option_panel',
    )
);


// Setting banner_advertisement_section.
$wp_customize->add_setting('banner_advertisement_section',
    array(
        'default' => $chromenews_default['banner_advertisement_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(
    new WP_Customize_Cropped_Image_Control($wp_customize, 'banner_advertisement_section',
        array(
            'label' => esc_html__('Header Section Advertisement', 'chromenews'),
            'description' => sprintf(esc_html__('Recommended Size %1$s px X %2$s px', 'chromenews'), 930, 110),
            'section' => 'frontpage_advertisement_settings',
            'width' => 930,
            'height' => 110,
            'flex_width' => true,
            'flex_height' => true,
            'priority' => 120,
        )
    )
);

/*banner_advertisement_section_url*/
$wp_customize->add_setting('banner_advertisement_section_url',
    array(
        'default' => $chromenews_default['banner_advertisement_section_url'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control('banner_advertisement_section_url',
    array(
        'label' => esc_html__('URL Link', 'chromenews'),
        'section' => 'frontpage_advertisement_settings',
        'type' => 'text',
        'priority' => 130,
    )
);

// Add Theme Options Panel.
$wp_customize->add_panel('theme_option_panel',
    array(
        'title' => esc_html__('Theme Options', 'chromenews'),
        'priority' => 30,
        'capability' => 'edit_theme_options',
    )
);





// Breadcrumb Section.
$wp_customize->add_section('site_breadcrumb_settings',
    array(
        'title' => esc_html__('Breadcrumb Options', 'chromenews'),
        'priority' => 10,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);


// Setting - breadcrumb.
$wp_customize->add_setting('enable_breadcrumb',
    array(
        'default' => $chromenews_default['enable_breadcrumb'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_checkbox',
    )
);

$wp_customize->add_control('enable_breadcrumb',
    array(
        'label' => esc_html__('Show breadcrumbs', 'chromenews'),
        'section' => 'site_breadcrumb_settings',
        'type' => 'checkbox',
        'priority' => 10,
    )
);

// Setting - global content alignment of news.
$wp_customize->add_setting('select_breadcrumb_mode',
    array(
        'default' => $default['select_breadcrumb_mode'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_select',
    )
);

$wp_customize->add_control('select_breadcrumb_mode',
    array(
        'label' => esc_html__('Select Breadcrumbs', 'chromenews'),
        'description' => esc_html__("Please ensure that you have enabled the plugin's breadcrumbs before choosing other than Default", 'chromenews'),
        'section' => 'site_breadcrumb_settings',
        'type' => 'select',
        'choices' => array(
            'default' => esc_html__('Default', 'chromenews'),
            'yoast' => esc_html__('Yoast SEO', 'chromenews'),
            'rankmath' => esc_html__('Rank Math', 'chromenews'),
            'bcn' => esc_html__('NavXT', 'chromenews'),
        ),
        'priority' => 100,
    ));




/**
 * Layout options section
 *
 * @package ChromeNews
 */

// Layout Section.
$wp_customize->add_section('site_layout_settings',
    array(
        'title' => esc_html__('Global Settings', 'chromenews'),
        'priority' => 9,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);


// Setting - preloader.
$wp_customize->add_setting('enable_site_preloader',
    array(
        'default' => $chromenews_default['enable_site_preloader'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_checkbox',
    )
);

$wp_customize->add_control('enable_site_preloader',
    array(
        'label' => esc_html__('Enable Preloader', 'chromenews'),
        'section' => 'site_layout_settings',
        'type' => 'checkbox',
        'priority' => 10,
    )
);


// Setting - global content alignment of news.
$wp_customize->add_setting('global_content_alignment',
    array(
        'default' => $chromenews_default['global_content_alignment'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_select',
    )
);

$wp_customize->add_control('global_content_alignment',
    array(
        'label' => esc_html__('Global Content Alignment', 'chromenews'),
        'section' => 'site_layout_settings',
        'type' => 'select',
        'choices' => array(
            'align-content-left' => esc_html__('Content - Primary sidebar', 'chromenews'),
            'align-content-right' => esc_html__('Primary sidebar - Content', 'chromenews'),
            'full-width-content' => esc_html__('Full width content', 'chromenews')
        ),
        'priority' => 130,
    ));






// Global Section.
$wp_customize->add_section('site_categories_settings',
    array(
        'title' => esc_html__('Categories Settings', 'chromenews'),
        'priority' => 10,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);

// Setting - global content alignment of news.
$wp_customize->add_setting('global_show_categories',
    array(
        'default' => $chromenews_default['global_show_categories'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_select',
    )
);

$wp_customize->add_control('global_show_categories',
    array(
        'label' => esc_html__('Post Categories', 'chromenews'),
        'section' => 'site_categories_settings',
        'type' => 'select',
        'choices' => array(
            'yes' => esc_html__('Show', 'chromenews'),
            'no' => esc_html__('Hide', 'chromenews'),

        ),
        'priority' => 130,
    ));




// Global Section.
$wp_customize->add_section('site_author_and_date_settings',
    array(
        'title' => esc_html__('Author and Date Settings', 'chromenews'),
        'priority' => 9,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);


// Setting - global content alignment of news.
$wp_customize->add_setting('global_post_date_author_setting',
    array(
        'default' => $chromenews_default['global_post_date_author_setting'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_select',
    )
);

$wp_customize->add_control('global_post_date_author_setting',
    array(
        'label' => esc_html__('For Spotlight Posts', 'chromenews'),
        'section' => 'site_author_and_date_settings',
        'type' => 'select',
        'choices' => array(
            'show-date-author' => esc_html__('Show Date and Author', 'chromenews'),
            'show-date-only' => esc_html__('Show Date Only', 'chromenews'),            
            'hide-date-author' => esc_html__('Hide All', 'chromenews'),
        ),
        'priority' => 130,
    ));


// Setting - global content alignment of news.
$wp_customize->add_setting('small_grid_post_date_author_setting',
    array(
        'default' => $chromenews_default['small_grid_post_date_author_setting'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_select',
    )
);

$wp_customize->add_control('small_grid_post_date_author_setting',
    array(
        'label' => esc_html__('For Small Grid', 'chromenews'),
        'section' => 'site_author_and_date_settings',
        'type' => 'select',
        'choices' => array(            
            'show-date-only' => esc_html__('Show Date', 'chromenews'),            
            'hide-date-author' => esc_html__('Hide All', 'chromenews'),
        ),
        'priority' => 130,
    ));

// Setting - global content alignment of news.
$wp_customize->add_setting('list_post_date_author_setting',
    array(
        'default' => $chromenews_default['list_post_date_author_setting'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_select',
    )
);

$wp_customize->add_control('list_post_date_author_setting',
    array(
        'label' => esc_html__('For List', 'chromenews'),
        'section' => 'site_author_and_date_settings',
        'type' => 'select',
        'choices' => array(            
            'show-date-only' => esc_html__('Show Date', 'chromenews'),            
            'hide-date-author' => esc_html__('Hide All', 'chromenews'),
        ),
        'priority' => 130,
    ));

// Setting - global content alignment of news.
$wp_customize->add_setting('global_author_icon_gravatar_display_setting',
    array(
        'default' => $chromenews_default['global_author_icon_gravatar_display_setting'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_select',
    )
);

$wp_customize->add_control('global_author_icon_gravatar_display_setting',
    array(
        'label' => esc_html__('Author Icon/Gravatar', 'chromenews'),
        'section' => 'site_author_and_date_settings',
        'type' => 'select',
        'choices' => array(
            'display-gravatar' => esc_html__('Show Gravatar', 'chromenews'),
            'display-icon' => esc_html__('Show Icon', 'chromenews'),
            'display-none' => esc_html__('None', 'chromenews'),
        ),
        'priority' => 130,
        'active_callback' => 'chromenews_display_author_status'
    ));

    // Setting - global content alignment of news.
$wp_customize->add_setting(
    'global_date_display_type',
    array(
        'default' => $chromenews_default['global_date_display_type'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_select',
    )
);

$wp_customize->add_control(
    'global_date_display_type',
    array(
        'label' => esc_html__('Post Date Type', 'chromenews'),
        'section' => 'site_author_and_date_settings',
        'type' => 'select',
        'choices' => array(
            'published' => esc_html__('Published Date', 'chromenews'),
            'modified' => esc_html__('Modified Date', 'chromenews'),          


        ),
        'priority' => 130,
        'active_callback' => 'chromenews_display_date_status'
    )
);

// Setting - global content alignment of news.
$wp_customize->add_setting('global_date_display_setting',
    array(
        'default' => $chromenews_default['global_date_display_setting'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_select',
    )
);

$wp_customize->add_control('global_date_display_setting',
    array(
        'label' => esc_html__('Date Format', 'chromenews'),
        'section' => 'site_author_and_date_settings',
        'type' => 'select',
        'choices' => array(
            'default-date' => esc_html__('WordPress Default Date Format', 'chromenews'),
            'theme-date' => esc_html__('Ago Date Format', 'chromenews'),            


        ),
        'priority' => 130,
        'active_callback' => 'chromenews_display_date_status'
    ));


//========== minutes read count options ===============

// Global Section.
$wp_customize->add_section('site_min_read_settings',
    array(
        'title' => esc_html__('Minutes Read Count', 'chromenews'),
        'priority' => 9,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);


// Setting - global content alignment of news.
$wp_customize->add_setting('global_show_min_read',
    array(
        'default' => $chromenews_default['global_show_min_read'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_select',
    )
);

$wp_customize->add_control('global_show_min_read',
    array(
        'label' => esc_html__('Minutes Read Count', 'chromenews'),
        'section' => 'site_min_read_settings',
        'type' => 'select',
        'choices' => array(
            'yes' => esc_html__('Show', 'chromenews'),
            'no' => esc_html__('Hide', 'chromenews'),

        ),
        'priority' => 130,
    ));




// Global Section.
$wp_customize->add_section('site_excerpt_settings',
    array(
        'title' => esc_html__('Excerpt Settings', 'chromenews'),
        'priority' => 10,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);


// Setting - related posts.
$wp_customize->add_setting('global_read_more_texts',
    array(
        'default' => $chromenews_default['global_read_more_texts'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control('global_read_more_texts',
    array(
        'label' => __('Global Excerpt Read More', 'chromenews'),
        'section' => 'site_excerpt_settings',
        'type' => 'text',
        'priority' => 130,

    )
);


//============= Watch Online Section ==========
//section title
$wp_customize->add_setting('show_watch_online_section_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new ChromeNews_Section_Title(
        $wp_customize,
        'show_watch_online_section_section_title',
        array(
            'label' => esc_html__("Custom Menu Section", 'chromenews'),
            'section' => 'header_options_settings',
            'priority' => 100,

        )
    )
);

$wp_customize->add_setting('show_watch_online_section',
    array(
        'default' => $chromenews_default['show_watch_online_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_checkbox',
    )
);

$wp_customize->add_control('show_watch_online_section',
    array(
        'label' => esc_html__('Enable Custom Menu Section', 'chromenews'),
        'section' => 'header_options_settings',
        'type' => 'checkbox',
        'priority' => 100,

    )
);

$wp_customize->add_setting('aft_custom_icon_preset',
    array(
        'default' => $chromenews_default['aft_custom_icon_preset'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_select',
    )
);

$wp_customize->add_control('aft_custom_icon_preset',
    array(
        'label' => esc_html__('Icon', 'chromenews'),
        'section' => 'header_options_settings',
        'type' => 'select',
        'choices' => array(
            'fas fa-bell' => esc_html__('Bell', 'chromenews'),
            'fas fa-play' => esc_html__('Play', 'chromenews'),
            'fas fa-user' => esc_html__('User', 'chromenews'),            
        ),
        'priority' => 100,
        'active_callback' => 'chromenews_show_watch_online_section_status'
    ));



// Setting - related posts.
$wp_customize->add_setting('aft_custom_title',
    array(
        'default' => $chromenews_default['aft_custom_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control('aft_custom_title',
    array(
        'label' => __('Title', 'chromenews'),
        'section' => 'header_options_settings',
        'type' => 'text',
        'priority' => 100,
        'active_callback' => 'chromenews_show_watch_online_section_status'
    )
);

// Setting - related posts.
$wp_customize->add_setting('aft_custom_link',
    array(
        'default' => $chromenews_default['aft_custom_link'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    )
);

$wp_customize->add_control('aft_custom_link',
    array(
        'label' => __('Link', 'chromenews'),
        'section' => 'header_options_settings',
        'type' => 'text',
        'priority' => 100,
        'active_callback' => 'chromenews_show_watch_online_section_status'
    )
);


//========== single posts options ===============

// Single Section.
$wp_customize->add_section('site_single_posts_settings',
    array(
        'title' => esc_html__('Single Post', 'chromenews'),
        'priority' => 10,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);

// Setting - related posts.
$wp_customize->add_setting('single_show_featured_image',
    array(
        'default' => $chromenews_default['single_show_featured_image'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_checkbox',
    )
);

$wp_customize->add_control('single_show_featured_image',
    array(
        'label' => __('Show Featured Image', 'chromenews'),
        'section' => 'site_single_posts_settings',
        'type' => 'checkbox',
        'priority' => 100,
    )
);


$wp_customize->add_setting('single_post_title_view',
    array(
        'default' => $chromenews_default['single_post_title_view'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_select',
    )
);

$wp_customize->add_control('single_post_title_view',
    array(
        'label' => esc_html__('Featured Image Position', 'chromenews'),
        'section' => 'site_single_posts_settings',
        'type' => 'select',
        'choices' => array(
            'boxed' => esc_html__('Default', 'chromenews'),
            'title-below-image' => esc_html__('Title below image', 'chromenews'),
            
            
        ),
        'priority' => 100,
        'active_callback' => 'chromenews_featured_image_posts_status'
    ));


// Setting - global content alignment of news.
$wp_customize->add_setting('global_single_content_mode',
    array(
        'default'           => $default['global_single_content_mode'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_select',
    )
);

$wp_customize->add_control( 'global_single_content_mode',
    array(
        'label'       => esc_html__('Single Content', 'chromenews'),
        'section'     => 'site_single_posts_settings',
        'type'        => 'select',
        'choices'               => array(
            'single-content-mode-boxed' => esc_html__( 'Spacious', 'chromenews' ),
            'single-content-mode-compact' => esc_html__( 'Compact', 'chromenews' ),
        ),
        'priority'    => 100,
    ));





//Social share option

if (class_exists('Jetpack') && Jetpack::is_module_active('sharedaddy')):
    $wp_customize->add_setting('single_post_social_share_view',
        array(
            'default' => $chromenews_default['single_post_social_share_view'],
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'chromenews_sanitize_select',
        )
    );

    $wp_customize->add_control('single_post_social_share_view',
        array(
            'label' => esc_html__('Social Share Option', 'chromenews'),
            'description' => esc_html__('Social Share from Jetpack plugin', 'chromenews'),
            'section' => 'site_single_posts_settings',
            'type' => 'select',
            'choices' => array(
                'after-title-default' => esc_html__('After Title', 'chromenews'),
                'before-title' => esc_html__('Before Title', 'chromenews'),
                'after-content' => esc_html__('After Content', 'chromenews'),
            ),
            'priority' => 100,
        ));
endif;



//========== related posts  options ===============

$wp_customize->add_setting('single_related_posts_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new ChromeNews_Section_Title(
        $wp_customize,
        'single_related_posts_section_title',
        array(
            'label' => esc_html__("Related Posts Settings", 'chromenews'),
            'section' => 'site_single_posts_settings',
            'priority' => 100,

        )
    )
);

// Setting - related posts.
$wp_customize->add_setting('single_show_related_posts',
    array(
        'default' => $chromenews_default['single_show_related_posts'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_checkbox',
    )
);

$wp_customize->add_control('single_show_related_posts',
    array(
        'label' => __('Enable Related Posts', 'chromenews'),
        'section' => 'site_single_posts_settings',
        'type' => 'checkbox',
        'priority' => 100,
    )
);

// Setting - related posts.
$wp_customize->add_setting('single_related_posts_title',
    array(
        'default' => $chromenews_default['single_related_posts_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control('single_related_posts_title',
    array(
        'label' => __('Title', 'chromenews'),
        'section' => 'site_single_posts_settings',
        'type' => 'text',
        'priority' => 100,
        'active_callback' => 'chromenews_related_posts_status'
    )
);





/**
 * Archive options section
 *
 * @package ChromeNews
 */

// Archive Section.
$wp_customize->add_section('site_archive_settings',
    array(
        'title' => esc_html__('Archive Settings', 'chromenews'),
        'priority' => 10,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);


// Disable main banner in blog
$wp_customize->add_setting('disable_main_banner_on_blog_archive',
    array(
        'default'           => $default['disable_main_banner_on_blog_archive'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_checkbox',
    )
);

$wp_customize->add_control('disable_main_banner_on_blog_archive',
    array(
        'label'    => esc_html__('Disable Main Banner on Blog', 'chromenews'),
        'section'  => 'site_archive_settings',
        'type'     => 'checkbox',
        'priority' => 50,
        'active_callback' => 'chromenews_main_banner_section_status'
    )
);

//Setting - archive content view of news.
$wp_customize->add_setting('archive_layout',
    array(
        'default' => $chromenews_default['archive_layout'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_select',
    )
);

$wp_customize->add_control('archive_layout',
    array(
        'label' => esc_html__('Archive layout', 'chromenews'),
        'description' => esc_html__('Select layout for archive', 'chromenews'),
        'section' => 'site_archive_settings',
        'type' => 'select',
        'choices' => array(
            'archive-layout-grid' => esc_html__('Grid', 'chromenews'),
            'archive-layout-list' => esc_html__('List', 'chromenews'),
            
        ),
        'priority' => 130,
    ));



//========== sidebar blocks options ===============

// Trending Section.
$wp_customize->add_section('sidebar_block_settings',
    array(
        'title' => esc_html__('Sidebar Settings', 'chromenews'),
        'priority' => 10,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);


// Setting - frontpage_sticky_sidebar.
$wp_customize->add_setting('frontpage_sticky_sidebar',
    array(
        'default' => $default['frontpage_sticky_sidebar'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_checkbox',
    )
);

$wp_customize->add_control('frontpage_sticky_sidebar',
    array(
        'label' => esc_html__('Make Sidebar Sticky', 'chromenews'),
        'section' => 'sidebar_block_settings',
        'type' => 'checkbox',
        'priority' => 100,

    )
);

// Setting - global content alignment of news.
$wp_customize->add_setting('frontpage_sticky_sidebar_position',
    array(
        'default' => $default['frontpage_sticky_sidebar_position'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_select',
    )
);

$wp_customize->add_control('frontpage_sticky_sidebar_position',
    array(
        'label' => esc_html__('Sidebar Sticky Position', 'chromenews'),
        'section' => 'sidebar_block_settings',
        'type' => 'select',
        'choices' => array(
            'sidebar-sticky-top' => esc_html__('Top', 'chromenews'),
            'sidebar-sticky-bottom' => esc_html__('Bottom', 'chromenews'),
        ),
        'priority' => 100,
        'active_callback' => 'chromenews_frontpage_sticky_sidebar_status'
    ));

//========== footer latest blog carousel options ===============

// Footer Section.
$wp_customize->add_section('frontpage_latest_posts_settings',
    array(
        'title' => esc_html__('You May Have Missed', 'chromenews'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);
// Setting - latest blog carousel.
$wp_customize->add_setting('frontpage_show_latest_posts',
    array(
        'default' => $chromenews_default['frontpage_show_latest_posts'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_checkbox',
    )
);

$wp_customize->add_control('frontpage_show_latest_posts',
    array(
        'label' => __('Show Above Footer', 'chromenews'),
        'section' => 'frontpage_latest_posts_settings',
        'type' => 'checkbox',
        'priority' => 100,
    )
);


// Setting - featured_news_section_title.
$wp_customize->add_setting('frontpage_latest_posts_section_title',
    array(
        'default' => $chromenews_default['frontpage_latest_posts_section_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('frontpage_latest_posts_section_title',
    array(
        'label' => esc_html__('Posts Section Title', 'chromenews'),
        'section' => 'frontpage_latest_posts_settings',
        'type' => 'text',
        'priority' => 100,
        'active_callback' => 'chromenews_latest_news_section_status'

    )
);



//========== footer section options ===============
// Footer Section.
$wp_customize->add_section('site_footer_settings',
    array(
        'title' => esc_html__('Footer', 'chromenews'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);


// Setting banner_advertisement_section.
$wp_customize->add_setting('footer_background_image',
    array(
        'default' => $default['footer_background_image'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(
    new WP_Customize_Cropped_Image_Control($wp_customize, 'footer_background_image',
        array(
            'label' => esc_html__('Footer Background Image', 'chromenews'),
            'description' => sprintf(esc_html__('Recommended Size %1$s px X %2$s px', 'chromenews'), 1024, 800),
            'section' => 'site_footer_settings',
            'width' => 1024,
            'height' => 800,
            'flex_width' => true,
            'flex_height' => true,
            'priority' => 100,
        )
    )
);

// Setting - global content alignment of news.
$wp_customize->add_setting('footer_copyright_text',
    array(
        'default' => $chromenews_default['footer_copyright_text'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control('footer_copyright_text',
    array(
        'label' => __('Copyright Text', 'chromenews'),
        'section' => 'site_footer_settings',
        'type' => 'text',
        'priority' => 100,
    )
);


// Setting - global content alignment of news.
$wp_customize->add_setting('hide_footer_menu_section',
    array(
        'default' => $chromenews_default['hide_footer_menu_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_checkbox',
    )
);

$wp_customize->add_control('hide_footer_menu_section',
    array(
        'label' => __('Hide footer Menu Section', 'chromenews'),
        'section' => 'site_footer_settings',
        'type' => 'checkbox',
        'priority' => 100,
    )
);