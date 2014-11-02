jQuery(function($) {
 
	var element_clicked = false;
  
	$('#custom_header_button').click(function() {
		var formfield = jQuery('#custom_header').attr('name');
		tb_show('', 'media-upload.php?type=image&TB_iframe=true');
		element_clicked = true;
		return custom_header_button();
	});

	function custom_header_button() {
		// Store original function
		window.original_send_to_editor = window.send_to_editor;
		
		/**
		* Override send_to_editor function from original script
		* Writes URL into the textbox.
		*
		* Note: If header is not clicked, we use the original function.
		*/
		window.send_to_editor = function(html) {
			if (element_clicked) {
				var imgurl = $('img',html).attr('src');
				
				console.log(imgurl);
				
				// do stuff here with the URL
				jQuery('#custom_header').val(imgurl);  
				
				element_clicked = false;
				tb_remove();
				$j('#custom_header_button').trigger('click');
			} else {
				window.original_send_to_editor(html);
			}
		}
	}

});