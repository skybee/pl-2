<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


function html_individual_added( $html ){
    
    $ci =& get_instance();
    $ci->load->helper('friends_link');
    
    
    $counter    = $ci->load->view('counter/li_v', '', TRUE);
    $counter   .= friends_link();
    $html       = str_ireplace('</body>', $counter.' </body>', $html);
    
    return $html;
}