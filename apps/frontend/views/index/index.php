<?php
use common\YUrl;
use services\CategoryService;
use services\NewsService;
require(APP_VIEW_PATH . DIRECTORY_SEPARATOR . 'common/header.php');
?>
<div class="container">
	<?php require(APP_VIEW_PATH . DIRECTORY_SEPARATOR . 'common/navbar.php'); ?>
	<?php
	//示例：显示一个分类的文章
	//使用方法：NewsService::getNewsList('', '', '', '', 1, 要获取的数量, 分类ID, 1, 1);
	$_list = NewsService::getNewsList('', '', '', '', 1, 20, 1, 1, 1);
	foreach ($_list['list'] as $_item) {
		echo '<p><a href="/archives/', $_item['news_id'], '">', $_item['title'], '</a></p>';
	}
	?>
</div>
<?php require(APP_VIEW_PATH . DIRECTORY_SEPARATOR . 'common/footer.php'); ?>