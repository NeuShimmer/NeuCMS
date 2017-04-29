<?php
use common\YUrl;
$title = $cat['cat_name'];
require(APP_VIEW_PATH . DIRECTORY_SEPARATOR . 'common/header.php');
?>
<div class="container">
	<?php require(APP_VIEW_PATH . DIRECTORY_SEPARATOR . 'common/navbar.php'); ?>
	<ol class="breadcrumb">
  		<li><a href="/">首页</a></li>
  		<li class="active"><?=$cat['cat_name']?></li>
	</ol>
	<h1><?=$cat['cat_name']?></h1>
	<?php
	foreach ($list['list'] as $atlas) {
		echo '<h3><a href="/atlas/view/', empty($atlas['code']) ? $atlas['news_id'] : $atlas['code'], '">', htmlspecialchars($atlas['title']), '</a></h3>';
		echo '<p>', $atlas['intro'], '</p>';
	}
	?>
</div>
<?php require(APP_VIEW_PATH . DIRECTORY_SEPARATOR . 'common/footer.php'); ?>