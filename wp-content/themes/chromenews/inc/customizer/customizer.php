<?php
/**
 * ChromeNews Theme Customizer
 *
 * @package ChromeNews
 */

if (!function_exists('chromenews_get_option')):
/**
 * Get theme option.
 *
 * @since 1.0.0
 *
 * @param string $key Option key.
 * @return mixed Option value.
 */
function chromenews_get_option($key) {

	if (empty($key)) {
		return;
	}

	$value = '';

	$default       = chromenews_get_default_theme_options();
	$default_value = null;

	if (is_array($default) && isset($default[$key])) {
		$default_value = $default[$key];
	}

	if (null !== $default_value) {
		$value = get_theme_mod($key, $default_value);
	} else {
		$value = get_theme_mod($key);
	}

	return $value;
}
endif;

// Load customize default values.
require get_template_directory().'/inc/customizer/customizer-callback.php';

// Load customize default values.
require get_template_directory().'/inc/customizer/customizer-default.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function chromenews_customize_register($wp_customize) {

	// Load customize controls.
	require get_template_directory().'/inc/customizer/customizer-control.php';

	// Load customize sanitize.
	require get_template_directory().'/inc/customizer/customizer-sanitize.php';

	$wp_customize->get_setting('blogname')->transport         = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
	$wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    $wp_customize->get_control('background_color')->label = __( 'Background Color', 'chromenews' );

	if (isset($wp_customize->selective_refresh)) {
		$wp_customize->selective_refresh->add_partial('blogname', array(
				'selector'        => '.site-title a',
				'render_callback' => 'chromenews_customize_partial_blogname',
			));
		$wp_customize->selective_refresh->add_partial('blogdescription', array(
				'selector'        => '.site-description',
				'render_callback' => 'chromenews_customize_partial_blogdescription',
			));
	}

    $default = chromenews_get_default_theme_options();

    // Setting - secondary_font.
    $wp_customize->add_setting('site_title_font_size',
        array(
            'default'           => $default['site_title_font_size'],
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control('site_title_font_size',
        array(
            'label'    => esc_html__('Site Title Size', 'chromenews'),
            'section'  => 'title_tagline',
            'type'     => 'number',
            'priority' => 50,
        )
    );

    // Setting - header overlay.
    $wp_customize->add_setting('site_title_uppercase',
        array(
            'default'           => $default['site_title_uppercase'],
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'chromenews_sanitize_checkbox',
        )
    );

    $wp_customize->add_control('site_title_uppercase',
        array(
            'label'    => esc_html__('Uppercase Site Title and Tagline', 'chromenews'),
            'section'  => 'title_tagline',
            'type'     => 'checkbox',
            'priority' => 50,
        )
    );


    $wp_customize->get_section('header_image')->panel = 'site_header_option_panel';

    // use get control
    $wp_customize->get_control( 'header_textcolor')->label = __( 'Site Title/Tagline Color', 'chromenews' );
    $wp_customize->get_control( 'header_textcolor')->section = 'colors';   
    $wp_customize->get_control( 'header_textcolor')->priority = 5;

    // Setting - select_main_banner_section_mode.
    $wp_customize->add_setting('select_header_image_mode',
        array(
            'default'           => $default['select_header_image_mode'],
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'chromenews_sanitize_select',
        )
    );

    $wp_customize->add_control( 'select_header_image_mode',
        array(
            'label'       => esc_html__('Header Image Mode', 'chromenews'),
            'description'       => esc_html__('Image visibility may vary as per the mode', 'chromenews'),
            'section'     => 'header_image',
            'type'        => 'select',
            'choices'               => array(
                'default' => esc_html__( "Set as Background", 'chromenews' ),
                'full' => esc_html__( "Show Full Image", 'chromenews' ),
            ),
            'priority'    => 50
        ));


    // Setting - header overlay.
    $wp_customize->add_setting('enable_header_image_tint_overlay',
        array(
            'default'           => $default['enable_header_image_tint_overlay'],
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'chromenews_sanitize_checkbox',
        )
    );

    $wp_customize->add_control('enable_header_image_tint_overlay',
        array(
            'label'    => esc_html__('Enable Image Tint/Overlay', 'chromenews'),
            'section'  => 'header_image',
            'type'     => 'checkbox',
            'priority' => 50,
        )
    );

   

	/*theme option panel info*/
	require get_template_directory().'/inc/customizer/theme-options.php';

    // Register custom section types.
    $wp_customize->register_section_type( 'ChromeNews_Customize_Section_Upsell' );

    // Register sections.
    $wp_customize->add_section(
        new ChromeNews_Customize_Section_Upsell(
            $wp_customize,
            'theme_upsell',
            array(
                'title'    => esc_html__( 'ChromeNews Pro', 'chromenews' ),
                'pro_text' => esc_html__( 'Upgrade Now', 'chromenews' ),
                'pro_url'  => 'https://www.afthemes.com/products/chromenews-pro/',
                'priority'  => 1,
            )
        )
    );



}
add_action('customize_register', 'chromenews_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function chromenews_customize_partial_blogname() {
	bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function chromenews_customize_partial_blogdescription() {
	bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function chromenews_customize_preview_js() {
	wp_enqueue_script('chromenews-customizer', get_template_directory_uri().'/js/customizer.js', array('customize-preview'), '20151215', true);

}

add_action('customize_preview_init', 'chromenews_customize_preview_js');


function chromenews_customizer_css() {
    wp_enqueue_script( 'chromenews-customize-controls', get_template_directory_uri() . '/assets/customizer-admin.js', array( 'customize-controls' ) );

    wp_enqueue_style( 'chromenews-customize-controls-style', get_template_directory_uri() . '/assets/customizer-admin.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'chromenews_customizer_css',0 );

