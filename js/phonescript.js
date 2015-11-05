jQuery(document).ready(function($) {
	
	jquery_check_links('');

	//responsive map
	$("div.responsive-map").click(function(event) {
		if($("div.gmap_marker").length > 0) {
			jquery_check_links("div.gmap_marker");
			$("div.responsive-map").off(event);
		}
	});
	
	function jquery_check_links(element){
		var element = element;
		
		$(element+" a[href]").each(function() {
			var orig_href = $(this).attr("href");
			var new_href = phonescripts(isMobile(), orig_href);
			$(this).attr("href",new_href);
		});
	}
});


function phonescripts(mode, teltag) {
	var mode = mode;
	var teltag = teltag;
	var new_phone = '';

	if( teltag.substr(0,4) == "tel:") {
		var phone_number = teltag.substring(4);
		
		var local = phone_number.match(/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})([ .-]?)([0-9]{4})/ig); 
		var international = phone_number.match(/^\+[0-9]{2}?([ .-]?)\(?([0-9]{3})\)?([ .-]?)([0-9]{3})([ .-]?)([0-9]{4})/ig); 
		var uk = phone_number.match(/\(?([0-9]{4})\)?([ .-]?)([0-9]{3})([ .-]?)([0-9]{4})/ig); 

		if (mode == false) {
			if (local){
				new_phone = teltag.substring(4).replace(/[^0-9]/g,"");
				new_phone = "tel:+1"+new_phone;
				//console.log("local "+new_phone);
			}
			
			if (international) {
				new_phone = teltag.substring(4).replace(/[^0-9]/g,"");
				new_phone = "tel:+"+new_phone;
				//console.log("international "+new_phone);
			}

			if (uk) {
				new_phone = teltag.substring(4).replace(/[^0-9]/g,"");
				new_phone = "tel:+44"+new_phone;
				//console.log("uk "+new_phone);
			}
		}
		
		if (mode == true) {
			new_phone = teltag.substring(4).replace(/[^0-9]/g,"");
			new_phone = "tel:"+new_phone;
			//console.log("mode "+new_phone);
		}
		
	} else {
		new_phone = teltag;
		//console.log("others "+new_phone);
	}
		
	return new_phone;
}