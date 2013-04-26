<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


function html_individual_clean_before( $html ){        
    return $html;
}

function html_individual_clean_after( $html ){
    
    $ci =& get_instance();
//    $ci->load->library('clean_lib');
    $ci->load->helper('simple_html_dom');
    
    
    $html_obj = str_get_html($html);
    $html_obj->find('#cleft',0)->innertext = $html_obj->find('#cleft',0)->innertext."\n\n<!--#cctv-links-->\n\n";
    $html = $html_obj->save();

    
    return $html;
}