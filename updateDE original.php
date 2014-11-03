<?php
require('exacttarget_soap_client.php');
$wsdl = 'https://webservice.exacttarget.com/etframework.wsdl';
try{
       /* Create the Soap Client */
       $client = new ExactTargetSoapClient($wsdl, array('trace'=>1));
        /* Set username and password here */
        $client->username = 'username';
        $client->password = 'password';
    
        $DE = new ExactTarget_DataExtensionObject();
        $DE->CustomerKey="UpdateTest_Key";  //Same as external key in user interface
    
     /*Update can happen only if you have PrimaryKey column.IN this Example PhoneNumber
     											is primary Key in DataExtension*/ 
        $apiPropertyKey = new ExactTarget_APIProperty();
        $apiPropertyKey->Name="PhoneNumber";
        $apiPropertyKey->Value="5555555555";
        $DE->Keys[] = $apiPropertyKey;        

        $apiProperty1 =new ExactTarget_APIProperty();
        $apiProperty1->Name="Name";
        $apiProperty1->Value="PHP_Name_New";        

        $DE->Properties=array($apiProperty1);
        $object1 = new SoapVar($DE, SOAP_ENC_OBJECT, 'DataExtensionObject', 
        "http://exacttarget.com/wsdl/partnerAPI");
        $updateOptions = new ExactTarget_UpdateOptions();
         /*% ExactTarget_SaveOption */ 
         $saveOption = new ExactTarget_SaveOption();                
         $saveOption->PropertyName="DataExtensionObject";
         $saveOption->SaveAction=ExactTarget_SaveAction::UpdateAdd;

         $updateOptions->SaveOptions[] = new SoapVar($saveOption, SOAP_ENC_OBJECT, 
         'SaveOption', "http://exacttarget.com/wsdl/partnerAPI");
         // Apply options and object to request
         $request = new ExactTarget_UpdateRequest();
         $request->Options = $updateOptions;
         $request->Objects = array($object1);
         $results = $client->Update($request);
    
    } catch (SoapFault $e) {
    var_dump($e);
    }
    Print "Request: \n".
    $client->__getLastRequestHeaders() ."\n";
    print "Request: \n".
    $client->__getLastRequest() ."\n";
    print "Response: \n".
    $client->__getLastResponseHeaders()."\n";
    print "Response: \n".
    $client->__getLastResponse()."\n";
?>