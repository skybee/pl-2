<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


function html_individual_clean_before( $html ){ 
    
    $html = preg_replace("#(\.css)\?.*(['\"])#i", "$1$2", $html); //удаление параметра css
    $html = preg_replace("#<iframe[\s\S]*?facebook\.com[\s\S]*?</iframe>#i", '', $html); //удаление FB
    
    return $html; 
    
}
function html_individual_clean_after( $html ){ 
    
    $ci =& get_instance();
    $ci->load->library('clean_lib');
    $ci->load->helper('simple_html_dom');
    
    $html = $ci->clean_lib->js_dlete( $html, 'connect.facebook.net' );
    $html = $ci->clean_lib->js_dlete( $html, 'gemius' );
//    $html = $ci->clean_lib->js_dlete( $html, 'stats.wordpress.com' );      
    $html = $ci->clean_lib->js_dlete( $html, 's0.wp.com' );        
    $html = $ci->clean_lib->js_dlete( $html, 'gravatar.com' );        
//    $html = $ci->clean_lib->js_dlete( $html, 'apis.google.com/js/plusone.js' );
//    $html = $ci->clean_lib->js_dlete( $html, 'bbelements.com' );
    $html = $ci->clean_lib->js_dlete( $html, 'twitter.com' );
    $html = $ci->clean_lib->js_dlete( $html, 'sas_manager' );

    $html_obj = str_get_html($html);
    $html_obj->find('#news_right_block',0)->innertext = '<!--#right_ads-->';
    $html_obj->find('.billboard',0)->innertext = '<!--#top_ads-->';
    $html_obj->find('#social',0)->innertext = '<!--#fb_likes-->';
    
    $html = $html_obj->save();
    
    return $html; 
}