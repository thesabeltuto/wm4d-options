<?php header('Content-type: text/javascript');
$wm4d_multiple_select = get_option('wm4d_multiple_select');
$wm4d_map_select = get_option('wm4d_map_select');

?>
jQuery(document).ready(function($) {
    map_select_ajax();
	jQuery('#wm4d_map_select').click(function() {
		map_select_ajax();
	});
    
})

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
        
	} else {
		if( jQuery('#wm4d_map_select input').attr('checked') ) {
				map_options_ajax(false, true);
			} else {
				map_options_ajax(false, false);
			}
		jQuery('.wm4d_map_text').html('Location (Address or Link)');
		jQuery('.wm4d_map_text2').html('Please fill up Location in Client Options first and click save before you edit for Custom Map Information.');
		jQuery('#wm4d_primary_options .wm4d_map_text2').html('<strong>CUSTOM MAP LINK</strong> takes priority over Custom Map Location in the front end script.');
	}
}

function map_options_ajax(a,b) {
var option = a;
var map = b;
	if ( option == true && map == true ) {
		jQuery('div#wm4d_primary_options.map_select').hide();
		jQuery('div#wm4d_multiple_options.map_select').show();
	}
	if ( option == false  && map == true ){
		jQuery('div#wm4d_primary_options.map_select').show();
		jQuery('div#wm4d_multiple_options.map_select').hide();
	}
	
	if ( option == true && map == false ) {
		jQuery('.map_select').hide();
	}
	if ( option == false  && map == false ){
		jQuery('.map_select').hide();
	}
}