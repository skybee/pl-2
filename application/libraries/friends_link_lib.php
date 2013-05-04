<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class friends_link_lib{
    
    function __construct() {
        $this->ci =& get_instance();
        $this->page_seed = $this->get_page_seed();
    }
    
    function get_link( $percent = 10, $url_limit = 5000, $query_limit = 100 ){
        if( !$this->get_link_or_no($percent) )
            return '';
        
        $this->ci->load->model('linkator_m','',TRUE);
        
        $rnd_host   = $this->ci->linkator_m->get_rnd_host( $this->page_seed );
        $rnd_url_ar = $this->ci->linkator_m->get_rnd_host_url( $rnd_host, $this->page_seed, $url_limit );
        if( $rnd_url_ar )
            $query_str  = $this->ci->linkator_m->get_rnd_host_url_query( $rnd_url_ar['id'], $this->page_seed, $query_limit );
        
        //получение случайного числа, для отображения title вместо query
        $title_seed = $this->get_page_seed()+999;
        srand($title_seed);
        $title_rnd_int = rand(1,100);
        srand();
        
        if( $title_rnd_int <= 5 || $query_str == false ) //замена анкора на title
            $query_str = $rnd_url_ar['title'];
        
        return '<a href="'.$rnd_url_ar['url'].'">'.$query_str.'</a>';
    }
    
    function get_link_or_no( $percent ){ //определяет будат ли отдаваться ссылка для текущей стр.
        
        srand( $this->page_seed );
        $rnd_int = rand(1, 100);
        srand();
        
        if( $rnd_int <= $percent )
            return TRUE;
        else
            return FALSE;
    }
    
    function get_page_seed(){
        $seed = abs( crc32($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']) );
        return $seed;
    }
}