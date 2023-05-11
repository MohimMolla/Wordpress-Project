<?php

/**
 * Option Panel
 *
 * @package Newspaperex
 */


function newspaperex_customize_register($wp_customize) {

$newsup_default = newspaperex_get_default_theme_options();


//section title
$wp_customize->add_setting('editior_post_section',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new newsup_Section_Title(
        $wp_customize,
        'editior_post_section',
        array(
            'label'             => esc_html__( 'Editor Post Section', 'newspaperex' ),
            'section'           => 'frontpage_main_banner_section_settings',
            'priority'          => 40,
            'active_callback' => 'newsup_main_banner_section_status'
        )
    )
);


// Setting - drop down category for slider.
$wp_customize->add_setting('select_editor_news_category',
    array(
        'default' => $newsup_default['select_editor_news_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new Newsup_Dropdown_Taxonomies_Control($wp_customize, 'select_editor_news_category',
    array(
        'label' => esc_html__('Category', 'newspaperex'),
        'description' => esc_html__('Select category for Editor 2 Post', 'newspaperex'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'dropdown-taxonomies',
        'taxonomy' => 'category',
        'priority' => 60,
        'active_callback' => 'newsup_main_banner_section_status'
    )));



// Setting banner_advertisement_section.
$wp_customize->add_setting('banner_right_advertisement_section',
    array(
        'default' => $newsup_default['banner_right_advertisement_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new WP_Customize_Cropped_Image_Control($wp_customize, 'banner_right_advertisement_section',
        array(
            'label' => esc_html__('Banner Section Advertisement', 'newspaperex'),
            'description' => sprintf(esc_html__('Recommended Size %1$s px X %2$s px', 'newspaperex'), 930, 100),
            'section' => 'frontpage_advertisement_settings',
            'width' => 930,
            'height' => 100,
            'flex_width' => true,
            'flex_height' => true,
            'priority' => 200,
        )
    )
);


/*banner_advertisement_section_url*/
$wp_customize->add_setting('banner_right_advertisement_section_url',
    array(
        'default' => '#',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control('banner_right_advertisement_section_url',
    array(
        'label' => esc_html__('URL Link', 'newspaperex'),
        'section' => 'frontpage_advertisement_settings',
        'type' => 'url',
        'priority' => 210,
    )
);

$wp_customize->add_setting('newsup_right_open_on_new_tab',
    array(
        'default' => true,
        'sanitize_callback' => 'newsup_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Newsup_Toggle_Control( $wp_customize, 'newsup_right_open_on_new_tab', 
        array(
            'label' => esc_html__('Open link in a new tab', 'newspaperex'),
            'type' => 'toggle',
            'section' => 'frontpage_advertisement_settings',
            'priority' => 220,
        )
    ));

    /*banner_advertisement_section_url*/
$wp_customize->add_setting('banner_left_advertisement_section_url',
    array(
        'default' => '#',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control('banner_left_advertisement_section_url',
    array(
        'label' => esc_html__('URL Link left', 'newspaperex'),
        'section' => 'frontpage_advertisement_settings',
        'type' => 'url',
        'priority' => 210,
    )
);


}
add_action('customize_register', 'newspaperex_customize_register');
