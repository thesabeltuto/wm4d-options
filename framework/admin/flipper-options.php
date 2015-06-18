<?php /* Admin Flipper Options */

function WM4D_OPTIONS_PLUGIN_submenu_flipper_options() {
	WM4D_OPTIONS_PLUGIN_selection();
	if ( get_option('wm4d_phone') == '' ) $wm4d_phone='is currently empty'; else $wm4d_phone=get_option('wm4d_phone');
	if ( get_option('wm4d_phones') == '' ) $wm4d_phones='is currently empty'; else $wm4d_phones=get_option('wm4d_phones');
	if ( get_option('wm4d_phones_loc') == '' ) $wm4d_phones_loc='is currently empty'; else $wm4d_phones_loc=get_option('wm4d_phones_loc');
	if ( get_option('wm4d_flipper_referers') == '' ) $wm4d_flipper_referers=''; else $wm4d_flipper_referers=get_option('wm4d_flipper_referers');
	if ( get_option('wm4d_flipper_phone') == '' ) $wm4d_flipper_phone='is not initialized'; else $wm4d_flipper_phone=get_option('wm4d_flipper_phone');
	if ( get_option('wm4d_flipper_phones') == '' ) $wm4d_flipper_phones='is not initialized'; else $wm4d_flipper_phones=get_option('wm4d_flipper_phones');
	if ( get_option('wm4d_flipper_campaign_phone') == '' ) $wm4d_flipper_campaign_phone=''; else $wm4d_flipper_campaign_phone=get_option('wm4d_flipper_campaign_phone');
	if ( get_option('wm4d_flipper_campaign_phones') == '' ) $wm4d_flipper_campaign_phones=''; else $wm4d_flipper_campaign_phones=get_option('wm4d_flipper_campaign_phones');

	$domain = get_bloginfo( 'url' ) . "?ref=";
	$campaign = flipper_get_numbers();
?>
	<div class="wm4d_wrap">
	<h1>WM4D Options</h1>
    <div id="wm4d_nav">
        <ul>
			<?php WM4D_OPTIONS_PLUGIN_navigation(); ?>
       </ul>
    </div>
        <form method="post" action="options.php">
            <?php settings_fields( 'wm4d-flipper-group' );
                    do_settings_sections( 'wm4d-flipper-group' ); ?>
    		<div class="wm4d_content" id="wm4d_li-6">
			<h2>Flipper Options</h2>
    		<?php submit_button(); ?>
                <h2><input name="wm4d_flipper_select" type="checkbox" value="enable" <?php checked( get_option('wm4d_flipper_select') == 'enable' ); ?> /> &nbsp;
                Enable / Disable Number Flipper</h2>
                <hr />
                <p>Enabling this will replace phone numbers in your site according to referer.
                </p>
				<?php //REFERER LIST ?>
                <h2>Referer List</h2>
                <hr />
                <div class="wm4d_section table">
                <div class="wm4d_table_wrap">
                <table id="referer" border="0" cellspacing="0" cellpadding="8" class="wm4d_table_form">
                    <thead>
                        <th>ID</th>
                        <th>Referer</th>
                        <th><input type="button" class="wm4d_add wm4d_referers_add" id="wm4d_referers_add" name="wm4d_primary_add" value="+"  /></th>
                    </thead>
                <?php //print_r ($wm4d_flipper_referers);
                for($i = 0; $i < sizeof($wm4d_flipper_referers);$i++) {  $id = $i+1; ?>
                    <tr id="referer_<?=$id?>">
                        <td><input type="text" readonly="readonly" name="wm4d_referers_id" value="<?=$id?>" size="1" tabindex="-1"/></td>
                        <td><input type="text" name="wm4d_flipper_referers[]" value="<?=$wm4d_flipper_referers[$i]?>" size="48"/></td>
                        <td><input type="button" class="wm4d_remove wm4d_referer_remove" name="wm4d_referer_remove" value="-"  tabindex="-1"></td>
                    </tr>
                <?php } ?>
                </table>
                <hr/>
                <div class="wm4d_table_wrap_foot_left"><input type="button" class="wm4d_add wm4d_referers_add" id="wm4d_referers_add" name="wm4d_referers_add" value="Add Referer"  /></div>
                <div class="wm4d_table_wrap_foot_right"><input type="button" class="wm4d_add wm4d_trigger_submit" name="submit" value="Save Changes"  /></div>
                </div>
                </div>

<?php /*?>				<div class="wm4d_section home">
                <h3>OUTPUT AREA FOR TESTING</h3>
                <ol>
                    <li><strong>Referers:</strong> <?= print_r($wm4d_flipper_referers) ?></li>
					<?php if( get_option('wm4d_multiple_select') != 'enable') { ?>
                    <li><strong>Phone:</strong> <?= print_r($wm4d_phone) ?></li>
                    <li><strong>Referer Phone: (referer:campaignphone)</strong>
						<ol><li><?=  print_r($wm4d_flipper_phone) ?></li></ol></li>
                    <li><strong>campaign phone selected:</strong> 
                        <ol><li><?=print_r($wm4d_flipper_campaign_phone)?></li></ol>
					<?php } ?>
					<?php if( get_option('wm4d_multiple_select') == 'enable') { ?>
                    <li><strong>Referer Phones: (phone:referer:campaignphones)</strong>
						<ol><li><?= print_r($wm4d_flipper_phones) ?></li></ol></li>
                    <li><strong>Phones</strong>: <?= print_r($wm4d_phones) ?></li>
                    <li><strong>Phones Location:</strong> <?= print_r($wm4d_phones_loc) ?></li>
                    <li><strong>campaign phones selected:</strong> 
                        <ol><li><?=print_r($wm4d_flipper_campaign_phones)?></li></ol>
					<?php } ?>
				</ol>
                </div>
<?php */?>
				<?php //PRIMARY SELETED ?>
                <?php if( get_option('wm4d_multiple_select') != 'enable') { ?>
                <h2>Phone Numbers to Flip</h2>
                <hr />
                <div class="wm4d_section table flipnote"></div>
                <?php
                for($i = 0; $i < sizeof($wm4d_flipper_referers);$i++) {   
					$size = strlen($wm4d_phone);
                ?>              
                <div class="wm4d_section table flipnum">
                <h3>Referer: <strong><?=$wm4d_flipper_referers[$i]?></strong></h3>

                    <div class="wm4d_table_wrap">
                    <table id="primary" border="0" cellspacing="0" cellpadding="8" class="wm4d_table_form">
                        <thead>
                            <th>ID</th>
                            <th>Phone Number From</th>
                            <th>Phone Number To</th>
                       </thead>
                       <tbody>

                        <tr id="flipper1_<?=$wm4d_flipper_referers[$i]?>">
                            <td><input type="text" readonly="readonly" value="1" size="1" tabindex="-1"/></td>
                            <td><input type="text" class="phone_format" readonly="readonly" value="<?=$wm4d_phone;?>" size="<?=$size?>" tabindex="-1"/></td>
                            <td> <?php // echo $i; ?>
                            <select class="wm4d_campaigns primary_campaign" id="ref_<?=$wm4d_flipper_referers[$i]?>" name="wm4d_flipper_campaign_phone[]">
                            	<option value="">-- NO REPLACE NUMBER --</option>
                            	<?php echo get_campaign_numbers($campaign,'primary', $wm4d_flipper_campaign_phone[$i]); ?>
                            </select>
                            <input type="text" hidden="hidden" name="wm4d_flipper_phone[]" value="<?=$wm4d_flipper_referers[$i]?>:<?=$wm4d_flipper_campaign_phone[$i]?>" size="1" tabindex="-1"/>
                            </td>
                        </tr>
                    </tbody> 
                    </table>
                    <hr/>
                    <div class="wm4d_table_wrap_foot_left">Link: <input type="text" readonly="readonly" value="<?=$domain.$wm4d_flipper_referers[$i]?>" size="48"/></div>
                    <div class="wm4d_table_wrap_foot_right"><input type="button" class="wm4d_add wm4d_trigger_submit" name="submit" value="Save Changes"  /></div>
                    </div>
                    </div>
                    <?php /*?></div><?php */?>
                <?php } ?>
                    <div class="clear"></div>
                </div>
				<?php } ?>
 				<?php //MULTIPLE SELETED ?>
                <?php if( get_option('wm4d_multiple_select') == 'enable') { ?>
                <h2>Phone Numbers to Flip</h2>
                <hr />
                <?php $x=0; // count index for selected campaign phones
				for($i = 0; $i < sizeof($wm4d_flipper_referers);$i++) { ?>                
                <div class="wm4d_section table flipnum">
                <h3>Referer: <strong><?=$wm4d_flipper_referers[$i]?></strong></h3>
                    <div class="wm4d_table_wrap">
                    <table id="multiple" border="0" cellspacing="0" cellpadding="8" class="wm4d_table_form">
                        <thead>
                            <th>ID</th>
                            <th>Phone Number From</th>
                            <th>Phone Number To</th>
                        </thead>
                        <tbody>
                    <?php 
					$size = max(array_map('strlen', $wm4d_phones)) + max(array_map('strlen', $wm4d_phones_loc)) + 1;
					for($n = 0; $n < sizeof($wm4d_phones);$n++) {  $id = $n+1;
					?>
                        <tr id="flipper2_<?=$wm4d_flipper_referers[$i]?>">
                            <td><input type="text" readonly="readonly" value="<?=$id?>" size="1" tabindex="-1"/></td>
                            <td><input type="text" readonly="readonly" value="<?=$wm4d_phones[$n]." - ".$wm4d_phones_loc[$n];?>" size="<?=$size?>" tabindex="-1"/></td>
                            <td> <?php /*echo $i; ?> | <?php echo $n; ?> | <?php echo $x;*/ //output index for campaign selected ?>
                            <select class="wm4d_campaigns multiple_campaign" id="ref_<?=$wm4d_flipper_referers[$i]?>_index_<?=$id?>" name="wm4d_flipper_campaign_phones[]">
                            	<option value="">-- NO REPLACE NUMBER --</option>
                            	<?php echo get_campaign_numbers($campaign,'multiple', $wm4d_flipper_campaign_phones[$x]); ?>
                            </select>
                            <input type="text" hidden="hidden" id="wm4d_flipper_phones" name="wm4d_flipper_phones[]" value="<?=$id?>:<?=$wm4d_flipper_referers[$i]?>:<?=$wm4d_flipper_campaign_phone[$i]?>" size="1" tabindex="-1"/>
                            </td>
                        </tr>
                    <?php $x++; // increment index for selected campaign phones
					} ?> 
                    </tbody> 
                    </table>
                    <hr/>
                    <div class="wm4d_table_wrap_foot_left">Link: <input type="text" readonly="readonly" value="<?=$domain.$wm4d_flipper_referers[$i]?>" size="48"/></div>
                    <div class="wm4d_table_wrap_foot_right"><input type="button" class="wm4d_add wm4d_trigger_submit" name="submit" value="Save Changes"  /></div>
                    </div>
                    </div>
                <?php } // for referers?> 
                <div class="clear"></div>                
                </div>   
                <?php } //if multiple selected ?>
                                
      		<?php submit_button(); ?>
            </div>
        </form>
	</div>
<style>#wpfooter { position: inherit!important; }</style>
<?php
}

function get_campaign_numbers($campaign, $type, $campaign_selected) {
	$campaign = $campaign->campaigns;
	$type = $type;
	$campaign_selected = $campaign_selected;
	
		$options  = '';

		for($i = 0; $i < sizeof($campaign);$i++) {
			$phone_number = $campaign[$i]->postback_params->phone_clean;
			$campaign_phone = $campaign[$i]->postback_params->phone;
			$campaign_name = $campaign[$i]->f_cmp_name;
			if($campaign_selected == $phone_number) { 
				$options .= '<option value="'.$phone_number.'" selected>'.$campaign_phone.' - '.$campaign_name.'</option>';
			} else {
				$options .= '<option value="'.$phone_number.'">'.$campaign_phone.' - '.$campaign_name.'</option>';
			}
		}
		
	return $options;
}

?>