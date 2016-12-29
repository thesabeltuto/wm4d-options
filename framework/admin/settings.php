<?php /* Admin Settings */

// create custom plugin settings menu
add_action('admin_menu', 'WM4D_OPTIONS_PLUGIN_theme_create_menu');

add_action( 'admin_enqueue_scripts', 'call_wm4d_ajax_admin' );
add_action( 'wp_ajax_nopriv_add_wm4d_ajax_admin', 'add_wm4d_ajax_admin');
add_action( 'wp_ajax_add_wm4d_ajax_admin', 'add_wm4d_ajax_admin');


function WM4D_OPTIONS_PLUGIN_theme_create_menu() {

	//create new top-level menu
	add_menu_page('WM4D Options', 'WM4D Options', 'administrator', 'wm4d_options', 'WM4D_OPTIONS_PLUGIN_home_page', '', 4 );

	//create new submenus
	add_submenu_page( 'wm4d_options', 'Client Options', 'Client Options', 'manage_options', 'wm4d_options_client_options', 'WM4D_OPTIONS_PLUGIN_submenu_client_options' );
	add_submenu_page( 'wm4d_options', 'Flipper Options', 'Flipper Options', 'manage_options', 'wm4d_options_flipper_options', 'WM4D_OPTIONS_PLUGIN_submenu_flipper_options' );
	add_submenu_page( 'wm4d_options', 'Custom Codes', 'Custom Codes', 'manage_options', 'wm4d_options_custom_codes', 'WM4D_OPTIONS_PLUGIN_submenu_custom_codes' );
	add_submenu_page( 'wm4d_options', 'Page Texts', 'Page Options', 'manage_options', 'wm4d_options_page_options', 'WM4D_OPTIONS_PLUGIN_submenu_page_options' );
	add_submenu_page( 'wm4d_options', 'Support', 'Support', 'manage_options', 'wm4d_options_support', 'WM4D_OPTIONS_PLUGIN_submenu_support' );
	add_submenu_page( 'wm4d_options', 'About', 'About', 'manage_options', 'wm4d_options_about', 'WM4D_OPTIONS_PLUGIN_submenu_about' );
	
	//call register settings function
	add_action('admin_init', 'WM4D_OPTIONS_PLUGIN_register_codes_options' );
	add_action('admin_init', 'WM4D_OPTIONS_PLUGIN_register_page_options' );
	add_action('admin_init', 'WM4D_OPTIONS_PLUGIN_register_client_options' );
	add_action('admin_init', 'WM4D_OPTIONS_PLUGIN_register_flipper_options' );
	add_action('admin_init', 'WM4D_OPTIONS_PLUGIN_register_support_options' );

}

function add_wm4d_ajax_admin(){
	require(WM4D_OPTIONS_PLUGIN_DIR.'/framework/admin/ajax-script.js.php');
	exit;
}
function call_wm4d_ajax_admin() {
	wp_register_script('wm4d_ajax_admin', '/wp-admin/admin-ajax.php?action=add_wm4d_ajax_admin', '', $GLOBALS['WM4D_OPTIONS_PLUGIN_AJAX_ADMIN_VERSION'],true);	
    wp_enqueue_script( 'wm4d_ajax_admin', 'jQuery' );
}


function WM4D_OPTIONS_PLUGIN_register_codes_options() {
	//register codes settings
	register_setting( 'wm4d-codes-group', 'wm4d_css' );
	register_setting( 'wm4d-codes-group', 'wm4d_script' );
	register_setting( 'wm4d-codes-group', 'wm4d_html' );
	register_setting( 'wm4d-codes-group', 'wm4d_footer' );
}

function WM4D_OPTIONS_PLUGIN_register_page_options() {
	//register page settings
	register_setting( 'wm4d-page-group', 'wm4d_testimonials' );
	register_setting( 'wm4d-page-group', 'wm4d_before_afters' );
	register_setting( 'wm4d-page-group', 'wm4d_office_images' );
	register_setting( 'wm4d-page-group', 'wm4d_functions_select' );
}

function WM4D_OPTIONS_PLUGIN_register_client_options() {
	//register client settings
	register_setting( 'wm4d-client-group', 'wm4d_client' );

	register_setting( 'wm4d-client-group', 'wm4d_doctor' );
	register_setting( 'wm4d-client-group', 'wm4d_doc_titles' );
	register_setting( 'wm4d-client-group', 'wm4d_phone' );
	register_setting( 'wm4d-client-group', 'wm4d_location' );
	register_setting( 'wm4d-client-group', 'wm4d_location_short' );
	
	register_setting( 'wm4d-client-group', 'wm4d_doctors' );
	register_setting( 'wm4d-client-group', 'wm4d_docs_titles' );
	register_setting( 'wm4d-client-group', 'wm4d_phones' );
	register_setting( 'wm4d-client-group', 'wm4d_locations' );

	register_setting( 'wm4d-client-group', 'wm4d_practice' );
	register_setting( 'wm4d-client-group', 'wm4d_multiple_select' );
	register_setting( 'wm4d-client-group', 'wm4d_phone_format_select' );

	register_setting( 'wm4d-client-group', 'wm4d_phones_loc' );
}

function WM4D_OPTIONS_PLUGIN_register_flipper_options() {
	//register flipper settings
	register_setting( 'wm4d-flipper-group', 'wm4d_flipper_phone' );
	register_setting( 'wm4d-flipper-group', 'wm4d_flipper_phones' );
	register_setting( 'wm4d-flipper-group', 'wm4d_flipper_select' );

	register_setting( 'wm4d-flipper-group', 'wm4d_flipper_referers' );
	
	if(get_option('wm4d_flipper_referers')==''){
		$default_referers=array('yahoo','bing','google','facebook', 'youtube', 'twitter');
		update_option('wm4d_flipper_referers', $default_referers);
	}

	register_setting( 'wm4d-flipper-group', 'wm4d_flipper_campaign_phone' );
	register_setting( 'wm4d-flipper-group', 'wm4d_flipper_campaign_phones' );

	register_setting( 'wm4d-flipper-group', 'wm4d_flipper_server_mode' );
	
	if(get_option('wm4d_flipper_server_mode')==''){
		update_option('wm4d_flipper_server_mode', 'client');
	}
}

function WM4D_OPTIONS_PLUGIN_register_support_options() {
	//register support settings
	register_setting( 'wm4d-support-group', 'wm4d_beta_select' );
	register_setting( 'wm4d-support-group', 'wm4d_console_select' );
}

function WM4D_OPTIONS_PLUGIN_selection() {
		if ( isset($_POST['submit']) ) {
		
			if ( isset( $_POST['wm4d_flipper_select'] ) )
				update_option( 'wm4d_flipper_select', 'enable' );
			else
				update_option( 'wm4d_flipper_select', 'false' );
				
			if ( isset( $_POST['wm4d_functions_select'] ) )
				update_option( 'wm4d_functions_select', 'enable' );
			else
				update_option( 'wm4d_functions_select', 'false' );
		
			if ( isset( $_POST['wm4d_multiple_select'] ) )
				update_option( 'wm4d_multiple_select', 'enable' );
			else
				update_option( 'wm4d_multiple_select', 'false' );
		
			if ( isset( $_POST['wm4d_testing_select'] ) )
				update_option( 'wm4d_testing_select', 'enable' );
			else
				update_option( 'wm4d_testing_select', 'false' );
		
			if ( isset( $_POST['wm4d_beta_select'] ) )
				update_option( 'wm4d_beta_select', 'enable' );
			else
				update_option( 'wm4d_beta_select', 'false' );

			if ( isset( $_POST['wm4d_map_select'] ) )
				update_option( 'wm4d_map_select', 'enable' );
			else
				update_option( 'wm4d_map_select', 'false' );

			if ( isset( $_POST['wm4d_console_select'] ) )
				update_option( 'wm4d_console_select', 'enable' );
			else
				update_option( 'wm4d_console_select', 'false' );

		
			if(isset($_POST['wm4d_doctors'])){
				$wm4d_doctors =array();
				foreach($_POST['wm4d_doctors'] as $key => $value){
					array_push($wm4d_doctors, $value);
				};			
			}
		
			if(isset($_POST['wm4d_locations'])){
				$wm4d_locations =array();
				foreach($_POST['wm4d_locations'] as $key => $value){
					array_push($wm4d_locations, $value);
				}
			}

			if(isset($_POST['wm4d_phones'])){
				$wm4d_phones =array();
				foreach($_POST['wm4d_phones'] as $key => $value){
					array_push($wm4d_phones, $value );
				}
			}

			if(isset($_POST['wm4d_phones_loc'])){
				$wm4d_phones_loc =array();
				foreach($_POST['wm4d_phones_loc'] as $key => $value){
					array_push($wm4d_phones_loc, $value);
				}
			}
			
			update_option( 'wm4d_doctors', $wm4d_doctors );
			update_option( 'wm4d_locations', $wm4d_locations );
			update_option( 'wm4d_phones', $wm4d_phones );
			update_option( 'wm4d_phones_loc', $wm4d_phones_loc );
			
			if(isset($_POST['wm4d_flipper_referers'])){
				$wm4d_flipper_referers =array();
				foreach($_POST['wm4d_flipper_referers'] as $key => $value){
					array_push($wm4d_flipper_referers, $value);
				}
			}
			
			if(isset($_POST['wm4d_flipper_campaign_phone'])){
				$wm4d_flipper_campaign_phone =array();
				foreach($_POST['wm4d_flipper_campaign_phone'] as $key => $value){
					array_push($wm4d_flipper_campaign_phone, $value);
				}
			} 

			if(isset($_POST['wm4d_flipper_campaign_phones'])){
				$wm4d_flipper_campaign_phones =array();
				foreach($_POST['wm4d_flipper_campaign_phones'] as $key => $value){
					array_push($wm4d_flipper_campaign_phones, $value);
				}
			} 
			
			if(isset($_POST['wm4d_flipper_phone'])){
				$wm4d_flipper_phone =array();
				foreach($_POST['wm4d_flipper_phone'] as $key => $value){
					array_push($wm4d_flipper_phone, $value);
				}
			}
			if(isset($_POST['wm4d_flipper_phones'])){
				$wm4d_flipper_phones =array();
				foreach($_POST['wm4d_flipper_phones'] as $key => $value){
					array_push($wm4d_flipper_phones, $value);
				}
			}
			
			update_option( 'wm4d_flipper_phone', $wm4d_flipper_phone );
			update_option( 'wm4d_flipper_phones', $wm4d_flipper_phones );

			update_option( 'wm4d_flipper_referers', $wm4d_flipper_referers );
			update_option( 'wm4d_flipper_campaign_phone', $wm4d_flipper_campaign_phone );
			update_option( 'wm4d_flipper_campaign_phones', $wm4d_flipper_campaign_phones );

			update_option( 'wm4d_flipper_server_mode', $wm4d_flipper_server_mode );


			if(isset($_POST['wm4d_map_addresses'])){
				$wm4d_map_addresses =array();
				foreach($_POST['wm4d_map_addresses'] as $key => $value){
					array_push($wm4d_map_addresses, $value);
				}
			}

			if(isset($_POST['wm4d_map_links'])){
				$wm4d_map_links =array();
				foreach($_POST['wm4d_map_links'] as $key => $value){
					array_push($wm4d_map_links, $value);
				}
			}
			
			update_option( 'wm4d_map_address', $wm4d_map_address );
			update_option( 'wm4d_map_addresses', $wm4d_map_addresses );

			update_option( 'wm4d_map_link', $wm4d_map_link );
			update_option( 'wm4d_map_links', $wm4d_map_links );
			
		}
}
?>