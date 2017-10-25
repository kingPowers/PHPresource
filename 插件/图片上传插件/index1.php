<?php var_dump($_FILES);?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>上传图片插件</title>

<link href="css/common.css" type="text/css" rel="stylesheet"/>
<link href="css/index.css" type="text/css" rel="stylesheet"/>

</head>
<body>
<form action="./index.php" method="post" enctype="multipart/form-data">
<div class="img-box full">
	<section class=" img-section">
		<p class="up-p">作品图片：<span class="up-span">最多可以上传5张图片，马上上传</span></p>
		<div class="z_photo upimg-div clear" >
			   
				 <section class="z_file fl">
					<img src="img/a11.png" class="add-img">
					<input type="file" name="file" id="file"  class="file" value="" accept="image/jpg,image/jpeg,image/png,image/bmp" multiple />
				 </section>
		 </div>
	 </section>
</div>
</form>
<aside class="mask works-mask">
	<div class="mask-content">
		<p class="del-p ">您确定要删除作品图片吗？</p>
		<p class="check-p"><span class="del-com wsdel-ok">确定</span><span class="wsdel-no">取消</span></p>
	</div>
</aside>

<script src="js/jquery.js"></script>
<!--<script src="js/imgUp.js"></script>-->
<script src="js/imgPlugin.js"></script>
<script type="text/javascript">
$(function(){
	var value = $("input[name='file']").attr("addid");
$("#file").takungaeImgup({
      formData: {
          "path": "./images",
          "name": ''
      },
      url:"./upload.php",
      success: function(data) {
      	alert(1);
      },
      error: function(err) {
          alert(err);
      }
});
})
</script>
</body>
</html>
