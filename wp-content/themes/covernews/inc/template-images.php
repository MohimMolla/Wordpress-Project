<?php
/**
 * Custom template images for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package CoverNews
 */


if ( ! function_exists( 'covernews_post_thumbnail' ) ) :
    /**
     * Displays an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index views, or a div
     * element when on single views.
     */
    function covernews_post_thumbnail() {
        if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
            return;
        }

        global $post;

        if ( is_singular() ) :

            $theme_class = covernews_get_option('global_image_alignment');
            $post_image_alignment = get_post_meta($post->ID, 'covernews-meta-image-options', true);
            $post_class = !empty($post_image_alignment) ? $post_image_alignment : $theme_class;

            if ( $post_class != 'no-image' ):
                ?>
                <div class="post-thumbnail <?php echo esc_attr($post_class); ?>">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>

        <?php else :
            $archive_layout = covernews_get_option('archive_layout');
            $archive_layout = $archive_layout;
            $archive_class = '';
            if ($archive_layout == 'archive-layout-list') {
                $archive_image_alignment = covernews_get_option('archive_image_alignment');
                $archive_class = $archive_image_alignment;
                $archive_image = 'medium';
            } elseif ($archive_layout == 'archive-layout-full') {
                $archive_image = 'large';
            } else {
                $archive_image = 'post-thumbnail';
            }

            ?>
            <div class="post-thumbnail <?php echo esc_attr($archive_class); ?>">
                <a href="<?php the_permalink(); ?>" aria-hidden="true">
                    <?php
                    the_post_thumbnail( $archive_image, array(
                        'alt' => the_title_attribute( array(
                            'echo' => false,
                        ) ),
                    ) );
                    ?>
                </a>
            </div>

        <?php endif; // End is_singular().
    }
endif;



if (!function_exists('covernews_the_post_thumbnail')) :
    /**
     * Displays an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index views, or a div
     * element when on single views.
     */
    function covernews_the_post_thumbnail($covernews_thumbnail_size, $covernews_post_id, $return = false)
    {

       
        if (get_the_post_thumbnail($covernews_post_id) != '') {            
            if ($return) {
                return get_the_post_thumbnail($covernews_post_id, $covernews_thumbnail_size);
            } else {
                the_post_thumbnail($covernews_thumbnail_size);
            }
        } else {
            
            $covernews_img_url = '';
            ob_start();
            ob_end_clean();
            $covernews_post_content = get_post_field('post_content', $covernews_post_id);
            $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $covernews_post_content, $matches);
            
            if (isset($matches[1][0])) {

                $covernews_img_id = covernews_find_post_id_from_path($matches[1][0]);
                $covernews_img_url = wp_get_attachment_image_src($covernews_img_id, $covernews_thumbnail_size);
                if (isset($covernews_img_url[0])) {
                    if ($return) {
                        $covernews_img_html = wp_get_attachment_image($covernews_img_id, $covernews_thumbnail_size);
                        return $covernews_img_html;
                    } else {
                        echo wp_kses_post(wp_get_attachment_image($covernews_img_id, $covernews_thumbnail_size));
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
function covernews_find_post_id_from_path($path)
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