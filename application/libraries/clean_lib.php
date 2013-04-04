<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class clean_lib{
    
    function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->library('subdomain_lib');
        $this->CI->config->load('parse');
        
        $this->domain->in   = str_ireplace('www.', '', $this->CI->config->item('donor_domain') );
        $this->domain->out  = $this->CI->config->item('site_domain');
        
        $this->js_ar        = array(); //массив js скриптов <script *** >***</script>
    }
    
    function html( $html ){
        
        //individual clean
        $html = html_individual_clean_before( $html );
        
        $html = $this->domain_replace( $html );
        
        //img title delete
        $pattern = "#(alt|title|longdesc)=['\"][\s\S]*?['\"]#i";
        $html = preg_replace($pattern, '', $html);
        
        
        //< a replace >//
        $pattern = "#<a\s+[\s\S]*?</a>#i";
        preg_match_all($pattern, $html, $a_ar); //нахождение всех ссылок
        $a_ar = $a_ar[0];
        
        $href_pattern = "#href=['\"]([\s\S]*?)['\"]#i"; //получение url
        $outlink_pattern = "#href=['\"]\S*?{$this->domain->out}\S*?['\"]#i"; //для определения внешних ссылок
        
        foreach( $a_ar as $key => $a_tag ){
            preg_match($href_pattern, $a_tag, $href_ar );
            
            if( !empty($href_ar[1]) ){
                $absolute_url = uri2absolute( $href_ar[1], $this->domain->out ); //получение нового абсолютного URL
                
                $new_a_tag = preg_replace("#([\s\S]*?)href=['\"][\s\S]*?['\"]([\s\S]*?)#i", "$1href=\"".$absolute_url."\"$2", $a_tag);
                
                if( preg_match($outlink_pattern, $new_a_tag) == false  ){ //удаление внешней ссылки
                    $new_a_tag = ' ';
                }
                
                $link_replace['search'][]   = $a_tag;
                $link_replace['replace'][]  = $new_a_tag;
            }
        }
        
        if( isset($link_replace['search']) )
            $html = str_ireplace($link_replace['search'], $link_replace['replace'], $html );
        //</ a replace >//
        
        
        //meta delete
        $pattern = "#<meta[\s\S]*?>#i";
        $html = preg_replace($pattern, '', $html);
        
        // subdomain to uri (перенос субдомена в uri)
        $this->CI->subdomain_lib->set_site_domain( $this->domain->out );
        $html = $this->CI->subdomain_lib->subd_to_uri( $html );
        
        // очистка url from css & js
        $html = $this->css_js_url_clean($html);
        
        // encode js & css (уникализация имени файла)
        $html = $this->CI->subdomain_lib->cssjs_encode( $html );
        
        //adsense del
        if( $this->CI->config->item('clean_adsense') )
            $html = $this->adsense($html);
        
        // google_analytics del
        if( $this->CI->config->item('clean_google_analytics') )
            $html = $this->google_analytics($html);
        
        //individual clean
        $html = html_individual_clean_after( $html );
        
        return $html;
    }
    
    function domain_replace( $content ){
        $pattern = "#(www\.|){$this->domain->in}#i";
        $replace = $this->domain->out;
        
        return $result_ar = preg_replace($pattern, $replace, $content);
    }
    
    function adsense( $html ){
        $html = $this->js_dlete($html, 'google_ad_client', '<!--#adsense_1-->');
        $html = $this->js_dlete($html, 'pagead/show_ads.js', '<!--#adsense_2-->');
        
        return $html;
    }
    
    function google_analytics( $html ){
        $html = $this->js_dlete($html, 'google-analytics.com/ga.js', '<!--#google_analytics_1-->');
        $html = $this->js_dlete($html, '_getTracker', '<!--#google_analytics_2-->');
        
        return $html;
    }
    
    function js_dlete( $html, $search, $replace = "<!--#clean_js-->" ){
        if( count( $this->js_ar ) < 1 ){ //создание массива скриптов
            $pattern = "#<script[\s\S]*?>[\s\S]*?</script>#i";
            $js_ar = array();
            preg_match_all($pattern, $html, $js_ar);
            $this->js_ar = $js_ar[0];
        }
        
        $search_ar = array(); $replace_ar = array();
        foreach( $this->js_ar as $js){
            if( stripos( $js, $search ) !== false ){
                $search_ar[]    = $js;
                $replace_ar[]   = "\n".$replace."\n";
            }
        }
        
        if( count( $search_ar ) > 0 )
            $html = str_ireplace($search_ar, $replace_ar, $html);
        
        return $html;
    }
    
    function css_js_url_clean( $html ){
        $pattern = "#(['\"]http://.*?\.)(css|js)\?.*?(['\"])#i";
        $html = preg_replace($pattern, "$1$2$3", $html);
        
//        preg_match_all($pattern, $html, $matches);
//        print_r($matches);
        
        return $html;
    }
    
    
}