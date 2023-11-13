<?php 
	if (!empty($_COOKIE["uid"]))) {
		$_SESSION["uid"] = $_COOKIE["uid"];
	}

	if (empty($_SESSION["uid"]) || empty($_SESSION["uid"])) {
	}
 ?>