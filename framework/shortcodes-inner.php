<?php
/* USE SHORTCODE IN MENU */
add_filter( 'wp_nav_menu_objects', 'wm4d_dynamic_menu_items' );

function wm4d_dynamic_menu_items( $menu_items ) {
    foreach ( $menu_items as $menu_item ) {
		$title = $menu_item->title;
        if ( preg_match('%client_name%', $title) ) {
			$title = get_general_data('client_name', $title);
        }
        if ( preg_match('%practice_name%', $title) ) {
			$title = get_general_data('practice_name', $title);
        }
        if ( preg_match('%doctor_name%', $title) ) {
			$title = get_multi_data('doctor_name', $title);
        }
        if ( preg_match('%doctor_title%', $title) ) {
			$title = get_multi_data('doctor_title', $title);
        }
        if ( preg_match('%location%', $title) ) {
			$title = get_general_data('location', $title);
        }
        if ( preg_match('%phone_numbers_menu%', $title) ) {
			$title = get_phones_menu($title);
        }
		
		global $shortcode_tags;
		$menu_item->title = $title;
  }
    return $menu_items;
}


/* calls for all edited output */
function call_title_shortcode($title,$content=null){
	if(preg_match('%client_name%', $title)){
		$title = get_general_data('client_name', $title);
	}
	if(preg_match('%practice_name%', $title)){
		$title = get_general_data('practice_name', $title);
	}
	if(preg_match('%phone_number%', $title)){
		$title = get_multi_data('phone_number', $title, $content);
	}
	if(preg_match('%location%', $title)){
		$title = get_multi_data('location', $title);
	}
	if(preg_match('%doctor_name%', $title)){
		$title = get_multi_data('doctor_name', $title);
	}
	if(preg_match('%doctor_title%', $title)){
		$title = get_multi_data('doctor_title', $title);
	}
	
	return $title;	
}

function get_general_data($match, $title) {
	if($match == 'client_name') {
		$string = explode('%client_name%', $title );
		$match1 = get_option('wm4d_client');
	}
	if($match == 'practice_name') {
		$string = explode('%practice_name%', $title );
		$match1 = get_option('wm4d_practice');
	}
	if($match == 'doctor_name') {
		$string = explode('%doctor_name%', $title );
		$match1 = get_option('wm4d_doctor');
	}
	if($match == 'doctor_title') {
		$string = explode('%doctor_title%', $title );
		$match1 = get_option('wm4d_doctor').', '.get_option('wm4d_doc_titles');
	}
	if($match == 'location') {
		$string = explode('%location%', $title );
		$match1 = nl2br(get_option('wm4d_location'));
	}
	$title = $string[0];
	$title .= $match1;
	$title .= $string[1];	
	return $title;	
}


function get_multi_data($match, $title) {
	if($match == 'phone_number') {
		$match1 = get_option('wm4d_phone');
		$matchN = get_option('wm4d_phones');
		$string = explode('%phone_number', $title );

	}
	
	if($match == 'doctor_name') {
		$match1 = get_option('wm4d_doctor');
		$matchN = get_option('wm4d_doctors');
		$string = explode('%doctor_name', $title );
	}
	
	if($match == 'doctor_title') {
		$doctor1 = get_option('wm4d_doctor');
		$titles1 = get_option('wm4d_doc_titles');
		$match1 = $doctor1.', '.$titles1;
		$matchN = get_option('wm4d_doctors');
		$titlesN = get_option('wm4d_docs_titles');
		$string = explode('%doctor_title', $title );
	}
	
	if($match == 'location') {
		$match1 = get_option('wm4d_location');
		$matchN = get_option('wm4d_locations');
		$string = explode('%location', $title );
	}
	
	$title = $string[0];
	for($i=1; $i < sizeof($string); $i++) {
		$matchstring1 = explode('%', $string[$i]);
		if($matchstring1[0] == '') {
			if($match == 'phone_number') {
				$title .= '<a href="tel:'.$match1.'">'.$match1.'</a>';
			} else {
				
				$title .= $match1;
			}
			$title .= $matchstring1[$i]; //outnext
		} else {
			$next = explode('s', $matchstring1[0] );
			$getid = explode('_', $matchstring1[0]);
			$id = $getid[1]-1;

			if($id == -1) {
				$endtext = substr($string[$i],2); // cut first: s%
				$max = count($matchN);
				foreach( $matchN as $k => $v) {
					if($match == 'phone_number') {
						if ($k == $max-1) {
						   $title .= '<a href="tel:'.$v.'">'.$v.'</a>';
						} else {
						   $title .= '<a href="tel:'.$v.'">'.$v.'</a>, ';
						}
					} elseif($match == 'doctor_title') {
						if ($k == $max-1) {
						   $title .= $v.', '.$titlesN[$k];
						} else {
						   $title .= $v.', '.$titlesN[$k].', ';
						}
					} else {
						if ($k == $max-1) {
						   $title .= $v;
						} else {
						   $title .= $v.', ';
						}
					}
				}
				$title .= $endtext; //outnext
			}
			if($id > -1) {
				if ($id<10) {
					$endtext = substr($string[$i],4);  // cut first: s_#%
				} else {
					$endtext = substr($string[$i],5);  // cut first: s_##%
				}
				
				if($match == 'phone_number') {
					$title .= '<a href="tel:'.$matchN[$id].'">'.$matchN[$id].'</a>';
				} elseif($match == 'doctor_title') {
					$Ndoctor = $matchN[$id];
					$Ntitles = $titlesN[$id];
					$title .= $Ndoctor.', '.$Ntitles;
				} else {
					$title .= $matchN[$id];
				}
				$title .= $endtext; //outnext
			}
		}
	} 
	
	return $title;	
}

function get_phones_menu($title){
	$title = '';
	$phones = get_option('wm4d_phones');
	$location = get_option('wm4d_phones_loc');
	$string = explode('%phone_numbers_menu%', $title );
	$max = count($phones);
	foreach( $phones as $k => $v) {
		if($k == 0) {
			$title .= '<a href="tel:'.$v.'">'. $location[$k] ."<br/>". $v .'</a></li>';
		}
		else {
			$title .= '<li id="menu-item-phones-'.$k.'" clas"menu-item menu-item-type-custom menu-item-object-custom menu-item-phones'.$k.'">';
			$title .= '<a href="tel:'.$v.'">'. $location[$k] ."<br/>". $v .'</a></li>';
		}
	}
	
	return $title;
}

function call_phone_shortcode($phone){
	if(preg_match('%phone_number%', $phone)){
		$phone = get_multi_data('phone_number', $phone);
	} else {
		$phone = '<a href="tel:'.$phone.'">'.$phone.'</a>';
	}
	return $phone;	
}
	
function call_address_shortcode($address, $line){
	if(preg_match('%location%', $address)){
		$address = get_multi_data('location', $address);
		$string = explode("\n", $address );

		switch ($line) {
		case 'line1':
			$address = $string[0];
			return $address;
			break;
		case 'line2':
			$address = $string[1];
			return $address;
			break;
		case 'line3':
			$address = $string[2];
			return $address;
			break;
		case 'line4':
			$address = $string[3];
			return $address;
			break;
		}
	}
	else {
		return $address;
	}
}

function call_description_shortcode($description){
	if(preg_match('%phone_number%', $description)){
		$description = get_multi_data('phone_number', $description);
	}
	if(preg_match('%doctor_name%', $description)){
		$description = get_multi_data('doctor_name', $description);
	}
	if(preg_match('%doctor_title%', $description)){
		$description = get_multi_data('doctor_title', $description);
	}
	if(preg_match('%client_name%', $description)){
		$description = get_general_data('client_name', $description);
	}
	if(preg_match('%practice_name%', $description)){
		$description = get_general_data('practice_name', $description);
	}
	if(preg_match('%location%', $description)){
		$data = get_multi_data('location', $description);
		$string = preg_replace("#\r\n#",'{br}',trim($data));
		$description = $string;
	}
	if(preg_match('%multi_data%', $description)){
		$practice = get_option('wm4d_practice');
		$all_phones = get_option('wm4d_phones');
		$all_locations = get_option('wm4d_locations');
		
		$string = '';
		$string .= $practice . '{br}';

		foreach($all_phones as $k => $v) {
			$locations = preg_replace("#\r\n#",'{br}',trim($all_locations[$k]));

			$string .= $locations . '{br}';
			//$string .= 'Phone: ' . $v . ' | ';
			$string .='Phone: <a href="tel:'.$v.'">'.$v.'</a> | ';
		}
		
		$description = $string;
	}
	//return print_r( $data );
	return $description;

}

function call_addresses_shortcode($address){
	if(preg_match('%location%', $address)){
		$data = get_multi_data('location', $address);
		$string = preg_replace("#\r\n#",', ',trim($data));
		$address = $string;
	}
	if(preg_match('%multi_data%', $address)){
		$data = get_option('wm4d_locations');
		
		foreach($data as $k => $v) {
			$locations = preg_replace("#\r\n#",', ',trim($v));
			$string .= $locations . '|';
		}
		$address = $string;
	}
	return $address;
	//return print_r( $data );
}

function call_icons_shortcode($address, $icons) {
	if(preg_match('%multi_data%', $address)){
		$data = get_option('wm4d_locations');
		$string = '';
		foreach($data as $k => $v) {
			$string .=  $icons . '|';
		}
		$icons = $string;
	}
	return $icons;
}

function call_web_shortcode($url){
	if(preg_match('%self%', $url)){
		$url = site_url();
		$a = preg_replace('#^[^:/.]*[:/]+#i', '',urldecode( $url ));
		$out =	preg_replace('!\bwww3?\..*?\b!', '', $a);
		$url = $out;	
	}
	else {
		$out = "<a target='_blank' href='{$url}'>";
		$a = preg_replace('#^[^:/.]*[:/]+#i', '',urldecode( $url ));
		$out .=	preg_replace('!\bwww3?\..*?\b!', '', $a);
		$out .= "</a>";
		$url = $out;	
	}
	return $url;	
}
?>