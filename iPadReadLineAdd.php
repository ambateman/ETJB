<?php
/*
 * This file just reads a csv text file and extracts the bits.
 */

require('ET_Client.php');
$myclient = new ET_Client();

$filename = 'withfirstname.txt';

$newsubscriber="true";
$row = 0;
$rowcount=0;
if (($handle = fopen($filename, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        $rowcount++;
        echo "<p> $num fields in line $row: with rowcount: $rowcount <br /></p>\n";
        $row++;
        $uuid=$data[0];    
        $emvalue=$data[1];
        $fname=$data[2];
        $time=$data[3];
        $UsediPad=true;
        $sep="@";
        $emarray=explode($sep,$emvalue,2);
        $emvalue="F00yRow".$row.$sep."janrain.com";
        echo "emvalue: ".$emvalue;
          
        	$deRow=new ET_DataExtension_Row();
        	$deRow->authStub=$myclient;
			//Specify the name of the data extension
			$deRow->CustomerKey = "E0F40D76-C623-402B-9BAC-8450B1DA87A9";
			//specifiy the values of the data extension row
			$deRow->props = array("UUID"=>$uuid,"EmailAddress"=>$emvalue,"FirstName"=>$fname,
			"TimeStamp"=>$time,"UsediPad"=>'true'
			);
       
    $response = $deRow->post();
    print_r($response);
	print("<br/>"); 

	
    }
    fclose($handle);
}
?>