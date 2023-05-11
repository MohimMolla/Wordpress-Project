<?php

/**
 * Font and Color Option Panel
 *
 * @package ChromeNews
 */

$chromenews_default = chromenews_get_default_theme_options();


// Setting - global content alignment of news.
$wp_customize->add_setting('header_textcolor_dark_mode',
    array(
        'default' => $chromenews_default['header_textcolor_dark_mode'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control('header_textcolor_dark_mode',
    array(
        'label' => esc_html__('Site Title/Tagline Color (Dark Mode)', 'chromenews'),
        'section' => 'colors',
        'type' => 'color',
        'priority' => 5,
    ));

// Setting - global content alignment of news.
$wp_customize->add_setting('global_site_mode_setting',
    array(
        'default' => $chromenews_default['global_site_mode_setting'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_select',
    )
);

$wp_customize->add_control('global_site_mode_setting',
    array(
        'label' => esc_html__('Site Color Mode', 'chromenews'),
        'section' => 'colors',
        'type' => 'select',
        'choices' => array(
            'aft-light-mode' => esc_html__('Light', 'chromenews'),
            'aft-dark-mode' => esc_html__('Dark', 'chromenews'),
        ),
        'priority' => 5,
    ));



//section title
$wp_customize->add_setting('site_background_color_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new ChromeNews_Section_Title(
        $wp_customize,
        'site_background_color_section_title',
        array(
            'label' => esc_html__('Primary Color Section ', 'chromenews'),
            'section' => 'colors',
            'priority' => 5,
            
        )
    )
);


// Setting - slider_caption_bg_color.
$wp_customize->add_setting('dark_background_color',
    array(
        'default' => $chromenews_default['dark_background_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'dark_background_color',
        array(
            'label' => esc_html__('Background Color (Dark Mode)', 'chromenews'),
            'section' => 'colors',
            'type' => 'color',
            'priority' => 5,
            'active_callback' => 'chromenews_global_site_mode_dark_status'

        )
    )
);


//section title
$wp_customize->add_setting('global_color_section_notice',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new ChromeNews_Simple_Notice_Custom_Control(
        $wp_customize,
        'global_color_section_notice',
        array(
            'description' => esc_html__('Background Color (Dark Mode) will be applied for this mode.', 'chromenews'),
            'section' => 'colors',
            'priority' => 5,
            'active_callback' => 'chromenews_global_site_mode_dark_status'
        )
    )
);





//section title
$wp_customize->add_setting('secondary_color_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new ChromeNews_Section_Title(
        $wp_customize,
        'secondary_color_section_title',
        array(
            'label' => esc_html__('Secondary Color Section ', 'chromenews'),
            'section' => 'colors',
            'priority' => 10,
            
        )
    )
);


// Setting - secondary_color.
$wp_customize->add_setting('secondary_color',
    array(
        'default' => $chromenews_default['secondary_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(

    new WP_Customize_Color_Control(
        $wp_customize,
        'secondary_color',
        array(
            'label' => esc_html__('Secondary Color', 'chromenews'),
            'section' => 'colors',
            'type' => 'color',
            'priority' => 10,
            
        )
    )
);

// Setting - secondary_color.
$wp_customize->add_setting('text_over_secondary_color',
    array(
        'default' => $chromenews_default['text_over_secondary_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(

    new WP_Customize_Color_Control(
        $wp_customize,
        'text_over_secondary_color',
        array(
            'label' => esc_html__('Texts over Secondary Color', 'chromenews'),
            'section' => 'colors',
            'type' => 'color',
            'priority' => 10,
            
        )
    )
);

//section title
$wp_customize->add_setting('global_primay_menu_color_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new ChromeNews_Section_Title(
        $wp_customize,
        'global_primay_menu_color_section_title',
        array(
            'label' => esc_html__('Primary Navigation Section ', 'chromenews'),
            'section' => 'colors',
            'priority' => 100,
            //'active_callback' => 'chromenews_global_site_mode_status'
        )
    )
);


// Setting - slider_caption_bg_color.
$wp_customize->add_setting('main_navigation_custom_background_color',
    array(
        'default' => $chromenews_default['main_navigation_custom_background_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(

    new WP_Customize_Color_Control(
        $wp_customize,
        'main_navigation_custom_background_color',
        array(
            'label' => esc_html__('Background Color', 'chromenews'),
            'section' => 'colors',
            'type' => 'color',
            'priority' => 100,
            //'active_callback' => 'chromenews_global_site_mode_status'
        )
    )
);


//============= Font Options ===================
// font Section.
$wp_customize->add_section('font_typo_section',
    array(
        'title' => esc_html__('Fonts & Typography', 'chromenews'),
        'priority' => 5,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);

global $chromenews_google_fonts;


// Trending Section.
$wp_customize->add_setting('site_title_font_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new ChromeNews_Section_Title(
        $wp_customize,
        'site_title_font_section_title',
        array(
            'label' => esc_html__("Font Family Section", 'chromenews'),
            'section' => 'font_typo_section',
            'priority' => 100,

        )
    )
);



// Setting - secondary_font.
$wp_customize->add_setting('site_title_font',
    array(
        'default' => $chromenews_default['site_title_font'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_select',
    )
);
$wp_customize->add_control('site_title_font',
    array(
        'label' => esc_html__('Site Title Font', 'chromenews'),

        'section' => 'font_typo_section',
        'type' => 'select',
        'choices' => $chromenews_google_fonts,
        'priority' => 100,
    )
);

// Setting - primary_font.
$wp_customize->add_setting('primary_font',
    array(
        'default' => $chromenews_default['primary_font'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_select',
    )
);
$wp_customize->add_control('primary_font',
    array(
        'label' => esc_html__('Primary Font', 'chromenews'),

        'section' => 'font_typo_section',
        'type' => 'select',
        'choices' => $chromenews_google_fonts,
        'priority' => 100,
    )
);

// Setting - secondary_font.
$wp_customize->add_setting('secondary_font',
    array(
        'default' => $chromenews_default['secondary_font'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_select',
    )
);
$wp_customize->add_control('secondary_font',
    array(
        'label' => esc_html__('Secondary Font', 'chromenews'),

        'section' => 'font_typo_section',
        'type' => 'select',
        'choices' => $chromenews_google_fonts,
        'priority' => 110,
    )
);


// Trending Section.
$wp_customize->add_setting('font_formatting_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new ChromeNews_Section_Title(
        $wp_customize,
        'font_formatting_section_title',
        array(
            'label' => esc_html__("Texts Formatting Section", 'chromenews'),
            'section' => 'font_typo_section',
            'priority' => 110,

        )
    )
);


// Setting - global content alignment of news.
$wp_customize->add_setting('title_font_weight',
    array(
        'default' => $chromenews_default['title_font_weight'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'chromenews_sanitize_select',
    )
);

$wp_customize->add_control('title_font_weight',
    array(
        'label' => esc_html__('Title Font Weight', 'chromenews'),
        'description' => sprintf(esc_html__('Default Value: %d', 'chromenews'), $chromenews_default['title_font_weight']),
        'section' => 'font_typo_section',
        'type' => 'select',
        'choices' => array(           
            
            '500' => esc_html__('500', 'chromenews'),            
            '700' => esc_html__('700', 'chromenews'),
            
        ),
        'priority' => 110,
    ));



// Trending Section.
$wp_customize->add_setting('font_size_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new ChromeNews_Section_Title(
        $wp_customize,
        'font_size_section_title',
        array(
            'label' => esc_html__("Font Size Section", 'chromenews'),
            'section' => 'font_typo_section',
            'priority' => 110,

        )
    )
);


// Setting - secondary_font.
$wp_customize->add_setting('chromenews_section_title_font_size',
    array(
        'default' => $chromenews_default['chromenews_section_title_font_size'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control('chromenews_section_title_font_size',
    array(
        'label' => esc_html__('Global Section Title Size', 'chromenews'),
        'description' => sprintf(esc_html__('Default Value: %d', 'chromenews'), $chromenews_default['chromenews_section_title_font_size']),
        'section' => 'font_typo_section',
        'type' => 'number',
        'priority' => 110,
    )
);