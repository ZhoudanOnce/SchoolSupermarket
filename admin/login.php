<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include_once("../common/init.php");?><?php echo $CONFIG["webname"];?></title>
<link href="<?php echo __ADMIN__;?>/skin/login/css/css.css" rel="stylesheet" type="text/css" />
</head>


 <script src="<?php echo __ADMIN__;?>/skin/login/js/jquery-1.4.1.min.js" type="text/javascript"></script>
    <script src="<?php echo __ADMIN__;?>/skin/login/js/jquery.cookie.js" type="text/javascript"></script>
    <script type="text/javascript" language="javascript" src="<?php echo __ADMIN__;?>/skin/login/js/jquery.validate.js"></script>
    <script src="<?php echo __ADMIN__;?>/skin/login/js/jquery.metadata.js" type="text/javascript"></script>
<SCRIPT type=text/javascript>
function selectTag(showContent,selfObj){
debugger;
	// 操作标签
	var tag = document.getElementById("tags").getElementsByTagName("li");
	var taglength = tag.length;
	for(i=0; i<taglength; i++){
		tag[i].className = "";
	}
	selfObj.parentNode.className = "selectTag";
	// 操作内容
	for(i=0; j=document.getElementById("tagContent"+i); i++){
		j.style.display = "none";
	}
	document.getElementById(showContent).style.display = "block";
	
	
}
</SCRIPT>






<body>
<div class="content_room">
	
    <div class="tab">
	  <ul id=tags>
   		<li class=selectTag><a onClick="selectTag('tagContent0',this)"  href="javascript:void(0)">登录中心</a> </li>
		  <!--
      	<li><a onClick="selectTag('tagContent1',this)"  href="javascript:void(0)">2</a> </li>
   		<li><a onClick="selectTag('tagContent2',this)" href="javascript:void(0)">1</a> </li>
          <span><a href="#">返回首页 ></a></span>-->
      </ul>
      	<div id=tagContent>
        	<div class="tagContent selectTag" id=tagContent0>
				<form class="" id="login" name="login" method="post" action="logincheck.php" onSubmit="return checklogin();">
                <div class="login_title"><?php echo $CONFIG["webname"];?></div>
            
            
           		<ul>
                    <li><span>用户名：</span>
                        <input name="account" type="text" id="txtTel" class="kuang"></li>
                    <li><span>密码：</span><input name="password" type="password"
                        id="txtPwdL" class="kuang"></li>
					<li><span>角色：</span><input type="radio" style="width:20px;" name="type" id="select1" value="员工" checked>
                              员工
                                <input type="radio" style="width:20px; margin-left:10px;" name="type" id="select1" value="超级管理员" checked>
                              管理员</li>
                </ul>
                <div class="hd_register_black">
                    <input type="submit" name="btnLogin" value="登录" id="btnLogin" class="hd_register_btn hd_register_btnleft">  <br>
					<center><a href="user/index.php">外来人员登录</a></center>
                </div>
				</form>
            </div>
            
            
            
		</div>	
    </div>
<div class="banner"><img src="<?php echo __ADMIN__;?>/skin/login/images/bg.jpg"/></div>

    
</div>
</body>
</body>
</html>

<script language="javascript">
function checklogin()
{
  if(document.login.account.value=='')
     {alert('请输入帐户');
      document.login.account.focus();
      return false
    }
  if (document.login.password.value=='')
   {alert('请输入密码');
    document.login.password.focus();
    return false
   }
}
</script>