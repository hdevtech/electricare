<?php 
	$regpath = __DIR__;
	$regd = str_ireplace('\\', "/", $regpath).'/qr_3/roger_cd/qrlib.php';
	require_once $regd;
	$back_color = 0xFFFFFF;
	$fore_color = 0x2F64B3;// BLUE 
	//$fore_color = 0x000000; // red
	$var = hdev_data::decd(urldecode($er_rasms_qqrrccdd));
	$tab = str_ireplace("\t", "", $var);
	//echo $tab;
	$direct = QRcode::png($tab, false, 'm', 4, 3, false, $back_color, $fore_color);
 ?>