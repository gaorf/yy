<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link href="/yy/Public/Statics/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="/yy/Public/Yy/hui/css/H-ui.login.css" rel="stylesheet" type="text/css" />
<link href="/yy/Public/Yy/hui/css/style.css" rel="stylesheet" type="text/css" />
<link href="/yy/Public/Statics/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />
<title>后台登录 </title>
<style>
.tips{
	height:28px;
	line-height:28px;
	color:#c33;
	font-size:16px;
}
</style>
<script>
if(window.top!=window){window.top.location.href=document.location.href;}
</script>
</head>
<body>
<div class="header"></div>
<div class="loginWraper">
  <div id="loginform" class="loginBox">
    <form class="form form-horizontal" action="<?php echo U('login');?>" method="post">
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
        <div class="formControls col-xs-8">
          <input id="" name="username" type="text" placeholder="账户" class="input-text size-L">
        </div>
      </div>
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
        <div class="formControls col-xs-8">
          <input id="" name="password" type="password" placeholder="密码" class="input-text size-L">
        </div>
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
          <input class="input-text size-L" name="verify" type="text" placeholder="验证码" style="width:150px;">
          <img src="<?php echo U('verify');?>" style="cursor:pointer;" class="verifyimg reloadverify"> <a id="kanbuq" href="javascript:;" class="reloadverify">看不清，换一张</a> </div>
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3 tips">
        <!-- 
          <label for="online">
            <input type="checkbox" name="online" id="online" value="">
            使我保持登录状态</label>
             -->
        </div>
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
          <input name="" type="submit" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
        </div>
      </div>
    </form>
  </div>
</div>
<div class="footer">Copyright</div>
<script type="text/javascript" src="/yy/Public/Statics/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/yy/Public/Statics/h-ui/js/H-ui.min.js"></script>
<script>
$(function(){
	$("form").submit(function(){
		var self = $(this);
		$.post(self.attr("action"), self.serialize(), success, "json");
		return false;

		function success(data){
			if(data.status){
				window.location.href = data.url;
			} else {
				self.find('.tips').text(data.info);
				//self.find(".check-tips").text(data.info);
				//console.log(data.info);
				//刷新验证码
				$(".reloadverify").click();
			}
		}
	});
	//刷新验证码
	var verifyimg = $(".verifyimg").attr("src");
    $(".reloadverify").click(function(){
        if( verifyimg.indexOf('?')>0){
            $(".verifyimg").attr("src", verifyimg+'&random='+Math.random());
        }else{
            $(".verifyimg").attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());
        }
    });
})
</script>
</body>
</html>