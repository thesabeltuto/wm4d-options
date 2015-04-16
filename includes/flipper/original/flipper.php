<?php

function flipper_adding_scripts() {
//	wp_register_script('flipper-script', plugins_url('/js/flipper.js.php' ,dirname(__FILE__)),'','1.1', true);
	wp_register_script('flipper-script', '/wp-admin/admin-ajax.php?action=get_flipper_js','','1.1', true);

//admin_url( 'admin-ajax.php?action=get_flipper_js', 'relative' );
	wp_enqueue_script('flipper-script');
}
function flipper_get_replace1() {
	$res=array();
	$k=get_option('wm4d_phone');
	if ($k!="") {	
		$tmp = split("\n",get_option('wm4d_flipper_phone'));
		foreach ($tmp as $lne) {
			$row=split(":",$lne);
			$res[$row[0]][$k] = $row[1];
		};
	}
	return $res;
}
/*

function flipper_get_replace1_by_ref($ref) {
	$tmp = split("\n",get_option('wm4d_flipper_phone'));
	$res=false;
	foreach ($tmp as $lne) {
		$row=split(":",$lne);
		if ($row[0]==$ref) {
			$res = $row[1];
			break;
		};
	};
	return $res;
}

function flipper_get_replace_many_by_ref($ref) {
	$tmp = split("\n",get_option('wm4d_flipper_phones'));
	$res=array();
	foreach ($tmp as $lne) {
		$row=split(":",$lne);
//	print_r($tmp);exit;
		
		if ($row[1]==$ref) {
			$res[$row[0]] = $row[2];

		};
		
	};
	return $res;
}
function flipper_get_by_ref($ref) {
	$k=get_option('wm4d_phone');
	$res=array();
	if ($k!="" && $v=flipper_get_replace1($ref)) $res[$k]=$v;
	
	$tmp2 = flipper_get_replace_many($ref);
	$kk=split("\n",get_option('wm4d_phones'));
//	print_r($kk);exit;
	foreach ($kk as $k=>$v) 
		if (isset($tmp2[$k+1])) {
			$vv=split(":",$v);
			$res[$vv[0]] = $tmp2[$k+1];
		}
	return $res;
//	print_r($res);

}
*/

function flipper_get_replace_many() {
	$tmp = split("\n",get_option('wm4d_flipper_phones'));
	$res=array();
	foreach ($tmp as $lne) {
		$row=split(":",$lne);
//	print_r($tmp);exit;

		$res[$row[1]][$row[0]] = chop($row[2]);
		
	};
	return $res;
}



function flipper_get_all() {
//	$k=get_option('wm4d_phone');
	$res=flipper_get_replace1($ref);
//	$res['yahoo']['[dentist_local_phone]']='111-111-1111';
//	if ($k!="" && $v=flipper_get_replace1($ref)) $res['_all'][$k]=$v;
//	print_r($res);	exit;
	$tmp2 = flipper_get_replace_many($ref);
//	print_r($tmp2);
	$kk=split("\n",get_option('wm4d_phones'));

	foreach ($tmp2 as $r=>$row) 

		foreach ($row as $k=>$v) 
			if (isset($kk[$k-1])) {
				$kkk=split(":",$kk[$k-1]);
				$vv=split(":",$v);
				$res[$r][$kkk[0]] = chop($v);//$tmp2[$k+1];
			}

//	print_r($res);exit;

	return $res;
//	print_r($res);

}
/*

function flipper_get_ref() {
	$ref="";
	if ($_GET['ref']!="") {
		$_COOKIE['ref']=$_GET['ref'];
		$ref=$_COOKIE['ref'];
//	print_r($_GET);exit;

	} elseif ($_COOKIE['ref']!="") {
		$ref=$_COOKIE['ref'];
	}
	return $ref;
}
*/
function flipper_get_js() {
	include("flipper.js.php");
	exit;
}

//if (true) {
	if (get_option('wm4d_flipper_select')=="enable") {
//	if (preg_match("/master-play/im",$_SERVER['HTTP_HOST'])) {
//		echo "<!-- flipper test ".get_option('wm4d_flipper_select');
		add_action( 'wp_enqueue_scripts', 'flipper_adding_scripts' );  

//		echo plugins_url('/js/flipper.js.php' ,__FILE__);
//		echo "-->";
	};



add_action( 'wp_ajax_nopriv_get_flipper_js', 'flipper_get_js');
add_action( 'wp_ajax_get_flipper_js', 'flipper_get_js');


//}
?>