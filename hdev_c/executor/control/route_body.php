<?php 
	/**
	 * routing assisstant
	 */
	class hdev_menu_url
	{
		public static function body($value)
		{
			$_SESSION['act_url'] = array();
			$_SESSION['act_url'] = $value;
		}
		public static function url_req($url,$user)
		{
			if (!empty($url) && !empty($user)) {
				return "y";
			}
		}
    public static function body_nd($val)
    {
      $_SESSION['nd_url'] = array();
      $_SESSION['nd_url'] = $val;
    }
	}
 ?>