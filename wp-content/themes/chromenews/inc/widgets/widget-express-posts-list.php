<?php
if (!class_exists('ChromeNews_Express_Posts_List')) :
    /**
     * Adds ChromeNews_Express_Posts_List widget.
     */
    class ChromeNews_Express_Posts_List extends ChromeNews_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array(
                'chromenews-express-posts-section-title',
                'chromenews-number-of-posts',

            );
            $this->select_fields = array(

                'chromenews-select-category',

            );

            $widget_ops = array(
                'classname' => 'chromenews_express_posts_list_widget',
                'description' => __('Displays Express Posts from selected categories.', 'chromenews'),
                'customize_selective_refresh' => false,
            );

            parent::__construct('chromenews_express_posts_list', __('AFTA Express Posts List', 'chromenews'), $widget_ops);
        }

        /**
         * Front-end display of widget.
         *
         * @param array $args Widget arguments.
         * @param array $instance Saved values from database.
         * @see WP_Widget::widget()
         *
         */

        public function widget($args, $instance)
        {

            $instance = parent::chromenews_sanitize_data($instance, $instance);


            /** This filter is documented in wp-includes/default-widgets.php */

            $chromenews_express_section_title = apply_filters('widget_title', $instance['chromenews-express-posts-section-title'], $instance, $this->id_base);
            $chromenews_express_section_title = $chromenews_express_section_title ? $chromenews_express_section_title : "Express Post";

            $chromenews_no_of_post = 4;
            $chromenews_category = !empty($instance['chromenews-select-category']) ? $instance['chromenews-select-category'] : '0';
            $chromenews_show_excerpt = 'archive-content-excerpt';


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
                <?php $chromenews_featured_express_posts_one = chromenews_get_posts($chromenews_no_of_post, $chromenews_category); ?>

                <div class="af-main-banner-categorized-posts express-posts layout-1">
                    <div class="section-wrapper clearfix">
                        <div class="small-grid-style clearfix">
                            <?php

                            if ($chromenews_featured_express_posts_one->have_posts()) :
                                ?>
                                <?php if (!empty($chromenews_express_section_title)): ?>
                                <?php chromenews_render_section_title($chromenews_express_section_title, $color_class); ?>
                            <?php endif; ?>
                                <div class="featured-post-items-wrap clearfix af-container-row af-widget-body">
                                    <?php
                                    $chromenews_count = 1;
                                    while ($chromenews_featured_express_posts_one->have_posts()) :
                                        $chromenews_featured_express_posts_one->the_post();
                                        global $post;
                                        $chromenews_first_section_class = '';
                                        if ($chromenews_count == 1): ?>
                                            <div class="col-2 pad float-l af-sec-post <?php echo esc_html($chromenews_first_section_class); ?>">
                                                <?php do_action('chromenews_action_loop_grid', $post->ID, 'grid-design-default', 'medium', true); ?>
                                            </div>
                                        <?php else: ?>
                                            <div class="col-2 pad float-l list-part af-sec-post">
                                                <?php do_action('chromenews_action_loop_list', $post->ID, 'thumbnail', 0, false, true, false); ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php
                                        $chromenews_count++;
                                    endwhile;
                                    wp_reset_postdata();
                                    ?>
                                </div>
                            <?php endif;
                            ?>
                        </div>

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
         * @param array $instance Previously saved values from database.
         * @see WP_Widget::form()
         *
         */
        public function form($instance)
        {
            $this->form_instance = $instance;


            //print_pre($terms);
            $categories = chromenews_get_terms();


            if (isset($categories) && !empty($categories)) {
                // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
                echo parent::chromenews_generate_text_input('chromenews-express-posts-section-title', __('Title', 'chromenews'), 'Express Posts List');
                echo parent::chromenews_generate_select_options('chromenews-select-category', __('Select Category', 'chromenews'), $categories);
               

            }

            //print_pre($terms);


        }

    }
endif;