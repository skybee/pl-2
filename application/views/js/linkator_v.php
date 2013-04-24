<?php if (!defined('BASEPATH')) exit('No direct script access allowed');?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript">
    <? if( $noconflict ) echo "jQuery.noConflict(); \n"; ?>
        
    jQuery(document).ready(function(){
        host        = location.hostname;
        url         = location.href;
        title       = jQuery('title').text();
        referrer    = document.referrer;
        
        if( title.length > 10 ){
            jQuery.post('/sb_linkator/', {host:host, url:url, title:title, referrer:referrer} );
        }
    });
</script>