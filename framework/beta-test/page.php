<?php /* Admin Flipper Options */

function WM4D_OPTIONS_PLUGIN_submenu_beta_test() {
	WM4D_OPTIONS_PLUGIN_selection();
	WM4D_OPTIONS_PLUGIN_submission();
	if ( get_option('wm4d_phone') == '' ) $wm4d_phone='currently empty'; else $wm4d_phone=get_option('wm4d_phone');
	if ( get_option('wm4d_primary_referer') == '' ) $wm4d_primary_referer = ''; else $wm4d_primary_referer = get_option('wm4d_primary_referer') ;
	if ( get_option('wm4d_primary_phone') == '' ) $wm4d_primary_phone = '';  else $wm4d_primary_phone = get_option('wm4d_primary_phone') ;
	if ( get_option('wm4d_multiple_selected_phone') == '' ) $wm4d_multiple_selected_phone = ''; else $wm4d_multiple_selected_phone = get_option('wm4d_multiple_selected_phone') ;
	if ( get_option('wm4d_multiple_referer') == '' ) $wm4d_multiple_referer = ''; else $wm4d_multiple_referer = get_option('wm4d_multiple_referer') ;
	if ( get_option('wm4d_multiple_phone') == '' ) $wm4d_multiple_phone = '';  else $wm4d_multiple_phone = get_option('wm4d_multiple_phone') ;
	if ( get_option('wm4d_doctors') == '' ) $wm4d_doctors = '';  else $wm4d_doctors = get_option('wm4d_doctors') ;
	if ( get_option('wm4d_locations') == '' ) $wm4d_locations = '';  else $wm4d_locations = get_option('wm4d_locations') ;
	if ( get_option('wm4d_phones') == '' ) $wm4d_phones = '';  else $wm4d_phones = get_option('wm4d_phones') ;
	if ( get_option('wm4d_phones_loc') == '' ) $wm4d_phones_loc = '';  else $wm4d_phones_loc = get_option('wm4d_phones_loc') ;
?>
<div class="wm4d_wrap">
	<h1>WM4D Options</h1>
    <div id="wm4d_nav">
        <ul>
			<?php WM4D_OPTIONS_PLUGIN_navigation(); ?>
       </ul>
    </div>
        <form method="post" action="options.php">
            <?php settings_fields( 'wm4d-beta-test-group' );
                    do_settings_sections( 'wm4d-beta-test-group' ); ?>
    		<div class="wm4d_content" id="wm4d_li-7">
			<h2>Testing Ground Page</h2>
            <p>This page is for testing only. Not all function and design is final here.</p>
    		<?php submit_button(); ?>
                <h2><input name="wm4d_testing_select" type="checkbox" value="enable" <?php checked( get_option('wm4d_testing_select') == 'enable' ); ?> /> &nbsp;
                Enable / Disable Testing Ground</h2>
                <hr />
                <p>Enabling this will make all codes work both frontend and backend.</p>
                
                <div id="wm4d_select_options_flipper">
                <?php if( get_option('wm4d_multiple_select') != 'enable') { ?>
                <input type="hidden" name="wm4d_select_options" value="primay"/>
                <?php } ?>
                <?php if( get_option('wm4d_multiple_select') == 'enable') { ?>
                <input type="hidden" name="wm4d_select_options" value="multiple"/>
                <?php } ?>
                </div>
                
                
                <div class="wm4d_select_multiple">
                <div class="wm4d_section">
                <h2>Multiple Options | Client Options</h2>
                <hr />
                    <div class="wm4d_section table">
                    <h3>Doctors' Names</h3>
                    <div class="wm4d_table_wrap">
                    <table id="doctors" border="0" cellspacing="0" cellpadding="8" class="wm4d_table_form">
                        <thead>
                            <th>ID</th>
                            <th>Doctor's Name</th>
                            <th><input type="button" class="wm4d_add wm4d_doctors_add" id="wm4d_doctors_add" name="wm4d_primary_add" value="+"  /> </th>
                        </thead>
                    <?php
                    $alldata = array();
                    for($i = 0; $i < sizeof($wm4d_doctors);$i++) {  $id = $i+1; ?>
                        <tr id="doctors_<?=$id?>">
                            <td><input type="text" readonly="readonly" name="wm4d_doctors_id" value="<?=$id?>" size="1" tabindex="-1"/></td>
                            <td><input type="text" name="wm4d_doctors[]" value="<?=$wm4d_doctors[$i]?>" size="48"/></td>
                            <td><input type="button" class="wm4d_remove wm4d_doctors_remove" name="wm4d_doctors_remove" value="-"  tabindex="-1"></td>
                        </tr>
                    <?php } ?>
                    </table>
                    <hr/>
                    <div class="wm4d_table_wrap_foot_left">Enter all information you need.</div>
                    <div class="wm4d_table_wrap_foot_right">
                        <input type="button" class="wm4d_add wm4d_doctors_add" id="wm4d_doctors_add2" name="wm4d_doctors_add" value="Add More Doctors"  />
                    </div>
                    </div>
                    </div>
                
                    <div class="wm4d_section table">
                    <h3>Phone Numbers by Location</h3>
                    <div class="wm4d_table_wrap">
                    <table id="phones" border="0" cellspacing="0" cellpadding="8" class="wm4d_table_form">
                        <thead>
                            <th>ID</th>
                            <th>Phone Number</th>
                            <th>Location</th>
                            <th><input type="button" class="wm4d_add wm4d_phones_add" id="wm4d_phones_add" name="wm4d_primary_add" value="+"  /> </th>
                        </thead>
                    <?php
                    $alldata = array();
                    for($i = 0; $i < sizeof($wm4d_phones);$i++) {  $id = $i+1; ?>
                        <tr id="phones_<?=$id?>">
                            <td><input type="text" readonly="readonly" name="wm4d_phones_id" value="<?=$id?>" size="1" tabindex="-1"/></td>
                            <td><input type="text" class="phone_format" name="wm4d_phones[]" value="<?=$wm4d_phones[$i]?>" /></td>
                            <td><input type="text" name="wm4d_phones_loc[]" value="<?=$wm4d_phones_loc[$i]?>" /></td>
                            <td><input type="button" class="wm4d_remove wm4d_phones_remove" name="wm4d_phones_remove" value="-"  tabindex="-1"></td>
                        </tr>
                    <?php } ?>
                    </table>
                    <hr/>
                    <div class="wm4d_table_wrap_foot_left">Enter all information you need.</div>
                    <div class="wm4d_table_wrap_foot_right">
                        <input type="button" class="wm4d_add wm4d_phones_add" id="wm4d_phones_add2" name="wm4d_phones_add" value="Add More Phones"  />
                    </div>
                    </div>
                    </div>
                
                    <div class="wm4d_section table">
                    <h3>Office Locations</h3>
                    <div class="wm4d_table_wrap">
                    <table id="locations" border="0" cellspacing="0" cellpadding="8" class="wm4d_table_form">
                        <thead>
                            <th>ID</th>
                            <th>Office Location</th>
                            <th><input type="button" class="wm4d_add wm4d_locations_add" id="wm4d_locations_add" name="wm4d_locations_add" value="+"  /> </th>
                        </thead>
                    <?php
                    $alldata = array();
                    for($i = 0; $i < sizeof($wm4d_locations);$i++) {  $id = $i+1; ?>
                        <tr id="locations_<?=$id?>">
                            <td><input type="text" readonly="readonly" name="wm4d_locations_id" value="<?=$id?>" size="1" tabindex="-1"/></td>
                            <td><input type="text" name="wm4d_locations[]" value="<?=$wm4d_locations[$i]?>" size="48"/></td>
                            <td><input type="button" class="wm4d_remove wm4d_locations_remove" name="wm4d_locations_remove" value="-"  tabindex="-1"></td>
                        </tr>
                    <?php } ?>
                    </table>
                    <hr/>
                    <div class="wm4d_table_wrap_foot_left">Enter all information you need.</div>
                    <div class="wm4d_table_wrap_foot_right">
                        <input type="button" class="wm4d_add wm4d_locations_add" id="wm4d_locations_add2" name="wm4d_locations_add" value="Add More Locations"  />
                    </div>
                    </div>
                    </div>
                </div>
                </div>
                
                <div class="wm4d_select_primary">
                <div class="wm4d_section table">
                <h2>Primary Options | Flipper Options</h2>
                <hr />
                <h3>Phone Numbers to Flip</h3>
                    <div class="wm4d_table_wrap">
                    <table id="primary" border="0" cellspacing="0" cellpadding="8" class="wm4d_table_form">
                        <thead>
                            <th>ID</th>
                            <th>Phone Number From</th>
                            <th>Referer</th>
                            <th>Phone Number To</th>
                            <th><input type="button" class="wm4d_add wm4d_primary_add" id="wm4d_primary_add" name="wm4d_primary_add" value="+"  /> </th>
                        </thead>
                    <?php
                    $alldata = array();
                    for($i = 0; $i < sizeof($wm4d_primary_referer);$i++) {  $id = $i+1; ?>
                        <tr id="primary_<?=$id?>">
                            <td><input type="text" readonly="readonly" name="wm4d_primary_id" value="<?=$id?>" size="1" tabindex="-1"/></td>
                            <td><input type="text" readonly="readonly" name="wm4d_phone" value="<?=$wm4d_phone?>" tabindex="-1"/></td>
                            <td><input type="text" name="wm4d_primary_referer[]" value="<?=$wm4d_primary_referer[$i]?>"/></td>
                            <td><input type="text" class="phone_format" name="wm4d_primary_phone[]" value="<?=$wm4d_primary_phone[$i]?>"/></td>
                            <td><input type="button" class="wm4d_remove wm4d_primary_remove" name="wm4d_primary_remove" value="-"  tabindex="-1"></td>
                        </tr>
                    <?php } ?>
                    </table>
                    <hr/>
                    <div class="wm4d_table_wrap_foot_left">Enter all information you need.</div>
                    <div class="wm4d_table_wrap_foot_right">
                        <input type="button" class="wm4d_add wm4d_primary_add" id="wm4d_primary_add2" name="wm4d_multiple_add" value="Add More Referers"  />
                    </div>
                    </div>
                </div>
                </div>

                <div class="wm4d_select_multiple">
                <div class="wm4d_section table">
                <h2>Multiple Options | Flipper Options</h2>
                <hr />
                <h3>Phone Numbers to Flip</h3>
                    <div class="wm4d_table_wrap">
                    <table id="multiple" border="0" cellspacing="0" cellpadding="8" class="wm4d_table_form">
                        <thead>
                            <th>ID</th>
                            <th>Phone Number From</th>
                            <th>Referer</th>
                            <th>Phone Number To</th>
                            <th><input type="button" class="wm4d_add wm4d_multiple_add" id="wm4d_multiple_add" name="wm4d_multiple_add" value="+"  /> </th>
                       </thead>
                       <tbody>
                    <?php
                    $alldata = array();
                    for($i = 0; $i < sizeof($wm4d_multiple_referer);$i++) {  $id = $i+1; ?>
                        <tr id="multiple_<?=$id?>">
                            <td><input type="text" readonly="readonly" name="wm4d_multiple_id" value="<?=$id?>" size="1" tabindex="-1"/></td>
                            <td><select id="wm4d_multiple_selected_phone" name="wm4d_multiple_selected_phone[]"><?php echo get_multiple_phones($wm4d_phones, $wm4d_phones_loc, $wm4d_multiple_selected_phone[$i]); ?></select></td>
                            <td><input type="text" name="wm4d_multiple_referer[]" value="<?=$wm4d_multiple_referer[$i]?>"/></td>
                            <td><input type="text" class="phone_format" name="wm4d_multiple_phone[]" value="<?=$wm4d_multiple_phone[$i]?>"/></td>
                            <td><input type="button" class="wm4d_remove wm4d_multiple_remove" name="wm4d_multiple_remove" value="-"  tabindex="-1"></td>
                        </tr>
                    <?php } ?> 
                    </tbody> 
                    </table>
                    <hr/>
                    <div class="wm4d_table_wrap_foot_left">Enter all information you need.</div>
                    <div class="wm4d_table_wrap_foot_right">
                        <input type="button" class="wm4d_add wm4d_multiple_add" id="wm4d_multiple_add2" name="wm4d_multiple_add" value="Add More Referers"  />
                    </div>
                    </div>
                </div>
                </div>
                
                <?php submit_button(); ?>
				<hr />
                
                <div class="wm4d_section">
                <h2>Testing Ground Results Summary</h2>
				<hr />
               
                <div class="wm4d_select_primary">
                <div class="wm4d_section home">
                <h2>Primary Data</h2>
                <ol>
                	<li>Primary Phone Number From <?=$wm4d_phone?></li>
                    <?php if (!empty($wm4d_primary_referer)) {
					for($i = 0; $i < sizeof($wm4d_primary_referer);$i++){ ?>
                    <li>Flip to <?=$wm4d_primary_phone[$i]?> when referer is <?=$wm4d_primary_referer[$i]?></li>
                    <?php } } ?>
               </ol>
                </div>
                </div>

                <div class="wm4d_select_multiple">
                <div class="wm4d_section home">
                <h2>Multiple Data</h2>
                <ol>
                    <li>Multiple Phone Number From <?php if(!empty($wm4d_phones)) echo 'is available'; else echo 'is empty';?>.</li>
                    <?php if (!empty($wm4d_multiple_referer)) {
					for($i = 0; $i < sizeof($wm4d_multiple_referer);$i++){ ?>
                    <li><?=$wm4d_multiple_selected_phone[$i]?> will flip to <?=$wm4d_multiple_phone[$i]?> when referer is <?=$wm4d_multiple_referer[$i]?></li>
                    <?php } } ?>
                </ol>
                </div>
                </div>
                </div>


				<div class="wm4d_section">
                <h2>Testing Ground Support</h2>
				<hr />

                <div class="wm4d_section home">
                <h2>Database Options</h2>
                <ol>
                	<li>Enable/Disable Testing Ground (string, value is enable): <strong>wm4d_testing_select</strong></li>
					<li>Multiple Options | Client Options
                    <ol>
                        <li>Multiple Doctors (array): <strong>wm4d_doctors</strong></li>
                        <li>Multiple Locations (array): <strong>wm4d_locations</strong></li>
                        <li>Multiple Phone Numbers (array, value is phone number): <strong>wm4d_phones</strong></li>
                        <li>Multiple Phone Numbers-Location (array, value is short location): <strong>wm4d_phones_loc</strong></li>
                    </ol>
					<li>Primary Options | Flipper Options
                    <ol>
                        <li>Primary Phone From (string, value is phone number): <strong>wm4d_phone</strong></li>
                        <li>Primary Referer (array): <strong>wm4d_primary_referer</strong></li>
                        <li>Primary Phone To (array): <strong>wm4d_primary_phone</strong></li>
                    </ol>
					<li>Multiple Options | Flipper Options
                    <ol>
                        <li>Multiple Referer (array): <strong>wm4d_multiple_referer</strong></li>
                        <li>Multiple Phone To (array): <strong>wm4d_multiple_phone</strong></li>
                        <li>Multiple Phone From (array, value is phone number): <strong>wm4d_multiple_selected_phone</strong></li>
                    </ol>
                </ol>
                </div>
                
<?php /*?>                <div class="wm4d_section home">
                <h2>Remove All Data From Database</h2>
                <hr />
                <p><input type="button" id="wm4d_delete" name="DeleteData" onclick="<?php remove_all_data(); ?>" value="Delete All Data" src="?page=wm4d_options_beta_test"/></p>
                <p>Clicking this will delete all data saved in this page only.</p>
                </div>
<?php */?>
				</div>

          </div>
    </form>
	</div>
<?php
}

function remove_all_data(){
	delete_option('wm4d_primary_referer');
	delete_option('wm4d_primary_phone');
	delete_option('wm4d_multiple_referer');
	delete_option('wm4d_multiple_phone');
	delete_option('wm4d_multiple_selected_phone');
	delete_option('wm4d_testing_select');
	
	delete_option('wm4d_doctors');
	delete_option('wm4d_locations');
	delete_option('wm4d_phones');
	delete_option('wm4d_phones_loc');
	
	unregister_setting('wm4d-beta-test-group','wm4d_primary_referer');
	unregister_setting('wm4d-beta-test-group','wm4d_primary_phone');
	unregister_setting('wm4d-beta-test-group','wm4d_multiple_referer');
	unregister_setting('wm4d-beta-test-group','wm4d_multiple_phone');
	unregister_setting('wm4d-beta-test-group','wm4d_multiple_selected_phone');	
	unregister_setting('wm4d-beta-test-group','wm4d_testing_select');	

	unregister_setting('wm4d-beta-test-group','wm4d_doctors');	
	unregister_setting('wm4d-beta-test-group','wm4d_locations');	
	unregister_setting('wm4d-beta-test-group','wm4d_phones');	
	unregister_setting('wm4d-beta-test-group','wm4d_phones_loc');	
}

function get_multiple_phones($wm4d_phones, $locations, $selectedphone) {
	$selectedphone = $selectedphone;
	$wm4d_phones = $wm4d_phones;
	$locations = $locations;
	$options = '';
	for($i = 0; $i < sizeof($wm4d_phones);$i++) {
		if($selectedphone == $wm4d_phones[$i]) { 
			$options .= '<option value="'.$wm4d_phones[$i].'" selected>'.$locations[$i].': '.$wm4d_phones[$i].'</option>';
		} else {
			$options .= '<option value="'.$wm4d_phones[$i].'">'.$locations[$i].': '.$wm4d_phones[$i].'</option>';
		}
	}
		
	return $options;
}
?>