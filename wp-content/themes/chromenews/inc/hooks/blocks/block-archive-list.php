<?php
    /**
     * List block part for displaying page content in page.php
     *
     * @package ChromeNews
     */
    

    $chromenews_content_view = chromenews_get_option('archive_content_view');
    $chromenews_show_excerpt = true;
    if($chromenews_content_view == 'archive-content-none'){
        $chromenews_show_excerpt = false;
    }

?>
<div class="archive-list-post list-style">
    <?php do_action('chromenews_action_loop_list', $post->ID, 'medium', 0, true, true, $chromenews_show_excerpt, true, $chromenews_content_view); ?>
    <?php
        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'chromenews'),
            'after' => '</div>',
        ));
    ?>
</div>