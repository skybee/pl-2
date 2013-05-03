var keyStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";

function decode64(input) {
    var output = "";
    var chr1, chr2, chr3 = "";
    var enc1, enc2, enc3, enc4 = "";
    var i = 0;

    // remove all characters that are not A-Z, a-z, 0-9, +, /, or =
    var base64test = /[^A-Za-z0-9\+\/\=]/g;
    if (base64test.exec(input)) {
        ajax_verify();
    }
    input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

    do {
        enc1 = keyStr.indexOf(input.charAt(i++));
        enc2 = keyStr.indexOf(input.charAt(i++));
        enc3 = keyStr.indexOf(input.charAt(i++));
        enc4 = keyStr.indexOf(input.charAt(i++));

        chr1 = (enc1 << 2) | (enc2 >> 4);
        chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
        chr3 = ((enc3 & 3) << 6) | enc4;

        output = output + String.fromCharCode(chr1);

        if (enc3 != 64) {
            output = output + String.fromCharCode(chr2);
        }
        if (enc4 != 64) {
            output = output + String.fromCharCode(chr3);
        }

        chr1 = chr2 = chr3 = "";
        enc1 = enc2 = enc3 = enc4 = "";

    } while (i < input.length);

    return unescape(output);
}

var PIANO_COOKIE_DURATION = 8 * 60 * 60
var PIANO_COOKIE_NAME = 'murator_verify'
var PIANO_THEIR_COOKIE_NAME = 'piano_unique_key'

function piano_verify_check(){
    var piano_unique_key = get_cookie(PIANO_THEIR_COOKIE_NAME);
    var piano_verify_cookie = get_cookie(PIANO_COOKIE_NAME);

    if(piano_unique_key){
        if(piano_verify_cookie){
            piano_verify = decode64(piano_verify_cookie);
            piano_verify_list = piano_verify.split(";");
            puk = piano_verify_list[0];
            timestamp = parseInt(piano_verify_list[1], 10);
            if(puk != piano_unique_key || timestamp + PIANO_COOKIE_DURATION < parseInt(new Date().getTime() / 1000, 10)){
                ajax_verify();
            }
        }
        else {
            ajax_verify();
        }
    }
    else {
        if(piano_verify_cookie){
            delete_cookie(PIANO_COOKIE_NAME);
            document.location.reload(true);
        }
    }
}

function ajax_verify(){
    var request;
    request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        if (request.readyState == 4 && request.status == 200){
            response = request.response;
            document.location.reload(true);
        }
    };
    request.open("POST", "/piano/verify.html", true);
    //request.setRequestHeader("X-CSRFToken", get_cookie('csrftoken'));
    //request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    request.send();
}


function get_cookie(name){
    name = name + "=";
    var val = null;
    var carray = document.cookie.split(';');
    for(var i = 0; i < carray.length; i++){
        var c=carray[i];
        while(c.charAt(0) == ' ')
            c=c.substring(1,c.length);
        if (c.indexOf(name) == 0)
            return c.substring(name.length, c.length);
    }
    return val;
}

function delete_cookie(name){
    document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/;';
}

var readyStateCheckInterval = setInterval(function() {
    if (document.readyState === "complete") {
        piano_verify_check();
        clearInterval(readyStateCheckInterval);
    }
}, 10);
