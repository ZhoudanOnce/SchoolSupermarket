<?php 
	include_once("inc.php");
	$tb_name = "about";
	$rs = array();
	if ($_REQUEST["id"]) {
		$rs = $mysql->db_get_row("select * from $tb_name where id=". $_REQUEST["id"]);
	}
	
	
?>
<?php include_once("base.php");?>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="17" rowspan="2" valign="top" bgcolor="#FFFFFF"></td>
		<td valign="top">
			<table width="100%" height="31" border="0" cellpadding="0" cellspacing="0">
				<tr bgcolor="#FFFFFF"><td height="31"><div class="title"><?php echo $rs["title"]?></div></td></tr>
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
								
                                    <table width="100%" class="cont">
                                        <tr>
                                          <td align="center"><?php echo $rs["title"];?></td>
                                        </tr>
                                       
                                        <tr>
                                          <td align="left">
                                            <div style="margin:20px; line-height:25px;">
                                           <?php echo $rs['content'];?></div><center><input name="button" type="button" class="btn" onClick="javascript:history.back();" value="返回"></center></td>
                                        </tr>
                                    </table>
							
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