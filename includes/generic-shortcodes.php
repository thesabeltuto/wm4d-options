<?php /************ WM4D OPTIONS - Generic Shortcodes ******************/

// Allow widgets to run shortcodes
//add_filter('widget_text', 'do_shortcode');
//add_filter('the_title', 'do_shortcode');
//add_filter('the_excerpt', 'do_shortcode');
//add_filter('gform_notification', 'do_shortcode', 10, 3);
//add_filter('wp_init', 'do_shortcode')

add_shortcode( 'this_year', 'get_this_year' );	

function get_this_year( $atts ){
	$the_year = date("Y");
	return $the_year;
}

?>