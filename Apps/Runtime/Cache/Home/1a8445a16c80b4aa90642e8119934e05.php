<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta property="qc:admins" content="1513211767607445147656375" />
    <title><?php echo (C("APP_NAME")); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" type="text/css" href="//cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/Public/Css/default.css" />
	<script src="//cdn.bootcss.com/jquery/2.2.0/jquery.min.js"></script>	
	<script src="//cdn.bootcss.com/layer/3.0.1/layer.min.js"></script>	


	<script type="text/javascript" src="/Public/lhgdialog/lhgdialog.min.js"></script><script type="text/javascript" src="/Public/Js/common.js"></script>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
        <script src="//cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><?php echo (APP_NAME); ?></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="<?php echo U('Home/Index/index');?>">我的收藏</a>
                </li>

            </ul>

			<ul class="nav navbar-nav navbar-right">
				<li><a href="#">Link</a></li>
				<li class="dropdown"><a href="#" class="dropdown-toggle"
					data-toggle="dropdown" role="button" aria-haspopup="true"
					aria-expanded="false"><?php echo ((isset($username) && ($username !== ""))?($username):'未登录'); ?> <span class="caret"></span></a>
					<?php if($uid > 0): ?><ul class="dropdown-menu">
						<li><a href="<?php echo U('Index/logout');?>">退出</a></li>
					</ul><?php endif; ?>
				</li>
			</ul>

			</div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

 <style>
.form-container{
	margin-top:5rem;
	margin-bottome:5rem;
}
</style>

<div class="container form-container">
	<ul class="nav nav-tabs">
		<li class="active"><a href="javascript:void(0);">登录</a></li>
		<li><a href="<?php echo U('Home/Index/join');?>">注册</a></li>
	</ul>
	<form method="post" action="<?php echo U('Home/Index/login');?>" id="loginForm">
	<div class="form-group">
		<label for="inputEmail">邮箱</label>
		
		<input type="text" name="email" class="form-control" id="inputEmail" placeholder="Email">
		
	</div>
	<div class="form-group">
		<label for="inputPassword">密码</label>
		<input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
	</div>
	<div class="form-group">
		<button type="button" class="btn" onclick="javascript:formsubmit('#loginForm')">登录</button>
	</div>
	<div class="form-group">
	<label>用其他账号登录</label>
		<div class="controls"><a href="https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=100485793&redirect_uri=<?php echo urlencode(C('HOST_URL').U('Home/Index/qqLogin')); ?>"><img src="./Public/icon/qq_connect_logo_7.png" /></a></div>
	</div>
</form>
</div>


<div class="container">
	<div class="footer">
		<p>&copy; HOLDMYLOVE.COM 2012-<?php echo date('Y');?></p>
	</div>
</div>
	<!-- /container -->
	<script src="//cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  </body>
</html>