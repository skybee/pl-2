<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function html_individual_added( $html ){
    
    $ci =& get_instance();
    $ci->load->helper('friends_link');
    $ci->load->library('friends_link_lib');
    
    $ads            = $ci->load->view('ads/wieszjak_v', '', TRUE);
    $ads_artcl      = $ci->load->view('ads/wieszjak_article_v', '', TRUE);
    $counter        = $ci->load->view('counter/li_v', '', TRUE);
//    $counter       .= friends_link();
    $linkator_js    = $ci->load->view('js/linkator_v', array('noconflict'=>false), TRUE);
    $friends_link   = $ci->friends_link_lib->get_link();
    $ads           .= '<br /><br />'.$friends_link;
    
    $html       = str_ireplace('</body>', $linkator_js."\n".$counter.' </body>', $html);
    $html       = str_replace('<!--#right_adsense-->', $ads, $html);
    $html       = str_replace('<!--#article_adsense-->', $ads_artcl, $html);
    
    return $html;
}