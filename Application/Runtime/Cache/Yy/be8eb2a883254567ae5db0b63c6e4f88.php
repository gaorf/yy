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
<script type="text/javascript" src="/yy/Public/Statics/lib/jquery/1.9.1/jquery.min.js"></script> 
<title>后台</title>

<script src="/yy/Public/Statics/lib/ueditor/1.4.3/ueditor.config.js" ></script>
<script src="/yy/Public/Statics/lib/ueditor/1.4.3/ueditor.all.js" ></script>
<link href="/yy/Public/Statics/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/yy/Public/Statics/lib/webuploader/0.1.5/webuploader.min.js"></script> 

</head>
<body>
<?php if(!$show_nav): ?><nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 图片管理 <span class="c-gray en">&gt;</span> 图片列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<?php else: ?>
<nav class="breadcrumb"><?php echo ((isset($header_title) && ($header_title !== ""))?($header_title):"操作"); ?></nav><?php endif; ?>

<div class="page-container">
	<form action="<?php echo U('addGoods');?>" method="post" class="form form-horizontal validate" id="form-article-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>产品名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" name="goods_name" placeholder="" id="" required >
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>生产企业：</label>
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
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>品牌：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text brand-name" style="width:25%" value="" readonly name="brand_name" required >
				<input type="hidden" class="input-text brand-id" style="width:5%" value="" readonly name="brand_id" required >
				<div class="brand-list mt-10 hide"></div>
			</div>	
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分类：</label>
			<div class="formControls col-xs-8 col-sm-9 link-select">
				<span class="select-box"><select class="select one" name="category_id_1"  onChange="getLinkCategory(this.value,0,'two')" required><option value="">--请选择--</option></select></span>
				<span class="select-box"><select class="select two" name="category_id_2" onChange="getLinkCategory(this.value,0,'three')" required><option value="">--请选择--</option></select></span>
				<span class="select-box"><select class="select three" name="category_id_3" required><option value="">--请选择--</option></select></span>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>批准文号：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" style="width:25%" class="input-text" value="" name="goods_approval" required />
				<span class="c-999"></span>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red"></span>库存：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" style="width:25%" class="input-text" value="" name="goods_number" number="true" />
				<span class="c-999">不填写为无限量供货</span>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>市场价：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" style="width:25%" class="input-text" value="" name="market_price"  required />
				<span class="c-999"></span>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>本店价：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" style="width:25%" class="input-text" value="" name="shop_price" required />
				<span class="c-999"></span>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品规格：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" style="width:25%" class="input-text" value="" name="goods_spec" required />
				<span class="c-999"></span>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>剂型：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" style="width:25%" class="input-text" value="" name="goods_pre" required />
				<span class="c-999"></span>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>件装数量：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" style="width:25%" class="input-text" value="" name="big_number" required />
				<span class="c-999"></span>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>中装数量：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" style="width:25%" class="input-text" value="" name="middle_number" required />
				<span class="c-999"></span>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">主图：</label>
			<div class="formControls col-xs-8 col-sm-9">
				               <div class="uploader-thum-container">
					<div id="thelist" class="uploader-list"></div>
					<div id="picker">选择图片</div>
					<button id="ctlBtn" class="btn btn-default btn-uploadstar radius ml-10">开始上传</button>
				</div>
                <script>
                $(function(){
                     // 优化retina, 在retina下这个值是2
                    var ratio = window.devicePixelRatio || 1;
        
                    // 缩略图大小
                    var thumbnailWidth = 110 * ratio;
                    var thumbnailHeight = 110 * ratio;
                	var $list = $('#thelist'),$btn = $('#ctlBtn');
                	var uploader = WebUploader.create({
                        swf: '/yy/Public/Statics/lib/webuploader/0.1.5/Uploader.swf',
                        server: '/yy/index.php/Upload/ajax_upload.html',
                        pick: {
                        	id:'#picker', //指定选择文件的按钮容器
                        	label:'',
                        	innerHTML:'',
                        	multiple:false //是否开启多个文件
                        },
                        //chunked: true, //是否要分片处理大文件上传
                        //chunkSize:2*1024*1024 //分片上传，每片2M，默认是5M
                        auto: false, //选择文件后是否自动上传
                        //chunkRetry : 2, //如果某个分片由于网络问题出错，允许自动重传次数
                        runtimeOrder: 'flash',
                        formData:''
                    });
                    //当文件被加入队列以后触发。
                    uploader.on("fileQueued",function(file){
                    	//console.log(file);
                    	//$list.append('<div class="item bg-primary" style="padding:10px;margin:0 0 10px;" id="'+file.id+'"><button type="button" class="close"><span>&times;</span></button><span class="info">'+file.name+'</span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="state">等待上传...</span></div>');
                        var $li = $(
                			'<div id="' + file.id + '" class="item">' +
                				'<div class="pic-box"><img></div>'+
                				'<div class="info">' + file.name + '</div>' +
                				'<p class="state">等待上传...</p>'+
                			'</div>'
                		),
                		$img = $li.find('img');
                		$list.append( $li );
                	
                		// 创建缩略图
                		// 如果为非图片文件，可以不用调用此方法。
                		// thumbnailWidth x thumbnailHeight 为 100 x 100
                		uploader.makeThumb( file, function( error, src ) {
                			if ( error ) {
                				$img.replaceWith('<span>不能预览</span>');
                				return;
                			}
                	
                			$img.attr( 'src', src );
                		}, thumbnailWidth, thumbnailHeight );
                    });
                    //取消上传某个项目
                    $list.on("click",".close",function(){
                    	var item = $(this).parent(".item");
                    	var id = item.attr("id");
                    	uploader.removeFile( id );
                    	item.remove();
                    });
                    //点击开始上传
                    $btn.on("click",function(){
                    	uploader.upload();
                        return false;
                    });
                    // 文件上传过程中创建进度条实时显示。
                    uploader.on( 'uploadProgress', function( file, percentage ) {
                        var $li = $( '#'+file.id ),
                            $percent = $li.find('.progress .progress-bar');
                    
                        // 避免重复创建
                        if ( !$percent.length ) {
                            $percent = $('<div class="progress progress-striped active">' +
                              '<div class="progress-bar" role="progressbar" style="width: 0%">' +
                              '</div>' +
                            '</div>').appendTo( $li ).find('.progress-bar');
                        }
                    
                        $li.find('.state').text('上传中...');
                        $percent.css( 'width', percentage * 100 + '%' );
                    });
                    uploader.on( 'uploadAccept',function(object ,ret){
                        if(ret.status==0){
                            return false;
                        }else{
                            return true;
                        }
                    }); 
                    //文件上传成功
                    uploader.on( 'uploadSuccess', function( file ,response ) {
                        console.log(response);
                        $( '#'+file.id ).find('.state').text('已上传');
                        if(response.status==3){
                            addtext(response.info); 
                        }
                    });
                    // 文件上传失败，显示上传出错
                    uploader.on( 'uploadError', function( file ,reason ) {
                        $( '#'+file.id ).find('.state').text(reason.info);
                    });
                    // 完成上传完
                    uploader.on( 'uploadComplete', function( file ) { 
                        setTimeout(
                            function(){ 
                                $('#'+file.id).fadeOut(); 
                            },
                            1000);
                    });
                });   
                </script>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">商品详情：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<script id="goods_detail" name="goods_detail" type="text/plain"></script>
<script>
    var ue = UE.getEditor('goods_detail');    
</script>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">药用说明书：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<script id="goods_specification" name="goods_specification" type="text/plain"></script>
<script>
    var ue = UE.getEditor('goods_specification');    
</script>
			</div>
		</div>
		<div class="row cl skin-minimal">
			<label class="form-label col-xs-4 col-sm-2">热销：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<div class="switch" data-on="success" data-off="warning" data-animated="false" data-on-label="是" data-off-label="否">
				    <input type="checkbox" name="is_hot" <?php if(!isset($row['is_hot']) OR $row['is_hot'] == 1): ?>checked<?php endif; ?> value="1" />
				</div>
			</div>
		</div>
		<div class="row cl skin-minimal">
			<label class="form-label col-xs-4 col-sm-2">新品：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<div class="switch" data-on="success" data-off="warning" data-animated="false" data-on-label="是" data-off-label="否">
				    <input type="checkbox" name="is_new" <?php if(!isset($row['is_new']) OR $row['is_new'] == 1): ?>checked<?php endif; ?> value="1" />
				</div>
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


<script type="text/javascript" src="/yy/Public/Statics/lib/layer/3.0.3/layer.js"></script>
<script type="text/javascript" src="/yy/Public/Statics/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/yy/Public/Yy/hui/js/H-ui.admin.js"></script>
<script type="text/javascript" src="/yy/Public/Statics/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="/yy/Public/Statics/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/yy/Public/Statics/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript" src="/yy/Public/Yy/js/common.js"></script>


<script>
$(function(){

	$(".validate").validate();
	
	$(".check-company").click(function(){
		var companyId = $(this).data('id');
		var companyName = $(this).text();
		var brandStr = '';
		$(".company-id").val(companyId);
		$(".company-name").val(companyName);
		
		$.get(
			'<?php echo U("Goods/getCompanyBrand");?>',
			{company_id:companyId},
			function(data){
				$.each(data,function(i,n){
					brandStr += '<a href="###" class="btn btn-link check-brand" data-id="'+n.id+'">'+n.brand_name+'</a>';
				})
				$(".brand-list").html(brandStr).show();
			},
			'json'
		);
		
		return false;
	});
	
	$(".brand-list").on('click','.check-brand',function(){
		var brandId = $(this).data('id');
		var brandName = $(this).text();
		$(".brand-id").val(brandId);
		$(".brand-name").val(brandName);
		return false;
	});
	
	
	$(".select-company").click(function(){
		if($(".company-show").css("display")=='block'){
			$(".company-show").hide();
			$(".brand-list").hide();
		}else{
			$(".company-show").show();
		}
	});
	
	getLinkCategory(0,0,'one');
});

function getLinkCategory(pid,sid,cla){
	$.get(
		'<?php echo U("Goods/getCategory");?>',
		{pid:pid,sid:sid},
		function(data){
			$("."+cla).html('');
			var str = '<option value="">--请选择--</option>';
			$(str+data).appendTo("."+cla);
		},
		'html'
	);	
}

function search(obj){
	var box = $(".company-list");
	var key = $(obj).val();
	$(".company-list a").hide();
	$(".company-list a:contains("+key+")").show();
	
	
}

</script>

</body>
</html>