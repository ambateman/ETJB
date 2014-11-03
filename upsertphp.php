<?php
/*
 * The purpose of this php code is alter or add row entries in an
 * exacttarget data extension. Because it takes a little bit longer to
 * add rows this way (because it has to handle referential integrity 
 * duties as well), it is not recommended for bulk data transfers.
 */


$tkn = include 'token.php';
$EventDefinitionKey= "key:subscribers";

//$EventDefinitionKey = "CONTACT-EVENT-dcd8ab12-0d65-45f8-4eb4-d1b605e78800";
//$header1="Authorization: Bearer".$token."\r\n";
$header2="Content-Type: application/json\r\n";
$lname="Long";
//$UsediPad='false';
$UsediPad="true";
$emaddress="tmbateman@hotmail.com";
$token= $tkn; //"susqp7df6vj5v3znmxbq8x2k";
$cdf="key:subscribers";

$url="https://www.exacttargetapis.com/hub/v1/dataevents/".$cdf."/rows/EmailAddress:".$emaddress;
//$url="https://www.exacttargetapis.com/hub/v1/dataevents/key:subscribers/rows/EmailAddress:tbateman@janrain.com";

//populate the following string to send the right data to fire the event.
$jsonarray=array("values"=>array("FirstName"=>"Super Mario","UsediPad"=>$UsediPad));
$pkge=json_encode($jsonarray);

//The php curl instructions. Not sure all of them are necessary, but I'm not going
//to experiment.
    $ch = curl_init();  
    curl_setopt($ch,CURLOPT_URL,$url);
   // curl_setopt($ch,CURLOPT_PUT,true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
    curl_setopt($ch,CURLOPT_HTTPHEADER, array("Content-type: application/json","Authorization: Bearer " .$token));
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_HEADER, false); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, $pkge);    
	echo "package: $pkge<br/>";
	$output=curl_exec($ch);
	echo "$output<br/>";
	curl_close($ch);
	echo "package 2: $pkge<br/>";
	
	

?>