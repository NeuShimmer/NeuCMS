<?php
use common\YUrl;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0041)http://www.budanmai.com/index.php?m=admin -->
<html xmlns="http://www.w3.org/1999/xhtml" class="off">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">

		<title>NeuCMS - 后台管理中心</title>
		<link href="<?php echo YUrl::assets('css', '/backend/reset.css'); ?>"
			rel="stylesheet" type="text/css">
			<link
				href="<?php echo YUrl::assets('css', '/backend/zh-cn-system.css'); ?>"
				rel="stylesheet" type="text/css">
				<link rel="stylesheet" type="text/css"
					href="<?php echo YUrl::assets('css', '/backend/zh-cn-styles1.css'); ?>"
					title="styles1" media="screen">
					<link rel="alternate stylesheet" type="text/css"
						href="<?php echo YUrl::assets('css', '/backend/zh-cn-styles2.css'); ?>"
						title="styles2" media="screen">
						<link rel="alternate stylesheet" type="text/css"
							href="<?php echo YUrl::assets('css', '/backend/zh-cn-styles3.css'); ?>"
							title="styles3" media="screen">
							<link rel="alternate stylesheet" type="text/css"
								href="<?php echo YUrl::assets('css', '/backend/zh-cn-styles4.css'); ?>"
								title="styles4" media="screen">

								<script
									src="<?php echo YUrl::assets('js', '/jquery-1.10.2.js'); ?>"></script>
								<!-- 对话框 -->
								<link rel="stylesheet"
									href="<?php echo YUrl::assets('js', '/artDialog/css/ui-dialog.css'); ?>">
									<script
										src="<?php echo YUrl::assets('js', '/artDialog/dist/dialog-min.js'); ?>"></script>
									<script
										src="<?php echo YUrl::assets('js', '/artDialog/dist/dialog-plus-min.js'); ?>"></script>

									<script language="javascript" type="text/javascript"
										src="<?php echo YUrl::assets('js', '/backend/styleswitch.js'); ?>"></script>
									<script language="javascript" type="text/javascript"
										src="<?php echo YUrl::assets('js', '/backend/hotkeys.js'); ?>"></script>
									<script language="javascript" type="text/javascript"
										src="<?php echo YUrl::assets('js', '/backend/jquery.sgallery.js'); ?>"></script>

									<style type="text/css">
.objbody {
	overflow: hidden
}

.btns {
	background-color: #666;
}

.btns {
	position: absolute;
	top: 116px;
	right: 30px;
	z-index: 1000;
	opacity: 0.6;
}

.btns2 {
	background-color: rgba(0, 0, 0, 0.5);
	color: #fff;
	padding: 2px;
	border-radius: 3px;
	box-shadow: 0px 0px 2px #333;
	padding: 0px 6px;
	border: 1px solid #ddd;
}

.btns:hover {
	opacity: 1;
}

.btns h6 {
	padding: 4px;
	border-bottom: 1px solid #666;
	text-shadow: 0px 0px 2px #000;
}

.btns .pd4 {
	padding-top: 4px;
	border-top: 1px solid #999;
}

.pd4 li {
	border-radius: 0px 6spx 0px 6px;
	margin-top: 2px;
	margin-bottom: 3px;
	padding: 2px 0px;
}

.btns .pd4 li span {
	padding: 0px 6px;
}

.pd {
	padding: 4px;
}

.ac {
	background-color: #333;
	color: #fff;
}

.hvs {
	background-color: #555;
	cursor: pointer;
}

.bg_btn {
	background: url(<?php echo YUrl::assets('image', '/backend/icon2.jpg');
        ?>) no-repeat;
	width: 32px;
	height: 32px;
}
</style>

</head>
<body scroll="no" class="objbody" youdao="bind">
	<div class="" style="display: none; position: absolute;">
		<div class="aui_outer">
			<table class="aui_border">
				<tbody>
					<tr>
						<td class="aui_nw"></td>
						<td class="aui_n"></td>
						<td class="aui_ne"></td>
					</tr>
					<tr>
						<td class="aui_w"></td>
						<td class="aui_c"><div class="aui_inner">
								<table class="aui_dialog">
									<tbody>
										<tr>
											<td colspan="2" class="aui_header"><div class="aui_titleBar">
													<div class="aui_title"
														style="cursor: move; display: block;"></div>
													<a class="aui_close" href="javascript:/*artDialog*/;"
														style="display: block;">×</a>
												</div></td>
										</tr>
										<tr>
											<td class="aui_icon" style="display: none;"><div
													class="aui_iconBg" style="background: none;"></div></td>
											<td class="aui_main" style="width: auto; height: auto;"><div
													class="aui_content" style="padding: 20px 25px;"></div></td>
										</tr>
										<tr>
											<td colspan="2" class="aui_footer"><div class="aui_buttons"
													style="display: none;"></div></td>
										</tr>
									</tbody>
								</table>
							</div></td>
						<td class="aui_e"></td>
					</tr>
					<tr>
						<td class="aui_sw"></td>
						<td class="aui_s"></td>
						<td class="aui_se" style="cursor: se-resize;"></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<div class="header" style="width: auto;">
		<div class="logo lf">
			<a href="" target="_blank"><span class="invisible">NeuCMS</span></a>
		</div>
		<div class="rt-col">
			<div class="tab_style white cut_line text-r">
				<a href="" target="_blank">NeuCMS</a>
				<ul id="Skin">
					<li class="s1 styleswitch" rel="styles1"></li>
					<li class="s2 styleswitch" rel="styles2"></li>
					<li class="s3 styleswitch" rel="styles3"></li>
					<li class="s4 styleswitch" rel="styles4"></li>
				</ul>
			</div>
		</div>
		<div class="col-auto">
			<div class="log white cut_line">您好！<?php echo $username; ?>  [<?php echo $realname; ?>]<span>|</span><a
					href="<?php echo YUrl::createBackendUrl('', 'Public', 'logout'); ?>">[退出]</a><span>|</span>
				<!-- <a href="" target="_blank" id="site_homepage">站点首页</a> -->
			</div>
			<ul class="nav white" id="top_menu">
        <?php foreach($top_menu as $key => $menu):?>
        <li id="_M<?php echo $menu['menu_id']; ?>"
					class="<?php echo $key == 0 ? 'on' : ''; ?> top_menu"><a
					href="javascript:_M(<?php echo $menu['menu_id']; ?>, '')"
					hidefocus="true" style="outline: none;"><?php echo $menu['name']; ?></a></li>
        <?php endforeach; ?>
        </ul>
		</div>
	</div>
	<div id="content" style="width: auto;">
		<div class="col-left left_menu">
			<div id="Scroll" style="height: 524px;">
				<div id="leftMain"></div>
			</div>
			<a href="javascript:;" id="openClose"
				style="outline: invert none medium; height: 574px;"
				hidefocus="hidefocus" class="open" title="展开与关闭"><span
				class="hidden">展开</span></a>
		</div>
		<div class="col-1 lf cat-menu" id="display_center_id"
			style="display: none" height="100%">
			<div class="content">
				<iframe name="center_frame" id="center_frame" src=""
					frameborder="false" scrolling="auto"
					style="border: none; height: 553px;" width="100%" height="auto"
					allowtransparency="true"></iframe>
			</div>
		</div>
		<div class="col-auto mr8">
			<div class="crumbs">
				<!--
    <div class="shortcut cu-span">
	    <a href="" target="right"><span>生成首页</span></a>
	    <a href="" target="right"><span>更新缓存</span></a>
    </div>
    -->
				当前位置：<span id="current_pos"></span>
			</div>
			<div class="col-1">
				<div class="content" style="position: relative; overflow: hidden">
					<iframe name="right" id="rightMain" src="/index/index/right"
						frameborder="false" scrolling="auto"
						style="border: none; margin-bottom: 30px; height: 505px;"
						width="100%" height="auto" allowtransparency="true"></iframe>
				</div>
			</div>
		</div>
	</div>

	<!-- 左侧菜单过多，会形成上下滚动箭头方向 -->
	<div class="scroll" style="display: none;">
		<a href="javascript:;" class="per" title="使用鼠标滚轴滚动侧栏"
			onclick="menuScroll(1);"></a> <a href="javascript:;" class="next"
			title="使用鼠标滚轴滚动侧栏" onclick="menuScroll(2);"></a>
	</div>

	<script type="text/javascript">
if(!Array.prototype.map)
Array.prototype.map = function(fn,scope) {
  var result = [],ri = 0;
  for (var i = 0,n = this.length; i < n; i++){
	if(i in this){
	  result[ri++]  = fn.call(scope ,this[i],i,this);
	}
  }
return result;
};

var getWindowSize = function(){
return ["Height","Width"].map(function(name){
  return window["inner"+name] ||
	document.compatMode === "CSS1Compat" && document.documentElement[ "client" + name ] || document.body[ "client" + name ]
});
}
window.onload = function (){
	if(!+"\v1" && !document.querySelector) { // for IE6 IE7
	  document.body.onresize = resize;
	} else {
	  window.onresize = resize;
	}
	function resize() {
		wSize();
		return false;
	}
}
function wSize(){
	//这是一字符串
	var str=getWindowSize();
	var strs= new Array(); //定义一数组
	strs=str.toString().split(","); //字符分割
	var heights = strs[0]-150,Body = $('body');$('#rightMain').height(heights);
	//iframe.height = strs[0]-46;
	if(strs[1]<980){
		$('.header').css('width',980+'px');
		$('#content').css('width',980+'px');
		Body.attr('scroll','');
		Body.removeClass('objbody');
	}else{
		$('.header').css('width','auto');
		$('#content').css('width','auto');
		Body.attr('scroll','no');
		Body.addClass('objbody');
	}

	var openClose = $("#rightMain").height()+39;
	$('#center_frame').height(openClose+9);
	$("#openClose").height(openClose+30);
	$("#Scroll").height(openClose-20);
	windowW();
}
wSize();
function windowW(){
	if($('#Scroll').height()<$("#leftMain").height()){
		$(".scroll").show();
	}else{
		$(".scroll").hide();
	}
}
windowW();

// 左侧开关
$("#openClose").click(function(){
	if($(this).data('clicknum')==1) {
		$("html").removeClass("on");
		$(".left_menu").removeClass("left_menu_on");
		$(this).removeClass("close");
		$(this).data('clicknum', 0);
		$(".scroll").show();
	} else {
		$(".left_menu").addClass("left_menu_on");
		$(this).addClass("close");
		$("html").addClass("on");
		$(this).data('clicknum', 1);
		$(".scroll").hide();
	}
	return false;
});

function _M(menuid, targetUrl) {
	var site_url = '<?php echo YUrl::createBackendUrl('', 'Index', 'leftMenu'); ?>';
	$("#leftMain").load(site_url + "?menu_id="+menuid, {limit: 25}, function(response) {
		// 如果返回的是JS。说明已经登录超时。刷新窗口可以重新登录。
	    try {
		   var obj = jQuery.parseJSON(response);
		   window.parent.location.reload();
	    } catch (e) {
		   // ...
	    }
	    windowW();
	});
	$('.top_menu').removeClass("on");
	$('#_M'+menuid).addClass("on");
	var arrow_url = '<?php echo YUrl::createBackendUrl('', 'Index', 'arrow'); ?>';
	$.get(arrow_url + "?menu_id="+menuid, function(data){
		$("#current_pos").html(data);
	});
	//当点击顶部菜单后，隐藏中间的框架
	$('#display_center_id').css('display','none');
	//显示左侧菜单，当点击顶部时，展开左侧
	$(".left_menu").removeClass("left_menu_on");
	$("#openClose").removeClass("close");
	$("html").removeClass("on");
	$("#openClose").data('clicknum', 0);
	$("#current_pos").data('clicknum', 1);
}

/**
 * 左侧菜单点击处理。
 */
function _MP(menuid, targetUrl) {
	$("#menuid").val(menuid);
	$("#rightMain").attr('src', targetUrl + '?menuid=' + menuid);
	$('.sub_menu').removeClass("on fb blue");
	$('#_MP'+menuid).addClass("on fb blue");
	var arrow_url = '<?php echo YUrl::createBackendUrl('', 'Index', 'arrow'); ?>';
	$.get(arrow_url + "?&menu_id="+menuid, function(data){
		$("#current_pos").html(data+'<span id="current_pos_attr"></span>');
	});
	$("#current_pos").data('clicknum', 1);
}

(function(){
    var addEvent = (function(){
             if (window.addEventListener) {
                return function(el, sType, fn, capture) {
                    el.addEventListener(sType, fn, (capture));
                };
            } else if (window.attachEvent) {
                return function(el, sType, fn, capture) {
                    el.attachEvent("on" + sType, fn);
                };
            } else {
                return function(){};
            }
        })(),
    Scroll = document.getElementById('Scroll');
    // IE6/IE7/IE8/IE10/IE11/Opera 10+/Safari5+
    addEvent(Scroll, 'mousewheel', function(event){
        event = window.event || event ;
		if(event.wheelDelta <= 0 || event.detail > 0) {
				Scroll.scrollTop = Scroll.scrollTop + 29;
			} else {
				Scroll.scrollTop = Scroll.scrollTop - 29;
		}
    }, false);

    // Firefox 3.5+
    addEvent(Scroll, 'DOMMouseScroll',  function(event){
        event = window.event || event ;
		if(event.wheelDelta <= 0 || event.detail > 0) {
				Scroll.scrollTop = Scroll.scrollTop + 29;
			} else {
				Scroll.scrollTop = Scroll.scrollTop - 29;
		}
    }, false);

})();

function menuScroll(num){
	var Scroll = document.getElementById('Scroll');
	if(num==1){
		Scroll.scrollTop = Scroll.scrollTop - 60;
	}else{
		Scroll.scrollTop = Scroll.scrollTop + 60;
	}
}

// 加载默认的菜单。
$(function(){
	_M('1000');
})

</script>

</body>
</html>