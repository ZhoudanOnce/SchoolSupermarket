<?php 
	include_once("inc.php");
	$tb_name = "zhigong";
	$rs = $mysql->db_get_row("select * from $tb_name where id=".$_SESSION["zhigongid"]);
	if ($_POST){
		$row = $mysql->db_get_row("select * from $tb_name where id=".$_SESSION["zhigongid"]);
		if($_POST["password"] != $_POST["repassword"]) {
			goBakMsg("两次密码输入不一致");
		} else if ($_POST["oldpassword"]!=$row["password"]) {
			goBakMsg("原密码错误");
		} else {
			$data = array();
			$data["password"] = "'".$_POST["password"]."'";
			$mysql->db_mdf($tb_name,$data,$_SESSION["zhigongid"]);
			goBakMsg("密码修改成功");
		}
	}
?>
<?php include_once("base.php");?>
<body>
<script type="text/javascript"> 
function check(){
		if(document.form1.oldpassword.value==""){
		alert("请输入原密码");
		document.form1.oldpassword.focus();
		return false;
	}
	if(document.form1.password.value==""){
		alert("请输入密码");
		document.form1.password.focus();
		return false;
	}
	if(document.form1.repassword.value==""){
		alert("请输入确认密码");
		document.form1.repassword.focus();
		return false;
	}
	if(document.form1.password.value!=document.form1.repassword.value){
		alert("两次输入密码不一致");
		document.form1.repassword.focus();
		return false;
	}
	
	}
</script>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="17" rowspan="2" valign="top" bgcolor="#FFFFFF"></td>
		<td valign="top">
			<table width="100%" height="31" border="0" cellpadding="0" cellspacing="0">
				<tr bgcolor="#FFFFFF"><td height="31"><div class="title">修改密码</div></td></tr>
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
							<form name="form1" method="post" action="?" onSubmit="return check()">
								<table width="100%" class="cont tr_color">
									<tr class="d">
										<td width="40%" align="right">帐号： </td>
										<td><?php echo $rs["username"];?></td>
									</tr>
                                    
                                    <tr class="d">
										<td align="right">原 密 码： </td>
										<td><input class="text" type="password" name="oldpassword" value=""/> </td>
									</tr>
									<tr class="d">
										<td align="right">新 密 码： </td>
										<td><input class="text" type="password" name="password" value=""/> </td>
									</tr>
                                    <tr class="d">
										<td align="right">确认密码： </td>
										<td><input class="text" type="password" name="repassword" value=""/> </td>
									</tr>
									
									<tr class="d">
										<td align="right">&nbsp;</td>
										<td><input class="btn" type="submit" value="提交" /></td>
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