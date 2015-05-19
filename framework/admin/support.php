<?php /* Admin Support Page */

function WM4D_OPTIONS_PLUGIN_submenu_support() {
?>
	<div class="wm4d_wrap">
	<h1>WM4D Options</h1>
	

    <div id="wm4d_nav">
        <ul>
			<?php WM4D_OPTIONS_PLUGIN_navigation(); ?>
       </ul>
    </div>


		<div class="wm4d_content" id="wm4d_li-3">
			<h2>Support</h2>
            
            <h3>Client Options</h3>
            <div class="wm4d_section wm4d_support">
                <p>Custom Codes was created for you to be able to customize and personalize your website. This section saves your client's information to the database.</p>
                <p><strong>Client's Name</strong> is for the identification of who owns the website. HTML tags are not advisable. Shortcode is `[client_name]`.</p>
                <p><strong>Practice Name</strong> is a copy of the website title. HTML tags are not advisable. Shortcode is `[practice_name]`.</p>
                <p><strong>Enable / Disable Multiple Information</strong> is where you enable or disable multiple doctors, phone numbers and/or locations.</p>
                <p><strong>Enable / Disable International Phone Format</strong> is where you enable or disable the international phone format which is +99 (999) 999-9999. Standard phone format is (999) 999-9999.</p>
				<?php //PRIMARY SELETED ?>
                <?php if( get_option('wm4d_multiple_select') != 'enable') { ?>
                <p><strong>Doctor's Name</strong> is where you enter the star Doctor's name only. HTML tags are not advisable. Shortcode is `[doctor_name]`.</p>
                <p><strong>Doctor's Titles</strong> is where you enter the star Doctor's corresponding titles only. HTML tags are not advisable. Shortcode for the doctor's name with title is `[doctor_name title="true"]`.</p>
                <p><strong>Phone Number</strong> is where you enter the main phone number of the office. HTML tags are not advisable. Shortcode is `[phone_number]`.</p>
                <p><strong>Office Location</strong> is where you enter the location of the office. You may enter up to 4 address lines here. HTML tags are not advisable. Shortcode is `[location short="true"]`.</p>
                <p><strong>Short Location</strong> is where you enter the short version of the office. HTML tags are not advisable. Shortcode is `[location]`.</p>
				<?php } ?>
				<?php //MULTIPLE SELETED ?>
                <?php if( get_option('wm4d_multiple_select') == 'enable') { ?>
                <p><strong>Doctors' Names</strong> is where you enter multiple Doctors' names only. HTML tags are not advisable.
                Shortcodes are `[doctor_names]` to show all doctors' names and `[doctor_names id="#"]` enter a number in `#` to show specific doctor.
                <p><strong>Doctors' Titles</strong> is where you enter multiple Doctors' corresponding titles only. HTML tags are not advisable.
                Shortcodes are `[doctor_names title="true"]` to show all doctors' names with titles and `[doctor_names id="#" title="true"]` enter a number in `#` to show specific doctor's name with titles.
                <p><strong>Phone Numbers by Location</strong> is where you enter multiple phone numbers with corresponding locations.
                Please do assign each phone numbers with corresponding short name of office location. HTML tags are not advisable.
                Shortcodes are `[phone_numbers]` to show all phone numbers and `[phone_numbers id="#"]` enter a number in `#` to show specific phone numbers by location.
                `[phone_numbers id="#" only="phone"]`, to show only phone number.`[phone_numbers id="#" only="location"]`, to show only location.
                <p><strong>Office Locations</strong> is where you enter multiple office locations.
                You may enter up to 4 address lines here. HTML tags are not advisable.
                Shortcodes are `[locations]` to show all office locations and `[locations id="#"]` enter a number in `#` to show specific location.
				<?php } ?>
            </div>

            <h3>Flipper Options</h3>
            <div class="wm4d_section wm4d_support">
                <p>Flipper Options was created for you to be able to flip phone numbers according to referer site the visitor came from.</p>
                <p><strong>Enable / Disable Number Flipper</strong> is where you enable or disable the number flipper functions.</p>
                <p><strong>Referer List</strong> is where you enter the list of referers for your flipper.</p>
                <p><strong>Phone Numbers to flip</strong> is where you will select the corresponding campaign number to flip for your Phone Number/s according to referer.</p>
            </div>
           
            <h3>Custom Codes</h3>
            <div class="wm4d_section wm4d_support">
            	<p>Custom Codes was created for you to be able to customize your website without having to edit the theme files and worry about the theme updates.
                This section saves your Styles and Scripts to the database. You can easily update your themes and keep your customizations.</p>
            	<p><strong>Custom Style</strong> is where you enter your custom style in css. No need to add &lt;style&gt; tags. This plugin automatically adds these codes to the header of your website.</p>
                <p><strong>Custom Script</strong> is where you enter your custom script in javascript or jquery. No need to add &lt;script&gt; tags.
                This plugin automatically adds these codes to the header of your website.</p>
                <p><strong>Custom HTML in Header</strong> is where you add generated scripts like google scripts, etc. to be added inside the &lt;head&gt; of your website.
                This area accepts HTML script and style tags.</p>
                <p><strong>Custom HTML in Footer</strong> is where you add generated scripts like google scripts, etc. to be added inside just before the &lt;\body&gt; of your website.
                This area accepts HTML script and style tags.</p>
           </div>

			<h3>Page Options</h3>
            <div class="wm4d_section wm4d_support">
            	<p>Page Options is for you to have a full customization of WM4D Functions. In includes page texts for your archives page where you put descriptions to the Before and Afters, Testimonials and Office Images pages.</p>
            	<p><strong>Enable / Disable WM4D Functions</strong> is where you enable or disable the WM4D Functions such as the Procedures, Offers, Testimonials, Before and Afters, Office Images and the Widgets.</p>
            	<p><strong>Before and Afters Page Text</strong> is where you enter your desired text for Before and Afters archive page.
                Shortcode is`[text_before_afters]`.</p>
            	<p><strong>Testimonials Page Text</strong> is where you enter your desired text for Testimonials archive page.
                Shortcode is`[text_testimonials]`.</p>
            	<p><strong>Office Images Page Text</strong> is where you enter your desired text for Office Images archive page.
                Shortcode is`[text_office_images]`.</p>
                <?php WM4D_OPTIONS_PLUGIN__support_page_post_types(); ?>
            </div>


			<h3>Custom Post Types</h3>
            <div class="wm4d_section wm4d_support">
            	<p>Custom Post Types are created for ease of navigation and categorization of contents for your website.</p>
            	<p><strong>Procedures</strong> is where you add Procedures or Services contents. Contents posted in this section will be displayed as a regular post page.</p>
            	<p><strong>Offers</strong> is where you add offer contents. This custom post type is based on the original wm4d plugin. This is where you link your procedures to specific Offers.
                Contents posted in this section will be displayed as a regular post page. However in this plugin, we use the Special Offer widget to display on your website.
                Proceedure category tag is `procedure_tags`.</p>
            	<p><strong>Testimonials</strong> is where you add Testimonial contents. Contents posted in this section will be displayed as a regular post page.
                A widget is available for this post type for you to display a slider section to your website. Testimonial category tag is `testimonial_categories`.</p>
            	<p><strong>Before and Afters</strong> is where you add Before and After contents. Contents posted in this section will be displayed as a regular post page.
                A widget is available for this post type for you to display a slider section to your website.</p>
            	<p><strong>Office Images</strong> is where you add Office contents. Contents posted in this section will be displayed as a regular post page.
                A widget is available for this post type for you to display a slider section to your website.</p>
                <?php WM4D_OPTIONS_PLUGIN__support_custom_post_types(); ?>
            </div>


			<h3>Widgets</h3>
            <div class="wm4d_section wm4d_support">
             	<p>Wigets are created to feature your Special Offers, Before and Afters, Office Images, and Testimonials in your website.</p>
           	<p><strong>Special Offer</strong> is widget where you can display your offers, NOT linked to any custom post type Offers above.
            Displaying different Special Offer to different Procedures or pages, you will need the <a href="https://wordpress.org/plugins/widget-context/" target="_blank">Widget Context</a> plugin.</p>
             	<p><strong>Before and Afters</strong> is a widget slider that will cycle all content posted in the custom post type Before and Afters. It will display the featured image of the content.</p>
            	<p><strong>Testimonials</strong> is a widget slider that will cycle all content posted in the custom post type Testimonials. It will display images, texts, embeds, iframes, etc.</p>
            	<p><strong>Office Images</strong> is a widget slider that will cycle all content posted in the custom post type Office Images. It will display the featured image of the content.</p>
           </div>

		</div>
    </div>
<?php
}
?>