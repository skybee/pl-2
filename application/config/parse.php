<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


//$config['clean_helper']     = 'default_helper'; //дополнительная индивидуальная ф-ция для очистки HTML - html_individual_clean( $html ){ return $html; }

$config['site_domain']      = $_SERVER['HTTP_HOST'];
$config['cache_time']       = 180;   //количество дней
$config['cache_time_index'] = 1;    //количество дней для главной страници
$config['clean_adsense']            = TRUE; // удаление рекламы google (может работать не корректно)
$config['clean_google_analytics']   = TRUE; // удаление google analytics (может работать не корректно)


if( $_SERVER['HTTP_HOST'] == 'pl-2.lh' ){
    $config['donor_domain']     = 'www.ctr.pl'; //основной домен по которому работает сайт (возможно с www)
    $config['donor_charset']    = 'iso-8859-2';
    $config['clean_helper']     = 'cctv_ctr_helper'; //хелпер для очистки html
    $config['clean_js_helper']  = 'default_js_helper'; //хелпер для очистки js
    $config['add_helper']       = 'cctv_default_helper';
    $config['lock_uri']         = array('/m_kontakt.htm'); // uri запрещенные к парсингу прим. '/forum/post/' не будут парситься все адреса вида '(subdomain.)donor.com/forum/post/*' 
}

//elseif( $_SERVER['HTTP_HOST'] == 'infobex.ru' ){ //$_SERVER['HTTP_HOST'] == 'obovsem.odnako.su'
//    $config['donor_domain']     = 'wieszjak.pl'; //основной домен по которому работает сайт (возможно с www)
//    $config['donor_charset']    = 'utf-8';
//    $config['clean_helper']     = 'wieszjak_helper';
//    $config['clean_js_helper']  = 'wieszjak_js_helper'; //хелпер для очистки js
//    $config['add_helper']       = 'wieszjak_helper';
//    $config['lock_uri']         = array('/forum','/profili','/ludzie'); // uri запрещенные к парсингу прим. '/forum/post/' не будут парситься все адреса вида '(subdomain.)donor.com/forum/post/*' 
//}
//elseif( $_SERVER['HTTP_HOST'] == 'strojdom.odnako.su'){
//    $config['donor_domain']     = 'www.budujemydom.pl'; //основной домен по которому работает сайт (возможно с www)
//    $config['donor_charset']    = 'utf-8';
//    $config['clean_helper']     = 'budujemydom_helper';
//    $config['clean_js_helper']  = 'default_js_helper'; //хелпер для очистки js
//    $config['add_helper']       = 'budujemydom_helper';
//    $config['lock_uri']         = array(); // uri запрещенные к парсингу прим. '/forum/post/' не будут парситься все адреса вида '(subdomain.)donor.com/forum/post/*' 
//}
//elseif( $_SERVER['HTTP_HOST'] == 'nebolej.odnako.su' ){
//    $config['donor_domain']     = 'www.poradnikzdrowie.pl'; //основной домен по которому работает сайт (возможно с www)
//    $config['donor_charset']    = 'utf-8';
//    $config['clean_helper']     = 'default_helper';
//    $config['clean_js_helper']  = 'default_js_helper'; //хелпер для очистки js
//    $config['add_helper']       = 'default_helper';
//    $config['lock_uri']         = array(); // uri запрещенные к парсингу прим. '/forum/post/' не будут парситься все адреса вида '(subdomain.)donor.com/forum/post/*' 
//}
//elseif( $_SERVER['HTTP_HOST'] == 'puteshestvie.odnako.su' ){
//    $config['donor_domain']     = 'www.podroze.pl'; //основной домен по которому работает сайт (возможно с www)
//    $config['donor_charset']    = 'utf-8';
//    $config['clean_helper']     = 'default_helper';
//    $config['clean_js_helper']  = 'default_js_helper'; //хелпер для очистки js
//    $config['add_helper']       = 'default_helper';
//    $config['lock_uri']         = array(); // uri запрещенные к парсингу прим. '/forum/post/' не будут парситься все адреса вида '(subdomain.)donor.com/forum/post/*' 
//}
//elseif( $_SERVER['HTTP_HOST'] == 'planshet.odnako.su' ){
//    $config['donor_domain']     = 'www.tablety.pl'; //основной домен по которому работает сайт (возможно с www)
//    $config['donor_charset']    = 'utf-8';
//    $config['clean_helper']     = 'tablety_helper';
//    $config['clean_js_helper']  = 'default_js_helper'; //хелпер для очистки js
//    $config['add_helper']       = 'tablety_helper';
//    $config['lock_uri']         = array(); // uri запрещенные к парсингу прим. '/forum/post/' не будут парситься все адреса вида '(subdomain.)donor.com/forum/post/*' 
//}
//elseif( $_SERVER['HTTP_HOST'] == 'horoshij-dom.odnako.su' ){
//    $config['donor_domain']     = 'ladnydom.pl'; //основной домен по которому работает сайт (возможно с www)
//    $config['donor_charset']    = 'iso-8859-2';
//    $config['clean_helper']     = 'default_helper'; //хелпер для очистки html
//    $config['clean_js_helper']  = 'default_js_helper'; //хелпер для очистки js
//    $config['add_helper']       = 'default_helper';
//    $config['lock_uri']         = array(); // uri запрещенные к парсингу прим. '/forum/post/' не будут парситься все адреса вида '(subdomain.)donor.com/forum/post/*' 
//}
//elseif( $_SERVER['HTTP_HOST'] == 'sovetchik.odnako.su' ){
//    $config['donor_domain']     = 'polki.pl'; //основной домен по которому работает сайт (возможно с www)
//    $config['donor_charset']    = 'utf-8';
//    $config['clean_helper']     = 'default_helper'; //хелпер для очистки html
//    $config['clean_js_helper']  = 'default_js_helper'; //хелпер для очистки js
//    $config['add_helper']       = 'default_helper';
//    $config['lock_uri']         = array(); // uri запрещенные к парсингу прим. '/forum/post/' не будут парситься все адреса вида '(subdomain.)donor.com/forum/post/*'   
//}
//elseif( $_SERVER['HTTP_HOST'] == 'apartment-style.ru' ){ //$_SERVER['HTTP_HOST'] == 'interer.odnako.su'
//    $config['donor_domain']     = 'www.urzadzamy.pl'; //основной домен по которому работает сайт (возможно с www)
//    $config['donor_charset']    = 'utf-8';
//    $config['clean_helper']     = 'urzadzamy_helper'; //хелпер для очистки html
//    $config['clean_js_helper']  = 'default_js_helper'; //хелпер для очистки js
//    $config['add_helper']       = 'urzadzamy_helper';
//    $config['lock_uri']         = array(); // uri запрещенные к парсингу прим. '/forum/post/' не будут парситься все адреса вида '(subdomain.)donor.com/forum/post/*'  
//}
//elseif( $_SERVER['HTTP_HOST'] == 'interior-design.odnako.su' ){
//    $config['donor_domain']     = 'czterykaty.pl'; //основной домен по которому работает сайт (возможно с www)
//    $config['donor_charset']    = 'iso-8859-2';
//    $config['clean_helper']     = 'default_helper'; //хелпер для очистки html
//    $config['clean_js_helper']  = 'default_js_helper'; //хелпер для очистки js
//    $config['add_helper']       = 'default_helper';
//    $config['lock_uri']         = array(); // uri запрещенные к парсингу прим. '/forum/post/' не будут парситься все адреса вида '(subdomain.)donor.com/forum/post/*' 
//}
//elseif( $_SERVER['HTTP_HOST'] == 'stroimsa.odnako.su' ){
//    $config['donor_domain']     = 'www.muratorplus.pl'; //основной домен по которому работает сайт (возможно с www)
//    $config['donor_charset']    = 'utf-8';
//    $config['clean_helper']     = 'default_helper'; //хелпер для очистки html
//    $config['clean_js_helper']  = 'default_js_helper'; //хелпер для очистки js
//    $config['add_helper']       = 'default_helper';
//    $config['lock_uri']         = array(); // uri запрещенные к парсингу прим. '/forum/post/' не будут парситься все адреса вида '(subdomain.)donor.com/forum/post/*' 
//}
//elseif( $_SERVER['HTTP_HOST'] == 'sad.odnako.su' ){
//    $config['donor_domain']     = 'www.e-ogrody.pl'; //основной домен по которому работает сайт (возможно с www)
//    $config['donor_charset']    = 'iso-8859-2';
//    $config['clean_helper']     = 'default_helper'; //хелпер для очистки html
//    $config['clean_js_helper']  = 'default_js_helper'; //хелпер для очистки js
//    $config['add_helper']       = 'default_helper';
//    $config['lock_uri']         = array(); // uri запрещенные к парсингу прим. '/forum/post/' не будут парситься все адреса вида '(subdomain.)donor.com/forum/post/*' 
//}
//elseif( $_SERVER['HTTP_HOST'] == 'auto24.odnako.su' ){
//    $config['donor_domain']     = 'superauto24.se.pl'; //основной домен по которому работает сайт (возможно с www)
//    $config['donor_charset']    = 'utf-8';
//    $config['clean_helper']     = 'default_helper'; //хелпер для очистки html
//    $config['clean_js_helper']  = 'default_js_helper'; //хелпер для очистки js
//    $config['add_helper']       = 'default_helper';
//    $config['lock_uri']         = array(); // uri запрещенные к парсингу прим. '/forum/post/' не будут парситься все адреса вида '(subdomain.)donor.com/forum/post/*' 
//}
//elseif( $_SERVER['HTTP_HOST'] == 'nakablukah.odnako.su' ){
//    $config['donor_domain']     = 'www.wysokieobcasy.pl'; //основной домен по которому работает сайт (возможно с www)
//    $config['donor_charset']    = 'iso-8859-2';
//    $config['clean_helper']     = 'default_helper'; //хелпер для очистки html
//    $config['clean_js_helper']  = 'default_js_helper'; //хелпер для очистки js
//    $config['add_helper']       = 'default_helper';
//    $config['lock_uri']         = array(); // uri запрещенные к парсингу прим. '/forum/post/' не будут парситься все адреса вида '(subdomain.)donor.com/forum/post/*' 
//}
//elseif( $_SERVER['HTTP_HOST'] == 'domosfera.odnako.su' ){
//    $config['donor_domain']     = 'www.domosfera.pl'; //основной домен по которому работает сайт (возможно с www)
//    $config['donor_charset']    = 'iso-8859-2';
//    $config['clean_helper']     = 'default_helper'; //хелпер для очистки html
//    $config['clean_js_helper']  = 'default_js_helper'; //хелпер для очистки js
//    $config['add_helper']       = 'default_helper';
//    $config['lock_uri']         = array(); // uri запрещенные к парсингу прим. '/forum/post/' не будут парситься все адреса вида '(subdomain.)donor.com/forum/post/*' 
//}
//elseif( $_SERVER['HTTP_HOST'] == 'zdorovie.odnako.su' ){
//    $config['donor_domain']     = 'zdrowie.gazeta.pl'; //основной домен по которому работает сайт (возможно с www)
//    $config['donor_charset']    = 'iso-8859-2';
//    $config['clean_helper']     = 'default_helper'; //хелпер для очистки html
//    $config['clean_js_helper']  = 'default_js_helper'; //хелпер для очистки js
//    $config['add_helper']       = 'default_helper';
//    $config['lock_uri']         = array(); // uri запрещенные к парсингу прим. '/forum/post/' не будут парситься все адреса вида '(subdomain.)donor.com/forum/post/*' 
//}
//elseif( $_SERVER['HTTP_HOST'] == 'ledi.odnako.su' ){
//    $config['donor_domain']     = 'kobieta.gazeta.pl'; //основной домен по которому работает сайт (возможно с www)
//    $config['donor_charset']    = 'iso-8859-2';
//    $config['clean_helper']     = 'default_helper'; //хелпер для очистки html
//    $config['clean_js_helper']  = 'default_js_helper'; //хелпер для очистки js
//    $config['add_helper']       = 'default_helper';
//    $config['lock_uri']         = array(); // uri запрещенные к парсингу прим. '/forum/post/' не будут парситься все адреса вида '(subdomain.)donor.com/forum/post/*' 
//}
//elseif( $_SERVER['HTTP_HOST'] == 'kanikuly.odnako.su' ){
//    $config['donor_domain']     = 'podroze.gazeta.pl'; //основной домен по которому работает сайт (возможно с www)
//    $config['donor_charset']    = 'iso-8859-2';
//    $config['clean_helper']     = 'default_helper'; //хелпер для очистки html
//    $config['clean_js_helper']  = 'default_js_helper'; //хелпер для очистки js
//    $config['add_helper']       = 'default_helper';
//    $config['lock_uri']         = array(); // uri запрещенные к парсингу прим. '/forum/post/' не будут парситься все адреса вида '(subdomain.)donor.com/forum/post/*' 
//}
//elseif( $_SERVER['HTTP_HOST'] == 'tech.odnako.su' ){
//    $config['donor_domain']     = 'technologie.gazeta.pl'; //основной домен по которому работает сайт (возможно с www)
//    $config['donor_charset']    = 'iso-8859-2';
//    $config['clean_helper']     = 'default_helper'; //хелпер для очистки html
//    $config['clean_js_helper']  = 'default_js_helper'; //хелпер для очистки js
//    $config['add_helper']       = 'default_helper';
//    $config['lock_uri']         = array(); // uri запрещенные к парсингу прим. '/forum/post/' не будут парситься все адреса вида '(subdomain.)donor.com/forum/post/*' 
//}

//============= CCTV =============//

elseif( $_SERVER['HTTP_HOST'] == 'cctv-kiev.pp.ua' ){ #cctv-camera-videonabludenie.pp.ua
    $config['donor_domain']     = 'www.kamery.pl'; //основной домен по которому работает сайт (возможно с www)
    $config['donor_charset']    = 'iso-8859-2';
    $config['clean_helper']     = 'cctv_kamery_helper'; //хелпер для очистки html
    $config['clean_js_helper']  = 'default_js_helper'; //хелпер для очистки js
    $config['add_helper']       = 'cctv_default_helper';
    $config['lock_uri']         = array(); // uri запрещенные к парсингу прим. '/forum/post/' не будут парситься все адреса вида '(subdomain.)donor.com/forum/post/*' 
}
elseif( $_SERVER['HTTP_HOST'] == 'cctv-secure.pp.ua' ){ #cctv-videonabludenie.pp.ua
    $config['donor_domain']     = 'www.ctr.pl'; //основной домен по которому работает сайт (возможно с www)
    $config['donor_charset']    = 'iso-8859-2';
    $config['clean_helper']     = 'cctv_ctr_helper'; //хелпер для очистки html
    $config['clean_js_helper']  = 'default_js_helper'; //хелпер для очистки js
    $config['add_helper']       = 'cctv_default_helper';
    $config['lock_uri']         = array('/m_kontakt.htm'); // uri запрещенные к парсингу прим. '/forum/post/' не будут парситься все адреса вида '(subdomain.)donor.com/forum/post/*' 
}
elseif( $_SERVER['HTTP_HOST'] == 'cctv-domofon.pp.ua' ){ #cctv-commax.pp.ua
    $config['donor_domain']     = 'www.e-alarmy.pl'; //основной домен по которому работает сайт (возможно с www)
    $config['donor_charset']    = 'iso-8859-2';
    $config['clean_helper']     = 'cctv_e-alarmy_helper'; //хелпер для очистки html
    $config['clean_js_helper']  = 'default_js_helper'; //хелпер для очистки js
    $config['add_helper']       = 'cctv_default_helper';
    $config['lock_uri']         = array(); // uri запрещенные к парсингу прим. '/forum/post/' не будут парситься все адреса вида '(subdomain.)donor.com/forum/post/*' 
}
elseif( $_SERVER['HTTP_HOST'] == 'cctv-pro.pp.ua' ){
    $config['donor_domain']     = 'www.aat.pl'; //основной домен по которому работает сайт (возможно с www)
    $config['donor_charset']    = 'utf-8';
    $config['clean_helper']     = 'cctv_aat_helper'; //хелпер для очистки html
    $config['clean_js_helper']  = 'default_js_helper'; //хелпер для очистки js
    $config['add_helper']       = 'cctv_default_helper';
    $config['lock_uri']         = array(); // uri запрещенные к парсингу прим. '/forum/post/' не будут парситься все адреса вида '(subdomain.)donor.com/forum/post/*'
}
elseif( $_SERVER['HTTP_HOST'] == 'cctv-alarm.pp.ua' ){
    $config['donor_domain']     = 'www.alkam-security.pl'; //основной домен по которому работает сайт (возможно с www)
    $config['donor_charset']    = 'utf-8';
    $config['clean_helper']     = 'cctv_alkam-security_helper'; //хелпер для очистки html
    $config['clean_js_helper']  = 'default_js_helper'; //хелпер для очистки js
    $config['add_helper']       = 'cctv_default_helper';
    $config['lock_uri']         = array(); // uri запрещенные к парсингу прим. '/forum/post/' не будут парситься все адреса вида '(subdomain.)donor.com/forum/post/*' 
}
elseif( $_SERVER['HTTP_HOST'] == 'cctv-kamera.pp.ua' ){
    $config['donor_domain']     = 'www.napad.pl'; //основной домен по которому работает сайт (возможно с www)
    $config['donor_charset']    = 'iso-8859-2';
    $config['clean_helper']     = 'cctv_napad_helper'; //хелпер для очистки html
    $config['clean_js_helper']  = 'default_js_helper'; //хелпер для очистки js
    $config['add_helper']       = 'cctv_default_helper';
    $config['lock_uri']         = array(); // uri запрещенные к парсингу прим. '/forum/post/' не будут парситься все адреса вида '(subdomain.)donor.com/forum/post/*' 
}
elseif( $_SERVER['HTTP_HOST'] == 'cctv-cam.pp.ua' ){ #cctv-dvr-videonabludenie.pp.ua
    $config['donor_domain']     = 'www.obserwuj.pl'; //основной домен по которому работает сайт (возможно с www)
    $config['donor_charset']    = 'utf-8';
    $config['clean_helper']     = 'cctv_obserwuj_helper'; //хелпер для очистки html
    $config['clean_js_helper']  = 'default_js_helper'; //хелпер для очистки js
    $config['add_helper']       = 'cctv_default_helper';
    $config['lock_uri']         = array(); // uri запрещенные к парсингу прим. '/forum/post/' не будут парситься все адреса вида '(subdomain.)donor.com/forum/post/*' 
}
elseif( $_SERVER['HTTP_HOST'] == 'cctv-camera.pp.ua' ){ #cctv-dahua.pp.ua
    $config['donor_domain']     = 'www.monitoring-system.pl'; //основной домен по которому работает сайт (возможно с www)
    $config['donor_charset']    = 'utf-8';
    $config['clean_helper']     = 'cctv_monitoring_system_helper'; //хелпер для очистки html
    $config['clean_js_helper']  = 'default_js_helper'; //хелпер для очистки js
    $config['add_helper']       = 'cctv_default_helper';
    $config['lock_uri']         = array(); // uri запрещенные к парсингу прим. '/forum/post/' не будут парситься все адреса вида '(subdomain.)donor.com/forum/post/*' 
}
elseif( $_SERVER['HTTP_HOST'] == 'cctv-dvr-cam.pp.ua' ){ #cctv-luxcam.pp.ua
    $config['donor_domain']     = 'www.mdh-system.pl'; //основной домен по которому работает сайт (возможно с www)
    $config['donor_charset']    = 'utf-8';
    $config['clean_helper']     = 'cctv_mdh_system_helper'; //хелпер для очистки html
    $config['clean_js_helper']  = 'default_js_helper'; //хелпер для очистки js
    $config['add_helper']       = 'cctv_default_helper';
    $config['lock_uri']         = array(); // uri запрещенные к парсингу прим. '/forum/post/' не будут парситься все адреса вида '(subdomain.)donor.com/forum/post/*' 
}

else show_404();


//$redirect_ar = array(
//    'budujemydom.tisbi.org'     => 'strojdom.odnako.su',
//    'poradnikzdrowie.tisbi.org' => 'nebolej.odnako.su',
//    'podroze.tisbi.org'         => 'puteshestvie.odnako.su',
//    'tablety.tisbi.org'         => 'planshet.odnako.su',
//    'ladnydom.tisbi.org'        => 'horoshij-dom.odnako.su',
//    'poradnikdomowy.tisbi.org'  => 'sovetchik.odnako.su',
//    'urzadzamy.tisbi.org'       => 'interer.odnako.su',
//    'czterykaty.tisbi.org'      => 'interior-design.odnako.su',
//    'muratorplus.tisbi.org'     => 'stroimsa.odnako.su',
//    'e-ogrody.tisbi.org'        => 'sad.odnako.su',
//    'superauto24.tisbi.org'     => 'auto24.odnako.su',
//    'wysokieobcasy.tisbi.org'   => 'nakablukah.odnako.su',
//    'domosfera.tisbi.org'       => 'domosfera.odnako.su',
//    'zdrowie.tisbi.org'         => 'zdorovie.odnako.su', //ga
//    'kobieta.tisbi.org'         => 'ledi.odnako.su',
//    'podroze-gazeta.tisbi.org'  => 'kanikuly.odnako.su',
//    'technologie.tisbi.org'     => 'tech.odnako.su',
//    'wieszjak.tisbi.org'        => 'obovsem.odnako.su'
//);
//
//
//if( isset( $redirect_ar[$_SERVER['HTTP_HOST']] ) ){
//    $new_domain = $redirect_ar[$_SERVER['HTTP_HOST']];
//    
//    $new_url = 'http://'.$new_domain.$_SERVER['REQUEST_URI'];
//    
//    header("HTTP/1.1 301 Moved Permanently");
//    header("Location: ".$new_url);
//    exit();
//}

