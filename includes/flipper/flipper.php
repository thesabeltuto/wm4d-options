<?php /* Flipper by Andrey */

/*		$check = sha1( time() );

$domain="www.ru";
$domain="lebanon-nj-dentist.com";

//		switch_to_blog( 1 );
		$ajax_url = admin_url( 'admin-ajax.php' );
		$ajax_url = str_replace( parse_url( $ajax_url, PHP_URL_HOST ), $domain, $ajax_url );
//		restore_current_blog();
		$response = wp_remote_request( add_query_arg( array(
			'action' => 'domainmapping_heartbeat_check',
			'check'  => $check,
		), $ajax_url ), array( 'sslverify' => false ) );

		print_r($response);exit;
*/
//		$status = !is_wp_error( $response ) && wp_remote_retrieve_response_code( $response ) == 200 && preg_replace('/\W*/', '', wp_remote_retrieve_body( $response ) ) == $check ? 1 : 0;
//		$this->set_valid_transient( $domain, $status );
//		print_r($status);exit;




add_action( 'wp_ajax_nopriv_get_flipper_js', 'flipper_get_js');
add_action( 'wp_ajax_get_flipper_js', 'flipper_get_js');

function flipper_get_keep_cookie() {
	$keep_cookie=false;
	return $keep_cookie;
}
function flipper_adding_scripts() {
	wp_register_script('flipper-script', '/wp-admin/admin-ajax.php?action=get_flipper_js','','1.1', true);
	wp_enqueue_script('flipper-script');
}

function flipper_get_js() {
	include("flipper.js.php");
	exit;
}

add_action( 'wp_enqueue_scripts', 'flipper_adding_scripts' );  

/*
if (get_option('wm4d_flipper_select')=="enable") {
//	echo "On";exit;
} else {	
	if ($_GET['ref']!="") {
		$ref=$_GET['ref'];
//		setcookie('ref', null, -1, '/');
		if ($ref=='_cleanit') {unset($_COOKIE['ref']);}
		elseif (!flipper_get_keep_cookie() || $_COOKIE['ref']=="") {$_COOKIE['ref']=$ref;};
	};

//	echo  $_COOKIE['ref'];
};
*/
//print_r($_COOKIE['ref']);



add_filter("gform_pre_submission_filter", "flipper_add_wm4d_rid");

function flipper_add_wm4d_rid($form) {
	if (preg_match("/master-play/im",$_SERVER['HTTP_HOST'])) {
		session_start();
		$in = serialize(array('ref'=>$_COOKIE['ref'],'time'=>time(),'_referer'=>$_SERVER['HTTP_REFERER']));
		$cr=$in;

		print_r($GLOBALS);
		print_r($in);
		exit;
	} else {
			$in = serialize(array('ref'=>$_COOKIE['ref'],'time'=>time(),'_referer'=>$_SERVER['HTTP_REFERER']));
			$cr=flipper_wm4d_rid_encode($in);
	};
	$out="[{WM4D Record ID: ".$cr."}]";
	if (isset($form['notifications'])) // for new multisite gf
		foreach ($form['notifications'] as $id=>$nt) {
			if ($nt['name']=='Admin Notification') {
				$form['notifications'][$id]['message'].="<br>\n$out";
			}
		};

	if (isset($form['notification'])) // For Old Multisite - gf
//		foreach ($form['notifications'] as $id=>$nt) {
//			if ($nt['name']=='Admin Notification') {
				$form['notification']['message'].="<br>\n$out";
//			}
//		};
/*
	if (preg_match("/pembroke-pines-comprehensive-dentistry/im",$_SERVER['HTTP_HOST'])) {
		print_r($form);exit;
	};
*/	
	return $form;

//	print_r($form);exit;
//	print_r(unserialize(flipper_wm4d_rid_decode($cr)));
//	echo $out;//exit;
}

function flipper_get_replace1() {
	$res=array();
	$k=get_option('wm4d_phone');
	if ($k!="" && get_option('wm4d_flipper_phone')!="") {	
		$tmp = get_option('wm4d_flipper_phone');		
//		print_r($tmp);exit;
		foreach ($tmp as $lne) {
			$row=explode(":",$lne);
			$res[$row[0]][$k] = $row[1];
		};
	}
	
//	print_r($k);
//	print_r($res);exit;
	return $res;
}

function flipper_get_replace_many() {
	$tmp = get_option('wm4d_flipper_phones');
	$res=array();
//	print_r(trim($tmp));exit;

	foreach ($tmp as $lne) if (trim($lne)!="")
	 {
		$row=explode(":",$lne);

		$res[$row[1]][$row[0]] = chop($row[2]);
		
	};
	return $res;
}

function flipper_clean_phone($in) {
	return preg_replace("/[^0-9]/im","", $in);
}

function flipper_format_phone($in) {
	if (preg_match_all("/^(\d{3})(\d{3})(\d{4})/im",$in,$m)) 
		$in="(".$m[1][0].")".$m[2][0]."-".$m[3][0];
//	print_r($m);
	return $in;
}

function flipper_get_all() {
	if (get_option('wm4d_multiple_select')!='enable' ) {		
		$res=flipper_get_replace1();
		foreach ($res as $ref=>$row) {
			foreach ($row as $k=>$v) {
				unset($res[$ref][$k]);
				if ($v!="") 
					$res[$ref][flipper_clean_phone($k)] = flipper_format_phone($v);
			};
			
		};
//	print_r($res);exit;
	} else {
		
		$tmp2 = flipper_get_replace_many();

//	print_r($tmp2);exit;

		$kk=get_option('wm4d_phones');
		$res = array();
		foreach ($tmp2 as $r=>$row) 
	
			foreach ($row as $k=>$v) 
				if (isset($kk[$k-1])) {
					$kkk=get_option('wm4d_phones');//explode(":",$kk[$k-1]);
					$vv=explode(":",$v);
					$res[$r][$kk[$k-1]] = chop($v);//$tmp2[$k+1];
				}
	
		foreach ($res as $i=>$j) 	
			foreach ($j as $s=>$r) {
				unset($res[$i][$s]);
				if ($r!="") {
					$s=flipper_clean_phone($s);
					$res[$i][$s]=flipper_format_phone($r);
				};
			};
	};

//	print_r($res);exit;
	return $res;

}

/*
function flipper_get_phone() {
	$items=array();
	$kk=explode("\n",get_option('wm4d_phone'));
	foreach ($kk as $it) {
		$kkk=explode(":",$it);	
		$items[]=array('phone'=>$kkk[0], 'ref'=>$kkk[1]);
	};
	return $items;	
}
*/

function flipper_get_phones() {
	$items=array();
	$kk=get_option('wm4d_phones');
	foreach ($kk as $it) {
		$kkk=explode(":",$it);	
		$items[]=array('phone'=>$kkk[0], 'office'=>$kkk[1]);
	};
	return $items;	
}

function flipper_get_referers() {
//	echo get_option('wm4d_flipper_referers')=='';exit;
	if (get_option('wm4d_flipper_select')=='enable' && trim(get_option('wm4d_flipper_referers'))=='') {
//		echo trim(get_option('wm4d_flipper_referers'))=='';exit;
		update_option('wm4d_flipper_referers',implode(", ",array('yahoo','bing','google','facebook')));
//		echo get_option('wm4d_flipper_referers');
	}
	$res=get_option('wm4d_flipper_referers');
	foreach ($res as $i=>$r) $res[$i]=strtolower(trim($r)); 
	return $res;
}

function flipper_update_number() {
//	echo "in";exit;
	$refs = flipper_get_referers();
	$phones = flipper_get_replace1();
	$out=array();
	foreach ($refs as $ref) {
//	print_r("ref_{$ref}");

//		foreach ($phones as $i=>$phone) {
//			$num=key($phone);
			if (isset($_POST["ref_${ref}"]) && $_POST["ref_${ref}"]!="") $out[]="{$ref}:".$_POST["ref_${ref}"];
//		};
	};
//	print_r(implode("\n", $out));exit;
	update_option("wm4d_flipper_phone", $out);
//exit;
}

function flipper_update_numbers() {
	$refs = flipper_get_referers();
	$phones = flipper_get_phones();
	$out=array();
//	print_r($refs);
//exit;
	foreach ($refs as $ref) {
		foreach ($phones as $i=>$phone) {
			if (isset($_POST["ref_${ref}_index_".($i+1).""]) && $_POST["ref_${ref}_index_".($i+1).""]!="") $out[]="".($i+1).":{$ref}:".$_POST["ref_${ref}_index_".($i+1).""];
		};
	};
//	print_r(implode("\n", $out));exit;
	update_option("wm4d_flipper_phones", $out);
//exit;
}

function flipper_get_numbers() {
	$res=json_decode(flipper_do_api_request());
	if (is_object($res))
//	print_r($res);exit;	
	foreach ($res->campaigns as $i=>$cmp) {
//		echo $res->campaigns[$i]->postback_params->phone_clean;exit;
		$res->campaigns[$i]->postback_params->phone_clean = preg_replace("/[^0-9]/im","", $cmp->postback_params->phone);
	}
	return $res;
//	print_r($res);		exit;
}

function flipper_do_api_request($options=array()) {
	$key="253614bbac999b38b5b60cae531c4969";
//	$url="http://localhost/mx/api/";
	$url="http://mx.wm4d.com/api/";

//	print_r($_SERVER['HTTP_HOST']);	
	$domain=$_SERVER['HTTP_HOST'];
//	$domain="dentistofnorcross.com";
//	$domain="http://miamibreastreconstruction.com/";

	$request="get_campaign_by_domain?k=$key&d=".urlencode($domain);
//	echo $request;exit;
	$result = file_get_contents($url.$request);
	return $result;

//	echo $url.$request;exit;
//	file_get_contents();
}

if (isset($_POST['submit'])) {

	if (isset($_POST['wm4d_referers'])){
		foreach ($_POST['wm4d_referers'] as $i=>$ref) {
				if ($ref=="") unset($_POST['wm4d_referers'][$i]);
		};

		update_option("wm4d_flipper_referers", $_POST['wm4d_referers']);
	};
//print_r(get_option('wm4d_flipper_referers'));exit;
//	print_r($_POST['wm4d_select_options']=='primary');exit;
	if ($_POST['wm4d_select_options']=='primary') flipper_update_number();
	elseif ($_POST['wm4d_select_options']=='multiple') flipper_update_numbers();

//	print_r(implode(", ", $_POST['wm4d_referers']));exit;

//	exit;
};

add_filter('gform_field_value_ref', 'capsure_ref');
function capsure_ref($value){
	$ref="";
	if (isset($_COOKIE['ref']) && $_COOKIE['ref']!="") $ref = $_COOKIE['ref'];
	else if (isset($_GET['ref']) && $_GET['ref']!="") $ref = $_GET['ref']; 

	return $ref;

}
function flipper_replace_ref($in) {
	$ref="";
	if (isset($_COOKIE['ref']) && $_COOKIE['ref']!="") $ref = $_COOKIE['ref'];
	else if (isset($_GET['ref']) && $_GET['ref']!="") $ref = $_GET['ref']; 
	if ($ref!="") $rs="ref=$ref";
	else $rs="";
	return str_replace("{ref}",$rs,$in);
}
function flipper_get_pk() {
	return '9( 7)ci#<~b3Vxq3Ow]>KR<5of.#Znvo5<O)P}o$2dwjUpe^:Ru-->L.|KI3rN!O';
}
function flipper_wm4d_rid_encode($text) {
	$iv_size = mcrypt_get_iv_size( MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB );
	$key = substr( md5( flipper_get_pk() ), 0, $iv_size );
	return trim( base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, $key, $text, MCRYPT_MODE_ECB, mcrypt_create_iv( $iv_size, MCRYPT_RAND ) ) ) );	
}

function flipper_wm4d_rid_decode($text) {
	$iv_size = mcrypt_get_iv_size( MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB );
	$key = substr( md5( flipper_get_pk() ), 0, $iv_size );
	return trim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, $key, base64_decode( $text ), MCRYPT_MODE_ECB, mcrypt_create_iv( $iv_size, MCRYPT_RAND ) ) );
}

//$str="v0CJI1NhtR2YCHOv6Dv98/Y9twEcUAf2iAkQzWpvrkQkaN89C5MaBqKDE/JKSKTGVo2apMBm8YUJZcbun4krCw==";
//print_r(unserialize(flipper_wm4d_rid_decode($str)));
//echo $_COOKIE['ref'];
?>