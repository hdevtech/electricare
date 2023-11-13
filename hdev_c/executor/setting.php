<?php 
//exit($data);
	if (isset($data) && !empty($data)) {}else{exit('validation failed');}
	$store = explode(';', $data);
	$HDEV =array();
	if (is_array($store) && count($store)>0) {
		foreach ($store as $stt) {
			$store2 = explode(':', $stt);
			if (is_array($store2) && count($store2) == 2) {
				$HDEV[$store2[0]]=$store2[1];
			}
		}
		
	}else{exit('validation failed');}
	
	if (is_array($HDEV) && count($HDEV) > 0 && isset($HDEV['ref'])) {
	}else{
		exit("validation Failed!");
	}
	$rasms_stc = new hdev_auth_service('',trim($HDEV['ref']));
	if ($rasms_stc->access()) {
		/// access granted 
	}else{
	  $disp = $rasms_stc->error('alert');
	  $HDEV['ref'] = "";

	  $from = (!is_null(trim($HDEV['from'])) && !empty(trim($HDEV['from']))) ? urldecode(trim($HDEV['from'])) : hdev_url::menu('');
	  hdev_note::message($disp);
	  hdev_note::redirect($from);
	  exit();
	}
	$csrf = new CSRF_Protect();
  	$csrf->verifyRequest($HDEV['app']);
	switch ($HDEV['ref']) {
		case 'action_delete':
			if (isset($HDEV['id']) && !empty($HDEV['id']) && isset($HDEV['src']) && !empty($HDEV['src'])) {
				$id = trim($HDEV['id']);
				$src = trim($HDEV['src']);
				$admin = hdev_log::uid();
				$rt = new hdev_db();
      			$tab = $rt->table("service");
      			$from = (!is_null(trim($HDEV['from'])) && !empty(trim($HDEV['from']))) ? urldecode(trim($HDEV['from'])) : hdev_url::menu('');

      			$ck = $rt->insert("UPDATE `$tab` SET `s_status` = :status WHERE `s_id` = :id;",[[":id",$id],[":status",'0']]);
	      		if ($ck == "ok") {
      				$csrf->up_tk();
      				if (isset($HDEV['mod_close']) && !empty($HDEV['mod_close'])) {
      					hdev_note::success('Service with <u>Reg No: '.$id.'</u> Deleted well.',$HDEV['mod_close']);
      					//hdev_note::redirect($from);
      				}else{
      					hdev_note::success('Service with <u>Reg No: '.$id.'</u> Deleted well.');
      					//hdev_note::redirect($from);
      				}
      			}else{
      				echo "something went wrong try again later";
      			}
			}
		break;
		case 'action_recover':
			if (isset($HDEV['id']) && !empty($HDEV['id']) && isset($HDEV['src']) && !empty($HDEV['src'])) {
				$id = trim($HDEV['id']);
				$src = trim($HDEV['src']);
				$admin = hdev_log::uid();
				$rt = new hdev_db();
      			$tab = $rt->table("service");
      			$from = (!is_null(trim($HDEV['from'])) && !empty(trim($HDEV['from']))) ? urldecode(trim($HDEV['from'])) : hdev_url::menu('');

      			$ck = $rt->insert("UPDATE `$tab` SET `s_status` = :status WHERE `s_id` = :id;",[[":id",$id],[":status",'1']]);
	      		if ($ck == "ok") {
      				$csrf->up_tk();
      				if (isset($HDEV['mod_close']) && !empty($HDEV['mod_close'])) {
      					hdev_note::success('Service with <u>Reg No: '.$id.'</u> Recovered well.',$HDEV['mod_close']);
      					//hdev_note::redirect($from);
      				}else{
      					hdev_note::success('Service with <u>Reg No: '.$id.'</u> Recovered well.');
      					//hdev_note::redirect($from);
      				}
      			}else{
      				echo "something went wrong try again later";
      			}
			}
		break;				
		case 'fault_delete':
			if (isset($HDEV['id']) && !empty($HDEV['id']) && isset($HDEV['src']) && !empty($HDEV['src'])) {
				$id = trim($HDEV['id']);
				$src = trim($HDEV['src']);
				$admin = hdev_log::uid();
				$rt = new hdev_db();
      			$tab = $rt->table("service");
      			$from = (!is_null(trim($HDEV['from'])) && !empty(trim($HDEV['from']))) ? urldecode(trim($HDEV['from'])) : hdev_url::menu('');

      			$ck = $rt->insert("UPDATE `$tab` SET `f_status` = :status WHERE `f_id` = :id;",[[":id",$id],[":status",'0']]);
	      		if ($ck == "ok") {
      				$csrf->up_tk();
      				if (isset($HDEV['mod_close']) && !empty($HDEV['mod_close'])) {
      					hdev_note::success('Fault with <u>Reg No: '.$id.'</u> Delete well.',$HDEV['mod_close']);
      					//hdev_note::redirect($from);
      				}else{
      					hdev_note::success('Fault with <u>Reg No: '.$id.'</u> Delete well.');
      					//hdev_note::redirect($from);
      				}
      			}else{
      				echo "something went wrong try again later";
      			}
			}
		break;
		case 'fault_recover':
			if (isset($HDEV['id']) && !empty($HDEV['id']) && isset($HDEV['src']) && !empty($HDEV['src'])) {
				$id = trim($HDEV['id']);
				$src = trim($HDEV['src']);
				$admin = hdev_log::uid();
				$rt = new hdev_db();
      			$tab = $rt->table("fault");
      			$from = (!is_null(trim($HDEV['from'])) && !empty(trim($HDEV['from']))) ? urldecode(trim($HDEV['from'])) : hdev_url::menu('');

      			$ck = $rt->insert("UPDATE `$tab` SET `f_status` = :status WHERE `f_id` = :id;",[[":id",$id],[":status",'1']]);
	      		if ($ck == "ok") {
      				$csrf->up_tk();
      				if (isset($HDEV['mod_close']) && !empty($HDEV['mod_close'])) {
      					hdev_note::success('Fault with <u>Reg No: '.$id.'</u> Recover well.',$HDEV['mod_close']);
      					//hdev_note::redirect($from);
      				}else{
      					hdev_note::success('Fault with <u>Reg No: '.$id.'</u> Recover well.');
      					//hdev_note::redirect($from);
      				}
      			}else{
      				echo "something went wrong try again later";
      			}
			}
		break;				
		case 'fault_report_approve':
			if (isset($HDEV['id']) && !empty($HDEV['id']) && isset($HDEV['src']) && !empty($HDEV['src'])) {
				$id = trim($HDEV['id']);
				$src = trim($HDEV['src']);
				$admin = hdev_log::uid();
				$rt = new hdev_db();
      			$tab = $rt->table("fault_report");
      			$from = (!is_null(trim($HDEV['from'])) && !empty(trim($HDEV['from']))) ? urldecode(trim($HDEV['from'])) : hdev_url::menu('');

      			$ck = $rt->insert("UPDATE `$tab` SET `fr_status` = :status WHERE `fr_id` = :id;",[[":id",$id],[":status",'2']]);
	      		if ($ck == "ok") {
      				$csrf->up_tk();
      				if (isset($HDEV['mod_close']) && !empty($HDEV['mod_close'])) {
      					hdev_note::success('Fault report with <u>Reg No: '.$id.'</u> approved well.',$HDEV['mod_close']);
      					//hdev_note::redirect($from);
      				}else{
      					hdev_note::success('Fault report with <u>Reg No: '.$id.'</u> approved well.');
      					//hdev_note::redirect($from);
      				}
      			}else{
      				echo "something went wrong try again later";
      			}
			}
		break;
		case 'fault_report_reject':
			if (isset($HDEV['id']) && !empty($HDEV['id']) && isset($HDEV['src']) && !empty($HDEV['src'])) {
				$id = trim($HDEV['id']);
				$src = trim($HDEV['src']);
				$admin = hdev_log::uid();
				$rt = new hdev_db();
      			$tab = $rt->table("fault_report");
      			$from = (!is_null(trim($HDEV['from'])) && !empty(trim($HDEV['from']))) ? urldecode(trim($HDEV['from'])) : hdev_url::menu('');

      			$ck = $rt->insert("UPDATE `$tab` SET `fr_status` = :status WHERE `fr_id` = :id;",[[":id",$id],[":status",'3']]);
	      		if ($ck == "ok") {
      				$csrf->up_tk();
      				if (isset($HDEV['mod_close']) && !empty($HDEV['mod_close'])) {
      					hdev_note::success('Fault report with <u>Reg No: '.$id.'</u> Rejected well.',$HDEV['mod_close']);
      					//hdev_note::redirect($from);
      				}else{
      					hdev_note::success('Fault report with <u>Reg No: '.$id.'</u> Rejected well.');
      					//hdev_note::redirect($from);
      				}
      			}else{
      				echo "something went wrong try again later";
      			}
			}
		break;				
		case 'service_request_approve':
			if (isset($HDEV['id']) && !empty($HDEV['id']) && isset($HDEV['src']) && !empty($HDEV['src'])) {
				$id = trim($HDEV['id']);
				$src = trim($HDEV['src']);
				$admin = hdev_log::uid();
				$rt = new hdev_db();
      			$tab = $rt->table("service_request");
      			$from = (!is_null(trim($HDEV['from'])) && !empty(trim($HDEV['from']))) ? urldecode(trim($HDEV['from'])) : hdev_url::menu('');

      			$ck = $rt->insert("UPDATE `$tab` SET `sr_status` = :status WHERE `sr_id` = :id;",[[":id",$id],[":status",'2']]);
	      		if ($ck == "ok") {
      				$csrf->up_tk();
      				if (isset($HDEV['mod_close']) && !empty($HDEV['mod_close'])) {
      					hdev_note::success('Requested Service with <u>Reg No: '.$id.'</u> approved well.',$HDEV['mod_close']);
      					//hdev_note::redirect($from);
      				}else{
      					hdev_note::success('Requested Service with <u>Reg No: '.$id.'</u> approved well.');
      					//hdev_note::redirect($from);
      				}
      			}else{
      				echo "something went wrong try again later";
      			}
			}
		break;
		case 'service_request_reject':
			if (isset($HDEV['id']) && !empty($HDEV['id']) && isset($HDEV['src']) && !empty($HDEV['src'])) {
				$id = trim($HDEV['id']);
				$src = trim($HDEV['src']);
				$admin = hdev_log::uid();
				$rt = new hdev_db();
      			$tab = $rt->table("service_request");
      			$from = (!is_null(trim($HDEV['from'])) && !empty(trim($HDEV['from']))) ? urldecode(trim($HDEV['from'])) : hdev_url::menu('');

      			$ck = $rt->insert("UPDATE `$tab` SET `fr_status` = :status WHERE `fr_id` = :id;",[[":id",$id],[":status",'3']]);
	      		if ($ck == "ok") {
      				$csrf->up_tk();
      				if (isset($HDEV['mod_close']) && !empty($HDEV['mod_close'])) {
      					hdev_note::success('Requested Service <u>Reg No: '.$id.'</u> Rejected well.',$HDEV['mod_close']);
      					//hdev_note::redirect($from);
      				}else{
      					hdev_note::success('Requested Service <u>Reg No: '.$id.'</u> Rejected well.');
      					//hdev_note::redirect($from);
      				}
      			}else{
      				echo "something went wrong try again later";
      			}
			}
		break;				
		default:
			hdev_note::message('we cannot handle what you requested try again later');
			hdev_note::redirect(hdev_url::menu(''));
		break;
	}

 ?>