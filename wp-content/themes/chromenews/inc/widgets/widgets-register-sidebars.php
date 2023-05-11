<?php

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function chromenews_widgets_init()
{


    register_sidebar(array(
        'name' => esc_html__('Main Sidebar', 'chromenews'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets for main sidebar.', 'chromenews'),
        'before_widget' => '<div id="%1$s" class="widget chromenews-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span class="heading-line-before"></span><span class="heading-line">',
        'after_title' => '</span><span class="heading-line-after"></span></h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Front-page Content Section', 'chromenews'),
        'id' => 'home-content-widgets',
        'description' => esc_html__('Add widgets to front-page contents section.', 'chromenews'),
        'before_widget' => '<div id="%1$s" class="widget chromenews-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span class="heading-line-before"></span><span class="heading-line">',
        'after_title' => '</span><span class="heading-line-after"></span></h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Front-page Sidebar Section', 'chromenews'),
        'id' => 'home-sidebar-widgets',
        'description' => esc_html__('Add widgets to front-page sidebar section.', 'chromenews'),
        'before_widget' => '<div id="%1$s" class="widget chromenews-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span class="heading-line-before"></span><span class="heading-line">',
        'after_title' => '</span><span class="heading-line-after"></span></h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Off Canvas', 'chromenews'),
        'id'            => 'express-off-canvas-panel',
        'description'   => esc_html__('Add widgets for off-canvas section.', 'chromenews'),
        'before_widget' => '<div id="%1$s" class="widget chromenews-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span class="heading-line-before"></span><span class="heading-line">',
        'after_title' => '</span><span class="heading-line-after"></span></h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer First Section', 'chromenews'),
        'id' => 'footer-first-widgets-section',
        'description' => esc_html__('Displays items on footer first column.', 'chromenews'),
        'before_widget' => '<div id="%1$s" class="widget chromenews-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span class="heading-line-before"></span><span class="heading-line">',
        'after_title' => '</span><span class="heading-line-after"></span></h2>',
    ));


    register_sidebar(array(
        'name' => esc_html__('Footer Second Section', 'chromenews'),
        'id' => 'footer-second-widgets-section',
        'description' => esc_html__('Displays items on footer second column.', 'chromenews'),
        'before_widget' => '<div id="%1$s" class="widget chromenews-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span class="heading-line-before"></span><span class="heading-line">',
        'after_title' => '</span><span class="heading-line-after"></span></h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Third Section', 'chromenews'),
        'id' => 'footer-third-widgets-section',
        'description' => esc_html__('Displays items on footer third column.', 'chromenews'),
        'before_widget' => '<div id="%1$s" class="widget chromenews-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span class="heading-line-before"></span><span class="heading-line">',
        'after_title' => '</span><span class="heading-line-after"></span></h2>',
    ));
}

add_action('widgets_init', 'chromenews_widgets_init');
