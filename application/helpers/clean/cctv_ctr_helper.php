<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


function html_individual_clean_before( $html ){        
    return $html;
}

function html_individual_clean_after( $html ){
    
    $ci =& get_instance();
//    $ci->load->library('clean_lib');
    $ci->load->helper('simple_html_dom');
    
    
    $html_obj = str_get_html($html);
    
    for($i=0; true; $i++){
        if( is_object( $html_obj->find('.baner_right', $i) ) )
            $html_obj->find('.baner_right', $i)->outertext = '';
        else
            break;
    }
    
    $html_obj->find('#baner',0)->outertext = '';
    $html_obj->find('#topmenu',0)->outertext = '';
    $html_obj->find('#box_koszyk',0)->outertext = '';
    $html_obj->find('.foot_txt',0)->outertext = '';
    $html_obj->find('#cleft',0)->innertext = $html_obj->find('#cleft',0)->innertext."\n\n<!--#cctv-links-->\n\n";
    $html_obj->find('body',0)->innertext = '<style>#cleft h2{background-color:#3000E5;} #right{ background-color: #f3f3f3} </style>'.$html_obj->find('body',0);
    $html = $html_obj->save();

    
    return $html;
}