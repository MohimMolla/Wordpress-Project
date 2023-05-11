<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
 * <?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package ChromeNews
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses chromenews_header_style()
 */
function chromenews_custom_header_setup()
{
    add_theme_support('custom-header', apply_filters('chromenews_custom_header_args', array(
        'default-image' => '',
        'default-text-color' => '404040',
        'width' => 1500,
        'height' => 400,
        'flex-height' => true,
        'wp-head-callback' => 'chromenews_header_style',
    )));
}

add_action('after_setup_theme', 'chromenews_custom_header_setup');

if (!function_exists('chromenews_header_style')) :
    /**
     * Styles the header image and text displayed on the blog.
     *
     * @see chromenews_custom_header_setup().
     */
    function chromenews_header_style()
    {
        $chromenews_header_image_tint_overlay = chromenews_get_option('enable_header_image_tint_overlay');
        $chromenews_site_title_font_size = chromenews_get_option('site_title_font_size');
        $chromenews_header_textcolor_dark_mode = chromenews_get_option('header_textcolor_dark_mode');
        $chromenews_header_text_color = get_header_textcolor();



        // If we get this far, we have custom styles. Let's do this.
        ?>
        <style type="text/css">
            <?php

            if($chromenews_header_image_tint_overlay == false):
                ?>

            body .af-header-image.data-bg:before{
                opacity:0;
            }
            <?php
            endif;
            // Has the text been hidden?
            if ( ! display_header_text() ) :
            ?>
            .site-title,
            .site-description {
                position: absolute;
                clip: rect(1px, 1px, 1px, 1px);
                display: none;
            }

            <?php
                // If the user has set a custom color for the text use that.
                else :
            ?>
            .site-title a,
            .site-header .site-branding .site-title a:visited,
            .site-header .site-branding .site-title a:hover,
            .site-description {
                color: #<?php echo esc_attr( $chromenews_header_text_color ); ?>;
            }


            body.aft-dark-mode .site-title a,
            body.aft-dark-mode .site-header .site-branding .site-title a:visited,
            body.aft-dark-mode .site-header .site-branding .site-title a:hover,
            body.aft-dark-mode .site-description {
                color: <?php echo esc_attr( $chromenews_header_textcolor_dark_mode ); ?>;
            }

            .header-layout-3 .site-header .site-branding .site-title,
            .site-branding .site-title {
                font-size: <?php echo esc_attr( $chromenews_site_title_font_size ); ?>px;
            }

            @media only screen and (max-width: 640px) {
                .site-branding .site-title {
                    font-size: 40px;

                }
              }   

           @media only screen and (max-width: 375px) {
                    .site-branding .site-title {
                        font-size: 32px;

                    }
                }

            <?php endif; ?>


        </style>
        <?php
    }
endif;