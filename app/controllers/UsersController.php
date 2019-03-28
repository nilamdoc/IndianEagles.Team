<?php
namespace app\controllers;
use app\models\Users;
use app\models\Builders;
use app\models\Newusers;
use app\models\Directors;
use app\models\Registers;
use app\models\Sales;
use app\models\Purchases;
use app\models\Pages;
use app\models\Levels;
use app\models\File;

use lithium\storage\Session;
use app\extensions\action\Functions;
use \lithium\template\View;
use \Swift_MailTransport;
use \Swift_Mailer;
use \Swift_Message;
use \Swift_Attachment;

class UsersController extends \lithium\action\Controller {
	
	
	public function Home(){
		if($this->request->data){
			$page = Pages::find('all',array(
		'conditions'=>array('page'=>strtolower($this->request->data['page'])),
		))->save($this->request->data);
		}
		return $this->redirect('/');
	}
	public function add(){
		
					//Session::delete('session');			
					//Session::write('session',$data);
					//$session = Session::read('session');
					$session = Session::read('session');
//					if(!$session){return $this->redirect('/users/login');}
//					if($session['mcaNumber']!='92146504'){return $this->redirect('/users/login');}
		$users = Users::find("all",array(
			'order'=>array('_id'=>'ASC')
		));
		if($this->request->data){
			if($this->request->data['mcaNumber']!="" && $this->request->data["mcaName"]!=""){

				$refer = Users::first(array(
						'fields'=>array('left','mcaNumber','ancestors','mcaName'),
							'conditions'=>array('mcaNumber'=>$this->request->data['refer'])
						));
				$refer_ancestors = $refer['ancestors'];
				$ancestors = array();

				foreach ($refer_ancestors as $ra){
					array_push($ancestors, $ra);
				}
				$refer_mcanumber = (string) $refer['mcaNumber'];

				array_push($ancestors,$refer_mcanumber);

				$refer_id = $refer_mcanumber;
				$refer_left = (integer)$refer['left'];
				$refer_left_inc = (integer)$refer['left'];
				$refername = Users::find('first',array(
						'fields'=>array('mcaName','mcaNumber'),
						'conditions'=>array('mcaNumber'=>$this->request->data['refer'])
				));
				$refer_name = $refername['mcaName'];
				$refer_id = $refername['mcaNumber']; 

				
			}else{
				$refer_left = 0;
				$refer_name = "";
				$refer_id = "";
				$ancestors = array();
			}
				Users::update(
					array(
						'$inc' => array('right' => (integer)2)
					),
					array('right' => array('>'=>(integer)$refer_left_inc)),
					array('multi' => true)
				);
				Users::update(
					array(
						'$inc' => array('left' => (integer)2)
					),
					array('left' => array('>'=>(integer)$refer_left_inc)),
					array('multi' => true)
				);
			
			$data = array(
				'mcaName'=>(string)$this->request->data["mcaName"],
				'mcaNumber'=>(string)$this->request->data["mcaNumber"],
				'refer'=>(string)$this->request->data["refer"],
				'refer_name'=>$refer_name,
				'refer_id'=>(string)$refer_id,
				'ancestors'=> $ancestors,
				'DateJoin'=>(string)$this->request->data["DateJoin"],
				'left'=>(integer)($refer_left+1),
				'right'=>(integer)($refer_left+2),

			);

			Users::create()->save($data);
			
		}
		
		return compact("users");
	}
 
 	public function addnew(){
		
					//Session::delete('session');			
					//Session::write('session',$data);
					//$session = Session::read('session');
					$session = Session::read('session');
//					if(!$session){return $this->redirect('/users/login');}
//					if($session['mcaNumber']!='92146504'){return $this->redirect('/users/login');}
		$users = Newusers::find("all",array(
			'order'=>array('_id'=>'ASC')
		));
		if($this->request->data){
			if($this->request->data['mcaNumber']!="" && $this->request->data["mcaName"]!=""){

				$refer = Newusers::first(array(
						'fields'=>array('left','mcaNumber','ancestors','mcaName'),
							'conditions'=>array('mcaNumber'=>$this->request->data['refer'])
						));
				$refer_ancestors = $refer['ancestors'];
				$ancestors = array();

				foreach ($refer_ancestors as $ra){
					array_push($ancestors, $ra);
				}
				$refer_mcanumber = (string) $refer['mcaNumber'];

				array_push($ancestors,$refer_mcanumber);

				$refer_id = $refer_mcanumber;
				$refer_left = (integer)$refer['left'];
				$refer_left_inc = (integer)$refer['left'];
				$refername = Newusers::find('first',array(
						'fields'=>array('mcaName','mcaNumber'),
						'conditions'=>array('mcaNumber'=>$this->request->data['refer'])
				));
				$refer_name = $refername['mcaName'];
				$refer_id = $refername['mcaNumber']; 

				
			}else{
				$refer_left = 0;
				$refer_name = "";
				$refer_id = "";
				$ancestors = array();
			}
				Newusers::update(
					array(
						'$inc' => array('right' => (integer)2)
					),
					array('right' => array('>'=>(integer)$refer_left_inc)),
					array('multi' => true)
				);
				Newusers::update(
					array(
						'$inc' => array('left' => (integer)2)
					),
					array('left' => array('>'=>(integer)$refer_left_inc)),
					array('multi' => true)
				);
			
			$data = array(
				'mcaName'=>(string)$this->request->data["mcaName"],
				'mcaNumber'=>(string)$this->request->data["mcaNumber"],
				'refer'=>(string)$this->request->data["refer"],
				'refer_name'=>$refer_name,
				'refer_id'=>(string)$refer_id,
				'ancestors'=> $ancestors,
				'DateJoin'=>(string)$this->request->data["DateJoin"],
				'left'=>(integer)($refer_left+1),
				'right'=>(integer)($refer_left+2),

			);

			Newusers::create()->save($data);
			
		}
		
		return compact("users");
	}
 
 
public function buildersb($mcaNumber = null,$yyyymm=null){
$this->_render['layout'] = 'noHeaderFooter';
 
			$selfline = Builders::find('first',array(
				'conditions'=>array('mcaNumber'=>$mcaNumber)
			));
			

			
			$user = Builders::find('first',array(
				'conditions'=>array('mcaNumber'=>$mcaNumber)
			));
   
			$allusers = array();
   
				array_push($allusers,array(
					'mcaNumber'=>$user['mcaNumber'],
					'mcaName'=>$user['mcaName'],
					'refer'=>$user['refer'],
     'PaidTitle'=>$user[$yyyymm]['PaidTitle'],
     'Percent'=>$user[$yyyymm]['Percent'],
     'Gross'=>$user[$yyyymm]['Gross'],
     'TGBV'=>$user[$yyyymm]['TGBV'],
     'PGBV'=>$user[$yyyymm]['PGBV'],
     'RollUp'=>$user[$yyyymm]['RollUp'],
     'Legs'=>0
				));				
			
			$users = Builders::find('all',array(
					'conditions'=>array(
						'left'=>array('$gt'=>$user['left']),
						'right'=>array('$lt'=>$user['right']),
					),
					'order'=>array(
						'mcaName'=>'ASC'
					)
			));
			
			
			foreach($users as $u){
    $count = $this->countChilds($u['mcaNumber']);
    //print_r($u[$yyyymm]['PaidTitle']);exit;
				array_push($allusers,array(
					'mcaNumber'=>$u['mcaNumber'],
					'mcaName'=>$u['mcaName'],
					'refer'=>$u['refer'],
     'PaidTitle'=>$u[$yyyymm]['PaidTitle'],
     'Percent'=>$u[$yyyymm]['Percent'],
     'Gross'=>$u[$yyyymm]['Gross'],
     'TGBV'=>$u[$yyyymm]['TGBV'],
     'PGBV'=>$u[$yyyymm]['PGBV'],
     'RollUp'=>$u[$yyyymm]['RollUp'],
     'Legs'=>0
				));				
			}
			$self = Builders::find('first', array(
				'conditions'=>array('mcaNumber'=>(string)$mcaNumber),
				'order'=>array('mcaName'=>'ASC')
			));
			$selfline = array(
				'mcaNumber'=>$self['mcaNumber'],
				'mcaName'=>$self['mcaName'],
				'_id'=>(string)$self['_id'],
				'DateJoin'=>$self['DateJoin'],
				'refer'=>$self['refer'],
				'referName'=>$self['refer_name'],
    'PaidTitle'=>$self[$yyyymm]['PaidTitle'],
    'Percent'=>$self[$yyyymm]['Percent'],
    'Gross'=>$self[$yyyymm]['Gross'],
    'TGBV'=>$self[$yyyymm]['TGBV'],
    'PGBV'=>$self[$yyyymm]['PGBV'],
    'RollUp'=>$self[$yyyymm]['RollUp'],

				'Days'=>(string)round((time()-strtotime($self['DateJoin']))/60/60/24,0)
			);

			return compact('allusers','level','selfline');	
}
 
 
public function builders($mcaNumber = null){
$this->_render['layout'] = 'noHeaderFooter';
 $thismonth = date('Y-m',time());

			$selfline = Builders::find('first',array(
				'conditions'=>array('mcaNumber'=>$mcaNumber)
			));
			if($selfline['YYYYMM'][$thismonth]['TGBV']===0){
				$thismonth = date('Y-m',strtotime("-1 month", strtotime(date("F") . "1")));
				$months = (int)$months - 1;
			}

			
			$user = Builders::find('first',array(
				'conditions'=>array('mcaNumber'=>$mcaNumber)
			));
			$level = $user[$thismonth]['Level'];
			$count = $this->countChilds($mcaNumber);
			$allusers = array();
				array_push($allusers,array(
					'mcaNumber'=>$user['mcaNumber'],
					'mcaName'=>$user['mcaName'],
					'ValidTitle'=>$user[$thismonth]['ValidTitle'],
					'PaidTitle'=>$user[$thismonth]['PaidTitle'],
					'Percent'=>$user[$thismonth]['Percent'],
					'PBV'=>$user[$thismonth]['BV'],
					'GBV'=>$user[$thismonth]['GBV'],
     'TGBV'=>$user[$thismonth]['TGBV'],
					'PGBV'=>$user[$thismonth]['PGBV'],
					'TCGBV'=>$user[$thismonth]['TCGBV'],
     'Rollup'=>$user[$thismonth]['Rollup'],
     'Legs'=>$user[$thismonth]['Legs'],
     'QDLegs'=>$user[$thismonth]['QDLegs'],
     'count'=>$count,
					'refer'=>$user['refer'],
					'Level'=>$user[$thismonth]['Level'],
				));				
			
			$users = Builders::find('all',array(
					'conditions'=>array(
						'left'=>array('$gt'=>$user['left']),
						'right'=>array('$lt'=>$user['right']),
							$thismonth.'.Level'=>array('$lte'=>($level+40)),
//       $thismonth.'.Percent'=>array('$gte'=>19)
					),
					'order'=>array(
						$thismonth.'.TCGBV'=>'DESC',
						'mcaName'=>'ASC'
					)
			));
			
			
			foreach($users as $u){
    
    $count = $this->countChilds($u['mcaNumber']);
				array_push($allusers,array(
					'mcaNumber'=>$u['mcaNumber'],
					'mcaName'=>$u['mcaName'],
					'ValidTitle'=>$u[$thismonth]['ValidTitle'],
					'PaidTitle'=>$u[$thismonth]['PaidTitle'],
					'Percent'=>$u[$thismonth]['Percent'],
					'PBV'=>$u[$thismonth]['BV'],
					'GBV'=>$u[$thismonth]['GBV'],
					'PGBV'=>$u[$thismonth]['PGBV'],
     'TGBV'=>$u[$thismonth]['TGBV'],
					'TCGBV'=>$u[$thismonth]['TCGBV'],
     'Rollup'=>$u[$thismonth]['Rollup'],
     'Legs'=>$u[$thismonth]['Legs'],
     'QDLegs'=>$u[$thismonth]['QDLegs'],
     'count'=>$count,
					'refer'=>$u['refer'],
					'Level'=>$u[$thismonth]['Level'],
				));				
			}
			$self = Users::find('first', array(
				'conditions'=>array('mcaNumber'=>(string)$mcaNumber),
				'order'=>array('mcaName'=>'ASC')
			));
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
				'Days'=>(string)round((time()-strtotime($self['DateJoin']))/60/60/24,0)
			);
			return compact('allusers','level','selfline');	
}

	public function display($mcaNumber = null,$upline=null){
  ini_set('mongo.long_as_object', 1);		
		$session = Session::read('session');
		
//		if($mcaNumber!=$session['mcaNumber']){
//			$checkDownline = $this->checkDownline($mcaNumber);
//			if($checkDownline==false){$this->redirect('/users/display/'.$session['mcaNumber']);}
//		}
		
	if(!$session){return $this->redirect('/users/login');}

	
				$self = Users::find('first', array(
				'conditions'=>array('mcaNumber'=>(string)$mcaNumber),
				'order'=>array('mcaName'=>'ASC')
			));
			$ancestors = array();
			foreach($self['ancestors'] as $u){
				array_push($ancestors,$u);
			}
			$count = $this->countChilds($mcaNumber);

			$thismonth = date('Y-m',time());
				$startmonth = '2016-08';
				$d2 = date_create($thismonth.'-01');
				$d1 = date_create($startmonth.'-01');
				$interval = date_diff($d1, $d2);
				$months = (integer)$interval->format('%m months');
				$yyyymm = array();
				
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
				'Active'=>$this->countActiveChilds($self['mcaNumber'],date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ))
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
				'Days'=>(string)round((time()-strtotime($self['DateJoin']))/60/60/24,0)
			);
			$result = Users::find('all', array(
				'conditions'=>array('refer'=>$mcaNumber),
				'order'=>array('mcaName'=>'ASC')
			));
			$downline = array();

			foreach($result as $r){
					$count = $this->countChilds($r['mcaNumber']);
				$yyyymm = array();

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
				'Active'=>$this->countActiveChilds($r['mcaNumber'],date("Y-m", strtotime(-$i." month", strtotime(date("F") . "1")) ))
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
				'Days'=>(string)round((time()-strtotime($r['DateJoin']))/60/60/24,0),
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
					'PGBV'=>$d['PGBV']
				));
			}
			
	
	$count = count($uplines);
		
 $levels = Levels::find('all');
	return compact('count','selfline','downline','alllevels','alldirectors','months');
				
	}


public function addPV($user_id,$month){
		$session = Session::read('session');
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
		$session = Session::read('session');
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
			$NodeDetails = Users::find('all',array(
				'conditions'=>array(
				'mcaNumber' => $user_id
			)));
			foreach($NodeDetails as $pd){
				$left = $pd['left'];
				$right = $pd['right'];
			}
			$ParentDetails = Users::find('all',array(
				'conditions' => array(
					'left'=>array('$lt'=>$left),
					'right'=>array('$gt'=>$right)
				),
				'order'=>array('left'=>'ASC')
				));
		return $ParentDetails;
	}	

	public function countParents($user_id){
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
			$NodeDetails = Users::find('all',array(
				'conditions'=>array(
				'mcaNumber' => $user_id
			)));
			foreach($NodeDetails as $pd){
				$left = $pd['left'];
				$right = $pd['right'];
			}
			$ParentDetails = Users::count(array(
				'conditions' => array(
					'left'=>array('$lt'=>$left),
					'right'=>array('$gt'=>$right)
				))
			);
		return $ParentDetails;
	}	

	public function Training(){
$togo = explode('/',$this->request->url);
	if($this->request->data){
		$page = Pages::find('all',array(
		'conditions'=>array('page'=>strtolower($this->request->data['page'])),
		))->save($this->request->data);
		}
		$page = Pages::find('first',array(
			'conditions'=>array('page'=>$togo[count($togo)-1])
		));
		return compact('page');
	}	
		
	
	public function Businessplan(){
$togo = explode('/',$this->request->url);
	if($this->request->data){
		$page = Pages::find('all',array(
		'conditions'=>array('page'=>strtolower($this->request->data['page'])),
		))->save($this->request->data);
		}
		$page = Pages::find('first',array(
			'conditions'=>array('page'=>strtolower($togo[count($togo)-1]))
		));
		return compact('page');
		
	}
	public function Fly(){
$togo = explode('/',$this->request->url);
	if($this->request->data){
		$page = Pages::find('all',array(
		'conditions'=>array('page'=>strtolower($this->request->data['page'])),
		))->save($this->request->data);
		}
		$page = Pages::find('first',array(
			'conditions'=>array('page'=>strtolower($togo[count($togo)-1]))
		));
		return compact('page');
		
	}
	public function Register(){
	if($this->request->data){
		$file1 = $this->request->data['file1'];
		$file2 = $this->request->data['file2'];
		$file3 = $this->request->data['file3'];
		$Register = Registers::create($this->request->data);
		$saved = $Register->save();
		$register_id = $Register->_id;
		
		$allowed = array('jpg', 'jpeg', 'png', 'gif');
		$extension = pathinfo($this->request->data['file1']['name'],PATHINFO_EXTENSION);
		if(!in_array(strtolower($extension), $allowed)){
			$msg = "Sorry, only JPG, PNG, GIF file is allowed.";
			$uploadOk = 0;
		}
		$extension = pathinfo($this->request->data['file2']['name'],PATHINFO_EXTENSION);
		if(!in_array(strtolower($extension), $allowed)){
			$msg = "Sorry, only JPG, PNG, GIF file is allowed.";
			$uploadOk = 0;
		}
		$extension = pathinfo($this->request->data['file3']['name'],PATHINFO_EXTENSION);
		if(!in_array(strtolower($extension), $allowed)){
			$msg = "Sorry, only JPG, PNG, GIF file is allowed.";
			$uploadOk = 0;
		}
			$path = LITHIUM_APP_PATH. '/webroot/documents/';
			$resizedFile1 = $path.$this->request->data['file1']['name'];
//			print_r($path);
			$resize1 = $this->smart_resize_image($this->request->data['file1']['tmp_name'], null,1024 , 0 , true , $resizedFile1 , false , false ,100 );
			if($resize1 == false){
					$msg = "File format different, cannot verify.";
					$uploadOk = 0;
				}
			$resizedFile3 = $path.$this->request->data['file3']['name'];
//			print_r($path);
			$resize3 = $this->smart_resize_image($this->request->data['file3']['tmp_name'], null,1024 , 0 , true , $resizedFile3 , false , false ,100 );
			if($resize3 == false){
					$msg = "File format different, cannot verify.";
					$uploadOk = 0;
				}				
			$resizedFile2 = $path.$this->request->data['file2']['name'];
			
			$resize2 = $this->smart_resize_image($this->request->data['file2']['tmp_name'], null,1024 , 0 , true , $resizedFile2 , false , false ,100 );
			if($resize2 == false){
					$msg = "File format different, cannot verify.";
					$uploadOk = 0;
				}
			$fileData = array(
						'file' => file_get_contents($resizedFile1),
						'filename'=>$this->request->data['file1']['name'],
						'metadata'=>array('filename'=>$this->request->data['file1']['name']),
						'register_id' => (string)$register_id,
				);
				
			$file = File::create();
				if ($file->save($fileData)) {
					$msg = "Upload OK"	;
				}
				$fileData = array(
						'file' => file_get_contents($resizedFile2),
						'filename'=>$this->request->data['file2']['name'],
						'metadata'=>array('filename'=>$this->request->data['file2']['name']),
						'register_id' => (string)$register_id,
				);
			$file = File::create();
				if ($file->save($fileData)) {
					$msg = "Upload OK"	;
				}
			$fileData = array(
						'file' => file_get_contents($resizedFile3),
						'filename'=>$this->request->data['file3']['name'],
						'metadata'=>array('filename'=>$this->request->data['file3']['name']),
						'register_id' => (string)$register_id,
				);
				
			$file = File::create();
				if ($file->save($fileData)) {
					$msg = "Upload OK"	;
				}
				
				// email to user and admin
					$this->sendemail($this->request->data,$resizedFile1, $resizedFile2, $resizedFile3);
				//========================
				
			unlink($resizedFile1) ;
			unlink($resizedFile2) ;
			unlink($resizedFile3) ;
		
	}
	return compact('msg');
	}

/**
 * easy image resize function
 * @param  $file - file name to resize
 * @param  $string - The image data, as a string
 * @param  $width - new image width
 * @param  $height - new image height
 * @param  $proportional - keep image proportional, default is no
 * @param  $output - name of the new file (include path if needed)
 * @param  $delete_original - if true the original image will be deleted
 * @param  $use_linux_commands - if set to true will use "rm" to delete the image, if false will use PHP unlink
 * @param  $quality - enter 1-100 (100 is best quality) default is 100
 * @return boolean|resource
 */
  function smart_resize_image($file,
                              $string             = null,
                              $width              = 0, 
                              $height             = 0, 
                              $proportional       = false, 
                              $output             = 'file', 
                              $delete_original    = true, 
                              $use_linux_commands = false,
  							  $quality = 100
  		 ) {

      
    if ( $height <= 0 && $width <= 0 ) return false;
    if ( $file === null && $string === null ) return false;
    # Setting defaults and meta
    $info                         = $file !== null ? getimagesize($file) : getimagesizefromstring($string);
    $image                        = '';
    $final_width                  = 0;
    $final_height                 = 0;
//				print_r($info);
				if($info==null){
					return false;
				}
    list($width_old, $height_old) = $info;
	$cropHeight = $cropWidth = 0;

    # Calculating proportionality
    if ($proportional) {
      if      ($width  == 0)  $factor = $height/$height_old;
      elseif  ($height == 0)  $factor = $width/$width_old;
      else                    $factor = min( $width / $width_old, $height / $height_old );

      $final_width  = round( $width_old * $factor );
      $final_height = round( $height_old * $factor );
    }
    else {
      $final_width = ( $width <= 0 ) ? $width_old : $width;
      $final_height = ( $height <= 0 ) ? $height_old : $height;
	  $widthX = $width_old / $width;
	  $heightX = $height_old / $height;
	  
	  $x = min($widthX, $heightX);
	  $cropWidth = ($width_old - $width * $x) / 2;
	  $cropHeight = ($height_old - $height * $x) / 2;
    }
    # Loading image to memory according to type
    switch ( $info[2] ) {
      case IMAGETYPE_JPEG:  $file !== null ? $image = imagecreatefromjpeg($file) : $image = imagecreatefromstring($string);  break;
      case IMAGETYPE_GIF:   $file !== null ? $image = imagecreatefromgif($file)  : $image = imagecreatefromstring($string);  break;
      case IMAGETYPE_PNG:   $file !== null ? $image = imagecreatefrompng($file)  : $image = imagecreatefromstring($string);  break;
      default: return false;
    }
		
    
    # This is the resizing/resampling/transparency-preserving magic
    $image_resized = imagecreatetruecolor( $final_width, $final_height );
    if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {
      $transparency = imagecolortransparent($image);
      $palletsize = imagecolorstotal($image);

      if ($transparency >= 0 && $transparency < $palletsize) {
        $transparent_color  = imagecolorsforindex($image, $transparency);
        $transparency       = imagecolorallocate($image_resized, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
        imagefill($image_resized, 0, 0, $transparency);
        imagecolortransparent($image_resized, $transparency);
      }
      elseif ($info[2] == IMAGETYPE_PNG) {
        imagealphablending($image_resized, false);
        $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
        imagefill($image_resized, 0, 0, $color);
        imagesavealpha($image_resized, true);
      }
    }
    imagecopyresampled($image_resized, $image, 0, 0, $cropWidth, $cropHeight, $final_width, $final_height, $width_old - 2 * $cropWidth, $height_old - 2 * $cropHeight);
	
	
    # Taking care of original, if needed
    if ( $delete_original ) {
      if ( $use_linux_commands ) exec('rm '.$file);
      else @unlink($file);
    }

    # Preparing a method of providing result
    switch ( strtolower($output) ) {
      case 'browser':
        $mime = image_type_to_mime_type($info[2]);
        header("Content-type: $mime");
        $output = NULL;
      break;
      case 'file':
        $output = $file;
      break;
      case 'return':
        return $image_resized;
      break;
      default:
      break;
    }
//    print_r($output);
    # Writing image according to type to the output destination and image quality
    switch ( $info[2] ) {
      case IMAGETYPE_GIF:   imagegif($image_resized, $output);    break;
      case IMAGETYPE_JPEG:  imagejpeg($image_resized, $output, $quality);   break;
      case IMAGETYPE_PNG:
        $quality = 9 - (int)((0.9*$quality)/10.0);
        imagepng($image_resized, $output, $quality);
        break;
      default: return false;
    }

    return true;
  }

	public function gettraining(){
			if($this->request->data){
				$Register = Registers::create($this->request->data);
				$saved = $Register->save();
				$register_id = $Register->_id;		
				$msg = "Upload OK"	;	
				// email to user and admin
					$this->sendemail($this->request->data);
				//========================

			}
			
		return compact('msg');
	}
	public function givetraining(){
			if($this->request->data){
				$Register = Registers::create($this->request->data);
				$saved = $Register->save();
				$register_id = $Register->_id;		
				$msg = "Upload OK"	;	
				// email to user and admin
					$this->sendemail($this->request->data);
				//========================
			}
		return compact('msg');
	}
public function sendemail($data,$file1=null,$file2=null,$file3=null){
				$email = $data['email'];
				$function = new Functions();
				$compact = array('data'=>$data);
				$from = array(NOREPLY => "noreply");
				$email = $email;
				$function->sendEmailTo($email,$compact,'users','register',"IndianEagles.Team - Register",$from,MAIL_1,MAIL_2,MAIL_4,$file1,$file2,$file3);
}

public function monthly(){
	$session = Session::read('session');
//	if($session['mcaNumber']!='92146504'){return $this->redirect('/users/login');}

		$users = Users::find("all",array(
			'order'=>array('mcaName'=>'ASC')
		));
	if($this->request->data){
		$data = array(
			"mcaNumber" => $this->request->data['mcaNumber'],
			"PV" => (integer) $this->request->data['PV'],
			"BV" => (integer) $this->request->data['BV'],
			"YearMonth" => $this->request->data['YearMonth']
		);
		
		$record = Sales::find('first',array(
			'conditions'=>array(
				'mcaNumber'=> $this->request->data['mcaNumber'],
				"YearMonth" => $this->request->data['YearMonth']
			)
		));
		if(count($record)==0){
		$Sales = Sales::create($data);	
		$saved = $Sales->save();	
		}else{
			
		}
		$record = Sales::find('all',array(
			'conditions'=>array(
				'mcaNumber'=> $this->request->data['mcaNumber'],
				"YearMonth" => $this->request->data['YearMonth']
			)
		))->save($data);
		
		$data = array(
				$this->request->data['YearMonth'] => array(
			"PV" => (integer) $this->request->data['PV'],
			"BV" => (integer) $this->request->data['BV']
			),
			'2016-08.BV'=> (integer) $this->request->data['Previous']
		);
		$record = Users::find('all',array(
			'conditions'=>array(
				'mcaNumber'=> $this->request->data['mcaNumber'],
			)
		))->save($data);
	}
		$thismonth = $this->request->data['YearMonth'];
		
		$bv = Users::find('all',array(
			'conditions'=>array($thismonth.'.BV'=>array('$gt'=>0)),
			'order'=>array($thismonth.'.BV'=>'DESC')
		));
		print_r(count($bv));
		return compact('users','bv', 'thismonth');
}
public function dateofjoin(){
		$session = Session::read('session');
//	if($session['mcaNumber']!='92146504'){return $this->redirect('/users/login');}

		$users = Users::find("all",array(
			'order'=>array('mcaName'=>'ASC')
		));
		
		if($this->request->data){
			$data = array(
				'DateJoin' => $this->request->data['DateJoin']
			);
				$record = Users::find('all',array(
			'conditions'=>array(
				'mcaNumber'=> $this->request->data['mcaNumber'],
			)
		))->save($data);
		}
		return compact('users');
}
public function getPV($mcaNumber,$YearMonth){
	$user = Users::find("first",array(
			'conditions'=>array('mcaNumber'=>$mcaNumber)
		));
		for ($i=12;$i>=0;$i--){
			$StartDate = gmdate('Y-m',mktime(0,0,0,gmdate('m',time()),gmdate('d',time()),gmdate('Y',time()))-$i*60*60*24*30);
		}
		
	$PV = $user[$YearMonth]['PV'];
	$BV = $user[$YearMonth]['BV'];
	$Previous = $user['2016-08']['BV'];
	//print_r($user['2016-08']['BV']);
	return $this->render(array('json' => array(
				'PV'=> $PV,
				'BV'=> $BV,
				'Previous'=> $Previous,
			)));
	
	
}
public function search(){
	
}
public function searchName($mcaName){
	$users = Users::find("all",array(
			'conditions'=>array('mcaName'=>array('$regex'=>$mcaName,'$options'=>'i')),
			'order'=>array('mcaName'=>'ASC')
		));
		$resultTable = '<table class="table table-condensed table-bordered table-responsive">
<tr><td>MCA Name</td><td>MCA Number</td></tr>';
		foreach($users as $user){
			$resultTable = $resultTable . '<tr>';
			$resultTable = $resultTable . '<td>';
			$resultTable = $resultTable . '<a href="/users/display/'.$user['mcaNumber'].'">'.$user['mcaName'].'</a>';
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
		$resultTable = '<table class="table table-condensed table-bordered table-responsive">
<tr><td>MCA Name</td><td>MCA Number</td></tr>';
		foreach($users as $user){
			$resultTable = $resultTable . '<tr>';
			$resultTable = $resultTable . '<td>';
			$resultTable = $resultTable . '<a href="/users/display/'.$user['mcaNumber'].'">'.$user['mcaName'].'</a>';
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
public function thismonth()	{
	$thismonth = date('Y-m',time());
	
	$users = Users::find("all",array(
			'conditions'=>array($thismonth.'.PV'=>array('$gt'=>0)),
			'order'=>array(
				$thismonth.'.PV'=>'DESC',
				$thismonth.'.BV'=>'DESC')
		));
		return compact('users','thismonth');
}
public function login(){
	Session::delete('session');
	if($this->request->data){
		$user = Users::find('first',array(
			'conditions'=>array(
				'mcaNumber'=>$this->request->data['mcaNumber'],
				'DateJoin'=>$this->request->data['DateJoin']
			)
		));
		
		if(count($user)==1){
			$data = array(
				'mcaName' => $user['mcaName'],
				'mcaNumber' => $user['mcaNumber'],
				'DateJoin' => $user['DateJoin'],
				'refer' => $user['refer'],
				'left' => $user['left'],
				'right' => $user['right']
			);
			Session::write('session',$data);	
			$session = Session::read('session');
		return $this->redirect('/users/display/'.$user['mcaNumber']);	
		}
	}
}
public function checkDownline($root){
	$session = Session::read('session');
	$togo = Users::find('first',array(
		'conditions'=>array('mcaNumber'=>$root)
	));
	if($togo['left']>=$session['left'] && $togo['right']<=$session['right']){return true;}
	
	return false;
}
 
	public function mobile(){
		
		if($this->request->data){
			if($this->request->data['mcaNumber']!=""){
		$data = array(
			"mcaNumber" => $this->request->data['mcaNumber'],
			"Mobile" => $this->request->data['Mobile'],
		);	
		
		Users::find('all',array(
			'conditions'=>array(
				'mcaNumber'=> $this->request->data['mcaNumber'],
			)
		))->save($data);
			}
		}
		
				$thismonth = date('Y-m',strtotime("0 month", strtotime(date("F") . "1")));
				$previousmonth = date('Y-m',strtotime("-1 month", strtotime(date("F") . "1")));
				$yestermonth = date('Y-m',strtotime("-2 month", strtotime(date("F") . "1")));
		$conditions = 	array(
		 				'Mobile'=>array('$exists'=>false),
				);
				

		$users = Users::find("first",array(
			'conditions'=>$conditions,
			'order'=>array($thismonth.'.BV'=>'DESC',$previousmonth.'.BV'=>'DESC','DateJoin'=>'DESC')
		));
		$count = Users::find('count',array(
			'conditions' => $conditions
			));

		return compact("users",'count');
	}
	
		public function gender(){
		
		$users = Users::find("all",array(
			'conditions'=>array('Gender'=>array('$exists'=>false)),
			'order'=>array('_id'=>'ASC')
		));

		if($this->request->data){
			if($this->request->data['mcaNumber']!=""){
		$data = array(
			"mcaNumber" => $this->request->data['mcaNumber'],
			"Gender" => $this->request->data['Gender'],
		);		
		Users::find('all',array(
			'conditions'=>array(
				'mcaNumber'=> $this->request->data['mcaNumber'],
			)
		))->save($data);
			}
		}
		return compact("users");
	}
	public function uploadbv(){
		ini_set('memory_limit','-1');
		
  $User = Users::find('all');
//  foreach($User as $u){
//    $conditions = array(
//     'mcaNumber' => (string)$u['mcaNumber']
//    );
    
//			$bvupdate = array(
//   						$this->request->data['YearMonth'].'.ValidTitle' => '..',
//									$this->request->data['YearMonth'].'.PaidTitle' => '..'
//    );
//  	Users::update($bvupdate,$conditions);
//  }
   
  
  
  
  
		if($this->request->data){
			$file = $this->request->data['file'];	
			
			if($_FILES['file']['tmp_name'] == 0){	
				$name = $_FILES['file']['tmp_name'];
//    $ext = strtolower(end(explode('.', $_FILES['file']['tmp_name'])));
    $type = $_FILES['file']['tmp_name'];
    $tmpName = $_FILES['file']['tmp_name'];
			}
			$row = 1;

			if (($handle = fopen($tmpName, "r")) !== FALSE) {
						while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
							$num = count($data);
							$row++;
								$conditions = array(
									'mcaNumber' => (string)$data[1]
								);
								$bvupdate = array(
									$this->request->data['YearMonth'].'.Serial' => (int)$data[0],
         $this->request->data['YearMonth'].'.Level' => (int)$data[5],
									$this->request->data['YearMonth'].'.ValidTitle' => trim((string)$this->titleCase($data[7])),
									$this->request->data['YearMonth'].'.PaidTitle' => trim((string)$this->titleCase($data[8])),
									$this->request->data['YearMonth'].'.PV' => (int)$data[9],
									$this->request->data['YearMonth'].'.GPV' => (int)$data[10],
									$this->request->data['YearMonth'].'.BV' => (int)$data[11],
									$this->request->data['YearMonth'].'.GBV' => ((int)$data[13]-(int)$data[11]),
									$this->request->data['YearMonth'].'.TGBV' => (int)$data[13],
									$this->request->data['YearMonth'].'.TCGBV' => (int)$data[14],
									$this->request->data['YearMonth'].'.Percent' => (int)$data[15],
									$this->request->data['YearMonth'].'.PGBV' => (int)$data[16],
									$this->request->data['YearMonth'].'.Rollup' => (int)$data[17],
									$this->request->data['YearMonth'].'.Legs' => (int)$data[18],
									$this->request->data['YearMonth'].'.QDLegs' => (int)$data[19],
         $this->request->data['YearMonth'].'.NEFT' => (string)$data[29],
         $this->request->data['YearMonth'].'.Aadhar' => (string)$data[30],
								);
								if($this->request->data['Previous']==true){
									
									$BV = Users::find('first',array(
										'conditions' => array(
										'mcaNumber' => (string)$data[1]
									)));
									$previousBV = array(
											$this->request->data['YearMonth'].'.Previous.Level' => (int)$BV[$this->request->data['YearMonth']]['Level'],
											$this->request->data['YearMonth'].'.Previous.ValidTitle' => trim((string)$BV[$this->request->data['YearMonth']]['ValidTitle']),
											$this->request->data['YearMonth'].'.Previous.PaidTitle' => trim((string)$BV[$this->request->data['YearMonth']]['PaidTitle']),
											$this->request->data['YearMonth'].'.Previous.PV' => (int)$BV[$this->request->data['YearMonth']]['PV'],
											$this->request->data['YearMonth'].'.Previous.GPV' => (int)$BV[$this->request->data['YearMonth']]['GPV'],
											$this->request->data['YearMonth'].'.Previous.BV' => (int)$BV[$this->request->data['YearMonth']]['BV'],
											$this->request->data['YearMonth'].'.Previous.GBV' => (int)$BV[$this->request->data['YearMonth']]['GBV'],
											$this->request->data['YearMonth'].'.Previous.TGBV' => (int)$BV[$this->request->data['YearMonth']]['TGBV'],
											$this->request->data['YearMonth'].'.Previous.TCGBV' => (int)$BV[$this->request->data['YearMonth']]['TCGBV'],
											$this->request->data['YearMonth'].'.Previous.Percent' => (int)$BV[$this->request->data['YearMonth']]['Percent'],
											$this->request->data['YearMonth'].'.Previous.PGBV' => (int)$BV[$this->request->data['YearMonth']]['PGBV'],
											$this->request->data['YearMonth'].'.Previous.Rollup' => (int)$BV[$this->request->data['YearMonth']]['Rollup'],
											$this->request->data['YearMonth'].'.Previous.Legs' => (int)$BV[$this->request->data['YearMonth']]['Legs'],
											$this->request->data['YearMonth'].'.Previous.QDLegs' => (int)$BV[$this->request->data['YearMonth']]['QDLegs'],
           $this->request->data['YearMonth'].'.Previous.NEFT' => (string)$BV[$this->request->data['YearMonth']]['NEFT'],
           $this->request->data['YearMonth'].'.Previous.Aadhar' => (string)$BV[$this->request->data['YearMonth']]['Aadhar'],
									);
									Users::update($previousBV,$conditions);
								}
        
							Users::update($bvupdate,$conditions);
							if($this->request->data['Previous']==true){
								$dailyBV = Users::find('first',array(
										'conditions' => array(
										'mcaNumber' => (string)$data[1]
								)));
								$today = $dailyBV[$this->request->data['YearMonth']]['BV'];
								$yesterday = $dailyBV[$this->request->data['YearMonth']]['Previous']['BV'];
								$mcaName = $dailyBV['mcaName'];
								$mcaNumber = $dailyBV['mcaNumber'];
								$todayDate = gmdate('Y-m-d',time());
								
								$dailyUpdate = array(
									'BV'=> (integer)($today - $yesterday),
									'mcaName'=>(string)$mcaName,
									'mcaNumber'=>(string)$mcaNumber,
									'Date'=>(string)$todayDate
								);
								Purchases::create()->save($dailyUpdate);
							}	
						}
						fclose($handle);
			}
		}
	}
	function titleCase($string, $delimiters = array(" ", "-", ".", "'", "O'", "Mc"), $exceptions = array("de", "da", "dos", "das", "do", "I", "II", "III", "IV", "V", "VI"))
    {
        /*
         * Exceptions in lower case are words you don't want converted
         * Exceptions all in upper case are any words you don't want converted to title case
         *   but should be converted to upper case, e.g.:
         *   king henry viii or king henry Viii should be King Henry VIII
         */
        $string = mb_convert_case($string, MB_CASE_TITLE, "UTF-8");
        foreach ($delimiters as $dlnr => $delimiter) {
            $words = explode($delimiter, $string);
            $newwords = array();
            foreach ($words as $wordnr => $word) {
                if (in_array(mb_strtoupper($word, "UTF-8"), $exceptions)) {
                    // check exceptions list for any words that should be in upper case
                    $word = mb_strtoupper($word, "UTF-8");
                } elseif (in_array(mb_strtolower($word, "UTF-8"), $exceptions)) {
                    // check exceptions list for any words that should be in upper case
                    $word = mb_strtolower($word, "UTF-8");
                } elseif (!in_array($word, $exceptions)) {
                    // convert to uppercase (non-utf8 only)
                    $word = ucfirst($word);
                }
                array_push($newwords, $word);
            }
            $string = join($delimiter, $newwords);
       }//foreach
       return $string;
    }
public function uploadmca(){

		if($this->request->data){
			$file = $this->request->data['file'];	
			
			if($_FILES['file']['tmp_name'] == 0){	
				$name = $_FILES['file']['tmp_name'];
    $ext = strtolower(end(explode('.', $_FILES['file']['tmp_name'])));
    $type = $_FILES['file']['tmp_name'];
    $tmpName = $_FILES['file']['tmp_name'];
			}
			$row = 1;

			if (($handle = fopen($tmpName, "r")) !== FALSE) {
						while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
							$num = count($data);
							$row++;
								$data = array(
									'mcaNumber' => (string)$data[1],
									'mcaName' => ucwords(strtolower((string)$data[2])),
									'refer' => (integer)$data[6],
									'level' => (string)$data[5],
									'DateJoin' => (string)$data[4],
								);
								$user = Users::find("first",array(
								"conditions"=>array('mcaNumber'=>$data['mcaNumber'])
								));
								if(count($user)!=1){
									if($data['mcaNumber']!=""){
										if((int)$data['mcaNumber']>0){
											$this->addUser($data);
											print_r($data);
										}
									}
								}
						}
						fclose($handle);
			}
	}
}

public function uploadbuilders(){

		if($this->request->data){
			$file = $this->request->data['file'];	
			
			if($_FILES['file']['tmp_name'] == 0){	
				$name = $_FILES['file']['tmp_name'];
    $ext = strtolower(end(explode('.', $_FILES['file']['tmp_name'])));
    $type = $_FILES['file']['tmp_name'];
    $tmpName = $_FILES['file']['tmp_name'];
			}
			$row = 1;

			if (($handle = fopen($tmpName, "r")) !== FALSE) {
						while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
							$num = count($data);
							$row++;
								$data = array(
									'mcaNumber' => (string)$data[1],
									'mcaName' => ucwords(strtolower((string)$data[2])),
									'refer' => (integer)$data[5],
//									'level' => (string)$data[5],
									'DateJoin' => (string)$data[4],
         'ValidTitle'=>(string)$data[6],
         'PaidTitle'=>(string)$data[7],
         'Percent'=>(integer)$data[8],
         'PBV'=>(integer)$data[10],
         'GBV'=>(integer)$data[12],
         'TGBV'=>(integer)$data[13],
         'TCGBV'=>(integer)$data[14],
         'Level'=>(integer)$data[15],
         'PGBV'=>(integer)$data[16],
         'RollUp'=>(integer)$data[17],
         'Legs'=>(integer)$data[18],
         'QDLegs'=>(integer)$data[19],
         'APB'=>(integer)$data[20],
         'DB'=>(integer)$data[21],
         'LPB'=>(integer)$data[22],
         'TF'=>(integer)$data[23],
         'CF'=>(integer)$data[24],
         'HF'=>(integer)$data[25],
         'Gross'=>(integer)$data[26],
         
         
								);
								$user = Builders::find("first",array(
								"conditions"=>array('mcaNumber'=>$data['mcaNumber'])
								));
								if(count($user)!=1){
									if($data['mcaNumber']!=""){
										if((int)$data['mcaNumber']>0){
           $yyyymm = $this->request->data['yyyymm'];
											$this->addUserBuilders($data,$yyyymm);
											print_r($data);
										}
									}
								}else{
           $yyyymm = $this->request->data['yyyymm'];
											$this->updateUserBuilders($data,$yyyymm);
        }
						}
						fclose($handle);
			}
	}
}

	public function adduser($data){
		
			if($data){
			if($data['mcaNumber']!="" && $data["mcaName"]!=""){
				print_r($data['refer']);
				$refer = Users::first(array(
						'fields'=>array('left','mcaNumber','ancestors','mcaName'),
							'conditions'=>array('mcaNumber'=>(string)$data['refer'])
						));
				$refer_ancestors = $refer['ancestors'];
				
				$ancestors = array();

				foreach ($refer_ancestors as $ra){
					array_push($ancestors, $ra);
				}
				$refer_mcanumber = (string) $refer['mcaNumber'];

				array_push($ancestors,$refer_mcanumber);

				$refer_id = $refer_mcanumber;
				$refer_left = (integer)$refer['left'];
				$refer_left_inc = (integer)$refer['left'];
				$refername = Users::find('first',array(
						'fields'=>array('mcaName','mcaNumber'),
						'conditions'=>array('mcaNumber'=>(string)$data['refer'])
				));
				
				$refer_name = $refername['mcaName'];
				$refer_id = $refername['mcaNumber']; 

				
			}else{
				$refer_left = 0;
				$refer_name = "";
				$refer_id = "";
				$ancestors = array();
			}
				Users::update(
					array(
						'$inc' => array('right' => (integer)2)
					),
					array('right' => array('>'=>(integer)$refer_left_inc)),
					array('multi' => true)
				);
				Users::update(
					array(
						'$inc' => array('left' => (integer)2)
					),
					array('left' => array('>'=>(integer)$refer_left_inc)),
					array('multi' => true)
				);
			
			$data = array(
				'mcaName'=>(string)$data["mcaName"],
				'mcaNumber'=>(string)$data["mcaNumber"],
				'refer'=>(string)$data["refer"],
				'refer_name'=>$refer_name,
				'refer_id'=>(string)$refer_id,
				'ancestors'=> $ancestors,
				'DateJoin'=>(string)$data["DateJoin"],
				'left'=>(integer)($refer_left+1),
				'right'=>(integer)($refer_left+2),

			);

			Users::create()->save($data);
			
		}

	}
	public function updateUserBuilders($data,$yyyymm){
			$data = array(
				'mcaName'=>(string)$data["mcaName"],
				'mcaNumber'=>(string)$data["mcaNumber"],
				'refer'=>(string)$data["refer"],
				'refer_name'=>$refer_name,
				'refer_id'=>(string)$refer_id,
				'ancestors'=> $ancestors,
				'DateJoin'=>(string)$data["DateJoin"],
				'left'=>(integer)($refer_left+1),
				'right'=>(integer)($refer_left+2),
     $yyyymm.'.ValidTitle'=>(string)$data['ValidTitle'],
     $yyyymm.'.PaidTitle'=>(string)$data['PaidTitle'],
     $yyyymm.'.Percent'=>(integer)$data['Percent'],
     $yyyymm.'.PBV'=>(integer)$data['PBV'],
     $yyyymm.'.GBV'=>(integer)$data['GBV'],
     $yyyymm.'.TGBV'=>(integer)$data['TGBV'],
     $yyyymm.'.TCGBV'=>(integer)$data['TCGBV'],
     $yyyymm.'.Level'=>(integer)$data['Level'],
     $yyyymm.'.PGBV'=>(integer)$data['PGBV'],
     $yyyymm.'.RollUp'=>(integer)$data['RollUp'],
     $yyyymm.'.Legs'=>(integer)$data['Legs'],
     $yyyymm.'.QDLegs'=>(integer)$data['QDLegs'],
     $yyyymm.'.APB'=>(integer)$data['APB'],
     $yyyymm.'.DB'=>(integer)$data['DB'],
     $yyyymm.'.LPB'=>(integer)$data['LPB'],
     $yyyymm.'.TF'=>(integer)$data['TF'],
     $yyyymm.'.CF'=>(integer)$data['CF'],
     $yyyymm.'.HF'=>(integer)$data['HF'],
     $yyyymm.'.Gross'=>(integer)$data['Gross'],

			);
   $conditions = array('mcaNumber'=>(string)$data["mcaNumber"]);
			Builders::update($data,$conditions);
  
 }
	public function adduserBuilders($data,$yyyymm){
		
			if($data){
			if($data['mcaNumber']!="" && $data["mcaName"]!=""){
				print_r($data['refer']);
				$refer = Builders::first(array(
						'fields'=>array('left','mcaNumber','ancestors','mcaName'),
							'conditions'=>array('mcaNumber'=>(string)$data['refer'])
						));
				$refer_ancestors = $refer['ancestors'];
				
				$ancestors = array();
    if(count($refer_ancestors)>0){
     foreach ($refer_ancestors as $ra){
      array_push($ancestors, $ra);
     }
    }
				$refer_mcanumber = (string) $refer['mcaNumber'];

				array_push($ancestors,$refer_mcanumber);

				$refer_id = $refer_mcanumber;
				$refer_left = (integer)$refer['left'];
				$refer_left_inc = (integer)$refer['left'];
				$refername = Builders::find('first',array(
						'fields'=>array('mcaName','mcaNumber'),
						'conditions'=>array('mcaNumber'=>(string)$data['refer'])
				));
				
				$refer_name = $refername['mcaName'];
				$refer_id = $refername['mcaNumber']; 

				
			}else{
				$refer_left = 0;
				$refer_name = "";
				$refer_id = "";
				$ancestors = array();
			}
				Builders::update(
					array(
						'$inc' => array('right' => (integer)2)
					),
					array('right' => array('>'=>(integer)$refer_left_inc)),
					array('multi' => true)
				);
				Builders::update(
					array(
						'$inc' => array('left' => (integer)2)
					),
					array('left' => array('>'=>(integer)$refer_left_inc)),
					array('multi' => true)
				);
			
			$data = array(
				'mcaName'=>(string)$data["mcaName"],
				'mcaNumber'=>(string)$data["mcaNumber"],
				'refer'=>(string)$data["refer"],
				'refer_name'=>$refer_name,
				'refer_id'=>(string)$refer_id,
				'ancestors'=> $ancestors,
				'DateJoin'=>(string)$data["DateJoin"],
				'left'=>(integer)($refer_left+1),
				'right'=>(integer)($refer_left+2),
     $yyyymm.'.ValidTitle'=>(string)$data['ValidTitle'],
     $yyyymm.'.PaidTitle'=>(string)$data['PaidTitle'],
     $yyyymm.'.Percent'=>(integer)$data['Percent'],
     $yyyymm.'.PBV'=>(integer)$data['PBV'],
     $yyyymm.'.GBV'=>(integer)$data['GBV'],
     $yyyymm.'.TGBV'=>(integer)$data['TGBV'],
     $yyyymm.'.TCGBV'=>(integer)$data['TCGBV'],
     $yyyymm.'.Level'=>(integer)$data['Level'],
     $yyyymm.'.PGBV'=>(integer)$data['PGBV'],
     $yyyymm.'.RollUp'=>(integer)$data['RollUp'],
     $yyyymm.'.Legs'=>(integer)$data['Legs'],
     $yyyymm.'.QDLegs'=>(integer)$data['QDLegs'],
     $yyyymm.'.APB'=>(integer)$data['APB'],
     $yyyymm.'.DB'=>(integer)$data['DB'],
     $yyyymm.'.LPB'=>(integer)$data['LPB'],
     $yyyymm.'.TF'=>(integer)$data['TF'],
     $yyyymm.'.CF'=>(integer)$data['CF'],
     $yyyymm.'.HF'=>(integer)$data['HF'],
     $yyyymm.'.Gross'=>(integer)$data['Gross'],

			);

			Builders::create()->save($data);
			
		}

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

}
?>