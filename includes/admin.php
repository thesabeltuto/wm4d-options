<?php /************ WM4D OPTIONS ******************/

// create custom plugin settings menu
add_action('admin_menu', 'WM4D_OPTIONS_PLUGIN_theme_create_menu');

function WM4D_OPTIONS_PLUGIN_theme_create_menu() {

	//create new top-level menu
	add_menu_page('WM4D Options', 'WM4D Options', 'administrator', __FILE__, 'WM4D_OPTIONS_PLUGIN_theme_options_page','' );

	//call register settings function
	add_action('admin_init', 'WM4D_OPTIONS_PLUGIN_register_theme_options' );
}

function WM4D_OPTIONS_PLUGIN_register_theme_options() {
	//register our settings
	register_setting( 'wm4d-options-group', 'wm4d_options_css' );
	register_setting( 'wm4d-options-group', 'wm4d_options_script' );
	register_setting( 'wm4d-options-group', 'wm4d_options_testimonials' );
	register_setting( 'wm4d-options-group', 'wm4d_options_before_afters' );
	register_setting( 'wm4d-options-group', 'wm4d_options_office_images' );
}

function WM4D_OPTIONS_PLUGIN_theme_options_page() {

	?>
	<div class="wm4d_wrap">
	<h1>WM4D Options</h1>
	

    <div id="wm4d_nav">
        <ul>
            <li id="wm4d_li1"><a href="#">Custom Codes</a></li>
            <li id="wm4d_li2"><a href="#">Page Texts</a></li>
            <li id="wm4d_li3"><a href="#">Support</a></li>
            <li id="wm4d_li4"><a href="#">About</a></li>
            <li id="donate"><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=H228JQZP6269J&lc=PH&item_name=TT%2dPlugins&item_number=tt%2dplugins¤cy_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted" target="_blank">Donate</a></li>
       </ul>
    </div>


	<form method="post" action="options.php">
		<?php settings_fields( 'wm4d-options-group' );
				do_settings_sections( 'wm4d-options-group' ); ?>
        
        <div class="wm4d_content" id="wm4d_li-1">
			<h2>Custom Codes</h2>
	
    		<?php submit_button(); ?>

			<h3>Custom Style</h3>
			<div class="wm4d_section"><textarea type="text" name="wm4d_options_css" rows="7" cols="60" /><?php echo get_option('wm4d_options_css'); ?></textarea>
            <br />Enter your custom style in css. No need to add &lt;style&gt; tags.
            </div>
			<h3>Custom Script</h3>
			<div class="wm4d_section"><textarea type="text" name="wm4d_options_script" rows="7" cols="60" /><?php echo get_option('wm4d_options_script'); ?></textarea>
            <br />Enter your custom script in javascript or jquery. No need to add &lt;script&gt; tags.
            </div>

    		<?php submit_button(); ?>

		</div>
        
		<div class="wm4d_content" id="wm4d_li-2">
			<h2>Page Texts</h2>

    		<?php submit_button(); ?>

			<h3>Before and Afters Page Text</h3>
			<div class="wm4d_section"><textarea type="text" name="wm4d_options_before_afters" rows="7" cols="60" /><?php echo get_option('wm4d_options_before_afters'); ?></textarea>
            <br />Enter your desired text for Before and Afters archive page.
            </div>

			<h3>Testimonials Page Text</h3>
			<div class="wm4d_section"><textarea type="text" name="wm4d_options_testimonials" rows="7" cols="60" /><?php echo get_option('wm4d_options_testimonials'); ?></textarea>
            <br />Enter your desired text for Testimonials archive page.
            </div>

			<h3>Office Images Page Text</h3>
			<div class="wm4d_section"><textarea type="text" name="wm4d_options_office_images" rows="7" cols="60" /><?php echo get_option('wm4d_options_office_images'); ?></textarea>
            <br />Enter your desired text for Office Images archive page.
            </div>

    		<?php submit_button(); ?>

		</div>
        
        
		<div class="wm4d_content" id="wm4d_li-3">
			<h2>Support</h2>
			<h3>Custom Codes</h3>
            <div class="wm4d_section wm4d_support">
            	<p>Custom Codes was created for you to be able to customize your website without having to edit the theme files and worry about the theme updates. This section saves your Styles and Scripts to the database. You can easily update your themes and keep your customizations.</p>
            	<p><strong>Custom Style</strong> is where you enter your custom style in css. No need to add &lt;style&gt; tags. This plugin automatically adds these codes to the header of your website. However should you wish to add the custom option to your theme, you may add it using `wm4d_options_css`.</p>
                <p><strong>Custom Script</strong> is where you enter your custom script in javascript or jquery. No need to add &lt;script&gt; tags. This plugin automatically adds these codes to the header of your website. However should you wish to add the custom option to your theme, you may add it using `wm4d_options_script`.</p>
                <p><strong>Custom HTML</strong> is currently NOT supported. This is where you supposedly add generated scripts like google scripts, etc. to be added inside the &lt;head&gt; of your website. Should you wish to add this feature for this plugin, please donate and contact the author.</p>
            </div>

			<h3>Page Texts</h3>
            <div class="wm4d_section wm4d_support">
            	<p>Page Texts is for a full customization of your archives page where you put descriptions to the Before and Afters, Testimonials and Office Images pages.</p>
            	<p><strong>Before and Afters Page Text</strong> is where you enter your desired text for Before and Afters archive page. If you wish to add this feature to your template, the custom option is `wm4d_options_before_afters`.</p>
            	<p><strong>Testimonials Page Text</strong> is where you enter your desired text for Testimonials archive page. If you wish to add this feature to your template, the custom option is `wm4d_options_testimonials`.</p>
            	<p><strong>Office Images Page Text</strong> is where you enter your desired text for Office Images archive page. If you wish to add this feature to your template, the custom option is `wm4d_options_office_images`.</p>
            </div>


			<h3>Custom Post Types</h3>
            <div class="wm4d_section wm4d_support">
            	<p>Custom Post Types are created for ease of navigation and categorization of contents for your website.</p>
            	<p><strong>Procedures</strong> is where you add Procedures or Services contents. Contents posted in this wm4d_section will be displayed as a regular post page.</p>
            	<p><strong>Offers</strong> is where you add offer contents. This custom post type is based on the original wm4d plugin. This is where you link your procedures to specific Offers. Contents posted in this wm4d_section will be displayed as a regular post page. However in this plugin, we use the Special Offer widget to display on your website.</p>
            	<p><strong>Testimonials</strong> is where you add Testimonial contents. Contents posted in this wm4d_section will be displayed as a regular post page. A widget is available for this post type for you to display a slider wm4d_section to your website.</p>
            	<p><strong>Office Images</strong> is where you add Office contents. Contents posted in this wm4d_section will be displayed as a regular post page. A widget is available for this post type for you to display a slider wm4d_section to your website.</p>
            </div>


			<h3>Widgets</h3>
            <div class="wm4d_section wm4d_support">
             	<p>Wigets are created to feature your Special Offers, Before and Afters, Office Images, and Testimonials in your website.</p>
           	<p><strong>Special Offer</strong> is widget where you can display your offers, NOT linked to any custom post type Offers above. Displaying different Special Offer to different Procedures or pages, you will need the <a href="https://wordpress.org/plugins/widget-context/" target="_blank">Widget Context</a> plugin.</p>
             	<p><strong>Before and Afters</strong> is a widget slider that will cycle all content posted in the custom post type Before and Afters. It will display the featured image of the content.</p>
            	<p><strong>Testimonials</strong> is a widget slider that will cycle all content posted in the custom post type Testimonials. It will display images, texts, embeds, iframes, etc.</p>
            	<p><strong>Office Images</strong> is a widget slider that will cycle all content posted in the custom post type Office Images. It will display the featured image of the content.</p>
           </div>

		</div>
        
		<div class="wm4d_content" id="wm4d_li-4">
			<h2>About</h2>
			<h3>Description</h3>
            <div class="wm4d_section about">
            	<p>This plugin is a simplified <a href="http://www.wm4d.com/" target="_blank">WM4D</a> plugin that includes custom post types and widgets of  before and afters, prodecures, offers, office images and testimonials. This plugin also includes theme options that can help you edit styles and scripts on dashboard.</p>
            </div>
            
            <h3>Author</h3>
            <div class="wm4d_section about">
            	<p>Created by <a href="http://thesabeltuto.blogspot.com" target="_blank">Thesabel Tuto</a>. For questions, suggestions and bug reports please contact the author.</p>
            </div>
            
            <h3>Plugin Site</h3>
            <div class="wm4d_section about">
            	<p>Plugin site at <a href="http://ttplugins.wordpress.com/" target="_blank">TT Plugins</a>. Check out other plugins created by the author.</p>
            </div>
            
            <h3>Donate</h3>
            <div class="wm4d_section about">
            	<p>Donations are accepted via Paypal Donate to <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=H228JQZP6269J&lc=PH&item_name=TT%2dPlugins&item_number=tt%2dplugins¤cy_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted" target="_blank">TT Plugins</a>. Please donate to support the author in improving this plugin and in creating more useful and helpful plugins. Thank you for supporting!</p>
            </div>
            
		</div>
        
	</form>
    
        <div class="wm4d_footer">Plugin created by <a href="http://thesabeltuto.blogspot.com" target="_blank">Thesabel Tuto</a> | Plugin site at <a href="http://ttplugins.wordpress.com/" target="_blank">TT Plugins</a> | <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=H228JQZP6269J&lc=PH&item_name=TT%2dPlugins&item_number=tt%2dplugins¤cy_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted" target="_blank">DONATE!</a></div>
	</div>
<?php } ?>