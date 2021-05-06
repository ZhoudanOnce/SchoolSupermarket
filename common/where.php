<?php
$page = $_REQUEST["page"]?$_REQUEST["page"]:1;
if ($_REQUEST["pid"]) {$where_sql .= " and pid= ". $_REQUEST["pid"]."";}
if ($_REQUEST["categoryid"]) {$where_sql .= " and categoryid= ". $_REQUEST["categoryid"]."";}
if ($_REQUEST["title"]) {$where_sql .= " and title like '%". $_REQUEST["title"] ."%' ";}
if ($_REQUEST["username"]) {$where_sql .= " and username= '". $_REQUEST["username"]."'";} 
if ($_REQUEST["s1"]) {$where_sql .= " and categoryid= ". $_REQUEST["s1"]."";} 
if ($_REQUEST["s2"]) {$where_sql .= " and category1id= ". $_REQUEST["s2"]."";} 
if ($_REQUEST["s3"]) {$where_sql .= " and fenleiid= ". $_REQUEST["s3"]."";} 
if ($_REQUEST["s4"]) {$where_sql .= " and fenlei1id= ". $_REQUEST["s4"]."";} 
if ($_REQUEST["uname"]) {$where_sql .= " and uname like '%". $_REQUEST["uname"] ."%' ";}
if ($_REQUEST["nickname"]) {$where_sql .= " and nickname like '%". $_REQUEST["nickname"] ."%' ";}
if ($_REQUEST["status"]) {$where_sql .= " and status= '". $_REQUEST["status"]."'";} 
if ($_REQUEST["account"]) {$where_sql .= " and account like '%". $_REQUEST["account"] ."%' ";}
if ($_REQUEST["number1"]) {$where_sql .= " and number1 like '%". $_REQUEST["number1"] ."%' ";}
if ($_REQUEST["onumber"]) {$where_sql .= " and onumber like '%". $_REQUEST["onumber"] ."%' ";}
if ($_REQUEST["keywords"]) {$where_sql .= " and keywords like '%". $_REQUEST["keywords"] ."%' ";}
if ($_REQUEST["zname"]) {$where_sql .= " and zname like '%". $_REQUEST["zname"] ."%' ";}
if ($_REQUEST["semesterid"]) {$where_sql .= " and semesterid =". $_REQUEST["semesterid"] ." ";}
if ($_REQUEST["type"]) {$where_sql .= " and type ='". $_REQUEST["type"] ." '";}
if ($_REQUEST["content"]) {$where_sql .= " and content like '%". $_REQUEST["content"] ."%' ";}
if ($_REQUEST["categoryid"]) {$where_sql .= " and categoryid= ". $_REQUEST["categoryid"]."";} 
if ($_REQUEST["category1id"]) {$where_sql .= " and category1id= ". $_REQUEST["category1id"]."";} 
if ($_REQUEST["isnice"]) {$where_sql .= " and isnice= ". $_REQUEST["isnice"]."";} 
if ($_REQUEST["userid"]) {$where_sql .= " and userid= ". $_REQUEST["userid"]."";}
if ($_REQUEST["shenfen"]) {$where_sql .= " and shenfen= '". $_REQUEST["shenfen"]."'";}
if ($_REQUEST["tname"]) {$where_sql .= " and tname= '". $_REQUEST["tname"]."'";}
if ($_REQUEST["zt"]) {$where_sql .= " and zt= '". $_REQUEST["zt"]."'";}
if ($_REQUEST["goodsid"]) {$where_sql .= " and goodsid= ". $_REQUEST["goodsid"]."";} 
if ($_REQUEST["categoryid2"]) {$where_sql .= " and categoryid2= '". $_REQUEST["categoryid2"]."'";}
if ($_REQUEST["content1id"]) {$where_sql .= " and content1id= '". $_REQUEST["content1id"]."'";}
if ($_REQUEST["status1"]) {$where_sql .= " and status1= '". $_REQUEST["status1"]."'";} 
if ($_REQUEST["sorts2id"]) {$where_sql .= " and sorts2id= '". $_REQUEST["sorts2id"]."'";} 
if ($_REQUEST["status1"]) {$where_sql .= " and status1= '". $_REQUEST["status1"]."'";}
if ($_REQUEST["fenleiid"]) {$where_sql .= " and fenleiid= ". $_REQUEST["fenleiid"]."";}
if ($_REQUEST["begintime"]) {$where_sql .= " and begintime like '%". $_REQUEST["begintime"] ."%' ";}
if ($_REQUEST["endtime"]) {$where_sql .= " and endtime like '%". $_REQUEST["endtime"] ."%' ";}
if ($_REQUEST["onumber"]) {$where_sql .= " and onumber like '%". $_REQUEST["onumber"] ."%' ";}
if ($_REQUEST["addressid"]) {$where_sql .= " and addressid= ". $_REQUEST["addressid"]."";} 
if ($_REQUEST["sortsid"]) {$where_sql .= " and sortsid= ". $_REQUEST["sortsid"]."";} 
?>