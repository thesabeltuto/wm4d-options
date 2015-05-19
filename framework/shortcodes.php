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
	extract(shortcode_atts(array( 'title' => false ), $atts ));

	if($atts == true ) {
		$name = get_option('wm4d_doctor');
		$title = get_option('wm4d_doc_titles');
		
		$wm4d_doctor = $name .', '. $title;
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
	extract(shortcode_atts(array( 'short' => false ), $atts ));
	if($atts == true) {
		$wm4d_location = get_option('wm4d_location_short');
	} else {
		$wm4d_location = nl2br(get_option('wm4d_location'));
	}	
	return $wm4d_location;
}

function wm4d_doctors( $atts ){
	extract(shortcode_atts(array( 'id' => '', 'title' => false ), $atts ));
	
	$id -=1;
	
	$doctors = get_option('wm4d_doctors');
	$titles = get_option('wm4d_docs_titles');
	
	switch($title) {
		case false: 
			if ($id == -1) {
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
		case true:
			if ($id == -1) {
				$alldoctors = '';
				$maxdoctors = count($doctors);
				$i = 0;
				foreach( $doctors as $d ) {
					if ( $i == 0 ) {
					   $alldoctors .= $doctors[$i].', '.$titles[$i].', ';
					} else if ($i == $maxdoctors-1) {
					   $alldoctors .= $doctors[$i].', '.$titles[$i];
					} else {
					   $alldoctors .= $doctors[$i].', '.$titles[$i].', ';
					   }
					$i++;
				}
				return $alldoctors;
			} else {
				$name = $doctors[$id];
				$title = $titles[$id];
				$doctor = $name . ', ' . $title;
				return $doctor;
			}
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
		'title' => 'Testimonials',
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
	extract(shortcode_atts(array( 'title' => 'Before and Afters' ), $atts ));
	
	if($title != ''){ $title = '<h2 class="widget-title">'.$title.'</h2>';	}
	
	$bna = '<div id="before-after">';
	$bna .= $title;
	$bna .= '<ul id="before-after-cycle">';
	
	$before_after_args = array('post_type' => 'before-and-afters', 'posts_per_page' => -1);
	$before_after_loop = new WP_Query($before_after_args);
	while ($before_after_loop->have_posts()) : $before_after_loop->the_post();
		$bna .= the_post_thumbnail();
	endwhile;
		
	$bna .= '</ul>';
	$bna .= '<div id="before-after-nav">';
	$bna .= '<a href="#"><span id="before-after-prev">Prev</span></a>'; 
	$bna .=  '<a href="#"><span id="before-after-next">Next</span></a>';
	$bna .= '</div>';
	$bna .= '</div>';
	
	return $bna;
}

function office_images( $atts ) {
	extract(shortcode_atts(array( 'title' => 'Office Images' ), $atts ));
	
	if($title != ''){ $title = '<h2 class="widget-title">'.$title.'</h2>';	}

	$office = '<div id="office-images">';
	$office .= $title;
	$office .= '<ul id="office-images-cycle">';
	
	$office_images_args = array('post_type' => 'office-images', 'posts_per_page' => -1);
	$office_images_loop = new WP_Query($office_images_args);
	while ($office_images_loop->have_posts()) : $office_images_loop->the_post();
		$office .= the_post_thumbnail();
	endwhile;
		
	$office .= '</ul>';
	$office .= '<div id="office-images-nav">';
	$office .= '<a href="#"><span id="office-images-prev">Prev</span></a>'; 
	$office .=  '<a href="#"><span id="office-images-next">Next</span></a>';
	$office .= '</div>';
	$office .= '</div>';

	return $office;
}
?>