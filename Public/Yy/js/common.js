/**
 * 
 */
function layer_popup(title,url){
	var index= layer.open({
		type:2,
		title:title,
		content:url
	});
	layer.full(index);
}

function layer_del(obj,msg="确认要执行此操作吗？"){
	var url = $(obj).attr('href');
	layer.confirm(msg,function(index){
		location.href=url;
	})
	return false;
}