<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* Приведение ссылки к абсолютному URI
*
* @param string $link ссылка (абсолютный URI, абсолютный путь на сайте, относительный путь)
* @param string $base базовый URI (можно без "http://")
* @return string абсолютный URI ссылки
*/

function uri2absolute($link, $base){
        if (!preg_match('~^(http://[^/?#]+)?([^?#]*)?(\?[^#]*)?(#.*)?$~i', $link.'#', $matchesLink)) {
            return false;
        }
        if (!empty($matchesLink[1])) {
            return $link;
        }
        if (!preg_match('~^(http://)?([^/?#]+)(/[^?#]*)?(\?[^#]*)?(#.*)?$~i', $base.'#', $matchesBase)) {
            return false;
        }
        if (empty($matchesLink[2])) {
        if (empty($matchesLink[3])) {
            return 'http://'.$matchesBase[2].$matchesBase[3].$matchesBase[4];;
        }
        return 'http://'.$matchesBase[2].$matchesBase[3].$matchesLink[3];
        }
        $pathLink = explode('/', $matchesLink[2]);
        if ($pathLink[0] == '') {
            return 'http://'.$matchesBase[2].$matchesLink[2].$matchesLink[3];
        }
        $pathBase = explode('/', preg_replace('~^/~', '', $matchesBase[3]));
        if (sizeOf($pathBase) > 0) {
            array_pop($pathBase);
        }
        foreach ($pathLink as $p) {
            if ($p == '.') {
        continue;
        } elseif ($p == '..') {
        if (sizeOf($pathBase) > 0) {
        array_pop($pathBase);
        }
        } else {
        array_push($pathBase, $p);
        }
        }
        return 'http://'.$matchesBase[2].'/'.implode('/', $pathBase).$matchesLink[3];
    }