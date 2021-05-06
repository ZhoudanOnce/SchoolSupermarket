<?php 
	include_once("inc.php");
	$tb_name = "crk";
	if ($_REQUEST["id"]) {
		$rs = $mysql->db_get_row("select * from $tb_name where id=". $_REQUEST["id"]);
	}
	if ($_POST){
		$data = array();
		if ($_REQUEST["id"]) {
			
		} else {
			$number1=date("YmjHis");//编号生成
			$data["cnumber1"] = "'".$number1."'";
		}
		$row1 = $mysql->db_get_row("select * from kucun where  classifyid=".$_POST["classifyid"]." and content1id=".$_POST["content1id"]);
				if (!$row1["id"]) {
					$data1["content1id"] = "'".$_POST["content1id"]."'";
					$data1["classifyid"] = "'".$_POST["classifyid"]."'";
					$data1["number1"] = "'".$mysql->db_get_val("content1",$_POST["content1id"],"number1")."'";
					$data1["categoryid"] = "'".$mysql->db_get_val("content1",$_POST["content1id"],"categoryid")."'";
					$data1["gongyingid"] = "'".$mysql->db_get_val("content1",$_POST["content1id"],"gongyingid")."'";
					$mysql->db_add("kucun",$data1);
				}
		$data["adminid"] = "'".$_SESSION["adminid"]."'";
		$data["nums"] = "'".$_POST["nums"]."'";
		$data["classifyid"] = "'".$_POST["classifyid"]."'";
		$data["content1id"] = "'".$_POST["content1id"]."'";
		$data["mprice"] = "'".$_POST["mprice"]."'";
		$data["number1"] = "'".$mysql->db_get_val("content1",$_POST["content1id"],"number1")."'";
		$data["categoryid"] = "'".$mysql->db_get_val("content1",$_POST["content1id"],"categoryid")."'";
		$data["begintime"] = "'".$_POST["begintime"]."'";
		$data["totals"] = "'".$_POST["mprice"]*$_POST["nums"]."'";
		$data["type"] = "'".$_POST["type"]."'";
		if ($_REQUEST["id"]) {
			$mysql->db_mdf($tb_name,$data,$_REQUEST["id"]);
			if($_POST["nums"]!=$_POST["nums1"]){
				$mysql->db_query("update content1 set nums=nums+".$_POST["nums"]."-".$_POST["nums1"]." where id=".$_POST["content1id"]);
				$mysql->db_query("update kucun set nums=nums+".$_POST["nums"]."-".$_POST["nums1"]." where classifyid=".$_POST["classifyid"]." and content1id=".$_POST["content1id"]);
				}
		} else {
			$mysql->db_add($tb_name,$data);
			$mysql->db_query("update content1 set nums=nums+".$_POST["nums"]." where id=".$_POST["content1id"]);
			$mysql->db_query("update kucun set nums=nums+".$_POST["nums"]." where classifyid=".$_POST["classifyid"]." and  content1id=".$_POST["content1id"]);
		}
		urlMsg("提交成功", $tb_name."_list.php?type=入库");
		die;
	}
?>
<?php include_once("base.php");?>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="17" rowspan="2" valign="top" bgcolor="#FFFFFF"></td>
		<td valign="top">
			<table width="100%" height="31" border="0" cellpadding="0" cellspacing="0">
				<tr bgcolor="#FFFFFF"><td height="31"><div class="title">添加/修改入库</div></td></tr>
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
                                <input type="hidden" name="nums1" value="<?php echo $rs["nums"];?>" />
                                <input type="hidden" name="content1id" value="<?php echo $_REQUEST["content1id"];?>" />
                                <input type="hidden" name="type" value="<?php echo $_REQUEST["type"];?>" />
                                    <table width="100%" class="cont">
                                       <?php 
											$bumena = $mysql->db_get_all("select * from classify  order by id asc");
											if(!empty($bumena[0])){
										?>
                                        <tr>
                                          <td width="40%" align="right"> 选择片区：</td>
                                          <td >
                                          <select name="classifyid">
											  <?php foreach($bumena as $row) {	?>
                                                <option value="<?php echo $row["id"];?>" <?php if($rs["classifyid"]==$row["id"]){echo ' selected="selected" ';}?>><?php echo $row["title"];?></option>
                                            <?php } ?>
                                          </select>
                                          </td>
                                        </tr>
                                        <?php }?>
                                        <tr>
                                          <td width="" align="right"> 商品名称：</td>
                                          <td width="">
                                          <?php echo $mysql->db_get_val("content1",$_REQUEST["content1id"],"title")?>
											  </td>
                                        </tr>
                                        <tr>
                                          <td width="" align="right"><span class="red">*</span> 进货价：</td>
                                          <td width=""><input name="mprice" type="text" class="text" size="30" value="<?php echo $rs["mprice"];?>" /></td>
                                        </tr>
                                        <tr>
                                          <td width="" align="right"><span class="red">*</span> 数量：</td>
                                          <td width=""><input name="nums" type="text" class="text" size="30" value="<?php echo $rs["nums"];?>" onKeyUp="this.value=this.value.replace(/\D/g,'')" onBlur="this.value=this.value.replace(/\D/g,'')"/></td>
                                        </tr>
                                        <tr>
                                          <td width="" align="right"><span class="red">*</span> 日期：</td>
                                          <td width="">    
                                          		<input name="begintime" id="datepicker" type="text"   onClick="WdatePicker()" style="width:350px;" class="text" value="<?php echo $rs["begintime"];?>" required></td>
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
