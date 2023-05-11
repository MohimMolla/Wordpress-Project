<?php

// Load widget base.
require_once get_template_directory() . '/inc/widgets/widgets-base.php';


/* Theme Widget sidebars. */
require get_template_directory() . '/inc/widgets/widgets-common-functions.php';

/**
 * Load Init for Hook files.
 */

require get_template_directory() . '/inc/widgets/widgets-register-sidebars.php';




/*
* Load Post List
*/

require get_template_directory() . '/inc/widgets/widget-posts-grid.php';

/*
* Load Express Posts List
*/

require get_template_directory() . '/inc/widgets/widget-express-posts-list.php';


/*
* Load Post List
*/

require get_template_directory() . '/inc/widgets/widget-posts-single-column.php';

/*
* Load Post List
*/

require get_template_directory() . '/inc/widgets/widget-posts-double-column.php';



/*
 * Load Trending Posts
 */

require get_template_directory() . '/inc/widgets/widget-trending-posts.php';


/*
 * Load Prime News
 */

require get_template_directory() . '/inc/widgets/widget-author-info.php';

/*
 * Load Posts Slider
 */

require get_template_directory() . '/inc/widgets/widget-posts-slider.php';

/*
 * Load Post Tabs
 */

require get_template_directory() . '/inc/widgets/widget-posts-list.php';


/*
* Load Social contact
*/

require get_template_directory() . '/inc/widgets/widget-social-contacts.php';




/* Register site widgets */
if (!function_exists('chromenews_widgets')) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function chromenews_widgets()
    {
        register_widget('ChromeNews_author_info');        
        register_widget('ChromeNews_Express_Posts_List');        
        register_widget('ChromeNews_Express_Posts_Single_Column');
        register_widget('ChromeNews_Express_Posts_Double_Column');
        register_widget('ChromeNews_Featured_Post');
        register_widget('ChromeNews_Posts_Slider');        
        register_widget('ChromeNews_Posts_lists');        
        register_widget('ChromeNews_Trending_Posts');        
        register_widget('ChromeNews_Social_Contacts');


    }
endif;
add_action('widgets_init', 'chromenews_widgets');