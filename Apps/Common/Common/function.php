<?php
//导入扩展函数库
load('extend');
/**
 * 上传文件方法
 */
function upload() {
	import ( 'ORG.Net.UploadFile' );
	$upload = new UploadFile (); // 实例化上传类
	$upload->maxSize = 3145728; // 设置附件上传大小
	$upload->allowExts = array (
			'jpg',
			'gif',
			'png',
			'jpeg'
	); // 设置附件上传类型
	$upload->savePath = './Public/Uploads/';
	$upload->thumb = true;
	$upload->thumbMaxWidth = 100;
	$upload->thumbMaxHeight = 100;
	
	if (! $upload->upload ()) {
		$message = $upload->getErrorMsg();
		$data = array(
				'error'=>1,
				'message'=>$message
		);
	} else {
		$info =  $upload->getUploadFileInfo();
		$path = $info[0]['savepath'].$info[0]['savename'];
		$thumb = $info[0]['savepath'].'thumb_'.$info[0]['savename'];	
		$data = array(
				'error'=>0,
				'name'=>$info[0]['name'],
				'url'=>$path,
				'thumb'=>$thumb
		);
	}
	
	return $data;
}

function is_url($url){
	if (preg_match('/http:\/\/[\w\.]*\.[\w]/i', $url)){
		return true;
	}
	return false;
}

function encode_password($password){
	$password = md5(C('PASS_KEY').$password);
	return $password;
}

function get_uid(){
	return cookie('uid');
}

/**
 * 截取中文字符串,如果字串中包含字母或数字
 * @access public
 * @param $str
 * @param $lenght
 */

function mbsubstr($str, $length){
	$strlen = mb_strlen($str,'utf-8');
	$substr = mb_substr($str, 0, $length, 'utf-8');
	preg_match_all('/[a-zA-Z0-9]{1}/i', $substr, $matchs);
	$latin_len = count($matchs[0]);
	if ( $latin_len>3 ){
		$add_strlen = $latin_len;//ceil($latin_len / $latin_c);
		$substr .= mb_substr($str, $length, $add_strlen,'utf-8');
	}
	return $substr;
}
