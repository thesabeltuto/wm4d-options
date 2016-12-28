<?php /* Mods Settings */
function WM4D_OPTIONS_PLUGIN_submenu_mods() {
	if ( get_option('wm4d_map_address') == ''  ) $wm4d_map_address='currently <span class="empty">empty</span>'; else $wm4d_map_address=get_option('wm4d_map_address');
	if ( get_option('wm4d_map_link') == ''  ) $wm4d_map_link='currently <span class="empty">empty</span>'; else $wm4d_map_link=get_option('wm4d_map_link');
	if ( get_option('wm4d_map_addresses') == ''  ) $wm4d_map_addresses='currently <span class="empty">empty</span>'; else $wm4d_map_addresses="includes:";
	if ( get_option('wm4d_map_links') == ''  ) $wm4d_map_links='currently <span class="empty">empty</span>'; else $wm4d_map_links="includes:";


	if ( get_option('wm4d_map_select') == '' ) $wm4d_map_select='currently <span class="empty">disabled</span>'; else $wm4d_map_select='<span class="filled">enabled</span>';
	if ( get_option('wm4d_map_console') == '' ) $wm4d_map_console='currently <span class="empty">disabled</span>'; else $wm4d_map_console='<span class="filled">enabled</span>';
?>
	<div class="wm4d_mods_wrap">
	<h1>WM4D Options - MODS <span>Version <?=$GLOBALS['WM4D_OPTIONS_PLUGIN_VERSION']?></span></h1>
	
    <div id="wm4d_nav">
        <ul>
			<?php	WM4D_OPTIONS_PLUGIN_navigation_mods();
			WM4D_OPTIONS_PLUGIN_navigation_BETA_ENABLED();?>
       </ul>
    </div>

        <div class="wm4d_content">

            <div id="wm4d_nav2">
                <ul>
                    <?php WM4D_OPTIONS_PLUGIN_navigation_mods_inner(); ?>
               </ul>
            </div>
            
            <h2>WM4D Options MODIFICATIONS</h2>
			<br />
                            
<?php /*?>            <div class="wm4d_section home">
            <h3>Please select the following to proceed:</h3>
				<ol>
                    <li><a href="?page=wm4d_mods_resmap"><strong>Res Map</strong> - Responsive Styled Google Maps Plugin Modification</a></li>
                </ol>
            </div>            
<?php */?>

            <div class="wm4d_section home">
            <h3>Res Map</h3>
            	<p>Responsive Styled Google Maps Plugin Modification</p>
				<ol>
                    <li>Res Map Mod is currently <?=$wm4d_map_select?></li>
                    <li>Jquery Console Log is currently <?=$wm4d_map_console?></li>
					<?php if ( get_option('wm4d_multiple_select') != 'enable' ) { ?>
                    <li>Custom Map Location is <?=$wm4d_map_address?></li>
                    <li>Custom Map Link is <?=$wm4d_map_link?></li>
					<?php } ?>
					<?php if ( get_option('wm4d_multiple_select') == 'enable' ) { ?>
                    <li>Custom Map Locations <?=$wm4d_map_addresses?></li>
                    <?php $map_addresses = get_option('wm4d_map_addresses');
						if($map_addresses != '') {
							echo '<ol>';
							for($i = 0; $i < sizeof($map_addresses);$i++) {
								echo '<li>'.$map_addresses[$i].'</li>';
							}
							echo '</ol>';
						}
					?>
                    <li>Custom Map Links <?=$wm4d_map_links?></li>
                     <?php $map_links = get_option('wm4d_map_links');
						if($map_links != '') {
							echo '<ol>';
							for($i = 0; $i < sizeof($map_links);$i++) {
								echo '<li>'.$map_links[$i].'</li>';
							}
							echo '</ol>';
						}
					?>
					<?php } ?>
                </ol>
            </div>            

        
            <div class="wm4d_section home">
            <h3>Support</h3>
				All detailed information you need is in the support section.
                Click <a href="?page=wm4d_options_support">here</a> to navigate to support section now.
            </div>            
 
            <div class="wm4d_section home">
            <h3>About</h3>
				All detailed information about the plugin and the author is in the about section.
                Click <a href="?page=wm4d_options_about">here</a> to navigate to about section now.
                Click <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=H228JQZP6269J&lc=US&item_name=TT%2dPlugins%3a%20Support%20WordPress%20Plugin%20Development&item_number=TT%2dPlugins&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted" target="_blank">here</a> to donate to the author now.
                Version <?= $GLOBALS['WM4D_OPTIONS_PLUGIN_VERSION']?>.
            </div>            

        </div>
    </div>
<?php	
}

function WM4D_OPTIONS_PLUGIN_support_mods() {
?>
            <h2>MODS</h2>
            <hr />
            <div class="wm4d_section wm4d_support wm4d_mods">
				<p><strong>MODS</strong> is where you put all modifications of existing functions from plugins or themes and make it your own. This has a separate leg totally independent of the main functionalities of the WM4D-Options plugin. Made for developer's convinience. Contact WM4D-Options plugin Author for more details.</p>
				<?php WM4D_OPTIONS_PLUGIN_support_mods_resmap(); ?>
           </div>

<?php
}
?>