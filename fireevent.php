<?php
/*
 * The purpose of this php code is to fire an event in exacttarget.
 * The only two fields it requires to accomplish this is the subscriber/contact
 * email address and the name of the trigger (the contact-event key). I am passing the 
 * name of the event trigger as a courtesy. I don't yet have a use for it.
 * 
 * For testing purposes, I have a page with a form on it that calls this php. Since
 * w3c is still futzing around with adding json as a content type to forms, I am
 * adding code that will parse the body in different ways (json and the regular 
 * 'Content-Type: application/x-www-form-urlencoded')
 */

//The first thing that happens is that we check for the token:

$token = include 'token.php';
$headervalues=array();

/*
 * Capture the header parameters in an associative array so 
 * that we can use the values to make decisions. The value most
 * of interest is the content-type. We need to know if this is a json
 * body or not.
 */
foreach (getallheaders() as $name => $value) {
	//echo "$name: $value<br/>";
	$headervalues[$name]=$value;
	}
	$ct=$headervalues["Content-Type"];

//Next read the body of the post and get event def key and email address
//This first part finds the trigger name and key in the request body.
$body = @file_get_contents('php://input');

if (strpos($ct,'json') !== false) { //if this is a json content type...
    /*
     * handle the body of the http request as a json.
     */
}else { //this is the content type that is no json (most likely 
	print_r($body);
	$bodyparts=explode("&",$body);
	$tn = explode("=",$bodyparts[0]); //$triggername = explode("=",$bodyparts[0])[1];  <-works on my site...
	$eck=explode("=",$bodyparts[1]);
	$Eventcontactkey = $eck[1];
	$ea=explode("=",$bodyparts[2]);
	$emailadd=$ea[1];
	$triggername = str_replace("+"," ",$tn[1]);
	$emailadd=str_replace("%40", "@", $emailadd);
	
}


//add error trapping later
$contacteventkey=$Eventcontactkey;

//file_get_contents can do a POST, create a context for that first:
$url= "https://www.exacttargetapis.com/interaction-experimental/v1/events";

//populate the following string to send the right data to fire the event.
$jsonarray=array("ContactKey"=>$emailadd,"EventDefinitionKey"=>$contacteventkey,
				 "Data"=>array("EmailAddress"=>$emailadd));
$pkge=json_encode($jsonarray);

//The php curl instructions. Not sure all of them are necessary, but I'm not going
//to experiment.
    $ch = curl_init();  
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_POST,true);
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
    curl_setopt($ch,CURLOPT_HTTPHEADER, array("Content-Type:application/json","Authorization: Bearer " .$token));
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_HEADER, false); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, $pkge);    

	$output=curl_exec($ch);
	echo "Result: $output<br/>";
	curl_close($ch);

?>