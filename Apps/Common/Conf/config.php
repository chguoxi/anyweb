<?php
return array(
	'DB_TYPE'=>'mysql',
	'DB_HOST'=>'127.0.0.1',
	'DB_NAME'=>'anyweb',
	'DB_USER'=>'anyweb',
	'DB_PWD'=>'DSDfssdfsd555',
	'DB_PORT'=>'3306',
	'MODULE_ALLOW_LIST'=>array('Home','Admin'),
	'DEFAULT_MODULE' => 'Home',
	'APP_GROUP_LIST'=>'Admin,Home',
	'DEFAULT_GROUP'=>'Home',
 	'APP_STATUS' => 'debug',
	'SHOW_PAGE_TRACE' =>false,
	'DB_PREFIX' => 'any_',
	'PASS_KEY'=>'Wes23sd',
	'URL_MODEL'=>0,
	'PASS_ENCODE_FUNC'=>'encode_password',
	'APP_NAME'=>'网络收藏夹',
	'COOKIE_EXPIRE'=>3600*24*7,
	'HOST_URL'=>'http://www.holdmylove.com',
	'TMPL_L_DELIM'=>'<{',
	'TMPL_R_DELIM'=>'}>',
	'NO_LOGIN_LIST'=>array(
			'Home/Index/login',
			'Home/Index/logout',
			'Home/Index/join',
			'Home/Index/qqLogin'
	)
);
?>