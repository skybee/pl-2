<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class domain_alias_lib{
    
    function __construct() {
        $this->ci =& get_instance();
        $this->ci->config->load('parse');
        $this->create_folders();
    }
    
    
    function create_folders(){
        $domain_dir = 'sourse/'.$this->ci->config->item('site_domain');
        if( !is_dir($domain_dir) ){
            
            mkdir($domain_dir, 0777);
            mkdir($domain_dir.'/cache', 0777);
            mkdir($domain_dir.'/image', 0777);
            mkdir($domain_dir.'/file', 0777);
        }
    }
    
}