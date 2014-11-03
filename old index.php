<?php
	require('ET_Client.php');
	$myclient = new ET_Client();
	//echo "So Far, so good";
	
	/* this remmed block is for adding a single subsciber email to a list
	 * It works pretty well, but it's a single email.
	 
	//method way
	$emvalue="ParisRoxanne@tempusinateapot.net";
	$authStub = $myclient;
	$objType = "Subscriber";
	$props=array("EmailAddress"=>$emvalue,"SubscriberKey"=>$emvalue, "Lists"=>array("ID"=>1729));
	$response=new ET_Post($authStub,$objType,$props);
	//the next line is the 'sugar' way -- it works, but complains.
	//$response = $myclient->AddSubscriberToList(array("peggyp@tempusinateapot.net"), array(1729));
	print_r($response);
	*/
	
	/*this is the data extension example used in the book.
	 * It SHOULD work.
	 */
	$emvalue="tbateman@janrain.com";//@janrain.com";
	$fname="Anthony";
	$lname="Bateman";
	$ts="2014-10-26T00:09:22Z";
	$newsubscriber="true";
	$deRow=new ET_DataExtension_Row();
	$deRow->authStub=$myclient;
	$usedipad = "false";
	//Specify the name of the data extension
	$deRow->CustomerKey = "subscribers";//E0F40D76-C623-402B-9BAC-8450B1DA87A9";
	//specifiy the values of the data extension row
	$deRow->props = array("EmailAddress"=>$emvalue,"UUID"=>"E0F40D76-C623-402B-9BAC-8450B1DA87A9",
	"TimeStamp"=>$ts,"FirstName"=>$fname,"IsNewSubscriber"=>$newsubscriber,"UsediPad"=>$usedipad);
	$response = $deRow->post();
	
	print_r($response);
	
?>
	