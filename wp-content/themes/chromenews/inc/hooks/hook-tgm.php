<?php
/**
 * Recommended plugins
 *
 * @package ChromeNews
 */

if ( ! function_exists( 'chromenews_recommended_plugins' ) ) :

    /**
     * Recommend plugins.
     *
     * @since 1.0.0
     */
    function chromenews_recommended_plugins() {

        $plugins = array(
            array(
                'name'     => esc_html__( 'AF Companion', 'chromenews' ),
                'slug'     => 'af-companion',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'Templatespare', 'chromenews' ),
                'slug'     => 'templatespare',
                'required' => false,
    
            ),
            array(
                'name'     => esc_html__( 'Elespare', 'chromenews' ),
                'slug'     => 'elespare',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'Blockspare', 'chromenews' ),
                'slug'     => 'blockspare',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'Latest Posts Block', 'chromenews' ),
                'slug'     => 'latest-posts-block-lite',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'Free Live Chat using 3CX', 'chromenews' ),
                'slug'     => 'wp-live-chat-support',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'Magic Content Box', 'chromenews' ),
                'slug'     => 'magic-content-box-lite',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'WP Post Author', 'chromenews' ),
                'slug'     => 'wp-post-author',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'Frontend Post Submission', 'chromenews' ),
                'slug'     => 'frontend-post-submission-manager-lite',
                'required' => false,
            )
        );

        tgmpa( $plugins );

    }

endif;

add_action( 'tgmpa_register', 'chromenews_recommended_plugins' );
