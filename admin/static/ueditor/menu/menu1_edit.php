<?php 
	include_once("inc.php");
	if($_REQUEST["pid"]){$pid=$_REQUEST["pid"];}else{$pid=0;}
	$rs = array();
	if ($_REQUEST["id"]) {
		$rs = $mysql->db_get_row("select * from menu where id=". $_REQUEST["id"]);
	}
	if ($_POST){
		$data = array();
		$data["title"] = "'".$_POST["title"]."'";
		$data["pid"] = "'".$_POST["pid"]."'";
		$data["auth"] = "'".$_POST["auth"]."'";
		$data["grade"] = "'".$_POST["grade"]."'";
		$data["url"] = "'".$_POST["url"]."'";
		if ($_REQUEST["id"]) {
			$mysql->db_mdf("menu",$data,$_REQUEST["id"]);
		} else {
			$mysql->db_add("menu",$data);
		}
		urlMsg("提交成功", "menu1_list.php?auth=".$_POST["auth"]."&pid=".$_POST["pid"]);
		die;
	}
	
?>
<?php include_once("base.php");?>
	<script>
	function checkadd()
	{
	if (document.add.title.value=='')
	{
	alert('标题不能为空');
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
				<tr bgcolor="#FFFFFF"><td height="31"><div class="title">添加/修改操作</div></td></tr>
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
								<form name="add" method="post" action="?" onSubmit="return checkadd()"  enctype="multipart/form-data">
									<input type="hidden" name="id" value="<?php echo $rs["id"];?>" />
									<input type="hidden" name="pid" value="<?php echo $_REQUEST["pid"];?>" />
                                    <input type="hidden" name="auth" value="<?php echo $_REQUEST["auth"];?>" />
                                    <table width="100%" class="cont">
                                        <tr>
                                          <td width="120" align="right"><span class="red">*</span> 名称：</td>
                                          <td><input name="title" type="text" class="text" style="width:350px;"  value="<?php echo $rs["title"];?>"></td>
                                        </tr>
                                        <?php 
											$menuA = $mysql->db_get_all("select * from menu where type=0 and auth=".$_REQUEST['auth']." and pid=0 order by grade asc");
											if(!empty($menuA[0])){
										?>
                                        <tr>
                                          <td align="right"><span class="red">*</span> 所属系别：</td>
                                          <td>
                                          <select name="pid">
											  <?php foreach($menuA as $row) {	?>
                                                <option value="<?php echo $row["id"];?>" <?php if($_REQUEST["pid"]==$row["id"]){echo ' selected="selected" ';}?>><?php echo $row["title"];?></option>
                                            <?php } ?>
                                          </select>
                                          </td>
                                        </tr>
                                        <?php }?>
                                        <tr>
                                          <td width="120" align="right"><span class="red">*</span> 网址：</td>
                                          <td><input name="url" type="text" class="text" style="width:350px;"  value="<?php echo $rs["url"];?>"></td>
                                        </tr>
                                        <tr>
                                          <td width="120" align="right"><span class="red">*</span> 排序：</td>
                                          <td><input name="grade" type="text" class="text" style="width:350px;"  value="<?php echo $rs["grade"];?>"></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><input type="submit" class="btn" id="submitBtn" value="提交" ></td>
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
</body>
</html>