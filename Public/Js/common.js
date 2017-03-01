/**
 * 显示信息
 *
 */
function showinfo(tipmsg) {
	jQuery.dialog.tips(tipmsg,'2','32X32/i.png');
}

/**
 * 显示错误
 *
 */
function showerror(tipmsg) {
	jQuery.dialog.tips(tipmsg,'2','32X32/fail.png')
}

/**
 * 显示警告
 *
 */
function showwarning(tipmsg) {
	jQuery.dialog.tips(tipmsg,'2','32X32/hits.png')
}
/**
 * 显示成功
 *
 */
function showsuccess(tipmsg) {
	jQuery.dialog.tips(tipmsg,'2','32X32/succ.png')
}

/**
 * 表单提交 
 * 异步提交
 *
 */
function formsubmit(obj,urls,vali){
	if(vali == 1 && !jQuery(obj).valid()){
		return false;
	}
	if(urls == '' || urls == 'undefined' || urls == null) {
		if(jQuery(obj).attr('action')) {
			urls = jQuery(obj).attr('action');
		} else {
			urls = window.location.href ;
		}
	}
	
	jQuery.ajax({
		url      : urls,
		data     : jQuery(obj).serialize(),
		type     : "POST",
		success  : function(data){
		if( data.status != 'undefined' && data.status != null && data.status == 1 ){
			layer.msg('<p><a><i class="layui-icon" style="font-size: 30px; color: #fff;">&#xe605;</i></a></p><p>'+data.info+'</p>');
			window.location.href = data.url;
		}else{
			layer.msg('<p><a><i class="layui-icon" style="font-size: 30px; color: #fff;">&#x1006;</i></a></p><p>'+data.info+'</p>');
			//location.reload();
		}
//			jQuery.dialog.tips(data.info,'2','32X32/i.png',function(){
//				if(data.data != '' && data.data != 'undefined' && data.data != null){
//					window.location.href = data.data;
//				}else{
//					location.reload();
//				}
//			});
		},
		dataType : "json"
	});
	return false;
}
$(document).ready(function(){
	//自动编辑状态
	$('input[ctype="edit"],a[ctype="edit"]').click(function(){
		var url = $(this).attr('acturl');
		var container = $(this).attr('container');
		var content = $('#'+container).html();
		$.ajax({
			url:url,
			type:'get',
			data:'',
			success:function(data){
				$('#'+container).html(data);
				$('#'+container+' input[name="cancle"]').click(function(){
					$('#'+container).html(content);
				});
			}
		});
	});
	//自动删除信息
	$('input[ctype="drop"],a[ctype="drop"]').click(function(){
		var url = $(this).attr('acturl');
		var rmElement = $(this).attr('rmElement');
		jQuery.dialog({
			title   : '请确认',
			content : '你确定要删除本条信息！',
			okVal   : '确定',
			cancelVal : '取消',
			ok      : function(){
				$.ajax({
					url:url,
					type:'get',
					dataType:'json',
					success:function(data){
						if(data.status == 1) {
							showsuccess(data.info);
							$("#"+rmElement).remove();
//							var m = setTimeout('window.location.reload()',3000);
						} else {
							showerror(data.info);
						}
					}
				});
			},
			cancel  : function(){
				return true ;
			}
		});
	});
	//自动编辑状态
	$('a[ctype="ajaxmod"]').click(function(){
		var url = $(this).attr('acturl');
		$.ajax({
			url:url,
			type:'get',
			data:'',
			dataType:'json',
			success:function(data){
				if(data.status == 1) {
					showsuccess(data.info);
					var m = setTimeout('window.location.reload()',3000);
				} else {
					showerror(data.info);
				}
			}
		});
	});

});