<?php
namespace app\extensions\action;
use app\models\Users;

class Mobile extends \lithium\action\Controller {
		function twilio($mobile,$msg,$twoCode){
			
// Get cURL resource
$url = 'https://api.twilio.com/2010-04-01/Accounts/'.TWILIO_ACCOUNT_SID.'/Calls.json';
$CallURL = 'http://indianeagles.team/mobile/say/'.$twoCode;
$auth = TWILIO_ACCOUNT_SID.":".TWILIO_AUTH_TOKEN;
$fields = array(
		'To' =>  $mobile  ,
		'From' => TWILIO_MOBILE  ,
		'Url' => $CallURL  ,
		'Method'=>'POST' ,
		'FallbackMethod'=>'POST',
		'StatusCallbackMethod'=>'POST',
		'Record'=>'false'
		);
$post = http_build_query($fields);
//print_r($fields);
//print_r($post);
$curl = curl_init($url);
// Set some options - we are passing in a useragent too here
curl_setopt($curl,	CURLOPT_POST, true);
curl_setopt($curl,  CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl,	CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl,	CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl,  CURLOPT_USERAGENT , 'Mozilla 5.0');
curl_setopt($curl,  CURLOPT_POSTFIELDS, $post);
//curl_setopt($curl, 	CURLOPT_HTTPHEADER, array('Content-Length: 7' ));
curl_setopt($curl,	CURLOPT_USERPWD, $auth);
curl_setopt($curl,	CURLOPT_VERBOSE , 1);

//print_r($curl);
// Send the request & save response to $resp
$resp = curl_exec($curl);
//print_r($resp);
//print_r(curl_getinfo($curl));
// Close request to clear up some resources
$curl_errno = curl_errno($curl);

//print_r( "cURL Error ($curl_errno): $curl_error\n");
curl_close($curl);
}

 function sendSms($to, $message){
		$url = "https://api.twilio.com/2010-04-01/Accounts/".TWILIO_ACCOUNT_SID."/SMS/Messages";;
		$auth = TWILIO_ACCOUNT_SID.":".TWILIO_AUTH_TOKEN;
		$to = $to; 
$body = $message;
$fields = array (
    'From' => TWILIO_MOBILE,
    'To' => $to,
    'Body' => $body,
);
$post = http_build_query($fields);
$curl = curl_init($url);
// Set some options - we are passing in a useragent too here
curl_setopt($curl,	CURLOPT_POST, true);
curl_setopt($curl,  CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl,	CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl,	CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl,  CURLOPT_USERAGENT , 'Mozilla 5.0');
curl_setopt($curl,  CURLOPT_POSTFIELDS, $post);
//curl_setopt($curl, 	CURLOPT_HTTPHEADER, array('Content-Length: 7' ));
curl_setopt($curl,	CURLOPT_USERPWD, $auth);
curl_setopt($curl,	CURLOPT_VERBOSE , 1);

//print_r($curl);
// Send the request & save response to $resp
$resp = curl_exec($curl);
//print_r($resp);
//print_r(curl_getinfo($curl));
// Close request to clear up some resources
$curl_errno = curl_errno($curl);

//print_r( "cURL Error ($curl_errno): $curl_error\n");
curl_close($curl);
	}
  
}
?>