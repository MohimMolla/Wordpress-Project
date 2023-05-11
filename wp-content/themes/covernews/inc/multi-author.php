<?php 
if(!function_exists('covernews_by_author')){
    function covernews_by_author(){
        global $post;
        
        if(class_exists('WP_Post_Author')){
            $post_id = $post->ID;
            $awpa_post_authors = get_post_meta($post_id, 'wpma_author');
            $enable_author_metabox_for_post = get_option('awpa_author_metabox_integration');
            $multiauthor_settings = false;
            if($enable_author_metabox_for_post && $enable_author_metabox_for_post['enable_author_metabox']==true){
                $multiauthor_settings = true;
            }
            if(isset($awpa_post_authors) && !empty($awpa_post_authors) && $multiauthor_settings == true){
                foreach ($awpa_post_authors as $key=>$author_id) {

                    $needle = 'guest-';
                    if (strpos($author_id, $needle) !== false) {
                        $filter_id = substr($author_id, strpos($author_id, "-") + 1);
                        $author_id = $filter_id;
                        $author_type = 'guest';
                    } else {
                        $author_id = $author_id;
                        $author_type = 'default';
                    }

                     covernews_author_list($post_id,$author_id,$author_type, $author_avatar=false);
                     if( $key != ( count( $awpa_post_authors ) - 1 ) ){
                         echo ",";
                     } 
                }
            }else{
                $author_id = $post->post_author;?>
                <a href="<?php echo esc_url(get_author_posts_url($author_id)) ?>">
                    <?php echo esc_html(get_the_author_meta('display_name', $author_id)); ?>
                </a>
                <?php

               
            }
        }else{
            $author_id = $post->post_author;?>
                <a href="<?php echo esc_url(get_author_posts_url($author_id)) ?>">
                    <?php echo esc_html(get_the_author_meta('display_name', $author_id)); ?>
                </a>
       <?php }

    }

}

if(!function_exists('covernews_author_list')){
function covernews_author_list($post_id='',$author_id='',$author_type='',$author_avatar=false){
        
             if($author_type == 'default'){ 
                 $default_author_id = get_post_field('post_author', $post_id);
                 $author_name = get_userdata( $author_id);
                ?>
                <a href="<?php echo esc_url(get_author_posts_url($author_id)) ?>">
                    <?php echo esc_html($author_name->display_name); ?>
                </a>
                <?php 
                } 
                if($author_type == 'guest'){
                    $wp_amulti_authors = new WPAMultiAuthors();
                    $guest_user_data = $wp_amulti_authors->get_guest_by_id($author_id);
                    
                    ?>
                    
                    <?php echo  esc_html($guest_user_data->display_name); ?>
                <?php } ?>
                
            <?php 
        }
    }