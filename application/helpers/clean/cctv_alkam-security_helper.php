<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


function html_individual_clean_before( $html ){        
    return $html;
}

function html_individual_clean_after( $html ){
    
    $ci =& get_instance();
    $ci->load->library('clean_lib');
    $ci->load->helper('simple_html_dom');

    $html = preg_replace("#<iframe src=.http://www.facebook.com[\s\S]*?</iframe>#i", "\n", $html);
    
    $html = $ci->clean_lib->js_dlete( $html, 'redcart.pl' ); 
    $html = $ci->clean_lib->js_dlete( $html, 'plusone.js' );
    $html = $ci->clean_lib->js_dlete( $html, 'livechatinc.net' );
    $html = $ci->clean_lib->js_dlete( $html, 'doubleclick.net' );
    $html = $ci->clean_lib->js_dlete( $html, 'google.translate' );
    $html = $ci->clean_lib->js_dlete( $html, 'translate.google.com' );
    $html = $ci->clean_lib->js_dlete( $html, '/ajax/info/squeeze/' );
    $html = $ci->clean_lib->js_dlete( $html, 'add_cart_event' );
    $html = $ci->clean_lib->js_dlete( $html, '/ajax/info/top_info/' );
    
    
    
    $html_obj = str_get_html($html);
    
    //уменьшение объема главной страницы
    $html_obj->find('.m_start_table',3)->outertext = "";
    $html_obj->find('.m_start_table',4)->outertext = "";     
    $html_obj->find('.m_start_table',5)->outertext = "";
    $html_obj->find('.m_start_table',6)->outertext = "";
    $html_obj->find('.m_start_table',7)->outertext = "";
    $html_obj->find('.m_start_table',8)->outertext = ""; 
    $html_obj->find('.m_start_table',9)->outertext = "";
    $html_obj->find('#column_right',0)->outertext = "";
    // /уменьшение объема главной страницы
    
    $html_obj->find('.bannery_monitoring',0)->outertext = "";
    $html_obj->find('#widget_shop4',0)->outertext = "";
    $html_obj->find('#header_main',0)->outertext = "";
    $html_obj->find('#footer',0)->outertext = "";
    $html_obj->find('#widget_shop5',0)->outertext = "";
    $html_obj->find('#header_main_2',0)->outertext = "";
    $html_obj->find('#widget_shop6',0)->outertext = "";
    $html_obj->find('body',0)->style = "background-image:none; background-color:#e5e5e5;";
    
    $html_obj->find('.box_body_fun_left',0)->innertext = "\n\n<!--#cctv-links-->\n\n";
    
    $html_obj->find('body',0)->innertext = '<style>.box_table_list_left{ background: url("box_header_list_left.png") }</style>'.$html_obj->find('body',0)->innertext;
    $html = $html_obj->save();

    
    return $html;
}