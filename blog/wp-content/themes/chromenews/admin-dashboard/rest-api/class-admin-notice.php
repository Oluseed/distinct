<?php 
class AdminNotice {

    private $dismiss_notice_key = 'aft_notice_dismissed';

    private $theme_name;
	private $theme_slug;
	private $screenshot;
	private $page_slug;


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
			add_action( 'admin_notices', [ $this, 'chromenews_admin_notice' ], 0 );
			add_action( 'wp_ajax_aft_notice_dismiss', [ $this, 'chromenews_notice_dismiss' ] );
		}
	
    }

    function chromenews_admin_notice(){
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
        $this->chromenews_dashboard_notice_content();
        echo '</div>';

       
    }

    function chromenews_dashboard_notice_content(){
		if ( file_exists( WP_PLUGIN_DIR . '/af-companion/af-companion.php' ) ) {
			if(is_plugin_active('af-companion/af-companion.php')){
				$af_companion_title = __( 'Get Starter Sites', 'chromenews' );
				$af_companion_url = site_url( ).'/wp-admin/admin.php?page=af-companion';
			}else{
            $af_companion_title = __( 'Activate AF Companion', 'chromenews' );
            $af_companion_url = wp_nonce_url( 'plugins.php?action=activate&plugin=af-companion/af-companion.php&plugin_status=all&paged=1', 'activate-plugin_af-companion/af-companion.php' );
			}
        }else{
            $af_companion_title = __( 'Install AF Companion', 'chromenews' );
            $af_companion_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=af-companion' ), 'install-plugin_af-companion' );
        }


        $main_template = '<div class="aft-notice-wrapper">
        %1$s
        
        <div class="aft-notice-msg-wrapper">%2$s %3$s %4$s  </div>
        
        </div>';
        
        $notice_header = sprintf(
			'<h2>%1$s</h2><p class="about-description">%2$s</p></hr>',
			esc_html__( 'Howdy!', 'chromenews' ),
			sprintf(
				esc_html__( '%s is now installed and ready to use. We\'ve assembled some links to get you started.', 'chromenews' ),
				$this->theme_name
			)
		);

        $notice_picture    = sprintf(
			'<div class="aft-notice-col-1"><figure>
					<img src="%1$s"/>
				</figure></div>',
				esc_url( $this->screenshot )
		);

		$demo_link = "https://afthemes.com/products/chromenews/";
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
				__( 'Click, Import, Wow! No Coding - Your Site Ready in Minutes!', 'chromenews' ),
				esc_html__( 'Explore our ready-to-use websites! No coding required—just one click to import a demo and have your site up in minutes. Thanks for choosing our theme—let your creativity shine!', 'chromenews' ),
				$af_companion_url,
			$af_companion_title,
			esc_url($demo_link),
			esc_html__('Explore More','chromenews'),
			esc_url( admin_url() ."themes.php?page=".$this->page_slug ),
			esc_html__('Theme dashboard','chromenews')

		);

		
		$notice_external_msg =sprintf(
			'<div class="aft-notice-col-3">
			<div class="aft-documentation">
				<h3><span class="dashicons dashicons-format-aside"></span>%1$s</h3>
				<p>%2$s</p>
			</div>
			<div class="aft-documentation-links">
				<div>
					<a href="' . esc_url( 'https://docs.afthemes.com/chromenews/' ) . '" target="_blank"><span aria-hidden="true" class="dashicons dashicons-external"></span>%3$s</a>
					<a href="' . esc_url( 'https://www.youtube.com/@wpafthemes' ) . '" target="_blank"><span aria-hidden="true" class="dashicons dashicons-external"></span>%4$s</a>
					<a href="' . esc_url( 'https://afthemes.com/blog/' ) . '" target="_blank"><span aria-hidden="true" class="dashicons dashicons-external"></span>%5$s</a>
					<a href="' . esc_url( 'https://afthemes.com/supports/' ) . '" target="_blank"><span aria-hidden="true" class="dashicons dashicons-external"></span>%6$s</a>
				</div>
				<div>
					<a href="https://afthemes.com/products/chromenews-pro/" target="_blank" class="button">%7$s</a>
				</div>
			</div>
			</div>',
			__( 'Documentation', 'chromenews' ),
			esc_html__( 'Please check our full documentation for detailed information on how to setup and customize the theme.', 'chromenews' ),
			esc_html__( 'Docs', 'chromenews' ),
			esc_html__( 'Videos', 'chromenews' ),
			esc_html__( 'Blog', 'chromenews' ),
			esc_html__( 'Support', 'chromenews' ),
			esc_html__( 'Upgrade', 'chromenews' ),

		);

		

        echo sprintf($main_template,
        $notice_header,
        $notice_picture,
		$notice_starter_msg,
		$notice_external_msg
	);
    }


    public function chromenews_notice_dismiss() {

       
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