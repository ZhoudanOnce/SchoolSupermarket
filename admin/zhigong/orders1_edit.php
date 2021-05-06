<?php 
	include_once("inc.php");
	$tb_name = "orders1";
	$rs = array();
	if ($_REQUEST["id"]) {
		$rs = $mysql->db_get_row("select * from $tb_name where id=". $_REQUEST["id"]);
	}
	if ($_POST){
		$data = array();
		$data["nums"] = "'".$_POST["nums"]."'";
		$data["content1id"] = "'".$_POST["content1id"]."'";
		$pricex = $mysql->db_get_val("content1",$_POST["content1id"],"price")*$_POST["nums"];
		$pricej = $mysql->db_get_val("content1",$_POST["content1id"],"pricej")*$_POST["nums"];
		$yingli = $pricex-$pricej;
		$data["pricex"] = "'".$pricex."'";
		$data["pricej"] = "'".$pricej."'";
		$data["categoryid"] = "'".$mysql->db_get_val("content1",$_POST["content1id"],"categoryid")."'";
		$data["gongyingid"] = "'".$mysql->db_get_val("content1",$_POST["content1id"],"gongyingid")."'";
		$data["number1"] = "'".$mysql->db_get_val("content1",$_POST["content1id"],"number1")."'";
		$data["yingli"] = "'".$yingli."'";
		$data["price"] = "'".$mysql->db_get_val("content1",$_POST["content1id"],"price")."'";
		$data["kucunid"] = "'".$_POST["kucunid"]."'";
		$data["ordersid"] = "'".$_POST["ordersid"]."'";
		$data["orderstitle"] = "'".$mysql->db_get_val("orders",$_POST["ordersid"],"title")."'";
		$rs1 = $mysql->db_get_row("select * from kucun where id=".$_POST["kucunid"]);
		$data["zhigongid"] = "'".$_SESSION["zhigongid"]."'";
		if($rs1['nums']<$_POST["nums"]){
			goBakMsg("库存不足");die;
		}
		else{
			$rsj = $mysql->db_get_row("select * from $tb_name where ordersid=". $_POST["ordersid"]." and content1id=".$_POST["content1id"]);
			if($rsj["id"]){
				$numsa = $_POST["nums"]+$rsj["nums"];
				$yingli = $yingli+$rsj["yingli"];
				$pricex = $pricex+$rsj["pricex"];
				$pricej = $pricej+$rsj["pricej"];
				$mysql->db_query("update $tb_name set nums=".$numsa.",yingli=".$yingli.",pricex=".$pricex.",pricej=".$pricej."  where id=".$rsj["id"]);
			}else{
			$mysql->db_add($tb_name,$data);}
			$mysql->db_query("update content1 set nums=nums-".$_POST["nums"]." where id=".$_POST["content1id"]);
			$mysql->db_query("update kucun set nums=nums-".$_POST["nums"]." where id=".$_POST["kucunid"]);
		}
		urlMsg("提交成功", $tb_name."_list.php?ordersid=".$_POST["ordersid"]);
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
				<tr bgcolor="#FFFFFF"><td height="31"><div class="title">采购出库</div></td></tr>
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
								<form name="add" method="post" action="?"  enctype="multipart/form-data">
                                    <input type="hidden" name="kucunid" value="<?php echo $_REQUEST["kucunid"];?>" />
                                    <input type="hidden" name="classifyid" value="<?php echo $_REQUEST["classifyid"];?>" />
									<input type="hidden" name="ordersid" value="<?php echo $_REQUEST["ordersid"];?>" />
                                    <input type="hidden" name="content1id" value="<?php echo $_REQUEST["content1id"];?>" />
                                    <table width="100%" class="cont">
                                       <tr>
                                          <td width="40%" align="right">商品：</td>
                                          <td>
                                          <?php echo $mysql->db_get_val("content1",$_REQUEST["content1id"],"title");?>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td width="" align="right"> 商品编号：</td>
                                          <td width=""><?php echo $mysql->db_get_val("content1",$_REQUEST["content1id"],"number1")?></td>

                                        </tr>
                                        <tr>
                                          <td width="" align="right"> 商品类别：</td>
                                          <td width=""><?php echo $mysql->db_get_val("category",$mysql->db_get_val("content1",$_REQUEST["content1id"],"categoryid"),"title")?></td>

                                        </tr>
                                        <tr>
                                          <td width="" align="right"> 商品供应商：</td>
                                          <td width=""><?php echo $mysql->db_get_val("gongying",$mysql->db_get_val("content1",$_REQUEST["content1id"],"gongyingid"),"title")?></td>

                                        </tr>
                                        <tr>
                                          <td width="" align="right"> 商品描述：</td>
                                          <td width=""><?php echo $mysql->db_get_val("content1",$_REQUEST["content1id"],"content")?></td>
       
                                        </tr>
                                       
                                        
                                        <tr>
                                          <td width="" align="right"><span class="red">*</span> 数量：</td>
                                          <td width=""><input name="nums" type="text" class="text" size="30" required></td>
                                            
                                        </tr>
                                        <tr>
                                            <td align="right"></td>
                                            <td><input type="submit" class="btn" id="submitBtn" value="提交" ><input name="button" type="button" class="btn" onClick="javascript:history.back();" value="返回"></td>
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