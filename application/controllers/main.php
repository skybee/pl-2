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
        $this->load->library('domain_alias_lib');
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
        
        //передача управления линкатору
        if( $this->donor_uri == '/sb_linkator/'){ $this->linkator(); exit(); }

        
        //проверка на запрет uri
        if( $this->download_lib->lock_uri( $this->donor_url ) ){ show_404( 'Lock URI - '.$this->donor_url); exit(); }
        
        //проверка страны для блокировки
        $country    = get_country();
        $al         = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        if( $country == 'PL' || $country == 'UA' || $al == 'pl' ){ show_404( 'Lock Country - '.$this->donor_url); exit(); }
        
        
        // извлечение кеша
        if( $html = $this->cache->file->get( $this->cache_name ) ){
            $html = html_individual_added($html);
            echo $html;
//            $this->load->view('script_time_v');
        }
        else{
            //загрузка html
            $html_ar    = $this->download_lib->down_with_curl( $this->donor_url, true );

            // < check empty & 301 > //
            if( empty($html_ar['content']) ){
                $location = $this->download_lib->read_location( $this->donor_url );
                if( $location ){
                    $location   = $this->clean_lib->domain_replace( $location );
                    $location   = $this->subdomain_lib->subd_to_uri( $location );

                    header("HTTP/1.1 301 Moved Permanently");
                    header($location);
                    exit();
                }
                else { show_404( 'Empty HTML - '.$this->donor_url); } 
                exit();
            }
            // </ check empty & 301 > //


            //проверка Content-type
            if( $this->download_lib->check_html_type( $html_ar['content-type'] ) ){
                $html = $html_ar['content'];
                unset( $html_ar );
            }
            else{
                show_404( 'Content-Type Error - '.$this->donor_url);
                exit();
            }

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
                echo $html;     
    //            $this->load->view('script_time_v');
            }
            else  show_404( 'Translate Error - Code:'.$this->translate_lib->get_err_msg().' - '.$this->donor_url );
        }
    }
    
    function img(){
        $data   = $this->download_lib->down_with_curl( $this->donor_url );
        $fname  = $this->file_load_lib->get_file_name( $this->donor_url );
        $c_type = $this->file_load_lib->get_file_type( $fname );
        
        file_put_contents('sourse/'.$this->config->item('site_domain').'/image/'.$fname, $data);
        
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
        
        file_put_contents('sourse/'.$this->config->item('site_domain').'/file/'.$fname, $data);
        
        
        header('Content-type:'.$c_type.';');
        echo $data;
    }
    
    function linkator(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            
            if( empty($_POST['host']) OR empty($_POST['url']) OR mb_strlen($_POST['title']) < 10 ) exit();
            
            $this->load->model('linkator_m','',TRUE);
            $this->load->helper('linkator');
            
            //занесение url
            if( $url_id = $this->linkator_m->search_url( $_POST['url'] ) ){ //поиск такого url
                $this->linkator_m->update_url( $url_id ); //обновление счетчика url
            }
            else{
                $url_id = $this->linkator_m->insert_url( $_POST ); //занесение url
            }
            
            if( strlen( $_POST['referrer'] ) > 5 ){
                $query_txt = get_google_query( $_POST['referrer'] );
            }
            else
                $query_txt = '';
            
            //занесение запросов
            if( $url_id > 0 && mb_strlen($query_txt) >=2  ){
                if( $query_id = $this->linkator_m->search_query($url_id, $query_txt) ){ //поиск такого запроса
                    $this->linkator_m->update_query( $query_id ); //обновление счетчика запроса
                }
                else{
                    $this->linkator_m->insert_query($url_id, $query_txt); //занесение запроса
                }
            }
        }
    }
}