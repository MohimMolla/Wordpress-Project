<?php
defined('ABSPATH') or die('No script kiddies please!'); // prevent direct access
if(!class_exists('AF_themes_info')){
class AF_themes_info{
		/**
		 * Version
		 *
		 * @var string $version Class version.
		 *
		 * @since 1.0.0
		 */
		private $version = '1.0.1';	

			/**
		 * Theme name.
		 *
		 * @var string $theme_name Theme name.
		 *
		 * @since 1.0.0
		 */
		private $theme_name;

		private $current_user_name;

		/**
		 * Theme slug.
		 *
		 * @var string $theme_slug Theme slug.
		 *
		 * @since 1.0.0
		 */
		private $theme_slug;

		function __construct() {
			$theme = wp_get_theme();

			$this->theme_name = $theme->get( 'Name' );
			$this->theme_version = $theme->get( 'Version' );
			$this->theme_slug    = $theme->get_template();
			$this->menu_name     = isset( $this->config['menu_name'] ) ? $this->config['menu_name'] : sprintf( esc_html__( '%s', 'covernews' ), $this->theme_name );
			$this->page_name     = isset( $this->config['page_name'] ) ? $this->config['page_name'] : sprintf( esc_html__( '%s', 'covernews' ), $this->theme_name );
			$this->page_slug     = $this->theme_slug . '-details';
			add_action( 'admin_menu', array( $this, 'covernews_register_info_page' ) );
			add_action( 'admin_enqueue_scripts', array($this,'covernews_register_backend_scripts'));
			add_action( 'init', array($this,'covernews_load_files'));
			add_filter( 'admin_body_class',array($this,'my_body_classes') );


			$current_user = wp_get_current_user();
			$this->current_user_name = $current_user->user_login;
			
			
		}

		function my_body_classes( $classes ) {
			$classes = explode(' ', $classes);
			$classes = array_merge($classes, [
				'aft-admin-dashboard-notice'
			]);
			return implode(' ', array_unique($classes));
			 
		
			 
		}
		public function covernews_register_info_page() {

			// Add info page.
			add_theme_page( $this->menu_name, $this->page_name, 'activate_plugins', $this->page_slug, array( $this, 'covernews_render_page' ), 1 );
		}

		public function covernews_render_page(){?>
			<div id="af-theme-dashboard"></div>
   		<?php }


		function covernews_register_backend_scripts(){
				wp_enqueue_style( 'plugin-installer-style', get_template_directory_uri(). '/admin-dashboard/dist/style-admin_dashboard.css','','1.0','all');
				wp_enqueue_script('aftheme-dashboard', // Handle.
				get_template_directory_uri() . '/admin-dashboard/dist/admin_dashboard.build.js', array('react', 'react-dom', 'wp-api-fetch','wp-element'), // Dependencies, defined above.
				'1.0.0',
				true
				);

				$changelog = $this->covernews_get_latest_changelog();
				$dahboard_path = get_template_directory_uri().'/admin-dashboard/plugin-imgs';
				$siteUrl = site_url( );
				$theme = wp_get_theme();
				
			
				wp_localize_script(
					'aftheme-dashboard',
					'afDashboardData',
					[
						'customizer_url' => admin_url('/customize.php?autofocus'),
						'changelog'=>$changelog,
						'dahboard_path'=>$dahboard_path,
						'siteUrl'=>$siteUrl,
						'aflogoUrl'=>get_template_directory_uri(),
						"themeUrl"=>(! is_child_theme())?get_template_directory_uri():get_stylesheet_directory_uri(),
						"themeName"=>$this->theme_name,
						"themeVesrion"=>$this->theme_version,
						"currentUser"=>$this->current_user_name
						
					]
				);

				wp_enqueue_script( 'plugin-installer', get_template_directory_uri(). '/admin-dashboard/dist/plugin_installer.build.js', array( 'jquery','aftheme-dashboard' ));
				wp_localize_script( 'plugin-installer', 'aft_installer_localize', array(
				'ajax_url' => admin_url('admin-ajax.php'),
				'admin_nonce' => wp_create_nonce('aft_installer_nonce'),
				'install_now' => __('Are you sure you want to install this plugin?', 'covernews'),
				'install_btn' => __('Install Now', 'covernews'),
				'activate_btn' => __('Activate', 'covernews'),
				'installed_btn' => __('Activated', 'covernews')
				));
		}

		function covernews_get_latest_changelog(){
			$readme = null;
			$access_type = get_filesystem_method();
	
			if ($access_type === 'direct') {
				$creds = request_filesystem_credentials(
					site_url() . '/wp-admin/',
					'', false, false,
					[]
				);
	
				if (WP_Filesystem($creds)) {
					global $wp_filesystem;
	
					$readme = $wp_filesystem->get_contents(
						get_template_directory() . '/changelog.txt'
					);
				}

				$newchangelog = str_replace("###" ,"",$readme);
				$newchangelog = str_replace("Changes:" ,"",$newchangelog);
				$newchangelog = str_replace("*" ,"",$newchangelog);
				
				$newchangelogs =explode("###",$newchangelog);
					
				$changelog = '';
	
	
				foreach(array_filter($newchangelogs) as $key=>$val){
				
					if(!empty($val)){
					  $changelog .= $val;
					}
				}
				
			}
	
	
			return $changelog;
	

		}

		function covernews_load_files(){
			require_once  get_template_directory().'/admin-dashboard/rest-api/api-request.php';
			require_once  get_template_directory().'/admin-dashboard/rest-api/class-admin-notice.php';
			require_once  get_template_directory().'/admin-dashboard/rest-api/class-ajaxcall.php';
		}
}

$aft_dashboard = new AF_themes_info;
}