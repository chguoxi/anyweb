<?php
namespace Home\Controller;
use Home\Controller\BaseController;
class CollectController extends BaseController {
	protected $modelName = 'Collect';
	
	public function edit(){
		
		$userCollectCount = $this->modelObj->where("uid=".$this->uid)->count();
		$allowCollectCount = $this->modelObj->checkUserMaxCollect($this->uid);
		//dump($userCollectCount);
		//dump($allowCollectCount);
		//exit;
		$tipsMsg = "很抱歉,你最多能添加".$allowCollectCount."个连接";
		if ( $userCollectCount>=$allowCollectCount ){
			$this->error($tipsMsg);
		}
		$cateModel = D('Cate');
		$cates = $cateModel->getUserCates($this->uid);
		$this->assign('cates',$cates);
		$this->assign('tipsMsg',$tipsMsg);
		parent::edit();
	}
	
	public function collectList(){
		
		layout('Layout/user');
		
		$collects = $this->modelObj->getCollect($this->uid);
		$cateModel = D('Cate');
		$cates = $cateModel->getUserCates($this->uid);
		$this->assign('cates',$cates);
		$this->assign('collects',$collects);
		$this->display('Collect:index');
	}
	
	public function manageMode(){
		$isManageMode = $this->isManageMode();
		if ( $isManageMode ){
			session('manageMode',0);
		}
		else{
			session('manageMode',1);
		}
		$this->success('设置成功');
	}
	public function redirect(){
		$id = I('id');
		if ( !is_numeric($id) ){
			
		}
	}
	public function delete(){
		$id = I('id');
		if ( !is_numeric($id) ){
			$this->error('请选择你要删除的连接');
		}
		$cinfo = $this->modelObj->where("id=$id")->find();
		if ( !$cinfo ){
			$this->error('该数据不存在或已被删除');
		}
		if ( !$this->checkAuthority($cinfo['uid']) ){
			$this->error('你没有权限操作该数据');
		}
		parent::delete();
	}
}