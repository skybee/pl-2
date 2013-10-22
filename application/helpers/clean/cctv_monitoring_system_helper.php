<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


function html_individual_clean_before( $html ){    
    
    $html = preg_replace("#<a href=.https://transferuj.pl[\s\S]+?</a>#i", '', $html);
    
    return $html;
}

function html_individual_clean_after( $html ){
    
    $ci =& get_instance();
    $ci->load->library('clean_lib');
    $ci->load->helper('simple_html_dom');
    
    $html = $ci->clean_lib->js_dlete( $html, '4u.pl' ); 
    $html = $ci->clean_lib->js_dlete( $html, 'connect.facebook.com' );
    
    
    $html_obj = str_get_html($html);
    $html_obj->find('.layout-box-type-facebook-like',0)->innertext = '';
    $html_obj->find('.facebook',0)->outertext = '';
    $html_obj->find('#header',0)->outertext = '';
    $html_obj->find('#producers-logos',0)->outertext = '';
    $html_obj->find('#product-search',0)->outertext = '';
    $html_obj->find('#footer',0)->outertext = '';
    $html_obj->find('#horizontal-navigation',0)->style = "background: #42AF1C;";
    $html_obj->find('#main-container',0)->style = "border: 4px solid #42AF1C;";
    
    for($i=0; true; $i++){
        if( is_object( $html_obj->find('#horizontal-navigation li', $i) ) )
            $html_obj->find('#horizontal-navigation li', $i)->style = "background: #42AF1C;";
        else
            break;
    }
    
    for($i=0; true; $i++){
        if( is_object( $html_obj->find('.layout-box-header', $i) ) )
            $html_obj->find('.layout-box-header', $i)->style = "background: #42AF1C;";
        else
            break;
    }
    
    $html_obj->find('#layout-column-0',0)->innertext = $html_obj->find('#layout-column-0',0)->innertext."\n\n<!--#cctv-links-->\n\n";
    $html = $html_obj->save();

    
    return $html;
}