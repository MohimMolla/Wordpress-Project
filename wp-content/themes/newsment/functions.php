<?php
/*This file is part of HardNews child theme.

All functions of this file will be loaded before of parent theme functions.
Learn more at https://codex.wordpress.org/Child_Themes.

Note: this function loads the parent stylesheet before, then child theme stylesheet
(leave it in place unless you know what you are doing.)
*/

function newsment_enqueue_child_styles()
{
    $min = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    $parent_style = 'covernews-style';

    $fonts_url = 'https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700';
    wp_enqueue_style('newsment-google-fonts', $fonts_url, array(), null);
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap' . $min . '.css');
    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
    wp_enqueue_style(
        'newsment',
        get_stylesheet_directory_uri() . '/style.css',
        array('bootstrap', $parent_style),
        wp_get_theme()->get('Version')
    );
}
add_action('wp_enqueue_scripts', 'newsment_enqueue_child_styles');



/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function newsment_widgets_init()
{

    register_sidebar(array(
        'name'          => esc_html__('Front-page Banner Ad Section', 'newsment'),
        'id'            => 'home-advertisement-widgets',
        'description'   => esc_html__('Add widgets for frontpage banner section advertisement.', 'newsment'),
        'before_widget' => '<div id="%1$s" class="widget covernews-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span>',
        'after_title' => '</span></h2>',
    ));
}

add_action('widgets_init', 'newsment_widgets_init');



function newsment_override_banner_advertisment_function()
{
    remove_action('covernews_action_banner_advertisement', 'covernews_banner_advertisement', 10);
}

add_action('wp_loaded', 'newsment_override_banner_advertisment_function');

/**
 * Overriding Parent theme Advertisment section
 *
 * @since NewsQuare 1.0.0
 *
 */
function newsment_banner_advertisement()
{

    if (('' != covernews_get_option('banner_advertisement_section'))) { ?>
        <div class="banner-promotions-wrapper">
            <?php if (('' != covernews_get_option('banner_advertisement_section'))) :

                $covernews_banner_advertisement = covernews_get_option('banner_advertisement_section');
                $covernews_banner_advertisement = absint($covernews_banner_advertisement);
                $covernews_banner_advertisement = wp_get_attachment_image($covernews_banner_advertisement, 'full');
                $covernews_banner_advertisement_url = covernews_get_option('banner_advertisement_section_url');
                $covernews_banner_advertisement_url = isset($covernews_banner_advertisement_url) ? esc_url($covernews_banner_advertisement_url) : '#';
                $covernews_open_on_new_tab = covernews_get_option('banner_advertisement_open_on_new_tab');
                $covernews_open_on_new_tab = ('' != $covernews_open_on_new_tab) ? '_blank' : '';

            ?>
                <div class="promotion-section">
                    <a href="<?php echo esc_url($covernews_banner_advertisement_url); ?>" target="<?php echo esc_attr($covernews_open_on_new_tab); ?>">
                        <?php echo wp_kses_post($covernews_banner_advertisement); ?>
                    </a>
                </div>
            <?php endif; ?>

        </div>
        <!-- Trending line END -->
    <?php
    }

    if (is_active_sidebar('home-advertisement-widgets')) : ?>
        <div class="banner-promotions-wrapper">
            <div class="promotion-section">
                <?php dynamic_sidebar('home-advertisement-widgets'); ?>
            </div>
        </div>
<?php endif;
}
add_action('covernews_action_banner_advertisement', 'newsment_banner_advertisement', 10);

function newsment_filter_default_theme_options($defaults)
{
    $defaults['site_title_font_size'] = 52;
    $defaults['banner_advertisement_scope'] = 'site-wide';
    return $defaults;
}

add_filter('covernews_filter_default_theme_options', 'newsment_filter_default_theme_options', 1);

function newsment_filter_custom_header_args($header_args)
{
    $header_args['default-image'] = get_stylesheet_directory_uri() . '/assets/img/default-header-image.jpeg';
    $header_args['default-text-color'] = 'ffffff';
    return $header_args;
}

add_filter('covernews_custom_header_args', 'newsment_filter_custom_header_args', 1);
