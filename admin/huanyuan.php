<?php
include_once("inc.php");
global $CONFIG;
$database = $CONFIG["db_name"];
$result = $mysql->db_get_all("show table status from $database");
if($result[0]){
	foreach($result as $row) {
		$mysql->db_query("drop table ".$row["Name"]);
	}
}else{urlMsg("备份不存在", "main.php");die;}
$mysql_file="../data/data.sql";
restore($mysql_file); //执行MySQL恢复命令
function restore($fname)
 {
  if (file_exists($fname)) {
   $sql_value="";
   $cg=0;
   $sb=0;
   $sqls=file($fname);
   foreach($sqls as $sql)
   {
    $sql_value.=$sql;
   }
   $a=explode(";\r\n", $sql_value);  //根据";\r\n"条件对数据库中分条执行
   $total=count($a)-1;
   //mysql_query("set names 'utf8'");
   for ($i=0;$i<$total;$i++)
   {
    //mysql_query("set names 'utf8'");
    //执行命令
    if(mysql_query($a[$i]))
    {
     $cg+=1;
    }
    else
    { // www.jbxue.com
     $sb+=1;
     $sb_command[$sb]=$a[$i];
    }
   }
   echo "<script>alert('操作完毕，共处理 $total 条命令，成功 $cg 条，失败 $sb 条');parent.location.href='index.php'</script>";
   //显示错误信息
   if ($sb>0)
   {
    echo "<hr><br><br>失败命令如下：<br>";
    for ($ii=1;$ii<=$sb;$ii++)
    {
     echo "<p><b>第 ".$ii." 条命令（内容如下）：</b><br>".$sb_command[$ii]."</p><br>";
    }
   }   //--
  }else{
   echo "MySQL备份文件不存在，请检查文件路径是否正确！";
  }
 }
urlMsg("操作成功", "main.php");
?>