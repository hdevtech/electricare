<?php 
  /**
   * language activation
   */
  class hdev_lang
  {
    private static $lang = array();
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
      $langg = (isset($_SESSION['lang']) && !empty($_SESSION['lang'])) ? $_SESSION['lang'] : "eng" ;
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

 ?>