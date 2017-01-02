<?php
/*
	Plugin Name: WM4D-Options
	Plugin URI: http://wm4d.com
	Description: This plugin is a simplified <a href="http://www.wm4d.com/" target="_blank">WM4D</a> plugin that includes custom post types and widgets of  before and afters, prodecures, offers, office images and testimonials.
	This plugin also includes theme options that can help you edit styles and scripts on dashboard. Client options has been added to provide flexibilty of information across the website.
	Number flipper has been added to help you flip phone numbers for specific website visitors.
	Version: 3.3.6
	Author: Thesabel Tuto
	Author URI: http://thesabeltuto.blogspot.com
	Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=H228JQZP6269J&lc=US&item_name=TT%2dPlugins%3a%20Support%20WordPress%20Plugin%20Development&item_number=TT%2dPlugins&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted
	License: GPLv2 or later
	License URI: http://www.gnu.org/licenses/gpl-2.0.html

	Copyright 2014  THESABEL UY TUTO, CSNA, MBA  (email : thesabeltuto@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Define paths and variables
define('WM4D_OPTIONS_PLUGIN_FILE', __FILE__ );
define('WM4D_OPTIONS_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('WM4D_OPTIONS_PLUGIN_URL', plugin_dir_url(__FILE__));

// Global variables
$WM4D_OPTIONS_PLUGIN_VERSION = '3.3.6';
$WM4D_OPTIONS_PLUGIN_CSS_VERSION = '3.0.9'; // style
$WM4D_OPTIONS_PLUGIN_JS_VERSION = '3.1.2'; // thescript
$WM4D_OPTIONS_PLUGIN_JS2_VERSION = '0.1.3'; // phonescript
$WM4D_OPTIONS_PLUGIN_ADMIN_CSS_VERSION = '3.1.5'; // admin
$WM4D_OPTIONS_PLUGIN_ADMIN_JS_VERSION = '3.1.5'; // admin
$WM4D_OPTIONS_PLUGIN_ADMIN_JS2_VERSION = '1.4.2'; // maskedinput
$WM4D_OPTIONS_PLUGIN_AJAX_ADMIN_VERSION = '1.5'; // ajax-admin
$WM4D_OPTIONS_PLUGIN_AJAX_BETA_TEST_VERSION = '1.9'; // ajax-beta
$WM4D_OPTIONS_PLUGIN_AJAX_MODS_VERSION = '0.0.6'; // ajax-mods


// Load Plugin
add_action('init', 'load_WM4D_OPTIONS_PLUGIN_scripts');
WM4D_OPTIONS_PLUGIN_wm4d_functions();

if ( is_admin() ) {
	add_action('init', 'load_WM4D_OPTIONS_PLUGIN_scripts_in');
} else {
	add_action('wp_head', 'load_WM4D_OPTIONS_PLUGIN_scripts_out');
	add_action('wp_footer', 'load_WM4D_OPTIONS_HTML_footer_out', 998, 1);
}

function load_WM4D_OPTIONS_PLUGIN_scripts_out() {
    wp_register_script('wm4d-option-thescripts.js', WM4D_OPTIONS_PLUGIN_URL.'/js/thescripts.js', '', $GLOBALS['WM4D_OPTIONS_PLUGIN_JS_VERSION'], false);	
	wp_register_style('wm4d-option-style',  WM4D_OPTIONS_PLUGIN_URL.'/css/style.css', '', $GLOBALS['WM4D_OPTIONS_PLUGIN_CSS_VERSION'], '');

    wp_enqueue_script('wm4d-option-jquery.fancybox.pack.js', WM4D_OPTIONS_PLUGIN_URL.'/js/jquery.fancybox.pack.js');	
    wp_enqueue_script('wm4d-option-jquery.cycle.all.js', WM4D_OPTIONS_PLUGIN_URL.'/js/jquery.cycle.all.js');	
	wp_enqueue_style('wm4d-option-jquery.fancybox.css',  WM4D_OPTIONS_PLUGIN_URL.'/css/jquery.fancybox.css');
    wp_enqueue_script('wm4d-option-thescripts.js');	
	wp_enqueue_style('wm4d-option-style');

	require(WM4D_OPTIONS_PLUGIN_DIR.'/includes/custom-codes.php');
	if(get_option('wm4d_testing_select') == 'enable') {
		require(WM4D_OPTIONS_PLUGIN_DIR.'/framework/beta-test/shortcodes.php');
	} else {
	}

    wp_register_script('wm4d-option-phonescript.js', WM4D_OPTIONS_PLUGIN_URL.'/js/phonescript.js', '', $GLOBALS['WM4D_OPTIONS_PLUGIN_JS2_VERSION'], true);
    wp_enqueue_script('wm4d-option-phonescript.js');
}

function load_WM4D_OPTIONS_PLUGIN_scripts_in() {
    wp_register_script('wm4d-option-admin.js', WM4D_OPTIONS_PLUGIN_URL.'/js/admin.js', '', $GLOBALS['WM4D_OPTIONS_PLUGIN_ADMIN_JS_VERSION'], false);	
    wp_register_script('wm4d-jquery.maskedinput.js', WM4D_OPTIONS_PLUGIN_URL.'/js/jquery.maskedinput.js', '', $GLOBALS['WM4D_OPTIONS_PLUGIN_ADMIN_JS2_VERSION'], true);	
	wp_register_style('wm4d-option-admin.css',  WM4D_OPTIONS_PLUGIN_URL.'/css/admin.css', '', $GLOBALS['WM4D_OPTIONS_PLUGIN_ADMIN_CSS_VERSION'], '');

    wp_enqueue_script('wm4d-option-admin.js');
	wp_enqueue_script('wm4d-jquery.maskedinput.js');	
	wp_enqueue_style('wm4d-option-admin.css');
 
	require(WM4D_OPTIONS_PLUGIN_DIR.'/framework/admin.php');
	
	if(get_option('wm4d_beta_select') == 'enable') {
		require(WM4D_OPTIONS_PLUGIN_DIR.'/framework/beta-test.php');
	} else {
	}

}

function load_WM4D_OPTIONS_PLUGIN_scripts() {
	wp_enqueue_script('jquery');
//  wp_register_script('wm4d-jquery-1.11.3.min.js', WM4D_OPTIONS_PLUGIN_URL.'/js/jquery-1.11.3.min.js', '', '1.11.3', false);	
//	wp_enqueue_script('wm4d-jquery-1.11.3.min.js');	
}

function load_WM4D_OPTIONS_HTML_footer_out() {
	$wm4d_footer = get_option('wm4d_footer');
	if(!empty($wm4d_footer)) echo do_shortcode($wm4d_footer);
}

function WM4D_OPTIONS_PLUGIN_wm4d_functions() {
	if ( get_option('wm4d_functions_select') == 'enable' ) {
		require(WM4D_OPTIONS_PLUGIN_DIR.'/framework/post-types.php');
		require(WM4D_OPTIONS_PLUGIN_DIR.'/includes/wm4d-functions.php');
	}
	
	require(WM4D_OPTIONS_PLUGIN_DIR.'/framework/shortcodes.php');
}


if ( get_option('wm4d_flipper_select') == 'enable' ) {
	include(WM4D_OPTIONS_PLUGIN_DIR.'/includes/flipper/flipper.php'); // by Andrey
}

//** AFTER THEME MODS HERE
add_action( 'after_setup_theme', 'WM4D_OPTIONS_PLUGIN_aftertheme');
function WM4D_OPTIONS_PLUGIN_aftertheme(){
	include(WM4D_OPTIONS_PLUGIN_DIR.'/framework/shortcodes-inner.php');
	include(WM4D_OPTIONS_PLUGIN_DIR.'/includes/integrations/integrations.php');
}

//** MODS PAGE HERE
include(WM4D_OPTIONS_PLUGIN_DIR.'/includes/mods/settings.php');

if(get_option('wm4d_console_select') == 'enable') {
	error_reporting(E_ALL); ini_set('display_errors', 1);		
} else {
}
?>