<?php
if (!class_exists('ChromeNews_Posts_Slider')) :
    /**
     * Adds ChromeNews_Posts_Slider widget.
     */
    class ChromeNews_Posts_Slider extends ChromeNews_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('chromenews-posts-slider-title','chromenews-number-of-posts');
            $this->select_fields = array('chromenews-select-category');

            $widget_ops = array(
                'classname' => 'chromenews_posts_slider_widget aft-widget',
                'description' => __('Displays posts slider from selected category.', 'chromenews'),
                'customize_selective_refresh' => false,
            );

            parent::__construct('chromenews_posts_slider', __('AFTA Posts Slider', 'chromenews'), $widget_ops);
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


            /** This filter is documented in wp-includes/default-widgets.php */
            $chromenews_posts_slider_title = apply_filters('widget_title', $instance['chromenews-posts-slider-title'], $instance, $this->id_base);
            $chromenews_category = isset($instance['chromenews-select-category']) ? $instance['chromenews-select-category'] : 0;
            $number_of_posts = 5;

            $color_class = '';
            if(absint($chromenews_category) > 0){
                $color_id = "category_color_" . $chromenews_category;
                // retrieve the existing value(s) for this meta field. This returns an array
                $term_meta = get_option($color_id);
                $color_class = ($term_meta) ? $term_meta['color_class_term_meta'] : 'category-color-1';
            }
          
            // open the widget container
            echo $args['before_widget'];
            ?>
            <?php
            
            ?>
            <section class="aft-blocks pad-v">
                <div class="af-slider-wrap">
    
                    <?php if (!empty($chromenews_posts_slider_title)): ?>
                        <?php chromenews_render_section_title($chromenews_posts_slider_title, $color_class); ?>
                    <?php endif; ?>
                    <div class="widget-block widget-wrapper af-widget-body">
                        <div class="af-posts-slider af-widget-post-slider posts-slider banner-slider-2  af-posts-slider af-widget-carousel af-cat-widget-carousel slick-wrapper">
                            <?php
                                $chromenews_slider_posts = chromenews_get_posts($number_of_posts, $chromenews_category);
                                if ($chromenews_slider_posts->have_posts()) :
                                    while ($chromenews_slider_posts->have_posts()) : $chromenews_slider_posts->the_post();
            
                                        global $post;

                                        ?>
                                        <div class="slick-item">
                                            <?php do_action('chromenews_action_loop_grid', $post->ID, 'grid-design-texts-over-image', 'large'); ?>
                                        </div>
                                    <?php
                                    endwhile;
                                endif;
                                wp_reset_postdata();
                            ?>
                        </div>
                        <div class="af-widget-post-slider-navcontrols af-slick-navcontrols"></div>
                    </div>
                </div>
            </section>

            <?php
            // close the widget container
            echo $args['after_widget'];
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
            

            $categories = chromenews_get_terms();
            if (isset($categories) && !empty($categories)) {
                // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
                echo parent::chromenews_generate_text_input('chromenews-posts-slider-title', __('Title', 'chromenews'), 'Posts Slider');

                echo parent::chromenews_generate_select_options('chromenews-select-category', __('Select category', 'chromenews'), $categories);
                
            }
        }
    }
endif;