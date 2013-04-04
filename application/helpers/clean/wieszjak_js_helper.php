<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function clean_js( $js ){
    
    $js = str_ireplace( 'advertway.', '', $js);
    $js = str_ireplace( 'api.pl', '111', $js);
    
    return $js;
}