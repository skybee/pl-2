<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


function html_individual_clean_before( $html ){        
    return $html;
}

function html_individual_clean_after( $html ){
    
    $ci =& get_instance();
//    $ci->load->library('clean_lib');
    $ci->load->helper('simple_html_dom');

    $html = preg_replace("#src=\"http://(www|status).gadu-gadu.pl/[\s\S]+?\"#i", '', $html);
    
    $html_obj = str_get_html($html);
    $html_obj->find('.glowna',0)->outertext = '';
    $html_obj->find('#przybornik',0)->outertext = '';
    $html_obj->find('#box-search',0)->outertext = '';
    $html_obj->find('#product-top',0)->outertext = '';
    $html_obj->find('#header',0)->style = "background-image: none; height: auto; ";
    $html_obj->find('#menus',0)->style = "background: #00a; height: 35px; margin: 0; padding-left: 20px; width: 100%; ";
    $html_obj->find('#pasek_menu',0)->style = "margin:0; padding:0; ";
    $html_obj->find('body',0)->style = "background-image: none;";
    $html_obj->find('#page',0)->style = "border: 4px solid #00a;";
    $html_obj->find('#stopka',0)->outertext = '';
    $html_obj->find('#footer',0)->outertext = '';
    $html_obj->find('.box-left-content',0)->outertext = '';
    $html_obj->find('.box-left-content',1)->outertext = '';
    
    for($i=0; true; $i++){
        if( is_object( $html_obj->find('.header', $i) ) )
            $html_obj->find('.header', $i)->style = "background-image: none; background: #5c98f8;";
        else
            break;
    }
    
    for($i=0; true; $i++){
        if( is_object( $html_obj->find('.categories h2', $i) ) )
            $html_obj->find('.categories h2', $i)->style = "background-image: none; background: #5c98f8;";
        else
            break;
    }
    
    $html_obj->find('.container-right',0)->innertext = $html_obj->find('.container-right',0)->innertext."\n\n<!--#cctv-links-->\n\n";
    $html = $html_obj->save();

    
    return $html;
}