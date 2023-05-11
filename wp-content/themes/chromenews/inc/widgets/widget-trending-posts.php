<?php

if (!class_exists('ChromeNews_Trending_Posts')) :
    /**
     * Adds ChromeNews_Prime_News widget.
     */
    class ChromeNews_Trending_Posts extends ChromeNews_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array(
                'chromenews-trending-news-title',
                'chromenews-number-of-posts',

            );
            $this->select_fields = array(

                'chromenews-news_filter-by',
                'chromenews-select-category',

            );

            $widget_ops = array(
                'classname' => 'chromenews_trending_news_widget',
                'description' => __('Displays grid from selected categories.', 'chromenews'),
                'customize_selective_refresh' => false,
            );

            parent::__construct('chromenews_trending_news', __('AFTA Trending News', 'chromenews'), $widget_ops);
        }

        /**
         * Front-end display of widget.
         *
         * @see WP_Widget::widget()
         *
         * @param array $args Widget arguments.
         * @param array $instance Saved values from database.
         */

        public function widget($args, $instance)
        {

            $instance = parent::chromenews_sanitize_data($instance, $instance);

            $chromenews_trending_news_section_title = apply_filters('widget_title', $instance['chromenews-trending-news-title'], $instance, $this->id_base);

            $chromenews_no_of_post = 5;
            $chromenews_category = !empty($instance['chromenews-select-category']) ? $instance['chromenews-select-category'] : '0';
            $chromenews_posts_filter_by = !empty($instance['chromenews-news_filter-by']) ? $instance['chromenews-news_filter-by'] : 'cat';

            $color_class = '';
            if (absint($chromenews_category) > 0) {
                $color_id = "category_color_" . $chromenews_category;
                // retrieve the existing value(s) for this meta field. This returns an array
                $term_meta = get_option($color_id);
                $color_class = ($term_meta) ? $term_meta['color_class_term_meta'] : 'category-color-1';
            }

            // open the widget container
            echo $args['before_widget']; ?>
            <div class="full-wid-resp pad-v">
                <?php

                if (!empty($chromenews_trending_news_section_title)) { ?>
                    <?php chromenews_render_section_title($chromenews_trending_news_section_title, $color_class); ?>
                <?php }
                ?>
                <div class="slick-wrapper af-trending-widget-carousel af-post-carousel-list banner-vertical-slider af-widget-carousel af-widget-body">

                    <?php

                    $chromenews_filterby = 'cat';
                    $chromenews_number_of_posts = 1;
                    if ($chromenews_no_of_post) {
                        $chromenews_number_of_posts = $chromenews_no_of_post;
                    }
                    $chromenews_featured_posts = chromenews_get_posts($chromenews_number_of_posts, $chromenews_category, $chromenews_filterby);
                    if ($chromenews_featured_posts->have_posts()) :
                        $chromenews_count = 1;
                        while ($chromenews_featured_posts->have_posts()) :
                            $chromenews_featured_posts->the_post();
                            global $post;

                    ?>
                            <div class="slick-item pad">
                                <div class="aft-trending-posts list-part af-sec-post">
                                    <?php do_action('chromenews_action_loop_list', $post->ID, 'thumbnail', $chromenews_count, false, true, false); ?>
                                </div>
                            </div>
                        <?php
                            $chromenews_count++;
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    <?php endif; ?>

                </div>
                <div class="af-widget-trending-carousel-navcontrols af-slick-navcontrols"></div>
            </div>
<?php echo $args['after_widget'];
        }

        /**
         * Back-end widget form.
         *
         * @see WP_Widget::form()
         *
         * @param array $instance Previously saved values from database.
         */
        public function form($instance)
        {
            $this->form_instance = $instance;


            $trending_news_layout = array(
                'layout-1' => "Layout 1",
                'layout-2' => "Layout 1"
            );
            $trending_news_filterby = array(
                'cat' => "Category",
                'tag' => "Tag"
            );
            $featured_image = array(
                'yes' => 'Yes',
                'no' => 'No'
            );
            $categories = chromenews_get_terms();

            echo parent::chromenews_generate_text_input('chromenews-trending-news-title', __('Title', 'chromenews'), 'Trending News');            
            echo parent::chromenews_generate_select_options('chromenews-select-category', __('Select Category', 'chromenews'), $categories);
           
        }
    }

endif;
