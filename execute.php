<?php
// Create map with request parameters
$clientId = 'm7gqqftrywz9ug4g5vb6cp52';
$clientSecrect = '2FWwseHzNXx2AzzPEZKqxkkT';
$ev="CONTACT-EVENT-161b2170-c19a-1aac-0527-cc37a3468076";

$params = array ('clientId' => $clientId,'clientSecret' => $clientSecrect);
$url = 'https://auth.exacttargetapis.com/v1/requestToken';
//$data = array('clientId' => 'zgh8tcukhua4ph63fju66ayt', 'clientSecret' => 'q5BeE2Aw4PZb662XUz3SYzf8');

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
 
// Read page rendered as result of your POST request
$result =  file_get_contents (
                  $url,  
                  false,
                  $context);
//print_r($result."\r\n");
$jsonresult = json_decode($result);
$token = $jsonresult->accessToken;
print_r("the token: ".$token);

return $token;

















// Create map with request parameters
$clientId = 'm7gqqftrywz9ug4g5vb6cp52';
$clientSecrect = '2FWwseHzNXx2AzzPEZKqxkkT';
$em = "tmbateman@hotmail.com";

$params = array ('ContactKey' => $em,'EmailAddress' => $em, 'Event'=>jljlj);
$url = 'https://auth.exacttargetapis.com/v1/requestToken';
//$data = array('clientId' => 'zgh8tcukhua4ph63fju66ayt', 'clientSecret' => 'q5BeE2Aw4PZb662XUz3SYzf8');

// Build Http query using params
$query = http_build_query ($params);
 
// Create Http context details
$contextData = array ( 
                'method' => 'POST',
                'header' => "Connection: close\r\n".
							"Authorization: Bearer 6nm8mtnh74mh58sj39fb9yvd\r\n".
							"Content-type: application/json\r\n".
                            "Content-Length: ".strlen($query)."\r\n",
                'content'=> $query );
 
// Create context resource for our request
$context = stream_context_create (array ( 'http' => $contextData ));
 
// Read page rendered as result of your POST request
$result =  file_get_contents (
                  $url,  
                  false,
                  $context);
//print_r($result."\r\n");
$jsonresult = json_decode($result);
$token = $jsonresult->accessToken;
print_r("the token: ".$token);

return $token;
 
 
// Server response is now stored in $result variable so you can process it
?>