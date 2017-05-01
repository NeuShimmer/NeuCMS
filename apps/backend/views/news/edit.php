<?php
use common\YUrl;
require_once (APP_VIEW_PATH . DIRECTORY_SEPARATOR . 'common/header.php');
?>

<style type="text/css">
html {
	_overflow-y: scroll
}
</style>

<div class="pad_10">
	<form action="<?php echo YUrl::createBackendUrl('', 'News', 'edit'); ?>"
		method="post" name="myform" id="myform">
		<table cellpadding="2" cellspacing="1" class="table_form" width="100%">
			<tr>
				<th width="100">文章分类：</th>
				<td><select name="cat_id">
					<?php foreach ($news_cat_list as $cat): ?>
    					<option value="<?=$cat['cat_id']?>" <?php if ($cat['cat_id']==$detail['cat_id']) echo 'selected'; ?>><?=$cat['cat_name']?></option>
						<?php
						if (isset($cat['sub']) && is_array($cat['sub'])) {
							foreach ($cat['sub'] as $sub_cat) {
								echo '<option value="', $cat['cat_id'], '"';
								if ($sub_cat['cat_id']==$detail['cat_id']) {
									echo ' selected';
								}
								echo '>&nbsp;&nbsp;&nbsp;├─ ', $sub_cat['cat_name'], '</option>';
							}
						}
						?>
        			<?php endforeach; ?>
		</select></td>
			</tr>
			<tr>
				<th width="100">文章标题：</th>
				<td><input type="text" name="title" id="title" size="40"
					class="input-text"
					value="<?php echo htmlspecialchars($detail['title']) ?>">(不得超过100个字符)</td>
			</tr>
			<tr>
				<th width="100">文章编码：</th>
				<td><?=isset($frontend_url)?$frontend_url:''?>article/<input type="text"
					name="code" id="code" size="10" class="input-text"
					value="<?php echo $detail['code']; ?>">(自定义URL)</td>
			</tr>
			<tr>
				<th width="100">关键词：</th>
				<td><input type="text" name="keywords" id="keywords" size="40"
					class="input-text"
					value="<?php echo htmlspecialchars($detail['keywords']) ?>"></td>
			</tr>
			<tr>
				<th width="100">文章简介：</th>
				<td><textarea name="intro" id="intro" style="width: 90%;" rows="5" cols="50"><?php echo htmlspecialchars($detail['intro']) ?></textarea></td>
			</tr>
			<tr>
				<th width="100">来源：</th>
				<td><input type="text" name="source" id="source" size="20"
					class="input-text"
					value="<?php echo htmlspecialchars($detail['source']) ?>"></td>
			</tr>
			<tr>
				<th width="100">显示状态：</th>
				<td><select name="display">
						<option value="1">显示</option>
						<option value="0">隐藏</option>
				</select></td>
			</tr>
			<tr>
				<th width="100">文章主图：</th>
				<td><input type="hidden" name="image_url" id="input_voucher"
					value="<?php echo $detail['image_url'] ?>" />
					<div id="previewImage">
						<img width="120" height="120"
							src="<?php echo YUrl::filePath($detail['image_url']); ?>" />
					</div></td>
			</tr>
			<tr>
				<th width="100">文章内容：</th>
				<td><textarea name="content" id="editor_id" style="width: 90%;" rows="5" cols="50"><?php echo $detail['content']; ?></textarea></td>
			</tr>
			<tr>
				<td width="100%" align="center" colspan="2"><input type="hidden"
					name="news_id" value="<?php echo $detail['news_id']; ?>" /> <input
					id="form_submit" type="button" name="dosubmit" class="btn_submit"
					value=" 提交 " /></td>
			</tr>
		</table>

	</form>
</div>

<script type="text/javascript">
<!--

$(document).ready(function(){
	$('#form_submit').click(function(){
	    $.ajax({
	    	type: 'post',
            url: $('form').eq(0).attr('action'),
            dataType: 'json',
            data: $('form').eq(0).serialize(),
            success: function(data) {
                if (data.errcode == 0) {
                	alert('更新成功');
					window.location.reload();
                } else {
                	dialogTips(data.errmsg, 3);
                }
            }
	    });
	});

	/* 图片上传 */
	var previewImage = $('#previewImage');
	//previewImage.css({"width": "120px", "height": "120px", "border": "2px solid #CCD"});
	//previewImage.empty();
	//previewImage.append('<img src="<?php echo YUrl::assets('js', '/AjaxUploader/upload_default.png') ?>">');
    var uploader = new ss.SimpleUpload({
      button: previewImage,
      url: '<?php echo YUrl::createBackendUrl('', 'Index', 'upload'); ?>',
      name: 'uploadfile',
      multipart: true,
      hoverClass: 'hover',
      focusClass: 'focus',
      responseType: 'json',
      startXHR: function() {
          // 开始上传。可以做一些初始化的工作。
      },
      onSubmit: function() {
    	  previewImage.empty();
    	  previewImage.append('<img src="<?php echo YUrl::assets('js', '/AjaxUploader/upload_loading.png') ?>">');
        },
      onComplete: function(filename, response) {
          // 上传完成。
          if (!response) {
        	  previewImage.empty();
        	  previewImage.append('<img src="<?php echo YUrl::assets('js', '/AjaxUploader/upload_error.png') ?>">');
              return;
          }
          if (response.errcode == 0) {
              $('#previewImage').empty();
              $('#previewImage').append('<img style="max-width:119px;max-height:119px;" src="' + response.data[0]['image_url'] + '"/>');
              $('#input_voucher').val(response.data[0]['relative_image_url']);
          } else {
        	  previewImage.empty();
        	  previewImage.append('<img src="<?php echo YUrl::assets('js', '/AjaxUploader/upload_error.png') ?>">');
              dialogTips(response.errmsg, 5);
          }
        },
      onError: function() {
    	  previewImage.empty();
    	  previewImage.append('<img src="<?php echo YUrl::assets('js', '/AjaxUploader/upload_error.png') ?>">');
        }
	});
});



//-->
</script>

<link href="<?=YUrl::assets('js', '/umeditor/themes/default/css/umeditor.css')?>" type="text/css" rel="stylesheet">
<script type="text/javascript" src="<?=YUrl::assets('js', '/umeditor/third-party/template.min.js')?>"></script>
<script type="text/javascript" src="<?=YUrl::assets('js', '/umeditor/umeditor.config.js')?>"></script>
<script type="text/javascript" src="<?=YUrl::assets('js', '/umeditor/umeditor.min.js')?>"></script>
<script type="text/javascript" src="<?=YUrl::assets('js', '/umeditor/lang/zh-cn/zh-cn.js')?>"></script>
<script>
		window.UMEDITOR_CONFIG.imageUrl = '<?=YUrl::createBackendUrl('', 'Index', 'umUpload')?>';
		window.UMEDITOR_CONFIG.imagePath = '';
        UM.getEditor('editor_id');
</script>

</body>
</html>