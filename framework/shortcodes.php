<?php /************ WM4D OPTIONS - Shortcodes ******************/

// Allow widgets to run shortcodes
add_filter('widget_text', 'do_shortcode');
add_filter('the_title', 'do_shortcode');
add_filter('the_excerpt', 'do_shortcode');
//add_filter('gform_notification', 'do_shortcode', 10, 3);
//add_filter('wp_init', 'do_shortcode')

add_shortcode( 'text_before_afters', 'wm4d_before_afters' );	
add_shortcode( 'text_testimonials', 'wm4d_testimonials' );	
add_shortcode( 'text_office_images', 'wm4d_office_images' );

add_shortcode( 'client_name', 'wm4d_client' );	
add_shortcode( 'practice_name', 'wm4d_practice' );	

if ( get_option('wm4d_multiple_select') != 'enable' ) {
	add_shortcode( 'doctor_name', 'wm4d_doctor' );	
	add_shortcode( 'phone_number', 'wm4d_phone' );	
	add_shortcode( 'location', 'wm4d_location' );	
}

if ( get_option('wm4d_multiple_select') == 'enable' ) {
	add_shortcode( 'doctor_names', 'wm4d_doctors' );	
	add_shortcode( 'phone_numbers', 'wm4d_phones' );	
	add_shortcode( 'locations', 'wm4d_locations' );	
}

function wm4d_before_afters( $atts ){
	$wm4d_before_afters = get_option('wm4d_before_afters');
	return $wm4d_before_afters;
}

function wm4d_testimonials( $atts ){
	$wm4d_testimonials = get_option('wm4d_testimonials');
	return $wm4d_testimonials;
}

function wm4d_office_images( $atts ){
	$wm4d_office_images = get_option('wm4d_office_images');
	return $wm4d_office_images;
}

function wm4d_client( $atts ){
	$wm4d_client = get_option('wm4d_client');
	return $wm4d_client;
}

function wm4d_doctor( $atts ){
	$wm4d_doctor = get_option('wm4d_doctor');
	return $wm4d_doctor;
}

function wm4d_phone( $atts ){
	$wm4d_phone = get_option('wm4d_phone');
	return $wm4d_phone;
}

function wm4d_location( $atts ){
	$wm4d_location = nl2br(get_option('wm4d_location'));
	return $wm4d_location;
}

function wm4d_doctors( $atts ){
	extract(shortcode_atts(array( 'id' => '' ), $atts ));
	
	$id -=1;
	
	$doctors = get_option('wm4d_doctors');
	
	if($atts =='') {
		$alldoctors = '';
		$maxdoctors = count($doctors);
		$i = 0;
	   foreach( $doctors as $d ) {
		   if ( $i == 0 ) {
			   $alldoctors .= $doctors[$i].', ';
		   } else if ($i == $maxdoctors-1) {
			   $alldoctors .= $doctors[$i];
		   } else {
			   $alldoctors .= $doctors[$i].', ';
			   }
		   $i++;
	   }
	   return $alldoctors;
	} else {
		return $doctors[$id];
	}
}

function wm4d_phones( $atts ){
	extract(shortcode_atts(array( 'id' => '', 'only' => ''), $atts ));

	$phonesdata = get_option('wm4d_phones');
	$phonesdata_loc = get_option('wm4d_phones_loc');
	$phonelocation = array();
	
	$array_id = $id -1;
	
	$allphones = '';
	$maxphones = count($phonesdata);
	$i = 0;
	foreach( $phonesdata as $p ) {
		$n = $i+1;
		
		if ( $i == 0 ) {
		   $allphones .= $phonesdata[$i].' - '.$phonesdata_loc[$i].', ';
		} elseif ($i == $maxphones-1) {
		   $allphones .= $phonesdata[$i].' - '.$phonesdata_loc[$i].'';
		} else {
		   $allphones .= $phonesdata[$i].' - '.$phonesdata_loc[$i].', ';
		}
		$i++;
	}

	if($id == '' ) {
		return $allphones;
	}
	if( $only == 'phone') {
	   return $phonesdata[$array_id];
	}
	if( $only == 'location') {
	   return $phonesdata_loc[$array_id];
	}
	
	else {
		return $phonesdata[$array_id].' - '.$phonesdata_loc[$array_id];
	}
}

function wm4d_locations( $atts ){
	extract(shortcode_atts(array( 'id' => '' ), $atts ));

	$id -=1;

	$locations = get_option('wm4d_locations');
	
	if($atts =='') {
		$alllocations = '';
		$maxlocations = count($locations);
		$i = 0;
	   foreach( $locations as $l ) {
		   if ( $i == 0 ) {
			   $alllocations .= nl2br($locations[$i]).', ';
		   } else if ($i == $maxlocations-1) {
			   $alllocations .= nl2br($locations[$i]);
		   } else {
			   $alllocations .= nl2br($locations[$i]).', ';
			   }
		   $i++;
	   }
	   return $alllocations;
	} else {
		return nl2br($locations[$id]);
	}
}

function wm4d_practice( $atts ){
	$wm4d_practice = get_option('wm4d_practice');
	return $wm4d_practice;
}
?>