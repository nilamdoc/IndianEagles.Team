<?php
namespace app\extensions\command;

use app\models\Telegrams;
use app\models\Users;
use app\models\Products;

class Telegram extends \lithium\console\Command {
	public function run(){
		define('LITHIUM_WEBROOT_PATH', str_replace("\\","/",str_replace("F:","",dirname(LITHIUM_APP_PATH))) . '/app/webroot');
		$telegram = Telegrams::find('first',array(
			'order'=>array('_id'=>'DESC'),
		));
//		print_r($telegram['offset']);
		$url = "https://api.telegram.org/bot".TELEGRAM."/getUpdates?offset=".$telegram['offset'];
		$payload = $this->curl_get_contents($url);
		
		print_r($payload);
		$jdec = json_decode($payload);
		foreach($jdec->result as $r){
			$update_id = $r->update_id;
			$message_id = $r->message->chat->id;
			$userName = $r->message->chat->first_name . " " . $r->message->chat->last_name . " (".$r->message->chat->username.")";
//			print_r($message_id);
		
		$data = array('offset'=>$update_id);
		if(substr($r->message->text,0,1)!='/'){
				$url = "https://api.telegram.org/bot".TELEGRAM."/sendMessage?chat_id=".$message_id."&text=Could not understand command use '/' for list of commands";
			$payload = $this->curl_get_contents();
		}else{
		if($telegram['offset']!=$update_id){
//			print_r($r->message->text);
			Telegrams::create()->save($data);
			//print_r($data);
			$commands = split(" ", $r->message->text);
			switch (strtolower( $commands[0])){
				case "/start":
				$text = urlencode("Hi ".$userName.",\n
<b>IndianEagles.Team</b> welcomes you.\n
We provide with the following details:
|- /productcode : Product details: Code, Name, Size, MPR, DP, BV, Product image
|- /mca NUMBER : Current status of given MCA Number
|- /search NAME : Name, MCA Number, Mobile Phone
|- /offernewjoinee - Offer New Joinee
|- /offerrepurchase - Offer Repurchase
");
$url = "https://api.telegram.org/bot".TELEGRAM."/sendMessage?chat_id=".$message_id."&parse_mode=HTML&text=".$text;
				$payload = $this->curl_get_contents($url);
				break;
				
				case "/mca":
				$text = $this->getMCA($commands[1],$userName);
				$url = "https://api.telegram.org/bot".TELEGRAM."/sendMessage?chat_id=".$message_id."&parse_mode=HTML&text=".$text;
				$payload = $this->curl_get_contents($url);
				break;
				
				case "/search":
				for($i = 1;$i<=count($commands);$i++){
					$name = $name . " ".$commands[$i];
				}
				
				$text = $this->searchName($name);
				print_r($text);
				$url = "https://api.telegram.org/bot".TELEGRAM."/sendMessage?chat_id=".$message_id."&parse_mode=HTML&text=".$text;
				$payload = $this->curl_get_contents($url);
				break;
				
				default:
				$productCode = strtoupper(substr($r->message->text,1,strlen($r->message->text)));
				$text = $this->getProduct($productCode,$userName);
				$textDP = $this->getProductNoDP($productCode,$userName);				
				$url = "https://api.telegram.org/bot".TELEGRAM."/sendMessage?chat_id=".$message_id."&parse_mode=HTML&text=".$text;
				$payload = $this->curl_get_contents($url);
				$this->UploadPhoto($productCode,$message_id,urldecode(str_replace("</b>","*",str_replace("<b>","*",$textDP))));
				$this->UploadProductPhoto($productCode,$message_id,urldecode(str_replace("</b>","*",str_replace("<b>","*",$textDP))));
				break;
			}
		}
		}
		}
	}
	public function getProduct($productCode,$userName){
		$product = Products::find('first',array(
			'conditions'=>array('Code'=>$productCode)
		));
		if(count($product)!=0){
			$text = "Product Code: ".$product['Code']. "\n";
			$text = $text . "Name: ".str_replace("-","",str_replace("&","",$product['Name'])). "\n";
			$text = $text . "Category: ".str_replace("-","",str_replace("&","",$product['Category'])). "\n";
			$text = $text . "Size: ".$product['Size']. "\n";
			$text = $text . "MRP: ".$product['MRP']. "\n";
			$text = $text . "DP: ".$product['DP']. "\n";
			$text = $text . "BV: ".$product['BV']. "\n\n";
			$text = $text . $userName. "\n\n";
//			$text = $text . "<b>Description</b>: ".$product['Description']. "\n";
		}else{
			if(strtolower(substr($productCode,0,2))=='bp'){
				$text = "Business Plan";
			}else{
				$text = "Product Not Found!";
			}
		}
		return urlencode($text);
	}

	public function getProductNoDP($productCode,$userName){
		$product = Products::find('first',array(
			'conditions'=>array('Code'=>$productCode)
		));
		if(count($product)!=0){
			$text = "Product Code: ".$product['Code']. "\n";
			$text = $text . "Name: ".str_replace("-","",str_replace("&","",$product['Name'])). "\n";
			$text = $text . "Category: ".str_replace("-","",str_replace("&","",$product['Category'])). "\n";
			$text = $text . "Size: ".$product['Size']. "\n";
			$text = $text . "MRP: ".$product['MRP']. "\n\n";
			$text = $text . $userName. "\n\n";			
		}else{
			if(strtolower(substr($productCode,0,2))=='bp'){
				$text = "Business Plan";
			}else{
				$text = "Product Not Found!";
			}
		}
		return urlencode($text);
	}
	
	public function getMCA($mcaNumber){
		setlocale(LC_MONETARY, 'en_IN');
		$user = Users::find('first',array(
			'conditions'=>array('mcaNumber'=>(string)$mcaNumber)
		));
		$count = $this->countChilds($mcaNumber);
		$thismonth = date('Y-m',time());
		if(count($user)!=0){
			$text = "MCA Number: ".$user['mcaNumber']. "
";
			$text = $text . "MCA Name: ".$user['mcaName']. "
";
			$text = $text . "Joining Date: ".$user['DateJoin']. "
";
			$text = $text . "Downline: ".$count. "
";
			$text = $text . "Mobile: +91".$user['Mobile']. "
";
			$text = $text . "Valid Title: ".$user[$thismonth]['ValidTitle']. "
";
			$text = $text . "Paid as Title: ".$user[$thismonth]['PaidTitle']. "
";
			$text = $text . "Percent: ".$user[$thismonth]['Percent']. "%
";
			$text = $text . "PBV: ".$this->moneyFormatIndia($user[$thismonth]['BV']). "
";
			$text = $text . "GBV: ".$this->moneyFormatIndia($user[$thismonth]['GBV']). "
";
			$text = $text . "TGBV: ".$this->moneyFormatIndia($user[$thismonth]['TGBV']). "
";
			$text = $text . "TCGBV: ".$this->moneyFormatIndia($user[$thismonth]['TCGBV']). "
";
			$text = $text . "PGBV: ".$this->moneyFormatIndia($user[$thismonth]['PGBV']). "
";
			$text = $text . "Roll Up: ".$this->moneyFormatIndia($user[$thismonth]['Rollup']). "
";
			$text = $text . "Legs: ".$user[$thismonth]['Legs']. "
";
			$text = $text . "Qualified Director Legs: ".$user[$thismonth]['QDLegs']. "
";
			$text = $text . "NEFT: ".$user[$thismonth]['NEFT']. "
";
			$text = $text . "Aadhar: ".$user[$thismonth]['Aadhar']. "
";
		}else{
			$text = "MCA No: ".$mcaNumber. " not found!";
		}
		return $text;
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

	public function UploadPhoto($productCode,$message_id,$text){
				$photo = LITHIUM_WEBROOT_PATH."/img/".strtoupper($productCode).".jpg";
				$bot_url    = "https://api.telegram.org/bot".TELEGRAM."/";
				$url = $bot_url . "sendPhoto?chat_id=" . $message_id;
				$ch = curl_init(); 
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
								"Content-Type:multipart/form-data"
				));
				curl_setopt($ch, CURLOPT_URL, $url); 
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
				curl_setopt($ch, CURLOPT_POSTFIELDS, array(
					"photo"     => "@".$photo, 
					"caption"			=> $text
				)); 
				curl_setopt($ch, CURLOPT_INFILESIZE, filesize($photo));
				$output = curl_exec($ch);
				curl_close($ch);
	}

	public function UploadProductPhoto($productCode,$message_id,$text){
				$photo = LITHIUM_WEBROOT_PATH."/product/".strtoupper($productCode).".jpg";
				$bot_url    = "https://api.telegram.org/bot".TELEGRAM."/";
				$url = $bot_url . "sendPhoto?chat_id=" . $message_id;
				$ch = curl_init(); 
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
								"Content-Type:multipart/form-data"
				));
				curl_setopt($ch, CURLOPT_URL, $url); 
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
				curl_setopt($ch, CURLOPT_POSTFIELDS, array(
								"photo"     => "@".$photo, 
								"caption"			=> $text
																											
				)); 
				curl_setopt($ch, CURLOPT_INFILESIZE, filesize($photo));
				$output = curl_exec($ch);
				curl_close($ch);
	}

		public function searchName($mcaName){
			print_r(trim( $mcaName));
				$users = Users::find('all',array(
					'conditions'=>array('mcaName'=>array('$regex'=>trim($mcaName),'$options'=>'i')),
					'order'=>array('mcaName'=>'ASC')
				));
//				print_r(count($users));
				foreach($users as $user){
					$resultTable = $resultTable . $user['mcaName'].' - <a href="t.me/'.$user['mcaNumber'].'">'.$user['mcaNumber'].'</a> - '.$user['Mobile'].'
';
//					print_r($user['mcaName']);
				}
//				print_r($resultTable);
				return urlencode($resultTable);
					
		}
		public function curl_get_contents($url)
		{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
	}
	
}
?>