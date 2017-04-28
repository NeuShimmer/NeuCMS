<h1><?=$cat['cat_name']?></h1>
<?php
foreach ($list['list'] as $article) {
	echo '<h3><a href="/archives/', $article['news_id'], '">', htmlspecialchars($article['title']), '</a></h3>';
	echo '<p>', $article['intro'], '</p>';
	echo '<hr>';
}