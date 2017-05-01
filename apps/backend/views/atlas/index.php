<?php
use common\YUrl;
require_once (APP_VIEW_PATH . DIRECTORY_SEPARATOR . 'common/header.php');
?>

<div class="subnav">
	<div class="content-menu ib-a blue line-x">
		<a href='javascript:;' class="on"><em>图集列表</em></a>
	</div>
</div>
<style type="text/css">
html {
	_overflow-y: scroll
}
</style>

<div class="pad-lr-10">

	<form name="searchform" action="" method="get">
		<table width="100%" cellspacing="0" class="search-form">
			<tbody>
				<tr>
					<td>
						<div class="explain-col">
							<p>
								图集标题：<input type="text" value="<?php echo $title; ?>"
									class="input-text" name="title" placeholder="图集标题" /> 管理员账号：<input
									type="text" value="<?php echo $admin_name; ?>"
									class="input-text" name="admin_name" placeholder="管理员账号" />
								上传时间：<input type="text" name="starttime" id="starttime"
									value="<?php echo $starttime; ?>" size="20"
									class="date input-text" /> ～ <input type="text" name="endtime"
									id="endtime" value="<?php echo $endtime; ?>" size="20"
									class="date input-text" />
								<script type="text/javascript">
Calendar.setup({
	weekNumbers: false,
    inputField : "starttime",
    trigger    : "starttime",
    dateFormat: "%Y-%m-%d %H:%I:%S",
    showTime: true,
    minuteStep: 1,
    onSelect   : function() {this.hide();}
});

Calendar.setup({
	weekNumbers: false,
    inputField : "endtime",
    trigger    : "endtime",
    dateFormat: "%Y-%m-%d %H:%I:%S",
    showTime: true,
    minuteStep: 1,
    onSelect   : function() {this.hide();}
});
</script>
								<input type="submit" name="search" class="button" value="搜索" />
							</p>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</form>


	<form name="myform" id="myform" action="" method="post">
		<div class="table-list">
			<table width="100%" cellspacing="0">
				<thead>
					<tr>
						<th width="5%" align="center">图集ID</th>
						<th width="10%" align="center">封面</th>
						<th width="15%" align="left">标题</th>
						<th width="20%" align="left">简介</th>
						<th width="10%" align="left">关键词</th>
						<th width="5%" align="center">显示</th>
						<th width="5%" align="center">浏览量</th>
						<th width="8%" align="left">修改时间</th>
						<th width="8%" align="left">创建时间</th>
						<th width="10%" align="center">管理操作</th>
					</tr>
				</thead>
				<tbody>
    <?php foreach ($list as $item): ?>
    	<tr>
						<td align="center"><?php echo $item['news_id']; ?></td>
						<td align="center"><a target="_blank"
							href="<?php echo YUrl::filePath($item['image_url']); ?>"><img
								width="120" height="120"
								src="<?php echo YUrl::filePath($item['image_url']); ?>" /></a></td>
						<td align="left"><?php echo $item['title']; ?></td>
						<td align="left"><?php echo $item['intro']; ?></td>
						<td align="left"><?php echo $item['keywords']; ?></td>
						<td align="center"><?php echo $item['display'] ? '显示' : '隐藏'; ?></td>
						<td align="center"><?php echo $item['hits']; ?></td>
						<td align="left"><?php echo date('Y-m-d H:i:s', $item['modified_time']); ?></td>
						<td align="left"><?php echo date('Y-m-d H:i:s', $item['created_time']); ?></td>
						<td align="center"><a href="<?=YUrl::createBackendUrl('', 'Atlas', 'edit'); ?>?news_id=<?=$item['news_id']?>" title="修改">修改</a> | <a href="###"
							onclick="deleteDialog('deleteDelete', '<?php echo YUrl::createBackendUrl('', 'Atlas', 'delete', ['news_id' => $item['news_id']]); ?>', '<?php echo $item['title'] ?>')"
							title="删除">删除</a></td>
					</tr>
    <?php endforeach; ?>
    </tbody>
			</table>

			<div id="pages">
<?php echo $page_html; ?>
</div>

		</div>

	</form>
</div>
</body>
</html>