<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class linkator_m extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    
    function search_url( $url ){
        $url = mysql_real_escape_string($url);
        
        $query = $this->db->query(" SELECT `id` FROM `site_url` WHERE `url` = '{$url}' ");
                                    
        if( $query->num_rows < 1 ) return false;
        
        $row = $query->row();
        return $row->id;
    }
    
    function insert_url( $data_ar ){
        foreach( $data_ar as $key => $val )
            $data_ar[$key] = mysql_real_escape_string($val);
        
        $this->db->query("  INSERT INTO `site_url` 
                            SET
                                `host`  = '{$data_ar['host']}',
                                `url`   = '{$data_ar['url']}',
                                `title` = '{$data_ar['title']}',
                                `count` = 1
                        ");
        
        $id = $this->db->insert_id();                        
        
        if( $id > 0 ) return $id;
        else return false;
    }
    
    function update_url( $id ){
        $this->db->query(" UPDATE `site_url` SET `count`=`count`+1 WHERE `id`={$id} ");
    }
    
    function search_query($url_id, $query_txt){
        $query_txt = mysql_real_escape_string($query_txt);
        
        $query = $this->db->query(" SELECT `id` FROM `search_query` 
                                    WHERE 
                                        `site_url_id`   = '{$url_id}'
                                         AND
                                         `search_text`  = '{$query_txt}'
                                  ");
        
        if( $query->num_rows < 1 ) return false;
        
        $row = $query->row();
        return $row->id;                                
    }
    
    function insert_query( $url_id, $query_txt){
        $query_txt = mysql_real_escape_string($query_txt);
        
        $this->db->query("  INSERT INTO `search_query`
                            SET
                                `site_url_id`   = '{$url_id}',
                                `search_text`   = '{$query_txt}',    
                                `count`         = 1    
                        ");
                                
        $id = $this->db->insert_id();                        
        
        if( $id > 0 ) return $id;
        else return false;                        
    }
    
    function update_query( $id ){
        $this->db->query(" UPDATE `search_query` SET `count`=`count`+1 WHERE `id`={$id}  ");
    }
    
    
    //==== GET Friends Links Method ====//
    
    function get_rnd_host( $page_seed ){
        $query = $this->db->query("SELECT DISTINCT `host` FROM `site_url` ORDER BY RAND({$page_seed}) LIMIT 1");
        $row = $query->row();
        
        return $row->host;
    }
    
    function get_rnd_host_url($host, $page_seed, $limit = 1000){
        $query = $this->db->query(" SELECT      `id`,`url`,`title` 
                                FROM        `site_url` 
                                WHERE       `host` = '{$host}'
                                ORDER BY    `count` DESC
                                LIMIT       $limit
                              ");
                                
        if( $query->num_rows() < 1 ) return FALSE;
        
        foreach( $query->result_array() as $row ){
            $url_ar[] = $row;
        }
        
        srand( $page_seed );
        shuffle($url_ar);
        srand();
        
        return $url_ar[0];
    }
    
    function get_rnd_host_url_query($url_id, $page_seed, $limit = 100){
        $query = $this->db->query(" SELECT      `search_text` 
                                FROM        `search_query`
                                WHERE       `site_url_id` = '{$url_id}'
                                ORDER BY    `count` DESC
                                LIMIT       $limit    
                              ");
                               
        if( $query->num_rows() < 1 ) return FALSE;
        
        foreach( $query->result_array() as $row ){
            $query_ar[] = $row;
        }
        
        srand( $page_seed );
        shuffle($query_ar);
        srand();
        
        return $query_ar[0]['search_text'];                        
    }
} 