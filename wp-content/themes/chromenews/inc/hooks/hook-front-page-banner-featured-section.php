<?php
if (!function_exists('chromenews_banner_featured_section')) :
    /**
     * Ticker Slider
     *
     * @since ChromeNews 1.0.0
     *
     */
    function chromenews_banner_featured_section()
    {
        $chromenews_show_featured_section = chromenews_get_option('show_featured_posts_section');
        if ($chromenews_show_featured_section == true) :

?>
            <div class="aft-frontpage-feature-section-wrapper">
                <section class="aft-blocks af-main-banner-featured-posts">
                    <div class="container-wrapper">
                        <?php do_action('chromenews_action_banner_featured_posts'); ?>
                    </div>
                </section>
            </div>
<?php
        endif;
    }
endif;


add_action('chromenews_action_banner_featured_section', 'chromenews_banner_featured_section', 10);
