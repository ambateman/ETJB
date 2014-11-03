<?php
/*
 * This file just reads a csv text file and extracts the bits.
 */

require('ET_Client.php');
$myclient = new ET_Client();

$filename = 'updatedList4.csv';
$emvalue="";
$fname="";
$flname="";
$lname="";
$fieldname="";
$fieldNew="";
$fieldOld="";
$relationshipNew="";
$relationshipOld="";
$cityNew="";
$cityOld="";
$countryNew="";
$countryOld="";
$zipNew="";
$zipOld="";

$newsubscriber="true";
$row = 0;
$rowcount=0;
$olduuid=0;  //initialize UUID. Use this to decide how to pack the DE named JanrainDemo
if (($handle = fopen($filename, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        $rowcount++;
        echo "<p> $num fields in line $row: with rowcount: $rowcount <br /></p>\n";
        $row++;
        $uuid=$data[0];
        
        if($olduuid == 0){
        	$olduuid=$uuid;	
        }
        
        if($olduuid != $uuid and $rowcount>3){
        	$deRow=new ET_DataExtension_Row();
        	$deRow->authStub=$myclient;
			//Specify the name of the data extension
			$deRow->CustomerKey = "E0F40D76-C623-402B-9BAC-8450B1DA87A9";
			//specifiy the values of the data extension row
			$deRow->props = array("UUID"=>$uuid,"EmailAddress"=>$emvalue,"FirstName"=>$fname,"LastName"=>$lname,"FullName"=>$flname,"IsNewSubscriber"=>$newsubscriber,
			"RelationshipNew"=>$relationshipNew,"RelationshipOld"=>$relationshipOld,
			"CityNew"=>$cityNew,"CityOld"=>$cityOld,
			"CountryNew"=>$countryNew,"CountryOld"=>$countryOld,
			"PostalCodeNew"=>$zipNew,"PostalCodeOld"=>$zipOld
			);
			if($relationshipNew=="Engaged" || $relationshipNew=="Married"){  //an extra filter
           	 	$response = $deRow->post();
   			 	print_r($response);
				print("<br/>"); 
				}
			 $olduuid=$uuid;  
			 echo "Rowcount: ".$rowcount."<br/>";
			 $rowcount=0; 
			 $emvalue="";
			 $fname="";
			$flname="";
			$lname="";
			$fieldname="";
			$fieldNew="";
			$fieldOld="";
			$relationshipNew="";
			$relationshipOld="";
			$cityNew="";
			$cityOld="";
			$countryNew="";
			$countryOld="";
			$zipNew="";
			$zipOld="";
			 		 
        }
        
        	for ($c=0; $c < $num; $c++) {

        		//$uuid = $data[1];
        		$emvalue="Row".$row.$data[1];
        		if($data[2] !=null) $fname=$data[2];
        		if($data[5] !=null) $fieldname=$data[5];
        		
        		Switch ($fieldname){			
        			Case "city":
        				if($data[6] != null) $cityNew=$data[6];
        				if($data[7] != null) $cityOld=$data[7];
        				break;	
        			Case "country":
        		 		if($data[6] != null) $countryNew=$data[6];
        				if($data[7] != null) $countryOld=$data[7];
        				break;     		
        			Case "zip":
        		    	if($data[6] != null) $zipNew=$data[6];
        				if($data[7] != null) $zipOld=$data[7];
        				break;     		
        			Case "relationship":
        		    	if($data[6] != null) $relationshipNew=$data[6];
        				if($data[7] != null) $relationshipOld=$data[7];
        				break;   		  		
        			Default:
        				break; 		
        		}//end of switch
        	}
        
   /*     
    $response = $deRow->post();
    print_r($response);
	print("<br/>"); 
	*/
	
    }
    fclose($handle);
}
?>