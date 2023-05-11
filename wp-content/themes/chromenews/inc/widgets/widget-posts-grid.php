<?php
    if (!class_exists('ChromeNews_Featured_Post')) :
        /**
         * Adds ChromeNews_Featured_Post widget.
         */
        class ChromeNews_Featured_Post extends ChromeNews_Widget_Base
        {
            /**
             * Sets up a new widget instance.
             *
             * @since 1.0.0
             */
            function __construct()
            {
                $this->text_fields = array(
                    'chromenews-featured-posts-title',
                    'chromenews-number-of-posts'
                
                );
                $this->select_fields = array(
                    
                    'chromenews-select-category',
                
                );
                
                $widget_ops = array(
                    'classname' => 'chromenews_featured_posts_widget',
                    'description' => __('Displays grid from selected categories.', 'chromenews'),
                    'customize_selective_refresh' => false,
                );
                
                parent::__construct('chromenews_featured_posts', __('AFTA Post Grid', 'chromenews'), $widget_ops);
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
    
                $chromenews_featured_news_title = apply_filters('widget_title', $instance['chromenews-featured-posts-title'], $instance, $this->id_base);
    
                $chromenews_number_of_featured_news = 4;
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
                <section class="aft-blocks af-main-banner-featured-posts pad-v">
                    <div class="af-main-banner-featured-posts featured-posts">
                        <?php if (!empty($chromenews_featured_news_title)): ?>
                            <?php chromenews_render_section_title($chromenews_featured_news_title, $color_class); ?>
                        <?php endif; ?>
                        <div class="section-wrapper af-widget-body">
                            <div class="af-container-row clearfix">
                                <?php
                                    $chromenews_featured_posts = chromenews_get_posts($chromenews_number_of_featured_news, $chromenews_category);
                                    if ($chromenews_featured_posts->have_posts()) :
                                        while ($chromenews_featured_posts->have_posts()) :
                                            $chromenews_featured_posts->the_post();
                                            global $post;
                                            ?>
                                            <div class="col-4 pad float-l ">
                                                <?php do_action('chromenews_action_loop_grid', $post->ID); ?>
                                            </div>
                                        <?php endwhile;
                                    endif;
                                    wp_reset_postdata();
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
                    echo parent::chromenews_generate_text_input('chromenews-featured-posts-title', __('Title', 'chromenews'), 'Posts Grid');
                    echo parent::chromenews_generate_select_options('chromenews-select-category', __('Select Category', 'chromenews'), $categories);
                    
                    
                }
                
                //print_pre($terms);
                
                
            }
            
        }
    endif;