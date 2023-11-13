<?php 
	$rasms_service = array( 
	/* ALL REQUEST ACCESS */ 
	'login' => array(
		'name'=>"Access to login",
		'error'=>"Access denied to you to login"
		),
	'user_edit' => array(
		'name'=>"Access to Edit User",
		'error'=>"Access denied to you to Edit User"
		),	
	'self_change_user_pwd' => array(
		'name'=>"Access to Change user password",
		'error'=>"Access denied to you to Change user password"
		),	
	'driver_recover' => array(
		'name'=>"Access to reject Landlord",
		'error'=>"Access denied to you to reject Landlord"
		),
	'driver_reg' => array(
		'name'=>"Access to edit Landlord",
		'error'=>"Access denied to you to edit Landlord"
		),			
	'driver_approve' => array(
		'name'=>"Access to delete Landlord",
		'error'=>"Access denied to you to delete Landlord"
		),	
	'driver_reject' => array(
		'name'=>"Access to recover Landlord",
		'error'=>"Access denied to you to recover Landlord"
		),
	'driver_delete' => array(
		'name'=>"Access to recover Landlord",
		'error'=>"Access denied to you to recover Landlord"
		),	
	'action_recover' => array(
		'name'=>"Access to reject Landlord",
		'error'=>"Access denied to you to reject Landlord"
		),
	'action_reg' => array(
		'name'=>"Access to edit Landlord",
		'error'=>"Access denied to you to edit Landlord"
		),			
	'action_approve' => array(
		'name'=>"Access to delete Landlord",
		'error'=>"Access denied to you to delete Landlord"
		),	
	'action_reject' => array(
		'name'=>"Access to recover Landlord",
		'error'=>"Access denied to you to recover Landlord"
		),
	'action_delete' => array(
		'name'=>"Access to recover Landlord",
		'error'=>"Access denied to you to recover Landlord"
		),	
	'fault_recover' => array(
		'name'=>"Access to reject Landlord",
		'error'=>"Access denied to you to reject Landlord"
		),
	'fault_reg' => array(
		'name'=>"Access to edit Landlord",
		'error'=>"Access denied to you to edit Landlord"
		),			
	'fault_approve' => array(
		'name'=>"Access to delete Landlord",
		'error'=>"Access denied to you to delete Landlord"
		),	
	'fault_reject' => array(
		'name'=>"Access to recover Landlord",
		'error'=>"Access denied to you to recover Landlord"
		),
	'fault_delete' => array(
		'name'=>"Access to recover Landlord",
		'error'=>"Access denied to you to recover Landlord"
		),	
	'service_request_recover' => array(
		'name'=>"Access to reject Landlord",
		'error'=>"Access denied to you to reject Landlord"
		),
	'service_request_reg' => array(
		'name'=>"Access to edit Landlord",
		'error'=>"Access denied to you to edit Landlord"
		),			
	'service_request_approve' => array(
		'name'=>"Access to delete Landlord",
		'error'=>"Access denied to you to delete Landlord"
		),	
	'service_request_reject' => array(
		'name'=>"Access to recover Landlord",
		'error'=>"Access denied to you to recover Landlord"
		),
	'service_request_delete' => array(
		'name'=>"Access to recover Landlord",
		'error'=>"Access denied to you to recover Landlord"
		),	
	'fault_report_recover' => array(
		'name'=>"Access to reject Landlord",
		'error'=>"Access denied to you to reject Landlord"
		),
	'fault_report_reg' => array(
		'name'=>"Access to edit Landlord",
		'error'=>"Access denied to you to edit Landlord"
		),			
	'fault_report_approve' => array(
		'name'=>"Access to delete Landlord",
		'error'=>"Access denied to you to delete Landlord"
		),	
	'fault_report_reject' => array(
		'name'=>"Access to recover Landlord",
		'error'=>"Access denied to you to recover Landlord"
		),
	'fault_report_delete' => array(
		'name'=>"Access to recover Landlord",
		'error'=>"Access denied to you to recover Landlord"
		),	
	'send_reset_code' => array(
		'name'=>"Access to recover Post",
		'error'=>"Access denied to you to recover Post"
		),
	'enter_code' => array(
		'name'=>"Access to recover Post",
		'error'=>"Access denied to you to recover Post"
		),
	'reset_password' => array(
		'name'=>"Access to recover Post",
		'error'=>"Access denied to you to recover Post"
		),
	'appoitment_reg' => array(
		'name'=>"Access to recover Post",
		'error'=>"Access denied to you to recover Post"
		),				
	'service_api' => array(
		'name'=>"Access to recover Post",
		'error'=>"Access denied to you to recover Post"
		),				
	'fault_api' => array(
		'name'=>"Access to recover Post",
		'error'=>"Access denied to you to recover Post"
		),				
	);

	//$all_services = array_keys($rasms_service);
	//$tg = "";
	//foreach ($all_services as $key) {
	//	if ($key == "stud_delete") {
	//		$tg = 9;
	//	}
	//	if ($tg == 9) {
	//		echo "'".$key."' /*".$rasms_service[$key]['name']."*/,\n";
	//	}
		
	//}
	//$pts = implode(",", $all_services);

	//echo $pts."<br><br><br><br><br><br><br>";
	//print_r($all_services);

	$rasms_service_users = array(
		'guest'=>array(
			'location_select',
			'login' /*Access to login*/,
			"send_reset_code",
			"enter_code",
			"reset_password",
			"appoitment_reg",
			"service_request_reg",
			"fault_report_reg",
			"service_api",
			"fault_api"

		),
		'admin'=> array( //// was admin
			
			'login' /*Access to login*/,
			'user_edit' /*Access to edit user*/,
			'self_change_user_pwd'/** access to change password*/,
			"driver_recover",
			"driver_approve",
			"driver_reject",
			"driver_delete",
			"action_reg",
			"action_recover",
			"action_approve",
			"action_reject",
			"action_delete",
			"fault_reg",
			"fault_recover",
			"fault_approve",
			"fault_reject",
			"fault_delete",
			"service_request_recover",
			"service_request_approve",
			"service_request_reject",
			"service_request_delete",
			"fault_report_recover",
			"fault_report_approve",
			"fault_report_reject",
			"fault_report_delete",
			"service_api"

		),			
	);
 ?>