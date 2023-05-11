<?php

/**
 * Option Panel
 *
 * @package ChromeNews
 */

$chromenews_default = chromenews_get_default_theme_options();


/**
 * Frontpage options section
 *
 * @package ChromeNews
 */


// Add Frontpage Options Panel.
$wp_customize->add_panel('main_banner_option_panel',
    array(
        'title' => esc_html__('Main Banner Options', 'chromenews'),
        'priority' => 30,
        'capability' => 'edit_theme_options',
    )
);


/**
 * Main Banner Slider Section
 * */

// Main banner Sider Section.
$wp_customize->add_section('frontpage_main_banner_section_settings',
    array(
        'title' => esc_html__('Main Banner', 'chromenews'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'main_banner_option_panel',
    )
);


// Setting - show_main_news_section.
$wp_customize->add_setting('show_main_news_section',
    array(
        'default' => $chromenews_default['show_main_news_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_checkbox',
    )
);

$wp_customize->add_control('show_main_news_section',
    array(
        'label' => esc_html__('Enable Main Banner Section', 'chromenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'checkbox',
        'priority' => 100,

    )
);



// Setting banner_advertisement_section.
$wp_customize->add_setting('main_banner_background_section',
    array(
        'default' => $default['main_banner_background_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(
    new WP_Customize_Cropped_Image_Control($wp_customize, 'main_banner_background_section',
        array(
            'label' => esc_html__('Main Banner Background Image', 'chromenews'),
            'description' => sprintf(esc_html__('Recommended Size %1$s px X %2$s px', 'chromenews'), 1024, 800),
            'section' => 'frontpage_main_banner_section_settings',
            'width' => 1024,
            'height' => 800,
            'flex_width' => true,
            'flex_height' => true,
            'priority' => 100,
            'active_callback' => 'chromenews_main_banner_section_status'
        )
    )
);
//main banner layout

$wp_customize->add_setting(
    'select_main_banner_layout_section',
    array(
        'default' => $chromenews_default['select_main_banner_layout_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_select',
    )
);

$wp_customize->add_control(
    'select_main_banner_layout_section',
    array(
        'label' => esc_html__('Select Main Banner Layout', 'chromenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'select',
        'choices' => array(
            'layout-aligned' => esc_html__("Default", 'chromenews'),                            
            'layout-tiled-2' => esc_html__("Tiled", 'chromenews'),
            'layout-vertical' => esc_html__("Vertical", 'chromenews')   
        ),
        'priority' => 100,
        'active_callback' => 'chromenews_main_banner_section_status'
    )
);

//main banner order

$wp_customize->add_setting('select_main_banner_order_3',
    array(
        'default' => $chromenews_default['select_main_banner_order_3'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_select',
    )
);

$wp_customize->add_control('select_main_banner_order_3',
    array(
        'label' => esc_html__('Select Main Banner Order', 'chromenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'select',
        'choices' => array(
            'order-1' => esc_html__("Order 1", 'chromenews'),
            'order-2' => esc_html__("Order 2", 'chromenews'),
            
        ),
        'priority' => 100,
        'active_callback' => function ($control) {
            return (
                chromenews_main_banner_section_status($control)
                
            );
        },
    ));



/**
 * Main Banner Section
 * */

//section title
$wp_customize->add_setting('main_banner_panel_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new ChromeNews_Section_Title(
        $wp_customize,
        'main_banner_panel_section_title',
        array(
            'label' => esc_html__('Main News Section ', 'chromenews'),
            'section' => 'frontpage_main_banner_section_settings',
            'priority' => 100,
            'active_callback' => 'chromenews_main_banner_section_status',
        )
    )
);


// Setting - select_main_banner_section_mode.
$wp_customize->add_setting('select_main_banner_carousel_filterby',
    array(
        'default' => $chromenews_default['select_main_banner_carousel_filterby'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_select',
    )
);

$wp_customize->add_control('select_main_banner_carousel_filterby',
    array(
        'label' => esc_html__('Filter Posts By', 'chromenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'select',
        'choices' => array(
            'cat' => esc_html__("Category", 'chromenews'),
            'tag' => esc_html__("Tag", 'chromenews'),
            
        ),
        'priority' => 100,
        'active_callback' => 'chromenews_main_banner_section_status'
    ));


// Setting - drop down category for slider.
$wp_customize->add_setting('select_slider_news_category',
    array(
        'default' => $chromenews_default['select_slider_news_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new ChromeNews_Dropdown_Taxonomies_Control($wp_customize, 'select_slider_news_category',
    array(
        'label' => esc_html__('Select Category', 'chromenews'),
        'description' => esc_html__('Select category to be shown on main slider section', 'chromenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'dropdown-taxonomies',
        'taxonomy' => 'category',
        'priority' => 100,
        'active_callback' => function ($control) {
            return (
                chromenews_main_banner_section_status($control)
                &&
                chromenews_main_banner_section_filterby_cat_status($control)
            );
        },

    )));


// Setting - drop down category for slider.
$wp_customize->add_setting('select_slider_news_tag',
    array(
        'default' => $chromenews_default['select_slider_news_tag'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new ChromeNews_Dropdown_Taxonomies_Control($wp_customize, 'select_slider_news_tag',
    array(
        'label' => esc_html__('Select Tag', 'chromenews'),
        'description' => esc_html__('Select tag to be shown on main slider section', 'chromenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'dropdown-taxonomies',
        'taxonomy' => 'post_tag',
        'priority' => 100,
        'active_callback' => function ($control) {
            return (
                chromenews_main_banner_section_status($control)
                &&
                chromenews_main_banner_section_filterby_tag_status($control)
            );
        },
    )));


// Setting - number_of_slides.
$wp_customize->add_setting('number_of_slides',
    array(
        'default' => $chromenews_default['number_of_slides'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control('number_of_slides',
    array(
        'label' => esc_html__('Number of Posts', 'chromenews'),
        'description' => esc_html__('Accepts any postive number.', 'chromenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'number',
        'priority' => 100,
        'active_callback' => 'chromenews_main_banner_section_status'

    )
);

$wp_customize->add_setting(
    'main_banner_carousel_autoplay',
    array(
        'default' => $chromenews_default['main_banner_carousel_autoplay'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'main_banner_carousel_autoplay',
    array(
        'label' => esc_html__('Enable Autoplay', 'chromenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'checkbox',
        'priority' => 100,
        'active_callback' => function ($control) {
            return (chromenews_main_banner_section_status($control)                
            );
        },
    )
);


/**
 * Editor's Picks Post Section
 * */


//section title
$wp_customize->add_setting('editors_picks_panel_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new ChromeNews_Section_Title(
        $wp_customize,
        'editors_picks_panel_section_title',
        array(
            'label' => esc_html__("Editor's Picks Section", 'chromenews'),
            'section' => 'frontpage_main_banner_section_settings',
            'priority' => 100,
            'active_callback' => function($control){
                return(
                    chromenews_main_banner_section_status($control)
                    
                );
            },
        )
    )
);


$wp_customize->add_setting('main_editors_picks_section_title',
    array(
        'default' => $chromenews_default['main_editors_picks_section_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('main_editors_picks_section_title',
    array(
        'label' => esc_html__('Section Title ', 'chromenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'text',
        'priority' => 100,
        'active_callback' => function($control){
            return(
                chromenews_main_banner_section_status($control)
                
            );
        },

    )

);


// Setting - select_main_banner_section_mode.
$wp_customize->add_setting('select_editors_picks_filterby',
    array(
        'default' => $chromenews_default['select_editors_picks_filterby'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_select',
    )
);

$wp_customize->add_control('select_editors_picks_filterby',
    array(
        'label' => esc_html__('Filter Posts By', 'chromenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'select',
        'choices' => array(
            'cat' => esc_html__("Category", 'chromenews'),
            'tag' => esc_html__("Tag", 'chromenews'),
            
        ),
        'priority' => 100,
        'active_callback' => function($control){
            return(
                chromenews_main_banner_section_status($control)
                
            );
        },
    ));


// Setting - drop down category for slider.
$wp_customize->add_setting('select_editors_picks_news_category',
    array(
        'default' => $chromenews_default['select_editors_picks_news_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new ChromeNews_Dropdown_Taxonomies_Control($wp_customize, 'select_editors_picks_news_category',
    array(
        'label' => esc_html__('Select Category', 'chromenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'dropdown-taxonomies',
        'taxonomy' => 'category',
        'priority' => 100,
        'active_callback' => function ($control) {
            return (
                chromenews_main_banner_section_status($control)
                &&
                chromenews_editors_picks_section_filterby_cat_status($control)
                
            );
        },

    )));


// Setting - drop down category for slider.
$wp_customize->add_setting('select_editors_picks_news_tag',
    array(
        'default' => $chromenews_default['select_editors_picks_news_tag'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new ChromeNews_Dropdown_Taxonomies_Control($wp_customize, 'select_editors_picks_news_tag',
    array(
        'label' => esc_html__('Select Tag', 'chromenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'dropdown-taxonomies',
        'taxonomy' => 'post_tag',
        'priority' => 100,
        'active_callback' => function ($control) {
            return (
                chromenews_main_banner_section_status($control)
                &&
                chromenews_editors_picks_section_filterby_tag_status($control)
                
            );
        },
    )));


$wp_customize->add_setting(
    'editors_picks_news_autoplay',
    array(
        'default' => $chromenews_default['editors_picks_news_autoplay'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'editors_picks_news_autoplay',
    array(
        'label' => esc_html__('Enable Autoplay', 'chromenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'checkbox',
        'priority' => 100,
        'active_callback' => function ($control) {
            return (chromenews_main_banner_section_status($control)
            && chromenews_editors_picks_section_autoplay_status($control)
            );
        },
    )
);

/**
 * Trending Post Section
 * */

//section title
$wp_customize->add_setting('trending_post_panel_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new ChromeNews_Section_Title(
        $wp_customize,
        'trending_post_panel_section_title',
        array(
            'label' => esc_html__("Trending Section", 'chromenews'),
            'section' => 'frontpage_main_banner_section_settings',
            'priority' => 100,
            'active_callback' => function ($control) {
                return (
                    chromenews_main_banner_section_status($control)
                    &&
                    chromenews_main_banner_layout_trending_status($control)
                );
            },
        )
    )
);


$wp_customize->add_setting('main_trending_news_section_title',
    array(
        'default' => $chromenews_default['main_trending_news_section_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('main_trending_news_section_title',
    array(
        'label' => esc_html__('Section Title ', 'chromenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'text',
        'priority' => 100,
        'active_callback' => function ($control) {
            return (
                chromenews_main_banner_section_status($control)
                &&
                    chromenews_main_banner_layout_trending_status($control)
            );
        },

    )

);


// Setting - select_main_banner_section_mode.
$wp_customize->add_setting('select_trending_post_filterby',
    array(
        'default' => $chromenews_default['select_trending_post_filterby'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_select',
    )
);

$wp_customize->add_control('select_trending_post_filterby',
    array(
        'label' => esc_html__('Filter Posts By', 'chromenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'select',
        'choices' => array(
            'cat' => esc_html__("Category", 'chromenews'),
            'tag' => esc_html__("Tag", 'chromenews'),
            
        ),
        'priority' => 100,
        'active_callback' => function ($control) {
            return (
                chromenews_main_banner_section_status($control)
                &&
                    chromenews_main_banner_layout_trending_status($control)
            );
        },
    ));



// Setting - drop down category for slider.
$wp_customize->add_setting('select_trending_post_category',
    array(
        'default' => $chromenews_default['select_trending_post_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new ChromeNews_Dropdown_Taxonomies_Control($wp_customize, 'select_trending_post_category',
    array(
        'label' => esc_html__('Select Category', 'chromenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'dropdown-taxonomies',
        'taxonomy' => 'category',
        'priority' => 100,
        'active_callback' => function ($control) {
            return (
                chromenews_main_banner_section_status($control)
                &&
                chromenews_trending_post_section_filterby_cat_status($control)
                &&
                    chromenews_main_banner_layout_trending_status($control)
            );
        },

    )));

// Setting - drop down category for slider.
$wp_customize->add_setting('select_trending_post_tag',
    array(
        'default' => $chromenews_default['select_trending_post_tag'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new ChromeNews_Dropdown_Taxonomies_Control($wp_customize, 'select_trending_post_tag',
    array(
        'label' => esc_html__('Select Tag', 'chromenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'dropdown-taxonomies',
        'taxonomy' => 'post_tag',
        'priority' => 100,
        'active_callback' => function ($control) {
            return (
                chromenews_main_banner_section_status($control)
                &&
                chromenews_trending_post_section_filterby_tag_status($control)
                &&
                    chromenews_main_banner_layout_trending_status($control)
            );
        },
    )));




    $wp_customize->add_setting(
        'trending_post_autoplay',
        array(
            'default' => $chromenews_default['trending_post_autoplay'],
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'chromenews_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
        'trending_post_autoplay',
        array(
            'label' => esc_html__('Enable Autoplay', 'chromenews'),
            'section' => 'frontpage_main_banner_section_settings',
            'type' => 'checkbox',
            'priority' => 100,
            'active_callback' => function ($control) {
                return (chromenews_main_banner_section_status($control)
                &&
                    chromenews_main_banner_layout_trending_status($control)
                );
            },
        )
    );
    


// Advertisement Section.
$wp_customize->add_section('frontpage_popular_tags_settings',
    array(
        'title' => esc_html__('Popular Tags', 'chromenews'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'main_banner_option_panel',
    )
);


// Setting banner_advertisement_section.
$wp_customize->add_setting('frontpage_popular_tags_settings',
    array(
        'default' => $chromenews_default['frontpage_popular_tags_settings'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_setting('show_popular_tags_section',
    array(
        'default' => $chromenews_default['show_popular_tags_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_checkbox',
    )
);
$wp_customize->add_control('show_popular_tags_section',
    array(
        'label' => esc_html__('Enable Trending Tags', 'chromenews'),
        'section' => 'frontpage_popular_tags_settings',
        'type' => 'checkbox',
        'priority' => 100,
    )
);


$wp_customize->add_setting('frontpage_popular_tags_section_title',
    array(
        'default' => $chromenews_default['frontpage_popular_tags_section_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('frontpage_popular_tags_section_title',
    array(
        'label' => esc_html__('Section Title ', 'chromenews'),
        'section' => 'frontpage_popular_tags_settings',
        'type' => 'text',
        'priority' => 100,
        'active_callback' => 'chromenews_popular_tags_section_status'

    )

);


// Setting - select_main_banner_section_mode.
$wp_customize->add_setting('frontpage_popular_tags_section_filterby',
    array(
        'default' => $chromenews_default['frontpage_popular_tags_section_filterby'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_select',
    )
);

$wp_customize->add_control('frontpage_popular_tags_section_filterby',
    array(
        'label' => esc_html__('Order Tags By', 'chromenews'),
        'section' => 'frontpage_popular_tags_settings',
        'type' => 'select',
        'choices' => array(
            'popular' => esc_html__("Popularity", 'chromenews'),
            'latest' => esc_html__("Latest", 'chromenews'),            
        ),
        'priority' => 100,
        'active_callback' => 'chromenews_popular_tags_section_status'
    ));


//Flash news
$wp_customize->add_section('frontpage_flash_news_settings',
    array(
        'title' => esc_html__('Exclusive News', 'chromenews'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'main_banner_option_panel',
    )
);


// Setting banner_advertisement_section.
$wp_customize->add_setting('frontpage_flash_news_settings',
    array(
        'default' => $chromenews_default['frontpage_flash_news_settings'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_setting('show_flash_news_section',
    array(
        'default' => $chromenews_default['show_flash_news_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_checkbox',
    )
);
$wp_customize->add_control('show_flash_news_section',
    array(
        'label' => esc_html__('Enable Exclusive News', 'chromenews'),
        'section' => 'frontpage_flash_news_settings',
        'type' => 'checkbox',
        'priority' => 100,
    )
);


$wp_customize->add_setting('flash_news_title',
    array(
        'default' => $chromenews_default['flash_news_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('flash_news_title',
    array(
        'label' => esc_html__('Section Title ', 'chromenews'),
        'section' => 'frontpage_flash_news_settings',
        'type' => 'text',
        'priority' => 100,
        'active_callback' => 'chromenews_flash_posts_section_status'

    )

);

$wp_customize->add_setting('select_flash_news_category',
    array(
        'default'           => $chromenews_default['select_flash_news_category'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new chromenews_Dropdown_Taxonomies_Control($wp_customize, 'select_flash_news_category',
    array(
        'label'       => esc_html__('Flash Posts Category', 'chromenews'),
        'description' => esc_html__('Select category to be shown on trending posts ', 'chromenews'),
        'section'     => 'frontpage_flash_news_settings',
        'type'        => 'dropdown-taxonomies',
        'taxonomy'    => 'category',
        'priority'    => 100,
        'active_callback' => 'chromenews_flash_posts_section_status'
    )));

/**
 * Frontpage options section
 *
 * @package ChromeNews
 */


// Add Frontpage Options Panel.
$wp_customize->add_panel('frontpage_option_panel',
    array(
        'title' => esc_html__('Frontpage Options', 'chromenews'),
        'priority' => 30,
        'capability' => 'edit_theme_options',
    )
);



/**
 * Featured Post Section
 * */

    $wp_customize->add_section('frontpage_featured_posts_settings',
        array(
            'title' => esc_html__('Featured Posts', 'chromenews'),
            'priority' => 50,
            'capability' => 'edit_theme_options',
            'panel' => 'frontpage_option_panel',
        )
    );




// Setting - show_featured_posts_section.
    $wp_customize->add_setting('show_featured_posts_section',
        array(
            'default' => $chromenews_default['show_featured_posts_section'],
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'chromenews_sanitize_checkbox',
        )
    );

    $wp_customize->add_control('show_featured_posts_section',
        array(
            'label' => esc_html__('Enable Featured Post Section', 'chromenews'),
            'section' => 'frontpage_featured_posts_settings',
            'type' => 'checkbox',
            'priority' => 22,


        )
    );

    $wp_customize->add_setting('featured_news_section_title',
        array(
            'default' => $chromenews_default['featured_news_section_title'],
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control('featured_news_section_title',
        array(
            'label' => esc_html__('Section Title ', 'chromenews'),
            'section' => 'frontpage_featured_posts_settings',
            'type' => 'text',
            'priority' => 130,
            'active_callback' => 'chromenews_featured_posts_section'

        )

    );

    //List of categories

    $wp_customize->add_setting('select_featured_news_category',
        array(
            'default' => $chromenews_default['select_featured_news_category'],
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'absint',
        )
    );

    $wp_customize->add_control(new ChromeNews_Dropdown_Taxonomies_Control($wp_customize, 'select_featured_news_category',
        array(
            'label' => sprintf(__('Select ', 'chromenews')),
            'description' => esc_html__('Select category to be shown on featured section ', 'chromenews'),
            'section' => 'frontpage_featured_posts_settings',
            'type' => 'dropdown-taxonomies',
            'taxonomy' => 'category',
            'priority' => 130,
            'active_callback' => 'chromenews_featured_posts_section',


        )));




// Frontpage Layout Section.
$wp_customize->add_section('frontpage_layout_settings',
    array(
        'title' => esc_html__('Frontpage Layout Settings', 'chromenews'),
        'priority' => 10,
        'capability' => 'edit_theme_options',
        'panel' => 'frontpage_option_panel',
    )
);


// Setting - show_main_news_section.
$wp_customize->add_setting('frontpage_content_alignment',
    array(
        'default' => $chromenews_default['frontpage_content_alignment'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_select',
    )
);

$wp_customize->add_control('frontpage_content_alignment',
    array(
        'label' => esc_html__('Frontpage Content Alignment', 'chromenews'),
        'description' => esc_html__('Select frontpage content alignment', 'chromenews'),
        'section' => 'frontpage_layout_settings',
        'type' => 'select',
        'choices' => array(
            'align-content-left' => esc_html__('Home Content - Home Sidebar', 'chromenews'),
            'align-content-right' => esc_html__('Home Sidebar - Home Content', 'chromenews'),
            'full-width-content' => esc_html__('Only Home Content', 'chromenews')
        ),
        'priority' => 10,
    ));