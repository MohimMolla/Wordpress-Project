<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package ChromeNews
 */

if (!function_exists('chromenews_post_categories')) :
    function chromenews_post_categories($chromenews_is_single = false)
    {
        $chromenews_global_show_categories = chromenews_get_option('global_show_categories');
        if ($chromenews_global_show_categories == 'no') {
            return;
        }

        $show_category_number = 0;

        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {
            global $post;
            $chromenews_post_categories = get_the_category($post->ID);
            if ($chromenews_post_categories) {

                $chromenews_output = '<ul class="cat-links">';
                $category_count = 0;
                foreach ($chromenews_post_categories as $post_category) {
                    $chromenews_t_id = $post_category->term_id;
                    $chromenews_color_id = "category_color_" . $chromenews_t_id;

                    // retrieve the existing value(s) for this meta field. This returns an array
                    $chromenews_term_meta = get_option($chromenews_color_id);
                    $chromenews_color_class = ($chromenews_term_meta) ? $chromenews_term_meta['color_class_term_meta'] : 'category-color-1';

                    $chromenews_output .= '<li class="meta-category">
                             <a class="chromenews-categories ' . esc_attr($chromenews_color_class) . '" href="' . esc_url(get_category_link($post_category)) . '">
                                 ' . esc_html($post_category->name) . '
                             </a>
                        </li>';

                    if ($chromenews_is_single == false) {
                        if (++$category_count == $show_category_number) break;
                    }


                }
                $chromenews_output .= '</ul>';
                echo wp_kses_post($chromenews_output);

            }
        }
    }
endif;


if (!function_exists('chromenews_get_category_color_class')) :

    function chromenews_get_category_color_class($term_id)
    {

        $chromenews_color_id = "category_color_" . $term_id;
        // retrieve the existing value(s) for this meta field. This returns an array
        $chromenews_term_meta = get_option($chromenews_color_id);
        $chromenews_color_class = ($chromenews_term_meta) ? $chromenews_term_meta['color_class_term_meta'] : '';
        return $chromenews_color_class;


    }
endif;

if (!function_exists('chromenews_post_item_meta')) :

    function chromenews_post_item_meta($chromenews_post_display = 'spotlight-post')
    {

        global $post;
        if ('post' == get_post_type($post->ID)):

            $chromenews_author_id = $post->post_author;
            $chromenews_date_display_setting = chromenews_get_option('global_date_display_setting');
            $chromenews_author_icon_gravatar_display_setting = chromenews_get_option('global_author_icon_gravatar_display_setting');

            if($chromenews_post_display == 'list-post'){
                $chromenews_post_meta = chromenews_get_option('list_post_date_author_setting');
            }elseif($chromenews_post_display == 'grid-post'){
                $chromenews_post_meta = chromenews_get_option('small_grid_post_date_author_setting');
            }else{
                $chromenews_post_meta = chromenews_get_option('global_post_date_author_setting');

            }

            if ($chromenews_post_meta == 'show-date-only') {
                $chromenews_display_author = false;
                $chromenews_display_date = true;
            } elseif ($chromenews_post_meta == 'show-author-only') {
                $chromenews_display_author = true;
                $chromenews_display_date = false;
            } elseif (($chromenews_post_meta == 'show-date-author')) {
                $chromenews_display_author = true;
                $chromenews_display_date = true;
            } else {
                $chromenews_display_author = false;
                $chromenews_display_date = false;
            }

            ?>


            <span class="author-links">
                <?php if ($chromenews_display_author): ?>
                <span class="item-metadata posts-author byline">
                <?php if ($chromenews_author_icon_gravatar_display_setting == 'display-gravatar'){ 
                     chromenews_by_author($gravatar=true);
                     }elseif ($chromenews_author_icon_gravatar_display_setting == 'display-icon'){?>
                    <i class="far fa-user-circle"></i>
                    <?php   chromenews_by_author($gravatar=false);
                    }else{  
                    chromenews_by_author($gravatar=false);
                    }?>
            </span>
            <?php endif; ?>


            <?php
            if ($chromenews_display_date):             
                $chromenews_date_display_type = chromenews_get_option('global_date_display_type');
                $post_date = chromenews_post_date_meta($chromenews_date_display_type);
            ?>
                <span class="item-metadata posts-date">
                <i class="far fa-clock" aria-hidden="true"></i>
                <a href="<?php echo esc_url(get_month_link(get_post_time('Y'),get_post_time('m'))); ?>">                    
                    <?php echo wp_kses_post($post_date);  ?>
            </a>
            </span>
            <?php endif; ?>

            </span>
        <?php
        endif;

    }
endif;

if (!function_exists('chromenews_post_date_meta')) :

    function chromenews_post_date_meta($display_date_by = 'published')
    {
        $post_date = get_post_modified_time(get_option('date_format'));
        $chromenews_date_display_setting = chromenews_get_option('global_date_display_setting');
        if ($display_date_by == 'modified') {
            if ($chromenews_date_display_setting == 'default-date') {
                $post_date =  get_post_modified_time(get_option('date_format'));
             } else {
                $post_date = __(human_time_diff(get_post_modified_time('U'), current_time('timestamp')) . ' ' . __('ago', 'chromenews'));
            }
        } else {
            if ($chromenews_date_display_setting == 'default-date') {
                $post_date = get_the_time(get_option('date_format'));
            } else {
                $post_date = __(human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ' . __('ago', 'chromenews'));
            }
        }
        return $post_date;
    }
endif;


if (!function_exists('chromenews_post_item_tag')) :

    function chromenews_post_item_tag($view = 'default')
    {
        global $post;

        if ('post' === get_post_type()) {

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', ' ');
            if ($tags_list) {
                /* translators: 1: list of tags. */
                printf('<span class="tags-links">' . esc_html('Tags: %1$s') . '</span>', $tags_list);
            }
        }

        if (is_single()) {
            edit_post_link(
                sprintf(
                    wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                        __('Edit <span class="screen-reader-text">%s</span>', 'chromenews'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                ),
                '<span class="edit-link">',
                '</span>'
            );
        }

    }
endif;