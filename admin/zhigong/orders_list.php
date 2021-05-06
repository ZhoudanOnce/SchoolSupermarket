<?php 
	include_once("inc.php");
	$tb_name = "orders";
	$page = $_REQUEST["page"]?$_REQUEST["page"]:1;
	$where_sql = "zhigongid=".$_SESSION["zhigongid"];
	if ($_REQUEST["title"]) {
		$where_sql .= " and title like '%". $_REQUEST["title"] ."%' ";
	}
	if ($_REQUEST["stime"]) {
		$where_sql .= " and addtime >='". $_REQUEST["stime"]." 00:00:00'";
	} 
	if ($_REQUEST["etime"]) {
		$where_sql .= " and addtime <='". $_REQUEST["etime"]." 23:59:59'";
	} 
	$list = $mysql->db_get_page("select * from $tb_name where $where_sql order by id desc", $page,10);
	if ($page*1>$list["page"]*1){
		$page = $list["page"];
	}
	$Page = new PageWeb($list["total"],$list["page_size"], "&title=".$_REQUEST["title"], $page);
	$page_show = $Page->show(); 
?>
<?php include_once("base.php");?>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="17" rowspan="2" valign="top" bgcolor="#FFFFFF"></td>
		<td valign="top">
			<table width="100%" height="31" border="0" cellpadding="0" cellspacing="0">
				<tr bgcolor="#FFFFFF"><td height="31"><div class="title"><a href="<?php echo $tb_name;?>_edit.php">生成订单</a></div></td></tr>
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
            <td>
              <form id="pagerForm" action="?" method="get">
                 <input type="text" onFocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" class="text"  value='<?php echo $_REQUEST["stime"];?>' id='stime' name='stime'  placeholder="开始时间" >
                <input type="text" onFocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" class="text"  value='<?php echo $_REQUEST["etime"];?>' id='etime' name='etime'  placeholder="结束时间" >
                <input type="text" name="title" class="text" value="<?php echo $_REQUEST["title"]; ?>" placeholder="输入编号"/>
                <button type="submit"  id="chaxun" class="btn">查询</button> 共计：<?php $sums2 = $mysql->db_get_row("select sum(totals) as num from orders WHERE $where_sql");  if($sums2['num']==""){echo "0";}else{echo $sums2['num'];}?>
              </form></td></tr></table>
          </td><td width="1%">&nbsp;</td></tr>
			<tr>
				<td width="1%">&nbsp;</td>
				<td width="96%">
					<table width="100%">
						<td colspan="2">
                        <form action="?" method="post" name="lsm" id="lsm">
  <input type="hidden" name="chk" value="ok" />
							<table width="100%"  class="cont tr_color">
								<tr>
								  <th>编号</th>
								  <th>操作员</th>
                                  <th>金额</th>
                                  <th width="200">商品管理</th>
                                  <th width="160">操作</th>
							  </tr>
                                <?php
									foreach($list['data'] as $row) {
								?>
								<tr align="center" class="d">
                                <td align="center"><?php echo $row['title'];?></td>
									<td align="center"><?php if($row["adminid"]>0){echo $mysql->db_get_val("admin",$row["adminid"],"aname");}else{echo $mysql->db_get_val("zhigong",$row["zhigongid"],"zname");}?></td>
									<td align="center"><?php echo $row['totals'];?></td>
                                    <td align="center"><a href="orders1_list.php?ordersid=<?php echo $row['id'];?>">商品管理</a></td>
                                    <td><a href="<?php echo $tb_name;?>_show.php?id=<?php echo $row['id'];?>">查看</a>&nbsp;&nbsp;<a href="?id=<?php echo $row['id'];?>&act=del" onclick='return confirm("真的要删除?!");'>删除</a></td>
								</tr>
                                <?php } ?>
                                
							</table></form>
						</td>
					</tr>
					</table>
					<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
                        <tr>
                          <td align="center"><?php echo $page_show;?></td>
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

$act = !empty($_GET['act']) ? trim($_GET['act']) : '';
  if($act == 'del')
	{
		$rs1 = $mysql->db_get_all("select * from orders1 where ordersid=". $_REQUEST["id"]);
		if($rs1[0]){goBakMsg("订单下有商品，请删除商品后删除订单");die;}
		$mysql->db_del($tb_name,$_REQUEST["id"]);
		urlMsg("操作成功", $tb_name."_list.php");
	}
?>
</body>
</html>