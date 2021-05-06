<?php 
	include_once("inc.php");
	$tb_name="zhigong";
	$rs = $mysql->db_get_row("select * from $tb_name where id=".$_SESSION["zhigongid"]);
	if ($_POST){
		$data = array();
		if(!$_REQUEST["id"]){
			$row = $mysql->db_get_row("select * from $tb_name where username='". $_POST["username"] ."'");
			if ($row["id"]) {
				goBakMsg("工号已存在");
				die;
			}else{
				$data["username"] = "'".$_POST["username"]."'";
			}
		}
		if($_POST["password"]){
		$data["password"] = "'".$_POST["password"]."'";}
		$data["zname"] = "'".$_POST["zname"]."'";
		$data["sex"] = "'".$_POST["sex"]."'";	
		$data["begintime"] = "'".$_POST["begintime"]."'";
		$data["desc1"] = "'".$_POST["desc1"]."'";
		$data["tel"] = "'".$_POST["tel"]."'";
		$data["hun"] = "'".$_POST["hun"]."'";
		
		$data["ruzhitime"] = "'".$_POST["ruzhitime"]."'";

		
		$data["zhuzhi"] = "'".$_POST["zhuzhi"]."'";
		if(!empty($_FILES['img']['name'])){
			$file = $_FILES['img'];//得到传输的数据
			//得到文件名称
			$name = $file['name'];
			$type = strtolower(substr($name,strrpos($name,'.')+1)); //得到文件类型，并且都转化成小写
			//判断是否是通过HTTP POST上传的
			$upload_path = ROOT_PATH.'/Public/Upload/'; //上传文件的存放路径
			
			//开始移动文件到相应的文件夹
			$mu=mt_rand(1,10000000);
			if(move_uploaded_file($file['tmp_name'],$upload_path.$mu.".".$type)){
			  $fileName =$mu.".".$type;
			}else{
			  //echo "Failed!";
			}
			$data["img"] = "'".$fileName."'";	
		}	

		if ($_REQUEST["id"]) {
			$mysql->db_mdf($tb_name,$data,$_REQUEST["id"]);
		} else {
			$mysql->db_add($tb_name,$data);
		}
		goBakMsg("操作成功");
		die;
	}
?>
<?php include_once("base.php");?>
<script>
function check()
{
	if (document.form1.username.value=='')
	{
		alert('工号不能为空');
		document.form1.username.focus();
		return false
	}
	if (document.form1.zname.value=='')
	{
		alert('姓名不能为空');
		document.form1.zname.focus();
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
				<tr bgcolor="#FFFFFF"><td height="31"><div class="title">修改资料</div></td></tr>
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
                                          <td width="40%" align="right">片区：</td>
                                          <td width=""><?php echo $mysql->db_get_val("classify",$rs["classifyid"],"title")?></td>
                                        </tr>
										<tr>
                                          <td width="40%" align="right"><span class="red">*</span> 工号：</td>
                                          <td width=""><?php echo $rs["username"];?></td>
                                        </tr>
        
                                        <tr>
                                          <td width="" align="right"><span class="red">*</span> 姓名：</td>
                                          <td width=""><input class="text" name="zname" type="text" maxlength="18" value="<?php echo $rs["zname"];?>"></td>
                                        </tr>
                                        <tr>
                                          <td width="" align="right"><span class="red">*</span> 性别：</td>
                                          <td width="">
                                          	<select name="sex">
                                                <option value="男" <?php if($rs["sex"]=="男"){echo "selected";}?>>男</option>
                                                <option value="女" <?php if($rs["sex"]=="女"){echo "selected";}?>>女</option>
                                            </select></td>
                                        </tr>
                                        <tr>
                                          <td width="" align="right">出生日期：</td>
                                          <td width="">    
                                          		<input name="begintime" id="datepicker" type="text"   onClick="WdatePicker()" style="width:350px;" class="text" value="<?php echo $rs["begintime"];?>" required></td>
                                        </tr>
                                        <tr>
                                          <td width="" align="right"> 图片上传：</td>
                                          <td width=""><input type="file" name="img" class="text" id="img"><?php if(!empty($rs['img'])){?><img src="<?php echo __PUBLIC__;?>/Upload/<?php echo $rs["img"];?>" height="50" width="50"/><?php }?></td>
                                        </tr>
                                        <tr>
                                          <td width="" align="right">电话：</td>
                                          <td width=""><input name="tel" type="text" class="text" size="30"  maxlength="20" value="<?php echo $rs["tel"];?>" required></td>
                                        </tr>
                                         <tr>
                                          <td width="" align="right"><span class="red">*</span> 婚姻状况：</td>
                                          <td width="">
                                          	<select name="hun">
                                                <option value="已婚" <?php if($rs["hun"]=="已婚"){echo "selected";}?>>已婚</option>
                                                <option value="未婚" <?php if($rs["hun"]=="未婚"){echo "selected";}?>>未婚</option>
                                                <option value="其它" <?php if($rs["hun"]=="其它"){echo "selected";}?>>其它</option>
                                            </select></td>
                                        </tr>
                                        
                                        <tr>
                                          <td width="" align="right">入职时间：</td>
                                          <td width="">    
                                          		<input name="ruzhitime" id="datepicker" type="text"   onClick="WdatePicker()" style="width:350px;" class="text" value="<?php echo $rs["ruzhitime"];?>" required></td>
                                        </tr>
                                         <tr>
                                          <td width="" align="right">备注：</td>
                                          <td width=""><textarea name="desc1" cols="30" class="text"><?php echo $rs["desc1"];?></textarea></td>
                                        </tr>

                                        <tr>
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