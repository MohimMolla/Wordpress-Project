<?php
if (!function_exists('chromenews_header_section')) :
    /**
     * Banner Slider
     *
     * @since ChromeNews 1.0.0
     *
     */
    function chromenews_header_section()
    {

        $chromenews_header_layout = chromenews_get_option('header_layout');


?>

        <header id="masthead" class="header-layout-centered chromenews-header">
            <?php
            chromenews_get_block('layout-centered', 'header');


            ?>

        </header>

        <!-- end slider-section -->
    <?php
    }
endif;
add_action('chromenews_action_header_section', 'chromenews_header_section', 40);

//Load main nav menu
if (!function_exists('chromenews_main_menu_nav_section')) :

    function chromenews_main_menu_nav_section()
    {

    ?>
        <div class="navigation-container">
            <nav class="main-navigation clearfix">

                <span class="toggle-menu" aria-controls="primary-menu" aria-expanded="false">
                    <a href="javascript:void(0)" class="aft-void-menu">
                        <span class="screen-reader-text">
                            <?php esc_html_e('Primary Menu', 'chromenews'); ?>
                        </span>
                        <i class="ham"></i>
                    </a>
                </span>


                <?php
                $chromenews_global_show_home_menu = chromenews_get_option('global_show_primary_menu_border');
                wp_nav_menu(array(
                    'theme_location' => 'aft-primary-nav',
                    'menu_id' => 'primary-menu',
                    'container' => 'div',
                    'container_class' => 'menu main-menu menu-desktop ' . $chromenews_global_show_home_menu,
                ));
                ?>
            </nav>
        </div>


    <?php }
endif;

add_action('chromenews_action_main_menu_nav', 'chromenews_main_menu_nav_section', 40);

//load search form
if (!function_exists('chromenews_load_search_form_section')) :

    function chromenews_load_search_form_section()
    {
    ?>
        <div class="af-search-wrap">
            <div class="search-overlay">
                <a href="#" title="Search" class="search-icon">
                    <i class="fa fa-search"></i>
                </a>
                <div class="af-search-form">
                    <?php get_search_form(); ?>
                </div>
            </div>
        </div>

        <?php }

endif;
add_action('chromenews_load_search_form', 'chromenews_load_search_form_section');


//watch online
if (!function_exists('chromenews_load_watch_online_section')) :

    function chromenews_load_watch_online_section()
    {

        $chromenews_aft_enable_custom_link = chromenews_get_option('show_watch_online_section');
        if ($chromenews_aft_enable_custom_link) :
            $chromenews_aft_custom_link = chromenews_get_option('aft_custom_link');
            $chromenews_aft_custom_link = !empty($chromenews_aft_custom_link) ? $chromenews_aft_custom_link : '#';
            $chromenews_aft_custom_icon = chromenews_get_option('aft_custom_icon_preset');
            $chromenews_aft_custom_title = chromenews_get_option('aft_custom_title');
            if (!empty($chromenews_aft_custom_title)) :
        ?>
                <div class="custom-menu-link">
                    <a href="<?php echo esc_url($chromenews_aft_custom_link); ?>">
                        <?php if (!empty($chromenews_aft_custom_icon)) : ?>
                            <i class="<?php echo esc_attr($chromenews_aft_custom_icon); ?>" aria-hidden="true"></i>
                        <?php endif; ?>
                        <?php echo esc_html($chromenews_aft_custom_title); ?>
                    </a>
                </div>
            <?php endif; ?>
        <?php endif; ?>

    <?php }

endif;
add_action('chromenews_load_watch_online', 'chromenews_load_watch_online_section');

//watch online
if (!function_exists('chromenews_dark_and_light_mode_section')) :

    function chromenews_dark_and_light_mode_section()
    {
        $chromenews_enable_site_mode_switch = chromenews_get_option('enable_site_mode_switch');
        if ($chromenews_enable_site_mode_switch == 'aft-enable-mode-switch') :
            $chromenews_global_site_mode_setting = chromenews_get_option('global_site_mode_setting');
           
            if(isset($_COOKIE["stored-site-mode"])){
                $chromenews_global_site_mode_setting = $_COOKIE["stored-site-mode"];
            }else{
                if (!empty($chromenews_global_site_mode_setting)) {
                    $chromenews_global_site_mode_setting = $chromenews_global_site_mode_setting;        
                }
            }
        ?>
            <div id="aft-dark-light-mode-wrap">
                <a href="javascript:void(0)" class="<?php echo esc_attr($chromenews_global_site_mode_setting); ?>" data-site-mode="<?php echo esc_attr($chromenews_global_site_mode_setting); ?>" id="aft-dark-light-mode-btn">
                    <span class="aft-icon-circle"><?php esc_html_e('Light/Dark Button', 'chromenews'); ?></span>
                </a>
            </div>
        <?php
        endif;
    }

endif;
add_action('chromenews_dark_and_light_mode', 'chromenews_dark_and_light_mode_section');



//Load off canvas section
if (!function_exists('chromenews_load_off_canvas_section')) :

    function chromenews_load_off_canvas_section()
    {
        if (is_active_sidebar('express-off-canvas-panel')) :
        ?>


            <span class="offcanvas">
                <a href="#" class="offcanvas-nav">
                    <div class="offcanvas-menu">
                        <span class="mbtn-top"></span>
                        <span class="mbtn-mid"></span>
                        <span class="mbtn-bot"></span>
                    </div>
                </a>
            </span>
        <?php
        endif;
    }

endif;
add_action('chromenews_load_off_canvas', 'chromenews_load_off_canvas_section');

//load date part
if (!function_exists('chromenews_load_date_section')) :
    function chromenews_load_date_section()
    {
        $chromenews_show_date = chromenews_get_option('show_date_section');
        $chromenews_show_time = chromenews_get_option('show_time_section');

        if ($chromenews_show_date == true || $chromenews_show_time == true) : ?>
            <span class="topbar-date">
                <?php
                $datetime = '';
                if ($chromenews_show_date == true) {
                    $datetime .= date_i18n(get_option('date_format'), current_time('timestamp'));
                }

                if ($chromenews_show_time == true) {
                    $chromenews_top_header_time_format = chromenews_get_option('top_header_time_format');
                    if ($chromenews_top_header_time_format == 'en-US' || $chromenews_top_header_time_format == 'en-GB') {
                        $datetime .=  ' <span id="topbar-time"></span>';
                    } else {
                        $datetime .=  ' <span id="topbar-time-wp">';
                        $datetime .=  date_i18n(get_option('time_format'), current_time('timestamp'));
                        $datetime .=  '</span>';
                    }
                }

                echo wp_kses_post($datetime);
                ?>
            </span>
        <?php endif;
    }
endif;
add_action('chromenews_load_date', 'chromenews_load_date_section');

//load social icon menu
if (!function_exists('chromenews_load_social_menu_section')) :

    function chromenews_load_social_menu_section()
    {
        ?>
        <?php
        $chromenews_show_social_menu = chromenews_get_option('show_social_menu_section');
        if (has_nav_menu('aft-social-nav') && $chromenews_show_social_menu == true) : ?>

            <?php
            wp_nav_menu(array(
                'theme_location' => 'aft-social-nav',
                'link_before' => '<span class="screen-reader-text">',
                'link_after' => '</span>',
                'container' => 'div',
                'container_class' => 'social-navigation'
            ));
            ?>

        <?php endif; ?>
    <?php }

endif;

add_action('chromenews_load_social_menu', 'chromenews_load_social_menu_section');

//Load site branding section

if (!function_exists('chromenews_load_site_branding_section')) :
    function chromenews_load_site_branding_section()
    {
        $chromenews_class = '';
        $chromenews_site_title_uppercase = chromenews_get_option('site_title_uppercase');
        if ($chromenews_site_title_uppercase) {
            $chromenews_class = 'uppercase-site-title';
        }
    ?>
        <div class="site-branding <?php echo esc_attr($chromenews_class); ?>">
            <?php
            the_custom_logo();
            if (is_front_page() || is_home()) : ?>
                <h1 class="site-title font-family-1">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="site-title-anchor" rel="home"><?php bloginfo('name'); ?></a>
                </h1>
            <?php else : ?>
                <p class="site-title font-family-1">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="site-title-anchor" rel="home"><?php bloginfo('name'); ?></a>
                </p>
            <?php endif; ?>

            <?php
            $chromenews_description = get_bloginfo('description', 'display');
            if ($chromenews_description || is_customize_preview()) : ?>
                <p class="site-description"><?php echo esc_html($chromenews_description); ?></p>
            <?php
            endif; ?>
        </div>

    <?php }




endif;
add_action('chromenews_load_site_branding', 'chromenews_load_site_branding_section');

if (!function_exists('chromenews_header_advertisement_section')) :
    function chromenews_header_advertisement_section()
    { ?>

        <?php
        $chromenews_banner_advertisement = chromenews_get_option('banner_advertisement_section');
        if (('' != $chromenews_banner_advertisement) || is_active_sidebar('home-promotion-widgets')) :
            $chromenews_header_layout = chromenews_get_option('header_layout');
            if ($chromenews_header_layout == 'header-layout-compressed-full') : ?>
                <?php
                $chromenews_banner_advertisement_scope = chromenews_get_option('banner_advertisement_scope');
                if ($chromenews_banner_advertisement_scope == 'front-page-only') :
                    if (is_home() || is_front_page()) :
                ?>
                        <div class="container-wrapper">
                            <div class="header-promotion">
                                <?php do_action('chromenews_action_banner_advertisement'); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php else : ?>
                    <div class="container-wrapper">
                        <div class="header-promotion">
                            <?php do_action('chromenews_action_banner_advertisement'); ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>



<?php
    }
    add_action('chromenews_action_header_advertisement_section', 'chromenews_header_advertisement_section');
endif;
