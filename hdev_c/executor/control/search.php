<?php 
    /**
   * search data 
   */
  class hdev_search
  {
    private static $limit = null;
    public static function reset()
    {
      self::$limit = null;
    }
    public static function set()
    {
      self::$limit = "1";
    }
    public static function search()
    {
      if (!is_null(self::$limit)) {
        return true;
      }else{
        return false;
      }
    }

  }

 ?>