<?php
if (!class_exists('ChromeNews_Express_Posts_Double_Column')) :
    /**
     * Adds ChromeNews_Express_Posts_Double_Column widget.
     */
    class ChromeNews_Express_Posts_Double_Column extends ChromeNews_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array(
                'chromenews-posts-list-title-1',
                'chromenews-posts-list-title-2',
                'chromenews-posts-slider-number'

            );
            $this->select_fields = array(

                'chromenews-select-category-1',
                'chromenews-select-category-2',

            );

            $widget_ops = array(
                'classname' => 'chromenews_posts_double_columns_widget',
                'description' => __('Displays grid from selected categories.', 'chromenews'),
                'customize_selective_refresh' => false,
            );

            parent::__construct('chromenews_posts_double_column', __('AFTA Post Double Columns', 'chromenews'), $widget_ops);
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


            $chromenews_no_of_post = 3;

            for ($chromenews_i = 1; $chromenews_i <= 2; $chromenews_i++) {
                $chromenews_section_title = apply_filters('widget_title', $instance['chromenews-posts-list-title-' . $chromenews_i], $instance, $this->id_base);
                $chromenews_category = !empty($instance['chromenews-select-category-' . $chromenews_i]) ? $instance['chromenews-select-category-' . $chromenews_i] : '0';
                $chromenews_featured_categories['feature_' . $chromenews_i][] = $chromenews_category;
                $chromenews_featured_categories['feature_' . $chromenews_i][] = $chromenews_section_title;



                $color_class = '';
                if(absint($chromenews_category) > 0){
                    $color_id = "category_color_" . $chromenews_category;
                    // retrieve the existing value(s) for this meta field. This returns an array
                    $term_meta = get_option($color_id);
                    $color_class = ($term_meta) ? $term_meta['color_class_term_meta'] : 'category-color-1';
                }
                $chromenews_featured_categories['feature_' . $chromenews_i][] = $color_class;

            }

            // open the widget container
            echo $args['before_widget'];
            if (isset($chromenews_featured_categories)): ?>

                <div class="af-container-row pad-v clearfix">
                    <?php
                    foreach ($chromenews_featured_categories as $chromenews_fc): ?>
                        <div class="col-2 pad float-l af-sec-post">
                            <?php if (!empty($chromenews_fc[1])): ?>
                                <?php chromenews_render_section_title($chromenews_fc[1], $chromenews_fc[2]); ?>
                            <?php endif; ?>

                            <?php $chromenews_all_posts_vertical = chromenews_get_posts($chromenews_no_of_post, $chromenews_fc[0]); ?>
                            <div class="full-wid-resp af-widget-body">
                                <?php
                                if ($chromenews_all_posts_vertical->have_posts()) :
                                    $chromenews_count = 1;
                                    while ($chromenews_all_posts_vertical->have_posts()) : $chromenews_all_posts_vertical->the_post();
                                        global $post;
                                        if ($chromenews_count == 1):
                                            ?>
                                            <div class="af-sec-post">
                                                <?php do_action('chromenews_action_loop_grid', $post->ID, 'grid-design-default', 'medium'); ?>
                                            </div>
                                        <?php else: ?>
                                            <?php do_action('chromenews_action_loop_list', $post->ID, 'thumbnail', 0, false, true, false); ?>
                                        <?php
                                        endif;
                                        $chromenews_count++;
                                    endwhile;
                                endif;
                                wp_reset_postdata();
                                ?>
                            </div>
                        </div><!--featured-category-item-->
                    <?php

                    endforeach; ?>

                </div>
            <?php
            endif;

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
                echo parent::chromenews_generate_text_input('chromenews-posts-list-title-1', __('Title', 'chromenews'), 'Post Double Columns 1');
                echo parent::chromenews_generate_text_input('chromenews-posts-list-title-2', __('Title', 'chromenews'), 'Post Double Columns 2');
                echo parent::chromenews_generate_select_options('chromenews-select-category-1', __('Select Category 1', 'chromenews'), $categories);
                echo parent::chromenews_generate_select_options('chromenews-select-category-2', __('Select Category 2', 'chromenews'), $categories);
                

            }

            //print_pre($terms);


        }

    }
endif;