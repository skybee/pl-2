<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


function html_individual_clean_before( $html ){        
    return $html;
}

function html_individual_clean_after( $html ){
    
    $ci =& get_instance();
    $ci->load->library('clean_lib');
    $ci->load->helper('simple_html_dom');
    
    $html = $ci->clean_lib->js_dlete( $html, 'gemius' );
    $html = $ci->clean_lib->js_dlete( $html, 'cookie_info.js' );
    $html = $ci->clean_lib->js_dlete( $html, 'connect.facebook.net' );
    $html = $ci->clean_lib->js_dlete( $html, 'bbelements.com' );
    $html = $ci->clean_lib->js_dlete( $html, 'pianomedia' );
    $html = $ci->clean_lib->js_dlete( $html, 'tuznajdziesz.pl' );
    $html = $ci->clean_lib->js_dlete( $html, 'ocena' );
    $html = $ci->clean_lib->js_dlete( $html, 'oceny' );
    $html = $ci->clean_lib->js_dlete( $html, 'sonda' );
    $html = $ci->clean_lib->js_dlete( $html, 'losowy-produkt' );
    $html = $ci->clean_lib->js_dlete( $html, 'twitter' );
    $html = $ci->clean_lib->js_dlete( $html, 'plusone.js' );
    $html = $ci->clean_lib->js_dlete( $html, 'achtak.pl' );
    $html = $ci->clean_lib->js_dlete( $html, 'pinterest.com' );        
    
    $style  = $ci->load->view('style/urzadzamy_v','',TRUE);
    $html   = str_ireplace('</head>', $style.' </head>', $html);
    $html   = str_ireplace('lang="pl-PL"', '', $html);
    
    $html_obj = str_get_html($html);
    $html_obj->find('.polecaneItem',2)->outertext = ''; //сайты друзья
    $html_obj->find('.prawaAutorskie',0)->outertext = ''; //копирайт
    $html_obj->find('.gaztz',0)->outertext = ''; //печатные журналы
    $html_obj->find('.top_menu',0)->innertext = ''; //шапка с поиском
    $html_obj->find('.ads',0)->innertext = '<!--#top_ads-->'; //верхний рекламный блок
    $html_obj->find('.right_column',0)->innertext = '<div><!--#right_ads--></div>'.$html_obj->find('.right_column',0)->innertext; //правый блок рекламы
    $html_obj->find('.twitter',0)->outertext = ''; //twitter
    
    $html = $html_obj->save();
    
    return $html;
}