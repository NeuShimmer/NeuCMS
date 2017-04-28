<?php
use common\YCore;
use common\YUrl;
use services\CategoryService;
if (!isset($_site_name)) {
	$_site_name = YCore::config('site_name');
}
$_cat_list = CategoryService::getCategoryList(0, CategoryService::CAT_NEWS, false, false);
?>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><?=$_site_name ?></a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<?php
					foreach ($_cat_list as $v) {
						if (is_array($v['sub']) && count($v['sub']) > 0) {
							echo '<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">', $v['cat_name'], ' <span class="caret"></span></a><ul class="dropdown-menu">';
							foreach ($v['sub'] as $vv) {
								echo '<li><a href="/list/', $vv['cat_id'], '">', $vv['cat_name'], '</a></li>';
							}
							echo '</ul></li>';
						} else {
							echo '<li><a href="';
							echo ($v['is_out_url'] && !empty($v['out_url'])) ? $v['out_url'] : '/list/', $v['cat_id'];
							echo '">', $v['cat_name'], '</a></li>';
						}
					}
					?>
				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
		<!--/.container-fluid -->
	</nav>