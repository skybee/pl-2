<?php


class bing_translate_lib{
    
    function get_translate($html){
        
        $html = '<html><body><h1>Bezprzewodowy monitoring IP dużych powierzchni</h1><p>Po dokładnym przeanalizowaniu nagrań z kamer znajdujących się w pobliżu okazało się, że w zdarzeniu brały również osoby trzecie, które wepchnęły mężczyznę do wody.</p></body></html>';
        
        //Client ID of the application.
        $clientID       = "hcpl";
        //Client Secret key of the application.
        $clientSecret = "ONl+7Ht7PBDonR+vW+tecjlnZy11Ve5nY/m5XRSAHQc=";
        //OAuth Url.
        $authUrl      = "https://datamarket.accesscontrol.windows.net/v2/OAuth2-13/";
        //Application Scope Url
        $scopeUrl     = "http://api.microsofttranslator.com";
        //Application grant type
        $grantType    = "client_credentials";

        //Create the AccessTokenAuthentication object.
        $authObj      = new AccessTokenAuthentication();
        //Get the Access token.
        $accessToken  = $authObj->getTokens($grantType, $scopeUrl, $clientID, $clientSecret, $authUrl);
        //Create the authorization Header string.
        $authHeader = "Authorization: Bearer ". $accessToken;

        //Set the params.//
        $fromLanguage = "pl";
        $toLanguage   = "ru";
        $inputStrArr  = array( $html );
        $contentType  = 'text/html';
        //Create the Translator Object.
        $translatorObj = new HTTPTranslator();

        //Get the Request XML Format.
        $requestXml = $translatorObj->createReqXML($fromLanguage,$toLanguage,$contentType,$inputStrArr);

        //HTTP TranslateMenthod URL.
        $translateUrl = "http://api.microsofttranslator.com/v2/Http.svc/TranslateArray";

        //Call HTTP Curl Request.
        $curlResponse = $translatorObj->curlRequest($translateUrl, $authHeader, $requestXml);

        //Interprets a string of XML into an object.
        $xmlObj = simplexml_load_string($curlResponse);
        $i=0;
        echo "<table border=2px>";
        echo "<tr>";
        echo "<td><b>From $fromLanguage</b></td><td><b>To $toLanguage</b></td>";
        echo "</tr>";
        foreach($xmlObj->TranslateArrayResponse as $translatedArrObj){
            echo "<tr><td>".$inputStrArr[$i]."</td><td>". $translatedArrObj->TranslatedText."</td></tr>";
            $i++;
        }
        echo "</table>";
    }
}


class AccessTokenAuthentication {
    /*
     * Get the access token.
     *
     * @param string $grantType    Grant type.
     * @param string $scopeUrl     Application Scope URL.
     * @param string $clientID     Application client ID.
     * @param string $clientSecret Application client ID.
     * @param string $authUrl      Oauth Url.
     *
     * @return string.
     */
    function getTokens($grantType, $scopeUrl, $clientID, $clientSecret, $authUrl){
        try {
            //Initialize the Curl Session.
            $ch = curl_init();
            //Create the request Array.
            $paramArr = array (
                 'grant_type'    => $grantType,
                 'scope'         => $scopeUrl,
                 'client_id'     => $clientID,
                 'client_secret' => $clientSecret
            );
            //Create an Http Query.//
            $paramArr = http_build_query($paramArr);
            //Set the Curl URL.
            curl_setopt($ch, CURLOPT_URL, $authUrl);
            //Set HTTP POST Request.
            curl_setopt($ch, CURLOPT_POST, TRUE);
            //Set data to POST in HTTP "POST" Operation.
            curl_setopt($ch, CURLOPT_POSTFIELDS, $paramArr);
            //CURLOPT_RETURNTRANSFER- TRUE to return the transfer as a string of the return value of curl_exec().
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, TRUE);
            //CURLOPT_SSL_VERIFYPEER- Set FALSE to stop cURL from verifying the peer's certificate.
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            //Execute the  cURL session.
            $strResponse = curl_exec($ch);
            //Get the Error Code returned by Curl.
            $curlErrno = curl_errno($ch);
            if($curlErrno){
                $curlError = curl_error($ch);
                throw new Exception($curlError);
            }
            //Close the Curl Session.
            curl_close($ch);
            //Decode the returned JSON string.
            $objResponse = json_decode($strResponse);
            if ($objResponse->error){
                throw new Exception($objResponse->error_description);
            }
            return $objResponse->access_token;
        } catch (Exception $e) {
            echo "Exception-".$e->getMessage();
        }
    }
}


Class HTTPTranslator {
    /*
     * Create and execute the HTTP CURL request.
     *
     * @param string $url        HTTP Url.
     * @param string $authHeader Authorization Header string.
     * @param string $postData   Data to post.
     *
     * @return string.
     *
     */
    function curlRequest($url, $authHeader, $postData=''){
        //Initialize the Curl Session.
        $ch = curl_init();
        //Set the Curl url.
        curl_setopt ($ch, CURLOPT_URL, $url);
        //Set the HTTP HEADER Fields.
        curl_setopt ($ch, CURLOPT_HTTPHEADER, array($authHeader,"Content-Type: text/xml"));
        //CURLOPT_RETURNTRANSFER- TRUE to return the transfer as a string of the return value of curl_exec().
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, TRUE);
        //CURLOPT_SSL_VERIFYPEER- Set FALSE to stop cURL from verifying the peer's certificate.
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, False);
        if($postData) {
            //Set HTTP POST Request.
            curl_setopt($ch, CURLOPT_POST, TRUE);
            //Set data to POST in HTTP "POST" Operation.
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        }
        //Execute the  cURL session.
        $curlResponse = curl_exec($ch);
        //Get the Error Code returned by Curl.
        $curlErrno = curl_errno($ch);
        if ($curlErrno) {
            $curlError = curl_error($ch);
            throw new Exception($curlError);
        }
        //Close a cURL session.
        curl_close($ch);
        return $curlResponse;
    }


    /*
     * Create Request XML Format.
     *
     * @param string $fromLanguage   Source language Code.
     * @param string $toLanguage     Target language Code.
     * @param string $contentType    Content Type.
     * @param string $inputStrArr    Input String Array.
     *
     * @return string.
     */
    function createReqXML($fromLanguage,$toLanguage,$contentType,$inputStrArr) {
        //Create the XML string for passing the values.
        $requestXml = "<TranslateArrayRequest>".
            "<AppId/>".
            "<From>$fromLanguage</From>". 
            "<Options>" .
             "<Category xmlns=\"http://schemas.datacontract.org/2004/07/Microsoft.MT.Web.Service.V2\" />" .
              "<ContentType xmlns=\"http://schemas.datacontract.org/2004/07/Microsoft.MT.Web.Service.V2\">$contentType</ContentType>" .
              "<ReservedFlags xmlns=\"http://schemas.datacontract.org/2004/07/Microsoft.MT.Web.Service.V2\" />" .
              "<State xmlns=\"http://schemas.datacontract.org/2004/07/Microsoft.MT.Web.Service.V2\" />" .
              "<Uri xmlns=\"http://schemas.datacontract.org/2004/07/Microsoft.MT.Web.Service.V2\" />" .
              "<User xmlns=\"http://schemas.datacontract.org/2004/07/Microsoft.MT.Web.Service.V2\" />" .
            "</Options>" .
            "<Texts>";
        foreach ($inputStrArr as $inputStr)
        $requestXml .=  "<string xmlns=\"http://schemas.microsoft.com/2003/10/Serialization/Arrays\">$inputStr</string>" ;
        $requestXml .= "</Texts>".
            "<To>$toLanguage</To>" .
          "</TranslateArrayRequest>";
        return $requestXml;
    }
}

//try {
//    //Client ID of the application.
//    $clientID       = "hcpl";
//    //Client Secret key of the application.
//    $clientSecret = "ONl+7Ht7PBDonR+vW+tecjlnZy11Ve5nY/m5XRSAHQc=";
//    //OAuth Url.
//    $authUrl      = "https://datamarket.accesscontrol.windows.net/v2/OAuth2-13/";
//    //Application Scope Url
//    $scopeUrl     = "http://api.microsofttranslator.com";
//    //Application grant type
//    $grantType    = "client_credentials";
//
//    //Create the AccessTokenAuthentication object.
//    $authObj      = new AccessTokenAuthentication();
//    //Get the Access token.
//    $accessToken  = $authObj->getTokens($grantType, $scopeUrl, $clientID, $clientSecret, $authUrl);
//    //Create the authorization Header string.
//    $authHeader = "Authorization: Bearer ". $accessToken;
//
//    //Set the params.//
//    $fromLanguage = "ru";
//    $toLanguage   = "en";
//    $inputStrArr  = array("Идем в кино");
//    $contentType  = 'text/plain';
//    //Create the Translator Object.
//    $translatorObj = new HTTPTranslator();
//
//    //Get the Request XML Format.
//    $requestXml = $translatorObj->createReqXML($fromLanguage,$toLanguage,$contentType,$inputStrArr);
//
//    //HTTP TranslateMenthod URL.
//    $translateUrl = "http://api.microsofttranslator.com/v2/Http.svc/TranslateArray";
//
//    //Call HTTP Curl Request.
//    $curlResponse = $translatorObj->curlRequest($translateUrl, $authHeader, $requestXml);
//
//    //Interprets a string of XML into an object.
//    $xmlObj = simplexml_load_string($curlResponse);
//    $i=0;
//    echo "<table border=2px>";
//    echo "<tr>";
//    echo "<td><b>From $fromLanguage</b></td><td><b>To $toLanguage</b></td>";
//    echo "</tr>";
//    foreach($xmlObj->TranslateArrayResponse as $translatedArrObj){
//        echo "<tr><td>".$inputStrArr[$i]."</td><td>". $translatedArrObj->TranslatedText."</td></tr>";
//        $i++;
//    }
//    echo "</table>";
//} catch (Exception $e) {
//    echo "Exception: " . $e->getMessage() . PHP_EOL;
//}