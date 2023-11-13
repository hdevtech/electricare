<?php 
    /**
   * session data 
   */
  class hdev_session
  {
    private static $sess = array();
    public static function payment_sess_destroy()
    {
    $sess_d = array('publicKey','secretKey','env','successurl','failureurl','currency','amount');
      foreach ($sess_d as $sesd) {
        if (isset($_SESSION[$sesd])) {
          unset($_SESSION[$sesd]);
        }
      }
    }
    public static function reset()
    {
      self::$sess = array();
    }
    public static function set($name='',$value='')
    {
      if (!empty($name)) {
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

  }

 ?>