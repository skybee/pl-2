<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


function html_individual_clean_before( $html ){        
    return $html;
}

function html_individual_clean_after( $html ){
    
    $ci =& get_instance();
//    $ci->load->library('clean_lib');
    $ci->load->helper('simple_html_dom');
    
    $html = preg_replace("#AAT[\s]+Holding#i", 'CCTV Dahua', $html);
    
    
    $html_obj = str_get_html($html);
    $html_obj->find('.menu',1)->innertext = $html_obj->find('.menu',1)->innertext."<li class=\"collapsed\"> \n\n<!--#cctv-links-->\n\n </li>";
    $html_obj->find('#divisions',0)->innertext = '';
    $html_obj->find('#footer',0)->innertext = '';
    $html_obj->find('.banersRotator',0)->outertext = '';
    $html_obj->find('#head',0)->style = 'display: none;';
    $html_obj->find('#main',0)->style = 'background-position: 0px 0px;';
    $html_obj->find('#side',0)->style = 'opacity: 1; background-color: #5C98F8;';
    $html_obj->find('#wrapper1',0)->style = 'background-color: #2E4C7C; border: 20px solid #2E4C7C';
    $html = $html_obj->save();

    
    return $html;
}