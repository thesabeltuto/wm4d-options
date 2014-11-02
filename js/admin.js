jQuery(document).ready(function($) {
	jQuery('div.wm4d_content').hide();
	jQuery('div#wm4d_li-1').show();
	jQuery('#wm4d_nav li').removeClass('active');
	jQuery('#wm4d_nav li#wm4d_li1').addClass('active');
	jQuery('#wm4d_nav li').click(function() {
		var id = jQuery(this).attr('id').substr(7);
			jQuery('div.wm4d_content').hide();
			jQuery('#wm4d_nav li').removeClass('active');
			jQuery('#wm4d_nav li#wm4d_li'+id).addClass('active');
			jQuery('div.wm4d_content#wm4d_li-'+id).show();
	});
	
});