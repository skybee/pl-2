<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


function get_country(){
    include("application/helpers/geoip/files/geoip.inc");
    
    $gi = geoip_open("application/helpers/geoip/files/GeoIP.dat",GEOIP_STANDARD);
    
    $country_code = geoip_country_code_by_addr($gi, $_SERVER['REMOTE_ADDR']);
    geoip_close($gi);
    
    return $country_code;
}
