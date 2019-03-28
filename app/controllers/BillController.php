<?php
namespace app\controllers;
use app\models\Pages;
use app\models\Users;
use app\models\Admins;
use app\models\DPUsers;
use app\models\Invoices;
use app\models\InvoiceDetails;
use app\models\Options;
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

class BillController extends \lithium\action\Controller {
	protected function _init(){
		parent::_init();
  $employee = Session::read('employee');
  if($this->request->action!='login'){
   if($employee==null){return $this->redirect('/bill/login');}
  } 
	}
 public function findMCA($mcaNumber=null){
 $user = Invoices::find('first',array(
   'conditions'=>array('mcaNumber'=>$mcaNumber)
  ));
 
  return $this->render(array('json' => array(
    'user'=>$user
			)));
 }
 public function findinvoices($mcaNumber=null){
  
 $Invoices = Invoices::find('all',array(
 'conditions'=>array(
  'mcaNumber'=>$mcaNumber, 
  'pending' => null
  ),
  'order'=>array('invoiceNo'=>'DESC')
 )); 
 $allinvoices = array();
 foreach($Invoices as $invoice){
  array_push($allinvoices, array(
   'invoiceNo'=>$invoice['invoiceNo'],
   'mcaNumber'=>$invoice['mcaNumber'],
   'mcaName'=>$invoice['mcaName'],
   'invoiceSr'=>$invoice['invoiceSr'],
   'totalItems'=>$invoice['totalItems'],
   'totalProducts'=>$invoice['totalProducts'],
   'totalDP'=>$invoice['totalDP'],
   'totalBV'=>$invoice['totalBV'],
   'payment'=>$invoice['payment']
  ));
 }

 $user = Invoices::find('first',array(
   'conditions'=>array('mcaNumber'=>$mcaNumber)
  ));
  
  return $this->render(array('json' => array(
    'user'=>$user,
    'invoices'=>$allinvoices
			)));
  }
 public function findcode($code=null){
  $product = Products::find('first',array(
   'conditions'=>array('Code'=>$code)
  ));
  return $this->render(array('json' => array(
				'product'=> $product,
			)));
 }
 public function findname($name=null){
  $products = Products::find('all',array(
   'conditions'=>array('Name'=>array('$regex'=>$name,'$options'=>'-i'))
  ));
  $searchedProducts = array();
  foreach($products as $product){
			array_push($searchedProducts,$product['Code'].': '.$product['Name'].' - '.$product['Size']);
		}
  return $this->render(array('json' => array(
				'products'=> $searchedProducts,
			)));
  
 }
 public function findean($ean=null){
  $product = Products::find('first',array(
   'conditions'=>array('EAN'=>$ean)
  ));
  return $this->render(array('json' => array(
				'product'=> $product,
			)));
 }
 public function products(){
  $this->_render['layout'] = 'noHeaderFooter';
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
								$Product = array(
									'Code' => (String)$data[0],
									'Category' => (String)$data[1],
									'EAN' => (String)$data[2],
									'Name' => (String)$data[3],
									'Size' => (String)$data[4],
									'MRP' => (Double)$data[5],
									'DP' => (Double)$data[6],
									'BV' => (Double)$data[7],
         'Description'=>'',
								);
        
       Products::create()->save($Product); 
     }
   }
  }
 }
 public function index(){
  $this->_render['layout'] = 'noHeaderFooter';
 }
 public function addnew(){
  if($this->request->data){
   extract($this->request->data);
   
   $maxInvoiceNo = Invoices::find('first',array(
    'conditions'=>array('invoiceSr'=>$bill),
    'order'=>array('invoiceNo'=>'DESC'),
    'limit'=>1
   ));
   if($maxInvoiceNo['invoiceNo']==null){
    $invoiceNo =  "000001";
   }else{
    $invoiceNo = str_pad((integer)($maxInvoiceNo['invoiceNo'])+1,5,"0",STR_PAD_LEFT);
   }
   $i=0;$TotalItems=0;$TotalProducts=0;$TotalDP=0;$TotalBV=0;
   foreach($this->request->data['code'] as $list){
   $data = array( 
      'DateTime' => new \MongoDate(),
      'mcaNumber' => $mcaNumber,
      'mcaName' => $mcaName,
      'mcaPhone' => $mcaPhone,
      'invoiceSr'=>$bill,
      'invoiceNo' => (string)$invoiceNo,
      'srno'=>$this->request->data['srno'][$i],
      'ean'=>$this->request->data['ean'][$i],
      'code'=>$this->request->data['code'][$i],
      'name'=>$this->request->data['name'][$i],
      'DP'=>round($this->request->data['DP'][$i]),
      'BV'=>round($this->request->data['BV'][$i]),
      'Quantity'=>round($this->request->data['Quantity'][$i]),
      'TotalDP'=>round($this->request->data['TotalDP'][$i]),
      'TotalBV'=>round($this->request->data['TotalBV'][$i])
    );
    $TotalItems = $TotalItems+1;
    $TotalProducts = $TotalProducts+$this->request->data['Quantity'][$i];
    $TotalDP = $TotalDP + $this->request->data['TotalDP'][$i];
    $TotalBV = $TotalBV + $this->request->data['TotalBV'][$i];
    $i++;
   InvoiceDetails::create()->save($data);
   }
   
   
   $data = array(
    'DateTime' => new \MongoDate(),
    'mcaNumber' => $mcaNumber,
    'mcaName' => $mcaName,
    'mcaPhone' => $mcaPhone,
    'invoiceSr'=>$bill,
    'invoiceNo' => (string)$invoiceNo,
    'totalItems'=>(integer)$TotalItems,
    'totalProducts'=>(integer)$TotalProducts,
    'totalDP'=>round($TotalDP),
    'totalBV'=>round($TotalBV),
    'prepared'=>$prepared,
    'preparedMobile'=>$preparedMobile,
    'DPName'=>$DPName,
    'payment'=>$payment,
    'Remarks'=>$Remarks
   );
   Invoices::create()->save($data);
  }
  $print = $this->createPDF($bill,$invoiceNo);
  return $this->redirect('/bill/listbill');
 }
 
 private function createPDF($bill,$invoiceNo){
  $billData = Invoices::find('first',array(
   'conditions'=>array(
    'invoiceSr'=>$bill,
    'invoiceNo'=>$invoiceNo
   )
  ));
  $billDetails = InvoiceDetails::find('all',array(
   'conditions'=>array(
    'invoiceSr'=>$bill,
    'invoiceNo'=>$invoiceNo
   )
  ));
  
		$view  = new View(array(
		'paths' => array(
			'template' => '{:library}/views/{:controller}/{:template}.{:type}.php',
			'layout'   => '{:library}/views/layouts/{:layout}.{:type}.php',
		)
		));
		
  echo $view->render(
		'all',
		compact('billData','billDetails'),
		array(
			'controller' => 'print',
			'template'=>'printinvoice',
			'type' => 'pdf',
			'layout' =>'print'
		)
		);	
  
  return true;
 }
 public function add(){
  $employee = Session::read('employee');
  $this->_render['layout'] = 'noHeaderFooter';
  $products = Products::find('all',array(
			'order'=>array(
			'Category'=>'ASC',
			'Code'=>'ASC',
			'Name'=>'ASC',
			),
//   'conditions'=>array('Old_Code'=>null)
		));
  $options = Options::find('all');
		return compact('products','employee','options');

 }
 public function listbill(){
  $this->_render['layout'] = 'noHeaderFooter';
  $employee = Session::read('employee');
  $bills = Invoices::find('all',array(
   'conditions'=>array(
    'DPName'=>$employee['DP'],
    'DateTime'=>array()
    )
  ));
  return compact('employee','bills');
 }
 public function login(){
  $this->_render['layout'] = 'noHeaderFooter';
  if($this->request->data){
   extract($this->request->data);
   if($password!=$phone_code){
    return $this->redirect('/bill/login');
   }else{
    $Admin = Admins::find('first',array(
     'conditions'=>array('phone'=>$phone)
    ));
    if(count($Admin)==0){
     $data = array(
      'phone'=>$phone,
      'DateTime'=> new \MongoDate(),
      'IP'=>$_SERVER['REMOTE_ADDR']
     );
    }else{
     $DP = array();
     foreach ($Admin['DP'] as $dp){
      array_push($DP,array(
       'Name'=>$dp['Name'],
       'bill'=>$dp['bill'],
       'invoice'=>$dp['invoice'],
       'role'=>$dp['role']
      ));
     }
    $data = array(
     'phone'=>$phone,
     'DateTime'=> new \MongoDate(),
     'IP'=>$_SERVER['REMOTE_ADDR'],
     'Name'=>$Admin['Name'],
     'DPs'=>$DP,
     'DP'=>"",
     'role'=>""
    );
     
    }
    DPUsers::create()->save($data);
 			Session::delete('employee');			
    Session::write('employee',$data);
    return $this->redirect('/bill/select');

   }
   
  }
 }
 public function select(){
  $this->_render['layout'] = 'noHeaderFooter';
  if($this->request->data){
   extract($this->request->data);
   $employee = Session::read('employee');  
   foreach($employee['DPs'] as $dataDP ){
    if($DP==$dataDP['Name']){
     $employee['DP']=$dataDP['Name'];
     $employee['role']=$dataDP['role'];
     $employee['bill']=$dataDP['bill'];
     $employee['invoice']=$dataDP['invoice'];
    }
    Session::write('employee',$employee);
   }
   return $this->redirect('/bill/add');
  }
 }
 public function addinvoice(){
  $this->_render['layout'] = 'noHeaderFooter';

 }
 public function logout(){
  Session::delete('employee');			
  return $this->redirect('/bill/login');
 }
 
}  
 
?>