<?php 
	include_once("../common/init.php");

	if($_REQUEST["type"]=="logout"){
		session_destroy();
		session_start();
		urlMsg("退出成功", __BASE__."/admin/login.php");
		die;
	}
	if ($_POST) {
		if($_POST["type"]=="员工"){
			$rsRow = $mysql->db_get_row("select * from zhigong where username='". $_POST["account"] ."'");
			if ($rsRow['password'] == $_POST["password"]){
				$_SESSION["zhigongid"]	=	$rsRow['id'];
				$_SESSION['zhigongzname']	=	$rsRow['zname'];
				$_SESSION['classifyid']	=	$rsRow['classifyid'];
				$_SESSION['type2']		=	"员工";
				
				urlMsg("登录成功", "zhigong/index.php");die;
				
				die;
			} else {
				goBakMsg("账号不存在或密码错误");die;
			}
		}else{
			$rsRow = $mysql->db_get_row("select * from admin where username='". $_POST["account"] ."' and type='".$_POST["type"]."'");
			if ($rsRow['password'] == $_POST["password"]){
				$_SESSION["adminid"]	=	$rsRow['id'];
				$_SESSION['adminname']	=	$rsRow['username'];
				$_SESSION['type2']		=	$rsRow['type'];
				if($rsRow['type']=="超级管理员"){urlMsg("登录成功", __BASE__."/admin/index.php");die;}
			 }
		else{
				goBakMsg("账号不存在或密码错误");die;
			}
}}



?>