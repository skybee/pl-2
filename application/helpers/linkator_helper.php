<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function get_google_query( $url_str ){
    $result = parse_url($url_str);
    parse_str($result['query'], $params);
    
    $query = urldecode( $params['q'] );
    
    return $query;
}