<?php
namespace Home\Controller;
use Home\Controller\BaseController;
class UserController extends BaseController {
	protected $modelName = 'User';
	private   $tcAppid = '100485793';
	private   $tcAppkey= '4eaa5bfa453de61ea0ba8d601ba5b5a9';
	
	public function _initialize(){
		parent::_initialize();
		vendor('Tencent.Connect.API.qqConnectAPI');
	}
	public function join(){
// 		C('TOKEN_ON',true);
		if ( IS_POST ){
			$result = $this->modelObj->create();
			if ( !$result ){
				$this->error($this->modelObj->getError());
			}
			else {
				$uid = $this->modelObj->add();
				if ( $uid ){
					$userInfo = $this->modelObj->where('uid='.$uid)->find();
					$username = $userInfo['username'];
					$this->_setLoginCookie($uid, $username);
					$this->success('恭喜你!加入成功',U('Index/index'));
				}
				else{
					$this->error('系统错误');
				}
			}
		}
		else{
			$this->display('User:join');
		}
	}
	
	public function login(){
		C('TOKEN_ON',true);
		//dump(C('LAYOUT_NAME'));exit;
		if ( $this->isLogin() ){
			$this->redirect(U('Index/index'));
		}
		if ( IS_POST ){
			$password = I('password');
			$email = I('email');
			$check = $this->_checkUserData($email, $password);
			if ( $check['status'] ){
				$uid = $check['user']['uid'];
				$username = $check['user']['username'];
				$this->_setLoginCookie($uid, $username);
				$this->success('登录成功',U('Index/index'));
			}
			else {
				$this->error($check['msg']);
			}
		}
		else{
			$this->display('User:login');
		}
	}
	
	public function qqLogin(){
		//应用的APPID
		$app_id = "100485793";
		
		//应用的APPKEY
		$app_secret = "4eaa5bfa453de61ea0ba8d601ba5b5a9";
		
		//成功授权后的回调地址
		$my_url = C('HOST_URL').U('Home/Index/qqLogin');
		
		
		//Step1：获取Authorization Code
		session_start();
		$code = $_REQUEST["code"];
		
		if(empty($code))
		{
			//state参数用于防止CSRF攻击，成功授权后回调时会原样带回
			$_SESSION['state'] = md5(uniqid(rand(), TRUE));
			//拼接URL
			$dialog_url = "https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id="
			. $app_id . "&redirect_uri=" . urlencode($my_url) . "&state="
			. $_SESSION['state'];
		
			echo("<script> top.location.href='" . $dialog_url . "'</script>");
		}
		
		//Step2：通过Authorization Code获取Access Token
		if($_REQUEST['state'] == $_SESSION['state'])
		{
			//拼接URL
			$token_url = "https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&"
			. "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url)
			. "&client_secret=" . $app_secret . "&code=" . $code;
			
			$response = file_get_contents($token_url);
			if (strpos($response, "callback") !== false)
			{
				$lpos = strpos($response, "(");
				$rpos = strrpos($response, ")");
				$response  = substr($response, $lpos + 1, $rpos - $lpos -1);
				$msg = json_decode($response);
				if (isset($msg->error))
				{
					echo "<h3>error:</h3>" . $msg->error;
					echo "<h3>msg  :</h3>" . $msg->error_description;
					exit;
				}
			}
			//Step3：使用Access Token来获取用户的OpenID
			$params = array();
			parse_str($response, $params);
			
			$graph_url = "https://graph.qq.com/oauth2.0/me?access_token="
				.$params['access_token'];
		
			$str  = file_get_contents($graph_url);
			if (strpos($str, "callback") !== false)
			{
				$lpos = strpos($str, "(");
				$rpos = strrpos($str, ")");
				$str  = substr($str, $lpos + 1, $rpos - $lpos -1);
			}
			$user = json_decode($str);
			if (isset($user->error))
			{
				echo "<h3>error:</h3>" . $user->error;
				echo "<h3>msg  :</h3>" . $user->error_description;
				exit;
			}
			$access_url = "https://graph.qq.com/user/get_user_info?access_token=".$params['access_token']."&oauth_consumer_key=".$app_id."&openid=".$user->openid;
			$userinfo = file_get_contents($access_url);
			$info = json_decode($userinfo);
			
			$virtual_email = $user->openid.'@qq.com';
			$newuser = array(
					'username'=>$info->nickname,
					'password'=>md5(rand(100000,999999)),
					'email'=>$virtual_email
					);
			$userdata = $this->modelObj->where("email='$virtual_email'")->find();
			if ( !$userdata ){
				$uid = $this->modelObj->add($newuser);
			}
			else{
				$uid = $userdata['uid'];
			}
			$this->_setLoginCookie($uid, $info->nickname);
			$this->success('登录成功',U('Index/index'));
		}
		else
		{
			echo("The state does not match. You may be a victim of CSRF.");
		}
		
	}
	
	public function logout(){
		cookie('uid',null);
		cookie('username',null);
		cookie(null);
		$this->success('退出成功!',U('Index/login'));
	}
	
	private function _checkUserData($email, $password){
		$status = true;
		$msg = '';
		$where = array('email'=>$email);
		$user = $this->modelObj->where($where)->find();
		$encode_func = C('PASS_ENCODE_FUNC');
		$password = $encode_func($password);
		
		if ( !$user ){
			$status = false;
			$msg = '邮箱未注册';
		}
		elseif ($user['password'] != $password ){
			$status = false;
			$msg = '密码不正确';
		}
		else{
			
		}
		return array( 'status'=>$status, 'msg'=>$msg, 'user'=>$user );
	}
	
	private function _setLoginCookie($uid,$username){
		session('uid',$uid);
		session('username',$username);
		cookie('uid',$uid);
		cookie('username',$username);
	}
}