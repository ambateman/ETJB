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
	$emvalue="bateman.tony@gmail.com";
	$fname="Toni";
	$lname="Bateman";
	$flname="Toni Bateman";
	$newsubscriber="true";
	$deRow=new ET_DataExtension_Row();
	$deRow->authStub=$myclient;
	//Specify the name of the data extension
	$deRow->CustomerKey = "subscribers";
	//specifiy the values of the data extension row
	$deRow->props = array("EmailAddress"=>$emvalue,"FirstName"=>$fname,"LastName"=>$lname,"FullName"=>$flname,"IsNewSubscriber"=>$newsubscriber);
	$response = $deRow->post();
	
	
	
	print_r($response);
	
?>
	