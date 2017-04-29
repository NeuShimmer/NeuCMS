<?php
use common\YUrl;
require_once (APP_VIEW_PATH . DIRECTORY_SEPARATOR . 'common/header.php');
?>

<div class="subnav">
	<div class="content-menu ib-a blue line-x">
		<a class="add fb"
			href="javascript:postDialog('addNavbar', '<?php echo YUrl::createBackendUrl('', 'Page', 'navbarAdd'); ?>', '添加分类', 400, 250)"><em>添加导航</em></a>
		<a href='javascript:;' class="on"><em>导航列表</em></a>
	</div>
</div>

<style type="text/css">
html {
	_overflow-y: scroll
}
</style>
<div class="pad-lr-10">

	<form name="myform"
		action="<?php echo YUrl::createBackendUrl('', 'Page', 'navbarSort'); ?>" method="post" id="sort_form">
		<div class="table-list">
			<table width="100%" cellspacing="0">
				<thead>
					<tr>
						<th width="80">排序</th>
						<th width="100">ID</th>
						<th align="left">名称</th>
						<th>管理操作</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($list as $nav): ?>
						<tr>
						<td align='center'><input
							name='rank[<?php echo $nav['id']; ?>]' type='text'
							size='3' value='<?php echo $nav['rank']; ?>'
							class='input-text-c'></td>
						<td align='center'><?php echo $nav['id']; ?></td>
						<td align='left'><?php echo $nav['name']; ?></td>
						<td align='center'><a
							href="javascript:postDialog('addNavbar', '<?php echo YUrl::createBackendUrl('',  'Page', 'navbarAdd', ['parentid' => $nav['id']]); ?>', '添加子菜单', 450, 280);">添加子菜单</a>
							| <a
							href="javascript:postDialog('editNavbar', '<?php echo YUrl::createBackendUrl('',  'Page', 'navbarEdit', ['id' => $nav['id']]); ?>', '修改', 450, 280);">修改</a>
							| <a
							href="javascript:deleteDialog('deleteNavbar', '<?php echo YUrl::createBackendUrl('',  'Page', 'navbarDel', ['id' => $nav['id']]); ?>', '<?php echo $nav['name']; ?>');">删除</a>
						</td>
					</tr>
						<?php if (isset($nav['sub'])): ?>
						<?php foreach ($nav['sub'] as $sub_m): ?>
					<tr>
						<td align='center'><input
							name='rank[<?php echo $sub_m['id']; ?>]' type='text'
							size='3' value='<?php echo $sub_m['rank']; ?>'
							class='input-text-c'></td>
						<td align='center'><?php echo $sub_m['id']; ?></td>
						<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;├─ <?php echo $sub_m['name']; ?></td>
						<td align='center'><a
							href="javascript:postDialog('editNavbar', '<?php echo YUrl::createBackendUrl('', 'Page', 'navbarEdit', ['id' => $sub_m['id']]); ?>', '修改', 450, 280);">修改</a>
							| <a
							href="javascript:deleteDialog('deleteNavbar', '<?php echo YUrl::createBackendUrl('', 'Page', 'navbarDel', ['id' => $sub_m['id']]); ?>', '<?php echo $sub_m['name']; ?>');">删除</a>
						</td>
					</tr>
						<?php endforeach; ?>
						<?php endif; ?>
					<?php endforeach; ?>
					</tbody>
			</table>
			<div class="btn">
				<input type="button" id="form_submit" class="button" name="dosubmit" value="排序" />
			</div>
		</div>
	</div>
</div>
</form>
</body>
</html>

<script type="text/javascript">
<!--

$(document).ready(function(){
	$('#form_submit').click(function(){
	    $.ajax({
	    	type: 'post',
            url: $('#sort_form').attr('action'),
            dataType: 'json',
            data: $('#sort_form').serialize(),
            success: function(data) {
                if (data.errcode == 0) {
                	window.location.reload();
                } else {
                	dialogTips(data.errmsg, 3);
                }
            }
	    });
	});
});

//-->
</script>

</body>
</html>