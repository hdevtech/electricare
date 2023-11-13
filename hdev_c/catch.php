<?php
if (!function_exists("hdev_vd")) {
  function hdev_vd()
  {
    //default validation
    $regd = getcwd().DIRECTORY_SEPARATOR.'hdev_c'.DIRECTORY_SEPARATOR.'executor'.DIRECTORY_SEPARATOR.'exec_v.php';
    include $regd;
  }
}
if (!function_exists("mini_loader")) {
  function mini_loader()
  {
    //default mini navigation
    $regd = getcwd().DIRECTORY_SEPARATOR.'hdev_c'.DIRECTORY_SEPARATOR.'loader.php';
    return $regd;
  }
}
// Include router class 
$regd = getcwd().DIRECTORY_SEPARATOR."hdev_c".DIRECTORY_SEPARATOR."executor".DIRECTORY_SEPARATOR."hdev_parse.php";
include $regd;

$valid = array('login_i','up');
foreach ($valid as $vd) {
  hdev_route::add('/'.$vd, function() {
    hdev_vd();
    exit();
  });
} 
//add login page
hdev_route::add('/login', function() {
  if (hdev_log::loged()) {
    hdev_note::redirect(hdev_url::get_url_host());exit();
  }
  include getcwd().'/hdev_c/l_header.php';
  include getcwd().'/hdev_c/re_log_auth.php';
  include getcwd().'/hdev_c/l_footer.php';
  exit();
});
//add login page
hdev_route::add('/forgot', function() {
  if (hdev_log::loged()) {
    hdev_note::redirect(hdev_url::get_url_host());exit();
  }
  include getcwd().'/hdev_c/l_header.php';
  include getcwd().'/hdev_c/pass_reset.php';
  include getcwd().'/hdev_c/l_footer.php';
  exit();
});
hdev_route::add('/cert/gen/(.*)/(.*)', function($auth,$data) {
hdev_session::set('t_id',$data);
hdev_session::set('auth',$auth);
   $regd = getcwd().DIRECTORY_SEPARATOR.'hdev_c'.DIRECTORY_SEPARATOR.'executor'.DIRECTORY_SEPARATOR.'TCPDF-main'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'tcpdf_config.php';
  include $regd;  
  $regd = getcwd().DIRECTORY_SEPARATOR.'hdev_c'.DIRECTORY_SEPARATOR.'executor'.DIRECTORY_SEPARATOR.'TCPDF-main'.DIRECTORY_SEPARATOR.'tcpdf.php';
  include $regd; 
  $regd = getcwd().DIRECTORY_SEPARATOR.'hdev_c'.DIRECTORY_SEPARATOR.'report'.DIRECTORY_SEPARATOR.'cert_full.php';
  include $regd;

  exit();
  //$csrf->up_tk();
  hdev_log::close();
});
hdev_route::add('/app/setting/(.*)/(.*)', function($auth,$data) {
  $csrf = new CSRF_Protect();
  $csrf->verifyRequest($auth);
  $data = hdev_data::decd($data);
  $regd = getcwd().DIRECTORY_SEPARATOR.'hdev_c'.DIRECTORY_SEPARATOR.'executor'.DIRECTORY_SEPARATOR.'setting.php';
  include $regd;
  //$csrf->up_tk();
  hdev_log::close();
});


// Add base route (startpage)
hdev_route::add('/', function() {
  //  if (!hdev_log::loged()) {
  //  hdev_note::redirect(hdev_url::get_url_host()."/login");exit();
  //}else{
    hdev_menu_url::body([hdev_lang::on("menu","home"),"hdev_c/home","/r/home"]);
  //}
});

//full home page 
hdev_route::add('', function() {
  //if (!hdev_log::loged()) {
  //  hdev_note::redirect(hdev_url::get_url_host()."/login");exit();
  //}else{
    hdev_menu_url::body([hdev_lang::on("menu","home"),"hdev_c/home","/r/home"]);
  //}
});
hdev_route::add('/a/b/c', function() {
  //if (!hdev_log::loged()) {
  //  hdev_note::redirect(hdev_url::get_url_host()."/login");exit();
  //}else{
    hdev_menu_url::body([hdev_lang::on("menu","home"),"hdev_c/home","/r/home"]);
      include mini_loader();
  exit();
  //}
});
//full home page  
hdev_route::add('/r/about', function() {
  hdev_menu_url::body([hdev_lang::on("menu","about"),"about","/r/about"]);
});
//full home page 
hdev_route::add('/r/home', function() {
  hdev_menu_url::body([hdev_lang::on("menu","home"),"hdev_c/home","/r/home"]);
});

hdev_route::add('/r/home/a/b/c', function() {
  hdev_menu_url::body([hdev_lang::on("menu","home"),"hdev_c/home","/r/home"]); 
  include mini_loader();
  exit();
});
//full home page 
hdev_route::add('/get/assessment', function() {
  hdev_menu_url::body([hdev_lang::on("menu","home"),"hdev_c/index/all_cert","/get/assessment"]);
});

hdev_route::add('/get/assessment/a/b/c', function() {
  hdev_menu_url::body([hdev_lang::on("menu","home"),"hdev_c/index/all_cert","/get/assessment"]); 
  include mini_loader();
  exit();
});
hdev_route::add('/r/home/page/(.*)/a/b/c', function($page) {
  hdev_session::set("page",$page);
  hdev_menu_url::body([hdev_lang::on("menu","home"),"hdev_c/home","/r/home"]); 
  include mini_loader();
  exit();
});
//full home page 
hdev_route::add('/r/home/page/(.*)', function($page) {
  hdev_session::set("page",$page);
  //exit('r/home/()');
  hdev_menu_url::body([hdev_lang::on("menu","home"),"hdev_c/home","/r/home"]);
});
hdev_route::add('/r/profile', function() { 
  $sc = hdev_log::fid();
  switch ($sc) {
    case 'admin':
    case 'main_admin':
      hdev_menu_url::body([hdev_lang::on("menu","memb_info"),"hdev_c/index/profile","/r/profile"]);
      break;
    case 'employee':
      hdev_menu_url::body([hdev_lang::on("menu","memb_info"),"hdev_c/index/profile_provider","/r/profile"]);
      break;      
    default:
      hdev_menu_url::body(["404","error","/error"]);
      break;
  }
});
hdev_route::add('/r/profile/a/b/c', function() { 
  $sc = hdev_log::fid();
  switch ($sc) {
    case 'admin':
    case 'main_admin':
      hdev_menu_url::body([hdev_lang::on("menu","memb_info"),"hdev_c/index/profile","/r/profile"]);
      break;
    case 'provider':
      hdev_menu_url::body([hdev_lang::on("menu","memb_info"),"hdev_c/index/profile_provider","/r/profile"]);
      break;
    case 'agent':
      hdev_menu_url::body([hdev_lang::on("menu","memb_info"),"hdev_c/index/agent_profile","/r/profile"]);
      break;
    case 'tenant':
      hdev_menu_url::body([hdev_lang::on("menu","memb_info"),"hdev_c/index/tenant_profile","/r/profile"]);
      break;      
    default:
      hdev_menu_url::body(["404","error","/error"]);
      break;
  }
  include mini_loader();
  exit();
});

hdev_route::add('/approve/driver', function() { 
  hdev_menu_url::body(["Approved Drivers","hdev_c/index/driver_approve","/approve/driver"]);
});
hdev_route::add('/approve/driver/a/b/c', function() { 
  hdev_menu_url::body(["Approved Drivers","hdev_c/index/driver_approve","/approve/driver"]);
  include mini_loader();
  exit();
});
hdev_route::add('/delete/driver', function() { 
  hdev_menu_url::body(["Deleted Drivers","hdev_c/index/driver_delete","/delete/driver"]);
});
hdev_route::add('/delete/driver/a/b/c', function() { 
  hdev_menu_url::body(["Deleted Drivers","hdev_c/index/driver_delete","/delete/driver"]);
  include mini_loader();
  exit();
});
hdev_route::add('/reg/driver', function() { 
  hdev_menu_url::body(["Drivers waiting for approval","hdev_c/index/driver_reg","/reg/transaction"]);
});
hdev_route::add('/reg/driver/a/b/c', function() { 
  hdev_menu_url::body(["Drivers waiting for approval","hdev_c/index/driver_reg","/reg/driver"]);
  include mini_loader();
  exit();
});
hdev_route::add('/reject/driver', function() { 
  hdev_menu_url::body(["Rejected Drivers","hdev_c/index/driver_reject","/reject/driver"]);
});
hdev_route::add('/reject/driver/a/b/c', function() { 
  hdev_menu_url::body(["Rejected Drivers","hdev_c/index/driver_reject","/reject/driver"]);
  include mini_loader();
  exit();
});
hdev_route::add('/approve/owner', function() { 
  hdev_menu_url::body(["Approved Owners","hdev_c/index/owner_approve","/approve/owner"]);
});
hdev_route::add('/approve/owner/a/b/c', function() { 
  hdev_menu_url::body(["Approved Owners","hdev_c/index/owner_approve","/approve/owner"]);
  include mini_loader();
  exit();
});
hdev_route::add('/delete/service', function() { 
  hdev_menu_url::body(["Deleted Services","hdev_c/index/services_delete","/delete/service"]);
});
hdev_route::add('/delete/service/a/b/c', function() { 
  hdev_menu_url::body(["Deleted Services","hdev_c/index/services_delete","/delete/service"]);
  include mini_loader();
  exit();
});
hdev_route::add('/reg/service', function() { 
  hdev_menu_url::body(["Services Info","hdev_c/index/service_reg","/reg/service"]);
});
hdev_route::add('/reg/service/a/b/c', function() { 
  hdev_menu_url::body(["Services Info","hdev_c/index/service_reg","/reg/service"]);
  include mini_loader();
  exit();
});
hdev_route::add('/pending/service', function() { 
  hdev_menu_url::body(["Pending Service requests Info","hdev_c/index/service_request_reg","/pending/service"]);
});
hdev_route::add('/pending/service/a/b/c', function() { 
  hdev_menu_url::body(["Pending Service requests Info","hdev_c/index/service_request_reg","/pending/service"]);
  include mini_loader();
  exit();
});
hdev_route::add('/approve/service', function() { 
  hdev_menu_url::body(["Approved Service requests Info","hdev_c/index/service_request_approve","/approve/service"]);
});
hdev_route::add('/approve/service/a/b/c', function() { 
  hdev_menu_url::body(["Approved Service requests Info","hdev_c/index/service_request_approve","/approve/service"]);
  include mini_loader();
  exit();
});
hdev_route::add('/reject/service', function() { 
  hdev_menu_url::body(["Rejected Service requests Info","hdev_c/index/service_request_reject","/reject/service"]);
});
hdev_route::add('/reject/service/a/b/c', function() { 
  hdev_menu_url::body(["Rejected Service requests Info","hdev_c/index/service_request_reject","/reject/service"]);
  include mini_loader();
  exit();
});
hdev_route::add('/delete/fault', function() { 
  hdev_menu_url::body(["Deleted Faults","hdev_c/index/faults_delete","/delete/fault"]);
});
hdev_route::add('/delete/fault/a/b/c', function() { 
  hdev_menu_url::body(["Deleted Faults","hdev_c/index/faults_delete","/delete/fault"]);
  include mini_loader();
  exit();
});
hdev_route::add('/reg/fault', function() { 
  hdev_menu_url::body(["Faults Info","hdev_c/index/fault_reg","/reg/fault"]);
});
hdev_route::add('/reg/fault/a/b/c', function() { 
  hdev_menu_url::body(["Faults Info","hdev_c/index/fault_reg","/reg/fault"]);
  include mini_loader();
  exit();
});
hdev_route::add('/pending/fault', function() { 
  hdev_menu_url::body(["Pending Service reports Info","hdev_c/index/fault_report_reg","/pending/fault"]);
});
hdev_route::add('/pending/fault/a/b/c', function() { 
  hdev_menu_url::body(["Pending Service reports Info","hdev_c/index/fault_report_reg","/pending/fault"]);
  include mini_loader();
  exit();
});
hdev_route::add('/approve/fault', function() { 
  hdev_menu_url::body(["Approved Service reports Info","hdev_c/index/fault_report_approve","/approve/fault"]);
});
hdev_route::add('/approve/fault/a/b/c', function() { 
  hdev_menu_url::body(["Approved Service reports Info","hdev_c/index/fault_report_approve","/approve/fault"]);
  include mini_loader();
  exit();
});
hdev_route::add('/reject/fault', function() { 
  hdev_menu_url::body(["Rejected Service reports Info","hdev_c/index/fault_report_reject","/reject/fault"]);
});
hdev_route::add('/reject/fault/a/b/c', function() { 
  hdev_menu_url::body(["Rejected Service reports Info","hdev_c/index/fault_report_reject","/reject/fault"]);
  include mini_loader();
  exit();
});
hdev_route::add('/all/appoitments', function() { 
  hdev_menu_url::body(["Current Appoitments","hdev_c/index/appoitments","/all/appoitments"]);
});
hdev_route::add('/all/appoitments/a/b/c', function() { 
  hdev_menu_url::body(["Current Appoitments","hdev_c/index/appoitments","/all/appoitments"]);
  include mini_loader();
  exit();
});

hdev_route::add('/s', function() {
  if (hdev_log::loged()) {
    include 'executor/main_app_js.php';
  }
  hdev_log::close();
});

hdev_route::add('/script-1', function() {
    include 'hdev_c/main_app_js.php';
    exit;
});

hdev_route::add('/auth/gen/(.*)', function($er_rasms_qqrrccdd) {
  if (hdev_log::loged()) {
    include 'executor/cds.php';
  }
  hdev_log::close();
});
hdev_route::add('/test', function() {
  include 'hdev_c/test.php';
  exit();
});


///********************************backups****************************


// Add a 404 not found route
hdev_route::pathNotFound(function($path) { 
  // Do not forget to send a status header back to the client
  // The router will not send any headers by default
  // So you will have the full flexibility to handle this case
  header('HTTP/1.0 404 Not Allowed');
  hdev_menu_url::body(["error","hdev_c/error","/error"]);
});
 
// Add a 405 method not allowed route
hdev_route::methodNotAllowed(function($path, $method) {
  // Do not forget to send a status header back to the client
  // The router will not send any headers by default
  // So you will have the full flexibility to handle this case
  header('HTTP/1.0 405 Method Not Allowed');
  echo 'Error 405 :-(<br>';
  echo 'The requested path "'.$path.'" exists. But the request method "'.$method.'" is not allowed on this path!';
});

// Run the Router with the given Basepath
// If your script lives in the web root folder use a / or leave it empty
//hdev_route::unset_r(2);// remove a route

//var_export(hdev_route::all_req());exit;// all requests
/*$tg = array();
$reqs = hdev_route::all_req();
foreach ($reqs as $key => $value) {
  $tg[$value['expression']] = ['name'=>'','func'=>''];
} 
var_export($tg);
exit();*/
hdev_route::access('/');
//hdev_route::run('/'); 
//hdev_route::access('/', false, false, false, "http://o.rasms/r/profile_info");
//exit(hdev_route::get_active2());

//var_export(parse_url(hdev_url::menu(ltrim($_SERVER['REQUEST_URI'],'/'))));exit;
//echo hdev_route::get_active();
$rasms_stc = new hdev_url_Service('',trim(hdev_route::get_active()));
//echo hdev_route::get_active();
//echo hdev_route::get_active2();exit();
//var_dump(hdev_route::get_active());
//var_dump($rasms_stc->error('alert'));exit();
//var_dump($rasms_stc->access());exit();
if ($rasms_stc->access()) {
  /// access granted
  //echo "granted";
  $rt = new hdev_db("default"); 
  if ($rt->connection_check()) {
    //var_dump($rt->connection_check());exit;
  }else {
    exit();
    echo "<div style='width: 50%;margin-left:15%;margin-top:5%;'><fieldset>RASMS DATA STORE CHECKER<hr>Re-start the application to get this fixed <br> Or click <a href='".hdev_url::menu("")."'>Here</a><hr>&copy".date("Y")."- IZERE HIRWA ROGER - ".APP_NAME."<hr></fieldset><div>";
    echo '<meta content="2; '.hdev_url::menu("").'" http-equiv="refresh" />'; exit();
  }
    hdev_route::run('/'); 
}else{
  hdev_route::access('/', false, false, false, hdev_url::get_url_full());
  $tt = hdev_route::get_active2();
  if ($tt != "error") {
    hdev_note::message("access denied to request this page");
    $rasms_access_error = $rasms_stc->error('alert');
    hdev_menu_url::body(["Access denied !","error","/error"]);
  }else{
    hdev_menu_url::body(["404","error","/error"]);
  }
  
  ///call custom user func
}
/*foreach (hdev_route::all_req() as $url) {
  //echo "\t'".$url['expression']."' => array ("."\n"."\t\t'name' => 'access to view [".$url['expression']."]',\n\t\t'error' => 'You can not access this page',\n\t\t),\n";
  echo "\t\t\t'".$url['expression']."',\n";
}exit();*/


// If your script lives in a subfolder you can use the following example
// Do not forget to edit the basepath in .htaccess if you are on apache
// hdev_route::run('/api/v1');

// Enable case sensitive mode, trailing slashes and multi match mode by setting the params to true
// hdev_route::run('/', true, true, true);

//authenticate bro
if (!hdev_log::loged()) {
  //hdev_note::message("You must Log in first To access Rasms system");
  //hdev_note::redirect(hdev_url::get_url_host()."/login");
}
?>