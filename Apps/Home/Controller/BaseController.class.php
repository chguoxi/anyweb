<?php
namespace Home\Controller;
use Think\Controller;

class BaseController extends Controller {
	protected $modelName;
	protected $modelObj;
	protected $uid;
	protected $cateModel;
	protected $collectModel;
	
	/**
	 * 初始化数据
	 */
	public function _initialize(){
		$this->tuser();
		$this->checkLogin();
		$this->uid = get_uid();
		$this->modelName = ucfirst($this->modelName);
		$this->modelObj = D($this->modelName);
		$this->assign('siteName',APP_NAME);
		
		$this->cateModel = D('Cate');
		$this->collectModel = D('Collect');
		//创建收藏的默认分类
		$this->cateModel->addDefaultCate($this->uid);
		$this->assign('project',$this->_getProjectName());
		$this->assign('username',cookie('username'));
		$this->assign('isMangeMode',$this->isManageMode());
		$this->assign('uid',$this->uid);
	}
	
	/**
	 * 添加或修改数据
	 */
	public function edit(){
		$id = I('id');
		if ( !empty($id) && !is_numeric($id) ){
			$this->error('哥们,你是想坑我么?');
		}
		if ( $id ){
			$data = $this->modelObj->where($this->modelObj->getPk().'='.$id)->find();
			if ( isset($data['uid']) && !$this->checkAuthority($data['uid']) ){
				$this->error('你没有权限操作这条数据');
			}
		}
		try {
			if ( IS_POST ){
				if ( !$this->modelObj->create() ){
					$this->error($this->modelObj->getError());
				}
				if ( $id && $data ){
					$this->modelObj->where($this->modelObj->getPk().'='.$id)->save();
				}
				else{
					$this->modelObj->add();
				}
				
				$this->success('保存成功!');
			}
			else{
				$this->assign('data',$data);
				$this->display();
			}
		} catch (ThinkException $e) {
			$this->error($e->getMessage());
		}
	}
	
	/**
	 * 删除数据
	 */
	public function delete(){
		try {
			$ids = I('id');
			if ( !$ids && $this->isPost() ){
				$ids = $_POST['id'];
			}
			if ( is_array($ids) ){
				$wehresql = $this->modelObj->getPk()." in(".implode(',', $ids).")";
			}
			elseif( is_numeric($ids) ){
				$wehresql = $this->modelObj->getPk()." = $ids";
			}
			else{
				$this->error('没有选择任何数据');
			}
			$count = $this->modelObj->where($wehresql)->delete();
			$this->success("成功删除".$count."条记录");
		} catch (ThinkException $e) {
			$this->error($e->getMessage());
		}
	}
	
	private function checkLogin(){
		
		$nologin = C('NO_LOGIN_LIST');
		//dump($nologin);exit;
		//dump(MODULE_NAME);exit;
		$path = MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME;
		//dump($path);exit;
		if ( !$this->isLogin() && !in_array($path, $nologin) ){
			$this->redirect(U('Index/login'));
			//$this->error('你尚未登录,请先登录',U('Home/Index/login'));
		}
	}
	
	protected function isLogin(){
		$uid =get_uid();
		$username = cookie('username');
		if ( !$uid || empty($username)){
			cookie(null);
			return false;
		}
		return true;
	}
	
	private function tuser(){
// 		if ( !session('uid') ){
// 			session('uid',1);
// 			session('username','chguoxi');
// 		}
	}
	
	protected function isManageMode(){
		return session('manageMode');
	}
	
	public function verify(){
		import('ORG.Util.Image');
		Image::buildImageVerify();
	}
	
	private function _getProjectName(){
		return APP_NAME;
	}
	
	protected function getLastUpdateTime($key){
		
	}
	
	protected function checkAuthority($uid){
		return get_uid() == $uid? true : false;
	}
	

}