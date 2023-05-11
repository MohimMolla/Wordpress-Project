<?php
if (!function_exists('chromenews_banner_advertisement')):
    /**
     * Ticker Slider
     *
     * @since ChromeNews 1.0.0
     *
     */
    function chromenews_banner_advertisement()
    {


        $chromenews_banner_advertisement = chromenews_get_option('banner_advertisement_section');

        if (('' != $chromenews_banner_advertisement) ) { ?>
            <div class="banner-promotions-wrapper">
                <?php if (('' != $chromenews_banner_advertisement)):
                    $chromenews_banner_advertisement = absint($chromenews_banner_advertisement);
                    $chromenews_banner_advertisement = wp_get_attachment_image($chromenews_banner_advertisement, 'full');
                    $chromenews_banner_advertisement_url = chromenews_get_option('banner_advertisement_section_url');
                    $chromenews_banner_advertisement_url = isset($chromenews_banner_advertisement_url) ? esc_url($chromenews_banner_advertisement_url) : '#';
                    $chromenews_open_on_new_tab = chromenews_get_option('banner_advertisement_open_on_new_tab');
                    $chromenews_open_on_new_tab = ('' != $chromenews_open_on_new_tab) ? '_blank' : '';

                    ?>
                    <div class="promotion-section">
                        <a href="<?php echo esc_url($chromenews_banner_advertisement_url); ?>" target="<?php echo esc_attr($chromenews_open_on_new_tab); ?>">
                            <?php echo wp_kses_post($chromenews_banner_advertisement); ?>
                        </a>
                    </div>
                <?php endif; ?>                

            </div>
            <!-- Trending line END -->
            <?php
        }

         
    }
endif;

add_action('chromenews_action_banner_advertisement', 'chromenews_banner_advertisement', 10);