<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


function get_city_link( $rand_str, $file = 'city_link.txt' ){
    $link_ar = file( 'files/'.$file );
    
    srand( abs( crc32($rand_str) ) );
    shuffle($link_ar);
    srand();
    
    return $link_ar[0];
}
