<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class download_lib {

    function __construct() {
        $this->CI =& get_instance();
        $this->CI->config->load('parse');
    }
    
    function down_with_curl($url) {
//        echo $url;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; WOW64; Trident/6.0)');
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        
        $content    = curl_exec($ch);
        $http_code  = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if($http_code >= 404 ){ show_404( 'Load error. Code>=404 - '.$url); exit(); }

        return $content;
    }
    
    function read_location( $url ){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; WOW64; Trident/6.0)');
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_NOBODY, 1);

        $content = curl_exec($ch);
        curl_close($ch);
        
        //<поиск location>//
        $pattern = "#\n(Location:.*?)\n#i";
        preg_match($pattern, $content, $location_ar);
        
        if( isset($location_ar[1]) )
            return $location_ar[1];
        else
            return false;
        //</поиск location>//
    }
    
    function lock_uri( $url ){ //принимает url, возвращает true в случае нахождения заблокированного uri
        $lock_array     = $this->CI->config->item('lock_uri');
        $donor_domain   = $this->CI->config->item('donor_domain');
        
        if( count($lock_array) < 1 ) return FALSE;
        
        foreach( $lock_array as $lock_uri ){
            if( empty($lock_uri) )  continue;
            $search = $donor_domain.$lock_uri;
            
            if( stripos($url, $search) !== false )
                return TRUE;        
        }
        
        return FALSE;
    }
    
}