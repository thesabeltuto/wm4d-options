<?php

add_action('admin_menu', 'WM4D_OPTIONS_PLUGIN_theme_create_beta_menu');

add_action( 'admin_enqueue_scripts', 'add_ajax_beta_test' );
add_action( 'wp_ajax_nopriv_add_beta_test', 'add_beta_test');
add_action( 'wp_ajax_add_beta_test', 'add_beta_test');

function WM4D_OPTIONS_PLUGIN_theme_create_beta_menu() {

	//create new top-level menu
	add_menu_page('WM4D Options *Beta*', 'WM4D Options *Beta*', 'administrator', 'wm4d_options_beta_test', 'WM4D_OPTIONS_PLUGIN_submenu_beta_test', '', 55 );

	//create new submenus
	//add_submenu_page( 'wm4d_options', 'Beta Test*', 'Beta Test*', 'manage_options', 'wm4d_options_beta_test', 'WM4D_OPTIONS_PLUGIN_submenu_beta_test' );
	
	//call register settings function
	add_action('admin_init', 'WM4D_OPTIONS_PLUGIN_register_beta_test' );
}



function add_beta_test(){
	require(WM4D_OPTIONS_PLUGIN_DIR.'/framework/admin/ajax-script.js.php');
	exit;
}
function add_ajax_beta_test() {
	wp_register_script('ajax_beta_test', '/wp-admin/admin-ajax.php?action=add_beta_test', '', $GLOBALS['WM4D_OPTIONS_PLUGIN_AJAX_BETA_TEST_VERSION'],true);	
    wp_enqueue_script( 'ajax_beta_test', 'jQuery' );
}

function WM4D_OPTIONS_PLUGIN_register_beta_test() {
	//register beta_test settings
	register_setting( 'wm4d-beta-test-group', 'wm4d_testing_select' );

	register_setting( 'wm4d-beta-test-group', 'wm4d_primary_referer' );
	register_setting( 'wm4d-beta-test-group', 'wm4d_primary_phone' );

	register_setting( 'wm4d-beta-test-group', 'wm4d_multiple_selected_phone' );
	register_setting( 'wm4d-beta-test-group', 'wm4d_multiple_referer' );
	register_setting( 'wm4d-beta-test-group', 'wm4d_multiple_phone' );

	register_setting( 'wm4d-beta-test-group', 'wm4d_doctors' );
	register_setting( 'wm4d-beta-test-group', 'wm4d_locations' );
	register_setting( 'wm4d-beta-test-group', 'wm4d_phones' );
	register_setting( 'wm4d-beta-test-group', 'wm4d_phones_loc' );
}

function WM4D_OPTIONS_PLUGIN_submission() {
	if ( isset($_POST['submit']) ) {

		//MULTIPLE OPTIONS | CLIENT OPTIONS
		if(isset($_POST['wm4d_doctors'])){
			$wm4d_doctors ="";
			foreach($_POST['wm4d_doctors'] as $key => $value){
				array_push($value, $wm4d_doctors);
			}
		}
		if(isset($_POST['wm4d_locations'])){
			$wm4d_locations ="";
			foreach($_POST['wm4d_locations'] as $key => $value){
				array_push($value, $wm4d_locations);
			}
		}
		if(isset($_POST['wm4d_phones'])){
			$wm4d_phones ="";
			foreach($_POST['wm4d_phones'] as $key => $value){
				array_push($value, $wm4d_phones);
			}
		}
		if(isset($_POST['wm4d_phones_loc'])){
			$wm4d_phones_loc ="";
			foreach($_POST['wm4d_phones_loc'] as $key => $value){
				array_push($value, $wm4d_phones_loc);
			}
		}
		update_option( 'wm4d_doctors', $wm4d_doctors);
		update_option( 'wm4d_locations', $wm4d_locations);
		update_option( 'wm4d_phones', $wm4d_phones);
		update_option( 'wm4d_phones_loc', $wm4d_phones_loc);

		//PRIMARY PHONE
		if(isset($_POST['wm4d_primary_referer'])){
			$primary_referers ="";
			foreach($_POST['wm4d_primary_referer'] as $key => $r1){
				array_push($r1, $primary_referers);
			}
		}
		if(isset($_POST['wm4d_primary_phone'])){
			$primary_phones ="";
			foreach($_POST['wm4d_primary_phone'] as $key => $p1){
				array_push($p1, $primary_phones);
			}
		update_option( 'wm4d_primary_referer', $primary_referers);
		update_option( 'wm4d_primary_phone', $primary_phones);
		
		//MULTIPLE PHONES
		if(isset($_POST['wm4d_multiple_selected_phone'])){
			$selectedphone ="";
			foreach($_POST['wm4d_multiple_selected_phone'] as $key => $s){
				array_push($s, $selectedphone);
			}
		}
		if(isset($_POST['wm4d_multiple_referer'])){
			$multiple_referers ="";
			foreach($_POST['wm4d_multiple_referer'] as $key => $r2){
				array_push($r2, $multiple_referers);
			}
		}
		if(isset($_POST['wm4d_multiple_phone'])){
			$multiple_phone ="";
			foreach($_POST['wm4d_multiple_phone'] as $key => $p2){
				array_push($p2, $multiple_phone);
			}
		}
		update_option( 'wm4d_multiple_selected_phone', $selectedphone);
		update_option( 'wm4d_multiple_referer', $multiple_referers);
		update_option( 'wm4d_multiple_phone', $multiple_phone);
		}

		if ( isset( $_POST['wm4d_testing_select'] ) )
			update_option( 'wm4d_testing_select', 'enable' );
		else
			update_option( 'wm4d_testing_select', 'false' );

	}
}

?>