<?php
namespace Home\Controller;
use Home\Controller\BaseController;

class IndexController extends BaseController {
	private $userAction;
	private $collectAction;
	
	public function _initialize(){
		parent::_initialize();
		$this->userAction    = A('Home/User');
		$this->collectAction = A('Home/Collect');
	}
	
	public function index(){
		$this->collectAction->collectList();
	}
	
	public function join(){
		$this->userAction->join();
	}
	
	public function login(){
		$this->userAction->login();
	}
	
	public function qqLogin(){
		$this->userAction->qqLogin();
	}
	
	public function logout(){
		$this->userAction->logout();
	}
	
	public function manageMode(){
		$this->collectAction->manageMode();
	}
}
