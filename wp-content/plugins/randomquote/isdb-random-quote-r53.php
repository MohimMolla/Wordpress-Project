<?php
/*
Plugin Name: IsDB Random Quotes Plugin
Plugin URI: http://isdbstudents.com/wordpress-plugins/randomquote
Description: Post a random quote with every posts footers
Version: 1.0
Author: IsDB BISEW
Author URI: http://asamamun.wordpress.com
Text Domain: random-quote
License: GPLv2
*/

/* register_activation_hook( __FILE__, 'random_quote' );
function random_quote() {
    global $wp_version;
    if ( version_compare( $wp_version, '4.1', '<' ) ) {
    wp_die( 'This plugin requires WordPress version 4.1 or higher.' );
    }
}


register_deactivation_hook( __FILE__, 'end_random_quote' );
function end_random_quote() {
//do something
} */

//add script and style
function add_random_quote_script(){
    wp_enqueue_style( 'randomquote_css', plugins_url( 'assets/css/randomquote.css', __FILE__ ) , array(), null, 'all');
    //script should be registered first and then added/enqueued
    wp_register_script( 'jquery364', plugins_url( 'assets/js/jquery364.min.js', __FILE__ ), array (), null, true);    
    wp_register_script( 'randomquote_js', plugins_url( 'assets/js/randomquote.js', __FILE__ ), array ( 'jquery' ), null, true);
    wp_enqueue_script('jquery364');
    wp_enqueue_script('randomquote_js');

}
add_action( 'wp_enqueue_scripts', 'add_random_quote_script' );

// change title color
/* add_filter('the_title','changecolor');
function changecolor($t){
    return "<span style='color:green'>".$t."<span>";
} */

//add quote from api after the content
add_filter( 'the_content', 'add_quote' );
function add_quote($c){
    $oo = get_option('prowp_options');
    if(isset($oo) && isset($oo['show'])){
    $o = get_quote();
    return $c . "<hr><h3 class='quotebg'>".$oo['option_name']."</h3><div id='quoteContainer'>".$o->quote."- ".$o->author."</div><hr>";
    }
    else{
        return $c;
    }
}


function get_quote(){
    // create curl resource
    $ch = curl_init();
    // set url
    curl_setopt($ch, CURLOPT_URL, "https://dummyjson.com/quotes/".rand(1,100));
    //return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // $output contains the output string
    $output = curl_exec($ch);
    // close curl resource to free up system resources
    curl_close($ch); 
    return json_decode($output);
}


// create custom plugin settings menu
add_action( 'admin_menu', 'prowp_create_menu' );
/* function prowp_create_menu() {
//create new top-level menu
add_menu_page( 'Halloween Plugin Page', 'Halloween Plugin',
'manage_options', 'prowp_main_menu', 'prowp_main_plugin_page',
plugins_url( '/images/wordpress.png', __FILE__ ) ,3);
//create two sub-menus: settings and support
add_submenu_page( 'prowp_main_menu', 'Halloween Settings Page',
'Settings', 'manage_options', 'halloween_settings',
'prowp_settings_page' );
add_submenu_page( 'prowp_main_menu', 'Halloween Support Page',
'Support', 'manage_options', 'halloween_support', 'prowp_support_page' );
} */
function prowp_create_menu() {
    //create new top-level menu
    add_menu_page( 
        'Halloween Plugin Page', 
        'Halloween Plugin',
        'manage_options', 
        'prowp_main_menu', 
        'prowp_settings_page' ,//callback
    plugins_url( '/assets/images/icon.png', __FILE__ )
    ,4);
    //call register settings function
    add_action( 'admin_init', 'prowp_register_settings' );
    function prowp_register_settings() {
        //register our settings
        register_setting( 'prowp-settings-group', 'prowp_options','prowp_sanitize_options' );
        }
    }
?>
<?php
function prowp_settings_page() {
?>
<div class="wrap">
<h2>Halloween Plugin Options</h2>
<form method="post" action="options.php">
<?php settings_fields( 'prowp-settings-group' ); ?>
<?php 
$prowp_options = get_option( 'prowp_options' ); 
var_dump($prowp_options);
?>
<table class="form-table">
<tr>
        <th>Show Random Quote on single page?</th>
        <td><input type="checkbox" name="prowp_options[show]" id="" 
        <?php if(isset($prowp_options['show']))
	if('on' == $prowp_options['show']){
?>
	checked	
		<?php } ?> >
        
        </td>
    </tr>
<tr valign="top">
<th scope="row">Title</th>
<td><input type="text" name="prowp_options[option_name]"
value="<?= $prowp_options?esc_attr( $prowp_options['option_name']):''; ?>" /></td>
</tr>
<tr valign="top">
<th scope="row">Email</th>
<td><input type="text" name="prowp_options[option_email]"
value="<?= $prowp_options?esc_attr( $prowp_options['option_email']):''; ?>" /></td>
</tr>
<tr valign="top">
<th scope="row">URL</th>
<td><input type="text" name="prowp_options[option_url]"
value="<?= $prowp_options?esc_attr( $prowp_options['option_url']):''; ?>" /></td>
</tr>
<!-- new ticker -->
<tr valign="top">
<th scope="row">news 1</th>
<td><input type="text" name="prowp_options[news1]"
value="<?= $prowp_options?esc_attr( $prowp_options['news1']):''; ?>" /></td>
</tr>
<tr valign="top">
<th scope="row">news 2</th>
<td><input type="text" name="prowp_options[news2]"
value="<?= $prowp_options?esc_attr( $prowp_options['news2']):''; ?>" /></td>
</tr>
<tr valign="top">
<th scope="row">Ticker News IDs</th>
<td><input type="text" name="prowp_options[newsids]"
value="<?= $prowp_options?esc_attr( $prowp_options['newsids']):''; ?>" /></td>
</tr>
<!-- new ticker -->
</table>
<p class="submit">
<input type="submit" class="button-primary" value="Save Changes" />
</p>
</form>
</div>
<?php
}
?>
<?php
function prowp_sanitize_options( $input ) {
$input['option_name'] = sanitize_text_field( $input['option_name'] );
$input['option_email'] = sanitize_email( $input['option_email'] );
$input['option_url'] = esc_url( $input['option_url'] );
return $input;
}
?>