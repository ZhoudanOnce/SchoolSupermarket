<?php 
	include_once("inc.php");
	$tb_name = "sorts";
	if ($_REQUEST["id"]) {
		$rs = $mysql->db_get_row("select * from $tb_name where id=". $_REQUEST["id"]);
	}
	if ($_POST){
		$data = array();
		$data["title"] = "'".$_POST["title"]."'";
		if ($_REQUEST["id"]) {
			$mysql->db_mdf($tb_name,$data,$_REQUEST["id"]);
		} else {
			$mysql->db_add($tb_name,$data);
		}
		urlMsg("提交成功", $tb_name."_list.php");
		die;
	}
?>
<?php include_once("base.php");?>
<script>
function checkadd()
{
	if (document.add.title.value=='')
	{
	alert('分类名称不能为空');
	document.add.title.focus;
	return false
	}
}
</script>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="17" rowspan="2" valign="top" bgcolor="#FFFFFF"></td>
		<td valign="top">
			<table width="100%" height="31" border="0" cellpadding="0" cellspacing="0">
				<tr bgcolor="#FFFFFF"><td height="31"><div class="title">添加/修改部门</div></td></tr>
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
								<form name="add" method="post" action="?" onSubmit="return checkadd()">
								<input type="hidden" name="id" value="<?php echo $rs["id"];?>" />
                                    <table width="100%" class="cont">
                                        <tr>
                                          <td width="40%" align="right">部门名称：</td>
                                          <td width=""><input name="title" type="text" class="text" size="30" value="<?php echo $rs["title"];?>"></td>
                                        </tr>
                                        <tr>
                                            <td align="right">&nbsp;</td>
                                            <td><input class="btn" type="submit" value="提交" /><input name="button" type="button" class="btn" onClick="javascript:history.back();" value="返回"></td>
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
</body>
</html>
