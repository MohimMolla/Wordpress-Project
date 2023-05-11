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

<div class="aft-main-banner-part aft-banner-compressed-aligned af-container-row-5 <?php echo esc_attr($chromenews_title_class); ?>">

    <div class="aft-slider-part col-2 pad">
        <div class="aft-main-banner-slider-part chromenews-customizer">
            <?php if (!empty($chromenews_main_posts_title)): ?>
                <?php //chromenews_render_section_title($chromenews_main_posts_title); ?>
            <?php endif; ?>
            <?php chromenews_get_block('carousel', 'banner'); ?>
        </div>
    </div>

    <div class="aft-thumb-part col-4 pad ">
        <div class="chromenews-customizer">
            <?php if (!empty($chromenews_editors_picks_posts_title)): ?>
                <?php chromenews_render_section_title($chromenews_editors_picks_posts_title); ?>
            <?php endif; ?>
            <?php chromenews_get_block('thumb', 'banner'); ?>
        </div>
    </div>

    <div class="aft-trending-part col-4 aft-4-trending-posts pad">
        <div class="chromenews-customizer">
            <?php if (!empty($chromenews_trending_posts_title)): ?>
                <?php chromenews_render_section_title($chromenews_trending_posts_title); ?>
            <?php endif; ?>
            <?php chromenews_get_block('trending', 'banner'); ?>
        </div>
    </div>



</div>