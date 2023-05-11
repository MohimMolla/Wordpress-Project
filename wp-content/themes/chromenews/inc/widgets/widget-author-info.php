<?php
    if (!class_exists('ChromeNews_author_info')) :
        /**
         * Adds ChromeNews_author_info widget.
         */
        class ChromeNews_author_info extends ChromeNews_Widget_Base
        {
            /**
             * Sets up a new widget instance.
             *
             * @since 1.0.0
             */
            function __construct()
            {
                $this->text_fields = array('chromenews-author-info-title', 'chromenews-author-info-subtitle', 'chromenews-author-info-image', 'chromenews-author-info-name', 'chromenews-author-info-desc', 'chromenews-author-info-phone', 'chromenews-author-info-email');
                $this->url_fields = array('chromenews-author-info-facebook', 'chromenews-author-info-twitter', 'chromenews-author-info-linkedin', 'chromenews-author-info-instagram', 'chromenews-author-info-vk', 'chromenews-author-info-youtube', 'chromenews-author-info-tiktok');
                
                $widget_ops = array(
                    'classname' => 'chromenews_author_info_widget aft-widget',
                    'description' => __('Displays author info.', 'chromenews'),
                    'customize_selective_refresh' => false,
                );
                
                parent::__construct('chromenews_author_info', __('AFTA Author Info', 'chromenews'), $widget_ops);
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
    
                $chromenews_featured_news_title = apply_filters('widget_title', $instance['chromenews-author-info-title'], $instance, $this->id_base);
               
                
                $profile_image = isset($instance['chromenews-author-info-image']) ? ($instance['chromenews-author-info-image']) : '';
                
                if ($profile_image) {
                    $image_attributes = wp_get_attachment_image_src($profile_image, 'large');
                    $image_src = $image_attributes[0];
                    $image_class = 'data-bg data-bg-hover';
                    
                } else {
                    $image_src = '';
                    $image_class = 'no-bg';
                }
                
                $name = isset($instance['chromenews-author-info-name']) ? ($instance['chromenews-author-info-name']) : '';
                
                $desc = isset($instance['chromenews-author-info-desc']) ? ($instance['chromenews-author-info-desc']) : '';
                $facebook = isset($instance['chromenews-author-info-facebook']) ? ($instance['chromenews-author-info-facebook']) : '';
                $twitter = isset($instance['chromenews-author-info-twitter']) ? ($instance['chromenews-author-info-twitter']) : '';
                $instagram = isset($instance['chromenews-author-info-instagram']) ? ($instance['chromenews-author-info-instagram']) : '';
                $youtube = isset($instance['chromenews-author-info-youtube']) ? ($instance['chromenews-author-info-youtube']) : '';
                $linkedin = isset($instance['chromenews-author-info-linkedin']) ? ($instance['chromenews-author-info-linkedin']) : '';
                $tiktok = isset($instance['chromenews-author-info-tiktok']) ? ($instance['chromenews-author-info-tiktok']) : '';
                $vk = isset($instance['chromenews-author-info-vk']) ? ($instance['chromenews-author-info-vk']) : '';

                echo $args['before_widget'];
                ?>
                <section class="aft-blocks af-author-info pad-v">
                    <div class="af-author-info-wrap">
                        <?php if (!empty($chromenews_featured_news_title)): ?>
                            <?php chromenews_render_section_title($chromenews_featured_news_title); ?>
                        <?php endif; ?>
                    <div class="widget-block widget-wrapper af-widget-body">
                        <div class="posts-author-wrapper">
                            
                            <?php if (!empty($image_src)) : ?>


                                <figure class="read-img af-author-img">
                                    <img src="<?php echo esc_attr($image_src); ?>" alt=""/>
                                </figure>
                            
                            <?php endif; ?>
                            <div class="af-author-details">
                                <?php if (!empty($name)) : ?>
                                    <h4 class="af-author-display-name"><?php echo esc_html($name); ?></h4>
                                <?php endif; ?>
                                <?php if (!empty($desc)) : ?>
                                    <p class="af-author-display-name"><?php echo esc_html($desc); ?></p>
                                <?php endif; ?>
                                
                                <?php if (!empty($facebook) || !empty($twitter) || !empty($linkedin) || !empty($youtube) || !empty($instagram) || !empty($vk)) : ?>
                                    <div class="social-navigation aft-small-social-menu">
                                        <ul>
                                            <?php if (!empty($facebook)) : ?>
                                                <li>
                                                    <a href="<?php echo esc_url($facebook); ?>" target="_blank"></a>
                                                </li>
                                            <?php endif; ?>

                                            <?php if (!empty($instagram)) : ?>
                                                <li>
                                                    <a href="<?php echo esc_url($instagram); ?>" target="_blank"></a>
                                                </li>
                                            <?php endif; ?>

                                            <?php if (!empty($twitter)) : ?>
                                                <li>
                                                    <a href="<?php echo esc_url($twitter); ?>" target="_blank"></a>
                                                </li>
                                            <?php endif; ?>                                           


                                        </ul>
                                    </div>
                                <?php endif; ?>
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
                    echo parent::chromenews_generate_text_input('chromenews-author-info-title', __('About Author', 'chromenews'), __('Title', 'chromenews'));
                    
                    echo parent::chromenews_generate_image_upload('chromenews-author-info-image', __('Profile image', 'chromenews'), __('Profile image', 'chromenews'));
                    echo parent::chromenews_generate_text_input('chromenews-author-info-name', __('Name', 'chromenews'), __('Name', 'chromenews'));
                    echo parent::chromenews_generate_text_input('chromenews-author-info-desc', __('Descriptions', 'chromenews'), '');
                    echo parent::chromenews_generate_text_input('chromenews-author-info-facebook', __('Facebook', 'chromenews'), '');
                    echo parent::chromenews_generate_text_input('chromenews-author-info-instagram', __('Instagram', 'chromenews'), '');
                    echo parent::chromenews_generate_text_input('chromenews-author-info-twitter', __('Twitter', 'chromenews'), '');
                    

                    
                    
                }
            }
        }
    endif;