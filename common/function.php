<?php
	function check_loginuser(){
		if(!$_SESSION['id']) {
	
			echo "<script language='javascript'>alert('请登录');location.href='login.php';</script>";die;
		}
	}
	
	function check_login(){
		if(!$_SESSION['adminid']) {
			header("Location:".__BASE__."/admin/login.php");
		}
	}
	
	function check_loginzhigong(){
		if(!$_SESSION['zhigongid']) {
			header("Location:".__BASE__."/admin/login.php");
		}
		
	}
	

	//js弹出框
	function alertMsg($msg)
	{	
		echo "<script language='javascript'>alert('".$msg."');</script>";die;
	}
	function goBakMsg($msg)
	{	
		echo "<script language='javascript'>alert('".$msg."');history.go(-1);</script>";die;
	}
	function goclose($msg)
	{	
		echo "<script language='javascript'>alert('".$msg."');window.close();</script>;die;";
	}
	function urlMsg($msg,$url)
	{	
		echo "<script language='javascript'>alert('".$msg."');location.href='$url';</script>";die;
	}

?>