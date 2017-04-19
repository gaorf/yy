<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />

<link rel="stylesheet" type="text/css" href="/yy/Public/Statics/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/yy/Public/Yy/hui/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/yy/Public/Statics/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/yy/Public/Yy/hui/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/yy/Public/Yy/hui/css/style.css" />
<link rel="stylesheet" type="text/css" href="/yy/Public/Yy/css/common.css" />

<title>后台</title>

</head>
<body>
<?php if(!$show_nav): ?><nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 图片管理 <span class="c-gray en">&gt;</span> 图片列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<?php else: ?>
<nav class="breadcrumb"><?php echo ((isset($header_title) && ($header_title !== ""))?($header_title):"操作"); ?></nav><?php endif; ?>

<div class="page-container">
	<form action="<?php echo U('writeBrand');?>" method="post" class="form form-horizontal validate" id="form-article-add">
		<input type="hidden" name="id" value='<?php echo ($row["id"]); ?>'/>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>品牌名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo ($row["brand_name"]); ?>" name="brand_name" placeholder="" id="" required >
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>所属企业：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text company-name" style="width:25%" value="<?php echo ($row["company_name"]); ?>" readonly name="company_name" required >
				<input type="hidden" class="input-text company-id" style="width:5%" value="<?php echo ($row["company_id"]); ?>" readonly name="company_id" required >
				<a href="###" class="btn btn-primary select-company">选择企业</a>
				<div class="company-show mt-20  hide">
					<input type="text" class="input-text" style="width:25%" onkeyup="search(this);" placeholder="检索企业"/>
					<div class="company-list mt-10">
						<?php if(is_array($Company_list)): $i = 0; $__LIST__ = $Company_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="###" class="btn btn-link check-company" data-id="<?php echo ($vo["id"]); ?>"><?php echo ($vo["company_name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
				</div>
			</div>	
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">品牌简介：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea name="brand_desc" id="" class="textarea" cols="30" rows="10"><?php echo ($row["brand_desc"]); ?></textarea>
			</div>
		</div>
		<div class="row cl skin-minimal">
			<label class="form-label col-xs-4 col-sm-2">状态：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<div class="switch" data-on="success" data-off="warning" data-animated="false" data-on-label="是" data-off-label="否">
				    <input type="checkbox" name="status" <?php if(!isset($row['status']) OR $row['status'] == 1): ?>checked<?php endif; ?> value="1" />
				</div>
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 提交</button>
			</div>
		</div>
	</form>
</div>	


<script type="text/javascript" src="/yy/Public/Statics/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/yy/Public/Statics/lib/layer/3.0.3/layer.js"></script>
<script type="text/javascript" src="/yy/Public/Statics/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/yy/Public/Yy/hui/js/H-ui.admin.js"></script>
<script type="text/javascript" src="/yy/Public/Statics/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="/yy/Public/Statics/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/yy/Public/Statics/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript" src="/yy/Public/Yy/js/common.js"></script>


<script src="/yy/Public/Statics/distpicker/distpicker.data.js"></script>
<script src="/yy/Public/Statics/distpicker/distpicker.js"></script>
<script>
$(function(){
	$(".distpicker").distpicker({
		province: "<?php echo ($row["province"]); ?>",
		city: "<?php echo ($row["city"]); ?>",
		district: "<?php echo ($row["district"]); ?>",
	});
	$(".validate").validate();
	
	$(".check-company").click(function(){
		var companyId = $(this).data('id');
		var companyName = $(this).text();
		$(".company-id").val(companyId);
		$(".company-name").val(companyName);
		return false;
	});
	
	$(".select-company").click(function(){
		if($(".company-show").css("display")=='block'){
			$(".company-show").hide();
		}else{
			$(".company-show").show();
		}
	});
	
});

function search(obj){
	var box = $(".company-list");
	var key = $(obj).val();
	$(".company-list a").hide();
	$(".company-list a:contains("+key+")").show();
	
	
}

</script>

</body>
</html>