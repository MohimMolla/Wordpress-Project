<?php
/*
Plugin Name: Random Footer After Content
Plugin URI: http://idproject.com/wordpress/plugins/random-footer/
Description: Show Random Ads After Content.
Version: 1.0
License: GPLv2
Author: IDB BISEW
Author URI: http://idbbisew.com/
*/
//style sheet add start.
function stickey_add_script() {
     // if ( is_home() ) {
        //wp_enqueue_script( 'comment-reply' );
        wp_enqueue_style( 'fixedfooter_css', plugins_url( 'css/fixedfooter.css', __FILE__ ) , array(), null, 'all');
        wp_enqueue_script( 'fixedfooter_js', plugins_url( 'js/fixedfooter.js', __FILE__ ), array ( 'jquery' ), null, true);
      //}
  }
  add_action( 'wp_enqueue_scripts', 'stickey_add_script' );

function add_random_ads($c){
	$total = 7;
    $rand = mt_rand(1,$total);
$randomImage = "<img data-totalimg='".$total."' id='randomfoot' src='".plugin_dir_url(__FILE__)."ads/f".$rand.".png'>";
return $c."<hr>".$randomImage;
}
add_filter('the_content','add_random_ads',10,1);

//IDB ShortCode
function showAds($atts = null, $content = null){
    extract(shortcode_atts(array('id' => '1'), $atts));
    $image = "<img src='".plugin_dir_url(__FILE__)."ads/add (".$atts['id'].").gif'";
    return "<hr>".$image."</hr>";
}
add_shortcode('ads', 'showAds');
/*
// change user contact fields
function edu_contact_methods( $contactmethods ) {
    // Add some fields
    $contactmethods['title'] = 'Title';
    $contactmethods['phone'] = 'Phone Number';
    $contactmethods['twitter'] = 'Twitter Name (no @)';
    $contactmethods['fb'] = 'Facebook Name (no @)';
    // Remove AIM, Yahoo IM, Google Talk/Jabber if they're present
    unset($contactmethods['aim']);
    unset($contactmethods['yim']);
    unset($contactmethods['jabber']);
    // make it go!
    return $contactmethods;
    }
    //add_filter('hook_name','your_fx_name','priority','your fx's parameter)
    add_filter( 'user_contactmethods', 'edu_contact_methods', 10, 1 );

    //##################### users ##########################
    function edu_get_users() {
        $blogusers = get_users(array(
        'fields' => 'all_with_meta',
        'order' => 'ASC',
        'orderby' => 'nicename',
        ));
        usort($blogusers, 'edu_user_sort');
    return $blogusers;
    }
    function edu_user_sort( $a, $b ) {
    return strcmp( $a->last_name, $b->last_name );
}
//function edu_users_table
function edu_users_table( $echo = true ) {
    $users = edu_get_users();
    $output = '<table cellspacing="1" width="100%" border="2" id="user-directory">
    <thead>
    <tr>
    <th>'.__('Name', 'sample-user-directory' ).'</th>';
    $output .= '<th>'.__('Title', 'sample-user-directory' ).'</th>';
    $output .= '<th>'.__('Phone', 'sample-user-directory' ).'</th>';
    $output .= '<th>'.__('Email', 'sample-user-directory' ).'</th>';
    $output .= '<th>'.__('Twitter', 'sample-user-directory' ).'</th>';
    $output .= '</tr>
    </thead>
    <tbody>';
    foreach ($users as $user) {
    $name = join( ', ', array( $user->last_name, $user->first_name ) );
    if ( !empty( $user->user_url ) )
    $name = '<a href="'.esc_url( $user->user_url ).'">'.esc_html( $name ).'</a>';
    $output .= '<tr class="vcard" id="' . esc_attr( $user->user_nicename ) .'">';
    $output .= '<td class="fn uid">'.$name.'</td>';
    $output .= '<td class="title">' . esc_html($user->title) .'</td>';
    $output .= '<td class="tell">' . esc_html($user->phone) .'</td>';
    $output .= '<td class="email">';
$output .= '<a href="mailto:' . esc_attr($user->user_email) .'">';
$output .= esc_html($user->user_email) .'</a></td>';
$output .= '<td class="twitter">';
if ( !empty( $user->twitter ) )
$output .= '<a href="http://twitter.com/'.esc_attr($user->twitter).'">@'. esc_html($user->twitter) . '</a>';
$output .= '</td>';
$output .= '</tr>';
}
$output .= '</tbody>
</table>';
if ($echo) {
echo $output;
return;
}
return $output;
}
//adding shortcode
function edu_users_table_shortlink( $atts = null, $content = null ) {
    $content .= edu_users_table( false );
    return $content;
    }
    add_shortcode( 'allusers', 'edu_users_table_shortlink' );
    //##################### users ##########################
//IDB ShortCode
function showIdb($atts = null, $content = null){
    return "<hr>Islamic Development Bank";
}
add_shortcode('idb', 'showIdb');

//IDB ShortCode
function showAds($atts = null, $content = null){
    extract(shortcode_atts(array('id' => '1'), $atts));
    $image = "<img src='".plugin_dir_url(__FILE__)."ads/add (".$atts['id'].").gif'";
    return "<hr>".$image."</hr>";
}
add_shortcode('ads', 'showAds');
*/

