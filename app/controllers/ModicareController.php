<?php 
namespace app\controllers; 
use app\models\Telegrams; 
use app\models\Users; 
use app\models\Products;
use app\models\Seminars;
use app\models\Distributors;

// API TOKEN 

class ModicareController extends \lithium\action\Controller {
 public function index() { 
 $content = file_get_contents("php://input"); 
 $update = json_decode($content, true); 
 $message = $update["message"]; 
 $message_id = $message['message_id'];
 $chat_id = $message['chat']['id'];
 $reply = "ok"; 
 $API_URL = "https://api.telegram.org/bot/".TELEGRAM_MODICARE; 
 $sendto =$API_URL."sendmessage?chat_id=".$chat_id."&text=".$reply; 
 file_get_contents($sendto); 
  return $this->render(array('json' => array("url"=>"http://indianeagles.team/modicare/run/BOT_TOKEN")));
 }

// public function index(){
//  return $this->render(array('json' => array("url"=>"http://indianeagles.team/modicare/run/BOT_TOKEN")));
// }
 public function run($botURL){
  if($botURL != TELEGRAM_MODICARE){return "False";}
  define('API_URL', 'https://api.telegram.org/bot'.TELEGRAM_MODICARE.'/');
  define('LITHIUM_WEBROOT_PATH', str_replace("\\","/",str_replace("F:","",dirname(LITHIUM_APP_PATH))) . '/app/webroot');
    $arrContextOptions=array(
     "ssl"=>array(
     "verify_peer"=>false,
     "verify_peer_name"=>false,
    ),
   );
  $content = file_get_contents("php://input", false, stream_context_create($arrContextOptions));
  $update = json_decode($content, true);
  $parse_mode="HTML";
  
		if (isset($update["message"])) {
   $message = $update["message"];
   $message_id = $message['message_id'];
   $chat_id = $message['chat']['id'];
   $this->processMessage($update["message"],$message_id,$chat_id,$parse_mode);
  } else if (isset($update["inline_query"])) {
   $this->processInlineQuery($update["message"]);
  } else {
   $this->answerInlineQuery($update["message"]);
  }
  
  return $this->render(array('json' => array("success"=>"Yes")));		
 }
 
 
 public function processMessage($message,$message_id,$chat_id,$parse_mode){
  if (isset($message['text'])) {
    // incoming text message
    $text = $message['text'];
    $userName = "<b>".$message['chat']['first_name'] . " " . $message['chat']['last_name'] . "</b> (<i>".$message['chat']['username']."</i>)";
    $ReplyText = "Hi ".$userName.",

";
    if (strpos(strtolower($text), "mca") === 0){
      $commands = split(" ", $text);
      $ReplyText = $ReplyText . $this->getMCA($commands[1],$userName);
      $this->apiRequest("sendMessage", array('chat_id' => $chat_id, "text" => $ReplyText, "parse_mode"=>$parse_mode));
    }else if (strpos(strtolower($text), "name") === 0){
      $commands = split(" ", $text);
      $ReplyText = $ReplyText . $this->getName($commands[1],$userName);
      $this->apiRequest("sendMessage", array('chat_id' => $chat_id, "text" => $ReplyText, "parse_mode"=>$parse_mode));
    }else if (strpos(strtolower($text), "event") === 0){
      $commands = split(" ", $text);
      $ReplyText = $ReplyText . $this->getEvent($commands[1],$commands[2],$userName);
      $this->apiRequest("sendMessage", array('chat_id' => $chat_id, "text" => $ReplyText, "parse_mode"=>$parse_mode));
    }else if (strpos(strtolower($text), "dp") === 0){
      $commands = split(" ", $text);
      $ReplyText = $ReplyText . $this->getDP($commands[1],$userName);
      $this->apiRequest("sendMessage", array('chat_id' => $chat_id, "text" => $ReplyText, "parse_mode"=>$parse_mode));
    }else if (strpos(strtolower($text), "code") === 0){
     $commands = split(" ", $text);
     $ReplyText = $ReplyText . $this->getCode($commands[1],$userName);
     $this->apiRequest("sendMessage", array('chat_id' => $chat_id, "text" => $ReplyText, "parse_mode"=>$parse_mode));
//     $this->UploadPhoto(strtoupper(trim($commands[1])),$chat_id,$ReplyText);
    }else if (strpos(strtolower($text), "product") === 0){
     $commands = split(" ", $text);
     $ReplyText = $ReplyText . $this->getProduct($commands[1],$userName);
     $this->apiRequest("sendMessage", array('chat_id' => $chat_id, "text" => $ReplyText, "parse_mode"=>$parse_mode));
//     $this->UploadPhoto(strtoupper(trim($commands[1])),$chat_id,$ReplyText);
    }else{

      $ReplyText = $ReplyText . "<b>Usage:</b>
";
      $ReplyText = $ReplyText . "Search product on Code
";
      $ReplyText = $ReplyText . "<b>code</b> HL0001
";
      $ReplyText = $ReplyText . "Search product by Name
";
      $ReplyText = $ReplyText . "<b>product</b> moor
";
      $ReplyText = $ReplyText . "Search on  MCA number use
";
      $ReplyText = $ReplyText . "<b>mca</b> 92143138
";
      $ReplyText = $ReplyText . "Search a Name use
";
      $ReplyText = $ReplyText . "<b>name</b> ruchi
";
      $ReplyText = $ReplyText . "Search a Distribution Point, use the address keyword
";

      $ReplyText = $ReplyText . "<b>dp</b> manekbaug
";
      $ReplyText = $ReplyText . "Search a Event / Seminar
";

      $ReplyText = $ReplyText . "<b>event:</b>
";
      $ReplyText = $ReplyText . "event date YYYY-MM-DD
";
      $ReplyText = $ReplyText . "event city Ahmedabad
";
      $ReplyText = $ReplyText . "event state Gujarat
";
      $ReplyText = $ReplyText . "event venue Vastral
";
      $ReplyText = $ReplyText . "event person Ruchi
";

      $this->apiRequest("sendMessage", array('chat_id' => $chat_id, "text" => $ReplyText, "parse_mode"=>$parse_mode));

    
//        $this->apiRequestJson("sendMessage", array('chat_id' => $chat_id, "parse_mode"=>$parse_mode, "text" => $ReplyText, 
//       'reply_markup' => array(
//       'keyboard' => array(array('Products','Offers','Distributor','Event')),
//       'one_time_keyboard' => true,
//       'resize_keyboard' => true)));
    }  
  }
   return "OK";
   // return $this->render(array('json' => array(
				// 'Reply'=> $ReplyText,
			// )));

 }
 public function processInlineQuery(){}
 public function answerInlineQuery(){}
	
 public function countChilds($user_id){
	#Retrieving a Full Tree
	/* 	SELECT node.user_id
	FROM details AS node,
			details AS parent
	WHERE node.lft BETWEEN parent.lft AND parent.rgt
		   AND parent.user_id = 3
	ORDER BY node.lft;
	
	parent = db.details.findOne({user_id: ObjectId("50e876e49d5d0cbc08000000")});
	query = {left: {$gt: parent.left, $lt: parent.right}};
	select = {user_id: 1};
	db.details.find(query,select).sort({left: 1})
	 */
		$ParentDetails = Users::find('all',array(
			'conditions'=>array(
			'mcaNumber' => $user_id
			)));
		foreach($ParentDetails as $pd){
			$left = $pd['left'];
			$right = $pd['right'];
		}
		$NodeDetails = Users::count(array(
			'conditions' => array(
				'left'=>array('$gt'=>$left),
				'right'=>array('$lt'=>$right)
			))
		);

		return $NodeDetails;
	} 
 public function getMCA($mcaNumber,$userName){
		setlocale(LC_MONETARY, 'en_IN');
		$user = Users::find('first',array(
			'conditions'=>array('mcaNumber'=>(string)$mcaNumber)
		));
		$count = $this->countChilds($mcaNumber);
		$thismonth = date('Y-m',time());
	$text = "Hi ".$userName.",
MCA Number Search: <b>".$mcaNumber."</b>
";

		if(count($user)!=0){
			$text = "MCA Number: ".$user['mcaNumber']. "
";
			$text = $text . "MCA Name: ".$user['mcaName']. "
";
			$text = $text . "Joining Date: ".$user['DateJoin']. "
";
//			$text = $text . "Downline: ".$count. "
//";
			$text = $text . "Mobile: +91".$user['Mobile']. "
";
   $text = $text . "Upline MCA: ".$user['refer']. "
";
   $text = $text . "Upline Name: ".$user['refer_name']. "
";
			// $text = $text . "Valid Title: ".$user[$thismonth]['ValidTitle']. "
// ";
			// $text = $text . "Paid as Title: ".$user[$thismonth]['PaidTitle']. "
// ";
			// $text = $text . "Percent: ".$user[$thismonth]['Percent']. "%
// ";
			// $text = $text . "PBV: ".$this->moneyFormatIndia($user[$thismonth]['BV']). "
// ";
			// $text = $text . "GBV: ".$this->moneyFormatIndia($user[$thismonth]['GBV']). "
// ";
			// $text = $text . "TGBV: ".$this->moneyFormatIndia($user[$thismonth]['TGBV']). "
// ";
			// $text = $text . "TCGBV: ".$this->moneyFormatIndia($user[$thismonth]['TCGBV']). "
// ";
			// $text = $text . "PGBV: ".$this->moneyFormatIndia($user[$thismonth]['PGBV']). "
// ";
			// $text = $text . "Roll Up: ".$this->moneyFormatIndia($user[$thismonth]['Rollup']). "
// ";
			// $text = $text . "Legs: ".$user[$thismonth]['Legs']. "
// ";
			// $text = $text . "Qualified Director Legs: ".$user[$thismonth]['QDLegs']. "
// ";
			// $text = $text . "NEFT: ".$user[$thismonth]['NEFT']. "
// ";
			// $text = $text . "Aadhar: ".$user[$thismonth]['Aadhar']. "
// ";
		}else{
			$text = "MCA No: ".$mcaNumber. " not found!";
		}
		return $text;
	}
 public function getName($mcaName,$userName){
		setlocale(LC_MONETARY, 'en_IN');
		$users = Users::find('all',array(
					'conditions'=>array('mcaName'=>array('$regex'=>trim($mcaName),'$options'=>'i')),
     'order'=>array('mcaName'=>'ASC')
			));
		
		$thismonth = date('Y-m',time());
	$text = "Name Search: <b>".$mcaName."</b>

";
  
		if(count($users)!=0){
   foreach ($users as $user){ 
    if(strlen($text)<3000){
			$text = $text . "MCA Number: ".$user['mcaNumber']. "
";
			$text = $text . "MCA Name: ".$user['mcaName']. "
";
			$text = $text . "Joining Date: ".$user['DateJoin']. "
";
			$text = $text . "Mobile: +91".$user['Mobile']. "
";
   $text = $text . "Upline MCA: ".$user['refer']. "
";
   $text = $text . "Upline Name: ".$user['refer_name']. "
";
   $text = $text . "
";
    }
   }
		}else{
			$text = "Name: ".$mcaName. " not found!";
		}
		return $text;
	}
 public function getEvent($type,$param, $userName){
		setlocale(LC_MONETARY, 'en_IN');
 
$text = "Event Search: <b>".$type." ".$param."</b>

";
$today = gmdate('Y-m-d',time());

  switch (strtolower(trim($type))) {
    case "date":
       $events = Seminars::find('all',array(
        'conditions'=>array('EventDate'=>$param)
        )) ;
        break;
    case "city":
       $events = Seminars::find('all',array(
        'conditions'=>array('City'=>array('$regex'=>trim($param),'$options'=>'i'),'EventDate'=>array('$gte'=>$today)),
       )) ;
        break;
    case "state":
       $events = Seminars::find('all',array(
        'conditions'=>array('State'=>array('$regex'=>trim($param),'$options'=>'i'),'EventDate'=>array('$gte'=>$today)),
       )) ;
        break;
    case "venue":
       $events = Seminars::find('all',array(
        'conditions'=>array('Venue'=>array('$regex'=>trim($param),'$options'=>'i'),'EventDate'=>array('$gte'=>$today)),
       )) ;
        break;
    case "person":
        $events = Seminars::find('all',array(
        'conditions'=>array('Presenter'=>array('$regex'=>trim($param),'$options'=>'i'),'EventDate'=>array('$gte'=>$today)),
       )) ;
        break;
    default:
       $events = array();
}   
	 
		if(count($events)!=0){
   foreach ($events as $event){ 
    if(strlen($text)<3000){
			$text = $text . "Event Date: <b>".$event['EventDate']. "</b>
";
			$text = $text . "Event Time: <b>".$event['EventTime']. "</b>
";
			$text = $text . "Category: <b>".$event['Category']. "</b>
";
			$text = $text . "Venue: <b>".$event['Venue']. "</b>
";
			$text = $text . "City: <b>".$event['City']. "</b>
";
			$text = $text . "State: <b>".$event['State']. "</b>
";
			$text = $text . "Contact: <b>".$event['Contact']. "</b>
";
			$text = $text . "Presenter: <b>".$event['Presenter']. "</b>
";

   $text = $text . "
";
    }
   }
   $text = $text . " Length: ". strlen($text);

		}else{
			$text = "Event: ".$type." ".$param. " not found!

<b>Format:</b>
";
			$text = $text . "event date YYYY-MM-DD
";
			$text = $text . "event city Ahmedabad
";
			$text = $text . "event state Gujarat
";
			$text = $text . "event venue Vastral
";
			$text = $text . "event person Ruchi
";

		}
		return $text;
}


 public function getDP($name,$userName){
		setlocale(LC_MONETARY, 'en_IN');
  $search = Distributors::find('all',array(
   'conditions'=>array('City'=>array('$regex'=>trim($name),'$options'=>'i'))
  ));
		
		
	$distributor = "Distribution Point Search: <b>".$name."</b>

";
  
		if(count($search)!=0){
   foreach ($search as $s){
    if(strlen($distributor)<3000){
    
   $distributor = $distributor . $s['Address'];
   $distributor = $distributor . "
   ";
   $distributor = $distributor . $s['City']; 
   $distributor = $distributor . " - ";
   $distributor = $distributor . $s['State'];
   $distributor = $distributor . "
   ";
   $distributor = $distributor . $s['Mobile'];
   $distributor = $distributor . "
   ";
   $distributor = $distributor . "
   ";
   }
   }
		}else{
			$distributor = "DP: ".$name. " not found!";
		}
		return $distributor;
	}


 public function getCode($code,$userName){
		setlocale(LC_MONETARY, 'en_IN');
		$products = Products::find('all',array(
					'conditions'=>array('Code'=>array('$regex'=>strtoupper(trim($code)),'$options'=>'i')),
     'order'=>array('Code'=>'ASC')
			));
		
		
	$text = "Code Search: <b>".$code."</b>

";
  
		if(count($products)!=0){
   foreach ($products as $p){ 
       if(strlen($text)<3000){

			$text = $text . "Code Number: <b>".$p['Code']. "</b>
";
			$text = $text . "EAN Number: ".$p['EAN']. "
";
			$text = $text . "Category: <b>".str_replace("-","",str_replace("&","",$p['Category'])). "</b>
";
			$text = $text . "Product: <b>".str_replace("-","",str_replace("&","",$p['Name'])). "</b>
";
			$text = $text . "Size: <b>".$p['Size']. "</b>
";
			$text = $text . "MRP: <b>".$p['MRP']. "</b>
";
			$text = $text . "DP: <b>".$p['DP']. "</b>
";   
			$text = $text . "BV: <b>".$p['BV']. "</b>
";
			$text = $text . "Description: ".$p['Description']. "
";
$text = $text . "
";
       }

     }
		}else{
			$text = "Code: ".$code. " not found!";
		}
		return $text;
	}
public function getProduct($code,$userName){
		setlocale(LC_MONETARY, 'en_IN');
		$products = Products::find('all',array(
					'conditions'=>array('Name'=>array('$regex'=>strtoupper(trim($code)),'$options'=>'i')),
     'order'=>array('Code'=>'ASC')
			));
		
		
	$text = "Product Search: <b>".$code."</b>

";
  
		if(count($products)!=0){
   foreach ($products as $p){ 
       if(strlen($text)<3000){

			$text = $text . "Code Number: <b>".$p['Code']. "</b>
";
			$text = $text . "EAN Number: ".$p['EAN']. "
";
			$text = $text . "Category: <b>".str_replace("-","",str_replace("&","",$p['Category'])). "</b>
";
			$text = $text . "Product: <b>".str_replace("-","",str_replace("&","",$p['Name'])). "</b>
";
			$text = $text . "Size: <b>".$p['Size']. "</b>
";
			$text = $text . "MRP: <b>".$p['MRP']. "</b>
";
			$text = $text . "DP: <b>".$p['DP']. "</b>
";   
			$text = $text . "BV: <b>".$p['BV']. "</b>
";
			$text = $text . "Description: ".$p['Description']. "
";
$text = $text . "
";
       }
   }
		}else{
			$text = "Product: ".$code. " not found!";
		}
		return $text;
	}
 
 // Functions
 function apiRequest($method, $parameters) {
  if (!is_string($method)) {
    error_log("Method name must be a string\n");
    return false;
  }
  if (!$parameters) {
    $parameters = array();
  } else if (!is_array($parameters)) {
    error_log("Parameters must be an array\n");
    return false;
  }
  foreach ($parameters as $key => &$val) {
    // encoding to JSON array parameters, for example reply_markup
    if (!is_numeric($val) && !is_string($val)) {
      $val = json_encode($val);
    }
  }
  $url = API_URL.$method.'?'.http_build_query($parameters);
  $handle = curl_init($url);
  curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($handle, CURLOPT_SAFE_UPLOAD, false);
  curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
  curl_setopt($handle, CURLOPT_TIMEOUT, 60);
  return $this->exec_curl_request($handle);
 }
 function apiRequestJson($method, $parameters) {
  if (!is_string($method)) {
    error_log("Method name must be a string\n");
    return false;
  }
  if (!$parameters) {
    $parameters = array();
  } else if (!is_array($parameters)) {
    error_log("Parameters must be an array\n");
    return false;
  }
  $parameters["method"] = $method;
  $handle = curl_init(API_URL);
  curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
  curl_setopt($handle, CURLOPT_TIMEOUT, 60);
  curl_setopt($handle, CURLOPT_POSTFIELDS, json_encode($parameters));
  curl_setopt($handle, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
  return $this->exec_curl_request($handle);
 }
 function apiRequestWebhook($method, $parameters) {
  if (!is_string($method)) {
    error_log("Method name must be a string\n");
    return false;
  }
  if (!$parameters) {
    $parameters = array();
  } else if (!is_array($parameters)) {
    error_log("Parameters must be an array\n");
    return false;
  }
  $parameters["method"] = $method;
  header("Content-Type: application/json");
  echo json_encode($parameters);
  return true;
 }
 function exec_curl_request($handle) {
  $response = curl_exec($handle);
  if ($response === false) {
    $errno = curl_errno($handle);
    $error = curl_error($handle);
    error_log("Curl returned error $errno: $error\n");
    curl_close($handle);
    return false;
  }
  $http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));
  curl_close($handle);
  if ($http_code >= 500) {
    // do not wat to DDOS server if something goes wrong
    sleep(10);
    return false;
  } else if ($http_code != 200) {
    $response = json_decode($response, true);
    error_log("Request has failed with error {$response['error_code']}: {$response['description']}\n");
    if ($http_code == 401) {
      throw new Exception('Invalid access token provided');
    }
    return false;
  } else {
    $response = json_decode($response, true);
    if (isset($response['description'])) {
      error_log("Request was successfull: {$response['description']}\n");
    }
    $response = $response['result'];
  }
  return $response;
 }
 function curl_get_contents($url){
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_HEADER, 0);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch, CURLOPT_URL, $url);
   $data = curl_exec($ch);
   curl_close($ch);
   return $data;
 } 
 function moneyFormatIndia($num) {
    $explrestunits = "" ;
    if(strlen($num)>3) {
        $lastthree = substr($num, strlen($num)-3, strlen($num));
        $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
        $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
        $expunit = str_split($restunits, 2);
        for($i=0; $i<sizeof($expunit); $i++) {
            // creates each of the 2's group and adds a comma to the end
            if($i==0) {
                $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
            } else {
                $explrestunits .= $expunit[$i].",";
            }
        }
        $thecash = $explrestunits.$lastthree;
    } else {
        $thecash = $num;
    }
    return $thecash; // writes the final format where $currency is the currency symbol.
	}
 function UploadPhoto($productCode,$message_id,$text){
		$photo = LITHIUM_WEBROOT_PATH."/img/".strtoupper($productCode).".jpg";
		$bot_url    = "https://api.telegram.org/bot".TELEGRAM_MODICARE."/";
		$url = $bot_url . "sendPhoto?chat_id=" . $message_id ;
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, array("photo"=>$this->curl_file_create($photo), "caption"=> $text)); 
		curl_setopt($ch, CURLOPT_INFILESIZE, filesize($photo));
		$output = curl_exec($ch);
		curl_close($ch);
	}
}
?>