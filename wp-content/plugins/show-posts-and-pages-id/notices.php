<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php

// ============================================================
// replace the prefix when adding to new plugin "yydev_show_pages_id_"
// ============================================================

$yydev_show_pages_id_notice_info_array = array(
	'plugin_name' => "Show Pages ID", // the name of the plugin
	'developer_website' => "https://www.yydevelopment.com", // link to the developer website page
	'plugin_review_page' => "https://wordpress.org/plugins/show-posts-and-pages-id/#reviews", // link to the plugin support page 
	'plugin_support_link' => "https://wordpress.org/support/plugin/show-posts-and-pages-id/", // link to the plugin review page 
	'plugin_donate_link' => "https://www.yydevelopment.com/coffee-break/?plugin=show-posts-and-pages-id", // link to the plugin donate page
	'company_plugins_page' => "https://www.yydevelopment.com/yydevelopment-wordpress-plugins/", // link to the main company plugins page
	'icon_image_path' => plugins_url() . "/" .	basename( dirname( __FILE__ ) ) . "/images/icon.png", // link to the plugin icon
	'save_database_time_stamp_name' => "yydev_show_pages_id_timestamp",	// database input name to save data 
	'send_mail_in_days' => (4 * 30 * 60 * 60 * 24) + strtotime("now"), // the amount of time after we show the notice (4 months)
);

// ================================================
// creating time stamp if it doesn't exists
// ================================================

// loading the plugin version from the database
$plugin_db_timestamp = get_option($yydev_show_pages_id_notice_info_array['save_database_time_stamp_name']);

// checking if the plugin version exists on the dabase
// and checking if the database version equal to the plugin version $plugin_version
if( empty($plugin_db_timestamp) ) {

	// update the plugin version in the database
	update_option($yydev_show_pages_id_notice_info_array['save_database_time_stamp_name'], $yydev_show_pages_id_notice_info_array['send_mail_in_days']);
	$plugin_db_timestamp = get_option($yydev_show_pages_id_notice_info_array['save_database_time_stamp_name']);

} // if( empty($plugin_db_timestamp) ) {

// add_action('plugins_loaded', 'my_awesome_plugin_check_version');

// ================================================
// ajax function for when the visitor click on the buttons
// ================================================

// when the visitor want to stop getting the messages
function yydev_show_pages_id_stop_notice_forever() {

	global $yydev_show_pages_id_notice_info_array;
	update_option($yydev_show_pages_id_notice_info_array['save_database_time_stamp_name'], 'stop');
	die(); // we have to end ajax functions with die();
	
} // function yydev_show_pages_id_stop_notice_forever() {

add_action( 'wp_ajax_yydev_show_pages_id_stop_notice_forever', 'yydev_show_pages_id_stop_notice_forever' );


// when the visitor ask to get the message in the future
function yydev_show_pages_id_stop_notice_for_now() {

	global $yydev_show_pages_id_notice_info_array;
	update_option($yydev_show_pages_id_notice_info_array['save_database_time_stamp_name'], $yydev_show_pages_id_notice_info_array['send_mail_in_days']);
	die(); // we have to end ajax functions with die();
	
} // function yydev_show_pages_id_stop_notice_for_now() {

add_action( 'wp_ajax_yydev_show_pages_id_stop_notice_for_now', 'yydev_show_pages_id_stop_notice_for_now' );

// ================================================
// update the time stamp if the user click on one of the button
// ================================================

// creating a function with admin notice output
function yydev_show_pages_id_admin_notice($notice_info_array) {

	global $yydev_show_pages_id_notice_info_array;

	$plugin_name = $yydev_show_pages_id_notice_info_array['plugin_name'];
	$developer_website = $yydev_show_pages_id_notice_info_array['developer_website'];
	$plugin_review_page = $yydev_show_pages_id_notice_info_array['plugin_review_page'];
	$plugin_support_link = $yydev_show_pages_id_notice_info_array['plugin_support_link'];
	$plugin_donate_link = $yydev_show_pages_id_notice_info_array['plugin_donate_link'];
	$company_plugins_page = $yydev_show_pages_id_notice_info_array['company_plugins_page'];
	$icon_image_path = $yydev_show_pages_id_notice_info_array['icon_image_path'];
	$save_database_time_stamp_name = $yydev_show_pages_id_notice_info_array['save_database_time_stamp_name'];

?>

<script>

	jQuery(document).ready(function($){

		// if the user click on the right close button or ask to stop showing message
		$(document).on('click', '.yydev_show_pages_id_notice_style .yy-plugin-dismiss-forever', function() {
			$(this).parent().parent().animate({opacity: "0"}, 200, function() {

				$(this).css("display", "none");

				// use the function and update value using ajax
				var data = {'action': 'yydev_show_pages_id_stop_notice_forever'}; // var data = {
				jQuery.post(ajaxurl, data,  function(response) {});

			}); // $( relatedPostBox ).animate({opacity: "0"}, 1000, function() {
			return false;
		}); // $(document).on('click', '.yydev_show_pages_id_notice_style notice-dismiss', function() {


		// if the user click on ask me later
		$(document).on('click', '.yydev_show_pages_id_notice_style .yy-plugin-dismiss-for-now', function() {
			$(this).parent().parent().animate({opacity: "0"}, 200, function() {

				$(this).css("display", "none");

				// use the function and update value using ajax
				var data = {'action': 'yydev_show_pages_id_stop_notice_for_now'}; // var data = {
				jQuery.post(ajaxurl, data,  function(response) {});

			}); // $( relatedPostBox ).animate({opacity: "0"}, 1000, function() {
			return false;
		}); // $(document).on('click', '.yydev_show_pages_id_notice_style notice-dismiss', function() {


		// if the user click on the right close button or ask to stop showing message
		$(document).on('click', '.yydev_show_pages_id_notice_style .yy-review-plugin', function() {
			$(this).parent().parent().animate({opacity: "0"}, 200, function() {

				$(this).css("display", "none");

				// use the function and update value using ajax
				var data = {'action': 'yydev_show_pages_id_stop_notice_forever'}; // var data = {
				jQuery.post(ajaxurl, data,  function(response) {});

			}); // $( relatedPostBox ).animate({opacity: "0"}, 1000, function() {
		}); // $(document).on('click', '.yydev_show_pages_id_notice_style notice-dismiss', function() {

	}); // jQuery(document).ready(function($){

</script>

<style>

	.yydev_show_pages_id_notice_style {
		direction: ltr;
		text-align: left;
		position: relative;
		background: #fff;
		box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
		margin: 5px 0px 35px 0px !important;
		padding: 1px 12px;
		padding: 15px 30px 15px 35px;
		opacity: 1;
	}

	.yydev_show_pages_id_notice_style .yy-bottom-plugin-name {
		color: #fff;
		padding: 3px 10px;
		position: absolute;
		bottom: -20px;
		right: 10px;
		z-index: 999;
		-moz-border-radius: 0 0 3px 3px;
		-webkit-border-radius: 0 0 3px 3px;
		border-radius: 0 0 3px 3px;
		font-size: 12px;
		font-weight: bold;
		cursor: auto;	
		background: #8f8f8f;
		text-decoration: none;
		box-shadow: 0 1px 0 #006799;
	} 

	.yydev_show_pages_id_notice_style .notice-buttons {
		margin: 10px 0px 10px 0px;
	}

	.yydev_show_pages_id_notice_style .notice-buttons a {
		max-width: 100%;
		white-space: normal;
		margin: 4px 0px 4px 2px;
	}

	.yydev_show_pages_id_notice_style .yy-notice-dismiss {
		position: absolute;
		top: 0;
		left: auto;
		right: 1px;
		border: none;
		margin: 0;
		padding: 9px;
		background: 0 0;
		color: #72777c;
		cursor: pointer;
	}

	.yydev_show_pages_id_notice_style .yy-notice-dismiss::before {
		background: 0 0;
		color: #72777c;
		content: "\f153";
		display: block;
		font: normal 16px/20px dashicons;
		speak: none;
		height: 20px;
		text-align: center;
		width: 20px;
		-webkit-font-smoothing: antialiased;
		-moz-osx-font-smoothing: grayscale;
	}

	.yydev_show_pages_id_notice_style .yy-plugin-icon {
		max-width: 85px;
		float: left;
		margin: 4px 15px 0px -20px;
	}

</style>

	<div class="yydev_show_pages_id_notice_style notice notice-info">

		<div class="yy-plugin-icon">
		<img src="<?php echo $icon_image_path; ?>" alt="<?php echo $plugin_name; ?>" />
		</div><!--yy-plugin-icon-->

		We are happy to see that you are using our <b><?php echo $plugin_name; ?></b> plugin for some time now. 
		We at <a href="<?php echo $developer_website; ?>" target="_blank">YYDevelopment</a> share our plugin for free under GPLv2 license and the only thing we ask in return is that you give a <a href="<?php echo $plugin_review_page; ?>" target="_blank">positive review</a> if you liked it.

		<div class="notice-buttons">
			<a class="button button-primary yy-review-plugin" href="<?php echo $plugin_review_page; ?>" target="_blank">Yes!!! This plugin saved my life I love it and I will be happy to give it 5 stars review :)</a>
			<a class="button yy-plugin-dismiss-for-now" href="#" target="_blank">I am busy dude ask me again later</a>
			<a class="button button-secondary yy-plugin-dismiss-forever" href="#" target="_blank">Never show this message again :(</a>
		</div><!--notice-buttons-->

		If you have problems with the plugin you can submit a ticket at our <a href="<?php echo $plugin_support_link; ?>" target="_blank">plugin support page</a>. 
		You are also welcome to check our other <a href="<?php echo $company_plugins_page; ?>" target="_blank">free wordpress plugins</a>. And if you want to help support this FREE plugins <a target="_blank" href="<?php echo $plugin_donate_link; ?>">buy us a coffee</a>.

		<div class="yy-bottom-plugin-name "><?php echo $plugin_name; ?> Plugin</div>
		
	</div><!--yydev_show_pages_id_notice_style-->

<?php

} // function yydev_show_pages_id_admin_notice() {

// checking for global value that stop all plugins notices
$yydev_stop_plugins_notice = get_option('yydev_stop_plugins_notice');

if( !empty($plugin_db_timestamp) && ($plugin_db_timestamp != "stop") && ($plugin_db_timestamp < strtotime("now")) && ($yydev_stop_plugins_notice != 1) ) {
 
	// output the admin notice on the wordpress pages
	add_action( 'admin_notices', 'yydev_show_pages_id_admin_notice' );

} // if( !empty($plugin_db_timestamp) && ($plugin_db_timestamp != "stop") && ($plugin_db_timestamp < strtotime("now")) && ($yydev_stop_plugins_notice != 1) ) {

?>