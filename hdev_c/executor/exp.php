<?php 
	//HDEV GMS DEFINITIONS
	$language_definition = array("kiny","eng");
	$lang=array( 
		"menu"=>array(
				"kiny"=>array(
					"home"=>"Ahabanza",
					"announce"=>"Amatangazo",
					"media" => "Itangaza Makuru",
					"news" => "Amakuru",
					"leasson" => "Inyigisho",
					"posted" => "Byashyizweho",
					"ideas" => "Ibitekerezo",
					"forum" => "Urubuga rw'ibitekerezo",
					"lv_msg" => "Siga Ubutumwa",
					"name" =>"Amazina",
					"services"=>"Serivisi",
					"servicesall"=>"Serivisi zose",
					"about"=>"Ibyerekeye ".APP_NAME,
					"contact"=>"Tuvugishe",
					"lang"=>"Ururimi",
					"settings"=>"Amagenamiterere",
					"gn_st"=> "Amagenamiterere rusange",
					"mod_info"=>"Module information",
					"logout"=> "Sohoka",
					"login"=>"Injira",
					"profile" => "Umwirondoro",
					"my_profile" => "Umwirondoro wanjye",
					"user_reg"=>"Imyirondoro",
					"year_info" => "Ibijyanye N'imyaka",
					"agents" => "Abahagarariye",
					"provider" => "Uatanga inyigisho",
					"house"=>"Inzu",
					"tenant"=>"Umupangayi",
					"my_rent"=>"Ubukode Bwanjye",
					"applications"=>"Ubusabe bwanjye",
					"my_payments"=>"Ubwishyu Bwanjye",
					"act_rent"=>"Ubukode bwishyuwe Neza",
					"txs"=>"Raporo Y'ayinjiye",
					"inc_tx"=>"Ayinjijwe",
					"ld_payments"=>"Ubwishyu Bwa Uatanga inyigisho",
					"ld_received"=>"Ubwishyu Bwanjye",
					"approve_provider"=>"Kwemerera Utanga inyigisho",
					"wait_approve"=>"Gitegereje Kwemezwa",
					"approve_house"=>"Inzu ziri Mu igenzurwa",
					"deleted_house"=>"Inzu Zasibwe",
					"deleted_provider"=>"Ba Uatanga inyigisho basibwe",
					"deleted_agent"=>"Abahagarariye basibwe",

					"memb_info" => "Ibiranga abanyamuryango"
				),
				"eng"=>array(
					"home"=>"Home",
					"announce"=>"Announcements",
					"media" => "Media",
					"news" => "News",
					"leasson" => "Leasson",
					"posted" => "Posted",
					"ideas" => "Ideas",
					"forum" => "Forum",
					"lv_msg" => "Leave  message",
					"name" =>"Names",
					"services"=>"Services",
					"servicesall"=>"All Services",
					"about"=>"About ".APP_NAME,
					"contact"=>"Contact us",
					"lang"=>"Language",
					"settings"=>"Settings",
					"gn_st"=> "General Settings",
					"mod_info"=>"Module information",
					"logout"=> "Log out",
					"login"=>"Log in",
					"profile" => "Profile",
					"my_profile" => "My profile",
					"user_reg"=>"Users registration",
					"year_info" => "Year Info",
					"agents" => "Agents",
					"provider" => "Provider",
					"house"=>"House",
					"tenant" => "Tenant",
					"my_rent"=>"My rent",
					"applications"=>"My applications",
					"my_payments"=>"My Payments",
					"act_rent"=>"My Active Rents",
					"txs"=>"Income Report",
					"inc_tx"=>"My Income",
					"ld_payments"=>"Provider Payments",
					"ld_received"=>"My payouts",
					"approve_provider"=>"Provider Approval",
					"wait_approve"=>"Waiting For Approval",
					"approve_house"=>"Houses Approval",
					"deleted_house"=>"Deleted Houses",
					"deleted_provider"=>"Deleted Providers",
					"deleted_agent"=>"Deleted Agent",

					"memb_info" => "Members Identity"
				)
			),
		"form"=>array(
				"kiny" => array(
					"load"=> "Mwihangane... ibyo mwasabye birimo gukorwa!!!",
					"username" => "Izina rikuranga",
					"password" => "Ijambobanga",
					"signin" => "injira",
					"signin_form" => "Kwinjira",
					"edit" =>"hindura",
					"view" => "Reba",
					"delete" => "Siba",
					"close" => "Funga",

				),
				"eng"=>array(
					"load"=> "loading... please wait!!!",
					"username" => "Username",
					"password" => "password",
					"signin" => "Sign in",
					"signin_form" => "Sign in form",
					"edit" =>"Edit",
					"view" => "View",
					"delete" => "Delete",
					"close" => "Close",

					
				)
			),
		"data"=>array(
			"kiny" => array(
				),
			"eng" => array(

				)
			),
		"validation"=>array(
			"kiny" => array(
				"signedin" => "winjiye",
				"log_fair" => "Ntakonti ihuye nibyo mwanditse",
				"acc_exist" => "that account name already exists try diferrent one",
				"error_try_again" => "error try again later",
				"share_numeric" => "share amount must be numeric",
				"all_fields" => "uzuza imyanya yose",
				"acc_name_exist" => "Acount with provided name already exists",
				"acc_up_not_exist" => "the account desired to be updated does not exist",
				"acc_cnt_up" => "can't update this account with provided changes please try again",
				"acc_ref_cnt" => "can't match account name and referenced account",
				"saving" => "Saving... wait!!!",
				"loading" => "loading.....",
				"saved" => "Saved !!!",
				"acc_undetect" => "no account detected refresh a page and try again",
				"check_conn" => "error  check your internet connection",
				"error_try_part" => "few records were not updated",
				"l_found" => "Found and Fetched",
				"l_not_found" => "No records found",
				),
			"eng" => array(
				"signedin" => "Signed in!!",
				"log_fair" => "No account found for what you provided",
				"acc_exist" => "that account name already exists try diferrent one",
				"error_try_again" => "error try again later",
				"share_numeric" => "share amount must be numeric",
				"all_fields" => "Fill all fields",
				"acc_name_exist" => "Acount with provided name already exists",
				"acc_up_not_exist" => "the account desired to be updated does not exist",
				"acc_cnt_up" => "can't update this account with provided changes please try again",
				"acc_ref_cnt" => "can't match account name and referenced account",
				"saving" => "Saving... wait!!!",
				"loading" => "loading.....",
				"saved" => "Saved !!!",
				"acc_undetect" => "no account detected refresh a page and try again",
				"check_conn" => "error  check your internet connection",
				"error_try_part" => "few records were not updated",
				"l_found" => "Found and Fetched",
				"l_not_found" => "No records found",
				)
			)
	);
	///initialise language function to receceive and array of language definitions
	hdev_lang::reset();
	hdev_lang::set($lang);
	if (empty($_SESSION["lang"])) {
		$_SESSION["lang"] ="eng";
	}
	if ($_GET) {
		if (isset($_GET['lang'])) {
	      if (!empty($_GET['lang'])) {
	        if (in_array($_GET['lang'], $language_definition)) {
	        	$_SESSION['lang'] = $_GET['lang'];
	        	hdev_note::message("Ururimi rwahinduwe neza----Language changed");
	        	if (!empty($_GET["nxt"])) {
	        		hdev_note::redirect(hdev_url::activate($_GET["nxt"]));
	        	}
	        	else{
	        		hdev_note::redirect(hdev_url::get_url_host());
	        	}
	        }else{
	        	hdev_note::message("Ururimi wahisemo ntirwashoboye kuboneka --- Language selected does not exist");
	        	if (!empty($_GET["nxt"])) {
	        		hdev_note::redirect(hdev_url::activate($_GET["nxt"]));
	        	}
	        	else{
	        		hdev_note::redirect(hdev_url::get_url_host());
	        	}
	        }
	      }
	    }		
	}
	//$langg = $_SESSION['lang'];
	//$_SESSION['exp'] = $lang;
 ?>