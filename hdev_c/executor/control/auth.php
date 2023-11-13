<?php 
  /**  
   * varidation login
   */
  class hdev_v
  {
    public static function login($user,$password)
    {
      $rt = hdev_data::log_user($user,$password);
      if ($rt != "no") { 
        echo "ok";
      }else{
        echo "";
      }
    }
  }
   /**
   * uers permissions
   */
  class hdev_auth_service
  {
     
    function __construct($user='',$service)
    {
      global $rasms_service;
      global $rasms_service_users;
      $this->user = (isset($user) && !empty($user) && $user != "") ? trim($user) : hdev_log::uid();
      $userfunc = hdev_log::fid();
      //$userfunc = 'admin';
      $this->service = trim($service);
      $this->user_group = (isset($userfunc) && !isset($_GET['printer'])) ? trim($userfunc) : "guest" ;
      $this->service_db = $rasms_service;
      $this->user_db = $rasms_service_users;
    }
    public function access()
    {
      $retur = false;
      if (isset($this->user_db[$this->user_group]) && is_array($this->user_db[$this->user_group])) {
        //var_dump($this->user_db[$this->user_group]);
        if (in_array($this->service, $this->user_db[$this->user_group])) {
          if (array_key_exists($this->service, $this->service_db) && isset($this->service_db[$this->service]['name'])) {
            $retur = $this->service_db[$this->service]['name'];
          }
        }
      }
      return $retur;
    }
    public function error($ref="")
    {
      $retur = false;
      if (array_key_exists($this->service, $this->service_db) && isset($this->service_db[$this->service]['error'])) {
        $retur = $this->service_db[$this->service]['error'];
      }else{
        if ($ref == "") {
          return "Access Denied to you !!";
        }elseif ($ref == "alert") {
          return ucfirst($retur);
        }else{
          exit("Access Denied to you !!");
        }
      }
      if ($ref == "") {
        return ucfirst($retur);
      }elseif ($ref == "alert") {
          return ucfirst($retur);
      }else{
        exit(ucfirst($retur));
      }
    }
  }
  class hdev_url_service
  {
     
    function __construct($user='',$service)
    {
      global $rasms_urls;
      global $rasms_urls_users;
      $this->user = (isset($user) && !empty($user) && $user != "") ? trim($user) : hdev_log::uid();
      $userfunc = hdev_log::fid();
      //$userfunc = 'admin';
      $this->service = trim($service);
      $this->user_group = (isset($userfunc) && !empty($userfunc) && !isset($_GET['printer'])) ? trim($userfunc) : "guest" ;
      $this->service_db = $rasms_urls;
      $this->user_db = $rasms_urls_users;
    }
    public function access()
    {
      $retur = false;
      //$retur = ($this->user_group == "admin") ? true : false ;
      //$retur = ($this->user_group == "admin") ? true : false ;
      if (isset($this->user_db[$this->user_group]) && is_array($this->user_db[$this->user_group])) {
        //var_dump($this->user_db[$this->user_group]);
        if (in_array($this->service, $this->user_db[$this->user_group])) {
          if (array_key_exists($this->service, $this->service_db) && isset($this->service_db[$this->service]['name'])) {
            $retur = $this->service_db[$this->service]['name'];
          }
        }
      }
      return $retur;
    }
    public function error($ref="")
    {
      $retur = false;
      echo $this->service;
      /*print_r( array_keys($this->service_db)[5]);
      exit($this->service_db[$this->service]);*/
      if (array_key_exists($this->service, $this->service_db) && isset($this->service_db[$this->service]['error'])) {
        $retur = $this->service_db[$this->service]['error'];
      }else{
        if ($ref == "") {
          return "Access Denied to you !!!";
        }elseif ($ref == "alert") {
          return ucfirst($retur);
        }else{
          exit("Access Denied to you !!");
        }
      }
      if ($ref == "") {
        return ucfirst($retur);
      }elseif ($ref == "alert") {
          return ucfirst($retur);
      }else{
        exit(ucfirst($retur));
      }
    }
  }

 ?>