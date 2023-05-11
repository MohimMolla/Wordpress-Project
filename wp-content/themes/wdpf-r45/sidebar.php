<div id="sidebar" class="widget-area">
<?php if ( !dynamic_sidebar('sidebar-1') ) : // the ID of the sidebar ?>

<?php get_search_form(); ?>
<!-- all pages in alphabetical order -->
<ul> <?php wp_list_pages('exclude=2'); ?> </ul>
<h3>Categories</h3>
<!-- all categories in alphabetical order -->
<ul> <?php wp_list_categories(); ?> </ul>

<div id="archives" class="widget-container">
<h3 class="widget-title"><?php _e( 'Archives-month wise'); ?></h3>
<ul>
<?php wp_get_archives('type=monthly'); ?>
</ul>
</div>
<div id="archives" class="widget-container">
<h3 class="widget-title"><?php _e( 'Archives-year wise'); ?></h3>
<ul>
<?php wp_get_archives('type=yearly'); ?>
</ul>
</div>

<div id="archives" class="widget-container">
<h3 class="widget-title"><?php _e( 'Archives-year wise'); ?></h3>
<ul>
<?php wp_get_archives('type=daily'); ?>
</ul>
</div>

<?php endif; // end primary widget area ?>
</div><!-- first .widget-area -->