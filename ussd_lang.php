<?php 
  /**
   * language activation
   */
  class ussd_lang
  {
    private static $lang = array();
    private static $langg = "eng";

    public static function language($act="")
    {
      if (!empty($act)) {
        if($act == '1'){
            self::$langg = "kiny";
        }else{
            self::$langg = "eng";
        }
      }else{

      }
      return self::$langg;
    }
    public static function reset()
    {
      self::$lang = array();
    }
    public static function set($var=array())
    {
      self::$lang = $var; 
    }
    public static function on($pre,$view)
    {
      $langg = (!empty(self::language())) ? self::language() : "eng" ;
      if (!empty($pre) && !empty($view)) {
        if (isset(self::$lang[$pre][$langg][$view])) {
          if (!empty(self::$lang[$pre][$langg][$view])) {
            return self::$lang[$pre][$langg][$view];
          }else{
            return "";
          }
        }else{
          $langg = "eng";
          if (isset(self::$lang[$pre][$langg][$view]) && !empty(self::$lang[$pre][$langg][$view])) {
            return self::$lang[$pre][$langg][$view];
          }else{
            return "";
          }
        }
      }else{
        return "";
      }
    }
  }






  $language_definition = array("kiny","eng");
  $lang=array( 
    "data"=>array(
            "kiny"=>array(
                "choosen"=>"Wahisemo",
                "choose"=>"",
                "continue"=>"Komeza",
                "request_service"=>"Saba Serivisi",
                "report_fault"=>"Tanga amakuru kukibazo cyabaye",
                "your_names"=>"Amazina Yawe",
                "your_tell"=>"Telephone Yawe",
                "your_nid"=>"Indangamuntu yawe",
                "your_district"=>"Akarere",
                "service"=>"Serivisi",
                "fault"=>"Ikibazo",
                "service_request_registerd","Serivise yasabwe neza",
                "something_went_wrong"=>"Ntabwo service musabye ishoboye kuboneka",
                "fault_report_registered"=>"Ikibazo cyamenyekanishijwe neza",
                "service_not_found"=>"Servisi Ntiyasoboye Kuboneka",
                "fault_not_found"=>"Ikibazo ntabwo cyashoboye kuboneka",
                "invalid_district"=>"Akarere ntabwo kabonetse",
                "invalid_name"=>"Izina ryanditse nabi",
                "invalid_nid"=>"Indangamuntu yanditse nabi",
                "invalid_tell"=>"Telephone yanditse nabi"
            ),
            "eng"=>array(
                "choosen"=>"You have Choosen",
                "choose"=>"Choose",
                "continue"=>"Continue",
                "request_service"=>"Request Service",
                "report_fault"=>"Report Fault",
                "your_names"=>"Your Names",
                "your_tell"=>"Your Phone number",
                "your_nid"=>"Your National Id",
                "your_district"=>"Your District",
                "service"=>"Service",
                "fault"=>"Fault",
                "service_request_registered","Service request registered",
                "something_went_wrong"=>"Something went wrong",
                "fault_report_registered"=>"Fault report registered",
                "service_not_found"=>"Service not found",
                "fault_not_found"=>"Fault not found",
                "invalid_district"=>"Invalid district",
                "invalid_name"=>"Invalid name",
                "invalid_nid"=>"Invalid national id",
                "invalid_tell"=>" Invalid phone number"
            )
        ),
  );
  ///initialise language function to receceive and array of language definitions
  ussd_lang::reset();
  ussd_lang::set($lang);

 ?>