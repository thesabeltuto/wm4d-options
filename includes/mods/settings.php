<?php /* Mods Settings */
require(WM4D_OPTIONS_PLUGIN_DIR.'/includes/mods/mods.php');
include(WM4D_OPTIONS_PLUGIN_DIR.'/includes/mods/includes/resmap.php');

add_action('admin_menu', 'WM4D_OPTIONS_PLUGIN_theme_create_mods_menu');

add_action( 'admin_enqueue_scripts', 'add_ajax_wm4d_mods' );
add_action( 'wp_ajax_nopriv_add_wm4d_mods', 'add_wm4d_mods');
add_action( 'wp_ajax_add_wm4d_mods', 'add_wm4d_mods');

add_action( 'wp_enqueue_scripts', 'add_ajax_wm4d_mods_resmap' );
add_action( 'wp_ajax_nopriv_add_wm4d_mods_resmap', 'add_wm4d_mods_resmap');
add_action( 'wp_ajax_add_wm4d_mods_resmap', 'add_wm4d_mods_resmap');


function WM4D_OPTIONS_PLUGIN_theme_create_mods_menu() {

	//create new top-level menu
	add_menu_page('WM4D Mods', 'WM4D Mods', 'administrator', 'wm4d_mods', 'WM4D_OPTIONS_PLUGIN_submenu_mods', '', 99 );

	//create new submenus
	add_submenu_page( 'wm4d_mods', 'Res Map', 'Res Map', 'manage_options', 'wm4d_mods_resmap', 'WM4D_OPTIONS_PLUGIN_submenu_mods_resmap' );
	
	//call register settings function for MODS
	add_action('admin_init', 'WM4D_OPTIONS_PLUGIN_register_mods_options' );
	add_action('admin_init', 'WM4D_OPTIONS_PLUGIN_register_resmap_options' );
}


// AJAX

function add_wm4d_mods(){
	require(WM4D_OPTIONS_PLUGIN_DIR.'/includes/mods/ajax-script.js.php');
	exit;
}
function add_ajax_wm4d_mods() {
	wp_register_script('ajax_wm4d_mods', '/wp-admin/admin-ajax.php?action=add_wm4d_mods', '', $GLOBALS['WM4D_OPTIONS_PLUGIN_AJAX_MODS_VERSION'],true);	
    wp_enqueue_script( 'ajax_wm4d_mods', 'jQuery' );
}

function add_wm4d_mods_resmap(){
	require(WM4D_OPTIONS_PLUGIN_DIR.'/includes/mods/includes/resmap.js.php');
	exit;
}
function add_ajax_wm4d_mods_resmap() {
	wp_register_script('ajax_wm4d_mods_resmap', '/wp-admin/admin-ajax.php?action=add_wm4d_mods_resmap', '', $GLOBALS['WM4D_OPTIONS_PLUGIN_AJAX_MODS_VERSION'],true);	
    wp_enqueue_script( 'ajax_wm4d_mods_resmap', 'jQuery' );
}




// REGISTRATIONS

function WM4D_OPTIONS_PLUGIN_register_mods_options(){
	//register mods settings
	register_setting( 'wm4d-mods-group', 'wm4d_resmap_select' );
}

function WM4D_OPTIONS_PLUGIN_register_resmap_options(){
	//register map settings
	register_setting( 'wm4d-resmap-group', 'wm4d_map_address' );
	register_setting( 'wm4d-resmap-group', 'wm4d_map_link' );
	register_setting( 'wm4d-resmap-group', 'wm4d_map_select' );

	register_setting( 'wm4d-resmap-group', 'wm4d_map_addresses' );
	register_setting( 'wm4d-resmap-group', 'wm4d_map_links' );
}


// POST SUBMIT SELECTIONS

function WM4D_OPTIONS_PLUGIN_selection_mods() {
		if ( isset($_POST['submit']) ) {
			if ( isset( $_POST['wm4d_resmap_select'] ) )
				update_option( 'wm4d_resmap_select', 'enable' );
			else
				update_option( 'wm4d_resmap_select', 'false' );
		}
}

function WM4D_OPTIONS_PLUGIN_selection_resmap() {
		if ( isset($_POST['submit']) ) {
			if ( isset( $_POST['wm4d_map_select'] ) )
				update_option( 'wm4d_map_select', 'enable' );
			else
				update_option( 'wm4d_map_select', 'false' );


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

function WM4D_OPTIONS_PLUGIN_navigation_mods() {
?>
            <li id="wm4d_li0"><a href="?page=wm4d_options">Home</a></li>
            <li id="wm4d_li5"><a href="?page=wm4d_options_client_options">Client Options</a></li>
            <li id="wm4d_li6"><a href="?page=wm4d_options_flipper_options">Flipper Options</a></li>
            <li id="wm4d_li1"><a href="?page=wm4d_options_custom_codes">Custom Codes</a></li>
            <li id="wm4d_li2"><a href="?page=wm4d_options_page_options">Page Options</a></li>
            <li id="wm4d_li8" class="active"><a href="?page=wm4d_mods">Mods</a></li>
            <li id="wm4d_li3"><a href="?page=wm4d_options_support">Support</a></li>
            <li id="wm4d_li4"><a href="?page=wm4d_options_about">About</a></li>
<?php	
}

function WM4D_OPTIONS_PLUGIN_navigation_mods_inner() {
	$param_page = $_GET['page'];
	
	switch ($param_page) {
		case 'wm4d_mods':
		?>
            <li><a href="?page=wm4d_mods_resmap">Res Map</a></li>
<?php	break;
		case 'wm4d_mods_resmap':
		?>
            <li class="active"><a href="?page=wm4d_mods_resmap">Res Map</a></li>
<?php	break;
	}
}
?>