<?php
/*
 * The purpose of this php file is to obtain a new token value from
 * exacttarget. It is coded to use just a single application, so 
 * alter the $cliendId and the $clientSecret accordingly if you change.
 */
// Create map with request parameters
$clientId = 'm7gqqftrywz9ug4g5vb6cp52';
$clientSecret = '2FWwseHzNXx2AzzPEZKqxkkT';
$params = array ('clientId' => $clientId,'clientSecret' => $clientSecret);

$url = 'https://auth.exacttargetapis.com/v1/requestToken';

// Build Http query using params
$query = http_build_query ($params);
 
// Create Http context details
$contextData = array ( 
                'method' => 'POST',
                'header' => "Connection: close\r\n".
							"Content-type: application/x-www-form-urlencoded\r\n".
                            "Content-Length: ".strlen($query)."\r\n",
                'content'=> $query );
 
// Create context resource for our request
$context = stream_context_create (array ( 'http' => $contextData ));
 
$result =  file_get_contents (
                  $url,  
                  false,
                  $context);
$jsonresult = json_decode($result);
$token = $jsonresult->accessToken;
print_r("the token: ".$token);
return $token;

?>