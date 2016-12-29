<?php header('Content-type: text/javascript');
$wm4d_multiple_select = get_option('wm4d_multiple_select');
$wm4d_map_select = get_option('wm4d_map_select');
$wm4d_map_console = get_option('wm4d_map_console');

?>
jQuery(document).ready(function($) {
	mods_home_map();
    map_select_ajax();
	jQuery('#wm4d_map_select').click(function() {
		map_select_ajax();
	});

})
function mods_home_map() {
	if( '<?=$wm4d_multiple_select;?>' == 'enable' ) {
		map_link_ajax('.map_links');
	} else {
		map_link_ajax('#map_link');
	}

}

function map_select_ajax() {
	if( '<?=$wm4d_multiple_select;?>' == 'enable' ) {
		if( jQuery('#wm4d_map_select input').attr('checked') ) {
				map_options_ajax(true, true);
			} else {
				map_options_ajax(true, false);
			}
		jQuery('.wm4d_map_text').html('Locations (Addresses or Links)');
		jQuery('.wm4d_map_text2').html('Please fill up Multiple Locations in Client Options first and click save before you edit for Custom Map Information.');
		jQuery('.wm4d_map_text3').html('<strong>CUSTOM MAP LINKS</strong> take priority over Custom Map Locations in the front end script.');
        
		jQuery("textarea[id^=wm4d_map_condition_addresses]").keyup(function () {
			var id = jQuery(this).attr("id").substr(29);
				if( '<?=$wm4d_map_console;?>' == 'enable' ) {
					console.log('wm4d_map id '+id );
				}
				var a = jQuery("#wm4d_map_condition_addresses_"+id);
				var b = jQuery("#wm4d_map_condition_addresses2_"+id);
					if( '<?=$wm4d_map_console;?>' == 'enable' ) {
						console.log('wm4d_map a '+a.attr("id") );
						console.log('wm4d_map b '+b.attr("id") );
					}
				map_conditions_ajax(a,b);
		});
	} else {
		if( jQuery('#wm4d_map_select input').attr('checked') ) {
				map_options_ajax(false, true);
			} else {
				map_options_ajax(false, false);
			}
		jQuery('.wm4d_map_text').html('Location (Address or Link)');
		jQuery('.wm4d_map_text2').html('Please fill up Location in Client Options first and click save before you edit for Custom Map Information.');
		jQuery('#wm4d_primary_options .wm4d_map_text2').html('<strong>CUSTOM MAP LINK</strong> takes priority over Custom Map Location in the front end script.');

        var a = jQuery("textarea[name=wm4d_map_condition_address]"); 
        var b = jQuery("textarea[name=wm4d_map_condition_address2]");
        map_conditions_ajax(a,b);
	}
}

function map_options_ajax(a,b) {
var option = a;
var map = b;
	if ( option == true && map == true ) {
		jQuery('div#wm4d_primary_options.map_select').hide();
		jQuery('div#wm4d_multiple_options.map_select').show();
		jQuery('div#wm4d_map_console.map_select').show();
		jQuery('div#wm4d_map_condition_select.map_select').show();
	}
	if ( option == false  && map == true ){
		jQuery('div#wm4d_primary_options.map_select').show();
		jQuery('div#wm4d_multiple_options.map_select').hide();
		jQuery('div#wm4d_map_console.map_select').show();
		jQuery('div#wm4d_map_condition_select.map_select').show();
	}
	
	if ( option == true && map == false ) {
		jQuery('.map_select').hide();
	}
	if ( option == false  && map == false ){
		jQuery('.map_select').hide();
	}
}

function map_conditions_ajax(a,b) {
    var source = a;
    var output = b;
    source.keyup(function() {
        output.text(source.val());
    });
}

function map_link_ajax(a) {
    jQuery(a).each(function() {
    	var txt = jQuery(this).text();
    	var txtlen = jQuery(this).text().length;
		var txtsub = txt.substr(0, 60);
		if( '<?=$wm4d_map_console;?>' == 'enable' ) {
			console.log('wm4d_map txt '+txt);
			console.log('wm4d_map txtlen '+txtlen );
			console.log('wm4d_map txtsub '+txtsub );
		}
		if(txtlen > 60)
			var newtxt = '<a href="'+txt+'" target="_blank">'+txtsub+'</a>';
		jQuery(this).html(newtxt);
    });	
}