<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


function html_individual_added( $html ){
    
    $ci =& get_instance();
    $ci->load->helper('friends_link');
    $ci->load->library('friends_link_lib');
    
    $linkator_js    = $ci->load->view('js/linkator_v', array('noconflict'=>false), TRUE);
    
    $counter        = $ci->load->view('counter/li_v', '', TRUE);
//    $counter       .= friends_link();
    $friends_link   = $ci->friends_link_lib->get_link();
    $html           = str_ireplace('</body>', $friends_link."\n".$linkator_js."\n".$counter.' </body>', $html);
    
    return $html;
}