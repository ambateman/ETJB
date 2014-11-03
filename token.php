<?php
/*
 * The purpose of this php file is to supply a valid token to
 * whatever api call asks. This action follows the following
 * steps:
 * 0) create a token holding file if one does not exist.
 * 1) read the values in the token text file (token string and time limit);
 * 2) if the local time is still less than the file timelimit, the token is ok to use.
 * 3) if the local time is greater than or equal to the timelimit, get a new token.
 * 4) if the token is new, create a new timelimit (current time + 59 minutes).
 * 5) if the token is new, replace values in token text file with new token and timelimit.
 */

$tokensource = "tokenfile.csv";
//This next block should only be called once.
if(!file_exists($tokensource)){  //if file doesn't exist, create it.
	$ourFileHandle = fopen($tokensource, 'w') or die("can't open file");
	fclose($ourFileHandle);
	}
	
$tokenFile=file_get_contents($tokensource);
$tokenParts = explode(",", $tokenFile); //blow up the csv components (token and time limit)

if(count($tokenParts) <2){ //if empty, get a token and set the time
	/*time gives a number equal to seconds.
	*Since a token lasts 3600 seconds, add that to the time
	*as a check value (minus one minute...)
	*/
	$newToken= include 'getToken.php';  //actually get a token from exacttarget.
	$data=array($newToken.",",time()+3540);
	file_put_contents($tokensource, $data);
	$token=$newToken;
}
else{ //there's data in the file...
	$tokenExpiration = $tokenParts[1];
	if(time()<=$tokenExpiration){
		$token=$tokenParts[0];
	}
	else { //token is expired -- get a new one.
		$newToken= include 'getToken.php';
		$data=array($newToken.",",time()+3540);
		file_put_contents($tokensource, $data);
		$token=$newToken;
	}
}

return $token;

?>