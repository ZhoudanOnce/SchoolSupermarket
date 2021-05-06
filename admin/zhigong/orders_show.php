<?php
include_once("inc.php");
$tb_name = "orders";
$id = !empty($_GET['id']) ? intval($_GET['id']) : '';
$info = $mysql->db_get_row("select * from $tb_name where id='".$id."'");
?>
<?php include_once("base.php");?>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="17" rowspan="2" valign="top" bgcolor="#FFFFFF"></td>
		<td valign="top">
			<table width="100%" height="31" border="0" cellpadding="0" cellspacing="0">
				<tr bgcolor="#FFFFFF"><td height="31"><div class="title">订单查看</div></td></tr>
			</table>
		</td>
		<td width="16" rowspan="2" bgcolor="#FFFFFF"></td>
	</tr>
	<tr>
	<td valign="top" bgcolor="#F7F8F9">
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr><td colspan="4" height="10"></td></tr>
            <tr><td width="1%">&nbsp;</td><td width="96%">
            <table width="100%" class="cont">
			<tr>
            <td width="1%"></td>
            <td>
            订单编号:<?php echo $info['title'];?>
            </td></tr></table>
            </td><td width="1%">&nbsp;</td></tr>
			<tr>
				<td width="1%">&nbsp;</td>
				<td width="96%">
					<table width="100%">
						<td colspan="2">
							<table width="100%"  class="cont tr_color">
								<tr>
                                    <th>商品名称</th>
                                    <th>数量</th>
                                    <th>金额</th>
                                </tr>
<?php 
	$total = 0;
	$ordersta = $mysql->db_get_all("select * from orders1 where ordersid=".$info['id']." order by id desc");foreach($ordersta as $ordersrow) {
	$info1=$mysql->db_get_row("select * from content1 where id=".$ordersrow['content1id']);//调出商品信息
?>
								<tr align="center" class="d">
									<td><?php echo $info1['title'];?></td>
                                    <td align="center"><?php echo $ordersrow['nums'];?></td>
                                    <td><?php echo $ordersrow['pricex'];?></td>
                                </tr>
                                <?php  
								$total = $total+$ordersrow['pricex'];
								} ?>
                                <tr align="center" class="d">
									<td colspan="3">总计:<?php echo $total;?> 元</td>
                                </tr>
							</table>
						</td>
					</tr>
					</table>
                    
					    <table width="100%" cellPadding="6" bgcolor="#cecece" class="table table-bordered">
  <tr>
    <td height="20" align="center">
   <input name="button" type="button" class="btn" onClick="javascript:history.back();" value="返回">    </td>
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