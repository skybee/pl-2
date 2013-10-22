<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


function html_individual_clean_before( $html ){        
    return $html;
}

function html_individual_clean_after( $html ){
    
    $ci =& get_instance();
    $ci->load->library('clean_lib');
    $ci->load->helper('simple_html_dom');

    
    $html = $ci->clean_lib->js_dlete( $html, 'conversion.js' ); 
    $html = $ci->clean_lib->js_dlete( $html, 'connect.facebook.net' ); 
    
    
    $html_obj = str_get_html($html);
    $html_obj->find('body',0)->style = 'background-color: #f8f8f8';//
    $html_obj->find('#header',0)->style = 'height: auto;';
    $html_obj->find('#cookiesAccepted',0)->outertext = '';
    $html_obj->find('.hconf',0)->outertext = '';
    $html_obj->find('.heac',0)->outertext = '';
    $html_obj->find('#search_block',0)->outertext = '';
    $html_obj->find('#rightbtt_block',0)->outertext = '';
    $html_obj->find('#yt_block',0)->outertext = '';
    $html_obj->find('.lblock',0)->outertext = '';
    $html_obj->find('.lblock',1)->outertext = '';
    $html_obj->find('#prawy_fb',0)->outertext = '';
    $html_obj->find('#prawy_kontakt',0)->outertext = '';
    $html_obj->find('#left',0)->innertext = $html_obj->find('#left',0)->innertext."\n\n<!--#cctv-links-->\n\n";
    $html = $html_obj->save();

    
    return $html;
}