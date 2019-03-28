<?php
namespace app\controllers;
use app\models\Pages;
use app\models\Users;
use app\models\Admins;
use app\models\DPUsers;
use app\models\Invoices;
use app\models\InvoiceDetails;
use app\models\Products;
use app\models\Categories;
use lithium\data\Connections;
use lithium\storage\Session;
use lithium\data\source\MongoDb;
use app\extensions\action\Mobile;
use \lithium\template\View;
use \Swift_MailTransport;
use \Swift_Mailer;
use \Swift_Message;
use \Swift_Attachment;
use app\extensions\action\Functions;
use Twilio\Rest\Client;
use app\extensions\action\GoogleAuthenticator;

class TwilioController extends \lithium\action\Controller {
	protected function _init(){
		parent::_init();
	}
 public function sendSMS($mobile=null){
  if($mobile==null || strlen($mobile)<10){
   return $this->render(array('json' => array('error'=> 'Mobile number missing')));
  }
  $account_sid = TWILIO_ACCOUNT_SID;
  $auth_token = TWILIO_AUTH_TOKEN;
  $twilio_number = TWILIO_MOBILE;
  $client = new Client($account_sid, $auth_token);
  $ga = new GoogleAuthenticator();
  $secret = $ga->createSecret(64);
  $secretid = $ga->getCode($secret);  
  $phone_code = substr($secretid,0,6); 
  $client->messages->create(
    // Where to send a text message (your cell phone?)
    '+91'.$mobile,
    array(
        'from' => $twilio_number,
        'body' => $phone_code .' use the code in IndianEagles.Team!'
    )
  );
  
  return $this->render(array('json' => array(
				'sms'=> $phone_code
			)));
  
 }
}