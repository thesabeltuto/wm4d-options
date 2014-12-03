<?php
/*
	Plugin Name: WM4D-Options
	Plugin URI: http://wm4d.com
	Description: This plugin is a simplified <a href="http://www.wm4d.com/" target="_blank">WM4D</a> plugin that includes custom post types and widgets of  before and afters, prodecures, offers, office images and testimonials. This plugin also includes theme options that can help you edit styles and scripts on dashboard.
	Version: 3.0.5
	Author: Thesabel Tuto
	Author URI: http://thesabeltuto.blogspot.com
	Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=H228JQZP6269J&lc=PH&item_name=TT%2dPlugins&item_number=tt%2dplugins¤cy_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted
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

// Load Plugin
add_action('init', 'load_WM4D_OPTIONS_PLUGIN_scripts');
require_once(WM4D_OPTIONS_PLUGIN_DIR.'/includes/wm4d-functions.php');

if ( is_admin() ) {
	add_action('init', 'load_WM4D_OPTIONS_PLUGIN_scripts_in');
} else {
	add_action('wp_head', 'load_WM4D_OPTIONS_PLUGIN_scripts_out');
}

function load_WM4D_OPTIONS_PLUGIN_scripts_out() {
    wp_enqueue_script('wm4d-option-thescripts.js', WM4D_OPTIONS_PLUGIN_URL.'/js/thescripts.js');	
    wp_enqueue_script('wm4d-option-jquery.fancybox.pack.js', WM4D_OPTIONS_PLUGIN_URL.'/js/jquery.fancybox.pack.js');	
    wp_enqueue_script('wm4d-option-jquery.cycle.all.js', WM4D_OPTIONS_PLUGIN_URL.'/js/jquery.cycle.all.js');	
	wp_enqueue_style('wm4d-option-jquery.fancybox.css',  WM4D_OPTIONS_PLUGIN_URL.'/css/jquery.fancybox.css');
	wp_enqueue_style('wm4d-option-style',  WM4D_OPTIONS_PLUGIN_URL.'/css/style.css');

	require(WM4D_OPTIONS_PLUGIN_DIR.'/includes/custom-codes.php');
}

function load_WM4D_OPTIONS_PLUGIN_scripts_in() {
    wp_enqueue_script('wm4d-option-admin.js', WM4D_OPTIONS_PLUGIN_URL.'/js/admin.js');	
	wp_enqueue_style('wm4d-option-admin.css',  WM4D_OPTIONS_PLUGIN_URL.'/css/admin.css');

	require(WM4D_OPTIONS_PLUGIN_DIR.'/includes/admin.php');
}

function load_WM4D_OPTIONS_PLUGIN_scripts() {
	wp_enqueue_script('jquery');
}
?>