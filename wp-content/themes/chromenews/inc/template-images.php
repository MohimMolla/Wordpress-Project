<?php

/**
 * Custom template images for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package ChromeNews
 */


if (!function_exists('chromenews_post_thumbnail')) :
    /**
     * Displays an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index views, or a div
     * element when on single views.
     */
    function chromenews_post_thumbnail()
    {
        if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
            return;
        }

        global $post;

        if (is_singular()) :

            $chromenews_theme_class = chromenews_get_option('global_image_alignment');
            $chromenews_post_image_alignment = get_post_meta($post->ID, 'chromenews-meta-image-options', true);
            $chromenews_post_class = !empty($chromenews_post_image_alignment) ? $chromenews_post_image_alignment : $chromenews_theme_class;

            if ($chromenews_post_class != 'no-image') :
?>
                <div class="post-thumbnail <?php echo esc_attr($chromenews_post_class); ?>">
                    <?php the_post_thumbnail('full'); ?>
                </div>
            <?php endif; ?>

        <?php else :
            $chromenews_archive_layout = chromenews_get_option('archive_layout');
            $chromenews_archive_layout = $chromenews_archive_layout;
            $chromenews_archive_class = '';
            if ($chromenews_archive_layout == 'archive-layout-list') {
                $chromenews_archive_image_alignment = chromenews_get_option('archive_image_alignment');
                $chromenews_archive_class = $chromenews_archive_image_alignment;
                $chromenews_archive_image = 'medium';
            } elseif ($chromenews_archive_layout == 'archive-layout-full') {
                $chromenews_archive_image = 'large';
            } else {
                $chromenews_archive_image = 'thumbnail';
            }

        ?>
            <div class="post-thumbnail <?php echo esc_attr($chromenews_archive_class); ?>">
                <a href="<?php the_permalink(); ?>" aria-hidden="true">
                    <?php
                    the_post_thumbnail($chromenews_archive_image, array(
                        'alt' => the_title_attribute(array(
                            'echo' => false,
                        )),
                    ));
                    ?>
                </a>
            </div>

<?php endif; // End is_singular().
    }
endif;


if (!function_exists('chromenews_post_content_thumbnail')) :
    /**
     * Displays an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index views, or a div
     * element when on single views.
     */
    function chromenews_the_post_thumbnail($chromenews_thumbnail_size, $chromenews_post_id, $return = false)
    {

        global $post;
        if (get_the_post_thumbnail($chromenews_post_id) != '') {
            if ($return) {
                return get_the_post_thumbnail($chromenews_post_id, $chromenews_thumbnail_size);
            } else {
                the_post_thumbnail($chromenews_thumbnail_size);
            }
        } else {
            $chromenews_img_url = '';
            ob_start();
            ob_end_clean();
            $chromenews_post_content = get_post_field('post_content', $chromenews_post_id);
            $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $chromenews_post_content, $matches);

            if (isset($matches[1][0])) {

                $chromenews_img_id = chromenews_find_post_id_from_path($matches[1][0]);
                $chromenews_img_url = wp_get_attachment_image_src($chromenews_img_id, $chromenews_thumbnail_size);
                if (isset($chromenews_img_url[0])) {
                    if ($return) {
                        $chromenews_img_html = wp_get_attachment_image($chromenews_img_id, $chromenews_thumbnail_size);
                        return $chromenews_img_html;
                    } else {
                        echo wp_kses_post(wp_get_attachment_image($chromenews_img_id, $chromenews_thumbnail_size));
                    }
                } else {
                    if (@getimagesize($matches[1][0])) {
            ?>
                        <img src="<?php echo $matches[1][0]; ?>" />
<?php

                    }
                }
            }
        }
    }
endif;


/**
 * Find the post ID for a file PATH or URL
 *
 * @param string $path
 *
 * @return int
 */
function chromenews_find_post_id_from_path($path)
{
    // detect if is a media resize, and strip resize portion of file name
    if (preg_match('/(-\d{1,4}x\d{1,4})\.(jpg|jpeg|png|gif)$/i', $path, $matches)) {
        $path = str_ireplace($matches[1], '', $path);
    }

    // process and include the year / month folders so WP function below finds properly
    if (preg_match('/uploads\/(\d{1,4}\/)?(\d{1,2}\/)?(.+)$/i', $path, $matches)) {
        unset($matches[0]);
        $path = implode('', $matches);
    }

    // at this point, $path contains the year/month/file name (without resize info)

    // call WP native function to find post ID properly
    return attachment_url_to_postid($path);
}
