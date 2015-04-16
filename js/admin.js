jQuery(document).ready(function($) {
	multiple_select();
	jQuery('#wm4d_select_options').click(function() {
		multiple_select();
	});
});

function multiple_select() {
	if( jQuery('#wm4d_select_options input').attr('checked') ) {
		jQuery('div#wm4d_primary_options').hide();
		jQuery('div#wm4d_multiple_options').show();
		jQuery('.wm4d_select_primary').hide();
		jQuery('.wm4d_select_multiple').show();
	} else {
		jQuery('div#wm4d_primary_options').show();
		jQuery('div#wm4d_multiple_options').hide();
		jQuery('.wm4d_select_primary').show();
		jQuery('.wm4d_select_multiple').hide();
	}
	
//	if( jQuery('#wm4d_select_options_flipper input').attr('value') == 'primary' ) {
//		jQuery('.wm4d_select_primary').show();
//		jQuery('.wm4d_select_multiple').hide();
//	}
//	if( jQuery('#wm4d_select_options_flipper input').attr('value') == 'multiple' ) {
//		jQuery('.wm4d_select_primary').hide();
//		jQuery('.wm4d_select_multiple').show();
//	}
}