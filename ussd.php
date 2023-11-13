<?php

define('APP_NAME', 'ElectriCare');
define('APP_URL', 'https://host.hdev.rw/electricare/up');
define("gateway", "1");

include "ussd_lang.php";
include "stack.php";
if (constant("gateway") == 1) {
	$sessionId   = $_POST["sessionId"];
	$serviceCode = $_POST["serviceCode"];
	$phoneNumber = $_POST["msisdn"];
	$val = $serviceCode;
	$vall = $_POST["UserInput"];

	$val_2 = substr($vall, strlen($val));

	$val_2 = substr($val_2, 0, -1);

	$text        = $val_2;	
	og_app::gateway_2_set("sessionId",$sessionId);

}elseif(constant('gateway') == 0){
	$sessionId   = $_POST["sessionId"];
	$serviceCode = $_POST["serviceCode"];
	$phoneNumber = $_POST["phoneNumber"];
	$text        = $_POST["text"];	
}

$response = '';

$textArr = explode('*', $text);

if (!is_array($textArr) || !isset($textArr[0]) ) {
	$textArr = array();
}
foreach ($textArr as $key => $value) {
	if ($key != 0 && (empty($value) || (is_numeric($value) && $value == 0))) {
		$value = "0-=kinvalid.@e";
	}
	og_app::set($key,$value);
}
$json_string = json_encode($_POST)."\n get_0:".og_app::get(0)."\n".date("h:i:s")."\n\n";

$file_handle = fopen('my_filename.json', 'a+');
fwrite($file_handle, $json_string);
fclose($file_handle);
//exit("hello");
if ( og_app::get(0) == "" ) {
	og_app::menu_reset();
	og_app::set_menu_title("".constant("APP_NAME")."\n Hitamo ururimi/Choose Language.");
	og_app::set_menu(1,"Ikinyarwanda");
	og_app::set_menu(2,"English");	
	og_app::display(og_app::menu_val(1));
}else{
	switch (og_app::get(0)) {   
		case '1':
		case '2':
			ussd_lang::language(og_app::get(0));
			if (empty(og_app::get(1))) {
				og_app::menu_reset();
				og_app::set_menu_title(constant("APP_NAME")."\n ".ussd_lang::on("data","choosen")." : ".((og_app::get(0)=="1") ? " : Ikinyarwanda" : " : English" ));
				og_app::set_menu(1,ussd_lang::on("data","continue")); 
				og_app::display(og_app::menu_val(1));
			}else{
				switch (og_app::get(1)) {
					case '1':
						if (empty(og_app::get(2))) { 
							og_app::menu_reset();
							og_app::set_menu_title(constant("APP_NAME")."\n".ussd_lang::on("data","choose")." :");
							og_app::set_menu(1,ussd_lang::on("data","request_service")); 
							og_app::set_menu(2,ussd_lang::on("data","report_fault")); 
							og_app::display(og_app::menu_val(1));
						}else{
							switch (og_app::get(2)) {
								case '1':
									if (empty(og_app::get(3))) { 
										og_app::menu_reset();
										og_app::set_menu_title(ussd_lang::on("data","your_names")." : ");
										og_app::display(og_app::menu_val(1));
									}elseif (og_app::name_valid(og_app::get(3))) {
										og_app::menu_reset();
										og_app::set_menu_title(ussd_lang::on("data","invalid_name"));
										og_app::display(og_app::menu_val(0));
									}else{
										if (empty(og_app::get(4))) { 
											og_app::menu_reset();
											og_app::set_menu_title(ussd_lang::on("data","your_nid")." : ");
											og_app::display(og_app::menu_val(1));
										}elseif (og_app::id_valid(og_app::get(4))) {
											og_app::menu_reset();
											og_app::set_menu_title(ussd_lang::on("data","invalid_nid"));
											og_app::display(og_app::menu_val(0));
										}else{
											//nid is stored in 4
											if (empty(og_app::get(5))) { 
												og_app::menu_reset();
												og_app::set_menu_title(ussd_lang::on("data","your_tell")." : ");
												og_app::display(og_app::menu_val(1));
											}elseif (og_app::phone_valid(og_app::get(5))) {
												og_app::menu_reset();
												og_app::set_menu_title(ussd_lang::on("data","invalid_tell"));
												og_app::display(og_app::menu_val(0));
											}else{
												//phone number is stored in 5
												if (empty(og_app::get(6))) { 
													og_app::menu_reset();
													og_app::set_menu_title(ussd_lang::on("data","service")." : ");
													$services = og_app::post(['ref'=>'service_api']);
													foreach($services as $service){
														og_app::set_menu($service["id"],$service["name"]);
													}
													og_app::display(og_app::menu_val(1));
												}else {
													//verification of service availability
													$services = og_app::post(['ref'=>'service_api']);
													$break = 0;
													foreach($services as $service){
														if(og_app::get(6) == $service["id"]){
															$break = 1;
															break;
														}
													}
													if($break == 0){
														og_app::menu_reset();
														og_app::set_menu_title(ussd_lang::on("data","service_not_found"));
														og_app::display(og_app::menu_val(0));
														exit();
													}
													//permit number is stored in 6
													if (empty(og_app::get(7))) { 
														og_app::menu_reset();
														og_app::set_menu_title(ussd_lang::on("data","your_district")." : ");
														og_app::display(og_app::menu_val(1));
													}elseif (og_validation::isUserInputInList(og_app::get(7))) {
														og_app::menu_reset();
														og_app::set_menu_title(ussd_lang::on("data","invalid_district"));
														og_app::display(og_app::menu_val(0));
													}else{
														$data = array();
														$data['ref'] = "service_request_reg";
														$data['sr_username'] = og_app::get(3);
														$data['sr_nid'] = og_app::get(4);
														$data['sr_tell'] = og_app::get(5);
														$data['s_id'] = og_app::get(6);
														$data['sr_district'] = og_app::get(7);
														$json_string = json_encode($data)."\n get_0:".og_app::get(0)."\n".date("h:i:s")."\n\n";
														$file_handle = fopen('service_req.json', 'a+');
														fwrite($file_handle, $json_string);
														fclose($file_handle);
														$return = json_decode(og_app::upload($data));
														if (isset($return->status) && $return->status == "success") {
															og_app::menu_reset();
															og_app::set_menu_title(ussd_lang::on("data","service_request_registered"));
															og_app::display(og_app::menu_val(0));
														}else{
															og_app::menu_reset();
															og_app::set_menu_title(ussd_lang::on("data","something_went_wrong"));
															og_app::display(og_app::menu_val(0));
														}
													}
													
												}
											}
										}
									}
								break;
								case '2':
									if (empty(og_app::get(3))) { 
										og_app::menu_reset();
										og_app::set_menu_title(ussd_lang::on("data","your_names")." : ");
										og_app::display(og_app::menu_val(1));
									}elseif (og_app::name_valid(og_app::get(3))) {
										og_app::menu_reset();
										og_app::set_menu_title(ussd_lang::on("data","invalid_name"));
										og_app::display(og_app::menu_val(0));
									}else{
											//nid is stored in 4
											if (empty(og_app::get(4))) { 
												og_app::menu_reset();
												og_app::set_menu_title(ussd_lang::on("data","your_tell")." : ");
												og_app::display(og_app::menu_val(1));
											}elseif (og_app::phone_valid(og_app::get(4))) {
												og_app::menu_reset();
												og_app::set_menu_title(ussd_lang::on("data","invalid_tell"));
												og_app::display(og_app::menu_val(0));
											}else{
												//phone number is stored in 5
												if (empty(og_app::get(5))) { 
													og_app::menu_reset();
													og_app::set_menu_title(ussd_lang::on("data","fault")." : ");
													$faults = og_app::post(['ref'=>'fault_api']);
													foreach($faults as $fault){
														og_app::set_menu($fault["id"],$fault["name"]);
													}
													og_app::display(og_app::menu_val(1));
												}else {
													//verification of service availability
													$faults = og_app::post(['ref'=>'fault_api']);
													$break = 0;
													foreach($faults as $fault){
														if(og_app::get(5) == $fault["id"]){
															$break = 1;
															break;
														}
													}
													if($break == 0){
														og_app::menu_reset();
														og_app::set_menu_title(ussd_lang::on("data","fault_not_found"));
														og_app::display(og_app::menu_val(0));
														exit();
													}
													//permit number is stored in 6
													if (empty(og_app::get(6))) { 
														og_app::menu_reset();
														og_app::set_menu_title(ussd_lang::on("data","your_district")." : ");
														og_app::display(og_app::menu_val(1));
													}elseif (og_validation::isUserInputInList(og_app::get(6))) {
														og_app::menu_reset();
														og_app::set_menu_title(ussd_lang::on("data","invalid_district"));
														og_app::display(og_app::menu_val(0));
													}else{
														$data = array();
														$data['ref'] = "fault_report_reg";
														$data['fr_username'] = og_app::get(3);
														$data['fr_tell'] = og_app::get(4);
														$data['f_id'] = og_app::get(5);
														$data['fr_district'] = og_app::get(6);
														$json_string = json_encode($data)."\n get_0:".og_app::get(0)."\n".date("h:i:s")."\n\n";
														$file_handle = fopen('fault_req.json', 'a+');
														fwrite($file_handle, $json_string);
														fclose($file_handle);
														$return = json_decode(og_app::upload($data));
														if (isset($return->status) && $return->status == "success") {
															og_app::menu_reset();
															og_app::set_menu_title(ussd_lang::on("data","fault_report_registered"));
															og_app::display(og_app::menu_val(0));
														}else{
															og_app::menu_reset();
															og_app::set_menu_title(ussd_lang::on("data","something_went_wrong"));
															og_app::display(og_app::menu_val(0));
														}
													}
													
												}
											}
									}
								break;
								
								default:
									// code...
									break;
							}

						}
					break;
					default:
						og_app::menu_reset();
						og_app::set_menu_title("Invalid Input.");
						og_app::display(og_app::menu_val(0));
					break;
				}
			}
		break;
		default:
			og_app::menu_reset();
			og_app::set_menu_title("Invalid Input.");
			og_app::display(og_app::menu_val(0));
		break;
	}
}
exit();
?>