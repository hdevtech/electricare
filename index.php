<?php
	//ob_start("ccc");function ccc($codedata) {$searchdata = array( '/\>[^\S ]+/s','/[^\S ]+\</s','/(\s)+/s');$replacedata = array('>','<','\\1');$codedata = preg_replace($searchdata, $replacedata, $codedata);return $codedata;}
	  $link = ['hdev_c/executor/include','hdev_c/catch','hdev_c/head','hdev_c/menu','hdev_c/body','hdev_c/footer'];
	  foreach ($link as $linkage) {
	    include $linkage.'.php';
	  }
	  //ob_end_flush();
 ?>