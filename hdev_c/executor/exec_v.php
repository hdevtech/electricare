<?php  
//sleep(10);
	if ($_GET) {
		if (isset($_GET['ref'])) {
			switch ($_GET['ref'] && isset($_GET['hash']) ) {
				case 'slide':
					if (isset($_GET['id']) && isset($_GET['hash']) && md5($_GET['id']) == $_GET['hash']) {
						$data = new hdev_db;
						$table = $data->table("slider");
						$id = $_GET['id'];
						if (!hdev_data::service('slide')) {
							exit('Access denied to you!');
						}
						$sql = $data->insert("DELETE FROM $table WHERE p_id=:p_id",[[':p_id',$id]]);
						if ($sql == "ok") {
							hdev_note::message($_GET['ref'].' deleted');
							hdev_note::redirect(hdev_url::menu('modify/slide'));
						}else {
							hdev_note::message('something went wrong');
							hdev_note::redirect(hdev_url::menu('modify/slide'));
						}
					}else{

							hdev_note::message('try again later');
							hdev_note::redirect(hdev_url::menu('modify/slide'));
					}
				break;
				
				default:
					echo "error occured please try again";
					hdev_note::message('error occured please try again later');
					hdev_note::redirect(hdev_url::menu('modify/slide'));
					break;
			}
			exit();
		}
	}
	if ($_POST) {
		if (!empty($_POST['ref'])) { 
			$rasms_stc = new hdev_auth_service('',trim($_POST['ref']));
			if ($rasms_stc->access()) {
				/// access granted 
			}else{
			  $rasms_stc->error('danger');
			}

  		switch ($_POST['ref']) {
  			case 'login':
  				
				if (!empty($_POST['usn']) && !empty($_POST['psw'])) {
					hdev_v::login($_POST["usn"],$_POST['psw']);
				}else{
					hdev_note::message(hdev_lang::on("validation","log_fair"));
	        		//hdev_note::redirect(hdev_url::get_url_host()."/h/login");
				}
 
			break;
  			case 'service_api':
  				$services_array = array();
				$services = hdev_data::action();
				foreach($services as $service){
					array_push($services_array, array("id"=>$service['s_id'],"name"=>$service['s_name']));
				}
				//json encode services array
				echo json_encode($services_array);
			break;
  			case 'fault_api':
  				$faults_array = array();
				$faults = hdev_data::fault();
				foreach($faults as $fault){
					array_push($faults_array, array("id"=>$fault['f_id'],"name"=>$fault['f_name']));
				}
				//json encode services array
				echo json_encode($faults_array);
			break;

			case 'send_reset_code':
				$csrf = new CSRF_Protect();
    			$csrf->verifyRequest();
				if (!empty($_POST['tell'])) {
					$tel = $_POST['tell'];
					if (hdev_data::phone_valid($tel)) {
      					exit(hdev_data::phone_valid($tel));
      				}
					$user = hdev_data::get_admin($tel,['tel']);
					$send_code = 0;
					if (is_array($user) && count($user) > 0) {
						$code = rand();
						$mask1 = time();
						$sent = md5($code.$mask1);
						$sent_og = strtoupper(substr($sent, 0, 6));
						//$sent_og = 12345;

						$code2 = $csrf->getToken();
						$mask2 = $sent_og.'-'.$code2.'-'.$tel;
						$mask = md5($mask2);
						$stmg = "Your Reset Code Is: ".$sent_og;
						hdev_note::live_sms($tel,$stmg);
						$send_code = 1;

					}else{
						$user = hdev_data::employee($tel,['tel']);
						$send_code = 0;
						if (is_array($user) && count($user) > 0) {
							$code = rand();
							$mask1 = time();
							$sent = md5($code.$mask1);
							$sent_og = strtoupper(substr($sent, 0, 6));
							//$sent_og = 1234;

							$code2 = $csrf->getToken();
							$mask2 = $sent_og.'-'.$code2.'-'.$tel;
							$mask = md5($mask2);
							$stmg = "Your Reset Code Is: ".$sent_og;
							hdev_note::live_sms($tel,$stmg);
							$send_code = 1;

						}

					}

					if ($send_code == 1) {
						$return['act'] = "success";
						$return['message'] = "Code Sent to: ".$tel;
						$return['mask'] = $mask;
						$return['tel'] = $tel;
					}else{
						$return['act'] = "error";
						$return['message'] = "Something went Wrong Try again later";
					}
      				echo json_encode($return);
				}else{
					$return['act'] = "error";
					$return['message'] = "Telephone number can't be empty";
					echo json_encode($return);
				}
			break;	
			case 'enter_code':
				$csrf = new CSRF_Protect();
    			$csrf->verifyRequest();
				if (!empty($_POST['mask']) && !empty($_POST['tel']) && !empty($_POST['code'])) {
					$mask = $_POST['mask'];
					$code = $_POST['code'];
					$tel = $_POST['tel'];

					$sent_og = strtoupper(trim($code));
					$code2 = $csrf->getToken();
					$mask2 = $sent_og.'-'.$code2.'-'.$tel;
					$mask_code = md5($mask2);


					if ($mask_code == $mask) {
						$user = hdev_data::get_admin($tel,['tel']);
						$profiles = "";
						foreach ($user as $users) {
							$profiles .= '<option value="'.$users['a_id']."-".$users['a_role'].'">'.$users['a_email'].'</option>';
						}

						if ($profiles != "") {
							$return['act'] = "success";
							$return['message'] = "Entered Code Validated !";
							$return['profiles'] = $profiles;
							$return['mask2'] = $mask.'-'.$code;
							$return['tel'] = $tel;
						}else{
							$return['act'] = "error";
							$return['message'] = "Something went Wrong Try again later";
						}
					}else{
						$return['act'] = "error";
						$return['message'] = "Code Entered is invalid or expired.";
					}
      				echo json_encode($return);
				}else{
					$return['act'] = "error";
					$return['message'] = "All Fields are required";
					echo json_encode($return);
				}
			break;	
			case 'reset_password':
					//var_dump($_POST);
				$csrf = new CSRF_Protect();
    			$csrf->verifyRequest();
				if (!empty($_POST['mask']) && !empty($_POST['tel']) && !empty($_POST['user']) && !empty($_POST['pass_1']) && !empty($_POST['pass_2'])) {
					$mask = $_POST['mask'];
					$tel = $_POST['tel'];
					$user_mix = $_POST['user'];
					$pass_1 = $_POST['pass_1'];
					$pass_2 = $_POST['pass_2'];

					$user_array = explode('-',$user_mix);
					if (isset($user_array[0]) && isset($user_array[1])) {
						$user = $user_array[0];
						$role = $user_array[1];
					}else{
						$return['act'] = "error";
						$return['message'] = "something went wrong try again later";
						echo json_encode($return);
						exit();
					}

					$mask_part = explode('-', $mask);
					if (isset($mask_part[0]) && isset($mask_part[1])) {
						$code = $mask_part[1];
						$mask = $mask_part[0];
					}else{
						$code = 0;
						$mask = 1;
					}

					$sent_og = strtoupper(trim($code));
					$code2 = $csrf->getToken();
					$mask2 = $sent_og.'-'.$code2.'-'.$tel;
					$mask_code = md5($mask2);


					if ($mask_code == $mask) {
						if ($pass_1 == $pass_2) {
							$rt = new hdev_db();
							$password = hdev_data::password_enc($pass_1);
							switch ($role) {
								case 'admin':
								case 'main_admin':
									$tab = $rt->table('main_auths');
		      						$ck = $rt->insert("UPDATE $tab SET `a_password` = :pwd WHERE `a_id` = :id",[[':pwd',$password],[':id',$user]]);
								break;				
								default:
									exit("access denied you can't change your password");
									break;
							}
							
						}else{
							$ck = "no";
							$pw = 1;
						}
      					if ($ck == "ok") {
							$return['act'] = "success";
							//$return['user'] = $user;
							$return['message'] = "Password For: [".$tel."] changed succesfull, You can now log in with the new password.";
							//$csrf->up_tk();
						}else{
							$return['act'] = "error";
							$return['message'] = (isset($pw)) ? "two passwords doesn't match" : 'Something went Wrong Try again later' ;;
						}
					}else{
						$return['act'] = "error";
						$return['message'] = "Code Entered is invalid or expired.";
					}
      				echo json_encode($return);
				}else{
					//var_dump($_POST);
					$return['act'] = "error";
					$return['message'] = "All Fields are required";
					echo json_encode($return);
				}
			break;
			case 'action_reg':
				$csrf = new CSRF_Protect();
				$csrf->verifyRequest();
				if (!empty($_POST['s_name'])) {
					$status = (hdev_log::fid() == "guest") ? "2" : "1" ;
					extract($_POST);

					$rt = new hdev_db();
      				$tab = $rt->table("service"); 
      				$user = hdev_log::uid();
      				$return = array();

      				$ck = $rt->insert("INSERT INTO `$tab` (`s_id`, `s_name`, `s_reg_date`, `s_status`) VALUES (NULL, :s_name, current_timestamp(), :status)",[[':s_name',$s_name],[':status',$status]]);
      				if ($ck == "ok") {
						$csrf->up_tk();
						if (isset($_POST['mod_close']) && !empty($_POST['mod_close'])) {
								hdev_note::success("Service Registered",$_POST['mod_close']);
						}else{
								hdev_note::success("Service Registered");
						}
					}else{
						echo "Something went Wrong Try again later";
					}
				}else{
					echo "all fields are required";
				}
			break;	
			case 'action_edit':
				$csrf = new CSRF_Protect();
				$csrf->verifyRequest();
				if (!empty($_POST['s_name']) && !empty($_POST['s_id'])) {
					$status = (hdev_log::fid() == "guest") ? "1" : "1" ;
					extract($_POST);

					$rt = new hdev_db();
      				$tab = $rt->table("service"); 
      				$user = hdev_log::uid();
      				$return = array();

					$ck = $rt->insert("UPDATE `$tab` SET `s_name` = :s_name WHERE `s_id` = :s_id",[[':s_name',$s_name],[':s_id',$s_id]]);

      				if ($ck == "ok") {
						$csrf->up_tk();
						if (isset($_POST['mod_close']) && !empty($_POST['mod_close'])) {
								hdev_note::success("Service Updated",$_POST['mod_close']);
						}else{
								hdev_note::success("Service Updated");
						}
					}else{
						echo "Something went Wrong Try again later";
					}
				}else{
					echo "All Fields are required";
				}
			break;	
			case 'fault_reg':
				$csrf = new CSRF_Protect();
				$csrf->verifyRequest();
				if (!empty($_POST['f_name'])) {
					$status = (hdev_log::fid() == "guest") ? "2" : "1" ;
					extract($_POST);

					$rt = new hdev_db();
      				$tab = $rt->table("fault"); 
      				$user = hdev_log::uid();
      				$return = array();

      				$ck = $rt->insert("INSERT INTO `$tab` (`f_id`, `f_name`, `f_reg_date`, `f_status`) VALUES (NULL, :f_name, current_timestamp(), :status)",[[':f_name',$f_name],[':status',$status]]);
      				if ($ck == "ok") {
						$csrf->up_tk();
						if (isset($_POST['mod_close']) && !empty($_POST['mod_close'])) {
								hdev_note::success("Fault Registered",$_POST['mod_close']);
						}else{
								hdev_note::success("Fault Registered");
						}
					}else{
						echo "Something went Wrong Try again later";
					}
				}else{
					echo "all fields are required";
				}
			break;	
			case 'fault_edit':
				$csrf = new CSRF_Protect();
				$csrf->verifyRequest();
				if (!empty($_POST['f_name']) && !empty($_POST['f_id'])) {
					$status = (hdev_log::fid() == "guest") ? "2" : "1" ;
					extract($_POST);

					$rt = new hdev_db();
      				$tab = $rt->table("fault"); 
      				$user = hdev_log::uid();
      				$return = array();

					$ck = $rt->insert("UPDATE `$tab` SET `f_name` = :f_name WHERE `f_id` = :f_id",[[':f_name',$f_name],[':f_id',$f_id]]);

      				if ($ck == "ok") {
						$csrf->up_tk();
						if (isset($_POST['mod_close']) && !empty($_POST['mod_close'])) {
								hdev_note::success("Fault Updated",$_POST['mod_close']);
						}else{
								hdev_note::success("Fault Updated");
						}
					}else{
						echo "Something went Wrong Try again later";
					}
				}else{
					echo "All Fields are required";
				}
			break;	
			case 'service_request_reg':
				if (!empty($_POST['sr_username']) && !empty($_POST['sr_tell']) && !empty($_POST['sr_nid']) && !empty($_POST['s_id']) && !empty($_POST['sr_district'])) {
					$status = (hdev_log::fid() == "guest") ? "1" : "1" ;
					$sr_username = $_POST['sr_username'];
					$sr_tell = $_POST['sr_tell'];
					$sr_nid = $_POST['sr_nid'];
					$sr_district = $_POST['sr_district'];
					$s_id = $_POST['s_id'];

					$rt = new hdev_db();
      				$tab = $rt->table("service_request"); 
      				$user = hdev_log::uid();
      				$return = array();
					$ck = $rt->insert("INSERT INTO `$tab` (`sr_id`, `sr_username`, `sr_tell`, `sr_nid`, `sr_district`, `s_id`, `sr_reg_date`, `sr_status`) VALUES (NULL, :sr_username, :sr_tell, :sr_nid, :sr_district, :s_id, current_timestamp(), :status)",[[':sr_username',$sr_username],[':sr_tell',$sr_tell],[':sr_nid',$sr_nid],[':sr_district',$sr_district],[':s_id',$s_id],[':status',$status]]);
      				if ($ck == "ok") {
      					//$csrf->up_tk();
      					$lid = $rt->last_id();
      					if ($status == "1") {
      						hdev_note::live_sms($sr_tell,'Your Service Request has been sent Successfully to '.constant("APP_NAME")." With Service request code:".$lid.".");
      						$return["status"] = "success";
      					}else{
      						$return["status"] = "error";
      					}
      					echo json_encode($return);
      				}else{
      					$return["status"] = "error";
      					echo json_encode($return);
      				}
				}else{
					$return["status"] = "error";
					echo json_encode($return);
				}
			break;	
			case 'fault_report_reg':
				if (!empty($_POST['fr_username']) && !empty($_POST['fr_tell']) && !empty($_POST['f_id']) && !empty($_POST['fr_district'])) {
					
					$status = (hdev_log::fid() == "guest") ? "1" : "1" ;
					$fr_username = $_POST['fr_username'];
					$fr_tell = $_POST['fr_tell'];
					$f_id = $_POST['f_id'];
					$fr_district = $_POST['fr_district'];


					$rt = new hdev_db();
      				$tab = $rt->table("fault_report"); 
      				$user = hdev_log::uid();
      				$return = array();
					$ck = $rt->insert("INSERT INTO `$tab` (`fr_id`, `fr_username`, `fr_tell`, `f_id`, `fr_district`, `fr_reg_date`, `fr_status`) VALUES (NULL, :fr_username, :fr_tell, :f_id, :fr_district, current_timestamp(), :status)",[[':fr_username',$fr_username],[':fr_tell',$fr_tell],[':f_id',$f_id],[':fr_district',$fr_district],[':status',$status]]);
      				if ($ck == "ok") {
      					//$csrf->up_tk();
      					$lid = $rt->last_id();
      					if ($status == "1") {
      						hdev_note::live_sms($fr_tell,'Your Fault Report has been sent Successfully to '.constant("APP_NAME")." With fault report code:".$lid.".");
      						$return["status"] = "success";
      					}else{
      						$return["status"] = "error";
      					}
      					echo json_encode($return);
      				}else{
      					$return["status"] = "error";
      					echo json_encode($return);
      				}
				}else{
					$return["status"] = "error";
					echo json_encode($return);
				}
			break;	
			case 'user_edit':
				$csrf = new CSRF_Protect();
    			$csrf->verifyRequest(); 
				if (isset($_POST['name']) && isset($_POST['a_nid']) && isset($_POST['email']) && isset($_POST['tel'])) {
					$name = $_POST['name'];
					$a_nid = $_POST['a_nid'];
					$email = $_POST['email'];
					$tel = $_POST['tel'];
      				if (isset($_POST['a_nid']) && !empty($_POST['a_nid'])) {
      					$a_nid = $_POST['a_nid'];
      					if (hdev_data::id_valid($a_nid)) {
      						exit(hdev_data::id_valid($a_nid));
      					}
      				}  
      				if (hdev_data::phone_valid($tel)) {
      					exit(hdev_data::phone_valid($tel));
      				}
					$id = hdev_log::uid();
					$rt = new hdev_db();
		      		$tab = $rt->auth_tbl();

					switch (hdev_log::fid()) {
						case 'admin':
						case 'main_admin';
							$ck = $rt->insert("UPDATE `admin` SET `a_name` = :name, `a_nid` = :nid, `a_tell` = :tel, `a_email` = :email WHERE `a_id` = :id",[[":id",$id],[':name',$name],[':nid',$a_nid],[":email",$email],[":tel",$tel]]);
						break;					
						default:
							exit("access denied you can't edit your user info");
							break;
					}

      				if ($ck == "ok") {
      					$csrf->up_tk();
      					if (isset($_POST['mod_close']) && !empty($_POST['mod_close'])) {
      						hdev_note::success("User info Updated",$_POST['mod_close']);
      					}else{
      						hdev_note::success("User info Updated");
      					}
      				}else{
      					echo "something went wrong try again later";
      				}
				}else{
					echo "all fields are required";
				}
			break;			
			case 'self_change_user_pwd':
				$csrf = new CSRF_Protect(); 
    			$csrf->verifyRequest();
				if (!empty($_POST['old_password']) && !empty($_POST['new_password']) && !empty($_POST['confirm_password'])) {
					$id = hdev_log::uid();
					$new_password = $_POST['new_password'];
					$confirm_password = $_POST['confirm_password'];
					$old_password = $_POST['old_password'];

					if ($new_password != $confirm_password) {
						exit("New and Confirm Passwords do not match!");
					}

					$password = hdev_data::password_enc($new_password);
					$old_password_hash = hdev_data::password_enc($old_password);
					$id = hdev_log::uid();
					$rt = new hdev_db();
		      		$tab = $rt->auth_tbl();

					switch (hdev_log::fid()) {
						case 'admin':
						case 'main_admin':
							$old_password_db = hdev_data::get_admin(hdev_log::uid(),['data'])["a_password"];
							$user = hdev_data::get_admin(hdev_log::uid(),['data'])["a_name"];
							if ($old_password_hash != $old_password_db) {
								exit("Provided current password is incorrect.");
							}
      						$ck = $rt->insert("UPDATE $tab SET `a_password` = :pwd WHERE `a_id` = :id",[[':pwd',$password],[':id',$id]]);
						break;				
						default:
							exit("access denied you can't change your password");
							break;
					}
      				if ($ck == "ok") {
      					$csrf->up_tk();
      					if (isset($_POST['mod_close']) && !empty($_POST['mod_close'])) {
      						hdev_note::success("Password for User: \" <u>".$user."</u> \" changed",$_POST['mod_close']);
      					}else{
      						hdev_note::success("Password for User: \" <u>".$user."</u> \" changed");
      					}
      				}else{
      					echo "something went wrong try again later";
      				}

				}else{
					echo "all fields are required";
				}
			break;
			default:
				echo "404! Sorry we can't see what you are looking for please refesh this page and try again.";
			break;
		}
		}
		//var_dump($_POST);
	}

 ?>