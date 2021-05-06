<?php 
	include_once("inc.php");
	$tb_name = "content1";
	if ($_REQUEST["id"]) {
		$rs = $mysql->db_get_row("select * from $tb_name where id=". $_REQUEST["id"]);
	}
	if ($_POST){
		if ($_REQUEST["id"]) {
			if($_POST["number1"]!=$_POST["number11"]){
				$row1 = $mysql->db_get_row("select * from $tb_name where number1='". $_POST["number1"] ."'");
				if ($row1["id"]) {
					goBakMsg("编号重复，请重新填写");
					die;
			}
			}
		} else {
			$row1 = $mysql->db_get_row("select * from $tb_name number1='". $_POST["number1"] ."'");
				if ($row1["id"]) {
					goBakMsg("编号重复，请重新填写");
					die;
			}
		}
		$data = array();
		$data["title"] = "'".$_POST["title"]."'";
		$data["content"] = "'".$_POST["content"]."'";
		$data["price"] = "'".$_POST["price"]."'";
		$data["pricej"] = "'".$_POST["pricej"]."'";
		$data["number1"] = "'".$_POST["number1"]."'";
		$data["gongyingid"] = "'".$_POST["gongyingid"]."'";
		$data["categoryid"] = "'".$_POST["categoryid"]."'";
		if($_POST["mark1"]){$data["mark1"] = "'".$_POST["mark1"]."'";}
		if($_POST["mark2"]){$data["mark2"] = "'".$_POST["mark2"]."'";}
		if(!empty($_FILES['img']['name'])){
			$file = $_FILES['img'];//得到传输的数据
			//得到文件名称
			$name = $file['name'];
			$type = strtolower(substr($name,strrpos($name,'.')+1)); //得到文件类型，并且都转化成小写
			$allow_type = array('jpg','jpeg','gif','png'); //定义允许上传的类型
			//判断文件类型是否被允许上传
			if(!in_array($type, $allow_type)){
			  //如果不被允许，则直接停止程序运行
			}
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
		$data["content"] = "'".$_POST["content"]."'";
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
	if (document.add.number1.value=='')
	{
	alert('编号不能为空');
	document.add.number1.focus;
	return false
	}
	if (document.add.title.value=='')
	{
	alert('名称不能为空');
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
				<tr bgcolor="#FFFFFF"><td height="31"><div class="title">添加/修改信息</div></td></tr>
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
								<form name="add" method="post" action="?" onSubmit="return checkadd()" enctype="multipart/form-data">
								<input type="hidden" name="id" value="<?php echo $rs["id"];?>" />
                                <input type="hidden" name="number11" value="<?php echo $rs["number1"];?>" />
                                    <table width="100%" class="cont">
                                        <?php 
											$categoryA = $mysql->db_get_all("select * from category order by id asc");
											if(!empty($categoryA[0])){
										?>
                                        <tr>
                                          <td width="40%" align="right">选择分类：</td>
                                          <td>
                                          <select name="categoryid">
											  <?php foreach($categoryA as $row) {	?>
                                                <option value="<?php echo $row["id"];?>" <?php if($rs["categoryid"]==$row["id"]){echo ' selected="selected" ';}?>><?php echo $row["title"];?></option>
                                            <?php } ?>
                                          </select>
                                          </td>
                                      </tr>
                                        <?php }?>
                                        <?php 
											$gongyinga = $mysql->db_get_all("select * from gongying order by id asc");
											if(!empty($gongyinga[0])){
										?>
                                        <tr>
                                          <td width="" align="right">选择供应商：</td>
                                          <td>
                                          <select name="gongyingid">
											  <?php foreach($gongyinga as $row) {	?>
                                                <option value="<?php echo $row["id"];?>" <?php if($rs["gongyingid"]==$row["id"]){echo ' selected="selected" ';}?>><?php echo $row["title"];?></option>
                                            <?php } ?>
                                          </select>
                                          </td>
                                      </tr>
                                        <?php }?>
                                        
                                        <tr>
                                          <td width="" align="right">编号：</td>
                                          <td><input name="number1" type="text" class="text" size="30" value="<?php echo $rs["number1"];?>" required></td>
                                        </tr>
                                        <tr>
                                          <td width="" align="right">名称：</td>
                                          <td><input name="title" type="text" class="text" size="30" value="<?php echo $rs["title"];?>" required></td>
                                        </tr>
                                        <tr>
                                          <td width="" align="right">进货价：</td>
                                          <td><input name="pricej" type="text" class="text" size="30" value="<?php echo $rs["pricej"];?>" required></td>
                                        </tr>
                                        <tr>
                                          <td width="" align="right">销售价：</td>
                                          <td><input name="price" type="text" class="text" size="30" value="<?php echo $rs["price"];?>" required></td>
                                        </tr>
                                        <tr>
                                          <td width="" align="right">规格型号：</td>
                                          <td><input name="mark1" type="text" class="text" size="30" value="<?php echo $rs["mark1"];?>" required> 
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                          <td align="right">图片：</td>
                                          <td><input type="file" name="img" class="text" id="img"><?php if(!empty($rs['img'])){?><img src="<?php echo __PUBLIC__;?>/Upload/<?php echo $rs["img"];?>" height="50" width="50"/><?php }?></td>
                                        
                                        </tr>
                                        <tr>
                                          <td width="" align="right">备注：</td>
                                          <td><textarea name="content" cols="30" required class="text"><?php echo $rs["content"];?></textarea></td>
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
