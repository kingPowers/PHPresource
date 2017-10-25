<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="jquery.min.js"></script>
	<script type="text/javascript" src="webuploader.min.js"></script><!--引用插件-->
</head>
<body>
<div id="uploadimg"> 
    <div id="fileList" class="uploader-list"></div> 
    <div id="imgPicker">选择图片</div> 
</div>
</body>
</html>
<script type="text/javascript">
var uploader = WebUploader.create({ 
    auto: true, // 选完文件后，是否自动上传 
    swf: 'js/Uploader.swf', // swf文件路径 
    server: 'upload.php', // 文件接收服务端 
    pick: '#imgPicker', // 选择文件的按钮。可选 
    // 只允许选择图片文件。 
    accept: { 
        title: 'Images', 
        extensions: 'gif,jpg,jpeg,bmp,png', 
        mimeTypes: 'image/*' 
    } 
});
//接着监听fileQueued事件，即当有文件添加进来的时候，通过uploader.makeThumb来创建图片预览图。
uploader.on( 'fileQueued', function( file ) { 
    var $list = $("#fileList"), 
        $li = $( 
            '<div id="' + file.id + '" class="file-item thumbnail">' + 
                '<img>' + 
                '<div class="info">' + file.name + '</div>' + 
            '</div>' 
            ), 
        $img = $li.find('img'); 
 
 
    // $list为容器jQuery实例 
    $list.append( $li ); 
 
    // 创建缩略图 
    uploader.makeThumb( file, function( error, src ) { 
        if ( error ) { 
            $img.replaceWith('<span>不能预览</span>'); 
            return; 
        } 
 
        $img.attr( 'src', src ); 
    }, 100, 100 ); //100x100为缩略图尺寸 
});
//最后是上传状态提示了，当文件上传过程中, 上传成功，上传失败，上传完成都分别对应uploadProgress, uploadSuccess, uploadError, uploadComplete事件。
// 文件上传过程中创建进度条实时显示。 
uploader.on( 'uploadProgress', function( file, percentage ) { 
    var $li = $( '#'+file.id ), 
        $percent = $li.find('.progress span'); 
 
    // 避免重复创建 
    if ( !$percent.length ) { 
        $percent = $('<p class="progress"><span></span></p>') 
                .appendTo( $li ) 
                .find('span'); 
    } 
 
    $percent.css( 'width', percentage * 100 + '%' ); 
}); 
 
// 文件上传成功，给item添加成功class, 用样式标记上传成功。 
uploader.on( 'uploadSuccess', function( file, res ) { 
    console.log(res.filePath);//这里可以得到上传后的文件路径 
    $( '#'+file.id ).addClass('upload-state-done'); 
}); 
 
// 文件上传失败，显示上传出错。 
uploader.on( 'uploadError', function( file ) { 
    var $li = $( '#'+file.id ), 
        $error = $li.find('div.error'); 
 
    // 避免重复创建 
    if ( !$error.length ) { 
        $error = $('<div class="error"></div>').appendTo( $li ); 
    } 
 
    $error.text('上传失败'); 
}); 
 
// 完成上传完了，成功或者失败，先删除进度条。 
uploader.on( 'uploadComplete', function( file ) { 
    $( '#'+file.id ).find('.progress').remove(); 
});
</script>