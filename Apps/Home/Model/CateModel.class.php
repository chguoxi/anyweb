<?php
namespace Home\Model;
use Think\Model;
class CateModel extends Model {
	protected $pk = 'cateid';
	
	protected $_validate = array(
		array('catename','require','类别名称必填!'),
	);
	
	public function getUserCates($uid){
		$where = array('uid'=>$uid);
		$cates = $this->where($where)->select();
		return $cates;
	}
	
	public function addDefaultCate($uid){
		if(!$uid){
			return false;
		}
		$catename = '默认类别';
		$data = array(
				'uid'=>$uid,
				'isdefault'=>1
				);
		$default = $this->where($data)->find();
		if ( !$default ){
			$data['catename'] = $catename;
			return $this->add($data);
		}
		else {
			return $default['cateid'];
		}
	}
	
	protected function _before_write(&$data){
		if (in_array('uid', $this->fields) && !isset($data['uid'])){
			$data['uid'] = get_uid();
		}
	}
}
