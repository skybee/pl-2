<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class translate_lib{
    
    private $err_msg = '';
    
    function get_err_msg(){
        return $this->err_msg;
    }
    
    function send_post( $url, $post_ar ){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.2.2) Gecko/20100316 Firefox/3.6.2');
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_ar);

        $content = curl_exec($ch);
        curl_close($ch);
        
        return $content;
    }
    
    function get_translate( $html ){
        $post_ar['key']     = 'trnsl.1.1.20130804T183010Z.34edebe22254f237.66d78220c2768967ef7d49a8cd8f705c64647d49';
        $post_ar['lang']    = 'pl-ru';
        $post_ar['format']  = 'html';
        $post_ar['text']    = $html;
        
        $translate_url      = 'https://translate.yandex.net/api/v1.5/tr.json/translate';
        
        #$js_anser   = $this->send_post($translate_url, $post_ar);
        $js_anser   = $this->translate_proxy($translate_url, $post_ar);
        $anser_ar   = json_decode($js_anser, true);
        
//        '<pre>'.print_r($js_anser).'</pre>';
        
        if( $anser_ar['code'] == '200' )
            return $anser_ar['text'][0];
        else{
            $this->err_msg .= $anser_ar['code'];
            return FALSE;
        }
    }
     
    function translate_proxy( $url, $post_ar ){
        $proxy_ar = array(
            //hc.01 house-control.org.ua
            array('host'=>'house-control.org.ua',         'key'=>'trnsl.1.1.20131002T123630Z.fdac614fe17a45ed.68033bbe51e827cc66b6cb1903df7fee5ff996ab'),
            //hc.02 Coopertino.ru
            array('host'=>'trnsl-2.house-control.org.ua', 'key'=>'trnsl.1.1.20131002T192904Z.fd059a048f0ca480.d3b5d019f4c55bce58165681e3b971640dd10e62'),
            //hc.03 yacy.net84.net
            array('host'=>'trnsl-3.house-control.org.ua', 'key'=>'trnsl.1.1.20131002T200511Z.9dee007e91822ce8.4f256216009635e6fdd835691e9ae5671f7019be'),
            //hc.04 yacy.herobo.com
            array('host'=>'trnsl-4.house-control.org.ua', 'key'=>'trnsl.1.1.20131002T200910Z.ddf24538ec147aa0.bb562c7f3fc2b6d5b97e7b7dae83a95dee849aaa'),
            //hc.05 yacy.netii.net
            array('host'=>'trnsl-5.house-control.org.ua', 'key'=>'trnsl.1.1.20131002T201450Z.e9081981497d2a09.bc495375d31eb9a3b553df582b480c3fa8e49535')
        );
        
        $host_key = $proxy_ar[ rand(0, count($proxy_ar)-1 ) ];
        
        $proxy_url = 'http://'.$host_key['host'].'/translate-proxy.php';
        
        $post_ar['key'] = $host_key['key'];
        
        $send_post['url']       = $url;
        $send_post['post_ar']   = serialize( $post_ar );
        
//        echo '<pre>'.print_r($send_post,1).'</pre>';
        
        $answer = $this->send_post($proxy_url, $send_post);
        $answer = preg_replace("#<!-- Hosting24 Analytics Code -->[\s\S]*?<!-- End Of Analytics Code -->#i", '', $answer);
        
        $this->err_msg .= " -proxy:{$host_key['host']}- ";
//        file_put_contents('tmp.txt', $answer);
//        file_put_contents('tmp.txt', "\n----------- {$host_key['host']} ----------\n".$answer , FILE_APPEND);
        
        return $answer;
    }
}