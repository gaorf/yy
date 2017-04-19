<?php
namespace Common\Tag;
use Think\Template\TagLib;
class MyHtml extends TagLib{
    protected $tags = array(
        'ueditor'=>array('attr'=>'name,id,value','close'=>0),
        'webupload' => array('attr'=>'type,url,param','close'=>0)
    );
    
    public function _ueditor($tag){
        $name = $tag['name'];
        $id = $tag['id'];
        $value = $tag['value'];
        $str = <<<UEDITOR
<script id="$id" name="$name" type="text/plain">$value</script>
<script>
    var ue = UE.getEditor('$id');    
</script>
UEDITOR;
        return $str;
    }
    
    public function _webupload($tag){
        $type = isset($tag['type'])?$tag['type']:1;
        $url = isset($tag['url'])?$tag['url']:U('Upload/ajax_upload');
        $param = isset($tag['param'])?json_encode(explode('&', $tag['param'])):'';
        $str = '';
        switch($type){
            case 1:
               $str .=<<<WEB
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
                	var \$list = $('#thelist'),\$btn = $('#ctlBtn');
                	var uploader = WebUploader.create({
                        swf: '__STATICS__lib/webuploader/0.1.5/Uploader.swf',
                        server: '{$url}',
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
                        formData:'{$param}'
                    });
                    //当文件被加入队列以后触发。
                    uploader.on("fileQueued",function(file){
                    	//console.log(file);
                    	//\$list.append('<div class="item bg-primary" style="padding:10px;margin:0 0 10px;" id="'+file.id+'"><button type="button" class="close"><span>&times;</span></button><span class="info">'+file.name+'</span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="state">等待上传...</span></div>');
                        var \$li = $(
                			'<div id="' + file.id + '" class="item">' +
                				'<div class="pic-box"><img></div>'+
                				'<div class="info">' + file.name + '</div>' +
                				'<p class="state">等待上传...</p>'+
                			'</div>'
                		),
                		\$img = \$li.find('img');
                		\$list.append( \$li );
                	
                		// 创建缩略图
                		// 如果为非图片文件，可以不用调用此方法。
                		// thumbnailWidth x thumbnailHeight 为 100 x 100
                		uploader.makeThumb( file, function( error, src ) {
                			if ( error ) {
                				\$img.replaceWith('<span>不能预览</span>');
                				return;
                			}
                	
                			\$img.attr( 'src', src );
                		}, thumbnailWidth, thumbnailHeight );
                    });
                    //取消上传某个项目
                    \$list.on("click",".close",function(){
                    	var item = $(this).parent(".item");
                    	var id = item.attr("id");
                    	uploader.removeFile( id );
                    	item.remove();
                    });
                    //点击开始上传
                    \$btn.on("click",function(){
                    	uploader.upload();
                        return false;
                    });
                    // 文件上传过程中创建进度条实时显示。
                    uploader.on( 'uploadProgress', function( file, percentage ) {
                        var \$li = $( '#'+file.id ),
                            \$percent = \$li.find('.progress .progress-bar');
                    
                        // 避免重复创建
                        if ( !\$percent.length ) {
                            \$percent = $('<div class="progress progress-striped active">' +
                              '<div class="progress-bar" role="progressbar" style="width: 0%">' +
                              '</div>' +
                            '</div>').appendTo( \$li ).find('.progress-bar');
                        }
                    
                        \$li.find('.state').text('上传中...');
                        \$percent.css( 'width', percentage * 100 + '%' );
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
WEB;
            break;
        }
        return $str;
    }
    
}