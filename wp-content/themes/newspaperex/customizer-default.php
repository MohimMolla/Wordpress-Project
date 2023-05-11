<?php
/**
 * Default theme options.
 *
 * @package Newspaperex
 */

if (!function_exists('newspaperex_get_default_theme_options')):

/**
 * Get default theme options
 *
 * @since 1.0.0
 *
 * @return array Default theme options.
 */
function newspaperex_get_default_theme_options() {

    $defaults = array();

    $defaults['select_editor_news_category'] = 0;
    $defaults['banner_right_advertisement_section'] = '';
    $defaults['banner_right_advertisement_section_url ']='#';
    $defaults['banner_left_advertisement_section_url ']='#';


	return $defaults;

}
endif;