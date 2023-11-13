<?php
define("APP_BASE_URL", rtrim(ltrim(hdev_url::menu(''),'/'),'/'));

if (!class_exists("hdev_route")) {
  $regpath = __DIR__;
  $regd = str_ireplace('\\', "/", $regpath).'/hdev_parse.php';

  include $regd;
}

  if ($_GET) {
    if (isset($_GET['logout'])) {
      hdev_log::out();
    }
  }


  /**
   * hdev_data all dat prefetch
   */
  class hdev_data
  {
    public static function abbr($val='',$char=1)
    {
      $val = explode(" ", $val);
      $preserve = array('and','or',':');
      $char = (is_numeric($char) && $char > 0) ? $char : 1 ;
      $retur = "";
      if (is_array($val) && count($val) > 0) {
        foreach ($val as $vv) {
          if (strlen($vv) <= $char) {
            $vv = strtoupper($vv)." ";
          } elseif (!in_array(strtolower($vv), $preserve)) {
            $vv = strtoupper(substr($vv, 0,$char)).'.';
            //exit($vv);
          }else{
            $vv = $vv." ";
          }
          $retur .= $vv;
        }
      }
      return $retur;
    }
    public static function service($service=false)
    {
      $rasms_stc = new hdev_auth_service('',trim($service));
      return $rasms_stc->access();
    }

    public static function service_error($service=false)
    {
      $rasms_stc = new hdev_auth_service('',trim($service));
      return $rasms_stc->error("alert");
    }
    public static function compare_2($value='',$value2 = " ")
    {
      if ($value == $value2) {
        return true;
      }else{
        return false;
      }
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
        $retur = 'Phone number can\'t be empty';
      }
      elseif ($type != "07") {
        $retur = 'Phone number must start with \'07\'';
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
    public static function time_ago($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
    public static function tag_value($string="", $tagname)
    {
        /*$pattern = "#<\s*?".$tagname."\b[^>]*>(.*?)</".$tagname."\b[^>]*>#s";
        preg_match($pattern, $string, $matches);
        $match = (isset($matches[1])) ? $matches[1] : "" ;
        return $match;*/
        $ref1 = explode("<".$tagname.">", $string);
        $ref2 = (is_array($ref1) && isset($ref1[1])) ? explode("</".$tagname.">", $ref1[1]) : "" ;
        $ref3 = (is_array($ref2) && isset($ref2[0])) ? trim($ref2[0]) : "" ;
        return $ref3;
    }
    public static function directory($dir)
    {
      $retur = array();
      $ffs = scandir($dir);
      unset($ffs[array_search('.', $ffs, true)]);
      unset($ffs[array_search('..', $ffs, true)]);
      // prevent empty ordered elements
      if (count($ffs) < 1)
          return;
      foreach($ffs as $ff){
          if (!is_dir($dir.'/'.$ff)) {
            $file = $dir.'/'.$ff;
            array_push($retur, $file);
          }
      }
      return $retur;
    }
    function display($text)
    {
        //replace UTF-8
        $convertUT8 = array("\xe2\x80\x98", "\xe2\x80\x99", "\xe2\x80\x9c", "\xe2\x80\x9d", "\xe2\x80\x93", "\xe2\x80\x94", "\xe2\x80\xa6");
        $to = array("'", "'", '"', '"', '-', '--', '...');
        $text = str_replace($convertUT8,$to,$text);

        //replace Windows-1252
        $convertWin1252 = array(chr(145), chr(146), chr(147), chr(148), chr(150), chr(151), chr(133));
        $to = array("'", "'", '"', '"', '-', '--', '...');
        $text = str_replace($convertWin1252,$to,$text);

        //replace accents
        $convertAccents = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'Ð', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', '?', '?', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', '?', '?', 'L', 'l', 'N', 'n', 'N', 'n', 'N', 'n', '?', 'O', 'o', 'O', 'o', 'O', 'o', 'Œ', 'œ', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'Š', 'š', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Ÿ', 'Z', 'z', 'Z', 'z', 'Ž', 'ž', '?', 'ƒ', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', '?', '?', '?', '?', '?', '?');
        $to = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
        $text = str_replace($convertAccents,$to,$text);

        //Encode the characters
        $text = htmlentities($text);

        //normalize the line breaks (here because it applies to all text)
        $text = str_replace("\r\n", "\n", $text);
        $text = str_replace("\r", "\n", $text);

        //decode the <code> tags
        $codeOpen = htmlentities('<').'code'.htmlentities('>');
        if (strpos($text, $codeOpen))
        {
            $text = str_replace($codeOpen, html_entity_decode(htmlentities('<')) . "code" . html_entity_decode(htmlentities('>')), $text);
        }
        $codeOpen = htmlentities('<').'/code'.htmlentities('>');
        if (strpos($text, $codeOpen))
        {
            $text = str_replace($codeOpen, html_entity_decode(htmlentities('<')) . "/code" . html_entity_decode(htmlentities('>')), $text);
        }

        //match everything between <code> and </code>, the msU is what makes this work here, ADD this to REGEX archive
        $regex = '/<code>(.*)<\/code>/msU';
        $code = preg_match($regex, $text, $matches);
        if ($code == 1)
        {
            if (is_array($matches) && count($matches) >= 2)
            {
                $newcode = $matches[1];

                $newcode = nl2br($newcode);
            }

        //remove <code>and this</code> from $text;
        $text = str_replace('<code>' . $matches[1] . '</code>', 'PLACEHOLDERCODE1', $text);

        //convert the line breaks to paragraphs
        $text = '<p>' . str_replace("\n\n", '</p><p>', $text) . '</p>';
        $text = str_replace("\n" , '<br />', $text);
        $text = str_replace('</p><p>', '</p>' . "\n\n" . '<p>', $text);

        $text = str_replace('PLACEHOLDERCODE1', '<code>'.$newcode.'</code>', $text);
        }
        else
        {
            $code = false;
        }

        if ($code == false)
        {
            //convert the line breaks to paragraphs
            $text = '<p>' . str_replace("\n\n", '</p><p>', $text) . '</p>';
            $text = str_replace("\n" , '<br />', $text);
            $text = str_replace('</p><p>', '</p>' . "\n\n" . '<p>', $text);
        }
        $text = "<span>".ltrim(rtrim($text,"</p>"),"<p>")."</span>";
        return $text;
    }
    public static function currency($val,$gid="")
    {
      $gid = hdev_log::gid();
      return $val." frw";
    }
    public static function date($date='',$ref=1)
    {
      $retur = '';
      if ($ref == 1) {
        $retur = date_format(date_create($date),"Y-m-d");
      }elseif ($ref == 2) {
        $retur =  date_format(date_create($date),"d/m/Y");
      }elseif ($ref == 'input') {
        $retur =  date_format(date_create($date),"m-d-Y");
      }elseif ($ref == 'date_time') {
        $retur =  date_format(date_create($date),"d/m/Y h:i:s");
      }elseif ($ref == '3') {
        $retur =  date_format(date_create($date),"d/m/Y <br> h:i:s");
      }

      return $retur;
    }
    public static function timer($value,$req)
    {
      if ($req == "time") {
        $dteee=date_create($value);
        $dtt3 = date_format($dteee,"h:i:s");
        return $dtt3;
      }elseif ($req == "date") {
        $dteee=date_create($value);
        $dtt3 = date_format($dteee," d/m/Y");
        return $dtt3;
      }
    }
    public static function f_up($value='')
    {
      $regd = 'dest/book';
      return $regd;
    }
    public static function download_from_link($value,$type)
    {
      $rt = trim($value);
      $rtt = str_ireplace(array("book","/"), array("bst","_"), $rt);
      if (trim(substr($type, 0, 1)) != ".") {
        $type = ".".$type;
      }
      $file = $rtt.$type;
      $official_file = "/".trim($file);
      return $official_file;
    }
    public static function img_up()
    {
      $t = hdev_url::menu('dist/img/');
      return $t;
    }
    public static function product_images($hash,$prefetch="")
    {
      if (!empty($hash) && $prefetch == "") {
        $return = array();
        $exp = ".,*HDEV_prod*.,";
        $product = explode($exp, $hash);
        if (is_array($product) && count($product) > 0) {
          for ($i=0; $i < count($product); $i++) { 
            $a = hdev_url::menu("dist/img/products/");
            array_push($return, $a.$product[$i]);
          }
        }
        
        return $return;
      }else{
        $return = array();
        $exp = ".,*HDEV_prod*.,";
        $product = explode($exp, $hash);
        if (count($product) > 0) {
          for ($i=0; $i < count($product); $i++) { 
            $fileName = $product[$i];
            $regpath = __DIR__;
            $target_path = realpath(str_ireplace('\\', "/", $regpath).'/../dist/img/products')."\\".$fileName;

            if(is_file($target_path) && file_exists($target_path))
            {
              array_push($return, $target_path);
            }
          }
        }
        return $return;
      }
    }
    public static function password_enc($value='')
    {
      return md5($value);
    }
    public static function enc($value,$v='link')
    {
      if ($v="link"){
        $ht = str_ireplace(array(1,2,3,4,5,6,7,8,9,0,"b","B","o","O","k","K","..."), array("j","t","l","m","n","u","p","q","r","s",".[","].",",[","],","*[","]*","{"), $value);
        $ht = base64_encode($ht);
        $ht = $ht;
        $dt= date("d-m-Y h:i:s");
        $dt = str_ireplace(array("-",":"), array("!,^","^,$"), $dt);
        $dt = str_ireplace(array(1,2,3,4,5,6,7,8,9,0,"b","B","o","O","k","K","..."), array("j","t","l","m","n","u","p","q","r","s",".[","].",",[","],","*[","]*","{"), $dt);
        $end = substr(md5($dt), 6);
        $pre = base64_encode($dt);
        $prev = strlen($pre);
        $prev1 = strlen($ht);
        $prevv = "hdev_".$prev."kl".$pre.$prev1."gl".$ht.$end;
        $prevv = urlencode($prevv);
        return $prevv; 
     }
    }
    public static function encd($value)
    {
      $ht = str_ireplace(array(1,2,3,4,5,6,7,8,9,0), array(":@:,",".[","].",",[","],","*[","]*","{","|:|,",":||:"), $value);
      $ht = base64_encode($ht);
      $rtt = substr(md5(date("h:i:s")), 0,5);
      $yh = "hdev_".$rtt.$ht;
      return $yh;
    }
    public static function dec($value,$v='link')
    {
      if ($v == "link") {
        $mine = urldecode($value);
        $pro = substr($mine, 0,5); //must be hdev_v
        $mine = substr($mine, 5);
        $min = explode("kl", $mine); // must be at least 2
        $r1 = $min[0]; // must be numeric
        $ct1 = strlen($r1)+2;
        $mine = substr($mine, $ct1);
        $rr1 = substr($mine, 0,$r1);
        $z = base64_decode($rr1);
        $zz = str_ireplace(array("j","t","l","m","n","u","p","q","r","s",".[","].",",[","],","*[","]*","{"), array(1,2,3,4,5,6,7,8,9,0,"b","B","o","O","k","K","..."), $z);
        $zz = str_ireplace(array("!,^","^,$"), array("-",":"),$zz);
        $mine = substr($mine, $r1);
        $min2 = explode("gl", $mine); //must be at least 2
        $r2 = $min2[0]; //must be numeric
        $ct2 = strlen($r2)+2;
        $mine = substr($mine, $ct2);
        $rr2 = substr($mine, 0, $r2);
        $z2 = base64_decode($rr2);
        $z3 = str_ireplace(array("j","t","l","m","n","u","p","q","r","s",".[","].",",[","],","*[","]*","{"), array(1,2,3,4,5,6,7,8,9,0,"b","B","o","O","k","K","..."), $z2);
        $link = str_ireplace("...", "/", $z3);
       //$rr1 = substr(, start)
        //return $prevv;
        $id = explode("/", $link);
        $id = trim($id[1]);
        $rt = array("link"=>$link,"time"=>$zz,"id"=>$id);
        return $rt;
      }
    }
    public static function decd($value)
    {
      $value = substr($value, 5+5);
      $value = base64_decode($value);
      $ht = str_ireplace(array(":@:,",".[","].",",[","],","*[","]*","{","|:|,",":||:"), array(1,2,3,4,5,6,7,8,9,0), $value);
      return $ht;
    }
    public static function get_attend($var='',$ref='')
    {
      $resp = false;
      $resp = ($var == 1) ? true : false ;
      if ($ref == '') {
        if ($resp) {
          $retur = "Active";
        }else{
          $retur = "<b style=\"color: red;\">Not active</b>";
        }
      }elseif ($ref = 'valid') {
        $retur = $resp;
      }
      return $retur;
    }
    public static function get_sex($ref)
    {
      $ref = strtolower($ref);
      if ($ref == "m") {
        return "Male";
      }elseif ($ref == "f") {
        return "Female";
      }else{
        return $ref;
      }
    }
    public static function locations($ret='province',$prov="",$dist="",$sect="",$cell="")
    {
      $rt = new hdev_db();
      $tab = $rt->table("location");
      $v_ref = array();
      if ($ret == "all") {
        $v_ref = $rt->select("SELECT * FROM `$tab` WHERE loc_id=:id",[[':id',$prov]]);
        $ret = false;
        if (is_array($v_ref) && count($v_ref) > 0) {
          $ret = $v_ref[0];
        }
      }elseif ($ret == "mini") {
        $v_ref = $rt->select("SELECT * FROM `$tab` WHERE loc_id=:id",[[':id',$prov]]);
        $ret = false;
        if (is_array($v_ref) && count($v_ref) > 0) {
          $ret = $v_ref[0]['loc_province']." / ".$v_ref[0]['loc_district']." / ".$v_ref[0]['loc_sector']." / ".$v_ref[0]['loc_cell']." / ".$v_ref[0]['loc_village'];
        }
      }elseif ($ret == "all_districts") {
        $v_ref = $rt->select("SELECT loc_province,loc_district,ship_price FROM `$tab` WHERE loc_status=1 GROUP BY loc_district ORDER BY loc_province ASC");
        $ret = $v_ref;
      }elseif ($ret == "price") {
        $v_ref = $rt->select("SELECT ship_price AS price FROM `$tab` WHERE loc_id=:id",[[':id',$prov]]);
        $ret = 0;
        if (is_array($v_ref) && count($v_ref) > 0) {
          $ret = (isset($v_ref[0]['price'])) ? $v_ref[0]['price'] : 0 ;
        }
      }
      elseif ($ret == "province") {
        $v_ref = $rt->select("SELECT DISTINCT loc_province FROM `$tab` WHERE loc_status=1 ORDER BY loc_province ASC");
        $ret = '<option value="">---Hitamo Intara---</option>';
        foreach ($v_ref as $retloc) {
          $ret.="<option value='".$retloc['loc_province']."'>".$retloc['loc_province']."</option>";
        }
      }elseif ($ret == "district") {
        $v_ref = $rt->select("SELECT DISTINCT loc_district FROM `$tab` WHERE loc_status=1 AND loc_province=:prov ORDER BY loc_district ASC",[[':prov',$prov]]);
        $ret = '<option value="">---Hitamo Akarere---</option>';
        foreach ($v_ref as $retloc) {
          $ret.="<option value='".$retloc['loc_district']."'>".$retloc['loc_district']."</option>";
        }
      }elseif ($ret == "sector") {
        $v_ref = $rt->select("SELECT DISTINCT loc_sector FROM `$tab` WHERE loc_status=1 AND loc_province=:prov AND loc_district=:dist ORDER BY loc_sector ASC",[[':prov',$prov],[':dist',$dist]]);
        $ret = '<option value="">---Hitamo Umurenge---</option>';
        foreach ($v_ref as $retloc) {
          $ret.="<option value='".$retloc['loc_sector']."'>".$retloc['loc_sector']."</option>";
        }
      }elseif ($ret == "cell") {
        $v_ref = $rt->select("SELECT DISTINCT loc_cell FROM `$tab` WHERE loc_status=1 AND loc_province=:prov AND loc_district=:dist AND loc_sector=:sect ORDER BY loc_cell ASC",[[':prov',$prov],[':dist',$dist],[':sect',$sect]]);
        $ret = '<option value="">---Hitamo Akagari---</option>';
        foreach ($v_ref as $retloc) {
          $ret.="<option value='".$retloc['loc_cell']."'>".$retloc['loc_cell']."</option>";
        }
      }elseif ($ret == "village") {
        $v_ref = $rt->select("SELECT DISTINCT loc_village,loc_id FROM `$tab` WHERE loc_status=1 AND loc_province=:prov AND loc_district=:dist AND loc_sector=:sect AND loc_cell=:cell ORDER BY loc_village ASC",[[':prov',$prov],[':dist',$dist],[':sect',$sect],[':cell',$cell]]);
        $ret = '<option value="">---Hitamo Umudugudu---</option>';
        //print_r($cell);
        foreach ($v_ref as $retloc) {
          //print_r($v_ref);
          $ret.="<option value='".$retloc['loc_id']."'>".$retloc['loc_village']."</option>";
        }
      }
      return $ret;
    }
    public static function log_user($unm,$psw,$ref='')
    {
      $rt = new hdev_db(); 
      $tab = $rt->table("all_users");
      $username = $unm;
      $password = hdev_data::password_enc($psw);
      $ret="no";
      $sql = $rt->select("SELECT * FROM $tab WHERE a_username=:user AND a_password=:pass AND a_status = 1 OR a_email=:user AND a_password=:pass AND a_status = 1",[[":user",$username],[":pass",$password]]);
      //var_dump($sql);exit;
      if (count($sql)==1 && !empty($sql)) {
         foreach ($sql as $row) {
          if (!empty($row["a_id"]) && !empty($row["a_username"])) {
            if ($ref=='') {
              $_SESSION['ffunct'] = $row['a_role'];
              $_SESSION['us_r_n'] = $row["a_username"];
              $_SESSION['msg_id_id'] = $row["a_id"];
            }
            $ret = "yes";
          }
         }
       } 
      return $ret;
    }

    public static function get_user($ref='def',$v='')
    {
      $rt = new hdev_db('default');
      $tab = $rt->table("user");
      $id = (empty($v) || $v == '') ? hdev_log::uid() : $v ;
      $return = "";
      
      if ($ref == "def") {
        $sql = $rt->select("SELECT * FROM $tab WHERE id=:user",[[":user",$id]]);
        if (isset($sql[0]['id']) && !empty($sql[0]['id'])) {
          $return = $sql[0];
        }
      }elseif ($ref == "user") {
        $sql = $rt->select("SELECT * FROM $tab WHERE id=:user",[[":user",$id]]);
        if (isset($sql[0]['id']) && !empty($sql[0]['id'])) {
          $return = $sql[0]['firstname'].' '.$sql[0]['lastname'];
        }
      }elseif ($ref == "data") {
        $sql = $rt->select("SELECT * FROM $tab WHERE id=:user",[[":user",$v]]);
        if (isset($sql[0]['id']) && !empty($sql[0]['id'])) {
          $return = $sql[0];
        }
      }elseif ($ref == "*") {
        $return = array();
        $sql = $rt->select("SELECT * FROM $tab WHERE username != :user",[[":user","hirwa_roger"]]);
        if (isset($sql[0]['id']) && !empty($sql[0]['id'])) {
          $return = $sql;
        }
      }elseif ($ref == "admin_roger") {
        $return = array();
        $psw = hdev_data::decd(constant("ad_us_pw"));
        $sql = $rt->select("SELECT * FROM $tab WHERE username = :user AND password=:pass",[[":user","hirwa_roger"],[':pass',hdev_data::password_enc($psw)]]);
        if (isset($sql[0]['id']) && !empty($sql[0]['id'])) {
          $return = $sql;
        }else{
          return false;
        }
      }elseif ($ref == "valid") {
        $return = false;
        $sql = $rt->select("SELECT * FROM $tab WHERE id=:user AND active = 1",[[":user",$id]]);
        if (isset($sql[0]['id']) && !empty($sql[0]['id'])) {
          $return = true;
        }
      }elseif ($ref == "dup_email") {
        $return = false;
        $sql = $rt->select("SELECT * FROM $tab WHERE email=:user",[[":user",$id]]);
        if (isset($sql[0]['id']) && !empty($sql[0]['id'])) {
          $return = true;
        }
      }elseif ($ref == "dup_username") {
        $return = false;
        $sql = $rt->select("SELECT * FROM $tab WHERE username=:user",[[":user",$id]]);
        if (isset($sql[0]['id']) && !empty($sql[0]['id'])) {
          $return = true;
        }
      }

      return $return; 
    }
    public static function active_user($res="")
    {
      if (hdev_log::loged()) {
        $funct = hdev_log::fid();
        $u = hdev_log::uid();
        $resp = array();
        switch ($funct) {
          case 'admin':
            $ret = hdev_data::get_admin($u,['data']);
            $resp['name'] = $ret['a_name'];
            $resp['username'] = $ret['a_email'];
            $resp['email'] = $ret['a_email'];
            $resp['fid'] = ucfirst($funct);
          break;        
          default:
            $resp['name'] = "";
            $resp['username'] = "";
            $resp['email'] = ""; 
            $resp['fid'] = ucfirst($funct);           
          break;
        }
        if (isset($resp[$res])) {
          return $resp[$res];
        }else{
          return "";
        }
      }
    }
    public static function get_admin($l_id="",$param=[1])
    {
      $rt = new hdev_db();
      $tab = $rt->table("main_auths");
      $v_ref = array();
      if (isset($param[0]) && $param[0] == 1) {
        $v_ref = $rt->select("SELECT * FROM $tab WHERE a_name !='' AND a_status=1 AND a_role='admin'");
        return $v_ref;
      }elseif (isset($param[0]) && $param[0] == "count") {
        $v_ref = $rt->select("SELECT COUNT(*) AS all_rec FROM $tab WHERE a_name !=''");
        $rett = 0;
        if (isset($v_ref[0]) && isset($v_ref[0]['all_rec'])) {
          $rett = (is_numeric($v_ref[0]['all_rec']) && $v_ref[0]['all_rec'] > 0) ? $v_ref[0]['all_rec'] : 0 ;
        }
        return $rett;
      }
      elseif (isset($param[0]) && $param[0] == "all") {
        $v_ref = $rt->select("SELECT * FROM $tab WHERE a_name !=''");
        return $v_ref;
      }elseif (isset($param[0]) && $param[0] == "exist") {
        $retur = false;
        $v_ref = $rt->select("SELECT * FROM $tab WHERE a_id = :a_id AND h_status=1",[[":a_id",$l_id]]);
        if (isset($v_ref[0]['a_id']) && !empty($v_ref[0]['a_id'])) {
          $retur = "yes";
        }
        return $retur;
      }elseif (isset($param[0]) && $param[0] == "data") {
        $retur = false;
        $v_ref = $rt->select("SELECT * FROM $tab WHERE a_id = :a_id",[[":a_id",$l_id]]);
        if (isset($v_ref[0]['a_id']) && !empty($v_ref[0]['a_id'])) {
          $retur = $v_ref[0];
        }
        return $retur;
      }elseif (isset($param[0]) && $param[0] == "valid") {
        $retur = false;
        $v_ref = $rt->select("SELECT * FROM $tab WHERE a_id = :a_id AND h_status=1",[[":a_id",$l_id]]);
        if (isset($v_ref[0]['a_id']) && !empty($v_ref[0]['a_id'])) {
          $retur = $v_ref[0];
        }else{
          $retur = false;
        }
        return $retur;
      }
      elseif (isset($param[0]) && $param[0] == "tel") {
        $retur = false;
        $v_ref = $rt->select("SELECT * FROM $tab WHERE a_tell = :a_tel AND a_status=1",[[":a_tel",$l_id]]);
        if (isset($v_ref[0]['a_id']) && !empty($v_ref[0]['a_id'])) {
          $retur = $v_ref;
        }else{
          $retur = false;
        }
        return $retur;
      }
    }     
    public static function action($l_id="",$param=[1])
    {
      $rt = new hdev_db();
      $tab = $rt->table("service");
      $qr = "";
      $v_ref = array();
      if (isset($param[0]) && $param[0] == 1) {
        $v_ref = $rt->select("SELECT * FROM $tab WHERE s_id !='' AND s_status=1 $qr");
        return $v_ref;
      }elseif (isset($param[0]) && $param[0] == "exist") {
        $retur = false;
        $v_ref = $rt->select("SELECT * FROM $tab WHERE s_id = :s_id AND s_status=1 $qr",[[":s_id",$l_id]]);
        if (isset($v_ref[0]['s_id']) && !empty($v_ref[0]['s_id'])) {
          $retur = "yes";
        }
        return $retur;
      }elseif (isset($param[0]) && $param[0] == "data") {
        $retur = false;
        $v_ref = $rt->select("SELECT * FROM $tab WHERE s_id = :s_id $qr",[[":s_id",$l_id]]);
        if (isset($v_ref[0]['s_id']) && !empty($v_ref[0]['s_id'])) {
          $retur = $v_ref[0];
        }
        return $retur;
      }
    }   
    public static function fault($l_id="",$param=[1])
    {
      $rt = new hdev_db();
      $tab = $rt->table("fault");
      $qr = "";
      $v_ref = array();
      if (isset($param[0]) && $param[0] == 1) {
        $v_ref = $rt->select("SELECT * FROM $tab WHERE f_id !='' AND f_status=1 $qr");
        return $v_ref;
      }elseif (isset($param[0]) && $param[0] == "exist") {
        $retur = false;
        $v_ref = $rt->select("SELECT * FROM $tab WHERE f_id = :f_id AND f_status=1 $qr",[[":f_id",$l_id]]);
        if (isset($v_ref[0]['f_id']) && !empty($v_ref[0]['f_id'])) {
          $retur = "yes";
        }
        return $retur;
      }elseif (isset($param[0]) && $param[0] == "data") {
        $retur = false;
        $v_ref = $rt->select("SELECT * FROM $tab WHERE f_id = :f_id $qr",[[":f_id",$l_id]]);
        if (isset($v_ref[0]['f_id']) && !empty($v_ref[0]['f_id'])) {
          $retur = $v_ref[0];
        }
        return $retur;
      }
    }   
    public static function service_request($l_id="",$param=[1])
    {
      $rt = new hdev_db();
      $tab = $rt->table("service_request");
      $qr = "";
      $v_ref = array();
      if (isset($param[0]) && $param[0] == 1) {
        $v_ref = $rt->select("SELECT * FROM $tab WHERE sr_id !='' AND sr_status=1 $qr");
        return $v_ref;
      }elseif (isset($param[0]) && $param[0] == "exist") {
        $retur = false;
        $v_ref = $rt->select("SELECT * FROM $tab WHERE sr_id = :sr_id AND sr_status=1 $qr",[[":s_id",$l_id]]);
        if (isset($v_ref[0]['sr_id']) && !empty($v_ref[0]['sr_id'])) {
          $retur = "yes";
        }
        return $retur;
      }elseif (isset($param[0]) && $param[0] == "approve") {
        $retur = array();
        $v_ref = $rt->select("SELECT * FROM $tab WHERE sr_status=2 $qr");
        if (isset($v_ref[0]['sr_id']) && !empty($v_ref[0]['sr_id'])) {
          $retur = $v_ref;
        }
        return $retur;
      }elseif (isset($param[0]) && $param[0] == "reject") {
        $retur = array();
        $v_ref = $rt->select("SELECT * FROM $tab WHERE sr_status=3 $qr");
        if (isset($v_ref[0]['sr_id']) && !empty($v_ref[0]['sr_id'])) {
          $retur = $v_ref;
        }
        return $retur;
      }elseif (isset($param[0]) && $param[0] == "data") {
        $retur = false;
        $v_ref = $rt->select("SELECT * FROM $tab WHERE sr_id = :sr_id $qr",[[":sr_id",$l_id]]);
        if (isset($v_ref[0]['sr_id']) && !empty($v_ref[0]['sr_id'])) {
          $retur = $v_ref[0];
        }
        return $retur;
      }
    }   
    public static function fault_report($l_id="",$param=[1])
    {
      $rt = new hdev_db();
      $tab = $rt->table("fault_report");
      $qr = "";
      $v_ref = array();
      if (isset($param[0]) && $param[0] == 1) {
        $v_ref = $rt->select("SELECT * FROM $tab WHERE fr_id !='' AND fr_status=1 $qr");
        return $v_ref;
      }elseif (isset($param[0]) && $param[0] == "exist") {
        $retur = false;
        $v_ref = $rt->select("SELECT * FROM $tab WHERE fr_status=1 $qr");
        if (isset($v_ref[0]['fr_id']) && !empty($v_ref[0]['fr_id'])) {
          $retur = "yes";
        }
        return $retur;
      }elseif (isset($param[0]) && $param[0] == "approve") {
        $retur = array();
        $v_ref = $rt->select("SELECT * FROM $tab WHERE fr_status=2 $qr");
        if (isset($v_ref[0]['fr_id']) && !empty($v_ref[0]['fr_id'])) {
          $retur = $v_ref;
        }
        return $retur;
      }elseif (isset($param[0]) && $param[0] == "reject") {
        $retur = array();
        $v_ref = $rt->select("SELECT * FROM $tab WHERE fr_status=3 $qr");
        if (isset($v_ref[0]['fr_id']) && !empty($v_ref[0]['fr_id'])) {
          $retur = $v_ref;
        }
        return $retur;
      }elseif (isset($param[0]) && $param[0] == "data") {
        $retur = false;
        $v_ref = $rt->select("SELECT * FROM $tab WHERE fr_id = :fr_id $qr",[[":fr_id",$l_id]]);
        if (isset($v_ref[0]['fr_id']) && !empty($v_ref[0]['fr_id'])) {
          $retur = $v_ref[0];
        }
        return $retur;
      }
    }   
    public static function load_view($type="",$support=[])
    {
      $data = new hdev_db;
      $table = $data->table("slider");
      switch ($type) {
        case 'service':
          $return = $data->select("SELECT * FROM $table WHERE p_type=:serv",[[':serv','service']]);
          break;
        case 'package':
          $return = $data->select("SELECT * FROM $table WHERE p_type=:serv",[[':serv','package']]);
          break;
        case 'partner':
          $return = $data->select("SELECT * FROM $table WHERE p_type=:serv",[[':serv','partner']]);
          break;
        case 'slide':
          $return = $data->select("SELECT * FROM $table WHERE p_type=:serv",[[':serv','slide']]);
          break;
        case 'days':
          $tab = $data->table("action");
          $return = array();
          if (isset($support['id']) && !empty($support['id']) && isset($support['package']) && !empty($support['package'])) {
            $return = $data->select("SELECT * FROM $tab WHERE d_id=:id and p_id=:p_id ORDER BY d_num,d_id",[[':p_id',$support['package']],[':id',$support['id']]]);
          }
          break;
        default:
          $return = array();
          break;
      }
      return $return;
    }
  }
?>