<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class hc_m extends CI_Model{
    
    
    function get_goods_rink( $rand_int, $min_price = 250, $limit = 300 ){
        $query = $this->db->query(" SELECT `id`, `name`, `url_name` FROM 
                                    (SELECT * FROM `goods` WHERE `price` >= {$min_price} ORDER BY `rank` DESC LIMIT {$limit}) AS `tt`
                                    ORDER BY RAND({$rand_int}) 
                                    LIMIT 1 ");
        
        $row = $query->row_array(); 
        
        return $row;
    }
    
    
}