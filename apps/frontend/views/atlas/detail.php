<?php
use common\YUrl;
$title = $detail['title'];
require(APP_VIEW_PATH . DIRECTORY_SEPARATOR . 'common/header.php');
?>
<div class="container">
	<?php require(APP_VIEW_PATH . DIRECTORY_SEPARATOR . 'common/navbar.php'); ?>
	<ol class="breadcrumb">
  		<li><a href="/">首页</a></li>
  		<li><a href="/atlas/list/<?=$cat['cat_id']?>"><?=$cat['cat_name']?></a></li>
  		<li class="active"><?=$detail['title']?></li>
	</ol>
	<h1><?=$detail['title']?></h1>
	<p>发布于：<?=date('Y-m-d H:i:s', $detail['created_time'])?></p>
	<?php
	if (!empty($detail['intro'])) {
		echo '<blockquote>', $detail['intro'], '</blockquote>';
	}
	?>
	<div class="row">
	<?php
	foreach ($detail['content'] as $v) {
		echo '<div class="col-md-4">';
		echo '<div class="thumbnail">';
    	echo '<img src="', addslashes($v['img']), '">';
		echo '<div class="caption">';
		echo '<p>', htmlspecialchars($v['intro']), '</p>';
		echo '</div>';
    	echo '</div>';
  		echo '</div>';
	}
	?>
	</div>
</div>
<?php require(APP_VIEW_PATH . DIRECTORY_SEPARATOR . 'common/footer.php'); ?>