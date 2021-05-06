<?php 
	include_once("inc.php");
	$tb_name = "about";
	$rs = $mysql->db_get_row("select * from $tb_name where id=".$_REQUEST["id"]);
	if ($_POST){
		$data = array();
		$data["content"] = "'".$_POST["content"]."'";
		if($_POST["desc1"]){$data["desc1"] = "'".$_POST["desc1"]."'";}
		$mysql->db_mdf($tb_name,$data,$_REQUEST["id"]);
		goBakMsg("修改成功");
	}
?>
<?php include_once("base.php");?>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="17" rowspan="2" valign="top" bgcolor="#FFFFFF"></td>
		<td valign="top">
			<table width="100%" height="31" border="0" cellpadding="0" cellspacing="0">
				<tr bgcolor="#FFFFFF"><td height="31"><div class="title"><?php echo $rs['title'];?></div></td></tr>
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
                                          <td width="120" align="right"> 内容：</td>
                                          <td><script type="text/javascript" charset="utf-8" src="<?php echo __ADMIN__;?>/static/ueditor/ueditor.config.js"></script>
											<script type="text/javascript" charset="utf-8" src="<?php echo __ADMIN__;?>/static/ueditor/ueditor.all.min.js"> </script>
                                            <script type="text/javascript" charset="utf-8" src="<?php echo __ADMIN__;?>/static/ueditor/lang/zh-cn/zh-cn.js"></script>
                                            <script type="text/javascript">
                                            $(function(){
                                                $("#submitBtn").click(function(){
                                                    $("#content").val(UE.getEditor('editor').getContent());
                                                    $("#form1").submit();
                                                });
                                            
                                                var ue = UE.getEditor('editor');
                                            });
                                            </script>
											<script id="editor" type="text/plain" style="width:100%;height:200px;"><?php echo $rs['content'];?></script>
											<textarea name="content" id="content" style="display:none;"><?php echo $rs['content'];?></textarea></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td><td align=""><input class="btn" id="submitBtn" type="submit" value="提交" />  <input name="button" type="button" class="btn" onClick="javascript:history.back();" value="返回"></td>
                                            
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