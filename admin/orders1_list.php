<?php 
	include_once("inc.php");
	$tb_name="orders1";
	$page = $_REQUEST["page"]?$_REQUEST["page"]:1;
	$where_sql .= " ordersid=". $_REQUEST["ordersid"]." ";
	//echo "select * from $tb_name where $where_sql order by id desc";die;
	$list = $mysql->db_get_page("select * from $tb_name where $where_sql order by id desc", $page,10);
	if ($page*1>$list["page"]*1){
		$page = $list["page"];
	}
	$Page = new PageWeb($list["total"],$list["page_size"], "", $page);
	$page_show = $Page->show(); 
?>
<?php include_once("base.php");?>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="17" rowspan="2" valign="top" bgcolor="#FFFFFF"></td>
		<td valign="top">
			<table width="100%" height="31" border="0" cellpadding="0" cellspacing="0">
				<tr bgcolor="#FFFFFF"><td height="31"><div class="title"><a href="kucun_list1.php?ordersid=<?php echo $_REQUEST["ordersid"];?>">添加</a></div></td></tr>
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
						<td colspan="2">
							<table width="100%"  class="cont tr_color">
								<tr>
									<th>编号</th>
									<th>商品</th>
                                    <th>销售价</th>
                                    <th>数量</th><th width="120">操作</th>
                                </tr>
                                <?php
									$totals = 0;
								foreach($list["data"] as $row) {
								?>
								<tr align="center" class="d">
									<?php $total = $row['price']*$row['nums'];?>
									<td><?php echo $mysql->db_get_val("content1",$row["content1id"],"number1");?></td>
                                    <td><?php echo $mysql->db_get_val("content1",$row["content1id"],"title");?></td>
                                    <td><?php echo $row['price'];?></td>
                                    <td><?php echo $row['nums'];?></td><td><a href="?id=<?php echo $row['id'];?>&act=del&ordersid=<?php echo $row['ordersid'];?>&nums=<?php echo $row['nums'];?>&content1id=<?php echo $row['content1id'];?>&kucunid=<?php echo $row['kucunid'];?>" onclick='return confirm("真的要退货?不可恢复!");'>退货</a></td>
                                </tr>
                                <?php
								$totals = $totals+$total;
								} ?>
							</table>
						</td>
					</tr>
					</table>
					<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
                        <tr>
                          <td align="center"><?php echo $page_show;?><br><input name="button" type="button" class="btn" onClick="window.location.href='orders_list.php'" value="返回"></td>
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
<?php
	if ($_REQUEST["act"]=="del") {
		$mysql->db_del($tb_name,$_REQUEST["id"]);
		$mysql->db_query("update content1 set nums=nums+".$_REQUEST["nums"]." where id=".$_REQUEST["content1id"]);
		$mysql->db_query("update kucun set nums=nums+".$_REQUEST["nums"]." where id=".$_REQUEST["kucunid"]);
		urlMsg("操作成功", $tb_name."_list.php?ordersid=".$_REQUEST["ordersid"]);
	}

$mysql->db_query("update orders set totals=".$totals." where id=".$_REQUEST["ordersid"]);

?>
</body>
</html>