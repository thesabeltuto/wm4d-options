<?php /* Admin Dashboard Page*/

function WM4D_OPTIONS_PLUGIN_theme_options_page() {
	if ( get_option('wm4d_css') == ''  ) $cssvalue='currently <span class="empty">empty</span>'; else $cssvalue='<span class="filled">filled</span>';
	if ( get_option('wm4d_script') == ''  ) $scriptvalue='currently <span class="empty">empty</span>'; else $scriptvalue='<span class="filled">filled</span>';
	if ( get_option('wm4d_html') == ''  ) $htmlvalue='currently <span class="empty">empty</span>'; else $htmlvalue='<span class="filled">filled</span>';
	if ( get_option('wm4d_testimonials') == ''  ) $tesvalue='currently <span class="empty">empty</span>'; else $tesvalue='<span class="filled">filled</span>';
	if ( get_option('wm4d_before_afters') == ''  ) $bnavalue='currently <span class="empty">empty</span>'; else $bnavalue='<span class="filled">filled</span>';
	if ( get_option('wm4d_office_images') == ''  ) $offvalue='currently <span class="empty">empty</span>'; else $offvalue='<span class="filled">filled</span>';
	if ( get_option('wm4d_footer') == ''  ) $footvalue='currently <span class="empty">empty</span>'; else $footvalue='<span class="filled">filled</span>';
	if ( get_option('wm4d_client') == ''  ) $wm4d_client='currently <span class="empty">empty</span>'; else $wm4d_client=get_option('wm4d_client');
	if ( get_option('wm4d_doctor') == ''  ) $wm4d_doctor='currently <span class="empty">empty</span>'; else $wm4d_doctor=get_option('wm4d_doctor');
	if ( get_option('wm4d_doc_titles') == ''  ) $wm4d_doc_titles='currently <span class="empty">empty</span>'; else $wm4d_doc_titles=get_option('wm4d_doc_titles');
	if ( get_option('wm4d_phone') == ''  ) $wm4d_phone='currently <span class="empty">empty</span>'; else $wm4d_phone=get_option('wm4d_phone');
	if ( get_option('wm4d_location') == ''  ) $wm4d_location='currently <span class="empty">empty</span>'; else $wm4d_location=get_option('wm4d_location');
	if ( get_option('wm4d_doctors') == ''  ) $wm4d_doctors='is currently <span class="empty">empty</span>'; else $wm4d_doctors="are:";
	if ( get_option('wm4d_docs_titles') == ''  ) $wm4d_docs_titles='is currently <span class="empty">empty</span>'; else $wm4d_docs_titles="are:";
	if ( get_option('wm4d_phones') == ''  ) $wm4d_phones='is currently <span class="empty">empty</span>'; else $wm4d_phones="are:";
	if ( get_option('wm4d_locations') == ''  ) $wm4d_locations='is currently <span class="empty">empty</span>'; else $wm4d_locations="are:";
	if ( get_option('wm4d_practice') == ''  ) $wm4d_practice='currently <span class="empty">empty</span>'; else $wm4d_practice=get_option('wm4d_practice');
	if ( get_option('wm4d_flipper_phone') == ''  ) $wm4d_flipper_phone='currently <span class="empty">empty</span>'; else $wm4d_flipper_phone='<span class="filled">filled</span>';
	if ( get_option('wm4d_flipper_phones') == ''  ) $wm4d_flipper_phones='currently <span class="empty">empty</span>'; else $wm4d_flipper_phones='<span class="filled">filled</span>';
	if ( get_option('wm4d_flipper_select') == '' ) $wm4d_flipper_select='currently <span class="empty">disabled</span>'; else $wm4d_flipper_select='<span class="filled">enabled</span>';
	if ( get_option('wm4d_functions_select') == '' ) $wm4d_functions_select='currently <span class="empty">disabled</span>'; else $wm4d_functions_select='<span class="filled">enabled</span>';
	if ( get_option('wm4d_multiple_select') == '' ) $wm4d_multiple_select='<span class="filled">Single Information</span>'; else $wm4d_multiple_select='<span class="filled">Multiple Information</span>';
	if ( get_option('wm4d_phone_format_select') == '' ) $wm4d_phone_format_select='<span class="filled">Standard Format</span>'; else $wm4d_phone_format_select='<span class="filled">International Format</span>';
	if ( get_option('wm4d_flipper_referers') == '' ) $wm4d_flipper_referers='is currently <span class="empty">empty</span>'; else $wm4d_flipper_referers="includes:";
	if ( get_option('wm4d_flipper_campaign_phone') == ''  ) $wm4d_flipper_campaign_phone='currently <span class="empty">empty</span>'; else $wm4d_flipper_campaign_phone='<span class="filled">filled</span>';
	if ( get_option('wm4d_flipper_campaign_phones') == ''  ) $wm4d_flipper_campaign_phones='currently <span class="empty">empty</span>'; else $wm4d_flipper_campaign_phones='<span class="filled">filled</span>';
	?>
	<div class="wm4d_wrap">
	<h1>WM4D Options</h1>
    <div id="wm4d_nav">
        <ul>
			<?php WM4D_OPTIONS_PLUGIN_navigation(); ?>
       </ul>
    </div>
		<div class="wm4d_content" id="wm4d_li-0">
			<h2>Welcome to the WM4D Options plugin.</h2>
            <br />
            
            <div class="wm4d_section home links">
            <h3>Please select the following to proceed:</h3>
				<ol>
					<?php WM4D_OPTIONS_PLUGIN_home_navigation(); ?>
				</ol>
            </div>

            <div class="wm4d_section home">
            <h3>Client Options</h3>
               <ol>
                    <li>Client's Name is <?=$wm4d_client; ?>.</li>
                    <li>Practice Name is <?=$wm4d_practice; ?>.</li>
                    <li>Currently Active: <?=$wm4d_multiple_select; ?>.</li>
                    <li>Phone Format is <?=$wm4d_phone_format_select; ?>.</li>
                    <?php if ( get_option('wm4d_multiple_select') != 'enable' ) { ?>
                    <li>Doctor's Name with Titles:<br /> <?=$wm4d_doctor.', '.$wm4d_doc_titles; ?>.</li>
                    <li>Phone Number is <?=$wm4d_phone; ?>.</li>
                    <li>Office Location is:<br /><?=nl2br($wm4d_location); ?>.</li>
                    <?php } ?>
                    <?php if ( get_option('wm4d_multiple_select') == 'enable' ) { ?>
                    <li>Doctors' Names with Titles <?=$wm4d_doctors;
						$doctors = get_option('wm4d_doctors');
						$titles = get_option('wm4d_docs_titles');
					   if($doctors != '') {
						   echo '<ol>';
						   for($i = 0; $i < sizeof($doctors);$i++) {
							   echo '<li>'.$doctors[$i].', '.$titles[$i].'</li>';
						   }
						   echo '</ol>';
					   }
                       ?>
                    </li>
                    <li>Phone Numbers by Location <?=$wm4d_phones; 
						$phones = get_option('wm4d_phones');
						$locations = get_option('wm4d_phones_loc');
						if($phones != '') {
							echo '<ol>';
							$phonelocation = array();
							for($i = 0; $i < sizeof($phones);$i++) {
								echo '<li>Call '.$phones[$i].' ('.$locations[$i].')</li>';
							}
							echo '</ol>';
						}
					?>
                    </li>
                    <li>Office Locations <?=$wm4d_locations; 
						$locations = get_option('wm4d_locations');
					   if($locations != '') {
						   echo '<ol>';
						   for($i = 0; $i < sizeof($locations);$i++) {
							   echo '<li>'.nl2br($locations[$i]).'</li>';
						   }
						   echo '</ol>';
					   }
					?>
                    </li>
                    <?php } ?>
               </ol>               
            </div>            
            
            <div class="wm4d_section home">
            <h3>Flipper Options</h3>
               <ol>
                    <li>Number Flipper is <?=$wm4d_flipper_select . '.';
					if( get_option('wm4d_flipper_select') != '') {?>
                    <li>Referer List is <?=$wm4d_flipper_referers;
						$referers = get_option('wm4d_flipper_referers');
						if($referers != '') {
							echo '<ol>';
							for($i = 0; $i < sizeof($referers);$i++) {
								echo '<li>'.$referers[$i].'</li>';
							}
							echo '</ol>';
						}
					?>
                    </li>
                    <?php /* if ( get_option('wm4d_multiple_select') != 'enable' ) { ?>
                        <li>Single Information <?php //$wm4d_flipper_campaign_phone . '.';
                            $referers = get_option('wm4d_flipper_referers');
                            $flipphone = get_option('wm4d_flipper_phone');
                            $campaign = get_option('wm4d_flipper_campaign_phone');
                            if($campaign != '') {
                                echo '<ol>';
                                for($i = 0; $i < sizeof($campaign);$i++) {
                                    echo '<li>Flip to '.$campaign[$i].' when referer is '.$referers[$i].'.</li>';
                                }
                                echo '</ol>';
                            }
                        ?>
                        </li>
                    <?php } ?>
                    <?php if ( get_option('wm4d_multiple_select') == 'enable' ) { ?>
                        <li>Multiple Information <?php //$wm4d_flipper_campaign_phones . '.';
                            $referer = get_option('wm4d_flipper_referers');
                            $phones = get_option('wm4d_phones');
                            $flipphones = get_option('wm4d_flipper_phones');
                            $campaign = get_option('wm4d_flipper_campaign_phones');
                            if($campaign != '') {
                                echo '<ol>';
                                for($n = 0; $n < sizeof($campaign);$n++) {
										echo '<li>'.$phones[$n].' flip to '.$campaign[$n].' ('.$referer[$n].')</li>';
                                }
                                echo '</ol>';
                            }
                            ?>
                        </li>
                    <?php
					} */
				   	?>
                    </li>
                    <?php } ?>
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
            <h3>Page Options</h3>
                <ol>
                    <li>WM4D Functions are <?=$wm4d_functions_select; ?>.</li>
                    <li>Before and Afters Page Text is <?=$bnavalue; ?>.</li>
                    <li>Testimonials Page Text is <?=$tesvalue; ?>.</li>
                    <li>Office Images Page Text is <?=$offvalue; ?>.</li>
               </ol>
            </div>            
 
            <div class="wm4d_section home">
            <h3>Shortcodes</h3>
                <ol>
                    <li>Client's Name: `[client_name]`</li>
                    <li>Practice Name: `[practice_name]`</li>
                    <?php if ( get_option('wm4d_multiple_select') != 'enable' ) { ?>
                    <li>Doctor's Name: `[doctor_name]`</li>
                    <li>Doctor's Name with Titles: `[doctor_name title="true"]`</li>
                    <li>Phone Number: `[phone_number]`</li>
                    <li>Office Location: `[location]`</li>
                    <li>Office Location Short: `[location short="true"]`</li>
                    <?php } ?>
                    <?php if ( get_option('wm4d_multiple_select') == 'enable' ) { ?>
                    <li>Doctors' Names:
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
                    
                    <li>Phone Numbers by Location:
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
                    <li>Office Locations:
                        <ol>
                            <li>Show all: `[locations]`</li>
                            <li>Show all short locations: `[locations short="true"]`</li>
                            <li>Show all in a sentence: `[locations and="true"]`</li>
                            <li>Show all short locations in a sentence: `[locations short="true" and="true"]`</li>
                            <li>Show specific Location: `[locations  id="#"]`</li>
                            <li>Show specific Short location: `[locations  id="#" short="true" ]`</li>
                            <li>Show number of locations: `[locations count="true"]`</li>
                        </ol>
                    </li>
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
?>