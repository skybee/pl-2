<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function html_individual_added( $html ){
    
    $ci =& get_instance();
    $ci->load->helper('friends_link');
    
    $ads_top    = $ci->load->view('ads/urzadzamy_top_v', '', TRUE);
    $ads_right  = $ci->load->view('ads/urzadzamy_right_v', '', TRUE);
    $counter    = $ci->load->view('counter/li_v', '', TRUE);
    $counter   .= friends_link();
    
    $html       = str_ireplace('</body>', $counter.' </body>', $html);
    $html       = str_replace('<!--#top_ads-->', $ads_top, $html);
    $html       = str_replace('<!--#right_ads-->', $ads_right, $html);
    
    return $html;
}