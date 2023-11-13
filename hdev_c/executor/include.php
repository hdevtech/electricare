<?php 
	session_start();
	$defpath = getcwd().DIRECTORY_SEPARATOR."hdev_c".DIRECTORY_SEPARATOR."executor".DIRECTORY_SEPARATOR."control".DIRECTORY_SEPARATOR;

	$l = ['set','url_service','service'];
	foreach ($l as $linkage) {
		$regpath = __DIR__;
  		$regd = str_ireplace('\\', "/", $regpath);
    	include $regd.'/'.$linkage.'.php';
  	}
  	$l2 = ['session_url','search','auth','log','menu','url','route_body','notification','lang','csrf_protect','db_init','db_pager','backup'];
  	foreach ($l2 as $link) {
  		include $defpath.$link.".php";
  	}
  	
	$regpath = __DIR__;
  	$regd = str_ireplace('\\', "/", $regpath);
    include $regd.'/'.'real_executor'.'.php'; 
    $regpath = __DIR__;
  	$regd = str_ireplace('\\', "/", $regpath);	
  	include $regd.'/'.'exp'.'.php';

 ?>