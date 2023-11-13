<?php 

	/**
	 * ussd launcher
		
	 */
	session_start();
	class og_app
	{
		
	    private static $sess = array();
	    private static $menu = array();
	    private static $gateway_2 = array();
		function __construct()
		{
			self::$menu['title'] = "";
		}
		public static function upload($data=array(),$endpoint="")
		{
			$endpoint = (empty($endpoint)) ? constant("APP_URL") : $endpoint ;
			$curl = curl_init();
			curl_setopt_array($curl, array(
			  CURLOPT_URL => $endpoint,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS => $data
			));

			$response = curl_exec($curl);

			curl_close($curl);
			return $response;

		}
		
		public static function post($data=array(),$endpoint="")
		{
			$endpoint = (empty($endpoint)) ? constant("APP_URL") : $endpoint ;
			$curl = curl_init();
			curl_setopt_array($curl, array(
			  CURLOPT_URL => $endpoint,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS => $data
			));

			$response = curl_exec($curl);

			curl_close($curl);
			return json_decode($response,true);

		}
		public static function phone_clear($value='')
		{
			$value = trim($value);
			$ret = $value;
			$str_1 = "+25";
			$var_1 = substr($value, 0,3);
			if ($str_1 == $var_1) {
				$ret = (string) substr($value, 3);
			}else{
				$str_2 = "25";
				$var_2 = substr($value, 0,2);
				if ($str_2 == $var_2) {
					$ret = (string) substr($value, 2);
				}
			}
			return $ret;
		}
	    public static function id_valid($value='')
	    {
	      $retur = false;
	      //echo strlen($value);
	      if (empty($value)) {
	        $retur = "ID Must not be empty";
	      }elseif (!is_numeric($value)) {
	        $retur = "ID must be in number format without space or any other non-numeric value";
	      }elseif (strlen($value) != 16) {
	        $retur = "ID must be 16 digits only";
	      }
	      return $retur;
	    }
	    public static function phone_valid($value='')
	    {
	      $retur = false;
	      $t = "";
	      if (!empty($value)) {
	        $t = $value;
	        $jk = strlen($t);
	        $type = substr($t, 0, 2);
	      }
	      if (empty($value)) {
	        $retur = 'Phone number can not be empty';
	      }
	      elseif ($type != "07") {
	        $retur = 'Phone number must start with 07';
	      }
	      elseif (!is_numeric($t)) {
	        $retur = 'Phone number must contain only numbers (0-9)';
	      }
	      elseif ($jk != "10") {
	        $retur = "Phone number must be 10 digits (07........)";
	      }else{
	        //echo $_POST['system_tel_nom'];
	      }
	      return $retur;
	    }
	    public static function name_valid($value='')
	    {
	      $givenName = $value;
	      $retur = false;

	      if(preg_match("/^([a-zA-Z' ]+)$/",$givenName)){
	        $retur = false;
	      }else{
	        $retur = 'Invalid name given.';
	      }

	      return $retur;

	    }   

	    public static function reset()
	    {
	      self::$sess = array();
	    }
	    public static function set($name='',$value='')
	    {
	      if (!empty($name) || $name == 0) {
	        self::$sess[$name] = $value;
	      }
	    }
	    public static function get($name)
	    {
	      if (count(self::$sess) > 0 && isset(self::$sess[$name]) && !is_null(self::$sess[$name])) {
	        return self::$sess[$name];
	      }else{
	        return "";
	      }
	    }
	    public static function set_menu_title($value='')
	    {
	    	self::$menu["title"] = (!empty($value)) ? $value."\n" : "";
	    }
	    public static function set_menu($name="",$value='')
	    {
	    	if (!empty($name)) {
	        	self::$menu["menu"][$name] = $value;
	      	}
	    }
	    public static function gateway_2_set($name="",$value='')
	    {
	    	if (!empty($name)) {
	        	self::$gateway_2[$name] = $value;
	      	}
	    }
	    public static function gateway_2_get($name="")
	    {
	    	if (count(self::$gateway_2) > 0 && isset(self::$gateway_2[$name]) && !is_null(self::$gateway_2[$name])) {
	        	return self::$gateway_2[$name];
		     }else{
		        return self::$gateway_2;
		    }
	    }	    
	    public static function menu_val($type="1")
	    {
	    	if (constant("gateway") == 1) {
		    	$continue = ($type == 1) ? 1 : 0 ;
		    	og_app::gateway_2_set("ContinueSession",$continue);

		    	$text = self::$menu['title'];
		    	foreach (self::$menu["menu"] as $key => $value) {
					$text .= $key.". ".$value." \n";
		    	}

				og_app::gateway_2_set("message",$text);
				$response = json_encode(og_app::gateway_2_get("/]/"));

	    	}else{
		    	$response = ($type == 1) ? "CON " : "END " ;
		    	$response .= self::$menu['title'];
		    	foreach (self::$menu["menu"] as $key => $value) {
					$response .= $key.". ".$value." \n";
		    	}
	    	}
	    	return $response;
	    }
	    public static function menu_reset($type="1")
	    {
	    	self::$menu['title'] = "";
	    	self::$menu['menu'] = array();

	    }
	    public static function display($value='')
	    {
	    	echo $value;
	    }
	    public static function get_uuid()
		{
		    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
		        // 32 bits for "time_low"
		        mt_rand(0, 0xffff), mt_rand(0, 0xffff),

		        // 16 bits for "time_mid"
		        mt_rand(0, 0xffff),

		        // 16 bits for "time_hi_and_version",
		        // four most significant bits holds version number 4
		        mt_rand(0, 0x0fff) | 0x4000,

		        // 16 bits, 8 bits for "clk_seq_hi_res",
		        // 8 bits for "clk_seq_low",
		        // two most significant bits holds zero and one for variant DCE1.1
		        mt_rand(0, 0x3fff) | 0x8000,

		        // 48 bits for "node"
		        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
		    );
		}
	}
/**
 * 
 */
class og_validation {
function isUserInputInList($userInput) {
    $rwandaDistricts = [
        "Ngoma",
        "Gatsibo",
        "Kayonza",
        "Kirehe",
        "Bugesera",
        "Nyagatare",
        "Rwamagana",
        "Kicukiro",
        "Gasabo",
        "Nyarugenge",
        "Burera",
        "Gakenke",
        "Gicumbi",
        "Musanze",
        "Rulindo",
        "Gisagara",
        "Huye",
        "Kamonyi",
        "Muhanga",
        "Nyamagabe",
        "Nyanza",
        "Nyaruguru",
        "Ruhango",
        "Karongi",
        "Ngororero",
        "Nyabihu",
        "Nyamasheke",
        "Rubavu",
        "Rusizi",
        "Rutsiro"
    ];

    // Convert the user input to title case to ensure a case-insensitive match
    $userInput = ucwords($userInput);

    if (in_array($userInput, $rwandaDistricts)) {
        return false;
    } else {
        return "Invalid District";
    }
}
}
 ?>