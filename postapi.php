<?php
$url = 'https://auth.exacttargetapis.com/v1/requestToken';
$data = array('clientId' => 'zgh8tcukhua4ph63fju66ayt', 'clientSecret' => 'q5BeE2Aw4PZb662XUz3SYzf8');

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/json",
        'method'  => 'POST',
        'content' => http_build_query($data),
    ),
);
$context  = stream_context_create($options);

$result = file_get_contents($url, false, $context);

print_r($result);

?>