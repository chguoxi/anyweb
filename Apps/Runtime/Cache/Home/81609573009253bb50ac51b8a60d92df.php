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
                    <a href="<?php echo U('Index/index');?>">我的收藏</a>
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

 <div class="container">
	
		<form  method="post" action="<?php echo U('Home/Collect/edit',array('id'=>$data['id']));?>" id="saveCollect">
		
		<div class="form-group"i>
		<label  for="inputEmail">分类</label>		
		<div class="input-group">
		
			<select name="cateid" class="form-control">
				<?php if(is_array($cates)): $i = 0; $__LIST__ = $cates;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i; if(($data["cateid"]) == $cate['cateid']): ?><option value="<?php echo ($cate["cateid"]); ?>" selected="selected" ><?php echo ($cate["catename"]); ?></option>
					<?php else: ?>
						<option value="<?php echo ($cate["cateid"]); ?>"><?php echo ($cate["catename"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			</select>
                       <div class="input-group-addon" id="dg"><i class="glyphicon glyphicon-plus"></i></div>
                </div>
		</div>
	
				
		

		<div class="form-group">
			<label class="control-label" for="inputEmail">标识名</label>
			
			<input type="text" class="form-control" name="name" value="<?php echo ($data["name"]); ?>" id="inputEmail" placeholder="自定义一个标识名" >
			
		</div>
		<div class="form-group">
			<label class="control-label" for="inputPassword">网址</label>
			
			<input type="text" class="form-control" name="value" value="<?php echo ($data["value"]); ?>" id="inputPassword" placeholder="填写您需要收藏的网址">
			
		</div>
		<div class="form-group">
			
			<button type="button" class="btn btn-primary" id="save" onclick="javascript:formsubmit('#saveCollect')">保存</button>
				
			
		</div>
	</form>
	

</div>

<hr>


<div id="cateform" >
<form action="{:U('Home/Cate/edit')}" class="form-inline" method="post" id="addForm">
	<label>类别名称:</label>
	<input type="text" name="catename" value="" placeholder="类别名称" id="catename" />
	<button type="button" class="btn" id="save" onclick="javascript:formsubmit('#addForm')">添加</button>
</form>
</div>
<script>
$(function(){
	var content = jQuery("#cateform").html();
    $('#dg').dialog({
    	title:'添加类别',
    	content:content
    	});
});  
</script>

<div class="container">
	<div class="footer">
		<p>&copy; HOLDMYLOVE.COM 2012-<?php echo date('Y');?></p>
	</div>
</div>
	<!-- /container -->
	<script src="//cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  </body>
</html>