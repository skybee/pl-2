<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class file_load_lib {

    function __construct() {
//        $this->CI = & get_instance();
//        $this->CI->load->library('download_lib');
    }

    function get_file_name($uri) {
        $uri = trim($uri);
        $pattern = "#[\d-_a-zA-Z%\+\(\)\?\&\.]+\.[a-z]{2,4}$#i";
        preg_match($pattern, $uri, $fname_ar);

        if (isset($fname_ar[0]) && !empty($fname_ar[0]))
            return $fname_ar[0];
        else
            return FALSE;
    }

    function load_file($uri) {
        
    }

    function get_file_type($fname) {
        $pattern = "#\.(\S{2,4})$#i";

        preg_match($pattern, $fname, $ftype_ar);
        
        if ( !isset($ftype_ar[1]) )
            return FALSE;

        $ftype = $ftype_ar[1];
        
        switch ($ftype) {
            case 'jpg':     $content_type = 'image/jpeg';
                break;
            case 'jpeg':    $content_type = 'image/jpeg';
                break;
            case 'png':     $content_type = 'image/png';
                break;
            case 'gif':     $content_type = 'image/gif';
                break;
            case 'ico':     $content_type = 'image/x-icon';
                break;
            case 'css':     $content_type = 'text/css';
                break;
            case 'js':      $content_type = 'application/x-javascript';
                break;
            case 'swf':     $content_type = 'application/x-shockwave-flash';
                break;
            case 'txt':     $content_type = 'text/plain';
                break;
            default:        $content_type = 'text/html';
                break;
        }
        
        return $content_type;
    }

}