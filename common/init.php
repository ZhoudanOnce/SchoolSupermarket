<?php
	error_reporting(0);
	if (__FILE__ == '')
	{
		die('error code: 0');
	}
	header('Content-Type:text/html;charset=utf-8');
	define('ROOT_PATH', str_replace('/common/init.php', '', str_replace('\\', '/', __FILE__)));
	date_default_timezone_set('PRC');  
	include_once ROOT_PATH."/config.php";
	include_once ROOT_PATH."/common/func_db.php";
    $mac = new GetMacAddr(PHP_OS);
	include_once ROOT_PATH."/common/function.php";
	include_once ROOT_PATH."/common/PageWeb.class.php";
	session_start();
	$mysql = new mysql();
	$mysql->connect($CONFIG);
	$mysql->db_kill();
	define('__BASE__', $CONFIG["url"]);
	define('__PUBLIC__', $CONFIG["url"]."/Public");
	define('__ADMIN__', $CONFIG["url"]."/admin");
?>