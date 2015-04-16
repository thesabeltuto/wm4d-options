<?php /* Flipper by Andrey */

add_action( 'wp_ajax_nopriv_get_flipper_js', 'flipper_get_js');
add_action( 'wp_ajax_get_flipper_js', 'flipper_get_js');

function flipper_adding_scripts() {
	wp_register_script('flipper-script', '/wp-admin/admin-ajax.php?action=get_flipper_js','','1.1', true);
	wp_enqueue_script('flipper-script');
}

function flipper_get_js() {
	include("flipper.js.php");
	exit;
}

if (get_option('wm4d_flipper_select')=="enable") {
	add_action( 'wp_enqueue_scripts', 'flipper_adding_scripts' );  
};

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

function flipper_get_replace_many() {
	$tmp = split("\n",get_option('wm4d_flipper_phones'));
	$res=array();
	foreach ($tmp as $lne) {
		$row=split(":",$lne);

		$res[$row[1]][$row[0]] = chop($row[2]);
		
	};
	return $res;
}

function flipper_get_all() {
	$res=flipper_get_replace1($ref);
	$tmp2 = flipper_get_replace_many($ref);
	$kk=split("\n",get_option('wm4d_phones'));

	foreach ($tmp2 as $r=>$row) 

		foreach ($row as $k=>$v) 
			if (isset($kk[$k-1])) {
				$kkk=split(":",$kk[$k-1]);
				$vv=split(":",$v);
				$res[$r][$kkk[0]] = chop($v);//$tmp2[$k+1];
			}
	return $res;

}
?>