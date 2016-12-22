<?php /* Admin Custom Codes Pages */

function WM4D_OPTIONS_PLUGIN_submenu_custom_codes() {
?>
	<div class="wm4d_wrap">
	<h1>WM4D Options <span>Version <?=$GLOBALS['WM4D_OPTIONS_PLUGIN_VERSION']?></span></h1>
    <div id="wm4d_nav">
        <ul>
			<?php WM4D_OPTIONS_PLUGIN_navigation(); ?>
        </ul>
    </div>
	<form method="post" action="options.php">
		<?php settings_fields( 'wm4d-codes-group' );
				do_settings_sections( 'wm4d-codes-group' ); ?>
        <div class="wm4d_content" id="wm4d_li-1">
			<h2>Custom Codes</h2>
    		<?php submit_button(); ?>
			<div class="wm4d_section">
            <h3>Custom Style</h3>
            <textarea type="text" name="wm4d_css" rows="7" cols="60" /><?php echo get_option('wm4d_css'); ?></textarea>
            <br />Enter your custom style in css.
            <br />No need to add &lt;style&gt; tags.
            <br />&nbsp;
            </div>
            
			<div class="wm4d_section">
			<h3>Custom Script</h3>
            <textarea type="text" name="wm4d_script" rows="7" cols="60" /><?php echo get_option('wm4d_script'); ?></textarea>
            <br />Enter your custom script in javascript or jquery.
            <br />No need to add &lt;script&gt; tags.
            <br />&nbsp;
            </div>
			
			<div class="wm4d_section">
            <h3>Custom HTML in Header</h3>
            <textarea type="text" name="wm4d_html" rows="7" cols="60" /><?php echo get_option('wm4d_html'); ?></textarea>
            <br />Enter your custom scripts in javascript, jquery or css.
            <br />Accepts HTML script and style tags.
            <br />Located inside the &lt;header&gt;.
            </div>
            
			<div class="wm4d_section">
			<h3>Custom HTML in Footer</h3>
            <textarea type="text" name="wm4d_footer" rows="7" cols="60" /><?php echo get_option('wm4d_footer'); ?></textarea>
            <br />Enter your custom scripts in javascript, jquery or css.
            <br />Accepts HTML script and style tags.
            <br />Located before &lt;\body&gt;.
            </div>
    		<?php submit_button(); ?>
		</div>
    </form>
    </div>
<?php
}
?>