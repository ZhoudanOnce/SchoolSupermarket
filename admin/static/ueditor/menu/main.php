<?php 
	include_once("inc.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>主要内容区main</title>
<link href="skin/index/css/css.css" type="text/css" rel="stylesheet" />
<link href="skin/index/css/main.css" type="text/css" rel="stylesheet" />
<style>
body{overflow-x:hidden; background:#f2f0f5; padding:15px 0px 10px 5px;}
#main{ font-size:12px;}
#main span.time{ font-size:14px; color:#528dc5; width:100%; padding-bottom:10px; float:left}
#main div.top{ width:100%; background:url(skin/index/images/main_r2_c2.jpg) no-repeat 0 10px; padding:0 0 0 15px; line-height:35px; float:left}
#main div.sec{ width:100%; background:url(skin/index/images/main_r2_c2.jpg) no-repeat 0 15px; padding:0 0 0 15px; line-height:35px; float:left}
.left{ float:left}
</style>
</head>
<body>
<!--main_top-->
<table width="99%" border="0" cellspacing="0" cellpadding="0" id="main">
  <tr>
    <td colspan="2" align="left" valign="top">
    <span class="time"><strong><?php echo $_SESSION['adminname']?></strong><u>[<?php echo $_SESSION['type2']?>]</u></span>
    <div class="top"><span class="left">欢迎登录<?php echo $CONFIG["webname"];?>管理</span></div>
    </td>
  </tr>
</table>
</body>
</html>