<?php
if (!function_exists('chromenews_archive_layout_selection')) :
    /**
     *
     * @param null
     *
     * @return null
     *
     * @since ChromeNews 1.0.0
     *
     */
    function chromenews_archive_layout_selection($chromenews_archive_layout = 'default')
    {

        switch ($chromenews_archive_layout) {

            case "archive-layout-list":
                chromenews_get_block('list', 'archive');
                break;
            default:
                chromenews_get_block('grid', 'archive');
        }
    }
endif;

if (!function_exists('chromenews_archive_layout')) :
    /**
     *
     * @param null
     *
     * @return null
     *
     * @since ChromeNews 1.0.0
     *
     */
    function chromenews_archive_layout($cat_slug = '')
    {

        $chromenews_archive_args = chromenews_archive_layout_class($cat_slug);
        if (!empty($chromenews_archive_args['data_mh'])) : ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class($chromenews_archive_args['add_archive_class']); ?> data-mh="<?php echo esc_attr($chromenews_archive_args['data_mh']); ?>">
                <?php chromenews_archive_layout_selection($chromenews_archive_args['archive_layout']); ?>
            </article>
        <?php else : ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class($chromenews_archive_args['add_archive_class']); ?>>
                <?php chromenews_archive_layout_selection($chromenews_archive_args['archive_layout']); ?>
            </article>
        <?php endif; ?>

    <?php

    }

    add_action('chromenews_action_archive_layout', 'chromenews_archive_layout', 10, 1);
endif;

function chromenews_archive_layout_class($chromenews_cat_slug)
{

    $chromenews_archive_args = [];
    $chromenews_archive_class = chromenews_get_option('archive_layout');
    $chromenews_archive_layout_list = chromenews_get_option('archive_image_alignment');
    $chromenews_archive_layout_grid = chromenews_get_option('archive_image_alignment_grid');

    if ($chromenews_archive_class == 'archive-layout-list') {
        $chromenews_archive_args['archive_layout'] = 'archive-layout-list';
        $chromenews_archive_args['add_archive_class'] = 'latest-posts-list col-1 float-l pad';
        $chromenews_archive_args['data_mh'] = '';
        $chromenews_image_align_class = $chromenews_archive_layout_list;
        $chromenews_archive_args['add_archive_class'] .= ' ' . $chromenews_archive_class . ' ' . $chromenews_image_align_class;
    } else {
        $chromenews_archive_args['archive_layout'] = 'archive-layout-grid';
        $chromenews_archive_args['add_archive_class'] = 'af-sec-post latest-posts-grid col-3 float-l pad ';
        $chromenews_archive_layout_mode = $chromenews_archive_layout_grid;
        if ($chromenews_archive_layout_mode == 'archive-image-full-alternate' || $chromenews_archive_layout_mode == 'archive-image-list-alternate') {
            $chromenews_archive_args['data_mh'] = '';
        } else {
            $chromenews_archive_args['data_mh'] = 'archive-layout-grid';
        }
        $chromenews_image_align_class = $chromenews_archive_layout_grid;
        $chromenews_archive_args['add_archive_class'] .= ' ' . $chromenews_archive_class . ' ' . $chromenews_image_align_class;
    }

    return $chromenews_archive_args;
}


//Archive div wrap before loop

if (!function_exists('chromenews_archive_layout_before_loop')) :

    /**
     *
     * @param null
     *
     * @return null
     *
     * @since ChromeNews 1.0.0
     *
     */

    function chromenews_archive_layout_before_loop()
    {

        //check is category
        $chromenews_archive_class = '';
        $chromenews_archive_mode = chromenews_get_option('archive_layout');
        //grid layout option
        if ($chromenews_archive_mode == 'archive-layout-grid') {
            $chromenews_archive_class = $chromenews_archive_mode . " " . 'two-col-masonry';
        } else {
            $chromenews_archive_class = $chromenews_archive_mode;
        }
    ?>
        <div id="aft-archive-wrapper" class="af-container-row aft-archive-wrapper chromenews-customizer clearfix <?php echo esc_attr($chromenews_archive_class); ?>">
        <?php

    }

    add_action('chromenews_archive_layout_before_loop', 'chromenews_archive_layout_before_loop');
endif;

if (!function_exists('chromenews_archive_layout_after_loop')) :

    function chromenews_archive_layout_after_loop()
    {
        ?>
        </div>
<?php }

    add_action('chromenews_archive_layout_after_loop', 'chromenews_archive_layout_after_loop');

endif;