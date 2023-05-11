<?php
if (!class_exists('ChromeNews_Posts_lists')) :
    /**
     * Adds ChromeNews_Posts_lists widget.
     */
    class ChromeNews_Posts_lists extends ChromeNews_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array(
                'chromenews-posts-list-title',
                'chromenews-posts-slider-number'
                
            );
            $this->select_fields = array(

                'chromenews-select-category',
                
            );

            $widget_ops = array(
                'classname' => 'chromenews_posts_lists_widget',
                'description' => __('Displays grid from selected categories.', 'chromenews'),
                'customize_selective_refresh' => false,
            );

            parent::__construct('chromenews_posts_list', __('AFTA Post List', 'chromenews'), $widget_ops);
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

            $title_1 = apply_filters('widget_title', $instance['chromenews-posts-list-title'], $instance, $this->id_base);
    
            $chromenews_no_of_post = 6;
            $chromenews_category = !empty($instance['chromenews-select-category']) ? $instance['chromenews-select-category'] : '0';


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
                <section class="aft-blocks aft-featured-category-section af-list-post featured-cate-sec pad-v">
                    <?php if (!empty($title_1)): ?>
                        <?php chromenews_render_section_title($title_1, $color_class); ?>
                    <?php endif; ?>
                    <?php $chromenews_all_posts_vertical = chromenews_get_posts($chromenews_no_of_post, $chromenews_category); ?>

                    <div class="full-wid-resp af-widget-body af-container-row clearfix">
                        <?php
                            if ($chromenews_all_posts_vertical->have_posts()) :
                                while ($chromenews_all_posts_vertical->have_posts()) : $chromenews_all_posts_vertical->the_post();
                                    global $post;

                                    ?>
                                    <div class="pad float-l col-2">
                                        <?php do_action('chromenews_action_loop_list', $post->ID, 'thumbnail', 0, false, true, false); ?>
                                    </div>
                                <?php
                                endwhile;
                            endif;
                            wp_reset_postdata();
                        ?>
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


            //print_pre($terms);
            $categories = chromenews_get_terms();
            


            if (isset($categories) && !empty($categories)) {
                // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
                echo parent::chromenews_generate_text_input('chromenews-posts-list-title', __('Title', 'chromenews'), 'Posts List');
                echo parent::chromenews_generate_select_options('chromenews-select-category', __('Select Category', 'chromenews'), $categories);
                
            }

            //print_pre($terms);


        }

    }
endif;