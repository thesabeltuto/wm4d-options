<?php
require_once(WM4D_OPTIONS_PLUGIN_DIR.'/framework/post-types/procedures.php');
require_once(WM4D_OPTIONS_PLUGIN_DIR.'/framework/post-types/doctors.php');
require_once(WM4D_OPTIONS_PLUGIN_DIR.'/framework/post-types/team.php');
require_once(WM4D_OPTIONS_PLUGIN_DIR.'/framework/post-types/offers.php');
require_once(WM4D_OPTIONS_PLUGIN_DIR.'/framework/post-types/office-images.php');
require_once(WM4D_OPTIONS_PLUGIN_DIR.'/framework/post-types/before-after.php');
require_once(WM4D_OPTIONS_PLUGIN_DIR.'/framework/post-types/testimonials.php');

/** MAKE THUMBNAILS WORK ON CUSTOM POSTS **/
add_action( 'after_setup_theme', 'WM4D_OPTIONS_PLUGIN_post_type_thumbs', 99 );
function WM4D_OPTIONS_PLUGIN_post_type_thumbs() {
	add_theme_support( 'post-thumbnails' );
}

add_action( 'init', 'custom_post_procedures' );
add_action( 'init', 'custom_post_doctors' );
add_action( 'init', 'custom_post_team' );
add_action( 'init', 'custom_post_testimonials' );
add_action( 'init', 'custom_post_offers' );
add_action( 'init', 'custom_post_before_and_afters' );
add_action( 'init', 'custom_post_office_images' );

add_action( 'admin_init', 'WM4D_OPTIONS_PLUGIN_register_page_options2' );

function WM4D_OPTIONS_PLUGIN_register_page_options2() {
	//register page settings
	register_setting( 'wm4d-page-group', 'wm4d_page_doctor' );
	register_setting( 'wm4d-page-group', 'wm4d_page_team' );
}

function WM4D_OPTIONS_PLUGIN__page_option_post_types(){
?>
        <div class="wm4d_section">
        <h3>Doctor Page Text</h3>
        <textarea type="text" name="wm4d_page_doctor" rows="7" cols="60" /><?php echo get_option('wm4d_page_doctor'); ?></textarea>
        <br />Enter your desired text for Doctor archive page.
        </div>
        <div class="wm4d_section">
        <h3>Team Page Text</h3>
        <textarea type="text" name="wm4d_page_team" rows="7" cols="60" /><?php echo get_option('wm4d_page_team'); ?></textarea>
        <br />Enter your desired text for Doctor archive page.
        </div>
<?php
}

function WM4D_OPTIONS_PLUGIN__support_page_post_types(){
?>
		<p><strong>Doctor Page Text</strong> is where you enter your desired text for Meet the Doctor/s archive page.
        Shortcode is`[text_doctors_page]`.</p>
        <p><strong>Team Page Text</strong> is where you enter your desired text for Meet the Doctor archive page.
        Shortcode is`[text_team_page]`.</p>
<?php
}

function WM4D_OPTIONS_PLUGIN__support_custom_post_types(){
?>
		<p><strong>Doctor Page Text</strong> is where you add Doctor's full bio and credentials.
        Contents posted in this section will be displayed as a regular post page.</p>
		<p><strong>Team Page Text</strong> is where you add Team Member's full bio and credentials.
        Contents posted in this section will be displayed as a regular post page.</p>
<?php
}

add_shortcode( 'text_doctors_page', 'wm4d_page_doctor' );	
add_shortcode( 'text_team_page', 'wm4d_page_team' );	

function wm4d_page_doctor( $atts ){
	$wm4d_page_doctor = get_option('wm4d_page_doctor');
	return $wm4d_page_doctor;
}

function wm4d_page_team( $atts ){
	$wm4d_page_team = get_option('wm4d_page_team');
	return $wm4d_page_team;
}


?>