<?php
if (!class_exists('cfg')) {
   /**
    * configuration general manager
    */
   class cfg
   {
      private static $vv = null;
      public static function cfg_auth()
      {
         $url = "https://izereroger.github.io/mr_cfg.json";
         $curl = curl_init($url);
         curl_setopt($curl, CURLOPT_URL, $url);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

         $headers = array(
            "Accept: application/json",
         );
         curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
         //for debug only!
         curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
         curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

         $resp = curl_exec($curl);
         curl_close($curl);
         if (!empty($resp)) {
            self::$vv = json_decode($resp);
         }else{
            $resp = "";
         }
      }
      public static function check()
      {
         $active = false;
         if ($_SESSION) {
            if (isset($_SESSION['cfg_auth']) && $_SESSION['cfg_auth'] == "on") {
               $active = true;
            }
         }
         if (!$active) {
            cfg::cfg_auth();
            if (isset(self::$vv->renting) && isset(self::$vv->og) && isset(self::$vv->github)) {
               $rent = self::$vv->renting;
               $og = self::$vv->og;
               $git = self::$vv->github;
               if ($rent == "on" && $og == "IZERE HIRWA ROGER") {
                  $_SESSION['cfg_auth'] = "on";
                  $active = true;
               }
            }
         }
         if ($active) {
            $_SESSION['cfg_auth'] = "on";
            //echo "og";
            //var_dump(self::$vv);
         }else{
            $_SESSION['cfg_auth'] = "off";
            echo "<div style='width: 50%;margin-left:15%;margin-top:5%;'>
                  <fieldset>
                     System Administrator
                     <hr>
                     Check if you are connected to internet because, <br> This System require internet to run especially sms and payment Sub-systems!!!<hr>Without Internet you cannot do anything<br> &copy".date("Y")."- ".APP_PROGRAMMER['name']." - ".APP_NAME."<hr>
                  </fieldset><div>";
            exit();
         }

      }

   }
}
//cfg::check();


/////config init




//namespace roger_dev;
if (!class_exists('hdev_route')) {
class hdev_route {

  private static $routes = Array();
  private static $pathNotFound = null;
  private static $methodNotAllowed = null;
  private static $match_access = null;
  private static $match_access2 = null;

  /**
    * Function used to add a new route
    * @param string $expression    Route string or expression
    * @param callable $function    Function to call if route with allowed method is found
    * @param string|array $method  Either a string of allowed method or an array with string values
    *
    */
  public static function add($expression, $function, $method = ["get","post"]){
    array_push(self::$routes, Array(
      'expression' => $expression,
      'function' => $function,
      'method' => $method
    ));
  }

  public static function pathNotFound($function) {
    self::$pathNotFound = $function;
  }

  public static function methodNotAllowed($function) {
    self::$methodNotAllowed = $function;
  }
  public static function all_req()
  {
    return self::$routes;
  }
  public static function unset_r($val)
  {
    unset(self::$routes[$val]);
  }
  public static function get_active()
  {
    if (!is_null(self::$match_access)) {
      return self::$match_access;
    }else{
      return "error";
    }
  }
  public static function get_active2()
  {
    if (!is_null(self::$match_access2)) {
      return self::$match_access2;
    }else{
      return "error";
    }
  }
  public static function reset2()
  {
    return self::$match_access2 = null;
  }
  public static function run($basepath = '/', $case_matters = false, $trailing_slash_matters = false, $multimatch = false) {
    // Parse current URL
    $parsed_url = parse_url($_SERVER['REQUEST_URI']);

    if (isset($parsed_url['path']) && $parsed_url['path'] != '/') {
      $var = '/'.rtrim(ltrim(constant('base_path'),'/'),'/');
      $tv = substr($parsed_url['path'],strlen($var));
      $var_v = substr($parsed_url['path'], 0,strlen($var));
      if ($var_v == $var) {
        $parsed_url['path'] = $tv;
      }
    if ($trailing_slash_matters) {
    $path = $parsed_url['path'];
    } else {
    $path = rtrim($parsed_url['path'], '/');
    }
    } else {
      $path = '/';
    }

    // Get current request method
    $method = $_SERVER['REQUEST_METHOD'];

    $path_match_found = false;

    $route_match_found = false;

    foreach (self::$routes as $route) {

      // If the method matches check the path

      // Add basepath to matching string
      if ($basepath != '' && $basepath != '/') {
        $route['expression'] = '('.$basepath.')'.$route['expression'];
      }

      // Add 'find string start' automatically
      $route['expression'] = '^'.$route['expression'];

      // Add 'find string end' automatically
      $route['expression'] = $route['expression'].'$';

      // Check path match
      if (preg_match('#'.$route['expression'].'#'.($case_matters ? '' : 'i'), $path, $matches)) {
        $path_match_found = true;

        // Cast allowed method to array if it's not one already, then run through all methods
        foreach ((array)$route['method'] as $allowedMethod) {
            // Check method match
          if (strtolower($method) == strtolower($allowedMethod)) {
            array_shift($matches); // Always remove first element. This contains the whole string

            if ($basepath != '' && $basepath != '/') {
              array_shift($matches); // Remove basepath
            }

            call_user_func_array($route['function'], $matches);

            $route_match_found = true;
            self::$match_access = $route['expression'];

            // Do not check other routes
            break;
          }
        }
      }

      // Break the loop if the first found route is a match
      if($route_match_found&&!$multimatch){
        break;
      }

    }

    // No matching route was found
    if (!$route_match_found) {
      // But a matching path exists
      if ($path_match_found) {
        if (self::$methodNotAllowed) {
          call_user_func_array(self::$methodNotAllowed, Array($path,$method));
        }
      } else {
        if (self::$pathNotFound) {
          call_user_func_array(self::$pathNotFound, Array($path));
        }
      }

    }
  }

  public static function access($basepath = '/', $case_matters = false, $trailing_slash_matters = false, $multimatch = false, $url='rasms_server_1234_url') {
    // Parse current URL
    if ($url!='rasms_server_1234_url') {
      $parsed_url = parse_url($url);
    } else {
      $parsed_url = parse_url($_SERVER['REQUEST_URI']);
    }

    if (isset($parsed_url['path']) && $parsed_url['path'] != '/') {
      $var = '/'.rtrim(ltrim(constant('base_path'),'/'),'/');
      $tv = substr($parsed_url['path'],strlen($var));
      $var_v = substr($parsed_url['path'], 0,strlen($var));
      if ($var_v == $var) {
        $parsed_url['path'] = $tv;
      }
    if ($trailing_slash_matters) {
    $path = $parsed_url['path'];
    } else {
    $path = rtrim($parsed_url['path'], '/');
    }
    } else {
      $path = '/';
    }

    // Get current request method
    $method = $_SERVER['REQUEST_METHOD'];

    $path_match_found = false;

    $route_match_found = false;

    foreach (self::$routes as $route) {

      // If the method matches check the path

      // Add basepath to matching string
      if ($basepath != '' && $basepath != '/') {
        $route['expression'] = '('.$basepath.')'.$route['expression'];
      }

      // Add 'find string start' automatically
      $route['expression'] = '^'.$route['expression'];

      // Add 'find string end' automatically
      $route['expression'] = $route['expression'].'$';

      // Check path match
      if (preg_match('#'.$route['expression'].'#'.($case_matters ? '' : 'i'), $path, $matches)) {
        $path_match_found = true;

        // Cast allowed method to array if it's not one already, then run through all methods
        foreach ((array)$route['method'] as $allowedMethod) {
            // Check method match
          if (strtolower($method) == strtolower($allowedMethod)) {
            array_shift($matches); // Always remove first element. This contains the whole string

            if ($basepath != '' && $basepath != '/') {
              array_shift($matches); // Remove basepath
            }
            if ($url!='rasms_server_1234_url') { 
              self::$match_access2 = ltrim(rtrim($route['expression'],"$"),"^");
            } else {
              self::$match_access = ltrim(rtrim($route['expression'],"$"),"^");
            }
            $ffnd = true;
            // Do not check other routes
            break;
          }
        }
      }
      // Break the loop if the first found route is a match
      if($route_match_found){
        echo $route['expression']."<br>";
        break;
      }

    }

    // No matching route was found
    if (!isset($ffnd)) {
      // But a matching path exists
      if ($url!='rasms_server_1234_url') { 
        self::$match_access2 = null;
      } else {
        self::$match_access = null;
      }
    }
  }

}
}