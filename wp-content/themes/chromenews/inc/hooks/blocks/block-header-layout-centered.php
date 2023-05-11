<?php
    /**
     * List block part for displaying header content in page.php
     *
     * @package ChromeNews
     */
    
    $chromenews_class = '';
    $chromenews_background = '';
    if (has_header_image()) {
        $chromenews_class = 'af-header-image  data-bg';
        $chromenews_background = get_header_image();
    }
$chromenews_show_top_header_section = chromenews_get_option('show_top_header_section');
?>
<?php if($chromenews_show_top_header_section): ?>

<div class="top-header">
    <div class="container-wrapper">
        <div class="top-bar-flex">
            <div class="top-bar-left col-2">

                <div class="date-bar-left">
                    <?php do_action('chromenews_load_date'); ?>
                </div>
            </div>
            <div class="top-bar-right col-2">
                <div class="aft-small-social-menu">
                    <?php do_action('chromenews_load_social_menu'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<div class="mid-header-wrapper <?php echo esc_attr($chromenews_class); ?>"
     data-background="<?php echo esc_attr($chromenews_background); ?>">

    <div class="mid-header">
        <div class="container-wrapper">
            <div class="mid-bar-flex">
                <div class="logo">
                    <?php do_action('chromenews_load_site_branding'); ?>
                </div>
            </div>
        </div>
    </div>

    <?php
        $chromenews_banner_advertisement_scope = chromenews_get_option('banner_advertisement_scope');
        if ($chromenews_banner_advertisement_scope == 'front-page-only'):
            if (is_home() || is_front_page()):
                ?>
                <div class="below-mid-header">
                    <div class="container-wrapper">
                        <div class="header-promotion">
                            <?php do_action('chromenews_action_banner_advertisement'); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="below-mid-header">
                <div class="container-wrapper">
                    <div class="header-promotion">
                        <?php do_action('chromenews_action_banner_advertisement'); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

</div>
<div id="main-navigation-bar" class="bottom-header">
    <div class="container-wrapper">
        <div class="bottom-nav">
            <div class="offcanvas-navigaiton">
                <?php if (is_active_sidebar('express-off-canvas-panel')) : ?>
                    <div class="off-cancas-panel">
                        <?php do_action('chromenews_load_off_canvas'); ?>
                    </div>
                    <div id="sidr" class="primary-background">
                        <a class="sidr-class-sidr-button-close" href="#sidr-nav"></a>
                        <?php dynamic_sidebar('express-off-canvas-panel'); ?>
                    </div>
                <?php endif; ?>
            <?php do_action('chromenews_action_main_menu_nav'); ?>
            <div class="search-watch">
                <?php do_action('chromenews_dark_and_light_mode'); ?>
                <?php do_action('chromenews_load_search_form'); ?>
                <?php do_action('chromenews_load_watch_online'); ?>
            </div>

        </div>

    </div>
</div>

