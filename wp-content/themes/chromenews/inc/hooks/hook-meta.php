<?php
/**
 * Implement theme metabox.
 *
 * @package ChromeNews
 */

if (!function_exists('chromenews_add_theme_meta_box')) :

    /**
     * Add the Meta Box
     *
     * @since 1.0.0
     */
    function chromenews_add_theme_meta_box()
    {

        $chromenews_screens = array('post', 'page');

        foreach ($chromenews_screens as $screen) {
            add_meta_box(
                'chromenews-theme-settings',
                esc_html__('Layout Options', 'chromenews'),
                'chromenews_render_layout_options_metabox',
                $screen,
                'side',
                'low'


            );
        }

    }

endif;

add_action('add_meta_boxes', 'chromenews_add_theme_meta_box');

if (!function_exists('chromenews_render_layout_options_metabox')) :

    /**
     * Render theme settings meta box.
     *
     * @since 1.0.0
     */
    function chromenews_render_layout_options_metabox($post, $metabox)
    {

        $chromenews_post_id = $post->ID;

        // Meta box nonce for verification.
        wp_nonce_field(basename(__FILE__), 'chromenews_meta_box_nonce');
        // Fetch Options list.
        $chromenews_content_layout = get_post_meta($chromenews_post_id, 'chromenews-meta-content-alignment', true);
        $chromenews_global_single_content_mode = get_post_meta($chromenews_post_id, 'chromenews-meta-content-mode', true);

        if (empty($chromenews_content_layout)) {
            $chromenews_content_layout = chromenews_get_option('global_content_alignment');
        }

        if (empty($chromenews_global_single_content_mode)) {
            $chromenews_global_single_content_mode = chromenews_get_option('global_single_content_mode');
        }


        ?>
        <div id="chromenews-settings-metabox-container" class="chromenews-settings-metabox-container">
            <div id="chromenews-settings-metabox-tab-layout">

                <div class="chromenews-row-content">
                    <!-- Select Field-->
                    <h3><?php esc_html_e('Content Options', 'chromenews') ?></h3>
                    <p>
                        <select name="chromenews-meta-content-mode" id="chromenews-meta-content-mode">

                            <option value="" <?php selected('', $chromenews_global_single_content_mode); ?>>
                                <?php esc_html_e('Set as global layout', 'chromenews') ?>
                            </option>
                            <option value="single-content-mode-boxed" <?php selected('single-content-mode-boxed', $chromenews_global_single_content_mode); ?>>
                                <?php esc_html_e('Spacious', 'chromenews') ?>
                            </option>
                            <option value="single-content-mode-compact" <?php selected('single-content-mode-compact', $chromenews_global_single_content_mode); ?>>
                                <?php esc_html_e('Compact', 'chromenews') ?>
                            </option>


                        </select>
                    </p>
                    <small><?php esc_html_e('Please go to Customize>Themes Options for Single Post/Page.', 'chromenews')?></small>

                </div><!-- .chromenews-row-content -->
                <div class="chromenews-row-content">
                    <!-- Select Field-->
                    <h3><?php esc_html_e('Sidebar Options', 'chromenews') ?></h3>
                    <p>
                        <select name="chromenews-meta-content-alignment" id="chromenews-meta-content-alignment">

                            <option value="" <?php selected('', $chromenews_content_layout); ?>>
                                <?php esc_html_e('Set as global layout', 'chromenews') ?>
                            </option>
                            <option value="align-content-left" <?php selected('align-content-left', $chromenews_content_layout); ?>>
                                <?php esc_html_e('Content - Primary Sidebar', 'chromenews') ?>
                            </option>
                            <option value="align-content-right" <?php selected('align-content-right', $chromenews_content_layout); ?>>
                                <?php esc_html_e('Primary Sidebar - Content', 'chromenews') ?>
                            </option>
                            <option value="full-width-content" <?php selected('full-width-content', $chromenews_content_layout); ?>>
                                <?php esc_html_e('No Sidebar', 'chromenews') ?>
                            </option>
                        </select>
                    </p>
                    <small><?php esc_html_e('Please go to Customize>Frontpage Options for Homepage.', 'chromenews')?></small>

                </div><!-- .chromenews-row-content -->

            </div><!-- #chromenews-settings-metabox-tab-layout -->
        </div><!-- #chromenews-settings-metabox-container -->

        <?php
    }

endif;


if (!function_exists('chromenews_save_layout_options_meta')) :

    /**
     * Save theme settings meta box value.
     *
     * @since 1.0.0
     *
     * @param int $chromenews_post_id Post ID.
     * @param WP_Post $post Post object.
     */
    function chromenews_save_layout_options_meta($chromenews_post_id, $post)
    {

        // Verify nonce.
        if (!isset($_POST['chromenews_meta_box_nonce']) || !wp_verify_nonce($_POST['chromenews_meta_box_nonce'], basename(__FILE__))) {
            return;
        }

        // Bail if auto save or revision.
        if (defined('DOING_AUTOSAVE') || is_int(wp_is_post_revision($post)) || is_int(wp_is_post_autosave($post))) {
            return;
        }

        // Check the post being saved == the $chromenews_post_id to prevent triggering this call for other save_post events.
        if (empty($_POST['post_ID']) || $_POST['post_ID'] != $chromenews_post_id) {
            return;
        }

        // Check permission.
        if ('page' == $_POST['post_type']) {
            if (!current_user_can('edit_page', $chromenews_post_id)) {
                return;
            }
        } else if (!current_user_can('edit_post', $chromenews_post_id)) {
            return;
        }

        $chromenews_content_layout = isset($_POST['chromenews-meta-content-alignment']) ? $_POST['chromenews-meta-content-alignment'] : '';
        $chromenews_global_single_content_mode = isset($_POST['chromenews-meta-content-mode']) ? $_POST['chromenews-meta-content-mode'] : '';
        update_post_meta($chromenews_post_id, 'chromenews-meta-content-alignment', sanitize_text_field($chromenews_content_layout));
        update_post_meta($chromenews_post_id, 'chromenews-meta-content-mode', sanitize_text_field($chromenews_global_single_content_mode));


    }

endif;

add_action('save_post', 'chromenews_save_layout_options_meta', 10, 2);


//Category fields meta starts


if (!function_exists('chromenews_taxonomy_add_new_meta_field')) :
// Add term page
    function chromenews_taxonomy_add_new_meta_field()
    {
        // this will add the custom meta field to the add new term page

        $chromenews_cat_color = array(
            'category-color-1' => __('Category Color 1', 'chromenews'),
            'category-color-2' => __('Category Color 2', 'chromenews'),
            'category-color-3' => __('Category Color 3', 'chromenews'),
            

        );
        ?>
        <div class="form-field">
            <label for="term_meta[color_class_term_meta]"><?php esc_html_e('Color Class', 'chromenews'); ?></label>
            <select id="term_meta[color_class_term_meta]" name="term_meta[color_class_term_meta]">
                <?php foreach ($chromenews_cat_color as $key => $value): ?>
                    <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                <?php endforeach; ?>
            </select>
            <p class="description"><?php esc_html_e('Select category color class. You can set appropriate categories color on "Categories" section of the theme customizer.', 'chromenews'); ?></p>
        </div>
        <?php
    }
endif;
add_action('category_add_form_fields', 'chromenews_taxonomy_add_new_meta_field', 10, 2);


if (!function_exists('chromenews_taxonomy_edit_meta_field')) :
// Edit term page
    function chromenews_taxonomy_edit_meta_field($term)
    {

        // put the term ID into a variable
        $chromenews_t_id = $term->term_id;

        // retrieve the existing value(s) for this meta field. This returns an array
        $chromenews_term_meta = get_option("category_color_$chromenews_t_id");

        ?>
        <tr class="form-field">
            <th scope="row" valign="top"><label
                        for="term_meta[color_class_term_meta]"><?php esc_html_e('Color Class', 'chromenews'); ?></label></th>
            <td>
                <?php
                $chromenews_cat_color = array(
                    'category-color-1' => __('Category Color 1', 'chromenews'),
                    'category-color-2' => __('Category Color 2', 'chromenews'),
                    'category-color-3' => __('Category Color 3', 'chromenews'),
                    

                );
                ?>
                <select id="term_meta[color_class_term_meta]" name="term_meta[color_class_term_meta]">
                    <?php foreach ($chromenews_cat_color as $key => $value): ?>
                        <option value="<?php echo esc_attr($key); ?>"<?php selected(isset($chromenews_term_meta['color_class_term_meta'])?$chromenews_term_meta['color_class_term_meta']:'', $key); ?>><?php echo esc_html($value); ?></option>
                    <?php endforeach; ?>
                </select>
                <p class="description"><?php esc_html_e('Select category color class. You can set appropriate categories color on "Categories" section of the theme customizer.', 'chromenews'); ?></p>
            </td>
        </tr>
        <?php
    }
endif;
add_action('category_edit_form_fields', 'chromenews_taxonomy_edit_meta_field', 10, 2);



if (!function_exists('chromenews_save_taxonomy_color_class_meta')) :
    // Save extra taxonomy fields callback function.
        function chromenews_save_taxonomy_color_class_meta($chromenews_term_id)
        {
            if (isset($_POST['term_meta'])) {
                $chromenews_t_id = $chromenews_term_id;
                $chromenews_term_meta = get_option("category_color_$chromenews_t_id");
                $chromenews_cat_keys = array_keys($_POST['term_meta']);
                foreach ($chromenews_cat_keys as $key) {
                    if (isset ($_POST['term_meta'][$key])) {
                        $chromenews_term_meta[$key] = $_POST['term_meta'][$key];
                    }
                }
                // Save the option array.
                update_option("category_color_$chromenews_t_id", $chromenews_term_meta);
            }
        }
    
    endif;
    add_action('edited_category', 'chromenews_save_taxonomy_color_class_meta', 10, 2);
    add_action('create_category', 'chromenews_save_taxonomy_color_class_meta', 10, 2);