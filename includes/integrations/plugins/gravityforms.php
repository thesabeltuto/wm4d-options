<?php
function wm4d_clean_phone($in) {
	return preg_replace("/[^0-9]/im","", $in);
}

/* GRAVITY FORM SHORTCODES */

add_filter( 'gform_merge_tag_filter', 'wm4d_gform_filter_phones', 10, 7 );
add_filter( 'gform_field_value_practice_name', 'wm4d_gform_practice_name', 10, 3 );
add_filter( 'gform_field_value_year', 'wm4d_gform_get_year', 10, 3 );

function wm4d_gform_filter_phones( $value, $merge_tag, $modifier, $field ) {
    if ( $field->type == 'phone' && $value !="") {
		$new_phone=wm4d_clean_phone($value);	
		$local = preg_match('/(\([0-9]{3}+\)+ [0-9]{3}+\-[0-9]{4}+)/', $value);
		$international = preg_match('/[0-9]{2}+ [0-9]{3}+ [0-9]{3}+ [0-9]{4}/', $value);
		$uk = preg_match('/(\([0-9]{4}+\)+ [0-9]{3}+\-[0-9]{4}+)/', $value);

		if ($local){		
			 $new_phone = "+1".$new_phone;
		}elseif ($international) {		
			 $new_phone = "+".$new_phone;
		}elseif ($uk) {		
			 $new_phone = "+44".$new_phone;
		}
			return $new_phone;    
	}
	else {
        return $value;
    }
}

/* added to get practice name */
function wm4d_gform_practice_name( $value, $field, $name ) {
    $wm4d_practice = get_option('wm4d_practice');
	return $wm4d_practice;
}
function wm4d_gform_get_year( $value, $field, $name ) {
    $value = date("Y");
	return $value;
}
?>