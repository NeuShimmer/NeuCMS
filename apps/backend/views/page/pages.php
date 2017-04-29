<?php
use common\YCore;
require_once (APP_VIEW_PATH . DIRECTORY_SEPARATOR . 'common/header.php');
$_frontend_domain_name = YCore::config('frontend_domain_name');
?>

<div class="subnav">
	<div class="content-menu ib-a blue line-x">
		<a href='javascript:;' class="on"><em>所有页面</em></a>
	</div>
</div>

<style type="text/css">
html {
	_overflow-y: scroll
}
</style>
<div class="pad-lr-10">
	<div class="table-list">
		<table width="100%" cellspacing="0">
			<thead>
				<tr>
					<th align="left">名称</th>
					<th>查看</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($list as $a): ?>
					<tr>
						<td align='left'><?=$a?></td>
						<td align='center'>
							<a href="<?=$_frontend_domain_name?>/page/<?=$a?>" target="_blank">查看</a>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
		</table>
	</div>
</div>
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