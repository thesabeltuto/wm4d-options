<?php
/* EDIT DT SHORTCODE OUTPUT */
/*
	dt_sc_titled_box
	dt_sc_icon_box_colored
	dt_sc_icon_box
	dt_sc_phone
	dt_sc_address
	dt_sc_web
*/
	remove_shortcode ( "dt_sc_titled_box");
	remove_shortcode ( "dt_sc_icon_box_colored" );
	remove_shortcode ( "dt_sc_icon_box" );
	remove_shortcode ( "dt_sc_phone" );
	remove_shortcode ( "dt_sc_address" );
	remove_shortcode ( "dt_sc_web" );
	
	add_shortcode ( "dt_sc_titled_box", "dt_sc_titled_box_edited" );
	add_shortcode ( "dt_sc_icon_box_colored", "dt_sc_icon_box_colored_edited" );
	add_shortcode ( "dt_sc_icon_box", "dt_sc_icon_box_edited" );
	add_shortcode ( "dt_sc_phone", "dt_sc_phone_edited");
	add_shortcode ( "dt_sc_address", "dt_sc_address_edited");
	add_shortcode ( "dt_sc_web", "dt_sc_web_edited");

/******* REPLACED SHORTCODES FROM ORGINAL *******/
	/* Titles Box Shortcode */
	function dt_sc_titled_box_edited($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'title' => '',
				'icon' => '',
				'type'	=> '',
				'variation' => '',
				'bgcolor' => '',
				'textcolor' => '' 
		), $attrs ) );
		
		$type = (empty($type)) ? 'dt-sc-titled-box' :"dt-sc-$type";
		$variation = ( ( $variation ) && ( empty( $bgcolor ) ) ) ? ' ' . $variation : '';
		$content = DTCoreShortcodesDefination::dtShortcodeHelper( $content );
		$title = call_title_shortcode($title,$content);
		
		$styles = array();
		if($bgcolor) $styles[] = 'background-color:' . $bgcolor . ';border-color:' . $bgcolor . ';';
		if($textcolor) $styles[] = 'color:' . $textcolor . ';';
		$style = join('', array_unique( $styles ) );
		$style = !empty( $style ) ? ' style="' . $style . '"': '' ;
		
		if($type == 'dt-sc-titled-box') :
			$icon = ( empty($icon) ) ? "" : "<span class='fa {$icon} '></span>";
			$title = "<h6 class='{$type}-title' {$style}> {$icon} {$title}</h6>";
			$out = "<div class='{$type} {$variation}'>";
			$out .= $title;
			$out .=	"<div class='{$type}-content'>{$content}</div>";
			$out .= "</div>";
		else :
			$out = "<div class='{$type}'>{$content}</div>";
		endif;
		return $out;
	}

	/* Icon Boxes Colored Shortcode */
	function dt_sc_icon_box_colored_edited($attrs, $content = null, $shortcodename = "") {
		extract ( shortcode_atts ( array (
				'type' => '',
				'fontawesome_icon' => '',
				'custom_icon' => '',
				'title' => '',
				'bgcolor' => ''
		), $attrs ) );
		
		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		$title = call_title_shortcode($title,$content);
		
		$bgcolor = empty ( $bgcolor ) ? "" : " style='background:{$bgcolor};' ";
		
		$type = ( trim($type) === 'type1' ) ? "no-space" : "space";
		
		$out =  "<div class='dt-sc-colored-box {$type}' {$bgcolor}>";
		
		$icon = "";
		if( !empty($fontawesome_icon) ){
			$icon = "<span class='fa fa-{$fontawesome_icon}'> </span>";
		
		}elseif( !empty($custom_icon) ){
			$icon = "";	
		}
		
		$out .= "<h5>{$icon}{$title}</h5>";
		$out .= $content;
		$out .= "</div>";
		return $out;
	}


	/* Icon Boxes Shortcode */
	function dt_sc_icon_box_edited($attrs, $content = null, $shortcodename = "") {
		extract ( shortcode_atts ( array (
				'type' => '',
				'fontawesome_icon' => '',
				'custom_icon' => '',
				'title' => '',
				'link' => '',
				'target' => ''
		), $attrs ) );
		
		$content = DTCoreShortcodesDefination::dtShortcodeHelper ( $content );
		$title = call_title_shortcode($title,$content);
		
		$out =  "<div class='dt-sc-ico-content {$type}'>";
		if( !empty($fontawesome_icon) ){
			$out .= "<div class='icon'> <span class='fa fa-{$fontawesome_icon}'> </span> </div>";
		
		}elseif( !empty($custom_icon) ){
			
		}
		$out .= empty( $title ) ? $out : "<h5><a href='{$link}' target='{$target}'> {$title} </a></h5>";
		$out .= $content;
		$out .= "</div>";
		return $out;
	}

	/* Phone Shortcode */
	function dt_sc_phone_edited($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'phone' => ''
		), $attrs ) );

		$phone = call_phone_shortcode($phone);

		$out = '<p class="dt-sc-contact-info">';
		$out .= "<i class='fa fa-phone'></i>";
		$out .= __('Phone : ','dt_themes');
		$out .= ( !empty($phone) ) ?"<span>{$phone}</span>": "";
		$out .= '</p>';
		
		return $out;
	 }


	/* Address Shortcode */
	function dt_sc_address_edited($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'line1' => '',
				'line2' => '',
				'line3' => '',
				'line4' => ''
		), $attrs ) );
		if(!empty($line1)) $line1 = call_address_shortcode($line1, 'line1'); else $line1 = '';
		if(!empty($line2)) $line2 = call_address_shortcode($line2, 'line2'); else $line2 = '';
		if(!empty($line3)) $line3 = call_address_shortcode($line3, 'line3'); else $line3 = '';
		if(!empty($line4)) $line4 = call_address_shortcode($line4, 'line4'); else $line4 = '';
		
		
		$out = '<p class="dt-sc-contact-info address">';
		$out .= "<i class='fa fa-rocket'></i>";
		$out .= "<span>";
		$out .= ( !empty($line1) ) ? $line1 : "";
		$out .= ( !empty($line2) ) ? "<br>$line2" : "";
		$out .= ( !empty($line3) ) ? "<br>$line3" : "";
		$out .= ( !empty($line4) ) ? "<br>$line4" : "";
		$out .= "</span>";
		$out .= '</p>';
		
		return $out;
	 }

	
	/* Web Shortcode */
	function dt_sc_web_edited($attrs, $content = null) {
		extract ( shortcode_atts ( array (
				'url' => ''
		), $attrs ) );
		$url = call_web_shortcode($url);
		
		$out = '<p class="dt-sc-contact-info">';
		$out .= "<i class='fa fa-globe' ></i>";
		$out .= __('Web : ','dt_themes');
		if( !empty( $url ) ) {
			$out .= "<a target='_blank' href='http://{$url}'>";
			$a = preg_replace('#^[^:/.]*[:/]+#i', '',urldecode( $url ));
			$out .=	preg_replace('!\bwww3?\..*?\b!', '', $a);
			$out .= "</a>";
		}
		$out .= '</p>';
		
		return $out;
	 }
?>