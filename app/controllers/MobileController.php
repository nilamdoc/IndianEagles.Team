<?php
namespace app\controllers;
use app\models\Pages;
use app\models\Users;
use app\models\Events;
use app\models\Levels;
use app\models\Directors;
use app\models\Locations;
use app\models\Addresses;
use app\models\Products;
use app\models\Messages;
use app\models\Distributors;
use app\models\Codes;
use app\models\Orders;
use app\models\Categories;
use lithium\data\Connections;
use lithium\data\source\MongoDb;
use app\extensions\action\GoogleAuthenticator;
use app\extensions\action\Mobile;
use \lithium\template\View;
use \Swift_MailTransport;
use \Swift_Mailer;
use \Swift_Message;
use \Swift_Attachment;
use app\extensions\action\Functions;


class MobileController extends \lithium\action\Controller {
	protected function _init(){
		parent::_init();
	}
	public function index(){
				return $this->render(array('json' => array("success"=>"Yes")));		
	}
 public function summary($mcaNumber){
  ini_set('memory_limit', '-1');
   $thismonth = date('Y-m',strtotime("0 month", strtotime(date("F") . "1")));   
//   $connection = new \Mongo( "mongodb://".CONNECTION_USER.":".CONNECTION_PASS."@".CONNECTION ); 
   $user = Users::find('first',array(
    'conditions'=>array('mcaNumber'=>$mcaNumber)
   ));
   $ZeroResult = Users::find('all',array(
    'fields'=> array($thismonth.'.Percent',$thismonth.'.BV'),
    'conditions'=>array(
     $thismonth.'.Percent'=>0,
     'left'=>array('$gt'=>$user['left']),
     'right'=>array('$lt'=>$user['right'])
     )
   ));
   $SevenResult = Users::find('all',array(
    'fields'=> array($thismonth.'.Percent',$thismonth.'.BV'),
    'conditions'=>array(
     $thismonth.'.Percent'=>7,
     'left'=>array('$gt'=>$user['left']),
     'right'=>array('$lt'=>$user['right'])
     )
   ));
   
   $TenResult = Users::find('all',array(
    'fields'=> array($thismonth.'.Percent',$thismonth.'.BV'),
    'conditions'=>array(
     $thismonth.'.Percent'=>10,
     'left'=>array('$gt'=>$user['left']),
     'right'=>array('$lt'=>$user['right'])
     )
   ));
   $ThirteenResult = Users::find('all',array(
    'fields'=> array($thismonth.'.Percent',$thismonth.'.BV'),
    'conditions'=>array(
     $thismonth.'.Percent'=>13,
     'left'=>array('$gt'=>$user['left']),
     'right'=>array('$lt'=>$user['right'])
     )
   ));
   $SixteenResult = Users::find('all',array(
    'fields'=> array($thismonth.'.Percent',$thismonth.'.BV'),
    'conditions'=>array(
     $thismonth.'.Percent'=>16,
     'left'=>array('$gt'=>$user['left']),
     'right'=>array('$lt'=>$user['right'])
     )
   ));
   $NinteenResult = Users::find('all',array(
    'fields'=> array($thismonth.'.Percent',$thismonth.'.BV'),
    'conditions'=>array(
     $thismonth.'.Percent'=>19,
     'left'=>array('$gt'=>$user['left']),
     'right'=>array('$lt'=>$user['right'])
     )
   ));
   $TwentyTwoResult = Users::find('all',array(
    'fields'=> array($thismonth.'.Percent',$thismonth.'.BV'),
    'conditions'=>array(
     $thismonth.'.Percent'=>22,
     'left'=>array('$gt'=>$user['left']),
     'right'=>array('$lt'=>$user['right'])
     )
   ));
   $Pthismonth = date('Y-m',strtotime("-1 month", strtotime(date("F") . "1")));   
   $PZeroResult = Users::find('all',array(
    'fields'=> array($Pthismonth.'.Percent',$Pthismonth.'.BV'),
    'conditions'=>array(
     $Pthismonth.'.Percent'=>0,
     'left'=>array('$gt'=>$user['left']),
     'right'=>array('$lt'=>$user['right'])
     )
   ));
   $PSevenResult = Users::find('all',array(
    'fields'=> array($Pthismonth.'.Percent',$Pthismonth.'.BV'),
    'conditions'=>array(
     $Pthismonth.'.Percent'=>7,
     'left'=>array('$gt'=>$user['left']),
     'right'=>array('$lt'=>$user['right'])
     )
   ));
   $PTenResult = Users::find('all',array(
    'fields'=> array($Pthismonth.'.Percent',$Pthismonth.'.BV'),
    'conditions'=>array(
     $Pthismonth.'.Percent'=>10,
     'left'=>array('$gt'=>$user['left']),
     'right'=>array('$lt'=>$user['right'])
     )
   ));
   $PThirteenResult = Users::find('all',array(
    'fields'=> array($Pthismonth.'.Percent',$Pthismonth.'.BV'),
    'conditions'=>array(
     $Pthismonth.'.Percent'=>13,
     'left'=>array('$gt'=>$user['left']),
     'right'=>array('$lt'=>$user['right'])
     )
   ));
   $PSixteenResult = Users::find('all',array(
    'fields'=> array($Pthismonth.'.Percent',$Pthismonth.'.BV'),
    'conditions'=>array(
     $Pthismonth.'.Percent'=>16,
     'left'=>array('$gt'=>$user['left']),
     'right'=>array('$lt'=>$user['right'])
     )
   ));
   $PNinteenResult = Users::find('all',array(
    'fields'=> array($Pthismonth.'.Percent',$Pthismonth.'.BV'),
    'conditions'=>array(
     $Pthismonth.'.Percent'=>19,
     'left'=>array('$gt'=>$user['left']),
     'right'=>array('$lt'=>$user['right'])
     )
   ));
   $PTwentyTwoResult = Users::find('all',array(
    'fields'=> array($Pthismonth.'.Percent',$Pthismonth.'.BV'),
    'conditions'=>array(
     $Pthismonth.'.Percent'=>22,
     'left'=>array('$gt'=>$user['left']),
     'right'=>array('$lt'=>$user['right'])
     )
   ));
   
   $result = array(
    $Pthismonth => array(
    '0' => array(
     'Total'=>count($PZeroResult),
     'BV'=>$this->sumGBV($PZeroResult,$Pthismonth),
     'Active'=>$this->ActivGBV($PZeroResult,$Pthismonth),
    ),
    '7' => array(
     'Total'=>count($PSevenResult),
     'BV'=>$this->sumGBV($PSevenResult,$Pthismonth),
     'Active'=>$this->ActivGBV($PSevenResult,$Pthismonth),
    ),
    '10' => array(
     'Total'=>count($PTenResult),
     'BV'=>$this->sumGBV($PTenResult,$Pthismonth),
     'Active'=>$this->ActivGBV($PTenResult,$Pthismonth),
    ),
    '13' => array(
     'Total'=>count($PThirteenResult),
     'BV'=>$this->sumGBV($PThirteenResult,$Pthismonth),
     'Active'=>$this->ActivGBV($PThirteenResult,$Pthismonth),
    ),
    '16' => array(
     'Total'=>count($PSixteenResult),
     'BV'=>$this->sumGBV($PSixteenResult,$Pthismonth),
     'Active'=>$this->ActivGBV($PSixteenResult,$Pthismonth),
    ),
    '19' => array(
     'Total'=>count($PNinteenResult),
     'BV'=>$this->sumGBV($PNinteenResult,$Pthismonth),
     'Active'=>$this->ActivGBV($PNinteenResult,$Pthismonth),
    ),
    '22' => array(
     'Total'=>count($PTwentyTwoResult),
     'BV'=>$this->sumGBV($PTwentyTwoResult,$Pthismonth),
     'Active'=>$this->ActivGBV($PTwentyTwoResult,$Pthismonth),
    ),
    ),
    $thismonth => array(
    '0' => array(
     'Total'=>count($ZeroResult),
     'BV'=>$this->sumGBV($ZeroResult,$thismonth),
     'Active'=>$this->ActivGBV($ZeroResult,$thismonth),
    ),
    '7' => array(
     'Total'=>count($SevenResult),
     'BV'=>$this->sumGBV($SevenResult,$thismonth),
     'Active'=>$this->ActivGBV($SevenResult,$thismonth),
    ),
     '10' => array(
     'Total'=>count($TenResult),
     'BV'=>$this->sumGBV($TenResult,$thismonth),
     'Active'=>$this->ActivGBV($TenResult,$thismonth),
    ),

    '13' => array(
     'Total'=>count($ThirteenResult),
     'BV'=>$this->sumGBV($ThirteenResult,$thismonth),
     'Active'=>$this->ActivGBV($ThirteenResult,$thismonth),
    ),
    '16' => array(
     'Total'=>count($SixteenResult),
     'BV'=>$this->sumGBV($SixteenResult,$thismonth),
     'Active'=>$this->ActivGBV($SixteenResult,$thismonth),
    ),
    '19' => array(
     'Total'=>count($NinteenResult),
     'BV'=>$this->sumGBV($NinteenResult,$thismonth),
     'Active'=>$this->ActivGBV($NinteenResult,$thismonth),
    ),
    '22' => array(
     'Total'=>count($TwentyTwoResult),
     'BV'=>$this->sumGBV($TwentyTwoResult,$thismonth),
     'Active'=>$this->ActivGBV($TwentyTwoResult,$thismonth),
    ),
    )
   );

  return compact('result');
 }
 public function ActivGBV($Result,$thismonth){
  $GBV = 0;
  foreach ($Result as $r){
   
   if ((int)$r[$thismonth]['BV']>0){
    $GBV = $GBV + 1;
   }
  }
  return $GBV;
 }
 public function sumGBV($Result,$thismonth){
  $GBV = 0;
  foreach ($Result as $r){
   $GBV = $GBV + (int)$r[$thismonth]['BV'];
  }
  return $GBV;
 }
	public function users(){
	$thismonth = date('Y-m',time());

	$selfline = Users::find('first',array(
	'conditions'=>array('mcaNumber'=>'92143138')
	));
	if($selfline['YYYYMM'][$thismonth]['TGBV']===0){
	$thismonth = date('Y-m',strtotime("-1 month", strtotime(date("F") . "1")));
	$months = (int)$months - 1;
}
	
	$allusers = Users::find('all',array(
		'fields'=>array($thismonth.'.Serial','mcaName','mcaNumber',$thismonth.'.Percent', 'Mobile',$thismonth.'.Level',$thismonth.'.BV',$thismonth.'.GBV',$thismonth.'.PGBV',$thismonth.'.TGBV',$thismonth.'.TCGBV',$thismonth.'.Rollup'),
		'order'=>array($thismonth.'.Serial'=>'ASC')
	));
	$users = array();
	foreach ($allusers as $u){
		$user = array(
			'mcaName'=>$u['mcaName'],
			'mcaNumber'=>$u['mcaNumber'],
			'Serial'=>$u[$thismonth]['Serial'],
			'Percent'=>$u[$thismonth]['Percent'],
			'Level'=>$u[$thismonth]['Level'],
			'Mobile'=>$u['Mobile'],
			'BV'=>$u[$thismonth]['BV'],
			'GBV'=>$u[$thismonth]['GBV'],
			'TGBV'=>$u[$thismonth]['TGBV'],
			'TCGBV'=>$u[$thismonth]['TCGBV'],
			'PGBV'=>$u[$thismonth]['PGBV'],
			'Rollup'=>$u[$thismonth]['Rollup'],
		);
		array_push($users,$user);
	}
	
	
	
		return $this->render(array('json' => array("users"=>$users)));		
	}
	public function events(){
		
		$datetime = gmdate('Y-m-d',time());
		
		$events = Events::find('all',array(
			'conditions'=>array('DateTime'=>array('$gte'=>$datetime)),
			'order'=>array('DateTime'=>'ASC')
		));
		$event = array();
		$allevents = array();
		foreach($events as $e){
			$event = array(
				'_id' => (string)$e['_id'],
				'DateTime' => (string)$e['DateTime'],
				'Event' => (string)$e['Event'],
				'Place' => (string)$e['Place'],
				'Address' => (string)$e['Address'],
				'City' => (string)$e['City'],
				'State' => (string)$e['State'],
				'Host' => (string)$e['Host'],
				'Topic' => (string)$e['Topic'],
				'Mobile' => (string)$e['Mobile'],
				'Review' => (string)$e['Review'],
				'EventDescription' => (string)$e['EventDescription'],
			);
			array_push($allevents,$event);
		}
		
		return $this->render(array('json' => array("events"=>$allevents)));		
	}

	public function event($id=null){
		$events = Events::find('first',array(
			'conditions'=>array('_id'=>(string)$id),
		));
		return $this->render(array('json' => array("events"=>$events)));		
	}

	public function productcategories(){
		$categories = Products::find('all',array(
			'fields'=>array('Category','Code'),
			'order'=>array('Category'=>'ASC')
		));
		$category = '';
		$allcategories = array();
		
		foreach($categories as $c){
			$count = Products::count(array(
				'Category'=>$c['Category']
			));
			
			
			$oldcategory = $c['Category'];
				if($category != $c['Category']){
					array_push($allcategories,array('Name'=>$c['Category'],'count'=>$count));
				}
				$category = $c['Category'];
		}
		return $this->render(array('json' => array("categories"=>$allcategories)));		
	}
	public function gproductcategories(){
		$categories = Products::find('all',array(
			'fields'=>array('g_Category','Code'),
			'order'=>array('Category'=>'ASC')
		));
		$category = '';
		$allcategories = array();
		
		foreach($categories as $c){
			$count = Products::count(array(
				'g_Category'=>$c['g_Category']
			));
			
			
			$oldcategory = $c['g_Category'];
				if($category != $c['g_Category']){
					array_push($allcategories,array('Name'=>$c['g_Category'],'count'=>$count));
				}
				$category = $c['g_Category'];
		}
		return $this->render(array('json' => array("categories"=>$allcategories)));		
	}
	
	public function products($category){
		$products = Products::find('all',array(
			'conditions'=>array('Category'=>rawurldecode(urldecode($category))),
			'order'=>array('Code'=>'ASC')
		));
		$product = array();
		$allproducts = array();
		foreach($products as $p){
			$product = array(
				'_id' => (string)$p['_id'],
				'Category' => (string)$p['Category'],
				'Code' => (string)$p['Code'],
				'Name' => (string)$p['Name'],
				'Size' => (string)$p['Size'],
				'MRP' => (string)$p['MRP'],
				'PV' => (string)$p['PV'],
				'DP' => (string)$p['DP'],
				'BV' => (string)$p['BV'],
				'Description' => (string)$p['Description'],
				'Video' => (string)$p['Video'],
			);
			array_push($allproducts,$product);
		}
		if(count($products)==1){
			array_push($allproducts,array());
		}
		return $this->render(array('json' => array("products"=>$allproducts)));		
	}
	public function gproducts($category){
		$products = Products::find('all',array(
			'conditions'=>array('g_Category'=>rawurldecode(urldecode($category))),
			'order'=>array('Code'=>'ASC')
		));
		$product = array();
		$allproducts = array();
		foreach($products as $p){
			$product = array(
				'_id' => (string)$p['_id'],
				'Category' => (string)$p['g_Category'],
				'Code' => (string)$p['Code'],
				'Name' => (string)$p['g_Name'],
				'Size' => (string)$p['Size'],
				'MRP' => (string)$p['MRP'],
				'PV' => (string)$p['PV'],
				'DP' => (string)$p['DP'],
				'BV' => (string)$p['BV'],
				'Description' => (string)$p['Description'],
				'Video' => (string)$p['Video'],
			);
			array_push($allproducts,$product);
		}
		if(count($products)==1){
			array_push($allproducts,array());
		}
		return $this->render(array('json' => array("products"=>$allproducts)));		
	}
	
	public function product($code){
		$product = Products::find('first',array(
			'conditions'=>array('Code'=>$code),
			'order'=>array('Code'=>'ASC')
		));
		return $this->render(array('json' => array("product"=>$product)));				
	}
	
	public function login($mcaNumber=null,$Mobile=null){
		$user = Users::find('first',array(
			'conditions'=>array(
				'mcaNumber'=>$mcaNumber,
			)
		));
		if(count($user)==1){
			$mobile = $user['Mobile'];
			if($mobile==""){
				$data = array('Mobile'=>$Mobile);
				$user = Users::find('all',array(
				'conditions'=>array(
				'mcaNumber'=>$mcaNumber,
					)
				))->save($data);
			}
			$user = Users::find('first',array(
			'conditions'=>array(
				'mcaNumber'=>$mcaNumber,
			)
		));
			$ga = new GoogleAuthenticator();
			$secret = $ga->createSecret(64);
			if($user['signinCodeused']=='Yes' || $user['signinCodeused']==""){
				$signinCode = $ga->getCode($secret);	
			}else{
				$signinCode = $user['signinCode'];
			}
			$data = array(
				'signinCode' => $signinCode,
				'signinCodeused' => 'No'
			);
			$user = Users::find('all',array(
						'conditions'=>array('mcaNumber'=>$mcaNumber)
			))->save($data);
			$user = Users::find('first',array(
			'conditions'=>array(
				'mcaNumber'=>$mcaNumber,
			)
			));
			$signinCode = $user['signinCode'];
			$Twilio = new Mobile();
			$msg = 'Please enter IndianEagles Log in password: '.$signinCode.' on the App login page.';
			
			$returnvalues = $Twilio->twilio("+91".$mobile,$msg,$signinCode);	 
			
		}
		return $this->render(array('json' => array("user"=>$user)));				
	}
	public function loginsms($mcaNumber=null,$Mobile=null){
		$user = Users::find('first',array(
			'conditions'=>array(
				'mcaNumber'=>$mcaNumber,
			)
		));
		if(count($user)==1){
			$mobile = $user['Mobile'];
			if($mobile==""){
				$data = array('Mobile'=>$Mobile);
				$user = Users::find('all',array(
				'conditions'=>array(
				'mcaNumber'=>$mcaNumber,
					)
				))->save($data);
			}
			$user = Users::find('first',array(
			'conditions'=>array(
				'mcaNumber'=>$mcaNumber,
			)
		));
			$ga = new GoogleAuthenticator();
			$secret = $ga->createSecret(64);
			if($user['signinCodeused']=='Yes' || $user['signinCodeused']==""){
				$signinCode = $ga->getCode($secret);	
			}else{
				$signinCode = $user['signinCode'];
			}
			$data = array(
				'signinCode' => $signinCode,
				'signinCodeused' => 'No'
			);
			$user = Users::find('all',array(
						'conditions'=>array('mcaNumber'=>$mcaNumber)
			))->save($data);
			$user = Users::find('first',array(
			'conditions'=>array(
				'mcaNumber'=>$mcaNumber,
			)
			));
			$signinCode = $user['signinCode'];
			$Twilio = new Mobile();
			$msg = $signinCode.' is the login code for the IndianEagles.Team mobile app, use it to validate your login.';
			$smsvalue = $Twilio->sendSms("+91".$mobile,$msg,$signinCode);
		}
		return $this->render(array('json' => array("user"=>$user)));				
	}
	public function validate($signinCode = null){
			$user = Users::find('first',array(
			'conditions'=>array(
				'signinCode'=>$signinCode
			)
			));
			if(count($user)>0){
				return $this->render(array('json' => array("user"=>$user)));				
			}else{
				return $this->render(array('json' => array("user"=>null)));				
			}
	}
	
		public function say($code){
		$newcode = '';
		for($i=0;$i<=strlen($code);$i++){
			$newcode = $newcode . substr($code,$i,1).',,,,,';
		}
		$layout = false;
		$view  = new View(array(
		'paths' => array(
			'template' => '{:library}/views/{:controller}/{:template}.{:type}.php',
			'layout'   => '{:library}/views/layouts/{:layout}.{:type}.php',
			)
			));
		
		echo $view->render(
		'all',
		compact('newcode'),
		array(
			'controller' => 'mobile',
			'template'=>'say',
			'type' => 'xml',
			'layout' =>'default'
			)
		);	
		return $this->render(array('layout' => false));
		exit;
//<Response>
//	<Say>Please enter GreenCoinX mobile phone verification code.
//	I repeat 3,4,5,6,9,1.
//	Again. 3,4,5,6,9,1.</Say>
//</Response>
	}
	public function states(){
		$distributors = Distributors::find('all',array(
		'order'=>array('State'=>'ASC','City'=>'ASC'),
	));
		
		$state = '';
		$allStates = array();
		foreach($distributors as $c){
			$oldState = $c['State'];
				if($state != $c['State']){
					array_push($allStates,$c['State']);
				}
				$state = $c['State'];
				
		}
		return $this->render(array('json' => array("States"=>$allStates)));				
	}
	
	public function distributors($state=null){
	$distributors = Distributors::find('all',array(
	 'conditions'=>array('State'=>rawurldecode(urldecode($state))),
		'order'=>array('State'=>'ASC','City'=>'ASC'),
	));
	$states = array();
		$allStates = array();
		foreach($distributors as $p){
			$states = array(
				'_id' => (string)$p['_id'],
				'State' => (string)$p['State'],
				'City' => (string)$p['City'],
				'Address' => (string)$p['Address'],
				'Mobile' => (string)$p['Mobile'],
			);
			array_push($allStates,$states);
		}
		
		return $this->render(array('json' => array("distributors"=>$allStates)));				
	}
	
	public function team($mcaNumber){
				$result = Users::find('all', array(
							'conditions'=>array('refer'=>$mcaNumber),
							'order'=>array('mcaName'=>'ASC')
				));
				
				$downline = array();
				foreach($result as $r){
					
					$countChild = $this->countChilds($r['mcaNumber']);
					array_push($downline,array(
						'Name'=>$r['mcaName'],
						'Number'=>$r['mcaNumber'],
						'DateJoin'=>$r['DateJoin'],
						'countChild'=>$countChild,
						'Days'=>(string)round((time()-strtotime($r['DateJoin']))/60/60/24,0)
					)
					);
				}
				$count = $this->countChilds($mcaNumber);				
				$team = array('Downline'=>$downline,'Count'=>$count);
		
		return $this->render(array('json' => array("team"=>$team)));				
	}
	public function downline($mcaNumber,$upline=null){
		$self = Users::find('first', array(
							'conditions'=>array('mcaNumber'=>$mcaNumber),
							'order'=>array('mcaName'=>'ASC')
				));
				$thismonth = date('Y-m',time());
				$startmonth = '2016-08';
				
				$d2 = date_create($thismonth.'-01');
				$d1 = date_create($startmonth.'-01');
				$interval = date_diff($d1, $d2);
				$months = $interval->format('%m months');

				
			
$GBV = array();
$GPV = array();
$BV = array();
$PV = array();
$selfline = array();


for ($i = (integer)$months; $i >=0 ; $i--){
		array_push($BV,
		array(
		'BV'.date('Y-m',mktime(0,0,0,gmdate('m',time()),gmdate('d',time()),gmdate('Y',time()))-$i*60*60*24*30).''=>
		$self[date('Y-m',mktime(0,0,0,gmdate('m',time()),gmdate('d',time()),gmdate('Y',time()))-$i*60*60*24*30).".BV"] 
		)
		);
		array_push($PV,
		array(
		'PV'.date('Y-m',mktime(0,0,0,gmdate('m',time()),gmdate('d',time()),gmdate('Y',time()))-$i*60*60*24*30).''=>
		$self[date('Y-m',mktime(0,0,0,gmdate('m',time()),gmdate('d',time()),gmdate('Y',time()))-$i*60*60*24*30).".PV"]
		)
		);
	
		array_push($GBV,
		array(
		'GBV'.date('Y-m',mktime(0,0,0,gmdate('m',time()),gmdate('d',time()),gmdate('Y',time()))-$i*60*60*24*30).''=>
		$this->addBV($self['mcaNumber'],date('Y-m',mktime(0,0,0,gmdate('m',time()),gmdate('d',time()),gmdate('Y',time()))-$i*60*60*24*30))
		)
		);
		array_push($GPV,
		array(
		'GPV'.date('Y-m',mktime(0,0,0,gmdate('m',time()),gmdate('d',time()),gmdate('Y',time()))-$i*60*60*24*30).''=>
		$this->addPV($self['mcaNumber'],date('Y-m',mktime(0,0,0,gmdate('m',time()),gmdate('d',time()),gmdate('Y',time()))-$i*60*60*24*30))
		)
		);
}
					$countChild = $this->countChilds($self['mcaNumber']);
					$getParents = $this->getParents($self['mcaNumber']);


					array_push($selfline,array(
						'Name'=>$self['mcaName'],
						'Number'=>$self['mcaNumber'],
						'DateJoin'=>$self['DateJoin'],
						'countChild'=>$countChild,
						'getParents'=>$getParents,
						'GPVs'=>$GPV,
						'GBVs'=>$GBV,
						'BVs'=>$BV,
						'PVs'=>$PV,
						'Days'=>(string)round((time()-strtotime($self['DateJoin']))/60/60/24,0)
					)
					);
				
				$result = Users::find('all', array(
							'conditions'=>array('refer'=>$mcaNumber),
							'order'=>array('mcaName'=>'ASC')
				));
				

$downline = array();
				foreach($result as $r){
					
					$countChild = $this->countChilds($r['mcaNumber']);
//					print_r(':'.$r['mcaNumber'].':');
					$getParents = $this->getParents($r['mcaNumber']);
					$addPV = $this->addPV($r['mcaNumber'],$thismonth);
	
					$addBV = $this->addBV($r['mcaNumber'],$thismonth);
					
$GBV = array();
$GPV = array();
$BV = array();
$PV = array();

for ($i = (integer)$months; $i >=0 ; $i--){
		array_push($BV,
		array(
		'BV'.date('Y-m',mktime(0,0,0,gmdate('m',time()),gmdate('d',time()),gmdate('Y',time()))-$i*60*60*24*30).''=>
		$r[date('Y-m',mktime(0,0,0,gmdate('m',time()),gmdate('d',time()),gmdate('Y',time()))-$i*60*60*24*30).".BV"]
		)
		);
		array_push($PV,
		array(
		'PV'.date('Y-m',mktime(0,0,0,gmdate('m',time()),gmdate('d',time()),gmdate('Y',time()))-$i*60*60*24*30).''=>
		$r[date('Y-m',mktime(0,0,0,gmdate('m',time()),gmdate('d',time()),gmdate('Y',time()))-$i*60*60*24*30).".PV"]
		)
		);
	
		array_push($GBV,
		array(
		'GBV'.date('Y-m',mktime(0,0,0,gmdate('m',time()),gmdate('d',time()),gmdate('Y',time()))-$i*60*60*24*30).''=>
		$this->addBV($r['mcaNumber'],date('Y-m',mktime(0,0,0,gmdate('m',time()),gmdate('d',time()),gmdate('Y',time()))-$i*60*60*24*30))
		)
		);
		array_push($GPV,
		array(
		'GPV'.date('Y-m',mktime(0,0,0,gmdate('m',time()),gmdate('d',time()),gmdate('Y',time()))-$i*60*60*24*30).''=>
		$this->addPV($r['mcaNumber'],date('Y-m',mktime(0,0,0,gmdate('m',time()),gmdate('d',time()),gmdate('Y',time()))-$i*60*60*24*30))
		)
		);
}

					
					array_push($downline,array(
						'Name'=>$r['mcaName'],
						'Number'=>$r['mcaNumber'],
						'DateJoin'=>$r['DateJoin'],
						'countChild'=>$countChild,
						'getParents'=>$getParents,
						'GPVs'=>$GPV,
						'GBVs'=>$GBV,
						'BVs'=>$BV,
						'PVs'=>$PV,
						'Days'=>(string)round((time()-strtotime($r['DateJoin']))/60/60/24,0)
					)
					);
				}
				$count = $this->countChilds($mcaNumber);
			 $levels = Levels::find('all');

				$uplines = Users::find('first',array(
					'conditions' => array('mcaNumber'=>$upline)
				));
				
				$upline = array(
					'mcaNumber'=>$uplines['mcaNumber'],
					'mcaName'=>$uplines['mcaName'],
					'refer'=>$uplines['refer'],
					'refer_name'=>$uplines['refer_name']
				);


		return $this->render(array('json' => array('users'=>
			array('count'=>$count,'selfline'=>$selfline,'downline'=>$downline,'upline'=>$upline)
		)));


	}

			public function getChilds($user_id){
	#Retrieving a Full Tree
	/* 	SELECT node.user_id
	FROM details AS node,
			details AS parent
	WHERE node.lft BETWEEN parent.lft AND parent.rgt
		   AND parent.user_id = 3
	ORDER BY node.lft;
	
	parent = db.details.findOne({user_id: ObjectId("50f19bc39d5d0ce409000012")});
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
		$NodeDetails = Users::find('all',array(
			'conditions' => array(
				'left'=>array('$gt'=>$left),
				'right'=>array('$lt'=>$right)
			),
			'order'=>array('left'=>'ASC')
			)
		);
		
		return $NodeDetails;
	}
	public function countActiveChilds($user_id,$month){
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
				'right'=>array('$lt'=>$right),
				$month.'.BV'=>array('$exists'=>1),
				$month.'.BV'=>array('$gt'=>0),
			))
		);
/*		
			print_r($user_id);
			print_r(":");
			print_r($month);
			print_r(":");
			print_r($NodeDetails);
			print_r(":::::");
*/			
		return $NodeDetails;
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
	public function getParents($user_id){
	#Retrieving a Single Path above a user
	/* SELECT parent.user_id
	FROM details AS node,
			details AS parent
	WHERE node.lft BETWEEN parent.lft AND parent.rgt
			AND node.user_id = 10
	ORDER BY node.lft;
	
	node = db.details.findOne({user_id: ObjectId("50e876e49d5d0cbc08000000")});
	query = {left: {$gt: node.left, $lt: node.right}};
	select = {user_id: 1};
	db.details.find(query,select).sort({left: 1})
	 */
			$NodeDetails = Users::find('first',array(
				'conditions'=>array(
				'mcaNumber' => $user_id
			)));
			$ancestors=array();
			foreach ($NodeDetails['ancestors'] as $n){
				array_push($ancestors, $n);
				
			}
			
		return $ancestors;
	}	
	public function userlist(){
		$users = Users::find('all',array(
			'order'=>array('mcaName'=>'ASC')
		));
		
		$list = array();
		foreach($users as $u){
			array_push($list,array(
				'mcaNumber'=>$u['mcaNumber'],
				'mcaName'=>$u['mcaName'],
			));
		}
		
		return $this->render(array('json' => array("list"=>$list)));				
	}
	public function message($fromMCA,$mcaNumber,$msg){
		$fromMCA = Users::find('first',array(
			'conditions'=>array('mcaNumber'=>$fromMCA)
		));
		$toMCA = Users::find('first',array(
			'conditions'=>array('mcaNumber'=>$mcaNumber)
		));
		$data = array(
			'fromMCANumber'=>$fromMCA['mcaNumber'],
			'fromMCAName'=>$fromMCA['mcaName'],
			'toMCANumber'=>$toMCA['mcaNumber'],
			'toMCAName'=>$toMCA['mcaName'],
			'msg'=>rawurldecode(urldecode($msg)),
			'DateTime'=>new \MongoDate(),
			'read'=>false,
			'delete'=>false,
		);
		Messages::create()->save($data);
		return $this->render(array('json' => array('message'=>'Yes')));				
	}
	public function messagedownline($fromMCA,$msg){
		
		$from = Users::find('first',array(
			'conditions'=>array('mcaNumber'=>$fromMCA)
		));
		$getChilds = $this->getChilds($fromMCA);
		
		foreach($getChilds as $t){
			
			$data = array(
			'fromMCANumber'=>$from['mcaNumber'],
			'fromMCAName'=>$from['mcaName'],
			'toMCANumber'=>$t['mcaNumber'],
			'toMCAName'=>$t['mcaName'],
			'msg'=>rawurldecode(urldecode($msg)),
			'DateTime'=>new \MongoDate(),
			'read'=>false,
			'delete'=>false,
		);
			Messages::create()->save($data);
		}
		return $this->render(array('json' => array('message'=>'Yes')));				
	}
	public function messageall($fromMCA,$msg){
		$fromMCA = Users::find('first',array(
			'conditions'=>array('mcaNumber'=>$fromMCA)
		));
		$toMCA = Users::find('all');
		foreach($toMCA as $t){
			$data = array(
			'fromMCANumber'=>$fromMCA['mcaNumber'],
			'fromMCAName'=>$fromMCA['mcaName'],
			'toMCANumber'=>$t['mcaNumber'],
			'toMCAName'=>$t['mcaName'],
			'msg'=>rawurldecode(urldecode($msg)),
			'DateTime'=>new \MongoDate(),
			'read'=>false,
			'delete'=>false,

		);
			Messages::create()->save($data);
		}
		
		return $this->render(array('json' => array('message'=>'Yes')));				
	}
	public function messages($mcaNumber){
		$messages = Messages::find('all',array(
			'conditions'=>array(
				'toMCANumber' => $mcaNumber,
				'delete'=> false
			),
			'order'=>array('DateTime'=>'DESC')
		));
		$message = array();
		$tomessage = array();
		foreach($messages as $m){
				$tomsg = Messages::find('all',array(
				'conditions'=>array(
					'fromMCANumber' => $mcaNumber,
					'toMCANumber'=>$m['toMCANumber'],
					'delete'=> false
				),
				'order'=>array('DateTime'=>'DESC')
				));
				date_default_timezone_set('Asia/Kolkata');
				foreach($tomsg as $t){
					array_push($tomessage,
				array(
					'_id'=>(string)'_'.$m['_id'],
					'myMessage'=>$tomsg,
					'fromMCANumber'=>$m['fromMCANumber'],
					'fromMCAName'=>$m['fromMCAName'],
					'toMCANumber'=>$m['toMCANumber'],
					'toMCAName'=>$m['toMCAName'],
					'msg'=>$m['msg'],
					'DateTime'=>date('r',$m['DateTime']->sec),
					'read'=>$m['read'],
					'delete'=>$m['delete'],
				)
			);
				}
			
			array_push($message,
				array(
					'_id'=>(string)'_'.$m['_id'],
					'myMessage'=>$tomessage,
					'fromMCANumber'=>$m['fromMCANumber'],
					'fromMCAName'=>$m['fromMCAName'],
					'toMCANumber'=>$m['toMCANumber'],
					'toMCAName'=>$m['toMCAName'],
					'msg'=>$m['msg'],
					'DateTime'=>date('r',$m['DateTime']->sec),
					'read'=>$m['read'],
					'delete'=>$m['delete'],
				)
			);
		}
		return $this->render(array('json' => array('messages'=>$message)));				
	}
	public function deleteMessage($id){
		$data = array(
			'delete'=> true
		);
		$conditions = array(
			'_id'=>substr($id,1)
		);
		
		Messages::update($data,$conditions);
		return $this->render(array('json' => array('success'=>'Yes')));				
	}
	public function readMessage($id){
		$data = array(
			'read'=> true
		);
		$conditions = array(
			'_id'=>substr($id,1)
		);
		
		Messages::update($data,$conditions);
		return $this->render(array('json' => array('success'=>'Yes')));				
	}
	public function addevent($date,$time,$topic,$event,$place,$address,$city,$state,$host,$mobile,$description ){
		$ndate=date_create_from_format("Y-m-d",rawurldecode(urldecode($date)));
		$ntime=date_create_from_format("H:i",rawurldecode(urldecode($time)));


		$data = array(
			'DateTime'=>date_format($ndate,"Y-m-d")." ".date_format($ntime,"h:i a"),
			'Topic'=>rawurldecode(urldecode($topic)),
			'Event'=>rawurldecode(urldecode($event)),
			'Place'=>rawurldecode(urldecode($place)),
			'Address'=>rawurldecode(urldecode($address)),
			'City'=>rawurldecode(urldecode($city)),
			'State'=>rawurldecode(urldecode($state)),
			'Host'=>rawurldecode(urldecode($host)),
			'Mobile'=>rawurldecode(urldecode($mobile)),
			'EventDescription'=>rawurldecode(urldecode($description)),
		);
		Events::create()->save($data);
		return $this->render(array('json' => array('success'=>'Yes')));
	}
	public function bv($mcaNumber,$upline=null){
		$self = Users::find('first', array(
							'conditions'=>array('mcaNumber'=>$mcaNumber),
							'order'=>array('mcaName'=>'ASC')
				));
				$thismonth = date('Y-m',time());
				$startmonth = '2016-08';
				
				$d2 = date_create($thismonth.'-01');
				$d1 = date_create($startmonth.'-01');
				$interval = date_diff($d1, $d2);
								$months = (integer)$interval->format('%m months') + (integer)$interval->format('%y years')*12;
				
$selfline=array();
$GBV = array();
$GPV = array();
$BV = array();
$PV = array();
$activeChilds = array();
$designation = array();
for ($i = (integer)$months; $i >=0 ; $i--){
	
		array_push($BV,
		array(
		'BV'.date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).''=>
		$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".BV"] 
		)
		);
		array_push($PV,
		array(
		'PV'.date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).''=>
		$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".PV"]
		)
		);
		array_push($GBV,
		array(
		'GBV'.date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).''=>
		$this->addBV($self['mcaNumber'],date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ))
		)
		);
		array_push($GPV,
		array(
		'GPV'.date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).''=>
		$this->addPV($self['mcaNumber'],date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ))
		)
		);
		array_push($activeChilds,
		array(
		'AC'.date('Y-m',date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) )).''=>
		$this->countActiveChilds($self['mcaNumber'],date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ))
		)
		);
		array_push($designation,
		array('DS'.date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).''=>
		$this->designation($self['mcaNumber'],date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ))
		)
		);
		
}
					$countChild = $this->countChilds($self['mcaNumber']);
					
					$getParents = $this->getParents($self['mcaNumber']);


					array_push($selfline,array(
						'Name'=>$self['mcaName'],
						'Number'=>$self['mcaNumber'],
						'DateJoin'=>$self['DateJoin'],
						'countChild'=>$countChild,
						'getParents'=>$getParents,
						'GPVs'=>$GPV,
						'GBVs'=>$GBV,
						'BVs'=>$BV,
						'PVs'=>$PV,
						'ACs'=>$activeChilds,
						'Mobile'=>$self['Mobile'],
						'Days'=>(string)round((time()-strtotime($self['DateJoin']))/60/60/24,0),
						'DSs'=>$designation
					)
					);
				
				$result = Users::find('all', array(
							'conditions'=>array('refer'=>$mcaNumber),
							'order'=>array('mcaName'=>'ASC')
				));
	

$downline = array();
				foreach($result as $r){
					
					$countChild = $this->countChilds($r['mcaNumber']);
					$countActiveChild = $this->countActiveChilds($r['mcaNumber']);
//					print_r(':'.$r['mcaNumber'].':');
					$getParents = $this->getParents($r['mcaNumber']);
					$addPV = $this->addPV($r['mcaNumber'],$thismonth);
	
					$addBV = $this->addBV($r['mcaNumber'],$thismonth);
					
$GBV = array();
$GPV = array();
$BV = array();
$PV = array();
$activeChilds = array();
$designation = array();
for ($i = (integer)$months; $i >=0 ; $i--){
		array_push($BV,
		array(
		'BV'.date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).''=>
		$r[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".BV"]
		)
		);
		array_push($PV,
		array(
		'PV'.date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).''=>
		$r[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".PV"]
		)
		);
	
		array_push($GBV,
		array(
		'GBV'.date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).''=>
		$this->addBV($r['mcaNumber'],date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ))
		)
		);
		array_push($GPV,
		array(
		'GPV'.date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).''=>
		$this->addPV($r['mcaNumber'],date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ))
		)
		);
		array_push($activeChilds,
		array(
		'AC'.date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).''=>
		$this->countActiveChilds($r['mcaNumber'],date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ))
		)
		);
				array_push($designation,
		array('DS'.date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).''=>
		$this->designation($r['mcaNumber'],date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ))
		)
		);

}

					
					array_push($downline,array(
						'Name'=>$r['mcaName'],
						'Number'=>$r['mcaNumber'],
						'DateJoin'=>$r['DateJoin'],
						'countChild'=>$countChild,
						'getParents'=>$getParents,
						'GPVs'=>$GPV,
						'GBVs'=>$GBV,
						'BVs'=>$BV,
						'PVs'=>$PV,
						'ACs'=>$activeChilds,
						'Mobile'=>$r['Mobile'],
						'Days'=>(string)round((time()-strtotime($r['DateJoin']))/60/60/24,0),
						'DSs'=>$designation
					)
					);
				}
				$count = $this->countChilds($mcaNumber);
				$uplines = Users::find('first',array(
					'conditions' => array('mcaNumber'=>$upline)
				));
				
				$upline = array(
					'mcaNumber'=>$uplines['mcaNumber'],
					'mcaName'=>$uplines['mcaName'],
					'refer'=>$uplines['refer'],
					'refer_name'=>$uplines['refer_name']
				);
			$levels = Levels::find('all',array(
				'order'=>array('Level'=>'DESC')
			));
			$alllevels = array();
			foreach($levels as $l){
				array_push($alllevels,array(
					'Level'=>$l['Level'],
					'Min'=>$l['Min'],
					'Max'=>$l['Max'],
					'Status'=>$l['Status']
				));
			}
	
		return $this->render(array('json' => array('users'=>					array('count'=>$count,'selfline'=>$selfline,'downline'=>$downline,'upline'=>$upline,'levels'=>$alllevels)		)));
	}
	public function addPV($user_id,$month){

		$ParentDetails = Users::find('first',array(
			'conditions'=>array(
			'mcaNumber' => $user_id
			)));
			$left = $ParentDetails['left'];
			$right = $ParentDetails['right'];
			$NodeDetails = Users::find('all',array(
			'conditions' => array(
				'left'=>array('$gt'=>$left),
				'right'=>array('$lt'=>$right)
			),
			'order'=>array('left'=>'ASC')
			)
		);
//		print_r($user_id);
//		print_r('##'.count($NodeDetails).'##');
		$sumPV = 0;
					foreach($NodeDetails as $nd){
						$sumPV = $sumPV + $nd[$month]['PV'];
//						print_r("&&".$nd['mcaName'].":");
//						print_r("".$nd[$month]['PV']."^^");
					}
					
					
//					print_r($sumPV);
//					print_r('\n');
		return $sumPV;
		
}
	public function addBV($user_id,$month){

			$ParentDetails = Users::find('first',array(
				'conditions'=>array(
				'mcaNumber' => $user_id
				)));
				$left = $ParentDetails['left'];
				$right = $ParentDetails['right'];
				$NodeDetails = Users::find('all',array(
				'conditions' => array(
					'left'=>array('$gt'=>$left),
					'right'=>array('$lt'=>$right)
				),
				'order'=>array('left'=>'ASC')
				)
			);
			$sumBV = 0;
			foreach($NodeDetails as $nd){
				$sumBV = $sumBV + $nd[$month]['BV'];
			}
			return $sumBV;
	}
	public function level($user_id,$month){
			$ParentDetails = Users::find('first',array(
				'conditions'=>array(
				'mcaNumber' => $user_id
				)));
				$left = $ParentDetails['left'];
				$right = $ParentDetails['right'];
				$NodeDetails = Users::find('all',array(
				'conditions' => array(
					'left'=>array('$gt'=>$left),
					'right'=>array('$lt'=>$right)
				),
				'order'=>array('left'=>'ASC')
				)
			);
			$sumBV = 0;
				$d2 = date_create($month.'-01');
				$d1 = date_create('2016-08-01');
				$interval = date_diff($d1, $d2);
				$months = $interval->format('%m months');
			
			for ($i = 0;$i<=(integer)$months;  $i++){
				foreach($NodeDetails as $nd){
					$sumBV = $sumBV + $nd[date("Y-m", strtotime($i." month", strtotime(date('Y-F',$d1->gettimestamp()) . "-1")) )]['BV'] ;
				}
				$sumBV = $sumBV + $ParentDetails[date("Y-m", strtotime($i." month", strtotime(date('Y-F',$d1->gettimestamp()) . "-1")) )]['BV'];
			}
	$levels = Levels::find('all',array(
				'order'=>array('Level'=>'DESC')
			));
			$alllevels = array();
			foreach($levels as $l){
				array_push($alllevels,array(
					'Level'=>$l['Level'],
					'Min'=>$l['Min'],
					'Max'=>$l['Max'],
					'Status'=>$l['Status']
				));
			}
			
			foreach($alllevels as $l){
				if($sumBV >= $l['Min'] && $sumBV <=$l['Max']){
					$selfLevel = array(
					'Level'=>$l['Level'],
					'Status'=>$l['Status'],
				);
				}
			}			
			
			return array('sumBV'=>$sumBV,'selfLevel'=>$selfLevel);
//			return $sumBV;
	}
	public function designation($user_id,$month){
		$ParentDetails = Users::find('first',array(
				'conditions'=>array(
				'mcaNumber' => $user_id
				)));

				$d2 = date_create($month.'-01');
				$d1 = date_create('2016-08-01');
				$interval = date_diff($d1, $d2);
				$months = $interval->format('%m months');
			
			$Xdesignation = array();
					array_push($Xdesignation, 
					array(
					'Level'=>$ParentDetails[$month]['Level']?:"",
					'ValidTitle'=>$ParentDetails[$month]['ValidTitle']?:"",
					'PaidTitle'=>$ParentDetails[$month]['PaidTitle']?:"",
					'Percent'=>$ParentDetails[$month]['Percent']?:"",
					'TCGBV'=>$ParentDetails[$month]['TCGBV']?:"",
					'TGBV'=>$ParentDetails[$month]['TGBV']?:"",
					'GBV'=>$ParentDetails[$month]['GBV']?:"",
					'PGBV'=>$ParentDetails[$month]['PGBV']?:"",
					'Rollup'=>$ParentDetails[$month]['Rollup']?:"",
					)
					);
				
//			print_r($designation);
			return $Xdesignation;
	}
	public function messagesCount($mcaNumber=null){
			$count = Messages::find('count',array(
					'toMCANumber'=>$mcaNumber,
					'delete'=>false,
					'read'=>false
			));
			return $this->render(array('json' => array('messages'=>
				array('count'=>$count)
			)));
	}
	public function favorites($mcaNumber =null){
		$user = Users::find('first',array(
			'conditions'=>array('mcaNumber'=>$mcaNumber)
		));
		$favorite = array();
		$userfavorite = $user['favorite'] ;
			foreach($userfavorite as $uf){
					array_push($favorite,$uf);
		}
		$products = Products::find('all',array(
			'conditions'=>array('Code'=>$favorite),
			'order'=>array('Code'=>'ASC')
		));
		
		$product = array();
		$allproducts = array();
		foreach($products as $p){
			$product = array(
				'_id' => (string)$p['_id'],
				'Category' => (string)$p['Category'],
				'Code' => (string)$p['Code'],
				'Name' => (string)$p['Name'],
				'Size' => (string)$p['Size'],
				'MRP' => (string)$p['MRP'],
				'PV' => (string)$p['PV'],
				'DP' => (string)$p['DP'],
				'BV' => (string)$p['BV'],
				'Description' => (string)$p['Description'],
				'Video' => (string)$p['Video'],
			);
			array_push($allproducts,$product);
		}
		if(count($products)==1){
			array_push($allproducts,array());
		}

			return $this->render(array('json' => array('products'=>$allproducts
			)));
	}
	public function favorite($Code=null,$mcaNumber=null){
		$user = Users::find('first',array(
			'conditions'=>array('mcaNumber'=>$mcaNumber)
		));
		
		$favorite = array();
		if($user['favorite']=="" || $user['favorite']==null){
		}else{
			$userfavorite = $user['favorite'] ;
			foreach($userfavorite as $uf){
					array_push($favorite,$uf);
			}
		}
		array_push($favorite,$Code);		
		
		$favorite = array_unique($favorite);
		
		$conditions = array('mcaNumber'=>(string)$mcaNumber);
		
		$data = array('favorite'=>$favorite);
		
		$user = Users::find('all',array(
						'conditions'=>array('mcaNumber'=>(string)$mcaNumber)
			))->save($data);
			return $this->render(array('json' => array('status'=>"Yes"
			)));
		
	}
	public function delfavorite($Code=null,$mcaNumber=null){
		$user = Users::find('first',array(
			'conditions'=>array('mcaNumber'=>$mcaNumber)
		));
		
		$favorite = array();
		if($user['favorite']=="" || $user['favorite']==null){
		}else{
			$userfavorite = $user['favorite'] ;
			foreach($userfavorite as $uf){
				if($uf!=$Code){
					array_push($favorite,$uf);
				}
			}
		}
		$favorite = array_unique($favorite);
		
		$conditions = array('mcaNumber'=>(string)$mcaNumber);
		
		$data = array('favorite'=>$favorite);
		
		$user = Users::find('all',array(
						'conditions'=>array('mcaNumber'=>(string)$mcaNumber)
			))->save($data);
			return $this->render(array('json' => array('status'=>"Yes"
			)));
		
	}
	public function showcart($codes,$mcaNumber){
		$codes = rawurldecode(urldecode($codes));
		$products = explode(",",$codes);
		$product = array();
		$quantity = array();
		foreach($products as $p){
			$productCode = explode(":",$p);
			array_push($product,$productCode[0]);
			array_push($quantity,$productCode[1]);
		}
		$orders = Products::find('all',array(
			'conditions'=>array('Code'=>array('$in'=>$product))
		));
		$allorders = array();
		foreach($orders as $o){
			$needle = array_search($o['Code'],$product);
			$order = array(
				'_id' => (string)$o['_id'],
				'Category' => (string)$o['Category'],
				'Code' => (string)$o['Code'],
				'Name' => (string)$o['Name'],
				'g_Name' => (string)$o['g_Name'],
				'Size' => (string)$o['Size'],
				'MRP' => (string)$o['MRP'],
				'PV' => (string)$o['PV'],
				'DP' => (string)$o['DP'],
				'BV' => (string)$o['BV'],
				'Quantity'=>$quantity[$needle],
			);
			array_push($allorders,$order);
		}
		return $this->render(array('json' => array('product'=>$allorders
		)));
		
	}
	public function dpaddress(){
		$distributors = Distributors::find('all',array(
			'conditions'=>array('IET'=>'YES')
		));
		$distributor = array();
		$alldistributors = array();
		foreach($distributors as $d){
			$distributor = array(
				'_id' => (string)$d['_id'],
				'State' => (string)$d['State'],
				'City' => (string)$d['City'],
				'Address' => (string)$d['Address'],
				'Mobile' => (string)$d['Mobile'],
				'PayTM' => (string)$d['PayTM'],
				'email' => (string)$d['email'],
				'Name' => (string)$d['Name'],
			);
			array_push($alldistributors,$distributor);
		}		
		return $this->render(array('json' => array('distributors'=>$alldistributors
		)));
	}
	public function sendpayment($cart=null,$mcaNumber=null,$mcaName=null,$email=null,$mobile=null,$address=null,$city=null,$state=null,$orderNo=null,$collect=null,$dpPoint=null){
		$cart = rawurldecode(urldecode($cart));
		
		$mcaNumber = rawurldecode(urldecode($mcaNumber));
		$mcaName = rawurldecode(urldecode($mcaName));
		$email = rawurldecode(urldecode($email));
		$mobile = rawurldecode(urldecode($mobile));
		$address = rawurldecode(urldecode($address));
		$city = rawurldecode(urldecode($city));
		$state = rawurldecode(urldecode($state));
		$orderNo = rawurldecode(urldecode($orderNo));
		$collect = rawurldecode(urldecode($collect));
		$dpPoint = rawurldecode(urldecode($dpPoint));
		
	
		//create cart start
		$products = explode(",",$cart);
		$product = array();
		$quantity = array();
		foreach($products as $p){
			$productCode = explode(":",$p);
			array_push($product,$productCode[0]);
			array_push($quantity,$productCode[1]);
		}
		$orders = Products::find('all',array(
			'conditions'=>array('Code'=>array('$in'=>$product)),
			'order'=>array('Code'=>'ASC')
		));
		$allorders = array();
		foreach($orders as $o){
			$needle = array_search($o['Code'],$product);
			$order = array(
				'_id' => (string)$o['_id'],
				'Category' => (string)$o['Category'],
				'Code' => (string)$o['Code'],
				'Name' => (string)$o['Name'],
				'Size' => (string)$o['Size'],
				'MRP' => (string)$o['MRP'],
				'PV' => (string)$o['PV'],
				'DP' => (string)$o['DP'],
				'BV' => (string)$o['BV'],
				'Quantity'=>$quantity[$needle],
			);
			array_push($allorders,$order);
		}
		//create cart end
		
		if($collect == "home"){
			$dpPoint = "";
			$dpdetails = array();
			
		}
		if($collect == "dp"){
			$dp = Distributors::find('first',array(
				'conditions'=>array('_id'=>(string)$dpPoint)
			));
			$dpdetails = array(
				'State'=>$dp['State'],
				'City'=>$dp['City'],
				'Address'=>$dp['Address'],
				'Mobile'=>$dp['Mobile'],				
				'Email'=>$dp['email'],
				'PayTM'=>$dp['PayTM'],
				'Name'=>$dp['Name'],
			);
		}
		$result = array(
			'user'=>array(
					'email'=>$email,
					'mobile'=>$mobile,
					'mcaName'=>$mcaName,
					'mcaNumber'=>$mcaNumber,
					'address'=>$address,
					'city'=>$city,
					'state'=>$state,
			),
			'orderNo'=>$orderNo,
			'collect'=>$collect,
			'allorders'=>$allorders,
			'dpdetails'=>$dpdetails
		);
		Orders::create()->save($result);
		
		$view  = new View(array(
		'paths' => array(
			'template' => '{:library}/views/{:controller}/{:template}.{:type}.php',
			'layout'   => '{:library}/views/layouts/{:layout}.{:type}.php',
		)
		));
	
		echo $view->render(
		'all',
		compact('result'),
		array(
			'controller' => 'mobile',
			'template'=>'order',
			'type' => 'pdf',
			'layout' =>'print'
		)
		);	
		$pdffile = OUTPUT_DIR.'Order-'.trim($orderNo).'-IET.pdf';
		$send = $this->sendemail($result,$pdffile);  //Order-IET866607-IET;
		
		unlink ($pdffile);
		return $this->render(array('json' => array('result'=>$result)));
	}
	public function sendorderemail($orderNo,$email,$dpemail){
		$data = array(
			'user'=>array(
				'email'=>$email
			),
			'dpdetails'=>array(
				'Email'=>$dpemail
			)
		);
		$pdffile = OUTPUT_DIR.'Order-'.trim($orderNo).'-IET.pdf';
		$send = $this->sendemail($data,$pdffile);  //Order-IET866607-IET;
		return $this->render(array('json' => array('result'=>$data)));
	}
	public function sendemail($data,$file1=null,$file2=null,$file3=null){
				$email = $data['user']['email'];
		
				$function = new Functions();
				$compact = array('data'=>$data);
				$from = array(NOREPLY => "noreply");
				$email = $email;
				
			if($data['dpdetails']['Email']==""){
					$function->sendEmailTo($email,$compact,'mobile','order',"IndianEagles.Team-Order",$from,'ruchi.doctor.modicare@gmail.com','nilamdoc@gmail.com',null,$file1);
			}else{
					$function->sendEmailTo($email,$compact,'mobile','order',"IndianEagles.Team-Order",$from,'ruchi.doctor.modicare@gmail.com',$data['dpdetails']['Email'],'nilamdoc@gmail.com',$file1);
			}
			return true;
	}
	public function active($mcaNumber=null,$month=null){
		$ParentDetails = Users::find('all',array(
			'conditions'=>array(
			'mcaNumber' => $mcaNumber
			)));
		foreach($ParentDetails as $pd){
			$left = $pd['left'];
			$right = $pd['right'];
		}
		$NodeDetails = Users::find('all',array(
			'conditions' => array(
				'left'=>array('$gt'=>$left),
				'right'=>array('$lt'=>$right),
				$month.'.BV'=>array('$exists'=>1),
				$month.'.BV'=>array('$gt'=>0),
			),
			'order'=>array($month.'.BV'=>'DESC')
			)
		);
		$allND = array();
		foreach($NodeDetails as $nd){
			$newND = array(
				'mcaNumber'=>(string)$nd['mcaNumber'],
				'mcaName'=>(string)$nd['mcaName'],
				$month=>array('BV'=>$nd[$month]['BV']?:0),
				'refer_name'=>(string)$nd['refer_name'],
				'refer_id'=>(string)$nd['refer'],
			);
			array_push($allND,$newND);
		}
		
		$NotPerforming = Users::find('all',array(
			'conditions' => array(
				'left'=>array('$gt'=>$left),
				'right'=>array('$lt'=>$right),
				$month.'.BV'=>0,
				
			),
			'order'=>array('mcaName'=>'ASC')
			)
		);
		
		$allNPD = array();
		foreach($NotPerforming as $npd){
			$newNPD = array(
				'mcaNumber'=>(string)$npd['mcaNumber'],
				'mcaName'=>(string)$npd['mcaName'],
					$month=>array('BV'=>$npd[$month]['BV']?:0),
				'refer_name'=>(string)$npd['refer_name'],
				'refer_id'=>(string)$npd['refer'],
			);
			array_push($allNPD,$newNPD);
		}
		
		return $this->render(array('json' => array('result'=>$allND,'notPerformaing'=>$allNPD)));
	}
	
	function display_tree($root) {  
    // retrieve the left and right value of the $root node  
				// $result = mysql_query('SELECT lft, rgt FROM tree '.  'WHERE title="'.$root.'";');  
				$result = Users::find('first',array(
					'conditions' => array('mcaNumber'=>$root),
					'fields' => array('left','right', )
				));
    // $row = mysql_fetch_array($result);  

    // start with an empty $right stack  

     

    // now, retrieve all descendants of the $root node  

    // $result = mysql_query('SELECT title, lft, rgt FROM tree '.'WHERE lft BETWEEN '.$row['lft'].' AND '.$row['rgt'].' ORDER BY lft ASC;');  
				$next = Users::find('all',array(
					'conditions'=>array(
						'left'=>array('$gt'=>$result['left']),
						'right'=>array('$lt'=>$result['right']),
					),
					'fields'=>array('mcaName','mcaNumber','left','right'),
					'order'=>array('left'=>'ASC')
				));
				
    // display each row  
				foreach($next as $n){
					//$right = array();  
					if(count($right)>0){
						 while ($right[count($right)-1]>$n['right']) {  
								array_pop($right);  
							}
					}
					echo str_repeat('-',count($right)).$n['mcaName'].'-'.$n['mcaNumber']."<br>";  
					$right[] = $n['right'];  
				}
					
					
    // while ($row = mysql_fetch_array($result)) {  
        // only check stack if there is one  
        // if (count($right)>0) {  
        // check if we should remove a node from the stack  
        // while ($right[count($right)-1]<$row['rgt']) {  
         // array_pop($right);  
								// }  
       // }  

        // display indented node title  
        // echo str_repeat('  ',count($right)).$row['title']."n";  
        // add this node to the stack  
								// $right[] = $row['rgt'];  
							return $this->render(array('json' => array('result'=>$right)));
    }  

		public function listProducts($order,$category=null){
			if($category==null){
			$products = Products::find('all',array(
			'fields'=>array('Code','Name','MRP','DP','BV','PV','Category','Size'),
			'order'=>array($order=>"ASC")
			));
			}else{
				if($category=='All'){
						$products = Products::find('all',array(
						'fields'=>array('Code','Name','MRP','DP','BV','PV','Category','Size'),
						'order'=>array(
							'Category'=>'ASC',
							$order=>"ASC"
							)
						));
				}else{
						$products = Products::find('all',array(
						'conditions'=>array('Category'=>$category),
						'fields'=>array('Code','Name','MRP','DP','BV','PV','Category','Size'),
						'order'=>array(
							'Category'=>'ASC',
							$order=>"ASC"
							)
						));
				}
			}
		$categories = Products::find('all',array(
			'fields'=>array('Category','Code'),
			'order'=>array('Category'=>'ASC')
		));
		$category = '';
		$allcategories = array();
		
		foreach($categories as $c){
			$count = Products::count(array(
				'Category'=>$c['Category']
			));
			
			
			$oldcategory = $c['Category'];
				if($category != $c['Category']){
					array_push($allcategories,array('Name'=>$c['Category'],'count'=>$count));
				}
				$category = $c['Category'];
		}
			
			return $this->render(array('json' => array('result'=>$products,'categories'=>$allcategories)));
		}
		public function upline($mcaNumber=null){
			$users = Users::find('first',array(
				'conditions' => array('mcaNumber'=>$mcaNumber),
				'order'=>array('DateJoin'=>'ASC')
			));
			$ancestors = array();
			foreach($users['ancestors'] as $u){
				array_push($ancestors,$u);
			}
			$self = Users::find('first', array(
							'conditions'=>array('mcaNumber'=>$mcaNumber),
							'order'=>array('mcaName'=>'ASC')
				));
			
			$uplines = Users::find('all',array(
				'conditions'=>array('mcaNumber'=>array('$in'=>$ancestors)),
				'order'=>array('DateJoin'=>'DESC')
			));
			$upline = array();
			$thismonth = date('Y-m',time());
				$startmonth = '2016-08';
			
				$d2 = date_create($thismonth.'-01');
				$d1 = date_create($startmonth.'-01');
				$interval = date_diff($d1, $d2);
								$months = (integer)$interval->format('%m months') + (integer)$interval->format('%y years')*12;


		$selfline = array();
$GBV = array();
$GPV = array();
$BV = array();
$PV = array();
$activeChilds = array();



for ($i = (integer)$months; $i >=0 ; $i--){
	
		array_push($BV,
		array(
		'BV'.date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).''=>
		$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".BV"] 
		)
		);
		array_push($PV,
		array(
		'PV'.date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).''=>
		$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".PV"]
		)
		);
		array_push($GBV,
		array(
		'GBV'.date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).''=>
		$this->addBV($self['mcaNumber'],date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ))
		)
		);
		array_push($GPV,
		array(
		'GPV'.date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).''=>
		$this->addPV($self['mcaNumber'],date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ))
		)
		);
		array_push($activeChilds,
		array(
		'AC'.date('Y-m',date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) )).''=>
		$this->countActiveChilds($self['mcaNumber'],date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ))
		)
		);
}
					$countChild = $this->countChilds($self['mcaNumber']);
					
					$getParents = $this->getParents($self['mcaNumber']);


					array_push($selfline,array(
						'Name'=>$self['mcaName'],
						'Number'=>$self['mcaNumber'],
						'DateJoin'=>$self['DateJoin'],
						'countChild'=>$countChild,
						'getParents'=>$getParents,
						'GPVs'=>$GPV,
						'GBVs'=>$GBV,
						'BVs'=>$BV,
						'PVs'=>$PV,
						'ACs'=>$activeChilds,
						'Mobile'=>$self['Mobile'],
						'Days'=>(string)round((time()-strtotime($self['DateJoin']))/60/60/24,0)
					)
					);
		
foreach($uplines as $u){
$GBV = array();
$GPV = array();
$BV = array();
$PV = array();
$activeChilds = array();

					$countChild = $this->countChilds($u['mcaNumber']);
					$countActiveChild = $this->countActiveChilds($u['mcaNumber']);
//					print_r(':'.$r['mcaNumber'].':');
					$getParents = $this->getParents($u['mcaNumber']);
					$addPV = $this->addPV($u['mcaNumber'],$thismonth);
	
					$addBV = $this->addBV($u['mcaNumber'],$thismonth);




for ($i = (integer)$months; $i >=0 ; $i--){
		array_push($BV,
		array(
		'BV'.date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).''=>
		$u[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".BV"]
		)
		);
		array_push($PV,
		array(
		'PV'.date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).''=>
		$u[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".PV"]
		)
		);
	
		array_push($GBV,
		array(
		'GBV'.date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).''=>
		$this->addBV($u['mcaNumber'],date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ))
		)
		);
		array_push($GPV,
		array(
		'GPV'.date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).''=>
		$this->addPV($u['mcaNumber'],date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ))
		)
		);
		array_push($activeChilds,
		array(
		'AC'.date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).''=>
		$this->countActiveChilds($u['mcaNumber'],date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ))
		)
		);
}
				
				array_push($upline,array(
					'Name'=>$u['mcaName'],
					'Number'=>$u['mcaNumber'],
					'DateJoin'=>$u['DateJoin'],
					'Mobile'=>$u['Mobile'],
					'countChild'=>$countChild,
						'GPVs'=>$GPV,
						'GBVs'=>$GBV,
						'BVs'=>$BV,
						'PVs'=>$PV,
						'ACs'=>$activeChilds,
					'Days'=>(string)round((time()-strtotime($u['DateJoin']))/60/60/24,0)
				));
			}
			
			$levels = Levels::find('all',array(
				'order'=>array('Level'=>'DESC')
			));
			$alllevels = array();
			foreach($levels as $l){
				array_push($alllevels,array(
					'Level'=>$l['Level'],
					'Min'=>$l['Min'],
					'Max'=>$l['Max'],
					'Status'=>$l['Status']
				));
			}
	
		return $this->render(array('json' => array('users'=>					array('count'=>count($uplines),'selfline'=>$selfline,'downline'=>$upline,'levels'=>$alllevels)		)));
		}
		public function myteam($mcaNumber,$upline=null,$whois=null){
		
			$self = Users::find('first', array(
				'conditions'=>array('mcaNumber'=>(string)$whois),
			));
		$mcaName = $self['mcaName'];
		$check = Users::find('first', array(
				'conditions'=>array('mcaNumber'=>(string)$mcaNumber),
			));
			$myName = $check['mcaName'];
		$appData = array();
		foreach($self['app'] as $a){
			if($a['mcaNumber']!=$mcaNumber){
			$data = array(
				'mcaNumber'=>$a['mcaNumber'],
				'mcaName'=>$a['mcaName'],
				'DateTime'=>$a['DateTime'],
				'mySelf'=>$a['mySelf'],
				'myName'=>$a['myName'],
			);
			array_push($appData,$data);
			}
		};
		
			$data = array(
					'mcaNumber'=>(string)$mcaNumber,
					'mcaName'=>(string)$myName,
					'DateTime'=> gmdate('Y-m-d H:i:s',time()+strtotime('+330 minutes', 0)),
					'mySelf' => (string)$whois,
					'myName' => $mcaName
			);
			array_push($appData,$data);
		
		$data = array(
			'app'=>$appData
		);
			$conditions = array('mcaNumber'=>(string)$whois);
			
			Users::update($data,$conditions);
			
			$self = Users::find('first', array(
				'conditions'=>array('mcaNumber'=>(string)$mcaNumber),
				'order'=>array('mcaName'=>'ASC')
			));

			$left = $self['left'];
			$right = $self['right'];
			
			$ancestors = array();
			foreach($self['ancestors'] as $u){
				array_push($ancestors,$u);
			}
			$count = $this->countChilds($mcaNumber);
			$thismonth = date('Y-m',strtotime("0 month", strtotime(date("F") . "1")));
//			print_r($thismonth);
				$startmonth = '2016-08';
				$d2 = date_create($thismonth.'-01');
				$d1 = date_create($startmonth.'-01');
				$interval = date_diff($d1, $d2);
				$months = (integer)$interval->format('%m months') + (integer)$interval->format('%y years')*12;
    
				$yyyymm = array();
				$Pyyyymm = array();
for ($i = (integer)$months; $i >=0 ; $i--){
	array_push($yyyymm,
		array(
		date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).''=>
			array(
				'BV'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".BV"],
				'PV'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".PV"],
				'Level'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Level"],
				'ValidTitle'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".ValidTitle"],
				'PaidTitle'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".PaidTitle"],
				'Percent'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Percent"],
				'TCGBV'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".TCGBV"],
				'TGBV'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".TGBV"],
				'GBV'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".GBV"],
				'PGBV'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".PGBV"],
				'GPV'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".GPV"],
				'Rollup'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Rollup"],
				'Legs'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Legs"],
				'QDLegs'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".QDLegs"],
				'NEFT'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".NEFT"],    
    'Aadhar'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Aadhar"],    
				'Active'=>$this->countActiveChilds($self['mcaNumber'],date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ))
			)
		)
		);
	array_push($Pyyyymm,
		array(
		date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).''=>
			array(
				'BV'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Previous.BV"],
				'PV'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Previous.PV"],
				'Level'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Previous.Level"],
				'ValidTitle'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Previous.ValidTitle"],
				'PaidTitle'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Previous.PaidTitle"],
				'Percent'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Previous.Percent"],
				'TCGBV'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Previous.TCGBV"],
				'TGBV'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Previous.TGBV"],
				'GBV'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Previous.GBV"],
				'PGBV'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Previous.PGBV"],
				'GPV'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Previous.GPV"],
				'Rollup'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Previous.Rollup"],
				'Legs'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Previous.Legs"],
				'QDLegs'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Previous.QDLegs"],
    'NEFT'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Previous.NEFT"],    
    'Aadhar'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Previous.Aadhar"],    
			)
		)
		);		
} 
			$selfline = array(
				'mcaNumber'=>$self['mcaNumber'],
				'mcaName'=>$self['mcaName'],
				'_id'=>(string)$self['_id'],
				'DateJoin'=>$self['DateJoin'],
				'Gender'=>$self['Gender'],
				'Mobile'=>$self['Mobile'],
				'countChild'=>$count,
				'refer'=>$self['refer'],
				'referName'=>$self['refer_name'],
				'countUpline'=>count($self['ancestors'])-1,
				'Uplines'=>$ancestors,
				'YYYYMM'=>$yyyymm,
				'PYYYYMM'=>$Pyyyymm,
				'Days'=>(string)round((time()-strtotime($self['DateJoin']))/60/60/24,0),
				'App'=>$this->object_to_array($self['app'])
			);
			$result = Users::find('all', array(
				'conditions'=>array('refer'=>$mcaNumber),
				'order'=>array('mcaName'=>'ASC')
			));
			$downline = array();

			foreach($result as $r){
					$count = $this->countChilds($r['mcaNumber']);
				$yyyymm = array();
				$Pyyyymm = array();
			$ancestors = array();
			foreach($r['ancestors'] as $u){
				array_push($ancestors,$u);
			}
				
for ($i = (integer)$months; $i >=0 ; $i--){
	array_push($yyyymm,
		array(
		date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).''=>
			array(
				'BV'=>$r[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".BV"],
				'PV'=>$r[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".PV"],
				'Level'=>$r[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Level"],
				'ValidTitle'=>$r[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".ValidTitle"],
				'PaidTitle'=>$r[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".PaidTitle"],
				'Percent'=>$r[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Percent"],
				'TCGBV'=>$r[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".TCGBV"],
				'TGBV'=>$r[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".TGBV"],
				'GBV'=>$r[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".GBV"],
				'PGBV'=>$r[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".PGBV"],
				'GPV'=>$r[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".GPV"],
				'Rollup'=>$r[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Rollup"],
				'Legs'=>$r[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Legs"],
				'QDLegs'=>$r[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".QDLegs"],
    'NEFT'=>$r[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".NEFT"],
    'Aadhar'=>$r[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Aadhar"],
				'Active'=>$this->countActiveChilds($r['mcaNumber'],date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ))
			)
		)
		);
	array_push($Pyyyymm,
		array(
		date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).''=>
			array(
				'BV'=>$r[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Previous.BV"],
				'PV'=>$r[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Previous.PV"],
				'Level'=>$r[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Previous.Level"],
				'ValidTitle'=>$r[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Previous.ValidTitle"],
				'PaidTitle'=>$r[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Previous.PaidTitle"],
				'Percent'=>$r[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Previous.Percent"],
				'TCGBV'=>$r[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Previous.TCGBV"],
				'TGBV'=>$r[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Previous.TGBV"],
				'GBV'=>$r[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Previous.GBV"],
				'PGBV'=>$r[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Previous.PGBV"],
				'GPV'=>$r[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Previous.GPV"],
				'Rollup'=>$r[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Previous.Rollup"],
				'Legs'=>$r[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Previous.Legs"],
				'QDLegs'=>$r[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Previous.QDLegs"],
				'NEFT'=>$r[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Previous.NEFT"],
    'Aadhar'=>$r[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".Previous.Aadhar"],
			)
		)
		);

}
$mydownline = array(
				'mcaNumber'=>$r['mcaNumber'],
				'mcaName'=>$r['mcaName'],
				'_id'=>(string)$r['_id'],
				'DateJoin'=>$r['DateJoin'],
				'Gender'=>$r['Gender'],
				'Mobile'=>$r['Mobile'],
				'countChild'=>$count,
				'refer'=>$r['refer'],
				'referName'=>$r['refer_name'],
				'countUpline'=>count($r['ancestors'])-1,
				'Uplines'=>$ancestors,
				'YYYYMM'=>$yyyymm,
				'PYYYYMM'=>$Pyyyymm,
				'Days'=>(string)round((time()-strtotime($r['DateJoin']))/60/60/24,0),
				'App'=>$this->object_to_array($r['app'])
			);
					
					array_push($downline,$mydownline);	
				}
				$levels = Levels::find('all',array(
				'order'=>array('Level'=>'DESC')
			));
			$alllevels = array();
			foreach($levels as $l){
				array_push($alllevels,array(
					'Level'=>$l['Level'],
					'Min'=>$l['Min'],
					'Max'=>$l['Max'],
					'Status'=>$l['Status']
				));
			}
			$directors = Directors::find('all',array(
				'order'=>array('Legs'=>'DESC')
			));
			$alldirectors = array();
			foreach($directors as $d){
				array_push($alldirectors,array(
					'Title'=>$d['Title'],
					'Legs'=>$d['Legs'],
					'PBV'=>$d['PBV'],
					'PGBV'=>$d['PGBV'],
					'DBP'=>$this->object_to_array($d['DBP']),
					'LPB'=>$this->object_to_array($d['LPB']),
				));
			}

		$myOwnDirectors = array();
			$self = Users::find('first', array(
				'conditions'=>array('mcaNumber'=>(string)$mcaNumber),
				'order'=>array('mcaName'=>'ASC')
			));
//			print_r($thismonth);
					if($self[$thismonth]['TGBV']===0){
							$thismonth = date('Y-m',strtotime("-1 month", strtotime(date("F") . "1")));
							$months = (int)$months - 1;
						}
//			print_r($thismonth);						
				$yyyymm = array();
		$Directors = array();
		for ($i = (integer)$months-5; $i >=0 ; $i--){
				$Directors[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]=array(
							'mcaNumber'=>$self['mcaNumber'],
							'mcaName'=>$self['mcaName'],
							'DateJoin'=>$self['DateJoin'],
							'Gender'=>$self['Gender'],
							'Mobile'=>$self['Mobile'],
							'refer'=>$self['refer'],
							'refer_name'=>$self['refer_name'],
							'BV'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['BV'],
							'ValidTitle'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['ValidTitle'],
							'PaidTitle'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['PaidTitle'],
							'Legs'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['Legs'],
							'QDLegs'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['QDLegs'],
							'Percent'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['Percent'],
							'TGBV'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['TGBV'],
							'TCGBV'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['TCGBV'],
							'PGBV'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['PGBV'],
							'Level'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['Level'],
							'Rollup'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['Rollup'],
						);
		}
		array_push($myOwnDirectors,$Directors);
		
		$myDirectors = Users::find('all',array(
					'conditions'=>array(
						'left'=>array('$gt'=>$self['left']),
						'right'=>array('$lt'=>$self['right']),
//						$thismonth.'.Legs'=>array('$gt'=>0),
						$thismonth.'.Percent'=>array('$gte'=>22),
					),
					'order'=>array('left'=>'ASC',$thismonth.'Level'=>'ASC')
				));
					
					
			$thismonth = date('Y-m',time());
				$startmonth = '2016-08';
				$d2 = date_create($thismonth.'-01');
				$d1 = date_create($startmonth.'-01');
				$interval = date_diff($d1, $d2);
				$months = (integer)$interval->format('%m months') + (integer)$interval->format('%y years')*12;

					
						$yyyymm = array();
				foreach($myDirectors as $myD){
						if($myD[$thismonth]['TGBV']===0){
							$thismonth = date('Y-m',strtotime("-1 month", strtotime(date("F") . "1")));
							$months = (int)$months - 1;
						}
		
		
		for ($i = (integer)$months-5; $i >=0 ; $i--){
				
				if($myD[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['Percent']==22){
				$Directors[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]=array(
					'mcaNumber'=>$myD['mcaNumber'],
					'mcaName'=>$myD['mcaName'],
					'DateJoin'=>$myD['DateJoin'],
					'Gender'=>$myD['Gender'],
					'Mobile'=>$myD['Mobile'],
					'refer'=>$myD['refer'],
					'refer_name'=>$myD['refer_name'],

					'BV'=>$myD[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['BV'],
					'ValidTitle'=>$myD[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['ValidTitle'],
					'PaidTitle'=>$myD[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['PaidTitle'],
					'Legs'=>$myD[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['Legs'],
					'QDLegs'=>$myD[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['QDLegs'],
					'Percent'=>$myD[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['Percent'],
					'TGBV'=>$myD[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['TGBV'],
					'TCGBV'=>$myD[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['TCGBV'],
					'PGBV'=>$myD[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['PGBV'],
					'Level'=>$myD[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['Level'],
					'Rollup'=>$myD[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['Rollup'],
				);
				}else{
					$Directors=array();
				}
			}
			array_push($myOwnDirectors,$Directors);
		}
			$thismonth = date('Y-m',strtotime("0 month", strtotime(date("F") . "1")));
		$conditions = array(
				$thismonth.'.TCGBV'=>array('$gte'=>112000),
				$thismonth.'.Percent'=>array('$lt'=>22),
				'left'=>array('$gt'=>$left),
				'right'=>array('$lt'=>$right)
			);
			
		$toBeDirectors = Users::find('all',array(
			'conditions'=>$conditions
		));
		
		$allToBeDirectors = array();
		foreach($toBeDirectors as $toD){
			array_push($allToBeDirectors,array(
				'mcaNumber'=>$toD['mcaNumber'],
				'mcaName'=>$toD['mcaName'],
				'_id'=>(string)$toD['_id'],
				'DateJoin'=>$toD['DateJoin'],
				'Gender'=>$toD['Gender'],
				'Mobile'=>$toD['Mobile'],
				'refer'=>$toD['refer'],
				'referName'=>$toD['refer_name'],
				'TCGBV'=>$toD[$thismonth]['TCGBV'],
				'BV'=>$toD[$thismonth]['BV']
			));
		}
		$summary = $this->summary($mcaNumber);
			return $this->render(array('json' => array('users'=>					array('selfline'=>$selfline,'downline'=>$downline,'levels'=>$alllevels,'directors'=>$alldirectors,'myDirectors'=>$myOwnDirectors,'toBeDirectors'=>$allToBeDirectors,'summary'=>$summary)		)));
		}
		
  public function salary($mcaNumber,$upline=null){
			$self = Users::find('first', array(
							'conditions'=>array('mcaNumber'=>$mcaNumber),
							'order'=>array('mcaName'=>'ASC')
				));
				
				$thismonth = date('Y-m',time());
				$startmonth = '2016-08';
				
				$d2 = date_create($thismonth.'-01');
				$d1 = date_create($startmonth.'-01');
				$interval = date_diff($d1, $d2);
								$months = (integer)$interval->format('%m months') + (integer)$interval->format('%y years')*12;
				
$selfline=array();
$GBV = array();
$GPV = array();
$BV = array();
$PV = array();
$activeChilds = array();
$monthSalary = array();
$designation = array();
for ($i = (integer)$months; $i >=0 ; $i--){
	
		array_push($BV,
		array(
		'BV'.date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).''=>
		$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".BV"] 
		)
		);
		array_push($PV,
		array(
		'PV'.date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).''=>
		$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".PV"]
		)
		);
		array_push($GBV,
		array(
		'GBV'.date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).''=>
		$this->addBV($self['mcaNumber'],date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ))
		)
		);
		array_push($GPV,
		array(
		'GPV'.date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).''=>
		$this->addPV($self['mcaNumber'],date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ))
		)
		);
		array_push($activeChilds,
		array(
		'AC'.date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).''=>
		$this->countActiveChilds($self['mcaNumber'],date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ))
		)
		);
		array_push($monthSalary,
		array('MS'.date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).''=>
		$this->level($self['mcaNumber'],date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ))
		)
		);
		array_push($designation,
		array('DS'.date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).''=>
		$this->designation($self['mcaNumber'],date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ))
		)
		);
		
		
}
		$countChild = $this->countChilds($self['mcaNumber']);
		$getParents = $this->getParents($self['mcaNumber']);

					$totalBV = 0;
					$totalGBV = 0;
					foreach($BV as $key => $val){
							foreach($val as $v){
								$totalBV = $totalBV + $v;
							}
					}
					foreach($GBV as $key => $val){
							foreach($val as $v){
								$totalGBV = $totalGBV + $v;
							}
					}
$levels = Levels::find('all',array(
				'order'=>array('Level'=>'DESC')
			));
			$alllevels = array();
			foreach($levels as $l){
				array_push($alllevels,array(
					'Level'=>$l['Level'],
					'Min'=>$l['Min'],
					'Max'=>$l['Max'],
					'Status'=>$l['Status']
				));
			}
			$total = $totalBV + $totalGBV;
			foreach($alllevels as $l){
				if($total >= $l['Min'] && $total <=$l['Max']){
					$selfLevel = array(
					'Level'=>$l['Level'],
					'Status'=>$l['Status'],
				);
				}
			}
			$selfSalary = array();
			foreach($BV as $key=>$val){
					foreach($val as $k=>$v){
						array_push($selfSalary,array(
							$k => round($v * $selfLevel['Level']/100,0)
						));
					}
			}
			$groupSalary = array();
			foreach($GBV as $key=>$val){
					foreach($val as $k=>$v){
						array_push($groupSalary,array(
							$k => round($v * $selfLevel['Level']/100,0)
						));
					}
			}
					array_push($selfline,array(
						'Name'=>$self['mcaName'],
						'Number'=>$self['mcaNumber'],
						'DateJoin'=>$self['DateJoin'],
						'countChild'=>$countChild,
						'getParents'=>$getParents,
						'GPVs'=>$GPV,
						'GBVs'=>$GBV,
						'BVs'=>$BV,
						'PVs'=>$PV,
						'ACs'=>$activeChilds,
						'Mobile'=>$self['Mobile'],
						'Days'=>(string)round((time()-strtotime($self['DateJoin']))/60/60/24,0),
						'totalBV' => $totalBV,
						'totalGBV' => $totalGBV,
						'selfLevel'=>$selfLevel,
						'selfSalary'=>$selfSalary,
						'groupSalary'=>$groupSalary,
						'monthStatus'=>$monthSalary,
						'DSs'=>$designation
					)
					);
			
				$result = Users::find('all', array(
							'conditions'=>array('refer'=>$mcaNumber),
							'order'=>array('mcaName'=>'ASC')
				));
	$downline = array();
				foreach($result as $r){
$GBV = array();
$GPV = array();
$BV = array();
$PV = array();
$activeChilds = array();
$monthSalary = array();
$designation = array();
$countChild = $this->countChilds($r['mcaNumber']);
					$countActiveChild = $this->countActiveChilds($r['mcaNumber']);
//					print_r(':'.$r['mcaNumber'].':');
					$getParents = $this->getParents($r['mcaNumber']);
					$addPV = $this->addPV($r['mcaNumber'],$thismonth);
	
					$addBV = $this->addBV($r['mcaNumber'],$thismonth);
					
for ($i = (integer)$months; $i >=0 ; $i--){
			array_push($BV,
		array(
		'BV'.date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).''=>
		$r[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".BV"]
		)
		);
		array_push($PV,
		array(
		'PV'.date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).''=>
		$r[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).".PV"]
		)
		);
	
		array_push($GBV,
		array(
		'GBV'.date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).''=>
		$this->addBV($r['mcaNumber'],date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ))
		)
		);
		array_push($GPV,
		array(
		'GPV'.date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).''=>
		$this->addPV($r['mcaNumber'],date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ))
		)
		);
		array_push($activeChilds,
		array(
		'AC'.date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).''=>
		$this->countActiveChilds($r['mcaNumber'],date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ))
		)
		);
		
		array_push($monthSalary,
		array('MS'.date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).''=>
		$this->level($r['mcaNumber'],date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ))
		)
		);
		
		array_push($designation,
		array('DS'.date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ).''=>
		$this->designation($r['mcaNumber'],date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ))
		)
		);

}	
				$totalBV = 0;
					$totalGBV = 0;
					foreach($BV as $key => $val){
							foreach($val as $v){
								$totalBV = $totalBV + $v;
							}
					}
					foreach($GBV as $key => $val){
							foreach($val as $v){
								$totalGBV = $totalGBV + $v;
							}
					}
			$levels = Levels::find('all',array(
				'order'=>array('Level'=>'DESC')
			));
			$alllevels = array();
			foreach($levels as $l){
				array_push($alllevels,array(
					'Level'=>$l['Level'],
					'Min'=>$l['Min'],
					'Max'=>$l['Max'],
					'Status'=>$l['Status']
				));
			}
			$total = $totalBV + $totalGBV;
			foreach($alllevels as $l){
				if($total >= $l['Min'] && $total <=$l['Max']){
					$selfLevel = array(
					'Level'=>$l['Level'],
					'Status'=>$l['Status'],
				);
				}
			}
			$selfSalary = array();
			$BVSalary = array();
			foreach($BV as $key=>$val){
					foreach($val as $k=>$v){
						array_push($selfSalary,array(
							$k => round($v * $selfLevel['Level']/100,0)
						));
						array_push($BVSalary, array(
							'G'.$k => $v
						));
					}
			}
			
			
			$groupSalary = array();
			foreach($GBV as $key=>$val){
					foreach($val as $k=>$v){
						array_push($groupSalary,array(
							$k => round(($BVSalary[$key][$k]+$v) * $selfLevel['Level']/100,0)
						));
					}
			}
			
				array_push($downline,array(
						'Name'=>$r['mcaName'],
						'Number'=>$r['mcaNumber'],
						'DateJoin'=>$r['DateJoin'],
						'countChild'=>$countChild,
						'getParents'=>$getParents,
						'GPVs'=>$GPV,
						'GBVs'=>$GBV,
						'BVs'=>$BV,
						'PVs'=>$PV,
						'ACs'=>$activeChilds,
						'Mobile'=>$r['Mobile'],
						'Days'=>(string)round((time()-strtotime($r['DateJoin']))/60/60/24,0),
						'totalBV' => $totalBV,
						'totalGBV' => $totalGBV,
						'selfLevel'=>$selfLevel,
						'selfSalary'=>$selfSalary,
						'groupSalary'=>$groupSalary,
						'monthStatus'=>$monthSalary,
						'DSs'=>$designation
					)
					);
				}
				$count = $this->countChilds($mcaNumber);
				
				$uplines = Users::find('first',array(
					'conditions' => array('mcaNumber'=>$upline)
				));
				
				$upline = array(
					'mcaNumber'=>$uplines['mcaNumber'],
					'mcaName'=>$uplines['mcaName'],
					'refer'=>$uplines['refer'],
					'refer_name'=>$uplines['refer_name']
				);
				
		return $this->render(array('json' => array(
			'users'=> array(
				'count'=>$count,
				'selfline'=>$selfline,
				'downline'=>$downline,
				'upline'=>$upline,
				'levels'=>$alllevels))));		
				
		}
		public function searchdp($searchText=null){
			
			if($searchText!=null){
				$search = Distributors::find('all',array(
					'conditions'=>array('City'=>array('$regex'=>''.$searchText.'','$options'=>'i'))
//					'conditions'=>array('City'=>$searchText)
				))	;
				$result = array();
				foreach($search as $s){
					array_push($result,array(
						'State'=>$s['State'],
						'City'=>$s['City'],
						'Address'=>$s['Address'],
						'Mobile'=>$s['Mobile'],
						'_id'=>(string) $s['_id']
					));
				}
			return $this->render(array('json' => array(
				'search'=> array(
				'result'=>$result,
					))));		
			}
		}
		public function report($mcaNumber=null){
   ini_set('memory_limit', '-1');
   
			$self = Users::find('first', array(
							'conditions'=>array('mcaNumber'=>$mcaNumber),
							'order'=>array('mcaName'=>'ASC')
				));
				$thismonth = date('Y-m',strtotime("0 month", strtotime(date("F") . "1")));
				$previousmonth = date('Y-m',strtotime("-1 month", strtotime(date("F") . "1")));
				$yestermonth = date('Y-m',strtotime("-2 month", strtotime(date("F") . "1")));

					$user = Users::find('first',array(
						'conditions'=>array('mcaNumber'=>$self['refer'])
					));
					$mobile_upline = $user['Mobile'];
				
				$selfline = array(
						'Name'=>$self['mcaName'],
						'Number'=>$self['mcaNumber'],
						'DateJoin'=>$self['DateJoin'],
						'Mobile'=>$self['Mobile'],
						$thismonth.'PBV' => $self[$thismonth]['BV']?:0,
						$previousmonth.'PBV' => $self[$previousmonth]['BV']?:0,
						$yestermonth.'PBV' => $self[$yestermonth]['BV']?:0,						
						'refer'=>$self['refer'],
						'refer_name'=>$self['refer_name'],
						'refer_mobile'=>$mobile_upline?:""
						
				);
				
		$result = Users::find('all',array(
					'conditions'=>array(
						'left'=>array('$gt'=>$self['left']),
						'right'=>array('$lt'=>$self['right']),
						$thismonth.'.BV'=>array('$lt'=>600)
					),
					'order'=>array($previousmonth.'.BV'=>'DESC',$yestermonth.'.BV'=>'DESC',$thismonth.'.BV'=>'DESC','mcaName'=>'ASC')
				));
		
			
		
	$downline = array();
				foreach($result as $r){
					
					$user = Users::find('first',array(
						'conditions'=>array('mcaNumber'=>$r['refer'])
					));
					
					$mobile_upline = $user['Mobile'];
					
				array_push($downline,array(
						'Name'=>$r['mcaName'],
						'Number'=>$r['mcaNumber'],
						'DateJoin'=>$r['DateJoin'],
						'Mobile'=>$r['Mobile']?:"",
						$thismonth.'PBV' => $r[$thismonth]['BV']?:0,
						$previousmonth.'PBV' => $r[$previousmonth]['BV']?:0,
						$yestermonth.'PBV' => $r[$yestermonth]['BV']?:0,						
						'refer'=>$r['refer'],
						'refer_name'=>$r['refer_name'],
						'refer_mobile'=>$mobile_upline?:""
					)
					);
		$months = array(
			$yestermonth,$previousmonth,$thismonth
		);


		
				}
			
				return $this->render(array('json' => array('users'=>	array('self'=>$selfline,'downline'=>$downline,'months'=>$months)		)));	
		}
		public function treeview($mcaNumber){
			$records = Users::find('all', array(
					'order'=>array('DateJoin'=>'ASC','mcaNumber'=>'ASC')
				));
			$treeview = array();
			
			foreach ($records as $r){
				 $treeview[$r['mcaNumber']] = array("refer" => $r['refer'], "mcaName" => $r['mcaName']);
			}
//					print_r($treeview);
					exit;			
			foreach ($treeview as $t){
//				$this->createTreeView($treeview, 0);
			}
			
			return $this->render(array('json' => $treeview));	
		}
		public function createTreeView($array, $currentParent, $currLevel = 0, $prevLevel = -1) {
			foreach ($array as $categoryId => $category) {

				if ($currentParent == $category['parent_id']) {                       
					if ($currLevel > $prevLevel) echo " <ol class='tree'> "; 
					if ($currLevel == $prevLevel) echo " </li> ";
					echo '<li> <label for="subfolder2">'.$category['name'].'</label> <input type="checkbox" name="subfolder2"/>';
					if ($currLevel > $prevLevel) { $prevLevel = $currLevel; }
						$currLevel++; 
						$this->createTreeView ($array, $categoryId, $currLevel, $prevLevel);
						$currLevel--;               
					}   

			}
			if ($currLevel == $prevLevel) echo " </li>  </ol> ";
	
		}
		public function card($mcaNumber = null){
		$self = Users::find('first', array(
							'conditions'=>array('mcaNumber'=>$mcaNumber),
							'order'=>array('mcaName'=>'ASC')
				));
			$thismonth = date('Y-m',strtotime("0 month", strtotime(date("F") . "1")));				
			$date = date_create($self['DateJoin']);
			$user = array(
				'mcaNumber'=>$self['mcaNumber'],
				'mcaName'=>$self['mcaName'],
				'title'=>$self[$thismonth]['ValidTitle'],
				'Date'=>$date->format('d M Y'),
				
			);
			return $this->render(array('json' => $user));	
		}
		public function directors($mcaNumber=null){
		
		$result = Users::find('all',array(
					'conditions'=>array(
						'left'=>array('$gt'=>$self['left']),
						'right'=>array('$lt'=>$self['right']),
						''
					),
					'order'=>array('left'=>'ASC')
				));
				$directors = array();
				
			return $this->render(array('json' => array('directors'=>	$directors)		));	
		}

		public function DirectorTree($mcaNumber=null){
			$thismonth = date('Y-m',time());

			$selfline = Users::find('first',array(
				'conditions'=>array('mcaNumber'=>$mcaNumber)
			));
			if($selfline['YYYYMM'][$thismonth]['TGBV']===0){
				$thismonth = date('Y-m',strtotime("-1 month", strtotime(date("F") . "1")));
				$months = (int)$months - 1;
			}

			
			$user = Users::find('first',array(
				'conditions'=>array('mcaNumber'=>$mcaNumber)
			));
			$level = $user[$thismonth]['Level'];
			
			$allusers = array();
				array_push($allusers,array(
					'mcaNumber'=>$user['mcaNumber'],
					'mcaName'=>$user['mcaName'],
					'Title'=>$user[$thismonth]['ValidTitle'],
					'PaidTitle'=>$user[$thismonth]['PaidTitle'],
					'Percent'=>$user[$thismonth]['Percent'],
					'PBV'=>$user[$thismonth]['BV'],
					'GBV'=>$user[$thismonth]['GBV'],
					'PGBV'=>$user[$thismonth]['PGBV'],
					'TCGBV'=>$user[$thismonth]['TCGBV'],
					'refer'=>$user['refer'],
					'Level'=>$user[$thismonth]['Level'],
				));				
			
			$users = Users::find('all',array(
					'conditions'=>array(
						'left'=>array('$gt'=>$user['left']),
						'right'=>array('$lt'=>$user['right']),
							$thismonth.'.Level'=>array('$lte'=>($level+9)),
       $thismonth.'.Percent'=>22
					),
					'order'=>array(
						$thismonth.'.TCGBV'=>'DESC',
						'mcaName'=>'ASC'
					)
			));
			
			
			foreach($users as $u){
				array_push($allusers,array(
					'mcaNumber'=>$u['mcaNumber'],
					'mcaName'=>$u['mcaName'],
					'Title'=>$u[$thismonth]['ValidTitle'],
					'PaidTitle'=>$u[$thismonth]['PaidTitle'],
					'Percent'=>$u[$thismonth]['Percent'],
					'PBV'=>$u[$thismonth]['BV'],
					'GBV'=>$u[$thismonth]['GBV'],
					'PGBV'=>$u[$thismonth]['PGBV'],
					'TCGBV'=>$u[$thismonth]['TCGBV'],
					'refer'=>$u['refer'],
					'Level'=>$u[$thismonth]['Level'],
				));				
			}
			
			
			return $this->render(array('json' => array('users'=>	$allusers,'level'=>$level)));	
		}

		public function tree($mcaNumber=null){
			$thismonth = date('Y-m',time());

			$selfline = Users::find('first',array(
				'conditions'=>array('mcaNumber'=>$mcaNumber)
			));
			if($selfline['YYYYMM'][$thismonth]['TGBV']===0){
				$thismonth = date('Y-m',strtotime("-1 month", strtotime(date("F") . "1")));
				$months = (int)$months - 1;
			}

			
			$user = Users::find('first',array(
				'conditions'=>array('mcaNumber'=>$mcaNumber)
			));
			$level = $user[$thismonth]['Level'];
			
			$allusers = array();
				array_push($allusers,array(
					'mcaNumber'=>$user['mcaNumber'],
					'mcaName'=>$user['mcaName'],
					'Title'=>$user[$thismonth]['ValidTitle'],
					'PaidTitle'=>$user[$thismonth]['PaidTitle'],
					'Percent'=>$user[$thismonth]['Percent'],
					'PBV'=>$user[$thismonth]['BV'],
					'GBV'=>$user[$thismonth]['GBV'],
					'PGBV'=>$user[$thismonth]['PGBV'],
					'TCGBV'=>$user[$thismonth]['TCGBV'],
					'refer'=>$user['refer'],
					'Level'=>$user[$thismonth]['Level'],
				));				
			
			$users = Users::find('all',array(
					'conditions'=>array(
						'left'=>array('$gt'=>$user['left']),
						'right'=>array('$lt'=>$user['right']),
							$thismonth.'.Level'=>array('$lte'=>($level+3))
					),
					'order'=>array(
						$thismonth.'.TCGBV'=>'DESC',
						'mcaName'=>'ASC'
					)
			));
			
			
			foreach($users as $u){
				array_push($allusers,array(
					'mcaNumber'=>$u['mcaNumber'],
					'mcaName'=>$u['mcaName'],
					'Title'=>$u[$thismonth]['ValidTitle'],
					'PaidTitle'=>$u[$thismonth]['PaidTitle'],
					'Percent'=>$u[$thismonth]['Percent'],
					'PBV'=>$u[$thismonth]['BV'],
					'GBV'=>$u[$thismonth]['GBV'],
					'PGBV'=>$u[$thismonth]['PGBV'],
					'TCGBV'=>$u[$thismonth]['TCGBV'],
					'refer'=>$u['refer'],
					'Level'=>$u[$thismonth]['Level'],
				));				
			}
			
			
			return $this->render(array('json' => array('users'=>	$allusers,'level'=>$level)));	
		}
		public function object_to_array($data)
		{
    if (is_array($data) || is_object($data))
    {
        $result = array();
        foreach ($data as $key => $value)
        {
            $result[$key] = $this->object_to_array($value);
        }
        return $result;
    }
    return $data;
		}
		public function latlon($mcaNumber=null,$latitude=null,$longitude=null,$datetime=null){
			$thismonth = date('Y-m',strtotime("0 month", strtotime(date("F") . "1")));				
			$self = Users::find('first',array(
				'conditions'=>array('mcaNumber'=>$mcaNumber)
			));
		$user = array(
				'mcaNumber'=>$self['mcaNumber'],
				'mcaName'=>$self['mcaName'],
				'ValidTitle'=>$self[$thismonth]['ValidTitle'],
				'latitude'=>floatval($latitude),
				'longitude'=>floatval($longitude),
				'DateTime'=>$datetime,
			);	
			Locations::create()->save($user);	
			return $this->render(array('json' => array('user'=>	$user)));	
		}
		
		public function location(){
			$startdate = date('Y-m-d',mktime(0,0,0,gmdate('m',time()),gmdate('d',time()),gmdate('Y',time()))-4*60*60*24);
			$enddate = date('Y-m-d',time());
			
			$users = Locations::find('all',array(
				'conditions'=>array('DateTime'=>array('$gte'=>$startdate)),
				'order'=>array('DateTime'=>'DESC')
			));
			$allusers = array();
			$mca = 0;
				foreach ($users as $u){
					$user = array(
						'mcaNumber'=>$u['mcaNumber'],
						'mcaName'=>$u['mcaName'],
						'Title'=>$u['ValidTitle'],
						'latitude'=>$u['latitude'],
						'longitude'=>$u['longitude'],
						'DateTime'=>$u['DateTime']
						);
						if($mca != $u['mcaNumber']){
							array_push($allusers,$user);
						}
						$mca = $u['mcaNumber'];
				}
			return $this->render(array('json' => array('users'=>$allusers)));	
		}
		public function searchname($mcaName){
				$users = Users::find("all",array(
			'conditions'=>array('mcaName'=>array('$regex'=>$mcaName,'$options'=>'i')),
			'order'=>array('mcaName'=>'ASC')
		));
		$resultTable = '<table class="w3-table-all w3-small"><tr><th>MCA Name</th><th>MCA Number</th></tr>';
		foreach($users as $user){
			$resultTable = $resultTable . '<tr>';
			$resultTable = $resultTable . '<td>';
			$resultTable = $resultTable . '<a href="#" style="color:blue" onclick=iet.myteam("'.$user['mcaNumber'].'","'.$user['refer'].'")>'.$user['mcaName'].'</a>';
			$resultTable = $resultTable . '</td>';
			$resultTable = $resultTable . '<td>';
			$resultTable = $resultTable . $user['mcaNumber'];
			$resultTable = $resultTable . '</td>';
			$resultTable = $resultTable . '</tr>';
		}
		$resultTable = $resultTable . '</table>';
		return $this->render(array('json' => array(
				'resultTable'=> $resultTable,
			)));
		}
		public function searchNumber($mcaNumber){
	$users = Users::find("all",array(
			'conditions'=>array('mcaNumber'=>array('$regex'=>$mcaNumber,'$options'=>'i')),
			'order'=>array('mcaName'=>'ASC')
		));
		$resultTable = '<table class="w3-table-all w3-small"><tr><th>MCA Name</th><th>MCA Number</th></tr>';
		foreach($users as $user){
			$resultTable = $resultTable . '<tr>';
			$resultTable = $resultTable . '<td>';
						$resultTable = $resultTable . '<a href="#" style="color:blue" onclick=iet.myteam("'.$user['mcaNumber'].'","'.$user['refer'].'")>'.$user['mcaName'].'</a>';
			$resultTable = $resultTable . '</td>';
			$resultTable = $resultTable . '<td>';
			$resultTable = $resultTable . $user['mcaNumber'];
			$resultTable = $resultTable . '</td>';
			$resultTable = $resultTable . '</tr>';
		}
		$resultTable = $resultTable . '</table>';
		return $this->render(array('json' => array('resultTable'=> $resultTable)));
	}
	
	public function dubai(){
		$thismonth = date('Y-m',strtotime("0 month", strtotime(date("F") . "1")));
//			print_r($thismonth);
				$startmonth = '2016-08';
				$d2 = date_create($thismonth.'-01');
				$d1 = date_create($startmonth.'-01');
				$interval = date_diff($d1, $d2);
								$months = (integer)$interval->format('%m months') + (integer)$interval->format('%y years')*12;
				
				$yyyymm = array();
				$Pyyyymm = array();
		$myOwnDirectors = array();
			$self = Users::find('first', array(
				'conditions'=>array('mcaNumber'=>'92143138'),
				'order'=>array('mcaName'=>'ASC')
			));
//			print_r($thismonth);
					if($self[$thismonth]['TGBV']===0){
							$thismonth = date('Y-m',strtotime("-1 month", strtotime(date("F") . "1")));
							$months = (int)$months - 1;
						}
//			print_r($thismonth);						
				$yyyymm = array();
		$Directors = array('mcaNumber'=>$self['mcaNumber'],'mcaName'=>$self['mcaName']);
		
		for ($i = (integer)$months-5; $i >=0 ; $i--){
								$Directors[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]=array(
							'mcaNumber'=>$self['mcaNumber'],
							'mcaName'=>$self['mcaName'],
							'DateJoin'=>$self['DateJoin'],
							'Gender'=>$self['Gender'],
							'Mobile'=>$self['Mobile'],
							'refer'=>$self['refer'],
							'refer_name'=>$self['refer_name'],
							'BV'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['BV'],
							'ValidTitle'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['ValidTitle'],
							'PaidTitle'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['PaidTitle'],
							'Legs'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['Legs'],
							'QDLegs'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['QDLegs'],
							'Percent'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['Percent'],
							'TGBV'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['TGBV'],
							'TCGBV'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['TCGBV'],
							'PGBV'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['PGBV'],
							'Level'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['Level'],
							'Rollup'=>$self[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['Rollup'],
						);
		}
		array_push($myOwnDirectors,$Directors);
		
		$myDirectors = Users::find('all',array(
					'conditions'=>array(
						'left'=>array('$gt'=>$self['left']),
						'right'=>array('$lt'=>$self['right']),
//						$thismonth.'.Legs'=>array('$gt'=>0),
						$thismonth.'.Percent'=>array('$gte'=>22),
					),
					'order'=>array('left'=>'ASC',$thismonth.'Level'=>'ASC')
				));
					
					
			$thismonth = date('Y-m',time());
				$startmonth = '2016-08';
				$d2 = date_create($thismonth.'-01');
				$d1 = date_create($startmonth.'-01');
				$interval = date_diff($d1, $d2);
								$months = (integer)$interval->format('%m months') + (integer)$interval->format('%y years')*12;

					
						$yyyymm = array();
				foreach($myDirectors as $myD){
						if($myD[$thismonth]['TGBV']===0){
							$thismonth = date('Y-m',strtotime("-1 month", strtotime(date("F") . "1")));
							$months = (int)$months - 1;
						}
		
				$Directors = array('mcaNumber'=>$myD['mcaNumber'],'mcaName'=>$myD['mcaName']);
		for ($i = (integer)$months-5; $i >=0 ; $i--){
				
				if($myD[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['Percent']==22){
				$Directors[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]=array(
					'mcaNumber'=>$myD['mcaNumber'],
					'mcaName'=>$myD['mcaName'],
					'DateJoin'=>$myD['DateJoin'],
					'Gender'=>$myD['Gender'],
					'Mobile'=>$myD['Mobile'],
					'refer'=>$myD['refer'],
					'refer_name'=>$myD['refer_name'],

					'BV'=>$myD[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['BV'],
					'ValidTitle'=>$myD[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['ValidTitle'],
					'PaidTitle'=>$myD[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['PaidTitle'],
					'Legs'=>$myD[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['Legs'],
					'QDLegs'=>$myD[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['QDLegs'],
					'Percent'=>$myD[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['Percent'],
					'TGBV'=>$myD[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['TGBV'],
					'TCGBV'=>$myD[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['TCGBV'],
					'PGBV'=>$myD[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['PGBV'],
					'Level'=>$myD[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['Level'],
					'Rollup'=>$myD[date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")))]['Rollup'],
				);
				}else{
					$Directors=array();
				}
			}
			array_push($myOwnDirectors,$Directors);
		}
		return $this->render(array('json' => array('myDirectors'=>$myOwnDirectors)));

	}
	public function levelup($mcaNumber=null){
			$self = Users::find('first', array(
							'conditions'=>array('mcaNumber'=>$mcaNumber),
							'order'=>array('mcaName'=>'ASC')
				));
				$thismonth = date('Y-m',strtotime("0 month", strtotime(date("F") . "1")));

					$user = Users::find('first',array(
						'conditions'=>array('mcaNumber'=>$self['refer'])
					));
					$mobile_upline = $user['Mobile'];

					$levels = Levels::find('all',array(
				'order'=>array('Level'=>'ASC')
			));
			$alllevels = array();
			foreach($levels as $l){
				array_push($alllevels,array(
					'Level'=>$l['Level'],
					'Min'=>$l['Min'],
					'Max'=>$l['Max'],
					'Status'=>$l['Status']
				));
			}
					foreach($levels as $l){
						if($self[$thismonth]['TCGBV']<$l['Min']){
							$nextTarget = $l['Min'] - $self[$thismonth]['TCGBV'];
							$nextLevel = $l['Level'];
							break;
						}
					}
				
				$selfline = array(
						'Name'=>$self['mcaName'],
						'Number'=>$self['mcaNumber'],
						'DateJoin'=>$self['DateJoin'],
						'Mobile'=>$self['Mobile'],
						$thismonth.'TCGBV' => $self[$thismonth]['TCGBV']?:0,
						'NextTarget'=>$nextTarget?:0,
						'NextLevel'=>$nextLevel?:0,
						'refer'=>$self['refer'],
						'refer_name'=>$self['refer_name'],
						'refer_mobile'=>$mobile_upline?:""
						
				);
				
		$result = Users::find('all',array(
					'conditions'=>array(
						'left'=>array('$gt'=>$self['left']),
						'right'=>array('$lt'=>$self['right']),
						$thismonth.'.Percent'=>array('$lt'=>22)
					),
					'order'=>array($thismonth.'.TCGBV'=>'DESC','mcaName'=>'ASC')
				));
		

		
	$downline = array();
				foreach($result as $r){
					
					$user = Users::find('first',array(
						'conditions'=>array('mcaNumber'=>$r['refer'])
					));
					foreach($levels as $l){
						if($r[$thismonth]['TCGBV']<$l['Min']){
							$nextTarget = $l['Min'] - $r[$thismonth]['TCGBV'];
							$nextLevel = $l['Level'];
							break;
						}
					}
					if($nextTarget<=4000){
					
						$mobile_upline = $user['Mobile'];
						array_push($downline,array(
						'Name'=>$r['mcaName'],
						'Number'=>$r['mcaNumber'],
						'DateJoin'=>$r['DateJoin'],
						'Mobile'=>$r['Mobile']?:"",
						'Level' => $r[$thismonth]['Percent']?:0,
						'TCGBV' => $r[$thismonth]['TCGBV']?:0,
						'NextTarget'=>$nextTarget?:0,
						'NextLevel'=>$nextLevel?:0,
						'refer'=>$r['refer'],
						'refer_name'=>$r['refer_name'],
						'refer_mobile'=>$mobile_upline?:""
					)
					);
				}
				}
			
				return $this->render(array('json' => array('users'=>	array('self'=>$selfline,'downline'=>$downline,'levels'=>$alllevels)		)));	

	}
	public function views(){
			$self = Users::find('all', array(
				'conditions'=>array('app'=>array('$exists'=>1)),
				'order'=>array('app.DateTime'=>'DESC')
		));
		$views = array();
		foreach($self as $s){
			$count = count($s[app]);
			$app = array(
				'mcaNumber'=>$s['mcaNumber'],
				'mcaName'=>$s['mcaName'],
				'DateTime'=>$s['app'][$count-1]['DateTime'],
			);
			$apps = array();
			foreach($s['app'] as $a){
				if($s['mcaNumber']==$a['mySelf']){
					array_push($apps,array(
						'mcaNumber'=>$a['mcaNumber'],
						'mcaName'=>$a['mcaName'],
						'DateTime'=>$a['DateTime'],
						'mySelf'=>$a['mySelf'],
						'myName'=>$a['myName'],
					));
				}
			}
			array_push($views,array(
				'app'=>$app,
				'users'=>$apps
			));
		}
		return $this->render(array('json' => array('users'=>$views)));
	}
}  

?>