<?php 
  
  /**
     *  craete menu of data
     */

    class hdevmenu
    { 
       public static function hdevstr($str)
       {
         return str_ireplace(array("'",'"'), array('\'',"\""), $str);
       }
       public static function message($msg)
       {
         echo '
          <script>alert(\''.$msg.'\')</script>
         ';
       }
       public static function nd_nav($min)
        {
           $urlk = trim($_SESSION['nd_url'][1]);
           if ($min == $urlk) {
            echo " btn-primary";
           }else{
            echo " btn-secondary";
           }
        }
       public static function topmenu($trees,$name,$link,$icon,$id='',$power='')
       {
         if (empty($_SESSION["act_url"])) {
            //$urlk = $urlk = trim(str_ireplace(hdev_url::get_url_min(), "", hdev_url::get_url_full()));
          }else{
            if (empty($_SESSION["act_url"][2])) {
              //$urlk = $urlk = trim(str_ireplace(hdev_url::get_url_min(), "", hdev_url::get_url_full()));
            }else{
              $urlk = trim(hdev_url::menu(ltrim($_SESSION['act_url'][2],'/')));

            }
          }
        if (empty($name)) {
          echo ""; 
        }elseif ($trees == "1") {
          $rnf = rand();
            $gen_id = ' btn_destination="'."hdev_url__".md5(hdev_data::encd($link."_".$rnf)).'" ';
            $id = (!empty($id)) ? ' id=\''.$id.'\'' : '' ;
            $power = (!empty($power)) ? $power : '' ;
            $view = '<li class="nav-item text-nowrap">';
            $error = "";
            if (!empty($link)) {
              $linka = explode("...", $link);
              if (is_array($linka) && count($linka) == 2) {
                $urlka = hdev_url::menu(trim($linka[0]).'/'.trim($linka[1]));
              }elseif (is_array($linka) && count($linka) == 1) {
                $urlka = hdev_url::menu(trim($linka[0]));
              }else{
                $urlka = hdev_url::menu('');
              }

             // hdev_route::access('/', false, false, false, $urlka);
              hdev_route::access('/', false, false, false, $urlka);
              $rasms_stc = new hdev_url_service('',trim(hdev_route::get_active2()));
              if ($rasms_stc->access()) {
                if ($urlk == $urlka) {
                  $preff = "";
                  if (constant("APP_MASK") != "") {
                      $preff = " -- " .constant("APP_MASK");
                    }
                  $view .='<a  href="'.$urlka.'" class="lift nav-link active'.$power.'"'.$gen_id.$id.' title="'.'APP'.'---' .self::hdevstr($name).$preff.'"">';
                }else{
                  $preff = "";
                  if (constant("APP_MASK") != "") {
                      $preff = " -- " .constant("APP_MASK");
                    }
                  $view .='<a  href="'.$urlka.'" class="text-nowrap lift nav-link'.$power.'"'.$gen_id.$id.' title="'.'APP'.'---' .self::hdevstr($name).$preff.'"">';
                }
              }else{
                $error ="no";
              }
            }else{
              $error = "no";
            }
            if ($error == "") {
              if (!empty($icon)) { 
                $view .= '<i class="nav-icon '.trim($icon).'"></i>';
                if (!empty($link)) {
                  $view .="&nbsp;<span>".self::hdevstr($name).'</span></a>';
                }
                  
                $view .= "</li>";

                echo $view;
              }
            }
         }
       }
       public static function mainmenu($trees,$name,$link,$icon,$power='')
       {
        $urlk = trim(hdev_url::menu(ltrim($_SESSION['act_url'][2],'/')));

        if (empty($name)) {
        }elseif ($trees == "1") {
            $gen_id =' btn_destination="'."hdev_url__".md5(hdev_data::encd($link."_".rand())).'" ';
            $view_item = '<li class="nav-item">';
            $view = "";
            $power = (!empty($power)) ? $power : '' ;
            $error = "";
            if (!empty($link)) {
              $linka = explode("...", $link);
              if (is_array($linka) && count($linka) == 2) {
                $urlka = hdev_url::menu(trim($linka[0]).'/'.trim($linka[1]));
              }elseif (is_array($linka) && count($linka) == 1) {
                $urlka = hdev_url::menu(trim($linka[0]));
              }else{
                $urlka = hdev_url::menu('');
              }

              hdev_route::access('/', false, false, false, $urlka);
              $rasms_stc = new hdev_url_service('',trim(hdev_route::get_active2()));
              if ($rasms_stc->access()) {
                if ($urlk == $urlka) {
                  $preff = "";
                  if (constant("APP_MASK") != "") {
                      $preff = " -- " .constant("APP_MASK");
                    }
                  $view .='<a href="'.$urlka.'" class="nav-link  liftk '.$power.'"'.$gen_id.'title="'.'APP'.' - ' .self::hdevstr($name).$preff.'">';
                }else{
                  $preff = "";
                  if (constant("APP_MASK") != "") {
                      $preff = " -- " .constant("APP_MASK");
                    }
                  $view .='<a href="'.$urlka.'" class="nav-link liftk '.$power.'"'.$gen_id.'title="'.'APP'.' - ' .self::hdevstr($name).$preff.'">';
                }
              }else{
                $error = "no";
              }
            }else{
              $error = "no";
            }
            if ($error == "") {
              if (!empty($icon)) {
                $view .= '<i class="'.trim($icon).'"></i><span>';
              }
              if (!empty($link)) {
                $view .=self::hdevstr(trim($name)).'</span></a>';
              }
                
              $view .= "</li>";
              echo $view_item.$view;
            }
         }elseif ($trees == "2") {
           $rnf = rand();
           $fm_linker = 'hdev_menu_id_'.md5(hdev_data::encd($link."_".$rnf));
           $gen_id = ' btn_destination="'."hdev_url__".md5(hdev_data::encd($link."_".$rnf)).'" ';
           $gen_id1 = ' btn_destination_parent_1="'."hdev_url__".md5(hdev_data::encd($link."_".$rnf)).'" ';
           $gen_id2 = ' btn_destination_parent_2="'."hdev_url__".md5(hdev_data::encd($link."_".$rnf)).'" ';
           $view="";
           $name = explode("^^", $name);
           $link = explode("^^", $link);
           $icon = explode("^^", $icon);
           $power = (!empty($power)) ? explode("^^", $power) : "" ;
           if (count($name)==count($link) && count($name)==count($icon) ) {
            
            $urkmult =array();
            $sumv = array();

            for ($i=1; $i <= count($name)-1; $i++) {
                $k = $i;

                $linka = explode("...", $link[$i]);
                if (!empty($link)) {
                  if (count($linka) == 2) {
                    $urlka = hdev_url::menu(trim($linka[0]).'/'.trim($linka[1]));
                    hdev_route::access('/', false, false, false, $urlka);
                    $rasms_stc = new hdev_url_service('',trim(hdev_route::get_active2()));
                    if ($rasms_stc->access()) {
                      array_push($sumv, "y"); 
                      if ($urlk == $urlka) {
                        array_push($urkmult, "y");
                      }
                    }

                  }
                }      
              }
          if (in_array("y", $sumv)) {
              if (in_array("y", $urkmult)) {
                $view = '<li class="nav-item has-treeview menu-open"'.$gen_id1.'>
                        <a href="#" class="ind nav-link active"'.$gen_id2.'  data-bs-target="#'.$fm_linker.'" data-bs-toggle="collapse">';
              }else{
                $view = '<li class="nav-item"'.$gen_id1.'>
                         <a href="#" class="ind nav-link"'.$gen_id2.' data-bs-target="#'.$fm_linker.'" data-bs-toggle="collapse">';
              }

            $view .='
                <i class="';
            $view .= trim($icon[0]);
            $view .='"></i> 
                <span>';
            $view.=self::hdevstr(trim($name[0]));
            $view.='
                </span><i class="bi bi-chevron-down ms-auto"></i>
              </a>';
              if (in_array("y", $urkmult)) {
                //active
                $prec ='<ul id="'.$fm_linker.'" class="nav-content collapse show" data-bs-parent="#sidebar-nav">'; 
              }else{
                //not active
                $prec = '<ul id="'.$fm_linker.'" class="nav-content collapse" data-bs-parent="#sidebar-nav">';
              }
              $view .=$prec;
              for ($i=1; $i <= count($name)-1; $i++) {
                $linka = explode("...", $link[$i]);
                $nam = $name[$i];

                $pk = (isset($power[$i]) && !empty($power[$i])) ? ' rel="'.trim($power[$i]).'" ' : "" ;
                $error = "";
                if (is_array($linka) && count($linka) == 2) {
                  $urlka = hdev_url::menu(trim($linka[0]).'/'.trim($linka[1]));
                }elseif (is_array($linka) && count($linka) == 1) {
                  $urlka = hdev_url::menu(trim($linka[0]));
                }else{
                  $urlka = hdev_url::menu('');
                }

                hdev_route::access('/', false, false, false, $urlka);
                //var_dump(hdev_route::get_active2());exit();
                $rasms_stc = new hdev_url_service('',trim(hdev_route::get_active2()));
                if ($rasms_stc->access()) {
                  $view.='<li class="nav-item">'; 
                  if ($urlk == $urlka) {
                    $preff = "";
                    if (constant("APP_MASK") != "") {
                        $preff = " -- " .constant("APP_MASK");
                      }
                    $view .='<a href="'.$urlka.'" class="active liftk "'.$pk.$gen_id.'title="'.'APP'.' - ' .self::hdevstr(trim($name[$i])).$preff.'">';
                  }else{
                    $preff = "";
                    if (constant("APP_MASK") != "") {
                        $preff = " -- " .constant("APP_MASK");
                      }
                    $view .='<a href="'.$urlka.'" class="liftk "'.$pk.$gen_id.'title="'.'APP'.' - ' .self::hdevstr(trim($name[$i])).$preff.'">';
                    //var_dump(self::hdevstr($name[$i]));exit();
                    //$view .='<a href="'.$urlka.'" class="nav-link liftk '.$pk[$i].'" title="'.APP_NAME.'---' .$name[$i].'">';
                  }
                }else{
                  $error = "no";
                }
                if ($error == "") {
                  $view.='<i class=" '.trim($icon[$i]).'"></i>';
                  $view.='<span>'.self::hdevstr(trim($name[$i])).'</span>';
                  $view.='</a></li>'; 
                }    
                    
              }
            $view.='
                    </ul>
                  </li>';
            }
           }
          echo $view;
         }
       }
    }
    
 ?>