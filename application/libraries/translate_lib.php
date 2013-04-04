<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class translate_lib{
    
    function send_post( $url, $post_ar ){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.2.2) Gecko/20100316 Firefox/3.6.2');
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_ar);

        $content = curl_exec($ch);
        curl_close($ch);

        return $content;
    }
    
    function get_translate( $html ){
        $post_ar['lang']    = 'pl-ru';
        $post_ar['format']  = 'html';
        $post_ar['text']    = $html;
        
        $translate_url      = 'http://translate.yandex.net/api/v1/tr.json/translate';
        
        $js_anser   = $this->send_post($translate_url, $post_ar);
        $anser_ar   = json_decode($js_anser, true);
        
        if( $anser_ar['code'] == '200' )
            return $anser_ar['text'][0];
        else
            return FALSE;
    }
}