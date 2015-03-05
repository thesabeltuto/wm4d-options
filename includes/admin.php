<?php /************ WM4D OPTIONS ******************/

// create custom plugin settings menu
add_action('admin_menu', 'WM4D_OPTIONS_PLUGIN_theme_create_menu');

function WM4D_OPTIONS_PLUGIN_theme_create_menu() {

	//create new top-level menu
	add_menu_page('WM4D Options', 'WM4D Options', 'administrator', 'wm4d_options', 'WM4D_OPTIONS_PLUGIN_theme_options_page', '', 90 );

	//create new submenus
	add_submenu_page( 'wm4d_options', 'Client Options', 'Client Options', 'manage_options', 'wm4d_options_client_options', 'WM4D_OPTIONS_PLUGIN_submenu_client_options' );
	add_submenu_page( 'wm4d_options', 'Custom Codes', 'Custom Codes', 'manage_options', 'wm4d_options_custom_codes', 'WM4D_OPTIONS_PLUGIN_submenu_custom_codes' );
	add_submenu_page( 'wm4d_options', 'Page Texts', 'Page Texts', 'manage_options', 'wm4d_options_page_texts', 'WM4D_OPTIONS_PLUGIN_submenu_page_texts' );
	add_submenu_page( 'wm4d_options', 'Support', 'Support', 'manage_options', 'wm4d_options_support', 'WM4D_OPTIONS_PLUGIN_submenu_support' );
	add_submenu_page( 'wm4d_options', 'About', 'About', 'manage_options', 'wm4d_options_about', 'WM4D_OPTIONS_PLUGIN_submenu_about' );
	
	//call register settings function
	add_action('admin_init', 'WM4D_OPTIONS_PLUGIN_register_theme_options' );
	add_action('admin_init', 'WM4D_OPTIONS_PLUGIN_register_client_options' );
}

function WM4D_OPTIONS_PLUGIN_register_theme_options() {
	//register our settings
	register_setting( 'wm4d-options-group', 'wm4d_options_css' );
	register_setting( 'wm4d-options-group', 'wm4d_options_script' );
	register_setting( 'wm4d-options-group', 'wm4d_options_html' );
	register_setting( 'wm4d-options-group', 'wm4d_options_testimonials' );
	register_setting( 'wm4d-options-group', 'wm4d_options_before_afters' );
	register_setting( 'wm4d-options-group', 'wm4d_options_office_images' );
	register_setting( 'wm4d-options-group', 'wm4d_options_footer' );
}

function WM4D_OPTIONS_PLUGIN_register_client_options() {
	//register our settings
	register_setting( 'wm4d-client-group', 'wm4d_client' );
	register_setting( 'wm4d-client-group', 'wm4d_doctor' );
	register_setting( 'wm4d-client-group', 'wm4d_phone' );
	register_setting( 'wm4d-client-group', 'wm4d_location' );
	register_setting( 'wm4d-client-group', 'wm4d_doctors' );
	register_setting( 'wm4d-client-group', 'wm4d_phones' );
	register_setting( 'wm4d-client-group', 'wm4d_locations' );
	register_setting( 'wm4d-client-group', 'wm4d_practice' );
}

function WM4D_OPTIONS_PLUGIN_theme_options_page() {
	 if ( get_option('wm4d_options_css') == null || get_option('wm4d_options_css') == ''  ) $cssvalue='currently <span class="empty">empty</span>'; else $cssvalue='<span class="filled">filled</span>';
	 if ( get_option('wm4d_options_script') == null || get_option('wm4d_options_script') == ''  ) $scriptvalue='currently <span class="empty">empty</span>'; else $scriptvalue='<span class="filled">filled</span>';
	 if ( get_option('wm4d_options_html') == null || get_option('wm4d_options_html') == ''  ) $htmlvalue='currently <span class="empty">empty</span>'; else $htmlvalue='<span class="filled">filled</span>';
	 if ( get_option('wm4d_options_testimonials') == null || get_option('wm4d_options_testimonials') == ''  ) $tesvalue='currently <span class="empty">empty</span>'; else $tesvalue='<span class="filled">filled</span>';
	 if ( get_option('wm4d_options_before_afters') == null || get_option('wm4d_options_before_afters') == ''  ) $bnavalue='currently <span class="empty">empty</span>'; else $bnavalue='<span class="filled">filled</span>';
	 if ( get_option('wm4d_options_office_images') == null || get_option('wm4d_options_office_images') == ''  ) $offvalue='currently <span class="empty">empty</span>'; else $offvalue='<span class="filled">filled</span>';
	 if ( get_option('wm4d_options_footer') == null || get_option('wm4d_options_footer') == ''  ) $footvalue='currently <span class="empty">empty</span>'; else $footvalue='<span class="filled">filled</span>';
	 if ( get_option('wm4d_client') == null || get_option('wm4d_client') == ''  ) $wm4d_client='currently <span class="empty">empty</span>'; else $wm4d_client=get_option('wm4d_client');
	 if ( get_option('wm4d_doctor') == null || get_option('wm4d_doctor') == ''  ) $wm4d_doctor='currently <span class="empty">empty</span>'; else $wm4d_doctor=get_option('wm4d_doctor');
	 if ( get_option('wm4d_phone') == null || get_option('wm4d_phone') == ''  ) $wm4d_phone='currently <span class="empty">empty</span>'; else $wm4d_phone=get_option('wm4d_phone');
	 if ( get_option('wm4d_location') == null || get_option('wm4d_locations') == ''  ) $wm4d_location='currently <span class="empty">empty</span>'; else $wm4d_location=get_option('wm4d_location');
	 if ( get_option('wm4d_doctors') == null || get_option('wm4d_doctors') == ''  ) $wm4d_doctors='is currently <span class="empty">empty</span>'; else $wm4d_doctors="are:";
	 if ( get_option('wm4d_phones') == null || get_option('wm4d_phones') == ''  ) $wm4d_phones='is currently <span class="empty">empty</span>'; else $wm4d_phones="are:";
	 if ( get_option('wm4d_locations') == null || get_option('wm4d_locations') == ''  ) $wm4d_locations='is currently <span class="empty">empty</span>'; else $wm4d_locations="are:";
	 if ( get_option('wm4d_practice') == null || get_option('wm4d_practice') == ''  ) $wm4d_practice='currently <span class="empty">empty</span>'; else $wm4d_practice=get_option('wm4d_practice');
	?>
	<div class="wm4d_wrap">
	<h1>WM4D Options</h1>
	

    <div id="wm4d_nav">
        <ul>
            <li id="wm4d_li0" class="active"><a href="?page=wm4d_options">Home</a></li>
            <li id="wm4d_li5"><a href="?page=wm4d_options_client_options">Client Options</a></li>
            <li id="wm4d_li1"><a href="?page=wm4d_options_custom_codes">Custom Codes</a></li>
            <li id="wm4d_li2"><a href="?page=wm4d_options_page_texts">Page Texts</a></li>
            <li id="wm4d_li3"><a href="?page=wm4d_options_support">Support</a></li>
            <li id="wm4d_li4"><a href="?page=wm4d_options_about">About</a></li>
       </ul>
    </div>
       
		<div class="wm4d_content" id="wm4d_li-0">
			<h2>Welcome to the WM4D Options plugin.</h2>
            <br />
            <div class="wm4d_section home links">
            <h3>Please select the following to proceed:</h3>

                <ol>
                    <li><a href="?page=wm4d_options">Home</a></li>
                    <li><a href="?page=wm4d_options_client_options">Client Options</a></li>
                    <li><a href="?page=wm4d_options_custom_codes">Custom Codes</a></li>
                    <li><a href="?page=wm4d_options_page_texts">Page Texts</a></li>
                    <li><a href="?page=wm4d_options_support">Support</a></li>
                    <li><a href="?page=wm4d_options_about">About</a></li>
               </ol>
            </div>

            <div class="wm4d_section home client-options">
            <h3>Client Options</h3>

               <ol>
                    <li>Client's Name is <?=$wm4d_client; ?>.</li>
                    <li>Practice Name is <?=$wm4d_practice; ?>.</li>
                    <li>Doctor's Name is <?=$wm4d_doctor; ?>.</li>
                    <li>Phone Number is <?=$wm4d_phone; ?>.</li>
                    <li>Office Location is <?=$wm4d_location; ?>.</li>
                    <li>Doctors' Names <?=$wm4d_doctors;
						$doctors = get_option('wm4d_doctors');
					   if($doctors) {
						   echo '<ol>';
						   $doctors = explode('*', $doctors);
						   for($i = 0; $i < sizeof($doctors);$i++) {
							   echo '<li>'.$doctors[$i].'</li>';
						   }
						   echo '</ol>';
					   }
                       ?>
                    </li>
                    <li>Phone Numbers by Location <?=$wm4d_phones; 
						$phones = get_option('wm4d_phones');
					   if($phones) {
						   echo '<ol>';
						   $phones = explode('*', $phones);
						   for($i = 0; $i < sizeof($phones);$i++) {
							   echo '<li>'.$phones[$i].'</li>';
						   }
						   echo '</ol>';
					   }
					?>
                    </li>
                    <li>Office Locations <?=$wm4d_locations; 
						$locations = get_option('wm4d_locations');
					   if($locations) {
						   echo '<ol>';
						   $locations = explode('*', $locations);
						   for($i = 0; $i < sizeof($locations);$i++) {
							   echo '<li>'.$locations[$i].'</li>';
						   }
						   echo '</ol>';
					   }
					?>
                    </li>
               </ol>


               
            </div>            
            
            <div class="wm4d_section home">
            <h3>Custom Codes</h3>

                <ol>
                    <li>Custom CSS is <?=$cssvalue; ?>.</li>
                    <li>Custom Script is <?=$scriptvalue; ?>.</li>
                    <li>Custom HTML in Header is <?=$htmlvalue; ?>.</li>
                    <li>Custom HTML in Footer is <?=$footvalue; ?>.</li>
               </ol>
            </div>            
 
            <div class="wm4d_section home">
            <h3>Page Texts</h3>

                <ol>
                    <li>Before and Afters Page Text is <?=$bnavalue; ?>.</li>
                    <li>Testimonials Page Text is <?=$tesvalue; ?>.</li>
                    <li>Office Images Page Text is <?=$offvalue; ?>.</li>
               </ol>
            </div>            
 
            <div class="wm4d_section home">
            <h3>Support</h3>
				All detailed information you need is in the support section. Click <a href="?page=wm4d_options_support">here</a> to navigate to support section now.
            </div>            
 
            <div class="wm4d_section home">
            <h3>About</h3>
				All detailed information about the plugin and the author is in the about section. Click <a href="?page=wm4d_options_about">here</a> to navigate to about section now. Click <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=H228JQZP6269J&lc=PH&item_name=TT%2dPlugins&item_number=tt%2dplugins¤cy_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted" target="_blank">here</a> to donate to the author now.
            </div>            
         
		</div>
            
	</div>
<?php }

function WM4D_OPTIONS_PLUGIN_submenu_custom_codes() {
?>
	<div class="wm4d_wrap">
	<h1>WM4D Options</h1>
	

    <div id="wm4d_nav">
        <ul>
            <li id="wm4d_li0"><a href="?page=wm4d_options">Home</a></li>
            <li id="wm4d_li5"><a href="?page=wm4d_options_client_options">Client Options</a></li>
            <li id="wm4d_li1" class="active"><a href="?page=wm4d_options_custom_codes">Custom Codes</a></li>
            <li id="wm4d_li2"><a href="?page=wm4d_options_page_texts">Page Texts</a></li>
            <li id="wm4d_li3"><a href="?page=wm4d_options_support">Support</a></li>
            <li id="wm4d_li4"><a href="?page=wm4d_options_about">About</a></li>
       </ul>
    </div>


	<form method="post" action="options.php">
		<?php settings_fields( 'wm4d-options-group' );
				do_settings_sections( 'wm4d-options-group' ); ?>
        
        <div class="wm4d_content" id="wm4d_li-1">
			<h2>Custom Codes</h2>
	
    		<?php submit_button(); ?>

			<div class="wm4d_section">
            <h3>Custom Style</h3>
            <textarea type="text" name="wm4d_options_css" rows="7" cols="60" /><?php echo get_option('wm4d_options_css'); ?></textarea>
            <br />Enter your custom style in css.
            <br />No need to add &lt;style&gt; tags.
            <br />&nbsp;
            </div>
            
			<div class="wm4d_section">
			<h3>Custom Script</h3>
            <textarea type="text" name="wm4d_options_script" rows="7" cols="60" /><?php echo get_option('wm4d_options_script'); ?></textarea>
            <br />Enter your custom script in javascript or jquery.
            <br />No need to add &lt;script&gt; tags.
            <br />&nbsp;
            </div>
			
			<div class="wm4d_section">
            <h3>Custom HTML in Header</h3>
            <textarea type="text" name="wm4d_options_html" rows="7" cols="60" /><?php echo get_option('wm4d_options_html'); ?></textarea>
            <br />Enter your custom scripts in javascript, jquery or css.
            <br />Accepts HTML script and style tags.
            <br />Located inside the &lt;header&gt;.
            </div>
            
			<div class="wm4d_section">
			<h3>Custom HTML in Footer</h3>
            <textarea type="text" name="wm4d_options_footer" rows="7" cols="60" /><?php echo get_option('wm4d_options_footer'); ?></textarea>
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

function WM4D_OPTIONS_PLUGIN_submenu_page_texts() {
?>
	<div class="wm4d_wrap">
	<h1>WM4D Options</h1>
	

    <div id="wm4d_nav">
        <ul>
            <li id="wm4d_li0"><a href="?page=wm4d_options">Home</a></li>
            <li id="wm4d_li5"><a href="?page=wm4d_options_client_options">Client Options</a></li>
            <li id="wm4d_li1"><a href="?page=wm4d_options_custom_codes">Custom Codes</a></li>
            <li id="wm4d_li2" class="active"><a href="?page=wm4d_options_page_texts">Page Texts</a></li>
            <li id="wm4d_li3"><a href="?page=wm4d_options_support">Support</a></li>
            <li id="wm4d_li4"><a href="?page=wm4d_options_about">About</a></li>
       </ul>
    </div>


	<form method="post" action="options.php">
		<?php settings_fields( 'wm4d-options-group' );
				do_settings_sections( 'wm4d-options-group' ); ?>

		<div class="wm4d_content" id="wm4d_li-2">
			<h2>Page Texts</h2>

    		<?php submit_button(); ?>

			<div class="wm4d_section">
			<h3>Before and Afters Page Text</h3>
            <textarea type="text" name="wm4d_options_before_afters" rows="7" cols="60" /><?php echo get_option('wm4d_options_before_afters'); ?></textarea>
            <br />Enter your desired text for Before and Afters archive page.
            </div>

			<div class="wm4d_section">
			<h3>Testimonials Page Text</h3>
            <textarea type="text" name="wm4d_options_testimonials" rows="7" cols="60" /><?php echo get_option('wm4d_options_testimonials'); ?></textarea>
            <br />Enter your desired text for Testimonials archive page.
            </div>

			<div class="wm4d_section">
			<h3>Office Images Page Text</h3>
            <textarea type="text" name="wm4d_options_office_images" rows="7" cols="60" /><?php echo get_option('wm4d_options_office_images'); ?></textarea>
            <br />Enter your desired text for Office Images archive page.
            </div>

    		<?php submit_button(); ?>

		</div>

	</form>
    </div>

<?php
}

function WM4D_OPTIONS_PLUGIN_submenu_support() {
?>
	<div class="wm4d_wrap">
	<h1>WM4D Options</h1>
	

    <div id="wm4d_nav">
        <ul>
            <li id="wm4d_li0"><a href="?page=wm4d_options">Home</a></li>
            <li id="wm4d_li5"><a href="?page=wm4d_options_client_options">Client Options</a></li>
            <li id="wm4d_li1"><a href="?page=wm4d_options_custom_codes">Custom Codes</a></li>
            <li id="wm4d_li2"><a href="?page=wm4d_options_page_texts">Page Texts</a></li>
            <li id="wm4d_li3" class="active"><a href="?page=wm4d_options_support">Support</a></li>
            <li id="wm4d_li4"><a href="?page=wm4d_options_about">About</a></li>
       </ul>
    </div>


		<div class="wm4d_content" id="wm4d_li-3">
			<h2>Support</h2>
            
			<h3>Client Options</h3>
            <div class="wm4d_section wm4d_support">
            	<p>Custom Codes was created for you to be able to customize and personalize your website. This section saves your client's information to the database.</p>
            	<p><strong>Client's Name</strong> is for the identification of who owns the website. HTML tags are accepted here but not advisable. Shortcode is `[client_name]`.</p>
                <p><strong>Practice Name</strong> is a copy of the website title. HTML tags are accepted here but not advisable. Shortcode is `[practice_name]`.</p>
                <p><strong>Doctor's Name</strong> is where you enter the star Doctor's name. HTML tags are accepted here but not advisable. Shortcode is `[doctor_name]`.</p>
                <p><strong>Phone Number</strong> is where you enter the main phone number of the office. HTML tags are accepted and advisable here. Shortcode is `[phone_number]`.</p>
                <p><strong>Office Location</strong> is where you enter the location of the office. HTML tags are accepted and advisable here. Shortcode is `[location]`.</p>
                <p><strong>Doctors' Names</strong> is where you enter multiple Doctors' names. You may not include the primary Doctor's name if you already entered one from the primary section. Please do separate each Doctors' names with a separator `*`. HTML tags are accepted and advisable here. Shortcode is `[doctor_names]` to show all doctors names and `[doctor_names id="#"]` enter a number in `#` to show specific doctor. Doctor's IDs are shown in the WM4D-Options > Home > Client Options section, click <a href="?wm4d_options">here</a> to navigate now.</p>
                <p><strong>Phone Numbers by Location</strong> is where you enter multiple phone numbers with corresponding locations. You may not include the primary phone number of the office if you already entered one from the primary section. Please do format each entry by `Location : Phone Number` or vice versa. Please do separate each phone numbers with corresponding location with a separator `*`. HTML tags are accepted and advisable here. Shortcode is `[phone_numbers]` to show all phone numbers and `[phone_numbers id="#"]` enter a number in `#` to show specific phone numbers. Phone Number's IDs are shown in the WM4D-Options > Home > Client Options section, click <a href="?wm4d_options">here</a> to navigate now.</p>
                <p><strong>Office Locations</strong> is where you enter multiple office locations. You may not include the primary office location if you already entered one from the primary section. Please do separate each locations with a separator `*`. HTML tags are accepted and advisable here. Shortcode is `[locations]` to show all doctors names and `[locations id="#"]` enter a number in `#` to show specific location. Location's IDs are shown in the WM4D-Options > Home > Client Options section, click <a href="?wm4d_options">here</a> to navigate now.</p>
           </div>

			<h3>Custom Codes</h3>
            <div class="wm4d_section wm4d_support">
            	<p>Custom Codes was created for you to be able to customize your website without having to edit the theme files and worry about the theme updates. This section saves your Styles and Scripts to the database. You can easily update your themes and keep your customizations.</p>
            	<p><strong>Custom Style</strong> is where you enter your custom style in css. No need to add &lt;style&gt; tags. This plugin automatically adds these codes to the header of your website. However should you wish to add the custom option to your theme, you may add it using `wm4d_options_css`.</p>
                <p><strong>Custom Script</strong> is where you enter your custom script in javascript or jquery. No need to add &lt;script&gt; tags. This plugin automatically adds these codes to the header of your website. However should you wish to add the custom option to your theme, you may add it using `wm4d_options_script`.</p>
                <p><strong>Custom HTML in Header</strong> is where you add generated scripts like google scripts, etc. to be added inside the &lt;head&gt; of your website. This area accepts HTML script and style tags. However should you wish to add the custom option to your theme, you may add it using `wm4d_options_html`.</p>
                <p><strong>Custom HTML in Footer</strong> is where you add generated scripts like google scripts, etc. to be added inside just before the &lt;\body&gt; of your website. This area accepts HTML script and style tags. However should you wish to add the custom option to your theme, you may add it using `wm4d_options_footer`.</p>
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
            	<p><strong>Procedures</strong> is where you add Procedures or Services contents. Contents posted in this section will be displayed as a regular post page.</p>
            	<p><strong>Offers</strong> is where you add offer contents. This custom post type is based on the original wm4d plugin. This is where you link your procedures to specific Offers. Contents posted in this section will be displayed as a regular post page. However in this plugin, we use the Special Offer widget to display on your website. Proceedure category tag is `procedure_tags`.</p>
            	<p><strong>Testimonials</strong> is where you add Testimonial contents. Contents posted in this section will be displayed as a regular post page. A widget is available for this post type for you to display a slider section to your website. Testimonial category tag is `testimonial_categories`.</p>
            	<p><strong>Before and Afters</strong> is where you add Before and After contents. Contents posted in this section will be displayed as a regular post page. A widget is available for this post type for you to display a slider section to your website.</p>
            	<p><strong>Office Images</strong> is where you add Office contents. Contents posted in this section will be displayed as a regular post page. A widget is available for this post type for you to display a slider section to your website.</p>
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
        </div>

<?php
}

function WM4D_OPTIONS_PLUGIN_submenu_about() {
?>
	<div class="wm4d_wrap">
	<h1>WM4D Options</h1>
	

    <div id="wm4d_nav">
        <ul>
            <li id="wm4d_li0"><a href="?page=wm4d_options">Home</a></li>
            <li id="wm4d_li5"><a href="?page=wm4d_options_client_options">Client Options</a></li>
            <li id="wm4d_li1"><a href="?page=wm4d_options_custom_codes">Custom Codes</a></li>
            <li id="wm4d_li2"><a href="?page=wm4d_options_page_texts">Page Texts</a></li>
            <li id="wm4d_li3"><a href="?page=wm4d_options_support">Support</a></li>
            <li id="wm4d_li4" class="active"><a href="?page=wm4d_options_about">About</a></li>
       </ul>
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

	</div>

<?php
}

function WM4D_OPTIONS_PLUGIN_submenu_client_options() {
?>
	<div class="wm4d_wrap">
	<h1>WM4D Options</h1>
	

    <div id="wm4d_nav">
        <ul>
            <li id="wm4d_li0"><a href="?page=wm4d_options">Home</a></li>
            <li id="wm4d_li5" class="active"><a href="?page=wm4d_options_client_options">Client Options</a></li>
            <li id="wm4d_li1"><a href="?page=wm4d_options_custom_codes">Custom Codes</a></li>
            <li id="wm4d_li2"><a href="?page=wm4d_options_page_texts">Page Texts</a></li>
            <li id="wm4d_li3"><a href="?page=wm4d_options_support">Support</a></li>
            <li id="wm4d_li4"><a href="?page=wm4d_options_about">About</a></li>
       </ul>
    </div>
        <form method="post" action="options.php">
            <?php settings_fields( 'wm4d-client-group' );
                    do_settings_sections( 'wm4d-client-group' ); ?>
        
    		<div class="wm4d_content" id="wm4d_li-5">
			<h2>Client Options</h2>

    		<?php submit_button(); ?>
				
                <h2>General Options</h2>
                <hr />

                <div class="wm4d_section">
                <h3>Client's Name</h3>
                <input name="wm4d_client" type="text" size="60" value="<?php echo get_option('wm4d_client'); ?>" />
                <br />Enter Client's Name here.
                </div>
                
                <div class="wm4d_section">
                <h3>Practice Name</h3>
                <input name="wm4d_practice" type="text" size="60" value="<?php echo get_option('wm4d_practice'); ?>" />
                <br />Enter Practice Name here.
                </div>
                
                <h2>Primary Options</h2>
                <hr />

                <div class="wm4d_section">
                <h3>Doctor's Name</h3>
                <input name="wm4d_doctor" type="text" size="60" value="<?php echo get_option('wm4d_doctor'); ?>" />
                <br />Enter the Star Doctor's Name here.
                </div>

                <div class="wm4d_section">
                <h3>Phone Number</h3>
                <input name="wm4d_phone" type="text" size="60" value="<?php echo get_option('wm4d_phone'); ?>" />
                <br />Enter the main Phone Number of the Office.
                </div>

                <div class="wm4d_section">
                <h3>Office Location</h3>
                <input name="wm4d_location" type="text" size="60" value="<?php echo get_option('wm4d_location'); ?>" />
                <br />Enter the main Location of the Office.
                </div>
 				
                <h2>Multiple Options</h2>
                <hr />
 			
                <div class="wm4d_section">
                <h3>Doctors' Names</h3>
                <textarea type="text" name="wm4d_doctors" rows="7" cols="60" /><?php echo get_option('wm4d_doctors'); ?></textarea>
                <br />Enter other Doctors' Names here.
                <br />Do not include the main doctor's name.
                <br />Separate each entry by *.
                </div>

                <div class="wm4d_section">
                <h3>Phone Numbers by Location</h3>
                <textarea type="text" name="wm4d_phones" rows="7" cols="60" /><?php echo get_option('wm4d_phones'); ?></textarea>
                <br />Enter other Phone Numbers with corresponding Locations here.
                <br />Do not include the main phone number.
                <br />Format "Location : Phone Number" or vice versa. Separate each entry by *.
                </div>
                
                <div class="wm4d_section">
                <h3>Office Locations</h3>
                <textarea type="text" name="wm4d_locations" rows="7" cols="60" /><?php echo get_option('wm4d_locations'); ?></textarea>
                <br />Enter other Locations of the Office here.
                <br />Do not include the main office location.
                <br />Separate each entry by *.
                </div>

               
				<?php submit_button(); ?>


            </div>
            
        </form>

	</div>
            
<?php

}
?>

