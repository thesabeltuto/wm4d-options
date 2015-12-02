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

/*
$content = get_the_content();
$content = apply_filters('the_content', $content);
*/

function flipper_get_settings() {
	$opts = array(
		'track'=>true,
		'flip'=>(get_option('wm4d_flipper_select')=="enable"),
		'server_mode'=>false, //'esi','php'
		'client_mode'=>'js',// 'js'
		'client_flip'=>true,// 'js'

		'keep_cookie'=>false  //for debug options
	);
	$domains=array( 'dentist-wilmette',
					'localhost',
					'master2',
					'invisalign-in-toronto',
					'the-dentist-of-scottsdale-az',
					'balharbourdentist',
					'dentist-of-franklin-tn',
					'dentist-of-stuart',
					'south-shore-dental-implants',
					'dental-implants-irving',
					'bostoninvisiblebraces' ,  //http://bostoninvisiblebraces.com/contact/
					'indianapolis-in-dentist',
//					'awardwinningcosmeticdentist',
					'hallandale-comprehensive-dentistry',
					'south-florida-dental-implants',
					'dental-implants-wpb',
					'dentistofhackensack'
					);
//	$debug_domain='2dentist-of-franklin-tn';					
//	$debug_domain='invisalign-in-toronto';					
//	$debug_domain='the-dentist-of-scottsdale-az';					

//	if (isset($_GET['esi'])&& $_GET['esi']!="")
	$found=false;
	foreach ($domains as $domain) 
		if (strpos($_SERVER['HTTP_HOST'], $domain) !== false) $found=true;

	if ($found ) { //$flipper_type="esi";		

		$opts = array(
			'track'=>true,
			'flip'=>true,
			'server_mode'=>'esi',//'esi', //'esi','php'
			'client_mode'=>false,// 'js'
			'client_flip'=>false,// 'js'
			'keep_cookie'=>false,  //for debug options
		);
/*
		if (strpos($_SERVER['HTTP_HOST'], $debug_domain) !== false) {
			$opts['client_mode']=false;// 'js'
			$opts['client_flip']=false;
		}
*/
	};
		
/*
		$opts = array(
			'track'=>true,
			'flip'=>true,	if ($_SERVER['REMOTE_ADDR']=='5.167.32.57') $domains[]=$debug_domain;

			'server_mode'=>false, //'esi','php'
			'client_mode'=>'js',// 'js'
			'keep_cookie'=>false,  //for debug options
		);
*/

	return $opts;
}

function flipper_get_visitor_info() {
	$opts=flipper_get_settings();
	$ck=$_COOKIE;
//	if ($opts['server_mode']=='esi' && isset($_SERVER['HTTP_X_COOKIE_ONE'])) $ck=flipper_parse_cookies($_SERVER['HTTP_X_COOKIE_ONE']);
//	else $ck=$_COOKIE;
	$nfo=array();
	if (isset($ck['ref']) && $ck['ref']!="") $nfo['ref']=$ck['ref'];
	if (isset($_GET['ref']) && $_GET['ref']!="") {

		if (!$opts['keep_cookie'] || !isset($nfo['ref'])) {
			if (!isset($_COOKIE['ref']) || $_COOKIE['ref']!=$_GET['ref']) {  //isset($_COOKIE['ref'])
				setcookie('ref', $_GET['ref'],0,'/');  //, time() + 3600000000
				$_COOKIE['ref']=$_GET['ref'];
			}
			$nfo['ref']=$_GET['ref'];
		};
	};
//	echo "<!--xxx ".print_r($_COOKIE,true)." -->";

	return $nfo;
}

add_action( 'wp_ajax_nopriv_get_flipper_js', 'flipper_get_js');
add_action( 'wp_ajax_get_flipper_js', 'flipper_get_js');

add_action( 'wp_ajax_nopriv_get_flipper_phone', 'filpper_process_esi');
add_action( 'wp_ajax_get_flipper_phone', 'filpper_process_esi');

/*
$example_cookie_header = "ASIHTTPRequestTestCookie=This+is+the+value; expires=Sat, 26-Jul-2008 17:00:42 GMT; path=/tests; domain=allseeing-i.com, PHPSESSID=6c951590e7a9359bcedde25cda73e43c; path=/";

print_r(flipper_parse_cookies($example_cookie_header));

*/

function flipper_process_phone($phone,$content="", $attrs=array()) {
	$char="%";
//	$flipper_type="esi";
	$opts=flipper_get_settings();
	$flipper_type=$opts['server_mode'];	
//	$flipper_type="php";

//	print_r($opts);
//echo $content;exit;
//	if (isset($_GET['esi']) && $_GET['esi']=='true') $flipper_type="esi";	
/*
	if ( strpos($_SERVER['HTTP_HOST'], 'dentist-wilmette') !== false )  $flipper_type=$opts['server_mode'];	
	if ( strpos($_SERVER['HTTP_HOST'], 'localhost') !== false )  $flipper_type="esi";	
*/	
	

//	if (isset($_GET['esi']) && $_GET['esi']=='true') $flipper_type="esi";	

//varnish number flipper
	if ($phone!="") {


		if ($flipper_type=="esi") {
			$nfo=flipper_get_visitor_info();
//			echo "Using ESI";
	
	//		$wm4d_phone ="@".$wm4d_phone;
			$params=array();
			if ($phone!="") {
				$params[]="p=".urlencode($phone);
				if (isset($_GET['ref']) && $_GET['ref']!="") $params[]="ref=".urlencode($_GET['ref']);
				if ($content!="") $params[]="c=".urlencode($content);
				if (sizeof($attrs)>0) {
					$a=shortcode_atts(array( 'id' => '', 'only' => '', 'and' => '', 'count' => ''), $attrs );
					if ($a['id']>0) $params[]="i=".$a['id'];
				};
//				print_r($content);exit;
/*
	if ( strpos($_SERVER['HTTP_HOST'], 'he-dentist-of-scottsdale-az') !== false )
		echo "<!-- xxxxx ".print_r($_REQUEST,true)."/wp-admin/admin-ajax.php?action=get_flipper_phone&".implode("&",$params)." -->\n";
*/				
				$phone='<esi:include src="/wp-admin/admin-ajax.php?action=get_flipper_phone&'.implode("&",$params).'"/>';
	//			echo $phone;exit;
	//			$wm4d_phone=flipper_get_esi($wm4d_phone);	
			}
	// php number flipper
		} elseif ($flipper_type=="php"){
//			echo "Using PHP $phone; $content";
			$phone=flipper_flip_phone($phone);
			if ($content!="") $phone=str_replace("{$char}phone_number{$char}",$phone,$content);
				
		}
	};
	return $phone;
}
/*
function flipper_get_ref($ck,$get) {
	if ()
}
*/

function flipper_flip_phone($phone,$content="") {
	$fphone=flipper_clean_phone($phone);
	$nfo=flipper_get_visitor_info();
//	$phonesdata_loc = get_option('wm4d_phones_loc');
	
//	print_r($phonesdata_loc);exit;

	if (isset($nfo['ref']) && $nfo['ref']!="" && $fphone!="") {
		$dta=flipper_get_all();
		if (isset($dta[$nfo['ref']]) && isset($dta[$nfo['ref']][$fphone])) $fphone = $dta[$nfo['ref']][$fphone]; 
		else $fphone=$phone;
//		echo $fphone;exit;	
	};
//	echo $fphone;exit;
//print_r($nfo);
//print_r($content);exit;
//	$out="";
//print_r($_GET['b']);
	if ($content!="") $fphone=str_replace("%phone_number%",$fphone,stripslashes($content));
//	else $fphone=$phone;
	return $fphone;
}


function flipper_get_esi($phone) {
	$ref=(isset($_GET['ref'])&&$_GET['ref']!="")?"&ref=".$_GET['ref']:"";
	return '<esi:include src="/wp-admin/admin-ajax.php?action=get_flipper_phone&p='.urlencode($phone).$ref.'"/>';
}

function filpper_process_esi() {
/*
	$str="wm4d_landing=http%3A%2F%2Fdentist-wilmette.com%2F%3Fesi%3Dtrue; ref=google; __utma=221748109.1090437898.1440183930.1440183930.1440185994.2; __utmb=221748109.6.10.1440185994; __utmc=221748109; __utmz=221748109.1440183930.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none)";
//	$co=http_parse_headers($str);
	$ck = flipper_parse_cookies($str);

	print_r($ck);exit;
	print_r($_SERVER);

*/

//echo "<!-- xxxx ".print_r(flipper_parse_cookies($_SERVER['HTTP_X_COOKIE_ONE']),true)." -->";

//	$ck = flipper_parse_cookies($_SERVER['HTTP_X_COOKIE_ONE']);

	$nfo=flipper_get_visitor_info();
/*
	$ck=$_COOKIE;

	if (isset($_GET['ref']) && $_GET['ref']!="") $ck['ref']=$_GET['ref'];
*/
	$fphone=$_GET['p'];
	$phone="";
	if (isset($_GET['p']) && $_GET['p']!="")
		$phone = flipper_clean_phone($_GET['p']);

//print_r($ck['ref']);
//echo $phone;exit;

	if (isset($nfo['ref']) && $nfo['ref']!="" && $phone!="") {

//	if (isset($ck['ref']) && $ck['ref']!="" && $phone!="") {
		$dta=flipper_get_all();
//		echo "<!-- ".print_r($dta,true)."-->";
//print_r($dta[$ck['ref']][$phone]);exit;			
		if (isset($dta[$nfo['ref']])) 
			if (isset($dta[$nfo['ref']][$phone])) $fphone = $dta[$nfo['ref']][$phone]; 
			
	};
	$out="";
//	echo $fphone;exit;
//print_r($_GET['b']);
	if (isset($_GET['c']) && $_GET['c']!="") {
		$phonesdata_loc = get_option('wm4d_phones_loc');
		$out=str_replace("%phone_number%",$fphone,stripslashes($_GET['c']));
		if (isset($_GET['i']) && isset($phonesdata_loc[$_GET['i']-1]))
		$out=str_replace("%location%",$phonesdata_loc[$_GET['i']-1],$out);
	}
	else $out=$fphone;
	echo $out;
//	print_r($_GET);
//	return $fphone;
	exit;
/*
	print_r($_COOKIE);
	if (isset($dta[]))
	print_r($dta);
	exit;
*/
}
/*
function flipper_fix_shortcode( $out, $pairs, $atts ) {
	echo "in";exit;
	print_r($out);exit;
    $out['featured'] = '';
    return $out;
}
add_filter( 'shortcode_atts_phone_number', 'flipper_fix_shortcode', 10, 3 );
*/
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
	if (false && preg_match("/master-play/im",$_SERVER['HTTP_HOST'])) {
		session_start();
		$in = serialize(array('ref'=>$_COOKIE['ref'],'landing'=>$_COOKIE['wm4d_landing'],'time'=>time(),'_referer'=>$_SERVER['HTTP_REFERER']));
		$cr=$in;

		print_r($GLOBALS);
		print_r($in);
		exit;
	} else {
			$in = serialize(array('ref'=>$_COOKIE['ref'],'landing'=>$_COOKIE['wm4d_landing'],'time'=>time(),'_referer'=>$_SERVER['HTTP_REFERER']));
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
		$in="(".$m[1][0].") ".$m[2][0]."-".$m[3][0];
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
//	print_r($_POST);exit;

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
	$domain=$_SERVER['HTTP_HOST'];
	if (isset($_GET['flipper_domain_debug'])&& $_GET['flipper_domain_debug']!="") $domain=$_GET['flipper_domain_debug'];
	elseif (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!="") {
//		echo $_SERVER['HTTP_REFERER'];
		parse_str(parse_url($_SERVER['HTTP_REFERER'],PHP_URL_QUERY),$nfo);
		if (isset($nfo['flipper_domain_debug']) && $nfo['flipper_domain_debug']!="") $domain=$nfo['flipper_domain_debug'];
//		print_r($nfo);
	}

	$options=array('action'=>'get_campaign_by_domain','request'=>array('d'=>$domain));
	$res=json_decode(flipper_do_api_request($options));
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
	$options['request']['k']=$key;

	$url="http://mx.wm4d.com/api/";
//	$url="http://localhost/mx/api/";

/*
	if ($options['action']=='set_campaign_referers') {
//	print_r($options);	exit;	

	};
*/
//	echo $url;exit;
	$req=array();
	foreach ($options['request'] as $k=>$v) $req[]="$k=".urlencode($v);
/*


	$domain=$_SERVER['HTTP_HOST'];
	if (isset($_GET['flipper_domain_debug'])&& $_GET['flipper_domain_debug']!="") $domain=$_GET['flipper_domain_debug'];
	elseif (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!="") {
//		echo $_SERVER['HTTP_REFERER'];
		parse_str(parse_url($_SERVER['HTTP_REFERER'],PHP_URL_QUERY),$nfo);
		if (isset($nfo['flipper_domain_debug']) && $nfo['flipper_domain_debug']!="") $domain=$nfo['flipper_domain_debug'];
//		print_r($nfo);
	}
*/
//	exit;
//	$domain="dentistofnorcross.com";
//	$domain="http://miamibreastreconstruction.com/";
//
//	$request="get_campaign_by_domain?k=$key&d=".urlencode($domain);
	
	$request=$options['action']."?".implode("&",$req);
//	echo $request;exit;
/*
	if ($options['action']=='set_campaign_referer') {
		echo $url.$request;
//	print_r($options);	
		exit;	

	};
*/
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
	$ctemp =	flipper_get_numbers();
	$campaigns=array();
	foreach ($ctemp->campaigns as $cmp) {
		if (isset($cmp->postback_params->phone_clean) && $cmp->postback_params->phone_clean!="")
			$campaigns[$cmp->postback_params->phone_clean]=$cmp;
	};
//print_r($campaigns);print_r($_POST);exit;
	$data=array();


	if (isset($_POST['wm4d_flipper_phone']))
	  foreach ($_POST['wm4d_flipper_phone'] as $lne) {
		  $row=explode(":",$lne);
		  if (sizeof($row)==2 && isset($campaigns[$row[1]])) {
			  $data[]=array('ref'=>$row[0],'phone'=>$row[1], 'campaign'=>$campaigns[$row[1]]->f_cmpid,'domain'=>$_SERVER['HTTP_HOST']);
		  };
	  };

	if (isset($_POST['wm4d_flipper_phones']))
	  foreach ($_POST['wm4d_flipper_phones'] as $lne) {
		  $row=explode(":",$lne);
		  if (sizeof($row)==3 && isset($campaigns[$row[2]])) {
			  $data[]=array('idx'=>$row[0],'ref'=>$row[1],'phone'=>$row[2], 'campaign'=>$campaigns[$row[2]]->f_cmpid,'domain'=>$_SERVER['HTTP_HOST']);
		  };
	  };
	if (isset($data) && sizeof($data)>0)
//	print_r($data);exit;	
		flipper_do_api_request(array('action'=>'set_campaign_referers','request'=>array('data'=>serialize($data))));
//		print_r(flipper_do_api_request(array('action'=>'set_campaign_referers','request'=>array('data'=>serialize($data)))));exit;
/*
	foreach ($data as $dta) {
		flipper_do_api_request(array('action'=>'set_campaign_referer','request'=>$dta));
//		print_r(flipper_do_api_request(array('action'=>'set_campaign_referer','request'=>$dta)));exit;
	};
*/

//	print_r($_POST['wm4d_select_options']=='multiple');exit;
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


function flipper_parse_cookies($header) {
	
	$cookies = array();
	
	$cookie = new fcookie();
	
	$parts = explode("=",$header);
	for ($i=0; $i< count($parts); $i++) {
		$part = $parts[$i];
		if ($i==0) {
			$key = $part;
			continue;
		} elseif ($i== count($parts)-1) {
			$cookie->set_value($key,$part);
			$cookies[] = $cookie;
			continue;
		}
		$comps = explode(" ",$part);
		$new_key = $comps[count($comps)-1];
		$value = substr($part,0,strlen($part)-strlen($new_key)-1);
		$terminator = substr($value,-1);
		$value = substr($value,0,strlen($value)-1);
		$cookie->set_value($key,$value);
		if ($terminator == ";") {
			$cookies[] = $cookie;
			$cookie = new fcookie();
		}
		
		$key = $new_key;
	}
	$ck=array();
	foreach ($cookies as $cobj) $ck[$cobj->name]=$cobj->value;
//	return $cookies;
	return $ck;
}

class fcookie {
	public $name = "";
	public $value = "";
	public $expires = "";
	public $domain = "";
	public $path = "";
	public $secure = false;
	
	public function set_value($key,$value) {
		switch (strtolower($key)) {
			case "expires":
				$this->expires = $value;
				return;
			case "domain":
				$this->domain = $value;
				return;
			case "path":
				$this->path = $value;
				return;
			case "secure":
				$this->secure = ($value == true);
				return;
		}
		if ($this->name == "" && $this->value == "") {
			$this->name = $key;
			$this->value = $value;
		}
	}
}

function flipper_escape_var($content,$var="phone_number") {
	return str_replace("%{$var}%", "@{$var}@", $content);
}

function flipper_unescape_var($content,$var="phone_number") {
	return str_replace("@{$var}@", "%{$var}%", $content);
}

function flipper_wptouch_escape($in) {
	$res=array('out'=>$in,'tag'=>'');
	if (preg_match("/(<esi[^>]+>)/im",$in,$m)) {
//		echo "<!-- ".print_r($m[1],true)."-->";
		$res['tag']=$m[1];
		$res['out']=str_replace($m[1],"[@ESI@]",$in);
	};
	return $res;
}

function flipper_wptouch($in) {
	$res=flipper_wptouch_escape($in);
	$res['out'] = strip_tags($res['out']);
	$res['out'] = str_replace("[@ESI@]",$res['tag'],$res['out']);
//	$res['out']=strip_tags($res['out']);
	return $res['out'];
}

$opts=flipper_get_settings();
if ($opts['server_mode']) {
//	echo "<!-- server_mode: ".$opts['server_mode']." -->";
	add_action( 'wp_loaded', 'flipper_init' );
//	add_action( 'after_setup_theme', 'flipper_init' );
};

function flipper_wm4d_phone($attrs, $content = null) {
//			echo "<!-- YYY ".print_r($attrs,true)."-->";
	$wm4d_phone = get_option('wm4d_phone');
	$wm4d_phone=flipper_process_phone($wm4d_phone, $content);
	return $wm4d_phone;

//		return flipper_process_phone(get_option('wm4d_phone'), $res);

}


	function flipper_wm4d_phones($attrs, $content = null) {
//		$attrs['phone']=flipper_escape_var($attrs['phone']);
//		print_r("innnn");exit;
		if ($content!="") $attrs['only']='phone';

		$res=wm4d_phones($attrs, $content);
//		echo $res;exit;
		extract(shortcode_atts(array( 'id' => '', 'only' => '', 'and' => '', 'count' => ''), $attrs ));

		if (true || $_SERVER['REMOTE_ADDR']=='5.167.32.57') {
			if ($only=='phone') {
	//			$phones=get_option('wm4d_phones');
//				echo $id;//exit;if ($id>0) 
				$res=flipper_process_phone($res, $content, $attrs);

			};
//			echo "<!-- YYY ".$res."-->";
//			echo "<!-- XXX ".print_r($attrs,true)." ".$content." -->";
		};

		if ($content!="") {
			$phonesdata_loc = get_option('wm4d_phones_loc');
//			print_r($phonesdata_loc[$id-1]);
//print_r($phonesdata_loc[$id-1]);exit;
//			if ($id!="") 
			$res=str_replace("%location%",$phonesdata_loc[$id-1],$res);
		};
//echo $res;exit;
//		print_r("||||".$res."||||");//exit;

		return $res;

//		return flipper_process_phone(get_option('wm4d_phone'), $res);
	
	}


function flipper_init() {
//	echo "<!-- ".print_r(get_defined_functions(),true)."-->";
	define('FLIPPER_INIT',true);
//	echo "<!-- ESI enabled-->";


//WM4D Options Support
/*
	if (true || function_exists("wm4d_phone")) {	
		echo "<!-- wm4d_phone-->";
		remove_shortcode ( "phone_number");	
		add_shortcode ( "phone_number", "flipper_wm4d_phone");		
	}
	function flipper_wm4d_phone($attrs, $content = null) {
//		$attrs['phone']=flipper_escape_var($attrs['phone']);
		$res=wm4d_phone($attrs, $content);
//		$phone=get_option('wm4d_phone');
//		$res="<!--XXX ".print_r($attrs,true)."-->".$res;
		return flipper_process_phone(get_option('wm4d_phone'), $res);
	
	}
*/

	if (function_exists("wm4d_phone")) {	
//		echo "<!-- wm4d_phone ".print_r(get_option('wm4d_phone'),true)."-->";

		remove_shortcode ( "phone_number");	
		add_shortcode ( "phone_number", "flipper_wm4d_phone");		
	}


	if (function_exists("wm4d_phones")) {	
//		echo "<!-- wm4d_phones ".print_r(get_option('wm4d_phones'),true)."-->";

		remove_shortcode ( "phone_numbers");	
		add_shortcode ( "phone_numbers", "flipper_wm4d_phones");		
	}
/*
	add_filter( 'wm4d_phones', 'flipper_get_wm4d_phones');
	function flipper_get_wm4d_phones($phones) {

		return $phones;
	}
*/

//Soulmedic wm4d Support



//Soulmedic Geo Support
	if (/*get_current_theme()=='soulmedic Geo' && */function_exists("dt_sc_phone_edited")) {	
//		echo "<!-- FLIPPERIN-->";
		remove_shortcode ( "dt_sc_phone");	
		add_shortcode ( "dt_sc_phone", "flipper_dt_sc_phone_edited");		
	}
	function flipper_dt_sc_phone_edited($attrs, $content = null) {
//		$attrs['phone']=flipper_escape_var($attrs['phone']);
		$res=dt_sc_phone_edited($attrs, $content);
		
		if ($attrs['phone']=="%phone_number%") {
			$phone=get_option('wm4d_phone');
			$res=str_replace($phone,"%phone_number%",$res);
			$res=flipper_process_phone($phone, $res);

		} else {
			$phones=get_option('wm4d_phones');
			if (!is_array($phones)) $phones=array();
	//		if ($phone!="") $phones[]=$phone;

//			echo "<!--XXX ".print_r($res,true)."-->";	
			
			foreach ($phones as $i=>$ph) 
				if ($attrs['phone']=="%phone_number_".($i+1)."%") {
					$res=str_replace($ph,"%phone_number%",$res);
					$attrs['id']=$i+1;
					$res=flipper_process_phone($ph, $res,$attrs);
				};
		}
/*

//		$res=flipper_unescape_var($res);
//		return flipper_process_phone(get_option('wm4d_phone'), $res);


		foreach ($phones as $i=>$ph) {
			$attrs['id']=$i+1;
			$res=flipper_process_phone($ph, $res,$attrs);
		}
*/
		return $res;
	
	}
//	if (strpos($_SERVER['HTTP_HOST'], $domain) !== false) $found=true;

	if ((strpos($_SERVER['HTTP_HOST'], 'south-florida-dental-implants') === false) && get_current_theme()=='soulmedic Geo' && function_exists("responsive_map_shortcode_edited")) {	
//		echo "<!-- ".get_current_theme()."-->";
		remove_shortcode ( "res_map");	
		add_shortcode ( "res_map", "flipper_responsive_map_shortcode_edited");		
	}
	function flipper_responsive_map_shortcode_edited($attrs, $content = null) {
//		$attrs['description']=flipper_escape_var($atts['description']);
		$res=responsive_map_shortcode_edited($attrs);
		$phone=get_option('wm4d_phone');
		$res=str_replace($phone,"%phone_number%",$res);
//		$res="<!--YYY ".print_r($attrs,true)."-->".$res;

//		$res=flipper_unescape_var($res);		
		return flipper_process_phone($phone, $res);
	}

//Old Multisite Support
	if (function_exists("wm4d_shortcode_local_phone")) {	

#		if ($_SERVER['REMOTE_ADDR']=='5.167.32.57') {
//			echo "<!-- XXXXX -->";
			remove_shortcode( 'dentist_phone');
			add_shortcode( 'dentist_phone', 'flipper_wm4d_shortcode_local_phone' );

			remove_shortcode( 'local_phone');
			add_shortcode( 'local_phone', 'flipper_wm4d_shortcode_local_phone' );

			remove_shortcode( 'dentist_local_phone');
			add_shortcode( 'dentist_local_phone', 'flipper_wm4d_shortcode_local_phone' );


#		};
	};

/*

flipper_process_phone
*/
}

//Old Multisite Support
function flipper_wm4d_shortcode_local_phone($attrs,$content ="") {
	$res=wm4d_shortcode_local_phone();
	$opts = get_option( 'dentist_options' );
	if ($content!="")
		$res=$content;
//	if ($res!=$opts['local_phone'])
	else  //"";//
		$res=str_replace($opts['local_phone'],"%phone_number%",$res);


//	echo "<!--YYY ".print_r($attrs,true)." $content -->";

	$res = flipper_process_phone($opts['local_phone'], $res);

//	echo "<!--ZZZ ".print_r($attrs,true)." $res -->";

	return $res;
};



//Soulmedic Geo Support


//$str="v0CJI1NhtR2YCHOv6Dv98/Y9twEcUAf2iAkQzWpvrkQkaN89C5MaBqKDE/JKSKTGVo2apMBm8YUJZcbun4krCw==";
//print_r(unserialize(flipper_wm4d_rid_decode($str)));
//echo $_COOKIE['ref'];


?>