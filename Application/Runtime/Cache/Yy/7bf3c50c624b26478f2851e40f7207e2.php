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
	<div class="cl pd-5 bg-1">
		<span class="l">
			<a class="btn btn-primary radius" href="<?php echo U('Category/addCategory');?>"><i class="Hui-iconfont">&#xe600;</i> 添加分类</a>
		</span> <span class="r"></span>
	</div>
	<div class="mt-20">
		<form name="myform" action="<?php echo U('Category/listorder');?>" method="post" class="form">
			<table class="table table-border table-striped table-hover">
				<tr class="active text-c">
					<th width="80">排序</th>
					<th width="100">id</th>
					<th>名称</th>
					<th width="80">菜单显示</th>
					<th width="80">状态</th>
					<th width="180">管理</th>
				</tr>
				<?php echo ($select_category); ?>
			</table>
			<div class="row cl">
				<div class="col-xs-8 col-sm-9">
					<button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe667;</i> 排序</button>
				</div>
			</div>
		</form>
	</div>
</div>


<script type="text/javascript" src="/yy/Public/Statics/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/yy/Public/Statics/lib/layer/3.0.3/layer.js"></script>
<script type="text/javascript" src="/yy/Public/Statics/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/yy/Public/Yy/hui/js/H-ui.admin.js"></script>
<script type="text/javascript" src="/yy/Public/Statics/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="/yy/Public/Statics/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/yy/Public/Statics/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript" src="/yy/Public/Yy/js/common.js"></script>


</body>
</html>