<?php // Flipper Data Match Framework. Just Reference Codes Here.

// Currently Outputs to WM4D-Options Home and Filler Options Pages.

// get data
$wm4d_phone=get_option('wm4d_phone');
$wm4d_phones=get_option('wm4d_phones');
$wm4d_flipper_phone=get_option('wm4d_flipper_phone');
$wm4d_flipper_phones=get_option('wm4d_flipper_phones');
 
// get referer url
$referer_url = $_SERVER['HTTP_REFERER'];
$referer_host = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);

// get data functions

// get phones by location
function get_phones($x) {
	$wm4d_phones = $x;
	$phonesbylocation = explode('<br />', nl2br($wm4d_phones));
	$phones = array();
		for($i = 0; $i < sizeof($phonesbylocation);$i++) {
			$splitdata = explode(':', $phonesbylocation[$i]);
			$id = $i+1;
			$data = array( 
				'id' => $i,
				'phoneid' => $id,
				'phone' => $splitdata[0],
				'location' => $splitdata[1]
			);
			array_push($phones, $data);
			//echo $phones[$i]['phone'].' ('.$phones[$i]['location'].')<br />';
		}
	return $phones;
}

// get flipper for main phone
function get_flip_phone($x) {
	$wm4d_flipper_phone = $x;
	$flipper_phone = explode('<br />', nl2br($wm4d_flipper_phone));
	$flip_phone = array();
		for($i = 0; $i < sizeof($flipper_phone);$i++) {
			$splitdata = explode(':', $flipper_phone[$i]);
			$id = $i+1;
			$data = array( 
				'id' => $i,
				'phoneid' => $id,
				'referer' => $splitdata[0],
				'phone' => $splitdata[1]
			);
			array_push($flip_phone, $data);
			//echo $flip_phone[$i]['phone'].' ('.$flip_phone[$i]['referer'].')<br />';
		}
	return $flip_phone;
}

// get flipper for multiple phones
function get_flip_phones() {
	$flipper_phones = explode('<br />', nl2br($wm4d_flipper_phones));
	$flip_phones = array();
		for($i = 0; $i < sizeof($flipper_phones);$i++) {
			$splitdata = explode(':', $flipper_phones[$i]);
			$id = $i+1;
			$data = array( 
				'id' => $i,
				'phoneid' => $splitdata[0],
				'referer' => $splitdata[1],
				'phone' => $splitdata[2]
			);
			array_push($flip_phones, $data);
			//echo $flip_phones[$i]['phoneid'].' ('.$flip_phones[$i]['referer'].') '.$flip_phones[$i]['phone'].'<br />';
		}
	
}

// get referer url function
function get_referer($host) {
	if( preg_match('/google.com/', $host) )
		$domain = 'google';
	
	elseif( preg_match('/youtube.com/', $host) )
		$domain = 'youtube';
	
	elseif( preg_match('/yahoo.com/', $host) )
		$domain = 'yahoo';
	
	elseif( preg_match('/bing.com/', $host) )
		$domain = 'bing';
	
	elseif( preg_match('/instagram.com/', $host) )
		$domain = 'instagram';

	elseif( preg_match('/twitter.com/', $host) )
		$domain = 'twitter';

	elseif( preg_match('/tumblr.com/', $host) )
		$domain = 'tumblr';
	
	elseif( preg_match('/localhost/', $host) )
		$domain = 'localhost';

	elseif( preg_match('/wm4d.com/', $host) )
		$domain = 'wm4d';

	elseif( empty($host) )
		$domain = '';

	else 
		$domain = $host;

	return $domain;
}

//run flipper function main action function
function run_flipper($x) {
	
	$referer =  $x;
	
	// match data for multiple phone numbers to flip
	for($n = 0; $n < sizeof($phones);$n++) {
		$get_phone_id = $phones[$n]['id'];
		$get_phone_number = $phones[$n]['phone'];
			
		for($i = 0; $i < sizeof($flip_phones);$i++) {
			$flip_phone_id  = $flip_phones[$i]['id'];
			$flip_phone_number = $flip_phones[$i]['phoneid'];
			
			if ( $get_phone_id == $flip_phone_id ) {
				//echo $get_phone_number.' > '.$flip_phones[$i]['referer'].' > '.$flip_phones[$i]['phone'].'<br />';
				if ( $get_phone_id == $phoneid ) {
					// script here
				}
			}
		}
	}
		
}

?>
