<?php header('Content-type: text/javascript');
$wm4d_phone=get_option('wm4d_phone');
$wm4d_phones=get_option('wm4d_phones');
$locations=get_option('wm4d_phones_loc');
$select_options=get_multiple_phones_beta($wm4d_phones,$locations, '');
$phone_format=get_option('wm4d_phone_format_select');
?>
jQuery(document).ready(function($) {
	add_referers();
	remove_referers();
	remove_on_save();
    remove_all_data();
    convert_phone_format();
});


function remove_all_data() {
    jQuery('input#wm4d_delete').on('click', function() {
            jQuery('tr[id^="primary_"]').parent().parent().remove();
            jQuery('tr[id^="multiple_"]').parent().parent().remove();
            jQuery('input[name="wm4d_testing_select"]').val('');
    });
}

function add_referers() {
	//ANY OPTIONS | REFERERS
    jQuery('input.wm4d_referers_add').click(function() {
    //alert('click');
		var tr_max = jQuery('tr[id^="referers_"]').length + 1;
		var tr_wrap = '<tr id="referers__TBA'+tr_max+'">';
		var id = '<td><input type="text" readonly="readonly" name="wm4d_referers_id" value="TBA" size="1"  tabindex="-1"/></td>';
		var doctors = '<td><input type="text" name="wm4d_referers[]"  size="48" /></td>';
		var remove = '<td><input type="button" class="wm4d_remove wm4d_doctors_remove" name="wm4d_doctors_remove" value="-"  tabindex="-1"/></td>';
	
		tr_wrap +=id;
		tr_wrap +=doctors;
		tr_wrap +=remove;
		tr_wrap += '</tr>';
	        
		jQuery('table#doctors').append(tr_wrap);

        convert_phone_format();
		remove_referers();
	});
 

	//MULTIPLE OPTIONS | DOCTORS
    jQuery('input.wm4d_doctors_add').click(function() {
    //alert('click');
		var tr_max = jQuery('tr[id^="doctors_"]').length + 1;
		var tr_wrap = '<tr id="doctors_TBA'+tr_max+'">';
		var id = '<td><input type="text" readonly="readonly" name="wm4d_doctors_id" value="TBA" size="1"  tabindex="-1"/></td>';
		var doctors = '<td><input type="text" name="wm4d_doctors[]"  size="48" /></td>';
		var remove = '<td><input type="button" class="wm4d_remove wm4d_doctors_remove" name="wm4d_doctors_remove" value="-"  tabindex="-1"/></td>';
	
		tr_wrap +=id;
		tr_wrap +=doctors;
		tr_wrap +=remove;
		tr_wrap += '</tr>';
	        
		jQuery('table#doctors').append(tr_wrap);

        convert_phone_format();
		remove_referers();
	});
    
	//MULTIPLE OPTIONS | PHONES
    jQuery('input.wm4d_phones_add').click(function() {
    //alert('click');
		var tr_max = jQuery('tr[id^="phones_"]').length + 1;
		var tr_wrap = '<tr id="phones_TBA'+tr_max+'">';
		var id = '<td><input type="text" readonly="readonly" name="wm4d_phones_id" value="TBA" size="1"  tabindex="-1"/></td>';
		var phones = '<td><input type="text" class="phone_format" name="wm4d_phones[]" /></td>';
		var locations = '<td><input type="text" name="wm4d_phones_loc[]" /></td>';
		var remove = '<td><input type="button" class="wm4d_remove wm4d_phones_remove" name="wm4d_phones_remove" value="-"  tabindex="-1"/></td>';
	
		tr_wrap +=id;
		tr_wrap +=phones;
		tr_wrap +=locations;
		tr_wrap +=remove;
		tr_wrap += '</tr>';
	        
		jQuery('table#phones').append(tr_wrap);

        convert_phone_format();
		remove_referers();
	});

	//MULTIPLE OPTIONS | LOCATIONS
    jQuery('input.wm4d_locations_add').click(function() {
    //alert('click');
		var tr_max = jQuery('tr[id^="locations_"]').length + 1;
		var tr_wrap = '<tr id="locations_TBA'+tr_max+'">';
		var id = '<td><input type="text" readonly="readonly" name="wm4d_locations_id" value="TBA" size="1"  tabindex="-1"/></td>';
		var locations = '<td><textarea name="wm4d_locations[]" cols="48" rows="4" value=""></textarea></td>';
		var remove = '<td><input type="button" class="wm4d_remove wm4d_locations_remove" name="wm4d_locations_remove" value="-"  tabindex="-1"/></td>';
	
		tr_wrap +=id;
		tr_wrap +=locations;
		tr_wrap +=remove;
		tr_wrap += '</tr>';
	        
		jQuery('table#locations').append(tr_wrap);

        convert_phone_format();
		remove_referers();
	});

	//PRIMARY REFERER
    jQuery('input.wm4d_primary_add').click(function() {
    //alert('click');
		var tr_max = jQuery('tr[id^="primary_"]').length + 1;
		var tr_wrap = '<tr id="primary_TBA'+tr_max+'">';
		var id = '<td><input type="text" readonly="readonly" name="wm4d_primary_id" value="TBA" size="1"  tabindex="-1"></td>';
		var phonefrom = '<td><input type="text" readonly="readonly" name="wm4d_phone" value="<?= $wm4d_phone ?>"  tabindex="-1"></td>';
		var referer = '<td><input type="text" name="wm4d_primary_referer[]" ></td>';
		var phoneto = '<td><input type="text" class="phone_format" name="wm4d_primary_phone[]"></td>';
		var remove = '<td><input type="button" class="wm4d_remove wm4d_primary_remove" name="wm4d_primary_remove" value="-"  tabindex="-1"></td>';
	
		tr_wrap +=id;
		tr_wrap +=phonefrom;
		tr_wrap +=referer;
		tr_wrap +=phoneto;
		tr_wrap +=remove;
		tr_wrap += '</tr>';
	        
		jQuery('table#primary').append(tr_wrap);

        convert_phone_format();
		remove_referers();
	});
	
	//MULTIPLE REFERER
    jQuery('input.wm4d_multiple_add').click(function() {
    //alert('click');
		var tr_max = jQuery('tr[id^="multiple_"]').length + 1;
		var tr_wrap = '<tr id="multiple_TBA'+tr_max+'">';
		var id = '<td><input type="text" readonly="readonly" name="wm4d_multiple_id" value="TBA" size="1"  tabindex="-1"></td>';
		var phonefrom = '<td><select id="wm4d_multiple_selected_phone" name="wm4d_multiple_selected_phone[]"><?=$select_options ?></select></td>';
		var referer = '<td><input type="text" name="wm4d_multiple_referer[]" ></td>';
		var phoneto = '<td><input type="text" class="phone_format" name="wm4d_multiple_phone[]"></td>';
		var remove = '<td><input type="button" class="wm4d_remove wm4d_multiple_remove" name="wm4d_multiple_remove" value="-"  tabindex="-1"></td>';        
        
		tr_wrap += id;
		tr_wrap += phonefrom;
		tr_wrap += referer;
		tr_wrap += phoneto;
		tr_wrap += remove;
		tr_wrap += '</tr>';

		jQuery('table#multiple').append(tr_wrap);
        
        convert_phone_format();
		remove_referers();
	});
}

function remove_referers() {
	//MULTIPLE OPTIONS | DOCTORS
	jQuery('input.wm4d_doctors_remove').click(function() {
        if( jQuery('table#doctors tr').length == 2 ) {
            jQuery(this).parent().prev().children().val('');
        }	else { 
            jQuery(this).parent().parent().remove();
        }
	});

	//MULTIPLE OPTIONS | PHONES
	jQuery('input.wm4d_phones_remove').click(function() {
        if( jQuery('table#phones tr').length == 2 ) {
            jQuery(this).parent().prev().children().val('');
        }	else { 
            jQuery(this).parent().parent().remove();
        }
	});

	//MULTIPLE OPTIONS | LOCATIONS
	jQuery('input.wm4d_locations_remove').click(function() {
        if( jQuery('table#locations tr').length == 2 ) {
            jQuery(this).parent().prev().children().val('');
        }	else { 
            jQuery(this).parent().parent().remove();
        }
	});

	//PRIMARY REFERER
	jQuery('input.wm4d_primary_remove').click(function() {
        if( jQuery('table#primary tr').length == 2 ) {
            jQuery(this).parent().prev().children().val('');
            jQuery(this).parent().prev().prev().children().val('');
        }	else { 
            jQuery(this).parent().parent().remove();
        }
	});

	//MULTIPLE REFERER
	jQuery('input.wm4d_multiple_remove').click(function() {
        if( jQuery('table#multiple tr').length == 2 ) {
            jQuery(this).parent().prev().children().val('');
            jQuery(this).parent().prev().prev().children().val('');
        }	else { 
            jQuery(this).parent().parent().remove();
        }
	});
}

function remove_on_save() {
	jQuery('input[type="submit"]').on('click', function() {

	//PRIMARY REFERER
		jQuery('tr[id^="primary_"]').each(function() {
			var referer = jQuery(this).children().next().next().children().val();
			var phone = jQuery(this).children().next().next().next().children().val();
			var id = jQuery(this).attr('id');
			if(referer == '') {
				jQuery(this).remove();
			}
			if(phone == '') {
				jQuery(this).remove();
			}
		});

	//MULTIPLE REFERER
		jQuery('tr[id^="multiple_"]').each(function() {
			var referer = jQuery(this).children().next().next().children().val();
			var phone = jQuery(this).children().next().next().next().children().val();
			var id = jQuery(this).attr('id');
			if(referer == '') {
				jQuery(this).remove();
			}
			if(phone == '') {
				jQuery(this).remove();
			}
		});

	//MULTIPLE DOCTORS
		jQuery('tr[id^="doctors_"]').each(function() {
			var doctor = jQuery(this).children().next().children().val();
			var id = jQuery(this).attr('id');
			if(doctor == '') {
				jQuery(this).remove();
			}
		});

	//MULTIPLE PHONES
		jQuery('tr[id^="phones_"]').each(function() {
			var phones = jQuery(this).children().next().children().val();
			var location = jQuery(this).children().next().next().next().children().val();
			var id = jQuery(this).attr('id');
			if(phones == '') {
				jQuery(this).remove();
			}
			if(location == '') {
				jQuery(this).remove();
			}
		});

	//MULTIPLE LOCATIONS
		jQuery('tr[id^="locations_"]').each(function() {
			var locations = jQuery(this).children().next().children().val();
			var id = jQuery(this).attr('id');
			if(locations == '') {
				jQuery(this).remove();
			}
		});

	});

}

function convert_phone_format() {
	jQuery('#wm4d_select_phone_format').click(function() {
        if( jQuery('input#wm4d_phone_format_select').attr('checked') )  {
           jQuery('input.phone_format').each(function() { 
                jQuery(this).mask("+99 (999) 999-9999");
            });
        } else {
            jQuery('input.phone_format').each(function() { 
                jQuery(this).mask("(999) 999-9999");
            });
        }
	});
    
	if ( '<?=$phone_format?>' == 'enable') {
        jQuery('input.phone_format').each(function() { 
            jQuery(this).mask("+99 (999) 999-9999");
        });
    } else {
        jQuery('input.phone_format').each(function() { 
            jQuery(this).mask("(999) 999-9999");
        });
    }
}