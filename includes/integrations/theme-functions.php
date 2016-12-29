<?php
add_action('wp_head','wm4d_datetoday');

function wm4d_datetoday() {
?>
	<script>
    (function($) {	
		$(document).ready(function() {
			var offer = $('p.datetoday').html();
			var date = new Date().toDateString();
			var fday = date.split(" ")[0];
			var month = date.split(" ")[1];
			var day = date.split(" ")[2];
			var year = date.split(" ")[3];
			var newdate =  fday+', '+month+' '+day+', '+year;
			$('p.datetoday').html(offer+' '+newdate);
	
		});
    })(jQuery);
    </script>
<?php }
?>