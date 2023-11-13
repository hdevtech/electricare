<?php 
	
  /**
  * school identity
  */
    class hdev_school_ck
    {
      public static function check()
      {
        $ref = hdev_data::get_school();
        $sc_ret = array();
        $sc_ret[] = "ok"; 
        $sc_cd = hdev_data::decd(constant("roger_draft"));
        if (is_array($ref) && count($ref) > 0) {
          foreach ($ref as $sc) {
            if (isset($sc['sc_name'])) {
              $school = strtoupper($sc['sc_name']);
              if ($school == $sc_cd) {
                $sc_ret[]= "ok";
              }else{
                $sc_ret[] = "no";
              }
            }
          }
        }
        if (!in_array("no", $sc_ret)) {
          return false;
        }else{
          return "school";
        }
      }
      public static function admin()
      {
        $geto = hdev_data::get_user("admin_roger");
        if ($geto) {
          return false;
        }else{
          return "admin";
        }
      }
    }
 ?>