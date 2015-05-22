<?php /* Admin Page Texts Options Page*/

function WM4D_OPTIONS_PLUGIN_submenu_page_options() {
	WM4D_OPTIONS_PLUGIN_selection();
?>
	<div class="wm4d_wrap">
	<h1>WM4D Options</h1>
    <div id="wm4d_nav">
        <ul>
			<?php WM4D_OPTIONS_PLUGIN_navigation(); ?>
       </ul>
    </div>
	<form method="post" action="options.php">
		<?php settings_fields( 'wm4d-page-group' );
				do_settings_sections( 'wm4d-page-group' ); ?>
		<div class="wm4d_content" id="wm4d_li-2">
			<h2>Page Options</h2>
    		<?php submit_button(); ?>
            <h2><input name="wm4d_functions_select" type="checkbox" value="enable" <?php checked( get_option('wm4d_functions_select') == 'enable' ); ?> /> &nbsp;
            Enable / Disable WM4D Functions</h2>
            <hr />
            <p>Enabling this will activate the WM4D functions, custom posts and widgets in your site.
            </p>
		
			<?php if ( get_option('wm4d_functions_select') == 'enable' ) { ?>
                <h2>Page Texts</h2>
                <hr />
                <?php WM4D_OPTIONS_PLUGIN__page_option_post_types(); ?>    
                <div class="wm4d_section">
                <h3>Before and Afters Page Text</h3>
                <textarea type="text" name="wm4d_before_afters" rows="7" cols="60" /><?php echo get_option('wm4d_before_afters'); ?></textarea>
                <br />Enter your desired text for Before and Afters archive page.
                </div>
    
                <div class="wm4d_section">
                <h3>Testimonials Page Text</h3>
                <textarea type="text" name="wm4d_testimonials" rows="7" cols="60" /><?php echo get_option('wm4d_testimonials'); ?></textarea>
                <br />Enter your desired text for Testimonials archive page.
                </div>
    
                <div class="wm4d_section">
                <h3>Office Images Page Text</h3>
                <textarea type="text" name="wm4d_office_images" rows="7" cols="60" /><?php echo get_option('wm4d_office_images'); ?></textarea>
                <br />Enter your desired text for Office Images archive page.
                </div>
            <?php } ?>
        
    		<?php submit_button(); ?>
		</div>
	</form>
    </div>
<?php
}
?>