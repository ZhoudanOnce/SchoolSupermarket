<?php 
	include_once("inc.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>左侧导航menu</title>
<link href="skin/index/css/css.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="skin/index/js/sdmenu.js"></script>
<script type="text/javascript">
	// <![CDATA[
	var myMenu;
	window.onload = function() {
		myMenu = new SDMenu("my_menu");
		myMenu.init();
	};
	// ]]>
</script>
<style type=text/css>
html{ SCROLLBAR-FACE-COLOR: #538ec6; SCROLLBAR-HIGHLIGHT-COLOR: #dce5f0; SCROLLBAR-SHADOW-COLOR: #2c6daa; SCROLLBAR-3DLIGHT-COLOR: #dce5f0; SCROLLBAR-ARROW-COLOR: #2c6daa;  SCROLLBAR-TRACK-COLOR: #dce5f0;  SCROLLBAR-DARKSHADOW-COLOR: #dce5f0; overflow-x:hidden;}
body{overflow-x:hidden; background:url(skin/index/images/leftbg.jpg) left top repeat-y #f2f0f5; width:194px;}
</style>
</head>
<body onselectstart="return false;" ondragstart="return false;" oncontextmenu="return false;">
    <div style="float: left" id="my_menu" class="sdmenu">
      <div class="collapsed">
        <span>标题</span>
        <a href="menu_edit1.php?id=1" target="main" onFocus="this.blur()">标题</a>
      </div>
		<div class="collapsed">
        <span>管理员</span>
        <a href="menu_list.php?auth=1" target="main" onFocus="this.blur()">一级栏目显</a>
		  <a href="menu_list1.php?auth=1" target="main" onFocus="this.blur()">一级栏目不</a>
        <a href="menu1_list.php?auth=1" target="main" onFocus="this.blur()">二级栏目显</a>
		  <a href="menu1_list1.php?auth=1" target="main" onFocus="this.blur()">二级栏目不</a>
      </div>
      <div>
        <span>用户</span>
        <a href="menu_list.php?auth=3" target="main" onFocus="this.blur()">一级栏目显</a>
		  <a href="menu_list1.php?auth=3" target="main" onFocus="this.blur()">一级栏目不</a>
        <a href="menu1_list.php?auth=3" target="main" onFocus="this.blur()">二级栏目显</a>
		  <a href="menu1_list1.php?auth=3" target="main" onFocus="this.blur()">二级栏目不</a>
      </div>
      <div>
        <span>职工</span>
        <a href="menu_list.php?auth=2" target="main" onFocus="this.blur()">一级栏目显</a>
		  <a href="menu_list1.php?auth=2" target="main" onFocus="this.blur()">一级栏目不</a>
        <a href="menu1_list.php?auth=2" target="main" onFocus="this.blur()">二级栏目显</a>
		  <a href="menu1_list1.php?auth=2" target="main" onFocus="this.blur()">二级栏目不</a>
      </div>
      
    </div>
</body>
</html>