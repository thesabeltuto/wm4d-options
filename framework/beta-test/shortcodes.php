<?php /************ WM4D OPTIONS - Shortcodes ******************/

$beta_on = get_option('wm4d_testing_select');

// Allow widgets to run shortcodes
add_filter('widget_text', 'do_shortcode');

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


function wm4d_doctors( $atts ){
	extract(shortcode_atts(array( 'id' => '' ), $atts ));
	
	$id -=1;
	
	$wm4d_doctors = get_option('wm4d_doctors');
	
	if($atts =='') {
		$alldoctors = '';
		$maxdoctors = count($wm4d_doctors);
		$i = 0;
	   foreach( $wm4d_doctors as $d ) {
		   if ( $i == 0 ) {
			   $alldoctors .= $wm4d_doctors[$i].', ';
		   } else if ($i == $maxdoctors-1) {
			   $alldoctors .= $wm4d_doctors[$i];
		   } else {
			   $alldoctors .= $wm4d_doctors[$i].', ';
			   }
		   $i++;
	   }
	   return $alldoctors;
	} else {
		return $wm4d_doctors[$id];
	}
}

function wm4d_phones( $atts ){
	extract(shortcode_atts(array( 'id' => '', 'only' => ''), $atts ));

	$wm4d_phones = get_option('wm4d_phones');
	$wm4d_phones_loc = get_option('wm4d_phones_loc');

	$array_id = $id -1;
	
	$allphones = '';
	$maxphones = count($wm4d_phones);
	$i = 0;
	foreach( $wm4d_phones as $p ) {
		if ( $i == 0 ) {
		   $allphones .= $wm4d_phones[$i].' ('.$wm4d_phones_loc[$i].'), ';
		} elseif ($i == $maxphones-1) {
		   $allphones .= $wm4d_phones[$i].' ('.$wm4d_phones_loc[$i].')';
		} else {
		   $allphones .= $wm4d_phones[$i].' ('.$wm4d_phones_loc[$i].'), ';
		}
		$i++;
	}

	if($id == '' ) {
		return $allphones;
	}
	if( $only == 'phone') {
	   return $wm4d_phones[$array_id];
	}
	if( $only == 'location') {
	   return $wm4d_phones_loc[$array_id];
	}
	
	else {
		return $wm4d_phones[$array_id].' ('.$wm4d_phones_loc[$array_id].')';
	}
}

function wm4d_locations( $atts ){
	extract(shortcode_atts(array( 'id' => '' ), $atts ));

	$id -=1;

	$wm4d_locations = get_option('wm4d_locations');
	
	if($atts =='') {
		$alllocations = '';
		$maxlocations = count($wm4d_locations);
		$i = 0;
	   foreach( $wm4d_locations as $l ) {
		   if ( $i == 0 ) {
			   $alllocations .= $wm4d_locations[$i].', ';
		   } else if ($i == $maxlocations-1) {
			   $alllocations .= $wm4d_locations[$i];
		   } else {
			   $alllocations .= $wm4d_locations[$i].', ';
			   }
		   $i++;
	   }
	   return $alllocations;
	} else {
		return $wm4d_locations[$id];
	}
}


?>