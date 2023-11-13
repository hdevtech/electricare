<?php 

    /** get current urls 
      * include plugins linkage
      */
     class hdev_url
     {
    public static function img($url)
    {
        /*$urlParts = pathinfo($url);
        $extension = $urlParts['extension'];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $base64 = 'data:image/' . $extension . ';base64,' . base64_encode($response);
        return $base64;*/
        return $url;

    }
    public static function get_mime_type($filename='')
    {
        $idx = explode( '.', $filename );
        $count_explode = count($idx);
        $idx = strtolower($idx[$count_explode-1]);

        $mimet = array(
            'txt' => 'text/plain',
            'text' => 'text/plain',
            'htm' => 'text/html',
            'html' => 'text/html',
            'php' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',

            // images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',

            // archives
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'exe' => 'application/x-msdownload',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',

            // audio/video
            'mp3' => 'audio/mpeg',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',

            // adobe
            'pdf' => 'application/pdf',
            'psd' => 'image/vnd.adobe.photoshop',
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript',

            // ms office
            'doc' => 'application/msword',
            'rtf' => 'application/rtf',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',
            'docx' => 'application/msword',
            'xlsx' => 'application/vnd.ms-excel',
            'pptx' => 'application/vnd.ms-powerpoint',


            // open office
            'odt' => 'application/vnd.oasis.opendocument.text',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        );

        if (isset( $mimet[$idx] )) {
            return $mimet[$idx];
        } else {
            return 'application/octet-stream';
        }
    }
    public static function download($link='',$log='')
    {
    $file_to_download = $link;
    if (!file_exists($file_to_download)) {
      exit("The file requested to download does not exist in our servers<br>"/*.$file_to_download*/);
    }
    $idx = explode( '.', $file_to_download);
    $count_explode = count($idx);
    $idx = strtolower($idx[$count_explode-1]);

    $fnm = explode( '/', $file_to_download);
    $count_explodee = count($fnm);
    $fnm = $fnm[$count_explodee-1];
    // Download the file
    header('Content-Description: File Transfer');
    header('Content-Type:'.hdev_url::get_mime_type($file_to_download));
    header('Content-Length: ' . filesize($file_to_download));
    if (!empty($log) && $log != '') {
      hdev_log::out();
    }
    header('Content-Disposition: attachment; filename='.$fnm);
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    flush();
    readfile($file_to_download);
    exec('rm ' . $file_to_download);
    exit; 
    }
        public static function prot()
        {
            $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            return $protocol;
        }
        public static function get_url_host()
        {
            $protocol = self::prot();
            $url_host = $protocol . $_SERVER['HTTP_HOST'];
            return $url_host;
        }
        public static function get_url_min()
        {
            $url_query = $_SERVER['QUERY_STRING'];
            return "?".$url_query;
        }
        public static function get_url_full()
        {
            $protocol = $protocol = self::prot();
            $url_full = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            return $url_full;
        }
    public static function get_url_part()
    {
      $url_all = self::get_url_full();
      $mini = self::get_url_min();
      $ret = str_ireplace($mini, "", $url_all);
      return rtrim(ltrim($ret,"/"),"/");
    }
    public static function without_get()
    {
      $full = self::get_url_full();
      $min = self::get_url_min();
      $ret = str_ireplace($min, "", $full);
      return $ret;
    }
        public static function menu($link)
        {
            $ref = self::get_url_host();
            $fer = $ref.constant('base_path').$link;
            return $fer;
        }
    public static function next($value)
    {
      $ref = urlencode($value);
      return $ref;
    }
    public static function activate($value)
    {
      $ref = urldecode($value);
      return $ref;
    }
     }

 ?>