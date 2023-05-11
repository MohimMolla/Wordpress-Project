<?php 
class AdminNotice {

    private $dismiss_notice_key = 'aft_notice_dismissed';

    private $theme_name;
	private $theme_slug;
	private $screenshot;


    public function __construct() {

		$theme = wp_get_theme();
		if (! is_child_theme() ) {
			$this->screenshot =  get_template_directory_uri()."/screenshot.png";

		}else{
			$this->screenshot =  get_stylesheet_directory_uri()."/screenshot.png";

		}

		$this->theme_name = $theme->get( 'Name' );
		$this->theme_slug    = $theme->get_template();
		$this->page_slug     = $this->theme_slug . '-details';
      
        if ( get_option( $this->dismiss_notice_key ) !== 'yes' ) {
			add_action( 'admin_notices', [ $this, 'covernews_admin_notice' ], 0 );
			add_action( 'wp_ajax_aft_notice_dismiss', [ $this, 'covernews_notice_dismiss' ] );
		}
	
    }

    function covernews_admin_notice(){
        $current_screen = get_current_screen();
		
		if ( $current_screen->id !=='dashboard' && $current_screen->id !== 'themes' && $current_screen->id !=='appearance_page_af-dashbaord-details' ) {
            
			return;
		}

       

		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			return;
		}

		if ( is_network_admin() ) {
			return;
		}

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

        global $current_user;
		$user_id          = $current_user->ID;
		$dismissed_notice = get_user_meta( $user_id, $this->dismiss_notice_key, true );


		if ( $dismissed_notice === 'dismissed' ) {
			update_option( $this->dismiss_notice_key, 'yes' );
		}

		if ( get_option( $this->dismiss_notice_key, 'no' ) === 'yes' ) {
			return;
		}
        echo '<div class="aft-notice-content-wrapper updated notice">';
		echo '<button type="button" class="notice-dismiss aft-dismiss-notice"><span class="screen-reader-text">Dismiss this notice.</span></button>';
        $this->covernews_dashboard_notice_content();
        echo '</div>';

       
    }

    function covernews_dashboard_notice_content(){
		if ( file_exists( WP_PLUGIN_DIR . '/af-companion/af-companion.php' ) ) {
			if(is_plugin_active('af-companion/af-companion.php')){
				$af_companion_title = __( 'Get Starter Sites', 'covernews' );
				$af_companion_url = site_url( ).'/wp-admin/admin.php?page=af-companion';
			}else{
            $af_companion_title = __( 'Activate AF Companion', 'covernews' );
            $af_companion_url = wp_nonce_url( 'plugins.php?action=activate&plugin=af-companion/af-companion.php&plugin_status=all&paged=1', 'activate-plugin_af-companion/af-companion.php' );
			}
        }else{
            $af_companion_title = __( 'Install AF Companion', 'covernews' );
            $af_companion_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=af-companion' ), 'install-plugin_af-companion' );
        }


        $main_template = '<div class="aft-notice-wrapper">
        %1$s
        
        <div class="aft-notice-msg-wrapper">%2$s %3$s %4$s  </div>
        
        </div>';
        
        $notice_header = sprintf(
			'<h2>%1$s</h2><p class="about-description">%2$s</p></hr>',
			esc_html__( 'Howdy!', 'covernews' ),
			sprintf(
				esc_html__( '%s is now installed and ready to use. We\'ve assembled some links to get you started.', 'covernews' ),
				$this->theme_name
			)
		);

        $notice_picture    = sprintf(
			'<div class="aft-notice-col-1"><figure>
					<img src="%1$s"/>
				</figure></div>',
				esc_url( $this->screenshot )
		);

		$demo_link = "https://afthemes.com/products/covernews/";
		$notice_starter_msg =sprintf(
			'<div class="aft-notice-col-2">
				<div class="aft-general-info">
					<h3><span class="dashicons dashicons-images-alt2">
					</span>%1$s</h3>
					<p>%2$s</p>
				</div>
				<div class="aft-general-info-link">
					<div>
						<a href="%3$s" class="button button-primary">%4$s</a>
						<a href="%7$s" class="button">%8$s</a>
						
					</div>
					<div>
						<a href="%5$s" target="_blank"><span aria-hidden="true" class="dashicons dashicons-external"></span>%6$s</a>
					</div>
				</div>
				</div>',
			__( 'General info', 'covernews' ),
			esc_html__( 'All of the features provided by the theme are now ready to use; Here, we have gathered all of the essential details and helpful links for you and your better experience with the theme. Once again, Thanks for using our theme!', 'covernews' ),
			$af_companion_url,
			$af_companion_title,
			esc_url($demo_link),
			esc_html__('Demos/product','covernews'),
			esc_url( admin_url() ."themes.php?page=".$this->page_slug ),
			esc_html__('Theme dashboard','covernews')

		);

		
		$notice_external_msg =sprintf(
			'<div class="aft-notice-col-3">
			<div class="aft-documentation">
				<h3><span class="dashicons dashicons-format-aside"></span>%1$s</h3>
				<p>%2$s</p>
			</div>
			<div class="aft-documentation-links">
				<div>
					<a href="https://docs.afthemes.com/covernews/" target="_blank"><span aria-hidden="true" class="dashicons dashicons-external"></span>%3$s</a>
					<a href="https://www.youtube.com/watch?v=xGoGkII8ZUM&list=PL8nUD79gscmjTcKOtozDjH44CK1xHgzfM" target="_blank"><span aria-hidden="true" class="dashicons dashicons-external"></span>%4$s</a>
					<a href="https://afthemes.com/blog/" target="_blank"><span aria-hidden="true" class="dashicons dashicons-external"></span>%5$s</a>
				</div>
				<div>
					<a href="' . esc_url( admin_url() ) . '" class="button">%6$s</a>
				</div>
			</div>
			</div>',
			__( 'Documentation', 'covernews' ),
			esc_html__( 'Please check our full documentation for detailed information on how to setup and customize the theme.', 'covernews' ),
			esc_html__( 'Docs', 'covernews' ),
			esc_html__( 'Videos', 'covernews' ),
			esc_html__( 'Blog', 'covernews' ),
			esc_html__( 'Return to your dashboard', 'covernews' )

		);

		

        echo sprintf($main_template,
        $notice_header,
        $notice_picture,
		$notice_starter_msg,
		$notice_external_msg
	);
    }


    public function covernews_notice_dismiss() {

       
		if ( ! isset( $_POST['nonce'] ) ) {
			return;
		}
		$nonce =  $_POST['nonce'];
		if ( ! wp_verify_nonce( $nonce, 'aft_installer_nonce' ) ) {
			return;
		}
		
        
		update_option( $this->dismiss_notice_key, 'yes' );
		$json = array(
			'status' => 'success'
			
		);
		wp_send_json($json);
		wp_die();
	}

	
}

$data = new AdminNotice();