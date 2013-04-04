<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



function friends_link(){
    
    $domain_ar = array( 'strojdom.odnako.su',
                        'nebolej.odnako.su',
                        'puteshestvie.odnako.su',
                        'planshet.odnako.su',
                        'horoshij-dom.odnako.su',
                        'sovetchik.odnako.su',
                        'interer.odnako.su',
                        'interior-design.odnako.su',
                        'stroimsa.odnako.su',
                        'sad.odnako.su',
                        'auto24.odnako.su',
                        'nakablukah.odnako.su',
                        'domosfera.odnako.su',
                        'zdorovie.odnako.su',
                        'ledi.odnako.su',
                        'kanikuly.odnako.su',
                        'tech.odnako.su',
                        'obovsem.odnako.su'
                      );
    
    $int = abs( crc32( $_SERVER['REQUEST_URI'] ) );
    srand( $int );
    
    if( rand(1,100) > 5 ) 
        $anser = '';
    else{
        shuffle($domain_ar);
        
        $anser = '<a href="http://'.$domain_ar[0].'/">http://'.$domain_ar[0].'/</a>';
    }
    
    srand();
    
    return $anser;
}