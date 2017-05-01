<?php
use common\YUrl;
require_once (APP_VIEW_PATH . DIRECTORY_SEPARATOR . 'common/header.php');
?>

<style type="text/css">
html {
	_overflow-y: scroll
}
#atlas_content .item {
	margin-bottom: 5px;
}
#atlas_content .item > div {
	display: inline-block;
	margin-right: 5px;
}
#atlas_content img {
	width: 100%;
	height: 100%;
}
#atlas_content .item .text {
	width: calc(90% - 160px);
}
#atlas_content .item .text input {
	width: 100%;
}
</style>

<div class="pad_10">
	<form action="<?php echo YUrl::createBackendUrl('', 'Atlas', 'add'); ?>"
		method="post" name="myform" id="myform">
		<table cellpadding="2" cellspacing="1" class="table_form" width="100%">
			<tr>
				<th width="100">图集分类：</th>
				<td><select name="cat_id">
				<?php foreach ($news_cat_list as $cat): ?>
					<option value="<?php echo $cat['cat_id']; ?>"><?php echo $cat['cat_name']; ?></option>
					<?php
					if (isset($cat['sub']) && is_array($cat['sub'])) {
						foreach ($cat['sub'] as $sub_cat) {
							echo '<option value="', $cat['cat_id'], '">&nbsp;&nbsp;&nbsp;├─ ', $sub_cat['cat_name'], '</option>';
						}
					}
					?>
        		<?php endforeach; ?>
				</select></td>
			</tr>
			<tr>
				<th width="100">图集标题：</th>
				<td><input type="text" name="title" id="title" size="40"
					class="input-text" value="">(不得超过100个字符)</td>
			</tr>
			<tr>
				<th width="100">图集编码：</th>
				<td><?php echo $frontend_url; ?>atlas/<input type="text"
					name="code" id="code" size="10" class="input-text" value="">(自定义URL)</td>
			</tr>
			<tr>
				<th width="100">关键词：</th>
				<td><input type="text" name="keywords" id="keywords" size="40"
					class="input-text" value=""></td>
			</tr>
			<tr>
				<th width="100">图集简介：</th>
				<td><textarea name="intro" id="intro" style="width: 90%;" rows="5"
						cols="50"></textarea></td>
			</tr>
			<tr>
				<th width="100">来源：</th>
				<td><input type="text" name="source" id="source" size="20"
					class="input-text" value=""></td>
			</tr>
			<tr>
				<th width="100">显示状态：</th>
				<td><select name="display">
						<option value="1">显示</option>
						<option value="0">隐藏</option>
				</select></td>
			</tr>
			<tr>
				<th width="100">图集封面：</th>
				<td><input type="hidden" name="image_url" id="input_voucher"
					value="" /><div id="previewImage"></div></td>
			</tr>
			<tr>
				<th width="100">图集内容：</th>
				<td id="atlas_content">
					<div style="display:block;width:100%;"><input id="add_more" type="button" name="dosubmit" class="btn_submit" value=" 添加更多 " /></div>
				</td>
			</tr>
			<tr>
				<input id="content" type="hidden" name="content" value="" />
				<td width="100%" align="center" colspan="2"><input id="form_submit"
					type="button" name="dosubmit" class="btn_submit" value=" 提交 " /></td>
			</tr>
		</table>

	</form>
</div>

<script type="text/javascript">
<!--

$(document).ready(function(){
	$('#form_submit').click(function(){
		//生成图集内容
		var list = [];
		$('#atlas_content').find('.item').each(function(i, n) {
			if ($(n).find('.j_url').val().trim() === '') {
				return;
			}
			list.push({
				"img": $(n).find('.j_url').val().trim(),
				"intro": $(n).find('.j_intro').val().trim()
			});
		});
		$('#content').val(JSON.stringify(list));
		var data = $('form').eq(0).serialize();
	    $.ajax({
	    	type: 'post',
            url: $('form').eq(0).attr('action'),
            dataType: 'json',
            data: $('form').eq(0).serialize(),
            success: function(data) {
                if (data.errcode == 0) {
                	alert('添加成功');
					window.location.reload();
                } else {
                	dialogTips(data.errmsg, 3);
                }
            }
	    });
	});

	/* 图片上传 */
	var previewImage = $('#previewImage');
	previewImage.css({"width": "120px", "height": "120px", "border": "2px solid #CCD"});
	previewImage.empty();
	previewImage.append('<img src="<?php echo YUrl::assets('js', '/AjaxUploader/upload_default.png') ?>">');
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

	var addAtlasContent = function(url, intro) {
		if (url === undefined) {
			url = '';
			imgUrl = "<?php echo YUrl::assets('js', '/AjaxUploader/upload_default.png') ?>";
		} else {
			imgUrl = url;
		}
		if (intro === undefined) {
			intro = "";
		}
		var previewImage = $('<div />', {
			"class": "img"
		});
		previewImage.css({"width": "60px", "height": "60px", "border": "2px solid #CCD"});
		previewImage.empty();
		previewImage.append('<input type="hidden" class="j_url" value="' + url + '" /><img src="' + imgUrl + '">');
		$('#add_more').parent().before($('<div />', {
			"class": "item"
		}).append(previewImage).append('<div class="text"><input type="text" class="input-text j_intro" placeholder="图片说明" value="' + intro + '"><div>'));
		var uploader = new ss.SimpleUpload({
			button: previewImage,
			url: '<?=YUrl::createBackendUrl('', 'Index', 'upload')?>',
			name: 'uploadfile',
			multipart: true,
			hoverClass: 'hover',
			focusClass: 'focus',
			responseType: 'json',
			startXHR: function() {
			},
			onSubmit: function() {
				previewImage.find('.j_url').val('');
				previewImage.find('img').attr('src', "<?=YUrl::assets('js', '/AjaxUploader/upload_loading.png')?>");
			},
			onComplete: function(filename, response) {
				// 上传完成。
				if (!response) {
					previewImage.find('img').attr('src', "<?=YUrl::assets('js', '/AjaxUploader/upload_error.png')?>");
					return;
				}
				if (response.errcode == 0) {
					previewImage.find('img').attr('src', response.data[0]['image_url']);
					previewImage.find('.j_url').val(response.data[0]['image_url']);
				} else {
					previewImage.find('img').attr('src', '<?=YUrl::assets('js', '/AjaxUploader/upload_error.png')?>');
					dialogTips(response.errmsg, 5);
				}
			},
			onError: function() {
				previewImage.find('img').attr('src', '<?=YUrl::assets('js', '/AjaxUploader/upload_error.png')?>');
			}
		});
	};
	addAtlasContent();
	addAtlasContent();
	addAtlasContent();
	$('#add_more').bind('click', function() {
		addAtlasContent();
	});
});
//-->
</script>
</body>
</html>