<?php
    /**
     * List block part for displaying page content in page.php
     *
     * @package ChromeNews
     */


$chromenews_thumbnail_size = 'medium';
$chromenews_grid_design ='grid-design-default';

$chromenews_term_meta_grid = '';
if(is_category()){
    $chromenews_queried_object = get_queried_object();
    $chromenews_t_id = $chromenews_queried_object->term_id;
    $chromenews_term_meta_grid = get_option("category_layout_grid_$chromenews_t_id");
}

if (!empty($chromenews_term_meta_grid)) {
    $chromenews_archive_image = $chromenews_term_meta_grid['archive_layout_alignment_term_meta_gird'];
} else {
    $chromenews_archive_image = chromenews_get_option('archive_image_alignment_grid');
}

if($chromenews_archive_image  == 'archive-image-tile'){
    $chromenews_grid_design ='grid-design-texts-over-image';
}



$chromenews_content_view = chromenews_get_option('archive_content_view');
$chromenews_show_excerpt = true;
if($chromenews_content_view == 'archive-content-none'){
    $chromenews_show_excerpt = false;
}
?>

<div class="archive-grid-post">
    <?php do_action('chromenews_action_loop_grid', $post->ID, $chromenews_grid_design, $chromenews_thumbnail_size, $chromenews_show_excerpt, $chromenews_content_view); ?>

    <?php
        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'chromenews'),
            'after' => '</div>',
        ));
    ?>
</div>








