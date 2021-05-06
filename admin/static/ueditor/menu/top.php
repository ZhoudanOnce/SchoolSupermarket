<?php 
	include_once("inc.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台页面头部</title>
<link href="skin/index/css/css.css" type="text/css" rel="stylesheet" />
</head>
<body style="overflow-x:hidden;">
<!--禁止网页另存为-->
<noscript><iframe scr="*.htm"></iframe></noscript>
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="header">
  <tr>
    <td align="left" valign="top" id="logo"><?php echo $CONFIG["webname"];?></td>
    <td width="" align="left" valign="bottom">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="50" align="right" valign="top" id="header-right">
        	<a href="logincheck.php?type=logout" target="_parent" onFocus="this.blur()" class="admin-out">注销</a>
        	<a href="../index.php" target="_blank" onFocus="this.blur()" class="admin-index">网站首页</a>       	
            <span>

            </span>
        </td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>