<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


function html_individual_added( $html ){
    
    $ci =& get_instance();
    $ci->load->helper('cctv');
    
    
    //==== получение ссылок ====//
    $rand_str = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    
    srand( abs( crc32($rand_str) ) );
    $rnd_int    = rand(1, 100);
    $rnd_int_nf = rand(1, 100); //nofollow int
    srand();
    
    $link_txt = '';
    
    if( $rnd_int <= 10 ){ //house-control link
        $link_txt = get_city_link($rand_str, 'city_link.txt');
        
        if( $rnd_int_nf <= 25 ){ // add nofollow
            $link_txt = str_ireplace('<a ', '<a rel="nofollow" ', $link_txt);
        }
    }
    elseif( $rnd_int >= 85 && $rnd_int < 90 ){ // HC goods link
        
        $rnd_int = abs( crc32( $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ) );
        
        $json = file_get_contents( 'http://house-control.org.ua/donor/cctv/get_goods_rink/'.$rnd_int.'/250/300/' ); // rand int / min price / goods limit /
        
        $goods_ar = json_decode($json, true);
        
        if( is_array($goods_ar) ){
            if( $rnd_int_nf < 50 )
                $link_txt = '<a href="http://house-control.org.ua/goods/'.$goods_ar['id'].'/'.$goods_ar['url_name'].'/">'.$goods_ar['name'].'</a>';
            else
                $link_txt = $goods_ar['name'].' <a href="http://house-control.org.ua/goods/'.$goods_ar['id'].'/'.$goods_ar['url_name'].'/">http://house-control.org.ua/goods/'.$goods_ar['id'].'/'.$goods_ar['url_name'].'/</a>';
        }
    }
    elseif( $rnd_int >= 90 ){ // sape link
        $link_txt = get_city_link($rand_str, 'sape_a_link_donor.txt');
    }
    
    //==== /получение ссылок ====//
    
    
    
    $counter        = $ci->load->view('counter/li_v', '', TRUE);
    
    $html           = str_replace('<!--#cctv-links-->', $link_txt, $html);
    $html           = str_ireplace('</body>', $counter.' </body>', $html);
    
    return $html;
}