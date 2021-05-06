<?php 
	include_once("inc.php");
	$tb_name = "orders";
	$number1=date("YmjHis").$_SESSION["adminid"];
	$data["title"] = "'".$number1."'";
	$data["adminid"] = "'".$_SESSION["adminid"]."'";
	$mysql->db_add($tb_name,$data);
	urlMsg("操作成功", $tb_name."_list.php");
?>