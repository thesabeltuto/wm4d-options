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

add_shortcode( 'offer', 'special_offer' );
add_shortcode( 'testimonials', 'testimonials' );
add_shortcode( 'before_afters', 'before_afters' );
add_shortcode( 'office_images', 'office_images' );

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
	extract(shortcode_atts(array( 'title' => '' ), $atts ));

	if($title == true ) {
		$name = get_option('wm4d_doctor');
		$titles = get_option('wm4d_doc_titles');
		
		$wm4d_doctor = $name .', '. $titles;
	} else {
		$wm4d_doctor = get_option('wm4d_doctor');
	}
	
	return $wm4d_doctor;
}

function wm4d_phone( $atts ){
	$wm4d_phone = get_option('wm4d_phone');
	return $wm4d_phone;
}

function wm4d_location( $atts ){
	extract(shortcode_atts(array( 'short' => '' ), $atts ));
	if($short == true) {
		$wm4d_location = get_option('wm4d_location_short');
	} else {
		$wm4d_location = nl2br(get_option('wm4d_location'));
	}	
	return $wm4d_location;
}

function wm4d_doctors( $atts ){
	extract(shortcode_atts(array( 'id' => '', 'title' => '', 'and' => '', 'count' => '' ), $atts ));
	
	$array_id = $id-1;
	
	$doctors = get_option('wm4d_doctors');
	$titles = get_option('wm4d_docs_titles');
	$alldoctors = '';
	$maxdoctors = count($doctors);
	$blast = $maxdoctors-1;
	$blast2 = $maxdoctors-2;

	if ( $and == true ) {
		foreach( $doctors as $k => $v ) {
		   if ( $k == 0 ) {
			   $alldoctors .= $v.', ';
			   $alldoctitles .= $v.', '.$titles[$k].', ';
		   } elseif ($k == $blast) {
			   $alldoctors .= $v;
			   $alldoctitles .= $v.', '.$titles[$k];
		   } elseif ($k == $blast2) {
			   $alldoctors .= $v.' and ';
			   $alldoctitles .= $v.', '.$titles[$k].' and ';
		   } else {
			   $alldoctors .= $v.', ';
			   $alldoctitles .= $v.', '.$titles[$k].', ';
		   }
		}
	} else {
		foreach( $doctors as $k => $v ) {
		   if ( $k == 0 ) {
			   $alldoctors .= $v.', ';
			   $alldoctitles .= $v.', '.$titles[$k].', ';
		   } elseif ($k == $blast) {
			   $alldoctors .= $v;
			   $alldoctitles .= $v.', '.$titles[$k];
		   } else {
			   $alldoctors .= $v.', ';
			   $alldoctitles .= $v.', '.$titles[$k].', ';
		   }
		}
	}
	
	if ( $title == true ) {
		if ($id == '') {
			return $alldoctitles;
		} else {
			$name = $doctors[$array_id];
			$title = $titles[$array_id];
			$doctor = $name . ', ' . $title;
			return $doctor;
		}
	} else {
		if ( $count == true ) {
			return $maxdoctors;
		}
		if ($id == '') {
			return $alldoctors;
		} else {
			return $doctors[$array_id];
		}
	}
	
	
}

function wm4d_phones( $atts ){
	extract(shortcode_atts(array( 'id' => '', 'only' => '', 'and' => '', 'count' => ''), $atts ));

	$phonesdata = get_option('wm4d_phones');
	$phonesdata_loc = get_option('wm4d_phones_loc');
	$phonelocation = array();
	
	$array_id = $id -1;
	
	$allphones = '';
	$onlyphones = '';
	$onlylocs = '';
	$maxphones = count($phonesdata);
	$blast = $maxphones-1;
	$blast2 = $maxphones-2;
	$i = 0;
	
	if ( $and == true ) {
		foreach( $phonesdata as $k => $v ) {
			if ( $k == 0 ) {
			   $allphones .= $v.' - '.$phonesdata_loc[$k].', ';
			   $onlyphones .= $v.', ';
			   $onlylocs .= $phonesdata_loc[$k].', ';
			} elseif ($k == $blast) {
			   $allphones .= $v.' - '.$phonesdata_loc[$k];
			   $onlyphones .= $v;
			   $onlylocs .= $phonesdata_loc[$k];
			} elseif ($k == $blast2) {
			   $allphones .= $v.' - '.$phonesdata_loc[$k].' and ';
			   $onlyphones .= $v.' and ';
			   $onlylocs .= $phonesdata_loc[$k].' and ';
			} else {
			   $allphones .= $v.' - '.$phonesdata_loc[$k].', ';
			   $onlyphones .= $v.', ';
			   $onlylocs .= $phonesdata_loc[$k].', ';
			}
		}
	} else {
		foreach( $phonesdata as $k => $v ) {
			if ( $k == 0 ) {
			   $allphones .= $v.' - '.$phonesdata_loc[$k].', ';
			   $onlyphones .= $v.', ';
			   $onlylocs .= $phonesdata_loc[$k].', ';
			} elseif ($k == $blast) {
			   $allphones .= $v.' - '.$phonesdata_loc[$k];
			   $onlyphones .= $v;
			   $onlylocs .= $phonesdata_loc[$k];
			} else {
			   $allphones .= $v.' - '.$phonesdata_loc[$k].', ';
			   $onlyphones .= $v.', ';
			   $onlylocs .= $phonesdata_loc[$k].', ';
			}
		}
	}

	if( $only == 'phone' ) {
		if($id != '' ) {
			return $phonesdata[$array_id];
		} else {
			return $onlyphones;
		}
	}
	if( $only == 'location' ) {
		if($id != '' ) {
		   return $phonesdata_loc[$array_id];
		} else {
			return $onlylocs;
		}
	}
	else {
		if($id != '' ) {
			return $allphones;
		} else {
			return $phonesdata[$array_id].' - '.$phonesdata_loc[$array_id];
		}
	}
	
	if ( $count == true ) {
		return 	$maxphones;
	}
}

function wm4d_locations( $atts ){
	extract(shortcode_atts(array( 'id' => '', 'count' => '', 'short' => '', 'and' => '' ), $atts ));

	$array_id = $id-1;

	$locations = get_option('wm4d_locations');
	$phones_loc = get_option('wm4d_phones_loc');
	$alllocations = '';
	$shortlocations = '';
	$maxlocations = count($locations);
	$blast = $maxlocations-1;
	$blast2 = $maxlocations-2;
	
	if ($and == true) {
		foreach( $locations as $k => $v ) {
			if ( $k == 0 ) {
			   $alllocations .= nl2br($v).', ';
			   $shortlocations .= $phones_loc[$k].', ';
			} elseif ($k == $blast) {
			   $alllocations .= nl2br($v);
			   $shortlocations .= $phones_loc[$k];
			} elseif ($k == $blast2) {
			   $alllocations .= nl2br($v).' and ';
			   $shortlocations .= $phones_loc[$k].' and ';
			} else {
			   $alllocations .= nl2br($v).', ';
			   $shortlocations .= $phones_loc[$k].', ';
			   }
		}
	} else {
		foreach( $locations as $k => $v ) {
			if ( $k == 0 ) {
			   $alllocations .= nl2br($v).', ';
			   $shortlocations .= $phones_loc[$k].', ';
			} elseif ($k == $blast) {
			   $alllocations .= nl2br($v);
			   $shortlocations .= $phones_loc[$k];
			} else {
			   $alllocations .= nl2br($v).', ';
			   $shortlocations .= $phones_loc[$k].', ';
			   }
		}
	}
	
	if ( $count == true) {
		return $maxlocations;
	} else {
		if ($id == '') {
			if ($short == '') {
				return $alllocations;
			} else {
				return $shortlocations;
			}
		} else {
			if ($short == '') {
				$thelocation = nl2br($locations[$array_id]);	
				return $thelocation;
			} else {
				$theshortlocation = $phones_loc[$array_id];	
				return $thelocation;
			}
		}
	}
}

function wm4d_practice( $atts ){
	$wm4d_practice = get_option('wm4d_practice');
	return $wm4d_practice;
}

function special_offer($atts){
	extract(shortcode_atts(array(
		'title' => 'Special Offer',
		'price' => '',
		'service' => '',
		'options' => '',
		'tagline' => '',
		'consult' => 'Request Appointment',
		'extend' => 'Extend Offer',
		'consult_form_id' => '',
		'extend_form_id' => '',
		'consult_form_url' => '',
		'extend_form_url' => ''
	), $atts ));
	$offer_expires_date = date("Y-m-d");

	$special_offer = '<div id-"special-offer">'; 
	$special_offer .= '<div id="offer-heading">'.$title.'</div>';
	$special_offer .= '<div id="offer-wrap"><div id="offer"><h2>' . $price . '</h2>';
	$special_offer .= '<span>' . $service_offer . '</span></div>';
	$special_offer .= '<div id="offer-details"><div id="offer-features">' . $options . '</div></div>';
	$special_offer .= '<div id="tagline">'. $tagline . '</div>'; /*OpenInNewTab();*/
	$special_offer .= '<div id="consult-btn-text"><div class="various" href="#gform-consult-form-'. $consult_form_id . '"><a href="' . $consult_form_url . '" target="_blank">' . $consult. '</a></div></div>';
	$special_offer .= '<div id="expire-offer">Offer expires: ' . $offer_expires_date . '</div>';
	$special_offer .= '<div id="extend-offer"><div class="various" href="#gform-extend-form-'. $extend_form_id . '"><a href="' . $extend_form_url . '" target="_blank" >' . $extend . '</a></div></div>';
	$special_offer .= '<div id="gform-consult-form-' .  $consult_form_id . '" style="display:none;width:500px;">';
	$special_offer .= do_shortcode('[gravityform id="'. $consult_form_id . '" ajax="true"]');
	$special_offer .= '</div>';
	$special_offer .= '<div id="gform-extend-form-' .  $extend_form_id . '" style="display:none;width:500px;">';
	$special_offer .= do_shortcode('[gravityform id="'. $extend_form_id . '" ajax="true"]');
	$special_offer .= '</div>';
	$special_offer .= '</div>';
	
	return $special_offer;
}

function testimonials( $atts ) {
	extract(shortcode_atts(array(
		'title' => '',
		'all' => 'See All',
		'url' => '/testimonials/'
	), $atts ));
	
	if($title != ''){ $title = '<h2 class="widget-title">'.$title.'</h2>';	}
	
	$testimonials = '<div id="testimonials">';
	$testimonials .= $title;
	$testimonials .= '<div id="cycle" style="height:auto!important;max-height:300px!important;">';
	
	$slider_args = array('post_type' => 'testimonials', 'posts_per_page' => -1);
	$loop = new WP_Query($slider_args);
	while ($loop->have_posts()) : $loop->the_post();
		$testimonials .= '<div class="the-testimonial"><div class="testimonial-excerpt">'. get_the_excerpt() . '</div>';
		$testimonials .= '<div class="testimonial-title"> &mdash; ' . get_the_title() . '</div></div>';
	endwhile;
	wp_reset_postdata();
		
	$testimonials .= '</div>';
	$testimonials .= '<div id="testimonial-nav">';
	$testimonials .= '<a href="#"><span id="prev">Prev</span></a>'; 
	$testimonials .= '<a href="'. $url .'"><span id="seeall">'. $all .'</span></a>'; 
	$testimonials .= '<a href="#"><span id="next">Next</span></a>';
	$testimonials .= '</div>';
	$testimonials .= '</div>';
	
	return $testimonials;
}

function before_afters( $atts ) {
	extract(shortcode_atts(array( 'title' => '' ), $atts ));
	
	if($title != ''){ $title = '<h2 class="widget-title">'.$title.'</h2>';	}
	
	$bna = '<div id="before-after">';
	$bna .= $title;
	$bna .= '<ul id="before-after-cycle">';
	
	$before_after_args = array('post_type' => 'before-and-afters', 'posts_per_page' => -1);
	$before_after_loop = new WP_Query($before_after_args);
	while ($before_after_loop->have_posts()) : $before_after_loop->the_post();
		$bna .= get_the_post_thumbnail();
	endwhile;
	//wp_reset_postdata();
		
	$bna .= '</ul>';
	$bna .= '<div id="before-after-nav">';
	$bna .= '<a href="#"><span id="before-after-prev">Prev</span></a>'; 
	$bna .=  '<a href="#"><span id="before-after-next">Next</span></a>';
	$bna .= '</div>';
	$bna .= '</div>';
	
	return $bna;
}

function office_images( $atts ) {
	extract(shortcode_atts(array( 'title' => '' ), $atts ));
	
	if($title != ''){ $title = '<h2 class="widget-title">'.$title.'</h2>';	}

	$office = '<div id="office-images">';
	$office .= $title;
	$office .= '<ul id="office-images-cycle">';
	
	$office_images_args = array('post_type' => 'office-images', 'posts_per_page' => -1);
	$office_images_loop = new WP_Query($office_images_args);
	while ($office_images_loop->have_posts()) : $office_images_loop->the_post();
		$office .= get_the_post_thumbnail();
	endwhile;
	wp_reset_postdata();
	
	$office .= '</ul>';
	$office .= '<div id="office-images-nav">';
	$office .= '<a href="#"><span id="office-images-prev">Prev</span></a>'; 
	$office .=  '<a href="#"><span id="office-images-next">Next</span></a>';
	$office .= '</div>';
	$office .= '</div>';

	return $office;
}
?>