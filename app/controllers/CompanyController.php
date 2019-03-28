<?php
namespace app\controllers;
use app\models\Users;
use app\models\Pages;
class CompanyController extends \lithium\action\Controller {
	
	public function Index(){
		
	}	
	public function About(){
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
	public function privacy(){
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
	
}
?>