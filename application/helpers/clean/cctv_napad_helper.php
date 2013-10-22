<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


function html_individual_clean_before( $html ){        
    return $html;
}

function html_individual_clean_after( $html ){
    
    $ci =& get_instance();
    $ci->load->library('clean_lib');
    $ci->load->helper('simple_html_dom');
    
    $html = $ci->clean_lib->js_dlete( $html, 'google.translate' );
    $html = $ci->clean_lib->js_dlete( $html, 'translate.google.com' );
    $html = $ci->clean_lib->js_dlete( $html, 'apis.google.com' ); 
    $html = $ci->clean_lib->js_dlete( $html, 'facebook.com' );  
    $html = $ci->clean_lib->js_dlete( $html, '/assets/' );
    
    $html = preg_replace("#<iframe[\s\S]+?</iframe>#i", '<!--<iframe>-->', $html);
    
    $html_obj = str_get_html($html);
    $html_obj->find('#languages',0)->outertext = '';
    $html_obj->find('#social-media',0)->outertext = '';
    $html_obj->find('#pp-cookies-container',0)->outertext = '';
    $html_obj->find('#basketSave',0)->outertext = '';
    $html_obj->find('#preHeader',0)->outertext = '';
    $html_obj->find('#bar',0)->outertext = '';
    $html_obj->find('#mainRotator',0)->outertext = '';
    $html_obj->find('#footer',0)->outertext = '';
    $html_obj->find('#searchBox',0)->outertext = '';
    $html_obj->find('#phone',0)->outertext = '';
    $html_obj->find('#footerRotator',0)->outertext = '';
    $html_obj->find('.relCompany',0)->outertext = '';
    $html_obj->find('#mainButtons',0)->outertext = '';
    //$html_obj->find('#rightColumn',0)->innertext = $html_obj->find('#rightColumn',0)->innertext."\n\n<!--#cctv-links-->\n\n"; 
    $html_obj->find('#informationPages',0)->innertext = $html_obj->find('#informationPages',0)->innertext."<li class='last'>\n\n<!--#cctv-links-->\n\n</li>";
    $html_obj->find('#tabs-4',0)->innertext = $html_obj->find('#tabs-4',0)->innertext."\n\n<!--#cctv-links-->\n\n";
    
    $html_obj->find('body',0)->innertext = '<style>.blueGradient{background:#36c148;} #mainMenu{border:solid 1px #36c148;} #categories{border:solid 1px #36c148;}</style>'.$html_obj->find('body',0)->innertext;
    $html = $html_obj->save();

    
    return $html;
}