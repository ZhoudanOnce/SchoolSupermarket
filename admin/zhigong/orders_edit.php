<?php 
	include_once("inc.php");
	$tb_name = "orders";
	$number1=date("YmjHis").$_SESSION["zhigongid"];
	$data["title"] = "'".$number1."'";
	$data["zhigongid"] = "'".$_SESSION["zhigongid"]."'";
	$data["classifyid"] = "'".$_SESSION["classifyid"]."'";
	$mysql->db_add($tb_name,$data);
	urlMsg("操作成功", $tb_name."_list.php");
?>