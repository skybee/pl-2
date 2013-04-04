<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class subdomain_lib{
    
    function set_site_domain( $site_domain ){
        $this->site_domain = $site_domain;
    }
    
    function set_donor_domain( $donor_domain ){
        $this->donor_domain = $donor_domain;
    }
    
    function subd_to_uri( $data ){ //перенос субдомена в URI
        $pattern = "#http://([\S]+)\.".$this->site_domain."([\S]*?)#i";
        $replace = "http://".$this->site_domain."/subd-$1$2";
        
        $data = preg_replace($pattern, $replace, $data);
        
        return $data;
    }
    
    function subd_to_uri_for_cssjs( $data ){ //перенос субдомена в URI
        $pattern = "#http://([\S]+)\.".$this->site_domain."([\S]*?)#i";
        $replace = "http://".$this->site_domain."/subd-$1$2";
        
        $data = preg_replace($pattern, $replace, $data);
        
        return $data;
    }
    
    function get_donor_url( $uri ){ //преобразование субдомена из uri ( donor.ru/subdomain/* => subdomain.donor.ru/* )
        $url = 'http://'.$this->donor_domain.$uri;
        
        if( stripos($url, '/subd-') !== FALSE ){
            $pattern    = "#http://".$this->donor_domain."/subd-([a-z-_\.]*)([\s\S]*)#i";
            $replace    = "http://$1.".str_ireplace('www.', '', $this->donor_domain)."$2";
            
            $url = preg_replace($pattern, $replace, $url);
        }
        
        $url = str_ireplace($this->site_domain, $this->donor_domain, $url);
        
        return $url;
    }
    
    function cssjs_encode( $data ){
        $pattern = "#['\"]((http://".$this->site_domain."/)([\S]*?)\.(css|js))['\"]#i";
        
        preg_match_all($pattern, $data, $url_ar);
        
        $search_ar = array(); $replace_ar = array();
        
        $cnt_url = count( $url_ar[1] );
        
        for($i=0; $i<$cnt_url; $i++){
            $search_ar[]    = $url_ar[1][$i];
            $replace_ar[]   = $url_ar[2][$i].$this->sh_encode($url_ar[3][$i]).'.'.$url_ar[4][$i];
        }
        
        if( count($search_ar) > 0 )
            $data = str_ireplace($search_ar, $replace_ar, $data);
        
        return $data;
    }
    
    function sh_encode( $str ){
        return str_replace('/', '-sh-', $str);
    }
    
    function sh_decode( $str ){
        return str_replace('-sh-', '/', $str);
    }
}