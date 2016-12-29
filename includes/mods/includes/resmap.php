<?php /* Mods Settings */
function WM4D_OPTIONS_PLUGIN_submenu_mods_resmap() {
	WM4D_OPTIONS_PLUGIN_selection_resmap();
	if ( get_option('wm4d_map_addresses') == '' ) $wm4d_map_addresses = '';  else $wm4d_map_addresses = get_option('wm4d_map_addresses');
	if ( get_option('wm4d_map_links') == '' ) $wm4d_map_links = '';  else $wm4d_map_links = get_option('wm4d_map_links');
	$wm4d_locs = get_option('wm4d_locations');

	if ( get_option('wm4d_map_condition_addresses') == '' ) $wm4d_map_condition_addresses = '';  else $wm4d_map_condition_addresses = get_option('wm4d_map_condition_addresses');
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

        <form method="post" action="options.php">
            <?php settings_fields( 'wm4d-resmap-group' );
                    do_settings_sections( 'wm4d-resmap-group' ); ?>

    		<div class="wm4d_content" id="wm4d_li-8">
			<h2>Responsive Styled Google Maps Plugin Modification</h2>

    		<?php submit_button(); ?>

                <div id="wm4d_map_select">
                <h2><input id="wm4d_map_select" name="wm4d_map_select" type="checkbox" value="enable" <?php checked( get_option('wm4d_map_select') == 'enable' ); ?> /> &nbsp;
                Enable / Disable Custom Map Information</h2>
                <hr />
                <p>Enabling this will allow you to overwrite <span class="wm4d_map_text"></span> in the Responsive Styled Google Maps plugin.
                </p>
                <p class="wm4d_map_text2"></p>
                </div>

                <div id="wm4d_map_console" class="map_select">
                <h2><input id="wm4d_map_console" name="wm4d_map_console" type="checkbox" value="enable" <?php checked( get_option('wm4d_map_console') == 'enable' ); ?> /> &nbsp;
                Enable / Disable Jquery Console Logs</h2>
                <hr />
                <p>Enabling this will allow you to see the console logs of the resmap mod in your browser.
                </p>
                </div>

                <div id="wm4d_map_condition_select" class="map_select">
                <h2><input id="wm4d_map_condition_select" name="wm4d_map_condition_select" type="checkbox" value="enable" <?php checked( get_option('wm4d_map_condition_select') == 'enable' ); ?> /> &nbsp;
                Enable / Disable Special Conditions</h2>
                <hr />
                <p>Enabling this will allow you to input special map conditions (Manual Location/s) that don't match the Client Options.
                </p>
                </div>


                <?php if( get_option('wm4d_multiple_select') != 'enable') { ?>
                
                <div id="wm4d_primary_options" class="wm4d_select map_select">
                    <h2>Custom Map - Single Information</h2>
                    <hr />
                    <p>Overwrite <span class="wm4d_map_text"></span> in the Responsive Styled Google Maps plugin for one Location.</p>
                    <p class="wm4d_map_text2"></p>
       
                    <div class="wm4d_section table">
                    <h3>Custom Map Location</h3>
                    <div class="wm4d_table_wrap">
                    <table id="locations" border="0" cellspacing="0" cellpadding="8" class="wm4d_table_form">
                        <thead>
                            <th>Office Location</th>
                            <?php if ( get_option('wm4d_map_condition_select') == 'enable' ) { ?>
                            <th>Special Condition (Manual Office Location)</th>
							<?php } ?>
                            <th>Custom Map Location</th>
                        </thead>
                        <tr id="address">
                            <td><textarea readonly="readonly" name="wm4d_location"  cols="48" rows="4" value="get_option('wm4d_location')?>"><?=get_option('wm4d_location')?></textarea></td>
                            <?php if ( get_option('wm4d_map_condition_select') == 'enable' ) { ?>
                            <td><textarea name="wm4d_map_condition_address"  cols="48" rows="4" value="get_option('wm4d_map_condition_address')?>"><?=get_option('wm4d_map_condition_address')?></textarea></td>
							<?php } ?>
                            <td><textarea name="wm4d_map_address" cols="48" rows="4" value="<?php echo get_option('wm4d_map_address');?>"><?php echo get_option('wm4d_map_address');?></textarea></td>
                        </tr>
                    </table>
                    <hr/>
                    <div class="wm4d_table_wrap_foot_left">Enter the Location of the Office.<br />
                    	Format up to 4 lines of address information.</div>

                    </div>
                    </div>

                   <div class="wm4d_section table">
                    <h3>Custom Map Link</h3>
                    <div class="wm4d_table_wrap">
                    <table id="locations" border="0" cellspacing="0" cellpadding="8" class="wm4d_table_form">
                        <thead>
                            <th>Office Location</th>
                            <?php if ( get_option('wm4d_map_condition_select') == 'enable' ) { ?>
                            <th>Special Condition (Manual Office Location)</th>
							<?php } ?>
                            <th>Custom Map Link</th>
                        </thead>
                        <tr id="address">
                            <td><textarea readonly="readonly" name="wm4d_location" cols="48" rows="4" value="get_option('wm4d_location')?>"><?=get_option('wm4d_location')?></textarea></td>
                            <?php if ( get_option('wm4d_map_condition_select') == 'enable' ) { ?>
                            <td><textarea readonly="readonly" name="wm4d_map_condition_address2"  cols="48" rows="4" value="get_option('wm4d_map_condition_address')?>"><?=get_option('wm4d_map_condition_address')?></textarea></td>
							<?php } ?>
                            <td><input name="wm4d_map_link" type="text" size="48" value="<?=get_option('wm4d_map_link')?>" /></td>
                        </tr>
                    </table>
                    <hr/>
                    <div class="wm4d_table_wrap_foot_left">Enter all information you need.</div>

                    </div>
                    </div>

                </div>
                
				<?php } ?>
				<?php if ( get_option('wm4d_multiple_select') == 'enable' ) { ?>

                <div id="wm4d_multiple_options" class="wm4d_select map_select">
                    <h2>Custom Map - Multiple Information</h2>
                    <hr />
                    <p>Overwrite <span class="wm4d_map_text"></span> in the Responsive Styled Google Maps plugin for multiple Locations.</p>
                    <p class="wm4d_map_text2"></p>
                    <p class="wm4d_map_text3"></p>

                    <div class="wm4d_section table">
                    <h3>Custom Map Locations</h3>
                    <div class="wm4d_table_wrap">
                    <table id="locations" border="0" cellspacing="0" cellpadding="8" class="wm4d_table_form">
                        <thead>
                            <th>ID</th>
                            <th>Office Location</th>
                            <?php if ( get_option('wm4d_map_condition_select') == 'enable' ) { ?>
                            <th>Special Condition (Manual Office Location)</th>
							<?php } ?>
                            <th>Custom Map Location</th>
                        </thead>
                    <?php
                    //$alldata = array();
                    for($i = 0; $i < sizeof($wm4d_locs);$i++) {  $id = $i+1; ?>
                        <tr id="addresses_<?=$id?>">
                            <td><input type="text" readonly="readonly" name="wm4d_locations_id" value="<?=$id?>" size="1" tabindex="-1"/></td>
                            <td><textarea readonly="readonly" name="wm4d_locs_<?=$id?>" cols="48" rows="4" value="<?=$wm4d_locs[$i]?>"><?=$wm4d_locs[$i]?></textarea></td>
                            <?php if ( get_option('wm4d_map_condition_select') == 'enable' ) { ?>
                           <td><textarea name="wm4d_map_condition_addresses[]" id="wm4d_map_condition_addresses_<?=$id?>" cols="48" rows="4" value="<?=$wm4d_map_condition_addresses[$i]?>"><?=$wm4d_map_condition_addresses[$i]?></textarea></td>
							<?php } ?>
                            <td><textarea name="wm4d_map_addresses[]" cols="48" rows="4" value="<?=$wm4d_map_addresses[$i]?>"><?=$wm4d_map_addresses[$i]?></textarea></td>
                        </tr>
                    <?php } ?>
                    </table>
                    <hr/>
                    <div class="wm4d_table_wrap_foot_left">Enter all information you need.<br />
                    	Format up to 4 lines of address information.</div>

                    </div>
                </div>
                
                <div class="wm4d_section table">
                    <h3>Custom Map Links</h3>
                    <div class="wm4d_table_wrap">
                    <table id="locations" border="0" cellspacing="0" cellpadding="8" class="wm4d_table_form">
                        <thead>
                            <th>ID</th>
                            <th>Office Location</th>
                            <?php if ( get_option('wm4d_map_condition_select') == 'enable' ) { ?>
                            <th>Special Condition (Manual Office Location)</th>
							<?php } ?>
                            <th>Custom Map Link</th>
                        </thead>
                    <?php
					
                    //$alldata = array();
                    for($i = 0; $i < sizeof($wm4d_locs);$i++) {  $id = $i+1; ?>
                        <tr id="addresses_<?=$id?>">
                            <td><input type="text" readonly="readonly" name="wm4d_locations_id" value="<?=$id?>" size="1" tabindex="-1"/></td>
                            <td><textarea readonly="readonly" name="wm4d_locs_<?=$id?>" cols="48" rows="4" value="<?=$wm4d_locs[$i]?>"><?=$wm4d_locs[$i]?></textarea></td>
                            <?php if ( get_option('wm4d_map_condition_select') == 'enable' ) { ?>
                            <td><textarea readonly="readonly" name="wm4d_map_condition_addresses2[]" id="wm4d_map_condition_addresses2_<?=$id?>" cols="48" rows="4" value="<?=$wm4d_map_condition_addresses[$i]?>"><?=$wm4d_map_condition_addresses[$i]?></textarea></td>
							<?php } ?>
                            <td><input type="text" size="48" name="wm4d_map_links[]" value="<?=$wm4d_map_links[$i]?>"/></td>
                        </tr>
                    <?php } ?>
                                        
                    </table>
                    <hr/>
                    <div class="wm4d_table_wrap_foot_left">Enter all information you need.</div>

                    </div>
                </div>
				<?php } ?>

            </div>
			<?php submit_button(); ?>
        </form>
        </div>
    </div>
<?php	
}

function WM4D_OPTIONS_PLUGIN_support_mods_resmap() {
?>
    <p><strong>Resmap</strong> is Responsive Styled Google Maps Plugin Modification section where you overwrite the link of the map specifically to your needs.</p>
<?php
}
?>