jQuery(document).ready(function($) {
	$("a[href]").each(function() {
		var orig_href = $(this).attr("href");
			if( orig_href.substr(0,4) == "tel:") {
				var new_href = orig_href.substring(4).replace(/[^0-9]/g,"");
				$(this).attr("href", "tel:"+new_href);
			}
	});
});