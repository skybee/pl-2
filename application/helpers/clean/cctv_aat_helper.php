<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


function html_individual_clean_before( $html ){        
    return $html;
}

function html_individual_clean_after( $html ){
    
    $ci =& get_instance();
//    $ci->load->library('clean_lib');
    $ci->load->helper('simple_html_dom');
    
    
    $html_obj = str_get_html($html);
    $html_obj->find('.menu',1)->innertext = $html_obj->find('.menu',1)->innertext."<li class=\"collapsed\"> \n\n<!--#cctv-links-->\n\n </li>";
    $html = $html_obj->save();

    
    return $html;
}