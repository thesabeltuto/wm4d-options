<?php /* Admin Client Options Page */

function WM4D_OPTIONS_PLUGIN_submenu_client_options() {
	WM4D_OPTIONS_PLUGIN_selection();
	if ( get_option('wm4d_doctors') == '' ) $wm4d_doctors = '';  else $wm4d_doctors = get_option('wm4d_doctors');
	if ( get_option('wm4d_docs_titles') == '' ) $wm4d_docs_titles = '';  else $wm4d_docs_titles = get_option('wm4d_docs_titles');
	if ( get_option('wm4d_locations') == '' ) $wm4d_locations = '';  else $wm4d_locations = get_option('wm4d_locations');
	if ( get_option('wm4d_phones') == '' ) $wm4d_phones = ''; else $wm4d_phones = get_option('wm4d_phones');
	if ( get_option('wm4d_phones_loc') == '' ) $wm4d_phones_loc = ''; else $wm4d_phones_loc = get_option('wm4d_phones_loc');
?>
	<div class="wm4d_wrap">
	<h1>WM4D Options</h1>
    <div id="wm4d_nav">
        <ul>
			<?php WM4D_OPTIONS_PLUGIN_navigation(); ?>
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

                <div id="wm4d_select_options">
                <h2><input id="wm4d_multiple_select" name="wm4d_multiple_select" type="checkbox" value="enable" <?php checked( get_option('wm4d_multiple_select') == 'enable' ); ?> /> &nbsp;
                Enable / Disable Multiple Information</h2>
                <hr />
                <p>Enabling this will allow you to input multiple Doctor's Names, Phone Numbers and/or Locations.
                </p>
                </div>

                <div id="wm4d_select_phone_format">
                <h2><input id="wm4d_phone_format_select" name="wm4d_phone_format_select" type="checkbox" value="enable" <?php checked( get_option('wm4d_phone_format_select') == 'enable' ); ?> /> &nbsp;
                Enable / Disable International Phone Format</h2>
                <hr />
                <p>Enabling this will allow you to change the format of phone numbers from (999) 999-9999 to international +99 (999) 999-9999.
                </p>
                </div>
                
                <div id="wm4d_primary_options" class="wm4d_select">
                    <h2>Single Information</h2>
                    <hr />
                    <p>For one Doctor's Name, Phone Number and Location.</p>
       
                    <div class="wm4d_section">
                    <h3>Doctor's Name</h3>
                    <input name="wm4d_doctor" type="text" size="60" value="<?php echo get_option('wm4d_doctor'); ?>" />
                    <br />Enter the Doctor's Name here.
                    </div>
                    
                    <div class="wm4d_section">
                    <h3>Doctor's Titles</h3>
                    <input name="wm4d_doc_titles" type="text" size="60" value="<?php echo get_option('wm4d_doc_titles'); ?>" />
                    <br />Enter the Doctor's Titles here.
                    </div>
    
                    <div class="wm4d_section">
                    <h3>Phone Number</h3>
                    <input name="wm4d_phone" class="phone_format" type="text" size="60" value="<?php echo get_option('wm4d_phone'); ?>" />
                    <br />Enter the Phone Number of the Office.
                    </div>
    
                    <div class="wm4d_section">
                    <h3>Office Location</h3>
                    <textarea name="wm4d_location" cols="60" rows="4" value="<?php echo get_option('wm4d_location'); ?>"><?php echo get_option('wm4d_location'); ?></textarea>
                    <br />Enter the Location of the Office.<br />
                    Format up to 4 lines of address information.
                    </div>
                    
                    <div class="wm4d_section">
                    <h3>Short Location</h3>
                    <input name="wm4d_location_short" class="wm4d_location_short" type="text" size="60" value="<?php echo get_option('wm4d_location_short'); ?>" />
                    <br />Enter the short version of Office Location.
                    </div>
                </div>
                    
                <div id="wm4d_multiple_options" class="wm4d_select">
                    <h2>Multiple Information</h2>
                    <hr />
                    <p>For many Doctor's Names, Phone Numbers and/or Locations.
                    
					<div class="wm4d_section table">
                    <h3>Doctors' Names</h3>
                    <div class="wm4d_table_wrap">
                    <table id="doctors" border="0" cellspacing="0" cellpadding="8" class="wm4d_table_form">
                        <thead>
                            <th>ID</th>
                            <th>Doctor's Name</th>
                            <th>Doctor's Titles</th>
                            <th><input type="button" class="wm4d_add wm4d_doctors_add" id="wm4d_doctors_add" name="wm4d_primary_add" value="+"  /> </th>
                        </thead>
                    <?php
                    //$alldata = array();
                    for($i = 0; $i < sizeof($wm4d_doctors);$i++) {  $id = $i+1; ?>
                        <tr id="doctors_<?=$id?>">
                            <td><input type="text" readonly="readonly" name="wm4d_doctors_id" value="<?=$id?>" size="1" tabindex="-1"/></td>
                            <td><input type="text" name="wm4d_doctors[]" value="<?=$wm4d_doctors[$i]?>" size="48"/></td>
                            <td><input type="text" name="wm4d_docs_titles[]" value="<?=$wm4d_docs_titles[$i]?>" size="20"/></td>
                            <td><input type="button" class="wm4d_remove wm4d_doctors_remove" name="wm4d_doctors_remove" value="-"  tabindex="-1"></td>
                        </tr>
                    <?php } ?>
                    </table>
                    <hr/>
                    <div class="wm4d_table_wrap_foot_left">Enter all information you need.<br />
                    	Full name and doctor's titles.</div>
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
                    for($i = 0; $i < sizeof($wm4d_phones);$i++) {  $id = $i+1;
					?>
                        <tr id="phones_<?=$id?>">
                            <td><input type="text" readonly="readonly" name="wm4d_phones_id" value="<?=$id?>" size="1" tabindex="-1"/></td>
                            <td><input type="text" class="phone_format" name="wm4d_phones[]" value="<?=$wm4d_phones[$i]?>" /></td>
                            <td><input type="text" name="wm4d_phones_loc[]" value="<?=$wm4d_phones_loc[$i]?>" /></td>
                            <td><input type="button" class="wm4d_remove wm4d_phones_remove" name="wm4d_phones_remove" value="-"  tabindex="-1"></td>
                        </tr>
                    <?php } ?>
                    </table>
                    <hr/>
                    <div class="wm4d_table_wrap_foot_left">Enter all information you need.<br />
                    	Phone number and short name of location.</div>
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
                    //$alldata = array();
                    for($i = 0; $i < sizeof($wm4d_locations);$i++) {  $id = $i+1; ?>
                        <tr id="locations_<?=$id?>">
                            <td><input type="text" readonly="readonly" name="wm4d_locations_id" value="<?=$id?>" size="1" tabindex="-1"/></td>
                            <td><textarea name="wm4d_locations[]" cols="48" rows="4" value="<?=$wm4d_locations[$i]?>"><?=$wm4d_locations[$i]?></textarea></td>
                            <td><input type="button" class="wm4d_remove wm4d_locations_remove" name="wm4d_locations_remove" value="-"  tabindex="-1"></td>
                        </tr>
                    <?php } ?>
                    </table>
                    <hr/>
                    <div class="wm4d_table_wrap_foot_left">Enter all information you need.<br />
                    	Format up to 4 lines of address information.</div>
                    <div class="wm4d_table_wrap_foot_right">
                        <input type="button" class="wm4d_add wm4d_locations_add" id="wm4d_locations_add2" name="wm4d_locations_add" value="Add More Locations"  />
                    </div>
                    </div>
                    </div>
                </div>
                    
				<?php submit_button(); ?>
                
                <hr />
                <h2>Client Options Support</h2>
                <hr />
                
                <div class="wm4d_section">
                <h2>Shortcodes</h2>
                <hr />
                <div class="wm4d_section howto">
                <h3>General Options</h3>
                    <ol>
                        <li><strong>Client's Name:</strong> `[client_name]`</li>
                        <li><strong>Practice Name:</strong> `[practice_name]`</li>
                    </ol>
                <div class="wm4d_select_primary">
                <h3>Single Information</h3>
                    <ol>
                        <li><strong>Doctor's Name:</strong> `[doctor_name]`</li>
                        <li><strong>Doctor's Name with Title:</strong> `[doctor_name title="true"]`</li>
                        <li><strong>Phone Number:</strong> `[phone_number]`</li>
                        <li><strong>Office Location:</strong> `[location]`</li>
                        <li><strong>Short Location:</strong> `[location short="true"]`</li>
                   	</ol>
                </div>
                <div class="wm4d_select_multiple">
                <h3>Multiple Information</h3>
                    <ol>
                        <li><strong>Doctors' Names:</strong>
                            <ol>
                                <li>Show all: `[doctor_names]`</li>
                                <li>Show all with titles: `[doctor_names title="true"]`</li>
                                <li>Show all in a sentence: `[doctor_names and="true"]`</li>
                                <li>Show all with titles in a sentence: `[doctor_names title="true" and="true"]`</li>
                                <li>Show specific Doctor's name: `[doctor_names id="#"]`</li>
                                <li>Show specific Doctor's name with titles: `[doctor_names id="#" title="true"]`</li>
                                <li>Show number of Doctor: `[doctor_names count="true"]`</li>
                            </ol>
                        </li>
                        
                        <li><strong>Phone Numbers by Location:</strong>
                            <ol>
                                <li>Show all: `[phone_numbers]`</li>
                                <li>Show all phone numbers: `[phone_numbers only="phone"]`</li>
                                <li>Show all locations: `[phone_numbers only="location"]`</li>
                                <li>Show all in a sentence: `[phone_numbers and="true"]`</li>
                                <li>Show all phone numbers in a sentence: `[phone_numbers only="phone" and="true"]`</li>
                                <li>Show all locations in a sentence: `[phone_numbers only="location" and="true"]`</li>
                                <li>Show specific Phone number and location: `[phone_numbers id="#"]`</li>
                                <li>Show specific Phone number: `[phone_numbers id="#" only="phone"]`</li>
                                <li>Show specific Location: `[phone_numbers id="#" only="location"]`</li>
                                <li>Show number of phones: `[phone_numbers count="true"]`</li>
                           </ol>
                        </li>
                        <li><strong>Office Locations:</strong>
                            <ol>
                                <li>Show all: `[locations]`</li>
                                <li>Show all short locations: `[locations short="true"]`</li>
                                <li>Show all in a sentence: `[locations and="true"]`</li>
                                <li>Show all short locations in a sentence: `[locations short="true" and="true"]`</li>
                                <li>Show specific Location: `[locations  id="#"]`</li>
                                <li>Show specific Short location: `[locations  id="#" short="true"]`</li>
                                <li>Show number of locations: `[locations count="true"]`</li>
                            </ol>
                        </li>
                  </ol>
                </div> 
                </div> 
                </div>
                
                <div class="wm4d_section">
                <h2>Other Shortcodes</h2>
                <hr />
                <div class="wm4d_section howto">
                <h3>Appicable to</h3>
                    <ol>
                        <li>Soulmedic Theme and Plugins</li>
                    </ol>
                <h3>General Options</h3>
                    <ol>
                        <li><strong>Client's Name:</strong> `%client_name%`</li>
                        <li><strong>Practice Name:</strong> `%practice_name%`</li>
                    </ol>
                <div class="wm4d_select_primary">
                <h3>Single Information</h3>
                    <ol>
                        <li><strong>Doctor's Name:</strong> `%doctor_name%`</li>
                        <li><strong>Phone Number:</strong> `%phone_number%`</li>
                        <li><strong>Office Location:</strong> `%location%`</li>
                         <li><strong>Office Location:</strong> `%location_short%`</li>
                  	</ol>
                </div>
                <div class="wm4d_select_multiple">
                <h3>Multiple Information</h3>
                    <ol>
                        <li><strong>Doctors' Names:</strong>
                            <ol>
                                <li>Show all: `%doctor_names%`</li>
                                <li>Show specific Doctor's Name: `%doctor_names_#%`</li>
                            </ol>
                        </li>
                        
                        <li><strong>Phone Numbers by Location:</strong>
                            <ol>
                                <li>Show all: `%phone_numbers%`</li>
                                <li>Show specific Phone Number: `%phone_numbers_#%`</li>
                           </ol>
                        </li>
                        <li><strong>Office Locations:</strong>
                            <ol>
                                <li>Show all: `%locations%`</li>
                                <li>Show specific Location: `%locations_#%`</li>
                            </ol>
                        </li>
                  </ol>
                </div> 
                </div> 
                </div>
            </div>
        </form>
	</div>
<?php
}
?>