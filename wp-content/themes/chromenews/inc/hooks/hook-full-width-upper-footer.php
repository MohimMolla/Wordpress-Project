<?php

/**
 * Front page section additions.
 */


if (!function_exists('chromenews_full_width_upper_footer_section')) :
    /**
     *
     * @since ChromeNews 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function chromenews_full_width_upper_footer_section()
    {



        ?>

        <section class="aft-blocks above-footer-widget-section">
            <?php

            if (1 == chromenews_get_option('frontpage_show_latest_posts')) {
                chromenews_get_block('latest');
            }


            $chromenews_mailchimp_scope = chromenews_get_option('footer_mailchimp_subscriptions_scopes');
            if ($chromenews_mailchimp_scope == 'front-page') {
                if (is_front_page() || is_home()) {
                    if (1 == chromenews_get_option('footer_show_mailchimp_subscriptions')) {
                        chromenews_get_block('mailchimp');
                    }
                }
            } else {
                if (1 == chromenews_get_option('footer_show_mailchimp_subscriptions')) {
                    chromenews_get_block('mailchimp');
                }
            }


            ?>
        </section>
        <?php

    }
endif;
add_action('chromenews_action_full_width_upper_footer_section', 'chromenews_full_width_upper_footer_section');
