<?php
// Strip out any leading http:// or https:// 
// if other protocols such as ftp are present, 
// the intention is they'll fail regex further down

$url = trim(get_input('url'));

if (stripos($url, 'https://') === 0)
{
    $url = substr($url, 8);
    $portno = 443;
}
else
{ 
  if (stripos($url, 'http://') === 0)
  {
    $url = substr($url, 7);
  }
  $portno = 80;
}
// Get the string index of the first forward slash
// if there is none, add one at the end
$slashIdx = strpos($url, '/');
if ($slashIdx === false) {
    $slashIdx = strlen($url);
    $url .= '/';
}

 //$regex_expression = '_^(?:(?:https?|ftp)://)(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\x{00a1}-\x{ffff}0-9]-*)*[a-z\x{00a1}-\x{ffff}0-9]+)(?:\.(?:[a-z\x{00a1}-\x{ffff}0-9]-*)*[a-z\x{00a1}-\x{ffff}0-9]+)*(?:\.(?:[a-z\x{00a1}-\x{ffff}]{2,})))(?::\d{2,5})?(?:/\S*)?$_iuS';

  $regex_expression = '_^(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\x{00a1}-\x{ffff}0-9]-*)*[a-z\x{00a1}-\x{ffff}0-9]+)(?:\.(?:[a-z\x{00a1}-\x{ffff}0-9]-*)*[a-z\x{00a1}-\x{ffff}0-9]+)*(?:\.(?:[a-z\x{00a1}-\x{ffff}]{2,})))(?::\d{2,5})?(?:/\S*)?$_iuS';
// Regex validation of URL string

if (!preg_match($regex_expression, $url))
    $result = '20 invalid URL string';
else {
    //echo '<result><status>' . $url . ' | OK</status></result>';
    
    // Prepare for fsocketopen call
    // Split the URL into domain and path
    $domain = substr($url, 0, $slashIdx);
    $path   = substr($url, $slashIdx);
    //error_log('domain = ' . $domain);
    //error_log('path = ' . $path);
    $method = "HEAD"; // HEAD request is more efficient
    $http_response = "";
    $http_request = $method ." ". $path ." HTTP/1.1\r\n";
    $http_request .= "Host: ".$domain."\r\n";
    $http_request .= "User-Agent: Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0)\r\n\r\n";
 
    if ($portno == 443)
        $domain = 'tls://' . $domain;
    
    // Attempt to connect to this domain
    $fp = @fsockopen($domain, $portno, $errno, $errstr);
    if ($fp) {    
        fputs($fp, $http_request);
        
        // Read first 64 bytes of response
        $http_response = fgets($fp, 64);    
        fclose($fp);
 
        // regex out the HTTP status code
        // then validate whether the code is a 200 OK or 301/302 redirect
        preg_match('/HTTP\/\d\.\d (\d{3})/', $http_response, $matches);
        if (in_array(intval($matches[1]), array(200, 301, 302)))
            $result = '10 valid - ' . $http_response . '; ' . $domain  . '; ' . $portno;
        else
            $result = '30 http error - ' . $http_response . '; ' . $domain  . '; ' . $portno;
    }
    else 
        $result = '40 unknown host: ' . $errstr;
}

echo '<result><status>' . $result . '</status></result>';