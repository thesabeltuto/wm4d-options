<?php /* Admin About Page */

function WM4D_OPTIONS_PLUGIN_submenu_about() {
?>
	<div class="wm4d_wrap">
	<h1>WM4D Options <span>Version <?=$GLOBALS['WM4D_OPTIONS_PLUGIN_VERSION']?></span></h1>
    <div id="wm4d_nav">
        <ul>
			<?php WM4D_OPTIONS_PLUGIN_navigation(); ?>
       </ul>
    </div>
        <div class="wm4d_content" id="wm4d_li-4">
            <h2>About</h2>
            
            <h3>Description</h3>
            <div class="wm4d_section about">
                <p>This plugin is a simplified <a href="http://www.wm4d.com/" target="_blank">WM4D</a> plugin that includes custom post types and widgets of  before and afters, prodecures, offers, office images and testimonials.
                This plugin also includes theme options that can help you edit styles and scripts on dashboard.
                Client options has been added to provide flexibilty of information across the website.
                 Number flipper has been added to help you flip phone numbers for specific website visitors.</p>
            </div>

            <h3>Version</h3>
            <div class="wm4d_section about">
                <p>Version: <?= $GLOBALS['WM4D_OPTIONS_PLUGIN_VERSION']?></p>
            </div>
            
            <h3>Includes</h3>
            <div class="wm4d_section about">
                <p>Number Flipper Scripts by Andrey Novoselov</p>
            </div>

            <h3>Author</h3>
            <div class="wm4d_section about">
                <p>Created by <a href="http://thesabeltuto.blogspot.com" target="_blank">Thesabel Tuto</a>.
                For questions, suggestions and bug reports please contact the author.</p>
            </div>
            
            <h3>Plugin Site</h3>
            <div class="wm4d_section about">
                <p>Plugin site at <a href="http://ttplugins.wordpress.com/" target="_blank">TT Plugins</a>.
                Check out other plugins created by the author.</p>
            </div>
            
            <h3>Donate</h3>
            <div class="wm4d_section about">
                <p>Donations are accepted via Paypal Donate to <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=H228JQZP6269J&lc=US&item_name=TT%2dPlugins%3a%20Support%20WordPress%20Plugin%20Development&item_number=TT%2dPlugins&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted" target="_blank">TT Plugins</a>.
                Please donate to support the author in improving this plugin and in creating more useful and helpful plugins.
                Thank you for supporting!</p>
            </div>
        </div>
    </div>
<?php
}
?>