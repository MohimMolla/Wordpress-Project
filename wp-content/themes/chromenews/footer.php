<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ChromeNews
 */

$sidebar_col = 0;
if(is_active_sidebar( 'footer-first-widgets-section')){
    $sidebar_col +=1;
}

if(is_active_sidebar( 'footer-second-widgets-section')){
    $sidebar_col +=1;
}

if(is_active_sidebar( 'footer-third-widgets-section')){
    $sidebar_col +=1;
}

$sidebar_col_class = 'aft-footer-sidebar-col-'.$sidebar_col;

$chromenews_footer_background = chromenews_get_option('footer_background_image');
$chromenews_footer_background_url = '';
if(!empty($chromenews_footer_background)){

    $chromenews_footer_background = absint($chromenews_footer_background);
    $chromenews_footer_background_url = wp_get_attachment_url($chromenews_footer_background);

    $sidebar_col_class .= ' data-bg';

}


?>


</div>



<?php do_action('chromenews_action_full_width_upper_footer_section'); ?>

<footer class="site-footer <?php echo esc_attr($sidebar_col_class); ?>" data-background="<?php echo esc_attr($chromenews_footer_background_url); ?>">
    
    <?php if (is_active_sidebar( 'footer-first-widgets-section') || is_active_sidebar( 'footer-second-widgets-section') || is_active_sidebar( 'footer-third-widgets-section')) : ?>
    <div class="primary-footer">
        <div class="container-wrapper">
            <div class="af-container-row">
                <?php if (is_active_sidebar( 'footer-first-widgets-section') ) : ?>
                    <div class="primary-footer-area footer-first-widgets-section col-3 float-l pad">
                        <section class="widget-area color-pad">
                                <?php dynamic_sidebar('footer-first-widgets-section'); ?>
                        </section>
                    </div>
                <?php endif; ?>

                <?php if (is_active_sidebar( 'footer-second-widgets-section') ) : ?>
                    <div class="primary-footer-area footer-second-widgets-section  col-3 float-l pad">
                        <section class="widget-area color-pad">
                            <?php dynamic_sidebar('footer-second-widgets-section'); ?>
                        </section>
                    </div>
                <?php endif; ?>

                <?php if (is_active_sidebar( 'footer-third-widgets-section') ) : ?>
                    <div class="primary-footer-area footer-third-widgets-section  col-3 float-l pad">
                        <section class="widget-area color-pad">
                            <?php dynamic_sidebar('footer-third-widgets-section'); ?>
                        </section>
                    </div>
                <?php endif; ?>
               
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if(1 != chromenews_get_option('hide_footer_menu_section')): ?>
    <?php if (has_nav_menu( 'aft-footer-nav' ) || has_nav_menu( 'aft-social-nav' )):
        $class = 'col-1';
        if (has_nav_menu( 'aft-footer-nav' ) && has_nav_menu( 'aft-social-nav' )){
            $class = 'col-2';
        }

        ?>
    <div class="secondary-footer">
        <div class="container-wrapper">
            <div class="af-container-row clearfix af-flex-container">
                <?php if (has_nav_menu( 'aft-footer-nav' )): ?>
                    <div class="float-l pad color-pad <?php echo esc_attr($class); ?>">
                        <div class="footer-nav-wrapper">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'aft-footer-nav',
                            'menu_id' => 'footer-menu',
                            'depth' => 1,
                            'container' => 'div',
                            'container_class' => 'footer-navigation'
                        )); ?>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php if (has_nav_menu( 'aft-social-nav' )): ?>
                    <div class="float-l pad color-pad <?php echo esc_attr($class); ?>">
                        <div class="footer-social-wrapper">
                            <div class="aft-small-social-menu">
                                <?php
                                wp_nav_menu(array(
                                    'theme_location' => 'aft-social-nav',
                                    'link_before' => '<span class="screen-reader-text">',
                                    'link_after' => '</span>',
                                    'container' => 'div',
                                    'container_class' => 'social-navigation'
                                ));
                                ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php endif; ?>
    <div class="site-info">
        <div class="container-wrapper">
            <div class="af-container-row">
                <div class="col-1 color-pad">
                    <?php $chromenews_copy_right = chromenews_get_option('footer_copyright_text'); ?>
                    <?php if (!empty($chromenews_copy_right)): ?>
                        <?php echo esc_html($chromenews_copy_right); ?>
                    <?php endif; ?>
                    <?php $chromenews_theme_credits = chromenews_get_option('hide_footer_copyright_credits'); ?>
                    <?php if ($chromenews_theme_credits != 1): ?>
                        <span class="sep"> | </span>
                        <?php
                        /* translators: 1: Theme name, 2: Theme author. */
                        printf(esc_html__('%1$s by %2$s.', 'chromenews'), '<a href="https://afthemes.com/products/chromenews/" target="_blank">ChromeNews</a>', 'AF themes');
                        ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>

<?php $chromenews_scroll_to_top_position = chromenews_get_option('global_scroll_to_top_position');
if($chromenews_scroll_to_top_position != 'none'):
?>

<a id="scroll-up" class="secondary-color <?php echo esc_attr($chromenews_scroll_to_top_position); ?>">
</a>
<?php endif; ?>
<?php wp_footer(); ?>

</body>
</html>
