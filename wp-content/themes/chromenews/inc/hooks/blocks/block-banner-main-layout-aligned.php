<?php
$chromenews_trending_posts_title = chromenews_get_option('main_trending_news_section_title');
$chromenews_main_posts_title = chromenews_get_option('main_banner_news_section_title');
$chromenews_editors_picks_posts_title = chromenews_get_option('main_editors_picks_section_title');

$chromenews_title_class ='' ;
if(empty($chromenews_main_posts_title)){
    $chromenews_title_class .= 'no-main-slider-title';
}

if(empty($chromenews_trending_posts_title)){
    $chromenews_title_class .= ' no-trending-title';
}

if(empty($chromenews_editors_picks_posts_title)){
    $chromenews_title_class .= ' no-editors-picks-title';
}

?>

<div class="aft-main-banner-part aft-banner-aligned af-container-row-5 <?php echo esc_attr($chromenews_title_class); ?>">

    <div class="aft-slider-part col-1 pad">
        <div class="aft-main-banner-slider-part chromenews-customizer col-66 pad">
            <?php if (!empty($chromenews_main_posts_title)): ?>
                <?php //chromenews_render_section_title($chromenews_main_posts_title); ?>
            <?php endif; ?>
            <?php chromenews_get_block('carousel', 'banner'); ?>
        </div>

        <div class="chromenews-customizer aft-3-trending-posts col-3 pad">
            <?php if (!empty($chromenews_trending_posts_title)): ?>
                <?php chromenews_render_section_title($chromenews_trending_posts_title); ?>
            <?php endif; ?>
            <?php chromenews_get_block('trending', 'banner'); ?>
        </div>
    </div>
    <div class="aft-trending-part col-1 pad">
        <div class="aft-4-thumbs-horizontal aft-horizontal-grid-part chromenews-customizer col-1 pad">
            <?php if (!empty($chromenews_editors_picks_posts_title)): ?>
                <?php chromenews_render_section_title($chromenews_editors_picks_posts_title); ?>
            <?php endif; ?>
            <?php chromenews_get_block('thumb-carousel', 'banner'); ?>
        </div>
    </div>
</div>


