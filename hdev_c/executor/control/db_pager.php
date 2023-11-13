<?php 
	  /**
   * limiting sql results
   */
  class hdev_pager 
  {
    
    private static $limit = null;
    private static $curr_page = null;
    private static $rows_ret = null;
    private static $url = null;
    function __construct($ref_url="")
    {
      self::$url = hdev_url::menu($ref_url);
    }
    public static function reset()
    {
      self::$limit = "";
    }
    public static function set($page='',$rows='')
    {
      self::$curr_page = (is_numeric($page)) ? $page : 1 ;//curent page
      self::$rows_ret = $rows;//all rows
      $start = $page;
      $end = $rows;
      if ($start == 0 || $start == 1 || empty($start) || !is_numeric($start)) {
        $start = 0;
      }
      if (isset($end) && is_numeric($end) && !empty($end) && $end != 0) {
        $init = ($end*$start)-$end;
        if ($start == 0) {
          $init = 0;
        }
        self::$limit = " LIMIT ".$init.",".$end;
      }else{
        self::$limit = "";
      }
    }
    public static function limit($ref='get')
    {
      return self::$limit;
    }
    public static function page()
    {
      return self::$curr_page;
    }
    public static function rows()
    {
      return self::$rows_ret;
    }
    public static function page_row($max=0,$r_name="Records")
    {
      $return = '
        <div class="border-top border-left border-right border-bottom p-1">
          <div class="row">
      ';
      $btnv = ceil($max/self::rows());
      if ($btnv != 0) {
        $return .= '
          <div class="col-sm-2">
            <span class="btn btn-secondary">Page '.self::page()." in ".$btnv.' pages</span>
            </div>';
        $return .= '
          <div class="col-sm-8" align="center">
          <div class="btn-group iii_menu">';
        $pg = self::page();
        $prev = $pg-1;
        $next = $pg+1;
        if ($pg != 1) {
          $return .= '
            <button type="button" rel="external" url="'.self::$url.'" page="1" class="btn btn-sm btn-success pager_control"><i class="fa fa-angle-double-left"></i></button>
          ';
        }
        if ($prev > 0) {
          $return .= '
            <button type="button" rel="external" url="'.self::$url.'" page="'.$prev.'" class="btn btn-sm btn-success pager_control"><i class="fa fa-angle-left"></i></button>
          ';
        }
        for ($i=1; $i <= $btnv; $i++) { 
          $gg = ($i==$pg) ? "btn-primary " : "btn-secondary" ;
          $ic = ($i==$pg) ? "fa fa-file" : "fa fa-file-alt" ;
          $tg = $i-$pg;
          if ($tg > 3 || $tg < -3) {
          }else{
            $return .= '
              <button type="button" rel="external" url="'.self::$url.'" page="'.$i.'" class="btn btn-sm pager_control '.$gg.'"><b><i class="'./*$ic*/"".'">'.$i.'</i></b></button>
              ';
          }
        }
        if ($next <= $btnv) {
          $return .= '
            <button type="button" rel="external" url="'.self::$url.'" page="'.$next.'" class="btn btn-sm btn-success pager_control"><i class="fa fa-angle-right"></i></button>
          ';
        }
        if ($pg != $btnv) {
          $return .= '
            <button type="button" rel="external" url="'.self::$url.'" page="'.$btnv.'" class="btn btn-sm btn-success pager_control"><i class="fa fa-angle-double-right"></i></button>
          ';
        }
        $return .= '
            </div>
          </div>
          <div class="col-sm-2">
        ';
        if ($pg != $btnv) {
          $ptt = $pg*self::rows();
          $return .= "Showing ".$ptt." ".$r_name.", <br>In ".$max." ".$r_name.".";
        }elseif ($pg == $btnv) {
          $return .= "Showing ".$max." ".$r_name.", <br>In ".$max." ".$r_name." .";
        }
        $return .= '
          </div>
        ';
      }else{
        $return .= '
          <div class="col-sm-12">
            --
          </div>
        ';
      }
      $return .= '
        </div>
      </div>
      <hr/>
      ';
      echo $return;
    }
  }

 ?>