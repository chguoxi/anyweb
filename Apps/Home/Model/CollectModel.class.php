<?php
namespace Home\Model;
use Think\Model;

class CollectModel extends Model {
	protected $_validate = array(
			array('name','require','收藏名称必填!'),
			array('value','require','收藏内容必填'),
			array('value','url','URL地址不正确'),
			
	);
	
	public function getCollect($uid=0, $limit='', $order=''){
		$uid = $uid>0 ? $uid : get_uid();
		$cateModel = D('Cate');
		//查询条件
		$where = array();
		$where['ca.uid'] = array('EQ',$uid);
		$collects = $this->alias('co')->join(C('DB_PREFIX').'cate ca ON co.cateid=ca.cateid')->where($where)->select();
		$cates = $cateModel->getUserCates($uid);
		$mcollect = array();
		// 组装数据
		foreach ( $cates as $cate ) {
			$mcollect [$cate ['cateid']] = array (
					'catename' => $cate ['catename'],
					'cateid' => $cate ['cateid'],
					'isdefault' => $cate ['isdefault'],
					'data' => array () 
			);
			foreach ( $collects as $collect ) {
				if ($collect ['cateid'] == $cate ['cateid']) {
					array_push ( $mcollect [$cate ['cateid']] ['data'], $collect );
				}
			}
		}
		return $mcollect;
	}
	
	public function checkUserMaxCollect($uid){
		$userModel = D('User');
		$userCollectCount = C('USER_GROUP_ALLOW_COLLECT_COUNT');
		$group = $userModel->where("uid=".$uid)->getField('group');
		return  isset($userCollectCount[$group]) ? $userCollectCount[$group] : 100;
	}
	
	protected function _before_insert(&$data, $options){
		$data['uid'] = get_uid('uid');
		$data['dateline'] = strtotime('now');
	}
}