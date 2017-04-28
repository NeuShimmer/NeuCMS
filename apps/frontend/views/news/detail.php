<?php
use common\YUrl;
$title = $detail['title'];
require(APP_VIEW_PATH . DIRECTORY_SEPARATOR . 'common/header.php');
?>
<div class="container">
	<?php require(APP_VIEW_PATH . DIRECTORY_SEPARATOR . 'common/navbar.php'); ?>
	<ol class="breadcrumb">
  		<li><a href="/">首页</a></li>
  		<li><a href="/list/<?=$cat['cat_id']?>"><?=$cat['cat_name']?></a></li>
  		<li class="active"><?=$detail['title']?></li>
	</ol>
	<h1><?=$detail['title']?></h1>
	<p>发布于：<?=date('Y-m-d H:i:s', $detail['created_time'])?></p>
	<?php
	if (!empty($detail['intro'])) {
		echo '<blockquote>', $detail['intro'], '</blockquote>';
	}
	?>	
	<?=$detail['content']?>
</div>
<?php require(APP_VIEW_PATH . DIRECTORY_SEPARATOR . 'common/footer.php'); ?>