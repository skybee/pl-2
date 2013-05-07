<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


function html_individual_clean_before( $html ){
    
    //< удаление параметров у css js >
//    $pattern = "#(css|js)\?v\d{1,5}#i";
//    $replace = "$1";
//    $html = preg_replace($pattern, $replace, $html);
    //</ удаление параметров у css js >
        
    return $html;
}

function html_individual_clean_after( $html ){
    
    $ci =& get_instance();
    $ci->load->library('clean_lib');
    $ci->load->helper('simple_html_dom');
    
    $html = preg_replace("#<noscript>[\s\S]*?</noscript>#i", "\n", $html);
    $html = preg_replace("#<iframe src=.//www.facebook.com[\s\S]*?</iframe>#i", "\n", $html);
    
    $html = $ci->clean_lib->js_dlete( $html, 'adsearch.adkontekst.pl' ); 
    $html = $ci->clean_lib->js_dlete( $html, 'bbelements.com' );
    $html = $ci->clean_lib->js_dlete( $html, 'google.com/js/plusone.js' );
    $html = $ci->clean_lib->js_dlete( $html, 'connect.facebook.net' );
    $html = $ci->clean_lib->js_dlete( $html, 'gemius' );
    $html = $ci->clean_lib->js_dlete( $html, 'tynt.com' );
    $html = $ci->clean_lib->js_dlete( $html, 'ghmxy_identifier' );
    $html = $ci->clean_lib->js_dlete( $html, 'loadFavoriteArticleInfo' );
    $html = $ci->clean_lib->js_dlete( $html, 'nk_wg' );
    $html = $ci->clean_lib->js_dlete( $html, 'bmone2n' );
    $html = $ci->clean_lib->js_dlete( $html, 'g.infor.pl' );
    
    $html_obj = str_get_html($html);
    $html_obj->find('div#kol-prawa',0)->innertext = '<!--#right_adsense-->';
    $html_obj->find('div.articleRekl',0)->innertext = '<!--#article_adsense-->';
    $html_obj->find('div#topLinks2',0)->outertext = ''; //верхний черный блок
    $html_obj->find('div#footer div.row2',0)->innertext = ''; //нижний блок (копирайт и тд)
    $html_obj->find('table.share',0)->outertext = ''; //FB поделиться
    $html_obj->find('div.artMainTabs',0)->outertext = ''; //топ кнопки в статье
    $html_obj->find('#header_body',0)->outertext = ''; //лого и поиск    
    $html_obj->find('.mt20 .section_title',0)->outertext = ''; //лого внизу
    
    
    $html = $html_obj->save();
    
    return $html;
}