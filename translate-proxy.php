<?php

if( $_POST == NULL ) exit('<h1>Translate Proxy</h1>');

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

if( get_magic_quotes_gpc() )
    $_POST['post_ar'] = stripcslashes( $_POST['post_ar'] );

$post_ar    = unserialize( $_POST['post_ar'] );
$url        = $_POST['url'];
//$url        = 'http://trnsl-2.house-control.org.ua/check_ip.php';

$json = send_post( $url, $post_ar );

echo $json;

//file_put_contents('tmp.txt', "111\n\n".print_r($_POST,1)."\n\n222\n\n".print_r($post_ar,1) );


