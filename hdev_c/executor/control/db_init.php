<?php 
	/**
	 * db execution
	 */
	class hdev_db
	{
		public $conn = "";
		function table($pref)
    {
      $table = array(
        "all_users"=>"auth_engine",
              "main_auths" => "admin",
              "driver"=>"drivers",
              "appoitment"=>"appoitments",
              "owner"=>"owners",
              "service"=>"services",
              "fault"=>"faults",
              "service_request"=>"service_request",
              "fault_report"=>"faults_report",
            );
      return $table[$pref];
    }
    function auth_tbl($pref="")
    {
      $pref = (!empty($pref) && $pref != "") ? $pref : hdev_log::fid();
      $table = array(
              "admin"=>self::table("main_auths"),
              "main_admin"=>self::table("main_auths"),
            );
      return $table[$pref];
    }  
    function auth_col($pref="")
    {
      $pref = (!empty($pref) && $pref != "") ? $pref : hdev_log::fid();
      $table = array(
              "admin"=>"a_id",
              "service"=>"s_id"
            );
      return $table[$pref];
    }  
    function __construct($connn='pdo')
    {
      if ($connn == "pdo") {
        $servername = "localhost";
        $username = 'rustuser'; 
        $password = 'rustuserpass';
        $dbname = db;
        $port = dbport;


        /////og  config
        $servername = "localhost";
        $username = dbusr;
        $password = dbpass;
        $port = dbport;
          try{
          //$this->conn = new PDO("mysql:host='23.229.233.105';dbname='db_ikwim'; charset=utf8", $username, $password);
          $this->conn = new PDO("mysql:host=$servername; dbname=$dbname;charset=utf8;port=$port", $username, $password);
          }
          catch(PDOException $ex){
            $this->conn = "error";
          }
      }
    }
    public function connection_check()
    {
      $cnn = $this->conn;
      if ($cnn == "error") {
        return false;
      }else{
        return true;
      }
    }
    public function last_id()
    {
      $con = $this->conn;
      $last_id = $con->lastInsertId();
      return $last_id;
    }
    public static function create_db($db='')
    {
      $retur = false;
      if (!empty($db)) {
        $servername = "localhost";
        $username = dbusr;
        $password = dbpass;
        $port = dbport;
        $conn = new PDO("mysql:host=$servername; charset=utf8;port=$port", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE IF NOT EXISTS ".$db;
        $sanitise = explode(";", $sql);
        $query = "";
        if (isset($sanitise[0])) {
          $qq = explode(" ", $sql);
          if (isset($qq[0]) && $qq[0] == "CREATE" && isset($qq[1]) && $qq[1] == "DATABASE" ) {
            $query = $sanitise['0'];
          }
        }
        // use exec() because no results are returned
        //var_dump($query);exit();
        if ($conn->exec($query)) {
          $retur = true;
        }
      }
      return $retur;
    }
    function connect()
    {
      $conn = $this->conn;
      if(is_null($conn) || $conn===FALSE)
      {
          die('Rasms Internal error');
      }
      return $this->conn;
    }
		function select($query = "SELECT 1=1",$params = null)
		{
      //var_dump($query);
			try {
          if (is_string($this->conn)) {
                echo "<div style='width: 50%;margin-left:15%;margin-top:5%;'><fieldset>DATA STORE CHECKER<hr>Re-start the application to get this fixed <br> Or click <a href='".hdev_url::menu("")."'>Here</a><hr>&copy".date("Y")."- ".APP_PROGRAMMER['name']." - ".APP_NAME."<hr></fieldset><div>";
              echo '<meta content="2; '.hdev_url::menu("").'" http-equiv="refresh" />'; exit();
          }
			    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			    $stmt = $this->conn->prepare($query);
			    if (is_array($params) && count($params) > 0) {
			     	foreach ($params as $pd) {
			     		if (!empty($pd)) {
			     			$regpd = $pd;
			     			if (is_array($regpd) && count($regpd)==2) {
			     				$stmt->bindParam($regpd[0], $regpd[1]);
			     			}
			     		}
			     	}
			     }
			    $stmt->execute();
			    $stmt->setFetchMode(PDO::FETCH_ASSOC);
			    $res = $stmt->fetchAll(); 
			}
			catch(PDOException $e) {
				$res = array("Error: ",$e->getMessage());
			}
			return $res;
			$conn = null;
		}
    function insert($query,$params= null)
    {
      try {
        if (is_string($this->conn)) {
            echo "<div style='width: 50%;margin-left:15%;margin-top:5%;'><fieldset>DATA STORE CHECKER<hr>Re-start the application to get this fixed <br> Or click <a href='".hdev_url::menu("")."'>Here</a><hr>&copy".date("Y")."- ".APP_PROGRAMMER['name']." - ".APP_NAME."<hr></fieldset><div>";
              echo '<meta content="2; '.hdev_url::menu("").'" http-equiv="refresh" />'; exit();
          }

          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $this->conn->prepare($query);
          if (is_array($params) && count($params) > 0) {
            foreach ($params as $pd) {
              if (!empty($pd)) {
                $regpd = $pd;
                if (is_array($regpd) && count($regpd)==2) {
                  $stmt->bindParam($regpd[0], $regpd[1]);
                }
              }
            }
           }
          $stmt->execute();
          $rett = "ok";
          }
      catch(PDOException $e)
          {
          echo "error".$e->getMessage();
          $rett = "no";
          }
      return $rett;
      $conn = null;
    }
    function exec($query="")
    {
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
      $ret = "no";
      if ($this->conn->exec($query)) {
        $ret = "ok";
      }
      return $ret;
    }

	}


 ?>