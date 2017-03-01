<?php
namespace Home\Controller;
use Home\Controller\BaseController;
class CateController extends BaseController {
	protected $modelName = 'Cate';
	public function delete(){
		$collectModel = D('Collect');
		$defaultCate = $this->modelObj->where("uid=".$this->uid." AND isdefault=1")->getField('cateid');
		if ( !$defaultCate ){
			$defaultCate = $this->modelObj->addDefaultCate($this->uid);
		}
		try {
			$ids = I ( 'id' );
			if (! $ids && $this->isPost ()) {
				$ids = $_POST ['id'];
			}
			if (is_array ( $ids )) {
				$wheresql = "cateid in(".implode ( ',', $ids ).") AND uid=".$this->uid;
			} elseif (is_numeric ( $ids )) {
				$wheresql = "cateid = $ids AND uid=".$this->uid;
			} else {
				$this->error ( '没有选择任何数据' );
			}
			$collectModel->where( $wheresql )->setField("cateid",$defaultCate);
			$count = $this->modelObj->where ( $wheresql )->delete ();
			$this->success ( "成功删除".$count."条记录" );
		} catch ( ThinkException $e ) {
			$this->error ( $e->getMessage () );
		}
	}
}