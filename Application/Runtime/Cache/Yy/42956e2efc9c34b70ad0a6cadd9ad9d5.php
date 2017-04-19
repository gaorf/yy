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
	<form action="<?php echo U('writeCompany');?>" method="post" class="form form-horizontal validate" id="form-article-add">
		<input type="hidden" name="id" value='<?php echo ($row["id"]); ?>'/>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>企业名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo ($row["company_name"]); ?>" name="company_name" placeholder="" id="" required >
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>地址：</label>
			<div class="formControls col-xs-8 col-sm-9 distpicker link-select">
				  <span class="select-box"><select class="select" name="province" required></select></span>
				  <span class="select-box"><select class="select" name="city" required></select></span>
				  <span class="select-box"><select class="select" name="district" required></select></span>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">企业简介：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea name="company_desc" id="" class="textarea" cols="30" rows="10"><?php echo ($row["company_desc"]); ?></textarea>
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
});
</script>

</body>
</html>