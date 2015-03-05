<?php	$wm4d_options_css = get_option('wm4d_options_css');
		$wm4d_options_script = get_option('wm4d_options_script');
		$wm4d_options_html = get_option('wm4d_options_html');
?>
<?php if($wm4d_options_html !='' || $wm4d_options_html != null ) echo $wm4d_options_html; ?>
<?php if($wm4d_options_css !='' || $wm4d_options_css != null ) { ?>
<style>
<?php echo $wm4d_options_css; ?>
</style>
<?php } ?>
<?php if($wm4d_options_script !='' || $wm4d_options_script != null ) { ?>
<script>
<?php echo $wm4d_options_script; ?>
</script>
<?php } ?>


<?php
/************ WM4D OPTIONS - Client Options ******************/

add_shortcode( 'client_name', 'wm4d_client' );	
add_shortcode( 'doctor_name', 'wm4d_doctor' );	
add_shortcode( 'phone_number', 'wm4d_phone' );	
add_shortcode( 'location', 'wm4d_location' );	
add_shortcode( 'doctor_names', 'wm4d_doctors' );	
add_shortcode( 'phone_numbers', 'wm4d_phones' );	
add_shortcode( 'locations', 'wm4d_locations' );	
add_shortcode( 'practice_name', 'wm4d_practice' );	

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
	$wm4d_location = get_option('wm4d_location');
	return $wm4d_location;
}


function wm4d_doctors( $atts ){
	extract(shortcode_atts(array( 'id' => '' ), $atts ));
	
	$id -=1;
	
	$wm4d_doctors = get_option('wm4d_doctors');
	$doctors = explode('*', $wm4d_doctors);
	
	if($atts =='') {
		$alldoctors = '';
		$maxdoctors = count($doctors);
		$i = 0;
	   foreach( $doctors as $d ) {
		   if ( $i == 0 ) {
			   $alldoctors .= $doctors[$i].',';
		   } else if ($i == $maxdoctors-1) {
			   $alldoctors .= $doctors[$i];
		   } else {
			   $alldoctors .= $doctors[$i].',';
			   }
		   $i++;
	   }
	   return $alldoctors;
	} else {
		return $doctors[$id];
	}
}

function wm4d_phones( $atts ){
	extract(shortcode_atts(array( 'id' => '' ), $atts ));

	$id -=1;
	
	$wm4d_phones = get_option('wm4d_phones');
	$phones = explode('*', $wm4d_phones);
	
	if($atts =='') {
		$allphones = '';
		$maxphones = count($phones);
		$i = 0;
	   foreach( $phones as $p ) {
		   if ( $i == 0 ) {
			   $allphones .= $phones[$i].',';
		   } else if ($i == $maxphones-1) {
			   $allphones .= $phones[$i];
		   } else {
			   $allphones .= $phones[$i].',';
			   }
		   $i++;
	   }
	   return $allphones;
	} else {
		return $phones[$id];
	}
}

function wm4d_locations( $atts ){
	extract(shortcode_atts(array( 'id' => '' ), $atts ));

	$id -=1;

	$wm4d_locations = get_option('wm4d_locations');
	$locations = explode('*', $wm4d_locations);
	
	if($atts =='') {
		$alllocations = '';
		$maxlocations = count($locations);
		$i = 0;
	   foreach( $locations as $l ) {
		   if ( $i == 0 ) {
			   $alllocations .= $locations[$i].',';
		   } else if ($i == $maxlocations-1) {
			   $alllocations .= $locations[$i];
		   } else {
			   $alllocations .= $locations[$i].',';
			   }
		   $i++;
	   }
	   return $alllocations;
	} else {
		return $locations[$id];
	}
}


?>