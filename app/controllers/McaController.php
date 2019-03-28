<?php
namespace app\controllers;
use app\models\Pages;
use app\models\Users;
use app\models\Addresses;
use app\models\Events;
use app\models\Products;
use app\models\Codes;
use app\models\Categories;



class McaController extends \lithium\action\Controller {
	

public function urban(){
  if($this->request->data){
   $code = $this->request->data['Code'];
   $start = $this->request->data['Start'];
   $end = $this->request->data['End'];
   $k=0;
   for($i=$start;$i<=$end;$i++){
    $k++;
    $kk = str_pad($k,4,"0",STR_PAD_LEFT);
    $ii = str_pad($i,4,"0",STR_PAD_LEFT);
    
    $product = Products::find('first',array(
     'conditions'=>array('Code'=>$kk.$code)
    ));
    
    $data = array(
    'Code' => "UC".$ii,
    'Old_Code' => $kk.$code,
    'MRP' => (integer)$this->request->data['MRP'],
    'Old_MRP' => (integer)$product['MRP'],
    'DP' => (integer)$this->request->data['DP'],
    'Old_DP' => (integer)$product['DP'],
    'BV' => (integer)$this->request->data['DP']*$this->request->data['BVPercent']/100,
    'Old_BV' => (integer)$product['BV'],
    'Updated' => "Yes"
    );
    $newproduct = Products::find('first',array(
     'conditions'=>array('Code'=>(string)$kk.$code),
    ))->save($data);
   }
  }
		return compact('products');
}
 public function change(){
 	$products = Products::find('all',array(
			'order'=>array(
			'category'=>'ASC',
			'code'=>'ASC',
			'name'=>'ASC',
			),
//   'conditions'=>array('Old_Code'=>null)
		));
 $productschanged = Products::find('all',array(
  'conditions'=>array('Updated' => "Yes"),
			'order'=>array(
			'category'=>'ASC',
			'code'=>'ASC',
			'name'=>'ASC',
			),
//   'conditions'=>array('Old_Code'=>null)
		));
  
		return compact('products','productschanged');
}
 public function changeedit($_id){
 	if($this->request->data){
   $data = array(
    'code' => $this->request->data['Code'],
    'Old_Code' => $this->request->data['Old_Code'],
    'size' => $this->request->data['Size'],
    'mrp' => (integer)$this->request->data['MRP'],
    'Old_MRP' => (integer)$this->request->data['Old_MRP'],
    'dp' => (integer)$this->request->data['DP'],
    'description' => $this->request->data['description'],
    'Old_DP' => (integer)$this->request->data['Old_DP'],
    'bv' => (integer)$this->request->data['DP']*$this->request->data['BVPercent']/100,
    'Old_BV' => (integer)$this->request->data['Old_BV'],
    'Updated' => "Yes"
    );
			$newproduct = Products::find('first',array(
		'conditions'=>array('_id'=>(string)$this->request->data['_id']),
		))->save($data);
  return $this->redirect('/mca/change/');  
  }
  
  $product = Products::find('first',array(
			'conditions'=>array(
			'_id'=>(string)$_id,
			)
		));
  
		return compact('product');
}

	public function Index(){
	}	
	public function listall(){
		$products = Products::find('all',array(
			'order'=>array(
			'Category'=>'ASC',
			'Code'=>'ASC',
			'Name'=>'ASC',
			)
		));
		return compact('products');
	}
	public function gujarati($code=null){
		$product = Products::find('first',array(
		'conditions'=>array('code'=>$code),
		'order'=>array(
			'category'=>'ASC',
			'code'=>'ASC',
			'name'=>'ASC',
			)
		));
		$category = Products::find('all',array(
		'conditions'=>array('g_description'=>null),
		'order'=>array(
			'category'=>'ASC',
			'code'=>'ASC',
			'name'=>'ASC',
			)
		));
		if($this->request->data){
			$data = array(
				'g_category'=>$this->request->data['g_Category'],
				'g_name'=>$this->request->data['g_Name'],
				'g_description'=>$this->request->data['g_Description']
			);
			$product = Products::find('first',array(
		'conditions'=>array('code'=>$this->request->data['Code']),
		))->save($data);
		
		$product = Products::find('first',array(
		'conditions'=>array('code'=>$this->request->data['Code']),
		));
		}
		return compact('product','category');

	}
	public function order(){
			$products = Products::find('all',array(
		'order'=>array(
			'Category'=>'ASC',
			'Code'=>'ASC',
			'Name'=>'ASC',
			)
		));
		$addresses = Addresses::find('all',array(
			'order'=>array('_id'=>'DESC')
		));
		if($this->request->data){
			print_r($this->request->data);
		}
		return compact('products','addresses');
	}
	public function Products(){
		$products = Products::find('all',array(
		'order'=>array(
			'category'=>'ASC',
			'code'=>'ASC',
			'name'=>'ASC',
			)
		));
		return compact('products');
	}	
	public function Events(){
		$togo = explode('/',$this->request->url);
		$events = Events::find('all');
	if($this->request->data){
		
		if($this->request->data['page']=='events'){
		$page = Pages::find('all',array(
		'conditions'=>array('page'=>strtolower($this->request->data['page'])),
		))->save($this->request->data);
		}else{
			$event = Events::create($this->request->data)->save();
		}
	}
		$page = Pages::find('first',array(
			'conditions'=>array('page'=>strtolower($togo[count($togo)-1]))
		));
		return compact('page','events');
		
	}	
	public function Product($code=null){
		$product = Products::find('first',array(
		'conditions'=>array('code'=>$code),
		'order'=>array(
			'category'=>'ASC',
			'code'=>'ASC',
			'name'=>'ASC',
			)
		));
		$category = Products::find('all',array(
		'conditions'=>array('category'=>$product['category']),
		'order'=>array(
			'category'=>'ASC',
			'Code'=>'ASC',
			'name'=>'ASC',
			)
		));
		if($this->request->data){
			$data = array(
				'description'=>$this->request->data['description'],
				'video'=>$this->request->data['video']
			);
			$product = Products::find('first',array(
		'conditions'=>array('code'=>$this->request->data['code']),
		))->save($data);
		
		$product = Products::find('first',array(
		'conditions'=>array('code'=>$this->request->data['code']),
		));
		}
		return compact('product','category');
	}
	public function addproduct(){
		if($this->request->data){
			$data = array(
				'Category'=>$this->request->data['Category'],
				'Name'=>$this->request->data['Name'],
				'Size'=>$this->request->data['Size'],
				'Code'=>$this->request->data['Code'],
				'MRP'=> (int)$this->request->data['MRP'],
				'DP'=> (int)$this->request->data['DP'],
				'BV'=> (float)$this->request->data['BV'],
				'PV'=> (float)$this->request->data['PV'],
			);
			$Product = Products::create($data);	
			$saved = $Product->save();
		}
		
	$categories = Categories::find('all');

	return compact ('categories');
	}
	public function getDPBV($Code){
				$product = Products::find('first',array(
			'conditions'=>array('Code'=>$Code),
		));
				return $this->render(array('json' => array(
				'product'=> $product,
			)));

	}
	
	public function getIFSC($code){
		$banks = Codes::find('all',array(
			'conditions'=>array('IFSC'=>array('$regex'=>$code)),
			'order'=>array('IFSC'=>1),
			'limit'=>20
		));
		$IFSCcode = array();
		foreach($banks as $bank){
			array_push($IFSCcode,$bank['IFSC']);
		}
				return $this->render(array('json' => array(
				'IFSCcodes'=> $IFSCcode,
			)));
		
	}
	public function selectIFSC($code){
		$bank = Codes::find('first',array(
			'conditions'=>array('IFSC'=>$code)
		));
				return $this->render(array('json' => array(
				'bank'=> $bank,
			)));		
	}

}
?>