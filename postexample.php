<?php
// Create map with request parameters
$params = array ('clientId' => 'zgh8tcukhua4ph63fju66ayt', 'clientSecret' => 'q5BeE2Aw4PZb662XUz3SYzf8');
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
print_r($result);





 
// Server response is now stored in $result variable so you can process it
?>