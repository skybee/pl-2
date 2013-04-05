<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


function html_individual_clean_before( $html ){ 
    return $html;
}
function html_individual_clean_after( $html ){ 
    
    $ci =& get_instance();
    $ci->load->library('clean_lib');
    $ci->load->helper('simple_html_dom');
    
    $html = $ci->clean_lib->js_dlete( $html, 'adocean' );
    $html = $ci->clean_lib->js_dlete( $html, 'gemius' );
    
    $html_obj = str_get_html($html);
    $html_obj->find('div#newsletterBox',0)->outertext = ''; //всплывающий рекламный блок
    $html_obj->find('div#newsletterBoxLeft',0)->outertext = ''; //левый зафиксенный рекламный блок
    $html_obj->find('div#menuTop',0)->outertext = ''; //верхнее меню
    $html_obj->find('div#footer',0)->outertext = ''; //футер
    $html_obj->find('div.mainBottom',0)->outertext = ''; 
    $html_obj->find('div.mod_projekty_domow',0)->outertext = ''; //футер
    $html_obj->find('div.magazynyContent',0)->outertext = ''; //реклама журнала справа внизу
    $html_obj->find('div.pollOuter',0)->outertext = ''; //голосовалка
    $html_obj->find('div.topBanner',0)->outertext = '<!--#top_banner#-->'; //верхний баннер в статьях
    $html_obj->find('div.newsletter',0)->outertext = '<!--#top_mail#-->'; //подписка
    $html_obj->find('div.mod_avt_forum',0)->outertext = '<!--#forum-->'; //правый блок форума
    $html_obj->find('div.custom',0)->outertext = '<!--#ads_1#-->';
    $html_obj->find('div.custom',1)->outertext = '<!--#ads_2#-->';
    $html_obj->find('div.custom',2)->outertext = '<!--#ads_3#-->';
    $html_obj->find('div.mod_avtwiodace_firmy',0)->outertext = '<!--#ads_4#-->';
    if( is_object( $html_obj->find('div.contentRight',0) ) )
        $html_obj->find('div.contentRight',0)->innertext = '<!--#right_ads#--> '.$html_obj->find('div.contentRight',0)->innertext;
    
    $html = $html_obj->save();
    
    return $html;
}