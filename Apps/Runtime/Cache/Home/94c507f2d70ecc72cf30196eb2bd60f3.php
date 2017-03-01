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
            <a class="navbar-brand" href="#">添加 &nbsp;<i class="glyphicon glyphicon-plus"></i></a>
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

 <div class="container">
	

	<?php if(is_array($collects)): $i = 0; $__LIST__ = $collects;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$collect): $mod = ($i % 2 );++$i;?><div class="cate-section">
	<div class="catelist">
	        <h1 class="page-header">
	            <a class="catename"><?php echo ($collect["catename"]); ?></a>
	            <!-- 
		        <a  href="<?php echo U('Home/Collect/edit');?>" >
		        	<span class="glyphicon glyphicon-plus"></span>
		        </a>	            
	             -->
	            
	        </h1>
	</div>	
	<?php if(empty($collect['data'])): ?><div class="row">
			<p class="text-warning">该类别下暂无连接</p>
		</div><?php endif; ?>
	<?php if(!empty($collect['data'])): ?><div class="row">
		<?php if(is_array($collect[data])): $ckey = 0; $__LIST__ = $collect[data];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$col): $mod = ($ckey % 2 );++$ckey;?><div class="col-md-2 col-sm-3 col-xs-6 portfolio-item">
				
					<div class="img-holder">
						<h3><a href="<?php echo ($col["value"]); ?>" target="_blank"><?php echo mb_substr($col[name],0,15,"utf-8");?></a></h3>
					</div>					
				
	        </div><?php endforeach; endif; else: echo "" ;endif; ?>
		</div><?php endif; ?>
	</div><?php endforeach; endif; else: echo "" ;endif; ?>

</div>
<script>
$(function() {
		jQuery('li').hover(function(){
			$(this).find(".oprate").show();
		},function(){
			$(this).find(".oprate").hide();
		})
});

function show_editcate_form(id){
	var htmlobj=$.ajax({
		url:"{:U('Home/Cate/edit')}"+"&id="+id,
		async:false
		});
	var content = htmlobj.responseText ;
	jQuery.dialog({
		title : '修改',
		content : content
	});
}
jQuery('.tips').hover(function(){
	$(this).tooltip('show');
},function(){
	$(this).tooltip('hide');
})


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