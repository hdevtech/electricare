<?php
	//ob_start("ccc");function ccc($codedata) {$searchdata = array( '/\>[^\S ]+/s','/[^\S ]+\</s','/(\s)+/s');$replacedata = array('>','<','\\1');$codedata = preg_replace($searchdata, $replacedata, $codedata);return $codedata;}
	  //echo 
	  $link = ['hdev_c/body'];
	  foreach ($link as $linkage) {
	    include getcwd().DIRECTORY_SEPARATOR.$linkage.'.php';
	  }
	  //ob_end_flush();
 ?>