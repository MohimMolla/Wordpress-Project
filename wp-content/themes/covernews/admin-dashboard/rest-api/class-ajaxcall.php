<?php
if (!defined('ABSPATH')) exit;
	add_action( 'wp_ajax_covernews_plugin_installer', 'covernews_plugin_installer' ); // Install plugin
	add_action( 'wp_ajax_covernews_plugin_activation', 'covernews_plugin_activation' ); // Activate plugin
		function covernews_plugin_installer(){

			if ( ! current_user_can('install_plugins') )
				wp_die( __( 'Sorry, you are not allowed to install plugins on this site.', 'covernews' ) );

			$nonce = $_POST["nonce"];
			$plugin = $_POST["plugin"];

			// Check our nonce, if they don't match then bounce!
			if (! wp_verify_nonce( $nonce, 'aft_installer_nonce' ))
				wp_die( __( 'Error - unable to verify nonce, please try again.', 'covernews') );


         // Include required libs for installation
			require_once( ABSPATH . 'wp-admin/includes/plugin-install.php' );
			require_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );
			require_once( ABSPATH . 'wp-admin/includes/class-wp-ajax-upgrader-skin.php' );
			require_once( ABSPATH . 'wp-admin/includes/class-plugin-upgrader.php' );

			// Get Plugin Info
			$api = plugins_api( 'plugin_information',
				array(
					'slug' => $plugin,
					'fields' => array(
						'short_description' => false,
						'sections' => false,
						'requires' => false,
						'rating' => false,
						'ratings' => false,
						'downloaded' => false,
						'last_updated' => false,
						'added' => false,
						'tags' => false,
						'compatibility' => false,
						'homepage' => false,
						'donate_link' => false,
					),
				)
			);

			$skin     = new WP_Ajax_Upgrader_Skin();
			$upgrader = new Plugin_Upgrader( $skin );
			$upgrader->install($api->download_link);

			if($api->name){
				$status = 'success';
				$msg = $api->name .' successfully installed.';
			} else {
				$status = 'failed';
				$msg = 'There was an error installing '. $api->name .'.';
			}

			$json = array(
				'status' => $status,
				'msg' => $msg,
			);

			wp_send_json($json);

		}

		function covernews_plugin_activation(){
			if ( ! current_user_can('install_plugins') )
				wp_die( __( 'Sorry, you are not allowed to activate plugins on this site.', 'covernews' ) );

			$nonce = $_POST["nonce"];
			$plugin = $_POST["plugin"];

			// Check our nonce, if they don't match then bounce!
			if (! wp_verify_nonce( $nonce, 'aft_installer_nonce' ))
				die( __( 'Error - unable to verify nonce, please try again.', 'covernews' ) );


         // Include required libs for activation
			require_once( ABSPATH . 'wp-admin/includes/plugin-install.php' );
			require_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );
			require_once( ABSPATH . 'wp-admin/includes/class-plugin-upgrader.php' );


			// Get Plugin Info
			$api = plugins_api( 'plugin_information',
				array(
					'slug' => $plugin,
					'fields' => array(
						'short_description' => false,
						'sections' => false,
						'requires' => false,
						'rating' => false,
						'ratings' => false,
						'downloaded' => false,
						'last_updated' => false,
						'added' => false,
						'tags' => false,
						'compatibility' => false,
						'homepage' => false,
						'donate_link' => false,
					),
				)
			);


			if($api->name){
				$main_plugin_file = covernews_get_plugin_file($plugin);
				$status = 'success';
				if($main_plugin_file){
					activate_plugin($main_plugin_file,'', false, true);
					$msg = $api->name .' successfully activated.';
				}
			} else {
				$status = 'failed';
				$msg = 'There was an error activating '. $api->name .'.';
			}

			$json = array(
				'status' => $status,
				'msg' => $msg,
				'plugin'=>$plugin,
				'redirectUrl'=> site_url( ).'/wp-admin/admin.php?page='.$plugin
			);

			

			wp_send_json($json);

		}
    
    

    


