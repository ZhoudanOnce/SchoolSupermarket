<?php
include_once("inc.php");
if ($_POST){
	$q1=$mysql->db_query("show tables");
	while($t=$mysql->db_fetch_array($q1)){
	  $table=$t[0];
	  $q2=$mysql->db_query("show create table `$table`");
	  $sql=$mysql->db_fetch_array($q2);
	  $mysql.=$sql['Create Table'].";\r\n";
	  $q3=$mysql->db_query("select * from `$table`");
	  while($data=mysql_fetch_assoc($q3)){
		$keys=array_keys($data);
		$keys=array_map('addslashes',$keys);
		$keys=join('`,`',$keys);
		$keys="`".$keys."`";
		$vals=array_values($data);
		$vals=array_map('addslashes',$vals);
		$vals=join("','",$vals);
		$vals="'".$vals."'";
		$mysql.="insert into `$table`($keys) values($vals);\r\n";
	  }
	}
	$filename="../data/".$_POST["dataname"].".sql"; //存放路径，默认存放到项目最外层
	$fp = fopen($filename,'w');
	fputs($fp,$mysql);
	fclose($fp);
	goBakMsg("数据备份成功");
}
?>
<?php include_once("base.php");?>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="17" rowspan="2" valign="top" bgcolor="#FFFFFF"></td>
		<td valign="top">
			<table width="100%" height="31" border="0" cellpadding="0" cellspacing="0">
				<tr bgcolor="#FFFFFF"><td height="31"><div class="title">数据库备份</div></td></tr>
			</table>
		</td>
		<td width="16" rowspan="2" bgcolor="#FFFFFF"></td>
	</tr>
	<tr>
	<td valign="top" bgcolor="#F7F8F9">
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr><td colspan="4" height="10"></td></tr>
			<tr>
				<td width="1%">&nbsp;</td>
				<td width="96%">
					<table width="100%">
						<tr>
						  <td colspan="2">
								<form name="form1" method="post" action="?" onSubmit="return check()"  enctype="multipart/form-data">
									<input type="hidden" name="id" value="<?php echo $rs["id"];?>" />
                                    <table width="100%" class="cont">
                                        <tr>
                                          <td width="120" align="right"> 目录：</td>
                                          <td width="200">根目录data文件夹下</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                          <td align="right">名称：</td>
                                          <td><input name="dataname" type="text" class="text" size="30" value="data"  maxlength="20">
                                          </td>
                                            <td>.sql文件</td>
                                        </tr>
                                        
                                        <tr>
                                            <td align="right"><input class="btn" type="submit" value="提交" /></td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </table>
							</form>
						  </td>
							</tr>
						</table>
					</td>
					<td width="1%">&nbsp;</td>
				</tr>
				<tr><td height="20"></td></tr>
			</table>
		</td>
	</tr>
</table>
</body></html>