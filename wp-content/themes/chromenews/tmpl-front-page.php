<?php
 /* Template Name: Frontpage Widgets Template */

get_header();
if ( 'posts' == get_option( 'show_on_front' ) ) {
    include( get_home_template() );
} else {

    
    /**
     * chromenews_action_sidebar_section hook
     * @since Newsium 1.0.0
     *
     * @hooked chromenews_front_page_section -  20
     * @sub_hooked chromenews_front_page_section -  20
     */
    do_action('chromenews_front_page_section');


}
get_footer();