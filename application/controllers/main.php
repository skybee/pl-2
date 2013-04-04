<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class main extends CI_Controller{
    
    
    function __construct() {
        parent::__construct();
        
        $this->config->load('parse');
        $this->load->library('download_lib');
        $this->load->library('translate_lib');
        $this->load->library('clean_lib');
        $this->load->library('subdomain_lib');
        $this->load->library('file_load_lib');
        $this->load->helper( 'clean/'.$this->config->item('clean_helper') );
        $this->load->helper( 'clean/'.$this->config->item('clean_js_helper') );
        $this->load->helper( 'add/'.$this->config->item('add_helper') );
        $this->load->helper( 'uri2absolute' );
        $this->load->helper( 'geoip/geoip' );
        $this->load->driver('cache');
        
        $this->subdomain_lib->set_donor_domain( $this->config->item('donor_domain') );
        $this->subdomain_lib->set_site_domain( $this->config->item('site_domain') );
        $this->donor_uri = $this->subdomain_lib->sh_decode( $_SERVER['REQUEST_URI'] );
        $this->donor_url = $this->subdomain_lib->get_donor_url( $this->donor_uri );
        $this->cache_name = sha1($this->donor_url);
        $this->cache_time = 3600*24 * $this->config->item('cache_time');
        
        if( strlen($_SERVER['REQUEST_URI']) <= 1 ) //установка времени кеширования для главной страницы
            $this->cache_time = 3600*24 * $this->config->item('cache_time_index');
    }
    
    function index(){
        
        //проверка на запрет uri
        if( $this->download_lib->lock_uri( $this->donor_url ) ){ show_404(); exit(); }
        
        //проверка страны для блокировки
        if( get_country() == 'PL' ){ show_404(); exit(); }
        
        
        // извлечение кеша
        if( $html =  $this->cache->file->get( $this->cache_name ) ){
            $html = html_individual_added($html);
            exit($html);
        }
        
        //загрузка html
        $html   = $this->download_lib->down_with_curl( $this->donor_url );
        
        // < check empty & 301 > //
        if( empty($html) ){
            $location = $this->download_lib->read_location( $this->donor_url );
            if( $location ){
                $location   = $this->clean_lib->domain_replace( $location );
                $location   = $this->subdomain_lib->subd_to_uri( $location );
                
                header("HTTP/1.1 301 Moved Permanently");
                header($location);
                exit();
            }
            else { show_404('333'); } 
            exit();
        }
        // </ check empty & 301 > //
        
        //изменение кодировки
        $html = iconv( $this->config->item('donor_charset') ,'UTF-8//IGNORE', $html );
        
        //обработка html (чистка)
        $html = $this->clean_lib->html( $html );
        
        //перевод текста
        $html = $this->translate_lib->get_translate( $html );
        
        if( $html ){
            //Вставка info url 
            $info_url = "\n<!--\n<donuri>{$this->donor_uri}</donuri>\n<thisurl>http://{$this->config->item('site_domain')}{$_SERVER['REQUEST_URI']}<thisurl>\n-->";
            $html = str_ireplace('</body>', $info_url.'</body>', $html);
            
            //кеширование результата и вывод
            $this->cache->file->save( $this->cache_name, $html, $this->cache_time );
            $html = html_individual_added($html);
            echo $html;     //$this->load->view('script_time_v');
        }
        else  show_404();
    }
    
    function img(){
        $data   = $this->download_lib->down_with_curl( $this->donor_url );
        $fname  = $this->file_load_lib->get_file_name( $this->donor_url );
        $c_type = $this->file_load_lib->get_file_type( $fname );
        
        file_put_contents('sourse/image/'.$fname, $data);
        
        header('Content-type:'.$c_type.';');
        echo $data;
    }
    
    function file(){
        $data       = $this->download_lib->down_with_curl( $this->donor_url );
        $fname      = $this->file_load_lib->get_file_name( $this->subdomain_lib->sh_encode( ltrim( $this->donor_uri,'/') ) );
        $c_type     = $this->file_load_lib->get_file_type( $fname );
        
        if( $c_type == 'text/css' || $c_type == 'application/x-javascript' ){ //преобразование url
            $data   = $this->clean_lib->domain_replace( $data );
            $data   = $this->subdomain_lib->subd_to_uri( $data );
            
            if( $c_type == 'application/x-javascript' ) //очистка js
                $data = clean_js($data);
        }
        
        file_put_contents('sourse/'.$fname, $data);
        
        
        header('Content-type:'.$c_type.';');
        echo $data;
    }
}