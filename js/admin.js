jQuery(document).ready(function($) {
	multiple_select();
	jQuery('#wm4d_select_options').click(function() {
		//console.log('wm4d_select_options');
		multiple_select();
	});
	
	flipper_select();
	jQuery('#wm4d_flipper_select').click(function() {
		flipper_select();
	});
	
	phone_format_select()
	jQuery('#wm4d_select_phone_format').click(function() {
		console.log("wm4d_select_phone_format");
		phone_format_select();
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
}

function flipper_select() {
	if( jQuery('#wm4d_flipper_select input').attr('checked') ) {
		jQuery('.flipper_select').show();
	} else {
		jQuery('.flipper_select').hide();
	}
}

function phone_format_select() {
	if( jQuery('#wm4d_select_phone_format input').attr('checked') ) {
		jQuery('.phone_selections').show();
	} else {
		jQuery('.phone_selections').hide();
	}
}

