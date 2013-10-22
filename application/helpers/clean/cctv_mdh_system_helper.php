<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


function html_individual_clean_before( $html ){        
    return $html;
}

function html_individual_clean_after( $html ){
    
    $ci =& get_instance();
    $ci->load->library('clean_lib');
    $ci->load->helper('simple_html_dom');

    
    $html = $ci->clean_lib->js_dlete( $html, 'eraty.pl' ); 
    $html = $ci->clean_lib->js_dlete( $html, 'cookie.js' );
    
    $html = preg_replace("#([> ])MDH[- ]{1,3}SYSTEM([< ])#i", "$1DVR-CCTV$2", $html);
    
//    $html = $ci->clean_lib->js_dlete( $html, 'connect.facebook.net' ); 
    
    
    $html_obj = str_get_html($html);
    $html_obj->find('.ggSkype',0)->innertext = '<style type="text/css"> #cookieBox{display: none !important; } </style>';
    $html_obj->find('.sliderBox',0)->outertext = '';
    $html_obj->find('.bn_1',0)->outertext = '';
    $html_obj->find('.bn_2_3',0)->outertext = '';
    $html_obj->find('#producentsLogo',0)->outertext = '';
    $html_obj->find('#search',0)->outertext = '';
    $html_obj->find('#footerBg',0)->outertext = '';
    $html_obj->find('body',0)->style = 'background: #fff;';
    $html_obj->find('.topBg',0)->style = 'background: #fff;';
    $html_obj->find('#menuSearch',0)->style = 'background: #1b66ad;';
    $html_obj->find('#banerBox',0)->style = 'border: 3px solid #1b66ad;';
    $html_obj->find('#content',0)->style = 'border: 3px solid #1b66ad;';
    $html_obj->find('#top',0)->outertext = '';
    $html_obj->find('#pod',0)->outertext = '';
    $html_obj->find('#promotions',0)->outertext = '';
    $html_obj->find('#kamera',0)->outertext = '';
    
    for($i=0; true; $i++){
        if( is_object( $html_obj->find('#categories li', $i) ) )
            $html_obj->find('#categories li', $i)->style = "background: #1b66ad;";
        else
            break;
    }
    
    for($i=0; true; $i++){
        if( is_object( $html_obj->find('.extraBox', $i) ) )
            $html_obj->find('.extraBox', $i)->outertext = '';
        else
            break;
    }
    
    $html_obj->find('#rightCol',0)->innertext = $html_obj->find('#rightCol',0)->innertext."\n\n<!--#cctv-links-->\n\n";
    $html = $html_obj->save();

    
    return $html;
}