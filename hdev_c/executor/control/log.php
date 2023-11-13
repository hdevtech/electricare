<?php 
  
  /**
   * login or temporary data
   */
  class hdev_log
  {
    public static function wait($time="")
    {
      $tt = 10;
      if (is_numeric($time) && $time > 0) {
        $tt = $time;
      }
      sleep($tt);
    }
    public static function out()
    {
      session_unset();
      session_destroy(); 
      if (isset($_GET['nxt']) && !empty($_GET["nxt"])) {
        hdev_note::redirect(hdev_url::activate($_GET["nxt"]));
      }else{
        //hdev_note::message("loged out");
        hdev_note::redirect(hdev_url::menu(""));
      }

    }
    public static function uid()
    {
      if (isset($_SESSION['msg_id_id']) && !empty($_SESSION['msg_id_id'])) {
        return $_SESSION['msg_id_id'];
      }else{
        return '';
      }
    }
    public static function fid()
    {
      if (isset($_SESSION['ffunct']) && !empty($_SESSION['ffunct'])) {
        return $_SESSION['ffunct'];
      }else{
        return 'guest';
      }
    }
    public static function admin()
    {
      $user = self::fid();
      if ($user == "admin") {
        return true;
      }else{
        return false;
      }
    }        
    public static function loged()
    {
      if (!empty($_SESSION['msg_id_id'])) {
        return true;
      }else{
        return false;
      }
    }
    public static function close()
    {
      if (self::loged()) {
        exit();
      }
    }
    public static function qr_folder()
    {
      $regpath = __DIR__;
      $regg = $regpath;
      return realpath($regg)."\qr_3";
    }
    public static function qr_url_term($value='')
    {
      $vv = urlencode(hdev_data::encd($value));
      return hdev_url::menu("auth/gen".'/'.$vv);
    }   
  }

 ?>